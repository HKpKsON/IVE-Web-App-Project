<?php
include_once($_SERVER['DOCUMENT_ROOT'] .'/Config.php');
	
$pageName = 'Logout Success';

//Set up page title!
$title = (isset($pageName) ? $pageName : cfg::defaultPageName) . ' | ' . cfg::siteName . ' (School Project)';

//If you need header include other javascript or CSS
function headerExtra()
{
    ?>
    <?php
}

include_once($_SERVER['DOCUMENT_ROOT'] .'/Header.php');
?>
<div class="container">
	<h2 class="form-register-heading"><?= $pageName ?></h2>
	<hr />
	<div class="panel panel-success">
		<div class="panel-heading panel-title">You have been logged out.</div>
	<?php if(isset($_GET['reason']) && $_GET['reason'] == 'user'){ ?>
		<div class="panel-body h4">Reason: You clicked the Logout button.</div>
	<?php } ?>
	<?php if(isset($_GET['reason']) && $_GET['reason'] == 'idle'){ ?>
		<div class="panel-body h4">Reason: You have no activity for too long!</div>
	<?php } ?>
	<?php if(isset($_GET['reason']) && $_GET['reason'] == 'timeout'){ ?>
		<div class="panel-body h4">Reason: This session has been timeout.</div>
	<?php } ?>
		<a href="/"><div class="panel-footer text-center">Click me to go back to the homepage</div></a>
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