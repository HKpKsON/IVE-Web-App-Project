<?php
include_once $_SERVER['DOCUMENT_ROOT'] ."/Repositories/PollsRepository.php";
include_once $_SERVER['DOCUMENT_ROOT'] ."/Models/Polls.php";

use \Models\Polls;
use \Repositories\PollsRepository;

$conn = new PollsRepository();

if(isset($_GET['choose']) && isset($_GET['id']))
{
	$choose = $_GET['choose'];
	$id = $_GET['id'];
	
	$poll = new Polls;
	$poll = $conn->find($id);

	if($poll == false){
		echo "Loading fail";
	}else{
		if($choose === 'yes')
		{
			$poll->yes +=1;
			$conn->save($poll);
			header("Location: /Polls_show.php?id=".$poll->id);
		}
		else if($choose === 'no')
		{
			$poll->no +=1;
			$conn->save($poll);
			header("Location: /Polls_show.php?id=".$poll->id);
		}
		else
			echo "error choose";
	}
}
else
{
	echo "NOT find";
}
 

?>