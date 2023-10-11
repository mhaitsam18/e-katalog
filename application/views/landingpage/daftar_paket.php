<!DOCTYPE html>
<html lang="id" class="no-js">

<head>
	<?php $this->load->view('landingpage/head') ?>

	<title>Daftar Paket | E-Katalog UNPAD</title>

	<link rel="stylesheet" href="<?= base_url() ?>assets/dashboard/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
	<link rel="stylesheet" href="<?= base_url() ?>assets/dashboard/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
	<link rel="stylesheet" href="<?= base_url() ?>assets/dashboard/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
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
					<h1>Daftar Paket</h1>
					<nav class="d-flex align-items-center">
						<a href="<?= base_url('PUMK') ?>">PUMK<span class="lnr lnr-arrow-right"></span></a>
						<a href="#">Daftar Paket</a>
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
				<div class="col-lg-12">
					<h4>Daftar Paket</h4>
				</div>
				<div class="col-lg-12">
					<div class="blog_left_sidebar">
						<div class="row">
							<div class="col-lg-12" style="margin-bottom:20px">
								<table id="example1" class="table table-bordered table-striped">
									<thead>
										<th>No</th>
										<th>Paket</th>
										<th>Vendor</th>
										<th>Posisi</th>
										<th>Status</th>
										<th>Aksi</th>
									</thead>
									<?php if(! empty($paket)): ?>
									<tbody>
										<?php $no = 1; ?>
										<?php foreach ($paket as $data): ?>
											<tr>
												<td><?= $no++.'.' ?></td>
												<td>
													<span><?= $data->nama_paket ?? '-' ?></span>
												</td>
												<td>
													<span><?= $data->nama_perusahaan ?></span>
												</td>
												<td>
													<span>
														<?php if ($data->status == 0) { ?>
															PUMK
														<?php } elseif ($data->status == 1) { ?>
															PUMK
														<?php } elseif ($data->status == 2) { ?>
															Penyedia
														<?php } elseif ($data->status == 3) { ?>
															PUMK
														<?php } elseif ($data->status == 4) { ?>
															PUMK
														<?php } elseif ($data->status == 5) { ?>
															Penyedia
														<?php } elseif ($data->status == 6) { ?>
															Penyedia
														<?php } elseif ($data->status == 7) { ?>
															PUMK
														<?php } elseif ($data->status == 8) { ?>
															-
														<?php } else {
															echo "-";
														} ?>
													</span>
												</td>
												<td>
													<?= status_paket(($data->status)) ?>
												</td>
												<td>
													<a href="<?= base_url() ?>PUMK/detail_paket/<?= $data->id_paket ?>" class="btn btn-primary btn-sm">
														Lihat Detail
													</a>
												</td>
											</tr>
										<?php endforeach; ?>
									</tbody>
									<?php endif; ?>
								</table>
							</div>
						</div>
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
	<script src="<?= base_url() ?>assets/dashboard/plugins/datatables/jquery.dataTables.min.js"></script>
	<script src="<?= base_url() ?>assets/dashboard/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
	<script src="<?= base_url() ?>assets/dashboard/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
	<script>
		$(function() {
			$("#example1").DataTable({
				"responsive": true,
				"lengthChange": false,
				"autoWidth": false,
				"columnDefs": [
					{"orderable": false, targets: 4}
				]
			})
		});
	</script>
</body>

</html>