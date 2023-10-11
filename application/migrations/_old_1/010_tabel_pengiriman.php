<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Migration_Tabel_Pengiriman extends CI_Migration
{
	public function up()
	{
		echo PHP_EOL."--- Migrasi 10 ---".PHP_EOL;

		// Buat tabel pengiriman
		$this->dbforge->add_field('id_pemesanan INT(9) AUTO_INCREMENT NOT NULL PRIMARY KEY');
		$this->dbforge->add_field('nama_pemesan VARCHAR(255) NOT NULL');
		$this->dbforge->add_field('jabatan VARCHAR(255) NOT NULL');
		$this->dbforge->add_field('NIP VARCHAR(50) NOT NULL');
		$this->dbforge->add_field('email VARCHAR(255) NOT NULL');
		$this->dbforge->add_field('no_sertifikat VARCHAR(255) NOT NULL');
		$this->dbforge->add_field('komoditas VARCHAR(255) NOT NULL');
		$this->dbforge->add_field('nama_paket VARCHAR(255) NOT NULL');
		$this->dbforge->add_field('tahun_anggaran DATE NOT NULL');
		$this->dbforge->add_field('jenis_instansi VARCHAR(50) NOT NULL');
		$this->dbforge->add_field('instansi VARCHAR(255) NOT NULL');
		$this->dbforge->add_field('satuan_kerja VARCHAR(255) NOT NULL');
		$this->dbforge->add_field('npwp VARCHAR(255) NOT NULL');
		$this->dbforge->add_field('provinsi_sk VARCHAR(255) NOT NULL COMMENT "satuan kerja"');
		$this->dbforge->add_field('kota_sk VARCHAR(255) NOT NULL COMMENT "satuan kerja"');
		$this->dbforge->add_field('alamat_sk VARCHAR(511) NOT NULL COMMENT "satuan kerja"');
		$this->dbforge->add_field('provinsi VARCHAR(255) NOT NULL COMMENT "pengirim"');
		$this->dbforge->add_field('kota VARCHAR(255) NOT NULL COMMENT "pengirim"');
		$this->dbforge->add_field('alamat VARCHAR(511) NOT NULL COMMENT "pengirim"');
		$this->dbforge->add_field('sumber_dana VARCHAR(50) NOT NULL');
		$this->dbforge->add_field('kode_anggaran VARCHAR(50) NOT NULL');
		$this->dbforge->add_field('id_paket INT(9) NOT NULL');
		$this->dbforge->add_field('id_anggaran INT(9) NOT NULL');
		$this->dbforge->add_field('CONSTRAINT FOREIGN KEY (id_paket) REFERENCES paket(id_paket)');
		$this->dbforge->add_field('CONSTRAINT FOREIGN KEY (id_anggaran) REFERENCES anggaran(id_anggaran)');
		$this->dbforge->create_table('pengiriman');
		echo "Tabel pengiriman dibuat!".PHP_EOL;
	}

	public function down()
	{
		echo PHP_EOL."--- Migrasi 10 ---".PHP_EOL;

		$this->dbforge->drop_table('pengiriman', TRUE);
		echo "Tabel pengiriman dihapus!".PHP_EOL;
	}
}
