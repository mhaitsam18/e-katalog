<!DOCTYPE html>
<html lang="id" class="no-js">

<head>
	<?php $this->load->view('landingpage/head') ?>

	<title>Keranjang | E-Katalog UNPAD</title>

	<link rel="stylesheet" href="<?= base_url() ?>assets/dashboard/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
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
					<h1>Keranjang</h1>
					<nav class="d-flex align-items-center">
						<a href="<?= base_url(); ?>">Beranda<span class="lnr lnr-arrow-right"></span></a>
						<a href="#">Keranjang</a>
					</nav>
				</div>
			</div>
		</div>
	</section>
	<!-- End Banner Area -->


	<!--================Cart Area =================-->
	<section class="cart_area">
		<div class="container">

			<?php $this->alert->tampilkan(); ?>

			<?php if (empty($keranjang)) : ?>
				<h2 class="mb-4">Keranjang kosong</h2>
				<p><a href="<?= base_url('produk') ?>" class="border-0 primary-btn">Lihat Produk <i class="ml-2 lnr lnr-arrow-right" aria-hidden="true"></i></a></p>
			<?php else : ?>

				<div class="cart_inner mb-4" id="test">
					<h3 style="color:white;padding: 20px;">Keranjang</h3>
					<div class="table-responsive">
						<?= form_open('PUMK/update_keranjang/', array('id' => 'update-keranjang')); ?>
						<?= form_close(); ?>

						<table class="table" style="background-color:white">
							<thead>
								<tr>
									<th scope="col" class="align-middle">Produk</th>
									<th scope="col" class="align-middle">Penyedia</th>
									<th scope="col" class="align-middle">Harga Satuan</th>
									<th scope="col" class="align-middle">Kuantitas</th>
									<th scope="col" class="align-middle">Total Harga</th>
									<th scope="col">
										Pilih
										<div class="icheck-primary">
											<input type="checkbox" id="semua-produk" form="ambil-keranjang" checked>
											<label for="semua-produk" title="Pilih/tidak semua produk di bawah"></label>
										</div>
									</th>
									<th></th>
								</tr>
							</thead>
							<tbody>
								<?php $jumlah = $i = 0; ?>
								<?php foreach ($keranjang as $data) : ?>
									<tr class="items">
										<td>
											<div class="media">
												<div class="d-flex">
													<?php if (!$data->foto) { ?>
														<img src="<?= base_url() ?>assets/landingpage/img/dummyproduct.png" alt="Foto Produk" width="100px">
													<?php } else { ?>
														<img src="<?= base_url() ?>uploads/foto_produk/<?= $data->foto ?>" alt="Foto Produk" width="100px">
													<?php } ?>
												</div>
												<div class="media-body">
													<p><?= $data->nama_produk ?></p>
												</div>
											</div>
										</td>
										<td>
											<span class=""><?= $data->nama_perusahaan ?></span>
										</td>
										<td>
											<span style="text-align:left" class="harga" data-harga="<?= $data->harga ?>"><?= rupiah($data->harga); ?></span>
										</td>
										<td>
											<div class="product_count">
												<input type="hidden" name="data[pro][]" value="<?= $data->id_produk ?>" form="update-keranjang">
												<input type="number" name="data[qty][]" value="<?= $data->kuantitas ?>" class="form-control qty quantity-container" form="update-keranjang">
											</div>
										</td>
										<td>
											<?php $total   = $data->harga * $data->kuantitas; ?>
											<?php $jumlah += $total; ?>
											<span class="total counted" data-total="<?= $total; ?>"><?= rupiah($total); ?></span>
										</td>
										<td>
											<div class="icheck-primary d-inline">
												<input type="checkbox" class="pilihan-produk" id="produk-<?= $i ?>" value="<?= $data->id_penyedia ?>" form="ambil-keranjang" name="pilihan-produk[]" checked>
												<label for="produk-<?= $i ?>" title="Pilih/tidak produk ini"></label>
											</div>
										</td>
										<td>
											<a href="<?= base_url() ?>PUMK/hapus_produk/<?= $data->id_produk ?>" class="btn btn-sm btn-danger" title="Hapus produk ini"> <i class="lnr lnr-trash" aria-hidden="true"></i> </a>
										</td>
									</tr>
								<?php $i++;
								endforeach; ?>
								<tr class="bottom_button">
									<td colspan="3">
										<input type="submit" value="Update Keranjang" class="btn btn-dark d-inline-block" form="update-keranjang">

										<?= form_open('PUMK/ambil_keranjang', array('class' => 'd-inline-block', 'id' => 'ambil-keranjang')); ?>
										<button class="btn btn-success">
											Buat Ajuan Paket
											<i class="ml-2 lnr lnr-file-add" aria-hidden="true"></i>
										</button>
										<?= form_close(); ?>

									</td>
									<td>
										<p class="m-0 text-heading"><b>Subtotal</b></p>
										<span>(Sebelum PPN)</span>
									</td>
									<td colspan="3">
										<h5 id="subtotal" data-jumlah="<?= $jumlah ?>"><?= rupiah($jumlah) ?></h5>
									</td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>

			<?php endif; ?>
		</div>
	</section>
	<!--================End Cart Area =================-->

	<!-- start footer Area -->
	<?php $this->load->view('landingpage/footer') ?>
	<!-- End footer Area -->

	<?php $this->load->view('landingpage/script') ?>
	<script>
		$('document').ready(function() {
			const rupiah = new Intl.NumberFormat('id-ID', {
				style: 'currency',
				currency: 'IDR'
			});

			$('.qty').on('input', function() {
				const harga = $(this).parents('.items').find('.harga').data('harga');
				const qty = $(this).val();

				const total = harga * qty;

				const el_total = $(this).parents('.items').find('.total')
				el_total.text(rupiah.format(total));
				el_total.attr('data-total', total);

				hitung_total();
			});

			$('#semua-produk').on('change', function() {
				const is_checked = $('#semua-produk').prop('checked');

				$('.pilihan-produk').prop('checked', is_checked);
				$(this).parents('table').find('.total').toggleClass('counted', is_checked);

				hitung_total();
			});

			const n = $('.pilihan-produk').length;
			$('.pilihan-produk').on('change', function() {
				const n_checked = $('.pilihan-produk:checked').length;

				$('#semua-produk').prop('checked', n_checked === n);
				$(this).parents('.items').find('.total').toggleClass('counted');

				hitung_total();
			});

			function hitung_total() {
				let jumlah = 0;

				$('.counted').each(function(idx, el) {
					jumlah += Number(el.dataset.total);
				});

				$('#subtotal').text(rupiah.format(jumlah));
			}
		});
	</script>
</body>

</html>