<!DOCTYPE html>
<html lang="id">

<head>
	<?php $this->load->view('dashboard/admin/head') ?>
	<title>Edit Tag Berita | E-Katalog</title>
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
							<h1>Edit Tag Berita</h1>
						</div>
						<div class="col-sm-6">
							<ol class="breadcrumb float-sm-right">
								<li class="breadcrumb-item"><a href="<?= base_url('Admin') ?>">Beranda</a></li>
								<li class="breadcrumb-item active"><a href="<?= base_url('Admin/berita') ?>">Berita</a></li>
								<li class="breadcrumb-item active">Edit Tag Berita</li>
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
								<?= form_open('Admin/update_tag/' . $tags[0]->id_berita); ?>
								<div class="card-body">
									<div class="form-g">
										<label>Berita</label>
										<select name="id_berita" id="id_berita" class="form-control">
											<option value="<?= $tags[0]->id_berita; ?>"><?= $tags[0]->judul; ?></option>
										</select>
										<?= form_error('id_berita', '<small class="text-danger">', '</small>'); ?>
									</div>
									<div class="form-group mt-3">
										<?php $i = 1; ?>
										<label for="tag">Tag</label>
										<?php foreach ($tags as $t) : ?>
											<input type="text" class="form-control mb-3" value="<?= $t->tag ?>" name="tag<?= $i; ?>" id="tag<?= $i; ?>" placeholder="Nama Tag<?= $i; ?>">
											<?= $i++; ?>
										<?php endforeach; ?>
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

</body>

</html>