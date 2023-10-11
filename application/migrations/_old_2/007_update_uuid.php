<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Migration_Update_Uuid extends CI_Migration
{
	public function up()
	{
		echo PHP_EOL."--- Migrasi 7 ---".PHP_EOL;

		$this->db->query('ALTER TABLE po MODIFY id_po VARCHAR(36)');
		echo "Kolom `id_po` diubah menjadi VARCHAR(36) di tabel po".PHP_EOL;

		$this->db->query('ALTER TABLE po MODIFY no_sp VARCHAR(23)');
		echo "Kolom `no_sp` diubah menjadi NULLABLE di tabel po".PHP_EOL;
	}

	public function down()
	{
		echo PHP_EOL."--- Migrasi 7 ---".PHP_EOL;

		$this->db->query('ALTER TABLE po MODIFY id_po BINARY(16)');
		echo "Kolom `id_po` diubah menjadi BINARY(16) di tabel po".PHP_EOL;

		$this->db->query('ALTER TABLE po MODIFY no_sp VARCHAR(23) NOT NULL');
		echo "Kolom `no_sp` diubah menjadi NOT NULLABLE di tabel po".PHP_EOL;
	}
}
