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
		$hapus =mysqli_query($koneksi,"DELETE spk, aspek, faktor, bobot, hasil, nilai, spk_user, alternatif FROM spk 
										INNER JOIN aspek ON aspek.id_spk=spk.id_spk 
										INNER JOIN faktor ON faktor.aspek=aspek.id_aspek 
										INNER JOIN bobot ON bobot.id_spk=spk.id_spk 
										INNER JOIN spk_user ON spk_user.id_spk=spk.id_spk 
										INNER JOIN hasil ON hasil.id_spkuser=spk_user.id_spkuser 
										INNER JOIN nilai ON nilai.id_spkuser=spk_user.id_spkuser 
										INNER JOIN alternatif ON alternatif.id_spkuser=spk_user.id_spkuser 
										WHERE spk.id_spk='$_GET[id]'");

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
		if (isset($_GET["id"])) {
		$id = $_GET["id"];
		$nama_spk 		= $_POST["nama_spk"];
		$keterangan 	= $_POST["keterangan"];
		$jenis			= $_POST["jenis"];
		$tgl 			= date("Y-m-d");
		if ($jenis == 0) {
			$status = "0";
		}else{
			$status = "1";
		}
		$query = mysqli_query($koneksi, "INSERT INTO spk (nama_spk, 
														  keterangan, 
														  tanggal,
														  jenis,
														  status_verif, 
														  id_user)
													VALUES('$nama_spk',
														  '$keterangan', 
														  '$tgl', 
														  '$jenis',
														  '$status',
														  '$_SESSION[id_user]')") or die(mysqli_error($koneksi));
		$id_spk = mysqli_insert_id($koneksi);
		if($query){
			?>
				<script type="text/javascript">
					window.alert("Data berhasil ditambah");
					window.location="../../dashboard.php?module=aspek&id=<?=$id_spk?>&jenis=spkbaru";
				</script>
			<?php 
		}else{
			?>
				<script type="text/javascript">
					window.alert("Data gagal ditambah");
					window.location="../../dashboard.php?module=spk&act=tambah_op&id=<?=$id?>";
				</script>
			<?php 
		}
		}else{
		$nama_spk 		= $_POST["nama_spk"];
		$keterangan 	= $_POST["keterangan"];
		$tgl 			= date("Y-m-d");
		$jenis			= "0";
		$status			= "1";
		$query = mysqli_query($koneksi, "INSERT INTO spk (nama_spk, 
														  keterangan, 
														  tanggal,
														  jenis,
														  status_verif,
														  id_user)
													VALUES('$nama_spk',
														  '$keterangan', 
														  '$tgl', 
														  '$jenis',
														  '$status',
														  '$_SESSION[id_user]')") or die(mysqli_error($koneksi));
		$id_spk = mysqli_insert_id($koneksi);
		if($query){
			?>
				<script type="text/javascript">
					window.alert("Data berhasil ditambah");
					window.location="../../dashboard.php?module=aspek&id=<?=$id_spk?>&jenis=spkbaru";
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
	}
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
		}

		// edit spk
	elseif ($module=='spk' AND $act=='active'){
			$query = mysqli_query($koneksi, "UPDATE spk SET status_verif='$_GET[status]'
													WHERE id_spk='$_GET[id]'") or die(mysqli_error($koneksi));
		if($query){
			?>
				<script type="text/javascript">
					window.alert("Status Verifikasi SPK Berhasil Diubah");
					window.location="../../dashboard.php?module=spk&act=verif_spk";
				</script>
			<?php 
		}else{
			?>
				<script type="text/javascript">
					window.alert("Status Verifikasi Gagal Diubah");
					window.location="../../dashboard.php?module=spk&act=verif_spk";
				</script>
			<?php 
		}
	}
}
?>
