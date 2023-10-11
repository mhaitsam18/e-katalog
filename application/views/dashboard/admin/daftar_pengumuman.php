<!DOCTYPE html>
<html lang="id">

<head>
	<?php $this->load->view('dashboard/admin/head') ?>
	<title>Daftar Pengumuman | E-Katalog</title>
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
							<h1>Daftar Pengumuman</h1>
						</div>
						<div class="col-sm-6">
							<ol class="breadcrumb float-sm-right">
								<li class="breadcrumb-item"><a href="<?= base_url('Admin') ?>">Beranda</a></li>
								<li class="breadcrumb-item active">Pengumuman</li>
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
									<a href="<?= base_url() ?>Admin/tambah_pengumuman" class="btn btn-success">
										<i class="fas fa-plus"></i>
										Tambah
									</a><br><br>
									<table id="example1" class="table table-bordered table-striped">
										<thead>
											<tr>
												<th>No</th>
												<th>Judul Pengumuman</th>
												<th>Etalase Produk</th>
												<th>Daftar Merek</th>
												<th>Dokumen Syarat dan Ketentuan</th>
												<th>Dokumen Pengumuman</th>
												<th>Jumlah Penawaran</th>
												<th>Tahapan Pengumuman</th>
												<th>Aksi</th>
											</tr>
										</thead>
										<tbody>
											<?php
											$no = 1;
											foreach ($pengumuman as $data) : ?>
												<tr>
													<td><?= $no++ ?></td>
													<td><?= $data->judul ?></td>
													<td><?= $data->nama_etalase ?></td>
													<td>
														<a class="btn btn-primary" href="<?= base_url() ?>Admin/merek_pengumuman/<?= $data->id_pengumuman ?>">
															<i class="fas fa-file"></i>
															Merek</a>
													</td>
													<td>
														<button type="button" class="btn btn-dark" data-toggle="modal" data-target="#modal-lg<?= $data->id_pengumuman ?>">
															<i class="fa fa-list" aria-hidden="true"></i>
															Syarat
														</button>
													</td>
													<td>
														<?php if (!$data->dok_pengumuman) : echo "Tidak ada lampiran"; ?>
														<?php else : ?>
															<a class="btn btn-success" target="__blank" href="<?= base_url() ?>uploads/dokumen_pengumuman/<?= $data->dok_pengumuman ?>" rel="noopener noreferer">
																<i class="fas fa-file-alt"></i>
																Lampiran</a>
														<?php endif; ?>
													</td>
													<td><?= $data->jumlah_penawaran ?></td>
													<td>
														<a href="<?= base_url('Admin/tahapan_pengumuman/' . $data->id_pengumuman) ?>" class="btn btn-warning">
															<i class="fas fa-info-circle"></i>
															Info</a>
													</td>
													<td>
														<a href="<?= base_url('Admin/edit_pengumuman/' . $data->id_pengumuman) ?>" class="btn btn-primary">
															<i class="fas fa-regular fa-pen"></i>
															Edit</a>
														<a href="<?= base_url('Admin/hapus_pengumuman/' . $data->id_pengumuman . '/' . $data->dok_pengumuman) ?>" class="btn btn-danger tombol-hapus">
															<i class="fa fa-regular fa-trash mr-2"></i>
															Hapus</a>

													</td>
												</tr>
											<?php endforeach; ?>
										</tbody>
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

		<?php foreach ($pengumuman as $p) : ?>
			<div class="modal fade" id="modal-lg<?= $p->id_pengumuman ?>">
				<div class="modal-dialog modal-lg">
					<div class="modal-content">
						<div class="modal-header">
							<h4 class="modal-title">Pengumuman <?= $p->judul ?></h4>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body">
							<h5>Syarat dan Ketentuan</h5>
							<p><?= $p->syarat_ketentuan ?></p>
						</div>
						<div class="modal-footer justify-content-between">
							<button type="button" class="btn btn-default" data-dismiss="modal">Keluar</button>
						</div>
					</div>
					<!-- /.modal-content -->
				</div>
				<!-- /.modal-dialog -->
			</div>
		<?php endforeach; ?>
	</div>
	<!-- ./wrapper -->

	<?php $this->load->view('dashboard/admin/script') ?>
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
					targets: 8
				}]
			});
		});
	</script>
</body>

</html>