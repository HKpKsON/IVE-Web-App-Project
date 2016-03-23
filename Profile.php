<?php
session_start();

include_once($_SERVER['DOCUMENT_ROOT'] .'/Repositories/UsersRepository.php');
include_once($_SERVER['DOCUMENT_ROOT'] .'/Models/Users.php');

include_once($_SERVER['DOCUMENT_ROOT'] .'/Config.php');

use \Models\Users;
use \Repositories\UsersRepository;

use \PDO;
$PDO = new PDO('mysql:host='.cfg::dbIP.':'.cfg::dbPort.';dbname='.cfg::dbName,cfg::dbUser,cfg::dbPasswd);

if(!isset($_SESSION['uid'])){
	header('Location: /Login.php?error=nologin');
}elseif(isset($_GET['action']) && $_GET['action'] == 'update' && isset($_POST['inputLogin'])){
	$userRepo = new UsersRepository($PDO);
	$user = new Users;
	
	$user->id = $_SESSION['uid'];
	$user->password = $_POST['inputLogin'];
	
	if($userRepo->login($user) == false){
		header("Location: ?error=wrongpw");
		die();
	}else{
		$user = $userRepo->find($user->id);
		
		// Only Change Password if user actually give a new password
		if($_POST['inputPassword'] != ''){
			if($_POST['inputPassword'] !== $_POST['inputConPassword']){
				header("Location: ?error=password");
				die();
			}else{
				$user->password = $userRepo->hashnsalt($_POST['inputPassword'], $userRepo->saltgen());
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
		
		$updateuser = $userRepo->update($user);
		
		if($updateuser){
			header("Location: ?success=true");
			die();
		}else{
			header("Location: ?error=server");
			die();
		}
	}
	
}else{
	// If user's cookies does not match server record, reject their connection.
	$userRepo = new UsersRepository($PDO);
	
	$salt = isset($_SESSION['salt']) ? $_SESSION['salt'] : '';
	$uid = isset($_SESSION['uid']) ? $_SESSION['uid'] : '';

	if($salt !== $userRepo->findsalt($uid)){
		header('Location: /Logout.php?reason=timeout');
	}

	include_once($_SERVER['DOCUMENT_ROOT'] .'/Pages/Profile_Page.php');
}