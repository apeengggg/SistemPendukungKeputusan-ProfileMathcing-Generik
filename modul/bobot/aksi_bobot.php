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

	// Hapus bobot
	if ($module=='bobot' AND $act=='hapus'){
		$hapus =mysqli_query($koneksi,"DELETE FROM bobot WHERE id_bobot='$_GET[id]'");
	 if ($hapus) {
			?>
	  		<script type="text/javascript">
					window.alert("Data berhasil dihapus");
					window.location="../../dashboard.php?module=bobot";
			</script>
	  		<?php
	  		}else{
	  		?>
	  		<script type="text/javascript">
					window.alert("Data gagal dihapus");
					window.location="../../dashboard.php?module=bobot";
		</script>
	  	<?php
	}
			  
}

	// tambah bobot
	elseif ($module=='bobot' AND $act=='simpan'){
		$tgl=date("Y/m/d");
		   $query=mysqli_query($koneksi,"INSERT INTO bobot(selisih,
									 				 bobot, 
									 				 keterangan,
									 				 id_spk,
									 				 id_user) 
							   				   VALUES('$_POST[selisih]',
													  '$_POST[bobot]', 
													  '$_POST[keterangan]',
													  '$_POST[id_spk]',
													  '$_SESSION[id_user]')") or die (mysqli_error($koneksi));

		 if($query){
					?>
						<script type="text/javascript">
							window.alert("Data berhasil ditambah");
							window.location="../../dashboard.php?module=bobot";
						</script>
					<?php 
					}else{
						?>
							<script type="text/javascript">
								window.alert("Data gagal ditambah");
								window.location="../../dashboard.php?module=bobot";
							</script>
						<?php 
					}
			// header('location:../../dashboard.php?module='.$module);
	}

	// edit bobot
	elseif ($module=='bobot' AND $act=='update'){
		  $query=mysqli_query($koneksi,"UPDATE bobot SET selisih = '$_POST[selisih]', 
		  										  bobot 		= '$_POST[bobot]',  
		  										  keterangan 	= '$_POST[keterangan]', 
		  										  id_spk 		= '$_POST[id_spk]'
							   				WHERE id_bobot   	= '$_POST[id_bobot]'")or die (mysqli_error($koneksi));

		 if($query){
					?>
						<script type="text/javascript">
							window.alert("Data berhasil diubah");
							window.location="../../dashboard.php?module=bobot";
						</script>
					<?php 
					}else{
						?>
							<script type="text/javascript">
								window.alert("Data gagal diubah");
								window.location="../../dashboard.php?module=bobot";
							</script>
						<?php 
					}
		// header('location:../../dashboard.php?module='.$module);
		
	}
}
?>
