<!DOCTYPE html>
<html lang="id">

<head>
	<?php $this->load->view('dashboard/admin/head') ?>
	<title>Edit FAQ | E-Katalog</title>
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
							<h1>Edit FAQ</h1>
						</div>
						<div class="col-sm-6">
							<ol class="breadcrumb float-sm-right">
								<li class="breadcrumb-item"><a href="<?= base_url('Admin') ?>">Beranda</a></li>
								<li class="breadcrumb-item active"><a href="<?= base_url('Admin/faq') ?>">FAQ</a></li>
								<li class="breadcrumb-item active">Edit FAQ</li>
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
							<div class="card">
								<!-- form start -->
								<?= form_open("Admin/update_faq/$id_faq"); ?>
								<div class="card-body">
									<div class="form-group">
										<label for="pertanyaan">Pertanyaan</label>
										<input type="text" name="pertanyaan" class="form-control <?= form_error('pertanyaan') ? 'is-invalid' : ''; ?>" placeholder="pertanyaan" id="pertanyaan" value="<?= $pertanyaan; ?>">
										<?= form_error('pertanyaan', '<small class="text-danger">', '</small>'); ?>
									</div>
									<div class="form-group">
										<label for="jawaban">Jawaban</label>
										<input type="text" name="jawaban" class="form-control <?= form_error('jawaban') ? 'is-invalid' : ''; ?>" placeholder="jawaban" id="jawaban" value="<?= $jawaban; ?>">
										<?= form_error('jawaban', '<small class="text-danger">', '</small>'); ?>
									</div>
								</div>
								<!-- /.card-body -->
								<div class="card-footer">
									<a href="<?= base_url() ?>admin/faq" class="btn btn-danger">Kembali</a>
									<input type="submit" value="Submit" class="btn btn-info">
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

	</div>
	<!-- ./wrapper -->

	<?php $this->load->view('dashboard/admin/script') ?>
	<script src="<?= base_url() ?>assets/dashboard/plugins/sweetalert2/sweetalert2.min.js"></script>
	<script src="<?= base_url() ?>assets/dashboard/plugins/toastr/toastr.min.js"></script>

</body>

</html>