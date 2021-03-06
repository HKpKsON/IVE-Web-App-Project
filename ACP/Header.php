<?php include_once($_SERVER['DOCUMENT_ROOT'] .'/ACP/SecurityCheck.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	
    <title><?= isset($title) ? $title : "No Title" ?></title>

    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <link rel="stylesheet" href="/ACP/Includes/CSS/acp.css">

	<script src="//ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
	<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
	<?= function_exists('headerExtra') ? headerExtra() : "" ?>
</head>
<body>
<div id="wrapper">
<?php include_once($_SERVER['DOCUMENT_ROOT'] .'/ACP/Pages/Sidebar.php'); ?>
<div id="page-content-wrapper">
	<div class="container-fluid">