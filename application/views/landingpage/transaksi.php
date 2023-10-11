<!DOCTYPE html>
<html lang="id" class="no-js">

<head>
	<?php $this->load->view('landingpage/head') ?>
	<title>Transaksi | E-Katalog UNPAD</title>
	
	<link rel="stylesheet" href="<?= base_url() ?>assets/dashboard/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
	<link rel="stylesheet" href="<?= base_url() ?>assets/dashboard/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
	<link rel="stylesheet" href="<?= base_url() ?>assets/dashboard/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
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
					<h1>Transaksi</h1>
					<nav class="d-flex align-items-center">
						<a href="#">Informasi<span class="lnr lnr-arrow-right"></span></a>
						<a href="#">Transaksi</a>
					</nav>
				</div>
			</div>
		</div>
	</section>
	<!-- End Banner Area -->

	<br><br>
	<!--================Blog Area =================-->
	<section class="blog_area">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<div class="blog_left_sidebar">
						<div class="row">
							<div class="col-lg-12" style="margin-bottom:20px">
								<table class="table" id="example1">
									<thead>
										<th>No.</th>
										<th>Kategori Produk</th>
										<th>Etalase Produk</th>
										<th>Item Produk</th>
										<th>Jumlah Transaksi</th>
										<th>Total Produk Terjual</th>
									</thead>
									<tbody>
										<?php
										$no = 1;
										foreach ($produk as $data) { ?>
											<tr>
												<td><?= $no++ ?></td>
												<td><?= $data->nama_ke ?></td>
												<td><?= $data->nama_etalase ?></td>
												<td><?= $data->nama_item ?></td>
												<td><?= $data->totalpaket ?> paket</td>
												<td><?= $data->totalproduk ?> <?= $data->unit_pengukuran ?> </td>
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

	<!-- start footer Area -->
	<?php $this->load->view('landingpage/footer') ?>
	<!-- End footer Area -->

	<?php $this->load->view('landingpage/script') ?>
	<script src="<?= base_url() ?>assets/dashboard/plugins/datatables/jquery.dataTables.min.js"></script>
	<script src="<?= base_url() ?>assets/dashboard/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
	<script src="<?= base_url() ?>assets/dashboard/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
	<script>
		$(function() {
			$("#example1").DataTable({
				"responsive": true,
				"autoWidth": false,
			})
		});
	</script>
</body>

</html>