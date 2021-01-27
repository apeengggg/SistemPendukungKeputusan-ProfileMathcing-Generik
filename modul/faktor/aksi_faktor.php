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
		$ceknama=mysqli_query($koneksi,"SELECT * FROM faktor WHERE nama_faktor='$name' AND id_spk=$idspk");
		if (mysqli_num_rows($ceknama)>0) {
			?>
		<script type="text/javascript">
					window.alert("Nama Faktor Sudah Ada, Gagal Menambahkan Faktor!");
					window.location="../../dashboard.php?module=faktor&id=<?=$idaspek?>&id_spk=<?=$idspk?>";
		</script>
			<?php
		}else{
			$query=mysqli_query($koneksi,"INSERT INTO faktor(nama_faktor, 
													  aspek,
									 				  target, 
									 				  jenis, 
									 				  id_spk, 
									 				  id_user) 
							   					VALUES('$_POST[nama_faktor]',
							   						   '$_POST[id_aspek]',
													   '$_POST[target]', 
													   '$_POST[jenis]',
													   '$_POST[id_spk]',
													   '$_SESSION[id_user]')") or die (mysql_error());

				if($query){
				?>
					<script type="text/javascript">
						window.alert("Data berhasil ditambah");
						window.location="../../dashboard.php?module=faktor&id=<?=$idaspek?>&id_spk=<?=$idspk?>";
					</script>
				<?php 
				}else{
					?>
						<script type="text/javascript">
							window.alert("Data gagal ditambah");
							window.location="../../dashboard.php?module=faktor&id=<?=$idaspek?>&id_spk=<?=$idspk?>";
						</script>
					<?php 
				}
			// header('location:../../dashboard.php?module='.$module);
	}
}

	// edit faktor
	elseif ($module=='faktor' AND $act=='update'){
			$idaspek = $_POST['id_aspek'];
			$name=$_POST['nama_faktor'];
			$idspk=$_POST['id_spk'];
			$aspek_lama = mysqli_query($koneksi, "SELECT nama_faktor FROM faktor WHERE id_spk='$idspk'");
			$res_aspek = mysqli_fetch_array($aspek_lama);
			$aspek_l = $res_aspek['nama_faktor'];
			if ($name != $aspek_l) {
			$ceknama=mysqli_query($koneksi,"SELECT * FROM faktor WHERE nama_faktor='$name' AND id_spk=$idspk");
			if (mysqli_num_rows($ceknama)>0) {
			?>
				<script type="text/javascript">
					window.alert("Nama Faktor Sudah Ada, Gagal Menambahkan Faktor!");
					window.location="../../dashboard.php?module=faktor&id=<?=$idaspek?>&id_spk=<?=$idspk?>";
				</script>
			<?php
			}else{
		  $query=mysqli_query($koneksi,"UPDATE faktor SET nama_faktor 		= '$_POST[nama_faktor]', 
		  										   aspek 			= '$_POST[id_aspek]', 
		  										   target 			= '$_POST[target]', 
		  										   jenis			= '$_POST[jenis]',
		  										   id_spk 			= '$_POST[id_spk]'
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
	$query=mysqli_query($koneksi,"UPDATE faktor SET aspek 			= '$_POST[id_aspek]', 
		  										   target 			= '$_POST[target]', 
		  										   jenis			= '$_POST[jenis]',
		  										   id_spk 			= '$_POST[id_spk]'
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
}
}
?>
