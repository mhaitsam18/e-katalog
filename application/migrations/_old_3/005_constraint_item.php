<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Migration_Constraint_Item extends CI_Migration
{
	public function up()
	{
		echo PHP_EOL."--- Migrasi 5 ---".PHP_EOL;

		$this->db->query('ALTER TABLE user 
			ADD CONSTRAINT email UNIQUE KEY(email)');
		echo "Ubah email menjadi unique di tabel user berhasil!".PHP_EOL;
	}

	public function down()
	{
		echo PHP_EOL."--- Migrasi 5 ---".PHP_EOL;

		$this->db->query('ALTER TABLE user DROP CONSTRAINT email');
		echo "Hapus constraint email di tabel user berhasil!".PHP_EOL;
	}
}
