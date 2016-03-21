<?php
require_once($_SERVER['DOCUMENT_ROOT'] .'/Repositories/PHPMailer/PHPMailerAutoload.php');

$mail = new PHPMailer;

//$mail->SMTPDebug = 3;                               // Enable verbose debug output

$mail->isSMTP();                                      // Set mailer to use SMTP
$mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
$mail->SMTPAuth = true;                               // Enable SMTP authentication
$mail->Username = 'dummykenhasbeenused@gmail.com';                 // SMTP username
$mail->Password = 'Fuckmylife2016';                           // SMTP password
$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
$mail->Port = 587;                                    // TCP port to connect to

$mail->setFrom('dummykenhasbeenused@gmail.com', 'Apps In Development');