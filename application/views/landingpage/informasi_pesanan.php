<!DOCTYPE html>
<html lang="id">

<head>
	<?php $this->load->view('landingpage/head') ?>
	<title>Informasi Pesanan | E-Katalog UNPAD</title>
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
					<h1>Buat Ajuan</h1>
					<nav class="d-flex align-items-center">
						<a href="#">Buat Ajuan<span class="lnr lnr-arrow-right"></span></a>
						<a href="#">Informasi Pemesanan</a>
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
				<div class="col-lg-6">
					<h3>Data Pemesanan</h3>
					<?= form_open('PUMK/informasi_pesanan'); ?>
					<div class="form-group">
						<label for="nama-paket">Nama Paket <span class="text-danger">*</span></label>
						<input type="text" name="nama-paket" class="form-control" id="nama-paket" value="<?= set_value('nama-paket') ?>" placeholder="Nama Paket" required>
					</div>

					<div class="form-group">
						<label for="uraian-pekerjaan">Uraian Pekerjaan <span class="text-danger">*</span></label>
						<input type="text" name="uraian-pekerjaan" class="form-control" id="uraian-pekerjaan" value="<?= set_value('uraian-pekerjaan') ?>" placeholder="Uraian Pekerjaan" required>
					</div>

					<div class="form-group">
						<?php 
							$placeholder = "1. Volume dan spesifikasi teknis barang sesuai dengan yang disyaratkan;\n2. Barang dalam keadaan baru dapat berfungsi dengan baik dan dapat digunakan sesuai standar yang berlaku;\n3. ...";
						?>
						<label for="ruang-lingkup">Ruang Lingkup <span class="text-danger">*</span></label>
						<textarea type="text" name="ruang-lingkup" class="form-control" id="ruang-lingkup" rows="6" required><?= set_value('ruang-lingkup', $placeholder) ?></textarea>
					</div>

					<div class="form-group">
						<label for="tahun-anggaran">Tahun Anggaran <span class="text-danger">*</span></label>
						<input type="number" name="tahun-anggaran" class="form-control" id="tahun-anggaran" value="<?= set_value('tahun-anggaran') ?>" placeholder="2..." required>
					</div>

					<div class="form-group">
						<label for="alamat">Alamat Pengiriman <span class="text-danger">*</span></label>
						<textarea name="alamat" class="form-control" id="alamat" rows="3" required><?= set_value('alamat') ?></textarea>
					</div>

					<div class="form-group">
						<label for="tanggal-mulai">Tanggal Mulai <span class="text-danger">*</span></label>
						<input type="date" name="tanggal-mulai" class="form-control" id="tanggal-mulai" value="<?= set_value('tanggal-mulai') ?>" min="<?= date('Y-m-d') ?>" required>
					</div>

					<div class="form-group">
						<label for="tanggal-akhir">Tanggal Akhir <span class="text-danger">*</span></label>
						<input type="date" name="tanggal-akhir" class="form-control" id="tanggal-akhir" value="<?= set_value('tanggal-akhir') ?>" min="<?= date('Y-m-d') ?>" required>
					</div>

					<div class="form-group">
						<label for="pp">Personil Pengadaan <span class="text-danger">*</span></label>
						<select name="pp" id="pp" class="form-control" required>
							<option value=""> -- Pilih PP -- </option>
							<?php foreach ($pp as $data) : ?>
								<option value="<?= $data->id_pp ?>" <?= set_select('pp', $data->id_pp) ?>><?= $data->nama_pp ?></option>
							<?php endforeach; ?>
						</select>
					</div>

					<div class="form-group">
						<label for="pk">Pembuat Komitmen <span class="text-danger">*</span></label>
						<select name="pk" id="pk" class="form-control" required>
							<option value=""> -- Pilih PK -- </option>
							<?php foreach ($pk as $data) : ?>
								<option value="<?= $data->id_pk ?>" <?= set_select('pk', $data->id_pk) ?>><?= $data->nama_pk ?></option>
							<?php endforeach; ?>
						</select>
					</div>

					<div class="form-group text-right">
						<input type="submit" class="primary-btn border-0" value="Submit">
					</div>
					<?= form_close(); ?>
				</div>
			</div>
		</div>
	</section>
	<!--================Blog Area =================-->

	<!-- start footer Area -->
	<?php $this->load->view('landingpage/footer'); ?>
	<!-- End footer Area -->
	<?php $this->load->view('landingpage/script'); ?>
	<script>
		$('#tanggal-mulai').on('change', function() {
			$('#tanggal-akhir').attr('min', this.value);
		});
	</script>
</body>

</html>