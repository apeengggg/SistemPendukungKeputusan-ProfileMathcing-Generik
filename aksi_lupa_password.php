<?php
include "./config/koneksi.php";
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    // require '../vendor/autoload.php';
    require 'PHPMailer/src/SMTP.php';
    require 'PHPMailer/src/Exception.php';
    require 'PHPMailer/src/OAuth.php';
    require 'PHPMailer/src/PHPMailer.php';
    require 'PHPMailer/src/POP3.php';
$username=$_POST["username"];
$email=$_POST["email"];
$emailhash = base64_encode($email);
$unamehash = base64_encode($username);

// cek apakah email dan username terhubung dengansatu data yang sama

$cek = mysqli_query($koneksi, "SELECT * FROM user WHERE username='$username' AND email='$email'");
if (mysqli_num_rows($cek)<1) {
    ?>
	<script type="text/javascript">
			window.alert("username dan email tidak terdaftar!!");
			window.location="lupa_password.php";
		</script>
<?php
}else{
    
    /**
 * This example shows settings to use when sending via Google's Gmail servers.
 * This uses traditional id & password authentication - look at the gmail_xoauth.phps
 * example to see how to use XOAUTH2.
 * The IMAP section shows how to save this message to the 'Sent Mail' folder using IMAP commands.
 */

//Import PHPMailer classes into the global namespace


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
$mail->Username = 'mirfanmanaf0804@gmail.com';

//Password to use for SMTP authentication
$mail->Password = 'apenggmail8';

//Set who the message is to be sent from
$mail->setFrom('mirfanmanaf0804@gmail.com', 'Admin Aplikasi SPK PM Generik');

//Set an alternative reply-to address
// $mail->addReplyTo('mohirfanmanaf0804@gmail.com', 'Admin Aplikasi SPK PM Generik');

//Set who the message is to be sent to
$mail->addAddress($email, $username);

//Set the subject line
$mail->Subject = 'Link Verifikasi Perubahan Password';

//Read an HTML message body from an external file, convert referenced images to embedded,
//convert HTML into a basic plain-text alternative body
// $mail->msgHTML(file_get_contents('contents.html'), __DIR__);

$body = "Hi, ".$username."<br> Klik Link Berikut Untuk Mereset Password Anda : <br> http://localhost/spkpmgenerik/reset_password.php?code=".$emailhash."&id=".$unamehash;
$mail->Body = $body;
//Replace the plain text body with one created manually
$mail->AltBody = 'Link Reset Password Untuk'.$username;

//Attach an image file
// $mail->addAttachment('images/phpmailer_mini.png');

//send the message, check for errors
if (!$mail->send()) {
    echo 'Mailer Error: ' . $mail->ErrorInfo;
} else {
    echo 'Message sent!';
    
}
}


?>
