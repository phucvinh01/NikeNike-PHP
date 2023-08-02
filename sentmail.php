<?php 
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require 'ventor/PHPMailer-master/src/Exception.php';
require 'ventor/PHPMailer-master/src/PHPMailer.php';
require 'ventor/PHPMailer-master/src/SMTP.php';

$mail = new PHPMailer;
//$mail->SMTPDebug = 3;                               // Enable verbose debug output

$mail->isSMTP();                                      // Set mailer to use SMTP
$mail->Host = 'smtp.elasticemail.com';  // Specify main and backup SMTP servers
$mail->SMTPAuth = true;                               // Enable SMTP authentication
$mail->Username = 'nguyenphucvinh1920@gmail.com';                 // SMTP username
$mail->Password = '85F6B83ADBCBEB83397D94DC3830DD052240';                           // SMTP password
$mail->Port = 2525;                                    // TCP port to connect to

$mail->From = 'vn150746@gmail.com';
$mail->FromName = 'Test phpmailer';
$mail->addAddress('lamsaotoinho@gmail.com');               // Name is optional

$mail->isHTML(true);                                  // Set email format to HTML

$mail->Subject = 'BT 23 - 05 - 2023';
$mail->Body    = 'Nguyễn Phúc Vinh - 2001200636';
$mail->AltBody = 'Nguyễn Phúc Vinh - 2001200636';
if(!$mail->send()) {
    echo 'Message could not be sent.';
    echo 'Mailer Error: ' . $mail->ErrorInfo;
} else {
    echo 'Message has been sent to lamsaotoinho@gmail.com';
   
}

//267922