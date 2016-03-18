<?php
include_once "/Header.php";

include_once $_SERVER['DOCUMENT_ROOT'] ."/Repositories/PollsRepository.php";
include_once $_SERVER['DOCUMENT_ROOT'] ."/Models/Polls.php";

use \Models\Polls;	
use \Repositories\PollsRepository;

date_default_timezone_set('UTC');

function ShowPoll($id){
	
	$conn = new PollsRepository();
	$poll = new Polls;
	
	$poll = $conn->find($id);
	
	if($poll !== false)
	{
	$yes = $poll->yes;
	$no = $poll->no;
	$total = $yes + $no;
	if($total > 0){
		$yes = round($yes / $total * 100,0);
		$no = round($no / $total * 100,0);
	}else{
		$yes = 0;
		$no = 0;
	}
	
?>
	<h2 class="pane-title">Today's Poll</h2>
	
	<h2><?= $poll->title; ?></h2>
		  PUBLISHED : <?= $poll->publishdate; ?> </br>
		  UPDATED : <?= $poll->lastupdate; ?></br>
	<div class="progress">
	  <div class="progress-bar progress-bar-info" style="width: <?= $yes; ?>%">
			YES <?= $yes; ?>%
	  </div>
	  <div class="progress-bar progress-bar-danger " style="width: <?= $no; ?>%">
			NO <?= $no; ?>%
	  </div>
	</div>
		
	<a href="/Polls_vote.php?id=<?= $poll->id; ?>&choose=yes" class="btn btn-primary" type="button" >yes</a>
	</br>
	</br>
	<a href="/Polls_vote.php?id=<?= $poll->id; ?>&choose=no" class="btn btn-primary" type="button">no </a>
		
	<h3><span class="label label-default">Total number of votes recorded:<?= $total;?></span></h3>
<?php
	}
}


for($i = 1; $i <= 5; $i++) {
	ShowPoll($i);
} 



?>