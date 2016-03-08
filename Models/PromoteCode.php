<?php
namespace Models;
include_once "ModelBase.php";

class PromoteCode extends ModelBase
{
    public $code;
	public $comment;
	public $creationDate;
	public $expireDate;
	public $vaild;
}