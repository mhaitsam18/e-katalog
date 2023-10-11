<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Migration_Tambah_Idppk extends CI_migration
{
	public function up()
	{
		echo PHP_EOL."--- Migrasi 11 ---".PHP_EOL;

		$this->db->query('ALTER TABLE `pengumuman` ADD id_user INT NOT NULL');
		echo "Tambah id_user di tabel pengumuman berhasil!".PHP_EOL;

		$this->db->query('ALTER TABLE `berita` ADD id_user INT NOT NULL');
		echo "Tambah id_user di tabel berita berhasil!".PHP_EOL;

		$this->db->query('ALTER TABLE `unduhan` ADD id_user INT NOT NULL');
		echo "Tambah id_user di tabel unduhan berhasil!".PHP_EOL;
	}

	public function down()
	{
		echo PHP_EOL."--- Migrasi 11 ---".PHP_EOL;

		$this->db->query('ALTER TABLE `pengumuman` DROP id_user');
		echo "Hapus id_user di tabel pengumuman berhasil!".PHP_EOL;

		$this->db->query('ALTER TABLE `berita` DROP id_user');
		echo "Hapus id_user di tabel berita berhasil!".PHP_EOL;

		$this->db->query('ALTER TABLE `unduhan` DROP id_user');
		echo "Hapus id_user di tabel unduhan berhasil!".PHP_EOL;
	}
}
