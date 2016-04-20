<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/ACP/SecurityCheck.php');
include_once($_SERVER['DOCUMENT_ROOT'] . '/Config.php');

$pageName = 'Loans Management';

//Set up page title!
$title = (isset($pageName) ? $pageName : cfg::defaultPageName) . ' | ' . cfg::siteName . ' (School Project)';

//If you need header include other javascript or CSS
function headerExtra()
{
    ?>
    <?php
}


include_once($_SERVER['DOCUMENT_ROOT'] . '/Models/Users.php');
include_once($_SERVER['DOCUMENT_ROOT'] . '/Models/Loans.php');
include_once($_SERVER['DOCUMENT_ROOT'] . '/Repositories/UsersRepository.php');
include_once($_SERVER['DOCUMENT_ROOT'] . '/Repositories/LoansRepository.php');


include_once($_SERVER['DOCUMENT_ROOT'] . '/Config.php');

use \Models\Users;
use \Repositories\UsersRepository;
use \Models\Loans;
use \Repositories\LoansRepository;

use \PDO;

$PDO = new PDO('mysql:host=' . cfg::dbIP . ':' . cfg::dbPort . ';dbname=' . cfg::dbName, cfg::dbUser, cfg::dbPasswd);

include_once($_SERVER['DOCUMENT_ROOT'] . '/ACP/Header.php');
?>

    <!-- This is the actual body -->
    <h1><?= $pageName ?></h1>
    <hr/>
<?php
// User Permission Check
$userRepo = new UsersRepository($PDO);

if ($userRepo->find($_SESSION['uid'])->isAdmin != 255) {
    echo "<p>Sorry, You are not allowed to view this page.</p>";
} else {

    // Is allowed to use:
    ?>

    <?php
    $LoansRepo = new LoansRepository($PDO);
    $Loans = new Loans();

    $Loans = $LoansRepo->findAll();


    ?>
    <div class="container-fluid">
        <h2>Basic Table</h2>
        <p>The .table class adds basic styling (light padding and only horizontal dividers) to a table:</p>
        <table class="table">
            <thead>
            <tr>
                <th>ACTION</th>
                <th>ID</th>
                <th>Type</th>
                <th>URL</th>
                <th>Logo</th>
                <th>Content</th>
            </tr>
            </thead>
            <tbody>

            <?php
			if(count($Loans) > 0) {
				foreach ($Loans as $Loan) {
					?>
					<tr>
						<td>
							<span class="toggle">
								<span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
							</span><br />
							<a href="Detele.php?id=<?= $Loan->id ?>">
								<span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
							</a>
						</td>
						<td><?= $Loan->id ?></td>
						<td><?= $Loan->type ?></td>
						<td><?= $Loan->url ?></td>
						<td><?= $Loan->logo !== null ? '<img src="/Uploads/'.$Loan->logo.'" width="128px" />' : '' ?></td>
						<td><?= $Loan->content ?></td>
					</tr>
					
					<tr>
						<form action="Update.php?loan=<?= $Loan->id ?>" method="POST" enctype="multipart/form-data">
						<td><input type="submit" class="btn btn-default btn-sm" value="Submit"></td>
						<td><?= $Loan->id ?></td>
						<td><select class="form-control" name='type'>
								<option value="CreditCard" <?= $Loan->type == "Credit" ? "selected" : "" ?>>Credit Card</option>
								<option value="PersonalLoans" <?= $Loan->type == "Personal" ? "selected" : "" ?>>Personal Loans</option>
								<option value="Martgage" <?= $Loan->type == "Mortgage" ? "selected" : "" ?>>Martgage</option>
							</select></td>
						<td><input class="form-control" type="url" name="url" value="<?= $Loan->url ?>" required></td>
						<td><input class="form-control" type="file" name="logo"></td>
						<td><textarea class="form-control" rows="4" name="content"></textarea></td>
						</form>
					</tr>
				<?php
				}
			}else{
				echo "No Record.";
			}
            ?>
			<tr>
				<form action="Insert.php" method="POST" enctype="multipart/form-data">
			        <td><input type="submit" class="btn btn-default btn-sm" value="Submit"></td>
                    <td>ID</td>
                    <td><select class="form-control" name="type">
                            <option value="CreditCard">Credit Card</option>
                            <option value="PersonalLoans">Personal Loans</option>
                            <option value="Martgage">Martgage</option>
                        </select></td>
                    <td><input class="form-control" type="url" name="url" required></td>
                    <td><input class="form-control" type="file" name="logo" ></td>
                    <td><textarea class="form-control" rows="4" name="content"></textarea></td>
				</form>
			</tr>
            </tbody>
        </table>

    </div>

    <?php
}
//If you need add javascript before the end of body!
function bodyEndExtra()
{
    ?>
	<script src="form.js"></script>
    <script>
        console.log("This is Body End code");
    </script>

    <?php
}

include_once($_SERVER['DOCUMENT_ROOT'] . '/ACP/Footer.php');
?>