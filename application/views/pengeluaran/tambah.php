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
			<div id="content" data-url="<?= base_url('pengeluaran') ?>">
				<!-- load Topbar -->
				<?php $this->load->view('partials/topbar.php') ?>

				<div class="container-fluid">
				<div class="clearfix">
					<div class="float-left">
						<h1 class="h3 m-0 text-gray-800"><?= $title ?></h1>
					</div>
					<div class="float-right">
						<a href="<?= base_url('pengeluaran') ?>" class="btn btn-secondary btn-sm"><i class="fa fa-reply"></i>&nbsp;&nbsp;Kembali</a>
					</div>
				</div>
				<hr>
				<div class="row">
					<div class="col">
						<div class="card shadow">
							<div class="card-header"><strong>Isi Form Dibawah Ini!</strong></div>
							<div class="card-body">
								<form action="<?= base_url('pengeluaran/proses_tambah') ?>" id="form-tambah" method="POST">
									<h5>Data Petugas</h5>
									<hr>
									<div class="form-row">
										<div class="form-group col-md-2">
											<label>No. Keluar</label>
											<input type="text" name="no_keluar" value="KL<?= time() ?>" readonly class="form-control">
										</div>
										<div class="form-group col-md-3">
											<label>Kode Petugas</label>
											<input type="text" name="kode_petugas" value="<?= $this->session->login['kode'] ?>" readonly class="form-control">
										</div>
										<div class="form-group col-md-3">
											<label>Nama Petugas</label>
											<input type="text" name="nama_petugas" value="<?= $this->session->login['nama'] ?>" readonly class="form-control">
										</div>
										<div class="form-group col-md-2">
											<label>Tanggal Keluar</label>
											<input type="date" name="tgl_keluar" value="<?= date('Y-m-d') ?>" readonly class="form-control">
											<!-- <input type="text" name="tgl_keluar" value="<?= date('d/m/Y') ?>" readonly class="form-control"> -->
										</div>
										<div class="form-group col-md-2">
											<label>Jam</label>
											<input type="text" name="jam_keluar" value="<?= date('H:i:s') ?>" readonly class="form-control">
										</div>
									</div>
									<div class="row">
										<div class="col-md-3">
											<h5>Data Karyawan</h5>
											<hr>
											<div class="form-row">
												<div class="form-group col-md-9">
													<label for="nama_customer">Nama Karyawan</label>
													<select name="nama_customer" id="nama_customer" class="form-control" required>
														<option value="">Pilih Karyawan</option>
														<?php foreach ($all_customer as $customer): ?>
															<option value="<?= $customer->nama ?>"><?= $customer->nama ?></option>
														<?php endforeach ?>
													</select>
												</div>
												<div class="form-group col-md-3">
													<label for="">&nbsp;</label>
													<button disabled type="button" class="btn btn-danger btn-block" id="reset"><i class="fa fa-times"></i></button>
												</div>
												<input type="hidden" name="nama_customer" value="">
											</div>
										</div>
										<div class="col-md-9">
											<h5>Data Stok Gudang</h5>
											<hr>
											<div class="form-row">
												<div class="form-group col-md-3">
													<label for="nama_barang">Jenis Kaos</label>
													<select name="nama_barang" id="nama_barang" class="form-control">
														<option value="">Pilih Jenis Kaos</option>
														<?php foreach ($all_barang as $barang): ?>
															<option value="<?= $barang->nama_barang?>"><?= $barang->nama_barang ?> </option>
														<?php endforeach ?>
													</select>
													<!-- Tambahan input nama barang hidden -->
													<input type="hidden" disabled name="nama_barang_hide" value="">
												</div>
												<div class="form-group col-md-3">
													<label for="warna">Warna Kaos</label>
													<select name="warna" id="warna" class="form-control" disabled>
														<option value="">Pilih Warna Kaos</option>
													</select>
												</div>
												<div class="form-group col-md-2">
													<label for="ukuran_kaos">Ukuran Kaos</label>
													<select name="ukuran_kaos" id="ukuran_kaos" class="form-control" disabled>
														<option value="">Ukuran Kaos</option>
													</select>
												</div>
												<div class="form-group col-md-2">
													<label>Kode Barang</label>
													<input type="text" name="kode_barang" value="" readonly class="form-control">
												</div>
												<div class="form-group col-md-1">
													<label>Jumlah</label>
													<input type="number" name="jumlah" value="" class="form-control" readonly min='1'>
												</div>
												<div class="form-group col-md-1">
													<label for="">&nbsp;</label>
													<button disabled type="button" class="btn btn-primary btn-block" id="tambah"><i class="fa fa-plus"></i></button>
												</div>
												<input type="hidden" name="satuan" value="">
											</div>
										</div>
									</div>
									<div class="keranjang">
										<h5>Detail Pengeluaran</h5>
										<hr>
										<table class="table table-bordered" id="keranjang">
											<thead>
												<tr>
													<td width="20%">Jenis Kaos</td>
													<td width="15%">Kode Kaos</td>
													<td width="15%">Warna Kaos</td>
													<td width="15%">Ukuran Kaos</td>
													<td width="10%">Jumlah</td>
													<td width="10%">Satuan</td>
													<td width="10%">Aksi</td>
												</tr>
											</thead>
											<tbody>
											</tbody>
										</table>
										<table>
											<tr>
												<td colspan="7" align="center">
														<input type="hidden" name="max_hidden" value="">
														<button type="submit" class="btn btn-primary"><i class="fa fa-save"></i>&nbsp;&nbsp;Simpan</button>
													</td>
												</tr>
										</table>
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
	<script>
		$(document).ready(function(){
			$('tfoot').hide()

			$(document).keypress(function(event){
		    	if (event.which == '13') {
		      		event.preventDefault();
			   	}
			})


			$('#nama_customer').on('change', function(){
				$(this).prop('disabled', true)
				$('#reset').prop('disabled', false)
				$('input[name="nama_customer"]').val($(this).val())
			})

			$(document).on('click', '#reset', function(){
				$('#nama_customer').val('')
				$('#nama_customer').prop('disabled', false)
				$(this).prop('disabled', true)
				$('input[name="nama_customer"]').val('')
			})

			// $('#nama_barang').on('change', function(){

			// 	if($(this).val() == '') reset()
			// 	else {
			// 		const url_get_all_barang = $('#content').data('url') + '/get_all_barang'
			// 		$.ajax({
			// 			url: url_get_all_barang,
			// 			type: 'POST',
			// 			dataType: 'json',
			// 			data: {nama_barang: $(this).val()},
			// 			success: function(data){
			// 				$('input[name="nama_barang_hide"]').val(data.nama_barang) //tambahkan nama barang
			// 				$('input[name="kode_barang"]').val(data.kode_barang)
			// 				$('input[name="harga_barang"]').val(data.harga_jual)
			// 				$('input[name="warna"]').val(data.warna)
			// 				$('input[name="ukuran_kaos"]').val(data.ukuran_kaos)
			// 				$('input[name="jumlah"]').val(1)
			// 				$('input[name="satuan"]').val(data.satuan)
			// 				$('input[name="max_hidden"]').val(data.stok)
			// 				$('input[name="jumlah"]').prop('readonly', false)
			// 				$('button#tambah').prop('disabled', false)

			// 				$('input[name="sub_total"]').val($('input[name="jumlah"]').val() * $('input[name="harga_barang"]').val())
							
			// 				$('input[name="jumlah"]').on('keydown keyup change blur', function(){
			// 					$('input[name="sub_total"]').val($('input[name="jumlah"]').val() * $('input[name="harga_barang"]').val())
			// 				})
			// 			}
			// 		})
			// 	}
			// })

			$('#nama_barang').on('change', function(){
				$('select[name="warna').prop('selectedIndex',0);
				$('select[name="warna"]').prop('disabled', true);
				$('select[name="ukuran_kaos').prop('selectedIndex',0);
				$('select[name="ukuran_kaos"]').prop('disabled', true);

				if($(this).val() == '') reset()
				else {
					const url_get_warna_barang = $('#content').data('url') + '/get_barang_warna'
					$.ajax({
						url: url_get_warna_barang,
						type: 'POST',
						dataType: 'json',
						data: {nama_barang: $(this).val()},
						success: function(data){
							$('select[name="warna"]').attr('disabled', false);
							$('select[name="warna"]').html("<option>Pilih Warna Kaos</option>");
							$.each(data, function (key, value) {
								$('select[name="warna"]').append($("<option></option>").attr("value", value.warna).text(value.warna))
							})

						}
					})
				}
			})

			$('#warna').on('change', function(){

				if($(this).val() == '') reset()
				else {
					const url_get_ukuran_barang = $('#content').data('url') + '/get_barang_ukuran'
					$.ajax({
						url: url_get_ukuran_barang,
						type: 'POST',
						dataType: 'json',
						data: {
							nama_barang: $('#nama_barang').val(), 
							warna: $(this).val()
						},
						success: function(data){
							$('select[name="ukuran_kaos"]').attr('disabled', false);
							$('select[name="ukuran_kaos"]').html("<option>Ukuran Kaos</option>");
							$.each(data, function (key, value) {
								$('select[name="ukuran_kaos"]').append($("<option></option>").attr("value", value.ukuran_kaos).text(value.ukuran_kaos))
							})
							
						}
					})
				}
			})

			$('#ukuran_kaos').on('change', function(){

				if($(this).val() == '') reset()
				else {
					const url_get_ukuran_barang = $('#content').data('url') + '/get_barang_detail'
					$.ajax({
						url: url_get_ukuran_barang,
						type: 'POST',
						dataType: 'json',
						data: {
							nama_barang: $('#nama_barang').val(), 
							warna: $('#warna').val(),
							ukuran_kaos: $(this).val()
						},
						success: function(data){
							
							$('input[name="nama_barang_hide"]').val(data.nama_barang) //tambahkan nama barang
							$('input[name="kode_barang"]').val(data.kode_barang)
							$('input[name="harga_barang"]').val(data.harga_jual)
							$('input[name="warna"]').val(data.warna)
							$('input[name="ukuran_kaos"]').val(data.ukuran_kaos)
							$('input[name="jumlah"]').val(1)
							$('input[name="satuan"]').val(data.satuan)
							$('input[name="max_hidden"]').val(data.stok)
							
							$('input[name="jumlah"]').prop('readonly', false)
							$('button#tambah').prop('disabled', false)

							$('input[name="sub_total"]').val($('input[name="jumlah"]').val() * $('input[name="harga_barang"]').val())
							
							$('input[name="jumlah"]').on('keydown keyup change blur', function(){
								$('input[name="sub_total"]').val($('input[name="jumlah"]').val() * $('input[name="harga_barang"]').val())
							})
						}
					})
				}
			})

			let x = [];

			$(document).on('click', '#tambah', function(e){
				const url_keranjang_barang = $('#content').data('url') + '/keranjang_barang'
				const data_keranjang = {
					nama_barang: $('input[name="nama_barang_hide"]').val(),
					// nama_barang: $('select[name="nama_barang"]').val(),
					kode_barang: $('input[name="kode_barang"]').val(),
					// warna: $('select[name="warna"]').val(),
					// ukuran_kaos: $('select[name="ukuran_kaos"]').val(),
					warna: $('select[name="warna"]').val(),
					ukuran_kaos: $('select[name="ukuran_kaos"]').val(),
					jumlah: $('input[name="jumlah"]').val(),
					satuan: $('input[name="satuan"]').val(),
				}

				if(x.includes(data_keranjang.nama_barang + " " + data_keranjang.warna + " " + data_keranjang.ukuran_kaos)){
					alert('stok tidak tersedia!');
					return;
				}else{
					x.push(data_keranjang.nama_barang + " " + data_keranjang.warna + " " + data_keranjang.ukuran_kaos);
				}

				if(parseInt($('input[name="max_hidden"]').val()) < parseInt(data_keranjang.jumlah)) {
					alert('stok tidak tersedia! stok tersedia : ' + parseInt($('input[name="max_hidden"]').val()))	
				}
				else {
					$.ajax({
						url: url_keranjang_barang,
						type: 'POST',
						data: data_keranjang,
						success: function(data){
							$('select[name="warna').prop('selectedIndex',0);
							$('select[name="warna"]').prop('disabled', true);
							$('select[name="ukuran_kaos').prop('selectedIndex',0);
							$('select[name="ukuran_kaos"]').prop('disabled', true);

							// if($('select[name="nama_barang"]').val() == data_keranjang.nama_barang) $('option[value="' + data_keranjang.nama_barang + '"]').hide()
							reset()

							$('table#keranjang tbody').append(data)
							$('tfoot').show()

							$('#total').html('<strong>' + hitung_total() + '</strong>')
							$('input[name="total_hidden"]').val(hitung_total())

							
						}
					})
				}
				
			})


			$(document).on('click', '#tombol-hapus', function(){
				$(this).closest('.row-keranjang').remove()
				barang = x.indexOf($(this).data('barang'));
				x.splice(barang,1);

				$('option[value="' + $(this).data('nama-barang') + '"]').show()

				if($('tbody').children().length == 0) $('tfoot').hide()
			})

			$('button[type="submit"]').on('click', function(){
				$('input[name="kode_barang"]').prop('disabled', true)
				$('select[name="nama_barang"]').prop('disabled', true)
				$('select[name="warna"]').prop('disabled', true)
				$('select[name="ukuran_kaos"]').prop('disabled', true)
				$('input[name="satuan"]').prop('disabled', true)
				$('input[name="jumlah"]').prop('disabled', true)
			})

			function hitung_total(){
				let total = 0;
				$('.sub_total').each(function(){
					total += parseInt($(this).text())
				})

				return total;
			}

			function reset(){
				$('#nama_barang').val('')
				$('input[name="kode_barang"]').val('')
				$('input[name="warna"]').val('')
				$('input[name="ukuran_kaos"]').val('')
				$('input[name="jumlah"]').val('')
				$('input[name="jumlah"]').prop('readonly', true)
				$('button#tambah').prop('disabled', true)
			}
		})
	</script>
</body>
</html>