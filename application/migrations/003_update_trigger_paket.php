<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Migration_Update_Trigger_Paket extends CI_Migration
{
	public function up()
	{
		echo PHP_EOL."--- Migrasi 3 ---".PHP_EOL;

		$this->db->query('ALTER TABLE `riwayat_paket` 
			ADD COLUMN id_kak INT(9),
			ADD COLUMN receipt VARCHAR(9)');
		echo "Tambah kolom `id_kak` dan `receipt` di tabel riwayat_paket berhasil!".PHP_EOL;

		$this->db->query('DROP TRIGGER IF EXISTS after_insert_paket');
		echo "Trigger after_insert_paket dihapus!" . PHP_EOL;

		$this->db->query('
			CREATE TRIGGER IF NOT EXISTS after_insert_paket
			AFTER INSERT ON paket FOR EACH ROW
			BEGIN
				INSERT INTO riwayat_paket
				(id_paket, aksi, tanggal, id_pp, id_penyedia, id_kak, no_pr, status, jenis_pembayaran, dokumen, receipt)
				VALUE
				(NEW.id_paket, "Paket dibuat", NOW(), NEW.id_pp, NEW.id_penyedia, NEW.id_kak, NEW.no_pr, NEW.status, NEW.jenis_pembayaran, NEW.dokumen, NEW.receipt);
			END
		');
		echo "Trigger after_insert_paket dibuat ulang!".PHP_EOL;

		$this->db->query('DROP TRIGGER IF EXISTS after_update_paket');
		echo "Trigger after_update_paket dihapus!" . PHP_EOL;

		$this->db->query('
			CREATE TRIGGER IF NOT EXISTS after_update_paket
			AFTER UPDATE ON paket FOR EACH ROW
			BEGIN
				DECLARE aksi VARCHAR(255) DEFAULT "Ubah ";
				DECLARE id_pp INT;
				DECLARE id_penyedia INT;
				DECLARE id_kak INT;
				DECLARE no_pr VARCHAR(50);
				DECLARE status TINYINT;
				DECLARE jenis_pembayaran VARCHAR(20);
				DECLARE dokumen VARCHAR(255);
				DECLARE receipt VARCHAR(50);

				IF NOT OLD.id_pp <=> NEW.id_pp THEN 
					SET id_pp = NEW.id_pp;
					SET aksi = CONCAT(aksi, "PP, ");
				END IF;
				
				IF NOT OLD.id_penyedia <=> NEW.id_penyedia THEN 
					SET id_penyedia = NEW.id_penyedia;
					SET aksi = CONCAT(aksi, "Penyedia, ");
				END IF;

				IF NOT OLD.id_kak <=> NEW.id_kak THEN 
					SET id_kak = NEW.id_kak;
					SET aksi = CONCAT(aksi, "KAK, ");
				END IF;

				IF NOT OLD.no_pr <=> NEW.no_pr THEN 
					SET no_pr = NEW.no_pr;
					SET aksi = CONCAT(aksi, "no PR, ");
				END IF;

				IF NOT OLD.status <=> NEW.status THEN 
					SET status = NEW.status;
					SET aksi = CONCAT(aksi, "status, ");
				END IF;
				
				IF NOT OLD.jenis_pembayaran <=> NEW.jenis_pembayaran THEN 
					SET jenis_pembayaran = NEW.jenis_pembayaran;
					SET aksi = CONCAT(aksi, "jenis pembaran, ");
				END IF;
				
				IF NOT OLD.dokumen <=> NEW.dokumen THEN 
					SET dokumen = NEW.dokumen;
					SET aksi = CONCAT(aksi, "dokumen");
				END IF;

				IF NOT OLD.receipt <=> NEW.receipt THEN 
					SET receipt = NEW.receipt;
					SET aksi = CONCAT(aksi, "Receipt, ");
				END IF;

				INSERT INTO riwayat_paket
				(`id_paket`, `aksi`, `tanggal`, `id_pp`, `id_penyedia`, `id_kak`, `no_pr`, `status`, `jenis_pembayaran`, `dokumen`, `receipt`)
				VALUE
				(OLD.id_paket, aksi, NOW(), id_pp, id_penyedia, id_kak, no_pr, status, jenis_pembayaran, dokumen, receipt);
			END
		');
		echo "Trigger after_update_paket dibuat ulang!".PHP_EOL;
	}

	public function down()
	{
		echo PHP_EOL."--- Migrasi 3 ---".PHP_EOL;

		$this->db->query('DROP TRIGGER IF EXISTS after_insert_paket');
		echo "Trigger after_insert_paket dihapus!" . PHP_EOL;

		$this->db->query('
			CREATE TRIGGER IF NOT EXISTS after_insert_paket
			AFTER INSERT ON paket FOR EACH ROW
			BEGIN
				INSERT INTO riwayat_paket
				(id_paket, aksi, tanggal, id_pp, id_penyedia, id_kak, no_pr, status, jenis_pembayaran, dokumen, receipt)
				VALUE
				(NEW.id_paket, "Paket dibuat", NOW(), NEW.id_pp, NEW.id_penyedia, NEW.id_kak, NEW.no_pr, NEW.status, NEW.jenis_pembayaran, NEW.dokumen, NEW.receipt);
			END
		');
		echo "Trigger after_insert_paket dibuat ulang!".PHP_EOL;

		$this->db->query('DROP TRIGGER IF EXISTS after_update_paket');
		echo "Trigger after_update_paket dihapus!" . PHP_EOL;

		$this->db->query('
			CREATE TRIGGER IF NOT EXISTS after_update_paket
			AFTER UPDATE ON paket FOR EACH ROW
			BEGIN
				DECLARE aksi VARCHAR(255) DEFAULT "Ubah ";
				DECLARE id_pp INT;
				DECLARE id_penyedia INT;
				DECLARE no_pr VARCHAR(50);
				DECLARE status TINYINT;
				DECLARE jenis_pembayaran VARCHAR(20);
				DECLARE dokumen VARCHAR(255);

				IF NOT OLD.id_pp <=> NEW.id_pp THEN 
					SET id_pp = NEW.id_pp;
					SET aksi = CONCAT(aksi, "PP, ");
				END IF;
				
				IF NOT OLD.id_penyedia <=> NEW.id_penyedia THEN 
					SET id_penyedia = NEW.id_penyedia;
					SET aksi = CONCAT(aksi, "Penyedia, ");
				END IF;

				IF NOT OLD.no_pr <=> NEW.no_pr THEN 
					SET no_pr = NEW.no_pr;
					SET aksi = CONCAT(aksi, "no PR, ");
				END IF;

				IF NOT OLD.status <=> NEW.status THEN 
					SET status = NEW.status;
					SET aksi = CONCAT(aksi, "status, ");
				END IF;
				
				IF NOT OLD.jenis_pembayaran <=> NEW.jenis_pembayaran THEN 
					SET jenis_pembayaran = NEW.jenis_pembayaran;
					SET aksi = CONCAT(aksi, "jenis pembaran, ");
				END IF;
				
				IF NOT OLD.dokumen <=> NEW.dokumen THEN 
					SET dokumen = NEW.dokumen;
					SET aksi = CONCAT(aksi, "dokumen");
				END IF;

				INSERT INTO riwayat_paket
				(`id_paket`, `aksi`, `tanggal`, `id_pp`, `id_penyedia`, `no_pr`, `status`, `jenis_pembayaran`, `dokumen`)
				VALUE
				(OLD.id_paket, aksi, NOW(), id_pp, id_penyedia, no_pr, status, jenis_pembayaran, dokumen);
			END
		');
		echo "Trigger after_update_paket dibuat ulang!".PHP_EOL;

		$this->db->query('ALTER TABLE `riwayat_paket` 
			DROP COLUMN id_kak,
			DROP COLUMN receipt');
		echo "Tambah kolom `id_kak` dan `receipt` di tabel riwayat_paket berhasil!".PHP_EOL;
	}
}
