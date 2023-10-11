<!DOCTYPE html>
<html lang="id" class="no-js">

<head>
	<?php $this->load->view('landingpage/head') ?>
	<title>Postingan Berita | E-Katalog UNPAD</title>
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
					<h1>Berita</h1>
					<nav class="d-flex align-items-center">
						<a href="<?= base_url(); ?>">Beranda<span class="lnr lnr-arrow-right"></span></a>
						<a href="<?= base_url('berita'); ?>">Berita</a>
					</nav>
				</div>
			</div>
		</div>
	</section>
	<!-- End Banner Area -->

	<!--================Blog Area =================-->
	<section class="blog_area single-post-area section_gap">
		<div class="container">
			<a href="<?= base_url() ?>LandingPage/berita" class="primary-btn">
				<i class="fa fa-arrow-left" aria-hidden="true"></i>
				Kembali</a>
			<br><br>
			<div class="row">
				<div class="col-lg-8 posts-list">
					<div class="single-post row">
						<div class="col-lg-12">
							<div class="feature-img">
								<?php if (!$berita->gambar) { ?>
									<?php if ($berita->nama_kb == "Pengumuman") { ?>
										<img src="<?= base_url() ?>assets/landingpage/img/berita4.png" alt="post" width="720px">
									<?php } else if ($berita->nama_kb == "Katalog") { ?>
										<img src="<?= base_url() ?>assets/landingpage/img/berita3.png" alt="post" width="720px">
									<?php } else if ($berita->nama_kb == "Diskon") { ?>
										<img src="<?= base_url() ?>assets/landingpage/img/berita2.png" alt="post" width="720px">
									<?php } else { ?>
										<img src="<?= base_url() ?>assets/landingpage/img/berita1.png" alt="post" width="720px">
									<?php } ?>
								<?php } else { ?>
									<img src="<?= base_url() ?>uploads/poster_berita/<?= $berita->gambar ?>" alt="Poster Berita" width="600px">
								<?php } ?>
							</div>
						</div>
						<div class="col-lg-3  col-md-3">
							<div class="blog_info text-right">
								<div class="post_tag">
									<?php foreach ($tag as $data) { ?>
										<a href="#"><?= $data->tag ?>,</a>
									<?php } ?>
								</div>
								<ul class="blog_meta list">
									<li><a href="#"><?= $berita->penulis ?><i class="lnr lnr-user"></i></a></li>
									<li><a href="#"><?= $berita->tanggal ?><i class="lnr lnr-calendar-full"></i></a></li>
								</ul>
								<!-- <ul class="social-links">
                                    <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                    <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                    <li><a href="#"><i class="fa fa-github"></i></a></li>
                                    <li><a href="#"><i class="fa fa-behance"></i></a></li>
                                </ul> -->
							</div>
						</div>
						<div class="col-lg-9 col-md-9 blog_details">
							<h2><?= $berita->judul ?></h2>
							<p class="excert" style="text-align:justify">
								<?= $berita->body ?>
							</p>
						</div>

					</div>
				</div>
				<div class="col-lg-4">
					<div class="blog_right_sidebar">
						<aside class="single_sidebar_widget author_widget">
							<img class="author_img rounded-circle" src="<?= base_url() ?>assets/landingpage/img/dummyprofile.png" alt="" width="100px">
							<h4><?= $berita->penulis ?></h4>
							<p>Penulis</p>
							<br>
						</aside>
						<aside class="single-sidebar-widget tag_cloud_widget">
							<h4 class="widget_title">Tag Berita</h4>
							<ul class="list">
								<?php foreach ($tag as $data) { ?>
									<li><a href="#"><?= $data->tag ?></a></li>
								<?php } ?>
							</ul>
						</aside>
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