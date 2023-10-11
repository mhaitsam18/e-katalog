<!DOCTYPE html>
<html lang="id" class="no-js">

<?php $this->load->view('landingpage/head') ?>

<link rel="stylesheet" href="<?= base_url() ?>assets/dashboard/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="<?= base_url() ?>assets/dashboard/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
<!-- <link rel="stylesheet" href="<?= base_url() ?>assets/dashboard/plugins/datatables-buttons/css/buttons.bootstrap4.min.css"> -->

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
						<a href="index.html">Buat Paket<span class="lnr lnr-arrow-right"></span></a>
						<a href="category.html">Pilih Anggaran</a>
					</nav>
				</div>
			</div>
		</div>
	</section>
	<!-- End Banner Area -->

	<!--================Blog Area =================-->
	<section class="blog_area my-4">
		<div class="container">

			<?php $this->alert->tampilkan(); ?>

			<div class="row">
				<div class="col-lg-12">
					<h6>Buat Paket</h6>
					<div class="card_area d-flex align-items-center">
						<a href="" class="primary-btn" style="line-height:15px;padding:15px">1</a>
						<b>&nbsp;&nbsp;&nbsp;Pilih Anggaran</b>
						<p style="margin-top:10px;color:orange">&nbsp;&nbsp;<b>_______</b></p>
						<a href="" class="primary-btn" style="line-height:15px;padding:15px">2</a>
						<p style="margin-top:20px">&nbsp;&nbsp;&nbsp;Informasi Pemesanan</p>
						<p style="margin-top:10px;color:orange">&nbsp;&nbsp;<b>_______</b></p>
						<a href="" class="primary-btn" style="line-height:15px;padding:15px">3</a>
						<p style="margin-top:20px">&nbsp;&nbsp;&nbsp;Data PP/Pemesan</p>
						<p style="margin-top:10px;color:orange">&nbsp;&nbsp;<b>_______</b></p>
						<a href="" class="primary-btn" style="line-height:15px;padding:15px">4</a>
						<p style="margin-top:20px">&nbsp;&nbsp;&nbsp;Pilih PPK/Pembeli</p>
						<p style="margin-top:10px;color:orange">&nbsp;&nbsp;<b>_______</b></p>
						<a href="" class="primary-btn" style="line-height:15px;padding:15px">5</a>
						<p style="margin-top:20px">&nbsp;&nbsp;&nbsp;Daftar Produk</p>
					</div>
				</div>
				<div class="col-lg-12">
					<div class="blog_left_sidebar">
						<div class="row">
							<div class="col-lg-12" style="margin-bottom:20px">
								<?= form_open('PBJ/check_anggaran/', array('id' => 'check-anggaran')); ?>
								<?= form_close(); ?>

								<table id="example1" class="table table-bordered table-striped">
									<thead>
										<th>Nomor</th>
										<th>Anggaran</th>
										<th>Tahun Anggaran</th>
										<th>Jenis Anggaran</th>
										<th>Instansi</th>
										<th>Satuan Kerja</th>
										<th>Pagu Anggaran</th>
										<th>Aksi</th>
									</thead>
									<tbody>
										<?php foreach ($anggaran as $data) : ?>
											<tr>
												<td><?= $data->id_anggaran ?></td>
												<td><?= $data->nama_pr ?></td>
												<td><?= tanggal($data->tahun) ?></td>
												<td><?= $data->jenis_instansi ?></td>
												<td><?= $data->instansi ?></td>
												<td><?= $data->satuan_kerja ?></td>
												<td><?= rupiah($data->nominal); ?></td>
												<td>
													<button type="submit" class="btn btn-primary" name="anggaran" value="<?= $data->id_anggaran ?>" form="check-anggaran">Pilih</button>
												</td>
											</tr>
										<?php endforeach; ?>
									</tbody>
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
	<script src="<?= base_url() ?>assets/dashboard/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
	<!-- <script src="<?= base_url() ?>assets/dashboard/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script> -->
	<!-- <script src="<?= base_url() ?>assets/dashboard/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script> -->
	<script>
		$(function() {
			$("#example1").DataTable({
				"responsive": true,
				"lengthChange": false,
				"autoWidth": false,
			}).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
		});
	</script>
</body>

</html>