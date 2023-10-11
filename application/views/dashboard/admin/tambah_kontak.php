<!DOCTYPE html>
<html lang="id">

<head>
	<?php $this->load->view('dashboard/admin/head') ?>
	<title>Tambah Kontak | E-Katalog</title>
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
							<h1>Tambah Data Kontak Baru</h1>
						</div>
						<div class="col-sm-6">
							<ol class="breadcrumb float-sm-right">
								<li class="breadcrumb-item"><a href="<?= base_url('Admin') ?>">Beranda</a></li>
								<li class="breadcrumb-item"><a href="<?= base_url('Admin/kontak') ?>">Kontak</a></li>
								<li class="breadcrumb-item active">Tambah Kontak</li>
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
						<div class="col-md-12">
							<div class="card">
								<!-- form start -->
								<?= form_open('Admin/tambah_kontak'); ?>
								<div class="card-body" id="card-body">
									<div id="container-input-baru">
										<?php if (NULL === $this->input->post('data_baru[key][]')) : ?>
											<div class="form-group input-baru" id="input-baru-1">
												<strong>Data Baru 1</strong>
												<div class="row">
													<div class="col-md-3">
														<input type="text" name="data_baru[key][]" class="form-control <?= form_error('data_baru[key][]') ? 'is-invalid' : ''; ?>" placeholder="Nama data baru, cth: email" value="<?= set_value('data_baru[key][]'); ?>">
														<?= form_error('data_baru[key][]', '<small class="text-danger">', '</small>'); ?>
													</div>
													<div class="col-md-8">
														<input type="text" name="data_baru[value][]" class="form-control <?= form_error('data_baru[value][]') ? 'is-invalid' : ''; ?>" placeholder="Nilai data baru, cth: email@example.com" value="<?= set_value('data_baru[value][]'); ?>">
														<?= form_error('data_baru[value][]', '<small class="text-danger">', '</small>'); ?>
													</div>
													<div class="col-md-1">
														<button type="button" class="btn btn-default text-danger" title="Hapus field ini" data-no="1" onclick="hapusField(this)">
															<i class="fas fa-trash"></i>
														</button>
													</div>
												</div>
											</div>
										<?php else : ?>
											<?php $key = $this->input->post('data_baru[key][]'); ?>
											<?php for ($i = 1; $i <= count($key); $i++) : ?>
												<div class="form-group input-baru" id="input-baru-<?= $i; ?>">
													<strong>Data Baru <?= $i; ?></strong>
													<div class="row">
														<div class="col-md-3">
															<input type="text" name="data_baru[key][]" class="form-control <?= form_error('data_baru[key][]') ? 'is-invalid' : ''; ?>" placeholder="Nama data baru" value="<?= set_value('data_baru[key][]'); ?>">
															<?= form_error('data_baru[key][]', '<small class="text-danger">', '</small>'); ?>
														</div>
														<div class="col-md-8">
															<input type="text" name="data_baru[value][]" class="form-control <?= form_error('data_baru[value][]') ? 'is-invalid' : ''; ?>" placeholder="Nilai data baru" value="<?= set_value('data_baru[value][]'); ?>">
															<?= form_error('data_baru[value][]', '<small class="text-danger">', '</small>'); ?>
														</div>
														<div class="col-md-1">
															<button type="button" class="btn btn-default text-danger" title="Hapus field ini" data-no="<?= $i; ?>" onclick="hapusField(this)">
																<i class="fas fa-trash"></i>
															</button>
														</div>
													</div>
												</div>
											<?php endfor; ?>
										<?php endif; ?>
									</div>

									<div class="mt-4">
										<button type="button" class="btn btn-default" id="btn-tambah-kontak">
											<i class="fas fa-plus mr-1"></i>
											Tambah Data Kontak
										</button>
									</div>

								</div>
								<!-- /.card-body -->
								<div class="card-footer">
									<input type="submit" value="Submit" class="btn btn-primary">
									<a href="<?= base_url('Admin/kontak') ?>" class="btn btn-secondary">Batal</a>
								</div>
								<?= form_close(); ?>
							</div>

							<template id="input-baru-template">
								<div class="form-group" id="input-baru-#">
									<strong>Data Baru #</strong>
									<div class="row">
										<div class="col-md-3">
											<input type="text" name="data_baru[key][]" class="form-control" placeholder="Nama data baru, cth: email">
										</div>
										<div class="col-md-8">
											<input type="text" name="data_baru[value][]" class="form-control" placeholder="Nilai data baru, cth: email@example.com">
										</div>
										<div class="col-md-1">
											<button type="button" class="btn btn-default text-danger" title="Hapus field ini" data-no="#" onclick="hapusField(this)">
												<i class="fas fa-trash"></i>
											</button>
										</div>
									</div>
								</div>
							</template>

							<!-- /.card -->
						</div>
						<!--/.col (left) -->
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

	<?php $this->load->view('dashboard/admin/script') ?>
	<script>
		window.onload = () => {
			let jml_data_baru = document.getElementsByClassName('input-baru').length;


			const btn_tambah = document.getElementById('btn-tambah-kontak');
			btn_tambah.onclick = () => {
				jml_data_baru++;

				const template = document.getElementById('input-baru-template');

				const clone = template.content.cloneNode(true);

				const form_group = clone.querySelectorAll('.form-group')[0];
				form_group.setAttribute('id', 'input-baru-' + jml_data_baru);

				let input_title = clone.querySelectorAll('strong')[0];
				input_title.textContent = 'Data Baru ' + jml_data_baru;

				let btn_hapus = clone.querySelectorAll('button')[0];
				btn_hapus.setAttribute('data-no', jml_data_baru);

				const container = document.getElementById('container-input-baru');
				container.append(clone);
			}
		}

		function hapusField(el) {
			const idx = el.getAttribute('data-no');

			const input_baru = document.getElementById('input-baru-' + idx);
			input_baru.remove();
		}
	</script>

</body>

</html>