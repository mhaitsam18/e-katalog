<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Migration_Ubah_Nama_Pmok extends CI_Migration
{
	public function up()
	{
		echo PHP_EOL."--- Migrasi 8 ---".PHP_EOL;

		$this->db->query('ALTER TABLE keranjang CHANGE id_pmuk id_pumk INT(9)');
		echo "Kolom `id_pmuk` diubah menjadi `id_pumk` di tabel keranjang".PHP_EOL;

		$this->db->query('ALTER TABLE favorit CHANGE id_pmuk id_pumk INT(9)');
		echo "Kolom `id_pmuk` diubah menjadi `id_pumk` di tabel favorit".PHP_EOL;
	}

	public function down()
	{
		echo PHP_EOL."--- Migrasi 8 ---".PHP_EOL;

		$this->db->query('ALTER TABLE keranjang CHANGE id_pumk id_pmuk INT(9)');
		echo "Kolom `id_pumk` diubah menjadi `id_pmuk` di tabel keranjang".PHP_EOL;

		$this->db->query('ALTER TABLE favorit CHANGE id_pumk id_pmuk INT(9)');
		echo "Kolom `id_pumk` diubah menjadi `id_pmuk` di tabel favorit".PHP_EOL;
	}
}
