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
		$hapus = mysqli_query($koneksi,"DELETE FROM aspek WHERE id_aspek='$_GET[id]'");
	  if ($hapus) {
			?>
	  		<script type="text/javascript">
					window.alert("Data berhasil dihapus");
					window.location="../../dashboard.php?module=aspek";
			</script>
	  		<?php
	  		}else{
	  		?>
	  		<script type="text/javascript">
					window.alert("Data gagal dihapus");
					window.location="../../dashboard.php?module=aspek";
		</script>
	  	<?php
	}
			  
}

	// tambah aspek
	elseif ($module=='aspek' AND $act=='simpan'){
		$name=$_POST['nama_aspek'];
		$idspk=$_POST['id_spk'];
		$ceknama=mysqli_query($koneksi,"SELECT * FROM aspek WHERE nama_aspek='$name' AND id_spk=$idspk");
		if (mysqli_num_rows($ceknama)>0) {
			?>
		<script type="text/javascript">
					window.alert("Nama Aspek Sudah Ada, Gagal Menambahkan Aspek!");
					window.location="../../dashboard.php?module=aspek";
		</script>
			<?php
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
														'$_POST[nama_singkat]',
														'$_POST[id_spk]',
														'$_SESSION[id_user]')") or die (mysqli_error($koneksi));

				if($query){
				?>
					<script type="text/javascript">
						window.alert("Data berhasil ditambah");
						window.location="../../dashboard.php?module=aspek";
					</script>
				<?php 
				}else{
					?>
						<script type="text/javascript">
							window.alert("Data gagal ditambah");
							window.location="../../dashboard.php?module=aspek";
						</script>
					<?php 
				}
				//header('location:../../dashboard.php?module='.$module);
			}else{
				?>
				<script type="text/javascript">
					window.alert("Simpan data gagal. Bobot Core + Bobot Secondary Kurang dari 100%");
					window.location="../../dashboard.php?module=aspek";
				</script>
			<?php 
			}
	}
}

	// edit aspek
	elseif ($module=='aspek' AND $act=='update'){
		$name=$_POST['nama_aspek'];
		$idspk=$_POST['id_spk'];
		$aspek_lama = mysqli_query($koneksi, "SELECT nama_aspek FROM aspek WHERE id_spk='$idspk'");
		$res_aspek = mysqli_fetch_array($aspek_lama);
		$aspek_l = $res_aspek['nama_aspek'];
		if ($name != $aspek_l) {
		$ceknama=mysqli_query($koneksi,"SELECT * FROM aspek WHERE nama_aspek='$name' AND id_spk=$idspk");
		if (mysqli_num_rows($ceknama)>0) {
		?>
			<script type="text/javascript">
				window.alert("Nama Aspek Sudah Ada, Gagal Menambahkan Aspek!");
				window.location="../../dashboard.php?module=aspek";
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
				  												 id_spk 			='$_POST[id_spk]' 
									   						  WHERE  id_aspek    	= '$_POST[id_aspek]'")or die (mysqli_error($koneksi));
				  if($query){
					?>
						<script type="text/javascript">
							window.alert("Data berhasil diubah");
							window.location="../../dashboard.php?module=aspek";
						</script>
					<?php 
					}else{
						?>
							<script type="text/javascript">
								window.alert("Data gagal diubah");
								window.location="../../dashboard.php?module=aspek";
							</script>
						<?php 
					}
				//header('location:../../dashboard.php?module='.$module);
		}else{
				?>
				<script type="text/javascript">
					window.alert("Simpan data gagal. Bobot Core + Bobot Secondary Kurang dari 100%");
					window.location="../../dashboard.php?module=aspek";
				</script>
			<?php 
	}
		}
	}else{
		if(($_POST["bobot_core"]+$_POST["bobot_secondary"])==100)
			{
				  $query=mysqli_query($koneksi,"UPDATE aspek SET nama_aspek 		= '$_POST[nama_aspek]', 
				  												 bobot 				='$_POST[bobot]',  
				  												 bobot_core 		='$_POST[bobot_core]', 
				  												 bobot_secondary	='$_POST[bobot_secondary]',  
				  												 nama_singkat 		='$_POST[nama_singkat]',
				  												 id_spk 			='$_POST[id_spk]' 
									   						  WHERE  id_aspek    	= '$_POST[id_aspek]'")or die (mysqli_error($koneksi));
				  if($query){
					?>
						<script type="text/javascript">
							window.alert("Data berhasil diubah");
							window.location="../../dashboard.php?module=aspek";
						</script>
					<?php 
					}else{
						?>
							<script type="text/javascript">
								window.alert("Data gagal diubah");
								window.location="../../dashboard.php?module=aspek";
							</script>
						<?php 
					}
				//header('location:../../dashboard.php?module='.$module);
		}else{
				?>
				<script type="text/javascript">
					window.alert("Simpan data gagal. Bobot Core + Bobot Secondary Kurang dari 100%");
					window.location="../../dashboard.php?module=aspek";
				</script>
			<?php 
	}
	}
}
}
?>
