<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Surat Pesanan Pre Order</title>
	<link rel="shortcut icon" href="<?=base_url()?>assets/landingpage/img/logotransparan.png">
</head>

<body>
	<!-- <button onclick="Export2Doc('exportContent', 'Kontrak Paket');" style="margin:1rem 0; font-size: 1.2rem; background: #0DB432; cursor: pointer;color:white;padding:10px;border-radius:8px;border:0">Export &rarr;</button> -->
	<div id="exportContent">
	<style>
		table {border-collapse: collapse;}
		table td{padding: 8px;}
		table#dense td{padding: 4px;}
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
					<span style="margin-bottom: 0;font-weight:bold;">Jl. Raya Bandung - Sumedang Km.21 Jatinangor 45363 <br>
						Telp. (022) 84288889 Laman: www.unpad.ac.id, Email:riset@unpad.ac.id
					</span>
				</td>
			</tr>
		</table>
		<hr style="height: 2px;background: black;">
		<table width="100%">
			<tr>
				<td colspan="2" style="text-align: center;">
					<b>SURAT PESANAN (SP)</b><br>
					Nomor &Tab;&Tab;: 
					<?php if(!$paket){
						echo "xxxx";
					}else{?>
					<?=$paket->no_sp?>
					<?php }?> <br>
					Tanggal &Tab;&Tab; 	
					<?php if(!$paket){
						echo "xxxx";
					}else{
						$date=date_create($paket->tanggal);
						echo date_format($date,"d/m/Y");
					}?>
				</td>
			</tr>
			<tr>
				<td colspan="2" style="text-align: center;">
					<b>Pekerjaan</b> 
					<?php if(!$paket){
						echo "xxxx";
					}else{?>
					<?=$paket->uraian_pekerjaan?>
					<?php }?>
				</td>
			</tr>
		</table>
		<br>
		<table width="100%" id="dense">
			<tr>
				<td colspan="3">
					Yang bertanda tangan dibawah ini
				</td>
			</tr>
			<tr>
				<td style="width: 20%;">Nama</td>
				<td style="width: 10px;">:</td>
				<td><i style="color:red">>>Nama_Pembuat_Komitmen<<</i></td>
			</tr>
			<tr>
				<td style="width: 20%;">Jabatan</td>
				<td style="width: 10px;">:</td>
				<td>Pembuat Komitmen pada Universitas Padjajaran</td>
			</tr>
			<tr>
				<td style="width: 20%;">Alamat</td>
				<td style="width: 10px;">:</td>
				<td>Jalan Raya Bandung-Sumedang KM 21 Jatinangor</td>
			</tr>
			<tr>
				<td colspan="3">
					<br>	
					selanjutnya disebut sebagai <b>PPK</b>;
					<br>
				</td>
			</tr>
			<tr>
				<td>
					<br>
					bersama ini memerintahkan : 
				</td>
			</tr>
			<tr>
				<td style="width: 20%;">Nama</td>
				<td style="width: 10px;">:</td>
				<td><i style="color:red">>>Nama_Penyedia_Terendah<<</i></td>
			</tr>
			<tr>
				<td style="width: 20%;">Alamat</td>
				<td style="width: 10px;">:</td>
				<td><i style="color:red">>>Alamat_Penyedia_Terendah<<</i></td>
			</tr>
			<tr>
				<td colspan="3">selanjutnya disebut sebagai <b>Penyedia</b>;
					<br> <br>
					untuk segera memulai pelaksanaan pekerjaan dengan memperhatikan ketentuan-ketentuan sebagai berikut :
				</td>
			</tr>
		</table>
		<br>
		<table width="100%">
			<tr>
				<td>1.</td>
				<td><u>Daftar Barang</u>: sebagaimana terlampir;</td>
			</tr>
			<tr>
				<td>2.</td>
				<td><u>Tanggal waktu pengerjaan</u>: 
				<?php if(!$paket){
					echo "xxxx";
				}else{
				$date2 = date_create($paket->tanggal_mulai);
				$date3 = date_create($paket->tanggal_akhir);
				echo date_format($date2,"d/m/Y")?> s/d <?php echo date_format($date3,"d/m/Y")?> + <i style="color:red">>>Jangka_waktu_Pelaksanaan_Pekerjaan<<</i></td>
				<?php }?>
			</tr>
			<tr>
				<td>3.</td>
				<td><u>Waktu penyelesaian</u>: <i style="color:red">>>Jangka_waktu_Pelaksanaan_Pekerjaan<<</i> hari kalender</td>
			</tr>
			<tr>
				<td>4.</td>
				<td><u>Alamat Penyelesaian Pekerjaan</u>: 
				<?php if(!$paket){
						echo "xxxx";
					}else{?>
					<?=$paket->alamat?>
					<?php }?> 
				</td>
			</tr>
			<tr>
				<td>5.</td>
				<td><u>Denda</u>: Terhadap setiap hari keterlambatan penyelesaian pekerjaan Pengadaan Barang akan dikenakan Denda Keterlambatan sebesar 1/1000 (satu per seribu) dari bagian tertentu dari Nilai Kontrak sesuai dengan persyaratan dan ketentuan Kontrak.</td>
			</tr>
			<tr>
				<td><br></td>
			</tr>
			<tr>
				<td></td>
				<td style="float:right;margin-right:90px">Untuk dan atas nama Rektor <br> Pejabat Pembuat Komitmen,</td>
			</tr>
			<tr>
				<td><br><br></td>
			</tr>
			<tr>
				<td></td>
				<td style="float:right;margin-right:60px"><i style="color:red">>>Nama_Pembuat_Komitmen<<</i><br> NIP <i style="color:red">>>NIP_Pembuat_Komitmen<<</i></td>
			</tr>
		</table>
		<br><br><br>

		<hr>
		<table width="100%">
			<tr>
				<td>Lampiran Surat Pesanan (SP) <br>
					No. 
					<?php if(!$paket){
						echo "xxxx";
					}else{?>
					<?=$paket->no_sp?>
					<?php }?> 
					 <br>
					Tanggal 
					<?php if(!$paket){
						echo "xxxx";
					}else{?>
					<?php echo date_format($date,"d/m/Y")?>
					<?php }?> 
				</td>
			</tr>
			<tr>
				<td>Paket Pekerjaan 
					<?php if(!$paket){
						echo "xxxx";
					}else{?>
					<?=$paket->uraian_pekerjaan?>
					<?php }?> 
				</td>
			</tr>

		</table>
		<table width="100%" border="1">
			<tr style="text-align:center">
				<td rowspan="2">No</td>
				<td rowspan="2">Uraian</td>
				<td rowspan="2" colspan="2">Banyaknya</td>
				<td colspan="2">Harga (Rp)</td>
			</tr>
			<tr style="text-align:center">
				<td>Satuan</td>
				<td>Jumlah</td>
			</tr>
			<tbody>
				<?php $i = 1; $total = 0; ?>
				<?php foreach($keranjang as $data): ?>
				<tr>
					<td><?= $i++; ?></td>
					<td>
						<b><?= $data->nama_produk; ?></b>
						<div style="margin: left 10px;">
							<table>
								<tr>
									<td>Foto Produk</td>
									<td>:</td>
									<td>
										<?php if(!$data->foto){?>
											<img src="<?=base_url()?>assets/landingpage/img/dummyproduct.png" alt="Foto Produk"  width="80px">
										<?php }else{?>
											<img src="<?=base_url()?>uploads/foto_produk/<?=$data->foto?>" alt="Foto Produk" width="80px">
										<?php }?>
									</td>
								</tr>
								<tr>
									<td>Merek</td>
									<td>:</td>
									<td><?=$data->merk?></td>
								</tr>
								<tr>
									<td>Masa Berlaku</td>
									<td>:</td>
									<td><?=$data->masa_berlaku?></td>
								</tr>
								<tr>
									<td>No. Produk Penyedia</td>
									<td>:</td>
									<td><?=$data->no_produk_penyedia?></td>
								</tr>
								<tr>
									<td>Kode KBKI</td>
									<td>:</td>
									<td><?=$data->kode_kbki?></td>
								</tr>
								<tr>
									<td>Nilai TKDN</td>
									<td>:</td>
									<td><?=$data->nilai_tkdn?></td>
								</tr>
								<tr>
									<td>Stok</td>
									<td>:</td>
									<td><?=$data->deskripsi?></td>
								</tr>
								<tr>
									<td>Deskripsi</td>
									<td>:</td>
									<td><?=$data->deskripsi?></td>
								</tr>
							</table>
						</div>
					</td>
					<td><?= $data->kuantitas; ?></td>
					<td><?= $data->unit_pengukuran ?? '-'; ?></td>
					<td><?= rupiah($data->harga); ?></td>
					<td><?= rupiah($data->harga * $data->kuantitas); ?></td>
					<?php $total += $data->harga * $data->kuantitas ?>
				</tr>
				<?php endforeach; ?>
				<tr>
					<td colspan="5" style="text-align: right">Jumlah</td>
					<td><?= rupiah($total) ?></td>
				</tr>
				<tr>
					<td colspan="5" style="text-align: right">PPN</td>
					<td></td>
				</tr>
				<tr>
					<td colspan="5" style="text-align: right">Jumlah Total</td>
					<td></td>
				</tr>
				<tr>
					<td colspan="6">
					    <?php
                function penyebut($nilai) {
                $nilai = abs($nilai);
                $huruf = array("", "satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas");
                $temp = "";
                if ($nilai < 12) {
                    $temp = " ". $huruf[$nilai];
                } else if ($nilai <20) {
                    $temp = penyebut($nilai - 10). " belas";
                } else if ($nilai < 100) {
                    $temp = penyebut($nilai/10)." puluh". penyebut($nilai % 10);
                } else if ($nilai < 200) {
                    $temp = " seratus" . penyebut($nilai - 100);
                } else if ($nilai < 1000) {
                    $temp = penyebut($nilai/100) . " ratus" . penyebut($nilai % 100);
                } else if ($nilai < 2000) {
                    $temp = " seribu" . penyebut($nilai - 1000);
                } else if ($nilai < 1000000) {
                    $temp = penyebut($nilai/1000) . " ribu" . penyebut($nilai % 1000);
                } else if ($nilai < 1000000000) {
                    $temp = penyebut($nilai/1000000) . " juta" . penyebut($nilai % 1000000);
                } else if ($nilai < 1000000000000) {
                    $temp = penyebut($nilai/1000000000) . " milyar" . penyebut(fmod($nilai,1000000000));
                } else if ($nilai < 1000000000000000) {
                    $temp = penyebut($nilai/1000000000000) . " trilyun" . penyebut(fmod($nilai,1000000000000));
                }     
                return $temp;
            }
        
            function terbilang($nilai) {
                if($nilai<0) {
                    $hasil = "minus ". trim(penyebut($nilai));
                } else {
                    $hasil = trim(penyebut($nilai));
                }     		
                return $hasil;
            }
        
            $hasil = terbilang($total);
            ?>
					    Terbilang: <i style="text-transform:capitalize"><?=$hasil?></i></td>
				</tr>
			</tbody>
			
		</table>
		<br>
		<br>
		<table width="30%" style="text-align: center;float:right">
			<tr>
				<td>Untuk dan atas nama Rektor <br> Pejabat Pembuat Komitmen,</td>
			</tr>
			<tr>
				<td style="height: 64px;"></td>
			</tr>
			<tr>
				<td><i style="color:red">>>Nama_Pembuat_Komitmen<< <br> NIP <i style="color:red">>>NIP Pembuat Komitmen<<</i></i></td>
			</tr>
			<tr>
				<td>
				<br><br><br><br>
				</td>
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