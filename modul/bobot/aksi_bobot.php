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
		$idspk = $_GET['idspk'];
		$hapus =mysqli_query($koneksi,"DELETE FROM bobot WHERE id_bobot='$_GET[id]'");
	 if ($hapus) {
			?>
	  		<script type="text/javascript">
					window.alert("Data berhasil dihapus");
					window.location="../../dashboard.php?module=bobot&id=<?=$idspk?>";
			</script>
	  		<?php
	  		}else{
	  		?>
	  		<script type="text/javascript">
					window.alert("Data gagal dihapus");
					window.location="../../dashboard.php?module=bobot&id=<?=$idspk?>";
		</script>
	  	<?php
	}
			  
}

	// tambah bobot
	elseif ($module=='bobot' AND $act=='simpan'){
		$tgl=date("Y/m/d");
		$id = $_POST['id_spk'];
		$keterangan = $_POST['keterangan'];
		if ($keterangan==0) {
			$ket = 'Kompetensi individu kekurangan 4 tingkat/level';
			$bob = '1';
			$sel = '-4';
		}elseif ($keterangan==1) {
			$ket = 'Kompetensi individu kekurangan 3 tingkat/level';
			$bob = '2';
			$sel = '-3';
		}
		elseif ($keterangan==2) {
			$ket = 'Kompetensi individu kekurangan 2 tingkat/level';
			$bob = '3';
			$sel = '-2';
		}
		elseif ($keterangan==3) {
			$ket = 'Kompetensi individu kekurangan 1 tingkat/level';
			$bob = '4';
			$sel = '-1';
		}
		elseif ($keterangan==4) {
			$ket = 'Tidak ada selisih  ( kompetensi sesuai yang dibutuhkan...';
			$bob = '5';
			$sel = '0';
		}
		elseif ($keterangan==5) {
			$ket = 'Kompetensi individu kelebihan 4 tingkat/level';
			$bob = '1.5';
			$sel = '4';
		}
		elseif ($keterangan==6) {
			$ket = 'Kompetensi individu kelebihan 3 tingkat/level';
			$bob = '2.5';
			$sel = '3';
		}
		elseif ($keterangan==7) {
			$ket = 'Kompetensi individu kelebihan 2 tingkat/level';
			$bob = '3.5';
			$sel = '2';
		}
		elseif ($keterangan==8) {
			$ket = 'Kompetensi individu kelebihan 1 tingkat/level';
			$bob = '4.5';
			$sel = '1';
		}
		   $query=mysqli_query($koneksi,"INSERT INTO bobot(selisih,
									 				 bobot, 
									 				 keterangan,
									 				 id_spk,
									 				 id_user) 
							   				   VALUES('$sel',
													  '$bob', 
													  '$ket',
													  '$_POST[id_spk]',
													  '$_SESSION[id_user]')") or die (mysqli_error($koneksi));

		 if($query){
			//  cek apakah bobot sudaha ada 9 ?
			$cekbobot = mysqli_query($koneksi, "SELECT * FROM bobot WHERE id_spk='$id'");
				if (mysqli_num_rows($cekbobot)==9) {
					?>
						<script type="text/javascript">
							window.alert("Data berhasil ditambah");
							window.location="../../dashboard.php?module=bobot&id=<?=$id?>";
						</script>
					<?php
				}else{
					?>
						<script type="text/javascript">
							window.alert("Data berhasil ditambah");
							window.location="../../dashboard.php?module=bobot&act=tambah&id=<?=$id?>";
						</script>
					<?php
				}
					 
					}else{
						?>
							<script type="text/javascript">
								window.alert("Data gagal ditambah");
								window.location="../../dashboard.php?module=bobot&id=<?=$id?>";
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
