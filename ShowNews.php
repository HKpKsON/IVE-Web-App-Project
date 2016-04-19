<?php
session_start();
//Set up page title!
$title = "Show News";

//If you need header include other javascript or CSS
function headerExtra()
{
    ?>


    <?php
}

include_once "Header.php";

//Logic related to Database!
include_once $_SERVER['DOCUMENT_ROOT'] ."/Models/News.php";
include_once $_SERVER['DOCUMENT_ROOT'] ."/Repositories/NewsRepository.php";

use Models\News;
use Models\Reviews;
use Repositories\NewsRepository;
use Repositories\ComRepository;

$newsRepository = new NewsRepository();
$news = $newsRepository->find($_GET['id']);

$comRepository = new ComRepository();

$comresult= $comRepository->find($_GET['id']);
include_once "AdminOnly.php";
?>


<div class="panel panel-default">
    <!-- Default panel contents -->
    <div class="panel-heading">The News Text</div>
    <div class="panel-body">
        <p><a href="Index.php" >Home</a></p>
        <div class="admintext">Hi !! You are using Admin!</div>
</div>

<!-- List group -->
<ul class="list-group">
        <li class="list-group-item"><?= $news->title ?></li>
    <li class="list-group-item"><?= $news->new_date ?></li>
        <li class="list-group-item"><?= $news->author ?></li>
        <li class="list-group-item"><?= $news->text ?></li>
    </ul>


    </table>
    <table class="com-table">
        <?php
        foreach ( $comresult as $com) {
            $_SESSION['newid']=$_GET['id'];
                ?>
                <tr>
                    <td>#.<?=$com->com_id?></td>
                    <td>UserName:<?= $com->com_author ?><p><br/><div class="com-text">Comment:<?= $com->com_text ?></div></p>

                        Date:<?= $com->com_date ?>
                        <hr/>
                    </td>
                    <td class="tddel"><a href="DeleteCom.php?com_id=<?= $com->com_id ?>">Delete</a></td>

                </tr>
                <?php

        }

        ?>

        </table>

</div>
    <div class="com-form">
        <form action="AddCom.php?id=<?= $news->id ?>" method="post">
            <?php
            ?>
           <div class="enter-name" >Enter Your Name<br/></div>
            <input class="com-author" type="text" name="com_author"><br/>
            Enter Your Comment <br/>
            <input type="text" name="com_text"><br/>
            <input type="hidden"name="com_id"value='com_id'><br/>
            <input type="Submit" vaule="Send"/>
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

include_once "Footer.php";
?>

