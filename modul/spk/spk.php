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
					default :
						?>
						<div class="card-header card-header-rose card-header-text">
		                  <div class="card-text">
		                    <h4 class="card-title">Data SPK</h4>
		                  </div>
		                </div>

		                
		                <div class="card-body ">
							<?php
							if ($_SESSION["level"]=="admin") {
							?>
								<a href="?module=spk&act=tambah">
								<button class="btn  btn-youtube">
	                          		<i class="fa fa-plus-square-o"> </i> Tambah Data SPK
	                        	</button>
	                       	</a>
	                       	<?php
							}
							?>
							<table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
									<?php 
									$no=1;
									if($_SESSION["level"]=="admin")
									{
										$tampil = mysqli_query($koneksi,"SELECT * FROM spk INNER JOIN user ON user.id_user=spk.id_user WHERE status_verif=1 ORDER BY id_spk ASC");
									}else{
										$tampil = mysqli_query($koneksi,"SELECT * FROM spk WHERE id_user='$_SESSION[id_user]' ORDER BY id_spk ASC");
									?>
										<a href="?module=spk&act=tambah">
									<button class="btn  btn-youtube">
		                          		<i class="fa fa-plus-square-o"> </i> Tambah Data SPK
		                        	</button>
		                       		</a>
		                       		<?php
									}
								      echo "
								          <thead align='center'>
											<tr>
												<th width=''>No</th>
												<th>Nama Pembuat</th>
												<th>Tgl Dibuat</th>
												<th>Nama SPK</th>
												<th>Keterangan</th>
												<th>Jenis SPK</th>
												<th width='110px'>Aksi</th>
											</tr>
										</thead>
									<tbody>"; 
								    $no=1;
								    while ($r=mysqli_fetch_array($tampil)){
									   $a = $r['jenis'];
									   $b = $r['id_user'];
									   $id_user = $_SESSION['id_user'];
									//    echo $id_user;
									//    echo '<br>';
									//    echo $b; die;
									   if ($a == 0) {
										   $jenis = "Umum";
									   }else{
										   $jenis = "Privat";
									   }
								       echo "<tr>
								       			<td>$no</td>
												<td>$r[nama]</td>
												<td>$r[tanggal]</td>
												<td>$r[nama_spk]</td>
												<td width='200px'>$r[keterangan]</td>
												<td>$jenis</td>												
												<td width='110px'>";
										if ($b == $id_user) {
											?>
													 <center>
													 <a href="?module=spk&act=edit&id=<?php echo $r[id_spk] ?>" class="btn-sm btn-primary">
													 	<i class="fa fa-edit"></i>
													 </a>
													 <a href="modul/spk/aksi_spk.php?module=spk&act=hapus&id=<?php echo $r[id_spk] ?>" class="btn-sm btn-danger" onclick='return confirm("Anda yakin mau menghapus item ini ?")'>
													 	<i class="fa fa-trash"></i>
													 </a>
													 <!-- <a href='?module=spk&act=edit&id=<?php echo $r[id_spk] ?>' class='btn  btn-info btn-just-icon edit'><i class='material-icons' rel='tooltip' title='Edit'>edit</i></a>  
													 <a href='modul/spk/aksi_spk.php?module=spk&act=hapus&id=<?php echo $r[id_spk] ?>'  class='btn  btn-danger btn-just-icon remove' onclick='return confirm("Anda yakin mau menghapus item ini ?")'><i class='material-icons' rel='tooltip' title='Hapus'>close</i></a> -->
														
												   </center>
												   <?php 
										}else{
											echo "Tidak Memiliki Hak Akses Untuk Mengubah";
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

					case "operator" :
						?>
						<div class="card-header card-header-rose card-header-text">
		                  <div class="card-text">
		                    <h4 class="card-title">Data SPK Yang Pernah Dibuat</h4>
		                  </div>
		                </div>

		                
		                <div class="card-body ">
								<a href="?module=spk&act=tambah_op&id=<?=$_SESSION['id_user']?>">
								<button class="btn  btn-youtube">
	                          		<i class="fa fa-plus-square-o"> </i> Tambah Data SPK
	                        	</button>
	                       	</a>
							<table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
									<?php 
									$no=1;
									$tampil = mysqli_query($koneksi, "SELECT * FROM spk WHERE id_user='$_GET[id_user]'");
								      echo "
								          <thead align='center'>
											<tr>
												<th width=''>No</th>
												<th>Nama SPK</th>
												<th width='250px'>Keterangan</th>
												<th>Tgl Dibuat</th>
												<th>Jenis</th>
												<th>Status</th>
												<th width='110px'>Aksi</th>
											</tr>
										</thead>
									<tbody>"; 
								    $no=1;
								    while ($r=mysqli_fetch_array($tampil)){
									   $j = $r["jenis"];
									   $s = $r["status_verif"];
										if ($j == 0) {
										   $jenis = "Umum";
									   }else{
										   $jenis = "Private";
									   }

									   if ($s == 0) {
										   $status = "Menunggu Verifikasi Admin";
									   }elseif ($s == 1){
											$status = "Disetujui Admin";
									   }else{
											$status = "Ditolak Admin";
									   }

								       echo "<tr>
								       			<td>$no</td>
												<td><a href='?module=aspek&id=$r[id_spk]'>$r[nama_spk]</a></td>
												<td>$r[keterangan]</td>
												<td>$r[tanggal]</td>
												<td>$jenis</td>
												<td>$status</td>
												<td width='110px'>";
												?>
													 <center>
													 <a href="?module=spk&act=edit&id=<?php echo $r[id_spk] ?>" class="btn-sm btn-primary">
													 	<i class="fa fa-edit"></i>
													 </a>
													 <a href="modul/spk/aksi_spk.php?module=spk&act=hapus&id=<?php echo $r[id_spk] ?>" class="btn-sm btn-danger" onclick='return confirm("Anda yakin mau menghapus item ini? Aspek, Faktor, Bobot, Alternatif, Nilai, dan History Akan Terhapus!")'>
													 	<i class="fa fa-trash"></i>
													 </a>
													 <!-- <a href='?module=spk&act=edit&id=<?php echo $r[id_spk] ?>' class='btn  btn-info btn-just-icon edit'><i class='material-icons' rel='tooltip' title='Edit'>edit</i></a>  
													 <a href='modul/spk/aksi_spk.php?module=spk&act=hapus&id=<?php echo $r[id_spk] ?>'  class='btn  btn-danger btn-just-icon remove' onclick='return confirm("Anda yakin mau menghapus item ini ?")'><i class='material-icons' rel='tooltip' title='Hapus'>close</i></a> -->
														
												   </center>
												   <?php 
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

					case "verif_spk" :
						?>
						<div class="card-header card-header-rose card-header-text">
		                  <div class="card-text">
		                    <h4 class="card-title">Verifikasi Data SPK User</h4>
		                  </div>
		                </div>
		                <div class="card-body ">
							<table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
									<?php 
									$no=1;
									$tampil = mysqli_query($koneksi, "SELECT * FROM spk INNER JOIN user ON user.id_user=spk.id_user  WHERE spk.jenis=0 AND spk.id_user !='$_SESSION[id_user]' ORDER BY id_spk ASC");
								      echo "
								          <thead align='center'>
											<tr>
											<th width=''>No</th>
											<th>Nama Pembuat</th>
											<th>Tgl Dibuat</th>
											<th>Nama SPK</th>
											<th>Keterangan</th>
											<th>Jenis SPK</th>
											<th width='110px'>Aksi</th>
											</tr>
										</thead>
									<tbody>"; 
								    $no=1;
								    while ($r=mysqli_fetch_array($tampil)){
									   $j = $r["jenis"];
									   $s = $r["status_verif"];
										if ($j == 0) {
										   $jenis = "Umum";
									   }else{
										   $jenis = "Private";
									   }

									   if ($s == 0) {
										   $status = "Menunggu Verifikasi Admin";
									   }elseif ($s == 1){
											$status = "Disetujui";
									   }else{
											$status = "Ditolak";
									   }

								       echo "<tr>
								       			<td>$no</td>
												<td>$r[nama]</td>
												<td>$r[tanggal]</td>
												<td>$r[nama_spk]</td>
												<td>$r[keterangan]</td>
												<td>$jenis</td>
												<td width='110px'>";
												?>
													 <center>
													 <a href='?module=aspek&id=<?=$r[id_spk]?>'>Lihat Aspek</a><br>
													<?php
														if ($r[status_verif]==="0") {
															?>
														<a href='modul/spk/aksi_spk.php?module=spk&act=active&id=<?=$r[id_spk]?>&status=1' class='btn  btn-default btn-just-icon check'><i class='material-icons' rel='tooltip' title='Aktifasi'>check</i></a>
														<?php
														}elseif($r[status_verif]==="1"){
															?>
														<a href='modul/spk/aksi_spk.php?module=spk&act=active&id=<?=$r[id_spk]?>&status=2' class='btn  btn-danger btn-just-icon check'><i class='material-icons' rel='tooltip' title='Deaktifasi'>delete</i></a>
														<?php
														}else{
															?>
														<a href='modul/spk/aksi_spk.php?module=spk&act=active&id=<?=$r[id_spk]?>&status=1' class='btn  btn-success btn-just-icon check'><i class='material-icons' rel='tooltip' title='Deaktifasi'>check</i></a>
														<?php
														}													
													?>						
												   </center>
												   <?php 
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

					case "tambah":
					?>
						<div class="card-header card-header-rose card-header-text">
		                  <div class="card-text">
		                    <h4 class="card-title">Form SPK</h4>
		                  </div>
		                </div>
		                
		                <div class="card-body ">
									<form class="form" method="post" enctype="multipart/form-data" action="modul/spk/aksi_spk.php?module=spk&act=simpan">
										<div class="content">
										   
											<div class="input-group">
												<span class="input-group-addon">	
												</span>
												<input type="text" name="nama_spk" class='form-control' placeholder="Nama SPK ..." required>
											</div>
											<div class="input-group">
												<span class="input-group-addon">	
												</span>
												<input type="text" name="keterangan" class='form-control' placeholder="Keterangan SPK ..." required>
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

					case "tambah_op":
						if (isset($_GET["id"])) {
							$id = $_GET['id'];
						}
						?>
							<div class="card-header card-header-rose card-header-text">
							  <div class="card-text">
								<h4 class="card-title">Form SPK</h4>
							  </div>
							</div>
							
							<div class="card-body ">
										<form class="form" method="post" enctype="multipart/form-data" action="modul/spk/aksi_spk.php?module=spk&act=simpan&id=<?=$id?>">
											<div class="content">
												<div class="input-group">
													<span class="input-group-addon">	
													</span>
													<input type="text" name="nama_spk" class='form-control' placeholder="Nama SPK ..." required>
												</div>
												<div class="input-group">
													<span class="input-group-addon">	
													</span>
													<input type="text" name="keterangan" class='form-control' placeholder="Keterangan SPK ..." required>
												</div>
												<div class="input-group">
												<span class="input-group-addon">	
												</span>
												<select name="jenis" id="jenis" class="form-control" requried>
													<option value="">Pilih Jenis SPK ...</option>
													<option value="0"><b>Umum</b> [Bisa Digunakan Oleh User Lain, Dengan Persetujuan Awal Oleh Admin]</option>
													<option value="1"><b>Private</b> [Hanya Bisa Digunakan Oleh Anda, Tanpa Persetujuan Admin]</option>
												</select>
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

					$edit=mysqli_query($koneksi,"SELECT * FROM spk where id_spk='$_GET[id]'");
					$r=mysqli_fetch_array($edit);
					?>
						<div class="card-header card-header-rose card-header-text">
		                  <div class="card-text">
		                    <h4 class="card-title">Form SPK</h4>
		                  </div>
		                </div>
		                
		                <div class="card-body ">
									<form class="form" method="post" enctype="multipart/form-data" action="modul/spk/aksi_spk.php?module=spk&act=update">
										<input type="hidden" name="id_spk" value="<?php echo $r[id_spk] ?>">
										<div class="content">
											<div class="input-group">
												<label class="col-sm-4 control-label text-left">Nama SPK</label>
												<input type="text" name="nama_spk" placeholder="Nama SPK ..." class='form-control' value="<?php echo $r[nama_spk] ?>" required>
											</div>
										</div>

										<div class="content">
											<div class="input-group">
												<label class="col-sm-4 control-label text-left">Keterangan</label>
												<input type="text" name="keterangan" placeholder="Keterangan SPK ..." class='form-control' value="<?php echo $r[keterangan] ?>" required>
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
				