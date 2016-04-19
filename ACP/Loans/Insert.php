<?php
// Security Check
include_once($_SERVER['DOCUMENT_ROOT'] .'/ACP/SecurityCheck.php');


include_once($_SERVER['DOCUMENT_ROOT'] .'/Repositories/LoansRepository.php');
include_once($_SERVER['DOCUMENT_ROOT'] .'/Models/Loans.php');
include_once($_SERVER['DOCUMENT_ROOT'] .'/Repositories/UsersRepository.php');
include_once($_SERVER['DOCUMENT_ROOT'] .'/Models/Users.php');

include_once($_SERVER['DOCUMENT_ROOT'] .'/Config.php');


use \Models\Loans;
use \Repositories\LoansRepository;
use \Models\Users;
use \Repositories\UsersRepository;

use \PDO;
$PDO = new PDO('mysql:host='.cfg::dbIP.':'.cfg::dbPort.';dbname='.cfg::dbName,cfg::dbUser,cfg::dbPasswd);

$LoansRepo = new LoansRepository($PDO);

// User Permission Check
$userRepo = new UsersRepository($PDO);

if($userRepo->find($_SESSION['uid'])->isAdmin == 255){
	
	$Loan = new Loans;
	
	if(isset($_POST['url']) && trim($_POST['url']) != ''){
		
		switch($_POST['type']){
            case 'CreditCard':
                $Loan->type = 'Credit';
                break;
            case 'PersonalLoans':
                $Loan->type = 'Personal';
                break;
            default :
                $Loan->type = 'Mortgage';
        }
		function namegen($length = 32)
		{
			$charset = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
			$charsetlength = strlen($charset);
			$name = '';
			
			for ($i = 0; $i < $length; $i++){
				$name .= $charset[rand(0, $charsetlength - 1)];
			}
			
			return $name;
		}
		
		if($_FILES["logo"]["name"] && !$_FILES["logo"]["error"]){
			$uploadFile = $_FILES["logo"];
			
			$imageFileType = pathinfo($uploadFile["name"],PATHINFO_EXTENSION);

			if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif"){
				// Wrong File Type
				header('Location: /ACP/Loans/?success=false');
				die();
			}elseif($uploadFile["size"] > 2000000){
				// Too Big
				header('Location: /ACP/Loans/?success=false');
				die();
			}else{
				$target_dir = $_SERVER['DOCUMENT_ROOT']."/Uploads/";
				$target_name = namegen().'.'.$imageFileType;
				$target_file = $target_dir.$target_name;

				$uploaded = move_uploaded_file($uploadFile["tmp_name"], $target_file);
			}
		}
		
		$Loan->logo = $target_name;
		$Loan->url = $_POST['url'];
		$Loan->content = $_POST['content'];
		$stat = $LoansRepo->save($Loan);
		
		if($stat!==false){
			// success
			header('Location: /ACP/Loans/');
		}else{
			// false
			header('Location: /ACP/Loans/success=false');
		}
	}else{
		// Missing Information

		header('Location: /ACP/Loans/');
		die();
	}
}else{
    // No Permission

    header('Location: /ACP/Loans/');
    die();
}