<!DOCTYPE html>
<html lang="id">

<head>
	<?php $this->load->view('dashboard/admin/head.php') ?>

	<title>Daftar Berita | E-Katalog</title>

	<link rel="stylesheet" href="<?= base_url() ?>assets/dashboard/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
	<link rel="stylesheet" href="<?= base_url() ?>assets/dashboard/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
	<link rel="stylesheet" href="<?= base_url() ?>assets/dashboard/plugins/sweetalert2/sweetalert2.min.css">
</head>

<body class="hold-transition sidebar-mini">

	<?php if ($this->session->flashdata('flash')) : ?>
		<div class="flash-data" data-flashdata="<?= $this->session->flashdata('flash'); ?>"></div>
	<?php endif; ?>

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
					<div class="row mb-2">
						<div class="col-sm-6">
							<h1>Lihat Daftar Berita <?= isset($kb->nama_kb) ? 'Kategori ' . $kb->nama_kb : '' ?></h1>
							<a href="<?= base_url('/Admin/tambah_berita') ?>" class="btn btn-primary mt-3">
								Tambah Berita
							</a>
							<a href="<?= base_url('/Admin/tambah_tags') ?>" class="btn btn-warning mt-3 ml-3">
								Tambah Tags
							</a>
						</div>

						<div class="col-sm-6">
							<ol class="breadcrumb float-sm-right">
								<li class="breadcrumb-item"><a href="<?= base_url('Admin') ?>">Beranda</a></li>
								<?php if (!isset($kb)) : ?>
									<li class="breadcrumb-item active">Berita</li>
								<?php else : ?>
									<li class="breadcrumb-item active"><a href="<?= base_url('Admin/berita') ?>">Berita</a></li>
									<li class="breadcrumb-item active"><?= $kb->nama_kb ?></li>
								<?php endif; ?>
							</ol>
						</div>
					</div>
				</div><!-- /.container-fluid -->
			</section>
			<!-- Main content -->
			<section class="content">
				<div class="container-fluid">
					<div class="row">
						<div class="col-12">
							<div class="card">
								<?php if (isset($kb)) : ?>
									<div class="card-header">
										<a href="<?= base_url('Admin/berita') ?>" class="btn btn-secondary btn-sm">
											<i class="fa fa-arrow-left mr-2"></i> Kembali lihat semua berita
										</a>
									</div>
								<?php endif; ?>
								<div class="card-body">
									<table id="example1" class="table table-bordered table-striped">
										<thead>
											<tr>
												<th>No.</th>
												<th>Judul Berita</th>
												<th>Tanggal</th>
												<th>Kategori</th>
												<th>Aksi</th>
											</tr>
										</thead>
										<?php if (! empty($berita)) : ?>
											<tbody>
												<?php $i = 1; ?>
												<?php foreach ($berita as $b) : ?>
													<tr>
														<td><?= $i++ . '.'; ?></td>
														<td><?= $b->judul ?></td>
														<td><?= tanggal($b->tanggal) ?></td>
														<td>
															<a href="<?= base_url('Admin/kategori_berita/' . $b->id_kb); ?>"><?= $b->nama_kb ?? $kb->nama_kb ?></a>
														</td>
														<td width="25%">
															<a href="<?= base_url('Admin/berita/' . $b->id_berita); ?>" title="Lihat Detail" class="btn btn-info btn-sm mb-1">
																<i class="fas fa-eye mr-1"></i> Lihat Detail
															</a>
															<a href="<?= base_url('Admin/edit_berita/' . $b->id_berita); ?>" title="Edit" class="btn btn-primary btn-sm mb-1">
																<i class="fas fa-pen mr-1"></i> Edit
															</a>
															<a href="<?= base_url('Admin/hapus_berita/' . $b->id_berita) . '/' . $b->gambar; ?>" title="Hapus" class="btn btn-danger btn-sm mb-1 tombol-hapus">
																<i class="fas fa-trash mr-1"></i> Hapus
															</a>
														</td>
													</tr>
												<?php endforeach; ?>
											</tbody>
										<?php endif; ?>
										<tfoot>
									</table>
								</div>
								<!-- /.card-body -->
							</div>
							<!-- /.card -->
						</div>
						<!-- /.col -->
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
	<script src="<?= base_url('assets/dashboard/plugins/sweetalert2/sweetalert2.min.js') ?>"></script>
	<script src="<?= base_url('assets/dashboard/plugins/datatables/jquery.dataTables.min.js') ?>"></script>
	<script src="<?= base_url('assets/dashboard/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') ?>"></script>
	<script src="<?= base_url() ?>assets/dashboard/dist/js/delete-button.js"></script>
	<script src="<?= base_url() ?>assets/dashboard/dist/js/flash.js"></script>
	<script>
		$(function() {
			$("#example1").DataTable({
				"responsive": true,
				"autoWidth": false,
				"columnDefs": [{
					"orderable": false,
					targets: 4
				}]
			});
		});
	</script>
</body>

</html>