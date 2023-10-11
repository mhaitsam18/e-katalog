<!DOCTYPE html>
<html lang="id">
	<head>
		<?php $this->load->view("dashboard/admin/head.php"); ?>
		<link rel="stylesheet" href="<?= base_url() ?>assets/dashboard/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
		<link rel="stylesheet" href="<?= base_url() ?>assets/dashboard/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
	</head>

<body class="hold-transition sidebar-mini">
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
							<h1>Daftar Paket Baru Dibuat</h1>
						</div>
						<div class="col-sm-6">
							<ol class="breadcrumb float-sm-right">
								<li class="breadcrumb-item"><a href="<?= base_url('Admin') ?>">Beranda</a></li>
								<li class="breadcrumb-item active"><?= ucwords(str_replace('_', ' ', $this->uri->segment(2))) ?></li>
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
								<!-- /.card-header -->
								<div class="card-body">
									<table id="example1" class="table table-bordered table-striped">
										<thead>
											<tr>
												<th>No.</th>
												<th>Nama paket</th>
												<th>PUMK</th>
												<th>PP</th>
												<th>PK</th>
												<th>Status</th>
												<th>Aksi</th>
											</tr>
										</thead>
										<?php if (! empty($paket)) : ?>
											<tbody>
												<?php $i = 1; ?>
												<?php foreach ($paket as $p) : ?>
													<tr>
														<td><?= $i++.'.'; ?></td>
														<td><?= $p->nama_paket ?></td>
														<td><?= $p->nama_pumk ?></td>
														<td><?= $p->nama_pp ?></td>
														<td><?= $p->nama_pk ?></td>
														<td><?= status_paket($p->status); ?></td>
														<td>
															<a href="<?= base_url('Admin/paket/' . $p->id_paket); ?>" title="Lihat Detail Paket" class="btn btn-info btn-sm mb-1">
																<i class="fas fa-eye mr-1"></i>Detail
															</a>

															<?php if($p->status < 2): ?>
															<a href="<?= base_url('kak/' . $p->link); ?>" title="Lihat KAK" class="btn btn-info btn-sm mb-1" target="_blank" rel="noopener noreferer">
																<i class="fas fa-file mr-1"></i>KAK
															</a>
															<a href="<?= base_url('Admin/edit_paket/' . $p->id_paket); ?>" title="Edit Paket" class="btn btn-outline-secondary btn-sm mb-1">
																<i class="fas fa-edit mr-1"></i>Edit
															</a>
															<?php endif; ?>
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
	</div>
	<!-- ./wrapper -->

	<!-- jQuery -->
	<?php $this->load->view("dashboard/admin/script.php"); ?>
	<script src="<?= base_url('assets/dashboard/plugins/datatables/jquery.dataTables.min.js') ?>"></script>
	<script src="<?= base_url('assets/dashboard/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') ?>"></script>
	<script>
		$(function() {
			$("#example1").DataTable({
				"responsive": true,
				"autoWidth": false,
				"columnDefs": [
					{"orderable": false, targets: 6}
				]
			});
		});
	</script>
</body>

</html>