<?php
// Security Check
include_once($_SERVER['DOCUMENT_ROOT'] .'/ACP/SecurityCheck.php');


include_once($_SERVER['DOCUMENT_ROOT'] .'/Repositories/VideosRepository.php');
include_once($_SERVER['DOCUMENT_ROOT'] .'/Models/Videos.php');
include_once($_SERVER['DOCUMENT_ROOT'] .'/Repositories/UsersRepository.php');
include_once($_SERVER['DOCUMENT_ROOT'] .'/Models/Users.php');

include_once($_SERVER['DOCUMENT_ROOT'] .'/Config.php');


use \Models\Videos;
use \Repositories\VideosRepository;
use \Models\Users;
use \Repositories\UsersRepository;

use \PDO;
$PDO = new PDO('mysql:host='.cfg::dbIP.':'.cfg::dbPort.';dbname='.cfg::dbName,cfg::dbUser,cfg::dbPasswd);

$VideosRepo = new VideosRepository($PDO);

// User Permission Check
$userRepo = new UsersRepository($PDO);

function getYouTubeIdFromURL($url)
{
  $url_string = parse_url($url, PHP_URL_QUERY);
  parse_str($url_string, $args);
  return isset($args['v']) ? $args['v'] : false;
}



if($userRepo->find($_SESSION['uid'])->isAdmin == 255){
	
	$youtube_id = getYouTubeIdFromURL($_POST['video']);
	

	
	if(isset($_POST['video']) && trim($_POST['video']) != ''){
		
		$Video = new Videos;
		$Video = $VideosRepo->find($_GET['Video']);
		
		switch($_POST['type']){
            case 'HongKong':
                $Video->type = 'HongKong';
                break;
            case 'China':
                $Video->type = 'China';
                break;
            default:
                $Video->type = 'Asia';
        }
		
		$Video->video = $youtube_id !== False ? $youtube_id : $Video->video;
		$Video->title = $_POST['title'] == '' ? $Video->title : $_POST['title'];
		$Video->content = $_POST['content'] == '' ? $Video->content : $_POST['content'];
		
		$stat = $VideosRepo->update($Video);
		
		if($stat !== false){
			// success
			header('Location: /ACP/Videos/?success=true');
		}else{
			// false
			header('Location: /ACP/Videos/?success=false');
		}
	}else{
		// Missing Information

		header('Location: /ACP/Videos/');
		die('Missing Information');
	}
}else{
    // No Permission

    header('Location: /ACP/Videos/');
    die('No Permission');
}