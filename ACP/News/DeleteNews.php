<?php
// Security Check
include_once($_SERVER['DOCUMENT_ROOT'] .'/ACP/SecurityCheck.php');

include_once $_SERVER['DOCUMENT_ROOT'] ."/Models/News.php";
include_once $_SERVER['DOCUMENT_ROOT'] ."/Repositories/NewsRepository.php";

use Models\News;
use Repositories\NewsRepository;

$newsRepository = new NewsRepository();
$news = $newsRepository->destroy($_GET['id']);

header("Location: /ACP/News/");