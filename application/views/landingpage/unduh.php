<!DOCTYPE html>
<html lang="id" class="no-js">

<head>
	<?php $this->load->view('landingpage/head') ?>
	<title>Unduhan | E-Katalog UNPAD</title>
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
					<h1>Unduh</h1>
					<nav class="d-flex align-items-center">
						<a href="<?= base_url() ?>">Beranda<span class="lnr lnr-arrow-right"></span></a>
						<a href="#">Unduh</a>
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
							<form action="<?= base_url('unduh') ?>" method="get" id="filter-unduhan">
								<div class="input-group">
									<input type="text" name="search" class="form-control" placeholder="Cari Unduhan..." onfocus="this.placeholder = ''" onblur="this.placeholder = 'Cari Unduhan...'">
									<span class="input-group-btn">
										<button class="btn btn-default" type="submit"><i class="lnr lnr-magnifier"></i></button>
									</span>
								</div>
							</form>
						</aside>
						<aside class="single_sidebar_widget post_category_widget">
							<h4 class="widget_title">Kategori Topik</h4>
							<ul class="list cat-list">
								<?php foreach ($kategori as $data) { ?>
									<li>
										<div class="d-flex justify-content-between filter-kategori" data-kategori="<?= $data->id_ku ?>" style="cursor: pointer;">
											<p><?= $data->nama_ku ?></p>
											<p><?= $data->jumlah ?></p>
										</div>
									</li>
								<?php } ?>
							</ul>
						</aside>
					</div>
					<br><br>
				</div>
				<div class="col-lg-9">
					<div class="blog_left_sidebar">
						<article class="row blog_item">
							<?php if (empty($unduh)) : ?>
								<div class="m-auto">
									<p class="h5">Unduhan tidak ditemukan</p>
								</div>
							<?php else : ?>
								<?php foreach ($unduh as $data) : ?>
									<div class="col-md-3" style="box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);margin:20px">
										<div class="blog_info">
											<button class="btn btn-danger mb-4"><?= $data->nama_ku ?></button>
											<h3><?= $data->nama_unduhan ?></h3>
											<br>
											<p style="text-align:center">Diunggah pada <?= tanggal($data->tanggal); ?></p>
											<br>
											<center>
												<a href="<?= base_url() ?>uploads/file_unduhan/<?= $data->file ?>" download="Dokumen Unduhan">
													<i class="fa fa-download" aria-hidden="true"></i>
													Unduh
												</a>
											</center>
											<br>
										</div>
									</div>
								<?php endforeach; ?>
							<?php endif; ?>
						</article>

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
			$('<input>', {type: 'hidden', name:'kategori', 'value': id}).appendTo('#filter-unduhan');

			$('#filter-unduhan').submit();
		});
	</script>
</body>

</html>