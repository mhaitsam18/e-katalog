<!DOCTYPE html>
<html lang="id">

<head>
	<?php $this->load->view('dashboard/admin/head') ?>
	<title>Merek Pengumuman | E-Katalog</title>
	<link rel="stylesheet" href="<?= base_url() ?>assets/dashboard/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
	<link rel="stylesheet" href="<?= base_url() ?>assets/dashboard/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
</head>

<body class="hold-transition sidebar-mini">
	<div class="wrapper">
		<!-- Navbar -->
		<?php $this->load->view('dashboard/admin/navbar') ?>
		<!-- /.navbar -->

		<!-- Main Sidebar Container -->
		<?php $this->load->view('dashboard/admin/sidebar') ?>

		<!-- Content Wrapper. Contains page content -->
		<div class="content-wrapper">
			<!-- Content Header (Page header) -->
			<section class="content-header">
				<div class="container-fluid">
					<div class="row mb-2">
						<div class="col-sm-6">
							<h1>Daftar Merek Pengumuman</h1>
						</div>
						<div class="col-sm-6">
							<ol class="breadcrumb float-sm-right">
								<li class="breadcrumb-item"><a href="<?= base_url('Admin') ?>">Beranda</a></li>
								<li class="breadcrumb-item"><a href="<?= base_url('Admin/pengumuman') ?>">Pengumuman</a></li>
								<li class="breadcrumb-item active">Merek</li>
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
							<div class="card card-primary">
								<div class="card-header">
									<h3 class="card-title"><b style="color:white">Data Merek</b></h3>
								</div>
								<!-- /.card-header -->
								<div class="card-body" style="background-color:white">
									<div class="modal-body">
										<div class="row">
											<div class="col-md-12">
												<table id="example1" class="table table-bordered table-striped">
													<thead>
														<th>No</th>
														<th>Nama Merek</th>
														<th>Deskripsi</th>
														<th>Aksi</th>
													</thead>
													<tbody>
														<?php $no = 1;
														foreach ($merek as $data) : ?>
															<tr>
																<td><?= $no++ ?></td>
																<td><?= $data->nama_merek ?></td>
																<td><?= $data->deskripsi ?></td>
																<td>
																	<a href="<?= base_url() ?>Admin/hapus_merek/<?= $data->id_merek ?>" class="btn btn-danger">
																		<i class="fas fa-trash"></i>
																		Hapus</a>
																</td>
															</tr>
														<?php endforeach; ?>
													</tbody>
												</table>
											</div>
										</div>
									</div>
									<a href="<?= base_url() ?>Admin/pengumuman" class="btn btn-dark">
										<i class="fas fa-angle-double-left"></i>
										Kembali</a>
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

	<!-- jQuery -->
	<?php $this->load->view('dashboard/admin/script') ?>
	<script src="<?= base_url('assets/dashboard/plugins/datatables/jquery.dataTables.min.js') ?>"></script>
	<script src="<?= base_url('assets/dashboard/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') ?>"></script>
	<script>
		$(function() {
			$("#example1").DataTable({
				"responsive": true,
				"autoWidth": false,
				"columnDefs": [{
					"orderable": false,
					targets: 3
				}]
			});
		});
	</script>
</body>

</html>