<?php
// Security Check
include_once($_SERVER['DOCUMENT_ROOT'] .'/ACP/SecurityCheck.php');

include_once $_SERVER['DOCUMENT_ROOT'] . "Models/News.php";
include_once $_SERVER['DOCUMENT_ROOT'] . "Repositories/NewsRepository.php";

use Models\News;
use Repositories\NewsRepository;

$newsRepository = new NewsRepository();

//TODO: Convert the logic to get data form form!
for ($a = 0; $a < 4; $a++) {
    $news = new News();
    switch ($a) {
        Case 1:
            $news->category = "lifestyle";
            $cat="Lifestyle";
            break;
        Case 2:
            $news->category = "business";
            $cat="Business";
            break;
        Case 3:
            $news->category = "tech";
            $cat="Tech";
            break;
        default:
            $news->category = "hongkong";
            $cat="Hong Kong";
    }
    for ($i = 0; $i < 10; $i++) {

        $news->title = "$cat . New $i";
        $news->author = "Author $i";
        $news->text = " $cat Text $i";

        $news->new_date = "2016-$i-$a $i:$a:$i";
        $newsRepository->save($news);
    }
}
echo "Done!";
header("Location: /ACP/News/");