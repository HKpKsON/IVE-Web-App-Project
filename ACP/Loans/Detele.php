<?php
// Security Check
include_once($_SERVER['DOCUMENT_ROOT'] .'/ACP/SecurityCheck.php');


include_once($_SERVER['DOCUMENT_ROOT'] .'/Repositories/LoansRepository.php');
include_once($_SERVER['DOCUMENT_ROOT'] .'/Models/Loans.php');
include_once($_SERVER['DOCUMENT_ROOT'] .'/Repositories/UsersRepository.php');
include_once($_SERVER['DOCUMENT_ROOT'] .'/Models/Users.php');

include_once($_SERVER['DOCUMENT_ROOT'] .'/Config.php');


use \Models\Loans;
use \Repositories\LoansRepository;
use \Models\Users;
use \Repositories\UsersRepository;

use \PDO;
$PDO = new PDO('mysql:host='.cfg::dbIP.':'.cfg::dbPort.';dbname='.cfg::dbName,cfg::dbUser,cfg::dbPasswd);

$LoansRepo = new LoansRepository($PDO);

// User Permission Check
$userRepo = new UsersRepository($PDO);

if($userRepo->find($_SESSION['uid'])->isAdmin == 255){
	try{
		unlink($_SERVER['DOCUMENT_ROOT'] ."/Uploads/".$LoansRepo->find($_GET['id'])->logo);
	}catch(Exception $e){
		
	}
	$stat = $LoansRepo->destroy($_GET['id']);
	header('Location: /ACP/Loans/');
}else{
    // No Permission

    header('Location: /ACP/Loans/');
    die();
}