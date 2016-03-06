<?php
include_once $_SERVER['DOCUMENT_ROOT'] ."/Models/Student.php";
include_once $_SERVER['DOCUMENT_ROOT'] ."/Repositories/StudentRepository.php";

use Models\Student;
use Repositories\StudentRepository;

$studentRepository = new StudentRepository();
$student = $studentRepository->destroy($_GET['id']);

header("Location: ListStudents.php");