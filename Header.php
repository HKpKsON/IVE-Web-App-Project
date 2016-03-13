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

    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.css" rel="stylesheet" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="Includes/css/site.css">

    <script src="//code.jquery.com/jquery-2.2.0.js"></script>
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.js" crossorigin="anonymous"></script>
	
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
<div class="container">
	<div id="header" class="container">
		<div id="desktop-topbar" class="row visible-lg-*">
			<div class="col-md-2">
				<div class="dropdown">
					<button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
						Edition: Hong Kong <span class="caret"></span>
					</button>
					<ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
						<li><a href="/">Hong Kong</a></li>
						<li><a href="#">International</a></li>
						<li><a href="#">南華中文</a></li>
					</ul>
				</div>
			</div>
			<div class="col-md-2"><strong>Sun</strong> Mar 13, 2016</div>
			<div class="col-md-3">Jobs | Events | Education Courses</div>
			<div class="col-md-2">Weather</div>
			<div class="col-md-0">
			</div>
			<div class="col-md-3">
				<div id="login"><?php include_once('Login_Dialog.php'); ?></div>
			</div>
		</div>
		<div class="page-header">
			<h1><?= cfg::siteName ?></h1>
		</div>
	</div>
<!--Header End-->