<?php
include_once($_SERVER['DOCUMENT_ROOT'] .'/Config.php');

$pageName = 'Poll';

//Set up page title!
$title = (isset($pageName) ? $pageName : cfg::defaultPageName) . ' | ' . cfg::siteName . ' (School Project)';

//If you need header include other javascript or CSS
function headerExtra()
{
    ?>
	<link rel="stylesheet" type="text/css" href="Poll.css">
    <?php
}

$id = isset($_GET["id"]) ? $_GET["id"] : header("Location: /Polls_showall.php");

include_once($_SERVER['DOCUMENT_ROOT'] .'/Header.php');

include_once $_SERVER['DOCUMENT_ROOT'] ."/Repositories/PollsRepository.php";
include_once $_SERVER['DOCUMENT_ROOT'] ."/Models/Polls.php";

use \Models\Polls;	
use \Repositories\PollsRepository;

date_default_timezone_set('Asia/Hong_Kong');


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
	
	<a href="Polls.php" class="btn btn-default">Go Back</a>
	

<?php
	}
}

?>
<div class="container">
<?php
ShowPoll($id);
?>
</div>
<?php
//If you need add javascript before the end of body!
function bodyEndExtra()
{
    ?>
    <script>
        console.log("This is Body End code");
    </script>

    <?php
}

include_once($_SERVER['DOCUMENT_ROOT'] .'/Footer.php');
?>