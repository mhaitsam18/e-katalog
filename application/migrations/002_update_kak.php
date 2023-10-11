<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Migration_Update_Kak extends CI_Migration
{
	public function up()
	{
		echo PHP_EOL."--- Migrasi 2 ---".PHP_EOL;

		$this->db->query('ALTER TABLE keranjang 
			DROP FOREIGN KEY keranjang_ibfk_4,
			DROP COLUMN id_kak');
		echo "Kolom `id_kak` dihapus di tabel keranjang".PHP_EOL;

		$this->db->query('ALTER TABLE paket
			ADD COLUMN receipt VARCHAR(50),
			ADD COLUMN id_kak INT(9) NOT NULL,
			ADD FOREIGN KEY (id_kak) REFERENCES kak(id_kak)');
		echo "Tambah `id_kak` dan `receipt` di tabel paket".PHP_EOL;
	}

	public function down()
	{
		echo PHP_EOL."--- Migrasi 2 ---".PHP_EOL;

		$this->db->query('ALTER TABLE keranjang
			ADD COLUMN id_kak INT(9) NOT NULL,
			ADD FOREIGN KEY (id_kak) REFERENCES kak(id_kak)');
		echo "Tambah `id_kak` di tabel keranjang".PHP_EOL;

		$this->db->query('ALTER TABLE paket 
			DROP FOREIGN KEY paket_ibfk_3,
			DROP COLUMN id_kak,
			DROP COLUMN receipt');
		echo "Kolom `id_kak` dan `receipt` dihapus di tabel paket".PHP_EOL;
	}
}
