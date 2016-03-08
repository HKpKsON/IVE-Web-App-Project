<?php
include_once $_SERVER['DOCUMENT_ROOT'] ."/Header.php";

include_once $_SERVER['DOCUMENT_ROOT'] ."/Repositories/UsersRepository.php";
include_once $_SERVER['DOCUMENT_ROOT'] ."/Models/Users.php";

include_once('/Config.php');

use \Models\Users;
use \Repositories\UsersRepository;

use \PDO;

$user = new Users;
$user->username = 'siteAdmin';
$user->password = 'root';

$conn = new UsersRepository(new PDO('mysql:host='.cfg::dbIP.':'.cfg::dbPort.';dbname='.cfg::dbName,cfg::dbUser,cfg::dbPasswd));
$login = $conn->login($user);

if($login !== false){
	$_SESSION['uid'] = $login;
	$user = $conn->find($login);
	echo 'Welcome, ' . $user->salutation . ' ' . $user->displayname . '!';
}else{
	echo 'Access Denied.';
}

header('Location: /Header.php');

include_once $_SERVER['DOCUMENT_ROOT'] ."/Footer.php";