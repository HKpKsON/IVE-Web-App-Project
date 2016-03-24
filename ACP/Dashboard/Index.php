<?php
include_once($_SERVER['DOCUMENT_ROOT'] .'/Repositories/UsersRepository.php');
include_once($_SERVER['DOCUMENT_ROOT'] .'/Models/Users.php');

include_once($_SERVER['DOCUMENT_ROOT'] .'/Config.php');

use \Models\Users;
use \Repositories\UsersRepository;

use \PDO;
$PDO = new PDO('mysql:host='.cfg::dbIP.':'.cfg::dbPort.';dbname='.cfg::dbName,cfg::dbUser,cfg::dbPasswd);

$userRepo = new UsersRepository($PDO);
$user = $userRepo->find($_SESSION['uid']);
?>
<p class="h2">
<?php
if($user->isAdmin == 255){
	echo "Welcome back, Site Admin ".$user->salutation." ".$user->displayname."!";
}elseif($user->isAdmin == 1){
	echo "Welcome back, Editor ".$user->salutation." ".$user->displayname."!";
}else{
	echo "You should not be here, ".$user->salutation." ".$user->displayname."!";
}
?>
</p><br /><br />
<h2>Message of the day:</h2>
<p>
	<a href="http://www.vtc.edu.hk/" target="_blank">Do Not Put Links in the ACP without target="_blank" !!</a>
</p>