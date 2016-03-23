<?php
if(isset($_GET['reason'])){
	include_once($_SERVER['DOCUMENT_ROOT'] .'/Pages/Logout_Page.php');
	die();
}else{
	session_start();

	unset($_SESSION['uid']);
	unset($_SESSION['salt']);
	setcookie("login", "", time() - 3600);
	
	header('Location: ?reason=user');
}

?>