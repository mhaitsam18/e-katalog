<!DOCTYPE html>
<html lang="id">

<head>
	<?php $this->load->view('dashboard/admin/head.php') ?>

	<title>Lihat Daftar Kategori</title>

	<link rel="stylesheet" href="<?= base_url() ?>assets/dashboard/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
	<link rel="stylesheet" href="<?= base_url() ?>assets/dashboard/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
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
							<h1>Lihat Daftar Kategori</h1>
						</div>
						<div class="col-sm-6">
							<ol class="breadcrumb float-sm-right">
								<li class="breadcrumb-item"><a href="<?= base_url('Admin') ?>">Beranda</a></li>
								<li class="breadcrumb-item active">Kategori</li>
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
								<div class="card-header">
									<h2 class="h5 m-0">Kategori Etalase</h2>
								</div>
								<div class="card-body">
									<table id="table-ke" class="table table-bordered table-striped">
										<thead>
											<tr>
												<th>No.</th>
												<th>Kategori Etalase Produk</th>
											</tr>
										</thead>
										<tbody>
											<?php $i = 1; ?>
											<?php foreach ($kategori_etalase as $ke) : ?>
												<tr>
													<td><?= $i++ . '.'; ?></td>
													<td><?= $ke->nama_ke; ?></td>
												</tr>
											<?php endforeach; ?>
										</tbody>
									</table>
								</div>
							</div>
						</div>

						<div class="col-12">
							<div class="card">
								<div class="card-header">
									<h2 class="h5 m-0">Kategori Berita</h2>
								</div>
								<div class="card-body">
									<table id="table-kb" class="table table-bordered table-striped">
										<thead>
											<tr>
												<th>No.</th>
												<th>Kategori Berita</th>
											</tr>
										</thead>
										<tbody>
											<?php $i = 1; ?>
											<?php foreach ($kategori_berita as $kb) : ?>
												<tr>
													<td><?= $i++ . '.'; ?></td>
													<td>
														<a href="<?= base_url('Admin/kategori_berita/' . $kb->id_kb) ?>"><?= $kb->nama_kb ?></a>
													</td>
												</tr>
											<?php endforeach; ?>
										</tbody>
									</table>
								</div>
							</div>
						</div>

						<div class="col-12">
							<div class="card">
								<div class="card-header">
									<h2 class="h5 m-0">Kategori Unduhan</h2>
								</div>
								<div class="card-body">
									<table id="table-ku" class="table table-bordered table-striped">
										<thead>
											<tr>
												<th>No.</th>
												<th>Kategori Unduhan</th>
											</tr>
										</thead>
										<tbody>
											<?php $i = 1; ?>
											<?php foreach ($kategori_unduhan as $ku) : ?>
												<tr>
													<td><?= $i++ . '.'; ?></td>
													<td>
														<a href="<?= base_url('Admin/kategori_unduhan/' . $ku->id_ku) ?>"><?= $ku->nama_ku ?></a>
													</td>
												</tr>
											<?php endforeach; ?>
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
			$("#table-ke").DataTable({
				"responsive": true,
				"autoWidth": false,
				"paging": false,
				"columnDefs": [{
					"width": "2em",
					"targets": 0
				}],
				"language": {
					"emptyTable": "Tidak ada data kategori etalase"
				}
			});

			$("#table-kb").DataTable({
				"responsive": true,
				"autoWidth": false,
				"paging": false,
				"columnDefs": [{
					"width": "2em",
					"targets": 0
				}],
				"language": {
					"emptyTable": "Tidak ada data kategori berita"
				}
			});

			$("#table-ku").DataTable({
				"responsive": true,
				"autoWidth": false,
				"paging": false,
				"columnDefs": [{
					"width": "2em",
					"targets": 0
				}],
				"language": {
					"emptyTable": "Tidak ada data kategori unduhan"
				}
			});
		});
	</script>
</body>

</html>