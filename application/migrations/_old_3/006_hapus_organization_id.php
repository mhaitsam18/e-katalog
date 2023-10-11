<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Migration_Hapus_Organization_Id extends CI_Migration
{
	public function up()
	{
		echo PHP_EOL."--- Migrasi 6 ---".PHP_EOL;

		$this->db->query('ALTER TABLE item DROP COLUMN organization_id');
		echo "Hapus kolom organization_id di tabel item berhasil!".PHP_EOL;
	}

	public function down()
	{
		echo PHP_EOL."--- Migrasi 6 ---".PHP_EOL;

		$this->db->query('ALTER TABLE item ADD COLUMN organization_id VARCHAR(3) DEFAULT NULL');
		echo "Tambah kolom organization_id di tabel item berhasil!".PHP_EOL;
	}
}
