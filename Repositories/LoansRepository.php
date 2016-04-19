<?php
namespace Repositories;

include_once "RepositoryBase.php";
include_once $_SERVER['DOCUMENT_ROOT'] ."/Models/Loans.php";

use \PDO;
use \Models\Loans;

class LoansRepository extends RepositoryBase
{

    public function find($id)
    {
        $stmt = $this->connection->prepare('
            SELECT "Loans", Loans.*
             FROM Loans
             WHERE id = :id
        ');
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        // Set the fetchmode to populate an instance of 'Student'
        // This enables us to use the following:
        //     $user = $repository->find(1234);
        //     echo $student->name;
        $stmt->setFetchMode(PDO::FETCH_CLASS, '\Models\Loans');
        return $stmt->fetch();
    }

    public function findAll($type = '%')
    {
        $stmt = $this->connection->prepare('
            SELECT * FROM Loans
            WHERE type LIKE :type
        ');
        $stmt->bindparam(':type', $type);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_CLASS, '\Models\Loans');

        // fetchAll() will do the same as above, but we'll have an array. ie:
        //    $users = $repository->findAll();
        //    echo $students[0]->name;
        return $stmt->fetchAll();
    }

    /**
     * @property Student $student
     */
    public function save($Loans)
    {
        // If the ID is set, we're updating an existing record
        if (isset($Loans->id)) {
            return $this->update($Loans);
        }
        $stmt = $this->connection->prepare('
            INSERT INTO Loans
                (logo, url, content, type)
            VALUES
                (:logo, :url, :content, :type)
        ');
        $stmt->bindParam(':logo', $Loans->logo);
        $stmt->bindParam(':url', $Loans->url);
        $stmt->bindParam(':content', $Loans->content);
        $stmt->bindParam(':type', $Loans->type);

        return $stmt->execute();
    }

    /**
     * @property Student $student
     */
    public function update($Loan)
    {
        if (!isset($Loan->id)) {
            // We can't update a record unless it exists...
            throw new \LogicException(
                'Cannot update user that does not yet exist in the database.'
            );
        }
        $stmt = $this->connection->prepare('
            UPDATE Loans
            SET logo = :logo,
                 url = :url,
                 content = :content,
                 type = :type

            WHERE id = :id
        ');

        $stmt->bindParam(':logo', $Loan->logo);
        $stmt->bindParam(':url', $Loan->url);
        $stmt->bindParam(':content', $Loan->content);
        $stmt->bindParam(':type', $Loan->type);
        $stmt->bindParam(':id', $Loan->id);
        return $stmt->execute();
    }

    /**
     * @property Student $student
     */
    public function destroy($id)
    {
        if (!isset($id)) {
            // We can't delete a record unless it exists...
            throw new \LogicException(
                'Cannot update user that does not yet exist in the database.'
            );
        }
        $stmt = $this->connection->prepare('
            Delete FROM Loans
            WHERE id = :id
        ');
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }

	public function findType()
    {
        $stmt = $this->connection->prepare('
            SELECT DISTINCT type
             FROM Loans
        ');
        $stmt->execute();

		$row = $stmt->fetchAll(PDO::FETCH_COLUMN);
		return $row;

    }

}