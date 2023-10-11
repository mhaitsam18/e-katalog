<!DOCTYPE html>
<html lang="id">

<head>
	<?php $this->load->view('dashboard/admin/head') ?>
	<title>Kelola Kontak | E-Katalog</title>
	<link rel="stylesheet" href="<?= base_url() ?>assets/dashboard/plugins/sweetalert2/sweetalert2.min.css">
</head>

<body class="hold-transition sidebar-mini">

	<div class="wrapper">
		<!-- Navbar -->
		<?php $this->load->view('dashboard/admin/navbar') ?>
		<!-- /.navbar -->

		<!-- Main Sidebar Container -->
		<?php $this->load->view('dashboard/admin/sidebar') ?>

		<!-- Content Wrapper. Contains page content -->
		<div class="content-wrapper">
			<!-- Content Header (Page header) -->
			<section class="content-header">
				<div class="container-fluid">
					<div class="row mb-2">
						<div class="col-sm-6">
							<h1>Kelola Kontak</h1>
						</div>
						<div class="col-sm-6">
							<ol class="breadcrumb float-sm-right">
								<li class="breadcrumb-item"><a href="<?= base_url('Admin') ?>">Beranda</a></li>
								<li class="breadcrumb-item active">Kontak</li>
							</ol>
						</div>
					</div>
				</div><!-- /.container-fluid -->
			</section>

			<!-- Main content -->
			<section class="content">
				<div class="container-fluid">

					<?php $this->alert->tampilkan(); ?>

					<div class="row">
						<div class="col">
							<a href="<?= base_url('Admin/tambah_kontak') ?>" class="btn btn-primary">
								<i class="fas fa-plus mr-1"></i>
								Tambah Data Kontak Baru</a>
						</div>
					</div>

					<div class="row mt-2">
						<!-- left column -->
						<div class="col-md-12">
							<div class="card">
								<!-- form start -->
								<?= form_open('Admin/kontak'); ?>
								<div class="card-body">
									<div class="form-group">
										<label for="nama_kontak">Nama Kontak <span class="text-danger">*</span></label>
										<input type="text" name="nama_kontak" class="form-control <?= form_error('nama_kontak') ? 'is-invalid' : ''; ?>" placeholder="Universitas Padjadjaran" id="nama_kontak" value="<?= set_value('nama_kontak', $kontak['nama_kontak']) ?>" required>
										<?= form_error('nama_kontak', '<small class="text-danger">', '</small>'); ?>
									</div>
									<div class="form-group">
										<label for="alamat">Alamat <span class="text-danger">*</span></label>
										<textarea name="alamat" id="alamat" class="form-control w-100 <?= form_error('alamat') ? 'is-invalid' : ''; ?>" rows="3" required><?= set_value('alamat', $kontak['alamat']); ?></textarea>
										<?= form_error('alamat', '<small class="text-danger">', '</small>'); ?>
									</div>
									<div class="form-group">
										<label for="telepon_1">Nomor Telepon 1 <span class="text-danger">*</span></label>
										<input type="tel" name="telepon_1" class="form-control <?= form_error('telepon_1') ? 'is-invalid' : ''; ?>" id="telepon_1" value="<?= $kontak['telepon_1']; ?>" required>
										<?= form_error('telepon_1', '<small class="text-danger">', '</small>'); ?>
									</div>
									<div class="form-group">
										<label for="telepon_2">Nomor Telepon 2</label>
										<input type="tel" name="telepon_2" class="form-control <?= form_error('telepon_2') ? 'is-invalid' : ''; ?>" id="telepon_2" value="<?= $kontak['telepon_2']; ?>">
										<?= form_error('telepon_2', '<small class="text-danger">', '</small>'); ?>
									</div>
									<div class="form-group">
										<label for="jam_telepon">Jam Telepon</label>
										<input type="text" name="jam_telepon" class="form-control <?= form_error('jam_telepon') ? 'is-invalid' : ''; ?>" placeholder="Senin s.d. Jumat (08.00 s.d. 16.00)" id="jam_telepon" value="<?= set_value('jam_telepon', $kontak['jam_telepon']) ?>">
										<?= form_error('jam_telepon', '<small class="text-danger">', '</small>'); ?>
									</div>
									<div class="form-group">
										<label for="email">Email <span class="text-danger">*</span></label>
										<input type="email" name="email" class="form-control <?= form_error('email') ? 'is-invalid' : ''; ?>" id="email" value="<?= set_value('email', $kontak['email']) ?>" required>
										<?= form_error('email', '<small class="text-danger">', '</small>'); ?>
									</div>
									<div class="form-group">
										<label for="website">Website</label>
										<input type="url" name="website" class="form-control <?= form_error('website') ? 'is-invalid' : ''; ?>" id="website" value="<?= set_value('website', $kontak['website']) ?>">
										<?= form_error('website', '<small class="text-danger">', '</small>'); ?>
									</div>
									<div class="form-group">
										<label for="googlemap">Sematan Google Map</label>
										<textarea name="googlemap" id="googlemap" class="form-control <?= form_error('googlemap') ? 'is-invalid' : ''; ?>" rows="3">&lt;iframe src&equals;&quot;<?= set_value('googlemap', $kontak['googlemap'] ?? $kontak['googlemap_src']) ?>&quot; &gt; &lt;&sol;iframe&gt;</textarea>
										<small><a href="https://support.google.com/maps/answer/144361?hl=id&co=GENIE.Platform%3DDesktop#:~:text=Menyematkan%20peta%20atau%20petunjuk%20arah&text=di%20peta%20tersemat.-,Buka%20Google%20Maps.,View%20yang%20ingin%20Anda%20sematkan.&text=Klik%20Bagikan%20atau%20sematkan%20peta,Klik%20Sematkan%20peta." target="_blank" rel="noopener noreferrer">Cara menyalin sematan google map</a></small>
										<?= form_error('googlemap', '<br><small class="text-danger">', '</small>'); ?>
									</div>

									<?php $kontak_tambahan = array_slice($kontak, 8); ?>

									<?php if(! empty($kontak_tambahan)): ?>
									<div class="form-group mt-5">
										<span>Kontak Lain</span>
									</div><?php endif; ?>

									<?php foreach ($kontak_tambahan as $key => $value) : ?>
										<?php if (substr_count($key, 'data_baru') > 0) break; ?>
										<div class="form-group">
											<div class="row">
												<div class="col-12">
													<label for="<?= $key ?>"><?= ucwords(str_replace('_', ' ', $key)) ?></label>
												</div>
												<div class="col-11">
													<input type="text" name="<?= $key ?>" class="form-control <?= form_error($key) ? 'is-invalid' : ''; ?>" id="<?= $key ?>" value="<?= set_value($key, $value); ?>">
													<?= form_error($key, '<small class="text-danger">', '</small>'); ?>
												</div>
												<div class="col-1">
													<button type="submit" name="hapus-kontak" value="<?= $key ?>" class="btn btn-default text-danger tombol-hapus" title="Hapus field ini" form="hapus-kontak">
														<i class="fas fa-trash"></i>
													</button>
												</div>
											</div>
										</div>
									<?php endforeach; ?>

								</div>
								<!-- /.card-body -->
								<div class="card-footer">
									<input type="submit" value="Submit Perubahan" class="btn btn-primary">
									<a href="<?= base_url('kontak') ?>" class="btn btn-info" target="_blank" rel="noopener noreferrer">Lihat Kontak di Landing Page</a>
								</div>
								<?= form_close(); ?>
							</div>

							<!-- /.card -->
						</div>
						<!--/.col (left) -->
					</div>
					<!-- /.row -->
				</div><!-- /.container-fluid -->

				<?= form_open(base_url('Admin/hapus_kontak'), ['id' => 'hapus-kontak']); ?>
				<?= form_close(); ?>
			</section>
			<!-- /.content -->
		</div>
		<!-- /.content-wrapper -->
		<footer class="main-footer">
			<div class="float-right d-none d-sm-block">
				<b>Version</b> 3.2.0
			</div>
			<strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights reserved.
		</footer>

	</div>
	<!-- ./wrapper -->

	<?php $this->load->view('dashboard/admin/script') ?>
	<script src="<?= base_url() ?>assets/dashboard/plugins/sweetalert2/sweetalert2.min.js"></script>
	<script src="<?= base_url() ?>assets/dashboard/dist/js/delete-button.js"></script>
</body>

</html>