<!DOCTYPE html>
<html lang="id">
<?php $this->load->view('dashboard/penyedia/head'); ?>
<title>Tambah Produk</title>
</head>

<body class="hold-transition sidebar-mini">
	<div class="wrapper">
		<!-- Navbar -->
		<?php $this->load->view('dashboard/penyedia/navbar'); ?>
		<!-- /.navbar -->

		<!-- Main Sidebar Container -->
		<?php $this->load->view('dashboard/penyedia/sidebar'); ?>
		<!-- Content Wrapper. Contains page content -->
		<div class="content-wrapper">
			<!-- Content Header (Page header) -->
			<section class="content-header">
				<div class="container-fluid">
					<div class="row mb-2">
						<div class="col-sm-6">
							<h1>Kelola Etalase Produk</h1>
						</div>
						<div class="col-sm-6">
							<ol class="breadcrumb float-sm-right">
								<li class="breadcrumb-item"><a href="#">Beranda</a></li>
								<li class="breadcrumb-item active">Etalase Produk</li>
								<li class="breadcrumb-item active">Tambah Etalase Produk</li>
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
								<div class="card-header">
									<h3 class="card-title">Tambah Data Etalase Produk</h3>
								</div>
								<!-- /.card-header -->
								<!-- form start -->
								<?= form_open_multipart('Penyedia/input_data'); ?>
								<div class="card-body">
									<div class="form-group">
										<b>Sesuaikan data dengan format yang ada di bawah ini</b><br>
										<b>Pastikan kolom yang harus diisi tidak kosong.</b><br>
									</div>
									<div class="form-group">
										<a href="<?= base_url() ?>uploads/file_excel/template_input_produk.xlsx" target="downloads">Format Excel</a>
									</div>
									<div class="form-group">
										<span style="font-size:14px">
											<b style="color:red">*</b>Ket :
											Kode Etalase dan No Item dapat dilihat pada <br> menu <b>Kelola Kategori Produk</b> bagian <b>Data Etalase Produk</b> dan <b>Data Item Produk</b>
										</span>
									</div>
									<div class="form-group">
										<label for="">Upload Produk</label><br>
										<input type="file" name="filedata" id="">
									</div>
								</div>
								<!-- /.card-body -->
								<div class="card-footer">
									<a href="<?= base_url() ?>Penyedia/etalase_produk" class="btn btn-danger">Kembali</a>
									<input type="submit" value="Submit" class="btn btn-info">
									<a style="color:white" href="<?= base_url() ?>Penyedia/tambah_spesifikasi/1" class="btn btn-warning tampilkan">
										<i class="fa fa-plus" aria-hidden="true"></i>
										Spesifikasi Lainnya
									</a>
									<a href="<?= base_url() ?>Penyedia/tambah_lampiran/1" class="btn btn-success tampilkan">
										<i class="fa fa-plus" aria-hidden="true"></i>
										Lampiran
									</a>
								</div>
							</div>
							<?= form_close() ?>
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
	<?php $this->load->view('dashboard/penyedia/script'); ?>
	<script>
		<?php if ($this->session->flashdata('hasil')) : ?>
			const title = '<?= $this->session->hasil === 'berhasil' ? 'Sukses' : 'Gagal' ?>';
			const bg = '<?= $this->session->hasil === 'berhasil' ? 'bg-success' : 'bg-danger' ?>';
			const body = '<?= $this->session->pesan ?>';


			$(document).Toasts('create', {
				title: title,
				class: bg,
				body: body
			})
		<?php endif; ?>
	</script>
</body>

</html>