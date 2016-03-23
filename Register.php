<?php
session_start();

date_default_timezone_set('Asia/Hong_Kong');

include_once($_SERVER['DOCUMENT_ROOT'] .'/Models/Users.php');
include_once($_SERVER['DOCUMENT_ROOT'] .'/Models/Verifications.php');
include_once($_SERVER['DOCUMENT_ROOT'] .'/Repositories/UsersRepository.php');
include_once($_SERVER['DOCUMENT_ROOT'] .'/Repositories/VerificationsRepository.php');

include_once($_SERVER['DOCUMENT_ROOT'] .'/Config.php');

// Recaptcha
$privatekey = "6Le6ShsTAAAAAKkI0MYrxX7nbdiNBnrxzNGAiFWZ";

use \Models\Users;
use \Models\Verifications;
use \Repositories\UsersRepository;
use \Repositories\VerificationsRepository;

use \PDO;
$PDO = new PDO('mysql:host='.cfg::dbIP.':'.cfg::dbPort.';dbname='.cfg::dbName,cfg::dbUser,cfg::dbPasswd);

if(!isset($_GET['error']) && isset($_SESSION['uid'])){
	header('Location: /Login.php?error=logged');
}else if(isset($_GET['action']) && $_GET['action'] == 'register'){
	
	if(isset($_POST['g-recaptcha-response'])){
		
		$response=json_decode(file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=".$privatekey."&response=".$_POST['g-recaptcha-response']."&remoteip=".$_SERVER['REMOTE_ADDR']), true);
		
		if($response['success'] == false){
			header("Location: ?error=recaptcha");
			die();
		}elseif(!isset($_POST['inputUsername'], $_POST['inputEmail'], $_POST['inputPassword'], $_POST['inputConPassword'])){
			header("Location: ?error=empty");
			die();
		}elseif(empty($_POST['inputUsername']) || !ctype_alnum($_POST['inputUsername'])){
			header("Location: ?error=username");
			die();
		}elseif(empty($_POST['inputEmail']) || !filter_var($_POST['inputEmail'], FILTER_VALIDATE_EMAIL)){
			header("Location: ?error=email");
			die();
		}elseif(empty($_POST['inputPassword']) || empty($_POST['inputConPassword']) || !ctype_alnum($_POST['inputPassword']) || $_POST['inputPassword'] !== $_POST['inputConPassword']){
			header("Location: ?error=password");
			die();
		}else{
			$user = new Users;
			$userRepo = new UsersRepository($PDO);
			
			$user->username = $_POST['inputUsername'];
			$user->email = $_POST['inputEmail'];
			$user->password = $_POST['inputPassword'];

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
					$user->salutation = null;
			}
			
			$user->fullname = $_POST['inputFullName'];
			$user->displayname = $_POST['inputDisplayName'] != '' ? $_POST['inputDisplayName'] : $_POST['inputUsername'];
			$user->phone = $_POST['inputPhone'];
			
			include_once($_SERVER['DOCUMENT_ROOT'] .'/Pages/Countries.php');
			$country = new Countries;
			$country->validCountryCode($_POST['inputCountry']) ? $user->country = $_POST['inputCountry'] : $user->country = '';

			$adduser = $userRepo->adduser($user);
			
			if($adduser == 1){
				header("Location: ?error=registered");
				die();
			}elseif($adduser == -1){
				$verifyRepo = new VerificationsRepository($PDO);
				$verification = new Verifications;
						
				$verification->uid = $userRepo->findid($user->username);
				$verification->type = 0;

				$verification->expireDate = date("Y-m-d H:i:s", time() + (2 * 24 * 60 * 60));
				$verification->valid = TRUE;
						
				// Remove Last Record
				$verifyRepo->removeRecord($userRepo->findid($user->username), 0);
						
				// Save Record
				$result = $verifyRepo->save($verification);
				
				// Send Email
				require_once($_SERVER['DOCUMENT_ROOT'] .'/Repositories/Mail.php');
							
				$mail->addAddress($user->email, $user->displayname);     // Add a recipient

				$mail->isHTML(true);                                  // Set email format to HTML
				$mail->Subject = $user->salutation . ' ' . $user->displayname . ', Please activated your account.';
				$mail->Body = '<p>You have just registered on our website, please activated your account with this code: <strong>'.$result.'</strong>, this code will be expired in 48 hours. Any code you have requested before will be expired. Please goto this location <a href="http://localhost:8080/EmailValidation.php?action=activation">Email Validation</a> to Activate your Account. If you did not register on our website, please ignore this email, thank you.</p>';
				$mail->AltBody = 'You have just registered on our website, please activated your account with this code: ['.$result.'], this code will be expired in 48 hours. Any code you have requested before will be expired. If you did not register on our website, please ignore this email, thank you. http://localhost:8080/EmailValidation.php?action=activation';
							
				$mail->send();

				header("Location: /Login.php?success=invalid");
				die();
			}else{
				header("Location: ?error=server");
				die();
			}
		}
	}else{
		header("Location: ?error=recaptcha");
		die();
	}
	
}else{
	if(isset($_GET['action']) && $_GET['action'] == 'ref'){
		$refer = array(
			'username' => isset($_POST['inputUsername']) ? $_POST['inputUsername'] : '',
			'email' => isset($_POST['inputEmail']) ? $_POST['inputEmail'] : ''
		);
	}
	
	include_once($_SERVER['DOCUMENT_ROOT'] ."/Pages/Register_Page.php");
}
?>