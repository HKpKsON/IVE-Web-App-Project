<?php
session_start();

date_default_timezone_set('Asia/Hong_Kong');

include_once($_SERVER['DOCUMENT_ROOT'] .'/Repositories/UsersRepository.php');
include_once($_SERVER['DOCUMENT_ROOT'] .'/Models/Users.php');

include_once($_SERVER['DOCUMENT_ROOT'] .'/Config.php');

use \Models\Users;
use \Repositories\UsersRepository;

use \PDO;

$PDO = new PDO('mysql:host='.cfg::dbIP.':'.cfg::dbPort.';dbname='.cfg::dbName,cfg::dbUser,cfg::dbPasswd);

$uid = isset($_SESSION['uid']) ? $_SESSION['uid'] : FALSE;
$salt = isset($_SESSION['salt']) ? $_SESSION['salt'] : FALSE;
$sessionTime = isset($_SESSION['sessionTime']) ? $_SESSION['sessionTime'] : FALSE;

$userRepo = new UsersRepository($PDO);

if(!isset($_GET['error']) && $uid !== FALSE &&  $sessionTime > time() && $salt == $userRepo->findsalt($uid)){
	header('Location: /ACP/Index.php');
}else if(isset($_GET['action']) && $_GET['action'] == 'login'){
	$user = new Users;

	if(isset($_POST['inputUsername'], $_POST['inputPassword'])){
		if(filter_var($_POST['inputUsername'], FILTER_VALIDATE_EMAIL)){
			$user->email = $_POST['inputUsername'];
		}else{
			$user->username = $_POST['inputUsername'];
		}
		$user->password = $_POST['inputPassword'];
	}

	$login = $userRepo->login($user);
	
	if($login !== false){
		if($userRepo->find($login)->valid == false || $userRepo->find($login)->isAdmin == -1){
			header('Location: ?error=invalid');
			die();
		}elseif($userRepo->find($login)->isAdmin <= 0){
			header('Location: ?error=notadmin');
			die();
		}else{
			$_SESSION['uid'] = $login;
			$_SESSION['salt'] = $userRepo->findsalt($login);
			$_SESSION['sessionTime'] = time() + 15 * 60;
		
			setcookie('login', 'true');
			
			$user = $userRepo->find($login);
			header("Location: /ACP/");
			die();
		}
	}else{
		header('Location: ?error=userpw');
		die();
	}
}else{
	include_once($_SERVER['DOCUMENT_ROOT'] ."/ACP/Pages/Login_Page.php");
}
?>