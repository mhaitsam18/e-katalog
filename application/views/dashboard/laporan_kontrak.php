<!DOCTYPE html>
<html lang="id">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Draft Kontrak | E-Katalog UNPAD</title>
	<link rel="shortcut icon" href="<?= base_url() ?>assets/landingpage/img/logotransparan.png">
</head>

<body>
	<button onclick="Export2Doc('exportContent', <?= 'Kontrak Paket ' . $data_kontrak->nama_paket ?>);" style="margin:1rem 1rem 2rem 1rem; font-size: 1.2rem; background: #0DB432; cursor: pointer;color:white;padding:10px;border-radius:4px;border:0">Export &rarr;</button>

	<div id="exportContent">
		<style>
			table {
				border-collapse: collapse;
			}

			table td {
				padding: 8px;
			}

			table#dense td {
				padding: 4px;
			}
		</style>
		<table width="100%">
			<tr>
				<td><img src="<?= base_url(); ?>assets/landingpage/img/logounpad_kecil.png" width="120px;"></td>
				<td style="text-align: center;">
					<span style="margin-bottom: 8px;font-size: 18px;font-weight: normal;">
						KEMENTERIAN PENDIDIKAN, KEBUDAYAAN RISET, DAN TEKNOLOGI
					</span>
					<br>
					<span style="margin-bottom: 8px;font-size: 16px;font-weight: bold;">UNIVERSITAS PADJADJARAN</span>
					<p style="margin-bottom: 0;">Jalan Dipati Ukur No. 35 Bandung 40132
						Jalan Ir. Soekarno Km. 21 Jatinangor, Sumedang 45363
						Telepon (022) 84288888 Laman: www.unpad.ac.id, Email:humas@unpad.ac.id
					</p>
				</td>
			</tr>
		</table>
		<hr style="height: 2px;background: black;">
		<table width="100%">
			<tr>
				<td style="text-align: center; border: 1px solid black;">
					<b>SURAT PESANAN (SP)</b><br>
					<?= $data_kontrak->nama_paket ?>
				</td>
				<td style="border: 1px solid black;">
					<b>NOMOR DAN TANGGAL SP</b> <br>
					Nomor &nbsp;&nbsp;: <?= $data_kontrak->no_sp ?><br>
					Tanggal &nbsp;: <?= tanggal($tanggal_kontrak->tanggal ?? 'now') ?>
				</td>
			</tr>
		</table>
		<table width="100%" style="border: 1px solid black;" id="dense">
			<tr>
				<td colspan="3">
					Yang bertanda tangan dibawah ini
				</td>
			</tr>
			<tr>
				<td style="width: 20%;">Nama</td>
				<td style="width: 10px;">:</td>
				<td><?= $data_kontrak->nama_pk ?></td>
			</tr>
			<tr>
				<td style="width: 20%;">Jabatan</td>
				<td style="width: 10px;">:</td>
				<td>Pembuat Komitmen</td>
			</tr>
			<tr>
				<td style="width: 20%;">Alamat Kantor</td>
				<td style="width: 10px;">:</td>
				<td>Jalan Raya Bandung-Sumedang KM 21 Jatinangor</td>
			</tr>
			<tr>
				<td colspan="3">Selanjutnya disebut sebagai <b>PIHAK PERTAMA;</b></td>
			</tr>
			<tr>
				<td style="width: 20%;">Nama</td>
				<td style="width: 10px;">:</td>
				<td><?= $data_kontrak->nama_penyedia ?></td>
			</tr>
			<?php if (!empty($data_kontrak->nama_perusahaan)) : ?>
				<tr>
					<td style="width: 20%;">Jabatan</td>
					<td style="width: 10px;">:</td>
					<td><?= $data_kontrak->nama_perusahaan ?></td>
				</tr>
			<?php endif; ?>
			<tr>
				<td style="width: 20%;">Alamat Kantor</td>
				<td style="width: 10px;">:</td>
				<td><?= $data_kontrak->alamat_penyedia ?></td>
			</tr>
			<tr>
				<td colspan="3">Selanjutnya disebut sebagai <b>PIHAK KEDUA;</b>
					<br> untuk melaksanakan pekerjaan dengan memperhatikan ketentuan-ketentuan sebagai berikut :
				</td>
			</tr>
		</table>
		<br>
		<table width="100%" border="1">
			<thead>
				<td>No</td>
				<td>Nama Barang</td>
				<td>Kuantitas</td>
				<td>Satuan</td>
				<td>Harga Satuan</td>
				<td>Harga Nego</td>
				<td>Total</td>
			</thead>
			<tbody>
				<?php $i = 1;
				$total = 0; ?>
				<?php foreach ($keranjang as $data) : ?>
					<tr>
						<td><?= $i++; ?></td>
						<td><?= $data->nama_produk; ?></td>
						<td><?= $data->kuantitas; ?></td>
						<td><?= $data->unit_pengukuran ?? '-'; ?></td>
						<td><?= rupiah($data->harga); ?></td>
						<td><?= rupiah($data->harga); ?></td>
						<td><?= rupiah($data->harga * $data->kuantitas); ?></td>
						<?php $total += $data->harga * $data->kuantitas ?>
					</tr>
				<?php endforeach; ?>
				<tr>
					<td colspan="6" style="text-align: right">Jumlah</td>
					<td><?= rupiah($total) ?></td>
				</tr>
				<tr>
					<td colspan="6" style="text-align: right">PPN</td>
					<td>
						<?php
						$hitung = $total * 0.11;
						echo rupiah($hitung);
						?>
					</td>
				</tr>
				<tr>
					<td colspan="6" style="text-align: right">Jumlah Total</td>
					<td>
						<?php
						$itung = $total + $hitung;
						echo rupiah($itung);
						?>
					</td>
				</tr>
				<tr>
					<td colspan="6">
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
						Terbilang: <i style="text-transform:capitalize"><?= terbilang($itung); ?></i></td>
				</tr>
				<?php if (!empty($negosiasi)) : ?>
					<tr>
						<td colspan="4" style="text-align: right">Hasil Negosiasi</td>
						<?php $last_nego = end($negosiasi); ?>
						<?php $nego_harga = $last_nego->nominal + $last_nego->nominal * 0.11 ?>
						<td><?= rupiah($nego_harga) ?></td>
					</tr>
					<tr>
						<td colspan="6">
							Terbilang: <i style="text-transform:capitalize"><?= terbilang($nego_harga); ?></i>
						</td>
					</tr>
				<?php endif; ?>
			</tbody>
		</table>

		<br>

		<?php if (!empty($negosiasi)) : ?>
			<table border="1" width="100%">
				<tr>
					<th colspan="2">History Nego</th>
				</tr>
				<tr>
					<th>Tanggal</th>
					<th>Harga Nego</th>
				</tr>
				<?php foreach ($negosiasi as $nego) : ?>
					<tr>
						<td><?= tanggal($nego->tanggal); ?></td>
						<td><?= rupiah($nego->nominal); ?></td>
					</tr>
				<?php endforeach; ?>
			</table>
		<?php endif; ?>

		<br>

		<table width="100%" style="border: 1px solid black;">
			<tr>
				<td>
					<b>SYARAT DAN KETENTUAN :</b>
				</td>
			</tr>
			<tr>
				<td>
					<?php
					if (!empty($data_kontrak->tanggal_mulai) && !empty($data_kontrak->tanggal_akhir)) {
						$unix_diff = strtotime($data_kontrak->tanggal_akhir) - strtotime($data_kontrak->tanggal_mulai);
						$selisih_hari = abs(round($unix_diff / (24 * 60 * 60)));

						$selisih_hari += 1;
					}
					?>
					<ol style="margin: 0;">
						<li>Waktu Pelaksanaan Pekerjaan : selama <?= $selisih_hari; ?> (<?= trim(penyebut($selisih_hari)) ?>) hari kalender terhitung dari tanggal
							<?= tanggal($data_kontrak->tanggal_mulai); ?> sampai tanggal <?= tanggal($data_kontrak->tanggal_akhir) ?></li>
						<li>Alamat Pengiriman Barang : <?= $data_kontrak->alamat_kirim ?></li>
						<li>Pembayaran : pembayaran dilakukan dengan pembayaran secara <?= $data_kontrak->jenis_pembayaran ?? '<i>sekaligus/Termin/Bulanan</i>'  ?>; dan
							dipotong denda (apabila ada) dan pajak. Pembayaran tersebut akan dibayarkan melalui transfer ke
							Bank <?= $data_kontrak->bank ?> dengan nomor rekening <?= $data_kontrak->norek ?> atas nama <?= $data_kontrak->nama_perusahaan ?>. </li>
						<li>Denda Keterlambatan: sebesar 1/1000 (satu perseribu) dari sebagian total harga SP yang belum
							terselesaikan untuk setiap hari keterlambatan.</li>
					</ol>
				</td>
			</tr>
		</table>

		<br>
		<table width="100%" style="text-align: center">
			<tr>
				<td style="border: 1px solid black; border-bottom: none;">PIHAK PERTAMA</td>
				<td style="border: 1px solid black; border-bottom: none;">PIHAK KEDUA</td>
			</tr>
			<tr>
				<td style="border-left: 1px solid black; border-right: 1px solid black;height: 64px;"></td>
				<td style="border-left: 1px solid black; border-right: 1px solid black;height: 64px;"></td>
			</tr>
			<tr>
				<td style="border-left: 1px solid black; border-right: 1px solid black;"><?= $data_kontrak->nama_pk ?></td>
				<td style="border-left: 1px solid black; border-right: 1px solid black;"><?= $data_kontrak->nama_penyedia ?></td>
			</tr>
			<tr>
				<td style="border: 1px solid black; border-top: none;">Pembuat Komitmen</td>
				<td style="border: 1px solid black; border-top: none;"><?= $data_kontrak->nama_perusahaan ?? '' ?></td>
			</tr>
		</table>
	</div>
	<script>
		function Export2Doc(element, filename = '') {
			var preHtml = "<html xmlns:o'urn:schemas-microsoft-com:office:office;xmlns:w='urn:schemas-microsoft-com:office:word'";
			var postHtml = "</body></html>";
			var html = preHtml + document.getElementById(element).innerHTML + postHtml;

			var blob = new Blob(['\ufeff', html], {
				type: 'application/msword'
			});

			var url = 'data:application/vnd.ms-word;charset=utf-8,' + encodeURIComponent(html);

			filename = filename ? filename + '.doc' : 'document.doc';

			var downloadLink = document.createElement("a");

			document.body.appendChild(downloadLink);

			if (navigator.msSaveOrOpenBlob) {
				navigator.msSaveOrOpenBlob(blob, filename);
			} else {
				downloadLink.href = url;

				downloadLink.download = filename;

				downloadLink.click();
			}

			document.body.removeChild(downloadLink);
		}
	</script>
</body>

</html>