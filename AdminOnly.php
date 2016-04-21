<?php
include_once($_SERVER['DOCUMENT_ROOT'] .'/Config.php');

include_once($_SERVER['DOCUMENT_ROOT'] .'/Repositories/UsersRepository.php');
include_once($_SERVER['DOCUMENT_ROOT'] .'/Models/Users.php');

use \Models\Users;
use \Repositories\UsersRepository;

use \PDO;

$PDO = new PDO('mysql:host='.cfg::dbIP.':'.cfg::dbPort.';dbname='.cfg::dbName,cfg::dbUser,cfg::dbPasswd);
$userRepo = new UsersRepository($PDO);

if(isset($_SESSION['uid'])){
	$user = $userRepo->find($_SESSION['uid']);
	
	if($user->isAdmin >= 1){
		?>
			<script>
				$(document).ready(function () {
					$(".admintext").show();
					$(".tddel").show();
					$(".enter-name").remove();
					$(".com-author").prop("type", "hidden");
					$(".com-author").val("ADMIN");


				});
			</script>
		<?php 
	}else{
		?>
			<script>
				$(document).ready(function () {
					$(".tddel").hide();
					$(".admintext").hide();
				});
			</script>
		<?php
	}
}else{
	?>
		<script>
			$(document).ready(function () {
				$(".tddel").hide();
				$(".admintext").hide();
			});
		</script>
	<?php
}