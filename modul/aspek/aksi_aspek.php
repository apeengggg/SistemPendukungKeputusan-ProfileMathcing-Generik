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

	// Hapus aspek
	if ($module=='aspek' AND $act=='hapus'){
		$idspk = $_GET['id_spk'];
		$id = $_GET['id'];
		$hapus = mysqli_query($koneksi,"DELETE FROM aspek WHERE id_aspek='$id'");
		$hapus2 = mysqli_query($koneksi,"DELETE FROM faktor WHERE aspek='$id'");
	  if ($hapus && $hapus2) {
			?>
	  		<script type="text/javascript">
					window.alert("Data berhasil dihapus");
					window.location="../../dashboard.php?module=aspek&id=<?=$idspk?>";
			</script>
	  		<?php
	  		}else{
	  		?>
	  		<script type="text/javascript">
					window.alert("Data gagal dihapus");
					window.location="../../dashboard.php?module=aspek&id=<?=$idspk?>";
		</script>
	  	<?php
	}
			  
}

	// tambah aspek
	elseif ($module=='aspek' AND $act=='simpan'){
		$name=$_POST['nama_aspek'];
		$idspk=$_POST['id_spk'];
		$init = $_POST['Inisial'];
		$ceklebih = mysqli_query($koneksi, "SELECT SUM(bobot) as jumlah FROM aspek WHERE id_spk='$idspk'");
		$a = mysqli_fetch_array($ceklebih);
		$b = $a['jumlah'];
		$c = $b + $_POST['bobot'];
		$bobot_a = $_POST['bobot']/100;
		$bobot_sec = 100-$_POST['bobot_core'];
		$bobot_angka = is_numeric($_POST['bobot']);
		if ($_POST['bobot_core'] > 100 $_POST['bobot_core'] === 0 OR $_POST['bobot_core'] < 0) {
			echo "
						<script type='text/javascript'>
							window.alert('Bobot Core Lebih Dari 100 atau kurang dari sama dengan 0, Gagal Menambahkan Aspek Baru');
							window.location='../../dashboard.php?module=aspek&act=tambah&id=$idspk';
						</script>";
						die;
		}
		if ($_POST['bobot'] > 100 OR $_POST['bobot'] === 0 OR $_POST['bobot'] < 0) {
			echo "
						<script type='text/javascript'>
							window.alert('Bobot Lebih Dari 100 atau kurang dari sama dengan 0, Gagal Menambahkan Aspek Baru');
							window.location='../../dashboard.php?module=aspek&act=tambah&id=$idspk';
						</script>";
						die;
		}
		// if ($b > 100 OR $c > 100) {
		// 	echo "
		// 				<script type='text/javascript'>
		// 					window.alert('Jumlah Dari Bobot Aspek Lebih Dari 100, Gagal Menambahkan Aspek!');
		// 					window.location='../../dashboard.php?module=aspek&act=tambah&id=$idspk';
		// 				</script>";
		// 				die;
		// }
		// var_dump($_POST); die;
		$ceknama=mysqli_query($koneksi,"SELECT * FROM aspek WHERE (nama_aspek='$name' AND id_spk=$idspk) OR (nama_singkat='$init' AND id_spk=$idspk)");
		if (mysqli_num_rows($ceknama)>0) {
			if (isset($_GET["jenis"])) {
					echo "
						<script type='text/javascript'>
							window.alert('Nama Aspek+ / Initial Nama Sudah Ada, Gagal Menambahkan Aspek!');
							window.location='../../dashboard.php?module=aspek&act=tambah&id=$idspk&jenis=spkbaru';
						</script>";
				}else{
					echo "		
						<script type='text/javascript'>
							window.alert('Nama Aspek / Initial Nama Sudah Ada, Gagal Menambahkan Aspek!');
							window.location='../../dashboard.php?module=aspek&act=tambah&id=$idspk';
						</script>";
						}
		}else{
				$query=mysqli_query($koneksi,"INSERT INTO aspek(nama_aspek,
										 				 bobot, 
										 				 bobot_core, 
										 				 bobot_secondary, 
										 				 nama_singkat,
										 				 id_spk) 
								   				  VALUES('$_POST[nama_aspek]',
														'$bobot_a', 
														'$_POST[bobot_core]', 
														'$bobot_sec', 
														'$_POST[Inisial]',
														'$_POST[id_spk]')") or die (mysqli_error($koneksi));

				if($query){
					if (isset($_GET["jenis"])) {
					$id_aspek= mysqli_insert_id($koneksi);
						echo "
							<script type='text/javascript'>
								window.alert('Data Berhasil Ditambahkan');
								window.location='../../dashboard.php?module=faktor&id=$id_aspek&id_spk=$idspk&jenis=baru';
							</script>";
					}else{
						echo "		
							<script type='text/javascript'>
								window.alert('Data Berhasil Ditambahkan');
								window.location='../../dashboard.php?module=aspek&id=$idspk';
							</script>";
							}
				}else{
					if (isset($_GET["jenis"])) {
						echo "
							<script type='text/javascript'>
								window.alert('Data Gagal Ditambahkan');
								window.location='../../dashboard.php?module=aspek&act=tambah&id=$idspk&jenis=spkbaru';
							</script>";
					}else{
						echo "		
							<script type='text/javascript'>
								window.alert('Data Gagal Ditambahkan');
								window.location='../../dashboard.php?module=aspek&act=tambah&id=$idspk';
							</script>";
							}
				}
				//header('location:../../dashboard.php?module='.$module);
	}
}

	// edit aspek
	elseif ($module=='aspek' AND $act=='update'){
		$name=$_POST['nama_aspek'];
		$idspk = $_POST['id_spk'];
		$id_aspekk = $_POST['id_aspek'];
		$init = $_POST['nama_singkat'];
		$bobot_sec = 100-$_POST['bobot_core'];
		$bobot = $_POST['bobot']/100;
		if ($_POST['bobot_core'] > 100 OR $_POST['bobot_core'] === 0 OR $_POST['bobot_cores'] < 0) {
			echo "
						<script type='text/javascript'>
							window.alert('Bobot Core Lebih Dari 100, atau kurang dari samadengan 0, Gagal Menambahkan Aspek Baru');
							window.location='../../dashboard.php?module=aspek&act=tambah&id=$idspk';
						</script>";
						die;
		}
		if ($_POST['bobot'] > 100 OR $_POST['bobot'] === 0 OR $_POST['bobot'] < 0) {
			echo "
						<script type='text/javascript'>
							window.alert('Bobot Lebih Dari 100, atau kurang dari samadengan 0 Gagal Menambahkan Aspek Baru');
							window.location='../../dashboard.php?module=aspek&act=tambah&id=$idspk';
						</script>";
						die;
		}
		$aspek_lama = mysqli_query($koneksi, "SELECT nama_aspek, nama_singkat FROM aspek WHERE id_spk='$idspk' AND id_aspek='$id_aspekk'");
		$res_aspek = mysqli_fetch_array($aspek_lama);
		$init_l = $res_aspek['nama_singkat'];
		$aspek_l = $res_aspek['nama_aspek'];
		// cek apakah data baru sama dengan data lama?
		if ($name != $aspek_l OR $init != $init_l) {
		$ceknama=mysqli_query($koneksi,"SELECT * FROM aspek WHERE (nama_aspek='$name' AND id_spk=$idspk) OR (nama_singkat='$init' AND id_spk=$idspk)");
		// cek lagi ada ga data baru itu di aspek?
		if (mysqli_num_rows($ceknama)>0) {
		?>
		<!-- kalau iya -->
			<script type="text/javascript">
				window.alert("Nama Aspek Sudah Ada, Gagal Merubah Aspek!");
				window.location="../../dashboard.php?module=aspek&id=<?=$idspk?>";
			</script>
		<?php
		// kalo engga
		}else{
		  $query=mysqli_query($koneksi,"UPDATE aspek SET nama_aspek 		= '$_POST[nama_aspek]', 
				  										bobot 				='$bobot',  
				  										bobot_core 		='$_POST[bobot_core]', 
				  										bobot_secondary	='$bobot_sec',  
				  										nama_singkat 		='$_POST[nama_singkat]'
									   					WHERE  id_aspek    	= '$_POST[id_aspek]'")or die (mysqli_error($koneksi));
				  if($query){
					?>
						<script type="text/javascript">
							window.alert("Data berhasil diubah");
							window.location="../../dashboard.php?module=aspek&id=<?=$idspk?>";
						</script>
					<?php 
					}else{
						?>
							<script type="text/javascript">
								window.alert("Data gagal diubah");
								window.location="../../dashboard.php?module=aspek&id=<?=$idspk?>";
							</script>
						<?php 
					}
				//header('location:../../dashboard.php?module='.$module);
		}
		// kalau data aspek nama, dan initial sama dengan data lama langsung ubah gakperlu dicek
	}else{
				  $query=mysqli_query($koneksi,"UPDATE aspek SET nama_aspek 		= '$_POST[nama_aspek]', 
				  												 bobot 				='$bobot',  
				  												 bobot_core 		='$_POST[bobot_core]', 
				  												 bobot_secondary	='$bobot_sec',  
				  												 nama_singkat 		='$_POST[nama_singkat]'
									   						  WHERE  id_aspek    	= '$_POST[id_aspek]'")or die (mysqli_error($koneksi));
				  if($query){
					?>
						<script type="text/javascript">
							window.alert("Data berhasil diubah");
							window.location="../../dashboard.php?module=aspek&id=<?=$idspk?>";
						</script>
					<?php 
					}else{
						?>
							<script type="text/javascript">
								window.alert("Data gagal diubah");
								window.location="../../dashboard.php?module=aspek&id=<?=$idspk?>";
							</script>
						<?php 
					}
	}
}
	}
?>
