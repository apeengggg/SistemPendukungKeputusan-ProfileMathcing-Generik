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
		$hapusnilai = mysqli_query($koneksi, "DELETE FROM nilai WHERE id_alternatif='$_GET[id_spk]'");
		$hapushasil = mysqli_query($koneksi, "DELETE FROM hasil WHERE id_spkuser='$_GET[u_spk]' AND nama_alternatif='$_GET[name]'");
	  	if ($hapus && $hapusnilai && $hapushasil) {
	  	?>
	  	<script type="text/javascript">
					window.alert("Data berhasil dihapus");
					window.location="../../dashboard.php?module=alternatif_user&act=view_alt&id_spkuser=<?=$_GET[u_spk]?>&id_spk=<?=$_GET[id_spk]?>";
		</script>
	  	<?php
	  	}else{
	  		?>
	  	<script type="text/javascript">
					window.alert("Data gagal dihapus");
					window.location="../../dashboard.php?module=alternatif_user&act=view_alt&id_spkuser=<?=$_GET[u_spk]?>&id_spk=<?=$_GET[id_spk]?>"";
		</script>
	  	<?php
}
	}

	if ($module=='alternatif' AND $act=='hapus_spk_user'){
		$hapus = mysqli_query($koneksi,"DELETE FROM spk_user WHERE id_spkuser='$_GET[id]'");
		$hapus_alt = mysqli_query($koneksi,"DELETE FROM alternatif WHERE id_spkuser='$_GET[id]'"); ;
		$hapus_nilai = mysqli_query($koneksi,"DELETE FROM nilai WHERE id_spkuser='$_GET[id]'");;
		$hapus_hasil = mysqli_query($koneksi,"DELETE FROM hasil WHERE id_spkuser='$_GET[id]'");;
	  	if ($hapus) {
	  	?>
	  	<script type="text/javascript">
					window.alert("Data berhasil dihapus");
					window.location="../../dashboard.php?module=alternatif_user";
		</script>
	  	<?php
	  	}else{
	  		?>
	  	<script type="text/javascript">
					window.alert("Data gagal dihapus");
					window.location="../../dashboard.php?module=alternatif_user";
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

	// tambah alternatif
	elseif ($module=='alternatif' AND $act=='input_nilai_alt'){
			$idspk = $_POST['id_spk'];
			$idspkuser = $_POST['id_spkuser'];
			// $nilai = $_POST['nilai'];
			$id_faktor = $_POST['id_faktor'];
			$alt = $_POST['nama_alternatif'];
			$insert_alt = mysqli_query($koneksi, "INSERT INTO alternatif (nama_alternatif, id_spkuser) VALUES ('$alt', 	'$idspkuser')");
			if($insert_alt){
				$id_alt = mysqli_insert_id($koneksi);
				?>
					<script type="text/javascript">
						window.alert("Data berhasil ditambah");
						window.location="../../dashboard.php?module=alternatif_user&act=tambahdetail&id_spkuser=<?=$idspkuser?>&id_alt=<?=$id_alt?>&id_spk=<?=$idspk?>";
					</script>
				<?php 
				}else{
					?>
						<script type="text/javascript">
							window.alert("Data gagal ditambah");
							window.location="../../dashboard.php?module=alternatif_user&act=view_alt&id_spkuser=<?=$idspkuser?>";
						</script>
					<?php 
				}
			}

	elseif ($module=='alternatif' AND $act=='ubah_nilai'){
				//$tgl=date("Y/m/d");
					for ($i=0; $i <$_POST['jumlah_faktor'] ; $i++) { 
						$faktor 			  = $_POST["faktor"];
						$nilai 				  = $_POST["nilai"];
						$id_alternatif        = $_POST['id_alternatif'];
						$id_spk        		  = $_POST['id_spkuser'];
						$idspk        		  = $_POST['id_spk'];
						
						$queryubah = mysqli_query($koneksi, "UPDATE nilai SET nilai='$nilai[$i]' WHERE id_alternatif='$id_alternatif' AND faktor='$faktor[$i]'");
					}
					if($queryubah){
					?>
						<script type="text/javascript">
							window.alert("Data nilai berhasil diubah");
							window.location="../../dashboard.php?module=alternatif_user&act=view_alt&id_spkuser=<?=$id_spk?>&id_spk=<?=$idspk?>";
						</script>
					<?php 
					}else{
						?>
							<script type="text/javascript">
								window.alert("Data nilai gagal diubah");
								window.location="../../dashboard.php?module=alternatif_user&act=view_alt&id_spkuser=<?=$id_spk?>&id_spk=<?=$idspk?>";
							</script>
						<?php 
					}
					//header('location:../../dashboard.php?module='.$module);
			}

			elseif ($module=='alternatif' AND $act=='simpan_nilai'){
				$faktor 			  = $_POST["faktor"];
				$nilai 				  = $_POST["nilai"];
				$id_alternatif        = $_POST['id_alternatif'];
				$id_spk        		  = $_POST['id_spkuser'];
				$idspk        		  = $_POST['id_spk'];
				$max = max($nilai);
				$min = min($nilai);
				if ($max > 5 OR $min < 1  ) {
					?>
							<script type="text/javascript">
								window.alert("Terdapat Nilai Yang Lebih Dari 5 atau kurang dari 1");
								window.location="../../dashboard.php?module=alternatif_user&act=view_alt&id_spkuser=<?=$id_spk?>&id_spk=<?=$idspk?>";
							</script>
						<?php 
				}else{
					for ($i=0; $i < $_POST['jumlah_faktor']; $i++) { 
						$sql = "INSERT INTO nilai (id_alternatif, faktor, nilai, id_spkuser) VALUES ('$id_alternatif', '$faktor[$i]', '$nilai[$i]', '$id_spk')";
						$query = mysqli_query($koneksi, $sql);
					}	
					if ($query) {
						?>
							<script type="text/javascript">
								window.alert("Data nilai berhasil ditambah");
								window.location="../../dashboard.php?module=alternatif_user&act=view_alt&id_spkuser=<?=$id_spk?>&id_spk=<?=$idspk?>";
							</script>
						<?php 
					}else{
						?>
						<script type="text/javascript">
							window.alert("Data nilai gagal ditambah");
							window.location="../../dashboard.php?module=alternatif_user&act=view_alt&id_spkuser=<?=$id_spk?>&id_spk=<?=$idspk?>";
						</script>
					<?php 
					}
				}
			}

	elseif ($module=='alternatif' AND $act=='simpan_spk_baru'){
		//$tgl=date("Y/m/d");
			$query=mysqli_query($koneksi,"INSERT INTO spk_user(id_user,
									 				 id_spk,
									 				 ket) 
							   				  VALUES('$_SESSION[id_user]',
													'$_POST[id_spk]',
													'$_POST[keterangan]')") or die (mysqli_error($koneksi));
			$ambil_id = mysqli_insert_id($koneksi);
			// echo $ambil_id; die;

			if($query){
			?>
				<script type="text/javascript">
					window.alert("Data berhasil ditambah");
					window.location="../../dashboard.php?module=alternatif_user&act=view_alt&id_spkuser=<?=$ambil_id?>&id_spk=<?=$_POST[id_spk]?>";
				</script>
			<?php 
			}else{
				?>
					<script type="text/javascript">
						window.alert("Data gagal ditambah");
						window.location="../../dashboard.php?module=alternatif_user&act=view_alt&id_spkuser=<?=$ambil_id?>&id_spk=<?=$_POST[id_spk]?>";
					</script>
				<?php 
			}
			//header('location:../../dashboard.php?module='.$module);
	}

	// edit alternatif
	elseif ($module=='alternatif' AND $act=='update'){
		$id_spk = $_POST['id_spkuser'];
		$idspk = $_POST['id_spk'];
		  $query=mysqli_query($koneksi,"UPDATE alternatif SET nama_alternatif 	= '$_POST[nama_alternatif]'
							   						  WHERE  id_alternatif    	= '$_POST[id_alternatif]'")or die (mysqli_error($koneksi));
		  if($query){
			?>
				<script type="text/javascript">
					window.alert("Data berhasil diubah");
					window.location="../../dashboard.php?module=alternatif_user&act=view_alt&id_spkuser=<?=$id_spk?>&id_spk=<?=$idspk?>";
				</script>
			<?php 
			}else{
				?>
					<script type="text/javascript">
						window.alert("Data gagal diubah");
						window.location="../../dashboard.php?module=alternatif_user&act=view_alt&id_spkuser=<?=$id_spk?>&id_spk=<?=$idspk?>";
					</script>
				<?php 
			}
		//header('location:../../dashboard.php?module='.$module);
		
	}// edit alternatif
	elseif ($module=='alternatif' AND $act=='update_spkuser'){
		$id_spk = $_POST['id_spkuser'];
		  $query=mysqli_query($koneksi,"UPDATE spk_user SET ket 	= '$_POST[keterangan]'
							   						  WHERE  id_spkuser    	= '$id_spk'")or die (mysqli_error($koneksi));
		  if($query){
			?>
				<script type="text/javascript">
					window.alert("Data berhasil diubah");
					window.location="../../dashboard.php?module=alternatif_user";
				</script>
			<?php 
			}else{
				?>
					<script type="text/javascript">
						window.alert("Data gagal diubah");
						window.location="../../dashboard.php?module=alternatif_user";
					</script>
				<?php 
			}
		//header('location:../../dashboard.php?module='.$module);
		
	}
}

?>
