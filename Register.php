<?php
include_once $_SERVER['DOCUMENT_ROOT'] ."/Repositories/UsersRepository.php";
include_once $_SERVER['DOCUMENT_ROOT'] ."/Models/Users.php";

include_once('/Config.php');

use \Models\Users;
use \Repositories\UsersRepository;

use \PDO;

if(!isset($_GET['error']) && isset($_SESSION['uid'])){
	header('Location: /Login.php?error=logged');
}else if(isset($_GET['action']) && $_GET['action'] == "register"){
	if(isset($_POST['inputUsername'], $_POST['inputEmail'], $_POST['inputPassword'], $_POST['inputConPassword']) && !is_null($_POST['inputUsername'], $_POST['inputEmail'], $_POST['inputPassword'], $_POST['inputConPassword'])){
		$user = new Users;
		$conn = new UsersRepository(new PDO('mysql:host='.cfg::dbIP.':'.cfg::dbPort.';dbname='.cfg::dbName,cfg::dbUser,cfg::dbPasswd));
	}else{
		header("Location: ?error=empty");
	}
}else{
	include_once $_SERVER['DOCUMENT_ROOT'] ."/Register_Page.php";
}
?>