<?php
//Logic related to Database!
include_once $_SERVER['DOCUMENT_ROOT'] ."/Models/Videos.php";
include_once $_SERVER['DOCUMENT_ROOT'] ."/Repositories/VideosRepository.php";

use \Models\Videos;
use \Repositories\VideosRepository;

$Repo = new VideosRepository();

function ShowVideo($Video){
    // Display Data
    ?>
    <p>
		<div class="col col-xs-4 col-sm-4 col-md-4 text-center">
			<a href="/Videos.php?vid=<?= $Video->id ?>&type=<?= isset($_GET['type']) ? $_GET['type'] : '' ?>&page=<?= isset($_GET['page']) ? $_GET['page'] : '' ?>" title="<?= $Video->title . " | SCMP.TV" ?>">
				<img class="hidden-xs hidden-sm" src="http://img.youtube.com/vi/<?= $Video->video ?>/mqdefault.jpg" />
				<img class="hidden-md hidden-lg" src="http://img.youtube.com/vi/<?= $Video->video ?>/default.jpg" />
			</a>
			<h6><?= $Video->createdate ?></h6>
		</div>
    </p>
    <?php
}

function GetVideoByType($type)
{
    $Repo = new VideosRepository();
    $Videos = new Videos;
    $Videos = $Repo->findAll($type);
    return $Videos;
}

$types = $Repo->findType();

// Boolean Expression ? TRUE DO : FALSE DO
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$amount = 6;

// Does not set $GET TYPE or Can't find $GET TYPE
if( !isset($_GET['type']) || array_search($_GET['type'], $types) === FALSE ){
    header('Location: ?type=' . $types[0]);
}

include_once($_SERVER['DOCUMENT_ROOT'] .'/Config.php');

$pageName = 'Videos';

//Set up page title!
$title = (isset($pageName) ? $pageName : cfg::defaultPageName) . " | " . cfg::siteName . " (School Project)";

//If you need header include other javascript or CSS
function headerExtra()
{
	?>

	<?php
}

include_once($_SERVER['DOCUMENT_ROOT'] .'/Header.php');
$vid = isset($_GET['vid']) ? $_GET['vid'] : $Repo->findAll($_GET['type'])[0]->id;
$onDisplay = $Repo->find($vid);
?>
<div class="container">
    <!-- 16:9 aspect ratio -->
	<div class="jumbotrom">
		<h1><?= $onDisplay->title ?></h1><hr />
		<div class="embed-responsive embed-responsive-16by9">
			<iframe class="embed-responsive-item" src="https://www.youtube.com/embed/<?= $onDisplay->video ?>"></iframe>
		</div><br />
		<div class="well">
			<h2>Descriptions</h1><hr />
			<p class="h4"><?= $onDisplay->content ?></p>
		</div>
	</div>
    <ul class="nav nav-tabs">
        <?php
        foreach ($types as $type) {
            ?>
            <li role="presentation" <?= $_GET['type'] == $type ? 'class="active"' : '' ?> ><a href="?type=<?= $type ?>"><?= $type ?></a></li>
            <?php
        }

        ?>
    </ul>
    <div>
        <?php
        $Videos = GetVideoByType($_GET['type']);

        $i = 1;

        foreach($Videos as $Video){

            if((($page - 1) * $amount < $i) && ($i <= $page * $amount)){
                ShowVideo($Video);
            }
			
            if($i >= $page * $amount){
                if(count($Videos) % $amount !== 0){
                    $i++;
                }
                break;
            }else{
                $i++;
            }
        }
        ?>
    </div>
    <div class="col-md-12">
        <nav class="text-right">
            <ul class="pagination">
                <li>
                    <a href="?page=<?= isset($_GET['page']) && $_GET['page'] > 1 ? $_GET['page'] -1 : '1' ?>&type=<?= $_GET['type'] ?>" aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                    </a>
                </li>
                <li>
                    <span aria-hidden="true">Page <?= $page . " / " . ceil(count($Videos) / $amount) ?></span>
                </li>
                <li>
                    <a href="?page=
				<?php
                    if(isset($_GET['page'])){
                        if(($_GET['page'] * $amount) < $i){
                            echo $_GET['page'] +1;
                        }else{
                            echo $_GET['page'];
                        }
                    }else{
                        if($amount < $i){
                            echo '2';
                        }else{
                            echo '1';
                        }
                    }
                    ?>
				&type=<?= $_GET['type'] ?>" aria-label="Next">
                        <span aria-hidden="true">&raquo;</span>
                    </a>
                </li>
            </ul>
        </nav>
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