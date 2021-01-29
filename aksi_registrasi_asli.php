<?php  
include "config/koneksi.php";
$pass=md5($_POST["password"]);
$query=mysqli_query($koneksi,"INSERT INTO user(username,
                                               password,
				 							   nama, 
				 							   alamat, 
				 							   tlp, 
				 							   email, 
				 							   level,
				 							   aktif) 
		   								VALUES('$_POST[username]',
		   									   '$pass',
											   '$_POST[nama]',
											   '$_POST[alamat]',
											   '$_POST[tlp]',
											   '$_POST[email]',
											   'user',
											   'T')") or die (mysqli_error($koneksi));
if($query){
	?>
		<script type="text/javascript">
			window.alert("Registrasi berhasil");
			window.location="index.php";
		</script>
	<?php 
}else{
	?>
		<script type="text/javascript">
			window.alert("Registrasi gagal");
			window.location="index.php";
		</script>
	<?php 
}
?>