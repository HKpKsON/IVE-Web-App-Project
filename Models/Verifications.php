<?php
namespace Models;
include_once "ModelBase.php";

class Verifications extends ModelBase
{
	public $code;
	public $uid;
	public $type; // 0 = Verify Account, 1 = Verify Reset Password
	public $creationDate;
	public $expireDate;
	public $valid;
}