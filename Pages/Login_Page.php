<?php
include_once($_SERVER['DOCUMENT_ROOT'] .'/Config.php');

$pageName = 'Sign in';

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
	if(isset($_GET['success'])){
		$successmsg = array(
		"invalid" => "<strong>Thank you!</strong> You can login to your account as soon as you are validated by email, please check your email inbox for the activation code. The email will be sent within 10 minutes.",
		"valid" => "<strong>Congratulations!</strong> You have sucessfully registered and activated your account, welcome aborad!"
		);
		
			if(isset($successmsg[$_GET['success']])){ ?>
	<div class="alert alert-success alert-dismissible" role="alert">
		<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		<?= $successmsg[$_GET['success']]; ?>
	</div>
	<?php } unset($successmsg); } ?>
	<div class="col-md-6">
		<form class="form-signin" action="?action=login" method="POST">
				<h2 class="form-signin-heading"><?= $pageName ?></h2>
				<hr />
				<label for="inputUsername" class="sr-only">Username</label>
				<input id="inputUsername" name="inputUsername" class="form-control" placeholder="Username / Email" required="" autofocus="" type="text" value="<?= $cookieName ?>">
				<label for="inputPassword" class="sr-only">Password</label>
				<input id="inputPassword" name="inputPassword" class="form-control" placeholder="Password" required="" type="password">
				<div class="checkbox row">
					<div class="col-md-6 text-left">
						<a href="/FogetPassword.php">Forget Password?</a>
					</div>
					<div class="col-md-6 text-right">
						<label>
							<input id="inputRemember" name="inputRemember" value="remember-me" type="checkbox"> Remember me
						</label>
					</div>
					<br />
				</div>
				<button class="btn btn-lg btn-success btn-block" type="submit">Sign in</button>
				<?php
				if(isset($_GET['error'])){
					$errormsg = array(
						"userpw" => "<strong>Opps!</strong> Wrong Username or Password.",
						"logged" => "<strong>Opps!</strong> You have already logged in.",
						"nologin" => "<strong>Opps!</strong> Please signin to view this page!",
						"invalid" => "<strong>Sorry,</strong> you are not allowed to sign in since your account is either <strong>locked</strong> or <strong>not validated by email</strong>, please check your email inbox for validation. (Can't find your email? <a href=\"/EmailValidation.php?action=requestemail\" target=\"_blank\">Resend it?</a>)"
					);
					
					if(isset($errormsg[$_GET['error']])){ ?>
				<br /><div class="alert alert-danger alert-dismissible" role="alert">
					<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<?= $errormsg[$_GET['error']]; ?>
				</div>
				<?php } unset($errormsg); } ?>
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