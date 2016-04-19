<?php
// Security Check
include_once($_SERVER['DOCUMENT_ROOT'] .'/ACP/SecurityCheck.php');
include_once $_SERVER['DOCUMENT_ROOT'] ."/Repositories/PollsRepository.php";
include_once $_SERVER['DOCUMENT_ROOT'] ."/Models/Polls.php";
include_once($_SERVER['DOCUMENT_ROOT'] .'/Config.php');

use \Models\Polls;	
use \Repositories\PollsRepository;

$PollsRepo = new PollsRepository;
//add title
if(isset($_POST['inputtitle']) && trim($_POST['inputtitle'])!=""){
	
	$polls = new Polls;
	$polls->title = $_POST['inputtitle'];
	$polls->yes = 0;
	$polls->no = 0;
	
	$stat=$PollsRepo->save($polls);
	if($stat!==false){
		//success
		header('Location: /ACP/Polls/?success=true');
	}else{
		//fail
		header('Location: /ACP/Polls/?success=false');
	}
}

	
	
	

?>