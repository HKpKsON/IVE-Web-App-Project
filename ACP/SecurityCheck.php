<?php
function removeAll(){
	unset($PDO, $uid, $salt, $sessionTime, $userRepo);
}

session_start();

include_once($_SERVER['DOCUMENT_ROOT'] .'/Repositories/UsersRepository.php');
include_once($_SERVER['DOCUMENT_ROOT'] .'/Models/Users.php');

include_once($_SERVER['DOCUMENT_ROOT'] .'/Config.php');

use \Models\Users;
use \Repositories\UsersRepository;
use \PDO;

$PDO = new PDO('mysql:host='.cfg::dbIP.':'.cfg::dbPort.';dbname='.cfg::dbName,cfg::dbUser,cfg::dbPasswd);

date_default_timezone_set('Asia/Hong_Kong');

$uid = isset($_SESSION['uid']) ? $_SESSION['uid'] : FALSE;
$salt = isset($_SESSION['salt']) ? $_SESSION['salt'] : FALSE;
$sessionTime = isset($_SESSION['sessionTime']) ? $_SESSION['sessionTime'] : FALSE;

$userRepo = new UsersRepository($PDO);

if($uid === FALSE || $sessionTime === FALSE || $sessionTime < time() || $salt !== $userRepo->findsalt($uid)){
	removeAll();
	header('Location: /ACP/Login.php');
}else{
	$_SESSION['sessionTime'] = time() + 15 * 60;
	removeAll();
}
