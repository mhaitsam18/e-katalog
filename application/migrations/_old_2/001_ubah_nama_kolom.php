<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Migration_Ubah_Nama_Kolom extends CI_Migration
{
	public function up()
	{
		echo PHP_EOL."--- Migrasi 1 ---".PHP_EOL;

		$this->db->query('ALTER TABLE keranjang CHANGE id_pmok id_pmuk INT(9)');
		echo "Kolom `id_pmok` diubah menjadi `id_pmuk` di tabel keranjang".PHP_EOL;

		$this->db->query('ALTER TABLE favorit CHANGE id_pmok id_pmuk INT(9)');
		echo "Kolom `id_pmok` diubah menjadi `id_pmuk` di tabel favorit".PHP_EOL;
	}

	public function down()
	{
		echo PHP_EOL."--- Migrasi 1 ---".PHP_EOL;

		$this->db->query('ALTER TABLE keranjang CHANGE id_pmuk id_pmok INT(9)');
		echo "Kolom `id_pmuk` diubah menjadi `id_pmok` di tabel keranjang".PHP_EOL;

		$this->db->query('ALTER TABLE favorit CHANGE id_pmuk id_pmok INT(9)');
		echo "Kolom `id_pmuk` diubah menjadi `id_pmok` di tabel favorit".PHP_EOL;
	}
}
