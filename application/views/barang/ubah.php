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
								<form action="<?= base_url('barang/proses_ubah/' . $barang->kode_barang) ?>" id="form-tambah" method="POST">
									<div class="form-row">
										<div class="form-group col-md-6">
											<label for="kode_barang"><strong>Kode Kaos</strong></label>
											<input type="text" name="kode_barang" placeholder="Masukkan Kode Kaos" autocomplete="off"  class="form-control" required value="<?= $barang->kode_barang ?>" maxlength="8" readonly>
										</div>
										<div class="form-group col-md-6">
											<label for="nama_barang"><strong>Jenis Kaos</strong></label>
											<select type="text" name="nama_barang" id="nama_barang" class="form-control" required value="<?= $barang->nama_barang ?>">
												<option value="">-- Silahkan Pilih Jenis Kaos --</option>
												<option value="Anak Lengan Pendek" <?= $barang->nama_barang == 'Anak Lengan Pendek' ? 'selected' : '' ?>>Anak Lengan Pendek</option>
												<option value="Dewasa Lengan Panjang" <?= $barang->nama_barang == 'Dewasa Lengan Panjang' ? 'selected' : '' ?>>Dewasa Lengan Panjang</option>
												<option value="Dewasa Lengan Pendek" <?= $barang->nama_barang == 'Dewasa Lengan Pendek' ? 'selected' : '' ?>>Dewasa Lengan Pendek</option>
											</select>
										</div>
									</div>
									<div class="form-row">
										<div class="form-group col-md-6">
											<label for="warna"><strong>Warna Kaos</strong></label>
											<select name="warna" id="warna" class="form-control" required value="<?= $barang->warna ?>">
												<option value="">-- Silahkan Pilih Warna Kaos --</option>
												<option value="Abu-Abu" <?= $barang->warna == 'Abu-Abu' ? 'selected' : '' ?>>Abu-Abu</option>
												<option value="Biru" <?= $barang->warna == 'Biru' ? 'selected' : '' ?>>Biru</option>
												<option value="Hijau" <?= $barang->warna == 'Hijau' ? 'selected' : '' ?>>Hijau</option>
												<option value="Hitam" <?= $barang->warna == 'Hitam' ? 'selected' : '' ?>>Hitam</option>
												<option value="Maroon" <?= $barang->warna == 'Maroon' ? 'selected' : '' ?>>Maroon</option>
												<option value="Merah" <?= $barang->warna == 'Merah' ? 'selected' : '' ?>>Merah</option>
												<option value="Mustard" <?= $barang->warna == 'Mustard' ? 'selected' : '' ?>>Mustard</option>
												<option value="Navy" <?= $barang->warna == 'Navy' ? 'selected' : '' ?>>Navy</option>
												<option value="Pink" <?= $barang->warna == 'Pink' ? 'selected' : '' ?>>Pink</option>
												<option value="Putih" <?= $barang->warna == 'Putih' ? 'selected' : '' ?>>Putih</option>
											</select>
										</div>
										<div class="form-group col-md-6">
											<label for="ukuran_kaos"><strong>Ukuran Kaos</strong></label>
											<select name="ukuran_kaos" id="ukuran_kaos" class="form-control" required value="<?= $barang->ukuran_kaos ?>">
												<option value="">-- Silahkan Pilih Ukuran --</option>
												<option value="XS" <?= $barang->ukuran_kaos == 'XS' ? 'selected' : '' ?>>XS</option>
												<option value="S" <?= $barang->ukuran_kaos == 'S' ? 'selected' : '' ?>>S</option>
												<option value="M" <?= $barang->ukuran_kaos == 'M' ? 'selected' : '' ?>>M</option>
												<option value="L" <?= $barang->ukuran_kaos == 'L' ? 'selected' : '' ?>>L</option>
												<option value="XL" <?= $barang->ukuran_kaos == 'XL' ? 'selected' : '' ?>>XL</option>
												<option value="XXL" <?= $barang->ukuran_kaos == 'XXL' ? 'selected' : '' ?>>XXL</option>
												<option value="XXXL" <?= $barang->ukuran_kaos == 'XXXL' ? 'selected' : '' ?>>XXXL</option>
												<option value="XXXXL" <?= $barang->ukuran_kaos == 'XXXXL' ? 'selected' : '' ?>>XXXXL</option>
											</select>
										</div>
									</div>
									<div class="form-row">
										<div class="form-group col-md-6">
											<label for="stok"><strong>Stok Kaos</strong></label>
											<input type="number" name="stok" placeholder="Masukkan Stok" autocomplete="off"  class="form-control" required value="<?= $barang->stok ?>">
										</div>
										<div class="form-group col-md-6">
											<label for="satuan"><strong>Satuan</strong></label>
											<select name="satuan" id="satuan" class="form-control" required value="<?= $barang->satuan ?>">
												<option value="">-- Silahkan Pilih Satuan --</option>
												<option value="Pcs" <?= $barang->satuan == 'Pcs' ? 'selected' : '' ?>>Pcs</option>
												<option value="Kodi" <?= $barang->satuan == 'Kodi' ? 'selected' : '' ?>>Kodi</option>
												<option value="Lusin" <?= $barang->satuan == 'Lusin' ? 'selected' : '' ?>>Lusin</option>
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