<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Migration_Constraint_Item extends CI_Migration
{
	public function up()
	{
		echo PHP_EOL."--- Migrasi 3 ---".PHP_EOL;

		$this->db->query('ALTER TABLE item 
			CHANGE COLUMN kategori id_etalase INT(9) NOT NULL,
			ADD FOREIGN KEY (id_etalase) REFERENCES etalase(id_etalase)');
		echo "Ubah kolom kategori menjadi id_etalase di tabel item berhasil!".PHP_EOL;
	}

	public function down()
	{
		echo PHP_EOL."--- Migrasi 3 ---".PHP_EOL;

		$this->db->query('ALTER TABLE item DROP FOREIGN KEY item_ibfk_1');
		echo "Hapus foreign key di tabel item berhasil!".PHP_EOL;

		$this->db->query('ALTER TABLE item CHANGE COLUMN id_etalase kategori VARCHAR(50)');
		echo "Ubah kolom id_etalase menjadi kategori di tabel item berhasil!".PHP_EOL;
	}
}
