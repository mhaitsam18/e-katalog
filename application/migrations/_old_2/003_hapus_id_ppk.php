<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Migration_Hapus_Id_Ppk extends CI_Migration
{
	public function up()
	{
		echo PHP_EOL."--- Migrasi 3 ---".PHP_EOL;

		$this->db->query('ALTER TABLE riwayat_paket DROP COLUMN id_ppk');
		echo "Hapus kolom `id_ppk` di tabel riwayat_paket".PHP_EOL;
	}

	public function down()
	{
		echo PHP_EOL."--- Migrasi 3 ---".PHP_EOL;

		$this->db->query('ALTER TABLE riwayat_paket ADD COLUMN id_ppk INT(9)');
		echo "Tambah kolom `id_ppk` di tabel riwayat_paket".PHP_EOL;
	}
}
