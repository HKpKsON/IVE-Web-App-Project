<?php
include_once($_SERVER['DOCUMENT_ROOT'] .'/Config.php');

$pageName = 'Verifications';

//Set up page title!
$title = (isset($pageName) ? $pageName : cfg::defaultPageName) . ' | ' . cfg::siteName . ' (School Project)';

//If you need header include other javascript or CSS
function headerExtra()
{
    ?>
    <?php
}

date_default_timezone_set('Asia/Hong_Kong');

include_once($_SERVER['DOCUMENT_ROOT'] .'/Repositories/UsersRepository.php');
include_once($_SERVER['DOCUMENT_ROOT'] .'/Repositories/VerificationsRepository.php');
include_once($_SERVER['DOCUMENT_ROOT'] .'/Models/Users.php');
include_once($_SERVER['DOCUMENT_ROOT'] .'/Models/Verifications.php');

include_once($_SERVER['DOCUMENT_ROOT'] .'/Config.php');

use \Models\Users;
use \Models\Verifications;
use \Repositories\UsersRepository;
use \Repositories\VerificationsRepository;

use \PDO;
$PDO = new PDO('mysql:host='.cfg::dbIP.':'.cfg::dbPort.';dbname='.cfg::dbName,cfg::dbUser,cfg::dbPasswd);

include_once($_SERVER['DOCUMENT_ROOT'] .'/ACP/Header.php');
?>
<!-- This is the actual body -->
<?php
if(isset($_GET['success'])){
	$action = isset($_GET['action']) && $_GET['action'] == 'add' ? 'Creation' : 'Action';
	$action = isset($_GET['action']) && $_GET['action'] == 'edit' ? 'Editing' : $action;
	$action = isset($_GET['action']) && $_GET['action'] == 'delete' ? 'Deletion' : $action;
	
	$msg = array(
	'true' => '<strong>Verification Record '.$action.' Success.</strong>',
	'false' => '<strong>Verification Record '.$action.' Failed.</strong>'
	);

	if(isset($msg[$_GET['success']])){ ?>
	<div class="alert alert-warning alert-dismissible fade in" role="alert">
	<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
<?= $msg[$_GET['success']] ?>
</div>
<?php } unset($msg); } ?>
<h1><?= $pageName ?></h1>
<hr />
<?php
// User Permission Check
$userRepo = new UsersRepository($PDO);

