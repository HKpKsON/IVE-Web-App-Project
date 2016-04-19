<?php
namespace Repositories;

include_once "RepositoryBase.php";
include_once $_SERVER['DOCUMENT_ROOT'] ."/Models/News.php";


use \PDO;
use \Models\News;

class NewsRepository extends RepositoryBase
{

    public function find($id)
    {
        $stmt = $this->connection->prepare('
            SELECT *
             FROM new_data
             WHERE id = :id
        ');
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        // Set the fetchmode to populate an instance of 'Student'
        // This enables us to use the following:
        //     $user = $repository->find(1234);
        //     echo $student->name;
        $stmt->setFetchMode(PDO::FETCH_CLASS, '\Models\News');
        return $stmt->fetch();
    }

    public function findAll()
    {
        $stmt = $this->connection->prepare('
            SELECT * FROM new_data ORDER BY new_date DESC
        ');
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_CLASS, '\Models\News');

        // fetchAll() will do the same as above, but we'll have an array. ie:
        //    $users = $repository->findAll();
        //    echo $students[0]->name;
        return $stmt->fetchAll();
    }

    /**
     * @property Student $student
     */
    public function save($news)
    {
        // If the ID is set, we're updating an existing record
        if (isset($news->id)) {
            return $this->update($news);
        }
        $stmt = $this->connection->prepare('
            INSERT INTO new_data
                (author, title,text,category,new_date)
            VALUES
            (:author,:title,:text,:category,:new_date)
        ');
        $stmt->bindParam(':author', $news->author);
        $stmt->bindParam(':title', $news->title);
        $stmt->bindParam(':text', $news->text);
        $stmt->bindParam(':category', $news->category);
        $stmt->bindParam(':new_date', $news->new_date);
        return $stmt->execute();
    }

    /**
     * @property Student $student
     */
    public function update($news)
    {
       // if (!isset($news->id)) {
            // We can't update a record unless it exists...
            //throw new \LogicException(
               // 'Cannot update user that does not yet exist in the database.'
           // );
        //}
        $stmt = $this->connection->prepare('
            UPDATE new_data
            SET author=:author,
                  title=:title,
                  text=:text,
                  category=:category,
                  new_date=:new_date
            WHERE id = :id
        ');

        $stmt->bindParam(':author', $news->author);
        $stmt->bindParam(':title', $news->title);
        $stmt->bindParam(':text', $news->text);
        $stmt->bindParam(':category', $news->category);
        $stmt->bindParam(':new_date', $news->new_date);
        $stmt->bindParam(':id', $news->id);
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
            Delete FROM new_data
            WHERE id = :id
        ');
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }




}
class ComRepository extends RepositoryBase
{


    public function find($new_id)
    {
        $stmt = $this->connection->prepare('
            SELECT *
             FROM review
             WHERE new_id = :new_id
        ');
        $stmt->bindParam(':new_id', $new_id);
        $stmt->execute();

        // Set the fetchmode to populate an instance of 'Student'
        // This enables us to use the following:
        //     $user = $repository->find(1234);
        //     echo $student->name;
        $stmt->setFetchMode(PDO::FETCH_CLASS, '\Models\News');
        return $stmt->fetchAll();

    }

    public function findAll()
    {
        $stmt = $this->connection->prepare('
            SELECT * FROM review

        ');

        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_CLASS, '\Models\News');

        // fetchAll() will do the same as above, but we'll have an array. ie:
        //    $users = $repository->findAll();
        //    echo $students[0]->name;
        return $stmt->fetchAll();
    }

    /**
     * @property Student $student
     */
    public function save($com)
    {
        // If the ID is set, we're updating an existing record
       // if (isset($com->com_id)) {
           // return $this->update($com);
        //}
        $stmt = $this->connection->prepare('
            INSERT INTO review
                (com_id,new_id,com_author, com_text,com_date)
            VALUES
            (:com_id,:new_id,:com_author,:com_text,:com_date)
        ');
        $stmt->bindParam(':com_id', $com->com_id);
        $stmt->bindParam(':new_id', $com->new_id);
        $stmt->bindParam(':com_author', $com->com_author);
        $stmt->bindParam(':com_text', $com->com_text);
        $stmt->bindParam(':com_date', $com->com_date);
        return $stmt->execute();

    }

    /**
     * @property Student $student
     */
    public function update($com)
    {
       // if (!isset($com->com_id)) {
            // We can't update a record unless it exists...
            //throw new \LogicException(
              //  'Cannot update user that does not yet exist in the database.'
         //   );
      //  }
        $stmt = $this->connection->prepare('
            UPDATE review
            SET  com_text=:com_text,
                  com_date=:com_date,
            WHERE com_id = :com_id
        ');


        $stmt->bindParam(':com_text', $com->com_text);
        $stmt->bindParam(':com_date', $com->com_date);
        $stmt->bindParam(':com_id', $com->com_id);


        return $stmt->execute();







    }

    /**
     * @property Student $student
     */
    public function destroy($com_id)
    {
        if (!isset($com_id)) {
            // We can't delete a record unless it exists...
            throw new \LogicException(
                'Cannot update user that does not yet exist in the database.'
            );
        }
        $stmt = $this->connection->prepare('
            Delete FROM project.review
            WHERE com_id = :com_id
        ');
        $stmt->bindParam(':com_id', $com_id);
        return $stmt->execute();
    }


}
class CatRepository extends RepositoryBase{

    public function find($category)
    {
        $stmt = $this->connection->prepare('
            SELECT *
             FROM new_data
             WHERE category = :category
             ORDER BY new_date DESC
        ');
        $stmt->bindParam(':category', $category);
        $stmt->execute();



        // Set the fetchmode to populate an instance of 'Student'
        // This enables us to use the following:
        //     $user = $repository->find(1234);
        //     echo $student->name;
        $stmt->setFetchMode(PDO::FETCH_CLASS, '\Models\News');
        return $stmt->fetchAll();
    }


    public function findAll(){

    }

    public function save($o){

    }

    public function update($o){

    }

    public function destroy($o){

    }

}
