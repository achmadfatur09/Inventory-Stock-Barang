<!DOCTYPE html>
<html lang="en">
<head>
	<?php $this->load->view('partials/head.php') ?>
	<link rel="stylesheet" href="<?= base_url('sb-admin') ?>/vendor/daterangepicker/daterangepicker.css">
</head>

<body id="page-top">
	<div id="wrapper">
		<!-- load sidebar -->
		<?php $this->load->view('partials/sidebar.php') ?>

		<div id="content-wrapper" class="d-flex flex-column">
			<div id="content" data-url="<?= base_url('barang') ?>">
				<!-- load Topbar -->
				<?php $this->load->view('partials/topbar.php') ?>

				<div class="container-fluid">
				<div class="clearfix">
					<div class="float-left">
						<h1 class="h3 m-0 text-gray-800"><?= $title ?></h1>
					</div>
					<div class="float-right">
						<?php if ($this->session->login['role'] == 'admin'): ?>
							<a href="<?= base_url('penerimaan/export_detail_penerimaan').$report_filter ?>" target="_blank" class="btn btn-danger btn-sm"><i class="fa fa-print"></i>&nbsp;&nbsp;Export</a>
							<a href="<?= base_url('penerimaan') ?>" class="btn btn-secondary btn-sm"><i class="fa fa-reply"></i>&nbsp;&nbsp;Kembali</a>
						<?php endif ?>
					</div>
				</div>
				<hr>
				<?php if ($this->session->flashdata('success')) : ?>
					<div class="alert alert-success alert-dismissible fade show" role="alert">
						<?= $this->session->flashdata('success') ?>
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
				<?php elseif($this->session->flashdata('error')) : ?>
					<div class="alert alert-danger alert-dismissible fade show" role="alert">
						<?= $this->session->flashdata('error') ?>
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
				<?php endif ?>
				<div class="card shadow">
					<div class="card-header"><strong>Daftar Barang Penerimaan</strong></div>
					<div class="card-body">
					<form action="" method="POST">
							<div class="row">
								<div class="form-group col-md-2">
									<label for="nama_barang"><strong>Jenis Kaos</strong></label>
									<select type="text" name="nama_barang" id="nama_barang" class="form-control" >
										<option value="">-- Jenis Kaos --</option>
										<option value="Anak Lengan Pendek" <?= ($filter['nama_barang'] == 'Anak Lengan Pendek') ? 'selected' :''  ?> >Anak Lengan Pendek</option>
										<option value="Dewasa Lengan Panjang" <?= ($filter['nama_barang'] == 'Dewasa Lengan Panjang') ? 'selected' :''  ?> >Dewasa Lengan Panjang</option>
										<option value="Dewasa Lengan Pendek" <?= ($filter['nama_barang'] == 'Dewasa Lengan Pendek') ? 'selected' :''  ?> >Dewasa Lengan Pendek</option>
									</select>
								</div>
								<div class="form-group col-md-2">
									<label for="warna"><strong>Warna Kaos</strong></label>
									<select name="warna" id="warna" class="form-control" >
										<option value="">-- Warna Kaos --</option>
										<option value="Abu-Abu" <?= ($filter['warna'] == 'Abu-Abu') ? 'selected' :''  ?> >Abu-Abu</option>
										<option value="Biru" <?= ($filter['warna'] == 'Biru') ? 'selected' :''  ?> >Biru</option>
										<option value="Hijau" <?= ($filter['warna'] == 'Hijau') ? 'selected' :''  ?> >Hijau</option>
										<option value="Hitam" <?= ($filter['warna'] == 'Hitam') ? 'selected' :''  ?> >Hitam</option>
										<option value="Maroon" <?= ($filter['warna'] == 'Maroon') ? 'selected' :''  ?> >Maroon</option>
										<option value="Merah" <?= ($filter['warna'] == 'Merah') ? 'selected' :''  ?> >Merah</option>
										<option value="Mustard" <?= ($filter['warna'] == 'Mustard') ? 'selected' :''  ?> >Mustard</option>
										<option value="Navy" <?= ($filter['warna'] == 'Navy') ? 'selected' :''  ?> >Navy</option>
										<option value="Pink" <?= ($filter['warna'] == 'Pink') ? 'selected' :''  ?> >Pink</option>
										<option value="Putih" <?= ($filter['warna'] == 'Putih') ? 'selected' :''  ?> >Putih</option>
									</select>
								</div>
								<div class="form-group col-md-2">
									<label for="ukuran_kaos"><strong>Ukuran Kaos</strong></label>
									<select name="ukuran_kaos" id="ukuran_kaos" class="form-control" >
										<option value="">-- Ukuran Kaos --</option>
										<option value="XS" <?= ($filter['ukuran_kaos'] == 'XS') ? 'selected' :''  ?> >XS</option>
										<option value="S" <?= ($filter['ukuran_kaos'] == 'S') ? 'selected' :''  ?> >S</option>
										<option value="M" <?= ($filter['ukuran_kaos'] == 'M') ? 'selected' :''  ?> >M</option>
										<option value="L" <?= ($filter['ukuran_kaos'] == 'L') ? 'selected' :''  ?> >L</option>
										<option value="XL" <?= ($filter['ukuran_kaos'] == 'XL') ? 'selected' :''  ?> >XL</option>
										<option value="XXL" <?= ($filter['ukuran_kaos'] == 'XXL') ? 'selected' :''  ?> >XXL</option>
										<option value="XXXL" <?= ($filter['ukuran_kaos'] == 'XXXL') ? 'selected' :''  ?> >XXXL</option>
										<option value="XXXXL" <?= ($filter['ukuran_kaos'] == 'XXXXL') ? 'selected' :''  ?> >XXXXL</option>
									</select>
								</div>
                				<div class="form-group col-md-3">
									<label for="tanggal"><strong>Rentang Waktu</strong></label>
									<input type="text" class="form-control text-center" value="<?= $filter['tanggal'] ?? '' ?>" name="tanggal" id="tanggal">
								</div>
								<div class="form-group col-md-2">
									<label for="filter"><strong>Filter</strong></label><br>
									<button type="submit" name="filter" class="btn btn-primary"><i class="fa fa-filter"></i>&nbsp;&nbsp;Fiter Now</button>
								</div>
							</div>
						</form>
						<div class="row">
							<div class="col-md-3">
								<div class="card">
									<ul class="list-group list-group-flush">
										<li class="list-group-item">Jumlah Keseluruhan : <b><span class="text-primary"> <?= $stok_keseluruhan ?> </span></b></li>
										<?php if($stok_filtered !== 0): ?>
											<li class="list-group-item">Jumlah Berdasarkan Pencarian : <b><span class="text-primary"> <?= $stok_filtered ?> </span></b></li>
										<?php endif ?>
									</ul>
								</div>
							</div>
						</div>
						<div class="table-responsive">
							<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
								<thead>
									<tr>
										<th>No</th>
										<!-- <th>Kode Kaos</th> -->
										<th>No Terima</th>
										<th>Waktu Terima</th>
										<th>Jenis Kaos</th>
										<th>Warna Kaos</th>
										<th>Ukuran Kaos</th>
										<th>Jumlah</th>
									</tr>
								</thead>
								<tbody>
									<?php foreach ($all_penerimaan as $penerimaan): ?>
										<tr>
											<td><?= $no++ ?></td>
											<td><?= $penerimaan->no_terima ?></td>
											<td><?= $penerimaan->tgl_terima ?></td>
											<td><?= $penerimaan->nama_barang ?></td>
											<td><?= $penerimaan->warna ?></td>
											<td><?= $penerimaan->ukuran_kaos ?></td>
											<td><?= $penerimaan->jumlah ?> <?= strtoupper($penerimaan->satuan) ?></td>
										</tr>
									<?php endforeach ?>
								</tbody>
							</table>
						</div>
					</div>				
				</div>
				</div>
			</div>
			<!-- load footer -->
			<?php $this->load->view('partials/footer.php') ?>
		</div>
	</div>
	<?php $this->load->view('partials/js.php'); ?>

  <script>
	$(function () {

		var start;
		var end;
		// var start = moment().subtract(29, 'days');
		// var end = moment();

		function cb(start, end) {
			$('#tangal').val(start.format('YYYY-MM-DD') + ' - ' + end.format('YYYY-MM-DD'));
		}

		$('#tanggal').daterangepicker({
			startDate: start,
			endDate: end,
			ranges: {
				'Hari ini': [moment(), moment()],
				'Kemarin': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
				'7 hari terakhir': [moment().subtract(6, 'days'), moment()],
				'30 hari terakhir': [moment().subtract(29, 'days'), moment()],
				'Bulan ini': [moment().startOf('month'), moment().endOf('month')],
				'Bulan lalu': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1,
					'month').endOf('month')],
				'Tahun ini': [moment().startOf('year'), moment().endOf('year')],
				'Tahun lalu': [moment().subtract(1, 'year').startOf('year'), moment().subtract(1, 'year')
					.endOf('year')
				]
			}
		}, cb);

		cb(start, end);
	});

</script>

	<script src="<?= base_url('sb-admin/js/demo/datatables-demo.js') ?>"></script>
	<script src="<?= base_url('sb-admin') ?>/vendor/datatables/jquery.dataTables.min.js"></script>
	<script src="<?= base_url('sb-admin') ?>/vendor/datatables/dataTables.bootstrap4.min.js"></script>
	<script src="<?= base_url('sb-admin') ?>/vendor/daterangepicker/moment.min.js"></script>
	<script src="<?= base_url('sb-admin') ?>/vendor/daterangepicker/daterangepicker.js"></script>
</body>
</html>