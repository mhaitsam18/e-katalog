<!DOCTYPE html>
<html lang="id">

<head>
	<?php $this->load->view('dashboard/admin/head') ?>
	<title>Edit Paket | E-Katalog</title>
	<link rel="stylesheet" href="<?= base_url() ?>assets/dashboard/plugins/select2/css/select2.min.css">
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
							<h1>Edit Paket</h1>
						</div>
						<div class="col-sm-6">
							<ol class="breadcrumb float-sm-right">
								<li class="breadcrumb-item"><a href="<?= base_url('Admin'); ?>">Beranda</a></li>
								<li class="breadcrumb-item active">Paket</li>
								<li class="breadcrumb-item active">Edit Paket</li>
							</ol>
						</div>
					</div>
				</div><!-- /.container-fluid -->
			</section>

			<!-- Main content -->
			<section class="content">
				<div class="container-fluid">
					<div class="row">
						<!-- left column -->
						<div class="col-lg-6">
							<div class="card">
								<div class="card-header">
									<!-- <strong><?= $paket->nama_paket; ?></strong> -->
								</div>
								<div class="card-body">
									<!-- <strong class="d-block">PUMK</strong>
									<p><?= $paket->nama_pumk; ?></p> -->

									<strong class="d-block">PP</strong>
									<p><?= $paket->nama_pp; ?></p>

									<!-- <strong class="d-block">PK</strong>
									<p><?= $paket->nama_pk; ?></p> -->

									<strong class="d-block">Status</strong>
									<p><?= status_paket($paket->status); ?></p>

									<strong class="d-block">Tanggal Dibuat</strong>
									<p><?= tanggal($paket->tanggal); ?></p>

									<strong class="d-block">No. PR</strong>
									<p><?= $paket->no_pr ?? '-'; ?></p>
								</div>
							</div>
						</div>
						<!--/.col (left) -->

						<!-- right column -->
						<div class="col-lg-6">
							<?= form_open('Admin/switch_pp_pk') ?>
							<input type="hidden" name="id_paket" value="<?= $paket->id_paket ?>">
							<input type="hidden" name="id_kak" value="<?= $paket->id_kak ?>">
							<div class="card">
								<!-- form start -->

								<div class="card-header">
									<strong>Edit PP dan PK pada Paket</strong>
								</div>
								<div class="card-body">
									<div class="form-group">
										<label for="pp">PP</label>
										<select class="select2 w-100 <?= form_error('pp') ? 'is-invalid' : ''; ?>" id="pp" name="pp" data-placeholder="Pilih PP">
											<?php foreach ($pp as $data) : ?>
												<option value="<?= $data->id_pp ?>" <?= ($data->id_pp == $paket->id_pp) ? 'selected' : '' ?>><?= $data->nama_pp ?></option>
											<?php endforeach; ?>
										</select>
										<?= form_error('pp', '<small class="text-danger">', '</small>'); ?>
									</div>

									<div class="form-group">
										<label for="pk">PK</label>
										<select class="select2 w-100 <?= form_error('pk') ? 'is-invalid' : ''; ?>" id="pk" name="pk" data-placeholder="Pilih PK">
											<?php foreach ($pk as $data) : ?>
												<option value="<?= $data->id_pk ?>" <?= ($data->id_pk == $paket->id_pk) ? 'selected' : '' ?>><?= $data->nama_pk ?></option>
											<?php endforeach; ?>
										</select>
										<?= form_error('pk', '<small class="text-danger">', '</small>'); ?>
									</div>
								</div>
								<!-- /.card-body -->
								<div class=" card-footer">
									<input type="submit" value="Submit" class="btn btn-primary">
									<a href="<?= base_url('Admin/'.$this->session->daftar_paket) ?>" class="btn btn-secondary">Kembali</a>
								</div>
							</div>
							<?= form_close(); ?>
							<!-- /.card -->
						</div>
						<!--/.col (right) -->
					</div>
					<!-- /.row -->
				</div><!-- /.container-fluid -->
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

	<!-- Page specific script -->
	<?php $this->load->view('dashboard/admin/script') ?>
</body>

</html>