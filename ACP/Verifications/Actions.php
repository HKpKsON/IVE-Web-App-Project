<?php
// Security Check
include_once($_SERVER['DOCUMENT_ROOT'] .'/ACP/SecurityCheck.php');

include_once($_SERVER['DOCUMENT_ROOT'] .'/Models/Users.php');
include_once($_SERVER['DOCUMENT_ROOT'] .'/Models/Verifications.php');
include_once($_SERVER['DOCUMENT_ROOT'] .'/Repositories/UsersRepository.php');
include_once($_SERVER['DOCUMENT_ROOT'] .'/Repositories/VerificationsRepository.php');

include_once($_SERVER['DOCUMENT_ROOT'] .'/Config.php');

date_default_timezone_set('Asia/Hong_Kong');

use \Models\Users;
use \Models\Verifications;
use \Repositories\UsersRepository;
use \Repositories\VerificationsRepository;

use \PDO;
$PDO = new PDO('mysql:host='.cfg::dbIP.':'.cfg::dbPort.';dbname='.cfg::dbName,cfg::dbUser,cfg::dbPasswd);

$userRepo = new UsersRepository($PDO);
$verifyRepo = new VerificationsRepository($PDO);

if($userRepo->find($_SESSION['uid'])->isAdmin != 255){
	header('Location: /ACP/Verifications/');
	die();
}

if(isset($_GET['action'], $_GET['code']) && $_GET['action'] == 'edit'){
	$code = isset($_GET['code']) ? $_GET['code'] : FALSE;
	$verification = new Verifications;
	$verification = $code !== FALSE ? $verifyRepo->find($_GET['code']) : FALSE;
	$type = isset($_POST['inputType']) && ($_POST['inputType'] == 1 || $_POST['inputType'] == 0) ? $_POST['inputType'] : FALSE;
	
	if($verification !== FALSE && $type !== FALSE){
		
		$verification->type = $type;
		$verification->expireDate = isset($_POST['inputExpire']) ? $_POST['inputExpire'] : $verification->expireDate;
		$verification->valid = isset($_POST['inputValid']) ? $_POST['inputValid'] : $verification->valid;
		$result = $verifyRepo->update($verification);
		
		if($result !== FALSE){
			header('Location: /ACP/Verifications/?success=true&action='.$_GET['action']);
			die();
		}else{
			header('Location: /ACP/Verifications/?success=false&action='.$_GET['action']);
			die();
		}
	}
	
}elseif(isset($_GET['action']) && $_GET['action'] == 'add'){
	
	$user = isset($_POST['inputUsername']) ? $userRepo->findid($_POST['inputUsername']) : FALSE;
	$uid = $user !== FALSE ? $user : FALSE;
	$type = isset($_POST['inputType']) && ($_POST['inputType'] == 1 || $_POST['inputType'] == 0) ? $_POST['inputType'] : FALSE;
	
	if($uid !== FALSE && $type !== FALSE){
		$expire = isset($_POST['inputExpire']) ? $_POST['inputExpire'] : date("Y-m-d H:i:s", time());
		$valid = isset($_POST['inputValid']) ? $_POST['inputValid'] : 0;
		
		$verification = new Verifications;
		$verification->uid = $uid;
		$verification->type = $type;
		$verification->expireDate = $expire;
		$verification->valid = $valid;
		$result = $verifyRepo->save($verification);
		
		if($result !== FALSE){
			header('Location: /ACP/Verifications/?success=true&action='.$_GET['action']);
			die();
		}else{
			header('Location: /ACP/Verifications/?success=false&action='.$_GET['action']);
			die();
		}
	}else{
		header('Location: /ACP/Verifications/?success=false&action='.$_GET['action']);
		die();
	}

}elseif(isset($_GET['action']) && $_GET['action'] == 'delete'){
	
	$code = (isset($_GET['code']) && $verifyRepo->find($_GET['code']) !== FALSE) ? $_GET['code'] : FALSE;
	
	if(isset($_GET['confirm']) && $_GET['confirm'] == 'true'){
		if($code !== FALSE){
			$result = $verifyRepo->destroy($code);

			if($result !== FALSE){
				header('Location: /ACP/Verifications/?success=true&action='.$_GET['action']);
				die();
			}else{
				header('Location: /ACP/Verifications/?success=false&action='.$_GET['action']);
				die();
			}
		}else{
			header('Location: /ACP/Verifications/?success=false&action='.$_GET['action']);
			die();
		}
	}else{
		if($code !== FALSE){
			header('Location: Confirm.php?action=delete&code='.$code);
			die();
		}else{
			header('Location: /ACP/Verifications/?success=false&action='.$_GET['action']);
			die();
		}
	}
	
}else{
	// Action for Anything Else
	
	header('Location: /ACP/Verifications/');
	die();
}
?>