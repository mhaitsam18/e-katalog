<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Migration_Update_Skema extends CI_Migration
{
	/**
	 * Tambah tabel: negosiasi_harga, negosiasi_spesifikasi, riwayat_nh, dan riwayat_ns. 
	 * Hapus tabel: tawaran. 
	 * Update tabel: keranjang dan paket.
	 */
	public function up()
	{
		echo PHP_EOL."--- Migrasi 5 ---".PHP_EOL;

		// Update tabel paket
		$this->db->query('ALTER TABLE paket
			ADD id INT(9) AUTO_INCREMENT NOT NULL PRIMARY KEY FIRST,
			ADD id_ppk INT(9) AFTER id,
			DROP FOREIGN KEY paket_ibfk_1,
			DROP COLUMN id_produk,
			ADD id_anggaran INT(9) NOT NULL AFTER id_ppk,
			ADD FOREIGN KEY (id_anggaran) REFERENCES anggaran(id)'
		);
		echo "Tabel paket berhasil di-update!".PHP_EOL;

		// Update tabel keranjang
		$this->db->query('ALTER TABLE keranjang
			ADD id_paket INT(9) AFTER id_pbj,
			ADD FOREIGN KEY (id_paket) REFERENCES paket(id)'
		);
		echo "Tabel keranjang berhasil di-update!".PHP_EOL;

		// Hapus tabel tawaran
		$this->dbforge->drop_table('tawaran', TRUE);
		echo "Tabel tawaran dihapus!".PHP_EOL;

		// Buat tabel negosiasi_harga
		$this->dbforge->add_field('id', TRUE);
		$this->dbforge->add_field('nominal INT(11) UNSIGNED NOT NULL');
		$this->dbforge->add_field('ongkir INT(11) UNSIGNED');
		$this->dbforge->add_field('tanggal_pengiriman DATETIME');
		$this->dbforge->add_field('catatan_pembeli VARCHAR(2000)');
		$this->dbforge->add_field('id_paket INT(9) NOT NULL');
		$this->dbforge->add_field('CONSTRAINT FOREIGN KEY (id_paket) REFERENCES paket(id)');
		$this->dbforge->create_table('negosiasi_harga');
		echo "Tabel negosiasi_harga dibuat!".PHP_EOL;

		// Buat tabel negosiasi_spesifikasi
		$this->dbforge->add_field('id', TRUE);
		$this->dbforge->add_field('spesifikasi VARCHAR(255) NOT NULL');
		$this->dbforge->add_field('nilai VARCHAR(255) NOT NULL');
		$this->dbforge->add_field('catatan_pembeli VARCHAR(2000)');
		$this->dbforge->add_field('id_paket INT(9) NOT NULL');
		$this->dbforge->add_field('CONSTRAINT FOREIGN KEY (id_paket) REFERENCES paket(id)');
		$this->dbforge->create_table('negosiasi_spesifikasi');
		echo "Tabel negosiasi_spesifikasi dibuat!".PHP_EOL;

		// Buat tabel riwayat_paket
		$this->dbforge->add_field('id_paket INT(9) NOT NULL');
		$this->dbforge->add_field('aksi VARCHAR(255) NOT NULL');
		$this->dbforge->add_field('tanggal DATETIME DEFAULT NOW()');
		$this->dbforge->add_field('id_ppk INT(9)');
		$this->dbforge->add_field('id_anggaran INT(9)');
		$this->dbforge->add_field('status TINYINT');
		$this->dbforge->add_field('CONSTRAINT FOREIGN KEY (id_paket) REFERENCES paket(id)');
		$this->dbforge->create_table('riwayat_paket');
		echo "Tabel riwayat_paket dibuat!".PHP_EOL;

		// Buat tabel riwayat_nh, riwayat negosiasi_harga
		$this->dbforge->add_field('id_nh INT(9) NOT NULL COMMENT "id negosiasi_harga"');
		$this->dbforge->add_field('aksi VARCHAR(255) NOT NULL');
		$this->dbforge->add_field('tanggal DATETIME DEFAULT NOW()');
		$this->dbforge->add_field('nominal INT(11) UNSIGNED');
		$this->dbforge->add_field('ongkir INT(11) UNSIGNED');
		$this->dbforge->add_field('tanggal_pengiriman DATETIME');
		$this->dbforge->add_field('catatan_pembeli VARCHAR(2000)');
		$this->dbforge->add_field('catatan_penyedia VARCHAR(2000)');
		$this->dbforge->add_field('CONSTRAINT FOREIGN KEY (id_nh) REFERENCES negosiasi_harga(id)');
		$this->dbforge->create_table('riwayat_nh');
		echo "Tabel riwayat_nh dibuat!".PHP_EOL;

		// Buat tabel riwayat_ns, riwayat negosiasi_spesifikasi
		$this->dbforge->add_field('id_ns INT(9) NOT NULL COMMENT "id negosiasi_spesifikasi"');
		$this->dbforge->add_field('aksi VARCHAR(255) NOT NULL');
		$this->dbforge->add_field('tanggal DATETIME DEFAULT NOW()');
		$this->dbforge->add_field('spesifikasi VARCHAR(255)');
		$this->dbforge->add_field('nilai VARCHAR(255)');
		$this->dbforge->add_field('catatan_pembeli VARCHAR(2000)');
		$this->dbforge->add_field('catatan_penyedia VARCHAR(2000)');
		$this->dbforge->add_field('CONSTRAINT FOREIGN KEY (id_ns) REFERENCES negosiasi_spesifikasi(id)');
		$this->dbforge->create_table('riwayat_ns');
		echo "Tabel riwayat_ns dibuat!".PHP_EOL;
	}

	/**
	 * Hapus tabel: anggaran, negosiasi_harga, dan negosiasi_spesifikasi. 
	 * Hapus isi tabel: keranjang. 
	 * Buat tabel: tawaran. 
	 * Update tabel: keranjang dan paket. 
	 */
	public function down()
	{
		echo PHP_EOL."--- Migrasi 5 ---".PHP_EOL;

		$this->dbforge->drop_table('riwayat_ns', TRUE);
		echo "Tabel riwayat_ns dihapus!".PHP_EOL;

		$this->dbforge->drop_table('riwayat_nh', TRUE);
		echo "Tabel riwayat_nh dihapus!".PHP_EOL;

		$this->dbforge->drop_table('riwayat_paket', TRUE);
		echo "Tabel riwayat_paket dihapus!".PHP_EOL;

		$this->dbforge->drop_table('negosiasi_spesifikasi', TRUE);
		echo "Tabel negosiasi_spesifikasi dihapus!".PHP_EOL;

		$this->dbforge->drop_table('negosiasi_harga', TRUE);
		echo "Tabel negosiasi_harga dihapus!".PHP_EOL;

		// Buat tabel tawaran
		$this->dbforge->add_field('id', TRUE);
		$this->dbforge->add_field('nominal INT UNSIGNED NOT NULL');
		$this->dbforge->add_field('status varchar(25) NOT NULL');
		$this->dbforge->add_field('tanggal DATETIME NOT NULL DEFAULT NOW()');
		$this->dbforge->add_field('id_produk INT(9) NOT NULL');
		$this->dbforge->add_field('id_pbj INT(9) NOT NULL');
		$this->dbforge->add_field('CONSTRAINT FOREIGN KEY (id_produk) REFERENCES produk(id)');
		$this->dbforge->create_table('tawaran', TRUE);
		echo "Tabel tawaran dibuat!".PHP_EOL;

		$this->db->query('TRUNCATE TABLE keranjang');
		echo "Isi tabel keranjang dihapus!".PHP_EOL;
		
		$this->db->query('ALTER TABLE keranjang
			DROP FOREIGN KEY keranjang_ibfk_2,
			DROP COLUMN id_paket'
		);
		echo "Tabel keranjang berhasil di-update!".PHP_EOL;
		
		$this->db->query('TRUNCATE TABLE paket');
		echo "Isi tabel paket dihapus!".PHP_EOL;

		$this->db->query('ALTER TABLE paket
			DROP PRIMARY KEY,
			DROP COLUMN id,
			DROP COLUMN id_ppk,
			DROP FOREIGN KEY paket_ibfk_2,
			DROP COLUMN id_anggaran,
			ADD id_produk INT(9) NOT NULL FIRST,
			ADD FOREIGN KEY (id_produk) REFERENCES produk(id)'
		);
		echo "Tabel paket berhasil di-update!".PHP_EOL;
	}

}
