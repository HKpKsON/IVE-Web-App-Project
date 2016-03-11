<?php
session_start();
//TODO: Add PHP Logic to handle the active navbar and breadcrumbs
include_once('/Config.php');

include_once $_SERVER['DOCUMENT_ROOT'] ."/Repositories/UsersRepository.php";

use \Repositories\UsersRepository;

use \PDO;

if(isset($_SESSION['uid'])){
	$conn = new UsersRepository(new PDO('mysql:host='.cfg::dbIP.':'.cfg::dbPort.';dbname='.cfg::dbName,cfg::dbUser,cfg::dbPasswd));
	$login = $conn->find($_SESSION['uid']);
	$pageName = "Welcome back, " . $login->displayname . "!";
}

$title = (isset($pageName) ? $pageName : cfg::defaultPageName) . " | " . cfg::siteName . " (School Project)";
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?= isset($title) ? $title : "No Title" ?></title>

    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.css" rel="stylesheet"
          crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="css/site.css">

    <script src="//code.jquery.com/jquery-2.2.0.js"></script>
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.js"
            crossorigin="anonymous"></script>
    <?= function_exists('headerExtra') ? headerExtra() : "" ?>
</head>
<body>
<div class="container-fluid">
<!--Header End-->
	<div class="header">
		<h1><?= cfg::siteName ?></h1>
	</div>