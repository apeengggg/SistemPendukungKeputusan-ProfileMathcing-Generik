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
		if ($_SESSION['level']==='user') {
				$id_user = $_GET['id_user'];
		}
		$hapus =mysqli_query($koneksi,"	DELETE spk, aspek, faktor, hasil, nilai, spk_user, alternatif FROM spk 
										LEFT JOIN aspek ON aspek.id_spk=spk.id_spk 
										LEFT JOIN faktor ON faktor.aspek=aspek.id_aspek  
										LEFT JOIN spk_user ON spk_user.id_spk=spk.id_spk 
										LEFT JOIN hasil ON hasil.id_spkuser=spk_user.id_spkuser 
										LEFT JOIN nilai ON nilai.id_spkuser=spk_user.id_spkuser 
										LEFT JOIN alternatif ON alternatif.id_spkuser=spk_user.id_spkuser 
										WHERE spk.id_spk='$_GET[id]'");
		if ($_SESSION['level']==='user') {
			if ($hapus) {
			?>
	  		<script type="text/javascript">
					window.alert("Data berhasil dihapus");
					window.location="../../dashboard.php?module=spk&act=operator&id_user=<?=$id_user?>";
			</script>
	  		<?php
	  		}else{
	  		?>
	  		<script type="text/javascript">
					window.alert("Data gagal dihapus");
					window.location="../../dashboard.php?module=spk&act=operator&id_user=<?=$id_user?>";
		</script>
	  	<?php
	}
		}else{
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
}

	// tambah spk
	elseif ($module=='spk' AND $act=='simpan'){
		if (isset($_GET["id"])) {
		$id = $_GET["id"];
		$nama_spk 		= $_POST["nama_spk"];
		$keterangan 	= $_POST["keterangan"];
		// $jenis			= $_POST["jenis"];
		$status			= '-';
		$tgl 			= date("Y-m-d");
		$query = mysqli_query($koneksi, "INSERT INTO spk (nama_spk, 
														  keterangan,
														  status_verif,
														  id_user)
													VALUES('$nama_spk',
														  '$keterangan',
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
														  jenis,
														  status_verif,
														  id_user)
													VALUES('$nama_spk',
														  '$keterangan', 
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
			$id_user = $_POST['id_user'];
			$id_spk=$_POST["id_spk"];
		 	$nama_spk=$_POST["nama_spk"];
		 	$keterangan=$_POST["keterangan"];
			$query = mysqli_query($koneksi, "UPDATE spk SET nama_spk='$nama_spk', 
															keterangan='$keterangan' 
													    WHERE id_spk='$id_spk'") or die(mysqli_error($koneksi));
			if ($_SESSION['level']==='user') {
			if ($query) {
			?>
	  		<script type="text/javascript">
					window.alert("Data berhasil diubah");
					window.location="../../dashboard.php?module=spk&act=operator&id_user=<?=$id_user?>";
			</script>
	  		<?php
	  		}else{
	  		?>
	  		<script type="text/javascript">
					window.alert("Data gagal diubah");
					window.location="../../dashboard.php?module=spk&act=operator&id_user=<?=$id_user?>";
		</script>
	  	<?php
	}
		}else{
			if ($query) {
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
		// edit spk
		elseif ($module=='spk' AND $act=='deactive'){
			$query = mysqli_query($koneksi, "UPDATE spk SET status_verif='$_GET[status]', jenis=1
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

		// edit spk
		elseif ($module=='spk' AND $act=='publish'){
			$id = $_GET['id_user'];
			$id_spk = $_GET['id'];
			$cek_aspek = mysqli_query($koneksi, "SELECT * FROM aspek INNER JOIN faktor ON faktor.aspek=aspek.id_aspek WHERE aspek.id_spk='$id_spk'");
			if (mysqli_num_rows($cek_aspek) === 0) {
				?>
				<script type="text/javascript">
					window.alert("Aspek dan Atau Faktor Belum Terisi Cek Aspek dan Faktor Pada SPK Ini!");
					window.location="../../dashboard.php?module=spk&act=operator&id_user=<?=$id?>";
				</script>
			<?php 
			}else{
			$query = mysqli_query($koneksi, "UPDATE spk SET jenis='$_GET[status]', status_verif='Menunggu'
													WHERE id_spk='$_GET[id]'") or die(mysqli_error($koneksi));
		if($query){
			?>
				<script type="text/javascript">
					window.alert("Status SPK Berhasil DIubah Menjadi Publish/Umum");
					window.location="../../dashboard.php?module=spk&act=operator&id_user=<?=$id?>";
				</script>
			<?php 
		}else{
			?>
				<script type="text/javascript">
					window.alert("Status SPK Gagal Diubah Menjadi Publish/Umum");
					window.location="../../dashboard.php?module=spk&act=operator&id_user=<?=$id?>";
				</script>
			<?php 
		}
	}
}

		// edit spk
		elseif ($module=='spk' AND $act=='private'){
			$id = $_GET['id_user'];
			$query = mysqli_query($koneksi, "UPDATE spk SET jenis='$_GET[status]'
													WHERE id_spk='$_GET[id]'") or die(mysqli_error($koneksi));
		if($query){
			?>
				<script type="text/javascript">
					window.alert("Status SPK Berhasil DIubah Menjadi Private");
					window.location="../../dashboard.php?module=spk&act=operator&id_user=<?=$id?>";
				</script>
			<?php 
		}else{
			?>
				<script type="text/javascript">
					window.alert("Status SPK Berhasil Diubah Menjadi Private");
					window.location="../../dashboard.php?module=spk&act=operator&id_user=<?=$id?>";
				</script>
			<?php 
		}
	}
}
?>
