<?php
session_start();

include_once($_SERVER['DOCUMENT_ROOT'] .'/Repositories/UsersRepository.php');
include_once($_SERVER['DOCUMENT_ROOT'] .'/Models/Users.php');

use \Models\Users;
use \Repositories\UsersRepository;

use \PDO;

$PDO = new PDO('mysql:host='.cfg::dbIP.':'.cfg::dbPort.';dbname='.cfg::dbName,cfg::dbUser,cfg::dbPasswd);
$userRepo = new UsersRepository($PDO);

if(isset($_SESSION['uid'])){
	$user = $userRepo->find($_SESSION['uid']);
	
	if($user->isAdmin == 255){
		// Is Site Admin
	}elseif($user->isAdmin == 1){
		// Is Editor
	}else{
		// Not Admin
	}
}else{
	// Not Logged In
}
