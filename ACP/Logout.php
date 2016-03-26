<?php
session_start();

unset($_SESSION['sessionTime']);

header('Location: /ACP/Login.php');
die();

?>