<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Migration_Tambah_Kolom_Alamat extends CI_Migration
{
	public function up()
	{
		echo PHP_EOL."--- Migrasi 2 ---".PHP_EOL;

		$this->db->query('ALTER TABLE pengiriman ADD COLUMN alamat VARCHAR(511) NOT NULL');
		echo "Tambah kolom `alamat` di tabel pengiriman".PHP_EOL;
	}

	public function down()
	{
		echo PHP_EOL."--- Migrasi 2 ---".PHP_EOL;

		$this->db->query('ALTER TABLE pengiriman DROP COLUMN alamat');
		echo "Kolom `alamat` di tabel pengiriman dihapus!".PHP_EOL;
	}
}
