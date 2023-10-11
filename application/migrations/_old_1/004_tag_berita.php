<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Migration_Tag_Berita extends CI_Migration
{
	public function up()
	{
		echo PHP_EOL."--- Migrasi 4 ---".PHP_EOL;

		// Buat tabel tags
		$this->dbforge->add_field('id_berita INT(9) NOT NULL');
		$this->dbforge->add_field('tag VARCHAR(50) NOT NULL');
		$this->dbforge->add_field('CONSTRAINT FOREIGN KEY (id_berita) REFERENCES berita(id)');
		$this->dbforge->create_table('tags');
		echo "Tabel tags dibuat!".PHP_EOL;
	}

	public function down()
	{
		echo PHP_EOL."--- Migrasi 4 ---".PHP_EOL;

		$this->dbforge->drop_table('tags', TRUE);
		echo "Tabel tags dihapus!".PHP_EOL;
	}
}
