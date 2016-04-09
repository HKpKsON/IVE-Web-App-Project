<?php
include_once($_SERVER['DOCUMENT_ROOT'] .'/Models/Users.php');
include_once($_SERVER['DOCUMENT_ROOT'] .'/Models/Verifications.php');
include_once($_SERVER['DOCUMENT_ROOT'] .'/Repositories/UsersRepository.php');
include_once($_SERVER['DOCUMENT_ROOT'] .'/Repositories/VerificationsRepository.php');

include_once($_SERVER['DOCUMENT_ROOT'] .'/Config.php');

date_default_timezone_set('Asia/Hong_Kong');

use \Models\Users;
use \Models\Verifications;
use \Repositories\UsersRepository;
use \Repositories\VerificationsRepository;

use \PDO;
$PDO = new PDO('mysql:host='.cfg::dbIP.':'.cfg::dbPort.';dbname='.cfg::dbName,cfg::dbUser,cfg::dbPasswd);

$userRepo = new UsersRepository($PDO);
$verifyRepo = new VerificationsRepository($PDO);

if(isset($_GET['action'], $_GET['code']) && $_GET['action'] == 'update'){
	
}elseif(isset($_GET['action']) && $_GET['action'] == 'add'){
	
	$user = isset($_POST['inputUsername']) ? $userRepo->findid($_POST['inputUsername']) : FALSE;
	$uid = $user !== FALSE ? $user : FALSE;
	
	if($uid !== FALSE && isset($_POST['inputType']) && ($_POST['inputType'] == 1 || $_POST['inputType'] == 0)){
		$type = $_POST['inputType'];
		$valid = isset($_POST['inputValid']) ? $_POST['inputValid'] : FALSE;
		$expire = isset($_POST['inputExpire']) ? strtotime($_POST['inputExpire']) : time();
		$expire = $expire !== FALSE ? $expire : time();
	}else{
		// ERROR
	}
	
}else{
	// Action for Anything Else
	
	header('Location: /ACP/Verifications/');
	die();
}
?>