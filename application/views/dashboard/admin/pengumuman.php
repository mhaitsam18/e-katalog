<!DOCTYPE html>
<html lang="id">

<head>
	<?php $this->load->view('dashboard/admin/head.php') ?>
	<link rel="stylesheet" href="<?= base_url() ?>assets/dashboard/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
	<link rel="stylesheet" href="<?= base_url() ?>assets/dashboard/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">

	<title>Detail Pengumuman | E-Katalog</title>
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
							<h1>Detail Pengumuman</h1>
						</div>
						<div class="col-sm-6">
							<ol class="breadcrumb float-sm-right">
								<li class="breadcrumb-item"><a href="<?= base_url('Admin') ?>">Beranda</a></li>
								<li class="breadcrumb-item active"><a href="<?= base_url('Admin/pengumuman') ?>">Pengumuman</a></li>
								<li class="breadcrumb-item active"><?= character_limiter($pengumuman->judul, 15); ?></li>
							</ol>
						</div>
					</div>
				</div><!-- /.container-fluid -->
			</section>

			<section class="content">
				<div class="container-fluid">
					<div class="row">
						<div class="col">
							<a href="<?= base_url('Admin/pengumuman') ?>" class="btn btn-secondary btn-sm">
								<i class="fa fa-arrow-left mr-2"></i> Kembali ke daftar pengumuman
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
									<h2><?= $pengumuman->judul; ?></h2>

									<strong class="d-block">Etalase</strong>
									<p><?= $pengumuman->nama_etalase; ?></p>

									<strong class="d-block">Jumlah Penawaran</strong>
									<p><?= $pengumuman->jumlah_penawaran ?? '-'; ?></p>

									<strong class="d-block">Syarat & Ketentuan</strong>
									<div class="mb-2">
										<?= $pengumuman->syarat_ketentuan ?? '-'; ?>
									</div>

									<strong class="d-block">Dokumen Pengumuman</strong>
									<p>
										<?php if (!empty($pengumuman->dok_pengumuman)) : ?>
											<a target="_blank" href="<?= base_url() ?>uploads/dokumen_pengumuman/<?= $pengumuman->dok_pengumuman ?>" rel="noopener noreferer">
												<?= $pengumuman->dok_pengumuman ?>
											</a>
										<?php else : ?>
											-
										<?php endif; ?>
									</p>
								</div>
								<!-- /.card-body -->
							</div>
							<!-- /.card -->
						</div>
						<!-- /.col -->

						<!-- Daftar Merek -->
						<div class="col-12">
							<div class="card">
								<div class="card-header">
									<strong>Daftar Merek</strong>
								</div>
								<div class="card-body">
									<table id="example1" class="table table-bordered table-striped">
										<thead>
											<tr>
												<th>No.</th>
												<th>Nama Etalase</th>
												<th>Nama Merek</th>
												<th>Deskripsi</th>
											</tr>
										</thead>
										<?php if (!empty($merek)) : ?>
											<tbody>
												<?php $i = 1; ?>
												<?php foreach ($merek as $m) : ?>
													<tr>
														<td><?= $i++; ?></td>
														<td><?= $m->nama_merek ?></td>
														<td><?= $m->nama_etalase; ?></td>
														<td><?= $m->deskripsi; ?></td>
													</tr>
												<?php endforeach; ?>
											</tbody>
										<?php endif; ?>
									</table>
								</div>
							</div>
						</div>

						<!-- Tahapan pengumuman -->
						<div class="col-12">
							<div class="card">
								<div class="card-header">
									<strong>Jadwal Pengadaan <?= $pengumuman->judul ?></strong>
								</div>
								<div class="card-body">
									<table class="table table-bordered">
										<thead>
											<tr>
												<th>Tahapan</th>
												<th>Tanggal Mulai</th>
												<th>Tanggal Akhir</th>
												<th>Perubahan</th>
											</tr>
										</thead>
										<tbody>
											<?php if (!empty($tahapan)) : ?>
												<?php $i = 1; ?>
												<?php foreach ($tahapan as $data) : ?>
													<tr>
														<td><?= $i++; ?></td>
														<td><?= $data->judul ?></td>
														<td><?= tanggal($data->tanggal_mulai); ?></td>
														<td><?= tanggal($data->tanggal_akhir); ?></td>
														<td><?= $data->perubahan; ?></td>
													</tr>
												<?php endforeach; ?>
											<?php else : ?>
												<tr>
													<td colspan="4" align="center">Tidak ada tahapan pengumuman</td>
												</tr>
											<?php endif; ?>
										</tbody>
									</table>
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
	<script src="<?= base_url('assets\dashboard\plugins\datatables\jquery.dataTables.min.js') ?>"></script>
	<script src="<?= base_url('assets\dashboard\plugins\datatables-bs4\js\dataTables.bootstrap4.min.js') ?>"></script>
	<script>
		$(function() {
			$("#example1").DataTable({
				"responsive": true,
				"autoWidth": false,
				"columnDefs": [{
					"width": "max(20%, 200px)",
					"targets": 3
				}],
				"language": {
					"emptyTable": "Tidak ada daftar merek untuk pengumuman ini"
				}
			});
		});
	</script>
</body>

</html>