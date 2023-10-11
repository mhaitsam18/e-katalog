<!DOCTYPE html>
<html lang="id">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="robots" content="noindex">

	<title>Kerangka Acuan Kerja | E-Katalog UNPAD</title>
	<link rel="shortcut icon" href="<?= base_url() ?>assets/landingpage/img/logotransparan.png">
</head>

<body>
	<button onclick="Export2Doc('exportContent', 'Kerangka Acuan Kerja <?= $kak->nama_paket ?>');" style="margin:1rem 1rem 2rem 1rem; font-size: 1.2rem; background: #0DB432; cursor: pointer;color:white;padding:10px;border-radius:4px;border:0">Export
		&rarr;</button>
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
				<td><img src="<?= base_url(); ?>assets/landingpage/img/kopsurat.png" width="150px;"></td>
				<td style="text-align: center;">
					<span style="margin-bottom: 8px;font-size: 18px;font-weight: normal;">
						KEMENTERIAN PENDIDIKAN, KEBUDAYAAN <br> RISET, DAN TEKNOLOGI
					</span>
					<br>
					<span style="font-size: 27px;font-weight: bold;">UNIVERSITAS PADJADJARAN</span>
					<br>
					<span style="margin-bottom: 0;font-weight:bold;">Jln. Ir. Soekarno km. 21 Jatinangor, Kab. Sumedang
						Jawa Barat 45363 <br>
						Telp. (022) 84288889 Laman: www.unpad.ac.id, Email: humas@unpad.ac.id
					</span>
				</td>
			</tr>
		</table>
		<hr style="height: 2px;background: black;">

		<?php
		/**
		 * Tanggal kak
		 * 
		 * Berisi tanggal saat pumk menginputkan nomor pr (status = 1)
		 * atau jika belum diinputkan nomor pr maka berisi tanggal hari ini
		 * 
		 * @var string
		 */
		$tanggal_kak = date('d-m-Y', strtotime($kak->tanggal_buat ?? 'now'));
		?>
		<table width="100%">
			<tr>
				<td colspan="2" style="text-align: center;">
					<b style="font-size:20px"><u>KERANGKA ACUAN KERJA</u></b><br>
					Tanggal &Tab;&Tab;
					<?= $tanggal_kak ?>
				</td>
			</tr>
			<tr>
				<td colspan="2" style="text-align: center;">
					<b>Pekerjaan</b>
					<?= $kak->nama_paket ?>
				</td>
			</tr>
		</table>
		<br>
		<table width="100%" id="dense">
			<tr>
				<td style="width:10px"><b>A.</b></td>
				<td><b>Latar Belakang</b></td>
			</tr>
			<tr>
				<td></td>
				<td>
					<?= $kak->uraian_pekerjaan ?>
					<p style="margin-bottom:30px"></p>
				</td>
			</tr>
			<tr>
				<td style="width:10px"><b>B.</b></td>
				<td><b>Ruang Lingkup Pekerjaan</b></td>
			</tr>
			<tr>
				<td></td>
				<td>
					<ol>
						<li> Volume dan spesifikasi teknis barang sesuai dengan yang disyaratkan;</li>
						<li> Barang dalam keadaan baru dapat berfungsi dengan baik dan dapat digunakan sesuai standar
							yang berlaku;</li>
						<li>
							<?= $kak->ruang_lingkup ?>
						</li>
					</ol>
					<p style="margin-bottom:30px"></p>
				</td>
			</tr>
			<tr>
				<td style="width:10px"><b>C.</b></td>
				<td><b>Sumber Dana dan Perkiraan Biaya</b></td>
			</tr>
			<tr>
				<td></td>
				<td>
					<ol>
						<li> Sumber Dana Pengadaan ini dari Anggaran Universitas Padjadjaran Tahun
							<?= $kak->tahun_anggaran ?>;
						</li>
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
						<li> Harga Perkiraan Sendiri Rp <?= number_format($subtotal->total, 2, ".", ","); ?> (<i style="text-transform:capitalize"><?= terbilang($subtotal->total); ?></i>).</li>
					</ol>
					<p style="margin-bottom:30px"></p>
				</td>
			</tr>
			<tr>
				<td style="width:10px"><b>D.</b></td>
				<td><b>Cara Pelaksanaan/Mekanisme Kegiatan</b></td>
			</tr>
			<tr>
				<td></td>
				<td>
					Pengadaan ini akan dilakukan melalui <a href="http://ekatalog.unpad.ac.id" target="__blank">http://ekatalog.unpad.ac.id</a>
					<p style="margin-bottom:30px"></p>
				</td>
			</tr>
			<tr>
				<td style="width:10px"><b>E.</b></td>
				<td><b>Spesifikasi Teknis dan Volume Barang yang dibutuhkan</b></td>
			</tr>
			<tr>
				<td></td>
				<td>
					<table cellpadding="30px" border="1" width="100%">
						<thead style="background-color:lightgrey">
							<th>No</th>
							<th>Uraian</th>
							<th>Spesifikasi/Merk/Produsen</th>
							<th>Jumlah</th>
						</thead>
						<tbody>
							<?php
							$no = 1;
							foreach ($keranjang as $data) : ?>
								<tr>
									<td>
										<center>
											<?= $no++ ?>.
										</center>
									</td>
									<td>
										<center>
											<?= $data->nama_produk ?>
											<br>
											Penyedia : <?= $data->nama_perusahaan ?>
										</center>
									</td>
									<?php
									// foreach($spesifikasi as $data){
									?>
									<td>
										<ul>
											<li>Merk : <?= $data->merek ?></li>
											<li>Kategori : <?= $data->nama_item ?></li>
											<li>No Produk Penyedia : <?= $data->no_produk_penyedia ?></li>
											<li>Kode KBKI : <?= $data->kode_kbki ?></li>
											<li>Nilai TKDN : <?= $data->nilai_tkdn ?></li>
										</ul>
									</td>
									<?php //}
									?>
									<td>
										<center>
											<?= $data->kuantitas ?>
											<?= $data->unit_pengukuran ?>
										</center>
									</td>
								</tr>
							<?php endforeach; ?>
						</tbody>
					</table>
					<p style="margin-bottom:30px"></p>
				</td>
			</tr>
			<tr>
				<td style="width:10px"><b>F.</b></td>
				<td><b>Tempat Pelaksanaan Kegiatan :</b></td>
			</tr>
			<tr>
				<td></td>
				<td>
					Tempat pelaksanaan kegiatan ini berlokasi di
					<?= $kak->alamat_kirim ?>.
					<p style="margin-bottom:30px"></p>
			</tr>
			<tr>
				<td style="width:10px"><b>F.</b></td>
				<td><b>Jadwal Kegiatan :</b></td>
			</tr>
			<tr>
				<td></td>
				<td>
					<?php $tanggal_mulai = tanggal($kak->tanggal_mulai ?? $kak->tanggal_mulai); ?>
					<?php $tanggal_akhir = tanggal($kak->tanggal_akhir ?? $kak->tanggal_akhir); ?>
					Tanggal waktu pengerjaan:
					<?= $tanggal_mulai ?> s/d
					<?= $tanggal_akhir ?>
					<?php
					$waktu_pengerjaan = '-';

					if (!empty($kak->tanggal_mulai) && !empty($kak->tanggal_akhir)) {
						$unix_diff = strtotime($kak->tanggal_akhir) - strtotime($kak->tanggal_mulai);
						$selisih_hari = abs(round($unix_diff / (24 * 60 * 60))) + 1;

						$waktu_pengerjaan = $selisih_hari;
					}
					?><br>
					Jadwal pelaksanaan pekerjaan
					<?= $waktu_pengerjaan ?> Hari Kalender.
					<p style="margin-bottom:30px"></p>
				</td>
			</tr>
		</table>
		<br>
		<table width="50%" style="text-align: center; float: right;">
			<tr>
				<td>Sumedang
					<?= $tanggal_kak ?> <br>
					Pembuat Komitmen,
				</td>

			</tr>
			<tr>
				<td style="height: 64px;"></td>
			</tr>
			<tr>
				<td>
					<?= $kak->nama_pk ?> <br> NIP
					<?= $kak->nip ?>
				</td>
			</tr>
			<tr>
				<td>
					<br><br><br><br>
				</td>
			</tr>
		</table>
		<br><br><br>

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