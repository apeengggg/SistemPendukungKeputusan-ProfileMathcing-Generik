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
								<!-- <a href="?module=spk&act=tambah">
								<button class="btn  btn-youtube">
	                          		<i class="fa fa-plus-square-o"> </i> Tambah Data SPK
	                        	</button> -->
	                       	</a>
	                       	<?php
							}
							?>
							<table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
									<?php 
									$no=1;
									if($_SESSION["level"]=="admin")
									{
										$tampil = mysqli_query($koneksi,"SELECT * FROM spk ORDER BY id_spk ASC");
									}else{
										$tampil = mysqli_query($koneksi,"SELECT * FROM spk WHERE id_user='$_SESSION[id_user]' ORDER BY id_spk ASC");
									?>
	<!-- 									<a href="?module=spk&act=tambah">
									<button class="btn  btn-youtube">
		                          		<i class="fa fa-plus-square-o"> </i> Tambah Data SPK
		                        	</button>
		                       		</a> -->
		                       		<?php
									}
								      echo "
								          <thead>
											<tr>
												<th width=''>No</th>
												<th>Nama SPK</th>
												<th>Keterangan</th>
											</tr>
										</thead>
									<tbody>"; 
								    $no=1;
								    while ($r=mysqli_fetch_array($tampil)){
								       
								       echo "<tr>
								       			<td>$no</td>
												<td><a href=?module=aspek&act=view_aspek&id=$r[id_spk]>$r[nama_spk]</a></td>
												<td>$r[keterangan]</td>
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