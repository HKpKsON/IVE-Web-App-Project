<?php
// Security Check
include_once($_SERVER['DOCUMENT_ROOT'] .'/ACP/SecurityCheck.php');
include_once $_SERVER['DOCUMENT_ROOT'] ."/Repositories/PollsRepository.php";
include_once $_SERVER['DOCUMENT_ROOT'] ."/Models/Polls.php";
include_once($_SERVER['DOCUMENT_ROOT'] .'/Config.php');

use \Models\Polls;	
use \Repositories\PollsRepository;

$PollsRepo = new PollsRepository;
//delete title Get id
$stat=$PollsRepo->destroy($_GET['id']);

if($stat!==false){
//success
	header('Location: /ACP/Polls/?success=true');
}else{
//fail
	header('Location: /ACP/Polls/?success=false');
}



?>