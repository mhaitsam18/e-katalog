<!DOCTYPE html>
<html lang="id">

<head>
	<?php $this->load->view('dashboard/admin/head.php') ?>
	<title>Riwayat Produk | E-Katalog</title>
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
							<h1>Riwayat Produk</h1>
						</div>
						<div class="col-sm-6">
							<ol class="breadcrumb float-sm-right">
								<li class="breadcrumb-item"><a href="<?= base_url('Admin') ?>">Beranda</a></li>
								<li class="breadcrumb-item active"><a href="<?= base_url('Admin/produk/'.$id_produk) ?>">Detail Produk</a></li>
								<li class="breadcrumb-item active">Riwayat Produk</li>
							</ol>
						</div>
					</div>
				</div><!-- /.container-fluid -->
			</section>

			<section class="content">
				<div class="container-fluid">
					<div class="row">
						<div class="col">
							<a href="<?= base_url('Admin/produk/' . $id_produk) ?>" class="btn btn-secondary btn-sm">
								<i class="fa fa-arrow-left mr-2"></i> Kembali ke Detail Produk
							</a>

							<a href="<?= base_url('Admin/download_riwayat_produk/' . $id_produk) ?>" class="btn btn-secondary btn-sm">
								<i class="fa fa-download"></i> Download file .txt
							</a>
						</div>
					</div>
				</div>
			</section>

			<!-- Main content -->
			<section class="content">
				<div class="container-fluid">
					<div class="row mt-2">
						<div class="col-12">
							<div class="timeline">
								<?php foreach ($riwayat as $tanggal => $data) : ?>
									<div class="time-label">
										<span class="bg-red"><?= $tanggal ?></span>
									</div>
									<?php foreach ($data as $r) : ?>
										<div>
											<i class="fas fa-history bg-blue"></i>
											<div class="timeline-item">
												<span class="time"><i class="fas fa-clock mr-1"></i><?= $r['waktu'] ?></span>
												<h3 class="timeline-header"><?= ucfirst(str_replace('_', ' ', trim($r['aksi'], ', '))); ?></h3>

												<?php $item = $r['item_riwayat']; ?>
												<div class="timeline-body">
													<?php if (!is_null($item['nama_produk'])) : ?>
														<span class="d-block">Nama Produk: <?= $item['nama_produk']; ?></span>
													<?php endif; ?>

													<?php if (!is_null($item['harga'])) : ?>
														<span class="d-block">Harga: <?= rupiah($item['harga']); ?></span>
													<?php endif; ?>

													<?php if (!is_null($item['harga_ppn'])) : ?>
														<span class="d-block">Harga PPN: <?= rupiah($item['harga_ppn']); ?></span>
													<?php endif; ?>

													<?php if (!is_null($item['masa_berlaku'])) : ?>
														<span class="d-block">Masa Berlaku: <?= tanggal($item['masa_berlaku']); ?></span>
													<?php endif; ?>

													<?php if (!is_null($item['merek'])) : ?>
														<span class="d-block">Merk: <?= $item['merek']; ?></span>
													<?php endif; ?>

													<?php if (!is_null($item['no_produk_penyedia'])) : ?>
														<span class="d-block">No. Produk Penyedia: <?= $item['no_produk_penyedia']; ?></span>
													<?php endif; ?>

													<?php if (!is_null($item['unit_pengukuran'])) : ?>
														<span class="d-block">Unit Pengukuran: <?= $item['unit_pengukuran']; ?></span>
													<?php endif; ?>

													<?php if (!is_null($item['kode_kbki'])) : ?>
														<span class="d-block">Kode KBKI: <?= $item['kode_kbki']; ?></span>
													<?php endif; ?>

													<?php if (!is_null($item['nilai_tkdn'])) : ?>
														<span class="d-block">Nilai TKDN: <?= $item['nilai_tkdn']; ?></span>
													<?php endif; ?>

													<?php if (!is_null($item['stok'])) : ?>
														<span class="d-block">Stok: <?= $item['stok']; ?></span>
													<?php endif; ?>

													<?php if (!is_null($item['deskripsi'])) : ?>
														<span class="d-block">Deskripsi: <?= $item['deskripsi']; ?></span>
													<?php endif; ?>

													<?php if (!is_null($item['no_item'])) : ?>
														<span class="d-block">No. Item: <?= $item['no_item']; ?></span>
													<?php endif; ?>

													<?php if (!is_null($item['nama_etalase'])) : ?>
														<span class="d-block">Nama etalase: <?= $item['nama_etalase']; ?></span>
													<?php endif; ?>

													<?php if (!is_null($item['nama_penyedia'])) : ?>
														<span class="d-block">Penyedia: <?= $item['nama_penyedia']; ?></span>
													<?php endif; ?>

													<?php if (!is_null($item['foto'])) : ?>
														<div>
															<img src="<?= base_url('uploads/foto_produk/'.$item['foto']) ?>" alt="Foto Produk" class="img-thumbnail">
														</div>
													<?php endif; ?>
												</div>
											</div>
										</div>
									<?php endforeach; ?>
								<?php endforeach; ?>

								<div>
									<i class="fas fa-clock bg-gray"></i>
								</div>
							</div>
						</div>
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
	</div>
	<!-- ./wrapper -->

	<?php $this->load->view('dashboard/admin/script.php') ?>
</body>

</html>