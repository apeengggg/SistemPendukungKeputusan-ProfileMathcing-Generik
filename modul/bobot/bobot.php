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
					if (isset($_GET['id'])) {
						$id = $_GET['id'];
					}
					$query = mysqli_query($koneksi, "SELECT * FROM spk WHERE id_spk='$id'");
					$result = mysqli_fetch_array($query);
					$ra = $result['id_user'];
					$u = $_SESSION['id_user'];
						?>
						<div class="card-header card-header-rose card-header-text">
		                  <div class="card-text">
		                    <h4 class="card-title">Data Bobot</h4>
		                  </div>
		                </div>
						<div class="card-body ">
						<a href="?module=bobot&act=tambah&id=<?=$id?>">
								<button class="btn  btn-youtube">
	                          		<i class="fa fa-plus-square-o"> </i> Tambah Data Bobot
	                        	</button>
	                       	</a>
							<table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
									<?php 
									$no=1;
									if($_SESSION["level"]=="admin")
										{
											if (isset($_GET['id'])) {
												$id = $_GET['id'];
											}
											$tampil=mysqli_query($koneksi, "SELECT * FROM bobot");
										}else{
											$tampil=mysqli_query($koneksi, "SELECT * FROM bobot");
										}
								      echo "
								          <thead>
											<tr>
												<th width=''>No</th>
												<th>Nama SPK</th>
												<th>Selisih</th>
												<th>Bobot</th>
												<th>Keterangan</th>
												
												<th>Aksi</th>
											</tr>
										</thead>
									<tbody>"; 
								    $no=1;
								    while ($r=mysqli_fetch_array($tampil)){
								       
								       echo "<tr>
								       			<td>$no</td>
								       			<td>$r[nama_spk]</td>
								       			<td>$r[selisih]</td>
												<td>$r[bobot]</td>
												<td>$r[keterangan]</td>
												
												<td width='10%'>";
												?>
													<center>
													<a href="modul/bobot/aksi_bobot.php?module=bobot&act=hapus&id=<?php echo $r[id_bobot]?>&idspk=<?=$r[id_spk]?>" class="btn-sm btn-danger" onclick='return confirm("Anda yakin mau menghapus item ini ?")'>
														<i class="fa fa-trash"></i>
													</a>
													<!-- <a href='modul/bobot/aksi_bobot.php?module=bobot&act=hapus&id=<?php echo $r[id_bobot]?>&idspk=<?=$r[id_spk]?>' class='btn  btn-danger btn-just-icon remove' onclick='return confirm("Anda yakin mau menghapus item ini ?")'><i class='material-icons' rel='tooltip' title='Hapus'>close</i></a> -->
														
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
					if (isset($_GET['id'])) {
						$id = $_GET['id'];
					}
					?>
						<div class="card-header card-header-rose card-header-text">
		                  <div class="card-text">
		                    <h4 class="card-title">Form Bobot</h4>
		                  </div>
		                </div>
		                
		                <div class="card-body ">
									<form class="form" method="post" action="modul/bobot/aksi_bobot.php?module=bobot&act=simpan">
										<div class="content">
										    <div class="input-group">
												<input type="hidden" name="id_spk" class='form-control' value="<?=$id?>" required>
											</div>
											<label for="keterangan">Bobot</label>
											<select name="keterangan" id="keterangan" class='form-control' required>
												<option value="">Pilih Keterangan ...</option>
												<option value="0">-4 [Kompetensi Individu Kekurangan 4 Level/Tingkat]</option>
												<option value="1">-3 [Kompetensi Individu Kekurangan 3 Level/Tingkat]</option>
												<option value="2">-2 [Kompetensi Individu Kekurangan 2 Level/Tingkat]</option>
												<option value="3">-1 [Kompetensi Individu Kekurangan 1 Level/Tingkat]</option>
												<option value="4">0 [Tidak Ada Selisih (Sesuai Apa Yang Dibutuhkan) ]</option>
												<option value="5">4 [Kompetensi Individu Kelebihan 4 Level/Tingkat]</option>
												<option value="6">3 [Kompetensi Individu Kelebihan 3 Level/Tingkat]</option>
												<option value="7">2 [Kompetensi Individu Kelebihan 2 Level/Tingkat]</option>
												<option value="8">1 [Kompetensi Individu Kelebihan 1 Level/Tingkat]</option>

											</select>
											
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

					$edit=mysqli_query($koneksi,"SELECT bobot.*, spk.nama_spk FROM bobot, spk where bobot.id_bobot='$_GET[id]' AND bobot.id_spk=spk.id_spk");
					$r=mysqli_fetch_array($edit);
					?>
						<div class="card-header card-header-rose card-header-text">
		                  <div class="card-text">
		                    <h4 class="card-title">Form Bobot</h4>
		                  </div>
		                </div>
		                
		                <div class="card-body ">
									<form class="form" method="post" action="modul/bobot/aksi_bobot.php?module=bobot&act=update">
										<div class="content">
										    
											<input type="hidden" name="id_bobot" placeholder="Kode Bobot" class='form-control' value="<?php echo $r[id_bobot] ?>">
											
											<div class="input-group">
												<label class="col-sm-4 control-label text-left">SPK</label>
												<select name="id_spk" class='form-control' required>
													<option value="<?php echo $r[id_spk] ?>"><?php echo $r[nama_spk] ?></option>
													<?php  
													$sql="SELECT * FROM spk WHERE id_user='$_SESSION[id_user]' ORDER BY id_spk ASC";
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
												<label class="col-sm-4 control-label text-left">Selisih</label>
												<input type="text" name="selisih" placeholder="Selisih" class='form-control' value="<?php echo $r[selisih] ?>" required>
											</div>
											<div class="input-group">
												<label class="col-sm-4 control-label text-left">Bobot</label>
												<input type="text" name="bobot" class='form-control' value="<?php echo $r[bobot] ?>" required>
											</div>
											<div class="input-group">
												<label class="col-sm-4 control-label text-left">Keterangan</label>
												<input type="text" name="keterangan" class='form-control' value="<?php echo $r[keterangan] ?>" required>
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
				