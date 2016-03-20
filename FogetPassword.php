<?php
session_start();
include_once($_SERVER['DOCUMENT_ROOT'] .'/Repositories/UsersRepository.php');
include_once($_SERVER['DOCUMENT_ROOT'] .'/Models/Users.php');

include_once($_SERVER['DOCUMENT_ROOT'] .'/Config.php');

// Recaptcha
$privatekey = "6Le6ShsTAAAAAKkI0MYrxX7nbdiNBnrxzNGAiFWZ";

use \Models\Users;
use \Repositories\UsersRepository;

use \PDO;

if(!isset($_GET['error']) && isset($_SESSION['uid'])){
	header('Location: ?error=logged');
	die();
}else if(isset($_GET['action']) && $_GET['action'] == 'findmypassword'){
	if(isset($_POST['g-recaptcha-response'])){
		$response=json_decode(file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=".$privatekey."&response=".$_POST['g-recaptcha-response']."&remoteip=".$_SERVER['REMOTE_ADDR']), true);
		
		if($response['success'] == false){
			header("Location: ?error=recaptcha");
			die();
		}else{
			if(isset($_POST['inputUsername']) && isset($_POST['inputEmail'])){
				$conn = new UsersRepository(new PDO('mysql:host='.cfg::dbIP.':'.cfg::dbPort.';dbname='.cfg::dbName,cfg::dbUser,cfg::dbPasswd));
				$user = new Users;
				
				$user = $conn->find($conn->findid($_POST['inputUsername']));
				
				if($user !== false && $user->email == $_POST['inputEmail']){
					// Send Email
					
					header("Location: ?success=true");
					die();
				}else{
					header("Location: ?error=nosuchmember");
					die();
				}
			}else{
				header("Location: ?error=empty");
				die();
			}
		}
	}else{
		header("Location: ?error=recaptcha");
		die();
	}
}else{
	include_once($_SERVER['DOCUMENT_ROOT'] .'/Pages/ForgetPassword_Page.php');
}