<?php
include_once($_SERVER['DOCUMENT_ROOT'] .'/Repositories/UsersRepository.php');
include_once($_SERVER['DOCUMENT_ROOT'] .'/Models/Users.php');

include_once($_SERVER['DOCUMENT_ROOT'] .'/Config.php');

use \Models\Users;
use \Repositories\UsersRepository;

use \PDO;

if(isset($_SESSION['uid'])){
	$conn = new UsersRepository(new PDO('mysql:host='.cfg::dbIP.':'.cfg::dbPort.';dbname='.cfg::dbName,cfg::dbUser,cfg::dbPasswd));
	$login = $conn->find($_SESSION['uid']);
?>
	<a href="/Profile.php">My Profile</a>
	<span>|</span>
	<?php if($login->isAdmin > 0){ ?><a href="/ACP/" target="_blank"><strong>ACP</strong></a><?php } ?>
	<span>|</span>
	<a href="/Logout.php">Logout</a>
<?php
}else{
	$cookieName = isset($_COOKIE['username']) ? $_COOKIE['username'] : '';
?>
<!-- Login Button -->
<a href="/register.php">Subscribe</a>
<span>|</span>
<a href="#" data-toggle="modal" data-target="#login-dialog-sm">Login</a>
<!-- Login Dialog -->
<div class="modal fade text-left" id="login-dialog-sm" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-body">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h1>Please sign in</h1>
				<hr />
				<form class="form-signin-dialog" action="Login.php?action=login" method="POST">
						<label for="inputUsername" class="sr-only">Login</label>
						<input id="inputUsername" name="inputUsername" class="form-control" placeholder="Username / Email" required="" autofocus="" type="text" value="<?= $cookieName ?>">
						<label for="inputPassword" class="sr-only">Password</label>
						<input id="inputPassword" name="inputPassword" class="form-control" placeholder="Password" required="" type="password">
						<div class="checkbox">
						  <label>
							<input id="inputRemember" name="inputRemember" value="remember-me" type="checkbox"> Remember me
						  </label>
						  <a class="text-right" href="/FogetPassword.php">Forget Password?</a>
						</div>
						<button class="btn btn-lg btn-success" type="submit">Sign in</button>
						<button class="btn btn-lg btn-danger" type="button" data-dismiss="modal">Cancel</button>
				</form>
			</div>
		</div>
	</div>
</div>
<?php } ?>