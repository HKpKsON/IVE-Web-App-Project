<?php
session_start();

include_once($_SERVER['DOCUMENT_ROOT'] .'/Repositories/UsersRepository.php');
include_once($_SERVER['DOCUMENT_ROOT'] .'/Models/Users.php');

include_once($_SERVER['DOCUMENT_ROOT'] .'/Config.php');

use \Models\Users;
use \Repositories\UsersRepository;

use \PDO;

if(!isset($_SESSION['uid'])){
	header('Location: /Login.php?error=nologin');
}elseif(isset($_GET['action']) && $_GET['action'] == 'update' && isset($_POST['inputLogin'])){
	$conn = new UsersRepository(new PDO('mysql:host='.cfg::dbIP.':'.cfg::dbPort.';dbname='.cfg::dbName,cfg::dbUser,cfg::dbPasswd));
	$user = new Users;
	
	$user->id = $_SESSION['uid'];
	$user->password = $_POST['inputLogin'];
	
	if($conn->login($user) !== false){
		$user = $conn->find($user->id);
		
		if($_POST['inputPassword'] != ''){
			if($_POST['inputPassword'] !== $_POST['inputConPassword']){
				header("Location: ?error=password");
				die();
			}else{
				$user->password = $conn->hashnsalt($_POST['inputPassword'], $conn->saltgen());
			}
		}
		
		if(empty($_POST['inputEmail']) || !filter_var($_POST['inputEmail'], FILTER_VALIDATE_EMAIL)){
			header("Location: ?error=email");
			die();
		}else{
			$user->email = $_POST['inputEmail'];
		}
		
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
				$user->salutation = 'Mr.';
		}
		
		$user->displayname = $_POST['inputDisplayName'] != '' ? $_POST['inputDisplayName'] : $user->username;
		$user->fullname = $_POST['inputFullName'];
		$user->phone = $_POST['inputPhone'];
		$user->address = $_POST['inputAddress'];
		
		include_once($_SERVER['DOCUMENT_ROOT'] .'/Pages/Countries.php');
		$country = new Countries;
		$country->vaildCountryCode($_POST['inputCountry']) ? $user->country = $_POST['inputCountry'] : $user->country = 'HK';
		
		$updateuser = $conn->update($user);
		
		if($updateuser){
			header("Location: ?success=true");
			die();
		}else{
			header("Location: ?error=server");
			die();
		}
	}else{
		header("Location: ?error=wrongpw");
		die();
	}
}else{
	include_once($_SERVER['DOCUMENT_ROOT'] .'/Pages/Profile_Page.php');
}