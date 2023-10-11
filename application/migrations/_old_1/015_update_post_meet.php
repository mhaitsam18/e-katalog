<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Migration_Update_Post_Meet extends CI_Migration
{
	public function up()
	{
		echo PHP_EOL."--- Migrasi 15 ---".PHP_EOL;
	
		// Buat ulang tabel riwayat_produk
		$this->dbforge->drop_table('riwayat_produk', TRUE);
		echo "Tabel riwayat_produk dihapus".PHP_EOL;

		$this->dbforge->add_field('id_produk INT(9) NOT NULL');
		$this->dbforge->add_field('aksi VARCHAR(255) NOT NULL');
		$this->dbforge->add_field('tanggal DATETIME DEFAULT NOW()');
		$this->dbforge->add_field('nama_produk VARCHAR(255)');
		$this->dbforge->add_field('harga INT UNSIGNED');
		$this->dbforge->add_field('masa_berlaku DATE');
		$this->dbforge->add_field('merk VARCHAR(255)');
		$this->dbforge->add_field('no_produk_penyedia VARCHAR(255)');
		$this->dbforge->add_field('unit_pengukuran VARCHAR(100)');
		$this->dbforge->add_field('kode_kbki VARCHAR(100)');
		$this->dbforge->add_field('nilai_tkdn decimal(3,2)');
		$this->dbforge->add_field('stok INT');
		$this->dbforge->add_field('deskripsi TEXT');
		$this->dbforge->add_field('foto VARCHAR(100)');
		$this->dbforge->add_field('id_etalase INT(9)');
		$this->dbforge->add_field('id_penyedia INT(9)');
		$this->dbforge->create_table('riwayat_produk');
		echo "Tabel riwayat_produk dibuat!".PHP_EOL;


		// Update triggers
		$this->db->query('
			CREATE TRIGGER IF NOT EXISTS after_delete_produk
			AFTER DELETE ON produk FOR EACH ROW
			BEGIN
				INSERT INTO riwayat_produk
				(id_produk, aksi, tanggal, nama_produk, harga, masa_berlaku, merk, no_produk_penyedia, unit_pengukuran, kode_kbki, nilai_tkdn, stok, deskripsi, foto, id_etalase, id_penyedia)
				VALUE
				(OLD.id_produk, "produk dihapus", NOW(), OLD.nama_produk, OLD.harga, OLD.masa_berlaku, OLD.merk, OLD.no_produk_penyedia, OLD.unit_pengukuran, OLD.kode_kbki, OLD.nilai_tkdn, OLD.stok, OLD.deskripsi, OLD.foto, OLD.id_etalase, OLD.id_penyedia);
			END
		');
		echo "Trigger after_delete_produk dibuat!" . PHP_EOL;

		$this->_drop_triggers();

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

				IF NOT OLD.nama_produk <=> NEW.nama_produk THEN 
					SET nama_produk = NEW.nama_produk;
					SET aksi = CONCAT(aksi, "nama_produk, ");
				END IF;

				IF NOT OLD.harga <=> NEW.harga THEN 
					SET harga = NEW.harga;
					SET aksi = CONCAT(aksi, "harga, ");
				END IF;

				IF NOT OLD.masa_berlaku <=> NEW.masa_berlaku THEN 
					SET masa_berlaku = NEW.masa_berlaku;
					SET aksi = CONCAT(aksi, "masa_berlaku, ");
				END IF;

				IF NOT OLD.merk <=> NEW.merk THEN 
					SET merk = NEW.merk;
					SET aksi = CONCAT(aksi, "merk, ");
				END IF;

				IF NOT OLD.no_produk_penyedia <=> NEW.no_produk_penyedia THEN 
					SET no_produk_penyedia = NEW.no_produk_penyedia;
					SET aksi = CONCAT(aksi, "no_produk_penyedia, ");
				END IF;

				IF NOT OLD.unit_pengukuran <=> NEW.unit_pengukuran THEN 
					SET unit_pengukuran = NEW.unit_pengukuran;
					SET aksi = CONCAT(aksi, "unit_pengukuran, ");
				END IF;

				IF NOT OLD.kode_kbki <=> NEW.kode_kbki THEN 
					SET kode_kbki = NEW.kode_kbki;
					SET aksi = CONCAT(aksi, "kode_kbki, ");
				END IF;

				IF NOT OLD.nilai_tkdn <=> NEW.nilai_tkdn THEN 
					SET nilai_tkdn = NEW.nilai_tkdn;
					SET aksi = CONCAT(aksi, "nilai_tkdn, ");
				END IF;

				IF NOT OLD.stok <=> NEW.stok THEN 
					SET stok = NEW.stok;
					SET aksi = CONCAT(aksi, "stok, ");
				END IF;

				IF NOT OLD.deskripsi <=> NEW.deskripsi THEN 
					SET deskripsi = NEW.deskripsi;
					SET aksi = CONCAT(aksi, "deskripsi, ");
				END IF;

				IF NOT OLD.foto <=> NEW.foto THEN 
					SET foto = NEW.foto;
					SET aksi = CONCAT(aksi, "foto, ");
				END IF;

				IF NOT OLD.id_etalase <=> NEW.id_etalase THEN 
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

		$this->db->query('
			CREATE TRIGGER IF NOT EXISTS after_update_riwayat_ns
			AFTER UPDATE ON negosiasi_spesifikasi FOR EACH ROW
			BEGIN
				DECLARE aksi VARCHAR(255) DEFAULT "Ubah ";
				DECLARE spesifikasi VARCHAR(255);
				DECLARE nilai VARCHAR(255);
				DECLARE catatan_pembeli VARCHAR(2000);

				IF NOT OLD.spesifikasi <=> NEW.spesifikasi THEN 
					SET spesifikasi = NEW.spesifikasi;
					SET aksi = CONCAT(aksi, "spesifikasi, ");
				END IF;

				IF NOT OLD.nilai <=> NEW.nilai THEN 
					SET nilai = NEW.nilai;
					SET aksi = CONCAT(aksi, "nilai, ");
				END IF;

				IF NOT OLD.catatan_pembeli <=> NEW.catatan_pembeli OR OLD.catatan_pembeli IS NULL THEN 
					SET catatan_pembeli = NEW.catatan_pembeli;
					SET aksi = CONCAT(aksi, "catatan_pembeli, ");
				END IF;

				INSERT INTO riwayat_ns
				(`id_ns`, `aksi`, `tanggal`, `spesifikasi`, `nilai`, `catatan_pembeli`)
				VALUE
				(OLD.id_ns, aksi, NOW(), spesifikasi, nilai, catatan_pembeli);
			END
		');
		echo "Trigger after_update_riwayat_ns dibuat!" . PHP_EOL;

		$this->db->query('
			CREATE TRIGGER IF NOT EXISTS after_update_riwayat_nh
			AFTER UPDATE ON negosiasi_harga FOR EACH ROW
			BEGIN
				DECLARE aksi VARCHAR(255) DEFAULT "Ubah ";
				DECLARE nominal INT(11);
				DECLARE ongkir INT(11);
				DECLARE tanggal_pengiriman DATETIME;
				DECLARE catatan_pembeli VARCHAR(2000);

				IF NOT OLD.nominal <=> NEW.nominal THEN 
					SET nominal = NEW.nominal;
					SET aksi = CONCAT(aksi, "nominal, ");
				END IF;

				IF NOT OLD.ongkir <=> NEW.ongkir THEN 
					SET ongkir = NEW.ongkir;
					SET aksi = CONCAT(aksi, "ongkir, ");
				END IF;

				IF NOT OLD.tanggal_pengiriman <=> NEW.tanggal_pengiriman THEN 
					SET tanggal_pengiriman = NEW.tanggal_pengiriman;
					SET aksi = CONCAT(aksi, "tanggal_pengiriman, ");
				END IF;

				IF NOT OLD.catatan_pembeli <=> NEW.catatan_pembeli OR OLD.catatan_pembeli IS NULL THEN 
					SET catatan_pembeli = NEW.catatan_pembeli;
					SET aksi = CONCAT(aksi, "catatan_pembeli, ");
				END IF;

				INSERT INTO riwayat_nh
				(`id_nh`, `aksi`, `tanggal`, `nominal`, `ongkir`, `tanggal_pengiriman`, `catatan_pembeli`)
				VALUE
				(OLD.id_nh, aksi, NOW(), nominal, ongkir, tanggal_pengiriman, catatan_pembeli);
			END
		');
		echo "Trigger after_update_riwayat_nh dibuat!" . PHP_EOL;

		$this->db->query('
			CREATE TRIGGER IF NOT EXISTS after_update_paket
			AFTER UPDATE ON paket FOR EACH ROW
			BEGIN
				DECLARE aksi VARCHAR(255) DEFAULT "Ubah ";
				DECLARE id_ppk INT;
				DECLARE no_anggaran VARCHAR(50);
				DECLARE status TINYINT;

				IF NOT OLD.id_ppk <=> NEW.id_ppk THEN 
					SET id_ppk = NEW.id_ppk;
					SET aksi = CONCAT(aksi, "id_ppk, ");
				END IF;

				IF NOT OLD.no_anggaran <=> NEW.no_anggaran THEN 
					SET no_anggaran = NEW.no_anggaran;
					SET aksi = CONCAT(aksi, "no_anggaran, ");
				END IF;

				IF NOT OLD.status <=> NEW.status THEN 
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
	}

	public function down()
	{
		echo PHP_EOL."--- Migrasi 15 ---".PHP_EOL;

		$this->_drop_triggers();

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

		$this->db->query('
			CREATE TRIGGER IF NOT EXISTS after_update_riwayat_ns
			AFTER UPDATE ON negosiasi_spesifikasi FOR EACH ROW
			BEGIN
				DECLARE aksi VARCHAR(255) DEFAULT "Ubah ";
				DECLARE spesifikasi VARCHAR(255);
				DECLARE nilai VARCHAR(255);
				DECLARE catatan_pembeli VARCHAR(2000);

				IF OLD.spesifikasi <> NEW.spesifikasi THEN 
					SET spesifikasi = NEW.spesifikasi;
					SET aksi = CONCAT(aksi, "spesifikasi, ");
				END IF;

				IF OLD.nilai <> NEW.nilai THEN 
					SET nilai = NEW.nilai;
					SET aksi = CONCAT(aksi, "nilai, ");
				END IF;

				IF OLD.catatan_pembeli <> NEW.catatan_pembeli OR OLD.catatan_pembeli IS NULL THEN 
					SET catatan_pembeli = NEW.catatan_pembeli;
					SET aksi = CONCAT(aksi, "catatan_pembeli, ");
				END IF;

				INSERT INTO riwayat_ns
				(`id_ns`, `aksi`, `tanggal`, `spesifikasi`, `nilai`, `catatan_pembeli`)
				VALUE
				(OLD.id_ns, aksi, NOW(), spesifikasi, nilai, catatan_pembeli);
			END
		');
		echo "Trigger after_update_riwayat_ns dibuat!" . PHP_EOL;

		$this->db->query('
			CREATE TRIGGER IF NOT EXISTS after_update_riwayat_nh
			AFTER UPDATE ON negosiasi_harga FOR EACH ROW
			BEGIN
				DECLARE aksi VARCHAR(255) DEFAULT "Ubah ";
				DECLARE nominal INT(11);
				DECLARE ongkir INT(11);
				DECLARE tanggal_pengiriman DATETIME;
				DECLARE catatan_pembeli VARCHAR(2000);

				IF OLD.nominal <> NEW.nominal THEN 
					SET nominal = NEW.nominal;
					SET aksi = CONCAT(aksi, "nominal, ");
				END IF;

				IF OLD.ongkir <> NEW.ongkir THEN 
					SET ongkir = NEW.ongkir;
					SET aksi = CONCAT(aksi, "ongkir, ");
				END IF;

				IF OLD.tanggal_pengiriman <> NEW.tanggal_pengiriman THEN 
					SET tanggal_pengiriman = NEW.tanggal_pengiriman;
					SET aksi = CONCAT(aksi, "tanggal_pengiriman, ");
				END IF;

				IF OLD.catatan_pembeli <> NEW.catatan_pembeli OR OLD.catatan_pembeli IS NULL THEN 
					SET catatan_pembeli = NEW.catatan_pembeli;
					SET aksi = CONCAT(aksi, "catatan_pembeli, ");
				END IF;

				INSERT INTO riwayat_nh
				(`id_nh`, `aksi`, `tanggal`, `nominal`, `ongkir`, `tanggal_pengiriman`, `catatan_pembeli`)
				VALUE
				(OLD.id_nh, aksi, NOW(), nominal, ongkir, tanggal_pengiriman, catatan_pembeli);
			END
		');
		echo "Trigger after_update_riwayat_nh dibuat!" . PHP_EOL;

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


		$this->db->query('DROP TRIGGER IF EXISTS after_delete_produk');
		echo "Trigger after_delete_produk dihapus!" . PHP_EOL;


		$this->dbforge->drop_table('riwayat_produk', TRUE);
		echo "Tabel riwyat_produk dihapus".PHP_EOL;

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
	}


	private function _drop_triggers()
	{
		$this->db->query('DROP TRIGGER IF EXISTS after_update_riwayat_ns');
		echo "Trigger after_update_riwayat_ns dihapus!" . PHP_EOL;

		$this->db->query('DROP TRIGGER IF EXISTS after_update_riwayat_nh');
		echo "Trigger after_update_riwayat_nh dihapus!" . PHP_EOL;

		$this->db->query('DROP TRIGGER IF EXISTS after_update_paket');
		echo "Trigger after_update_paket dihapus!" . PHP_EOL;

		$this->db->query('DROP TRIGGER IF EXISTS after_update_produk');
		echo "Trigger after_update_produk dihapus!" . PHP_EOL;
	}
}
