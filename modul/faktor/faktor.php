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
							if (isset($_GET['id_spk'])) {
								$id_ = $_GET['id_spk'];
							}
							// ambil id_user
							$query = mysqli_query($koneksi, "SELECT * FROM spk WHERE id_spk='$id_' ");
							$result = mysqli_fetch_array($query);
							$ra = $result['id_user'];
							$u = $_SESSION['id_user'];

							// cek apakah sudah ada faktor core
							$cekfaktor = mysqli_query($koneksi, "SELECT * FROM faktor WHERE aspek='$id' AND jenis=1");
							$result1 = mysqli_num_rows($cekfaktor);
							// cek apakah sudah ada faktor secondary
							$cekfaktor1 = mysqli_query($koneksi, "SELECT * FROM faktor WHERE aspek='$id' AND jenis=2");
							$result2 = mysqli_num_rows($cekfaktor1);
								?>
									<div class="card-header card-header-rose card-header-text">
					                  <div class="card-text">
					                    <h4 class="card-title">Data Faktor</h4>
					                  </div>
					                </div>
								<?php
								if ($ra === $u) {
								if ($result1===0) {
									?>
									<br>
									<div class="alert alert-danger" role="alert">
											* Anda Belum Memasukan Faktor Dengan Jenis <b>CORE</b>
									</div>
									<?php
								}
								if ($result2===0) {
									?>
									<br>
									<div class="alert alert-danger" role="alert">
										* Anda Belum Memasukan Faktor Dengan Jenis <b>SECONDARY</b>
									</div>
									<?php
								}
								?>
					                
					                <div class="card-body ">
												<?php
									if (isset($_GET["jenis"])) {
									?>
										<a href="?module=aspek&id=<?=$id_?>&jenis=spkbaru">
											<button class="btn  btn-warning">
												<< Kembali Tambah Aspek
											</button>
										</a>
										<a href="?module=faktor&act=tambah_detail&id_aspek=<?=$id?>&id_spk=<?=$id_?>&jenis=baru">
											<button class="btn  btn-youtube">
					                          <i class="fa fa-plus-square-o"> </i> Tambah Data Faktor
					                        </button>
										</a>
										<!-- <a href="?module=bobot&id=<?=$id_?>&jenis=baru">
											<button class="btn  btn-primary">
												Lanjut Isi Bobot >>
											</button>
										</a> -->
									<?php
									}else{
										?>
										<a href="?module=aspek&id=<?=$id_?>">
											<button class="btn  btn-warning">
												<< Kembali Aspek
											</button>
										</a>
										<a href="?module=faktor&act=tambah_detail&id_aspek=<?=$id?>&id_spk=<?=$id_?>">
											<button class="btn  btn-youtube">
					                          <i class="fa fa-plus-square-o"> </i> Tambah Data Faktor
					                        </button>
										</a>

									<?php
									}		
								}else{
									echo '<div class="card-body ">';
								}	
									?>
										<table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
											<?php 
											$no=1;
											if($_SESSION["level"]=="admin")
											{
												if (isset($_GET['id'])) {
													$id = $_GET['id'];
												}
												$tampil = mysqli_query($koneksi,"SELECT spk.nama_spk, aspek.nama_aspek, faktor.nama_faktor, faktor.target, faktor.jenis, faktor.id_faktor, aspek.id_aspek, spk.id_spk FROM faktor INNER JOIN aspek ON aspek.id_aspek=faktor.aspek INNER JOIN spk ON spk.id_spk=aspek.id_spk
												WHERE faktor.aspek='$id'");
											}else{
												$tampil = mysqli_query($koneksi,"SELECT spk.nama_spk, aspek.nama_aspek, faktor.nama_faktor, faktor.target, faktor.jenis, faktor.id_faktor, aspek.id_aspek, spk.id_spk FROM faktor INNER JOIN aspek ON aspek.id_aspek=faktor.aspek INNER JOIN spk ON spk.id_spk=aspek.id_spk
												WHERE faktor.aspek='$id'");
											}
										      echo "
										          <thead>
													<tr>
														<th>No</th>
														<th>SPK</th>
														<th>Aspek</th>
														<th>Nama Faktor</th>	
														<th>Nilai Target</th>
														<th>Jenis</th>
														<th>Aksi</th>
													</tr>
												</thead>
											<tbody>"; 
										    $no=1;
										    while ($r=mysqli_fetch_array($tampil)){
											   $faktor = $r['jenis'];
											//    echo $faktor; die;
												if ($faktor==1) {
										       		$jenis="Core";
										       }else{
										       		$jenis="Secondary";
										       }
										       echo "<tr>
										       			<td>$no</td>
										       			<td>$r[nama_spk]</td>
										       			<td>$r[nama_aspek]</td>
										       			<td>$r[nama_faktor]</td>
										       			<td width='90px'>$r[target]</td>
														<td width='90px'>$jenis</td>
														<td width='110px'>";
											if ($ra === $u) {
												?>
												 <center>
															 <!-- edit -->
															 <a href="?module=faktor&act=edit&id_faktor=<?php echo $r[id_faktor] ?>&id_aspek=<?php echo $r[id_aspek] ?>&id_spk=<?php echo $r[id_spk] ?>"
															 class="btn-sm btn-info">
															 <i class="fa fa-edit"></i>
															 </a>
															 <!-- hapus -->
															 <a href="modul/faktor/aksi_faktor.php?module=faktor&act=hapus&id_faktor=<?php echo $r[id_faktor] ?>&id_aspek=<?php echo $r[id_aspek] ?>&id_spk=<?php echo $r[id_spk] ?>" 
															 class="btn-sm btn-danger" 
															 onclick='return confirm("Anda yakin mau menghapus item ini?")'>
															 <i class="fa fa-trash"></i>
															 </a>
															 <!-- <a href="?module=faktor&act=edit&id_faktor=<?php echo $r[id_faktor] ?>&id_aspek=<?php echo $r[id_aspek] ?>&id_spk=<?php echo $r[id_spk] ?>" class='btn  btn-info btn-just-icon edit'><i class='material-icons' rel='tooltip' title='Edit'>edit</i></a>   -->
															 <!-- <a href='modul/faktor/aksi_faktor.php?module=faktor&act=hapus&id_faktor=<?php echo $r[id_faktor] ?>&id_aspek=<?php echo $r[id_aspek] ?>&id_spk=<?php echo $r[id_spk] ?>' class='btn  btn-danger btn-just-icon remove'><i class='material-icons' rel='tooltip' title='Hapus' onclick='return confirm('Anda yakin mau menghapus item ini ?')">close</i></a> -->
																
														   </center>
												<?php
											}else{
												echo "Tidak Memiliki Hak Akses";
											}
											?>
											
															
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
							if (isset($_GET['id_aspek'])) {
								$id = $_GET['id_aspek'];
							}
							if (isset($_GET['id_spk'])) {
								$id_ = $_GET['id_spk'];
							}
							?>
								<div class="card-header card-header-rose card-header-text">
					                  <div class="card-text">
					                    <h4 class="card-title">Data Faktor</h4>
					                  </div>
					                </div>
					                
					                <div class="card-body ">
											<?php
											if (isset($_GET['jenis'])) {
												?>
												<form class="form" method="post" action="modul/faktor/aksi_faktor.php?module=faktor&act=simpan&jenis=baru">
											<?php
											}else{
												?>
												<form class="form" method="post" action="modul/faktor/aksi_faktor.php?module=faktor&act=simpan">
											<?php
											}	
											?>
												<div class="content">
													<input type="hidden" name="id_aspek" value="<?= $id ?>">
													<input type="hidden" name="id_spk" value="<?= $id_ ?>">
													<div class="input-group">
														<label class="col-sm-4 control-label text-left">Nama Faktor</label>
														<input type="text" name="nama_faktor"  class='form-control' placeholder="Nama Faktor" required>
													</div>
													<div class="input-group">
														<label class="col-sm-4 control-label text-left">Target</label>
														<input type="number" name="target" class="form-control" min="1" max="5" placeholder="Nilai 1-5... 1=Sangat Kurang 2=Kurang 3=cukup 4=Baik 5=Sangat Baik" required>
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
							$edit=mysqli_query($koneksi,"SELECT f.id_faktor, a.id_aspek, s.id_spk, f.nama_faktor, f.target, f.jenis FROM faktor f INNER JOIN aspek a ON a.id_aspek=f.aspek INNER JOIN spk s ON s.id_spk=a.id_spk WHERE f.id_faktor='$_GET[id_faktor]'");
							$r=mysqli_fetch_array($edit);
							?>
								<div class="card-header card-header-rose card-header-text">
					                  <div class="card-text">
					                    <h4 class="card-title">Form Faktor</h4>
					                  </div>
					                </div>
					                
					                <div class="card-body ">
											<form class="form" method="post" action="modul/faktor/aksi_faktor.php?module=faktor&act=update">
												<input type="hidden" name="id_faktor" placeholder="Kode Produk" class='form-control' value="<?php echo $r['id_faktor'] ?>" readonly>
												<input type="hidden" name="id_spk" placeholder="Kode Produk" class='form-control' value="<?php echo $r['id_spk'] ?>" readonly>
												<input type="hidden" name="id_aspek" placeholder="Kode Produk" class='form-control' value="<?php echo $r['id_aspek'] ?>" readonly>
												<div class="content">
													<!-- <div class="input-group">
														<label class="col-sm-4 control-label text-left">Nama SPK</label>
														<input type="text" name="nama_aspek" placeholder="" class='form-control' value="<?php echo $r[nama_spk] ?>" required readonly>
													</div> -->
													<div class="input-group">
														<label class="col-sm-4 control-label text-left">Nama Faktor</label>
														<input type="text" name="nama_faktor" value="<?php echo $r['nama_faktor'] ?>" class='form-control' placeholder="Nama Faktor" required>
													</div>
													<div class="input-group">
														<label class="col-sm-4 control-label text-left">Target</label>
														<input type="number" name="target" value="<?php echo $r['target'] ?>" class='form-control' placeholder="target" min='1' max='5' required>
														<!-- <select name="target" class='form-control' required>
								                            <option value='<?=$r['target']?>'><?=$r['target']?></option>
								                            <option value='1'>1 = Sangat Kurang</option>
								                            <option value='2'>2 = Kurang</option>
								                            <option value='3'>3 = Cukup</option>
								                            <option value='4'>4 = Baik</option>
								                            <option value='5'>5 = Sangat Baik</option>
														</select> -->
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
						                                	<option value="<?=$r[jenis]?>""><?=$jenis?></option>
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
			  
			