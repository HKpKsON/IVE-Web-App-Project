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
	
	/*	Hash Salt Generator
	************************************************
		$this->saltgen(salt_length)
			return salt; [with length n]
	************************************************
		By KEN	*/
	public function saltgen($length = 32)
	{
		$charset = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$charsetlength = strlen($charset);
		$salt = '';
		
		for ($i = 0; $i < $length; $i++){
			$salt .= $charset[rand(0, $charsetlength - 1)];
		}
		
		return $salt;
	}
	
	/*	Username or Email to User ID
	************************************************
		$this->findid(user_username or user_email)
			return user_id;	[If found]
			return false;	[If not found]
	************************************************
		By KEN */
	public function findid($info)
	{
		$stmt = $this->connection->prepare('
            SELECT id
             FROM users
             WHERE email = :info
			 OR username = :info
        ');
        $stmt->bindParam(':info', $info);
        $stmt->execute();
		
		if($stmt->rowCount() == 1){
			$row = $stmt->fetch(PDO::FETCH_ASSOC);
			return $row['id'];
		}
		
		return false;
	}
	
	/*	Find User's Password salt
	************************************************
		$this->findsalt(users_id)
			return user_password_salt;	[If user found]
			return false;	[If user not found]
	************************************************
		By KEN */
	private function findsalt($id)
	{
		$user = $this->find($id);
		if($user != false){
			$salt = substr($user->password, -32);
			return $salt;
		}
		
		return false;
	}

	/*	HASH & SALT Password
	************************************************
		$this->hashnsalt(password, salt)
			return hashed and salted password;
	************************************************
		By KEN */
	public function hashnsalt($password, $salt)
	{
		return hash('sha256', hash('sha256', $password) . $salt) . '*' . $salt;
	}
	
	/*	Login Function
	************************************************
		$this->login(users_obj);
			return user_id;	[If login sucess]
			return false;	[If login failed]
	************************************************
		By KEN */
	public function login($users)
    {
		if(isset($users->email)){
			$id = $this->findid($users->email);
		}else if(isset($users->username)){
			$id = $this->findid($users->username);
		}else if(isset($users->id)){
			$id = $users->id;
		}
		
		if($id == false || !isset($users->password)){
			return false;
		}else{
			$salt = $this->findsalt($id);
		}
		
		$users->password = $this->hashnsalt($users->password ,$salt);
		
        $stmt = $this->connection->prepare('
            SELECT id
             FROM users
             WHERE id = :id
			 AND password = :password
        ');
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':password', $users->password);
        $stmt->execute();
		
		$stmt->setFetchMode(PDO::FETCH_CLASS, '\Models\Users');
		
		if($stmt->rowCount() == 1){
			$row = $stmt->fetch();
			return $row->id;
		}
		
        return false;
    }

	/* Adding User
	************************************************
		$this->adduser(users_obj);
			return -1;	[If sucess]
			return 0;	[If DB error]
			return 1;	[If username taken]
			return 2;	[If password is null]
	************************************************
	*/
	public function adduser($users)
	{
		if($this->findid($users->username) != false){
			return 1;
		}elseif($users->password == null){
			return 2;
		}
		
		// Salting on password
		$salt = $this->saltgen();
		$users->password = $this->hashnsalt($users->password ,$salt);
		
		if($this->save($users) == false){
			return 0;
		}
		
		return -1;
	}
}