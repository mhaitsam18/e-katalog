<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Migration_Tambah_Tabel_Ubah_Nama_Id extends CI_Migration
{
	public function up()
	{
		echo PHP_EOL."--- Migrasi 13 ---".PHP_EOL;

		// Buat tabel dummy_ppk, table sementara untuk ppk
		$this->dbforge->add_field('id_ppk INT(9) NOT NULL AUTO_INCREMENT PRIMARY KEY');
		$this->dbforge->add_field('username VARCHAR(50)');
		$this->dbforge->add_field('nip VARCHAR(50)');
		$this->dbforge->add_field('nama VARCHAR(50)');
		$this->dbforge->add_field('jabatan VARCHAR(50)');
		$this->dbforge->add_field('email VARCHAR(50)');
		$this->dbforge->add_field('telp VARCHAR(24)');
		$this->dbforge->add_field('sertifikat_pbj VARCHAR(50)');
		$this->dbforge->create_table('dummy_ppk');
		echo "Tabel dummy_ppk dibuat!".PHP_EOL;

		// Buat tabel dummy_penyedia, table sementara untuk penyedia
		$this->dbforge->add_field('id_penyedia INT(9) NOT NULL AUTO_INCREMENT PRIMARY KEY');
		$this->dbforge->add_field('username VARCHAR(50)');
		$this->dbforge->add_field('nip VARCHAR(50)');
		$this->dbforge->add_field('nama VARCHAR(50)');
		$this->dbforge->add_field('jabatan VARCHAR(50)');
		$this->dbforge->add_field('email VARCHAR(50)');
		$this->dbforge->add_field('telp VARCHAR(24)');
		$this->dbforge->add_field('sertifikat_pbj VARCHAR(50)');
		$this->dbforge->create_table('dummy_penyedia');
		echo "Tabel dummy_penyedia dibuat!".PHP_EOL;

		$this->db->query('ALTER TABLE pengiriman CHANGE COLUMN id_pemesanan id_pengiriman INT(9) NOT NULL AUTO_INCREMENT');
		echo "Kolom `id_pemesanan` diubah menjadi `id_pengiriman` di tabel pengiriman".PHP_EOL;
	}

	public function down()
	{
		echo PHP_EOL."--- Migrasi 13 ---".PHP_EOL;

		$this->db->query('ALTER TABLE pengiriman CHANGE COLUMN id_pengiriman id_pemesanan INT(9) NOT NULL AUTO_INCREMENT');
		echo "Kolom `id_pengiriman` diubah menjadi `id_pemesanan` di tabel pengiriman".PHP_EOL;

		$this->dbforge->drop_table('dummy_ppk', TRUE);
		echo "Tabel dummy_ppk dihapus!".PHP_EOL;

		$this->dbforge->drop_table('dummy_penyedia', TRUE);
		echo "Tabel dummy_penyedia dihapus!".PHP_EOL;
	}
}
