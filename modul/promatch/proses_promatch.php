<?php 
include "config/koneksi.php";
//cek tabel nilai
$sql=mysqli_query($koneksi, "SELECT su.id_spkuser, su.id_user, su.ket, su.tgl, s.nama_spk, s.id_spk, s.keterangan, s.tanggal, s.id_user FROM spk_user su INNER JOIN spk s ON su.id_spk = s.id_spk WHERE su.id_spkuser='$_POST[id_spkuser]'");
$data=mysqli_fetch_array($sql);
// echo $data[id_spk]; die;
$jumlah=mysqli_num_rows($sql);

if($jumlah>0)
{
	$sql2=mysqli_query($koneksi, "SELECT * FROM nilai n INNER JOIN alternatif a ON n.id_alternatif=a.id_alternatif INNER JOIN spk_user su ON a.id_spkuser=su.id_spkuser WHERE n.id_alternatif=a.id_alternatif AND a.id_spkuser='$data[id_spkuser]'");
	$jumlah2=mysqli_num_rows($sql2);
	if($jumlah2<1)
	{
		?>
            <script type="text/javascript">
                window.alert("Data untuk id_spk objek spk tidak ditemukan");
                window.location="?module=promatch";
            </script>
        <?php 
	}
} 

$cekaspek = mysqli_query($koneksi, "SELECT SUM(bobot) as jumlah FROM aspek WHERE id_spk='$data[id_spk]'");
$j = mysqli_fetch_array($cekaspek);
$k = $j['jumlah'];
// echo $k ; die;
if ($k > 100 OR $k < 100) {
	?>
            <script type="text/javascript">
                window.alert("Gagal Melakukan Perhitungan, Jumlah Bobot Aspek Tidak Sama Dengan 100");
                window.location="?module=promatch";
            </script>
		<?php 
		die;
}




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
		                    <h4 class="card-title">Proses Profile Matcing</h4>
								<a href="#hasil_akhir" class="btn btn-success">Lihat Hasil Akhir</a>
		                  </div>
		                </div>
		                
		                <div class="card-body ">
						

  <?php
		//---------------------Menyimpan tabel bobot dalam array---------------------
			$bobot=array();
			$sql="SELECT * FROM bobot WHERE id_spk='$data[id_spk]'";
			$hasil=mysqli_query($koneksi,$sql);
			while($row=mysqli_fetch_array($hasil))
				{
					$bobot[$row['selisih']]=$row['bobot'];
				}
			// print_r($bobot); 
		//---------------------Menyimpan tabel sample dalam array---------------------
			$sql="SELECT * FROM nilai WHERE id_spkuser='$data[id_spkuser]'";
			$hasil=mysqli_query($koneksi,$sql);
			while($row=mysqli_fetch_array($hasil))
				{
					$nilai_sample[$row['id_alternatif']][$row['faktor']]=$row['nilai'];
				}
			// print_r($nilai_sample); die;
		//---------------------Menyimpan tabel alternatif dalam array---------------------		
        	$nama_alternatif=array();
			$nilai_akhir=array();
			$sql="SELECT * FROM alternatif WHERE id_spkuser='$data[id_spkuser]' ORDER BY id_alternatif";
			$hasil=mysqli_query($koneksi,$sql);
			while($row=mysqli_fetch_array($hasil))
				{
					$nama_alternatif[$row['id_alternatif']]=$row['nama_alternatif'];
					$nilai_akhir[$row['id_alternatif']]=0;
				}
				// print_r($nilai_akhir); die;
		//---------------------Menyimpan tabel aspek dalam array---------------------		
			$nama_aspek=array(); 
			$nama_singkat=array(); 
			$jumlah_kolom=array();
			$ba_all=array();
			$ba_cf=array();
			$ba_sf=array();
			$sql="SELECT *,(SELECT COUNT(id_faktor) FROM faktor WHERE aspek=id_aspek) AS jum_kolom 
				 FROM aspek WHERE id_spk='$data[id_spk]' ORDER BY id_aspek ASC";



			$hasil=mysqli_query($koneksi,$sql);
			while($row=mysqli_fetch_array($hasil))
				{
					$aspek=$row['id_aspek'];
					$nama_aspek[$row['id_aspek']]=$row['nama_aspek'];
					$nama_singkat[$row['id_aspek']]=$row['nama_singkat'];
					$jumlah_kolom[$row['id_aspek']]=$row['jum_kolom'];
					$ba_all[$row['id_aspek']]=$row['bobot'];
					$ba_cf[$row['id_aspek']]=$row['bobot_core'];
					$ba_sf[$row['id_aspek']]=$row['bobot_secondary'];
					//------------cari index berdasarkan nomor 
					$sql2="SELECT * FROM faktor WHERE aspek='$aspek' ORDER BY id_faktor";
					$hasil2=mysqli_query($koneksi,$sql2);
					$kolom=1;
					while($row2=mysqli_fetch_array($hasil2))
						{
							$r_index[$aspek][$kolom]=$row2['id_faktor'];
							$kolom++;
						}
				
				}
				// print_r($jumlah_kolom); die;
	?>
    <!-- <h1>Contoh SPK GAP MP</h1> -->
		<table class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
        	<thead>
        		<tr>
            	<th>No</th>
                <th>Aspek</th>
                <th>Faktor</th>
                <th>Nilai Target</th>
                <th>Type</th>
            </tr>
        	</thead>
        	<tbody>
            <?php
				$no=1;
				//---------------------Menyimpan tabel faktor dalam array dan menampilkan---------------------
            	$sql="SELECT faktor.*,nama_aspek,IF(jenis='1','c','s') AS nama_jenis
					FROM faktor LEFT JOIN aspek ON faktor.aspek=aspek.id_aspek WHERE faktor.id_spk='$data[id_spk]' ORDER BY id_aspek,id_faktor ASC";
				$hasil=mysqli_query($koneksi,$sql);
				$target=array();
				$nama_jenis=array();
				while($row=mysqli_fetch_array($hasil))
				{		
					$target[$row['id_faktor']]=$row['target'];
					$nama_jenis[$row['id_faktor']]=$row['nama_jenis'];
			?>
        	<tr>
        	  <td><?php echo $no++; ?></td>
        	  <td><?php echo $row['nama_aspek'];?></td>
        	  <td><?php echo $row['nama_faktor'];?></td>
        	  <td><?php echo $row['target'];?></td>
        	  <td><?php echo $row['nama_jenis'];?></td>
      	  </tr>
          <?php
				}
				// print_r($target); die;
		  ?>
		  </tbody>
        </table>
        <?php
			
			
			while (list($key, $value) = each($nama_aspek)) 
				{		
					echo "<h2>".$nama_aspek[$key]."</h2>";
					
		?>
        		
        		<table class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                	<thead>
                		<tr>
                    	<th>No</th>
                        <th>Nama</th>
                        <?php for($kol=1;$kol<=$jumlah_kolom[$key];$kol++) {?>
                        <th><?php echo $nama_singkat[$key]; ?><sub><?php echo $kol;?></sub></th>
                        <?php } ?>
                    </tr>
                	</thead>
                	<tbody>
                    <?php
						reset($nama_alternatif);
						$nomor=1;	
                    	while (list($k, $v) = each($nama_alternatif)) 
							{
								
					?>
                    <tr>
                    	<td><?php echo $nomor++;?></td>
                        <td><?php echo $nama_alternatif[$k];?></td>
                        <?php for($kol=1;$kol<=$jumlah_kolom[$key];$kol++) {
									$pos=$r_index[$key][$kol];
							?>
                        <td><?php echo $nilai_sample[$k][$pos]; ?></td>
                        <?php } ?>
                    </tr>
                    <?php
							}
					?>
					</tbody>
                </table>
        <?php			
				}
		?>
		<hr />
        <h2>PERHITUNGAN GAP</h2>
        <?php
		reset($nama_aspek);
        while (list($key, $value) = each($nama_aspek)) 
				{		
					echo "<h3>Aspek ".$nama_aspek[$key]."</h3>";
					
		?>
        		
        		<table class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                	<thead>
                		<tr>
                    	<th>No</th>
                        <th>Nama</th>
                        <?php for($kol=1;$kol<=$jumlah_kolom[$key];$kol++) {?>
                        <th><?php echo $nama_singkat[$key]; ?><sub><?php echo $kol;?></sub></th>
                        <?php } ?>
                    </tr>
                	</thead>
                	<tbody>
                    <?php
						//---------------------Proses menghitung nilai GAP---------------------		
						reset($nama_alternatif);
						$nomor=1;	
                    	while (list($k, $v) = each($nama_alternatif)) 
							{
								
					?>
                    <tr>
                    	<td><?php echo $nomor++;?></td>
                        <td><?php echo $nama_alternatif[$k];?></td>
                        <?php for($kol=1;$kol<=$jumlah_kolom[$key];$kol++) {
									$pos=$r_index[$key][$kol];
									$nilai_gap[$k][$pos]=$nilai_sample[$k][$pos]-$target[$pos]
							?>
                        <td>(<?php echo $nilai_sample[$k][$pos]; ?>-<?php echo $target[$pos]; ?>)=<strong><?php echo $nilai_gap[$k][$pos];?></strong></td>
                        <?php } ?>
                    </tr>
                    <?php
							}
					?>
					</tbody>
                </table>
        <?php			
				}
		?>
        
        
        <hr />
        <h2>PEMBOBOTAN</h2>
        <?php
		reset($nama_aspek);
        while (list($key, $value) = each($nama_aspek)) 
				{		
					echo "<h3>Aspek ".$nama_aspek[$key]." (".$ba_all[$key]."%)</h3>";
					
		?>
        		
        		<table class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                	<thead>
                		<tr>
                    	<th>No</th>
                        <th>Nama</th>
                        <?php for($kol=1;$kol<=$jumlah_kolom[$key];$kol++) {
								$pos=$r_index[$key][$kol];
							?>
                        <th><?php echo $nama_singkat[$key]; ?><sub><?php echo $kol;?></sub>[<?php echo $nama_jenis[$pos];?>]</th>
                        <?php } ?>
                        <th>rCF (<?php echo $ba_cf[$key];?>%)</th>
                        <th>rSF (<?php echo $ba_sf[$key];?>%)</th>
                        <th>Nilai</th>
                    </tr>
                	</thead>
                	<tbody>
                    <?php
						reset($nama_alternatif);
						$nomor=1;	
                    	while (list($k, $v) = each($nama_alternatif)) 
							{
								$jum_cf=$jum_sf=$ccf=$csf=0;
								
					?>
                    <tr>
                    	<td><?php echo $nomor++;?></td>
                        <td><?php echo $nama_alternatif[$k];?></td>
                        <?php for($kol=1;$kol<=$jumlah_kolom[$key];$kol++) {
									$pos=$r_index[$key][$kol];
									$nilai_bobot[$k][$pos]=$bobot[$nilai_sample[$k][$pos]-$target[$pos]];
									if($nama_jenis[$pos]=="c")
										{
											$jum_cf+=$nilai_bobot[$k][$pos];
											$ccf++;	
										}
									else
										{
											$jum_sf+=$nilai_bobot[$k][$pos];
											$csf++;	
										}	
										
							?>
                        <td><?php echo $nilai_bobot[$k][$pos];?></td>
                        <?php }
						
							$ncf=$jum_cf/$ccf;
							$nsf=$jum_sf/$csf;
							$nilai_bobot[$k][$key]=$ba_cf[$key]*($ncf/100)+$ba_sf[$key]*($nsf/100);
							$nilai_akhir[$k]+=$nilai_bobot[$k][$key]*($ba_all[$key]/100);
						 ?>
                        <td><?php echo $jum_cf."/".$ccf;?>=<?php echo number_format($ncf,2,",","."); ?></td>
                        <td><?php echo $jum_sf."/".$csf;?>=<?php echo number_format($nsf,2,",","."); ?></td>
                        <td><?php echo  number_format($nilai_bobot[$k][$key],2,",","."); ?></td>
                    </tr>
                    <?php
							}
					?>
					</tbody>
                </table>
        		<?php			
				}
				//print_r($nilai_akhir);
				reset($nilai_akhir);
				//krsort($nilai_akhir);
				//print_r($nilai_akhir);
				?>
        				<h3>Nilai Akhir Total</h3>
                        <table class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                        	<thead>
                        		<tr>
                            	<th>No</th>
                                <th>Nama</th>
                                <th>Nilai</th>
                            </tr>
                        	</thead>
                        	<tbody>
        				<?php
						
						$nomor=1;	
                    	while (list($k, $v) = each($nilai_akhir)) 	
							{
						?>
            			<tr>
                            	<td><?php echo $nomor++; ?></td>
                                <td><?php echo $nama_alternatif[$k]; ?></td>
                                <td><?php echo $nilai_akhir[$k]; ?></td>
                            </tr>
            			<?php					
							}
						?>
						</tbody>
        				</table>
             <?php
			 	//print_r($nilai_akhir);
				reset($nilai_akhir);
				arsort($nilai_akhir);
				//print_r($nilai_akhir);
				mysqli_query($koneksi,"DELETE FROM hasil WHERE id_spkuser='$data[id_spkuser]'");
			 ?>
                        
                        <h3 id="hasil_akhir">Nilai Akhir Total Sorting</h3>
                        <table class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                        	<thead>
                        		<tr>
                            	<th>No</th>
                                <th>Nama</th>
                                <th>Nilai</th>
                            </tr>
                        	</thead>
                        	<tbody>
        				<?php
						
						$nomor=1;	
                    	while (list($k, $v) = each($nilai_akhir)) 	
							{

							?>
		            			<tr>
		                            	<td><?php echo $nomor++; ?></td>
		                                <td><?php echo $nama_alternatif[$k]; ?></td>
		                                <td><?php echo number_format($nilai_akhir[$k],2,",","."); ?></td>
		                          </tr>
		            			<?php	
		            					//Cari hasil sebelumnya berdasarkan spk jika sudah ada timpa dengan yang baru
		            				$sql_spk=mysqli_query($koneksi, "SELECT * FROM spk_user WHERE id_spk='$data[id_spk]'");
		            				$jumlah_row=mysqli_num_rows($sql_spk);
		            				if($jumlah_row>1)
		            				{
		            					//hapus data sebelumnya
		            					mysqli_query($koneksi, "DELETE FROM hasil WHERE id_spkuser='$data[id_spk]'");
		            				}

									mysqli_query($koneksi,"INSERT INTO hasil(nama_alternatif,nilai, id_spk, id_user, id_spkuser) VALUES ('$nama_alternatif[$k]', '$nilai_akhir[$k]', '$data[id_spk]', '$_SESSION[id_user]', '$data[id_spkuser]')");				
							}
						?>
						</tbody>
        				</table>
        				

								</div>
					<?php
					break;
				}
			?>
		</div>
</div>
				