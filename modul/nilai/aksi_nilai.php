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

	// Hapus nilai profil
	if ($module=='nilai' AND $act=='hapus'){
		$hapus =mysqli_query($koneksi,"DELETE FROM nilai WHERE id_nilai='$_GET[id]'");
	  if ($hapus) {
			?>
	  		<script type="text/javascript">
					window.alert("Data berhasil dihapus");
					window.location="../../dashboard.php?module=nilai";
			</script>
	  		<?php
	  		}else{
	  		?>
	  		<script type="text/javascript">
					window.alert("Data gagal dihapus");
					window.location="../../dashboard.php?module=nilai";
		</script>
	  	<?php
	}
			  
}

	// tambah nilai profil
	elseif ($module=='nilai' AND $act=='simpan'){
		//$tgl=date("Y/m/d");
			for ($i=0; $i <$_POST['jumlah_faktor'] ; $i++) { 
		        $faktor 			  = $_POST["faktor"];
		        $nilai 				  = $_POST["nilai"];
		        $id_alternatif        = $_POST['id_alternatif'];
		        $id_spk        		  = $_POST['id_spk'];
		        
		        $sql = "insert into nilai (id_alternatif, faktor, nilai, id_spk, id_user)values
		        ('$id_alternatif', '$faktor[$i]', '$nilai[$i]', '$id_spk', '$_SESSION[id_user]')";
		        $query = mysqli_query($koneksi,$sql) or die(mysqli_error($koneksi));
    		}
			if($query){
			?>
				<script type="text/javascript">
					window.alert("Data berhasil ditambah");
					window.location="../../dashboard.php?module=nilai";
				</script>
			<?php 
			}else{
				?>
					<script type="text/javascript">
						window.alert("Data gagal ditambah");
						window.location="../../dashboard.php?module=nilai";
					</script>
				<?php 
			}
			//header('location:../../dashboard.php?module='.$module);
	}

	// edit nilai profil
	elseif ($module=='nilai' AND $act=='update'){
		  $query=mysqli_query($koneksi,"UPDATE nilai SET nilai 	= '$_POST[nilai]'
							   						  WHERE  id_nilai    	= '$_POST[id_nilai]'")or die (mysqli_error($koneksi));
		  if($query){
			?>
				<script type="text/javascript">
					window.alert("Data berhasil diubah");
					window.location="../../dashboard.php?module=nilai";
				</script>
			<?php 
			}else{
				?>
					<script type="text/javascript">
						window.alert("Data gagal diubah");
						window.location="../../dashboard.php?module=nilai";
					</script>
				<?php 
			}
		//header('location:../../dashboard.php?module='.$module);
		
	}
}
?>
