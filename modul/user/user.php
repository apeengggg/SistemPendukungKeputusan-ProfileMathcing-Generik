<?php 
include "../../config/koneksi.php";
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
								                    <h4 class="card-title">Data User</h4>
								                  </div>
								              </div>
								               <div class="card-body ">
													<!-- <a href="?module=user&act=tambah">
														<button class="btn  btn-youtube">
								                          <i class="fa fa-plus-square-o"> </i> Tambah Data User
								                        </button></a> -->
													<table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
														<?php 
														$no=1;
														$tampil = mysqli_query($koneksi,"SELECT * FROM user ORDER BY nama ASC");
													      echo "
													          <thead>
																<tr>
																	<th>No</th>
																	<th>Nama</th>
																	<th>Level</th>
																	<th>Foto</th>
																	<th>Aksi</th>
																</tr>
															</thead>
														<tbody>"; 
													    $no=1;
													    while ($r=mysqli_fetch_array($tampil)){
													       
													       echo "<tr>
													       			<td>$no</td>
																	<td>$r[nama]</td>
																	<td>$r[level]</td>
																	<td>";
																	if($r["foto"]!="")
																	{
																		echo "<img src='./foto/$r[foto]' width='100px' height='120px'>";
																	}else{
																		echo '<img src="assets/img/image_placeholder.jpg"  width="100px" alt="...">';
																	}
																	

														   echo "   </td>
																	<td width='20%'>
																		 <center>";
																		 if($r["aktif"]=="T")
																		 {
																		 	echo "
																		 		<a href='modul/user/aksi_user.php?module=user&act=aktifasi&id=$r[username]' class='btn  btn-success btn-just-icon check'><i class='material-icons' rel='tooltip' title='Aktifasi'>check</i></a>
																		 	";
																		 }else{
																		 	echo "
																		 		<a href='' class='btn  btn-success btn-just-icon check'><i class='material-icons' rel='tooltip' title='Sudah diaktifasi'>check</i></a>
																		 	";
																		 }
																		 ?>
																		 <a href='?module=user&act=edit&id=<?php echo $r[id_user] ?>' class='btn  btn-info btn-just-icon edit'><i class='material-icons' rel='tooltip' title='Edit'>edit</i></a>   
																		 <a href='modul/user/aksi_user.php?module=user&act=hapus&id=<?php echo $r[username] ?>' class='btn  btn-danger btn-just-icon remove' onclick='return confirm("Anda yakin mau menghapus item ini ?")'><i class='material-icons' rel='tooltip' title='Hapus'>close</i></a>
																		 <?php 
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

										case "tambah":
										?>
											<div class="card-header card-header-rose card-header-text">
								                  <div class="card-text">
								                    <h4 class="card-title">Data User</h4>
								                  </div>
								                </div>
								                
								                <div class="card-body ">
														<form class="form" method="post" enctype="multipart/form-data" action="modul/user/aksi_user.php?module=user&act=simpan">
															<div class="content">
															    <div class="input-group">
																	<label class="col-sm-4 control-label text-left">Username</label>
																	<input type="text" name="username" class='form-control' placeholder="" required>
																</div>
																<div class="input-group">
																	<label class="col-sm-4 control-label text-left">Password</label>
																	<input type="password" name="password" class='form-control' placeholder="" required>
																</div>
																<div class="input-group">
																	<label class="col-sm-4 control-label text-left">Nama</label>
																	<input type="text" name="nama" class='form-control' placeholder="" required>
																</div>
																<!-- <div class="input-group">
																	<label class="col-sm-4 control-label text-left">Alamat</label>
																	<input type="text" name="alamat" placeholder="" class='form-control' value="" required>
																</div> -->
																<div class="input-group">
																	<label class="col-sm-4 control-label text-left">No. Tlp</label>
																	<input type="text" name="tlp" placeholder="" class='form-control' value="" required>
																</div>
																<div class="input-group">
																	<label class="col-sm-4 control-label text-left">Email</label>
																	<input type="text" name="email" placeholder="" class='form-control' value="" required>
																</div>
																<div class="input-group">
																	<label class="col-sm-4 control-label text-left">Level</label>
																	<select name="level" class="form-control" required="">
																		<option value="">Plih Level</option>
																		<option value="Admin">Administrator</option>
																		<option value="User">User</option>
																	</select>
																</div>
																<div class="input-group">
																	<label class="col-sm-4 control-label text-left">Foto</label>
																<div class="col-md-4 col-sm-4">
											                      <h4 class="title">Foto</h4>
											                      <div class="fileinput fileinput-new text-center" data-provides="fileinput">
											                        <div class="fileinput-new thumbnail">
											                          <img src="assets/img/image_placeholder.jpg" alt="...">
											                        </div>
											                        <div class="fileinput-preview fileinput-exists thumbnail"></div>
											                        <div>
											                          <span class="btn btn-rose btn-round btn-file">
											                            <span class="fileinput-new">Select image</span>
											                            <span class="fileinput-exists">Change</span>
											                            <input type="file" name="file" required>
											                          </span>
											                          <a href="#pablo" class="btn btn-danger btn-round fileinput-exists" data-dismiss="fileinput"><i class="fa fa-times"></i> Remove</a>
											                        </div>
											                      </div>
											                    </div>
															</div>
															<div class="footer text-center">
																<input type="submit" value="Simpan" class="btn btn-primary pull-left">
																<input name="action" type="button" value="Cancel" onclick="window.history.back();" class="btn btn-danger pull-left">
															</div>
															<br>
														</div>
														</form>
													</div>
												
										<?php
										break;

										case "edit" :
										$edit=mysqli_query($koneksi,"SELECT * FROM user WHERE id_user='$_GET[id]'");
    									$r=mysqli_fetch_array($edit);
    									?>
											<div class="card-header card-header-rose card-header-text">
								                  <div class="card-text">
								                    <h4 class="card-title">Data User</h4>
								                  </div>
								                </div>
								                
								                <div class="card-body ">
														<form class="form" method="post" enctype="multipart/form-data" action="modul/user/aksi_user.php?module=user&act=update">
															<div class="content">
															    <div class="input-group">
																	<label class="col-sm-4 control-label text-left">Username</label>
																	<input type="text" name="username" placeholder="User Name" class='form-control' value="<?php echo $r[username] ?>" readonly>
																	<input type="hidden" name="id_user" placeholder="User Name" class='form-control' value="<?php echo $r[id_user] ?>" readonly>
																</div>
																<div class="input-group">
																	<label class="col-sm-4 control-label text-left">Password</label>
																	<input type="password" name="password" placeholder="" class='form-control'>
																</div>
																<div class="input-group">
																	<label class="col-sm-4 control-label text-left">Nama</label>
																	<input type="text" name="nama" placeholder="" class='form-control' value="<?php echo $r[nama] ?>" required>
																</div>
																<!-- <div class="input-group">
																	<label class="col-sm-4 control-label text-left">Alamat</label>
																	<input type="text" name="alamat" placeholder="" class='form-control' value="<?php echo $r[alamat] ?>" required>
																</div> -->
																<div class="input-group">
																	<label class="col-sm-4 control-label text-left">No. Tlp</label>
																	<input type="text" name="tlp" placeholder="" class='form-control' value="<?php echo $r[tlp] ?>" required>
																</div>
																<div class="input-group">
																	<label class="col-sm-4 control-label text-left">Email</label>
																	<input type="text" name="email" placeholder="" class='form-control' value="<?php echo $r[email] ?>" required>
																</div>
																<?php  

																if($_SESSION["level"]=="admin")
																{
																	?>
																		<div class="input-group">
																			<label class="col-sm-4 control-label text-left">Level</label>
																			<select name="level" class="form-control" required="">
																				<option value="<?php echo $r[level] ?>"><?php echo $r[level] ?></option>
																				<option value="Admin">Administrator</option>
																				<option value="User">User</option>
																			</select>
																		</div>
																	<?php 
																}
																?>
																<div class="input-group">
																	<label class="col-sm-4 control-label text-left">Foto</label>
																	<div class="col-md-4 col-sm-4">
													                      
													                      <div class="fileinput fileinput-new text-center" data-provides="fileinput">
														                        <div class="fileinput-new thumbnail">
														                        	<?php  
														                        		if($r["foto"]=="")
														                        		{
														                        			?>
														                        				<img src="assets/img/image_placeholder.jpg" alt="...">
														                        			<?php 
														                        		}else{
														                        			?>
														                        				 <img src="./foto/<?php echo  $r['foto']?>" alt="...">
														                        			<?php 
														                        		}
														                        	?>
														                         
														                        </div>
														                        <div class="fileinput-preview fileinput-exists thumbnail"></div>
														                        <div>
															                          <span class="btn btn-rose btn-round btn-file">
															                            <span class="fileinput-new">Select image</span>
															                            <span class="fileinput-exists">Change</span>
															                            <input type="file" name="file"/>
															                          </span>
														                          <a href="#pablo" class="btn btn-danger btn-round fileinput-exists" data-dismiss="fileinput"><i class="fa fa-times"></i> Remove</a>
														                        </div>
													                      </div>
												                    </div>
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
									}
								?>
					</div>
				</div>
			</div>