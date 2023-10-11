<!DOCTYPE html>
<html lang="id">

<head>
	<?php $this->load->view('dashboard/admin/head') ?>
	<title>Edit Pengumuman | E-Katalog</title>
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
							<h1>Edit Pengumuman</h1>
						</div>
						<div class="col-sm-6">
							<ol class="breadcrumb float-sm-right">
								<li class="breadcrumb-item"><a href="<?= base_url('Admin') ?>">Beranda</a></li>
								<li class="breadcrumb-item"><a href="<?= base_url('Admin/pengumuman') ?>">Pengumuman</a></li>
								<li class="breadcrumb-item active">Edit Pengumuman</li>
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
								<?= form_open_multipart('Admin/update_pengumuman/' . $pengumuman->id_pengumuman); ?>
								<div class="card-body">
									<div class="form-group">
										<label for="judul">Judul Pengumuman</label>
										<input type="text" name="judul" class="form-control <?= form_error('judul') ? 'is-invalid' : ''; ?>" placeholder="Judul Pengumuman" id="judul" value="<?= $pengumuman->judul; ?>">
										<?= form_error('judul', '<small class="text-danger">', '</small>'); ?>
									</div>
									<div class="form-group">
										<label for="etalase">Etalase Produk</label>
										<select name="etalase" id="etalase" class="form-control <?= form_error('etalase') ? 'is-invalid' : ''; ?>">
											<option value="">-- Pilih Etalase --</option>
											<?php foreach ($etalase as $data) { ?>
												<option value="<?= $data->id_etalase ?>" <?= $data->id_etalase === $pengumuman->id_etalase ? "selected" : "" ?>>
													<?= $data->nama_etalase ?></option>
											<?php } ?>
										</select>
										<?= form_error('etalase', '<small class="text-danger">', '</small>'); ?>
									</div>
									<div class="form-group">
										<label for="syarat">Syarat dan Ketentuan</label>
										<textarea id="summernote" name="syarat" id="syarat">
                    <?= $pengumuman->syarat_ketentuan; ?>
                    </textarea>
										<?= form_error('syarat', '<small class="text-danger">', '</small>'); ?>
									</div>
									<div class="form-group mb-3">
										<label for="file_dokumen">Dokumen Pengumuman</label>
										<br>
										<div class="custom-file col-8">
											<input type="hidden" name="old_file_dokumen" value="<?= $pengumuman->dok_pengumuman; ?>">
											<input type="file" class="custom-file-input <?= form_error('file_dokumen') ? 'is-invalid' : ''; ?>" id="file_dokumen" name="file_dokumen">
											<label class="custom-file-label" for="file_dokumen">Upload File Dokumen</label>
											<?= form_error('file_dokumen', '<small class="text-danger">', '</small>'); ?>
										</div>
									</div>
									<div class="form-group">
										<label for="jumlah_penawaran">jumlah Penawaran</label>
										<input type="number" name="jumlah_penawaran" class="form-control <?= form_error('jumlah_penawaran') ? 'is-invalid' : ''; ?>" placeholder="Jumlah Penawaran" id="jumlah_penawaran" value="<?= $pengumuman->jumlah_penawaran; ?>">
										<?= form_error('jumlah_penawaran', '<small class="text-danger">', '</small>'); ?>
									</div>
								</div>
								<!-- /.card-body -->
								<div class="card-footer">
									<a href="<?= base_url() ?>Admin/pengumuman" class="btn btn-danger">Kembali</a>
									<input type="submit" value="Submit" class="btn btn-info">
									<a style="color:white" href="<?= base_url() ?>Admin/tambah_merek" class="btn btn-warning tampilkan">
										<i class="fa fa-plus" aria-hidden="true"></i>
										Merek
									</a>
									<a href="<?= base_url() ?>Admin/tambah_tahapan" class="btn btn-success tampilkan">
										<i class="fa fa-plus" aria-hidden="true"></i>
										Tahapan Pengumuman
									</a>
								</div>
								</form>
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
							<button type="button" style="display:none" class="btn btn-danger toastrDefaultWarning">
								Launch Error Toast
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
	<script src="<?= base_url() ?>assets/dashboard/plugins/summernote/summernote-bs4.min.js"></script>
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