<?php
include_once $_SERVER['DOCUMENT_ROOT'] ."/Header.php";

include_once $_SERVER['DOCUMENT_ROOT'] ."/Repositories/UsersRepository.php";
include_once $_SERVER['DOCUMENT_ROOT'] ."/Models/Users.php";

include_once('/Config.php');

use \Models\Users;
use \Repositories\UsersRepository;

use \PDO;

if(isset($_GET['action'])){
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

	if($login !== false){
		$_SESSION['uid'] = $login;
		$user = $conn->find($login);
		echo 'Welcome, ' . $user->salutation . ' ' . $user->displayname . '!';
	}else{
		header('Location: ?error=userpw');
	}
	
	if(isset($_POST['inputRemember'])){
		setcookie('username', $_POST['inputUsername']);
	}
}else{
	$cookieName = isset($_COOKIE['username']) ? $_COOKIE['username'] : '';
	$msg_error_userpw = '<div class="alert alert-danger">Wrong Usernmae or Password</div>';
?>
<form class="form-signin" action="?action=login" method="POST">
        <h2 class="form-signin-heading">Please sign in</h2>
        <label for="inputUsername" class="sr-only">Username</label>
        <input id="inputUsername" name="inputUsername" class="form-control" placeholder="Username / Email" required="" autofocus="" type="text" value="<?= $cookieName ?>">
        <label for="inputPassword" class="sr-only">Password</label>
        <input id="inputPassword" name="inputPassword" class="form-control" placeholder="Password" required="" type="password">
        <div class="checkbox">
          <label>
            <input id="inputRemember" name="inputRemember" value="remember-me" type="checkbox"> Remember me
          </label>
        </div>
        <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
</form>
<?php 

	if(isset($_GET['error']) && $_GET['error'] == 'userpw')
		echo $msg_error_userpw;

} ?>
<?php include_once $_SERVER['DOCUMENT_ROOT'] ."/Footer.php"; ?>