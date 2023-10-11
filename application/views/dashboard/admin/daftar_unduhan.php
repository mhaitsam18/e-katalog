<!DOCTYPE html>
<html lang="id">

<head>
	<?php $this->load->view("dashboard/admin/head.php"); ?>

	<title>Daftar Unduhan | E-Katalog</title>

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
		<?php $this->load->view("dashboard/admin/navbar.php"); ?>
		<!-- /.navbar -->

		<!-- Main Sidebar Container -->
		<?php $this->load->view("dashboard/admin/sidebar.php"); ?>

		<!-- Content Wrapper. Contains page content -->
		<div class="content-wrapper">
			<!-- Content Header (Page header) -->
			<section class="content-header">
				<div class="container-fluid">
					<div class="row mb-2">
						<div class="col-sm-6">
							<h1>Lihat Daftar Unduhan</h1>
						</div>
						<div class="col-sm-6">
							<ol class="breadcrumb float-sm-right">
								<li class="breadcrumb-item"><a href="<?= base_url('Admin') ?>">Beranda</a></li>
								<?php if (! isset($ku)) : ?>
									<li class="breadcrumb-item active">Unduhan</li>
								<?php else : ?>
									<li class="breadcrumb-item active"><a href="<?= base_url('Admin/unduhan') ?>">Unduhan</a></li>
									<li class="breadcrumb-item active"><?= $ku->nama_ku ?></li>
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
						<div class="col">
							<?php if (! isset($ku)) : ?>
								<a href="<?= base_url('Admin/tambah_unduhan') ?>" class="btn btn-primary">
									<i class="fas fa-plus mr-1"></i>
									Tambah Unduhan</a>
							<?php else : ?>
								<a href="<?= base_url('Admin/unduhan') ?>" class="btn btn-secondary btn-sm">
									<i class="fa fa-arrow-left mr-2"></i> 
									Kembali lihat semua unduhan
								</a>
							<?php endif; ?>
						</div>
					</div>

					<div class="row mt-2">
						<div class="col-12">
							<div class="card">
								<div class="card-body">
									<table id="example1" class="table table-bordered table-striped">
										<thead>
											<tr>
												<th>No.</th>
												<th>Nama Unduhan</th>
												<th>Tanggal</th>
												<th>Kategori</th>
												<th>Admin</th>
												<th>Aksi</th>
											</tr>
										</thead>
										<?php if (! empty($unduhan)) : ?>
											<tbody>
												<?php $i = 1; ?>
												<?php foreach ($unduhan as $u) : ?>
													<tr>
														<td><?= $i++ . '.'; ?></td>
														<td><?= $u->nama_unduhan; ?></td>
														<td><?= tanggal($u->tanggal); ?></td>
														<td>
															<a href="<?= base_url('Admin/kategori_unduhan/' . $u->id_ku); ?>"><?= $u->nama_ku ?? $ku->nama_ku ?></a>
														</td>
														<td><?= $u->nama_admin; ?></td>

														<td>
															<a href="<?= base_url('uploads/file_unduhan/' . $u->file); ?>" title="Unduh berkas" class="btn btn-info btn-sm mb-1" download>
																<i class="fas fa-download mr-1"></i> Unduh Berkas
															</a>
															<a href="<?= base_url('Admin/edit_unduhan/' . $u->id_unduhan); ?>" title="Edit" class="btn btn-primary btn-sm mb-1">
																<i class="fas fa-pen mr-1"></i> Edit
															</a>
															<button title="Hapus" name="hapus-unduhan" value="<?= $u->id_unduhan; ?>" class="btn btn-danger btn-sm mr-1 mb-1 tombol-hapus" form="form-hapus">
																<i class="fas fa-regular fa-trash mr-1"></i> Hapus
															</button>
														</td>
													</tr>
												<?php endforeach; ?>
											</tbody>
										<?php endif; ?>
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

				<?= form_open(base_url('Admin/hapus_unduhan'), ['id' => 'form-hapus']); ?>
				<?= form_close(); ?>
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

	<!-- jQuery -->
	<?php $this->load->view("dashboard/admin/script.php"); ?>
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
					targets: 5
				}]
			});
		});
	</script>
</body>

</html>