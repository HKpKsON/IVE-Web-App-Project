<link rel="stylesheet" href="/Includes/loan.css">
<?php
//Logic related to Database!
include_once $_SERVER['DOCUMENT_ROOT'] ."/Models/Loans.php";
include_once $_SERVER['DOCUMENT_ROOT'] ."/Repositories/LoansRepository.php";

use \Models\Loans;
use \Repositories\LoansRepository;

$Repo = new LoansRepository();

function ShowLoan($Loan){
    // Display Data
	?>

		<div class="col col-md-3 text-center">
			<a href="<?= $Loan->url ?>" target="_blank">
			<img src="/Uploads/<?= $Loan->logo ?>" width="240" /><br />
			<p style="word-break : break-all"><?= $Loan->content ?></p>
			</a>
		</div>

	<?php
}

function GetLoanByType($type)
{
	$Repo = new LoansRepository();
    $Loans = new Loans;
    $Loans = $Repo->findAll($type);
	return $Loans;
}

$types = $Repo->findType();

// Boolean Expression ? TRUE DO : FALSE DO
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$amount = 4;

// Does not set $GET TYPE or Can't find $GET TYPE
if( !isset($_GET['type']) || array_search($_GET['type'], $types) === FALSE ){
	header('Location: ?type=' . $types[0]);
}

/*
array(
'0' => 'Type 1',
'1' => 'Type 2',
'2' => 'Type 3',
...
)
*/

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">

	<script src="//ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
	<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
</head>
<body>
<ul class="nav nav-tabs">
<?php
foreach ($types as $type) {
	?>
		<li role="presentation" <?= $_GET['type'] == $type ? 'class="active"' : '' ?> ><a href="?type=<?= $type ?>"><?= $type ?></a></li>
	<?php
}

?>
</ul>
<div>
	<?php	
	$Loans = GetLoanByType($_GET['type']);
		
	$i = 1;
		
	foreach($Loans as $Loan){

		if((($page - 1) * $amount < $i) && ($i <= $page * $amount)){
			ShowLoan($Loan);
		}

		if($i >= $page * $amount){
			if(count($Loans) % $amount !== 0){
				$i++;
			}
			break;
		}else{
			$i++;
		}
	}
	?>
</div>
<div class="col-md-12">
	<nav class="text-right">
		<ul class="pagination">
			<li>
				<a href="?page=<?= isset($_GET['page']) && $_GET['page'] > 1 ? $_GET['page'] -1 : '1' ?>&type=<?= $_GET['type'] ?>" aria-label="Previous">
					<span aria-hidden="true">&laquo;</span>
				</a>
			</li>
			<li>
				<span aria-hidden="true">Page <?= $page . " / " . ceil(count($Loans) / $amount) ?></span>
			</li>
			<li>
				<a href="?page=
				<?php
					if(isset($_GET['page'])){
						if(($_GET['page'] * $amount) < $i){
							echo $_GET['page'] +1;
						}else{
							echo $_GET['page'];
						}		
					}else{
						if($amount < $i){
							echo '2';
						}else{
							echo '1';
						}
					}
				?>
				&type=<?= $_GET['type'] ?>" aria-label="Next">
					<span aria-hidden="true">&raquo;</span>
				</a>
			</li>
		</ul>
	</nav>
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
?>

