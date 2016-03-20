<?php
include_once($_SERVER['DOCUMENT_ROOT'] .'/Repositories/UsersRepository.php');
include_once($_SERVER['DOCUMENT_ROOT'] .'/Models/Users.php');

include_once($_SERVER['DOCUMENT_ROOT'] .'/Config.php');

use \Models\Users;
use \Repositories\UsersRepository;

use \PDO;

if(isset($_POST['inputUsername'])){
	$conn = new UsersRepository(new PDO('mysql:host='.cfg::dbIP.':'.cfg::dbPort.';dbname='.cfg::dbName,cfg::dbUser,cfg::dbPasswd));

	if($conn->findid($_POST['inputUsername']) === false) {
		echo json_encode(array('valid' => 'true'));
	}else{
		echo json_encode(array('valid' => 'false'));
	}
}else{
	echo json_encode(array('valid' => 'false'));
}