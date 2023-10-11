<!DOCTYPE html>
<html lang="id" class="no-js">

<head>
	<?php $this->load->view('landingpage/head') ?>
	<title>Etalase Produk | E-Katalog UNPAD</title>
	<?php if($this->session->has_userdata('keranjang_alert')): ?>
		<link rel="stylesheet" href="<?= base_url('assets/dashboard/plugins/sweetalert2/sweetalert2.min.css') ?>"></link>
	<?php endif; ?>
</head>

<body>

	<!-- Start Header Area -->
	<?php $this->load->view('landingpage/header'); ?>
	<!-- End Header Area -->

	<!-- Start Banner Area -->
	<section class="banner-area organic-breadcrumb">
		<div class="container">
			<div class="breadcrumb-banner d-flex flex-wrap align-items-center justify-content-end">
				<div class="col-first">
					<h1>Pencarian Produk</h1>
					<p><?= $this->input->get('search') ?></p>
				</div>
			</div>
		</div>
	</section>
	<!-- End Banner Area -->

	<div class="container pb-xl-5">
		<div class="row">
			<div class="col-xl-3 col-lg-4 col-md-5">
				<?php if (!empty($etalase)) : ?>
					<div class="sidebar-categories">
						<div class="head">Filter Etalase</div>
						<ul class="main-categories">
							<?php foreach ($etalase as $id => $data) : ?>
								<li class="main-nav-list">
									<!-- <a href="<?= base_url('lihat_etalase/' . $id) ?>"><?= $data->nama_etalase ?> <span class="number">(<?= $data->jumlah_produk ?>)</span> </a> -->
									<a href="#"><?= $data['nama_etalase'] ?> <span class="number">(<?= $data['jumlah_produk'] ?>)</span> </a>
								</li>
							<?php endforeach; ?>
						</ul>
					</div>
				<?php endif; ?>
				<div class="sidebar-filter mt-50">
					<div class="top-filter-head mb-4">Filter Produk</div>
					<form action="<?= base_url() ?>" method="get">
						<input type="hidden" name="search" value="<?= html_escape($this->input->get('search')); ?>">
						<div class="form-group">
							<label for="merek">Merek</label>
							<input type="text" name="merek" id="merek" class="form-control" value="<?= html_escape($this->input->get('merek')); ?>">
						</div>

						<div class="form-group">
							<label for="low">Harga Terandah</label>
							<input type="number" name="low" id="low" class="form-control" value="<?= html_escape($this->input->get('low')); ?>">
						</div>

						<div class="form-group">
							<label for="high">Harga Tertinggi</label>
							<input type="number" name="high" id="high" class="form-control" value="<?= html_escape($this->input->get('high')); ?>">
						</div>

						<button type="submit" class="mt-4 border-0 btn-block primary-btn rounded-0" style="line-height: 2rem;">Tampilkan</a>
					</form>
				</div>
			</div>
			<div class="col-xl-9 col-lg-8 col-md-7">
				<!-- Start Filter Bar -->
				<!-- <div class="filter-bar d-flex flex-wrap align-items-center">
					<div class="sorting">
						<select>
							<option value="1">Default sorting</option>
							<option value="1">Default sorting</option>
							<option value="1">Default sorting</option>
						</select>
					</div>
				</div> -->
				<!-- End Filter Bar -->
				<!-- Start Best Seller -->
				<section class="lattest-product-area pb-40 category-list">
					<div class="row">
						<!-- single product -->
						<?php if (empty($produk)) : ?>
							<div class="m-auto">
								<p class="h5">Produk tidak ditemukan</p>
							</div>
						<?php else : ?>
							<?php foreach ($produk as $data) : ?>
								<div class="col-lg-4 col-md-6">
									<div class="single-product">

										<?php $src = is_null($data->foto) ? base_url() . 'assets/landingpage/img/dummyproduct.png' : base_url() . 'uploads/foto_produk/' . $data->foto ?>
										<img class="img-fluid" src="<?= $src ?>" alt="Foto produk">

										<div class="product-details">
											<h6><?= character_limiter($data->nama_produk, 50); ?></h6>

											<div class="price">
												<h6 class="text-capitalize"><?= rupiah($data->harga) ?></h6>
											</div>
											<div class="prd-bottom">

											<?php if (!$this->session->id) : ?>
												<a href="login" class="social-info">
													<span class="lnr lnr-cart"></span>
													<p class="hover-text">Keranjang</p>
												</a>
												<a href="login" class="social-info">
													<span class="lnr lnr-heart"></span>
													<p class="hover-text">Favorit</p>
												</a>
											<?php else: ?>
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
												<a href="<?= base_url('LandingPage/lihat_produk/' . $data->id_produk) ?>" class="social-info">
													<span class="lnr lnr-eye"></span>
													<p class="hover-text">Lihat Detail</p>
												</a>
											</div>
										</div>
									</div>
								</div>
							<?php endforeach; ?>
						<?php endif; ?>
					</div>
				</section>
				<!-- End Best Seller -->
				<!-- Start Filter Bar -->
				<div class="filter-bar d-flex flex-wrap align-items-center justify-content-end">
					<?= $this->pagination->create_links(); ?>
				</div>
				<!-- End Filter Bar -->
			</div>
		</div>
	</div>

	<!-- start footer Area -->
	<?php $this->load->view('landingpage/footer') ?>
	<!-- End footer Area -->

	<?php $this->load->view('landingpage/script') ?>
	<?php if($this->session->has_userdata('keranjang_alert')): ?>
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