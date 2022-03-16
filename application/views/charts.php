<html lang="en">
<head>
	<?php $this->load->view('partials/head.php') ?>
</head>

<body id="page-top">
	<div id="wrapper">
		<!-- load sidebar -->
		<?php $this->load->view('partials/sidebar.php') ?>

		<div id="content-wrapper" class="d-flex flex-column">
			<div id="content" data-url="<?= base_url('charts') ?>">
				<!-- load Topbar -->
				<?php $this->load->view('partials/topbar.php') ?>

				<div class="container-fluid">
					<div class="clearfix">
						<div class="float-left">
							<h1 class="h3 m-0 text-gray-800"><?= $title ?></h1>
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
				</div>
			</div>
			
			<div class="container-fluid">
	            <!-- Page Heading -->
	            <p class="mb-4">Halaman Grafik Radjo Kaos Untuk Melihat Perkembangan Stok Gudang Yang Tersedia Saat Ini</p>
				<div class="row">
					<div class="form-group col-md-2">
					<label for="type_chart"><strong>Pilih Jenis Stok</strong></label>
					<select type="text" name="type_chart" id="type_chart" class="form-control" required>
						<!-- <option value="">-- Pilih Grafik --</option> -->
						<option value="Pengeluaran">Pengeluaran</option>
						<option value="Pemasukan">Pemasukan</option>
					</select>
					</div>
					<div class="form-group col-md-2">
						<label for="time_chart"><strong>Pilih Grafik</strong></label>
						<select type="text" name="time_chart" id="time_chart" class="form-control" required>
							<!-- <option value="">-- Pilih Grafik --</option> -->
							<option value="Mingguan">Mingguan</option>
							<option value="Bulanan">Bulanan</option>
						</select>
					</div>
				</div>
				<!-- Content Row -->
				<div class="row">
					<!-- Area Chart -->
					<div class="col-md-8">
							<div class="card shadow">
									<!-- Card Header - Dropdown -->
									<div
											class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
											<h6 class="m-0 font-weight-bold text-primary" id="title-grafik">Grafik Stok</h6>
									</div>
									<!-- Card Body -->
									<div class="card-body">
											<div class="chart-bar">
												<!-- <canvas id="myBarChart"></canvas> -->
												<!-- <div class="d-flex justify-content-center">
													<div class="fa-3x loading-bar">
														<i class="fas fa-sync fa-spin"></i>
													</div>
												</div> -->
											</div>
									</div>
							</div>
					</div>
					<!-- Pie Chart -->
					<div class="col-md-4">
							<div class="card shadow">
									<!-- Card Header - Dropdown -->
									<div
											class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
											<h6 class="m-0 font-weight-bold text-primary">Stok Ukuran Baju</h6>
									</div>
									<!-- Card Body -->
									<div class="card-body">
											<div class="chart-pie">
													<canvas id="myPieChart"></canvas>
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

	<?php 
		$label_pie = null;
		$stok_pie = null;
		foreach($chart_stok_barang as $c){
			$label_pie[] = $c->ukuran_kaos; 
			$stok_pie[] = $c->stok;
		}
	?>

	<script type="text/javascript">

		const chart_labels_pie = <?= json_encode($label_pie) ?>;
		const chart_datas_pie = <?= json_encode($stok_pie) ?>;

		getChart({
			type: $('#type_chart').val() , 
			time: $('#time_chart').val()
		});

		$('#type_chart').on('change', function(){
			const data = {
				type: this.value,
				time: $('#time_chart').val()
			}
			getChart(data);
		});

		$('#time_chart').on('change', function(){
			const data = {
				type: $('#type_chart').val(),
				time: this.value
			}
			getChart(data);
		});

		let chart_labels_bar;
		let chart_datas_bar;
		
		async function getChart(data) {
			const postData = new FormData();
			postData.append("type", data.type);
			postData.append("time", data.time);
			
			$('.chart-bar').html(`
				<div class="d-flex justify-content-center align-items-center h-100">
					<div class="fa-3x loading-bar">
						<i class="fas fa-sync fa-spin"></i>
					</div>
				</div>
			`);

			await fetch('<?= base_url("charts/get_chart") ?>',{
				method: "POST",
				body: postData,
			})
			.then(response => response.json())
			.then(res => {
				$('#title-grafik').text(`Grafik Stok ${data.type}`);
				$('.chart-bar').html('<canvas id="myBarChart"></canvas>');
				chart_labels_bar = res.labels;
				chart_datas_bar = res.datas;
				chart_bar();
			})
		}

	</script>
	<script src="<?= base_url('sb-admin') ?>/vendor/chart.js/Chart.min.js"></script>
	<script src="<?= base_url('sb-admin/js/mychart/chart-bar.js') ?>"></script>
	<script src="<?= base_url('sb-admin/js/mychart/chart-pie.js') ?>"></script>
	<script src="<?= base_url('sb-admin/js/demo/datatables-demo.js') ?>"></script>
	<script src="<?= base_url('sb-admin') ?>/vendor/datatables/jquery.dataTables.min.js"></script>
	<script src="<?= base_url('sb-admin') ?>/vendor/datatables/dataTables.bootstrap4.min.js"></script>
</body>
</html>