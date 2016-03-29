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
	$msg = array(
	'true' => '<strong>User Profile Edited.</strong>',
	'false' => '<strong>User Profile Edition Failed.</strong>'
	);

	if(isset($msg[$_GET['success']])){ ?>
	<div class="alert alert-warning alert-dismissible fade in" role="alert">
	<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
<?= $msg[$_GET['success']]; ?>
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
</form>
<table class="table table-condensed h5">
<tr>
	<th>ACTION</th>
	<th>UID</th>
	<th>Username</th>
	<th>Password</th>
	<th>Salutation</th>
	<th>Display Name</th>
	<th>Email</th>
	<th>Address</th>
	<th>Full Name</th>
	<th>Phone No.</th>
	<th>Country</th>
	<th>If Valid</th>
	<th>User Groups</th>
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
	echo "<td colspan=\"0\" class=\"text-center\">Cannot Find Record</td>";
}else{
	
$i = 1;

foreach($result as $user){

	if($i > (($page-1) * $itemPerPage)){
?>
<tr><form action="Actions.php?action=update&user=<?= $user->id ?>" method="POST">
	<td class="text-center">
		<button type="sumbit" class="btn btn-default btn-sm" title="Edit">
			<span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
		</button>
	</td>
	<td><?= $user->id ?></td>
	<td><?= $user->username ?></td>
	<td><input type="text" class="form-control inputPassword" name="inputPassword" <?= $user->isAdmin == 255 ? 'placeholder="Disabled" disabled' : 'placeholder="New Password"'?>></td>
	<td>
		<select class="form-control" name="inputSalutation">
			<option value="MR" <?= $user->salutation == 'Mr.' ? 'selected' : '' ?>>Mr.</option>
			<option value="MRS" <?= $user->salutation == 'Mrs.' ? 'selected' : '' ?>>Mrs.</option>
			<option value="MS" <?= $user->salutation == 'Ms.' ? 'selected' : '' ?>>Ms.</option>
		</select>
	</td>
	<td><input type="text" class="form-control inputDisplayName" name="inputDisplayName" placeholder="New Display Name" value="<?= $user->displayname ?>"></td>
	<td><input type="text" class="form-control inputEmail" name="inputEmail" placeholder="New Email" value="<?= $user->email ?>"></td>
	<td><input type="text" class="form-control inputAddress" name="inputAddress" placeholder="New Address" value="<?= $user->address ?>"></td>
	<td><input type="text" class="form-control inputFullName" name="inputFullName" placeholder="Full Name" value="<?= $user->fullname ?>"></td>
	<td><input type="text" class="form-control inputPhone" name="inputPhone" placeholder="Phone No." value="<?= $user->phone ?>"></td>
	<td>
		<?php
			include_once($_SERVER['DOCUMENT_ROOT'] .'/Pages/Countries.php');
			$countrylist = new Countries;
			$countrylist->displayForm($user->country);
		?>
	</td>
	<td>
		<select class="form-control" name="inputValid"<?= $user->isAdmin == 255 ? ' disabled' : ''?>>
			<option value="TRUE" <?= $user->valid == '1' ? 'selected' : '' ?>>Valid</option>
			<option value="FALSE" <?= $user->valid == '0' ? 'selected' : '' ?>>Invalid</option>
		</select>
	</td>
	<td>
		<select class="form-control" name="inputAdmin">
			<option value="-1" <?= $user->isAdmin == '-1' ? 'selected' : '' ?> <?= $user->isAdmin == 255 ? ' disabled' : ''?>>Locked</option>
			<option value="0" <?= $user->isAdmin == '0' ? 'selected' : '' ?>>User</option>
			<option value="1" <?= $user->isAdmin == '1' ? 'selected' : '' ?>>Editor</option>
			<option value="255" <?= $user->isAdmin == '255' ? 'selected' : '' ?>>Site Admin</option>
		</select>
	</td>
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
<tr><form action="Actions.php?action=add" method="POST">
	<td class="text-center">
		<button type="sumbit" class="btn btn-default btn-sm" title="Add User">
			<span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
		</button>
	</td>
	<td>New</td>
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
	<td><input type="text" class="form-control inputEmail" name="inputEmail" placeholder="New Email"></td>
	<td><input type="text" class="form-control inputAddress" name="inputAddress" placeholder="New Address"></td>
	<td><input type="text" class="form-control inputFullName" name="inputFullName" placeholder="Full Name"></td>
	<td><input type="text" class="form-control inputPhone" name="inputPhone" placeholder="Phone No."></td>
	<td>
		<?php
			include_once($_SERVER['DOCUMENT_ROOT'] .'/Pages/Countries.php');
			$countrylist = new Countries;
			$countrylist->displayForm();
		?>
	</td>
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
</form></tr>
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
    <script>
        console.log("This is Body End code");
    </script>

    <?php
}

include_once($_SERVER['DOCUMENT_ROOT'] .'/ACP/Footer.php');
?>