<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Migration_Update_Uuid extends CI_Migration
{
	public function up()
	{
		echo PHP_EOL."--- Migrasi 1 ---".PHP_EOL;

		$this->db->query('ALTER TABLE po MODIFY id_po VARCHAR(36) NOT NULL');
		echo "Kolom `id_po` diubah menjadi VARCHAR(36) di tabel po".PHP_EOL;
	}

	public function down()
	{
		echo PHP_EOL."--- Migrasi 1 ---".PHP_EOL;

		$this->db->query('ALTER TABLE po MODIFY id_po INT(9) NOT NULL AUTO_INCREMENT');
		echo "Kolom `id_po` diubah menjadi INT(9) di tabel po".PHP_EOL;
	}
}
