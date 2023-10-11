<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Migration_Unduhan_Anggaran extends CI_Migration
{

	/**
	 * Tambah tabel anggaran dan kolom file di tabel unduhan
	 */
	public function up()
	{
		echo PHP_EOL."--- Migrasi 3 ---".PHP_EOL;

		// Buat tabel anggaran
		$this->dbforge->add_field('id', TRUE);
		$this->dbforge->add_field('nama_pr VARCHAR(255) NOT NULL');
		$this->dbforge->add_field('nominal INT(11) NOT NULL');
		$this->dbforge->add_field('tahun DATE NOT NULL');
		$this->dbforge->add_field('instansi VARCHAR(255) NOT NULL');
		$this->dbforge->add_field('jenis_instansi VARCHAR(50) NOT NULL');
		$this->dbforge->add_field('satuan_kerja VARCHAR(255) NOT NULL');
		$this->dbforge->create_table('anggaran');
		echo "Tabel anggaran dibuat!".PHP_EOL;

		// Update tabel unduhan
		$this->db->query('ALTER TABLE unduhan ADD COLUMN file VARCHAR(255) NOT NULL');
		echo "Tambah kolom file di tabel unduhan berhasil!".PHP_EOL;
	}

	/**
	 * Hapus tabel anggaran dan kolom file di tabel unduhan
	 */
	public function down()
	{
		echo PHP_EOL."--- Migrasi 3 ---".PHP_EOL;

		$this->db->query('ALTER TABLE unduhan DROP COLUMN file');
		echo "Hapus kolom file di tabel unduhan berhasil!".PHP_EOL;
		
		$this->dbforge->drop_table('anggaran', TRUE);
		echo "Tabel anggaran dihapus!".PHP_EOL;
	}
}
