<?php
include_once($_SERVER['DOCUMENT_ROOT'] .'/Config.php');

$pageName = 'Subscribe';
	
//Set up page title!
$title = (isset($pageName) ? $pageName : cfg::defaultPageName) . " | " . cfg::siteName . " (School Project)";

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
	<form id="form-register" action="?action=register" method="POST">
		<h2 class="form-register-heading"><?= $pageName ?></h2>
		<hr />
		<div class="panel panel-default">
			<div class="panel-body">
			<?php
			if(isset($_GET['error'])){
				$errormsg = array(
					"registered" => "<strong>Sorry</strong>, but the Username you choose was registed.",
					"password" => "<strong>Opps!</strong> There is something wrong with your password!",
					"empty" => "<strong>Opps!</strong> You Forgot to fill up the Form!",
					"username" => "<strong>Opps!</strong> There is something wrong with your Username! Please note that username must be 4 to 32 english characters and numbers.",
					"email" => "<strong>Opps!</strong> There is something wrong with your Email!",
					"server" => "<strong>Oh no!</strong> The server room is on fire!",
					"recaptcha" => "<strong>Opps!</strong> Please proof that you are not a robot!"
				);
				
				if(isset($errormsg[$_GET['error']])){
			?>
			<div class="alert alert-danger alert-dismissible fade in" role="alert">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<?= $errormsg[$_GET['error']]; ?>
			</div>
			<?php
				}
				unset($errormsg);
			}
			?>
			<div id="error-dialog" class="alert alert-danger alert-dismissible fade in" role="alert">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<span class="errormsg"></span>
			</div>
			<div class="col-md-6">
				<label for="inputUsername"><h3>Username</h3></label>
				<input id="inputRegUsername" name="inputUsername" class="form-control" placeholder="Username" type="text" required="" value="<?= isset($refer) ? $refer['username']: ''; ?>">
				<label for="inputEmail"><h3>Email</h3></label>
				<input id="inputRegEmail" name="inputEmail" class="form-control" placeholder="Email" type="email" required="" value="<?= isset($refer) ? $refer['email']: ''; ?>">
			</div>
			<div class="col-md-6">
				<label for="inputPassword"><h3>Password</h3></label>
				<input id="inputRegPassword" name="inputPassword" class="form-control" placeholder="Password" type="password" required="">
				<label for="inputConPassword"><h3>Confirm Password</h3></label>
				<input id="inputRegConPassword" name="inputConPassword" class="form-control" placeholder="Confirm Password" type="password" required="">
			</div>
			<div class="col-md-12"><hr /></div>
			<div class="col-md-6">
				<h3>Salutation</h3>
				<select class="form-control" name="inputSalutation">
					<option value="MR">Mr.</option>
					<option value="MRS">Mrs.</option>
					<option value="MS">Ms.</option>
				</select>
				<label for="inputFullName"><h3>Full Name</h3></label>
				<input id="inputFullName" name="inputFullName" class="form-control" placeholder="Your Full Name" type="text">
				<label for="inputDisplayName"><h3>Display Name</h3></label>
				<input id="inputDisplayName" name="inputDisplayName" class="form-control" placeholder="How To Call You?" type="text">
			</div>
			<div class="col-md-6">
				<label for="inputPhone"><h3>Phone</h3></label>
				<input id="inputPhone" name="inputPhone" class="form-control" placeholder="Phone Number" type="text">
				<label for="inputCountry"><h3>Country</h3></label>
				<?php
					include_once($_SERVER['DOCUMENT_ROOT'] .'/Pages/Countries.php');
					$countrylist = new Countries;
					$countrylist->displayForm();
				?>
			</div>
			<div class="col-md-6">
				<br />
				<div class="g-recaptcha" data-sitekey="6Le6ShsTAAAAABNekfeYmWEfP9RBLytL58XrYPMu"></div>
			</div>
			<div class="col-md-12">
				<hr />
				<button class="btn btn-lg btn-default btn-block formsubmit" type="submit">Register</button>
			</div>
		</form>
		</div>
</div>
</div>
<?php
//If you need add javascript before the end of body!
function bodyEndExtra()
{
    ?>
	<script src="Includes/js/register.js"></script>
    <script>
        console.log("This is Body End code");
    </script>

    <?php
}

include_once($_SERVER['DOCUMENT_ROOT'] .'/Footer.php');
?>