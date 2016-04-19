<?php
// Security Check
include_once($_SERVER['DOCUMENT_ROOT'] .'/ACP/SecurityCheck.php');


include_once($_SERVER['DOCUMENT_ROOT'] .'/Repositories/LoansRepository.php');
include_once($_SERVER['DOCUMENT_ROOT'] .'/Models/Loans.php');

include_once($_SERVER['DOCUMENT_ROOT'] .'/Config.php');


use \Models\Loans;
use \Repositories\LoansRepository;

use \PDO;
$PDO = new PDO('mysql:host='.cfg::dbIP.':'.cfg::dbPort.';dbname='.cfg::dbName,cfg::dbUser,cfg::dbPasswd);

$LoansRepo = new LoansRepository($PDO);

if(isset($_GET['action']) && isset($_GET['Loans']) && $_GET['action'] == 'update'){
    // Action for Update

    $Loans = new Loans;
    $Loans = $LoansRepo->find($_GET['Loans']);

    if($Loans === FALSE){
        header('Location: /ACP/Loans/?success=false');
        die();
    }else{
        switch($_POST['type']){
            case 'CreditCard':
                $Loans->type = 'Credit';
                break;
            case 'PersonalLoans':
                $Loans->type = 'Personal';
                break;
            case 'Martgage':
                $Loans->type = 'Mortgage';
                break;
            default:
                $Loans->type = 'Credit';
        }

        $Loans->displayname = $_POST['inputDisplayName'] == '' ? $user->username : $_POST['inputDisplayName'];
        $Loans->url = $_POST['url'];
        $Loans->logo = $_POST['logo'];
        $Loans->content = $_POST['content'];

        include_once($_SERVER['DOCUMENT_ROOT'] .'/Pages/Countries.php');
        $country = new Countries;
        $Loans->country = $country->validCountryCode($_POST['inputCountry']) ? $_POST['inputCountry'] : 'HK';

        $Loans->isAdmin = (isset($_POST['inputAdmin']) && ($_POST['inputAdmin'] == -1 || $_POST['inputAdmin'] == 0 || $_POST['inputAdmin'] == 1 || $_POST['inputAdmin'] == 255)) ? $_POST['inputAdmin'] : $user->isAdmin;
        $Loans->valid = (isset($_POST['inputValid']) && ($_POST['inputValid'] == 'TRUE' || $_POST['inputValid'] == 'FALSE')) ? $_POST['inputValid'] : $user->valid;

        $status = $LoansRepo->update($Loans);

        if($status !== FALSE){
            header('Location: /ACP/Loans/?success=true');
            die();
        }else{
            header('Location: /ACP/Loans/?success=false');
            die();
        }
    }

}elseif(isset($_GET['action']) && isset($_POST['inputUsername']) && $_GET['action'] == 'add'){
    // Action for Adding

    $Loans = new Loans;
    $user->username = $_POST['inputUsername'];
    $user->password = $_POST['inputPassword'] == '' ? '' : $userRepo->hashnsalt($_POST['inputPassword'], $userRepo->saltgen());

    switch($_POST['type']){
        case 'CreditCard':
            $Loans->type = 'Credit';
            break;
        case 'PersonalLoans':
            $Loans->type = 'Personal';
            break;
        case 'Martgage':
            $Loans->type = 'Mortgage';
            break;
        default:
            $Loans->type = 'Credit';
    }

    $Loans->displayname = $_POST['inputDisplayName'] == '' ? $user->username : $_POST['inputDisplayName'];
    $Loans->url = $_POST['url'];
    $Loans->logo = $_POST['logo'];
    $Loans->content = $_POST['content'];

    include_once($_SERVER['DOCUMENT_ROOT'] .'/Pages/Countries.php');
    $country = new Countries;
    $user->country = $country->validCountryCode($_POST['inputCountry']) ? $_POST['inputCountry'] : 'HK';

    $user->isAdmin = (isset($_POST['inputAdmin']) && ($_POST['inputAdmin'] == -1 || $_POST['inputAdmin'] == 0 || $_POST['inputAdmin'] == 1 || $_POST['inputAdmin'] == 255)) ? $_POST['inputAdmin'] : -1;
    $user->valid = $_POST['inputValid'] == 'TRUE' ? TRUE : FALSE;

    $LoansRepo->adduser($Loans);
    header('Location: /ACP/Loans/?page=last');
    die();

}else{
    // Action for Anything Else

    header('Location: /ACP/Loans/');
    die();
}
?>