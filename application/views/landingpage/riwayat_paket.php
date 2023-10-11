<!DOCTYPE html>
<html lang="id" class="no-js">

<head>
	<?php $this->load->view('landingpage/head') ?>
	<title>Riwayat Paket | E-Katalog UNPAD</title>
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
					<h1>Riwayat Paket</h1>
					<nav class="d-flex align-items-center">
						<a href="<?= base_url('PUMK/detail_paket/'.$id_paket) ?>">Detail Ajuan<span class="lnr lnr-arrow-right"></span></a>
						<a href="#">Riwayat Paket</a>
					</nav>
				</div>
			</div>
		</div>
	</section>
	<!-- End Banner Area -->

	<!--================Blog Area =================-->
	<section class="blog_area mt-4 mb-lg-5">
		<div class="container">
			<div class="row">
				<div class="col-12">
	
					<a href="<?= base_url('PUMK/detail_paket/'.$id_paket) ?>" class="btn btn-secondary">
						<i class="fa fa-arrow-circle-left" aria-hidden="true"></i>
						Kembali
					</a>
					<h2 class="mt-4">Riwayat Paket</h2>

					<table class="table mt-4 w-100">
						<thead>
							<th>No</th>
							<th>Tanggal</th>
							<th>Aksi</th>
							<th>Rincian</th>
						</thead>
						<?php if(! empty($riwayat)): ?>
							<tbody>
								<?php $no = 1; ?>
								<?php foreach ($riwayat as $data): ?>
									<tr>
										<td><?= $no++.'.' ?></td>
										<td><?= tanggal($data->tanggal) ?></td>
										<td><?= str_replace('_', ' ', trim($data->aksi, ', ')); ?></td>
										<td>
											<?php if (!is_null($data->nama_pp)) : ?>
												<span class="d-block">PP: <?= $data->nama_pp ?></span>
											<?php endif; ?>

											<?php if (!is_null($data->no_pr)) : ?>
												<span class="d-block">Nomor PR: <?= $data->no_pr ?></span>
											<?php endif; ?>

											<?php if (!is_null($data->status)) : ?>
												<span class="d-block">Status: <?= status_paket($data->status) ?></span>
											<?php endif; ?>
										</td>
									</tr>
								<?php endforeach; ?>
							</tbody>
						<?php endif; ?>
					</table>
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