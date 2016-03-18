<?php
//TODO: Add PHP Logic to handle the active navbar and breadcrumbs
include_once $_SERVER['DOCUMENT_ROOT'] ."/Repositories/UsersRepository.php";

use \Repositories\UsersRepository;

use \PDO;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	
    <title><?= isset($title) ? $title : "No Title" ?></title>

    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="Includes/css/site.css">
	<!-- http://fortawesome.github.io/Font-Awesome Icon CSS -->
	<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">

	<script src="//ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
	<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
</head>
<body>
<div class="container">
	<div id="header">
		<!-- Desktop Topbar Start -->
		<div id="desktop-topbar" class="row hidden-xs hidden-sm">
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
				<div class="col-md-7 text-left">
					<span class="menu-li"><div class="Date"></div></span>
					<span class="menu-li">Jobs | Events | Education Courses</span>
					<span class="menu-li">Weather</span>
				</div>
				<div class="col-md-3 text-right">
					<div id="login">
						<?php include_once('Login_Dialog.php'); ?>
						<a href="/register.php" class="btn btn-default btn_subscribe" title="Subscribe"><i class="fa fa-newspaper-o"></i></a>
						<a href="#" class="btn btn-default" title="Follow on Facebook"><i class="fa fa-facebook"></i></a>
						<a href="#" class="btn btn-default" title="Follow on Twitter"><i class="fa fa-twitter"></i></a>
					</div>
				</div>
				<div class="row page-header">
					<h1><?= cfg::siteName ?></h1>
				</div>
				<!-- Navbar -->
				<?php include_once("/Navbar.php") ?>
		</div>
		<!-- Desktop Topbar End -->
		<!-- Mobile Topbar Start -->
		<div id="mobile-topbar" class="row hidden-md hidden-lg">
			<div class="page-header">
				<h3 class="text-center"><?= cfg::siteName ?></h3>
			</div>
			<div class="col-xs-6 text-left">
				<div class="Date"></div>
			</div>
			<div class="col-xs-6 text-right">
				<a href="/register.php">Subscribe</a>
				<span>|</span>
				<a href="#" data-toggle="modal" data-target="#login-dialog">Login</a>
			</div>
		</div>
		<!-- Mobile Topbar End -->
	</div>
<!--Header End-->