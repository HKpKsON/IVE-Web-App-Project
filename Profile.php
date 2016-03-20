<?php
session_start();

include_once($_SERVER['DOCUMENT_ROOT'] .'/Repositories/UsersRepository.php');
include_once($_SERVER['DOCUMENT_ROOT'] .'/Models/Users.php');

include_once($_SERVER['DOCUMENT_ROOT'] .'/Config.php');

use \Models\Users;
use \Repositories\UsersRepository;

use \PDO;

if(!isset($_SESSION['uid'])){
	header('Location: /Login.php?error=nologin');
}elseif(isset($_GET['action']) && $_GET['action'] == 'update'){
	
}else{
	include_once($_SERVER['DOCUMENT_ROOT'] .'/Pages/Profile_Page.php');
}