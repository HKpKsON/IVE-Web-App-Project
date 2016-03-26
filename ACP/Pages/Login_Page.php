<?php
include_once($_SERVER['DOCUMENT_ROOT'] .'/Config.php');

$pageName = 'Login to ACP';

//Set up page title!
$title = (isset($pageName) ? $pageName : cfg::defaultPageName) . ' | ' . cfg::siteName . ' (School Project)';

//If you need header include other javascript or CSS
function headerExtra()
{
    ?>
	<link rel="stylesheet" href="/ACP/Includes/CSS/login.css">
    <?php
}

include_once($_SERVER['DOCUMENT_ROOT'] .'/ACP/Pages/Header_Login.php');
$cookieName = isset($_COOKIE['username']) ? $_COOKIE['username'] : '';
?>
<div class="container">
	<div class="container jumbotron login-box">
		<a class="close" data-dismiss="alert" aria-label="Close" href="javascript:window.close()" title="Close ACP"><span aria-hidden="true">&times;</span></a>
		<div class="col-md-5">
			<h2>Admin Message:</h2>
			<hr />
			<h4>
			This page is only authorized to Site Admins and Editors, Please login to continue.
			</h4>
		</div>
		<div class="col-md-7">
			<form class="container orm-signin" action="?action=login" method="POST">
				<h2 class="form-signin-heading"><?= $pageName ?></h2>
				<hr />
				<label for="inputUsername" class="sr-only">Username</label>
				<input id="inputUsername" name="inputUsername" class="form-control" placeholder="Username / Email" required="" autofocus="" type="text" value="<?= $cookieName ?>">
				<label for="inputPassword" class="sr-only">Password</label>
				<input id="inputPassword" name="inputPassword" class="form-control" placeholder="Password" required="" type="password">
				<br />
				<button class="btn btn-lg btn-default btn-block" type="submit">Sign in</button>
			</form>
		</div>
		<div class="col-md-12">
			<?php
			if(isset($_GET['error'])){
				$errormsg = array(
					"userpw" => "<strong>Opps!</strong> Wrong Username or Password.",
					"logged" => "<strong>Opps!</strong> You have already logged in.",
					"notadmin" => "<strong>Opps!</strong> You are not an Admin!",
					"invalid" => "<strong>Sorry,</strong> you are not allowed to sign in since your account is either <strong>locked</strong> or <strong>not validated by email</strong>, please check your email inbox for validation. (Can't find your email? <a href=\"/EmailValidation.php?action=requestemail\" target=\"_blank\">Resend it?</a>)",
					"timeout" => "<strong>Sorry, </strong> your session has time-out. Please login again."
					);
						
				if(isset($errormsg[$_GET['error']])){ ?>
				<br /><div class="alert alert-danger alert-dismissible fade in" role="alert">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<?= $errormsg[$_GET['error']]; ?>
			</div>
			<?php } unset($errormsg); } ?>
		</div>
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

include_once($_SERVER['DOCUMENT_ROOT'] .'/ACP/Pages/Footer_Login.php');
?>