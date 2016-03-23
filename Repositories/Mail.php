<?php
require_once($_SERVER['DOCUMENT_ROOT'] .'/Repositories/PHPMailer/PHPMailerAutoload.php');

$mail = new PHPMailer;

//$mail->SMTPDebug = 3;									// Enable verbose debug output

$mail->isSMTP();										// Set mailer to use SMTP
$mail->Host = 'smtp.gmail.com';							// Specify main and backup SMTP servers
$mail->SMTPAuth = true;									// Enable SMTP authentication
$mail->Username = 'dummykenhasbeenused@gmail.com';		// SMTP username
$mail->Password = 'Fuckmylife2016';						// SMTP password
$mail->SMTPSecure = 'tls';								// Enable TLS encryption, `ssl` also accepted
$mail->Port = 587;										// TCP port to connect to

$mail->setFrom('dummykenhasbeenused@gmail.com', 'Apps In Development');

/*
// This is How To Send Email
require_once($_SERVER['DOCUMENT_ROOT'] .'/Mail.php');
						
$mail->addAddress(_EMAIL ADDRESS_, _RECEIPIENT NAME_);     // Add a recipient

$mail->isHTML(true);                                  // Set email format to HTML

$mail->Subject = _MAIL SUBJECT LINE_;
$mail->Body = _MAIL HTML CONTENT_;
$mail->AltBody = _MAIL PLAIN TEXT CONTENT_;

if(!$mail->send()) {
	_MAIL SEND FAILED_
}else{
	_MAIL SEND SUCCESSFUL_
}
*/