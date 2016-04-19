<?php
namespace Repositories;

include_once "RepositoryBase.php";
include_once $_SERVER['DOCUMENT_ROOT'] ."/Models/Polls.php";

use \PDO;
use \Models\Polls;

class PollsRepository extends RepositoryBase
{

    public function find($id)
    {
        $stmt = $this->connection->prepare('
            SELECT "Polls", polls.*
             FROM polls
             WHERE id = :id
        ');
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        // Set the fetchmode to populate an instance of 'poll'
        // This enables us to use the following:
        //     $user = $repository->find(1234);
        //     echo $poll->name;
        $stmt->setFetchMode(PDO::FETCH_CLASS, '\Models\Polls');
        return $stmt->fetch();
    }

    public function findAll()
    {
        $stmt = $this->connection->prepare('
            SELECT * FROM polls
			ORDER BY id DESC
        ');
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_CLASS, '\Models\Polls');

        // fetchAll() will do the same as above, but we'll have an array. ie:
        //    $users = $repository->findAll();
        //    echo $polls[0]->name;
        return $stmt->fetchAll();
    }

    /**
     * @property poll $poll
     */
    public function save($poll)
    {
        // If the ID is set, we're updating an existing record
        if (isset($poll->id)) {
            return $this->update($poll);
        }
        $stmt = $this->connection->prepare('
            INSERT INTO polls
                (title,publishdate,lastupdate,yes,no)
            VALUES
                (:title,:publishdate,:lastupdate,:yes,:no)
        ');
        $stmt->bindParam(':title', $poll->title);
        $stmt->bindParam(':publishdate', $poll->publishdate);
		$stmt->bindParam(':lastupdate', $poll->lastupdate);
		$stmt->bindParam(':yes', $poll->yes);
		$stmt->bindParam(':no', $poll->no);
        return $stmt->execute();
    }

    /**
     * @property poll $poll
     */
    public function update($poll)
    {
        if (!isset($poll->id)) {
            // We can't update a record unless it exists...
            throw new \LogicException(
                'Cannot update user that does not yet exist in the database.'
            );
        }
        $stmt = $this->connection->prepare('
            UPDATE polls
            SET title = :title,
                publishdate = :publishdate,
				lastupdate =:lastupdate,
				yes = :yes,
				no = :no
            WHERE id = :id
        ');
        $stmt->bindParam(':title', $poll->title);
        $stmt->bindParam(':publishdate', $poll->publishdate);
		$stmt->bindParam(':lastupdate', $poll->lastupdate);
		$stmt->bindParam(':yes', $poll->yes);
		$stmt->bindParam(':no', $poll->no);
        $stmt->bindParam(':id', $poll->id);
        return $stmt->execute();
    }

    /**
     * @property poll $poll
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
            Delete FROM polls
            WHERE id = :id
        ');
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }
}