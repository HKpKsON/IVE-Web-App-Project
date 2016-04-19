<?php
// Security Check
include_once($_SERVER['DOCUMENT_ROOT'] .'/ACP/SecurityCheck.php');


include_once($_SERVER['DOCUMENT_ROOT'] .'/Repositories/VideosRepository.php');
include_once($_SERVER['DOCUMENT_ROOT'] .'/Models/Videos.php');
include_once($_SERVER['DOCUMENT_ROOT'] .'/Repositories/UsersRepository.php');
include_once($_SERVER['DOCUMENT_ROOT'] .'/Models/Users.php');

include_once($_SERVER['DOCUMENT_ROOT'] .'/Config.php');


use \Models\Videos;
use \Repositories\VideosRepository;
use \Models\Users;
use \Repositories\UsersRepository;

use \PDO;
$PDO = new PDO('mysql:host='.cfg::dbIP.':'.cfg::dbPort.';dbname='.cfg::dbName,cfg::dbUser,cfg::dbPasswd);

$VideosRepo = new VideosRepository($PDO);

// User Permission Check
$userRepo = new UsersRepository($PDO);

if($userRepo->find($_SESSION['uid'])->isAdmin == 255){

	$stat = $VideosRepo->destroy($_GET['id']);
	header('Location: /ACP/Videos/');
}else{
    // No Permission

    header('Location: /ACP/Videos/');
    die();
}