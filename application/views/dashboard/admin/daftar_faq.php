<!DOCTYPE html>
<html lang="id">

<head>
	<?php $this->load->view('dashboard/admin/head.php') ?>

	<title>Daftar FAQ | E-Katalog</title>

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
							<h1>Lihat Daftar <abbr title="Frequently Asked Question">FAQ</abbr></h1>
						</div>
						<div class="col-sm-6">
							<ol class="breadcrumb float-sm-right">
								<li class="breadcrumb-item"><a href="<?= base_url('Admin') ?>">Beranda</a></li>
								<?php if (!isset($faq)) : ?>
									<li class="breadcrumb-item active">FAQ</li>
								<?php else : ?>
									<!-- <li class="breadcrumb-item active"><a href="<?= base_url('Admin/faq') ?>">FAQ</a></li> -->
									<li class="breadcrumb-item active">FAQ</li>
								<?php endif; ?>
							</ol>
						</div>
					</div>
				</div><!-- /.container-fluid -->

			</section>


			<!-- Main content -->
			<section class="content">
				<div class="container-fluid">
								
					<?php $this->alert->tampilkan(); ?>

					<div class="row">
						<div class="col">
							<a href="<?= base_url('/Admin/tambah_faq') ?>" class="btn btn-primary mt-3">
								<i class="fas fa-plus mr-1"></i>
								Tambah FAQ
							</a>
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
												<th>Pertanyaan</th>
												<th>Jawaban</th>
												<th>Admin</th>
												<th>Aksi</th>
											</tr>
										</thead>

										<?php if (!empty($faq)) : ?>
											<tbody>
												<?php $i = 1; ?>
												<?php foreach ($faq as $f) : ?>
													<tr>
														<td><?= $i++ . '.'; ?></td>
														<td><?= $f->pertanyaan ?></td>
														<td><?= $f->jawaban ?></td>
														<td><?= $f->nama_admin ?></td>
														<td width="25%">
															<a href="<?= base_url('Admin/faq/' . $f->id_faq); ?>" title="Lihat Detail" class="btn btn-info btn-sm mr-1 mb-1">
																<i class="fas fa-eye mr-1"></i> Lihat Detail
															</a>
															<a href="<?= base_url('Admin/edit_faq/' . $f->id_faq); ?>" title="Edit" class="btn btn-primary btn-sm mr-1 mb-1">
																<i class="fas fa-regular fa-pen mr-1"></i> Edit
															</a>
															<button title="Hapus" name="hapus-faq" value="<?= $f->id_faq; ?>" class="btn btn-danger btn-sm mr-1 mb-1 tombol-hapus" form="form-hapus">
																<i class="fas fa-regular fa-trash mr-1"></i> Hapus
															</button>
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

				<?= form_open(base_url('Admin/hapus_faq'), ['id' => 'form-hapus']); ?>
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

	<?php $this->load->view('dashboard/admin/script.php') ?>
	<script src="<?= base_url('assets/dashboard/plugins/sweetalert2/sweetalert2.min.js') ?>"></script>
	<script src="<?= base_url('assets/dashboard/plugins/datatables/jquery.dataTables.min.js') ?>"></script>
	<script src="<?= base_url('assets/dashboard/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') ?>"></script>
	<script src="<?= base_url() ?>assets/dashboard/dist/js/delete-button.js"></script>
	<script src="<?=base_url()?>assets/dashboard/dist/js/flash.js"></script>
	<script>
		$(function() {
			$("#example1").DataTable({
				"responsive": true,
				"autoWidth": false,
				"columnDefs": [{
						"orderable": false,
						targets: 4
					},
					{
						"width": '2em',
						targets: 0
					}
				]
			});
		});
	</script>
</body>

</html>