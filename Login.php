<?php
// Because the sack of session, it must run before anything.
// It supposed to load in Header.php, in case we need to use header(), we skip it.
// Which means we need to start the session manually.
isset($_GET['action']) ? session_start() : include_once $_SERVER['DOCUMENT_ROOT'] ."/Header.php";

include_once $_SERVER['DOCUMENT_ROOT'] ."/Repositories/UsersRepository.php";
include_once $_SERVER['DOCUMENT_ROOT'] ."/Models/Users.php";

include_once('/Config.php');

use \Models\Users;
use \Repositories\UsersRepository;

use \PDO;

if(!isset($_GET['error']) && isset($_SESSION['uid'])){
	header('Location: ?error=logged');
}else if(isset($_GET['action'])){
	$user = new Users;

	if(isset($_POST['inputUsername'], $_POST['inputPassword'])){
		if(filter_var($_POST['inputUsername'], FILTER_VALIDATE_EMAIL)){
			$user->email = $_POST['inputUsername'];
		}else{
			$user->username = $_POST['inputUsername'];
		}
		$user->password = $_POST['inputPassword'];
	}

	$conn = new UsersRepository(new PDO('mysql:host='.cfg::dbIP.':'.cfg::dbPort.';dbname='.cfg::dbName,cfg::dbUser,cfg::dbPasswd));
	$login = $conn->login($user);

	if(isset($_POST['inputRemember'])){
		setcookie('username', $_POST['inputUsername']);
	}
	
	if($login !== false){
		$_SESSION['uid'] = $login;
		$user = $conn->find($login);
		header("Location: /");
	}else{
		header('Location: ?error=userpw');
	}
}else{
	$cookieName = isset($_COOKIE['username']) ? $_COOKIE['username'] : '';
?>
<div class="container">
	<div class="col-md-6">
		<form class="form-signin" action="?action=login" method="POST">
				<h2 class="form-signin-heading">Please sign in</h2>
				<hr />
				<label for="inputUsername" class="sr-only">Username</label>
				<input id="inputUsername" name="inputUsername" class="form-control" placeholder="Username / Email" required="" autofocus="" type="text" value="<?= $cookieName ?>">
				<label for="inputPassword" class="sr-only">Password</label>
				<input id="inputPassword" name="inputPassword" class="form-control" placeholder="Password" required="" type="password">
				<div class="checkbox">
				  <label>
					<input id="inputRemember" name="inputRemember" value="remember-me" type="checkbox"> Remember me
				  </label>
				</div>
				<button class="btn btn-lg btn-success btn-block" type="submit">Sign in</button>
				<?php
					if(isset($_GET['error']) && $_GET['error'] == 'userpw'){
				?>
				<hr />
				<div class="alert alert-danger alert-dismissible">
					<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<strong>Opps!</strong> Wrong Username or Password.
				</div>
				<?php } ?>
				<?php
					if(isset($_GET['error']) && $_GET['error'] == 'logged'){
				?>
				<hr />
				<div class="alert alert-danger alert-dismissible" role="alert">
					<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<strong>Opps!</strong> You have already logged in.
				</div>
				<?php } ?>
		</form>
	</div>
	<div class="col-md-6">
		<form class="form-register" action="subscribe.php" method="POST">
				<h2 class="form-register-heading">Subscribe</h2>
				<hr />
				<label for="inputUsername" class="sr-only">Username</label>
				<input id="inputUsername" name="inputUsername" class="form-control" placeholder="Username" required="" autofocus="" type="text">
				<label for="inputEmail" class="sr-only">Email</label>
				<input id="inputEmail" name="inputEmail" class="form-control" placeholder="Email" required="" autofocus="" type="email">
				<hr />
				<label for="inputPassword" class="sr-only">Password</label>
				<input id="inputPassword" name="inputPassword" class="form-control" placeholder="Password" required="" type="password">
				<label for="inputPassword" class="sr-only">Confirm Password</label>
				<input id="inputConPassword" name="inputPassword" class="form-control" placeholder="Confirm Password" required="" type="password">
				<hr />
				<button class="btn btn-lg btn-default btn-block" type="submit">Register</button>
		</form>
	</div>
</div>
<?php } ?>
<?php include_once $_SERVER['DOCUMENT_ROOT'] ."/Footer.php"; ?>