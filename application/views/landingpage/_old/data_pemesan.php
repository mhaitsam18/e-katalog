<!DOCTYPE html>
<html lang="id" class="no-js">

<?php $this->load->view('landingpage/head') ?>
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.7/css/select2.min.css" rel="stylesheet" />
<script src="https://code.jquery.com/jquery-3.4.1.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.7/js/select2.min.js"></script>

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
	<section class="blog_area mt-4">
		<div class="container">

			<?php $this->alert->tampilkan(); ?>

			<div class="row">
				<div class="card_area d-flex align-items-center">
					<a href="" class="primary-btn" style="line-height:15px;padding:15px">1</a>
					<p style="margin-top:20px">&nbsp;&nbsp;&nbsp;Pilih Anggaran</p>
					<p style="margin-top:10px;color:orange">&nbsp;&nbsp;<b>_______</b></p>
					<a href="" class="primary-btn" style="line-height:15px;padding:15px">2</a>
					<p style="margin-top:20px">&nbsp;&nbsp;&nbsp;Informasi Pemesanan</b>
					<p style="margin-top:10px;color:orange">&nbsp;&nbsp;<b>_______</b></p>
					<a href="" class="primary-btn" style="line-height:15px;padding:15px">3</a>
					<b>&nbsp;&nbsp;&nbsp;Data PBJ/Pemesan</b>
					<p style="margin-top:10px;color:orange">&nbsp;&nbsp;<b>_______</b></p>
					<a href="" class="primary-btn" style="line-height:15px;padding:15px">4</a>
					<p style="margin-top:20px">&nbsp;&nbsp;&nbsp;Pilih PPK/Pembeli</p>
					<p style="margin-top:10px;color:orange">&nbsp;&nbsp;<b>_______</b></p>
					<a href="" class="primary-btn" style="line-height:15px;padding:15px">5</a>
					<p style="margin-top:20px">&nbsp;&nbsp;&nbsp;Daftar Produk</p>
				</div>
				<div class="col-lg-12">
					<div class="blog_left_sidebar">
						<div class="row">
							<div class="col-lg-12" style="margin-bottom:20px">
								<br>
								<h3>Informasi Pemesanan</h3>
								<br>
								<?= form_open('PBJ/tambahan_info'); ?>
								<table cellpadding="10" class="w-100 mb-5">
									<tr>
										<td class="w-25">Nama Pemesan <span class="text-danger">*</span></td>
										<td><input type="text" name="nama" class="form-control" value="<?= set_value('nama') ?>" placeholder="Nama Pemesan"></td>
									</tr>
									<tr>
										<td>Jabatan <span class="text-danger">*</span></td>
										<td><input type="text" name="jabatan" class="form-control" value="<?= set_value('jabatan') ?>" placeholder="Jabatan"></td>
									</tr>
									<tr>
										<td>NIP <span class="text-danger">*</span></td>
										<td><input type="text" name="nip" class="form-control" value="<?= set_value('nip') ?>" placeholder="NIP"></td>
									</tr>
									<tr>
										<td>Email <span class="text-danger">*</span></td>
										<td><input type="email" name="email" class="form-control" value="<?= set_value('email') ?>" placeholder="Email"></td>
									</tr>
									<tr>
										<td>No.Sertifikat PBJ <span class="text-danger">*</span></td>
										<td><input type="text" name="sertifikat" class="form-control" value="<?= set_value('sertifikat') ?>" placeholder="No. Sertifikat PBJ"></td>
									</tr>
								</table>
								<div class="form-group text-right">
									<input type="submit" class="primary-btn border-0" value="Selanjutnya">
								</div>
								</form>
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
</body>

</html>