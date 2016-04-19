<?php
namespace Models;
include_once "ModelBase.php";

class News extends ModelBase
{
    public $author;
    public $title;
    public $text;
    public $category;
    public $new_date;
}
class Reviews extends ModelBase
{
    public $com_author;
    public $com_text;
    public $com_date;
    public $com_id;
    public $new_id;


}