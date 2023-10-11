<!DOCTYPE html>
<html lang="id" class="no-js">

<head>
	<?php $this->load->view('landingpage/head') ?>
	<title>Produk | E-Katalog UNPAD</title>
	<?php if ($this->session->has_userdata('keranjang_alert')) : ?>
		<link rel="stylesheet" href="<?= base_url('assets/dashboard/plugins/sweetalert2/sweetalert2.min.css') ?>"></link>
	<?php endif; ?>
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
					<h1>Detail Produk</h1>
					<nav class="d-flex align-items-center">
						<a href="<?= base_url() ?>">Beranda<span class="lnr lnr-arrow-right"></span></a>
						<a href="#">Detail Produk</a>
					</nav>
				</div>
			</div>
		</div>
	</section>
	<!-- End Banner Area -->

	<!--================Single Product Area =================-->
	<div class="product_image_area">
		<div class="container">
			<div class="row s_product_inner">
				<div class="col-lg-6">
					<div class="">
						<div class="single-prd-item">
							<?php if (!$produk->foto) { ?>
								<img class="img-fluid" src="<?= base_url() ?>assets/landingpage/img/dummyproduct.png" alt="Foto Produk">
							<?php } else { ?>
								<img class="img-fluid" src="<?= base_url() ?>uploads/foto_produk/<?= $produk->foto ?>" alt="Foto Produk">
							<?php } ?>
						</div>
					</div>
				</div>
				<div class="col-lg-5 offset-lg-1">
					<div class="s_product_text">
						<h3><?= $produk->nama_produk ?></h3>
						<h2 class="text-capitalize"><?= rupiah($produk->harga); ?></h2>
						<ul class="list mb-lg-5">
							<li><a href="#"><span>Kategori</span> : <?= $produk->nama_ke ?></a></li>
							<li><a href="#"><span>Etalase</span> : <?= $produk->nama_etalase ?></a></li>
							<li><a href="#"><span>Ketersediaan</span> : <?= $produk->stok == 0 ? 'Tidak tersedia' : 'tersedia'; ?></a>
							</li>
						</ul>
						<?= form_open('PUMK/input_produk/' . $produk->id_produk); ?>
						<div class="product_count d-flex align-items-center">
							<label for="qty">Jumlah:</label>
							<input type="number" name="qty" class="form-control" value="1">
						</div>
						<div class="card_area d-flex align-items-center">
							<?php if (!$this->session->id) : ?>
								<a class="primary-btn" href="<?= base_url() ?>login">Masukan Keranjang</a>
								<a class="btn btn-secondary rounded" href="<?= base_url() ?>login"><i class="lnr lnr-heart"></i></a>
							<?php else : ?>
								<input type="submit" value="Masukan Keranjang" class="primary-btn border-0">
								<a class="btn btn-secondary rounded" href="<?= base_url() ?>PUMK/input_favorit/<?= $produk->id_produk ?>"><i class="lnr lnr-heart"></i></a>
							<?php endif; ?>
						</div>
						<?= form_close(); ?>
					</div>
				</div>
			</div>
		</div>
		<!--================End Single Product Area =================-->

		<!--================Product Description Area =================-->
		<section class="product_description_area">
			<div class="container">
				<ul class="nav nav-tabs" id="myTab" role="tablist">
					<li class="nav-item">
						<a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Deskripsi</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Spesifikasi</a>
					</li>
				</ul>
				<div class="tab-content" id="myTabContent">
					<div class="tab-pane fade  show active" id="home" role="tabpanel" aria-labelledby="home-tab">
						<p><?= $produk->deskripsi ?></p>
					</div>
					<div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
						<div class="table-responsive">
							<table class="table">
								<tbody>
									<tr>
										<td>
											<h5>Merek</h5>
										</td>
										<td>
											<h5><?= $produk->merek ?></h5>
										</td>
									</tr>
									<tr>
										<td>
											<h5>No Produk Penyedia</h5>
										</td>
										<td>
											<h5><?= $produk->no_produk_penyedia ?></h5>
										</td>
									</tr>
									<tr>
										<td>
											<h5>Masa Berlaku</h5>
										</td>
										<td>
											<h5><?= $produk->masa_berlaku ?></h5>
										</td>
									</tr>
									<tr>
										<td>
											<h5>Unit Pengukuran</h5>
										</td>
										<td>
											<h5><?= $produk->unit_pengukuran ?></h5>
										</td>
									</tr>
									<tr>
										<td>
											<h5>Stok</h5>
										</td>
										<td>
											<h5><?= $produk->stok ?></h5>
										</td>
									</tr>
									<tr>
										<td>
											<h5>Kode KBKI</h5>
										</td>
										<td>
											<a href="" class="btn btn-primary"><?= $produk->kode_kbki ?></a>
										</td>
									</tr>
									<tr>
										<td>
											<h5>Nilai TKDN</h5>
										</td>
										<td>
											<h5><?= $produk->nilai_tkdn ?></h5>
										</td>
									</tr>
									<?php foreach ($spesifikasi as $data) { ?>
										<tr>
											<td>
												<h5><?= $data->spesifikasi ?></h5>
											</td>
											<td>
												<h5><?= $data->nilai ?></h5>
											</td>
										</tr>
									<?php } ?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</section>
		<!--================End Product Description Area =================-->

		<!-- start footer Area -->
		<?php $this->load->view('landingpage/footer') ?>
		<!-- End footer Area -->

		<?php $this->load->view('landingpage/script') ?>

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