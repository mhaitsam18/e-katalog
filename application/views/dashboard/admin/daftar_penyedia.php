<!DOCTYPE html>
<html lang="id">

<head>
	<?php $this->load->view('dashboard/admin/head.php') ?>

	<title>Daftar Penyedia | E-Katalog</title>

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
							<h1>Lihat Daftar Penyedia</h1>
						</div>
						<div class="col-sm-6">
							<ol class="breadcrumb float-sm-right">
								<li class="breadcrumb-item"><a href="<?= base_url('Admin') ?>">Beranda</a></li>
								<li class="breadcrumb-item active">Penyedia</li>
							</ol>
						</div>
					</div>
				</div><!-- /.container-fluid -->
			</section>
			<!-- Main content -->
			<section class="content">
				<div class="container-fluid">
					<div class="row mt-2">
						<div class="col-12">
							<div class="card">
								<div class="card-body">
									<table id="example1" class="table table-bordered table-striped">
										<thead>
											<tr>
												<th>No.</th>
												<th>Nama</th>
												<th>Alamat</th>
												<th>Nama Perusahaan</th>
												<th>Bank</th>
												<th>Nomor Rekening</th>
												<th>Aksi</th>
											</tr>
										</thead>
										<?php if (!empty($penyedia)) : ?>
											<tbody>
												<?php $i = 1; ?>
												<?php foreach ($penyedia as $p) : ?>
													<tr>
														<td><?= $i++ . '.'; ?></td>
														<td><?= $p->nama_penyedia ?></td>
														<td><?= $p->alamat_penyedia ?></td>
														<td><?= $p->nama_perusahaan ?></td>
														<td><?= $p->bank ?></td>
														<td><?= $p->norek ?></td>
														<td>
															<a href="<?= base_url('Admin/edit_penyedia/' . $p->id_penyedia); ?>" title="Edit" class="btn btn-secondary btn-sm mr-2 mb-2">
																<i class="fas fa-pen mr-1"></i> Edit
															</a>
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
					targets: 6
				}]
			});
		});
	</script>
</body>

</html>