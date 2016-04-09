<?php
namespace Repositories;

include_once "RepositoryBase.php";
include_once $_SERVER['DOCUMENT_ROOT'] ."/Models/Verifications.php";

use \PDO;
use \Models\Verifications;

class VerificationsRepository extends RepositoryBase
{

    public function find($code)
    {
        $stmt = $this->connection->prepare('
            SELECT "verifications", verifications.*
             FROM verifications
             WHERE code = :code
        ');
        $stmt->bindParam(':code', $code);
        $stmt->execute();

        $stmt->setFetchMode(PDO::FETCH_CLASS, '\Models\Verifications');
        return $stmt->fetch();
    }

    public function findAll()
    {
        $stmt = $this->connection->prepare('
            SELECT * FROM verifications
			ORDER BY creationDate DESC
        ');
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_CLASS, '\Models\Verifications');

        return $stmt->fetchAll();
    }

    public function save($verification)
    {
		$code = $this->RandomString();
		
        $stmt = $this->connection->prepare('
            INSERT INTO verifications
                (code, uid, type, expireDate, valid)
            VALUES
                (:code, :uid, :type, :expireDate, :valid)
        ');
		
        $stmt->bindParam(':code', $code);
        $stmt->bindParam(':uid', $verification->uid);
        $stmt->bindParam(':type', $verification->type);
        $stmt->bindParam(':expireDate', $verification->expireDate);
        $stmt->bindParam(':valid', $verification->valid);
		
        return $stmt->execute() ? $code : FALSE;
    }

    public function update($verification)
    {
        if (!isset($verification->code)) {
            // We can't update a record unless it exists...
            throw new \LogicException(
                'Cannot update record that does not yet exist in the database.'
            );
        }
        $stmt = $this->connection->prepare('
            UPDATE verifications
            SET uid = :uid,
				type = :type,
				expireDate = :expireDate,
				valid = :valid
            WHERE code = :code
        ');

        $stmt->bindParam(':uid', $verification->uid);
        $stmt->bindParam(':type', $verification->type);
        $stmt->bindParam(':expireDate', $verification->expireDate);
        $stmt->bindParam(':valid', $verification->valid);
		
        $stmt->bindParam(':code', $verification->code);
        return $stmt->execute();
    }

    public function destroy($code)
    {
        if (!isset($code)) {
            // We can't delete a record unless it exists...
            throw new \LogicException(
                'Cannot update record that does not yet exist in the database.'
            );
        }
        $stmt = $this->connection->prepare('
            Delete FROM verifications
            WHERE code = :code
        ');
        $stmt->bindParam(':code', $code);
        return $stmt->execute();
    }
	
	/*	Random String Generator
	************************************************
		$this->RandomString(string_length)
			return string; [with length n]
	************************************************
		By KEN	*/
	private function RandomString($length = 32)
	{
		$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$randstring = '';
		
		for ($i = 0; $i < $length; $i++) {
			$randstring .= $characters[rand(0, strlen($characters))];
		}
		
		return $randstring;
	}
	
	public function removeRecord($uid, $type)
    {
        $stmt = $this->connection->prepare('
            UPDATE verifications
            SET valid = FALSE
            WHERE uid = :uid
			AND type = :type
        ');
        $stmt->bindParam(':uid', $uid);
        $stmt->bindParam(':type', $type);

        return $stmt->execute();
    }
	
}