<?php
namespace Repositories;

include_once "RepositoryBase.php";
include_once $_SERVER['DOCUMENT_ROOT'] ."/Models/Users.php";

use \PDO;
use \Models\Users;

class UsersRepository extends RepositoryBase
{

    public function find($id)
    {
        $stmt = $this->connection->prepare('
            SELECT "users", users.*
             FROM users
             WHERE id = :id
        ');
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        // Set the fetchmode to populate an instance of 'users'
        // This enables us to use the following:
        //     $user = $repository->find(1234);
        //     echo $users->name;
        $stmt->setFetchMode(PDO::FETCH_CLASS, '\Models\Users');
        return $stmt->fetch();
    }

    public function findAll()
    {
        $stmt = $this->connection->prepare('
            SELECT * FROM users
        ');
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_CLASS, '\Models\Users');

        // fetchAll() will do the same as above, but we'll have an array. ie:
        //    $users = $repository->findAll();
        //    echo $users[0]->name;
        return $stmt->fetchAll();
    }

    public function save($users)
    {
        // If the ID is set, we're updating an existing record
        if (isset($users->id)) {
            return $this->update($users);
        }
        $stmt = $this->connection->prepare('
            INSERT INTO users
                (username, password, salutation, displayname, email, address, fullname, phone, country)
            VALUES
                (:username, :password, :salutation, :displayname, :email, :address, :fullname, :phone, :country)
        ');
        $stmt->bindParam(':username', $users->username);
        $stmt->bindParam(':password', $users->password);
        $stmt->bindParam(':salutation', $users->salutation);
        $stmt->bindParam(':displayname', $users->displayname);
        $stmt->bindParam(':email', $users->email);
        $stmt->bindParam(':address', $users->address);
        $stmt->bindParam(':fullname', $users->fullname);
        $stmt->bindParam(':phone', $users->phone);
        $stmt->bindParam(':country', $users->country);
        return $stmt->execute();
    }

    public function update($users)
    {
        if (!isset($users->id)) {
            // We can't update a record unless it exists...
            throw new \LogicException(
                'Cannot update user that does not yet exist in the database.'
            );
        }
        $stmt = $this->connection->prepare('
            UPDATE users
            SET username = :username,
                password = :password,
                salutation = :salutation,
                displayname = :displayname,
                email = :email,
                address = :address,
                fullname = :fullname,
                phone = :phone,
                country = :country,
				openid = :openid,
				isAdmin = :isAdmin
            WHERE id = :id
        ');

        $stmt->bindParam(':username', $users->username);
        $stmt->bindParam(':password', $users->password);
        $stmt->bindParam(':salutation', $users->salutation);
        $stmt->bindParam(':displayname', $users->displayname);
        $stmt->bindParam(':email', $users->email);
        $stmt->bindParam(':address', $users->address);
        $stmt->bindParam(':fullname', $users->fullname);
        $stmt->bindParam(':phone', $users->phone);
        $stmt->bindParam(':country', $users->country);
        $stmt->bindParam(':openid', $users->openid);
        $stmt->bindParam(':isAdmin', $users->isAdmin);
		
        $stmt->bindParam(':id', $users->id);
        return $stmt->execute();
    }

    public function destroy($id)
    {
        if (!isset($id)) {
            // We can't delete a record unless it exists...
            throw new \LogicException(
                'Cannot update user that does not yet exist in the database.'
            );
        }
        $stmt = $this->connection->prepare('
            Delete FROM users
            WHERE id = :id
        ');
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }
}