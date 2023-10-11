<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Migration_Post_Meet extends CI_Migration
{
	public function up()
	{
		echo PHP_EOL."--- Migrasi 14 ---".PHP_EOL;

		$this->dbforge->drop_table('dummy_ppk', TRUE);
		echo "Tabel dummy_ppk dihapus!".PHP_EOL;

		$this->dbforge->drop_table('dummy_penyedia', TRUE);
		echo "Tabel dummy_penyedia dihapus!".PHP_EOL;

		// Buat tabel dummy_penyedia, table sementara untuk penyedia
		$this->dbforge->add_field('id_penyedia INT(9) NOT NULL AUTO_INCREMENT PRIMARY KEY');
		$this->dbforge->add_field('nama_penyedia VARCHAR(255)');
		$this->dbforge->add_field('alamat VARCHAR(255)');
		$this->dbforge->create_table('dummy_penyedia');
		echo "Tabel dummy_penyedia dibuat!".PHP_EOL;


		// Ubah-ubah tabel paket: drop constraint, ubah nama kolom, update trigger, ubah riwayat paket
		$this->db->query('ALTER TABLE paket DROP CONSTRAINT paket_ibfk_1');
		echo "Hubungan paket ke anggaran dihapus!".PHP_EOL;

		$this->db->query('ALTER TABLE paket CHANGE COLUMN id_anggaran no_anggaran VARCHAR(50) DEFAULT NULL');
		echo "Ubah kolom id_anggaran menjadi no_anggaran di tabel paket".PHP_EOL;

		$this->_dropTrigger();

		$this->db->query('ALTER TABLE riwayat_paket CHANGE COLUMN id_anggaran no_anggaran VARCHAR(50) DEFAULT NULL');
		echo "Ubah kolom id_anggaran menjadi no_anggaran di tabel riwayat_paket".PHP_EOL;

		$this->db->query('
			CREATE TRIGGER IF NOT EXISTS after_insert_paket
			AFTER INSERT ON paket FOR EACH ROW
			BEGIN
				INSERT INTO riwayat_paket
				(id_paket, aksi, tanggal, id_ppk, no_anggaran, status)
				VALUE
				(NEW.id_paket, "Paket dibuat", NOW(), NEW.id_ppk, NEW.no_anggaran, NEW.status);
			END
		');
		echo "Trigger after_insert_paket dibuat!" . PHP_EOL;

		$this->db->query('
			CREATE TRIGGER IF NOT EXISTS after_update_paket
			AFTER UPDATE ON paket FOR EACH ROW
			BEGIN
				DECLARE aksi VARCHAR(255) DEFAULT "Ubah ";
				DECLARE id_ppk INT;
				DECLARE no_anggaran VARCHAR(50);
				DECLARE status TINYINT;

				IF OLD.id_ppk <> NEW.id_ppk THEN 
					SET id_ppk = NEW.id_ppk;
					SET aksi = CONCAT(aksi, "id_ppk, ");
				END IF;

				IF OLD.no_anggaran <> NEW.no_anggaran THEN 
					SET no_anggaran = NEW.no_anggaran;
					SET aksi = CONCAT(aksi, "no_anggaran, ");
				END IF;

				IF OLD.status <> NEW.status THEN 
					SET status = NEW.status;
					SET aksi = CONCAT(aksi, "status");
				END IF;

				INSERT INTO riwayat_paket
				(`id_paket`, `aksi`, `tanggal`, `id_ppk`, `no_anggaran`, `status`)
				VALUE
				(OLD.id_paket, aksi, NOW(), id_ppk, no_anggaran, status);
			END
		');
		echo "Trigger after_update_paket dibuat!" . PHP_EOL;


		// Ubah-ubah tabel pengiriman
		$this->db->query('ALTER TABLE pengiriman DROP CONSTRAINT pengiriman_ibfk_2');
		echo "Hubungan pengiriman ke anggaran dihapus!".PHP_EOL;

		$this->db->query('ALTER TABLE pengiriman 
			DROP COLUMN jabatan,
			DROP COLUMN NIP,
			DROP COLUMN email,
			DROP COLUMN no_sertifikat,
			DROP COLUMN komoditas,
			DROP COLUMN nama_paket,
			DROP COLUMN tahun_anggaran,
			DROP COLUMN jenis_instansi,
			DROP COLUMN instansi,
			DROP COLUMN satuan_kerja,
			DROP COLUMN npwp,
			DROP COLUMN provinsi_sk,
			DROP COLUMN kota_sk,
			DROP COLUMN alamat_sk,
			DROP COLUMN provinsi,
			DROP COLUMN kota,
			DROP COLUMN alamat,
			DROP COLUMN sumber_dana,
			DROP COLUMN kode_anggaran,
			DROP COLUMN id_anggaran
		');
		echo "Banyak kolom di tabel pengiriman dihapus!".PHP_EOL;

		$this->db->query('ALTER TABLE pengiriman CHANGE COLUMN nama_pemesan uraian_pekerjaan VARCHAR(255) NOT NULL');
		echo "Ubah kolom nama_pemesanan menjadi uraian_pekerjaan di tabel pangiriman".PHP_EOL;


		$this->dbforge->drop_table('anggaran', TRUE);
		echo "Tabel anggaran dihapus!".PHP_EOL;


		// Buat tabel riwayat_produk
		$this->dbforge->add_field('id_produk INT(9) NOT NULL');
		$this->dbforge->add_field('aksi VARCHAR(255) NOT NULL');
		$this->dbforge->add_field('tanggal DATETIME DEFAULT NOW()');
		$this->dbforge->add_field('nama_produk VARCHAR(255)');
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
		$this->dbforge->create_table('riwayat_produk');
		echo "Tabel riwayat_produk dibuat!".PHP_EOL;


		$this->db->query('
			CREATE TRIGGER IF NOT EXISTS after_insert_produk
			AFTER INSERT ON produk FOR EACH ROW
			BEGIN
				INSERT INTO riwayat_produk
				(id_produk, aksi, tanggal, nama_produk, harga, masa_berlaku, merk, no_produk_penyedia, unit_pengukuran, kode_kbki, nilai_tkdn, stok, deskripsi, foto, id_etalase)
				VALUE
				(NEW.id_produk, "produk dibuat", NOW(), NEW.nama_produk, NEW.harga, NEW.masa_berlaku, NEW.merk, NEW.no_produk_penyedia, NEW.unit_pengukuran, NEW.kode_kbki, NEW.nilai_tkdn, NEW.stok, NEW.deskripsi, NEW.foto, NEW.id_etalase);
			END
		');
		echo "Trigger after_insert_produk dibuat!" . PHP_EOL;

		$this->db->query('
			CREATE TRIGGER IF NOT EXISTS after_update_produk
			AFTER UPDATE ON produk FOR EACH ROW
			BEGIN
				DECLARE aksi VARCHAR(255) DEFAULT "Ubah ";
				DECLARE nama_produk VARCHAR(255);
				DECLARE harga INT(10);
				DECLARE masa_berlaku DATE;
				DECLARE merk VARCHAR(255);
				DECLARE no_produk_penyedia VARCHAR(255);
				DECLARE unit_pengukuran VARCHAR(100);
				DECLARE kode_kbki VARCHAR(100);
				DECLARE nilai_tkdn DECIMAL(3,2);
				DECLARE stok INT(11);
				DECLARE deskripsi TEXT;
				DECLARE foto VARCHAR(100);
				DECLARE id_etalase INT(9);

				IF OLD.nama_produk <> NEW.nama_produk THEN 
					SET nama_produk = NEW.nama_produk;
					SET aksi = CONCAT(aksi, "nama_produk, ");
				END IF;

				IF OLD.harga <> NEW.harga THEN 
					SET harga = NEW.harga;
					SET aksi = CONCAT(aksi, "harga, ");
				END IF;

				IF OLD.masa_berlaku <> NEW.masa_berlaku THEN 
					SET masa_berlaku = NEW.masa_berlaku;
					SET aksi = CONCAT(aksi, "masa_berlaku");
				END IF;

				IF OLD.merk <> NEW.merk THEN 
					SET merk = NEW.merk;
					SET aksi = CONCAT(aksi, "merk");
				END IF;

				IF OLD.no_produk_penyedia <> NEW.no_produk_penyedia THEN 
					SET no_produk_penyedia = NEW.no_produk_penyedia;
					SET aksi = CONCAT(aksi, "no_produk_penyedia");
				END IF;

				IF OLD.unit_pengukuran <> NEW.unit_pengukuran THEN 
					SET unit_pengukuran = NEW.unit_pengukuran;
					SET aksi = CONCAT(aksi, "unit_pengukuran");
				END IF;

				IF OLD.kode_kbki <> NEW.kode_kbki THEN 
					SET kode_kbki = NEW.kode_kbki;
					SET aksi = CONCAT(aksi, "kode_kbki");
				END IF;

				IF OLD.nilai_tkdn <> NEW.nilai_tkdn THEN 
					SET nilai_tkdn = NEW.nilai_tkdn;
					SET aksi = CONCAT(aksi, "nilai_tkdn");
				END IF;

				IF OLD.stok <> NEW.stok THEN 
					SET stok = NEW.stok;
					SET aksi = CONCAT(aksi, "stok");
				END IF;

				IF OLD.deskripsi <> NEW.deskripsi THEN 
					SET deskripsi = NEW.deskripsi;
					SET aksi = CONCAT(aksi, "deskripsi");
				END IF;

				IF OLD.foto <> NEW.foto THEN 
					SET foto = NEW.foto;
					SET aksi = CONCAT(aksi, "foto");
				END IF;

				IF OLD.id_etalase <> NEW.id_etalase THEN 
					SET id_etalase = NEW.id_etalase;
					SET aksi = CONCAT(aksi, "id_etalase");
				END IF;

				INSERT INTO riwayat_produk
				(`id_produk`, `aksi`, `tanggal`, `nama_produk`, `harga`, `masa_berlaku`, `merk`, `no_produk_penyedia`, `unit_pengukuran`, `kode_kbki`, `nilai_tkdn`, `stok`, `deskripsi`, `foto`, `id_etalase`)
				VALUE
				(OLD.id_produk, aksi, NOW(), nama_produk, harga, masa_berlaku, merk, no_produk_penyedia, unit_pengukuran, kode_kbki, nilai_tkdn, stok, deskripsi, foto, id_etalase);
			END
		');
		echo "Trigger after_update_produk dibuat!" . PHP_EOL;
	}

	public function down()
	{
		echo PHP_EOL."--- Migrasi 14 ---".PHP_EOL;

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


		// Buat tabel anggaran
		$this->dbforge->add_field('id_anggaran', TRUE);
		$this->dbforge->add_field('nama_pr VARCHAR(255) NOT NULL');
		$this->dbforge->add_field('nominal INT(11) NOT NULL');
		$this->dbforge->add_field('tahun DATE NOT NULL');
		$this->dbforge->add_field('instansi VARCHAR(255) NOT NULL');
		$this->dbforge->add_field('jenis_instansi VARCHAR(50) NOT NULL');
		$this->dbforge->add_field('satuan_kerja VARCHAR(255) NOT NULL');
		$this->dbforge->create_table('anggaran');
		echo "Tabel anggaran dibuat!".PHP_EOL;


		$this->db->query('TRUNCATE TABLE paket');
		echo "Isi tabel paket dihapus!".PHP_EOL;

		$this->db->query('TRUNCATE TABLE pengiriman');
		echo "Isi tabel pengiriman dihapus!".PHP_EOL;


		$this->db->query('ALTER TABLE paket CHANGE COLUMN no_anggaran id_anggaran INT(9) NOT NULL');
		echo "Ubah kolom no_anggaran menjadi id_anggaran di tabel paket".PHP_EOL;

		$this->db->query('ALTER TABLE paket ADD FOREIGN KEY (id_anggaran) REFERENCES anggaran (id_anggaran)');
		echo "Hubungan paket ke anggaran dibuat!".PHP_EOL;

		$this->_dropTrigger();

		$this->db->query('ALTER TABLE riwayat_paket CHANGE COLUMN no_anggaran id_anggaran INT(9) DEFAULT NULL');
		echo "Ubah kolom no_anggaran menjadi id_anggaran di tabel riwayat_paket".PHP_EOL;

		$this->db->query('
			CREATE TRIGGER IF NOT EXISTS after_insert_paket
			AFTER INSERT ON paket FOR EACH ROW
			BEGIN
				INSERT INTO riwayat_paket
				(id_paket, aksi, tanggal, id_ppk, id_anggaran, status)
				VALUE
				(NEW.id_paket, "Paket dibuat", NOW(), NEW.id_ppk, NEW.id_anggaran, NEW.status);
			END
		');
		echo "Trigger after_insert_paket dibuat!" . PHP_EOL;

		$this->db->query('
			CREATE TRIGGER IF NOT EXISTS after_update_paket
			AFTER UPDATE ON paket FOR EACH ROW
			BEGIN
				DECLARE aksi VARCHAR(255) DEFAULT "Ubah ";
				DECLARE id_ppk INT;
				DECLARE id_anggaran INT;
				DECLARE status TINYINT;

				IF OLD.id_ppk <> NEW.id_ppk THEN 
					SET id_ppk = NEW.id_ppk;
					SET aksi = CONCAT(aksi, "id_ppk, ");
				END IF;

				IF OLD.id_anggaran <> NEW.id_anggaran THEN 
					SET id_anggaran = NEW.id_anggaran;
					SET aksi = CONCAT(aksi, "id_anggaran, ");
				END IF;

				IF OLD.status <> NEW.status THEN 
					SET status = NEW.status;
					SET aksi = CONCAT(aksi, "status");
				END IF;

				INSERT INTO riwayat_paket
				(`id_paket`, `aksi`, `tanggal`, `id_ppk`, `id_anggaran`, `status`)
				VALUE
				(OLD.id_paket, aksi, NOW(), id_ppk, id_anggaran, status);
			END
		');
		echo "Trigger after_update_paket dibuat!" . PHP_EOL;


		$this->dbforge->drop_table('pengiriman', TRUE);
		echo "Tabel pengiriman dihapus!".PHP_EOL;

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


		$this->dbforge->drop_table('riwayat_produk', TRUE);
		echo "Tabel riwayat_produk dihapus!".PHP_EOL;

		$this->db->query('DROP TRIGGER IF EXISTS after_update_produk');
		echo "Trigger after_update_produk dihapus!" . PHP_EOL;

		$this->db->query('DROP TRIGGER IF EXISTS after_insert_produk');
		echo "Trigger after_insert_produk dihapus!" . PHP_EOL;
	}

	private function _dropTrigger()
	{
		$this->db->query('DROP TRIGGER IF EXISTS after_update_paket');
		echo "Trigger after_update_paket dihapus!" . PHP_EOL;

		$this->db->query('DROP TRIGGER IF EXISTS after_insert_paket');
		echo "Trigger after_insert_paket dihapus!" . PHP_EOL;
	}
}
