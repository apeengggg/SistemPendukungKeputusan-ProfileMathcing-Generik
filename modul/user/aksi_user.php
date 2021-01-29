<?php
error_reporting(0);
session_start();
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
		$email = $_POST['email'];
		$username = $_POST['username'];
		$cekemail = mysqli_query($koneksi, "SELECT * FROM user WHERE email='$email'");
		// cek aakah query di atas menghasilkan email yang sama / > 1
		if (mysqli_num_rows($cekemail)>0) {
		?>
					<script type="text/javascript">
						window.alert("Email Sudah Terdaftar, Gagal Mengupdate User");
						window.location="../../dashboard.php?module=home";
					</script>
		<?php
		}else{ 
	 	if(empty($_POST["password"])){
		if($_FILES['file']['size']==0)
		{
			$query=mysqli_query($koneksi,"UPDATE user SET nama  	= '$_POST[nama]',
		  										          alamat  	= '$_POST[alamat]',
		  										          tlp  		= '$_POST[tlp]',
		  										          email  	= '$_POST[email]'
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
		  										          		  email  	= '$_POST[email]',
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
		  										          		  email  	= '$_POST[email]',
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
		  										      email  	= '$_POST[email]',
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
		//header('location:../../dashboard.php?module='.$module);
		
	}
}
}
?>
