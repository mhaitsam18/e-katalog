<!DOCTYPE html>
<html lang="id">

<head>
	<?php $this->load->view('dashboard/admin/head.php') ?>
	<title>Riwayat Paket | E-Katalog</title>
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
							<h1>Riwayat Paket</h1>
						</div>
						<div class="col-sm-6">
							<ol class="breadcrumb float-sm-right">
								<li class="breadcrumb-item"><a href="<?= base_url('Admin') ?>">Beranda</a></li>
								<li class="breadcrumb-item active"><?= ucwords(str_replace('_', ' ', $this->session->daftar_paket)) ?></li>
							</ol>
						</div>
					</div>
				</div><!-- /.container-fluid -->
			</section>

			<section class="content">
				<div class="container-fluid">
					<div class="row">
						<div class="col">
							<a href="<?= base_url('Admin/paket/' . $id_paket) ?>" class="btn btn-secondary btn-sm">
								<i class="fa fa-arrow-left mr-2"></i> Kembali ke Detail Paket
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
							<div class="timeline">
								<?php foreach ($riwayat as $tanggal => $data) : ?>
									<div class="time-label">
										<span class="bg-red"><?= $tanggal ?></span>
									</div>
									<?php foreach ($data as $r) : ?>
										<div>
											<i class="fas fa-history bg-blue"></i>
											<div class="timeline-item">
												<span class="time"><i class="fas fa-clock mr-1"></i><?= $r['waktu'] ?></span>
												<h3 class="timeline-header"><?= str_replace('_', ' ', trim($r['aksi'], ', ')); ?></h3>

												<?php $this->load->view('dashboard/admin/timeline_body/'.$hlm, ['data' => $r['item_riwayat']]) ?>
											</div>
										</div>
									<?php endforeach; ?>
								<?php endforeach; ?>

								<div>
									<i class="fas fa-clock bg-gray"></i>
								</div>
							</div>
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

		<!-- Control Sidebar -->
		<aside class="control-sidebar control-sidebar-dark">
			<!-- Control sidebar content goes here -->
		</aside>
		<!-- /.control-sidebar -->
	</div>
	<!-- ./wrapper -->

	<?php $this->load->view('dashboard/admin/script.php') ?>
</body>

</html>