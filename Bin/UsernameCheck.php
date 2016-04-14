<?php
// Unused.
include_once($_SERVER['DOCUMENT_ROOT'] .'/Repositories/UsersRepository.php');
include_once($_SERVER['DOCUMENT_ROOT'] .'/Models/Users.php');

include_once($_SERVER['DOCUMENT_ROOT'] .'/Config.php');

use \Models\Users;
use \Repositories\UsersRepository;

use \PDO;

if(isset($_POST['inputUsername'])){
	$userRepo = new UsersRepository(new PDO('mysql:host='.cfg::dbIP.':'.cfg::dbPort.';dbname='.cfg::dbName,cfg::dbUser,cfg::dbPasswd));

	if($userRepo->findid($_POST['inputUsername']) === false && strlen($_POST['inputUsername']) >= 6 && ctype_alnum($_POST['inputUsername'])) {
		echo json_encode(array('valid' => 'true'));
	}else{
		echo json_encode(array('valid' => 'false'));
	}
}else{
	echo json_encode(array('valid' => 'false'));
}