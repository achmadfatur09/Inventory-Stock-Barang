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
			<div id="content" data-url="<?= base_url('pengeluaran') ?>">
				<!-- load Topbar -->
				<?php $this->load->view('partials/topbar.php') ?>

				<div class="container-fluid">
				<div class="clearfix">
					<div class="float-left">
						<h1 class="h3 m-0 text-gray-800"><?= $title ?></h1>
					</div>
					<div class="float-right">
						<a href="<?= base_url('pengeluaran/view_detail') ?>" class="btn btn-success btn-sm"><i class="fa fa-eye"></i>&nbsp;&nbsp;View Detail</a>
						<button type="button" class="btn btn-secondary btn-sm" data-toggle="modal" data-target="#modalExport"><i class="fa fa-print"></i>&nbsp;&nbsp;Export</button>
						<a href="<?= base_url('pengeluaran/tambah') ?>" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i>&nbsp;&nbsp;Tambah</a>
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
					<div class="card-header"><strong>Daftar Pengeluaran</strong></div>
					<div class="card-body">
						<div class="table-responsive">
							<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
								<thead>
									<tr>
										<td>No</td>
										<td>No Keluar</td>
										<td>Tanggal Keluar</td>
										<td>Nama Petugas</td>
										<td>Nama Karyawan</td>
										<td>Aksi</td>
									</tr>
								</thead>
								<tbody>
									<?php foreach ($all_pengeluaran as $pengeluaran): ?>
										<tr>
											<td><?= $no++ ?></td>
											<td><?= $pengeluaran->no_keluar ?></td>
											<td><?= $pengeluaran->tgl_keluar ?> <?= $pengeluaran->jam_keluar ?></td>
											<td><?= $pengeluaran->nama_petugas ?></td>
											<td><?= $pengeluaran->nama_customer ?></td>
											<td>
												<a href="<?= base_url('pengeluaran/detail/' . $pengeluaran->no_keluar) ?>" class="btn btn-success btn-sm"><i class="fa fa-eye"></i></a>
												<a onclick="return confirm('apakah anda yakin?')" href="<?= base_url('pengeluaran/hapus/' . $pengeluaran->no_keluar) ?>" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
											</td>
										</tr>
									<?php endforeach ?>
								</tbody>
							</table>
						</div>
					</div>				
				</div>
				</div>
			</div>

			<!-- Modal -->
			<div class="modal fade" id="modalExport" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
				<div class="modal-dialog " role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="exampleModalLongTitle">Export</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<form action="<?= base_url('pengeluaran/export') ?>" method="post" target="_blank">
							<div class="modal-body">
								<div class="form-group ">
									<label>Rentang Waktu</label>
									<input type="text" class="form-control text-center" name="tanggal" id="tanggal">
								</div>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
								<button type="submit" name="export" class="btn btn-primary">Export</button>
							</div>
						</form>
					</div>
				</div>
			</div>

			<!-- load footer -->
			<?php $this->load->view('partials/footer.php') ?>
		</div>
	</div>
	<?php $this->load->view('partials/js.php') ?>

	<script>
	$(function () {

		var start = moment().subtract(29, 'days');
		var end = moment();

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