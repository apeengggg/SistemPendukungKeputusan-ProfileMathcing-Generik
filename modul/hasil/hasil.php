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
		                    <h4 class="card-title">Data Hasil</h4>
		                  </div>
		                </div>
		                
		                <div class="card-body ">
							
							<table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
									<?php 
									$no=1;
									if($_SESSION["level"]=="admin")
									{
										$tampil = mysqli_query($koneksi,"SELECT * FROM spk, user WHERE spk.id_user=user.id_user ORDER BY spk.id_spk DESC");
									}else{
										$tampil = mysqli_query($koneksi,"SELECT * FROM spk_user us INNER JOIN spk s ON us.id_spk=s.id_spk INNER JOIN user u ON us.id_user=u.id_user WHERE us.id_user='$_SESSION[id_user]'") or die (mysqli_error($koneksi));
									}
								      echo "
								          <thead>
											<tr>
												<th width=''>No</th>
												<th>Nama SPK</th>
												<th>Keterangan</th>
												<th>Tgl Pembuatan</th>
											</tr>
										</thead>
									<tbody>"; 
								    $no=1;
								    while ($r=mysqli_fetch_array($tampil)){
								       
								       echo "<tr>
								       			<td>$no</td>
								       			<td> $r[nama_spk] </td>
												   <td> $r[ket] </td>
												   <td> $r[tgl] </td>
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

					case "detail" :
						?>
						<div class="card-header card-header-rose card-header-text">
		                  <div class="card-text">
		                    <h4 class="card-title">Data Hasil <?php echo $_GET["nama_spk"] ?></h4>
		                  </div>
		                </div>

		                <div class="card-body ">
							<?php  
		                	echo "<a href='laporan_spk.php?id_spk=$_GET[id_spk]&nama_spk=$_GET[nama_spk]&level=$_SESSION[level]' lass='btn btn-info btn-just-icon print' target='blank'><i class='material-icons' rel='tooltip' title='Print'>print</i></a>";
		                ?>
							<table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
									<?php 
									$no=1;
									if($_SESSION["level"]=="admin")
									{
										$tampil = mysqli_query($koneksi,"SELECT * FROM hasil, spk WHERE hasil.id_spk=spk.id_spk AND hasil.id_spk='$_GET[id_spk]' ORDER BY hasil.nilai DESC");
									}else{
										$tampil = mysqli_query($koneksi,"SELECT * FROM hasil, spk WHERE hasil.id_user='$_SESSION[id_user]' AND hasil.id_spk=spk.id_spk AND hasil.id_spk='$_GET[id_spk]' ORDER BY hasil.nilai DESC") or die (mysqli_error($koneksi));
									}
								      echo "
								          <thead>
											<tr>
												<th width=''>No</th>
												<th>Nama Alternatif</th>
												<th>Nilai</th>
											</tr>
										</thead>
									<tbody>"; 
								    $no=1;
								    while ($r=mysqli_fetch_array($tampil)){
								       
								       echo "<tr>
								       			<td>$no</td>
								       			<td>$r[nama_alternatif]</td>
								       			<td>$r[nilai]</td>
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
				}
			?>
		</div>
</div>
				