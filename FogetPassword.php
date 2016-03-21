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
	die();
}elseif(isset($_GET['action']) && $_GET['action'] == 'findmypassword'){
	if(isset($_POST['g-recaptcha-response'])){
		$response=json_decode(file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=".$privatekey."&response=".$_POST['g-recaptcha-response']."&remoteip=".$_SERVER['REMOTE_ADDR']), true);
		
		if($response['success'] == false){
			header("Location: ?error=recaptcha");
			die();
		}else{
			if(isset($_POST['inputUsername']) && isset($_POST['inputEmail'])){
				$userRepo = new UsersRepository($PDO);
				$user = new Users;
				
				$user = $userRepo->find($userRepo->findid($_POST['inputUsername']));
				
				if($user !== false && $user->email == $_POST['inputEmail']){
					$verifyRepo = new VerificationsRepository($PDO);
					$verification = new Verifications;
					
					$verification->uid = $user->id;
					$verification->type = 1;

					$verification->expireDate = date("Y-m-d H:i:s", time() + (2 * 24 * 60 * 60));
					$verification->vaild = TRUE;
					
					// Remove Last Record
					$verifyRepo->removeRecord($user->id, 1);
					
					// Save Record
					$result = $verifyRepo->save($verification);
					
					if($result !== FALSE){
						// Send Email
						require_once($_SERVER['DOCUMENT_ROOT'] .'/Mail.php');
						
						$mail->addAddress($user->email, $user->displayname);     // Add a recipient

						$mail->isHTML(true);                                  // Set email format to HTML

						$mail->Subject = $user->salutation . ' ' . $user->displayname . ', You have requested a password recovery.';
						$mail->Body =	'This is your code: <strong>'.$result.'</strong>, this code will be expired in 48 hours. Any code you have requested before will be expired.
										<br />Please goto this location <a href="http://localhost:8080/FogetPassword.php?action=resetpassword">Reset Password</a> to reset your password.';
						$mail->AltBody = 'This is your code: ['.$result.'], this code will be expired in 48 hours. Any code you have requested before will be expired. http://localhost:8080/FogetPassword.php?action=resetpassword';

						if(!$mail->send()) {
							header("Location: ?error=server");
							die();
						}else{
							header("Location: ?success=true");
							die();
						}
					}else{
						header("Location: ?error=server");
						die();
					}
				}else{
					header("Location: ?error=nosuchmember");
					die();
				}
			}else{
				header("Location: ?error=empty");
				die();
			}
		}
	}else{
		header("Location: ?error=recaptcha");
		die();
	}
}elseif(isset($_GET['action']) && $_GET['action'] == 'resetpassword'){

	if(isset($_POST['inputPassword'], $_POST['inputConPassword'], $_POST['inputCode'])){
		$response = json_decode(file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=".$privatekey."&response=".$_POST['g-recaptcha-response']."&remoteip=".$_SERVER['REMOTE_ADDR']), true);
		
		if(isset($_POST['g-recaptcha-response'])){
			if($response['success'] == false && FALSE){
				header("Location: ?action=resetpassword&error=recaptcha");
				die();
			}else{
				$verifyRepo = new VerificationsRepository($PDO);
				$verify = new Verifications;
				
				$verify = $verifyRepo->find($_POST['inputCode']);

				if($verify == FALSE || $verify->type != 1){
					header("Location: ?action=resetpassword&error=nosuchcode");
					die();
				}elseif($_POST['inputPassword'] !== $_POST['inputConPassword']){
					header("Location: ?action=resetpassword&error=password");
					die();
				}elseif($verify->vaild != 1 || strtotime($verify->expireDate) < time()){
					header("Location: ?action=resetpassword&error=expired");
					die();
				}else{
					$userRepo = new UsersRepository($PDO);
					$user = new Users;
					
					$user = $userRepo->find($verify->uid);
					$user->password = $userRepo->hashnsalt($_POST['inputPassword'], $userRepo->saltgen());
					
					$userRepo->update($user);
					
					$verify->vaild = 0;
					$verifyRepo->update($verify);
					
					header("Location: ?action=resetpassword&success=true");
					die();
				}
			}
		}else{
			header("Location: ?action=resetpassword&error=recaptcha");
			die();
		}
	}else{
		include_once($_SERVER['DOCUMENT_ROOT'] .'/Pages/ResetPassword_Page.php');
	}
	
}else{
	include_once($_SERVER['DOCUMENT_ROOT'] .'/Pages/ForgetPassword_Page.php');
}