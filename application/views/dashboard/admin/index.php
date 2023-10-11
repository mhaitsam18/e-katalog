<!DOCTYPE html>
<html lang="id">

<head>
	<?php $this->load->view('dashboard/admin/head.php') ?>
	<title>Dashboard | E-Katalog</title>
</head>

<body class="hold-transition sidebar-mini layout-fixed">
	<div class="wrapper">

		<!-- Preloader -->
		<div class="preloader flex-column justify-content-center align-items-center">
			<img class="animation__shake" src="<?= base_url() ?>assets/landingpage/img/logotransparan.png" alt="E-catalog Logo" height="60" width="60">
		</div>

		<!-- Navbar -->
		<?php $this->load->view('dashboard/admin/navbar') ?>
		<!-- /.navbar -->

		<!-- Main Sidebar Container -->
		<?php $this->load->view('dashboard/admin/sidebar') ?>

		<!-- Content Wrapper. Contains page content -->
		<div class="content-wrapper">
			<!-- Content Header (Page header) -->
			<div class="content-header">
				<div class="container-fluid">
					<div class="row mb-2">
						<div class="col-sm-6">
							<h1 class="m-0">Selamat Datang</h1>
						</div><!-- /.col -->
						<div class="col-sm-6">
							<ol class="breadcrumb float-sm-right">
								<li class="breadcrumb-item">Beranda</li>
								<li class="breadcrumb-item active">Dashboard</li>
							</ol>
						</div><!-- /.col -->
					</div><!-- /.row -->
				</div><!-- /.container-fluid -->
			</div>
			<!-- /.content-header -->

			<!-- Main content -->
			<section class="content">
				<div class="container-fluid">
					<div class="row">
						<div class="col-12">
							<h2 class="h4">Ringkasan Data</h2>
						</div>
					</div>

					<div class="row">
						<div class="col-12 col-sm-6 col-md-3">
							<a href="<?= base_url('Admin/etalase_produk') ?>" class="text-decoration-none text-dark">
								<div class="info-box">
									<span class="info-box-icon bg-gray elevation-1"><i class="fas fa-shopping-bag"></i></span>
		
									<div class="info-box-content">
										<span class="info-box-text">Jumlah Etalase</span>
										<span class="info-box-number">
											<?= $jml_etalase ?>
										</span>
									</div>
									<!-- /.info-box-content -->
								</div>
								<!-- /.info-box -->
							</a>
						</div>
						<!-- /.col -->
						<div class="col-12 col-sm-6 col-md-3">
							<a href="<?= base_url('Admin/pengumuman') ?>" class="text-decoration-none text-dark">
								<div class="info-box">
									<span class="info-box-icon bg-gray elevation-1"><i class="fas fa-bullhorn"></i></span>
		
									<div class="info-box-content">
										<span class="info-box-text">Jumlah Pengumuman</span>
										<span class="info-box-number">
											<?= $jml_pengumuman ?>
										</span>
									</div>
									<!-- /.info-box-content -->
								</div>
								<!-- /.info-box -->
							</a>
						</div>
						<!-- /.col -->
						<div class="col-12 col-sm-6 col-md-3">
							<a href="<?= base_url('Admin/berita') ?>" class="text-decoration-none text-dark">
								<div class="info-box">
									<span class="info-box-icon bg-gray elevation-1"><i class="fas fa-newspaper"></i></span>
		
									<div class="info-box-content">
										<span class="info-box-text">Jumlah Berita</span>
										<span class="info-box-number">
											<?= $jml_berita ?>
										</span>
									</div>
									<!-- /.info-box-content -->
								</div>
								<!-- /.info-box -->
							</a>
						</div>
						<!-- /.col -->
						<div class="col-12 col-sm-6 col-md-3">
							<a href="<?= base_url('Admin/unduhan') ?>" class="text-decoration-none text-dark">
								<div class="info-box">
									<span class="info-box-icon bg-gray elevation-1"><i class="fas fa-download"></i></span>
		
									<div class="info-box-content">
										<span class="info-box-text">Jml File Unduhan</span>
										<span class="info-box-number">
											<?= $jml_unduhan ?>
										</span>
									</div>
									<!-- /.info-box-content -->
								</div>
								<!-- /.info-box -->
							</a>
						</div>
						<!-- /.col -->
					</div>

					<div class="row mt-4">
						<div class="col-12">
							<h2 class="h4">Data Paket</h2>
						</div>
					</div>

					<div class="row">
						<div class="col-lg-3 col-6">
							<!-- small box -->
							<div class="small-box bg-light">
								<div class="inner">
									<h3><?= $diproses ?></h3>

									<p>Paket Diproses</p>
								</div>
								<div class="icon">
									<i class="fas fa-square"></i>
								</div>
								<a href="<?= base_url('Admin/paket_diproses'); ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
							</div>
						</div>
						<!-- ./col -->
						<div class="col-lg-3 col-6">
							<!-- small box -->
							<div class="small-box bg-warning">
								<div class="inner">
									<h3><?= $dinegosiasi; ?></h3>

									<p>Paket Dinegosiasi</p>
								</div>
								<div class="icon">
									<i class="fas fa-handshake"></i>
								</div>
								<a href="<?= base_url('Admin/paket_dinegosiasi'); ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
							</div>
						</div>
						<!-- ./col -->
						<div class="col-lg-3 col-6">
							<!-- small box -->
							<div class="small-box bg-info">
								<div class="inner">
									<h3><?= $dikirim ?></h3>

									<p>Paket Dikirim</p>
								</div>
								<div class="icon">
									<i class="fas fa-shipping-fast"></i>
								</div>
								<a href="<?= base_url('Admin/paket_dikirim') ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
							</div>
						</div>
						<!-- ./col -->
						<div class="col-lg-3 col-6">
							<!-- small box -->
							<div class="small-box bg-success">
								<div class="inner">
									<h3><?= $selesai ?></h3>

									<p>Paket Selesai</p>
								</div>
								<div class="icon">
									<i class="fas fa-check-square"></i>
								</div>
								<a href="<?= base_url('Admin/paket_selesai') ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
							</div>
						</div>
						<!-- ./col -->
					</div>
					<!-- /.row -->

					<!-- Main row -->
					<div class="row">
						<section class="col-12">
							<!-- Custom tabs (Charts with tabs)-->
							<div class="card">
								<div class="card-header">
									<h3 class="card-title">
										<i class="fas fa-chart-pie mr-1"></i>
										Paket, jumlah semua paket: <strong><?= $jml_paket ?></strong>
									</h3>
								</div><!-- /.card-header -->
								<div class="card-body">
											<canvas id="all-chart-canvas" height="300" style="height: 300px;"></canvas>
								</div><!-- /.card-body -->
							</div>
							<!-- /.card -->
						</section>
					</div>
					<!-- /.row (main row) -->
				</div><!-- /.container-fluid -->
			</section>
			<!-- /.content -->
		</div>
		<!-- /.content-wrapper -->
		<footer class="main-footer">
			<strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong>
			All rights reserved.
			<div class="float-right d-none d-sm-inline-block">
				<b>Version</b> 3.2.0
			</div>
		</footer>

	</div>
	<!-- ./wrapper -->

	<?php $this->load->view('dashboard/admin/script') ?>
	<script src="<?= base_url(); ?>assets/dashboard/plugins/chart.js/Chart.min.js"></script>
	<script>
  // Donut Chart
  var pieChartCanvas = document.getElementById('all-chart-canvas').getContext('2d')
  var pieData = {
    labels: [
      'Paket Diproses',
      'Paket Dinegosiasi',
      'Paket Dikirim',
			'Paket Selesai',
			'Paket Ditolak'
    ],
    datasets: [
      {
        data: [<?= $diproses ?>, <?= $dinegosiasi ?>, <?= $dikirim ?>, <?= $selesai ?>, <?= $ditolak ?>],
        backgroundColor: ['#d7d7d7', '#ffc107', '#17a2b8', '#28a745', '#dc3545']
      }
    ]
  }
  var pieOptions = {
    legend: {
      display: false
    },
    maintainAspectRatio: false,
    responsive: true
  }

  var pieChart = new Chart(pieChartCanvas, {
    type: 'doughnut',
    data: pieData,
    options: pieOptions
  });
	</script>
</body>

</html>