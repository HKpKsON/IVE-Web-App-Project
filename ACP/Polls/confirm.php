<?php
include_once($_SERVER['DOCUMENT_ROOT'] .'/Config.php');
include_once $_SERVER['DOCUMENT_ROOT'] ."/Repositories/PollsRepository.php";
include_once $_SERVER['DOCUMENT_ROOT'] ."/Models/Polls.php";

use \Models\Polls;
use \Repositories\PollsRepository;

$pageName = 'Set title';

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

function showtitle($poll){
	?>
		<td style="width: 34px;">
			<a href="Del.php?id=<?= $poll->id ?>" class="btn btn-default btn-sm" title="Del Title">
				<span class="glyphicon glyphicon-minus-sign" aria-hidden="true"></span>
			</a>
		</td>
		<td>
			<input type="text" class="form-control" name="inputtitle" placeholder="Title" value="<?= $poll->title ?>">
		</td>
		</form>
		
	<?php
}

if(!isset($_GET['id'])){
	header('Location: /ACP/Polls/');
}

$poll = new Polls;
$poll = $conn->find($_GET['id']);
?>


<h2>Confirm</h2>
<table class="table table-condensed">
<?php
	if($poll!==false){
	?>
	<tr>
		<?= showtitle($poll) ?>
	</tr>
	<?php
}else{
	header('Location: /ACP/Polls/');
}
?>
</table>

<a href="index.php" class="btn btn-default">Go Back</a>

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