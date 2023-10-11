<!DOCTYPE html>
<html lang="id">

<head>
	<?php $this->load->view('dashboard/admin/head.php') ?>

	<title>Daftar Produk | E-Katalog</title>
	
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
					<div class="row mb-2">
						<div class="col-sm-6">
							<h1>Etalase: <?= $etalase->nama_etalase ?></h1>
						</div>
						<div class="col-sm-6">
							<ol class="breadcrumb float-sm-right">
								<li class="breadcrumb-item"><a href="<?= base_url('Admin') ?>">Beranda</a></li>
								<li class="breadcrumb-item active"><a href="<?= base_url('Admin/etalase_produk') ?>">Etalase Produk</a></li>
								<li class="breadcrumb-item active"><?= $etalase->nama_etalase ?></li>
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
								<div class="card-body">
									<table id="example1" class="table table-bordered table-striped">
										<thead>
											<tr>
												<th>No.</th>
												<th>Nama Produk</th>
												<th>Harga</th>
												<th>TKDN</th>
												<th>Aksi</th>
											</tr>
										</thead>
										<?php if(! empty($produk)): ?>
											<tbody>
												<?php $i = 1; ?>
												<?php foreach ($produk as $p) : ?>
													<tr>
														<td><?= $i++.'.'; ?></td>
														<td><?= $p->nama_produk; ?></td>
														<td><?= rupiah($p->harga); ?></td>
														<td><?= $p->nilai_tkdn ?? '-'; ?></td>
														<td>
															<a href="<?= base_url('Admin/produk/'.$p->id_produk); ?>" title="Lihat Detail" class="btn btn-info btn-sm">
																<i class="fa fa-eye mr-2"></i> Lihat Detail
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
	</div>
	<!-- ./wrapper -->

	<?php $this->load->view('dashboard/admin/script.php') ?>
	<script src="<?= base_url('assets/dashboard/plugins/datatables/jquery.dataTables.min.js') ?>"></script>
	<script src="<?= base_url('assets/dashboard/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') ?>"></script>
	<script>
		$(function() {
			$("#example1").DataTable({
				"responsive": true,
				"autoWidth": false,
				"language": {
					"emptyTable": "Tidak ada produk dalam etalase ini"
				},
				"columnDefs": [{
					"orderable": false,
					targets: 4
				}]
			});
		});
	</script>
</body>

</html>