<!DOCTYPE html>
<html lang="id">

<head>
	<?php $this->load->view('dashboard/admin/head.php') ?>
	<title>Detail Paket | E-Katalog</title>
	<link rel="stylesheet" href="<?= base_url() ?>assets/dashboard/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
	<link rel="stylesheet" href="<?= base_url() ?>assets/dashboard/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
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
							<h1>Detail Paket</h1>
						</div>
						<div class="col-sm-6">
							<ol class="breadcrumb float-sm-right">
								<li class="breadcrumb-item"><a href="<?= base_url('Admin') ?>">Beranda</a></li>
								<li class="breadcrumb-item active"><?= ucwords(str_replace('_', ' ', $this->session->daftar_paket)) ?></li>
							</ol>
						</div>
					</div>
				</div><!-- /.container-fluid -->
			</section>

			<section class="content">
				<div class="container-fluid">
					<div class="row">
						<div class="col">
							<a href="<?= base_url('Admin/'.$this->session->daftar_paket) ?>" class="btn btn-secondary btn-sm">
								<i class="fa fa-arrow-left mr-1"></i> Kembali ke daftar paket
							</a>

							<a href="<?= base_url('Admin/riwayat_paket/'.$paket->id_paket) ?>" class="btn btn-secondary btn-sm">
								<i class="fa fa-history mr-1"></i> Lihat Riwayat Paket
							</a>
						</div>
					</div>
				</div>
			</section>

			<!-- Main content -->
			<section class="content">
				<div class="container-fluid">
					<div class="row mt-2">
						<!-- Detail Pengumuman -->
						<div class="col-12">
							<div class="card">
								<div class="card-header">
									<strong><?= $paket->id_paket ?></strong>
								</div>
								<div class="card-body">
									<dl class="row">
										<dt class="col-sm-2">PUMK</dt>
										<dd class="col-sm-10"><?= $keranjang[0]->nama_pumk; ?></dd>
										<dt class="col-sm-2">PP</dt>
										<dd class="col-sm-10"><?= $paket->nama_pp; ?></dd>
										<dt class="col-sm-2">Status</dt>
										<dd class="col-sm-10"><?= status_paket($paket->status); ?></dd>
										<dt class="col-sm-2">Tanggal dibuat</dt>
										<dd class="col-sm-10"><?= tanggal($paket->tanggal); ?></dd>
										<dt class="col-sm-2">No. PR</dt>
										<dd class="col-sm-10"><?= $paket->no_pr ?? '-'; ?></dd>
									</dl>
								</div>
								<!-- /.card-body -->
							</div>
							<!-- /.card -->
						</div>
						<!-- /.col -->

						<!-- Daftar Merek -->
						<div class="col-12">
							<div class="card">
								<div class="card-header">
									<div class="card-title text-bold">
										Produk dalam Paket ini
									</div>
								</div>
								<div class="card-body">
									<table id="keranjang" class="table table-bordered table-striped">
										<thead>
											<tr>
												<th>No.</th>
												<th>Nama Produk</th>
												<th>Penyedia</th>
												<th>Kuantitas</th>
												<th>Harga (+PPN)</th>
												<th>Total</th>
											</tr>
										</thead>
										<?php if (!empty($keranjang)) : ?>
											<tbody>
												<?php $i = 1; $subtotal = 0;?>
												<?php foreach ($keranjang as $k) : ?>
													<tr>
														<td><?= $i++; ?></td>
														<td><a href="<?= base_url('Admin/produk/'.$k->id_produk); ?>"><?= $k->nama_produk; ?></a></td>
														<td><?= $k->nama_penyedia; ?></td>
														<td><?= $k->kuantitas; ?></td>
														<td><?= rupiah($k->harga_ppn); ?></td>
														<td><?= rupiah($k->harga_ppn * $k->kuantitas); ?></td>
													</tr>
													<?php $subtotal += $k->harga_ppn * $k->kuantitas; ?>
												<?php endforeach; ?>
											</tbody>
											<tfoot>
												<tr>
													<td colspan="5" class="text-right">Subtotal</td>
													<td>
														<?= rupiah($subtotal) ?>
													</td>
												</tr>
											</tfoot>
										<?php endif; ?>
									</table>
								</div>
							</div>
						</div>

						<!-- Negosiasi Harga -->
						<div class="col-12">
							<div class="card">
								<div class="card-header">
									<div class="card-title text-bold">
										Negosiasi Harga
									</div>

									<div class="card-tools">
											<?php if(! empty($negosiasi_harga)): ?>
												<a href="<?= base_url('Admin/riwayat_negosiasi/harga/'.$paket->id_paket) ?>" class="btn btn-secondary btn-sm">
													<i class="fa fa-history mr-1"></i>Lihat Riwayat Negosiasi
												</a>
											<?php endif; ?>
									</div>
								</div>
								<div class="card-body">
									<table class="table table-bordered">
										<thead>
											<tr>
												<th>No.</th>
												<th>Nominal</th>
												<th>Ongkos Kirim</th>
												<th>Catatan Pembeli</th>
												<th>Catatan Penyedia</th>
											</tr>
										</thead>
										<tbody>
											<?php if (!empty($negosiasi_harga)) : ?>
												<?php $i = 1; ?>
												<?php foreach ($negosiasi_harga as $nh) : ?>
													<tr>
														<td><?= $i++; ?></td>
														<td><?= rupiah($nh->nominal); ?></td>
														<td><?= is_null($nh->ongkir) ? rupiah($nh->ongkir) : '-'; ?></td>
														<td><?= $nh->catatan_pembeli ?? '-'; ?></td>
														<td><?= $nh->catatan_penyedia ?? '-'; ?></td>
													</tr>
												<?php endforeach; ?>
											<?php else: ?>
												<tr>
													<td colspan="6" align="center">Tidak ada negosiasi harga di paket ini</td>
												</tr>
											<?php endif; ?>
										</tbody>
									</table>
								</div>
							</div>
						</div>

						<!-- Negosiasi Spesifikasi -->
						<div class="col-12">
							<div class="card">
								<div class="card-header">
									<div class="card-title text-bold">
										Negosiasi Spesifikasi
									</div>

									<div class="card-tools">
											<?php if(! empty($negosiasi_spesifikasi)): ?>
												<a href="<?= base_url('Admin/riwayat_negosiasi/spesifikasi/'.$paket->id_paket) ?>" class="btn btn-secondary btn-sm">
													<i class="fa fa-history mr-1"></i>Lihat Riwayat Negosiasi
												</a>
											<?php endif; ?>
									</div>
								</div>
								<div class="card-body">
									<table class="table table-bordered">
										<thead>
											<tr>
												<th>No.</th>
												<th>Spesifikasi</th>
												<th>Nilai</th>
												<th>Catatan Pembeli</th>
												<th>Catatan Penyedia</th>
											</tr>
										</thead>
										<tbody>
											<?php if (!empty($negosiasi_spesifikasi)) : ?>
												<?php $i = 1; ?>
												<?php foreach ($negosiasi_spesifikasi as $ns) : ?>
													<tr>
														<td><?= $i++; ?></td>
														<td><?= $ns->spesifikasi ?></td>
														<td><?= $ns->nilai; ?></td>
														<td><?= $ns->catatan_pembeli ?? '-'; ?></td>
														<td><?= $ns->catatan_penyedia ?? '-'; ?></td>
													</tr>
												<?php endforeach; ?>
											<?php else: ?>
												<tr>
													<td colspan="5" align="center">Tidak ada negosiasi spesifikasi di paket ini</td>
												</tr>
											<?php endif; ?>
										</tbody>
									</table>
								</div>
							</div>
						</div>

						<!-- Negosiasi Tanggal -->
						<div class="col-12">
							<div class="card">
								<div class="card-header">
									<div class="card-title text-bold">
										Negosiasi Tanggal
									</div>

									<div class="card-tools">
											<?php if(! empty($negosiasi_tanggal)): ?>
												<a href="<?= base_url('Admin/riwayat_negosiasi/tanggal/'.$paket->id_paket) ?>" class="btn btn-secondary btn-sm">
													<i class="fa fa-history mr-1"></i>Lihat Riwayat Negosiasi
												</a>
											<?php endif; ?>
									</div>
								</div>
								<div class="card-body">
									<table class="table table-bordered">
										<thead>
											<tr>
												<th>No.</th>
												<th>Tanggal Mulai</th>
												<th>Tanggal Akhir</th>
												<th>Catatan Pembeli</th>
												<th>Catatan Penyedia</th>
											</tr>
										</thead>
										<tbody>
											<?php if (!empty($negosiasi_tanggal)) : ?>
												<?php $i = 1; ?>
												<?php foreach ($negosiasi_tanggal as $nt) : ?>
													<tr>
														<td><?= $i++; ?></td>
														<td><?= tanggal($nt->tanggal_mulai); ?></td>
														<td><?= tanggal($nt->tanggal_akhir); ?></td>
														<td><?= $nt->catatan_pembeli ?? '-'; ?></td>
														<td><?= $nt->catatan_penyedia ?? '-'; ?></td>
													</tr>
												<?php endforeach; ?>
											<?php else: ?>
												<tr>
													<td colspan="6" align="center">Tidak ada negosiasi tanggal di paket ini</td>
												</tr>
											<?php endif; ?>
										</tbody>
									</table>
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
	<script src="<?= base_url('assets\dashboard\plugins\datatables\jquery.dataTables.min.js') ?>"></script>
	<script src="<?= base_url('assets\dashboard\plugins\datatables-bs4\js\dataTables.bootstrap4.min.js') ?>"></script>
	<script>
		$(function() {
			$("#keranjang").DataTable({
				"responsive": true,
				"autoWidth": false,
			});
		});
	</script>
</body>

</html>