<!DOCTYPE html>
<html lang="id" class="no-js">

<?php $this->load->view('landingpage/head') ?>
<link rel="stylesheet" href="<?= base_url() ?>assets/dashboard/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="<?= base_url() ?>assets/dashboard/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">

<body>

	<!-- Start Header Area -->
	<?php $this->load->view('landingpage/header') ?>
	<!-- End Header Area -->

	<!-- Start Banner Area -->
	<section class="banner-area organic-breadcrumb">
		<div class="container">
			<div class="breadcrumb-banner d-flex flex-wrap align-items-center justify-content-end">
				<div class="col-first">
					<h1>Buat Paket</h1>
					<nav class="d-flex align-items-center">
						<a href="#">Buat Paket<span class="lnr lnr-arrow-right"></span></a>
						<a href="#">Data PBJ/Pemesan</a>
					</nav>
				</div>
			</div>
		</div>
	</section>
	<!-- End Banner Area -->

	<!--================Blog Area =================-->
	<section class="blog_area my-4">
		<div class="container">
			<div class="row">
				<div class="card_area d-flex align-items-center">
					<a href="" class="primary-btn" style="line-height:15px;padding:15px">1</a>
					<p style="margin-top:20px">&nbsp;&nbsp;&nbsp;Pilih Anggaran</p>
					<p style="margin-top:10px;color:orange">&nbsp;&nbsp;<b>_______</b></p>
					<a href="" class="primary-btn" style="line-height:15px;padding:15px">2</a>
					<p style="margin-top:20px">&nbsp;&nbsp;&nbsp;Informasi Pemesanan</b>
					<p style="margin-top:10px;color:orange">&nbsp;&nbsp;<b>_______</b></p>
					<a href="" class="primary-btn" style="line-height:15px;padding:15px">3</a>
					<p style="margin-top:20px">&nbsp;&nbsp;&nbsp;Data PBJ/Pemesan</p>
					<p style="margin-top:10px;color:orange">&nbsp;&nbsp;<b>_______</b></p>
					<a href="" class="primary-btn" style="line-height:15px;padding:15px">4</a>
					<b>&nbsp;&nbsp;&nbsp;Pilih PPK/Pembeli</b>
					<p style="margin-top:10px;color:orange">&nbsp;&nbsp;<b>_______</b></p>
					<a href="" class="primary-btn" style="line-height:15px;padding:15px">5</a>
					<p style="margin-top:20px">&nbsp;&nbsp;&nbsp;Daftar Produk</p>
				</div>
				<div class="col-lg-12">
					<div class="blog_left_sidebar">
						<div class="row">
							<div class="col-lg-12">
								<br>
								<h3>Informasi PPK</h3>
								<br>
								<div class="row">
									<div class="col-12">
										<h5>Cari PPK</h5>
										<?= form_open('PBJ/update_ppk', array('id' => 'pilih-ppk')); ?>
										<?= form_close(); ?>

										<table id="example1" class="table table-bordered table-striped">
											<thead>
												<th>Nama</th>
												<th>NIP</th>
												<th>Jabatan</th>
												<th>Email</th>
												<th>Aksi</th>
											</thead>
											<?php if (!empty($daftar_ppk)) : ?>
												<tbody>
													<?php foreach ($daftar_ppk as $ppk) : ?>
														<tr>
															<td><?= $ppk->nama ?></td>
															<td><?= $ppk->nip ?></td>
															<td><?= $ppk->jabatan ?></td>
															<td><?= $ppk->email ?></td>
															<td>
																<button type="submit" class="btn btn-primary" name="ppk" value="<?= $ppk->id_ppk ?>" form="pilih-ppk">Pilih</button>
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
			});
		});
	</script>
</body>

</html>