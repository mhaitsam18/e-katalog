<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Migration_Update_Trigger_Produk extends CI_Migration
{
	public function up()
	{
		echo PHP_EOL."--- Migrasi 4 ---".PHP_EOL;

		$this->_drop_triggers();

		$this->db->query('
		CREATE TRIGGER `after_insert_produk`
		AFTER INSERT ON `produk` FOR EACH ROW
		BEGIN
			INSERT INTO riwayat_produk
			(id_produk, aksi, tanggal, nama_produk, harga, harga_ppn, masa_berlaku, merek, no_produk_penyedia, unit_pengukuran, kode_kbki, nilai_tkdn, stok, deskripsi, foto, no_item, id_etalase, id_user)
			VALUE
			(NEW.id_produk, "produk dibuat", NOW(), NEW.nama_produk, NEW.harga, NEW.harga_ppn, NEW.masa_berlaku, NEW.merek, NEW.no_produk_penyedia, NEW.unit_pengukuran, NEW.kode_kbki, NEW.nilai_tkdn, NEW.stok, NEW.deskripsi, NEW.foto, NEW.no_item, NEW.id_etalase, NEW.id_user);
		END
		');
		echo "Trigger after_insert_produk dibuat!" . PHP_EOL;

		$this->db->query('
			CREATE TRIGGER `after_update_produk`
			AFTER UPDATE ON `produk` FOR EACH ROW
			BEGIN
				DECLARE aksi VARCHAR(255) DEFAULT "Ubah ";
				DECLARE nama_produk VARCHAR(255);
				DECLARE harga INT(10);
				DECLARE harga_ppn INT(10);
				DECLARE masa_berlaku DATE;
				DECLARE merek VARCHAR(255);
				DECLARE no_produk_penyedia VARCHAR(255);
				DECLARE unit_pengukuran VARCHAR(100);
				DECLARE kode_kbki VARCHAR(100);
				DECLARE nilai_tkdn DECIMAL(3,2);
				DECLARE stok INT(11);
				DECLARE deskripsi TEXT;
				DECLARE foto VARCHAR(100);
				DECLARE no_item INT(11);
				DECLARE id_etalase INT(9);
				DECLARE id_user INT(9);

				IF NOT OLD.nama_produk <=> NEW.nama_produk THEN 
					SET nama_produk = NEW.nama_produk;
					SET aksi = CONCAT(aksi, "nama_produk, ");
				END IF;

				IF NOT OLD.harga <=> NEW.harga THEN 
					SET harga = NEW.harga;
					SET aksi = CONCAT(aksi, "harga sebelum ppn, ");
				END IF;

				IF NOT OLD.harga_ppn <=> NEW.harga_ppn THEN 
					SET harga_ppn = NEW.harga_ppn;
					SET aksi = CONCAT(aksi, "harga sesudah ppn, ");
				END IF;

				IF NOT OLD.masa_berlaku <=> NEW.masa_berlaku THEN 
					SET masa_berlaku = NEW.masa_berlaku;
					SET aksi = CONCAT(aksi, "masa_berlaku, ");
				END IF;

				IF NOT OLD.merek <=> NEW.merek THEN 
					SET merek = NEW.merek;
					SET aksi = CONCAT(aksi, "merek, ");
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

				IF NOT OLD.no_item <=> NEW.no_item THEN 
					SET no_item = NEW.no_item;
					SET aksi = CONCAT(aksi, "no item, ");
				END IF;

				IF NOT OLD.id_etalase <=> NEW.id_etalase THEN 
					SET id_etalase = NEW.id_etalase;
					SET aksi = CONCAT(aksi, "etalase");
				END IF;

				IF NOT OLD.id_user <=> NEW.id_user THEN 
					SET id_user = NEW.id_user;
					SET aksi = CONCAT(aksi, "penyedia");
				END IF;

				INSERT INTO riwayat_produk
				(`id_produk`, `aksi`, `tanggal`, `nama_produk`, `harga`, `harga_ppn`, `masa_berlaku`, `merek`, `no_produk_penyedia`, `unit_pengukuran`, `kode_kbki`, `nilai_tkdn`, `stok`, `deskripsi`, `foto`, `no_item`, `id_etalase`, `id_user`)
				VALUE
				(OLD.id_produk, aksi, NOW(), nama_produk, harga, harga_ppn, masa_berlaku, merek, no_produk_penyedia, unit_pengukuran, kode_kbki, nilai_tkdn, stok, deskripsi, foto, no_item, id_etalase, id_user);
			END
		');
		echo "Trigger after_update_produk dibuat!" . PHP_EOL;
	}

	public function down()
	{
		echo PHP_EOL."--- Migrasi 4 ---".PHP_EOL;

		$this->_drop_triggers();

		$this->db->query('
		CREATE TRIGGER `after_insert_produk`
		AFTER INSERT ON `produk` FOR EACH ROW
		BEGIN
			INSERT INTO riwayat_produk
			(id_produk, aksi, tanggal, nama_produk, harga, harga_ppn, masa_berlaku, merek, no_produk_penyedia, unit_pengukuran, kode_kbki, nilai_tkdn, stok, deskripsi, foto, no_item, id_etalase)
			VALUE
			(NEW.id_produk, "produk dibuat", NOW(), NEW.nama_produk, NEW.harga, NEW.harga_ppn, NEW.masa_berlaku, NEW.merek, NEW.no_produk_penyedia, NEW.unit_pengukuran, NEW.kode_kbki, NEW.nilai_tkdn, NEW.stok, NEW.deskripsi, NEW.foto, NEW.no_item, NEW.id_etalase);
		END
		');
		echo "Trigger after_insert_produk dibuat!" . PHP_EOL;

		$this->db->query('
			CREATE TRIGGER `after_update_produk`
			AFTER UPDATE ON `produk` FOR EACH ROW
			BEGIN
				DECLARE aksi VARCHAR(255) DEFAULT "Ubah ";
				DECLARE nama_produk VARCHAR(255);
				DECLARE harga INT(10);
				DECLARE harga_ppn INT(10);
				DECLARE masa_berlaku DATE;
				DECLARE merek VARCHAR(255);
				DECLARE no_produk_penyedia VARCHAR(255);
				DECLARE unit_pengukuran VARCHAR(100);
				DECLARE kode_kbki VARCHAR(100);
				DECLARE nilai_tkdn DECIMAL(3,2);
				DECLARE stok INT(11);
				DECLARE deskripsi TEXT;
				DECLARE foto VARCHAR(100);
				DECLARE no_item INT(11);
				DECLARE id_etalase INT(9);

				IF NOT OLD.nama_produk <=> NEW.nama_produk THEN 
					SET nama_produk = NEW.nama_produk;
					SET aksi = CONCAT(aksi, "nama_produk, ");
				END IF;

				IF NOT OLD.harga <=> NEW.harga THEN 
					SET harga = NEW.harga;
					SET aksi = CONCAT(aksi, "harga sebelum ppn, ");
				END IF;

				IF NOT OLD.harga_ppn <=> NEW.harga_ppn THEN 
					SET harga_ppn = NEW.harga_ppn;
					SET aksi = CONCAT(aksi, "harga sesudah ppn, ");
				END IF;

				IF NOT OLD.masa_berlaku <=> NEW.masa_berlaku THEN 
					SET masa_berlaku = NEW.masa_berlaku;
					SET aksi = CONCAT(aksi, "masa_berlaku, ");
				END IF;

				IF NOT OLD.merek <=> NEW.merek THEN 
					SET merek = NEW.merek;
					SET aksi = CONCAT(aksi, "merek, ");
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

				IF NOT OLD.no_item <=> NEW.no_item THEN 
					SET no_item = NEW.no_item;
					SET aksi = CONCAT(aksi, "no item, ");
				END IF;

				IF NOT OLD.id_etalase <=> NEW.id_etalase THEN 
					SET id_etalase = NEW.id_etalase;
					SET aksi = CONCAT(aksi, "id_etalase");
				END IF;

				INSERT INTO riwayat_produk
				(`id_produk`, `aksi`, `tanggal`, `nama_produk`, `harga`, `harga_ppn`, `masa_berlaku`, `merek`, `no_produk_penyedia`, `unit_pengukuran`, `kode_kbki`, `nilai_tkdn`, `stok`, `deskripsi`, `foto`, `no_item`, `id_etalase`)
				VALUE
				(OLD.id_produk, aksi, NOW(), nama_produk, harga, harga_ppn, masa_berlaku, merek, no_produk_penyedia, unit_pengukuran, kode_kbki, nilai_tkdn, stok, deskripsi, foto, no_item, id_etalase);
			END
		');
		echo "Trigger after_update_produk dibuat!" . PHP_EOL;
	}

	private function _drop_triggers()
	{
		$this->db->query('DROP TRIGGER IF EXISTS after_update_produk');
		echo "Trigger after_update_produk dihapus!" . PHP_EOL;

		$this->db->query('DROP TRIGGER IF EXISTS after_insert_produk');
		echo "Trigger after_insert_produk dihapus!" . PHP_EOL;
	}
}
