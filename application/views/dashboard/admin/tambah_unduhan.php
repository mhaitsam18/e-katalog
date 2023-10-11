<!DOCTYPE html>
<html lang="id">

<head>
	<?php $this->load->view('dashboard/admin/head') ?>
	<title>Tambah Unduhan | E-Katalog</title>
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
							<h1>Tambah Unduhan</h1>
						</div>
						<div class="col-sm-6">
							<ol class="breadcrumb float-sm-right">
								<li class="breadcrumb-item"><a href="<?= base_url('Admin') ?>">Beranda</a></li>
								<li class="breadcrumb-item active"><a href="<?= base_url('Admin/unduhan') ?>">Unduhan</a></li>
								<li class="breadcrumb-item active">Tambah Unduhan</li>
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
						<!-- left column -->
						<div class="col-md-12">
							<div class="card">
								<?= form_open_multipart('Admin/tambah_unduhan'); ?>
								<div class="card-body">
									<div class="form-group">
										<label for="nama_unduhan">Nama Unduhan</label>
										<input type="text" name="nama_unduhan" class="form-control  <?= form_error('nama_unduhan') ? 'is-invalid' : ''; ?>" placeholder="Nama Unduhan" id="nama_unduhan" value="<?= set_value('nama_unduhan'); ?>">
										<?= form_error('nama_unduhan', '<small class="text-danger">', '</small>'); ?>
									</div>
									<div class="form-group">
										<label for="kategori">Kategori Unduhan</label>
										<select name="kategori" id="kategori" class="form-control  <?= form_error('kategori') ? 'is-invalid' : ''; ?>">
											<option value="">-- Pilih Kategori --</option>
											<?php foreach ($kategori as $data) { ?>
												<option value="<?= $data->id_ku ?>" <?= set_select('kategori', $data->id_ku) ?> ><?= $data->nama_ku ?></option>
											<?php } ?>
										</select>
										<?= form_error('kategori', '<small class="text-danger">', '</small>'); ?>
									</div>
									<div class="form-group mb-3">
										<label for="unduhan">File Unduhan</label>
										<div class="d-block custom-file col-8">
											<input type="file" class="custom-file-input  <?= form_error('unduhan') ? 'is-invalid' : ''; ?>" id="unduhan" name="unduhan">
											<label class="custom-file-label" for="unduhan">Upload File</label>
											<?= form_error('unduhan', '<small class="text-danger">', '</small>'); ?>
										</div>
									</div>
								</div>
								<!-- /.card-body -->
								<div class="card-footer">
									<input type="submit" value="Submit" class="btn btn-primary">
									<a href="<?= base_url() ?>admin/unduhan" class="btn btn-secondary">Kembali</a>
								</div>
								<?= form_close(); ?>
							</div>
							<!-- /.card -->
						</div>
						<!--/.col (left) -->
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
	<script src="<?= base_url() ?>assets/dashboard/dist/js/custom-file-input.js"></script>

</body>

</html>