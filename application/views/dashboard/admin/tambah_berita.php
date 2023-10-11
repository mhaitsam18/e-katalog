<!DOCTYPE html>
<html lang="id">

<head>
	<?php $this->load->view('dashboard/admin/head') ?>
	<title>Tambah Berita | E-Katalog</title>
	<link rel="stylesheet" href="<?= base_url() ?>assets/dashboard/plugins/sweetalert2/sweetalert2.min.css">
	<link rel="stylesheet" href="<?= base_url() ?>assets/dashboard/plugins/summernote/summernote-bs4.min.css">
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
							<h1>Tambah Berita</h1>
						</div>
						<div class="col-sm-6">
							<ol class="breadcrumb float-sm-right">
								<li class="breadcrumb-item"><a href="<?= base_url('Admin') ?>">Beranda</a></li>
								<li class="breadcrumb-item active"><a href="<?= base_url('Admin/berita') ?>">Berita</a></li>
								<li class="breadcrumb-item active">Tambah Berita</li>
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
								<?= form_open_multipart('Admin/input_berita', array('method' => 'POST')); ?>
								<div class="card-body">
									<div class="form-group">
										<label for="judul">Judul Berita</label>
										<input type="text" name="judul" class="form-control  <?= form_error('judul') ? 'is-invalid' : ''; ?>" placeholder="Judul" id="judul" value="<?= set_value('judul'); ?>" />
										<?= form_error('judul', '<small class="text-danger">', '</small>'); ?>
									</div>
									<div class="form-group">
										<label for="kategori">Kategori Berita</label>
										<select name="kategori" id="kategori" class="form-control  <?= form_error('kategori') ? 'is-invalid' : ''; ?>">
											<option value="">-- Pilih Kategori --</option>
											<?php foreach ($kategori as $data) { ?>
												<option value="<?= $data->id_kb ?>"><?= $data->nama_kb ?></option>
											<?php } ?>
										</select>
										<?= form_error('kategori', '<small class="text-danger">', '</small>'); ?>
									</div>
									<div class="d-flex flex-column">
										<label for="gambar">Gambar Preview</label>
										<div class="mb-3">
											<img src="<?= base_url('uploads/poster_berita/default.jpg'); ?>" class="img-thumbnail img-preview" width="300">
										</div>
										<div class="form-group">
											<div class="input-group">
												<div class="custom-file col-sm-6">
													<input type="file" class="custom-file-input" id="gambar" name="gambarberita" onchange="previewGmb()" />
													<label class="custom-file-label" for="gambar">Pilih Gambar</label>
												</div>
											</div>
											<?= form_error('gambarberita', '<small class="text-danger">', '</small>'); ?>
										</div>
									</div>
									<div class="form-group mt-3">
										<label for="summernote">Deskripsi</label>
										<textarea class="form-control  <?= form_error('body') ? 'is-invalid' : ''; ?>" name="body" placeholder="Isi deskripsi.." id="summernote">
                      <?= set_value('body'); ?>
                    </textarea>
										<?= form_error('body', '<small class="text-danger">', '</small>'); ?>
									</div>
								</div>
								<!-- /.card-body -->
								<div class="card-footer">
									<a href="<?= base_url() ?>admin/berita" class="btn btn-danger">Kembali</a>
									<input type="submit" value="Submit" class="btn btn-info">
									<a style="color:white" href="<?= base_url() ?>admin/tambah_tags" class="btn btn-warning tampilkan">
										<i class="fa fa-plus" aria-hidden="true"></i>
										Tag
									</a>
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

	<!-- jQuery -->
	<?php $this->load->view('dashboard/admin/script') ?>
	<script src="<?= base_url() ?>assets/dashboard/plugins/summernote/summernote-bs4.min.js"></script>
	<script src="<?= base_url() ?>assets/dashboard/plugins/sweetalert2/sweetalert2.min.js"></script>
	<script src="<?= base_url() ?>assets/dashboard/plugins/toastr/toastr.min.js"></script>
	<script src="<?= base_url() ?>assets/dashboard/dist/js/preview-img.js"></script>
	<script>
		$("#summernote").summernote({
			toolbar: [
				// [groupName, [list of button]]
				["style", ["bold", "italic", "underline", "clear"]],
				["font", ["strikethrough", "superscript", "subscript"]],
				// ['fontsize', ['fontsize']],
				// ['color', ['color']],
				["para", ["ul", "ol", "paragraph"]],
				["height", ["height"]],
				["insert", ["link"]],
			],
		});
	</script>
</body>

</html>