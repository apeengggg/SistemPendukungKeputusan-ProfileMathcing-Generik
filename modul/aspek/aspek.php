<?php 
include "config/koneksi.php";
include "kode_otomatis.php";
$act=$_GET["act"];
 ?>	
 	<div class="row">
		<div class="col-md-12">
          <div class="card ">
            	
			<?php  
				switch($_GET["act"])
				{
					default:
					if (isset($_GET['id'])) {
						$id = $_GET['id'];
						// ambil id_user
						$query = mysqli_query($koneksi, "SELECT * FROM spk WHERE id_spk='$id'");
						$result = mysqli_fetch_array($query);
						$r = $result['id_user'];
						$user = $_SESSION['id_user'];
					}
					
						?>
						<div class="card-header card-header-rose card-header-text">
		                  <div class="card-text">
		                    <h4 class="card-title">Data Aspek</h4>
		                  </div>
		                </div>
		                <div class="card-body ">
							
						<?php
						if ($r == $user) {
						if (isset($_GET["jenis"])) {
						?>
							<a href="?module=aspek&act=tambah&id=<?=$id?>&jenis=spkbaru">
								<button class="btn  btn-youtube">
	                          		<i class="fa fa-plus-square-o"> </i> Tambah Data Aspek
	                        	</button>
	                       	</a>
							<!-- <a href="?module=aspek&act=tambah&id=<?=$id?>">
								<button class="btn  btn-primary">
	                          		Lanjut Isi Faktor >>
	                        	</button>
	                       	</a> -->
						<?php
						}else{
							?>
							<a href="?module=aspek&act=tambah&id=<?=$id?>">
								<button class="btn  btn-youtube">
	                          		<i class="fa fa-plus-square-o"> </i> Tambah Data Aspek +
	                        	</button>
	                       	</a>
						<?php
						}		
					}				
						?>
							   
	                       <div class="box-body">
          				<div class="alert alert-success" role="alert">
         				 		* Persentase Aspek Harus 100% dari Jumlah Aspek, dan Jumlah Presentase Bobot Core dan Bobot Secondary Harus 100%<br>
								* Untuk Melihat Faktor Silahkan Klik Pada Nama Aspek Yang Dipilih
         				 </div>
							<table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
									<?php 
									$no=1;
									if (isset($_GET['id'])) {
										$id = $_GET['id'];
									}
									if($_SESSION["level"]=="admin")
									{
										$tampil = mysqli_query($koneksi,"SELECT * FROM aspek INNER JOIN spk ON spk.id_spk=aspek.id_spk WHERE aspek.id_spk='$id' ORDER BY id_aspek ASC");
									}else{
										$tampil = mysqli_query($koneksi,"SELECT * FROM aspek INNER JOIN spk ON spk.id_spk=aspek.id_spk WHERE aspek.id_spk='$id' ORDER BY id_aspek ASC");
									}
								      echo "
								          <thead align='center'>
											<tr>
												<th width=''>No</th>
												<th>Nama Aspek</th>
												<th>Bobot</th>
												<th>Bobot Core</th>
												<th>Bobot Secondary</th>
												<th>Inisial Aspek</th>
												<th>Aksi</th>
											</tr>
										</thead>
									<tbody>"; 
								    $no=1;
								    while ($r=mysqli_fetch_array($tampil)){
									   $a = $r['id_user'];
									   $u = $_SESSION['id_user'];
								       echo "<tr>
								       			<td>$no</td>
								       			<td><a href='?module=faktor&id=$r[id_aspek]&id_spk=$_GET[id]'>$r[nama_aspek]</a></td>
												<td>$r[bobot]</td>
												<td>$r[bobot_core]</td>
												<td>$r[bobot_secondary]</td>
												<td>$r[nama_singkat]</td>
												<td width='120px'>";
											if ($a == $u) {
												?>
													 <center>
													<a href="?module=aspek&act=edit&id=<?php echo $r[id_aspek] ?>&id_spk=<?php echo $r[id_spk] ?>" class="btn-sm btn-info">
														<i class="fa fa-edit"></i>
													</a>
													<a href="modul/aspek/aksi_aspek.php?module=aspek&act=hapus&id=<?php echo $r[id_aspek] ?>&id_spk=<?php echo $r[id_spk] ?>" class="btn-sm btn-danger" onclick='return confirm("Anda yakin mau menghapus item ini ?")'>
														<i class="fa fa-trash"></i>
													</a>
													 <!-- <a href='?module=aspek&act=edit&id=<?php echo $r[id_aspek] ?>&id_spk=<?php echo $r[id_spk] ?>' class='btn btn-info btn-just-icon edit'><i class='material-icons' rel='tooltip' title='Edit'>edit</i></a> 
													 <a href='modul/aspek/aksi_aspek.php?module=aspek&act=hapus&id=<?php echo $r[id_aspek] ?>&id_spk=<?php echo $r[id_spk] ?>' class='btn btn-danger btn-just-icon remove' onclick='return confirm("Anda yakin mau menghapus item ini ?")'><i class='material-icons' rel='tooltip' title='Hapus'>close</i></a> -->
														
												   </center>
												   <?php 
											}else{
												echo "Tidak Memiliki Akses";
											}
												
												   echo "
												</td>
											</tr>";
								      $no++;
								    }
								    echo "</tbody>
											
										</table>";
									?>
									</div>
								</div>
							</div>
						<?php
					break;

					case "view_aspek":
					?>

					<div class="card-header card-header-rose card-header-text">
		                  <div class="card-text">
		                    <h4 class="card-title">Data Aspek</h4>
		                  </div>
		                </div>
		                
		                <div class="card-body ">
							<!-- <a href="?module=aspek&act=tambah">
								<button class="btn  btn-youtube">
	                          		<i class="fa fa-plus-square-o"> </i> Tambah Data Aspek
	                        	</button>
	                       	</a>
	                       <div class="box-body">
          				<div class="alert alert-success" role="alert">
         				 		Persentase Aspek Harus 100% dari Jumlah Aspek, dan Jumlah Presentase Bobot Core dan Bobot Secondary Harus 100%
         				 </div> -->
							<table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
									<?php 
									$no=1;
									if (isset($_GET['id'])) {
										$id = $_GET['id'];
									}
									if($_SESSION["level"]=="admin")
									{
										$tampil = mysqli_query($koneksi,"SELECT * FROM aspek WHERE id_spk='$id' ORDER BY id_aspek ASC");
									}else{
										$tampil = mysqli_query($koneksi,"SELECT * FROM aspek WHERE id_user='$_SESSION[id_user]' ORDER BY id_aspek ASC");
									}
								      echo "
								          <thead>
											<tr>
												<th width=''>No</th>
												<th>Nama Aspek</th>
											</tr>
										</thead>
									<tbody>"; 
								    $no=1;
								    while ($r=mysqli_fetch_array($tampil)){
								       
								       echo "<tr>
								       			<td>$no</td>
								       			<td><a href=?module=faktor&id=$r[id_aspek]&id_spk=$r[id_spk]>$r[nama_aspek]</a>
								       			</td>
											</tr>";
								      $no++;
								    }
								    echo "</tbody>
											
										</table>";
									?>
									</div>
								</div>
							</div>
				<?php
					break;

					case "tambah":
					if (isset($_GET['id'])) {
						$id = $_GET['id'];
					}
					?>
						<div class="card-header card-header-rose card-header-text">
		                  <div class="card-text">
		                    <h4 class="card-title">Form Aspek</h4>
		                  </div>
		                </div>
		                
		                <div class="card-body ">
						<?php
							if (isset($_GET['jenis'])) {
							?>
						<form class="form" method="post" action="modul/aspek/aksi_aspek.php?module=aspek&act=simpan&jenis=spkbaru">
						<?php
						}else{
							?>
						<form class="form" method="post" action="modul/aspek/aksi_aspek.php?module=aspek&act=simpan">
						<?php
						}					
						?>
									
										<div class="content">
										    <div class="input-group">
												<label class="col-sm-4 control-label text-left">Nama Aspek</label>
												<input type="hidden" name="id_spk" class='form-control' value="<?=$id?>" required>
												<input type="text" name="nama_aspek" class='form-control' placeholder="Nama Aspek" required>
											</div>
		
											<div class="input-group">
												<label class="col-sm-4 control-label text-left">Bobot</label>
												<input type="number" name="bobot" class='form-control' placeholder="Bobot" min="1" max="100" required >
											</div>
											<div class="input-group">
												<label class="col-sm-4 control-label text-left">Bobot Core</label>
												<input type="number" name="bobot_core" class='form-control' placeholder="Bobot Core" min="1" max="100" required>
											</div>
											<div class="input-group">
												<label class="col-sm-4 control-label text-left">Bobot Secondary</label>
												<input type="number" name="bobot_secondary" class='form-control' placeholder="Bobot Secondary" min="1" max="100" required>
											</div>
											<div class="input-group">
												<label class="col-sm-4 control-label text-left">Nama Singkat/Inisial</label>
												<input type="text" name="Inisial" class='form-control' placeholder="Inisial" required>
											</div>
										</div>
										<div class="footer text-center">
											<input type="submit" value="Simpan" class="btn btn-primary pull-left">
											<input name="action" type="button" value="Cancel" onclick="window.history.back();" class="btn btn-danger pull-left">
										</div>
									</form>
								</div>
							</div>
						</div>
					<?php
					break;

					case "edit" :
					if (isset($_GET['id'])) {
						$id = $_GET['id'];
					}
					if (isset($_GET['id_spk'])) {
						$id_ = $_GET['id_spk'];
					}
					$edit=mysqli_query($koneksi,"SELECT * FROM aspek, spk where aspek.id_aspek='$_GET[id]' AND aspek.id_spk=spk.id_spk");
					$r=mysqli_fetch_array($edit);
					?>
						<div class="card-header card-header-rose card-header-text">
		                  <div class="card-text">
		                    <h4 class="card-title">Form Aspek</h4>
		                  </div>
		                </div>
		                
		                <div class="card-body ">
									<form class="form" method="post" action="modul/aspek/aksi_aspek.php?module=aspek&act=update">
										<div class="content">
										    
											<input type="hidden" name="id_aspek" placeholder="Kode Aspek" class='form-control' value="<?=$id ?>">
											<input type="hidden" name="id_spk" class='form-control' value="<?=$id_ ?>">
											<div class="input-group">
												<label class="col-sm-4 control-label text-left">Nama Aspek</label>
												<input type="text" name="nama_aspek" class='form-control' value="<?php echo $r[nama_aspek] ?>" required>
											</div>
											<div class="input-group">
												<label class="col-sm-4 control-label text-left">Nama Aspek</label>
												<input type="text" name="bobot" class='form-control' value="<?php echo $r[bobot] ?>" required>
											</div>
											<div class="input-group">
												<label class="col-sm-4 control-label text-left">Bobot Core</label>
												<input type="text" name="bobot_core" class='form-control' value="<?php echo $r[bobot_core] ?>" required>
											</div>
											<div class="input-group">
												<label class="col-sm-4 control-label text-left">Bobot Secondary</label>
												<input type="text" name="bobot_secondary" class='form-control' value="<?php echo $r[bobot_secondary] ?>" required>
											</div>
											<div class="input-group">
												<label class="col-sm-4 control-label text-left">Nama Singakt/Inisial</label>
												<input type="text" name="nama_singkat" class='form-control' value="<?php echo $r[nama_singkat] ?>" required>
											</div>
										</div>
										<div class="footer text-center">
											<input type="submit" value="Ubah" class="btn btn-primary pull-left">
											<input name="action" type="button" value="Cancel" onclick="window.history.back();" class="btn btn-danger pull-left">
										</div>
									</form>
								</div>
							</div>
						</div>
					<?php
					break;
				}
			?>
		</div>
</div>
				