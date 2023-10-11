<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Migration_Nama_Perusahaan extends CI_Migration
{
	public function up()
	{
		echo PHP_EOL."--- Migrasi 2 ---".PHP_EOL;

		$this->db->query('ALTER TABLE penyedia 
			ADD COLUMN nama_perusahaan VARCHAR(50),
			ADD COLUMN bank VARCHAR(50),
			ADD COLUMN norek VARCHAR(20)');
		echo "Tambah beberapa kolom di tabel penyedia berhasil!".PHP_EOL;

		$this->db->query('ALTER TABLE po ADD COLUMN jenis_pembayaran VARCHAR(10)');
		echo "Tambah kolom di tabel po berhasil!".PHP_EOL;
	}

	public function down()
	{
		echo PHP_EOL."--- Migrasi 2 ---".PHP_EOL;

		$this->db->query('ALTER TABLE penyedia 
			DROP COLUMN nama_perusahaan,
			DROP COLUMN bank,
			DROP COLUMN norek');
		echo "Hapus beberapa kolom di tabel penyedia berhasil!".PHP_EOL;

		$this->db->query('ALTER TABLE po DROP COLUMN jenis_pembayaran VARCHAR(10)');
		echo "Hapus kolom di tabel po berhasil!".PHP_EOL;
	}
}
