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
		                    <h4 class="card-title">Data SPK Yang Pernah Digunakan</h4>
		                  </div>
		                </div>
		                
		                <div class="card-body ">
							<a href="?module=alternatif_user&act=tambah">
								<button class="btn  btn-youtube">
	                          		<i class="fa fa-plus-square-o"> </i> Tambah SPK Baru
	                        	</button>
	                       	</a>
							<table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
									<?php 
									$no=1;
									if($_SESSION["level"]=="admin")
									{
										$tampil = mysqli_query($koneksi,"SELECT * FROM alternatif, spk WHERE alternatif.id_spk=spk.id_spk ORDER BY alternatif.id_alternatif ASC");
									}else{
                                        $id_user = $_SESSION['id_user']; 
                                        // echo $id_user; die;
										$tampil = mysqli_query($koneksi,"SELECT u.nama, s.nama_spk, su.ket, su.id_spkuser, su.tgl, s.id_spk FROM spk_user su INNER JOIN user u ON su.id_user=u.id_user INNER JOIN spk s ON su.id_spk=s.id_spk WHERE su.id_user='$id_user'");
									}
									if($_SESSION["level"]=="admin") {
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
									}else{
										echo "
								          <thead>
											<tr>
												<th width=''>No</th>
												<th>Nama User</th>
												<th>Nama SPK</th>
												<th>Keterangan</th>
												<th>Tanggal Pembuatan</th>
												<th>Aksi</th>
											</tr>
										</thead>
									<tbody>";
									}
									
									if($_SESSION["level"]=="admin") {
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
														 <a href="modul/alternatif/aksi_alternatif.php?module=alternatif&act=hapus_alt_user&id=<?php echo $r['id_alternatif'] ?>" class="btn btn-danger btn-just-icon remove" onclick="return confirm('Anda yakin mau menghapus item ini ?')"><i class="material-icons" rel="tooltip" title="Hapus">close</i></a>
															
													   </center>
													 <?php 
													   echo "
													</td>
												</tr>";
										  $no++;
										}
										echo "</tbody>
											</table>";
									}else{
										$no=1;
										while ($r=mysqli_fetch_array($tampil)){
										   echo"
												   <tr>
														<td>$no</td>
														<td>$r[nama]</td>
														<td><a href='?module=alternatif_user&act=view_alt&id_spkuser=$r[id_spkuser]&id_spk=$r[id_spk]'>$r[nama_spk]</a></td>
														<td>$r[ket]</td>
														<td>$r[tgl]</td>
														<td width='10%'>";
													?>
														 <center>
														 <a href="?module=alternatif&act=edit&id=<?php echo $r['id_spkuser'] ?>" class="btn btn-info btn-just-icon edit"><i class="material-icons" rel="tooltip" title='Edit'>edit</i></a> 
														 <a href="modul/alternatif/aksi_alternatif.php?module=alternatif&act=hapus_alt_user&id=<?= $r[id_spkuser] ?>" class="btn btn-danger btn-just-icon remove" onclick="return confirm('Anda yakin mau menghapus item ini ?')"><i class="material-icons" rel="tooltip" title="Hapus">close</i></a>
															
													   </center>
													 <?php 
													   echo "
													</td>
												</tr>";
										  $no++;
										}
										echo "</tbody>
												
											</table>";
									}
									?>
							</div>
						<?php
                    break;
                    
                    case "view_alt" :
                        if (isset($_GET['id_spkuser'])) {
                            $idspkuser = $_GET['id_spkuser'];
                        }
                        if (isset($_GET['id_spk'])) {
                            $idspk = $_GET['id_spk'];
                        }
						?>
						<div class="card-header card-header-rose card-header-text">
		                  <div class="card-text">
		                    <h4 class="card-title">Data Alternatif</h4>
		                  </div>
		                </div>
		                
		                <div class="card-body ">
                        <a href="?module=alternatif_user&act=tambah_alt&id_spkuser=<?=$idspkuser?>&id_spk=<?=$idspk?>">
								<button class="btn  btn-youtube">
	                          		<i class="fa fa-plus-square-o"> </i> Tambah Alternatif Baru
	                        	</button>
                         </a>
							<table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
									<?php 
									$no=1;
									if($_SESSION["level"]=="admin")
									{
										$tampil = mysqli_query($koneksi,"SELECT * FROM alternatif, spk WHERE alternatif.id_spk=spk.id_spk ORDER BY alternatif.id_alternatif ASC");
									}else{
                                        $id_user = $_SESSION['id_user']; 
                                        // echo $id_user; die;
										$tampil = mysqli_query($koneksi,"SELECT a.nama_alternatif, a.id_alternatif, s.id_spk, n.nilai FROM alternatif a LEFT JOIN spk_user u ON a.id_spkuser=u.id_spkuser LEFT JOIN spk s ON u.id_spk=s.id_spk LEFT JOIN nilai n ON a.id_alternatif=n.id_alternatif WHERE a.id_spkuser='$idspkuser' GROUP BY a.nama_alternatif");
									}
									if($_SESSION["level"]=="admin") {
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
									}else{
										echo "
								          <thead align='center'>
											<tr>
												<th width=''>No</th>
												<th>Nama Alternatif</th>
												<th>Nilai</th>
												<th>Aksi</th>
											</tr>
										</thead>
									<tbody>";
									}
									
									if($_SESSION["level"]=="admin") {
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
									}else{
										$no=1;
										while ($r=mysqli_fetch_array($tampil)){
                                           ?>
												   <tr>
														<td><?=$no?></td>
                                                        <td><?=$r[nama_alternatif]?></td>
                                                        
                                        <?php
                                        $nilai = $r['nilai'];
                                           if ($nilai == 0 OR $nilai == "") {
                                           ?>
                                            <td align="center">
                                                <a href="?module=alternatif_user&act=tambahdetail&id_spkuser=<?=$idspkuser?>&id_alt=<?=$r[id_alternatif]?>&id_spk=<?=$r[id_spk]?>"><span class="badge badge-danger">Nilai Belum Disii</span></a>
                                            </td>
                                           <?php
                                        }else{
                                            ?>
                                           <td align="center">
                                           <a href="?module=alternatif_user&act=editnilai&id_spkuser=<?=$idspkuser?>&id_alt=<?=$r[id_alternatif]?>&id_spk=<?=$r[id_spk]?>"><span class="badge badge-success">Lihat Nilai</span></a>
                                            </td>
                                            <?php
                                        }
                                                    ?>
														<td>
														 <center>
														 <a href="?module=alternatif&act=edit&id=<?php echo $r['id_spkuser'] ?>" class="btn btn-info btn-just-icon edit"><i class="material-icons" rel="tooltip" title='Edit'>edit</i></a> 
														 <a href="modul/alternatif/aksi_alternatif.php?module=alternatif&act=hapus&id=<?php echo $r['id_spkuser'] ?>" class="btn btn-danger btn-just-icon remove" onclick="return confirm('Anda yakin mau menghapus item ini ?')"><i class="material-icons" rel="tooltip" title="Hapus">close</i></a>
															
													   </center>
													 <?php 
													   echo "
													</td>
												</tr>";
										  $no++;
										}
										echo "</tbody>
												
											</table>";
									}
									?>
							</div>
						<?php
					break;

					case "tambah":
					?>
						<div class="card-header card-header-rose card-header-text">
		                  <div class="card-text">
		                    <h4 class="card-title">Form Tambah SPK Baru</h4>
		                  </div>
		                </div>
		                
		                <div class="card-body ">
									<form class="form" method="post" action="modul/alternatif/aksi_alternatif.php?module=alternatif&act=simpan_spk_baru">
										<div class="content">
											<div class="input-group">
												<label class="col-sm-4 control-label text-left">SPK</label>
												<select name="id_spk" class='form-control' required>
													<option value="">Pilih SPK...</option>
													<?php  
													if($_SESSION["level"]=='admin')
													{
														$sql="SELECT * FROM spk ORDER BY id_spk ASC";
													}else{
														$sql="SELECT * FROM spk ORDER BY id_spk ASC";
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
												<label class="col-sm-4 control-label text-left">Keterangan SPK</label>
												<input type="text" name="keterangan" class='form-control' placeholder=" Contoh :'Promosi Jabatan Untuk Kantor A'" required>
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
                    case "tambah_alt" :
                        if (isset($_GET['id_spk'])) {
                            $idspk = $_GET['id_spk'];
                        }
                        if (isset($_GET['id_spkuser'])) {
                            $idspkuser = $_GET['id_spkuser'];
                        }
                        ?>
                            <div class="card-header card-header-rose card-header-text">
                              <div class="card-text">
                                <h4 class="card-title">Form Alternatif</h4>
                              </div>
                            </div>
                            
                            <div class="card-body ">
                                        <form class="form" method="post" action="modul/alternatif/aksi_alternatif.php?module=alternatif&act=input_nilai_alt">
                                            <div class="content">
                                                <input type="text" name="id_spk" placeholder="Kode Alternatif" class='form-control' value="<?php echo $idspk ?>">
                                                <input type="text" name="id_spkuser" placeholder="Kode Alternatif" class='form-control' value="<?php echo $idspkuser ?>">
                                                
                                                <div class="input-group">
                                                    <label class="col-sm-4 control-label text-left">Alternatif</label>
                                                    <input type="text" name="nama_alternatif" placeholder="Nama Alternatif" class='form-control' value="<?php echo $r[nama_alternatif] ?>" required>
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

                        case "tambahdetail":
                            if (isset($_GET['id_spkuser'])) {
                                $idspkuser = $_GET['id_spkuser'];
                            }
                            if (isset($_GET['id_alt'])) {
                                $idalt = $_GET['id_alt'];
                            }
                            if (isset($_GET['id_spk'])) {
                                $idspk = $_GET['id_spk'];
                            }
                            ?>
                                <div class="card-header card-header-rose card-header-text">
                                  <div class="card-text">
                                    <h4 class="card-title">Form Data alternatif</h4>
                                  </div>
                                </div>
                                
                                <div class="card-body ">
                                            <form class="form" method="post" action="modul/alternatif/aksi_alternatif.php?module=alternatif&act=simpan_nilai">
                                                <input type="text" name="id_spkuser" value="<?=$idspkuser?>">
                                                <input type="text" name="id_alternatif" value="<?=$idalt?>">
                                                <input type="text" name="id_spk" value="<?=$idspk?>">
                                                <div class="content">
                                                    <div class="input-group">
                                                        <label class="col-sm-12 control-label text-left"><b>Aspek</b></label>
                                                    </div>
                                                    <?php  
                                                    //cari aspke berdasarkan spk
                                                    $no=0;
                                                    $no_aspek=1;
                                                    $query_aspek=mysqli_query($koneksi, "SELECT * FROM aspek WHERE id_spk='$idspk' ORDER BY id_aspek ASC");
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

                            case "editnilai":
                                if (isset($_GET['id_spkuser'])) {
                                    $idspkuser = $_GET['id_spkuser'];
                                }
                                if (isset($_GET['id_alt'])) {
                                    $idalt = $_GET['id_alt'];
                                }
                                if (isset($_GET['id_spk'])) {
                                    $idspk = $_GET['id_spk'];
                                }
                                ?>
                                    <div class="card-header card-header-rose card-header-text">
                                      <div class="card-text">
                                        <h4 class="card-title">Form Ubah Data alternatif</h4>
                                      </div>
                                    </div>
                                    
                                    <div class="card-body ">
                                                <form class="form" method="post" action="modul/alternatif/aksi_alternatif.php?module=alternatif&act=ubah_nilai">
                                                    <input type="text" name="id_spkuser" value="<?=$idspkuser?>">
                                                    <input type="text" name="id_alternatif" value="<?=$idalt?>">
                                                    <input type="text" name="id_spk" value="<?=$idspk?>">
                                                    <div class="content">
                                                        <div class="input-group">
                                                            <label class="col-sm-12 control-label text-left"><b>Aspek</b></label>
                                                        </div>
                                                        <?php  
                                                        //cari aspke berdasarkan spk
                                                        $no=0;
                                                        $no_aspek=1;
                                                        $query_aspek=mysqli_query($koneksi, "SELECT * FROM aspek WHERE id_spk='$idspk' ORDER BY id_aspek ASC");
                                                        while($data_aspek=mysqli_fetch_array($query_aspek))
                                                        {
                                                            echo "<p><b>".$no_aspek.". ".$data_aspek["nama_aspek"]."</b></p>";
            
                                                            $q=mysqli_query($koneksi, "SELECT * FROM faktor INNER JOIN nilai ON faktor.id_faktor=nilai.faktor WHERE aspek='$data_aspek[id_aspek]' AND id_alternatif='$idalt'ORDER BY id_faktor ASC");
                                                             $no2=1;
                                                            while($r=mysqli_fetch_array($q))
                                                            {
                                                                
                                                                $faktor="faktor".$no;
                                                                $nilai="nilai".$no;
                                                                ?>
                                                                <div class="input-group">
                                                                    <input type="hidden" name="faktor[]" value="<?php echo $r[id_faktor] ?>">
                                                                    <label class="col-sm-4 control-label text-left"><?php echo $no2.". ".$r["nama_faktor"]; ?></label>
                                                                        <input type="text" name="nilai[]" required class="form-control" value="<?=$r['nilai']?>">
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
				}
			?>
		</div>
</div>
</div>
				