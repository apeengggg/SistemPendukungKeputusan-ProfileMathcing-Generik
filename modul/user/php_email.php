<?php

include "aksi_user.php";
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
// require '../vendor/autoload.php';
require '../../PHPMailer/src/SMTP.php';
require '../../PHPMailer/src/Exception.php';
require '../../PHPMailer/src/OAuth.php';
require '../../PHPMailer/src/PHPMailer.php';
require '../../PHPMailer/src/POP3.php';
//Create a new PHPMailer instance
$mail = new PHPMailer();

//Tell PHPMailer to use SMTP
$mail->isSMTP();

//Enable SMTP debugging
// SMTP::DEBUG_OFF = off (for production use)
// SMTP::DEBUG_CLIENT = client messages
// SMTP::DEBUG_SERVER = client and server messages
$mail->SMTPDebug = SMTP::DEBUG_SERVER;

//Set the hostname of the mail server
$mail->Host = 'smtp.gmail.com';
// use
// $mail->Host = gethostbyname('smtp.gmail.com');
// if your network does not support SMTP over IPv6

//Set the SMTP port number - 587 for authenticated TLS, a.k.a. RFC4409 SMTP submission
$mail->Port = 587;

//Set the encryption mechanism to use - STARTTLS or SMTPS
$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;

//Whether to use SMTP authentication
$mail->SMTPAuth = true;

//Username to use for SMTP authentication - use full email address for gmail
$mail->Username = 'suhardiman645@gmail.com';

//Password to use for SMTP authentication
$mail->Password = 'hardyman645';

//Set who the message is to be sent from
$mail->setFrom('suhardiman645@gmail.com', 'Admin Aplikasi SPK PM Generik');

//Set an alternative reply-to address
// $mail->addReplyTo('mohirfanmanaf0804@gmail.com', 'Admin Aplikasi SPK PM Generik');

//Set who the message is to be sent to
$mail->addAddress($e, $nama);

//Set the subject line
$mail->Subject = 'Link Verifikasi Perubahan Email';

//Read an HTML message body from an external file, convert referenced images to embedded,
//convert HTML into a basic plain-text alternative body
// $mail->msgHTML(file_get_contents('contents.html'), __DIR__);

$body = "Hi, ".$nama."<br> Klik Link Berikut Untuk Memverifikasi Perubahan Email Anda : <br> http://localhost/spkpmgenerik/confirm_email.php?code=.$hash_email.&id=.$id.";
$mail->Body = $body;
//Replace the plain text body with one created manually
$mail->AltBody = 'Link Verifikasi Perubahan Email Untuk :'.$email;

//Attach an image file
// $mail->addAttachment('images/phpmailer_mini.png');

//send the message, check for errors
if (!$mail->send()) {
    echo 'Mailer Error: ' . $mail->ErrorInfo;
} else {
    echo 'Message sent!';
    //Section 2: IMAP
    //Uncomment these to save your message in the 'Sent Mail' folder.
    #if (save_mail($mail)) {
    #    echo "Message saved!";
    #}
}

?>