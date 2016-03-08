<?php

include_once $_SERVER['DOCUMENT_ROOT'] ."/Repositories/UsersRepository.php";
include_once $_SERVER['DOCUMENT_ROOT'] ."/Models/Users.php";

use \Models\Users;
use \Repositories\UsersRepository;

$user = new Users;
$user->username = 'testUser';
$user->password = '123456';
$user->salutation = 'Mr.';
$user->displayname = $user->username;

$conn = new UsersRepository;
$register = $conn->adduser($user);

if($register == -1){
	echo 'Your registration is completed, ' . $user->username . ', welcome aborad!';
}else{
	echo 'Registration failed.';
}