<?php
//Logic related to Database!
include_once $_SERVER['DOCUMENT_ROOT'] ."/Models/News.php";
include_once $_SERVER['DOCUMENT_ROOT'] ."/Repositories/NewsRepository.php";

use Models\News;
use Repositories\NewsRepository;
use Repositories\ComRepository;
use Repositories\CatRepository;
$newsRepository = new NewsRepository();
$comRepository=new ComRepository();
$catRepository=new CatRepository();
$result = $newsRepository->findAll();
$hk_result=$catRepository->find('hongkong');
$bs_result=$catRepository->find('business');
$th_result=$catRepository->find('tech');
$life_result=$catRepository->find('lifestyle');

include_once "AdminOnly.php";

?>
<ul class="nav nav-tabs">
    <li class="active"><a href="#home" data-toggle="tab">Home</a></li>
    <li><a data-toggle="tab" href="#menu1">HONG KONG</a></li>
    <li><a data-toggle="tab" href="#menu2">BUSINESS</a></li>
    <li><a data-toggle="tab" href="#menu3">TECH</a></li>
    <li><a data-toggle="tab" href="#menu4">LIFESTYLE</a></li>
</ul>

<div class="tab-content">
    <div id="home" class="tab-pane fade in active">
        <h4>HOME</h4>
        <p>
            <div class="panel panel-default">
                <!-- Default panel contents -->
                <div class="panel-heading">News List</div>
                <div class="panel-body">
        <p>Here is all Newsl</p>
        <div class="admintext">Hi !! You are using Admin!</div>

    </div>

    <!-- Table -->
    <table class="table" >
        <?php
        foreach ($result as $news) {

            ?>
            <tr>
                <td><a href="ShowNews.php?id=<?= $news->id ?>"><?= $news->title ?></a><br/> <?= $news->text ?></td>
                <td><?=$news->new_date?></td>
                <td class="tddel"><a href="DeleteNews.php?id=<?= $news->id ?>">Delete</a></td>

            </tr>
            <?php
        }
        ?>
    </table>


</div>
</p>
</div>
<div id="menu1" class="tab-pane fade">
    <h4>Hong Kong</h4>
    <p>Content of Hong Kong Post</p>
    <div class="admintext">Hi !! You are using Admin!</div>


    <table class="table" >
        <?php
        foreach ($hk_result as $news) {

            ?>
            <tr>
                <td><a href="ShowNews.php?id=<?= $news->id ?>"><?= $news->title ?></a><br/> <?= $news->text ?></td>
                <td><?=$news->new_date?></td>
                <td class="tddel"><a href="DeleteNews.php?id=<?= $news->id ?>">Delete</a></td>


            </tr>
            <?php
        }
        ?>
    </table>

</div>
<div id="menu2" class="tab-pane fade">
    <h4>Business</h4>
    <p>Content of Business Post</p>
    <div class="admintext">Hi !! You are using Admin!</div>

    <table class="table" >
        <?php
        foreach ($bs_result as $news) {

            ?>
            <tr>
                <td><a href="ShowNews.php?id=<?= $news->id ?>"><?= $news->title ?></a><br/> <?= $news->text ?></td>
                <td><?=$news->new_date?></td>
                <td class="tddel"><a href="DeleteNews.php?id=<?= $news->id ?>">Delete</a></td>


            </tr>
            <?php
        }
        ?>
    </table>

</div>
<div id="menu3" class="tab-pane fade">
    <h4>Tech</h4>
    <p>Content of Tech Post</p>
    <div class="admintext">Hi !! You are using Admin!</div>

    <table class="table" >
        <?php
        foreach ($th_result as $news) {

            ?>
            <tr>
                <td><a href="ShowNews.php?id=<?= $news->id ?>"><?= $news->title ?></a><br/> <?= $news->text ?></td>
                <td><?=$news->new_date?></td>
                <td class="tddel"><a href="DeleteNews.php?id=<?= $news->id ?>">Delete</a></td>


            </tr>
            <?php
        }
        ?>
    </table>

</div>
<div id="menu4" class="tab-pane fade">
    <h4>Lifestyle</h4>
    <p>Content of Lifestyle Post.</p>
    <div class="admintext">Hi !! You are using Admin!</div>

    <table class="table" >
        <?php
        foreach ($life_result as $news) {

            ?>
            <tr>
                <td><a href="ShowNews.php?id=<?= $news->id ?>"><?= $news->title ?></a><br/> <?= $news->text ?></td>
                <td><?=$news->new_date?></td>
                <td class="tddel"><a href="DeleteNews.php?id=<?= $news->id ?>">Delete</a></td>


            </tr>
            <?php
        }
        ?>
    </table>

</div>
</div>

