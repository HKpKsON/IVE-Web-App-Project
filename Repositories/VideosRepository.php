<?php
namespace Repositories;

include_once "RepositoryBase.php";
include_once $_SERVER['DOCUMENT_ROOT'] ."/Models/Videos.php";

use \PDO;
use \Models\Videos;

class VideosRepository extends RepositoryBase
{

    public function find($id)
    {
        $stmt = $this->connection->prepare('
            SELECT "Videos", Videos.*
             FROM videos
             WHERE id = :id
        ');
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        // Set the fetchmode to populate an instance of 'Student'
        // This enables us to use the following:
        //     $user = $repository->find(1234);
        //     echo $student->name;
        $stmt->setFetchMode(PDO::FETCH_CLASS, '\Models\Videos');
        return $stmt->fetch();
    }

    public function findAll($type = '%')
    {
        $stmt = $this->connection->prepare('
            SELECT * FROM Videos
            WHERE type LIKE :type
        ');
        $stmt->bindparam(':type', $type);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_CLASS, '\Models\Videos');

        // fetchAll() will do the same as above, but we'll have an array. ie:
        //    $users = $repository->findAll();
        //    echo $students[0]->name;
        return $stmt->fetchAll();
    }

    /**
     * @property Student $student
     */
    public function save($Videos)
    {
        // If the ID is set, we're updating an existing record
        if (isset($Videos->id)) {
            return $this->update($Videos);
        }
        $stmt = $this->connection->prepare('
            INSERT INTO videos
                (type, video, content, title)
            VALUES
                (:type, :video, :content, :title)
        ');
        $stmt->bindParam(':type', $Videos->type);
        $stmt->bindParam(':video', $Videos->video);
        $stmt->bindParam(':content', $Videos->content);
        $stmt->bindParam(':title', $Videos->title);
        return $stmt->execute();
    }

    /**
     * @property Student $student
     */
    public function update($Videos)
    {
        if (!isset($Videos->id)) {
            // We can't update a record unless it exists...
            throw new \LogicException(
                'Cannot update user that does not yet exist in the database.'
            );
        }
        $stmt = $this->connection->prepare('
            UPDATE videos
            SET type = :type,
                video = :video,
                content= :content,
                title= :title
            WHERE id = :id
        ');

        $stmt->bindParam(':type', $Videos->type);
        $stmt->bindParam(':video', $Videos->video);
        $stmt->bindParam(':content', $Videos->content);
        $stmt->bindParam(':title', $Videos->title);
        $stmt->bindParam(':id', $Videos->id);
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
            Delete FROM videos
            WHERE id = :id
        ');
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }
    public function findType()
    {
        $stmt = $this->connection->prepare('
            SELECT DISTINCT type
             FROM videos
        ');
        $stmt->execute();

        $row = $stmt->fetchAll(PDO::FETCH_COLUMN);
        return $row;

    }
}