<?php  
include "config/koneksi.php";
$pass=md5($_POST["password"]);
$email=$_POST['email'];
$ceknama=mysqli_query($koneksi,"SELECT * FROM user Where email='$email'");
// $return=mysqli_fetch_assocc($koneksi,"SELECT * FROM user Where username='$username'");
$return=mysqli_num_rows($ceknama);
if ($return>0) {
	echo "
	<script type='text/javascript'>
			window.alert('Email sudah terdaftar');
			window.location='register.php';
		</script>
	";
	return false;

}
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
											   'T')") ;
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