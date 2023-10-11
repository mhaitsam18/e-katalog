<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Migration_Tambah_Trigger extends CI_Migration
{
	public function up()
	{
		echo PHP_EOL."--- Migrasi 6 ---".PHP_EOL;

		$this->db->query('
			CREATE TRIGGER IF NOT EXISTS after_insert_paket
			AFTER INSERT ON paket FOR EACH ROW
			BEGIN
				INSERT INTO riwayat_paket
				(id_paket, aksi, tanggal, id_ppk, id_anggaran, status)
				VALUE
				(NEW.id, "Paket dibuat", NOW(), NEW.id_ppk, NEW.id_anggaran, NEW.status);
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
				(OLD.id, aksi, NOW(), id_ppk, id_anggaran, status);
			END
		');
		echo "Trigger after_update_paket dibuat!" . PHP_EOL;

		$this->db->query('
			CREATE TRIGGER IF NOT EXISTS after_insert_riwayat_nh
			AFTER INSERT ON negosiasi_harga FOR EACH ROW
			BEGIN
				INSERT INTO riwayat_nh
				(id_nh, aksi, tanggal, nominal, ongkir, tanggal_pengiriman, catatan_pembeli)
				VALUE
				(NEW.id, "Negosiasi dimulai", NOW(), NEW.nominal, NEW.ongkir, NEW.tanggal_pengiriman, NEW.catatan_pembeli);
			END
		');
		echo "Trigger after_insert_riwayat_nh dibuat!" . PHP_EOL;

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

				IF OLD.catatan_pembeli <> NEW.catatan_pembeli THEN 
					SET catatan_pembeli = NEW.catatan_pembeli;
					SET aksi = CONCAT(aksi, "catatan_pembeli, ");
				END IF;

				INSERT INTO riwayat_nh
				(`id_nh`, `aksi`, `tanggal`, `nominal`, `ongkir`, `tanggal_pengiriman`, `catatan_pembeli`)
				VALUE
				(OLD.id, aksi, NOW(), nominal, ongkir, tanggal_pengiriman, catatan_pembeli);
			END
		');
		echo "Trigger after_update_riwayat_nh dibuat!" . PHP_EOL;

		$this->db->query('
			CREATE TRIGGER IF NOT EXISTS after_insert_riwayat_ns
			AFTER INSERT ON negosiasi_spesifikasi FOR EACH ROW
			BEGIN
				INSERT INTO riwayat_ns
				(id_ns, aksi, tanggal, spesifikasi, nilai, catatan_pembeli)
				VALUE
				(NEW.id, "Negosiasi dimulai", NOW(), NEW.spesifikasi, NEW.nilai, NEW.catatan_pembeli);
			END
		');
		echo "Trigger after_insert_riwayat_ns dibuat!" . PHP_EOL;

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

				IF OLD.catatan_pembeli <> NEW.catatan_pembeli THEN 
					SET catatan_pembeli = NEW.catatan_pembeli;
					SET aksi = CONCAT(aksi, "catatan_pembeli, ");
				END IF;

				INSERT INTO riwayat_ns
				(`id_ns`, `aksi`, `tanggal`, `spesifikasi`, `nilai`, `catatan_pembeli`)
				VALUE
				(OLD.id, aksi, NOW(), spesifikasi, nilai, catatan_pembeli);
			END
		');
		echo "Trigger after_update_riwayat_ns dibuat!" . PHP_EOL;
	}

	public function down()
	{
		echo PHP_EOL."--- Migrasi 6 ---".PHP_EOL;

		$this->db->query('DROP TRIGGER IF EXISTS after_update_riwayat_ns');
		echo "Trigger after_update_riwayat_ns dihapus!" . PHP_EOL;

		$this->db->query('DROP TRIGGER IF EXISTS after_update_riwayat_nh');
		echo "Trigger after_update_riwayat_nh dihapus!" . PHP_EOL;

		$this->db->query('DROP TRIGGER IF EXISTS after_insert_riwayat_ns');
		echo "Trigger after_insert_riwayat_ns dihapus!" . PHP_EOL;

		$this->db->query('DROP TRIGGER IF EXISTS after_insert_riwayat_nh');
		echo "Trigger after_insert_riwayat_nh dihapus!" . PHP_EOL;

		$this->db->query('DROP TRIGGER IF EXISTS after_update_paket');
		echo "Trigger after_update_paket dihapus!" . PHP_EOL;

		$this->db->query('DROP TRIGGER IF EXISTS after_insert_paket');
		echo "Trigger after_insert_paket dihapus!" . PHP_EOL;
	}
}
