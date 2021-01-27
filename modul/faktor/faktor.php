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
					                    <h4 class="card-title">Data Faktor</h4>
					                  </div>
					                </div>
					                
					                <div class="card-body ">
										<a href="?module=faktor&act=tambah">
											<button class="btn  btn-youtube">
					                          <i class="fa fa-plus-square-o"> </i> Tambah Data Faktor
					                        </button></a>
										<table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
											<?php 
											$no=1;
											if($_SESSION["level"]=="admin")
											{
												$tampil = mysqli_query($koneksi,"SELECT * FROM faktor, aspek, spk  
													WHERE faktor.aspek=aspek.id_aspek  
													AND aspek.id_spk=spk.id_spk 
													ORDER BY spk.id_spk, aspek, id_aspek, faktor.id_faktor ASC");
											}else{
												$tampil = mysqli_query($koneksi,"SELECT * FROM faktor, aspek, spk 
													WHERE faktor.aspek=aspek.id_aspek 
													AND faktor.id_user='$_SESSION[id_user]' 
													AND aspek.id_spk=spk.id_spk 
													ORDER BY spk.id_spk, aspek, id_aspek, faktor.id_faktor ASC");
											}
										      echo "
										          <thead>
													<tr>
														<th>No</th>
														<th>SPK</th>
														<th>Aspek</th>
														<th>Nama Faktor</th>	
														<th>Target</th>
														<th>Jenis</th>
														<th>Aksi</th>
													</tr>
												</thead>
											<tbody>"; 
										    $no=1;
										    while ($r=mysqli_fetch_array($tampil)){
										       if ($r['jenis']==1) {
										       		$jenis="Core";
										       }else{
										       		$jenis="Secondary";
										       }
										       echo "<tr>
										       			<td>$no</td>
										       			<td>$r[nama_spk]</td>
										       			<td>$r[nama_aspek]</td>
										       			<td>$r[nama_faktor]</td>
										       			<td>$r[target]</td>
														<td>$jenis</td>
														<td width='10%'>";
														?>
															 <center>
															 <a href='?module=faktor&act=edit&id=<?php echo $r[id_faktor] ?>'  class='btn  btn-info btn-just-icon edit'><i class='material-icons' rel='tooltip' title='Edit'>edit</i></a>  
															 <a href='modul/faktor/aksi_faktor.php?module=faktor&act=hapus&id=<?php echo $r[id_faktor] ?>' class='btn  btn-danger btn-just-icon remove'><i class='material-icons' rel='tooltip' title='Hapus' onclick='return confirm("Anda yakin mau menghapus item ini ?")'>close</i></a>
																
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
					                    <h4 class="card-title">Data Faktor</h4>
					                  </div>
					                </div>
					                
					                <div class="card-body ">
											<form class="form" method="post" action="?module=faktor&act=tambah_detail">
												<div class="content">
													 <div class="input-group">
													 	<label class="col-sm-4 control-label text-left">Nama SPK</label>
														<select name="spk" id="spk" class='form-control' required>
												          <option value="">Pilih</option>
												          
												          <?php
												          // Buat query untuk menampilkan semua data spk
												          if($_SESSION["level"]=="admin")
												          {
												          	$sql = mysqli_query($koneksi, "SELECT * FROM spk ORDER BY id_spk");
												          }else{
												          	$sql = mysqli_query($koneksi, "SELECT * FROM spk WHERE id_user='$_SESSION[id_user]' ORDER BY id_spk");
												          }
												          while($row = mysqli_fetch_array($sql)){ // Ambil semua data dari hasil eksekusi $sql
												            echo "<option value='".$row['id_spk']."'>".$row['nama_spk']."</option>";
												          }
												          ?>
												        </select>
												    </div>
												<div class="footer text-center">
													<input type="submit" value="Submit" class="btn btn-primary pull-left">
													<input name="action" type="button" value="Cancel" onclick="window.history.back();" class="btn btn-danger pull-left">
												</div>
											</form>
										</div>
									</div>
								</div>
							<?php
							break;
							case "tambah_detail":
							?>
								<div class="card-header card-header-rose card-header-text">
					                  <div class="card-text">
					                    <h4 class="card-title">Data Faktor</h4>
					                  </div>
					                </div>
					                
					                <div class="card-body ">
											<form class="form" method="post" action="modul/faktor/aksi_faktor.php?module=faktor&act=simpan">
												<div class="content">
													<input type="hidden" name="id_spk" value="<?php echo $_POST['spk'] ?>">
												    <div class="input-group">
														<label class="col-sm-4 control-label text-left">Nama Aspek</label>
														 <!--aspek-->
			                                            <select id="id_aspek" name="id_aspek" class='form-control'>
			                                                <option value="">Pilih</option>
			                                                <?php
			                                                    $query = mysqli_query($koneksi, "SELECT * FROM aspek WHERE id_spk='$_POST[spk]' ORDER BY nama_aspek");
                     												 while ($row = mysqli_fetch_array($query)) { ?>

			                                                    <option id="id_aspek" class="<?php echo $row['id_spk']; ?>" value="<?php echo $row['id_aspek']; ?>">
			                                                        <?php echo $row['nama_aspek']; ?>
			                                                    </option>

			                                                <?php } ?>
			                                            </select>
													</div>
													<div class="input-group">
														<label class="col-sm-4 control-label text-left">Nama Faktor</label>
														<input type="text" name="nama_faktor"  class='form-control' placeholder="Nama Faktor" required>
													</div>
													<div class="input-group">
														<label class="col-sm-4 control-label text-left">Target</label>
														<input type="text" name="target" class='form-control' placeholder="Target" required>
													</div>
													<div class="input-group">
														<label class="col-sm-4 control-label text-left">Jenis</label>
														<select name="jenis" class='form-control' required>
															<option value=''>Pilih Jenis</option>
								                            <option value='1'>Core</option>
								                            <option value='2'>Secondary</option>
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

							$edit=mysqli_query($koneksi,"SELECT * FROM faktor, aspek, spk where faktor.id_faktor='$_GET[id]' AND faktor.aspek=aspek.id_aspek AND aspek.id_spk=spk.id_spk");
							$r=mysqli_fetch_array($edit);
							?>
								<div class="card-header card-header-rose card-header-text">
					                  <div class="card-text">
					                    <h4 class="card-title">Form Faktor</h4>
					                  </div>
					                </div>
					                
					                <div class="card-body ">
											<form class="form" method="post" action="modul/faktor/aksi_faktor.php?module=faktor&act=update">
												<input type="hidden" name="id_faktor" placeholder="Kode Produk" class='form-control' value="<?php echo $r[id_faktor] ?>" readonly>
												<input type="hidden" name="id_spk" placeholder="Kode Produk" class='form-control' value="<?php echo $r[id_spk] ?>" readonly>
												<div class="content">
													<div class="input-group">
														<label class="col-sm-4 control-label text-left">Nama SPK</label>
														<input type="text" name="nama_aspek" placeholder="" class='form-control' value="<?php echo $r[nama_spk] ?>" required readonly>
													</div>
												    <div class="input-group">
														<label class="col-sm-4 control-label text-left">Nama Aspek</label>
														 <!--aspek-->
			                                            <select id="id_aspek" name="id_aspek" class='form-control'>
			                                                <option value="<?php echo $r['id_aspek'] ?>"><?php echo $r["nama_aspek"] ?></option>
			                                                <?php
			                                                    $query = mysqli_query($koneksi, "SELECT * FROM aspek WHERE aspek.id_spk='$r[id_spk]' ORDER BY nama_aspek");
			                                                    while ($row = mysqli_fetch_array($query)) { ?>

			                                                    <option id="id_aspek" class="<?php echo $row['id_spk']; ?>" value="<?php echo $row['id_aspek']; ?>">
			                                                        <?php echo $row['nama_aspek']; ?>
			                                                    </option>

			                                                <?php } ?>
			                                            </select>
													</div>
													<div class="input-group">
														<label class="col-sm-4 control-label text-left">Nama Faktor</label>
														<input type="text" name="nama_faktor" value="<?php echo $r['nama_faktor'] ?>" class='form-control' placeholder="Nama Faktor" required>
													</div>
													<div class="input-group">
														<label class="col-sm-4 control-label text-left">Target</label>
														<input type="text" name="target" placeholder="" class='form-control' value="<?php echo $r[target] ?>" required>
													</div>
													<div class="input-group">
														<label class="col-sm-4 control-label text-left">Jenis</label>
														<select name="jenis" class='form-control' required>
															<?php  
						                                	if($r["jenis"]==1){
						                                		$jenis="Core";
						                                	}elseif($r["jenis"]==2){
						                                		$jenis="Secondary";
						                                	}
						                                ?>
						                                	<option value="<?php echo $r['jenis'] ?>"><?php echo $jenis ?></option>
						                                    <option value="1">Core</option>
						                                    <option value="2">Secondary</option>
						                                </select>
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
			  
			