<!DOCTYPE html>
<html lang="en">
<head>
	<?php $this->load->view('partials/head.php') ?>
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
							<a href="<?= base_url('barang/report').$report_filter ?>" target="_blank" class="btn btn-danger btn-sm"><i class="fa fa-print"></i>&nbsp;&nbsp;Export</a>
							<a href="<?= base_url('barang/tambah') ?>" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i>&nbsp;&nbsp;Tambah</a>
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
					<div class="card-header"><strong>Daftar Barang</strong></div>
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
										<li class="list-group-item">Stok Keseluruhan : <b><span class="text-primary"> <?= $stok_keseluruhan ?> </span></b></li>
										<?php if($stok_filtered !== 0): ?>
											<li class="list-group-item">Stok Berdasarkan Pencarian : <b><span class="text-primary"> <?= $stok_filtered ?> </span></b></li>
										<?php endif ?>
									</ul>
								</div>
							</div>
						</div>
						<div class="table-responsive">
							<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
								<thead>
									<tr>
										<td>No</td>
										<!-- <td>Kode Kaos</td> -->
										<td>Jenis Kaos</td>
										<td>Warna Kaos</td>
										<td>Ukuran Kaos</td>
										<td>Stok Kaos</td>
										<td>Status Stok Kaos</td>
										<?php if ($this->session->login['role'] == 'admin'): ?>
											<td>Aksi</td>
										<?php endif ?>
									</tr>
								</thead>
								<tbody>
									<?php foreach ($all_barang as $barang): ?>
										<tr>
											<td><?= $no++ ?></td>
											<!-- <td><?= $barang->kode_barang ?></td> -->
											<td><?= $barang->nama_barang ?></td>
											<td><?= $barang->warna ?></td>
											<td><?= $barang->ukuran_kaos ?></td>
											<td><?= $barang->stok ?> <?= strtoupper($barang->satuan) ?></td>
 											<td>
											<?php
												if($barang->stok <= 24){
												    $status='Sedikit';
												}
												if($barang->stok > 24 && $barang->stok <= 50){
												    $status='Sedang';
												}
												if($barang->stok > 50){
												    $status='Banyak';
												}
												echo $status
											?>
 											</td>
 											<?php if ($this->session->login['role'] == 'admin'): ?>
												<td>
													<a href="<?= base_url('barang/ubah/' . $barang->kode_barang) ?>" class="btn btn-success btn-sm"><i class="fa fa-pen"></i></a>
													<a onclick="return confirm('apakah anda yakin?')" href="<?= base_url('barang/hapus/' . $barang->kode_barang) ?>" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
												</td>
											<?php endif ?>
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
	<script src="<?= base_url('sb-admin/js/demo/datatables-demo.js') ?>"></script>
	<script src="<?= base_url('sb-admin') ?>/vendor/datatables/jquery.dataTables.min.js"></script>
	<script src="<?= base_url('sb-admin') ?>/vendor/datatables/dataTables.bootstrap4.min.js"></script>
</body>
</html>