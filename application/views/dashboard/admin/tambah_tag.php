<!DOCTYPE html>
<html lang="id">

<head>
	<?php $this->load->view('dashboard/admin/head') ?>
	<title>Tambah Tag Berita | E-Katalog</title>

</head>

<body class="hold-transition sidebar-mini">

	<?php if ($this->session->flashdata('flash')) : ?>
		<div class="flash-data-gagal" data-flashdata="<?= $this->session->flashdata('flash'); ?>"></div>
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
							<h1>Tambah Tag Berita</h1>
						</div>
						<div class="col-sm-6">
							<ol class="breadcrumb float-sm-right">
								<li class="breadcrumb-item"><a href="<?= base_url('Admin') ?>">Beranda</a></li>
								<li class="breadcrumb-item active"><a href="<?= base_url('Admin/berita') ?>">Berita</a></li>
								<li class="breadcrumb-item active">Tambah Tag Berita</li>
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
								<?php echo form_open_multipart('Admin/input_tag', array('method' => 'POST')); ?>
								<div class="card-body">
									<div class="form-g">
										<label>Berita</label>
										<select name="id_berita" id="id_berita" class="form-control">
											<option value="">-- Pilih Berita --</option>
											<?php foreach ($berita as $data) { ?>
												<option value="<?= $data->id_berita ?>"><?= $data->judul ?></option>
											<?php } ?>
										</select>
										<?= form_error('id_berita', '<small class="text-danger">', '</small>'); ?>
									</div>
									<div class="form-group mt-3">
										<label for="tag">Tag</label>
										<input type="text" class="form-control mb-3" name="tag1" id="tag1" placeholder="Nama Tag1">
										<input type="text" class="form-control mb-3" name="tag2" id="tag2" placeholder="Nama Tag2">
										<input type="text" class="form-control mb-3" name="tag3" id="tag3" placeholder="Nama Tag3">
										<?= form_error('tag1', '<small class="text-danger">', '</small>'); ?>
									</div>

									<!-- /.card-body -->
									<div class="card-footer">
										<a href="<?= base_url() ?>Admin/berita" class="btn btn-danger">Kembali</a>
										<input type="submit" value="Submit" class="btn btn-info ml-2">
									</div>
								</div>
								<button type="button" style="display:none" class="btn btn-success toastrDefaultSuccess">
									Launch Success Toast
								</button>
								<button type="button" style="display:none" class="btn btn-danger toastrDefaultError">
									Launch Error Toast
								</button>
								<!-- /.card -->
							</div>
							<!--/.col (left) -->
							<!-- right column -->
							<div class="col-md-6">

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

	<!-- jQuery -->
	<?php $this->load->view('dashboard/admin/script') ?>
	<script src="<?= base_url() ?>assets/dashboard/plugins/sweetalert2/sweetalert2.min.js"></script>
	<script src="<?= base_url() ?>assets/dashboard/plugins/toastr/toastr.min.js"></script>
	<script src="<?= base_url() ?>assets/dashboard/dist/js/flash.js"></script>
</body>

</html>