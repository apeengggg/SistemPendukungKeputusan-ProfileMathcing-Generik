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
						?>
						<div class="card-header card-header-rose card-header-text">
		                  <div class="card-text">
		                    <h4 class="card-title">Data Aspek</h4>
		                  </div>
		                </div>
		                
		                <div class="card-body ">
							<a href="?module=aspek&act=tambah">
								<button class="btn  btn-youtube">
	                          		<i class="fa fa-plus-square-o"> </i> Tambah Data Aspek
	                        	</button>
	                       	</a>
	                       <div class="box-body">
          				<div class="alert alert-success" role="alert">
         				 		Persentase Aspek Harus 100% dari Jumlah Aspek, dan Jumlah Presentase Bobot Core dan Bobot Secondary Harus 100%
         				 </div>
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
								       
								       echo "<tr>
								       			<td>$no</td>
								       			<td>$r[nama_aspek]</td>
												<td>$r[bobot]</td>
												<td>$r[bobot_core]</td>
												<td>$r[bobot_secondary]</td>
												<td>$r[nama_singkat]</td>
												<td width='10%'>";
												?>
													 <center>
													 <a href='?module=aspek&act=edit&id=<?php echo $r[id_aspek] ?>' class='btn btn-info btn-just-icon edit'><i class='material-icons' rel='tooltip' title='Edit'>edit</i></a> 
													 <a href='modul/aspek/aksi_aspek.php?module=aspek&act=hapus&id=<?php echo $r[id_aspek] ?>' class='btn btn-danger btn-just-icon remove' onclick='return confirm("Anda yakin mau menghapus item ini ?")'><i class='material-icons' rel='tooltip' title='Hapus'>close</i></a>
														
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
								       			<td><a href=?module=faktor&id=$r[id_aspek]>$r[nama_aspek]</a>
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
						?>
				<?php
					break;

					case "tambah":
					?>
						<div class="card-header card-header-rose card-header-text">
		                  <div class="card-text">
		                    <h4 class="card-title">Form Aspek</h4>
		                  </div>
		                </div>
		                
		                <div class="card-body ">
									<form class="form" method="post" action="modul/aspek/aksi_aspek.php?module=aspek&act=simpan">
										<div class="content">
											<div class="input-group">
												<label class="col-sm-4 control-label text-left">SPK</label>
												<select name="id_spk" class='form-control' required>
													<option value="">Pilih SPK</option>
													<?php  
													if($_SESSION["level"]=='admin')
													{
														$sql="SELECT * FROM spk ORDER BY id_spk ASC";
													}else{
														$sql="SELECT * FROM spk WHERE id_user='$_SESSION[id_user]' ORDER BY id_spk ASC";
													}
													$query=mysqli_query($koneksi,$sql);
													while($data=mysqli_fetch_array($query))
													{
														?>
															<option value="<?php echo $data["id_spk"] ?>"><?php echo $data["nama_spk"] ?></option>
														<?php 																		}
													?>
												</select>
											</div>
										    <div class="input-group">
												<label class="col-sm-4 control-label text-left">Nama Aspek</label>
												<input type="text" name="nama_aspek" class='form-control' placeholder="Nama Aspek" required>
											</div>
		
											<div class="input-group">
												<label class="col-sm-4 control-label text-left">Bobot</label>
												<input type="number" name="bobot" class='form-control' placeholder="Bobot" required>
											</div>
											<div class="input-group">
												<label class="col-sm-4 control-label text-left">Bobot Core</label>
												<input type="number" name="bobot_core" class='form-control' placeholder="Bobot Core" required>
											</div>
											<div class="input-group">
												<label class="col-sm-4 control-label text-left">Bobot Secondary</label>
												<input type="number" name="bobot_secondary" class='form-control' placeholder="Bobot Secondary" required>
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
										    
											<input type="hidden" name="id_aspek" placeholder="Kode Aspek" class='form-control' value="<?php echo $r[id_aspek] ?>">
											
											
											<div class="input-group">
												<label class="col-sm-4 control-label text-left">SPK</label>
												<select name="id_spk" class='form-control' required>
													<option value="<?php echo $r[id_spk] ?>"><?php echo $r[nama_spk] ?></option>
													<?php  
													if($_SESSION["level"]=='admin')
													{
														$sql="SELECT * FROM spk ORDER BY id_spk ASC";
													}else{
														$sql="SELECT * FROM spk WHERE id_user='$_SESSION[id_user]' ORDER BY id_spk ASC";
													}
													$query=mysqli_query($koneksi,$sql);
													while($data=mysqli_fetch_array($query))
													{
														?>
															<option value="<?php echo $data["id_spk"] ?>"><?php echo $data["nama_spk"] ?></option>
														<?php 																		}
													?>
												</select>
											</div>
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
				