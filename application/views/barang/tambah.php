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
						<a href="<?= base_url('barang') ?>" class="btn btn-secondary btn-sm"><i class="fa fa-reply"></i>&nbsp;&nbsp;Kembali</a>
					</div>
				</div>
				<hr>
				<div class="row">
					<div class="col-md-6">
						<div class="card shadow">
							<div class="card-header"><strong>Isi Form Dibawah Ini!</strong></div>
							<div class="card-body">
								<form action="<?= base_url('barang/proses_tambah') ?>" id="form-tambah" method="POST">
									<div class="form-row">
										<div class="form-group col-md-6">
											<label for="kode_barang"><strong>Kode Kaos</strong></label>
											<input type="text" name="kode_barang" placeholder="Masukkan Kode Barang" autocomplete="off"  class="form-control" required value="<?= mt_rand(10000000, 99999999) ?>" maxlength="8" readonly>
										</div>
										<div class="form-group col-md-6">
											<label for="nama_barang"><strong>Jenis Kaos</strong></label>
											<select type="text" name="nama_barang" id="nama_barang" class="form-control" required>
												<option value="">-- Silahkan Pilih Kategori --</option>
												<option value="Anak Lengan Pendek">Anak Lengan Pendek</option>
												<option value="Dewasa Lengan Panjang">Dewasa Lengan Panjang</option>
												<option value="Dewasa Lengan Pendek">Dewasa Lengan Pendek</option>
											</select>
										</div>
									</div>
									<div class="form-row">
										<div class="form-group col-md-6">
											<label for="warna"><strong>Warna Kaos</strong></label>
											<select name="warna" id="warna" class="form-control" required>
												<option value="">-- Silahkan Pilih Warna --</option>
												<option value="Abu-Abu">Abu-Abu</option>
												<option value="Biru">Biru</option>
												<option value="Hijau">Hijau</option>
												<option value="Hitam">Hitam</option>
												<option value="Maroon">Maroon</option>
												<option value="Merah">Merah</option>
												<option value="Mustard">Mustard</option>
												<option value="Navy">Navy</option>
												<option value="Pink">Pink</option>
												<option value="Putih">Putih</option>
											</select>
										</div>
										<div class="form-group col-md-6">
											<label for="ukuran_kaos"><strong>Ukuran Kaos</strong></label>
											<select name="ukuran_kaos" id="ukuran_kaos" class="form-control" required>
												<option value="">-- Silahkan Pilih Ukuran --</option>
												<option value="XS">XS</option>
												<option value="S">S</option>
												<option value="M">M</option>
												<option value="L">L</option>
												<option value="XL">XL</option>
												<option value="XXL">XXL</option>
												<option value="XXXL">XXXL</option>
												<option value="XXXXL">XXXXL</option>
											</select>
										</div>
									</div>
									<div class="form-row">
										<div class="form-group col-md-6">
											<label for="stok"><strong>Stok Kaos</strong></label>
											<input type="number" name="stok" placeholder="Masukkan Stok Kaos" autocomplete="off"  class="form-control" required>
										</div>
										<div class="form-group col-md-6">
											<label for="satuan"><strong>Satuan</strong></label>
											<select name="satuan" id="satuan" class="form-control" required>
												<option value="">-- Silahkan Pilih Satuan --</option>
												<option value="Pcs">Pcs</option>
												<option value="Kodi">Kodi</ption>
												<option value="Lusin">Lusin</option>
											</select>
										</div>
									</div>
									<hr>
									<div class="form-group">
										<button type="submit" class="btn btn-primary"><i class="fa fa-save"></i>&nbsp;&nbsp;Simpan</button>
										<button type="reset" class="btn btn-danger"><i class="fa fa-times"></i>&nbsp;&nbsp;Batal</button>
									</div>
								</form>
							</div>				
						</div>
					</div>
				</div>
				</div>
			</div>
			<!-- load footer -->
			<?php $this->load->view('partials/footer.php') ?>
		</div>
	</div>
	<?php $this->load->view('partials/js.php') ?>
</body>
</html>