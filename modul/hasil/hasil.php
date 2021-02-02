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

				<table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0"
					width="100%" style="width:100%">
					<?php 
									$no=1;
									if($_SESSION["level"]=="admin")
									{
										$tampil = mysqli_query($koneksi,"SELECT * FROM spk");
									}else{
										$tampil = mysqli_query($koneksi,"SELECT * FROM spk_user us INNER JOIN spk s ON us.id_spk=s.id_spk INNER JOIN user u ON us.id_user=u.id_user WHERE us.id_user='$_SESSION[id_user]'") or die (mysqli_error($koneksi));
									}
									if($_SESSION["level"]=="admin"){
										echo "
										<thead>
											<tr>
												<th width=''>No</th>
												<th>Nama SPK</th>
												<th>Keterangan</th>
												<th>Tanggal Pembuatan</th>
											</tr>
										</thead>
									<tbody>";
									}else{
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
									}
									if($_SESSION["level"]=="admin"){
										$no=1;
										while ($r=mysqli_fetch_array($tampil)){
											echo "<tr>
														<td>$no</td>
														<td><a href='?module=hasil&act=user&id_spk=$r[id_spk]'>$r[nama_spk]</a></td>
														<td> $r[keterangan] </td>
														<td> $r[tanggal] </td>
													</tr>";
											$no++;
										}
										echo "</tbody>
											</table>";
									}else{
										$no=1;
										while ($r=mysqli_fetch_array($tampil)){ 
											echo "<tr>
														<td>$no</td>
														<td><a href='?module=hasil&act=detail&id_spkuser=$r[id_spkuser]'>$r[nama_spk]</a></td>
														<td> $r[ket] </td>
														<td> $r[tgl] </td>
													</tr>";
											$no++;
										}
										echo "</tbody>
											</table>";
									}
									?>
			</div>
		</div>
	</div>
	<?php
					break;

				case "user":
					$query =  mysqli_query($koneksi, "SELECT * FROM spk WHERE id_spk='$_GET[id_spk]'");
					$result = mysqli_fetch_array($query);
						?>
			<div class="card-header card-header-rose card-header-text">
				<div class="card-text">
					<h4 class="card-title">Data Pengguna SPK <?= $result['nama_spk']?></h4>
				</div>
			</div>

			<div class="card-body ">

				<table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0"
					width="100%" style="width:100%">
					<?php 
									$no=1;
									if($_SESSION["level"]=="admin")
									{
										$tampil = mysqli_query($koneksi,"SELECT u.nama, s.nama_spk, su.ket, su.id_spkuser FROM spk_user su INNER JOIN spk s ON s.id_spk=su.id_spk INNER JOIN user u ON u.id_user=su.id_user WHERE su.id_spk='$result[id_spk]'");
									}else{
										$tampil = mysqli_query($koneksi,"SELECT * FROM spk_user us INNER JOIN spk s ON us.id_spk=s.id_spk INNER JOIN user u ON us.id_user=u.id_user WHERE us.id_user='$_SESSION[id_user]'") or die (mysqli_error($koneksi));
									}
									if($_SESSION["level"]=="admin"){
										echo "
										<thead>
											<tr>
												<th width=''>No</th>
												<th>Nama Operator</th>
												<th>Nama SPK</th>
												<th>Keterangan</th>
											</tr>
										</thead>
									<tbody>";
									}else{
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
									}
									if($_SESSION["level"]=="admin"){
										$no=1;
										while ($r=mysqli_fetch_array($tampil)){
											echo "<tr>
														<td>$no</td>
														<td><a href='?module=hasil&act=detail&id_spkuser=$r[id_spkuser]'>$r[nama]</a></td>
														<td> $r[nama_spk] </td>
														<td> $r[ket] </td>
													</tr>";
											$no++;
										}
										echo "</tbody>
											</table>";
									}else{
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
									}
									?>
			</div>
		</div>
	</div>
	<?php
					break;

					case "detail" :
					$query = mysqli_query($koneksi, "SELECT * FROM spk INNER JOIN spk_user ON spk_user.id_spk=spk.id_spk INNER JOIN user u ON u.id_user=spk_user.id_user WHERE id_spkuser='$_GET[id_spkuser]'");
					$result = mysqli_fetch_array($query);
						?>
	<div class="card-header card-header-rose card-header-text">
		<div class="card-text">
		<table>
			<tr>
				<td>Data Hasil SPK</td>
				<td>:</td>
				<td><?= $result["nama_spk"]?></td>
			</tr>
			<tr>
				<td>Keterangan</td>
				<td>:</td>
				<td><?= $result["ket"]?></td>
			</tr>
			<tr>
				<td>Nama Operator</td>
				<td>:</td>
				<td><?= $result["nama"]?></td>
			</tr>
		</table>
			<!-- <h4 class="card-title">Data Hasil SPK : <?php echo $result["nama_spk"] ?></h4>
			<h4 class="card-title">Keterangan : <?php echo $result["ket"] ?></h4>
			<h4 class="card-title">Nama Operator : <?php echo $result["nama"] ?></h4> -->
		</div>
	</div>

	<div class="card-body ">
		<?php  
		echo "<a href='laporan_spk.php?id_spkuser=$_GET[id_spkuser]&nama_spk=$result[nama_spk]&level=$_SESSION[level]&user=$result[nama]&ket=$result[ket]' lass='btn btn-info btn-just-icon print' target='blank'><i class='material-icons' rel='tooltip' title='Print'>print</i></a>";
		?>
		<table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%"
			style="width:100%">
			<?php 
									$no=1;
									if($_SESSION["level"]=="admin")
									{
										$tampil = mysqli_query($koneksi,"SELECT * FROM hasil h INNER JOIN spk_user su ON su.id_spkuser=h.id_spkuser INNER JOIN spk s ON s.id_spk=su.id_spk WHERE su.id_spkuser='$_GET[id_spkuser]' ORDER BY h.nilai DESC");
									}else{
										$tampil = mysqli_query($koneksi,"SELECT * FROM hasil h INNER JOIN spk_user su ON su.id_spkuser=h.id_spkuser INNER JOIN spk s ON s.id_spk=su.id_spk WHERE su.id_user='$_SESSION[id_user]' AND su.id_spkuser='$_GET[id_spkuser]' ORDER BY h.nilai DESC") or die (mysqli_error($koneksi));
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