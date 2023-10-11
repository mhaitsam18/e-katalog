<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Migration_Tabel_Po extends CI_Migration
{
	public function up()
	{
		echo PHP_EOL."--- Migrasi 5 ---".PHP_EOL;

		// Buat tabel po
		$this->dbforge->add_field('id_pemesanan INT(9) AUTO_INCREMENT NOT NULL PRIMARY KEY');
		$this->dbforge->add_field('no_sp VARCHAR(23) NOT NULL');
		$this->dbforge->add_field('id_pbj INT(9)');
		$this->dbforge->add_field('tanggal_mulai DATE');
		$this->dbforge->add_field('tanggal_akhir DATE');
		$this->dbforge->add_field('id_paket INT(9) NOT NULL');
		$this->dbforge->create_table('po', TRUE);
		echo "Table po dibuat!".PHP_EOL;

		$this->db->query('ALTER TABLE po ADD FOREIGN KEY (id_paket) REFERENCES paket (id_paket) ON DELETE CASCADE ON UPDATE CASCADE');
		echo "Hubungan po ke paket dibuat!".PHP_EOL;
	}

	public function down()
	{
		echo PHP_EOL."--- Migrasi 5 ---".PHP_EOL;

		$this->dbforge->drop_table('po', TRUE);
		echo "Hapus tabel po".PHP_EOL;
	}
}
