<?php

//Load Composer's autoloader
require 'PHPMailer/class.phpmailer.php';

$mail = new PHPMailer(); // create a new object
$mail->isSMTP();
$mail->SMTPDebug = 2;
$mail->Host = "smtp.gmail.com";
$mail->SMTPAuth = true;

// But you can comment from here
$mail->SMTPSecure = "tls";
$mail->Port = 587;
$mail->CharSet = "UTF-8";
// To here. 'cause default secure is TLS.

$mail->setFrom("firdausrizki17@gmail.com", "Ololoev");
$mail->Username = "firdausrizki17@gmail.com";
$mail->Password = "S4ilorman";

$mail->Subject = "Тест";
$mail->msgHTML("Test");
$mail->addAddress("gamemodeon71@gmail.com", "Alex");

if (!$mail->send()) {
$mail->ErrorInfo;
} else {
echo 123;
}