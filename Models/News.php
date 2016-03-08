<?php
namespace Models;
include_once "ModelBase.php";

class News extends ModelBase
{
	public $title;
	public $subtitle;
	public $publishdate;
	public $lastupdate;
	public $author;
	public $content;
	public $tags;
}