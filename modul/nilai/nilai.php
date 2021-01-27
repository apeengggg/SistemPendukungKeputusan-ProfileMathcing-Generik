<?php 
include "config/koneksi.php";
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
		                    <h4 class="card-title">Form Nilai</h4>
		                  </div>
		                </div>
		                
		                <div class="card-body ">
									<table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
									<?php 
									$no=1;
									if($_SESSION["level"]=="admin")
									{
										$tampil = mysqli_query($koneksi,"SELECT * FROM spk");
									}else{
										$tampil = mysqli_query($koneksi,"SELECT * FROM spk  WHERE spk.id_user='$_SESSION[id_user]'");
									}
								      echo "
								          <thead>
											<tr>
												<th width=''>No</th>
												<th>Nama SPK</th>
												<th>Aksi</th>
											</tr>
										</thead>
									<tbody>"; 
								    $no=1;
								    while ($r=mysqli_fetch_array($tampil)){
								       
								       echo "<tr>
								       			<td>$no</td>
								       			<td>
								       			<a href='?module=nilai&act=detail_nilai&id_spk=$r[id_spk]&nama_spk=$r[nama_spk]'>$r[nama_spk]</a>
								       			</td>
								       			<td width='10%'>
													 <center>
													 <a href='?module=nilai&act=detail_nilai&id_spk=$r[id_spk]' class='btn btn-info btn-just-icon edit'><i class='material-icons' rel='tooltip' title='Isi Nilai Aternatif'>edit</i></a> ";
													 /*<a href='modul/aspek/aksi_aspek.php?module=aspek&act=hapus&id=$r[id_aspek]' class='btn btn-danger btn-just-icon remove'><i class='material-icons' rel='tooltip' title='Hapus'>close</i></a>	*/
													 echo "
												   </center>
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

					case "detail_nilai" :
						?>
						<div class="card-header card-header-rose card-header-text">
		                  <div class="card-text">
		                    <h4 class="card-title">Data Nilai</h4>
		                  </div>
		                </div>
		                
		                <div class="card-body ">
							<a href="?module=nilai&act=tambah">
								<button class="btn  btn-youtube">
	                          		<i class="fa fa-plus-square-o"> </i> Tambah Data Nilai
	                        	</button>
	                       	</a>
							<table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
									<?php 
									$no=1;
									if($_SESSION["level"]=="admin")
									{
										$tampil = mysqli_query($koneksi,"SELECT * FROM nilai, spk, aspek, faktor, alternatif 
											WHERE nilai.faktor=faktor.id_faktor 
											AND nilai.id_alternatif=alternatif.id_alternatif
											AND spk.id_spk=faktor.id_spk 
											AND spk.id_spk=alternatif.id_spk
											AND aspek.id_spk=spk.id_spk
											AND aspek.id_aspek=faktor.aspek
											AND nilai.id_spk='$_GET[id_spk]' 
											ORDER BY alternatif.id_alternatif, aspek.id_aspek, faktor.id_faktor  ASC") or die(mysqli_error($koneksi));
									}else{
										$tampil = mysqli_query($koneksi,"SELECT * FROM nilai, spk, aspek, faktor, alternatif 
											WHERE nilai.faktor=faktor.id_faktor 
											AND nilai.id_alternatif=alternatif.id_alternatif
											AND spk.id_spk=faktor.id_spk 
											AND spk.id_spk=alternatif.id_spk
											AND spk.id_spk=alternatif.id_spk
											AND aspek.id_spk=spk.id_spk
											AND aspek.id_aspek=faktor.aspek
											AND nilai.id_user='$_SESSION[id_user]' 
											AND nilai.id_spk='$_GET[id_spk]' 
											ORDER BY alternatif.id_alternatif, aspek.id_aspek, faktor.id_faktor  ASC") or die(mysqli_error($koneksi));
									}
								      echo "
								          <thead>
											<tr>
												<th width=''>No</th>
												<th>Nama Alternatif</th>
												<th>Nama SPK</th>
												<th>Nama Aspek</th>
												<th>Faktor</th>
												<th>Nilai</th>
												<th>Aksi</th>
											</tr>
										</thead>
									<tbody>"; 
								    $no=1;
								    while ($r=mysqli_fetch_array($tampil)){
								       
								       echo "<tr>
								       			<td>$no</td>
								       			<td>$r[nama_alternatif]</td>
								       			<td>$r[nama_spk]</td>
								       			<td>$r[nama_aspek]</td>
								       			<td>$r[nama_faktor]</td>
												<td>$r[nilai]</td><td width='10%'>
													 <center>
													 <a href='?module=nilai&act=edit&id=$r[id_nilai]' class='btn btn-info btn-just-icon edit'><i class='material-icons' rel='tooltip' title='Edit'>edit</i>
													<a href='modul/nilai/aksi_nilai.php?module=nilai&act=hapus&id=$r[id_aspek]' class='btn btn-danger btn-just-icon remove'><i class='material-icons' rel='tooltip' title='Hapus'>close</i>
													 </a> 											
												   </center>
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
		                    <h4 class="card-title">Form Nilai</h4>
		                  </div>
		                </div>
		                
		                <div class="card-body ">
									<table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
									<?php 
									$no=1;
									if($_SESSION["level"]=="admin")
									{
										$tampil = mysqli_query($koneksi,"SELECT * FROM spk");
									}else{
										$tampil = mysqli_query($koneksi,"SELECT * FROM spk  WHERE spk.id_user='$_SESSION[id_user]'");
									}
								      echo "
								          <thead>
											<tr>
												<th width=''>No</th>
												<th>Nama SPK</th>
												<th>Aksi</th>
											</tr>
										</thead>
									<tbody>"; 
								    $no=1;
								    while ($r=mysqli_fetch_array($tampil)){
								       
								       echo "<tr>
								       			<td>$no</td>
								       			<td>
								       			<a href='?module=nilai&act=tambahdetail&id_spk=$r[id_spk]&nama_spk=$r[nama_spk]'>$r[nama_spk]</a>
								       			</td>
								       			<td width='10%'>
													 <center>
													 <a href='?module=nilai&act=tambahdetail&id_spk=$r[id_spk]' class='btn btn-info btn-just-icon edit'><i class='material-icons' rel='tooltip' title='Isi Nilai Aternatif'>edit</i></a> ";
													 /*<a href='modul/aspek/aksi_aspek.php?module=aspek&act=hapus&id=$r[id_aspek]' class='btn btn-danger btn-just-icon remove'><i class='material-icons' rel='tooltip' title='Hapus'>close</i></a>	*/
													 echo "
												   </center>
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
					case "tambahdetail":
					?>
						<div class="card-header card-header-rose card-header-text">
		                  <div class="card-text">
		                    <h4 class="card-title">Form Nilai</h4>
		                  </div>
		                </div>
		                
		                <div class="card-body ">
									<form class="form" method="post" action="modul/nilai/aksi_nilai.php?module=nilai&act=simpan">
										<input type="hidden" name="id_spk" value="<?php echo $_GET['id_spk'] ?>">
										<div class="content">
											<div class="input-group">
												<label class="col-sm-4 control-label text-left">Alternatif</label>
												<select name="id_alternatif" class='form-control' required>
													<option value="">Pilih Alternatif</option>
													<?php  
													$sql="SELECT * FROM alternatif WHERE id_user='$_SESSION[id_user]' AND id_spk='$_GET[id_spk]' ORDER BY id_alternatif ASC";
													$query=mysqli_query($koneksi,$sql);
													while($data=mysqli_fetch_array($query))
													{
														?>
															<option value="<?php echo $data["id_alternatif"] ?>"><?php echo $data["nama_alternatif"] ?></option>
														<?php 
													}
													?>
												</select>
											</div>
											<div class="input-group">
												<label class="col-sm-12 control-label text-left"><b>Aspek</b></label>
											</div>
											<?php  
											//cari aspke berdasarkan spk
											$no=0;
											$no_aspek=1;
											$query_aspek=mysqli_query($koneksi, "SELECT * FROM aspek WHERE id_spk='$_GET[id_spk]' ORDER BY id_aspek ASC");
											while($data_aspek=mysqli_fetch_array($query_aspek))
											{
												echo "<p><b>".$no_aspek.". ".$data_aspek["nama_aspek"]."</b></p>";

												$q=mysqli_query($koneksi, "SELECT * FROM faktor WHERE aspek='$data_aspek[id_aspek]' ORDER BY id_faktor ASC");
 												$no2=1;
						                        while($r=mysqli_fetch_array($q))
						                        {
						                            
						                            $faktor="faktor".$no;
						                            $nilai="nilai".$no;
						                            ?>
						                            <div class="input-group">
							                            <input type="hidden" name="faktor[]" value="<?php echo $r[id_faktor] ?>">
							                            <label class="col-sm-4 control-label text-left"><?php echo $no2.". ".$r["nama_faktor"]; ?></label>
							                                <input type="text" name="nilai[]" required class="form-control" placeholder="">
							                        </div>     
						                        <?php 
						                        $no++;
						                        $no2++;
						                        }
						                        $no_aspek++;
											}					                        
					                        ?>
										<input type="hidden" name="jumlah_faktor" value="<?php echo $no; ?>"> 
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

					$edit=mysqli_query($koneksi,"SELECT * FROM nilai, alternatif, faktor where nilai.id_nilai='$_GET[id]' AND nilai.id_alternatif=alternatif.id_alternatif AND nilai.faktor=faktor.id_faktor") or die (mysqli_error($koneksi));
					$r=mysqli_fetch_array($edit);
					?>
						<div class="card-header card-header-rose card-header-text">
		                  <div class="card-text">
		                    <h4 class="card-title">Form Nilai</h4>
		                  </div>
		                </div>
		                
		                <div class="card-body ">
									<form class="form" method="post" action="modul/nilai/aksi_nilai.php?module=nilai&act=update">
										<div class="content">
										    
											<input type="hidden" name="id_nilai" placeholder="Kode Aspek" class='form-control' value="<?php echo $r[id_nilai] ?>">
											
											
											<div class="input-group">
												<label class="col-sm-4 control-label text-left">Alternatif</label>
												<select name="id_alternatif" class='form-control' required>
													<option value="<?php echo $r["id_alternatif"] ?>"><?php echo $r["nama_alternatif"] ?></option>
													<?php  
													$sql="SELECT * FROM alternatif WHERE id_user='$_SESSION[id_user]' AND id_spk='$_GET[id_spk]' ORDER BY id_alternatif ASC";
													$query=mysqli_query($koneksi,$sql);
													while($data=mysqli_fetch_array($query))
													{
														?>
															<option value="<?php echo $data["id_alternatif"] ?>"><?php echo $data["nama_alternatif"] ?></option>
														<?php 
													}
													?>
												</select>
											</div>
											<div class="input-group">
												<label class="col-sm-4 control-label text-left"><?php echo $r["nama_faktor"] ?></label>
												<input type="text" name="nilai" class='form-control' value="<?php echo $r[nilai] ?>" required>
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
				