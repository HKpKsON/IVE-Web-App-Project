<?php
// Security Check
include_once($_SERVER['DOCUMENT_ROOT'] .'/ACP/SecurityCheck.php');

date_default_timezone_set("Asia/Hong_Kong");
include_once $_SERVER['DOCUMENT_ROOT'] . "/Models/News.php";
include_once $_SERVER['DOCUMENT_ROOT'] . "/Repositories/NewsRepository.php";

use Models\News;
use Models\Reviews;
use Repositories\NewsRepository;
use Repositories\ComRepository;

$newsRepository = new NewsRepository();
$comRepository = new ComRepository();


$com = new Reviews();
$com->com_id = $_POST['com_id'];
$com->new_id=$_GET['id'];
$com->com_author = $_POST["com_author"];
$com->com_text = $_POST["com_text"];
$com->com_date = date("Y-m-d h:i:sa");
$comRepository->save($com);

header("Location: /ShowNews.php?id=".$_GET['id']);