<!DOCTYPE html>
<html lang="id">
<?php include "head.php" ?>
<title>Tambah Produk</title>
<link rel="stylesheet" href="<?=base_url()?>assets/dashboard/plugins/toastr/toastr.min.css">
<!-- SimpleMDE -->
</head>

<body class="hold-transition sidebar-mini">
	<div class="wrapper">
		<!-- Navbar -->
		<?php include "navbar.php" ?>
		<!-- /.navbar -->

		<!-- Main Sidebar Container -->
		<?php include "sidebar.php" ?>
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
								<div class="card-body">
									<?= form_open_multipart('Penyedia/input_produk', array('id' => 'produk-baru')); ?>
									<a href="<?= base_url() ?>Penyedia/tambah_produk2" class="btn btn-success">
										<i class="fas fa-plus"></i>
										Tambah Excel
									</a><br><br>
									<div class="form-g">
										<label>Kategori Etalase Produk</label>
										<select name="kategori" id="" class="form-control">
											<option value="">-- Pilih Kategori --</option>
											<?php foreach ($etalase_produk as $etalase) { ?>
												<option value="<?= $etalase->id_etalase ?>"><?= $etalase->nama_etalase ?></option>
											<?php } ?>
										</select>
									</div><br>
									<div class="form-g">
										<label>Item</label>
										<select name="item" id="select-state" placeholder="-- Pilih Item --">
											<option value="">-- Pilih Item --</option>
											<?php foreach ($item as $etalase) { ?>
												<option value="<?= $etalase->no_item ?>"><?= $etalase->no_item ?> - <?= $etalase->nama_item ?></option>
											<?php } ?>
										</select>
									</div><br>
									<div class="form-group">
										<label for="">Nama Produk</label>
										<input type="text" name="namaproduk" class="form-control" placeholder="Nama Produk" id="">
									</div>
									<div class="form-group">
										<label for="">Merk Produk</label>
										<input type="text" name="merk" class="form-control" placeholder="Merk" id="">
									</div>
									<div class="form-group">
										<label for="">Masa Berlaku Produk</label>
										<input type="date" name="masaberlaku" class="form-control" id="">
									</div>
									<div class="form-group">
										<label for="" style="display:block;margin-bottom:-4px">Harga Produk Sebelum PPN</label>
										<span style="color:red;font-size:12px">*harga yang ditampilkan akan ditambahkan otomatis 11% untuk PPN </span>
										<input type="number" name="hargaproduk" class="form-control" placeholder="Harga Produk" id="">
									</div>
									<div class="form-group">
										<label for="">No. Produk Penyedia</label>
										<input type="text" name="noproduk" class="form-control" id="" placeholder="No. Produk Penyedia">
									</div>
									<div class="form-group">
										<label for="">Unit Pengukuran</label>
										<input type="text" name="unit" class="form-control" placeholder="Unit Pengukuran" id="">
									</div>
									<div class="form-group">
										<label for="">Kode KBKI</label>
										<input type="text" name="kode" class="form-control" placeholder="Kode KBKI (Contoh :0,0)" id="">
									</div>
									<div class="form-group">
										<label for="">Nilai TKDN</label>
										<input type="text" name="nilai" class="form-control" placeholder="Nilai TKDN (%)" id="">
									</div>
									<div class="form-group">
										<label for="">Stok Produk</label>
										<input type="number" name="stokproduk" class="form-control" placeholder="Stok Produk" id="">
									</div>
									<div class="form-group">
										<label for="">Foto Produk</label><br>
										<input type="file" name="foto" id="">
									</div>
									<div class="form-group">
										<label for="">Deskripsi</label>
										<textarea name="deskripsi" class="form-control" id="" cols="15" rows="6"></textarea>
									</div>
									<?= form_close() ?>
								</div>
								<!-- /.card-body -->
								<div class="card-footer">
									<a href="<?= base_url() ?>Penyedia/etalase_produk" class="btn btn-danger">Kembali</a>
									<input type="submit" value="Submit" class="btn btn-info" form="produk-baru">
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
	<?php include "script.php" ?>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/js/standalone/selectize.min.js" integrity="sha256-+C0A5Ilqmu4QcSPxrlGpaZxJ04VjsRjKu+G82kl5UJk=" crossorigin="anonymous"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/css/selectize.bootstrap3.min.css" integrity="sha256-ze/OEYGcFbPRmvCnrSeKbRTtjG4vGLHXgOqsyLFTRjg=" crossorigin="anonymous" />
	<script src="<?= base_url() ?>assets/dashboard/plugins/toastr/toastr.min.js"></script>
	<!-- Page specific script -->

	<?php if ($hasil == "berhasil") { ?>
		<script>
			var announce = "Data tersimpan";
			toastr.success(announce)

			var announce = "Isi spesifikasi terlebih dahulu dengan klik tombol + Spesifikasi";
			toastr.warning(announce)
		</script>
	<?php } else if ($hasil == "gagal") { ?>
		<script>
			var announce = "Data gagal disimpan";
			toastr.error(announce)
		</script>
	<?php } ?>
	<script>
		$(document).ready(function() {
			$('select').selectize({
				sortField: 'number'
			});
		});
	</script>
</body>

</html>