<!DOCTYPE html>
<html lang="id">
<head>
	<?php $this->load->view('dashboard/admin/head.php') ?>
	<title>Detail Produk | E-Katalog</title>
</head>

<body class="hold-transition sidebar-mini">
	<div class="wrapper">
		<!-- Navbar -->
		<?php $this->load->view('dashboard/admin/navbar.php') ?>
		<!-- /.navbar -->

		<!-- Main Sidebar Container -->
		<?php $this->load->view('dashboard/admin/sidebar.php') ?>

		<!-- Content Wrapper. Contains page content -->
		<div class="content-wrapper">
			<!-- Content Header (Page header) -->
			<section class="content-header">
				<div class="container-fluid">
					<div class="row">
						<div class="col-sm-6">
							<h1>Detail Produk</h1>
						</div>
						<div class="col-sm-6">
							<ol class="breadcrumb float-sm-right">
								<li class="breadcrumb-item"><a href="<?= base_url('Admin') ?>">Beranda</a></li>
								<li class="breadcrumb-item active"><a href="<?= base_url('Admin/etalase_produk') ?>">Etalase Produk</a></li>
								<li class="breadcrumb-item active"><?= $produk->nama_etalase ?></li>
							</ol>
						</div>
					</div>
				</div><!-- /.container-fluid -->
			</section>

			<section class="content">
				<div class="container-fluid">
					<div class="row">
						<div class="col">
							<a href="<?= base_url('Admin/etalase_produk/'.$produk->id_ke) ?>" class="btn btn-secondary btn-sm">
								<i class="fa fa-arrow-left mr-2"></i> Kembali ke etalase
							</a>

							<a href="<?= base_url('Admin/riwayat_produk/'.$produk->id_produk) ?>" class="btn btn-secondary btn-sm">
								<i class="fa fa-history mr-1"></i> Lihat Riwayat Produk
							</a>
						</div>
					</div>
				</div>
			</section>

			<!-- Main content -->
			<section class="content">
				<div class="container-fluid">
					<div class="row mt-2">
						<!-- Detail Produk -->
						<div class="col-lg-6">
							<div class="card">
								<div class="card-body">
									<h2><?= $produk->nama_produk.' ('.$produk->no_item.')'; ?></h2>
									<p><?= $produk->nama_perusahaan ?></p>

									<strong class="d-block">Etalase</strong>
									<p><?= $produk->nama_etalase; ?></p>

									<strong class="d-block">Kategori</strong>
									<p><?= $produk->nama_ke; ?></p>

									<strong class="d-block">Merek</strong>
									<p><?= $produk->merek; ?></p>

									<strong class="d-block">Masa Berlaku</strong>
									<p><?= tanggal($produk->masa_berlaku); ?></p>

									<strong class="d-block">No. Produk Penyedia</strong>
									<p><?= $produk->no_produk_penyedia ?? '-'; ?></p>

									<strong class="d-block">Kode KBKI</strong>
									<p><?= $produk->kode_kbki; ?></p>

									<strong class="d-block">Nilai TKDN</strong>
									<p><?= $produk->nilai_tkdn ?? '-'; ?></p>

									<strong class="d-block">Harga</strong>
									<p><?= rupiah($produk->harga); ?></p>

									<strong class="d-block">Harga (+PPN)</strong>
									<p><?= rupiah($produk->harga_ppn); ?></p>

									<strong class="d-block">Stok</strong>
									<p><?= $produk->stok; ?></p>

									<strong class="d-block">Unit Pengukuran</strong>
									<p><?= $produk->unit_pengukuran ?? '-'; ?></p>

									<strong class="d-block">Deskripsi</strong>
									<p><?= $produk->deskripsi ?? '-'; ?></p>
								</div>
								<!-- /.card-body -->
							</div>
							<!-- /.card -->
						</div>
						<!-- /.col -->

						<!-- Spesifikasi produk -->
						<?php if(! empty($meta) || ! empty($produk->foto)): ?>
						<div class="col-lg-6">
							<div class="card">
								<div class="card-body">
									<?php if(! empty($produk->foto)): ?>
										<div class="mb-4">
											<img src="<?= base_url('uploads/foto_produk/'.$produk->foto) ?>" class="img-thumbnail" alt="Foto Produk">
										</div>
									<?php endif; ?>

									<?php foreach($meta as $m): ?>
										<strong class="d-block"><?= $m->spesifikasi ?></strong>
										<p><?= $m->nilai; ?></p>
									<?php endforeach; ?>
								</div>
								<!-- /.card-body -->
							</div>
							<!-- /.card -->
						</div>
						<?php endif; ?>
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

		<!-- Control Sidebar -->
		<aside class="control-sidebar control-sidebar-dark">
			<!-- Control sidebar content goes here -->
		</aside>
		<!-- /.control-sidebar -->
	</div>
	<!-- ./wrapper -->

	<?php $this->load->view('dashboard/admin/script.php') ?>
</body>

</html>