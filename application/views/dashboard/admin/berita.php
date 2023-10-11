<!DOCTYPE html>
<html lang="id">

<head>
	<?php $this->load->view('dashboard/admin/head.php') ?>
	<title>Detail Berita | E-Katalog</title>
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
							<h1>Detail Berita</h1>
						</div>
						<div class="col-sm-6">
							<ol class="breadcrumb float-sm-right">
								<li class="breadcrumb-item"><a href="<?= base_url('Admin') ?>">Beranda</a></li>
								<li class="breadcrumb-item active"><a href="<?= base_url('Admin/berita') ?>">Berita</a></li>
								<li class="breadcrumb-item active"><?= character_limiter($berita->judul, 15); ?></li>
							</ol>
						</div>
					</div>
				</div><!-- /.container-fluid -->
			</section>

			<section class="content">
				<div class="container-fluid">
					<div class="row">
						<div class="col">
							<a href="<?= base_url('Admin/berita') ?>" class="btn btn-secondary btn-sm">
								<i class="fa fa-arrow-left mr-2"></i> Kembali ke daftar berita
							</a>
						</div>
					</div>
				</div>
			</section>

			<!-- Main content -->
			<section class="content">
				<div class="container-fluid">
					<div class="row mt-2">
						<!-- Detail Pengumuman -->
						<div class="col-12">
							<div class="card">
								<div class="card-body">
									<p class="text-sm text-muted">
										Ditulis oleh <?= $berita->nama_admin ?> &mdash; <?= tanggal($berita->tanggal) ?> dalam <span class="badge bg-info"><?= $berita->nama_kb ?></span>
									</p>

									<h2 class="text-left mb-4"><?= $berita->judul; ?></h2>

									<?php if (!empty($berita->gambar)) : ?>
										<div class="mb-4 text-center" style="width: 18rem;">
											<img src="<?= base_url('uploads/poster_berita/' . $berita->gambar) ?>" class="img-thumbnail" alt="Banner Berita">
										</div>
									<?php endif; ?>

									<div class="mt-2">
										<?= $this->security->xss_clean($berita->body) ?>
									</div>

									<div class="mt-4">
										Tags:
										<?php foreach ($tags as $tag) : ?>
											<a href="<?= base_url('Admin/tags/' . $tag->tag); ?>" class="badge bg-secondary text-decoration-none"><?= $tag->tag ?></a>
										<?php endforeach; ?>
									</div>
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