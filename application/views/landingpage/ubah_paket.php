<!DOCTYPE html>
<html lang="id" class="no-js">

<head>
	<?php $this->load->view('landingpage/head') ?>
	<title>Ubah Paket | E-Katalog UNPAD</title>
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
					<h1>Ubah Ajuan</h1>
					<nav class="d-flex align-items-center">
						<a href="<?= base_url('PUMK/detail_paket/' . $id_paket) ?>">Detail Ajuan<span class="lnr lnr-arrow-right"></span></a>
						<a href="#">Ubah Ajuan</a>
					</nav>
				</div>
			</div>
		</div>
	</section>
	<!-- End Banner Area -->

	<!--================Blog Area =================-->
	<section class="blog_area mt-4 mb-lg-5">
		<div class="container">

			<?php $this->alert->tampilkan(); ?>

			<div class="row">
				<div class="col-lg-10">
					<a href="<?= base_url('PUMK/detail_paket/' . $id_paket) ?>" class="btn btn-outline-secondary">
						<i class="lnr lnr-arrow-left" aria-hidden="true"></i>
						Kembali ke detail paket
					</a>
					<h2 class="mt-5 mb-4">Ubah Ajuan</h2>

					<?= form_open('PUMK/ubah_paket/' . $id_paket); ?>
					<input type="hidden" name="p" value="<?= $id_paket ?>">

					<div class="form-group mb-lg-5">
						<label for="no-anggaran">Nomor PR</label>
						<input type="text" name="no-pr" class="form-control" id="no-pr" value="<?= set_value('no-pr', $pemesanan->no_pr ?? '') ?>">
					</div>

					<div class="form-group">
						<label for="nama-paket">Nama Paket <span class="text-danger">*</span></label>
						<input type="text" name="nama-paket" class="form-control" id="nama-paket" value="<?= set_value('nama-paket', $pemesanan->nama_paket ?? '') ?>" required>
					</div>

					<div class="form-group">
						<label for="uraian-pekerjaan">Uraian Pekerjaan <span class="text-danger">*</span></label>
						<input type="text" name="uraian-pekerjaan" class="form-control" id="uraian-pekerjaan" value="<?= set_value('uraian-pekerjaan', $pemesanan->uraian_pekerjaan ?? '') ?>" required>
					</div>

					<div class="form-group">
						<label for="ruang-lingkup">Ruang Lingkup <span class="text-danger">*</span></label>
						<input type="text" name="ruang-lingkup" class="form-control" id="ruang-lingkup" value="<?= set_value('ruang-lingkup', $pemesanan->ruang_lingkup ?? '') ?>" required>
					</div>

					<div class="form-group">
						<label for="tahun-anggaran">Tahun Anggaran <span class="text-danger">*</span></label>
						<input type="number" name="tahun-anggaran" class="form-control" id="tahun-anggaran" value="<?= set_value('tahun-anggaran', $pemesanan->tahun_anggaran ?? '') ?>" required>
					</div>

					<div class="form-group">
						<label for="alamat">Alamat Pengiriman <span class="text-danger">*</span></label>
						<textarea name="alamat" class="form-control" id="alamat" rows="3" required><?= set_value('alamat', $pemesanan->alamat_kirim ?? '') ?></textarea>
					</div>

					<div class="form-group">
						<label for="tanggal-mulai">Tanggal Mulai <span class="text-danger">*</span></label>
						<input type="date" name="tanggal-mulai" class="form-control" id="tanggal-mulai" value="<?= set_value('tanggal-mulai', $pemesanan->tanggal_mulai ?? '') ?>" min="<?= min([$pemesanan->tanggal_mulai, $pemesanan->tanggal_buat, date('Y-m-d')]) ?>" required>
					</div>

					<div class="form-group">
						<label for="tanggal-akhir">Tanggal Akhir <span class="text-danger">*</span></label>
						<input type="date" name="tanggal-akhir" class="form-control" id="tanggal-akhir" value="<?= set_value('tanggal-akhir', $pemesanan->tanggal_akhir ?? '') ?>" min="<?= $pemesanan->tanggal_mulai ?? date('Y-m-d') ?>" required>
					</div>

					<div class="form-group">
						<label for="pp">Personil Pengadaan <span class="text-danger">*</span></label>
						<select name="pp" id="pp" class="form-control" required>
							<option value=""> -- Pilih PP -- </option>
							<?php foreach ($pp as $data) : ?>
								<option value="<?= $data->id_pp ?>" <?= set_select('pp', $data->id_pp, $data->id_pp == ($pemesanan->id_pp ?? '')) ?> ><?= $data->nama_pp ?></option>
							<?php endforeach; ?>
						</select>
					</div>

					<div class="form-group">
						<label for="pk">Pembuat Komitmen <span class="text-danger">*</span></label>
						<select name="pk" id="pk" class="form-control" required>
							<option value=""> -- Pilih PK -- </option>
							<?php foreach ($pk as $data) : ?>
								<option value="<?= $data->id_pk ?>" <?= set_select('pk', $data->id_pk, $data->id_pk == ($pemesanan->id_pk ?? '')) ?> ><?= $data->nama_pk ?></option>
							<?php endforeach; ?>
						</select>
					</div>

					<div class="form-group text-right">
						<a href="<?= base_url('PUMK/detail_paket/' . $id_paket) ?>" class="btn btn-secondary">
							Batal
						</a>
						<input type="submit" value="Submit" class="btn btn-primary">
					</div>
					<?= form_close() ?>
				</div>
			</div>
		</div>
	</section>
	<!--================Blog Area =================-->

	<!-- start footer Area -->
	<?php $this->load->view('landingpage/footer') ?>
	<!-- End footer Area -->

	<?php $this->load->view('landingpage/script') ?>
	<script>
		$('#tanggal-mulai').on('change', function() {
			$('#tanggal-akhir').attr('min', this.value);
		});
	</script>
</body>

</html>