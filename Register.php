<?php
session_start();

include_once($_SERVER['DOCUMENT_ROOT'] .'/Repositories/UsersRepository.php');
include_once($_SERVER['DOCUMENT_ROOT'] .'/Models/Users.php');

include_once($_SERVER['DOCUMENT_ROOT'] .'/Config.php');

use \Models\Users;
use \Repositories\UsersRepository;

use \PDO;

if(!isset($_GET['error']) && isset($_SESSION['uid'])){
	header('Location: /Login.php?error=logged');
}else if(isset($_GET['action']) && $_GET['action'] == 'register'){
	
	if(!isset($_POST['inputUsername'], $_POST['inputEmail'], $_POST['inputPassword'], $_POST['inputConPassword'])){
		header("Location: ?error=empty");
	}elseif(empty($_POST['inputUsername']) || !ctype_alnum($_POST['inputUsername'])){
		header("Location: ?error=username");
	}elseif(empty($_POST['inputEmail']) || !filter_var($_POST['inputEmail'], FILTER_VALIDATE_EMAIL)){
		header("Location: ?error=email");
	}elseif(empty($_POST['inputPassword']) || empty($_POST['inputConPassword']) || !ctype_alnum($_POST['inputPassword']) || $_POST['inputPassword'] !== $_POST['inputConPassword']){
		header("Location: ?error=password");
	}else{
		$user = new Users;
		$conn = new UsersRepository(new PDO('mysql:host='.cfg::dbIP.':'.cfg::dbPort.';dbname='.cfg::dbName,cfg::dbUser,cfg::dbPasswd));
		
		$user->username = $_POST['inputUsername'];
		$user->email = $_POST['inputEmail'];
		$user->password = $_POST['inputPassword'];
		
		$salt = $conn->saltgen();
		$user->password = hash('sha256', hash('sha256', $user->password) . $salt) . '*' . $user->password;
		
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
		$user->displayname = $_POST['inputDisplayName'];
		$user->phone = $_POST['inputPhone'];
		
		include_once($_SERVER['DOCUMENT_ROOT'] .'/Pages/Countries.php');
		$country = new Countries;
		$country->vaildCountryCode($_POST['inputCountry']) ? $user->country = $_POST['inputCountry'] : $user->country = '';

		$adduser = $conn->adduser($user);
		
		if($adduser == 1){
			header("Location: ?error=registered");
		}elseif($adduser == -1){
			header("Location: /Login.php?success=true");
		}else{
			header("Location: ?error=server");
		}
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