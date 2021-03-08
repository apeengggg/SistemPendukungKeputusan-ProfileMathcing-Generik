<?php
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
	$module=$_GET['module'];
	$act=$_GET['act'];

	// Hapus faktor
	if ($module=='faktor' AND $act=='hapus'){
		$idaspek = $_GET['id_aspek'];
		$idspk = $_GET['id_spk'];
		$idfaktor = $_GET['id_faktor'];
		$hapus =mysqli_query($koneksi,"DELETE FROM faktor WHERE id_faktor='$_GET[id_faktor]'");
	  if ($hapus) {
			?>
	  		<script type="text/javascript">
					window.alert("Data berhasil dihapus");
					window.location="../../dashboard.php?module=faktor&id=<?=$idaspek?>&id_spk=<?=$idspk?>";
			</script>
	  		<?php
	  		}else{
	  		?>
	  		<script type="text/javascript">
					window.alert("Data gagal dihapus");
					window.location="../../dashboard.php?module=faktor&id=<?=$idaspek?>&id_spk=<?=$idspk?>";
		</script>
	  	<?php
	}
			  
}
	// tambah faktor
	elseif ($module=='faktor' AND $act=='simpan'){
		$idaspek = $_POST['id_aspek'];
		$name=$_POST['nama_faktor'];
		$idspk=$_POST['id_spk'];
		// cek angka bukan
		$cek = is_numeric($_POST['target']);
		if ($cek == true) {
			if ($_POST['target'] > 5 OR $_POST['target'] < 1) {
				if (isset($_GET["jenis"])) {
					echo "<script type='text/javascript'>
					window.alert('Nilai Target Lebih Dari Atau Kurang Dari 5');
					window.location='../../dashboard.php?module=faktor&id=$idaspek&id_spk=$idspk&jenis=baru';
							</script>";
							die;
				}else{
					echo "<script type='text/javascript'>
					window.alert('Nilai Target Lebih Dari Atau Kurang Dari 5');
					window.location='../../dashboard.php?module=faktor&id=$idaspek&id_spk=$idspk';
							</script>";
							die;
				}
			}
			$ceknama=mysqli_query($koneksi,"SELECT * FROM faktor WHERE nama_faktor='$name' AND aspek=$idaspek");
		if (mysqli_num_rows($ceknama)>0) {
				if (isset($_GET["jenis"])) {
					echo "<script type='text/javascript'>
					window.alert('Nama Faktor Sudah Ada, Gagal Menambahkan Faktor!');
					window.location='../../dashboard.php?module=faktor&id=$idaspek&id_spk=$idspk&jenis=baru';
							</script>";
				}else{
					echo "<script type='text/javascript'>
					window.alert('Nama Faktor Sudah Ada, Gagal Menambahkan Faktor!');
					window.location='../../dashboard.php?module=faktor&id=$idaspek&id_spk=$idspk';
							</script>";
				}
			?>
		
			<?php
		}else{
			$query=mysqli_query($koneksi,"INSERT INTO faktor(nama_faktor, 
													  aspek,
									 				  target, 
									 				  jenis) 
							   					VALUES('$_POST[nama_faktor]',
							   						   '$_POST[id_aspek]',
													   '$_POST[target]', 
													   '$_POST[jenis]')") or die (mysqli_error($koneksi));

				if($query){
					if (isset($_GET["jenis"])) {
						echo "<script type='text/javascript'>
						window.alert('Data berhasil ditambah');
						window.location='../../dashboard.php?module=faktor&id=$idaspek&id_spk=$idspk&jenis=baru';
					</script>";
					}else{
						echo "<script type='text/javascript'>
						window.alert('Data berhasil ditambah');
						window.location='../../dashboard.php?module=faktor&id=$idaspek&id_spk=$idspk';
					</script>";
					} 
				}else{
					if (isset($_GET["jenis"])) {
						echo "<script type='text/javascript'>
						window.alert('Data gagal ditambah');
						window.location='../../dashboard.php?module=faktor&id=$idaspek&id_spk=$idspk&jenis=baru';
					</script>";
					}else{
						echo "<script type='text/javascript'>
						window.alert('Data gagal ditambah');
						window.location='../../dashboard.php?module=faktor&id=$idaspek&id_spk=$idspk';
					</script>";
					}
					?>
						
					<?php 
				}
			// header('location:../../dashboard.php?module='.$module);
	}
		}else{
			if (isset($_GET["jenis"])) {
				echo "<script type='text/javascript'>
				window.alert('Nilai Target Bukan Angka!!');
				window.location='../../dashboard.php?module=faktor&id=$idaspek&id_spk=$idspk&jenis=baru';
						</script>";
						die;
			}else{
				echo "<script type='text/javascript'>
				window.alert('Nilai Target Bukan Angka!!');
				window.location='../../dashboard.php?module=faktor&id=$idaspek&id_spk=$idspk';
						</script>";
						die;
			}
		}
		
}

	// edit faktor
	elseif ($module=='faktor' AND $act=='update'){
			$idaspek = $_POST['id_aspek'];
			$name=$_POST['nama_faktor'];
			$idspk=$_POST['id_spk'];
			// var_dump($_POST); die;
			$aspek_lama = mysqli_query($koneksi, "SELECT nama_faktor FROM faktor WHERE aspek='$idaspek' AND id_faktor='$_POST[id_faktor]'");
			$res_aspek = mysqli_fetch_array($aspek_lama);
			$aspek_l = $res_aspek['nama_faktor'];
			// echo $aspek_l; 
			// echo $name; die;
			if ($name != $aspek_l) {
			$ceknama=mysqli_query($koneksi,"SELECT * FROM faktor WHERE nama_faktor='$name' AND aspek='$idaspek'");
			if (mysqli_num_rows($ceknama)>0) {
			?>
				<script type="text/javascript">
					window.alert("Nama Faktor Sudah Ada, Gagal Mengubah Faktor!");
					window.location="../../dashboard.php?module=faktor&id=<?=$idaspek?>&id_spk=<?=$idspk?>";
				</script>
			<?php
			}else{
		  $query=mysqli_query($koneksi,"UPDATE faktor SET 
		  										nama_faktor 		= '$_POST[nama_faktor]', 
		  										aspek 			= '$_POST[id_aspek]', 
		  										target 			= '$_POST[target]', 
		  										jenis			= '$_POST[jenis]'
				                         WHERE  id_faktor    	= '$_POST[id_faktor]'")or die (mysql_error());
		  	if($query){
					?>
						<script type="text/javascript">
							window.alert("Data berhasil diubah");
							window.location="../../dashboard.php?module=faktor&id=<?=$idaspek?>&id_spk=<?=$idspk?>";
						</script>
					<?php 
					}else{
						?>
							<script type="text/javascript">
								window.alert("Data gagal diubah");
								window.location="../../dashboard.php?module=faktor&id=<?=$idaspek?>&id_spk=<?=$idspk?>";
							</script>
						<?php 
					}
		// header('location:../../dashboard.php?module='.$module);
		
	}
}else{
	// $ceknama=mysqli_query($koneksi,"SELECT * FROM faktor WHERE nama_faktor='$name' AND id_spk=$idspk AND aspek='$idaspek'");
	// if (mysqli_num_rows($ceknama)>0) {
	// 	?>
	 			<!-- <script type="text/javascript"> -->
	 				<!-- window.alert("Nama Faktor Sudah Ada, Gagal Mengubah Faktor!"); -->
	 				<!-- window.location="../../dashboard.php?module=faktor&id=<?=$idaspek?>&id_spk=<?=$idspk?>"; -->
				<!-- </script> -->
	 		<?php
	// }else{
	$query=mysqli_query($koneksi,"UPDATE faktor SET aspek 			= '$_POST[id_aspek]', 
		  										   target 			= '$_POST[target]', 
		  										   jenis			= '$_POST[jenis]'
				                            WHERE  id_faktor    	= '$_POST[id_faktor]'")or die (mysqli_error($koneksi));
		  	if($query){
					?>
						<script type="text/javascript">
							window.alert("Data berhasil diubah");
							window.location="../../dashboard.php?module=faktor&id=<?=$idaspek?>&id_spk=<?=$idspk?>";
						</script>
					<?php 
					}else{
						?>
							<script type="text/javascript">
								window.alert("Data gagal diubah");
								window.location="../../dashboard.php?module=faktor&id=<?=$idaspek?>&id_spk=<?=$idspk?>";
							</script>
						<?php 
					}
		// header('location:../../dashboard.php?module='.$module);
}	
}
	}
?>
