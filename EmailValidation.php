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

if(isset($_GET['action']) && $_GET['action'] == 'requestemail'){
	
	if(isset($_POST['inputUsername'], $_POST['inputEmail'])){
		
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
						if($user->valid == TRUE){
							header("Location: ?error=notinvalid");
						}
						
						$verifyRepo = new VerificationsRepository($PDO);
						$verification = new Verifications;
						
						$verification->uid = $user->id;
						$verification->type = 0;

						$verification->expireDate = date("Y-m-d H:i:s", time() + (2 * 24 * 60 * 60));
						$verification->valid = TRUE;
						
						// Remove Last Record
						$verifyRepo->removeRecord($user->id, 0);
						
						// Save Record
						$result = $verifyRepo->save($verification);
						
						if($result !== FALSE){
							// Send Email
							require_once($_SERVER['DOCUMENT_ROOT'] .'/Repositories/Mail.php');
							
							$mail->addAddress($user->email, $user->displayname);     // Add a recipient

							$mail->isHTML(true);                                  // Set email format to HTML

							$mail->Subject = $user->salutation . ' ' . $user->displayname . ', You have requested an account activation.';
							$mail->Body =	'<p>This is your code: <strong>'.$result.'</strong>, this code will be expired in 48 hours. Any code you have requested before will be expired. Please goto this location <a href="http://localhost:8080/EmailValidation.php?action=activation&code='.$result.'">Email Validation</a> to Activate your Account.</p>';
							$mail->AltBody = 'This is your code: ['.$result.'], this code will be expired in 48 hours. Any code you have requested before will be expired. http://localhost:8080/EmailValidation.php?action=activation&code='.$result;

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
	}else{
		include_once($_SERVER['DOCUMENT_ROOT'] .'/Pages/ResendEmail_Page.php');
	}
}elseif(isset($_GET['action']) && $_GET['action'] == 'activation'){

	if(isset($_POST['inputCode'])){
		$response = json_decode(file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=".$privatekey."&response=".$_POST['g-recaptcha-response']."&remoteip=".$_SERVER['REMOTE_ADDR']), true);
		
		if(isset($_POST['g-recaptcha-response'])){
			if($response['success'] == false){
				header("Location: ?action=activation&error=recaptcha");
				die();
			}else{
				$verifyRepo = new VerificationsRepository($PDO);
				$verify = new Verifications;
				
				$verify = $verifyRepo->find($_POST['inputCode']);

				if($verify == FALSE || $verify->type != 0){
					header("Location: ?action=activation&error=nosuchcode");
					die();
				}elseif(strtotime($verify->expireDate) < time()){
					header("Location: ?action=activation&error=expired");
					die();
				}else{
					$userRepo = new UsersRepository($PDO);
					$user = new Users;
					
					$user = $userRepo->find($verify->uid);
					$user->valid = TRUE;
					
					$userRepo->update($user);
					
					$verify->valid = 0;
					$verifyRepo->update($verify);
					
					// Send Email
					require_once($_SERVER['DOCUMENT_ROOT'] .'/Repositories/Mail.php');
							
					$mail->addAddress($user->email, $user->displayname);     // Add a recipient

					$mail->isHTML(true);                                  // Set email format to HTML

					$mail->Subject = $user->salutation . ' ' . $user->displayname . ', You have activated your account!';
					$mail->Body = '<p>Congratulations! You have activated your account! Now you can Login to our website and enjoy the services!</p>';
					$mail->AltBody = 'Congratulations! You have activated your account! Now you can Login to our website and enjoy the services!';

					$mail->send();
					
					header("Location: /Login.php?success=valid");
					die();
				}
			}
		}else{
			header("Location: ?action=activation&error=recaptcha");
			die();
		}
	}else{
		include_once($_SERVER['DOCUMENT_ROOT'] .'/Pages/EmailValidation_Page.php');
	}
	
}else{
	include_once($_SERVER['DOCUMENT_ROOT'] .'/Pages/ResendEmail_Page.php');
}