<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Migration_Tambah_Kolom_Nama_Paket extends CI_Migration
{
	public function up()
	{
		echo PHP_EOL."--- Migrasi 4 ---".PHP_EOL;

		$this->db->query('ALTER TABLE pengiriman ADD COLUMN nama_paket VARCHAR(255)');
		echo "Tambah kolom `nama_paket` di tabel pengiriman".PHP_EOL;
	}

	public function down()
	{
		echo PHP_EOL."--- Migrasi 4 ---".PHP_EOL;

		$this->db->query('ALTER TABLE pengiriman DROP COLUMN nama_paket');

		echo "Hapus kolom `nama_paket` di tabel pengiriman".PHP_EOL;
	}
}
