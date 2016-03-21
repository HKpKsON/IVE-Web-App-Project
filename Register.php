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
$PDO = new PDO('mysql:host='.cfg::dbIP.':'.cfg::dbPort.';dbname='.cfg::dbName,cfg::dbUser,cfg::dbPasswd);

if(!isset($_GET['error']) && isset($_SESSION['uid'])){
	header('Location: /Login.php?error=logged');
}else if(isset($_GET['action']) && $_GET['action'] == 'register'){
	
	if(isset($_POST['g-recaptcha-response'])){
		
		$response=json_decode(file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=".$privatekey."&response=".$_POST['g-recaptcha-response']."&remoteip=".$_SERVER['REMOTE_ADDR']), true);
		
		if($response['success'] == false){
			header("Location: ?error=recaptcha");
			die();
		}elseif(!isset($_POST['inputUsername'], $_POST['inputEmail'], $_POST['inputPassword'], $_POST['inputConPassword'])){
			header("Location: ?error=empty");
			die();
		}elseif(empty($_POST['inputUsername']) || !ctype_alnum($_POST['inputUsername'])){
			header("Location: ?error=username");
			die();
		}elseif(empty($_POST['inputEmail']) || !filter_var($_POST['inputEmail'], FILTER_VALIDATE_EMAIL)){
			header("Location: ?error=email");
			die();
		}elseif(empty($_POST['inputPassword']) || empty($_POST['inputConPassword']) || !ctype_alnum($_POST['inputPassword']) || $_POST['inputPassword'] !== $_POST['inputConPassword']){
			header("Location: ?error=password");
			die();
		}else{
			$user = new Users;
			$conn = new UsersRepository($PDO);
			
			$user->username = $_POST['inputUsername'];
			$user->email = $_POST['inputEmail'];
			$user->password = $_POST['inputPassword'];

			switch($_POST['inputSalutation']){
				case 'MR':
					$user->salutation = 'Mr.';
					break;
				case 'MRS':
					$user->salutation = 'Mrs.';
					break;
				case 'MS':
					$user->salutation = 'Ms.';
					break;
				default:
					$user->salutation = null;
			}
			
			$user->fullname = $_POST['inputFullName'];
			$user->displayname = $_POST['inputDisplayName'] != '' ? $_POST['inputDisplayName'] : $_POST['inputUsername'];
			$user->phone = $_POST['inputPhone'];
			
			include_once($_SERVER['DOCUMENT_ROOT'] .'/Pages/Countries.php');
			$country = new Countries;
			$country->vaildCountryCode($_POST['inputCountry']) ? $user->country = $_POST['inputCountry'] : $user->country = '';

			$adduser = $conn->adduser($user);
			
			if($adduser == 1){
				header("Location: ?error=registered");
				die();
			}elseif($adduser == -1){
				header("Location: /Login.php?success=true");
				die();
			}else{
				header("Location: ?error=server");
				die();
			}
		}
	}else{
		header("Location: ?error=recaptcha");
		die();
	}
	
}else{
	if(isset($_GET['action']) && $_GET['action'] == 'ref'){
		$refer = array(
			'username' => isset($_POST['inputUsername']) ? $_POST['inputUsername'] : '',
			'email' => isset($_POST['inputEmail']) ? $_POST['inputEmail'] : ''
		);
	}
	
	include_once($_SERVER['DOCUMENT_ROOT'] ."/Pages/Register_Page.php");
}
?>