<!DOCTYPE html>
<html lang="id" class="no-js">

<head>
	<?php $this->load->view('landingpage/head') ?>
	<title>Postingan Pengumuman | E-Katalog UNPAD</title>
</head>

<body>

	<!-- Start Header Area -->
	<?php $this->load->view('landingpage/header') ?>
	<!-- End Header Area -->

	<!-- Start Banner Area -->
	<section class="banner-area organic-breadcrumb">
		<div class="container">
			<div class="breadcrumb-banner d-flex flex-wrap align-items-center justify-content-end">
				<div class="col-first">
					<h1>Pengumuman</h1>
					<nav class="d-flex align-items-center">
						<a href="<?= base_url(); ?>">Beranda<span class="lnr lnr-arrow-right"></span></a>
						<a href="<?= base_url('pengumuman'); ?>">Pengumuman</a>
					</nav>
				</div>
			</div>
		</div>
	</section>
	<!-- End Banner Area -->

	<!--================Blog Area =================-->
	<section class="blog_area single-post-area section_gap">
		<div class="container">
			<a href="<?= base_url() ?>LandingPage/pengumuman" class="primary-btn">
				<i class="fa fa-arrow-left" aria-hidden="true"></i> Kembali
			</a>
			<br><br>
			<h2>Pengumuman <?= $posting->judul ?></h2>
			<!-- <button class="btn btn-dark" style="float:right">NASIONAL</button> -->
			<br><br>
			<hr>
			<div class="row">
				<div class="col-lg-12 posts-list">
					<div class="single-post row">
						<div class="col-lg-12">
							<table cellpadding="20">
								<tr>
									<td><b>Etalase Produk</b></td>
									<td><?= $posting->nama_etalase ?></td>
								</tr>
								<tr>
									<td><b>Daftar Merek</b></td>
									<td>
										<button type="button" class="btn btn-primary tampilkan" data-toggle="modal" data-target="#modal-lg">
											<i class="fa fa-info" aria-hidden="true"></i> Info
										</button>
									</td>
								</tr>
								<tr>
									<td><b>Dokumen Syarat dan Kententuan</b></td>
									<td><?= $posting->syarat_ketentuan ?></td>
								</tr>
								<tr>
									<td><b>Dokumen Pengumuman</b></td>
									<td>
										<?php if (!$posting->dok_pengumuman) {
											echo "Tidak ada lampiran";
										} else { ?>
											<a class="btn btn-success" target="_blank" href="<?= base_url() ?>uploads/dokumen_pengumuman/<?= $posting->dok_pengumuman ?>" rel="noopener noreferer">
												<i class="fa fa-file" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;
												Lampiran</a>
										<?php } ?>
									</td>
								</tr>
								<tr>
									<td><b>Jumlah Penawaran</b></td>
									<td><?= $posting->jumlah_penawaran ?></td>
								</tr>
							</table>
							<br><br>
							<div class="table-responsive" style="border:1px solid blue;border-radius:10px;padding:15px;background-color:aliceblue">
								<h5>Jadwal <?= $posting->judul ?></h5>
								<table class="table" style="background-color:white">
									<thead style="text-align:center">
										<th>Tahapan</th>
										<th>Tanggal Mulai</th>
										<th>Tanggal Akhir</th>
										<th>Perubahan</th>
									</thead>
									<tbody>
										<?php foreach ($tahapan as $data) { ?>
											<tr>
												<td><?= $data->judul ?></td>
												<td><?= $data->tanggal_mulai ?></td>
												<td><?= $data->tanggal_akhir ?></td>
												<td><?= $data->perubahan ?></td>
											</tr>
										<?php } ?>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!--================Blog Area =================-->

	<?php foreach ($merek as $data) { ?>
		<div class="modal fade" id="modal-lg">
			<div class="modal-dialog modal-lg">
				<div class="modal-content">
					<div class="modal-header">
						<h4 class="modal-title">Daftar Merek</h4>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<table class="table" style="background-color:white">
							<thead style="text-align:center">
								<th>Etalase Produk</th>
								<th>Merek</th>
								<th>Deskripsi</th>
							</thead>
							<tbody>
								<?php foreach ($merek as $data) { ?>
									<tr>
										<td><?= $data->nama_etalase ?></td>
										<td><?= $data->nama_merek ?></td>
										<td><?= $data->deskripsi ?></td>
									</tr>
								<?php } ?>
							</tbody>
						</table>
					</div>
					<div class="modal-footer justify-content-between">
						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					</div>
				</div>
				<!-- /.modal-content -->
			</div>
			<!-- /.modal-dialog -->
		</div>
	<?php } ?>

	<!-- start footer Area -->
	<?php $this->load->view('landingpage/footer') ?>
	<!-- End footer Area -->

	<?php $this->load->view('landingpage/script') ?>
</body>

</html>