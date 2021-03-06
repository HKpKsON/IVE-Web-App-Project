<?php
// Security Check
include_once($_SERVER['DOCUMENT_ROOT'] .'/ACP/SecurityCheck.php');

include_once($_SERVER['DOCUMENT_ROOT'] .'/Repositories/UsersRepository.php');
include_once($_SERVER['DOCUMENT_ROOT'] .'/Models/Users.php');

include_once($_SERVER['DOCUMENT_ROOT'] .'/Config.php');

use \Models\Users;
use \Repositories\UsersRepository;

use \PDO;
$PDO = new PDO('mysql:host='.cfg::dbIP.':'.cfg::dbPort.';dbname='.cfg::dbName,cfg::dbUser,cfg::dbPasswd);

$userRepo = new UsersRepository($PDO);

if($userRepo->find($_SESSION['uid'])->isAdmin != 255){
	header('Location: /ACP/Users/');
	die();
}

if(isset($_GET['action']) && isset($_GET['user']) && $_GET['action'] == 'edit'){
	// Action for Update
	
	$user = new Users;
	$user = $userRepo->find($_GET['user']);

	if($user === FALSE){
		header('Location: /ACP/Users/?success=false&action='.$_GET['action']);
		die();
	}else{
		$user->password = ($user->isAdmin == 255 || $_POST['inputPassword'] == '') ? $user->password : $userRepo->hashnsalt($_POST['inputPassword'], $userRepo->saltgen());
		
		switch($_POST['inputSalutation']){
			case 'MR':
				$user->salutation = 'Mr.';
				break;
			case 'MRS':
				$user->salutation = 'Mrs.';
				break;
			case 'MS':
				$user->salutation = 'Ms.';
				break;
			default:
				$user->salutation = 'Mr.';
		}
		
		$user->displayname = $_POST['inputDisplayName'] != '' ? $_POST['inputDisplayName'] : $user->username;
		$user->email = $_POST['inputEmail'];
		$user->address = $_POST['inputAddress'];
		$user->fullname = $_POST['inputFullName'];
		$user->phone = $_POST['inputPhone'];
		
		include_once($_SERVER['DOCUMENT_ROOT'] .'/Pages/Countries.php');
		$country = new Countries;
		$user->country = $country->validCountryCode($_POST['inputCountry']) ? $_POST['inputCountry'] : 'HK';

		$user->isAdmin = (isset($_POST['inputAdmin']) && ($_POST['inputAdmin'] == -1 || $_POST['inputAdmin'] == 0 || $_POST['inputAdmin'] == 1 || $_POST['inputAdmin'] == 255)) ? $_POST['inputAdmin'] : $user->isAdmin;
		$user->valid = (isset($_POST['inputValid']) && ($_POST['inputValid'] == 'TRUE' || $_POST['inputValid'] == 'FALSE')) ? $_POST['inputValid'] : $user->valid;
		
		$status = $userRepo->update($user);

		if($status !== FALSE){
			header('Location: /ACP/Users/?success=true&action='.$_GET['action']);
			die();
		}else{
			header('Location: /ACP/Users/?success=false&action='.$_GET['action']);
			die();
		}
	}

}elseif(isset($_GET['action']) && isset($_POST['inputUsername']) && $_GET['action'] == 'add'){
	// Action for Adding
	
	$user = new Users;
	$user->username = $_POST['inputUsername'];
	$user->password = $_POST['inputPassword'] == '' ? '' : $userRepo->hashnsalt($_POST['inputPassword'], $userRepo->saltgen());
		
	switch($_POST['inputSalutation']){
		case 'MR':
			$user->salutation = 'Mr.';
			break;
		case 'MRS':
			$user->salutation = 'Mrs.';
			break;
		case 'MS':
			$user->salutation = 'Ms.';
			break;
		default:
			$user->salutation = 'Mr.';
	}
		
	$user->displayname = $_POST['inputDisplayName'] == '' ? $user->username : $_POST['inputDisplayName'];
	$user->email = $_POST['inputEmail'];
	$user->address = $_POST['inputAddress'];
	$user->fullname = $_POST['inputFullName'];
	$user->phone = $_POST['inputPhone'];
		
	include_once($_SERVER['DOCUMENT_ROOT'] .'/Pages/Countries.php');
	$country = new Countries;
	$user->country = $country->validCountryCode($_POST['inputCountry']) ? $_POST['inputCountry'] : 'HK';

	$user->isAdmin = (isset($_POST['inputAdmin']) && ($_POST['inputAdmin'] == -1 || $_POST['inputAdmin'] == 0 || $_POST['inputAdmin'] == 1 || $_POST['inputAdmin'] == 255)) ? $_POST['inputAdmin'] : -1;
	$user->valid = $_POST['inputValid'] == 'TRUE' ? TRUE : FALSE;
		
	$result = $userRepo->adduser($user);
	
	if($result == -1){
		header('Location: /ACP/Users/?page=last&success=true&action='.$_GET['action']);
		die();
	}else{
		header('Location: /ACP/Users/?success=false&action='.$_GET['action']);
		die();
	}
	
}else{
	// Action for Anything Else
	
	header('Location: /ACP/Users/');
	die();
}
?>