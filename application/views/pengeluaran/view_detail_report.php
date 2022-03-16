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
	<div class="row">
		<div class="col-md-4">
			<table class="table table-borderless">
				<tr>
					<td><strong>Nama Petugas</strong></td>
					<td>:</td>
					<td><?= $this->session->userdata('login')['nama'] ?></td>
				</tr>
				<tr>
					<td><strong>Nama Karyawan</strong></td>
					<td>:</td>
					<td><?= $all_detail_keluar[0]->nama_customer ?></td>
				</tr>
				<tr>
					<td><strong>Waktu keluar</strong></td>
					<td>:</td>
					<td><?= $all_detail_keluar[0]->tgl_keluar ?> - <?= $all_detail_keluar[count($all_detail_keluar) - 1]->tgl_keluar ?></td>
				</tr>
			</table>
		</div>
	</div>
	<br>

	<div class="row">
		<div class="col-md-12">
			<table border="1" class="table table-bordered" id="dataTable" width="100%" cellspacing="0" >
				<thead>
					<tr align="center">
						<td><strong>No</strong></td>
						<td><strong>No Keluar</strong></td>
						<td><strong>Waktu Keluar</strong></td>
						<td><strong>Jenis Kaos</strong></td>
						<td><strong>Warna</strong></td>
						<td><strong>Ukuran</strong></td>
						<td><strong>Jumlah</strong></td>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($all_detail_keluar as $detail_keluar): ?>
						<tr align="center">
							<td><?= $no++ ?></td>
							<td><?= $detail_keluar->no_keluar ?></td>
							<td><?= $detail_keluar->tgl_keluar ?></td>
							<td align="float-left"><?= $detail_keluar->nama_barang ?></td>
							<td><?= $detail_keluar->warna ?></td>
							<td><?= $detail_keluar->ukuran_kaos ?></td>
							<td><?= $detail_keluar->jumlah ?> <?= strtolower($detail_keluar->satuan) ?></td>
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
		</div>
	</div>
</body>
</html>