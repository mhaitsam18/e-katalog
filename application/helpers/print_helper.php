<?php

if (! function_exists('tanggal'))
{
	/**
	 * Cetak format tanggal dengan d-m-Y
	 * 
	 * @param    string|null    $tanggal     tanggal dr db yg mau dicetak
	 * @return   string
	 */
	function tanggal($tanggal)
	{
		if (! is_null($tanggal) && $tanggal !== '0000-00-00') {
			return date('d-m-Y', strtotime($tanggal));
		}
		
		return '-';
	}
}

if (! function_exists('rupiah'))
{
	/**
	 * Cetak angka dengan format currency rupiah
	 * 
	 * @param    string|int    $angka     angka yang mau diformat
	 * @return   string
	 */
	function rupiah($angka)
	{
		return 'Rp'.number_format($angka, 2, ',', '.');
	}
}

if (! function_exists('status_paket'))
{
	/**
	 * Cetak nama status paket berdasarkan kode paket
	 * 
	 * @param    string|int    $kode     kode status
	 * @return   string
	 */
	function status_paket($kode)
	{
		$status_paket = [
			'Pending', // 0
			'Persetujuan Paket ke PP', // 1
			'Ajukan Negosiasi ke Penyedia', // 2
			'Ajukan Kembali Negosiasi ke PP', // 3
			'Review PP', // 4
			'Pengiriman Paket', // 5
			'Paket Dikirim', // 6
			'Paket Selesai', // 7
			'Paket Ditolak/Dibatalkan', // 8
		];

		return $status_paket[$kode];
	}
}
