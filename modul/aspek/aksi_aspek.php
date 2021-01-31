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
		$hapus = mysqli_query($koneksi,"DELETE FROM aspek WHERE id_aspek='$_GET[id]'");
	  if ($hapus) {
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
		if ($b > 100 OR $c > 100) {
			echo "
						<script type='text/javascript'>
							window.alert('Jumlah Dari Bobot Aspek Lebih Dari 100, Gagal Menambahkan Aspek!');
							window.location='../../dashboard.php?module=aspek&act=tambah&id=$idspk';
						</script>";
						die;
		}
		// var_dump($_POST); die;
		$ceknama=mysqli_query($koneksi,"SELECT * FROM aspek WHERE (nama_aspek='$name' OR nama_singkat='$init') AND id_spk=$idspk");
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
			if(($_POST["bobot_core"]+$_POST["bobot_secondary"])==100)
			{
				$query=mysqli_query($koneksi,"INSERT INTO aspek(nama_aspek,
										 				 bobot, 
										 				 bobot_core, 
										 				 bobot_secondary, 
										 				 nama_singkat,
										 				 id_spk,
										 				 id_user) 
								   				  VALUES('$_POST[nama_aspek]',
														'$_POST[bobot]', 
														'$_POST[bobot_core]', 
														'$_POST[bobot_secondary]', 
														'$_POST[Inisial]',
														'$_POST[id_spk]',
														'$_SESSION[id_user]')") or die (mysqli_error($koneksi));

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
			}else{
				if (isset($_GET["jenis"])) {
					echo "
						<script type='text/javascript'>
							window.alert('Bobot Core dan Bobot Secondary Harus Sama Dengan 100%, Data Gagal Ditambahkan');
							window.location='../../dashboard.php?module=aspek&act=tambah&id=$idspk&jenis=spkbaru';
						</script>";
				}else{
					echo "		
						<script type='text/javascript'>
							window.alert('Bobot Core dan Bobot Secondary Harus Sama Dengan 100%, Data Gagal Ditambahkan');
							window.location='../../dashboard.php?module=aspek&act=tambah&id=$idspk';
						</script>";
						}
			}
	}
}

	// edit aspek
	elseif ($module=='aspek' AND $act=='update'){
		$name=$_POST['nama_aspek'];
		$idspk = $_POST['id_spk'];
		$id_aspekk = $_POST['id_aspek'];
		// var_dump($_GET); var_dump($_POST); die;
		$aspek_lama = mysqli_query($koneksi, "SELECT nama_aspek FROM aspek WHERE id_spk='$idspk'");
		$res_aspek = mysqli_fetch_array($aspek_lama);
		$aspek_l = $res_aspek['nama_aspek'];
		// echo $name; 
		// echo $aspek_l; die;
		if ($name != $aspek_l) {
		$ceknama=mysqli_query($koneksi,"SELECT * FROM aspek WHERE (nama_aspek='$name' OR nama_singkat='$init') AND id_spk=$idspk");
		if (mysqli_num_rows($ceknama)>0) {
		?>
			<script type="text/javascript">
				window.alert("Nama Aspek Sudah Ada, Gagal Merubah Aspek!");
				window.location="../../dashboard.php?module=aspek&id=<?=$idspk?>";
			</script>
		<?php
		}else{
		 if(($_POST["bobot_core"]+$_POST["bobot_secondary"])==100)
			{
				  $query=mysqli_query($koneksi,"UPDATE aspek SET nama_aspek 		= '$_POST[nama_aspek]', 
				  												 bobot 				='$_POST[bobot]',  
				  												 bobot_core 		='$_POST[bobot_core]', 
				  												 bobot_secondary	='$_POST[bobot_secondary]',  
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
		}else{
				?>
				<script type="text/javascript">
					window.alert("Simpan data gagal. Bobot Core + Bobot Secondary Kurang dari 100%");
					window.location="../../dashboard.php?module=aspek&id=<?=$idspk?>";
				</script>
			<?php 
	}
		}
	}else{
		$ceknama=mysqli_query($koneksi,"SELECT * FROM aspek WHERE (nama_aspek='$name' OR nama_singkat='$init') AND id_spk=$idspk");
		if (mysqli_num_rows($ceknama)>0) {
			?>
			<script type="text/javascript">
				window.alert("Nama Aspek Sudah Ada, Gagal Merubah Aspek!");
				window.location="../../dashboard.php?module=aspek&id=<?=$idspk?>";
			</script>
		<?php
		}else{
		if(($_POST["bobot_core"]+$_POST["bobot_secondary"])==100)
			{
				  $query=mysqli_query($koneksi,"UPDATE aspek SET nama_aspek 		= '$_POST[nama_aspek]', 
				  												 bobot 				='$_POST[bobot]',  
				  												 bobot_core 		='$_POST[bobot_core]', 
				  												 bobot_secondary	='$_POST[bobot_secondary]',  
				  												 nama_singkat 		='$_POST[nama_singkat]',
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
		}else{
				?>
				<script type="text/javascript">
					window.alert("Simpan data gagal. Bobot Core + Bobot Secondary Kurang dari 100%");
					window.location="../../dashboard.php?module=aspek&id=<?=$idspk?>";
				</script>
			<?php 
	}
	}
}
	}
}
?>
