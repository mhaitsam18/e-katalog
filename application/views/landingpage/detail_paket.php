<!DOCTYPE html>
<html lang="id" class="no-js">

<head>
	<?php $this->load->view('landingpage/head') ?>
	<title>Detail Paket | E-Katalog UNPAD</title>
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
					<h1>Detail Ajuan Paket</h1>
					<nav class="d-flex align-items-center">
						<a href="<?= base_url('PUMK/daftar_paket') ?>">Daftar Ajuan<span class="lnr lnr-arrow-right"></span></a>
						<a href="#">Detail Ajuan Paket</a>
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

			<div class="row mb-5">
				<div class="col-12">
					<a href="<?= base_url() ?>PUMK/daftar_paket" class="btn btn-dark">
						<i class="lnr lnr-list mr-1" aria-hidden="true"></i>
						Daftar Ajuan
					</a>

					<?php if ($pemesanan->status < 5) : ?>
						<a href="<?= base_url() ?>PUMK/ubah_paket/<?= $pemesanan->id_paket ?>" class="btn btn-secondary">
							<i class="lnr lnr-pencil mr-1" aria-hidden="true"></i>
							Ubah Ajuan
						</a>
					<?php endif; ?>

					<?php
					$subtotal = 0;

					foreach ($produk as $p) {
						$subtotal += $p->kuantitas * $p->harga;
					}
					?>

					<?php if($pemesanan->status >= 5 && $pemesanan->status != 8): ?>
						<?php if ($subtotal >= 100000000) : ?>
							<a href="<?= base_url() ?>PUMK/print_kontrak/<?= $pemesanan->id_paket ?>" target="_blank" class="btn btn-info" rel="noopener noreferer">
								<i class="lnr lnr-file-empty mr-1" aria-hidden="true"></i>
								Kontrak
							</a>
						<?php endif; ?>

						<a href="<?= base_url() ?>PUMK/print_invoice/<?= $pemesanan->id_paket ?>" target="_blank" class="btn btn-info" rel="noopener noreferer">
							<i class="lnr lnr-file-empty mr-1" aria-hidden="true"></i>
							Invoice
						</a>
					<?php endif; ?>

					<?php // Jika mengedit kondisional ini, edit juga kondisional modal di bagian bawah halaman ini 
					?>
					<?php if ($pemesanan->status < 2) : ?>
						<button type="button" class="btn btn-outline-danger" data-toggle="modal" data-target="#hapus-modal">
							<i class="lnr lnr-cross-circle" aria-hidden="true"></i>
							Batalkan Ajuan
						</button>
					<?php endif; ?>

					<?php // Jika mengedit kondisional ini, edit juga kondisional modal di bagian bawah halaman ini 
					?>
					<?php if ($pemesanan->status == 6) : ?>
						<button type="button" class="btn btn-warning" data-toggle="modal" data-target="#selesai-modal">
							<i class="lnr lnr-checkmark-circle mr-1" aria-hidden="true"></i>
							Verifikasi Paket Sampai
						</button>
					<?php endif; ?>
				</div>
			</div>

			<h2>Detail Ajuan</h2>

			<div class="row mt-4">
				<div class="col-lg-6">
					<section class="product_description_area mt-0">
						<div>
							<ul class="nav nav-tabs rounded-top" id="myTab" role="tablist">
								<li class="nav-item">
									<a class="nav-link active" id="home-tab" data-toggle="tab" href="#info" role="tab" aria-controls="info" aria-selected="true">Informasi Utama</a>
								</li>
								<li class="nav-item">
									<a class="nav-link" id="profile-tab" data-toggle="tab" href="#produk" role="tab" aria-controls="produk" aria-selected="false">Produk</a>
								</li>
								<li class="nav-item">
									<a href="<?= base_url('kak/'.$pemesanan->link) ?>" class="nav-link" target="_blank" rel="noopener noreferer">
										Lihat KAK
									</a>
								</li>
							</ul>
							<div class="tab-content rounded-bottom" id="myTabContent">
								<div class="tab-pane fade show active" id="info" role="tabpanel" aria-labelledby="info-tab">
									<div class="table-responsive">
										<table class="table">
											<tbody>
												<tr></tr>
												<tr>
													<th>Nama Paket</th>
													<td><?= $pemesanan->nama_paket ?></td>
												</tr>
												<tr>
													<th>Vendor</th>
													<td><?= $pemesanan->nama_perusahaan ?></td>
												</tr>
												<tr>
													<th>Uraian Pekerjaan</th>
													<td><?= $pemesanan->uraian_pekerjaan ?></td>
												</tr>
												<tr>
													<th>Ruang Linkup</th>
													<td><?= $pemesanan->ruang_lingkup ?></td>
												</tr>
												<tr>
													<th>Tahun Anggaran</th>
													<td><?= $pemesanan->tahun_anggaran ?></td>
												</tr>
												<tr>
													<th>Alamat dikirim</th>
													<td><?= $pemesanan->alamat_kirim ?></td>
												</tr>
												<tr>
													<th>Tanggal</th>
													<td><?= tanggal($pemesanan->tanggal_mulai) . ' s.d. ' . tanggal($pemesanan->tanggal_akhir) ?></td>
												</tr>
												<tr>
													<th>Nomor PR</th>
													<td><?= $pemesanan->no_pr ?? '<i>Belum diinputkan. Input dengan tombol Ubah Ajuan di atas.</i>' ?></td>
												</tr>
												<tr>
													<th>PP</th>
													<td><?= $pemesanan->nama_pp; ?></td>
												</tr>
												<tr>
													<th>PK</th>
													<td><?= $pemesanan->nama_pk; ?></td>
												</tr>
											</tbody>
										</table>
									</div>
								</div>
								<div class="tab-pane fade" id="produk" role="tabpanel" aria-labelledby="produk-tab">
									<div class="table-responsive">
										<h3>Daftar Produk</h3>
										<?php foreach ($produk as $p) : ?>
											<div class="row w-100">
												<div class="col-3">
													<?php $src = is_null($p->foto) ? base_url() . 'assets/landingpage/img/dummyproduct.png' : base_url() . 'uploads/foto_produk/' . $p->foto ?>
													<img class="img-fluid" src="<?= $src ?>" alt="Foto produk">
												</div>
												<div class="col-7">
													<table>
														<tr>
															<th>Nama</th>
															<td>:</td>
															<td><a href="<?= base_url('LandingPage/lihat_produk/' . $p->id_produk) ?>"><?= $p->nama_produk ?></a></td>
														</tr>
														<tr>
															<th>Etalase</th>
															<td>:</td>
															<td><?= $p->nama_etalase ?></td>
														</tr>
														<tr>
															<th>Kuantitas</th>
															<td>:</td>
															<td><?= $p->kuantitas ?></td>
														</tr>
														<tr>
															<th>Harga</th>
															<td>:</td>
															<td><?= rupiah($p->harga) ?></td>
														</tr>
														<tr>
															<th>Total</th>
															<td>:</td>
															<?php $total = $p->harga * $p->kuantitas ?>
															<td><?= rupiah($total) ?></td>
														</tr>
													</table>
												</div>
											</div>
										<?php endforeach; ?>
										<div class="mt-4">
											<b><?= 'Subtotal: ' . rupiah($subtotal); ?></b>
										</div>
									</div>
								</div>
							</div>
						</div>
					</section>
				</div>

				<div class="col-lg-6">
					<div class="d-flex align-items-center justify-content-center mb-4">
						<span class="primary-btn px-2">1</span>
						<?php if ($pemesanan->status <= 1) : ?>
							<b class="ml-2">Pending</b>
						<?php else : ?>
							<span class="ml-2">Pending</span>
						<?php endif; ?>
						<hr style="height: 2px;" class="bg-warning m-0 ml-2 flex-grow-1">
						<span class="primary-btn px-2">2</span>
						<?php if ($pemesanan->status >= 2 && $pemesanan->status <= 4) : ?>
							<b class="ml-2">Diproses</b>
						<?php else : ?>
							<span class="ml-2">Diproses</span>
						<?php endif; ?>
						<hr style="height: 2px;" class="bg-warning m-0 ml-2 flex-grow-1">
						<span class="primary-btn px-2">3</span>
						<?php if ($pemesanan->status == 5 || $pemesanan->status == 6) : ?>
							<b class="ml-2">Dikirim</b>
						<?php else : ?>
							<span class="ml-2">Dikirim</span>
						<?php endif; ?>
						<hr style="height: 2px;" class="bg-warning m-0 ml-2 flex-grow-1">
						<span class="primary-btn px-2">4</span>
						<?php if ($pemesanan->status >= 7) : ?>
							<b class="ml-2">Selesai</b>
						<?php else : ?>
							<span class="ml-2">Selesai</span>
						<?php endif; ?>
					</div>

					<div style="border:1px solid #eee;padding:15px;border-radius:5px">
						<h3>Status</h3>
						<table cellpadding="2" width="450px">
							<tr>
								<td colspan="2">
									<hr>
								</td>
							</tr>
							<tr>
								<th>Status</th>
								<td>
									<?php
									if ($pemesanan->status == 0) { ?>
										<span class="btn btn-light">Paket Pending</span>
									<?php } elseif ($pemesanan->status == 1) { ?>
										<span class="btn btn-primary">Persetujuan Paket ke PP</span>
									<?php } elseif ($pemesanan->status == 2) { ?>
										<span class="btn btn-primary">Ajukan Negosiasi ke Penyedia</span>
									<?php } elseif ($pemesanan->status == 3) { ?>
										<span class="btn btn-dark">Ajukan Negosiasi Kembali ke PP</span>
									<?php } elseif ($pemesanan->status == 4) { ?>
										<span class="btn btn-dark">Review PP</span>
									<?php } elseif ($pemesanan->status == 5) { ?>
										<span class="btn btn-dark">Pengiriman Paket</span>
									<?php } elseif ($pemesanan->status == 6) { ?>
										<span class="btn btn-warning">Paket Dikirim</span>
									<?php } elseif ($pemesanan->status == 7) { ?>
										<span class="btn btn-warning">Paket Selesai</span>
									<?php } elseif ($pemesanan->status == 8) { ?>
										<span class="btn btn-danger">Paket Ditolak/Dibatalkan</span>
									<?php } else {
										echo "-";
									} ?>
								</td>
							</tr>
							<tr>
								<td colspan="2">
									<hr>
								</td>
							</tr>
							<tr>
								<th title="Paket sedang diurus oleh">Posisi Paket</th>
								<td>
									<?php if ($pemesanan->status == 0) { ?>
										<span class="btn btn-light">PUMK</span>
									<?php } elseif ($pemesanan->status == 1) { ?>
										<span class="btn btn-primary">PUMK</span>
									<?php } elseif ($pemesanan->status == 2) { ?>
										<span class="btn btn-primary">Penyedia</span>
									<?php } elseif ($pemesanan->status == 3) { ?>
										<span class="btn btn-dark">PUMK</span>
									<?php } elseif ($pemesanan->status == 4) { ?>
										<span class="btn btn-dark">PUMK</span>
									<?php } elseif ($pemesanan->status == 5) { ?>
										<span class="btn btn-dark">Penyedia</span>
									<?php } elseif ($pemesanan->status == 6) { ?>
										<span class="btn btn-warning">Penyedia</span>
									<?php } elseif ($pemesanan->status == 7) { ?>
										<span class="btn btn-warning">PUMK</span>
									<?php } elseif ($pemesanan->status == 8) { ?>
										<span class="btn btn-danger">-</span>
									<?php } else {
										echo "-";
									} ?>
								</td>
							</tr>
							<tr>
								<td colspan="2">
									<hr>
								</td>
							</tr>
							<tr>
								<td colspan="2">
									<br>
									<a href="<?= base_url() ?>PUMK/riwayat_paket/<?= $pemesanan->id_paket ?>" class="btn btn-secondary w-100">
										<i class="lnr lnr-history mr-1" aria-hidden="true"></i>
										Riwayat Paket</a>
								</td>
							</tr>
						</table>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!--================Blog Area =================-->

	<?php if ($pemesanan->status == 6) : ?>
		<div class="modal fade" id="selesai-modal">
			<div class="modal-dialog modal-lg">
				<div class="modal-content">
					<div class="modal-header">
						<h4 class="modal-title">Paket <?= $pemesanan->nama_paket ?></h4>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<?= form_open('PUMK/selesai_paket/' . $pemesanan->id_paket); ?>
					<div class="modal-body">
						<p>Apakah Anda yakin akan <b style="color:black">menyelesaikan dan verifikasi</b> paket ini sudah sampai?</p>
						<input type="hidden" name="id_paket" value="<?= $pemesanan->id_paket; ?>">
						<div class="form-group mb-3">
							<label for="receipt" class="form-label">Masukkan Nomor Kuitansi</label>
							<input type="text" class="form-control" name="receipt" id="receipt">
						</div>
					</div>
					<div class="modal-footer justify-content-right">
						<button type="button" class="btn btn-warning" data-dismiss="modal">Tutup</button>
						<button type="submit" class="btn btn-success">Proses</button>
					</div>
					<?= form_close(); ?>
				</div>
				<!-- /.modal-content -->
			</div>
			<!-- /.modal-dialog -->
		</div>
	<?php endif; ?>

	<?php if ($pemesanan->status < 2) : ?>
		<div class="modal fade" id="hapus-modal">
			<div class="modal-dialog modal-lg">
				<div class="modal-content">
					<div class="modal-header">
						<h4 class="modal-title">Paket <?= $pemesanan->nama_paket ?></h4>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<p>Apakah Anda yakin akan <b style="color:black">membatalkan</b> ajuan paket ini?</p>
					</div>
					<div class="modal-footer justify-content-right">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Tidak</button>
						<a href="<?= base_url() ?>PUMK/batalkan/<?= $pemesanan->id_paket ?>" class="btn btn-danger">Iya</a>
					</div>
				</div>
				<!-- /.modal-content -->
			</div>
			<!-- /.modal-dialog -->
		</div>
	<?php endif ?>

	<!-- start footer Area -->
	<?php $this->load->view('landingpage/footer') ?>
	<!-- End footer Area -->

	<?php $this->load->view('landingpage/script') ?>
</body>

</html>