<?php 
include "../../config/koneksi.php";
 ?>
<div class="row">
		<div class="col-md-12">
          <div class="card ">

					<div class="card-header card-header-rose card-header-text">
	                  <div class="card-text">
	                    <h4 class="card-title">Data Prediksi Produksi</h4>
	                  </div>
	                </div>
	                
	                <div class="card-body ">
								<?php
									$sql=mysqli_query($koneksi, "SELECT * FROM data, produk WHERE data.kode_produk=produk.kode_produk");

								?>
								<form method='post'>
							         <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
							          	<thead>	
							            <tr>
							            	<th>No</th>
							            	<th>Produk</th>
							            	<th>Penjualan Paling Sedikit</th>
							            	<th>Penjualan Paling Banyak</th>
							            	<th>Persediaan Paling Sedikit</th>
							            	<th>Persediaan Paling Banyak</th>
							            	<th>Produksi Paling Sedikit</th>
							            	<th>Produksi Paling Banyak</th>
							            	<th>Penjualan diinginakn</th>
							            	<th>Persediaan</th>
							            	<th>Jumlah Harus Diproduksi</th>
							            </tr>
							            </thead>
							            <tbody>	
							            <?php  
							            $no=1;
							            while($data=mysqli_fetch_array($sql))
							            {
							            	?>
							            		<tr>
							            			<td><?php echo $no ?></td>
							            			<td><?php echo $data["nama_produk"] ?></td>
							            			<td><?php echo $data["penjualan_min"] ?></td>
							            			<td><?php echo $data["penjualan_max"] ?></td>
							            			<td><?php echo $data["persediaan_min"] ?></td>
							            			<td><?php echo $data["persediaan_max"] ?></td>
							            			<td><?php echo $data["produksi_min"] ?></td>
							            			<td><?php echo $data["produksi_max"] ?></td>
							            			<td><?php echo $data["penjualan_sekarang"] ?></td>
							            			<td><?php echo $data["persediaan_sekarang"] ?></td>
							            			<td><?php echo $data["produksi"] ?></td>
							            		</tr>
							            	<?php 
							            	$no++;
							            }
							            ?>
							            </tbody>
							          </table>
							        
							</div>
						</div>
					</div>
				</div>
