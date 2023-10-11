<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Migration_Create_Tabel_Kontak extends CI_Migration
{
	public function up()
	{
		echo PHP_EOL." --- Migrasi 4 --- ".PHP_EOL;

		// Buat tabel kontak
		$this->dbforge->add_field(['key' => ['type' => 'VARCHAR', 'constraint' => 50, 'unique' => TRUE]]);
		$this->dbforge->add_field('value VARCHAR(300)');
		$this->dbforge->create_table('kontak', TRUE);
		echo "Tabel `kontak` dibuat!".PHP_EOL;
	}

	public function down()
	{
		echo PHP_EOL." --- Migrasi 4 --- ".PHP_EOL;

		$this->dbforge->drop_table('kontak', TRUE);
		echo "Tabel `kontak` dihapus!" . PHP_EOL;
	}
}
