<?php
include_once($_SERVER['DOCUMENT_ROOT'] .'/Config.php');

$pageName = 'User Management';

//Set up page title!
$title = (isset($pageName) ? $pageName : cfg::defaultPageName) . ' | ' . cfg::siteName . ' (School Project)';

//If you need header include other javascript or CSS
function headerExtra()
{
    ?>
    <?php
}

include_once($_SERVER['DOCUMENT_ROOT'] .'/Repositories/UsersRepository.php');
include_once($_SERVER['DOCUMENT_ROOT'] .'/Models/Users.php');

include_once($_SERVER['DOCUMENT_ROOT'] .'/Config.php');

use \Models\Users;
use \Repositories\UsersRepository;

use \PDO;
$PDO = new PDO('mysql:host='.cfg::dbIP.':'.cfg::dbPort.';dbname='.cfg::dbName,cfg::dbUser,cfg::dbPasswd);

include_once($_SERVER['DOCUMENT_ROOT'] .'/ACP/Header.php');
?>
<!-- This is the actual body -->
<?php
if(isset($_GET['success'])){
	$action = isset($_GET['action']) && $_GET['action'] == 'add' ? 'Creation' : 'Action';
	$action = isset($_GET['action']) && $_GET['action'] == 'edit' ? 'Editing' : $action;
	// $action = isset($_GET['action']) && $_GET['action'] == 'delete' ? 'Deletion' : $action;
	
	$msg = array(
	'true' => '<strong>User Record '.$action.' Success.</strong>',
	'false' => '<strong>User Record '.$action.' Failed.</strong>'
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
Here you can view and edit all the users profile and information.<br />
Data will be shown with 10 records per page.
</p>
<p>
To Search Users, '%' means anything, '%user%' means any user with any prefix and suffix of 'user' are included.
</p>
<p>
Note: Password Edit, Locking and Validation Status are disabled to Admins for security reasons.
</p>
<form class="form-inline text-right" action="" method="GET">
<label><h4>Search: </h4></label>
<input type="text" class="form-control" id="search" name="search" placeholder="Search User" value="<?= isset($_GET['search']) ? $_GET['search'] : ''?>">
<button type="sumbit" class="btn btn-default" title="Search">
	<span class="glyphicon glyphicon-search" aria-hidden="true"></span>
</button>
<a class="btn btn-default" title="Clear Search" href="?search=">
	<span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
</a>
</form>
<table class="table table-condensed h5">
<tr>
	<th class="text-center" width="120">ACTION</th>
	<th>UID</th>
	<th>Username</th>
	<th>Full Name</th>
	<th>Display Name</th>
	<th>Email</th>
</tr>
<!-- User Edit -->
<?php
$search = (isset($_GET['search']) && $_GET['search'] !== '') ? $_GET['search'] : '%';
$result = $userRepo->findAll($search);

$itemPerPage = 10;
$total = $result !== FALSE ? count($result) : 0;
$mod = $total % $itemPerPage;
$maxPage = $mod == 0 ? $total / $itemPerPage : ($total - $mod) / $itemPerPage + 1;
$maxPage = $total > 0 ? $maxPage : 1;
$page = (isset($_GET['page']) && is_numeric($_GET['page']) && $_GET['page'] <= $maxPage && $_GET['page'] > 0) ? $page = $_GET['page'] : $page = 1;
$page = (isset($_GET['page']) && $_GET['page'] == 'last') ? $maxPage : $page;

if($total <= 0){
	echo "<td colspan=\"6\" class=\"text-center\">Cannot Find Record</td>";
}else{
	
$i = 1;

foreach($result as $user){

	if($i > (($page-1) * $itemPerPage)){
?>
<tr>
	<td class="text-center">
		<a class="btn btn-default btn-sm formtoggle" title="Edit Panel">
			<span class="glyphicon glyphicon-chevron-down" aria-hidden="true"></span>
		</a>
	</td>
	<td><?= $user->id ?></td>
	<td><?= $user->username ?></td>
	<td><?= $user->fullname ?></td>
	<td><?= $user->displayname ?></td>
	<td><?= $user->email ?></td>
</tr>
<tr>
<form action="Actions.php?action=edit&user=<?= $user->id ?>" method="POST">
	<td class="text-center">
		<button type="sumbit" class="btn btn-default btn-sm" title="Save">
			<span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
		</button>
	</td>
	<td><input type="text" class="form-control inputPassword" name="inputPassword" title="Change Password" <?= $user->isAdmin == 255 ? 'placeholder="Disabled" disabled' : 'placeholder="New Password"'?>></td>
	<td>
		<select class="form-control" name="inputSalutation" title="Salutation">
			<option value="MR" <?= $user->salutation == 'Mr.' ? 'selected' : '' ?>>Mr.</option>
			<option value="MRS" <?= $user->salutation == 'Mrs.' ? 'selected' : '' ?>>Mrs.</option>
			<option value="MS" <?= $user->salutation == 'Ms.' ? 'selected' : '' ?>>Ms.</option>
		</select>
	</td>
	<td><input type="text" class="form-control inputFullName" title="Full Name" name="inputFullName" placeholder="Full Name" value="<?= $user->fullname ?>"></td>
	<td><input type="text" class="form-control inputDisplayName" title="Display Name" name="inputDisplayName" placeholder="New Display Name" value="<?= $user->displayname ?>"></td>
	<td><input type="email" class="form-control inputEmail" title="Email Address" name="inputEmail" placeholder="New Email" value="<?= $user->email ?>"></td>
</tr><tr>
	<td>&nbsp;</td>
	<td>
		<select class="form-control" name="inputValid" title="Valid Account?" <?= $user->isAdmin == 255 ? ' disabled' : ''?>>
			<option value="TRUE" <?= $user->valid == '1' ? 'selected' : '' ?>>Valid</option>
			<option value="FALSE" <?= $user->valid == '0' ? 'selected' : '' ?>>Invalid</option>
		</select>
	</td>
	<td>
		<select class="form-control" name="inputAdmin" title="User Group">
			<option value="-1" <?= $user->isAdmin == '-1' ? 'selected' : '' ?> <?= $user->isAdmin == 255 ? ' disabled' : ''?>>Locked</option>
			<option value="0" <?= $user->isAdmin == '0' ? 'selected' : '' ?>>User</option>
			<option value="1" <?= $user->isAdmin == '1' ? 'selected' : '' ?>>Editor</option>
			<option value="255" <?= $user->isAdmin == '255' ? 'selected' : '' ?>>Site Admin</option>
		</select>
	</td>
	<td><input type="text" class="form-control inputPhone" title="Phone" name="inputPhone" placeholder="Phone No." value="<?= $user->phone ?>"></td>
	<td>
		<?php
			include_once($_SERVER['DOCUMENT_ROOT'] .'/Pages/Countries.php');
			$countrylist = new Countries;
			$countrylist->displayForm($user->country);
		?>
	</td>
	<td><input type="text" class="form-control inputAddress" title="Address" name="inputAddress" placeholder="New Address" value="<?= $user->address ?>"></td>
</form></tr>
<?php
		}
		
		if($mod == 0 && $i > $page*$itemPerPage)
			break;
		
		if($mod != 0 && $i >= $page*$itemPerPage)
			break;
		
		$i++;
	}
}
?>
<!-- Add New User -->
<form action="Actions.php?action=add" method="POST">
<tr>
	<td class="text-center">
		<button type="sumbit" class="btn btn-default btn-sm" title="Add User">
			<span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
		</button>
		<a class="btn btn-default btn-sm formtoggle" title="Edit">
			<span class="glyphicon glyphicon-chevron-down" aria-hidden="true"></span>
		</a>
	</td>
	<td><input type="text" class="form-control inputUsername" name="inputUsername" placeholder="New Username" required></td>
	<td><input type="text" class="form-control inputPassword" name="inputPassword" placeholder="New Password"></td>
	<td>
		<select class="form-control" name="inputSalutation">
			<option value="MR">Mr.</option>
			<option value="MRS">Mrs.</option>
			<option value="MS">Ms.</option>
		</select>
	</td>
	<td><input type="text" class="form-control inputDisplayName" name="inputDisplayName" placeholder="New Display Name"></td>
	<td><input type="email" class="form-control inputEmail" name="inputEmail" placeholder="New Email"></td>
</tr><tr>
	<td>
		<select class="form-control" name="inputValid">
			<option value="TRUE">Valid</option>
			<option value="FALSE" selected>Invalid</option>
		</select>
	</td>
	<td>
		<select class="form-control" name="inputAdmin">
			<option value="-1" selected>Locked</option>
			<option value="0">User</option>
			<option value="1">Editor</option>
			<option value="255">Site Admin</option>
		</select>
	</td>
	<td><input type="text" class="form-control inputFullName" name="inputFullName" placeholder="Full Name"></td>
	<td><input type="text" class="form-control inputPhone" name="inputPhone" placeholder="Phone No."></td>
	<td>
		<?php
			include_once($_SERVER['DOCUMENT_ROOT'] .'/Pages/Countries.php');
			$countrylist = new Countries;
			$countrylist->displayForm();
		?>
	</td>
	<td><input type="text" class="form-control inputAddress" name="inputAddress" placeholder="New Address"></td>
</tr></form>
</table>
<nav>
  <ul class="pager">
    <li class="previous <?= $page == 1 ? 'disabled' : '' ?>"><a class="black" href="?page=<?= $page == 1 ? $page : $page -1 ?><?= $search != '%' ? '&search='.$search : ''?>"><span aria-hidden="true">&larr;</span> Prev</a></li>
    <li class="next <?= $page >= $maxPage ? 'disabled' : '' ?>"><a class="black" href="?page=<?= $page >= $maxPage ? $page : $page +1 ?><?= $search != '%' ? '&search='.$search : ''?>">Next <span aria-hidden="true">&rarr;</span></a></li>
  </ul>
</nav>
<?php
}
//If you need add javascript before the end of body!
function bodyEndExtra()
{
    ?>
	<script src="Includes/js/form.js"></script>
    <script>
        console.log("This is Body End code");
    </script>

    <?php
}

include_once($_SERVER['DOCUMENT_ROOT'] .'/ACP/Footer.php');
?>