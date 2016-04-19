<?php
// Security Check
include_once($_SERVER['DOCUMENT_ROOT'] .'/ACP/SecurityCheck.php');
include_once $_SERVER['DOCUMENT_ROOT'] ."/Repositories/PollsRepository.php";
include_once $_SERVER['DOCUMENT_ROOT'] ."/Models/Polls.php";
include_once($_SERVER['DOCUMENT_ROOT'] .'/Config.php');

use \Models\Polls;	
use \Repositories\PollsRepository;

$PollsRepo = new PollsRepository;
//update title

	$polls = new Polls;
	$polls = $PollsRepo->find($_GET['id']);
	$polls->title = isset($_POST['title']) ? $_POST['title'] : $polls->title;

	$stat=$PollsRepo->update($polls);
	if($stat!==false){
		//success
		header('Location: /ACP/Polls/?success=true');
	}else{
		//fail
		header('Location: /ACP/Polls/?success=false');
	}


?>