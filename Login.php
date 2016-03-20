<?php
//If you need header include other javascript or CSS
function headerExtra()
{
    ?>

    <?php
}
?>
<?php
session_start();
include_once($_SERVER['DOCUMENT_ROOT'] .'/Repositories/UsersRepository.php');
include_once($_SERVER['DOCUMENT_ROOT'] .'/Models/Users.php');

include_once($_SERVER['DOCUMENT_ROOT'] .'/Config.php');

use \Models\Users;
use \Repositories\UsersRepository;

use \PDO;

if(!isset($_GET['error']) && isset($_SESSION['uid'])){
	header('Location: ?error=logged');
}else if(isset($_GET['action'])){
	$user = new Users;

	if(isset($_POST['inputUsername'], $_POST['inputPassword'])){
		if(filter_var($_POST['inputUsername'], FILTER_VALIDATE_EMAIL)){
			$user->email = $_POST['inputUsername'];
		}else{
			$user->username = $_POST['inputUsername'];
		}
		$user->password = $_POST['inputPassword'];
	}

	$conn = new UsersRepository(new PDO('mysql:host='.cfg::dbIP.':'.cfg::dbPort.';dbname='.cfg::dbName,cfg::dbUser,cfg::dbPasswd));
	$login = $conn->login($user);

	if(isset($_POST['inputRemember'])){
		setcookie('username', $_POST['inputUsername']);
	}
	
	if($login !== false){
		$_SESSION['uid'] = $login;
		$user = $conn->find($login);
		header("Location: /");
	}else{
		header('Location: ?error=userpw');
	}
}else{
	include_once($_SERVER['DOCUMENT_ROOT'] ."/Pages/Login_Page.php");
}
?>