<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Migration_Tambah_Kolom_Penulis extends CI_Migration
{
	/**
	 * Tambah kolom penulis di tabel berita, pengumuman, unduhan
	 */
	public function up()
	{
		echo PHP_EOL."--- Migrasi 2 ---".PHP_EOL;

		// $this->db->query('ALTER TABLE `berita` ADD penulis VARCHAR(255) NOT NULL');

		$this->db->query('ALTER TABLE `pengumuman` ADD penulis VARCHAR(255) NOT NULL');
		echo "Tambah kolom penulis di tabel pengumuman berhasil!".PHP_EOL;

		$this->db->query('ALTER TABLE `unduhan` ADD penulis VARCHAR(255) NOT NULL');
		echo "Tambah kolom penulis di tabel unduhan berhasil!".PHP_EOL;
	}

	/**
	 * Tambah kolom penulis di tabel berita, pengumuman, unduhan
	 */
	public function down()
	{
		echo PHP_EOL."--- Migrasi 2 ---".PHP_EOL;

		// $this->db->query('ALTER TABLE `berita` DROP COLUMN penulis');

		$this->db->query('ALTER TABLE `pengumuman` DROP COLUMN penulis');
		echo "Hapus kolom penulis di tabel pengumuman berhasil!".PHP_EOL;

		$this->db->query('ALTER TABLE `unduhan` DROP COLUMN penulis');
		echo "Hapus kolom penulis di tabel unduhan berhasil!".PHP_EOL;
	}

}
