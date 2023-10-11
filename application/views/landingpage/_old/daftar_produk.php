<!DOCTYPE html>
<html lang="id" class="no-js">

<?php $this->load->view('landingpage/head') ?>
<link rel="stylesheet" href="<?= base_url() ?>assets/dashboard/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="<?= base_url() ?>assets/dashboard/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">

<body>

	<!-- Start Header Area -->
	<?php $this->load->view('landingpage/header') ?>
	<!-- End Header Area -->

	<!-- Start Banner Area -->
	<section class="banner-area organic-breadcrumb">
		<div class="container">
			<div class="breadcrumb-banner d-flex flex-wrap align-items-center justify-content-end">
				<div class="col-first">
					<h1>Buat Paket</h1>
					<nav class="d-flex align-items-center">
						<a href="#">Buat Paket<span class="lnr lnr-arrow-right"></span></a>
						<a href="#">Preview Pesanan</a>
					</nav>
				</div>
			</div>
		</div>
	</section>
	<!-- End Banner Area -->

	<!--================Blog Area =================-->
	<section class="blog_area mt-4 mb-lg-5">
		<div class="container">
			<div class="row">
			<div class="col-lg-12 d-flex align-items-center justify-content-center">
				<a href="" class="primary-btn" style="line-height:15px;padding:15px">1</a>
				<span class="ml-2">Informasi Pemesanan</span>
				<hr style="width: 80px; height: 2px;" class="bg-warning m-0 ml-2">
				<a href="" class="primary-btn" style="line-height:15px;padding:15px">2</a>
				<b class="ml-2">Daftar Produk</b>
			</div>

				<div class="col-lg-12">
					<br><br>
					<div class="container">
						<div class="cart_inner" id="test">
							<h3 style="color:white;padding: 20px;">Daftar Produk</h3>
							<div class="table-responsive">
								<table class="table" style="background-color:white">
									<thead>
										<tr>
											<th scope="col">Produk</th>
											<th scope="col">Harga Satuan</th>
											<th scope="col">Kuantitas</th>
											<th scope="col">Total Harga</th>
										</tr>
									</thead>
									<tbody>
										<?php $subtotal = 0; ?>
										<?php foreach ($paket as $data) : ?>
											<tr>
												<td>
													<div class="media">
														<div class="d-flex">
															<?php if (!$data->foto) : ?>
																<img src="<?= base_url() ?>assets/landingpage/img/dummyproduct.png" width="180px">
															<?php else : ?>
																<img src="<?= base_url() ?>uploads/foto_produk/<?= $data->foto ?>" alt="Foto Produk" width="180px">
															<?php endif; ?>
														</div>
														<div class="media-body">
															<p><?= $data->nama_produk ?></p>
														</div>
													</div>
												</td>
												<td>
													<h5><?= rupiah($data->harga) ?></h5>
												</td>
												<td>
													<div class="product_count">
														<input type="text" value="<?= $data->kuantitas ?>" disabled>
													</div>
												</td>
												<td>
													<?php $total = $data->harga * $data->kuantitas; ?>
													<h5><?= rupiah($total) ?></h5>
													<?php $subtotal += $total; ?>
												</td>
											</tr>
										<?php endforeach; ?>
										<tr>
											<td colspan="3" class="text-right">
												<b>Subtotal</b>
											</td>
											<td>
												<b><?= rupiah($subtotal) ?></b>
											</td>
										</tr>
										<tr>
											<td colspan="4">
												<div class="checkout_btn_inner d-flex justify-content-end">
													<?= form_open(base_url('PUMK/buat_po')) ?>
														<input type="submit" value="Checkout" class="primary-btn border-0">
													<?= form_close() ?>
												</div>
											</td>
										</tr>
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
</body>

</html>