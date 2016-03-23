<?php
include_once($_SERVER['DOCUMENT_ROOT'] .'/Config.php');
	
$pageName = 'Email Activation';

//Set up page title!
$title = (isset($pageName) ? $pageName : cfg::defaultPageName) . ' | ' . cfg::siteName . ' (School Project)';

//If you need header include other javascript or CSS
function headerExtra()
{
    ?>
	<script src='//www.google.com/recaptcha/api.js'></script>
    <?php
}

include_once($_SERVER['DOCUMENT_ROOT'] .'/Header.php');
?>
<div class="container">
	<form class="form-register" action="?action=activation" method="POST">
		<h2 class="form-register-heading"><?= $pageName ?></h2>
		<hr />
		<?php
		if(isset($_GET['error'])){
			$errormsg = array(
				"recaptcha" => "<strong>Opps!</strong> Please proof that you are not a robot!",
				"nosuchcode" => "<strong>Opps!</strong> There is no such reset code!",
				"expired" => "<strong>Opps!</strong> Your code is either expired or used.",
				"empty" => "<strong>Opps!</strong> You forgot to fill up the form!",
				"server" => "<strong>Oh no!</strong> The server room is on fire!"
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
		<div class="col-md-6">
			<label for="inputCode"><h3>Code</h3></label>
			<input id="inputCode" name="inputCode" class="form-control" placeholder="Code" type="text" required="">
		</div>
		<div class="col-md-6">
			<label for="inputRecaptcha"><h3>Proof that your are human:</h3></label>
			<div class="g-recaptcha" data-sitekey="6Le6ShsTAAAAABNekfeYmWEfP9RBLytL58XrYPMu"></div>
		</div>
		<div class="col-md-12">
			<hr />
			<button class="btn btn-lg btn-danger btn-block" type="submit">Activate Account</button>
		</div>
	</form>
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