<?php
//Set up page title!
$title = "Show Students";

//If you need header include other javascript or CSS
function headerExtra()
{
    ?>
    <script src="//ajax.googleapis.com/ajax/libs/angularjs/1.4.5/angular.js"></script>

    <?php
}

include_once "Header.php";

//Logic related to Database!
include_once $_SERVER['DOCUMENT_ROOT'] ."/Models/Student.php";
include_once $_SERVER['DOCUMENT_ROOT'] ."/Repositories/StudentRepository.php";

use Models\Student;
use Repositories\StudentRepository;

$studentRepository = new StudentRepository();
$result = $studentRepository->findAll();
?>
<h2>Dynamic Tabs</h2>
<ul class="nav nav-tabs">
    <li class="active"><a href="#home" data-toggle="tab">Home</a></li>
    <li><a data-toggle="tab" href="#menu1">Menu 1</a></li>
</ul>

<div class="tab-content">
    <div id="home" class="tab-pane fade in active">
        <h4>HOME</h4>
        <p>
            <div class="panel panel-default">
                <!-- Default panel contents -->
                <div class="panel-heading">Student List</div>
                <div class="panel-body">
        <p>Here is all students</p>
    </div>

    <!-- Table -->
    <table class="table">
        <?php
        foreach ($result as $student) {
            ?>
            <tr>
                <td><?= $student->id ?></td>
                <td><a href="ShowStudent.php?id=<?= $student->id ?>"><?= $student->name ?></a></td>
                <td><?= $student->email ?></td>
                <td><a href="DeleteStudent.php?id=<?= $student->id ?>">Delete</a></td>
            </tr>
            <?php
        }
        ?>
    </table>
</div>
</p>
</div>
<div id="menu1" class="tab-pane fade">
    <h4>Menu 1</h4>
    <p>Content of menu 1.</p>
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

include_once "Footer.php";
?>