if($userRepo->find($_SESSION['uid'])->isAdmin != 255){
	echo "<p>Sorry, You are not allowed to view this page.</p>";
}else{
?>
<p>
Here you can view all the Email Verifications, you can filter only Valid or Non-Expired Verifications.<br />
Data will be shown with 10 record per page.
</p>
<p class="text-right">
<?php $filter = isset($_GET['filter']) ? $_GET['filter'] : 'all' ?>
<?php switch($filter){case 'valid': echo 'Fliter: Valid Only '; break; case 'invalid': echo 'Fliter: Invalid Only '; break; case 'nonexp': echo 'Fliter: Non-Expired Only '; break; case 'exp': echo 'Fliter: Expired Only '; break; default: ;}; ?> 
<?php if($filter != 'all'){ ?><a href="?filter=all" class="btn btn-default btn-sm" title="View All">View All</a> <?php } ?>
<?php if($filter == 'all'){ ?><a href="?filter=valid" class="btn btn-default btn-sm" title="Valid Only">Valid Only</a> <?php } ?>
<?php if($filter == 'all'){ ?><a href="?filter=invalid" class="btn btn-default btn-sm" title="Invalid Only">Invalid Only</a> <?php } ?>
<?php if($filter == 'all'){ ?><a href="?filter=nonexp" class="btn btn-default btn-sm" title="Non-Expired Onl">Non-Expired Only</a> <?php } ?>
<?php if($filter == 'all'){ ?><a href="?filter=exp" class="btn btn-default btn-sm" title="Expired Only">Expired Only</a> <?php } ?>
<form class="form-inline text-right" action="" method="GET">
<label><h4>Search: </h4></label>
<input type="text" class="form-control" id="search" name="search" placeholder="Search Code" value="<?= isset($_GET['search']) ? $_GET['search'] : ''?>">
<button type="sumbit" class="btn btn-default" title="Search">
	<span class="glyphicon glyphicon-search" aria-hidden="true"></span>
</button>
</form>
</p>
<table class="table table-condensed h5">
<tr>
	<th class="text-center" width="120">ACTION</th>
	<th>Code</th>
	<th>User</th>
	<th>Type</th>
	<th>Date Created</th>
	<th>Date Expiration</th>
	<th>Expired?</th>
	<th>Valid?</th>
</tr>
<?php
$verifyRepo = new VerificationsRepository($PDO);

$result = (isset($_GET['search']) && $_GET['search'] !== '') ? array($verifyRepo->find($_GET['search'])) : $verifyRepo->findAll();

$itemPerPage = 10;
$total = $result !== FALSE ? count($result) : 0;
$mod = $total % $itemPerPage;
$maxPage = $mod == 0 ? $total / $itemPerPage : ($total - $mod) / $itemPerPage + 1;
$maxPage = $total > 0 ? $maxPage : 1;
$page = (isset($_GET['page']) && is_numeric($_GET['page']) && $_GET['page'] <= $maxPage && $_GET['page'] > 0) ? $page = $_GET['page'] : $page = 1;

if($total <= 0){
	echo "<td colspan=\"0\" class=\"text-center\">Cannot Find Record</td>";
}else{
	
$i = 1;
$filtered = 0;

foreach($result as $validation){
	$matchfilter = ($filter == 'all' || ($filter == 'valid' && $validation->valid == 1) || ($filter == 'invalid' && $validation->valid == 0) || ($filter == 'nonexp' && strtotime($validation->expireDate) >= time()) || ($filter == 'exp' && strtotime($validation->expireDate) < time()));
	
	if($i > (($page-1) * $itemPerPage) && $matchfilter){
?>
<tr><form action="Actions.php?action=edit&code=<?= $validation->code ?>" method="POST">
	<td class="text-center">
		<button type="sumbit" class="btn btn-default btn-sm" title="Edit">
			<span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
		</button>
		<a href="Actions.php?action=delete&code=<?= $validation->code ?>" class="btn btn-default btn-sm" title="Delete">
			<span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
		</a>
	</td>
	<td><?= $validation->code ?></td>
	<td><?= $userRepo->find($validation->uid)->username ?></td>
	<td>
		<select class="form-control" name="inputType">
			<option value="0" <?= $validation->type == '0' ? 'selected' : '' ?>>Verify Account</option>
			<option value="1" <?= $validation->type == '1' ? 'selected' : '' ?>>Reset Password</option>
		</select>
	</td>
	<td><input type="text" class="form-control" value="<?= $validation->creationDate ?>" disabled></td>
	<td><input type="datetime" class="form-control inputExpire" name="inputExpire" placeholder="YYYY-MM-DD HH:MM:SS" value="<?= $validation->expireDate ?>"></td>
	<td><?= strtotime($validation->expireDate) > time() ? 'No' : 'Yes' ?></td>
	<td>
		<select class="form-control" name="inputValid">
			<option value="1" <?= $validation->valid == '1' ? 'selected' : '' ?>>Valid</option>
			<option value="0" <?= $validation->valid == '0' ? 'selected' : '' ?>>Invalid</option>
		</select>
	</td>
</form></tr>
<?php
}elseif(!$matchfilter){
	$filtered++;
}

if($mod == 0 && $i > $page*$itemPerPage)
	break;
		
if($mod != 0 && $i >= $page*$itemPerPage)
	break;
		
$i++;

}
if($total == $filtered){
	echo "<td colspan=\"0\" class=\"text-center\">All Record Filtered</td>";
} }

?>
<tr><form action="Actions.php?action=add" method="POST">
	<td class="text-center">
		<button type="sumbit" class="btn btn-default btn-sm" title="Create">
			<span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
		</button>
	</td>
	<td>New Code</td>
	<td><input type="text" class="form-control inputUsername" name="inputUsername" placeholder="Username" required></td>
	<td>
		<select class="form-control" name="inputType">
			<option value="0">Verify Account</option>
			<option value="1">Reset Password</option>
		</select>
	</td>
	<td><input type="text" class="form-control" placeholder="YYYY-MM-DD HH:MM:SS" value="Now" disabled></td>
	<td><input type="datetime" class="form-control inputExpire" name="inputExpire" placeholder="YYYY-MM-DD HH:MM:SS" value="<?= date("Y-m-d H:i:s", time() + (2 * 24 * 60 * 60)) ?>"></td>
	<td>-</td>
	<td>
		<select class="form-control" name="inputValid">
			<option value="1">Valid</option>
			<option value="0">Invalid</option>
		</select>
	</td>
</form></tr>
</table>
<nav>
  <ul class="pager">
    <li class="previous <?= $page == 1 ? 'disabled' : '' ?>"><a class="black" href="?page=<?= $page == 1 ? $page : $page -1 ?>"><span aria-hidden="true">&larr;</span> Prev</a></li>
    <li class="next <?= $page >= $maxPage ? 'disabled' : '' ?>"><a class="black" href="?page=<?= $page >= $maxPage ? $page : $page +1 ?>">Next <span aria-hidden="true">&rarr;</span></a></li>
  </ul>
</nav>
<?php
}
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