<!DOCTYPE html>
<html lang="en">

<style>
.rounded-image{
  border-radius: 200px;
  -webkit-border-radius: 200px;
  -moz-border-radius: 200px;
}
</style>

<head>

	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="">
	<meta name="author" content="">

	<title>Radjo Kaos - Login Users</title>
	<link href="<?= base_url('sb-admin') ?>/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
	<link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
	<link href="<?= base_url('sb-admin') ?>/img/logo.png" rel="icon">
	<link href="<?= base_url('sb-admin') ?>/css/sb-admin-2.min.css" rel="stylesheet">
	<link href="<?= base_url('sb-admin') ?>/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

</head>
<body class="bg-gradient-light">
	<div class="container">
		<!-- Outer Row -->
		<div class="row justify-content-left">
			<div class="col-sm-12 col-md-4">
				<div class="card o-hidden border-0 shadow-lg my-5">
					<div class="card-body p-0">
						<div class="row">
							<div class="col-lg-12">
								<div class="p-5">
									<div class="text-center">
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
										<img src="<?= base_url('sb-admin') ?>/img/logo.png" width="15%">
										<h1 class="h4 text-gray-900 mb-4">Radjo Kaos Jambi</h1>
									</div>
									<form class="user" method="POST" action="<?= base_url('login/proses_login') ?>">
										<div class="form-group">
											<input type="text" class="form-control" id="username" placeholder="Masukkan Username" autocomplete="off" required name="username">
										</div>
										<div class="form-group">
											<input type="password" class="form-control" id="password" placeholder="Masukkan Password" required name="password">
										</div>
										<div class="form-group">
											<select name="role" id="role" class="form-control" required>
												<option value="">Masuk Sebagai</option>
												<option value="petugas">Petugas</option>
												<option value="admin">Admin</option>
											</select>
										</div>
										<button type="submit" class="btn btn-primary btn-block" name="login">
											Login
										</button>
									</form>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-xl-8 col-md-12 mb-12">
				<div class="row">
					<div class="col-lg-10">
						<div class="p-5">
							<div class="text-center">
								<img class="rounded-image" src="<?= base_url('sb-admin') ?>/img/text.png" width="70%" height="70%">
								<p class="text-gray-900" align="justify"><br>
								<img src="<?= base_url('sb-admin') ?>/img/logo.png" width="5%">
								<b>Radjo Kaos Jambi,</b>
								Bagi Anda yang sangat menginginkan kenyamanan saat pemakaian kaos saat event atau saat gathering komunitas dapat menggunakan bahan dasar kaos cotton combed 30s dan jika Anda ingin Produksi/Konsultasi mengenai Kaos Cotton combed 30s, Silahkan hubungi Radjo Kaos untuk mendapatkan penjelasan bahan serta penawaran menarik dari kami.</p>
							</div>
						</div>
					</div>
        </div>
      </div>
		</div>
		<div class="row">
			<div class="col-xl-4 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-4">
          <div class="card-body">
            <div class="row no-gutters align-items-center">
              <div class="col mr-2">
                <a class="text-xs font-weight-bold text-primary text-uppercase mb-1">Jumlah Stok Gudang</a>
                <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $jumlah_barang ?> </div>
              </div>
              <div class="col-auto">
                <i class="fas fa-box fa-2x text-gray-300"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-xl-4 col-md-6 mb-4">
        <div class="card border-left-info shadow h-100 py-4">
          <div class="card-body">
            <div class="row no-gutters align-items-center">
              <div class="col mr-2">
                <a class="text-xs font-weight-bold text-info text-uppercase mb-1">Jumlah Pengeluaran</a>
                <div class="row no-gutters align-items-center">
                  <div class="col-auto">
                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?= $jumlah_pengeluaran ?></div>
                  </div>
                </div>
              </div>
              <div class="col-auto">
                <i class="fas fa-file-invoice fa-2x text-gray-300"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-xl-4 col-md-6 mb-4">
        <div class="card border-left-warning shadow h-100 py-4">
          <div class="card-body">
            <div class="row no-gutters align-items-center">
              <div class="col mr-2">
                <a class="text-xs font-weight-bold text-warning text-uppercase mb-1">Jumlah Penerimaan</a>
                <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $jumlah_penerimaan ?></div>
              </div>
              <div class="col-auto">
                <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
		</div>
		<div class="row">
			<div class="col-xl-4 text-center">
				<p class="text-gray-900 text-xs" align="justify"><br>
				<b>Lokasi :</b><br>
				Jl. Nusa Indah I No. 19 A Kel. Rawasari Kec. Alam Barajo – Kota Jambi
				(Depan Grand Hotel & Belakang Hotel Amanah) Kode Pos 36135</p>
			</div>
			<div class="col-xl-4 text-center">
				<p class="text-gray-900 text-xs" align="justify"><br>
				<b>Contact :</b><br>
				Telp. 0741-3613506 |<br>
				email : radjokaos@gmail.com |<br>
				<a href="www.radjokaos.com">www.radjokaos.com</a><br>
				HP/WA.  085381607080 / 085273384849</p>
			</div>
			<div class="col-xl-4 text-center">
				<p class="text-gray-900 text-xs" align="justify"><br>
				<b>About :</b><br>
				<b>Kain Cotton Combed 30s</b> merupakan kain yang terbuat dari serat kapas murni alami dengan karakteristik halus, nyaman, dan menyerap keringat. Cotton Combed 30s ini mengalami proses combing dimana proses ini membuat kain akan lebih halus.</p>
			</div>
		</div>
	</div>
	<script src="<?= base_url('sb-admin') ?>/vendor/jquery/jquery.min.js"></script>
	<script src="<?= base_url('sb-admin') ?>/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
	<script src="<?= base_url('sb-admin') ?>/vendor/jquery-easing/jquery.easing.min.js"></script>
	<script src="<?= base_url('sb-admin') ?>/js/sb-admin-2.min.js"></script>
</body>
</html>
