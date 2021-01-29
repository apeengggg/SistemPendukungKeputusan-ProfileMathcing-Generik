<?php
session_start();
if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){
	  echo "<link href='style.css' rel='stylesheet' type='text/css'>
	 <center>Untuk mengakses modul, Anda harus login <br>";
	  echo "<a href=../../index.php><b>LOGIN</b></a></center>";
}
else{
	include "../../config/koneksi.php";
	
	$module=$_GET['module'];
	$act=$_GET['act'];

	// Hapus spk
	if ($module=='spk' AND $act=='hapus'){
		$hapus =mysqli_query($koneksi,"DELETE FROM spk WHERE id_spk='$_GET[id]'");
		if ($hapus) {
			?>
	  		<script type="text/javascript">
					window.alert("Data berhasil dihapus");
					window.location="../../dashboard.php?module=spk";
			</script>
	  		<?php
	  		}else{
	  		?>
	  		<script type="text/javascript">
					window.alert("Data gagal dihapus");
					window.location="../../dashboard.php?module=spk";
		</script>
	  	<?php
	}
			  
}

	// tambah spk
	elseif ($module=='spk' AND $act=='simpan'){
		$nama_spk 		= $_POST["nama_spk"];
		$keterangan 	= $_POST["keterangan"];
		$tgl 			= date("Y-m-d");
		
		$query = mysqli_query($koneksi, "INSERT INTO spk (nama_spk, 
														  keterangan, 
														  tanggal, 
														  id_user)
													VALUES('$nama_spk',
														  '$keterangan', 
														  '$tgl', 
														  '$_SESSION[id_user]')") or die(mysqli_error($koneksi));
		if($query){
			?>
				<script type="text/javascript">
					window.alert("Data berhasil ditambah");
					window.location="../../dashboard.php?module=spk";
				</script>
			<?php 
		}else{
			?>
				<script type="text/javascript">
					window.alert("Data gagal ditambah");
					window.location="../../dashboard.php?module=spk";
				</script>
			<?php 
		}
				
		//header('location:../../dashboard.php?module='.$module);
	}

	// edit spk
	elseif ($module=='spk' AND $act=='update'){
		
			$id_spk=$_POST["id_spk"];
		 	$nama_spk=$_POST["nama_spk"];
		 	$keterangan=$_POST["keterangan"];
			$query = mysqli_query($koneksi, "UPDATE spk SET nama_spk='$nama_spk', 
															keterangan='$keterangan' 
													    WHERE id_spk='$id_spk'") or die(mysqli_error($koneksi));
			if($query){
				?>
					<script type="text/javascript">
						window.alert("Data berhasil diubah");
						window.location="../../dashboard.php?module=spk";
					</script>
				<?php 
			}else{
				?>
					<script type="text/javascript">
						window.alert("Data gagal diubah");
						window.location="../../dashboard.php?module=spk";
					</script>
				<?php 
			}
		
			//header('location:../../dashboard.php?module='.$module);
	}
}
?>
