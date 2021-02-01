<?php  
include "config/koneksi.php";
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
// require '../vendor/autoload.php';
require 'PHPMailer/src/SMTP.php';
require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/OAuth.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/POP3.php';

$pwd1 = $_POST["password"];
$pwd2 = $_POST["password_u"]; 
$pass=md5($_POST["password"]);
$email = $_POST["email"];
$date = date('Y-m-d');
$code = md5($email.$date);
$nama = $_POST["nama"];
$uname = $_POST["username"];
if ($pwd1 != $pwd2) {
	?>
	<script type="text/javascript">
			window.alert("Kolom Password dan Kolom Ulangi Password Tidak Sama!!");
			window.location="registrasi.php";
		</script>
<?php
}else{
// cek email sudah terdaftar ?
$sql = "SELECT * FROM user WHERE email='$email'";
$sql2 = "SELECT * FROM user WHERE username='$uname'";
$query1 =  mysqli_query($koneksi, $sql);
$query2 =  mysqli_query($koneksi, $sql2);
if (mysqli_num_rows($query2)>0) {
	?>
	<script type="text/javascript">
			window.alert("Username Sudah Terdaftar!");
			window.location="registrasi.php";
		</script>
<?php
}else{
if (mysqli_num_rows($query1)>0) {
	?>
	<script type="text/javascript">
			window.alert("Email Sudah Terdaftar!");
			window.location="registrasi.php";
		</script>
<?php
	}else{
		$query=mysqli_query($koneksi,"INSERT INTO user(username,password, nama, email, level, aktif, verif_code) 
								VALUES('$_POST[username]', '$pass', '$_POST[nama]', '$_POST[email]', 'user','T', '$code')") or die (mysqli_error($koneksi));

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
$mail->Username = 'suhardiman645@gmail.com';

//Password to use for SMTP authentication
$mail->Password = 'hardyman645';

//Set who the message is to be sent from
$mail->setFrom('suhardiman645@gmail.com', 'Admin Aplikasi SPK PM Generik');

//Set an alternative reply-to address
// $mail->addReplyTo('mohirfanmanaf0804@gmail.com', 'Admin Aplikasi SPK PM Generik');

//Set who the message is to be sent to
$mail->addAddress($email, $nama);

//Set the subject line
$mail->Subject = 'Link Verifikasi Pendaftaran Akun';

//Read an HTML message body from an external file, convert referenced images to embedded,
//convert HTML into a basic plain-text alternative body
// $mail->msgHTML(file_get_contents('contents.html'), __DIR__);

$body = "Hi, ".$nama."<br> Klik Link Berikut Untuk Memverifikasi Pendaftaran Akun Anda : <br> http://localhost/spkpmgenerik/confirm.php?code=".$code;
$mail->Body = $body;
//Replace the plain text body with one created manually
$mail->AltBody = 'Link Verifikasi Pendaftaran Akun $_POST[email]';

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



// if($query){
// 	?>
// 		<script type="text/javascript">
// 			window.alert("Registrasi berhasil");
// 			window.location="index.php";
// 		</script>
// 	<?php 
// }else{
// 	?>
// 		<script type="text/javascript">
// 			window.alert("Registrasi gagal");
// 			window.location="index.php";
// 		</script>
// 	<?php 
// }
}
}
}
?>