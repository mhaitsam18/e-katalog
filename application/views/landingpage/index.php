<!DOCTYPE html>
<html lang="id" class="no-js">

<head>
	<?php $this->load->view('landingpage/head'); ?>

	<title>E-Katalog UNPAD</title>
	<link rel="stylesheet" href="<?=base_url()?>assets/landingpage/css/owl.carousel.css">

	<?php if ($this->session->has_userdata('keranjang_alert')) : ?>
		<link rel="stylesheet" href="<?= base_url('assets/dashboard/plugins/sweetalert2/sweetalert2.min.css') ?>">
		</link>
	<?php endif; ?>
</head>

<body>

	<!-- Start Header Area -->
	<?php $this->load->view('landingpage/header'); ?>
	<!-- End Header Area -->

	<!-- start banner Area -->
	<section class="banner-area">
		<div class="container">
			<div class="row fullscreen align-items-center justify-content-start">
				<div class="col-lg-12">
					<div class="active-banner-sliderl">
						<!-- single-slide -->
						<div class="row single-slide align-items-center d-flex">
							<div class="col-lg-5 col-md-6">
								<div class="banner-content mt-lg-5">
									<h1>E-Katalog UNPAD</h1>
									<p style="margin-top:-5px;text-align:justify">Mari lengkapi kebutuhan organisasi Anda dengan
										berbelanja
										di E-katalog dengan mudah !! Tersedia beberapa kategori etalase produk yang dibutuhkan mulai dari
										alat tulis kantor,
										keperluan ruangan <br> kantor, dan lainnya. Yuk cari barang kebutuhanmu !</p>
									<br>
									<?php if (! isset($this->session->id)): ?>
										<a href="login" class="primary-btn">Login Sekarang</a>
									<?php endif; ?>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- End banner Area -->

	<!-- start features Area -->
	<section class="features-area section_gap">
		<div class="container">
			<div class="row features-inner">
				<!-- single features -->
				<div class="col-lg-4 col-md-6 col-sm-6">
					<div class="single-features">
						<i style="margin-top:5px;margin-bottom:8px" class="fa fa-cubes fa-4x" aria-hidden="true"></i>
						<h6>Barang</h6>
						<p>Kategori Etalase Produk</p>
					</div>
				</div>
				<!-- single features -->
				<div class="col-lg-4 col-md-6 col-sm-6">
					<div class="single-features">
						<i style="margin-top:5px;margin-bottom:8px" class="fa fa-child fa-4x" aria-hidden="true"></i>
						<h6>Jasa</h6>
						<p>Kategori Etalase Produk</p>
					</div>
				</div>
				<!-- single features -->
				<div class="col-lg-4 col-md-6 col-sm-6">
					<div class="single-features">
						<i style="margin-top:5px;margin-bottom:8px" class="fa fa-list fa-4x" aria-hidden="true"></i>
						<h6>Lainnya</h6>
						<p>Kategori Etalase Produk</p>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- end features Area -->

	<!-- Start category Area -->
	<section class="category-area">
		<div class="container">
			<h1>Pengumuman Terbaru</h1><br>
			<div class="row justify-content-center">
				<div class="col-lg-12 col-md-12">
					<div class="row">
						<?php foreach ($pengumuman as $data) : ?>
							<div class="col-lg-4 col-md-4">
								<div class="single-deal">
									<div class="overlay"></div>
									<img class="img-fluid w-100" src="<?= base_url() ?>assets/landingpage/img/berita4.png" alt="banner pengumuman">
									<a href="<?= base_url() ?>LandingPage/postingan_pengumuman/<?= $data->id_pengumuman ?>" target="_blank" rel="noopener noreferer">
										<div class="deal-details">
											<h6 class="deal-title"><?= $data->judul ?></h6>
										</div>
									</a>
								</div>
							</div>
						<?php endforeach; ?>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- End category Area -->

	<!-- start product Area -->
	<section class="mt-lg-5 pb-4">
		<!-- single product slide -->
		<div class="single-product-slider">
			<div class="container">
				<div class="row justify-content-center">
					<div class="col-lg-6 text-center">
						<div class="section-title">
							<h1>Produk</h1>
						</div>
					</div>
				</div>
				<div class="row">
					<?php foreach ($produk as $data) : ?>
						<div class="col-lg-3 col-md-6">
							<div class="single-product">
								<?php $src = is_null($data->foto) ? base_url() . 'assets/landingpage/img/dummyproduct.png' : base_url() . 'uploads/foto_produk/' . $data->foto ?>
								<img class="img-fluid" src="<?= $src ?>" alt="Foto produk">

								<div class="product-details">
									<h6><?= $data->nama_produk ?></h6>
									<div class="price">
										<h6 class="text-capitalize"><?= rupiah($data->harga) ?></h6>
									</div>
									<div class="prd-bottom">
										<?php if (! $this->session->id) : ?>
											<a href="<?= base_url('login') ?>" class="social-info">
												<span class="lnr lnr-cart"></span>
												<p class="hover-text">Keranjang</p>
											</a>
											<a href="<?= base_url('login') ?>" class="social-info">
												<span class="lnr lnr-heart"></span>
												<p class="hover-text">Favorit</p>
											</a>
										<?php else : ?>
											<a href="<?= base_url() ?>PUMK/input_produk/<?= $data->id_produk ?>" class="social-info">
												<span class="lnr lnr-cart"></span>
												<p class="hover-text">Keranjang</p>
											</a>
											<a href="<?= base_url() ?>PUMK/input_favorit/<?= $data->id_produk ?>" class="social-info">
												<span class="lnr lnr-heart"></span>
												<p class="hover-text">Favorit</p>
											</a>
										<?php endif; ?>
										<a href="<?= base_url() ?>LandingPage/bandingkan_produk/<?= $data->id_produk ?>" class="social-info">
											<span class="lnr lnr-sync"></span>
											<p class="hover-text">Bandingkan</p>
										</a>
										<a href="<?= base_url() ?>LandingPage/lihat_produk/<?= $data->id_produk ?>" class="social-info">
											<span class="lnr lnr-eye"></span>
											<p class="hover-text">Lihat Selengkapnya</p>
										</a>
									</div>
								</div>
							</div>
						</div>
					<?php endforeach; ?>
				</div>
			</div>
			<div class="text-center">
				<a href="<?= base_url() ?>produk" class="primary-btn">Lihat Lainnya</a>
			</div>
		</div>
	</section>
	<!-- end product Area -->

	<!-- Start exclusive deal Area -->
	<section class="exclusive-deal-area mt-lg-5">
		<div class="container-fluid">
			<div class="row justify-content-center align-items-center">
				<div class="col-lg-6 no-padding exclusive-left">
					<div class="row clock_sec clockdiv" id="clockdiv">
						<div class="col-lg-12">
							<h1>Dapatkan Tawaran Menarik</h1>
							<p>Catat dan ingat tanggal dan waktunya</p>
						</div>
						<div class="col-lg-12">
							<div class="row clock-wrap">
								<div class="col clockinner1 clockinner">
									<h1 class="days">150</h1>
									<span class="smalltext">Days</span>
								</div>
								<div class="col clockinner clockinner1">
									<h1 class="hours">23</h1>
									<span class="smalltext">Hours</span>
								</div>
								<div class="col clockinner clockinner1">
									<h1 class="minutes">47</h1>
									<span class="smalltext">Mins</span>
								</div>
								<div class="col clockinner clockinner1">
									<h1 class="seconds">59</h1>
									<span class="smalltext">Secs</span>
								</div>
							</div>
						</div>
					</div>
					<a href="" class="primary-btn">Belanja Sekarang</a>
				</div>
				<div class="col-lg-6 no-padding exclusive-right">
					<div class="active-exclusive-product-slider">
						<?php foreach ($berita as $data) : ?>
							<div class="single-exclusive-slider">
								<?php if (!$data->gambar) : ?>
									<?php if ($data->nama_kb == "Pengumuman") : ?>
										<img src="<?= base_url() ?>assets/landingpage/img/berita4.png" alt="post" width="900px">
									<?php elseif ($data->nama_kb == "Katalog") : ?>
										<img src="<?= base_url() ?>assets/landingpage/img/berita3.png" alt="post" width="900px">
									<?php elseif ($data->nama_kb == "Diskon") : ?>
										<img src="<?= base_url() ?>assets/landingpage/img/berita2.png" alt="post" width="900px">
									<?php else : ?>
										<img src="<?= base_url() ?>assets/landingpage/img/berita1.png" alt="post" width="900px">
									<?php endif; ?>
								<?php else : ?>
									<img src="<?= base_url() ?>uploads/poster_berita/<?= $data->gambar ?>" alt="Poster Berita" width="600px">
								<?php endif; ?>
								<div class="product-details">
									<br>
									<div class="price">
										<button class="btn btn-dark">
											<?= $data->nama_kb ?>
										</button>
									</div>
									<br>
									<h4><?= $data->judul ?></h4>
									<div class="add-bag d-flex align-items-center justify-content-center">
										<a class="add-btn" href="<?= base_url() ?>LandingPage/postingan_berita/<?= $data->id_berita ?>" target="__blank"><span class="lnr lnr-eye"></span></a>
										<span class="add-text text-uppercase">Lihat selengkapnya</span>
									</div>
								</div>
							</div>
						<?php endforeach; ?>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- End exclusive deal Area -->

	<!-- Start brand Area -->
	<section class="brand-area section_gap">
		<div class="container">
			<div class="row">
				<a class="col single-img" href="assets/landingpage/#">
					<img class="img-fluid d-block mx-auto" src="<?= base_url() ?>assets/landingpage/img/dum-logo.png" alt="">
				</a>
				<a class="col single-img" href="assets/landingpage/#">
					<img class="img-fluid d-block mx-auto" src="<?= base_url() ?>assets/landingpage/img/dum-logo.png" alt="">
				</a>
				<a class="col single-img" href="assets/landingpage/#">
					<img class="img-fluid d-block mx-auto" src="<?= base_url() ?>assets/landingpage/img/dum-logo.png" alt="">
				</a>
				<a class="col single-img" href="assets/landingpage/#">
					<img class="img-fluid d-block mx-auto" src="<?= base_url() ?>assets/landingpage/img/dum-logo.png" alt="">
				</a>
				<a class="col single-img" href="assets/landingpage/#">
					<img class="img-fluid d-block mx-auto" src="<?= base_url() ?>assets/landingpage/img/dum-logo.png" alt="">
				</a>
			</div>
		</div>
	</section>
	<!-- End brand Area -->
	<!-- start footer Area -->
	<?php $this->load->view('landingpage/footer'); ?>
	<!-- End footer Area -->

	<?php $this->load->view('landingpage/script'); ?>

	<script src="<?= base_url() ?>assets/landingpage/js/countdown.js"></script>

	<?php if ($this->session->has_userdata('keranjang_alert')) : ?>
		<script src="<?= base_url('assets/dashboard/plugins/sweetalert2/sweetalert2.min.js') ?>"></script>
		<script>
			window.onload = () => {
				Swal.fire({
					icon: 'success',
					text: 'Berhasil dimasukan ke keranjang',
					confirmButtonColor: '#f25f27'
				});
			}
		</script>
	<?php endif; ?>
</body>

</html>