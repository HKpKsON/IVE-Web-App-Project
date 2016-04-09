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

include_once($_SERVER['DOCUMENT_ROOT'] .'/Models/Users.php');
include_once($_SERVER['DOCUMENT_ROOT'] .'/Models/Verifications.php');
include_once($_SERVER['DOCUMENT_ROOT'] .'/Repositories/UsersRepository.php');
include_once($_SERVER['DOCUMENT_ROOT'] .'/Repositories/VerificationsRepository.php');

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
<h1><?= $pageName ?></h1>
<hr />
<?php
// User Permission Check
$userRepo = new UsersRepository($PDO);

if($userRepo->find($_SESSION['uid'])->isAdmin != 255){
	echo "<p>Sorry, You are not allowed to view this page.</p>";
}else{
	$verifyRepo = new VerificationsRepository($PDO);
	$code = (isset($_GET['code']) && $verifyRepo->find($_GET['code']) !== FALSE) ? $_GET['code'] : FALSE;
	if($code !== FALSE){
?>
<div class="alert alert-warning" role="alert">
	<h1>Are You Sure To Delete Record?</h1>
	<h3>Code: <?= $code ?></h3>
	<h3>For User: <?= $userRepo->find($verifyRepo->find($code)->uid)->username ?></h3>
	<br />
	<span><a class="btn btn-success btn-lg" href="Actions.php?action=delete&code=<?= $code ?>&confirm=true" role="button">YES</a></span>
	<span class="pull-right"><a class="btn btn-danger btn-lg" href="/ACP/Verifications/" role="button">NO</a></span>
</div>
<?php
	}else{
		header('Location: /ACP/Verifications/?success=false&action=delete');
		die();
	}
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