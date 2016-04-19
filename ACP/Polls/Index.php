<?php
include_once($_SERVER['DOCUMENT_ROOT'] .'/Config.php');
include_once $_SERVER['DOCUMENT_ROOT'] ."/Repositories/PollsRepository.php";
include_once $_SERVER['DOCUMENT_ROOT'] ."/Models/Polls.php";

use \Models\Polls;
use \Repositories\PollsRepository;

$pageName = 'Polls Management';

//Set up page title!
$title = (isset($pageName) ? $pageName : cfg::defaultPageName) . ' | ' . cfg::siteName . ' (School Project)';

//If you need header include other javascript or CSS
function headerExtra()
{
    ?>
	
    <?php
}
include_once($_SERVER['DOCUMENT_ROOT'] .'/ACP/Header.php');
?>

<?php

$conn = new PollsRepository();
$polls = new Polls;
	
$polls = $conn->findAll();
function showtitle($poll){
	?>
	<form action="edit.php?id=<?= $poll->id?>" method="POST">
		<td style="width: 34px;">
		<button type="sumbit" class="btn btn-default btn-sm" title="Edit Title">
			<span class="glyphicon glyphicon-circle-arrow-up" aria-hidden="true"></span>
		</button>
		</td>
		<td style="width: 34px;">
			<a href="confirm.php?id=<?= $poll->id ?>" class="btn btn-default btn-sm" title="Del Title">
				<span class="glyphicon glyphicon-minus-sign" aria-hidden="true"></span>
			</a>
		</td>
		<td>
			<input type="text" class="form-control" name="title" placeholder="Title" value="<?= $poll->title ?>">
		</td>
		<td width="128px">
		<?= $poll->publishdate ?>
		</td>
		</form>
	<?php
}
?>
<div class="container-fluid">
<h2>ADD TITLE</h2>
<table class="table">
<tr>
<form action="add.php" method="POST">
<td style="width: 34px;">
<button type="sumbit" class="btn btn-default btn-sm" title="Add Title">
<span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span>
</button>
</td>
<td>
<input type="text" class="form-control" name="inputtitle" placeholder="Title"  required>
</td>
</form>
</tr>
</table>

<h2>DELETE/EDIT TITLE</h2>
<table class="table table-condensed">
<?php
if(count($polls) >0){
	foreach($polls as $poll){
		?>
		<tr>
			<?= showtitle($poll) ?>
		</tr>
		<?php
	}
}
?>
</table>
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

include_once($_SERVER['DOCUMENT_ROOT'] .'/ACP/Footer.php');
?>