<!DOCTYPE html>
<html lang="id" class="no-js">

<head>
	<?php $this->load->view('landingpage/head') ?>
	<title>Bandingkan | E-Katalog UNPAD</title>
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
					<h1>Bandingkan Produk</h1>
					<nav class="d-flex align-items-center">
						<a href="<?= base_url() ?>">Beranda<span class="lnr lnr-arrow-right"></span></a>
						<a href="<?= base_url('produk') ?>">Produk<span class="lnr lnr-arrow-right"></span></a>
						<a href="#">Bandingkan Produk</a>
					</nav>
				</div>
			</div>
		</div>
	</section>
	<!-- End Banner Area -->

	<!--================Single Product Area =================-->
	<div class="product_image_area">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<table width="100%">
						<thead>
							<th>
								<h3>Data Produk di E-Katalog UNPAD</h3>
							</th>
							<th>
								<h3>Data Produk Sejenis di E-Katalog UNPAD</h3>
							</th>
						</thead>
					</table>
					<br>
				</div>
				<div class="col-lg-2">
					<div class="">
						<div class="single-prd-item">
							<?php if (!$produk->foto) { ?>
								<img src="<?= base_url() ?>assets/landingpage/img/dummyproduct.png" alt="" width="200px">
							<?php } else { ?>
								<img src="<?= base_url() ?>uploads/foto_produk/<?= $produk->foto ?>" alt="" width="200px">
							<?php } ?>
						</div>
					</div>
				</div>
				<div class="col-lg-3 offset-lg-1">
					<div class="s_product_text" style="margin-top:10px">
						<h3>
							<?= $produk->nama_produk ?>
						</h3>
						<h2>Rp
							<?php echo number_format($produk->harga, 2, ".", ","); ?>
						</h2>
						<ul class="list">
							<li><a class="active" href=""><span>Kategori</span> :
									<?= $produk->nama_ke ?>
								</a></li>
							<li><a href="#"><span>Etalase</span> :
									<?= $produk->nama_etalase ?>
								</a></li>
							<li><a href="#"><span>Ketersediaan</span> :
									<?php if ($produk->stok == 0) {
										echo "Tidak tersedia";
									} else {
										echo "Tersedia";
									}
									?>
								</a></li>
						</ul>
						<p></p>
					</div>
				</div>
				<div class="col-lg-2">
					<div class="">
						<div class="single-prd-item">
							<?php if (!$compare->foto) { ?>
								<img src="<?= base_url() ?>assets/landingpage/img/dummyproduct.png" alt="" width="200px">
							<?php } else { ?>
								<img src="<?= base_url() ?>uploads/foto_produk/<?= $compare->foto ?>" alt="" width="200px">
							<?php } ?>
						</div>
					</div>
				</div>
				<div class="col-lg-3 offset-lg-1">
					<div class="s_product_text" style="margin-top:10px">
						<h3>
							<?= $compare->nama_produk ?>
						</h3>
						<h2>Rp
							<?php echo number_format($compare->harga, 2, ".", ","); ?>
						</h2>
						<ul class="list">
							<li><a class="active" href=""><span>Kategori</span> :
									<?= $compare->nama_ke ?>
								</a></li>
							<li><a href="#"><span>Etalase</span> :
									<?= $compare->nama_etalase ?>
								</a></li>
							<li><a href="#"><span>Ketersediaan</span> :
									<?php if ($compare->stok == 0) {
										echo "Tidak tersedia";
									} else {
										echo "Tersedia";
									}
									?>
								</a></li>
						</ul>
						<p></p>
					</div>
				</div>
			</div>

			<div class="row">
				<div class="col-md-6">
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
									<p>
										<?= $compare->deskripsi ?>
									</p>
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
														<h5>
															<?= $compare->merek ?>
														</h5>
													</td>
												</tr>
												<tr>
													<td>
														<h5>No Produk Penyedia</h5>
													</td>
													<td>
														<h5>
															<?= $compare->no_produk_penyedia ?>
														</h5>
													</td>
												</tr>
												<tr>
													<td>
														<h5>Masa Berlaku</h5>
													</td>
													<td>
														<h5>
															<?= $compare->masa_berlaku ?>
														</h5>
													</td>
												</tr>
												<tr>
													<td>
														<h5>Unit Pengukuran</h5>
													</td>
													<td>
														<h5>
															<?= $compare->unit_pengukuran ?>
														</h5>
													</td>
												</tr>
												<tr>
													<td>
														<h5>Stok</h5>
													</td>
													<td>
														<h5>
															<?= $compare->stok ?>
														</h5>
													</td>
												</tr>
												<tr>
													<td>
														<h5>Kode KBKI</h5>
													</td>
													<td>
														<a href="" class="btn btn-primary">
															<?= $compare->kode_kbki ?>
														</a>
													</td>
												</tr>
												<tr>
													<td>
														<h5>Nilai TKDN</h5>
													</td>
													<td>
														<h5>
															<?= $compare->nilai_tkdn ?>
														</h5>
													</td>
												</tr>
												<?php foreach ($spesifikasi2 as $data) { ?>
													<tr>
														<td>
															<h5>
																<?= $data->spesifikasi ?>
															</h5>
														</td>
														<td>
															<h5>
																<?= $data->nilai ?>
															</h5>
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
				</div>
				<div class="col-md-6">
					<section class="product_description_area">
						<div class="container">
							<ul class="nav nav-tabs" id="myTab2" role="tablist">
								<li class="nav-item">
									<a class="nav-link active" id="home-tab" data-toggle="tab" href="#home2" role="tab" aria-controls="home" aria-selected="true">Deskripsi</a>
								</li>
								<li class="nav-item">
									<a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile2" role="tab" aria-controls="profile" aria-selected="false">Spesifikasi</a>
								</li>
							</ul>
							<div class="tab-content" id="myTabContent2">
								<div class="tab-pane fade  show active" id="home2" role="tabpanel" aria-labelledby="home-tab">
									<p>
										<?= $produk->deskripsi ?>
									</p>
								</div>
								<div class="tab-pane fade" id="profile2" role="tabpanel" aria-labelledby="profile-tab">
									<div class="table-responsive">
										<table class="table">
											<tbody>
												<tr>
													<td>
														<h5>Merek</h5>
													</td>
													<td>
														<h5>
															<?= $produk->merek ?>
														</h5>
													</td>
												</tr>
												<tr>
													<td>
														<h5>No Produk Penyedia</h5>
													</td>
													<td>
														<h5>
															<?= $produk->no_produk_penyedia ?>
														</h5>
													</td>
												</tr>
												<tr>
													<td>
														<h5>Masa Berlaku</h5>
													</td>
													<td>
														<h5>
															<?= $produk->masa_berlaku ?>
														</h5>
													</td>
												</tr>
												<tr>
													<td>
														<h5>Unit Pengukuran</h5>
													</td>
													<td>
														<h5>
															<?= $produk->unit_pengukuran ?>
														</h5>
													</td>
												</tr>
												<tr>
													<td>
														<h5>Stok</h5>
													</td>
													<td>
														<h5>
															<?= $produk->stok ?>
														</h5>
													</td>
												</tr>
												<tr>
													<td>
														<h5>Kode KBKI</h5>
													</td>
													<td>
														<a href="" class="btn btn-primary">
															<?= $produk->kode_kbki ?>
														</a>
													</td>
												</tr>
												<tr>
													<td>
														<h5>Nilai TKDN</h5>
													</td>
													<td>
														<h5>
															<?= $produk->nilai_tkdn ?>
														</h5>
													</td>
												</tr>
												<?php foreach ($spesifikasi as $data) { ?>
													<tr>
														<td>
															<h5>
																<?= $data->spesifikasi ?>
															</h5>
														</td>
														<td>
															<h5>
																<?= $data->nilai ?>
															</h5>
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
				</div>
			</div>
		</div>
	</div>

	<!-- start footer Area -->
	<?php $this->load->view('landingpage/footer') ?>
	<!-- End footer Area -->

	<?php $this->load->view('landingpage/script') ?>
	<script src="assets/landingpage/jquery.js"></script>

</body>

</html>