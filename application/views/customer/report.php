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
						<font size="4">PT Tower Bersama Group</font><br>
						<font size="2">perumahan tanjung permata, jl. BLK. AA, Eka Jaya, Jambi Selatan, Kota Jambi, Jambi 36136</font><br>
						<font size="2"> telp/fax : (021) 2924-900 email : corporate.secretary@tower-bersama.com </font><br>
						<font size="2">Date/Time : <?= $waktu=date("l, d-M-Y / H:i:s a"); ?></font>
					</center>
				</td>
			</tr>
			<!-- <tr>
				<td colspan="2"><hr></td>
			</tr> -->
		</table>
	</center>
	<hr>
	<center><font size="4">Laporan Data team</font><br><br></center>
	<div class="row">
		<table border="1" class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
			<thead>
				<tr>
					<td width="20px">No</td>
					<td>Kode Team</td>
					<td>Nama Team</td>
					<td>Telepon</td>
					<td>Email</td>
					<td>Alamat</td>
				</tr>
			</thead>
			<tbody>
			<?php foreach ($all_customer as $customer): ?>
				<tr>
					<td><?= $no++ ?></td>
					<td><?= $customer->kode ?></td>
					<td><?= $customer->nama ?></td>
					<td><?= $customer->telepon ?></td>
					<td><?= $customer->email ?></td>
					<td><?= $customer->alamat ?></td>
				</tr>	
			<?php endforeach ?>
			</tbody>

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
								<p>(<?= $this->session->login['nama'] ?>)<br/>user</p>
						</td>
						<td>
							
								<br/>
								<br>
								<br><br><br>
								
								<p>(_______________)
								<br/>admin</p>
						</td>
						<td>
							
								<br/>
								<br>
								<br><br><br>
								
								<p>(_______________)<br/>Pimpinan cabang</p>
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