<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title><?= $title ?></title>
	<link href="<?= base_url('sb-admin') ?>/css/sb-admin-2.min.css" rel="stylesheet">
</head>
<body>
	<center>
		<table  class="table table-bordered" id="dataTable" width="100%" cellspacing="0" >
			<tr>
				<!-- <td><img src="<?= base_url('sb-admin') ?>/img/tbg_logo.jpg" width="90" height="90"></td> -->
				<td>
					<center>
						<font size="6">Rajo Kaos Jambi</font><br>
						<font size="4">Jl. Nusa Indah I No. 19 A Kel. Rawasari Kec. Alam Barajo – Kota Jambi <br>
						(Depan Grand Hotel & Belakang Hotel Amanah) Kode Pos 36135</font><br>
						<font size="2"> telp/fax : 0811-7486-070 | email : rajokaos@gmail.com | radjokaos.com</font><br>
						<!-- <font size="2">Date/Time : <?= $waktu=date("l, d-M-Y / H:i:s a"); ?></font> -->
					</center>
				</td>
			</tr>
		</table>
	</center>
	<hr>
	<center><font size="4"><?= $title ?></font><br><br></center>
			<table class="table table-borderless">
				<tr>
					<td><strong>Nama</strong></td>
					<td>:</td>
					<td><?= $this->session->userdata('login')['nama'] ?></td>
				</tr>
				<tr>
					<td><strong>Tanggal</strong></td>
					<td>:</td>
					<td><?= $waktu=date("l, d-m-Y"); ?></td>
				</tr>
			</table>
	<br>
	<div class="row">
		<table border="1" class="table table-bordered" id="dataTable" width="100%" cellspacing="0" >
			
			<thead> 
				<tr align="center">
					<td>No</td>
					<!-- <td>Kode Kaos</td> -->
					<td><strong>Jenis Kaos</strong></td>
					<td><strong>Warna Kaos</strong></td>
					<td><strong>Ukuran Kaos</strong></td>
					<td><strong>Stok Kaos</strong></td>
					<td><strong>Status Stok Kaos</strong></td>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($all_barang as $barang): ?>
					<tr align="center">
						<td><?= $no++ ?></td>
						<!-- <td><?= $barang->kode_barang ?></td> -->
						<td align="float-left"><?= $barang->nama_barang ?></td>
						<td><?= $barang->warna ?></td>
						<td><?= $barang->ukuran_kaos ?></td>
						<td><?= $barang->stok ?> <?= strtoupper($barang->satuan) ?></td>
						<td>
							<?php
								if($barang->stok <= 10){
								    $status='Sedikit';
								}
								if($barang->stok > 10 && $barang->stok <= 30){
								    $status='Sedang';
								}
								if($barang->stok > 30){
								    $status='Banyak';
								}
								echo $status
							?>
						</td>
					</tr>
				<?php endforeach ?>
				
			</tbody>
			
		</table>

		<br><br>
		<br><br>

	<footer class="sticky-footer bg-white">
		<div class="container my-auto">
			<div class="copyright text-center my-auto">
				<div class="row">
				<table class="table table-bordered" id="dataTable" width="125%" cellspacing="0">
					<thead>
						<tr>
							<td></td>
							<td></td>
							<td></td>
						</tr>
					</thead>
					<tbody>
							<tr>
								<td>
									Jambi, <?= $waktu=date("d-m-Y"); ?><br>
									Mengetahui
										<br>
										<br>
										<br>
										<br>
										<p>(<?= $this->session->login['nama'] ?>)</p>
								</td>
							</tr>
					</tbody>
				</table>
				</div>
			</div>
		</div>
		</footer>
	</table>	
	</div>
</body>
</html>