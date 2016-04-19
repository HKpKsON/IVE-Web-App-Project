<?php
session_start();
include_once($_SERVER['DOCUMENT_ROOT'] .'/Repositories/UsersRepository.php');
include_once($_SERVER['DOCUMENT_ROOT'] .'/Config.php');

use \Repositories\UsersRepository;
use \PDO;

if(isset($_SESSION['uid'])){
	$userRepo = new UsersRepository(new PDO('mysql:host='.cfg::dbIP.':'.cfg::dbPort.';dbname='.cfg::dbName,cfg::dbUser,cfg::dbPasswd));
	$login = $userRepo->find($_SESSION['uid']);
	$pageName = "Welcome back, " . $login->displayname . "!";
}

//Set up page title!
$title = (isset($pageName) ? $pageName : cfg::defaultPageName) . " | " . cfg::siteName . " (School Project)";

//If you need header include other javascript or CSS
function headerExtra()
{
    ?>
	<script src="//ajax.googleapis.com/ajax/libs/angularjs/1.4.5/angular.js"></script>
    <?php
}
?>
<?php include_once($_SERVER['DOCUMENT_ROOT'] .'/Header.php'); ?>
<?php include_once($_SERVER['DOCUMENT_ROOT'] .'/ListNews.php'); ?>
<?php include_once($_SERVER['DOCUMENT_ROOT'] .'/Pages/Weather_Box.php'); ?>
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