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
					</center>
				</td>
			</tr>
		</table>
	</center>
	<hr>
	<center><font size="4"><?= $title ?></font><br><br></center>
			<table class="table table-borderless">
				<tr>
					<td><strong>Nama Petugas</strong></td>
					<td>:</td>
					<td><?= $this->session->userdata('login')['nama'] ?></td>
				</tr>
				<tr>
					<td><strong>Waktu Terima</strong></td>
					<td>:</td>
					<td><?= $tanggal ?></td>
				</tr>
			</table>
	<br>
	<div class="row">
		<table border="1" class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
			<thead>
				<tr align="center">
					<td><strong>No</strong></td>
					<td><strong>Tanggal Terima</strong></td>
					<td><strong>Jenis Kaos</strong></td>
					<td><strong>Warna Kaos</strong></td>
					<td><strong>Ukuran Kaos</strong></td>
					<td><strong>Jumlah Kaos</strong></td>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($all_penerimaan as $penerimaan): ?>
					<tr align="center">
						<td><?= $no++ ?></td>
						<td><?= $penerimaan->tgl_terima ?></td>
						<td align="float-left"><?= $penerimaan->nama_barang ?></td>
						<td><?= $penerimaan->warna ?></td>
						<td><?= $penerimaan->ukuran_kaos ?></td>
						<td><?= $penerimaan->jumlah ?></td>
					</tr>
				<?php endforeach ?>
			</tbody>
		</table>
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
							Mengetahui
								<br/>
								<br>
								<br><br><br>
								<p>(<?= $this->session->login['nama'] ?>)</p>
						</td>
					</tr>
				
			</tbody>
		</table>
	</div>
	</div>
	</div>
		</footer>
	</div>
</body>
</html>