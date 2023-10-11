<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Migration_Nullitas_Tanggal extends CI_Migration
{
	/**
	 * Hapus attribute NOT NULL pada field tanggal
	 */
	public function up()
	{
		echo PHP_EOL."--- Migrasi 7 ---".PHP_EOL;

		$this->db->query('ALTER TABLE berita MODIFY COLUMN tanggal DATETIME DEFAULT NOW()');
		echo "Tabel berita berhasil di-update!".PHP_EOL;

		$this->db->query('ALTER TABLE paket MODIFY COLUMN tanggal DATETIME DEFAULT NOW()');
		echo "Tabel paket berhasil di-update!".PHP_EOL;

		$this->db->query('ALTER TABLE unduhan MODIFY COLUMN tanggal DATETIME DEFAULT NOW()');
		echo "Tabel unduhan berhasil di-update!".PHP_EOL;
	}

	public function down()
	{
		echo PHP_EOL."--- Migrasi 7 ---".PHP_EOL;

		$this->db->query('ALTER TABLE berita MODIFY COLUMN tanggal DATETIME NOT NULL DEFAULT NOW()');
		echo "Tabel berita berhasil di-update!".PHP_EOL;

		$this->db->query('ALTER TABLE paket MODIFY COLUMN tanggal DATETIME NOT NULL DEFAULT NOW()');
		echo "Tabel paket berhasil di-update!".PHP_EOL;

		$this->db->query('ALTER TABLE unduhan MODIFY COLUMN tanggal DATETIME NOT NULL DEFAULT NOW()');
		echo "Tabel unduhan berhasil di-update!".PHP_EOL;
	}
}
