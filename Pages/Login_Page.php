<?php
include_once($_SERVER['DOCUMENT_ROOT'] .'/Config.php');

$pageName = 'Login';

//Set up page title!
$title = (isset($pageName) ? $pageName : cfg::defaultPageName) . ' | ' . cfg::siteName . ' (School Project)';

//If you need header include other javascript or CSS
function headerExtra()
{
    ?>

    <?php
}

include_once($_SERVER['DOCUMENT_ROOT'] .'/Header.php');
$cookieName = isset($_COOKIE['username']) ? $_COOKIE['username'] : '';
?>
<div class="container">
	<?php
	if(isset($_GET['success']) && $_GET['success'] == 'true'){
	?>
	<div class="alert alert-success alert-dismissible" role="alert">
		<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		<strong>Congratulations!</strong> You have sucessfully registered, welcome aborad!
	</div>
	<?php } ?>
	<div class="col-md-6">
		<form class="form-signin" action="?action=login" method="POST">
				<h2 class="form-signin-heading"><?= $pageName ?></h2>
				<hr />
				<label for="inputUsername" class="sr-only">Username</label>
				<input id="inputUsername" name="inputUsername" class="form-control" placeholder="Username / Email" required="" autofocus="" type="text" value="<?= $cookieName ?>">
				<label for="inputPassword" class="sr-only">Password</label>
				<input id="inputPassword" name="inputPassword" class="form-control" placeholder="Password" required="" type="password">
				<div class="checkbox">
				  <label>
					<input id="inputRemember" name="inputRemember" value="remember-me" type="checkbox"> Remember me
				  </label>
				  <a class="text-right" href="/FogetPassword.php">Forget Password?</a>
				</div>
				<button class="btn btn-lg btn-success btn-block" type="submit">Sign in</button>
				<?php
				if(isset($_GET['error'])){
					$errormsg = array(
						"userpw" => "<strong>Opps!</strong> Wrong Username or Password.",
						"logged" => "<strong>Opps!</strong> You have already logged in.",
						"nologin" => "<strong>Opps!</strong> Please login to view this page!"
					);
					
					if(isset($errormsg[$_GET['error']])){
				?>
				<div class="alert alert-danger alert-dismissible" role="alert">
					<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<?= $errormsg[$_GET['error']]; ?>
				</div>
				<?php
					}
					unset($errormsg);
				}
				?>
		</form>
	</div>
	<div class="col-md-6">
		<form class="form-register" action="/Register.php?action=ref" method="POST">
				<h2 class="form-register-heading">Subscribe</h2>
				<hr />
				<label for="inputUsername" class="sr-only">Username</label>
				<input id="inputUsername" name="inputUsername" class="form-control" placeholder="Username" required="" autofocus="" type="text">
				<label for="inputEmail" class="sr-only">Email</label>
				<input id="inputEmail" name="inputEmail" class="form-control" placeholder="Email" required="" autofocus="" type="email">
				<hr />
				<button class="btn btn-lg btn-default btn-block" type="submit">Register</button>
		</form>
	</div>
</div>
<?php
//If you need add javascript before the end of body!
function bodyEndExtra()
{
    ?>
    <script>
        console.log("This is Body End code");
    </script>

    <?php
}

include_once($_SERVER['DOCUMENT_ROOT'] .'/Footer.php');
?>