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
		                    <h4 class="card-title">Form Profile Matcing</h4>
		                  </div>
		                </div>
		                
		                <div class="card-body ">
									<form class="form" method="post" action="?module=proses_promatch">
										<div class="content">
										    <div class="input-group">
												<label class="col-sm-4 control-label text-left">SPK</label>
												<select name="id_spkuser" class='form-control' required>
													<option value="">Pilih SPK</option>
													<?php  
													if($_SESSION["level"]=="admin")
													{
														$sql="SELECT * FROM spk ORDER BY id_spk ASC";
													}else{
														$sql="SELECT * FROM spk_user su INNER JOIN spk s ON su.id_spk=s.id_spk WHERE su.id_user='$_SESSION[id_user]' ORDER BY su.id_spk ASC";
													}
													$query=mysqli_query($koneksi,$sql);
													while($data=mysqli_fetch_array($query))
													{
														?>
															<option value="<?php echo $data["id_spkuser"] ?>"><?php echo $data["nama_spk"] ?> [<?= $data["ket"]?>] [<?=$data["tgl"]?>]</option>
														<?php 																		}
													?>
												</select>
											</div>
										</div>
										<div class="footer text-center">
											<input type="submit" value="Proses" class="btn btn-primary pull-left">
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
				