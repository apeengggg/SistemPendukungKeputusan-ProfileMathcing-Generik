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
		                    <h4 class="card-title">Data Alternatif</h4>
		                  </div>
		                </div>
		                
		                <div class="card-body ">
							<a href="?module=alternatif&act=tambah">
								<button class="btn  btn-youtube">
	                          		<i class="fa fa-plus-square-o"> </i> Tambah Data Alternatif
	                        	</button>
	                       	</a>
							<table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
									<?php 
									$no=1;
									if($_SESSION["level"]=="admin")
									{
										$tampil = mysqli_query($koneksi,"SELECT * FROM alternatif, spk WHERE alternatif.id_spk=spk.id_spk ORDER BY alternatif.id_alternatif ASC");
									}else{
										$tampil = mysqli_query($koneksi,"SELECT * FROM alternatif, spk WHERE alternatif.id_user='$_SESSION[id_user]' AND alternatif.id_spk=spk.id_spk ORDER BY id_alternatif ASC");
									}
								      echo "
								          <thead>
											<tr>
												<th width=''>No</th>
												<th>Nama Alternatif</th>
												<th>Nama SPK</th>
												<th>Aksi</th>
											</tr>
										</thead>
									<tbody>"; 
								    $no=1;
								    while ($r=mysqli_fetch_array($tampil)){
								       echo"
								       		<tr>
								       			<td>$no</td>
								       			<td>$r[nama_alternatif]</td>
												<td>$r[nama_spk]</td>
												<td width='10%'>";
												?>
													 <center>
													 <a href="?module=alternatif&act=edit&id=<?php echo $r['id_alternatif'] ?>" class="btn btn-info btn-just-icon edit"><i class="material-icons" rel="tooltip" title='Edit'>edit</i></a> 
													 <a href="modul/alternatif/aksi_alternatif.php?module=alternatif&act=hapus&id=<?php echo $r['id_alternatif'] ?>" class="btn btn-danger btn-just-icon remove" onclick="return confirm('Anda yakin mau menghapus item ini ?')"><i class="material-icons" rel="tooltip" title="Hapus">close</i></a>
														
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

						<?php
					break;

					case "tambah":
					?>
						<div class="card-header card-header-rose card-header-text">
		                  <div class="card-text">
		                    <h4 class="card-title">Form Alternatif</h4>
		                  </div>
		                </div>
		                
		                <div class="card-body ">
									<form class="form" method="post" action="modul/alternatif/aksi_alternatif.php?module=alternatif&act=simpan">
										<div class="content">
											<div class="input-group">
												<label class="col-sm-4 control-label text-left">SPK</label>
												<select name="id_spk" class='form-control' required>
													<option>Pilih SPK</option>
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
												<label class="col-sm-4 control-label text-left">Alternatif</label>
												<input type="text" name="nama_alternatif" class='form-control' placeholder="Nama Alternatif" required>
											</div>
										</div>
										<div class="footer text-center">
											<input type="submit" value="Simpan" class="btn btn-primary pull-left">
											<input name="action" type="button" value="Cancel" onclick="window.history.back();" class="btn btn-danger pull-left">
										</div>
									</form>
								</div>
					<?php
					break;

					case "edit" :

					$edit=mysqli_query($koneksi,"SELECT * FROM alternatif, spk where alternatif.id_alternatif='$_GET[id]' AND alternatif.id_spk=spk.id_spk");
					$r=mysqli_fetch_array($edit);
					?>
						<div class="card-header card-header-rose card-header-text">
		                  <div class="card-text">
		                    <h4 class="card-title">Form Alternatif</h4>
		                  </div>
		                </div>
		                
		                <div class="card-body ">
									<form class="form" method="post" action="modul/alternatif/aksi_alternatif.php?module=alternatif&act=update">
										<div class="content">
										    
											<input type="hidden" name="id_alternatif" placeholder="Kode Alternatif" class='form-control' value="<?php echo $r[id_alternatif] ?>">
											
											<div class="input-group">
												<label class="col-sm-4 control-label text-left">SPK</label>
												<select name="id_spk" class='form-control' required>
													<option value="<?php echo $r["id_spk"] ?>"><?php echo $r["nama_spk"] ?></option>
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
												<label class="col-sm-4 control-label text-left">Alternatif</label>
												<input type="text" name="nama_alternatif" placeholder="Nama" class='form-control' value="<?php echo $r[nama_alternatif] ?>" required>
											</div>
										</div>
										<div class="footer text-center">
											<input type="submit" value="Ubah" class="btn btn-primary pull-left">
											<input name="action" type="button" value="Cancel" onclick="window.history.back();" class="btn btn-danger pull-left">
										</div>
									</form>
								</div>
							
					<?php
					break;
				}
			?>
		</div>
</div>
</div>
				