<?php

include_once $_SERVER['DOCUMENT_ROOT'] ."/Repositories/UsersRepository.php";
include_once $_SERVER['DOCUMENT_ROOT'] ."/Models/Users.php";

use \Models\Users;
use \Repositories\UsersRepository;

$user = new Users;
$user->username = 'siteAdmin';
$user->password = 'root';

$conn = new UsersRepository;
$login = $conn->login($user);

if($login !== false){
	$user = $conn->find($login);
	echo 'Welcome, ' . $user->salutation . ' ' . $user->displayname . '!';
}else{
	echo 'Access Denied.';
}