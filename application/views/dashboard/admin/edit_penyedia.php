<!DOCTYPE html>
<html lang="id">

<head>
	<?php $this->load->view('dashboard/admin/head') ?>

	<title>Edit Penyedia | E-Katalog</title>

	<link rel="stylesheet" href="<?= base_url() ?>assets/dashboard/plugins/toastr/toastr.min.css">
	<link rel="stylesheet" href="<?= base_url() ?>assets/dashboard/plugins/select2/css/select2.min.css">
	<link rel="stylesheet" href="<?= base_url() ?>assets/dashboard/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
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
							<h1>Edit Penyedia</h1>
						</div>
						<div class="col-sm-6">
							<ol class="breadcrumb float-sm-right">
								<li class="breadcrumb-item"><a href="<?= base_url('Admin') ?>">Beranda</a></li>
								<li class="breadcrumb-item active"><a href="<?= base_url('Admin/penyedia') ?>"></a>Penyedia</li>
								<li class="breadcrumb-item active">Edit Penyedia</li>
							</ol>
						</div>
					</div>
				</div><!-- /.container-fluid -->
			</section>

			<!-- Main content -->
			<section class="content">
				<div class="container-fluid">
					<div class="row">
						<!-- left column -->
						<div class="col-md-12">
							<!-- jquery validation -->
							<div class="card card-primary">
								<!-- form start -->

								<?= form_open('Admin/update_penyedia/'); ?>
								<input type="hidden" name="b" value="<?= $penyedia->id_penyedia ?>">
								<div class="card-body">
									<div class="form-group">
										<label for="nama_penyedia">Nama Penyedia</label>
										<input type="text" name="nama_penyedia" class="form-control <?= form_error('nama_penyedia') ? 'is-invalid' : ''; ?>" placeholder="Nama Penyedia" id="nama_penyedia" value="<?= set_value('nama_penyedia', $penyedia->nama_penyedia); ?>">
										<?= form_error('nama_penyedia', '<small class="text-danger">', '</small>'); ?>
									</div>
									<div class="form-group">
										<label for="alamat_penyedia">Alamat Penyedia</label>
										<input type="text" name="alamat_penyedia" class="form-control <?= form_error('alamat_penyedia') ? 'is-invalid' : ''; ?>" placeholder="Alamat Penyedia" id="alamat_penyedia" value="<?= set_value('alamat-Penyedia', $penyedia->alamat_penyedia); ?>">
										<?= form_error('alamat_penyedia', '<small class="text-danger">', '</small>'); ?>
									</div>
									<div class="form-group">
										<label for="nama_perusahaan">Nama Perusahaan</label>
										<input type="text" name="nama_perusahaan" class="form-control <?= form_error('nama_perusahaan') ? 'is-invalid' : ''; ?>" placeholder="Nama Perusahaan" id="nama_perusahaan" value="<?= set_value('nama_perusahaan', $penyedia->nama_perusahaan); ?>">
										<?= form_error('nama_perusahaan', '<small class="text-danger">', '</small>'); ?>
									</div>
									<div class="form-group">
										<label for="bank">Nama Bank</label>
										<input type="text" name="bank" class="form-control <?= form_error('bank') ? 'is-invalid' : ''; ?>" placeholder="Nama Bank" id="bank" value="<?= set_value('bank', $penyedia->bank); ?>">
										<?= form_error('bank', '<small class="text-danger">', '</small>'); ?>
									</div>
									<div class="form-group">
										<label for="norek">Nomor Rekening</label>
										<input type="number" name="norek" class="form-control <?= form_error('norek') ? 'is-invalid' : ''; ?>" placeholder="Nomor Rekening" id="norek" value="<?= set_value('norek', $penyedia->norek); ?>">
										<?= form_error('norek', '<small class="text-danger">', '</small>'); ?>
									</div>
									<div class="form-group">
										<label for="etalase">Kategori Etalase</label>
										<div class="select2-primary">
											<select class="select2 <?= form_error('etalase') ? 'is-invalid' : ''; ?>" id="etalase" name="etalase[]" multiple="multiple" data-placeholder="Kategori Etalase" style="width: 100%;">
												<?php foreach ($etalase as $key => $e): ?>
													<option value="<?= $e->id_etalase ?>" <?= set_select('etalase[]', $e->id_etalase, in_array($e->id_etalase, $etalase_penyedia)) ?> >
														<?= $e->nama_etalase, $key ?></option>
												<?php endforeach; ?>
											</select>
										</div>
										<?= form_error('etalase', '<small class="text-danger">', '</small>'); ?>
									</div>
								</div>
								<!-- /.card-body -->
								<div class=" card-footer">
									<input type="submit" value="Submit" class="btn btn-primary">
									<a href="<?= base_url() ?>Admin/penyedia" class="btn btn-secondary">Kembali</a>
								</div>
								<?= form_close(); ?>
							</div>
							<!-- /.card -->
						</div>
						<!--/.col (left) -->
						<!-- right column -->
						<div class="col-md-6">
							<button type="button" style="display:none" class="btn btn-success toastrDefaultSuccess">
								Launch Success Toast
							</button>
							<button type="button" style="display:none" class="btn btn-danger toastrDefaultError">
								Launch Error Toast
							</button>
							<button type="button" style="display:none" class="btn btn-warning toastrDefaultWarning">
								Launch Warning Toast
							</button>
						</div>
						<!--/.col (right) -->
					</div>
					<!-- /.row -->
				</div><!-- /.container-fluid -->
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

	<?php $this->load->view('dashboard/admin/script') ?>
	<!-- Page specific script -->
	<script src="<?= base_url() ?>assets/dashboard/plugins/sweetalert2/sweetalert2.min.js"></script>
  <script src="<?= base_url() ?>assets/dashboard/plugins/toastr/toastr.min.js"></script>
	<script src="<?= base_url() ?>assets/dashboard/plugins/select2/js/select2.full.min.js"></script>
	<script>
		$(document).ready(function() {
			$('.select2').select2();
		});
	</script>
</body>

</html>