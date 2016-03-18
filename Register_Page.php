<?php
	session_start();
	include_once('/Config.php');

	$pageName = "Register";
	
	//Set up page title!
	$title = (isset($pageName) ? $pageName : cfg::defaultPageName) . " | " . cfg::siteName . " (School Project)";

	//If you need header include other javascript or CSS
	function headerExtra()
	{
		?>

		<?php
	}
	include_once $_SERVER['DOCUMENT_ROOT'] ."/Header.php";
?>
<div class="container">
	<?php
	if(isset($_GET['error'])){
		$errormsg = array(
			"username" => "<strong>Opps!</strong> Your Username has been Used.",
			"password" => "<strong>Opps!</strong> Your Password does not Match.",
			"empty" => "<strong>Opps!</strong> You Forgot to fill up the Form."
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
	<form class="form-register" action="?action=register" method="POST">
		<h2 class="form-register-heading">Subscribe</h2>
		<hr />
		<div class="col-md-6">
			<label for="inputUsername"><h3>Username</h3></label>
			<input id="inputUsername" name="inputUsername" class="form-control" placeholder="Username" required="" autofocus="" type="text">
			<label for="inputEmail"><h3>Email</h3></label>
			<input id="inputEmail" name="inputEmail" class="form-control" placeholder="Email" required="" type="email">
		</div>
		<div class="col-md-6">
			<label for="inputPassword"><h3>Password</h3></label>
			<input id="inputPassword" name="inputPassword" class="form-control" placeholder="Password" required="" type="password">
			<label for="inputConPassword"><h3>Confirm Password</h3></label>
			<input id="inputConPassword" name="inputConPassword" class="form-control" placeholder="Confirm Password" required="" type="password">
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
			<input id="inputFullName" name="inputFullName" class="form-control" placeholder="Your Full Name" autofocus="" type="text">
			<label for="inputDisplayName"><h3>Display Name</h3></label>
			<input id="inputDisplayName" name="inputDisplayName" class="form-control" placeholder="How To Call You?" autofocus="" type="text">
		</div>
		<div class="col-md-6">
			<label for="inputPhone"><h3>Phone</h3></label>
			<input id="inputPhone" name="inputPhone" class="form-control" placeholder="Phone Number" autofocus="" type="text">
			<label for="inputCountry"><h3>Country</h3></label>
			<?php
				include_once("/Countries.php");
				countryList();
			?>
		</div>
		<div class="col-md-12">
			<hr />
			<button class="btn btn-lg btn-default btn-block" type="submit">Register</button>
		</div>
	</form>
</div>
<?php include_once $_SERVER['DOCUMENT_ROOT'] ."/Footer.php"; ?>