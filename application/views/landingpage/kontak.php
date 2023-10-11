<!DOCTYPE html>
<html lang="id" class="no-js">

<head>
	<?php $this->load->view('landingpage/head') ?>
	<title>Kontak | E-Katalog UNPAD</title>
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
					<h1>Kontak Kami</h1>
					<nav class="d-flex align-items-center">
						<a href="<?= base_url() ?>">Beranda<span class="lnr lnr-arrow-right"></span></a>
						<a href="#">Kontak</a>
					</nav>
				</div>
			</div>
		</div>
	</section>
	<!-- End Banner Area -->

	<!--================Contact Area =================-->
	<section class="contact_area section_gap_bottom">
		<div class="container pt-5">
			<div class="row">
				<div class="col-lg-6">
					<address class="contact_info">
						<div class="info_item">
							<i class="lnr lnr-map-marker"></i>
							<span class="font-weight-bold h5"><?= $kontak['nama_kontak']; ?></span>
							<p><?= $kontak['alamat']; ?></p>
						</div>
						<div class="info_item">
							<i class="lnr lnr-phone-handset"></i>
							<span class="font-weight-bold h5">Telepon</span>
							<p class="m-0">
								<a href="tel:<?= $kontak['telepon_1'] ?>"><?= $kontak['telepon_1'] ?></a>
								<?php if (!empty($kontak['telepon_2'])) : ?>
									/
									<a href="tel:<?= $kontak['telepon_2'] ?>"><?= $kontak['telepon_2'] ?></a>
								<?php endif; ?>
							</p>
							<?php if (!empty($kontak['jam_telepon'])) : ?>
								<p><?= $kontak['jam_telepon'] ?></p>
							<?php endif; ?>
						</div>
						<div class="info_item">
							<i class="lnr lnr-envelope"></i>
							<span class="font-weight-bold h5">Email</span>
							<p><a href="mailto:<?= $kontak['email'] ?>"><?= $kontak['email'] ?></a></p>
						</div>

						<?php if (!empty($kontak['website'])) : ?>
							<div class="info_item">
								<i class="lnr lnr-earth"></i>
								<span class="font-weight-bold h5">Website</span>
								<p><a href="<?= $kontak['website'] ?>"><?= $kontak['website'] ?></a></p>
							</div>
						<?php endif; ?>

						<div class="mt-5">
							<?php $kontak_tambahan = array_slice($kontak, 8); ?>
							<?php foreach ($kontak_tambahan as $key => $value) : ?>
								<?php if (!empty($value)) : ?>
									<p class="mb-1"><?= ucwords(str_replace('_', ' ', $key)) . ': ' . $value ?></p>
								<?php endif; ?>
							<?php endforeach; ?>
						</div>
					</address>
				</div>
				<div class="col-lg-6">
					<iframe class="w-100 h-100" src="<?= htmlentities($kontak['googlemap_src']) ?>" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
				</div>
			</div>
		</div>
	</section>
	<!--================Contact Area =================-->

	<?php $this->load->view('landingpage/script') ?>
</body>

</html>