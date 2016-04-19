<?php
// Security Check
include_once($_SERVER['DOCUMENT_ROOT'] .'/ACP/SecurityCheck.php');

include_once $_SERVER['DOCUMENT_ROOT'] ."/Models/News.php";
include_once $_SERVER['DOCUMENT_ROOT'] ."/Repositories/NewsRepository.php";

use Models\News;
use Models\Reviews;
use Repositories\NewsRepository;
use Repositories\ComRepository;

$newsRepository = new NewsRepository();
$comRepository = new ComRepository();

$com =$comRepository->destroy($_GET['com_id']);

if(isset($_SESSION['newid'])){
    header("Location: /ShowNews.php?id=".$_SESSION['newid']);
    session_unset();
    session_destroy();
}
else{
    header("Location: /ListNews.php");
}

