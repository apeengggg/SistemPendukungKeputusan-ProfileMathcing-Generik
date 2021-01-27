<?php
session_start();
error_reporting(0);
if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){
	  echo "<link href='style.css' rel='stylesheet' type='text/css'>
	 <center>Untuk mengakses modul, Anda harus login <br>";
	  echo "<a href=../../index.php><b>LOGIN</b></a></center>";
}
else{
	include "../../config/koneksi.php";

	$module=$_GET['module'];
	$act=$_GET['act'];

	// hapus alternatif
	if ($module=='alternatif' AND $act=='hapus'){
		$hapus = mysqli_query($koneksi,"DELETE FROM alternatif WHERE id_alternatif='$_GET[id]'");
	  	if ($hapus) {
	  	?>
	  	<script type="text/javascript">
					window.alert("Data berhasil dihapus");
					window.location="../../dashboard.php?module=alternatif";
		</script>
	  	<?php
	  	}else{
	  		?>
	  	<script type="text/javascript">
					window.alert("Data gagal dihapus");
					window.location="../../dashboard.php?module=alternatif";
		</script>
	  	<?php
}
	}
	// tambah alternatif
	elseif ($module=='alternatif' AND $act=='simpan'){
		//$tgl=date("Y/m/d");
			$query=mysqli_query($koneksi,"INSERT INTO alternatif(nama_alternatif,
									 				 id_spk,
									 				 id_user) 
							   				  VALUES('$_POST[nama_alternatif]',
													'$_POST[id_spk]',
													'$_SESSION[id_user]')") or die (mysqli_error($koneksi));

			if($query){
			?>
				<script type="text/javascript">
					window.alert("Data berhasil ditambah");
					window.location="../../dashboard.php?module=alternatif";
				</script>
			<?php 
			}else{
				?>
					<script type="text/javascript">
						window.alert("Data gagal ditambah");
						window.location="../../dashboard.php?module=alternatif";
					</script>
				<?php 
			}
			//header('location:../../dashboard.php?module='.$module);
	}

	// edit alternatif
	elseif ($module=='alternatif' AND $act=='update'){
		  $query=mysqli_query($koneksi,"UPDATE alternatif SET nama_alternatif 	= '$_POST[nama_alternatif]', 
		  												 	  id_spk 			='$_POST[id_spk]' 
							   						  WHERE  id_alternatif    	= '$_POST[id_alternatif]'")or die (mysqli_error($koneksi));
		  if($query){
			?>
				<script type="text/javascript">
					window.alert("Data berhasil diubah");
					window.location="../../dashboard.php?module=alternatif";
				</script>
			<?php 
			}else{
				?>
					<script type="text/javascript">
						window.alert("Data gagal diubah");
						window.location="../../dashboard.php?module=alternatif";
					</script>
				<?php 
			}
		//header('location:../../dashboard.php?module='.$module);
		
	}
}
?>
