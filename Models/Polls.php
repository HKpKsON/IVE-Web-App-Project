<?php
namespace Models;
include_once "ModelBase.php";

class Polls extends ModelBase
{
    public $title;
	public $publishdate;
	public $lastupdate;
	public $yes;
	public $no;
}