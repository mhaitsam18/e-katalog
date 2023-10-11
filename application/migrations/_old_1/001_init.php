<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Migration_Init extends CI_Migration
{
	/**
	 * Tambah tabel-tabel baru di database e-katalog
	 */
	public function up()
	{
		// Buat tabel kategori_etalase
		$this->dbforge->add_field('id', TRUE);
		$this->dbforge->add_field('nama varchar(100) NOT NULL');
		$this->dbforge->create_table('kategori_etalase');
		echo "Table kategori_etalase created!".PHP_EOL;

		// Buat tabel etalase
		$this->dbforge->add_field('id', TRUE);
		$this->dbforge->add_field('nama varchar(255) NOT NULL');
		$this->dbforge->add_field('id_kategori_etalase INT(9) NOT NULL');
		$this->dbforge->add_field('CONSTRAINT FOREIGN KEY (id_kategori_etalase) REFERENCES kategori_etalase(id)');
		$this->dbforge->create_table('etalase');
		echo "Table etalase created!".PHP_EOL;

		// Buat tabel produk
		$this->dbforge->add_field('id', TRUE);
		$this->dbforge->add_field('nama varchar(255) NOT NULL');
		$this->dbforge->add_field('harga INT UNSIGNED NOT NULL');
		$this->dbforge->add_field('masa_berlaku DATE');
		$this->dbforge->add_field('merk varchar(255) NOT NULL');
		$this->dbforge->add_field('no_produk_penyedia varchar(255)');
		$this->dbforge->add_field('unit_pengukuran varchar(100)');
		$this->dbforge->add_field('kode_kbki varchar(100) NOT NULL');
		$this->dbforge->add_field('nilai_tkdn decimal(3,2)');
		$this->dbforge->add_field('stok INT NOT NULL');
		$this->dbforge->add_field('deskripsi TEXT');
		$this->dbforge->add_field('foto varchar(100)');
		$this->dbforge->add_field('id_etalase INT(9) NOT NULL');
		$this->dbforge->add_field('id_penyedia INT(9) NOT NULL');
		$this->dbforge->add_field('CONSTRAINT FOREIGN KEY (id_etalase) REFERENCES etalase(id)');
		$this->dbforge->create_table('produk');
		echo "Table produk created!".PHP_EOL;

		// Buat tabel lampiran
		$this->dbforge->add_field('id', TRUE);
		$this->dbforge->add_field('nama varchar(255) NOT NULL');
		$this->dbforge->add_field('keterangan TEXT');
		$this->dbforge->add_field('id_produk INT(9) NOT NULL');
		$this->dbforge->add_field('CONSTRAINT FOREIGN KEY (id_produk) REFERENCES produk(id)');
		$this->dbforge->create_table('lampiran');
		echo "Table lampiran created!".PHP_EOL;

		// Buat tabel meta_produk
		$this->dbforge->add_field('id', TRUE);
		$this->dbforge->add_field('spesifikasi varchar(255) NOT NULL');
		$this->dbforge->add_field('nilai varchar(255) NOT NULL');
		$this->dbforge->add_field('id_produk INT(9) NOT NULL');
		$this->dbforge->add_field('CONSTRAINT FOREIGN KEY (id_produk) REFERENCES produk(id)');
		$this->dbforge->create_table('meta_produk');
		echo "Table meta_produk created!".PHP_EOL;

		// Buat tabel tawaran
		$this->dbforge->add_field('id', TRUE);
		$this->dbforge->add_field('nominal INT UNSIGNED NOT NULL');
		$this->dbforge->add_field('status VARCHAR(25) NOT NULL');
		$this->dbforge->add_field('tanggal DATETIME NOT NULL DEFAULT NOW()');
		$this->dbforge->add_field('id_produk INT(9) NOT NULL');
		$this->dbforge->add_field('id_pbj INT(9) NOT NULL');
		$this->dbforge->add_field('CONSTRAINT FOREIGN KEY (id_produk) REFERENCES produk(id)');
		$this->dbforge->create_table('tawaran');
		echo "Table tawaran created!".PHP_EOL;

		// Buat tabel keranjang
		$this->dbforge->add_key('id_produk', TRUE);
		$this->dbforge->add_key('id_pbj', TRUE);
		$this->dbforge->add_field('id_produk INT(9) NOT NULL');
		$this->dbforge->add_field('id_pbj INT(9) NOT NULL');
		$this->dbforge->add_field('kuantitas INT NOT NULL');
		// $this->dbforge->add_field('id', TRUE);
		$this->dbforge->add_field('CONSTRAINT FOREIGN KEY (id_produk) REFERENCES produk(id)');
		$this->dbforge->create_table('keranjang');
		echo "Table keranjang created!".PHP_EOL;

		// Buat tabel paket
		$this->dbforge->add_key('id_produk', TRUE);
		$this->dbforge->add_key('id_pbj', TRUE);
		$this->dbforge->add_field('id_produk INT(9) NOT NULL');
		$this->dbforge->add_field('id_pbj INT(9) NOT NULL');
		$this->dbforge->add_field('status TINYINT NOT NULL DEFAULT 0');
		$this->dbforge->add_field('tanggal DATETIME NOT NULL DEFAULT NOW()');
		$this->dbforge->add_field('CONSTRAINT FOREIGN KEY (id_produk) REFERENCES produk(id)');
		$this->dbforge->create_table('paket');
		echo "Table paket created!".PHP_EOL;

		// Buat tabel kategori_unduhan
		$this->dbforge->add_field('id', TRUE);
		$this->dbforge->add_field('nama varchar(100) NOT NULL');
		$this->dbforge->create_table('kategori_unduhan');
		echo "Table kategori_unduhan created!".PHP_EOL;

		// Buat tabel unduhan
		$this->dbforge->add_field('id', TRUE);
		$this->dbforge->add_field('nama varchar(255) NOT NULL');
		$this->dbforge->add_field('tanggal DATETIME NOT NULL DEFAULT NOW()');
		$this->dbforge->add_field('kapasitas INT NOT NULL');
		$this->dbforge->add_field('id_kategori_unduhan INT(9) NOT NULL');
		$this->dbforge->add_field('CONSTRAINT FOREIGN KEY (id_kategori_unduhan) REFERENCES kategori_unduhan(id)');
		$this->dbforge->create_table('unduhan');
		echo "Table unduhan created!".PHP_EOL;

		// Buat tabel pengumuman
		$this->dbforge->add_field('id', TRUE);
		$this->dbforge->add_field('judul varchar(255) NOT NULL');
		$this->dbforge->add_field('jumlah_penawaran INT DEFAULT 0');
		$this->dbforge->add_field('syarat_ketentuan TEXT');
		$this->dbforge->add_field('dok_pengumuman varchar(255)');
		$this->dbforge->add_field('id_etalase INT(9) NOT NULL');
		$this->dbforge->add_field('CONSTRAINT FOREIGN KEY (id_etalase) REFERENCES etalase(id)');
		$this->dbforge->create_table('pengumuman');
		echo "Table pengumuman created!".PHP_EOL;

		// Buat tabel tahapan_pengumuman
		$this->dbforge->add_field('id', TRUE);
		$this->dbforge->add_field('judul varchar(255) NOT NULL');
		$this->dbforge->add_field('tanggal_mulai DATE');
		$this->dbforge->add_field('tanggal_akhir DATE');
		$this->dbforge->add_field('perubahan varchar(255)');
		$this->dbforge->add_field('id_pengumuman INT(9) NOT NULL');
		$this->dbforge->add_field('CONSTRAINT FOREIGN KEY (id_pengumuman) REFERENCES pengumuman(id)');
		$this->dbforge->create_table('tahapan_pengumuman');
		echo "Table tahapan_pengumuman created!".PHP_EOL;

		// Buat tabel merek
		$this->dbforge->add_field('id', TRUE);
		$this->dbforge->add_field('nama varchar(255) NOT NULL');
		$this->dbforge->add_field('deskripsi varchar(255)');
		$this->dbforge->add_field('id_pengumuman INT(9) NOT NULL');
		$this->dbforge->add_field('id_etalase INT(9) NOT NULL');
		$this->dbforge->add_field('CONSTRAINT FOREIGN KEY (id_pengumuman) REFERENCES pengumuman(id)');
		$this->dbforge->add_field('CONSTRAINT FOREIGN KEY (id_etalase) REFERENCES etalase(id)');
		$this->dbforge->create_table('merek');
		echo "Table merek created!".PHP_EOL;
		
		// Buat tabel kategori_berita
		$this->dbforge->add_field('id', TRUE);
		$this->dbforge->add_field('nama varchar(100) NOT NULL');
		$this->dbforge->create_table('kategori_berita');
		echo "Table kategori_berita created!".PHP_EOL;

		// Buat tabel berita
		$this->dbforge->add_field('id', TRUE);
		$this->dbforge->add_field('judul varchar(255) NOT NULL');
		$this->dbforge->add_field('body TEXT NOT NULL');
		$this->dbforge->add_field('penulis varchar(255) NOT NULL');
		$this->dbforge->add_field('tanggal DATETIME NOT NULL DEFAULT NOW()');
		$this->dbforge->add_field('gambar varchar(100)');
		$this->dbforge->add_field('id_kategori_berita INT(9) NOT NULL');
		$this->dbforge->add_field('CONSTRAINT FOREIGN KEY (id_kategori_berita) REFERENCES kategori_berita(id)');
		$this->dbforge->create_table('berita');
		echo "Table berita created!".PHP_EOL;

		// Buat tabel favorit
		$this->dbforge->add_field('id', TRUE);
		$this->dbforge->add_field('id_pbj INT(9) NOT NULL');
		$this->dbforge->add_field('id_produk INT(9) NOT NULL');
		$this->dbforge->add_field('CONSTRAINT FOREIGN KEY (id_produk) REFERENCES produk(id)');
		$this->dbforge->create_table('favorit');
		echo "Table favorit created!".PHP_EOL;
	}

	/**
	 * Hapus semua tabel yang telah dibuat di atas
	 */
	public function down()
	{
		$this->dbforge->drop_table('unduhan', TRUE);
		$this->dbforge->drop_table('kategori_unduhan', TRUE);

		$this->dbforge->drop_table('merek', TRUE);
		$this->dbforge->drop_table('tahapan_pengumuman', TRUE);
		$this->dbforge->drop_table('pengumuman', TRUE);

		$this->dbforge->drop_table('berita', TRUE);
		$this->dbforge->drop_table('kategori_berita', TRUE);

		$this->dbforge->drop_table('favorit', TRUE);
		
		$this->dbforge->drop_table('keranjang', TRUE);
		$this->dbforge->drop_table('paket', TRUE);
		$this->dbforge->drop_table('tawaran', TRUE);
		$this->dbforge->drop_table('meta_produk', TRUE);
		$this->dbforge->drop_table('lampiran', TRUE);
		$this->dbforge->drop_table('produk', TRUE);
		$this->dbforge->drop_table('etalase', TRUE);
		$this->dbforge->drop_table('kategori_etalase', TRUE);

		echo "All table dropped!".PHP_EOL;
	}
}
