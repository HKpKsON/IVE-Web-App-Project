<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/ACP/SecurityCheck.php');
include_once($_SERVER['DOCUMENT_ROOT'] . '/Config.php');

$pageName = 'Videos Management';

//Set up page title!
$title = (isset($pageName) ? $pageName : cfg::defaultPageName) . ' | ' . cfg::siteName . ' (School Project)';

//If you need header include other javascript or CSS
function headerExtra()
{
    ?>
    <?php
}


include_once($_SERVER['DOCUMENT_ROOT'] . '/Models/Users.php');
include_once($_SERVER['DOCUMENT_ROOT'] . '/Models/Videos.php');
include_once($_SERVER['DOCUMENT_ROOT'] . '/Repositories/UsersRepository.php');
include_once($_SERVER['DOCUMENT_ROOT'] . '/Repositories/VideosRepository.php');


include_once($_SERVER['DOCUMENT_ROOT'] . '/Config.php');

use \Models\Users;
use \Repositories\UsersRepository;
use \Models\Videos;
use \Repositories\VideosRepository;

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
    $VideosRepo = new VideosRepository($PDO);
    $Videos = new Videos();

    $Videos = $VideosRepo->findAll();

    ?>
    <div class="container-fluid" >
        <h2>Basic Table</h2>
        <p>The .table class adds basic styling (light padding and only horizontal dividers) to a table:</p>
        <table class="table">
            <thead>
            <tr>
                <th>action</th>
                <th>id</th>
                <th>type</th>
                <th>video</th>
                <th>title</th>
                <th>content</th>
            </tr>
            </thead>
            <tbody>

            <?php
			if(count($Videos) > 0) {
				foreach ($Videos as $Video) {
					?>
					<tr>
						<td>
							<span class="toggle">
								<span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
							</span><br />
							<a href="Detele.php?id=<?= $Video->id ?>">
								<span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
							</a>
						</td>
						<td><?=$Video->id ?></td>
						<td><?=$Video->type ?></td>
						<td><iframe width="300" height="140" src="https://www.youtube.com/embed/<?=$Video->video ?>" frameborder="0" allowfullscreen></iframe></td>
						<td><?=$Video->title ?></td>
						<td><?=$Video->content ?></td>
					</tr>
					
					<tr>
						<form action="Update.php?Video=<?=$Video->id ?>" method="POST" >
						<td><input type="submit" class="btn btn-default btn-sm" value="Submit"></td>
						<td><?= $Video->id ?></td>
						<td><select class="form-control" name='type'>
								<option value="China" <?= $Video->type == "China" ? "selected" : "" ?>>China</option>
								<option value="HongKong" <?= $Video->type == "HongKong" ? "selected" : "" ?>>Hong Kong</option>
								<option value="Asia" <?= $Video->type == "Asia" ? "selected" : "" ?>>Asia</option>
							</select></td>
						<td><input class="form-control" type="url" name="video" value="<?= $Video->video ?>" required></td>
						<td><input class="form-control" type="text" name="title"></td>
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
				<form action="Insert.php" method="POST" >
			        <td><input type="submit" class="btn btn-default btn-sm" value="Submit"></td>
                    <td>ID</td>
                    <td><select class="form-control" name='type'>
                            <option value="China" >China</option>
                            <option value="HongKong" >Hong Kong</option>
                            <option value="Asia" >Asia</option>
                        </select></td>
                    <td><input class="form-control" type="url" name="video"  required></td>
                    <td><input class="form-control" type="text" name="title"></td>
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