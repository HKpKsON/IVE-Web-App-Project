<?php
include_once $_SERVER['DOCUMENT_ROOT'] ."/Repositories/UsersRepository.php";
include_once $_SERVER['DOCUMENT_ROOT'] ."/Models/Users.php";

include_once('/Config.php');

use \Models\Users;
use \Repositories\UsersRepository;

use \PDO;

if(isset($_SESSION['uid'])){
	$conn = new UsersRepository(new PDO('mysql:host='.cfg::dbIP.':'.cfg::dbPort.';dbname='.cfg::dbName,cfg::dbUser,cfg::dbPasswd));
	$login = $conn->find($_SESSION['uid']);
?>
<div class="btn-group">
  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?= $login->displayname ?> <span class="caret"></span>
  </button>
  <ul class="dropdown-menu">
    <li><a href="#">My Profile</a></li>
    <li role="separator" class="divider"></li>
    <li><a href="/Logout.php">Logout</a></li>
  </ul>
</div>
<?php
}else{
	$cookieName = isset($_COOKIE['username']) ? $_COOKIE['username'] : '';
?>
<span type="button" class="btn btn-default" data-toggle="modal" data-target="#login-dialog">Login</span>
<div class="modal fade" id="login-dialog" role="dialog">
	<div id="login-dialog" class="modal-dialog">
		<div class="modal-content">
			<div class="modal-body">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h1>Please sign in</h1>
				<hr />
				<form class="form-signin" action="Login.php?action=login" method="POST">
						<label for="inputUsername" class="sr-only">Login</label>
						<input id="inputUsername" name="inputUsername" class="form-control" placeholder="Username / Email" required="" autofocus="" type="text" value="<?= $cookieName ?>">
						<label for="inputPassword" class="sr-only">Password</label>
						<input id="inputPassword" name="inputPassword" class="form-control" placeholder="Password" required="" type="password">
						<div class="checkbox">
						  <label>
							<input id="inputRemember" name="inputRemember" value="remember-me" type="checkbox"> Remember me
						  </label>
						</div>
						<button class="btn btn-lg btn-success" type="submit">Sign in</button>
						<button class="btn btn-lg btn-danger" type="button" data-dismiss="modal">Cancel</button>
				</form>
				<hr />
				<h1>New Here?</h1>
				<span class="btn btn-lg btn-default">Subscribe</span>
			</div>
		</div>
	</div>
</div>
<?php } ?>