<!DOCTYPE html>
<html lang="id" class="no-js">
<head>
	<?php $this->load->view('landingpage/head') ?>
	<title>Pengumuman | E-Katalog UNPAD</title>
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
						<a href="">Pengumuman</a>
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
				<div class="col-lg-3">
					<div class="blog_right_sidebar">
						<aside class="single_sidebar_widget search_widget">
							<form action="<?= base_url('pengumuman') ?>" method="get">
								<div class="input-group mb-4">
									<input type="text" name="search" class="form-control" placeholder="Cari pengumuman...">
									<span class="input-group-btn">
										<button class="btn btn-default " type="button"><i class="lnr lnr-magnifier"></i></button>
									</span>
								</div><!-- /input-group -->

								<div class="form-group">
									<label for="start">Tanggal Mulai</label>
									<input type="date" name="start" id="start" class="form-control">
								</div>

								<div class="form-group">
									<label for="finish">Tanggal Akhir</label>
									<input type="date" name="finish" id="finish" class="form-control">
								</div>

								<button type="submit" class="mt-4 border-0 btn-block primary-btn rounded-0" style="line-height: 2rem;">Tampilkan</a>
							</form>
						</aside>
					</div>
					<br><br><br><br>
				</div>
				<div class="col-lg-9">
					<div class="blog_left_sidebar">
						<div class="row" id="dataTables">
							<?php if (empty($pengumuman)) : ?>
								<div class="m-auto">
									<p class="h5">Pengumuman tidak ditemukan</p>
								</div>
							<?php else : ?>
								<?php foreach ($pengumuman as $data) : ?>
									<div class="col-lg-4" style="margin-bottom:20px">
										<div class="categories_post">
											<a href="<?= base_url() ?>LandingPage/postingan_pengumuman/<?= $data->id_pengumuman ?>">
												<img src="<?= base_url() ?>assets/landingpage/img/berita4.png" alt="post">
												<div class="categories_details">
													<div class="categories_text">
														<!-- <a href="post_pengumuman.php">
																							<h5>NASIONAL</h5>
																					</a> -->
														<!-- <div class="border_line"></div> -->
														<p><?= $data->judul ?></p>
													</div>
												</div>
											</a>
										</div>
									</div>
								<?php endforeach; ?>
							<?php endif; ?>
						</div>
						<nav class="mt-4 blog-pagination justify-content-center d-flex">
							<?= $this->pagination->create_links(); ?>
						</nav>
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