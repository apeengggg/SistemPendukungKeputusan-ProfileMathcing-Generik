<?php
error_reporting(0);
session_start();
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){
	  echo "<link href='style.css' rel='stylesheet' type='text/css'>
	 <center>Untuk mengakses modul, Anda harus login <br>";
	  echo "<a href=../../index.php><b>LOGIN</b></a></center>";
}
else{
	
	include "../../config/koneksi.php";
	include "../../config/library.php";
	include "../../config/fungsi_thumb.php";
	$module=$_GET[module];
	$act=$_GET[act];

	// Aktifasi user
	if ($module=='user' AND $act=='aktifasi'){
		 mysqli_query($koneksi,"UPDATE user SET aktif='Y' WHERE username='$_GET[id]'");
	  header('location:../../dashboard.php?module='.$module);
	}

	// Hapus user
	if ($module=='user' AND $act=='hapus'){
		 $hapus =mysqli_query($koneksi,"DELETE FROM user WHERE username='$_GET[id]'");
	  if ($hapus) {
			?>
	  		<script type="text/javascript">
					window.alert("Data berhasil dihapus");
					window.location="../../dashboard.php?module=user";
			</script>
	  		<?php
	  		}else{
	  		?>
	  		<script type="text/javascript">
					window.alert("Data gagal dihapus");
					window.location="../../dashboard.php?module=user";
		</script>
	  	<?php
	}
			  
}

	// tambah user
	elseif ($module=='user' AND $act=='simpan'){
		$ekstensi_diperbolehkan	= array('png','jpg', 'jpeg');
			$foto = $_FILES['file']['name'];
			$email = $_POST['email'];
			$username = $_POST['username'];
		$cekemail = mysqli_query($koneksi, "SELECT * FROM user WHERE email='$email' OR username='$username'");
		// cek aakah query di atas menghasilkan email yang sama / > 1
		if (mysqli_num_rows($cekemail)>0) {
		?>
					<script type="text/javascript">
						window.alert("Email dan atau Username Sudah Terdaftar, Gagal Menambahkan User");
						window.location="../../dashboard.php?module=user";
					</script>
		<?php
		}else{
			$x = explode('.', $foto);
			$ekstensi = strtolower(end($x));
			$ukuran	= $_FILES['file']['size'];
			$file_tmp = $_FILES['file']['tmp_name'];
			if(in_array($ekstensi, $ekstensi_diperbolehkan) === true){
				if($ukuran < 1044070){			
					move_uploaded_file($file_tmp, './../../foto/'.$foto);
					$pass=md5($_POST["password"]);
					$query=mysqli_query($koneksi,"INSERT INTO user(username,
																	password,
									 								nama, 
									 								alamat, 
									 								tlp, 
									 								email, 
									 								level,
									 								foto) 
							   								VALUES('$_POST[username]',
							   										'$pass',
																	'$_POST[nama]',
																	'$_POST[alamat]',
																	'$_POST[tlp]',
																	'$email',
																	'$_POST[level]',
																	'$foto')") or die (mysqli_error($koneksi));
					if($query){
						?>
							<script type="text/javascript">
								window.alert("Data berhasil ditambah");
								window.location="../../dashboard.php?module=user";
							</script>
						<?php 
					}else{
						?>
							<script type="text/javascript">
								window.alert("Data gagal ditambah");
								window.location="../../dashboard.php?module=user";
							</script>
						<?php 
					}
				}else{
					?>
						<script type="text/javascript">
							window.alert("Ukuran Gambar terlalu besar");
							window.location="../../dashboard.php?module=user";
						</script>
					<?php 
				}
			}else{
				?>
					<script type="text/javascript">
						window.alert("Data ekstensi gambar tidak sesuai");
						window.location="../../dashboard.php?module=user";
					</script>
				<?php 
			}
		 	
			//header('location:../../dashboard.php?module='.$module);
	}
}

	// edit user
	elseif ($module=='user' AND $act=='update'){
		$nama = $_POST['nama'];
		$email = $_POST['email'];
		$username = $_POST['username'];
		$id = $_POST['id_user'];
		$data_lama = mysqli_query($koneksi, "SELECT username, email FROM user WHERE id_user='$id'");
		$res = mysqli_fetch_array($data_lama);
		$e = $res['email'];
		// echo $e; die;
		$u = $res['username'];
		$hash_email = md5($e);
		$hash_id = md5($id);
		// echo $username.'='.$u; 
		// echo '<br>';
		// echo $email.'='.$e; die;
		if ($e != $email) {

// require '../vendor/autoload.php';
require 'PHPMailer/src/SMTP.php';
require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/OAuth.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/POP3.php';
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

$body = "Hi, ".$nama."<br> Klik Link Berikut Untuk Memverifikasi Perubahan Email Anda : <br> http://localhost/spkpmgenerik/modul/user/confirm_email.php?code=".$hash_email."&id=".$id;
$mail->Body = $body;
//Replace the plain text body with one created manually
$mail->AltBody = 'Link Verifikasi Perubahan Email Untuk :'.$e;

//Attach an image file
// $mail->addAttachment('images/phpmailer_mini.png');

//send the message, check for errors
if (!$mail->send()) {
    echo 'Mailer Error: ' . $mail->ErrorInfo;
} else {
	echo 'Message sent!';
	// die;
    //Section 2: IMAP
    //Uncomment these to save your message in the 'Sent Mail' folder.
    #if (save_mail($mail)) {
    #    echo "Message saved!";
    #}
}
			// include 'php_email.php';
			?>
			<script type="text/javascript">
				window.alert("Anda Sudah Akan Mengubah Email, Saat Ini Email Anda Belum Diubah, Untuk Mengubahnya Silahkan Cek Email Lama Anda Kami Berikan Perubahan Link Untuk Perubahan Email");
			</script>
		<?php 
			// cek apakah email atau username sudah ada?
			
			$cekemail = mysqli_query($koneksi, "SELECT * FROM user WHERE email='$email' AND id_user='$id'");
			if (mysqli_num_rows($cekemail)>0) {
				?>
							<script type="text/javascript">
								window.alert("Data gagal disimpan, username dan email sudah terdaftar");
								window.location="../../dashboard.php?module=home";
							</script>
						<?php 
						die;
			}else{
				if(empty($_POST["password"])){
					if($_FILES['file']['size']==0)
					{
						$query=mysqli_query($koneksi,"UPDATE user SET nama  	= '$_POST[nama]',
																		alamat  	= '$_POST[alamat]',
																		tlp  		= '$_POST[tlp]',
																		verif_code = '$hash_email'
														  WHERE  username    	= '$_POST[username]'")or die (mysqli_error($koneksi));
								if($query){
									?>
										<script type="text/javascript">
											window.alert("Data berhasil disimpan");
											window.location="../../dashboard.php?module=home";
										</script>
									<?php 
								}else{
									?>
										<script type="text/javascript">
											window.alert("Data gagal disimpan");
											window.location="../../dashboard.php?module=home";
										</script>
									<?php 
								}
					}else{
						$ekstensi_diperbolehkan	= array('png','jpg','jpeg');
						$foto = $_FILES['file']['name'];
						$x = explode('.', $foto);
						$ekstensi = strtolower(end($x));
						$ukuran	= $_FILES['file']['size'];
						$file_tmp = $_FILES['file']['tmp_name'];
						if(in_array($ekstensi, $ekstensi_diperbolehkan) === true){
							if($ukuran < 1044070){			
								move_uploaded_file($file_tmp, './../../foto/'.$foto);
								$query=mysqli_query($koneksi,"UPDATE user SET nama      = '$_POST[nama]',
																				  alamat  	= '$_POST[alamat]',
																				  tlp  		= '$_POST[tlp]',
																				  foto  	= '$foto',
																				  verif_code = '$hash_email' 
														  WHERE  username    = '$_POST[username]'")or die (mysqli_error($koneksi));
								if($query){
									?>
										<script type="text/javascript">
											window.alert("Data berhasil disimpan");
											window.location="../../dashboard.php?module=home";
										</script>
									<?php 
								}else{
									?>
										<script type="text/javascript">
											window.alert("Data gagal disimpan");
											window.location="../../dashboard.php?module=home";
										</script>
									<?php 
								}
							}else{
								?>
									<script type="text/javascript">
										window.alert("Ukuran Gambar terlalu besar");
										window.location="../../dashboard.php?module=home";
									</script>
								<?php 
							}
						}else{
							?>
								<script type="text/javascript">
									window.alert("Data ekstensi gambar tidak sesuai");
									window.location="../../dashboard.php?module=home";
								</script>
							<?php 
						}
					}
					}else{
						$pass=md5($_POST["password"]);
						// mysqli_query($koneksi,"UPDATE admin SET nama  = '$_POST[nama]', password='$pass', level = '$_POST[level]' 
						// 				   WHERE  username    = '$_POST[username]'")or die (mysqli_error($koneksi));
						if($_FILES['file']['size']==0)
						{
							$query=mysqli_query($koneksi,"UPDATE user SET nama  = '$_POST[nama]',
																			  alamat  	= '$_POST[alamat]',
																				  tlp  		= '$_POST[tlp]',
																				password 	= '$pass',
																				  level 	= '$_POST[level]',
																				  verif_code = '$hash_email'
															  WHERE  username    = '$_POST[username]'")or die (mysqli_error($koneksi));
									if($query){
										?>
											<script type="text/javascript">
												window.alert("Data berhasil disimpan");
												window.location="../../dashboard.php?module=home";
											</script>
										<?php 
									}else{
										?>
											<script type="text/javascript">
												window.alert("Data gagal disimpan");
												window.location="../../dashboard.php?module=home";
											</script>
										<?php 
									}
						}else{
							$ekstensi_diperbolehkan	= array('png','jpg','jpeg');
							$foto = $_FILES['file']['name'];
							$x = explode('.', $foto);
							$ekstensi = strtolower(end($x));
							$ukuran	= $_FILES['file']['size'];
							$file_tmp = $_FILES['file']['tmp_name'];
							if(in_array($ekstensi, $ekstensi_diperbolehkan) === true){
								if($ukuran < 1044070){			
									move_uploaded_file($file_tmp, './../../foto/'.$foto);
									$query=mysqli_query($koneksi,"UPDATE user SET nama  = '$_POST[nama]',
																  password 	= '$password',
																  alamat  	= '$_POST[alamat]',
																	tlp  		= '$_POST[tlp]',
																	level 	= '$_POST[level]',
																	foto  	= '$foto',
																	verif_code = '$hash_email'
															  WHERE  username    = '$_POST[username]'")or die (mysqli_error($koneksi));
									if($query){
										?>
											<script type="text/javascript">
												window.alert("Data berhasil disimpan");
												window.location="../../dashboard.php?module=home";
											</script>
										<?php 
									}else{
										?>
											<script type="text/javascript">
												window.alert("Data gagal disimpan");
												window.location="../../dashboard.php?module=home";
											</script>
										<?php 
									}
								}else{
									?>
										<script type="text/javascript">
											window.alert("Ukuran Gambar terlalu besar");
											window.location="../../dashboard.php?module=home";
										</script>
									<?php 
								}
							}else{
								?>
									<script type="text/javascript">
										window.alert("Data ekstensi gambar tidak sesuai");
										window.location="../../dashboard.php?module=home";
									</script>
								<?php 
							}
						}
					}
			}
			// else email
		}else{
			if(empty($_POST["password"])){
				if($_FILES['file']['size']==0)
				{
					$query=mysqli_query($koneksi,"UPDATE user SET nama  	= '$_POST[nama]',
																	alamat  	= '$_POST[alamat]',
																	tlp  		= '$_POST[tlp]'
													  WHERE  username    	= '$_POST[username]'")or die (mysqli_error($koneksi));
							if($query){
								?>
									<script type="text/javascript">
										window.alert("Data berhasil disimpan");
										window.location="../../dashboard.php?module=home";
									</script>
								<?php 
							}else{
								?>
									<script type="text/javascript">
										window.alert("Data gagal disimpan");
										window.location="../../dashboard.php?module=home";
									</script>
								<?php 
							}
				}else{
					$ekstensi_diperbolehkan	= array('png','jpg','jpeg');
					$foto = $_FILES['file']['name'];
					$x = explode('.', $foto);
					$ekstensi = strtolower(end($x));
					$ukuran	= $_FILES['file']['size'];
					$file_tmp = $_FILES['file']['tmp_name'];
					if(in_array($ekstensi, $ekstensi_diperbolehkan) === true){
						if($ukuran < 1044070){			
							move_uploaded_file($file_tmp, './../../foto/'.$foto);
							$query=mysqli_query($koneksi,"UPDATE user SET nama      = '$_POST[nama]',
																			  alamat  	= '$_POST[alamat]',
																			  tlp  		= '$_POST[tlp]',
																			  foto  	= '$foto' 
													  WHERE  username    = '$_POST[username]'")or die (mysqli_error($koneksi));
							if($query){
								?>
									<script type="text/javascript">
										window.alert("Data berhasil disimpan");
										window.location="../../dashboard.php?module=home";
									</script>
								<?php 
							}else{
								?>
									<script type="text/javascript">
										window.alert("Data gagal disimpan");
										window.location="../../dashboard.php?module=home";
									</script>
								<?php 
							}
						}else{
							?>
								<script type="text/javascript">
									window.alert("Ukuran Gambar terlalu besar");
									window.location="../../dashboard.php?module=home";
								</script>
							<?php 
						}
					}else{
						?>
							<script type="text/javascript">
								window.alert("Data ekstensi gambar tidak sesuai");
								window.location="../../dashboard.php?module=home";
							</script>
						<?php 
					}
				}
				}else{
					$pass=md5($_POST["password"]);
					mysqli_query($koneksi,"UPDATE admin SET nama  = '$_POST[nama]', password='$pass', level = '$_POST[level]' 
									   WHERE  username    = '$_POST[username]'")or die (mysqli_error($koneksi));
					if($_FILES['file']['size']==0)
					{
						$query=mysqli_query($koneksi,"UPDATE user SET nama  = '$_POST[nama]',
																		  alamat  	= '$_POST[alamat]',
																			  tlp  		= '$_POST[tlp]',
																			password 	= '$pass',
																			  level 	= '$_POST[level]' 
														  WHERE  username    = '$_POST[username]'")or die (mysqli_error($koneksi));
								if($query){
									?>
										<script type="text/javascript">
											window.alert("Data berhasil disimpan");
											window.location="../../dashboard.php?module=home";
										</script>
									<?php 
								}else{
									?>
										<script type="text/javascript">
											window.alert("Data gagal disimpan");
											window.location="../../dashboard.php?module=home";
										</script>
									<?php 
								}
					}else{
						$ekstensi_diperbolehkan	= array('png','jpg','jpeg');
						$foto = $_FILES['file']['name'];
						$x = explode('.', $foto);
						$ekstensi = strtolower(end($x));
						$ukuran	= $_FILES['file']['size'];
						$file_tmp = $_FILES['file']['tmp_name'];
						if(in_array($ekstensi, $ekstensi_diperbolehkan) === true){
							if($ukuran < 1044070){			
								move_uploaded_file($file_tmp, './../../foto/'.$foto);
								$query=mysqli_query($koneksi,"UPDATE user SET nama  = '$_POST[nama]',
															  password 	= '$password',
															  alamat  	= '$_POST[alamat]',
																tlp  		= '$_POST[tlp]',
																level 	= '$_POST[level]',
																foto  	= '$foto' 
														  WHERE  username    = '$_POST[username]'")or die (mysqli_error($koneksi));
								if($query){
									?>
										<script type="text/javascript">
											window.alert("Data berhasil disimpan");
											window.location="../../dashboard.php?module=home";
										</script>
									<?php 
								}else{
									?>
										<script type="text/javascript">
											window.alert("Data gagal disimpan");
											window.location="../../dashboard.php?module=home";
										</script>
									<?php 
								}
							}else{
								?>
									<script type="text/javascript">
										window.alert("Ukuran Gambar terlalu besar");
										window.location="../../dashboard.php?module=home";
									</script>
								<?php 
							}
						}else{
							?>
								<script type="text/javascript">
									window.alert("Data ekstensi gambar tidak sesuai");
									window.location="../../dashboard.php?module=home";
								</script>
							<?php 
						}
					}
				}
		}
	 	
		//header('location:../../dashboard.php?module='.$module);
		
	}
}
?>
