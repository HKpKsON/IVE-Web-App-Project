<?php
session_start();
include_once('/Config.php');
if(isset($_SESSION['uid'])){
	$conn = new UsersRepository(new PDO('mysql:host='.cfg::dbIP.':'.cfg::dbPort.';dbname='.cfg::dbName,cfg::dbUser,cfg::dbPasswd));
	$login = $conn->find($_SESSION['uid']);
	$pageName = "Welcome back, " . $login->displayname . "!";
}

//Set up page title!
$title = (isset($pageName) ? $pageName : cfg::defaultPageName) . " | " . cfg::siteName . " (School Project)";

//If you need header include other javascript or CSS
function headerExtra()
{
    ?>

    <?php
}
?>
<?php include_once('Header.php'); ?>
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<?php include_once('Footer.php'); ?>