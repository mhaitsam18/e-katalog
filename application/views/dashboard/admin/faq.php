<!DOCTYPE html>
<html lang="id">

<head>
	<?php $this->load->view('dashboard/admin/head.php') ?>

	<title>Detail FAQ | E-Katalog</title>
</head>

<body class="hold-transition sidebar-mini">
	<div class="wrapper">
		<!-- Navbar -->
		<?php $this->load->view('dashboard/admin/navbar.php') ?>
		<!-- /.navbar -->

		<!-- Main Sidebar Container -->
		<?php $this->load->view('dashboard/admin/sidebar.php') ?>

		<!-- Content Wrapper. Contains page content -->
		<div class="content-wrapper">
			<!-- Content Header (Page header) -->
			<section class="content-header">
				<div class="container-fluid">
					<div class="row">
						<div class="col-sm-6">
							<h1>Detail FAQ</h1>
						</div>
						<div class="col-sm-6">
							<ol class="breadcrumb float-sm-right">
								<li class="breadcrumb-item"><a href="<?= base_url('Admin') ?>">Beranda</a></li>
								<li class="breadcrumb-item active"><a href="<?= base_url('Admin/faq') ?>">FAQ</a></li>
							</ol>
						</div>
					</div>
				</div><!-- /.container-fluid -->
			</section>

			<section class="content">
				<div class="container-fluid">
					<div class="row">
						<div class="col mb-3">
							<a href="<?= base_url('Admin/faq') ?>" class="btn btn-secondary btn-sm">
								<i class="fa fa-arrow-left mr-2"></i> Kembali ke daftar FAQ
							</a>
						</div>
					</div>
				</div>
			</section>

			<!-- Main content -->
			<section class="content">
				<div class="container-fluid">
					<div class="row mt-2">
						<div class="col-12">
							<div class="card">
								<div class="card-body">
									<h2 class="text-left mb-4"><?= $faq->pertanyaan; ?></h2>
									<h2 class="text-left mb-4"><?= $faq->jawaban; ?></h2>
									<h2 class="text-left mb-4"><?= $faq->nama_admin; ?></h2>
								</div>
								<!-- /.card-body -->
							</div>
							<!-- /.card -->
						</div>

					</div>
					<!-- /.row -->
				</div>
				<!-- /.container-fluid -->
			</section>
			<!-- /.content -->
		</div>
		<!-- /.content-wrapper -->
		<footer class="main-footer">
			<div class="float-right d-none d-sm-block">
				<b>Version</b> 3.2.0
			</div>
			<strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights reserved.
		</footer>
	</div>
	<!-- ./wrapper -->

	<?php $this->load->view('dashboard/admin/script.php') ?>
</body>

</html>