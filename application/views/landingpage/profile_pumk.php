<!DOCTYPE html>
<html lang="id" class="no-js">

<head>
	<?php $this->load->view('landingpage/head') ?>
	<title>Profil PUMK | E-Katalog UNPAD</title>
	
	<link rel="stylesheet" href="<?=base_url()?>assets/landingpage/css/font-awesome.min.css">
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
					<h1>Profil PUMK</h1>
					<nav class="d-flex align-items-center">
						<a href="<?= base_url() ?>">Beranda<span class="lnr lnr-arrow-right"></span></a>
						<a href="#">Profil</a>
					</nav>
				</div>
			</div>
		</div>
	</section>
	<!-- End Banner Area -->

	<!--================Blog Area =================-->
	<section class="blog_area single-post-area section_gap">
		<div class="container">
			<div class="row">
				<div class="col-lg-4">
					<div class="blog_right_sidebar">
						<aside class="single_sidebar_widget author_widget">
							<img class="author_img rounded-circle" src="<?= base_url() ?>assets/landingpage/img/dummyprofile.png" alt="" width="100px">
							<h4><?= $this->session->nama_pumk; ?></h4>
							<p>PUMK</p>
							<br>
							<form action="<?= base_url() ?>logout" method="post" class="nav-link">
								<?= csrf(); ?>
								<button class="primary-btn" style="border:0px">Logout</button>
							</form>
						</aside>
						<aside class="single-sidebar-widget tag_cloud_widget">


						</aside>
					</div>
				</div>
				<div class="col-lg-8">
					<div class="row">
						<div class="col-md-4" style="border:1px solid #eee;border-radius:8px;padding:25px">
							<div class="mb-3">
								<i class="fa fa-cart-arrow-down fa-5x mr-4" aria-hidden="true"></i>
								<span style="font-weight:bold;font-size:70px;"><?= $jml_keranjang ?></span>
							</div>
							<div>
								<a href="<?= base_url() ?>PUMK/keranjang">
									Keranjang
									<i class="fa fa-arrow-circle-right" aria-hidden="true"></i>
								</a>
							</div>
						</div>

						<div class="col-md-4" style="border:1px solid #eee;border-radius:8px;padding:25px">
							<div class="mb-3">
								<i class="fa fa-heart fa-5x mr-4" aria-hidden="true"></i>
								<span style="font-weight:bold;font-size:70px;"><?= $jml_favorit ?></span>
							</div>
							<div>
								<a href="<?= base_url() ?>PUMK/favorit/<?= $this->session->id ?>">
									Favorit
									<i class="fa fa-arrow-circle-right" aria-hidden="true"></i>
								</a>
							</div>
						</div>

						<div class="col-md-4" style="border:1px solid #eee;border-radius:8px;padding:25px">
							<div class="mb-3">
								<i class="fa fa-book fa-5x mr-4" aria-hidden="true"></i>
								<span style="font-weight:bold;font-size:70px;"><?= $jml_paket ?></span>
							</div>
							<div>
								<a href="<?= base_url() ?>PUMK/daftar_paket">
									Daftar Ajuan Paket
									<i class="fa fa-arrow-circle-right" aria-hidden="true"></i>
								</a>
							</div>
						</div>

					</div>

					<div class="text-center mt-5">
						<h2>Daftar Status Paket</h2>
					</div>

					<div class="col-md-12">
						<div class="row justify-content-center">
							<div class="col-md-4" style="border:1px solid #eee;border-radius:8px;padding:25px">
								<div class="mb-3">
									<i class="fa fa-spinner fa-5x mr-4" aria-hidden="true"></i>
									<span style="font-weight:bold;font-size:70px;"><?= $pending ?></span>
								</div>
								<div>
									<p>Paket Diproses</p>
								</div>
							</div>
							<div class="col-md-4" style="border:1px solid #eee;border-radius:8px;padding:25px">
								<div class="mb-3">
									<i class="fa fa-truck fa-5x mr-4" aria-hidden="true"></i>
									<span style="font-weight:bold;font-size:70px;"><?= $kirim ?></span>
								</div>
								<div>
									<p>Paket Dikirm</p>
								</div>
							</div>
							<div class="col-md-4" style="border:1px solid #eee;border-radius:8px;padding:25px">
								<div class="mb-3">
									<i class="fa fa-handshake-o fa-5x mr-4" aria-hidden="true"></i>
									<span style="font-weight:bold;font-size:70px;"><?= $negosiasi ?></span>
								</div>
								<div>
									<p>Paket Dinego</p>
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-12">
						<div class="row justify-content-center">
							<div class="col-md-4" style="border:1px solid #eee;border-radius:8px;padding:25px">
								<div class="mb-3">
									<i class="fa fa-check fa-5x mr-4" aria-hidden="true"></i>
									<span style="font-weight:bold;font-size:70px;"><?= $selesai ?></span>
								</div>
								<div>
									<p>Paket Selesai</p>
								</div>
							</div>
							<div class="col-md-4" style="border:1px solid #eee;border-radius:8px;padding:25px">
								<div class="mb-3">
									<i class="fa fa-times fa-5x mr-4" aria-hidden="true"></i>
									<span style="font-weight:bold;font-size:70px;"><?= $batal ?></span>
								</div>
								<div>
									<p>Paket Dibatalkan</p>
								</div>
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