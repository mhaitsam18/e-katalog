<!DOCTYPE html>
<html lang="id">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Lampiran Invoice | E-Katalog UNPAD</title>
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
	<link rel="stylesheet" href="<?= base_url() ?>assets/dashboard/plugins/fontawesome-free/css/all.min.css">
	<link rel="stylesheet" href="<?= base_url() ?>assets/dashboard/dist/css/adminlte.min.css">
	<link rel="stylesheet" href="<?= base_url() ?>assets/dashboard/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
	<link rel="shortcut icon" href="<?= base_url() ?>assets/landingpage/img/logotransparan.png">
</head>

<body>

	<button onclick="downloadimage()" class="btn btn-sm btn-success mt-4 ml-4">
		<i class="fa fa-print mr-2" aria-hidden="true"></i>
		Download Gambar
	</button>

	<div id="htmltoimage" style="padding:40px">
		<table width="100%">
			<tr>
				<td><img src="<?= base_url() ?>assets/landingpage/img/logo transparan with text.png" width="150px" alt=""></td>
				<td style="width: 70%">
					<p style="float:right">
						<i>Dicetak menggunakan E-catalog UNPAD pada tanggal
							<?php
							date_default_timezone_set('Asia/Jakarta');
							echo date('d-m-Y  H:i:s');
							?>
						</i>
					</p>
				</td>
			</tr>
		</table>

		<br>
		<br>

		<p style="margin-left:20px"><b style="color:black">Informasi Paket</b></p>
		<hr>
		<center>
			<table id="example1" class="table-striped" width="85%" cellpadding="10">
				<tr>
					<td>Etalase Produk</td>
					<td><b style="color:black"><?= $paket->nama_etalase ?></b></td>
					<td>Tanggal Buat</td>
					<td>
						<b style="color:black">
							<?= tanggal($tanggal_invoice->tanggal ?? 'now') ?>
						</b>
					</td>
				</tr>
				<tr>
					<td>ID Paket</td>
					<td><b style="color:black"><?= $paket->id_paket ?></b></td>
					<td>Tanggal Kirim</td>
					<td>
						<b style="color:black">
							<?= tanggal($data_kontrak->tanggal_mulai) . ' s.d. ' . tanggal($data_kontrak->tanggal_akhir); ?>
						</b>
					</td>
				</tr>
				<tr>
					<td width="20%">Nama Paket</td>
					<td width="25%"><b style="color:black"><?= $paket->nama_paket ?></b></td>
					<td width="20%">Uraian Pekerjaan</td>
					<td width="35%"><b style="color:black"><?= $paket->uraian_pekerjaan ?></b></td>
				</tr>
				<tr>
					<td>Jumlah Produk</td>
					<td><b style="color:black"><?= $paket->jumlahproduk ?></b></td>
					<td colspan="2"><b>Daftar Pesanan Produk</b></td>
				</tr>
				<tr>
					<td>Harga Total (+PPN)</td>
					<td>
						<?php if (empty($negosiasi)) : ?>
							<?php $harga_total = $paket->total + $paket->total * 0.11 ?>
							<b style="color:black"><?= rupiah($harga_total); ?></b>
						<?php else : ?>
							<?php $harga_total = $negosiasi->nominal + $negosiasi->nominal * 0.11 ?>
							<b style="color:black"><?= rupiah($harga_total); ?></b>
						<?php endif; ?>
					</td>
					<td colspan="2" rowspan="2">
						<ul>
							<?php foreach ($produk as $p) : ?>
								<?php $unit = $p->unit_pengukutan ?? 'pcs' ?>
								<li><?= $p->kuantitas . ' ' . $unit ?> <?= $p->nama_produk ?> ( <?= $p->kuantitas ?> <?= $p->unit_pengukuran ?> )</li>
							<?php endforeach; ?>
						</ul>
					</td>
				</tr>
				<tr>
					<td></td>
					<td>
						<?php
						function penyebut($nilai)
						{
							$nilai = abs($nilai);
							$huruf = array("", "satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas");
							$temp = "";
							if ($nilai < 12) {
								$temp = " " . $huruf[$nilai];
							} else if ($nilai < 20) {
								$temp = penyebut($nilai - 10) . " belas";
							} else if ($nilai < 100) {
								$temp = penyebut($nilai / 10) . " puluh" . penyebut($nilai % 10);
							} else if ($nilai < 200) {
								$temp = " seratus" . penyebut($nilai - 100);
							} else if ($nilai < 1000) {
								$temp = penyebut($nilai / 100) . " ratus" . penyebut($nilai % 100);
							} else if ($nilai < 2000) {
								$temp = " seribu" . penyebut($nilai - 1000);
							} else if ($nilai < 1000000) {
								$temp = penyebut($nilai / 1000) . " ribu" . penyebut($nilai % 1000);
							} else if ($nilai < 1000000000) {
								$temp = penyebut($nilai / 1000000) . " juta" . penyebut($nilai % 1000000);
							} else if ($nilai < 1000000000000) {
								$temp = penyebut($nilai / 1000000000) . " milyar" . penyebut(fmod($nilai, 1000000000));
							} else if ($nilai < 1000000000000000) {
								$temp = penyebut($nilai / 1000000000000) . " trilyun" . penyebut(fmod($nilai, 1000000000000));
							}
							return $temp;
						}

						function terbilang($nilai)
						{
							if ($nilai < 0) {
								$hasil = "minus " . trim(penyebut($nilai));
							} else {
								$hasil = trim(penyebut($nilai));
							}
							return $hasil;
						}
						?>
						<i style="text-transform:capitalize"><?= terbilang($harga_total); ?></i>
					</td>
				</tr>
			</table>
		</center>
		<br><br><br>
		<table class="table">
			<tr>
				<thead>
					<th width="33%">PUMK/Pemesan</th>
					<th width="33%">PP</th>
					<th width="33%">Penyedia</th>
				</thead>
				<tbody>
					<td>
						<b><?= $data_kontrak->nama_pumk ?></b><br>
						<?= $data_kontrak->jabatan_pumk ?> <br>
						<?= $data_kontrak->alamat_pumk ?>
					</td>
					<td>
						<b><?= $data_kontrak->nama_pp ?></b> <br>
						<?= $data_kontrak->jabatan_pp ?> <br>
						Jl. Raya Bandung Sumedang KM.21, Hegarmanah, Kec. Jatinangor, Kabupaten Sumedang, Jawa Barat 45363
					</td>
					<td>
						<b><?= $data_kontrak->nama_penyedia ?></b><br>
						<?= $data_kontrak->nama_perusahaan ?> <br>
						<?= $data_kontrak->alamat_penyedia ?> <br>
					</td>
				</tbody>
			</tr>
		</table>
	</div>

	<script src="<?= base_url() ?>assets/dashboard/dist/js/html2canvas.js"></script>
	<script type="text/javascript">
		function downloadimage() {
			var container = document.getElementById("htmltoimage");

			html2canvas(container, {
				allowTaint: true
			}).then(function(canvas) {

				var link = document.createElement("a");
				document.body.appendChild(link);
				link.download = "Invoice <?= $paket->nama_paket; ?>";
				link.href = canvas.toDataURL();
				link.target = "_blank";
				link.click();

			});
		}
	</script>
</body>

</html>