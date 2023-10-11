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
						<a href="#">Preview PO</a>
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
				<div class="col-lg-12 d-flex align-items-center justify-content-center">
					<a href="" class="primary-btn" style="line-height:15px;padding:15px">1</a>
					<span class="ml-2">Informasi Pemesanan</span>
					<hr style="width: 80px; height: 2px;" class="bg-warning m-0 ml-2">
					<a href="" class="primary-btn" style="line-height:15px;padding:15px">2</a>
					<b class="ml-2">Preview PO</b>
				</div>

				<div class="col-lg-12">
					<div class="blog_left_sidebar">
						<div class="row">
							<div class="col-lg-7 mb-4">
								<h3>Data Diperlukan</h3>
								<div class="card-body">
									<div class="mb-3">
										<a href="<?= base_url('po/'.$po->id_po) ?>" class="genric-btn primary medium" target="_blank" rel="noopener noreferer">
											Lihat PO
											<i class="lnr lnr-file-empty"></i>
										</a>
									</div>
									<?= form_open('PUMK/update_po'); ?>
									<div class="form-group">
										<label for="no-sp">No. Surat Pesanan <span class="text-danger">*</span></label>
										<input type="text" name="no-sp" class="form-control" id="no-sp" value="<?= set_value('no-sp', $po->no_sp ?? '') ?>" required>
									</div>

									<div class="form-group">
										<label for="no-anggaran">No. Anggaran <span class="text-danger">*</span></label>
										<input type="text" name="no-anggaran" class="form-control" id="no-anggaran" value="<?= set_value('no-anggaran', $po->no_anggaran ?? '') ?>" required>
									</div>

									<div class="form-group text-right">
										<input type="submit" class="primary-btn border-0" value="Submit">
									</div>
									<?= form_close(); ?>
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
</body>

</html>