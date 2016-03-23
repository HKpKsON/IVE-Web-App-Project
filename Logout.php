<?php
session_start();

unset($_SESSION['uid']);
unset($_SESSION['salt']);
setcookie("login", "", time() - 3600);

include_once($_SERVER['DOCUMENT_ROOT'] .'/Pages/Logout_Page.php');
die();

?>