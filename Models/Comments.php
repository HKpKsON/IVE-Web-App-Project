<?php
namespace Models;
include_once "ModelBase.php";

class Comments extends ModelBase
{
    public $uid;
	public $title;
	public $publishdate;
	public $lastupdate;
	public $content;
	public $type; // 0 = News Reply, 1 = Blog, 2 = Opinion
	public $newsId;
}