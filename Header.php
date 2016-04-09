<?php
//TODO: Add PHP Logic to handle the active navbar and breadcrumbs
include_once($_SERVER['DOCUMENT_ROOT'] .'/Config.php');
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
	<?= function_exists('headerExtra') ? headerExtra() : "" ?>
	
	<?php if(isset($_COOKIE['login'])){ ?>
	<!-- Really simple META logout -->
	<!-- Source: https://www.sitepoint.com/community/t/automatic-logout-after-inactive-for-15-minutes/3538/4 -->
	<meta http-equiv="refresh" content="1800;url=/Logout.php?reason=idle" />
	<?php } ?>
</head>
<body>
<div class="container">
	<div id="header">
		<!-- Desktop Topbar Start -->
		<div id="desktop-topbar" class="row hidden-xs hidden-sm">
			<div class="container">
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
				<div class="col-md-7 pull-left">
					<span class="menu-li"><div class="Date"></div></span>
					<span class="menu-li">Jobs | Events | Education Courses</span>
					<span class="menu-li">Weather</span>
				</div>
				<div class="col-md-3 pull-right">
					<div id="login">
						<?php include_once($_SERVER['DOCUMENT_ROOT'] .'/Pages/Login_Dialog.php'); ?>
						<a href="#" class="btn btn-default" title="Follow on Facebook"><i class="fa fa-facebook"></i></a>
						<a href="#" class="btn btn-default" title="Follow on Twitter"><i class="fa fa-twitter"></i></a>
					</div>
				</div>
				<div class="row page-header">
					<h1><?= cfg::siteName ?></h1>
				</div>
				<!-- Navbar -->
				<?php include_once($_SERVER['DOCUMENT_ROOT'] .'/Pages/Navbar.php') ?>
			</div>
		</div>
		<!-- Desktop Topbar End -->
		<!-- Mobile Topbar Start -->
		<div id="mobile-topbar" class="row hidden-md hidden-lg">
			<!-- Moblie Navbar -->
			<?php include_once("/Pages/Navbar_SM.php") ?>
			<div class="page-header">
				<h3 class="text-center"><?= cfg::siteName ?></h3>
			</div>
			<div class="col-xs-6 text-left">
				<div class="Date"></div>
			</div>
			<div class="col-xs-6 text-right">
				<?php include_once($_SERVER['DOCUMENT_ROOT'] .'/Pages/Login_Dialog_SM.php'); ?>
			</div>
		</div>
		<!-- Mobile Topbar End -->
	</div>
<!--Header End-->