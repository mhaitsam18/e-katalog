<!DOCTYPE html>
<html lang="id" class="no-js">

<head>
	<?php $this->load->view('landingpage/head') ?>
	<title>Berita | E-Katalog UNPAD</title>
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
						<a href="#">Berita</a>
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
						<aside class="mb-4 single_sidebar_widget search_widget">
							<form action="<?= base_url('berita') ?>" method="get" id="filter-berita">
								<div class="input-group">
									<input type="text" name="search" class="form-control" placeholder="Cari Berita..." value="<?= html_escape($this->input->get('search')); ?>" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Cari Berita...'">
									<!-- <input type="hidden" name="coba" value="bebas" class="d-none"> -->
									<span class="input-group-btn">
										<button class="btn btn-default" type="submit"><i class="lnr lnr-magnifier"></i></button>
									</span>
								</div>
							</form>
						</aside>
						<aside class="single_sidebar_widget popular_post_widget">
							<h3 class="widget_title">Berita Terbaru</h3>
							<?php foreach ($news as $data) { ?>
								<div class="media post_item">
									<?php if ($data->nama_kb == "Pengumuman") { ?>
										<img src="<?= base_url() ?>assets/landingpage/img/berita4.png" alt="post" width="100px">
									<?php } else if ($data->nama_kb == "Katalog") { ?>
										<img src="<?= base_url() ?>assets/landingpage/img/berita3.png" alt="post" width="100px">
									<?php } else if ($data->nama_kb == "Diskon") { ?>
										<img src="<?= base_url() ?>assets/landingpage/img/berita2.png" alt="post" width="100px">
									<?php } else { ?>
										<img src="<?= base_url() ?>assets/landingpage/img/berita1.png" alt="post" width="100px">
									<?php } ?>
									<div class="media-body">
										<a href="blog-details.html">
											<h3><?= $data->judul ?></h3>
										</a>
										<p><?= $data->tanggal ?></p>
									</div>
								</div>
								<div class="br"></div>
							<?php } ?>
						</aside>
						<aside class="single_sidebar_widget post_category_widget">
							<h4 class="widget_title">Kategori Berita</h4>
							<ul class="list cat-list">
								<?php foreach ($kategori as $data) { ?>
									<li>
										<div class="d-flex justify-content-between filter-kategori" data-kategori="<?= $data->id_kb ?>" style="cursor: pointer;">
											<p><?= $data->nama_kb ?></p>
											<p><?= $data->jumlah ?></p>
										</div>
									</li>
								<?php } ?>
							</ul>
						</aside>
					</div>
					<br><br>
				</div>
				<div class="col-lg-8">
					<div class="blog_left_sidebar">
						<?php if (empty($berita)) : ?>
							<div class="m-auto">
								<p class="h5">Berita tidak ditemukan</p>
							</div>
						<?php else : ?>
							<?php foreach ($berita as $data) : ?>
								<article class="row blog_item">
									<div class="col-md-3">
										<div class="blog_info text-right">
											<div class="post_tag">
												<a href="#"><?= $data->nama_kb ?></a>
											</div>
											<ul class="blog_meta list">
												<li><a href="#"><?= $data->penulis ?><i class="lnr lnr-user"></i></a></li>
												<li><a href="#"><?= $data->tanggal ?><i class="lnr lnr-calendar-full"></i></a></li>
											</ul>
										</div>
									</div>
									<div class="col-md-9">
										<div class="blog_post">
											<?php if (!$data->gambar) { ?>
												<?php if ($data->nama_kb == "Pengumuman") { ?>
													<img src="<?= base_url() ?>assets/landingpage/img/berita4.png" alt="post" width="600px">
												<?php } else if ($data->nama_kb == "Katalog") { ?>
													<img src="<?= base_url() ?>assets/landingpage/img/berita3.png" alt="post" width="600px">
												<?php } else if ($data->nama_kb == "Diskon") { ?>
													<img src="<?= base_url() ?>assets/landingpage/img/berita2.png" alt="post" width="600px">
												<?php } else { ?>
													<img src="<?= base_url() ?>assets/landingpage/img/berita1.png" alt="post" width="600px">
												<?php } ?>
											<?php } else { ?>
												<img src="<?= base_url() ?>uploads/poster_berita/<?= $data->gambar ?>" alt="Poster Berita" width="600px">
											<?php } ?>
											<div class="blog_details">
												<a href="<?= base_url() ?>LandingPage/postingan_berita/<?= $data->id_berita ?>">
													<h2><?= $data->judul ?></h2>
												</a>
												<p><?= character_limiter($data->body, 250); ?></p>
												<a href="<?= base_url() ?>LandingPage/postingan_berita/<?= $data->id_berita ?>" class="white_bg_btn">Lihat Selengkapnya</a>
											</div>
										</div>
									</div>
								</article>
							<?php endforeach; ?>
						<?php endif; ?>
						<nav class="blog-pagination justify-content-center d-flex">
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
	<script>
		$('.filter-kategori').click(function() {
			let id = $(event.currentTarget).data('kategori');
			$('<input>', {type: 'hidden', name:'kategori', 'value': id}).appendTo('#filter-berita');

			$('#filter-berita').submit();
		});
	</script>
</body>

</html>