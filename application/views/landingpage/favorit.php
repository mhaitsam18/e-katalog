<!DOCTYPE html>
<html lang="id" class="no-js">
<head>
	<?php $this->load->view('landingpage/head') ?>
	<title>Favorit | E-Katalog UNPAD</title>
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
					<h1>Favorit</h1>
					<nav class="d-flex align-items-center">
						<a href="<?= base_url(); ?>">Beranda<span class="lnr lnr-arrow-right"></span></a>
						<a href="">Favorit</a>
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

			<?php $this->alert->tampilkan(); ?>

			<div class="single-product-slider">
				<div class="container">
					<div class="row justify-content-center">
						<div class="col-lg-6 text-center">
							<div class="section-title">
								<h1>Produk Favorit Anda</h1>
							</div>
						</div>
					</div>
					<div class="row">
						<?php foreach ($fav as $data) { ?>
							<div class="col-lg-3 col-md-6">
								<div class="single-product">
									<?php if (!$data->foto) { ?>
										<img style="width:250px;height:250px" src="<?= base_url() ?>assets/landingpage/img/dummyproduct.png" alt="Foto Produk">
									<?php } else { ?>
										<img style="width:250px;height:250px" src="<?= base_url() ?>uploads/foto_produk/<?= $data->foto ?>" alt="Foto Produk">
									<?php } ?>
									<div class="product-details">
										<h6><?= $data->nama_produk ?></h6>
										<div class="price">
											<h6 class="text-capitalize"><?= rupiah($data->harga); ?></h6>
										</div>
										<div class="prd-bottom">
											<?php if (!$this->session->id) { ?>
												<a href="login" class="social-info">
													<span class="lnr lnr-cart"></span>
													<p class="hover-text">Keranjang</p>
												</a>
											<?php } else { ?>
												<a href="<?= base_url() ?>PUMK/input_produk/<?= $data->id_produk ?>" class="social-info">
													<span class="lnr lnr-cart"></span>
													<p class="hover-text">Keranjang</p>
												</a>
											<?php } ?>
											<a href="" class="social-info">
												<span class="lnr lnr-sync"></span>
												<p class="hover-text">Bandingkan</p>
											</a>
											<a href="<?= base_url() ?>LandingPage/lihat_produk/<?= $data->id_produk ?>" class="social-info">
												<span class="lnr lnr-eye"></span>
												<p class="hover-text">Lihat Selengkapnya</p>
											</a>
											<a href="<?= base_url() ?>PUMK/hapus_favorit/<?= $data->id_produk ?>" class="social-info">
												<span class="lnr lnr-trash"></span>
												<p class="hover-text">Hapus</p>
											</a>
										</div>
									</div>
								</div>
							</div>
						<?php } ?>
					</div>
				</div>
				<br>
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