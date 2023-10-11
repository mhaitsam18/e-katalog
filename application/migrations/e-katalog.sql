-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 04 Des 2022 pada 16.02
-- Versi server: 10.4.14-MariaDB
-- Versi PHP: 7.4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `e-katalog`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `admin`
--

CREATE TABLE `admin` (
  `id_admin` int(9) NOT NULL,
  `nama_admin` varchar(100) NOT NULL,
  `jabatan_admin` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `berita`
--

CREATE TABLE `berita` (
  `id_berita` int(9) NOT NULL,
  `judul` varchar(255) NOT NULL,
  `body` text NOT NULL,
  `tanggal` datetime DEFAULT current_timestamp(),
  `gambar` varchar(100) DEFAULT NULL,
  `id_kb` int(9) NOT NULL COMMENT 'id kategori_paket',
  `id_admin` int(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struktur dari tabel `etalase`
--

CREATE TABLE `etalase` (
  `id_etalase` int(9) NOT NULL,
  `nama_etalase` varchar(255) NOT NULL,
  `id_ke` int(9) NOT NULL COMMENT 'id kategori_etalase'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struktur dari tabel `etalase_penyedia`
--

CREATE TABLE `etalase_penyedia` (
  `id_penyedia` int(9) NOT NULL,
  `id_etalase` int(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `faq`
--

CREATE TABLE `faq` (
  `id_faq` int(9) NOT NULL,
  `pertanyaan` varchar(255) NOT NULL,
  `jawaban` text NOT NULL,
  `id_admin` int(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `favorit`
--

CREATE TABLE `favorit` (
  `id_favorit` int(9) NOT NULL,
  `id_pumk` int(9) DEFAULT NULL,
  `id_produk` int(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struktur dari tabel `item`
--

CREATE TABLE `item` (
  `no_item` varchar(16) NOT NULL,
  `nama_item` varchar(100) NOT NULL,
  `uom` varchar(50) DEFAULT NULL,
  `id_etalase` int(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `kak`
--

CREATE TABLE `kak` (
  `id_kak` int(9) NOT NULL,
  `nama_paket` varchar(100) NOT NULL,
  `uraian_pekerjaan` text NOT NULL,
  `ruang_lingkup` text NOT NULL,
  `tahun_anggaran` varchar(4) NOT NULL,
  `alamat_kirim` varchar(255) NOT NULL,
  `tanggal_mulai` date NOT NULL,
  `tanggal_akhir` date NOT NULL,
  `link` varchar(36) NOT NULL,
  `tanggal_buat` datetime NOT NULL DEFAULT current_timestamp(),
  `id_pk` int(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `kategori_berita`
--

CREATE TABLE `kategori_berita` (
  `id_kb` int(9) NOT NULL COMMENT 'id kategori_berita',
  `nama_kb` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struktur dari tabel `kategori_etalase`
--

CREATE TABLE `kategori_etalase` (
  `id_ke` int(9) NOT NULL COMMENT 'id kategori_etalase',
  `nama_ke` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struktur dari tabel `kategori_unduhan`
--

CREATE TABLE `kategori_unduhan` (
  `id_ku` int(9) NOT NULL COMMENT 'id kategori_unduhan',
  `nama_ku` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struktur dari tabel `keranjang`
--

CREATE TABLE `keranjang` (
  `id_keranjang` int(9) NOT NULL,
  `id_produk` int(9) NOT NULL,
  `id_pumk` int(9) NOT NULL,
  `id_kak` int(9) DEFAULT NULL,
  `id_paket` int(9) DEFAULT NULL,
  `kuantitas` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struktur dari tabel `lampiran`
--

CREATE TABLE `lampiran` (
  `id_lampiran` int(9) NOT NULL,
  `nama_lampiran` varchar(255) NOT NULL,
  `keterangan` text DEFAULT NULL,
  `id_produk` int(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struktur dari tabel `merek`
--

CREATE TABLE `merek` (
  `id_merek` int(9) NOT NULL,
  `nama_merek` varchar(255) NOT NULL,
  `deskripsi` varchar(255) DEFAULT NULL,
  `id_pengumuman` int(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struktur dari tabel `meta_produk`
--

CREATE TABLE `meta_produk` (
  `id_meta` int(9) NOT NULL COMMENT 'id meta_produk',
  `spesifikasi` varchar(255) NOT NULL,
  `nilai` varchar(255) NOT NULL,
  `id_produk` int(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struktur dari tabel `negosiasi_harga`
--

CREATE TABLE `negosiasi_harga` (
  `id_keranjang` int(9) NOT NULL,
  `nominal` int(11) UNSIGNED NOT NULL,
  `catatan_pembeli` varchar(500) DEFAULT NULL,
  `catatan_penyedia` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struktur dari tabel `negosiasi_spesifikasi`
--

CREATE TABLE `negosiasi_spesifikasi` (
  `id_ns` int(9) NOT NULL COMMENT 'id negosiasi_spesifikasi',
  `catatan_pembeli` varchar(500) DEFAULT NULL,
  `catatan_penyedia` varchar(500) DEFAULT NULL,
  `id_paket` int(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Trigger `negosiasi_spesifikasi`
--
DELIMITER $$
CREATE TRIGGER `after_insert_negosiasi_spesifikasi` AFTER INSERT ON `negosiasi_spesifikasi` FOR EACH ROW BEGIN

INSERT INTO riwayat_ns
(id_ns, aksi, tanggal, catatan_pembeli, catatan_penyedia)
VALUE
(NEW.id_ns, "Negosiasi dimulai", NOW(), NEW.catatan_pembeli, NEW.catatan_penyedia);

END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `after_update_negosiasi_spesifikasi` AFTER UPDATE ON `negosiasi_spesifikasi` FOR EACH ROW BEGIN

DECLARE aksi VARCHAR(255) DEFAULT "Ubah ";
DECLARE catatan_pembeli VARCHAR(500);
DECLARE catatan_penyedia VARCHAR(500);


IF NOT OLD.catatan_pembeli <=> NEW.catatan_pembeli THEN 
  SET catatan_pembeli = NEW.catatan_pembeli;
  SET aksi = CONCAT(aksi, "catatan pembeli, ");
END IF;

IF NOT OLD.catatan_penyedia <=> NEW.catatan_penyedia THEN 
  SET catatan_penyedia = NEW.catatan_penyedia;
  SET aksi = CONCAT(aksi, "catatan penyedia, ");
END IF;

				INSERT INTO riwayat_ns
				(`id_ns`, `aksi`, `tanggal`, `catatan_pembeli`, `catatan_penyedia`)
				VALUE
				(OLD.id_ns, aksi, NOW(),  catatan_pembeli, catatan_penyedia);

END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `negosiasi_tanggal`
--

CREATE TABLE `negosiasi_tanggal` (
  `id_nt` int(9) NOT NULL COMMENT 'id negosiasi_tanggal',
  `tanggal_mulai` date DEFAULT NULL,
  `tanggal_akhir` date DEFAULT NULL,
  `catatan_pembeli` varchar(500) DEFAULT NULL,
  `catatan_penyedia` varchar(500) DEFAULT NULL,
  `id_paket` int(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Trigger `negosiasi_tanggal`
--
DELIMITER $$
CREATE TRIGGER `after_insert_negosiasi_tanggal` AFTER INSERT ON `negosiasi_tanggal` FOR EACH ROW INSERT INTO riwayat_nt
				(id_nt, aksi, tanggal, tanggal_mulai, tanggal_akhir, catatan_pembeli, catatan_penyedia)
				VALUE
				(NEW.id_nt, "Negosiasi dimulai", NOW(), NEW.tanggal_mulai, NEW.tanggal_akhir, NEW.catatan_pembeli, NEW.catatan_penyedia)
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `after_update_negosiasi_tanggal` AFTER UPDATE ON `negosiasi_tanggal` FOR EACH ROW BEGIN 

DECLARE aksi VARCHAR(255) DEFAULT "Ubah ";
DECLARE tanggal_mulai DATE;
DECLARE tanggal_akhir DATE;
DECLARE catatan_pembeli VARCHAR(500);
DECLARE catatan_penyedia VARCHAR(500);

IF NOT OLD.tanggal_mulai <=> NEW.tanggal_mulai THEN 
    SET tanggal_mulai = NEW.tanggal_mulai;
    SET aksi = CONCAT(aksi, "tanggal mulai, ");
END IF;

IF NOT OLD.tanggal_akhir <=> NEW.tanggal_akhir THEN 
    SET tanggal_akhir = NEW.tanggal_akhir;
    SET aksi = CONCAT(aksi, "tanggal akhir, ");
END IF;

IF NOT OLD.catatan_pembeli <=> NEW.catatan_pembeli THEN 
    SET catatan_pembeli = NEW.catatan_pembeli;
    SET aksi = CONCAT(aksi, "catatan pembeli, ");
END IF;
                
IF NOT OLD.catatan_penyedia <=> NEW.catatan_penyedia THEN 
    SET catatan_penyedia = NEW.catatan_penyedia;
    SET aksi = CONCAT(aksi, "catatan penyedia, ");
END IF;


INSERT INTO riwayat_nt
(`id_nt`, `aksi`, `tanggal`, `tanggal_mulai`, `tanggal_akhir`, `catatan_pembeli`, `catatan_penyedia`)
VALUE
(OLD.id_nt, aksi, NOW(), tanggal_mulai, tanggal_akhir, catatan_pembeli, catatan_penyedia);

END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `paket`
--

CREATE TABLE `paket` (
  `id_paket` int(9) NOT NULL,
  `id_pp` int(9) NOT NULL,
  `id_penyedia` int(9) NOT NULL,
  `no_pr` varchar(20) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `jenis_pembayaran` varchar(20) DEFAULT NULL,
  `dokumen` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Trigger `paket`
--
DELIMITER $$
CREATE TRIGGER `after_insert_paket` AFTER INSERT ON `paket` FOR EACH ROW BEGIN
INSERT INTO riwayat_paket
(id_paket, aksi, tanggal, id_pp, id_penyedia, no_pr, status, jenis_pembayaran, dokumen)
VALUE
(NEW.id_paket, "Paket dibuat", NOW(), NEW.id_pp, NEW.id_penyedia, NEW.no_pr, NEW.status, NEW.jenis_pembayaran, NEW.dokumen);
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `after_update_paket` AFTER UPDATE ON `paket` FOR EACH ROW BEGIN
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
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengumuman`
--

CREATE TABLE `pengumuman` (
  `id_pengumuman` int(9) NOT NULL,
  `judul` varchar(255) NOT NULL,
  `jumlah_penawaran` int(11) DEFAULT 0,
  `syarat_ketentuan` text DEFAULT NULL,
  `dok_pengumuman` varchar(255) DEFAULT NULL,
  `id_etalase` int(9) NOT NULL,
  `id_admin` int(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struktur dari tabel `penyedia`
--

CREATE TABLE `penyedia` (
  `id_penyedia` int(9) NOT NULL,
  `nama_penyedia` varchar(255) DEFAULT NULL,
  `alamat_penyedia` varchar(255) DEFAULT NULL,
  `nama_perusahaan` varchar(50) DEFAULT NULL,
  `bank` varchar(50) DEFAULT NULL,
  `norek` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struktur dari tabel `pk`
--

CREATE TABLE `pk` (
  `id_pk` int(11) NOT NULL,
  `nama_pk` varchar(100) NOT NULL,
  `nip` varchar(18) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `pp`
--

CREATE TABLE `pp` (
  `id_pp` int(9) NOT NULL,
  `nama_pp` varchar(100) NOT NULL,
  `jabatan_pp` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `produk`
--

CREATE TABLE `produk` (
  `id_produk` int(9) NOT NULL,
  `nama_produk` varchar(255) NOT NULL,
  `harga` int(10) UNSIGNED NOT NULL COMMENT 'harga sebelum ppn',
  `harga_ppn` int(10) UNSIGNED DEFAULT NULL COMMENT 'harga sesudah ppn',
  `masa_berlaku` date DEFAULT NULL,
  `merek` varchar(100) NOT NULL,
  `no_produk_penyedia` varchar(255) DEFAULT NULL,
  `unit_pengukuran` varchar(100) DEFAULT NULL,
  `kode_kbki` varchar(100) NOT NULL,
  `nilai_tkdn` decimal(3,2) DEFAULT NULL,
  `stok` int(11) NOT NULL,
  `deskripsi` text DEFAULT NULL,
  `foto` varchar(100) DEFAULT NULL,
  `id_etalase` int(9) NOT NULL,
  `id_penyedia` int(9) NOT NULL,
  `no_item` varchar(16) CHARACTER SET utf8mb4 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Trigger `produk`
--
DELIMITER $$
CREATE TRIGGER `after_delete_produk` AFTER DELETE ON `produk` FOR EACH ROW BEGIN
				INSERT INTO riwayat_produk
				(id_produk, aksi, tanggal, nama_produk, harga, harga_ppn, masa_berlaku, merek, no_produk_penyedia, unit_pengukuran, kode_kbki, nilai_tkdn, stok, deskripsi, foto, no_item, id_etalase, id_penyedia)
				VALUE
				(OLD.id_produk, "produk dihapus", NOW(), OLD.nama_produk, OLD.harga, OLD.harga_ppn, OLD.masa_berlaku, OLD.merek, OLD.no_produk_penyedia, OLD.unit_pengukuran, OLD.kode_kbki, OLD.nilai_tkdn, OLD.stok, OLD.deskripsi, OLD.foto, OLD.no_item, OLD.id_etalase, OLD.id_penyedia);
			END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `after_insert_produk` AFTER INSERT ON `produk` FOR EACH ROW BEGIN
			INSERT INTO riwayat_produk
			(id_produk, aksi, tanggal, nama_produk, harga, harga_ppn, masa_berlaku, merek, no_produk_penyedia, unit_pengukuran, kode_kbki, nilai_tkdn, stok, deskripsi, foto, no_item, id_etalase, id_penyedia)
			VALUE
			(NEW.id_produk, "produk dibuat", NOW(), NEW.nama_produk, NEW.harga, NEW.harga_ppn, NEW.masa_berlaku, NEW.merek, NEW.no_produk_penyedia, NEW.unit_pengukuran, NEW.kode_kbki, NEW.nilai_tkdn, NEW.stok, NEW.deskripsi, NEW.foto, NEW.no_item, NEW.id_etalase, NEW.id_penyedia);
		END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `after_update_produk` AFTER UPDATE ON `produk` FOR EACH ROW BEGIN
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
				DECLARE id_penyedia INT(9);

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

				IF NOT OLD.id_penyedia <=> NEW.id_penyedia THEN 
					SET id_penyedia = NEW.id_penyedia;
					SET aksi = CONCAT(aksi, "penyedia");
				END IF;

				INSERT INTO riwayat_produk
				(`id_produk`, `aksi`, `tanggal`, `nama_produk`, `harga`, `harga_ppn`, `masa_berlaku`, `merek`, `no_produk_penyedia`, `unit_pengukuran`, `kode_kbki`, `nilai_tkdn`, `stok`, `deskripsi`, `foto`, `no_item`, `id_etalase`, `id_penyedia`)
				VALUE
				(OLD.id_produk, aksi, NOW(), nama_produk, harga, harga_ppn, masa_berlaku, merek, no_produk_penyedia, unit_pengukuran, kode_kbki, nilai_tkdn, stok, deskripsi, foto, no_item, id_etalase, id_penyedia);
			END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `pumk`
--

CREATE TABLE `pumk` (
  `id_pumk` int(9) NOT NULL,
  `nama_pumk` varchar(100) NOT NULL,
  `alamat_pumk` varchar(255) NOT NULL,
  `jabatan_pumk` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `riwayat_nh`
--

CREATE TABLE `riwayat_nh` (
  `id_paket` int(9) NOT NULL,
  `aksi` varchar(255) NOT NULL,
  `tanggal` datetime DEFAULT current_timestamp(),
  `nominal` int(11) UNSIGNED DEFAULT NULL,
  `ongkir` int(11) UNSIGNED DEFAULT NULL,
  `catatan_pembeli` varchar(500) DEFAULT NULL,
  `catatan_penyedia` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struktur dari tabel `riwayat_ns`
--

CREATE TABLE `riwayat_ns` (
  `id_ns` int(9) NOT NULL COMMENT 'id negosiasi_spesifikasi',
  `aksi` varchar(255) NOT NULL,
  `tanggal` datetime DEFAULT current_timestamp(),
  `catatan_pembeli` varchar(500) DEFAULT NULL,
  `catatan_penyedia` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struktur dari tabel `riwayat_nt`
--

CREATE TABLE `riwayat_nt` (
  `id_nt` int(9) NOT NULL COMMENT 'id negosiasi_tanggal',
  `aksi` varchar(255) NOT NULL,
  `tanggal` datetime DEFAULT current_timestamp(),
  `tanggal_mulai` date DEFAULT NULL,
  `tanggal_akhir` date DEFAULT NULL,
  `catatan_pembeli` varchar(500) DEFAULT NULL,
  `catatan_penyedia` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struktur dari tabel `riwayat_paket`
--

CREATE TABLE `riwayat_paket` (
  `id_paket` int(9) NOT NULL,
  `aksi` varchar(255) NOT NULL,
  `tanggal` datetime DEFAULT current_timestamp(),
  `id_pp` int(9) DEFAULT NULL,
  `id_penyedia` int(9) DEFAULT NULL,
  `no_pr` varchar(20) DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  `jenis_pembayaran` varchar(20) DEFAULT NULL,
  `dokumen` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struktur dari tabel `riwayat_produk`
--

CREATE TABLE `riwayat_produk` (
  `id_produk` int(9) NOT NULL,
  `aksi` varchar(255) NOT NULL,
  `tanggal` datetime DEFAULT current_timestamp(),
  `nama_produk` varchar(255) DEFAULT NULL,
  `harga` int(10) UNSIGNED DEFAULT NULL,
  `harga_ppn` int(10) UNSIGNED DEFAULT NULL,
  `masa_berlaku` date DEFAULT NULL,
  `merek` varchar(100) DEFAULT NULL,
  `no_produk_penyedia` varchar(255) DEFAULT NULL,
  `unit_pengukuran` varchar(100) DEFAULT NULL,
  `kode_kbki` varchar(100) DEFAULT NULL,
  `nilai_tkdn` decimal(3,2) DEFAULT NULL,
  `stok` int(11) DEFAULT NULL,
  `deskripsi` text DEFAULT NULL,
  `foto` varchar(100) DEFAULT NULL,
  `no_item` int(11) DEFAULT NULL,
  `id_etalase` int(9) DEFAULT NULL,
  `id_penyedia` int(9) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tags`
--

CREATE TABLE `tags` (
  `id_berita` int(9) NOT NULL,
  `tag` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tahapan_pengumuman`
--

CREATE TABLE `tahapan_pengumuman` (
  `id_tp` int(9) NOT NULL COMMENT 'id tahapan_pengumuman',
  `judul` varchar(255) NOT NULL,
  `tanggal_mulai` date DEFAULT NULL,
  `tanggal_akhir` date DEFAULT NULL,
  `perubahan` varchar(255) DEFAULT NULL,
  `id_pengumuman` int(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struktur dari tabel `unduhan`
--

CREATE TABLE `unduhan` (
  `id_unduhan` int(9) NOT NULL,
  `nama_unduhan` varchar(255) NOT NULL,
  `tanggal` datetime DEFAULT current_timestamp(),
  `kapasitas` int(11) NOT NULL,
  `id_ku` int(9) NOT NULL COMMENT 'id kategori_unduhan',
  `file` varchar(255) NOT NULL,
  `id_admin` int(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struktur dari tabel `unit_kerja`
--

CREATE TABLE `unit_kerja` (
  `kode_unit` varchar(7) NOT NULL,
  `nama_unit` varchar(100) NOT NULL,
  `is_faculty` tinyint(1) DEFAULT NULL,
  `nickname` varchar(50) DEFAULT NULL,
  `jenis` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `unit_pk`
--

CREATE TABLE `unit_pk` (
  `id_pk` int(11) NOT NULL,
  `kode_unit` varchar(7) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `unit_pp`
--

CREATE TABLE `unit_pp` (
  `id_pp` int(9) NOT NULL,
  `kode_unit` varchar(7) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `unit_pumk`
--

CREATE TABLE `unit_pumk` (
  `id_pumk` int(9) NOT NULL,
  `kode_unit` varchar(7) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(72) NOT NULL,
  `level` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Stand-in struktur untuk tampilan `view_paket`
-- (Lihat di bawah untuk tampilan aktual)
--
CREATE TABLE `view_paket` (
`id_paket` int(9)
,`id_pp` int(9)
,`id_penyedia` int(9)
,`no_pr` varchar(20)
,`status` tinyint(4)
,`jenis_pembayaran` varchar(20)
,`dokumen` varchar(255)
,`jumlah_produk` decimal(32,0)
,`total` decimal(42,0)
,`nama_paket` varchar(100)
,`id_pumk` int(9)
,`nama_pumk` varchar(100)
,`nama_pp` varchar(100)
,`nama_penyedia` varchar(255)
,`nama_pk` varchar(100)
,`tanggal_buat` datetime
);

-- --------------------------------------------------------

--
-- Stand-in struktur untuk tampilan `view_produk_paket`
-- (Lihat di bawah untuk tampilan aktual)
--
CREATE TABLE `view_produk_paket` (
`id_paket` int(9)
,`id_keranjang` int(9)
,`kuantitas` int(11)
,`harga_nego` int(11) unsigned
,`total` bigint(21) unsigned
,`id_produk` int(9)
,`nama_produk` varchar(255)
,`harga` int(10) unsigned
,`harga_ppn` int(10) unsigned
,`masa_berlaku` date
,`merek` varchar(100)
,`no_produk_penyedia` varchar(255)
,`unit_pengukuran` varchar(100)
,`kode_kbki` varchar(100)
,`nilai_tkdn` decimal(3,2)
,`stok` int(11)
,`deskripsi` text
,`foto` varchar(100)
,`id_etalase` int(9)
,`id_penyedia` int(9)
,`no_item` varchar(16)
,`nama_etalase` varchar(255)
,`nama_ke` varchar(50)
,`nama_item` varchar(100)
,`nama_penyedia` varchar(255)
,`nama_perusahaan` varchar(50)
);

-- --------------------------------------------------------

--
-- Struktur untuk view `view_paket`
--
DROP TABLE IF EXISTS `view_paket`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_paket`  AS SELECT `paket`.`id_paket` AS `id_paket`, `paket`.`id_pp` AS `id_pp`, `paket`.`id_penyedia` AS `id_penyedia`, `paket`.`no_pr` AS `no_pr`, `paket`.`status` AS `status`, `paket`.`jenis_pembayaran` AS `jenis_pembayaran`, `paket`.`dokumen` AS `dokumen`, sum(`keranjang`.`kuantitas`) AS `jumlah_produk`, sum(`keranjang`.`kuantitas` * `produk`.`harga`) AS `total`, `kak`.`nama_paket` AS `nama_paket`, `pumk`.`id_pumk` AS `id_pumk`, `pumk`.`nama_pumk` AS `nama_pumk`, `pp`.`nama_pp` AS `nama_pp`, `penyedia`.`nama_penyedia` AS `nama_penyedia`, `pk`.`nama_pk` AS `nama_pk`, `kak`.`tanggal_buat` AS `tanggal_buat` FROM (((((((`paket` join `pp` on(`paket`.`id_pp` = `pp`.`id_pp`)) join `penyedia` on(`paket`.`id_penyedia` = `penyedia`.`id_penyedia`)) join `keranjang` on(`paket`.`id_paket` = `keranjang`.`id_paket`)) join `pumk` on(`keranjang`.`id_pumk` = `pumk`.`id_pumk`)) join `produk` on(`keranjang`.`id_produk` = `produk`.`id_produk`)) join `kak` on(`keranjang`.`id_kak` = `kak`.`id_kak`)) join `pk` on(`kak`.`id_pk` = `pk`.`id_pk`)) GROUP BY `paket`.`id_paket` ;

-- --------------------------------------------------------

--
-- Struktur untuk view `view_produk_paket`
--
DROP TABLE IF EXISTS `view_produk_paket`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_produk_paket`  AS SELECT `paket`.`id_paket` AS `id_paket`, `keranjang`.`id_keranjang` AS `id_keranjang`, `keranjang`.`kuantitas` AS `kuantitas`, ifnull(`negosiasi_harga`.`nominal`,`produk`.`harga`) AS `harga_nego`, `keranjang`.`kuantitas`* ifnull(`negosiasi_harga`.`nominal`,`produk`.`harga`) AS `total`, `produk`.`id_produk` AS `id_produk`, `produk`.`nama_produk` AS `nama_produk`, `produk`.`harga` AS `harga`, `produk`.`harga_ppn` AS `harga_ppn`, `produk`.`masa_berlaku` AS `masa_berlaku`, `produk`.`merek` AS `merek`, `produk`.`no_produk_penyedia` AS `no_produk_penyedia`, `produk`.`unit_pengukuran` AS `unit_pengukuran`, `produk`.`kode_kbki` AS `kode_kbki`, `produk`.`nilai_tkdn` AS `nilai_tkdn`, `produk`.`stok` AS `stok`, `produk`.`deskripsi` AS `deskripsi`, `produk`.`foto` AS `foto`, `produk`.`id_etalase` AS `id_etalase`, `produk`.`id_penyedia` AS `id_penyedia`, `produk`.`no_item` AS `no_item`, `etalase`.`nama_etalase` AS `nama_etalase`, `kategori_etalase`.`nama_ke` AS `nama_ke`, `item`.`nama_item` AS `nama_item`, `penyedia`.`nama_penyedia` AS `nama_penyedia`, `penyedia`.`nama_perusahaan` AS `nama_perusahaan` FROM (((((((`paket` join `keranjang` on(`paket`.`id_paket` = `keranjang`.`id_paket`)) left join `negosiasi_harga` on(`keranjang`.`id_keranjang` = `negosiasi_harga`.`id_keranjang`)) join `produk` on(`keranjang`.`id_produk` = `produk`.`id_produk`)) join `etalase` on(`produk`.`id_etalase` = `etalase`.`id_etalase`)) join `kategori_etalase` on(`etalase`.`id_ke` = `kategori_etalase`.`id_ke`)) join `item` on(`produk`.`no_item` = `item`.`no_item`)) join `penyedia` on(`produk`.`id_penyedia` = `penyedia`.`id_penyedia`)) ;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indeks untuk tabel `berita`
--
ALTER TABLE `berita`
  ADD PRIMARY KEY (`id_berita`),
  ADD KEY `id_kb` (`id_kb`),
  ADD KEY `id_admin` (`id_admin`);

--
-- Indeks untuk tabel `etalase`
--
ALTER TABLE `etalase`
  ADD PRIMARY KEY (`id_etalase`),
  ADD KEY `id_ke` (`id_ke`);

--
-- Indeks untuk tabel `etalase_penyedia`
--
ALTER TABLE `etalase_penyedia`
  ADD KEY `id_penyedia` (`id_penyedia`),
  ADD KEY `id_etalase` (`id_etalase`);

--
-- Indeks untuk tabel `faq`
--
ALTER TABLE `faq`
  ADD PRIMARY KEY (`id_faq`),
  ADD KEY `id_admin` (`id_admin`);

--
-- Indeks untuk tabel `favorit`
--
ALTER TABLE `favorit`
  ADD PRIMARY KEY (`id_favorit`),
  ADD KEY `favorit_ibfk_1` (`id_produk`),
  ADD KEY `id_pumk` (`id_pumk`);

--
-- Indeks untuk tabel `item`
--
ALTER TABLE `item`
  ADD PRIMARY KEY (`no_item`),
  ADD KEY `id_etalase` (`id_etalase`);

--
-- Indeks untuk tabel `kak`
--
ALTER TABLE `kak`
  ADD PRIMARY KEY (`id_kak`),
  ADD KEY `id_pk` (`id_pk`);

--
-- Indeks untuk tabel `kategori_berita`
--
ALTER TABLE `kategori_berita`
  ADD PRIMARY KEY (`id_kb`);

--
-- Indeks untuk tabel `kategori_etalase`
--
ALTER TABLE `kategori_etalase`
  ADD PRIMARY KEY (`id_ke`);

--
-- Indeks untuk tabel `kategori_unduhan`
--
ALTER TABLE `kategori_unduhan`
  ADD PRIMARY KEY (`id_ku`);

--
-- Indeks untuk tabel `keranjang`
--
ALTER TABLE `keranjang`
  ADD PRIMARY KEY (`id_keranjang`),
  ADD KEY `id_paket` (`id_paket`),
  ADD KEY `keranjang_ibfk_1` (`id_produk`),
  ADD KEY `id_pumk` (`id_pumk`),
  ADD KEY `id_kak` (`id_kak`);

--
-- Indeks untuk tabel `lampiran`
--
ALTER TABLE `lampiran`
  ADD PRIMARY KEY (`id_lampiran`),
  ADD KEY `lampiran_ibfk_1` (`id_produk`);

--
-- Indeks untuk tabel `merek`
--
ALTER TABLE `merek`
  ADD PRIMARY KEY (`id_merek`),
  ADD KEY `merek_ibfk_1` (`id_pengumuman`);

--
-- Indeks untuk tabel `meta_produk`
--
ALTER TABLE `meta_produk`
  ADD PRIMARY KEY (`id_meta`),
  ADD KEY `meta_produk_ibfk_1` (`id_produk`);

--
-- Indeks untuk tabel `negosiasi_harga`
--
ALTER TABLE `negosiasi_harga`
  ADD KEY `id_keranjang` (`id_keranjang`);

--
-- Indeks untuk tabel `negosiasi_spesifikasi`
--
ALTER TABLE `negosiasi_spesifikasi`
  ADD PRIMARY KEY (`id_ns`),
  ADD KEY `id_paket` (`id_paket`);

--
-- Indeks untuk tabel `negosiasi_tanggal`
--
ALTER TABLE `negosiasi_tanggal`
  ADD PRIMARY KEY (`id_nt`),
  ADD KEY `id_paket` (`id_paket`);

--
-- Indeks untuk tabel `paket`
--
ALTER TABLE `paket`
  ADD PRIMARY KEY (`id_paket`),
  ADD KEY `id_pp` (`id_pp`),
  ADD KEY `id_penyedia` (`id_penyedia`);

--
-- Indeks untuk tabel `pengumuman`
--
ALTER TABLE `pengumuman`
  ADD PRIMARY KEY (`id_pengumuman`),
  ADD KEY `id_etalase` (`id_etalase`),
  ADD KEY `id_admin` (`id_admin`);

--
-- Indeks untuk tabel `penyedia`
--
ALTER TABLE `penyedia`
  ADD PRIMARY KEY (`id_penyedia`);

--
-- Indeks untuk tabel `pk`
--
ALTER TABLE `pk`
  ADD PRIMARY KEY (`id_pk`);

--
-- Indeks untuk tabel `pp`
--
ALTER TABLE `pp`
  ADD PRIMARY KEY (`id_pp`);

--
-- Indeks untuk tabel `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id_produk`),
  ADD KEY `id_etalase` (`id_etalase`),
  ADD KEY `id_user` (`id_penyedia`),
  ADD KEY `produk_ibfk_2` (`no_item`);

--
-- Indeks untuk tabel `pumk`
--
ALTER TABLE `pumk`
  ADD PRIMARY KEY (`id_pumk`);

--
-- Indeks untuk tabel `riwayat_nh`
--
ALTER TABLE `riwayat_nh`
  ADD KEY `id_paket` (`id_paket`) USING BTREE;

--
-- Indeks untuk tabel `riwayat_ns`
--
ALTER TABLE `riwayat_ns`
  ADD KEY `id_ns` (`id_ns`);

--
-- Indeks untuk tabel `riwayat_nt`
--
ALTER TABLE `riwayat_nt`
  ADD KEY `id_nt` (`id_nt`);

--
-- Indeks untuk tabel `riwayat_paket`
--
ALTER TABLE `riwayat_paket`
  ADD KEY `id_paket` (`id_paket`);

--
-- Indeks untuk tabel `riwayat_produk`
--
ALTER TABLE `riwayat_produk`
  ADD KEY `id_produk` (`id_produk`);

--
-- Indeks untuk tabel `tags`
--
ALTER TABLE `tags`
  ADD KEY `id_berita` (`id_berita`);

--
-- Indeks untuk tabel `tahapan_pengumuman`
--
ALTER TABLE `tahapan_pengumuman`
  ADD PRIMARY KEY (`id_tp`),
  ADD KEY `tahapan_pengumuman_ibfk_1` (`id_pengumuman`);

--
-- Indeks untuk tabel `unduhan`
--
ALTER TABLE `unduhan`
  ADD PRIMARY KEY (`id_unduhan`),
  ADD KEY `id_ku` (`id_ku`),
  ADD KEY `id_admin` (`id_admin`);

--
-- Indeks untuk tabel `unit_kerja`
--
ALTER TABLE `unit_kerja`
  ADD PRIMARY KEY (`kode_unit`);

--
-- Indeks untuk tabel `unit_pk`
--
ALTER TABLE `unit_pk`
  ADD KEY `kode_unit` (`kode_unit`),
  ADD KEY `id_pk` (`id_pk`);

--
-- Indeks untuk tabel `unit_pp`
--
ALTER TABLE `unit_pp`
  ADD KEY `id_pp` (`id_pp`),
  ADD KEY `kode_unit` (`kode_unit`);

--
-- Indeks untuk tabel `unit_pumk`
--
ALTER TABLE `unit_pumk`
  ADD KEY `id_pumk` (`id_pumk`),
  ADD KEY `kode_unit` (`kode_unit`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `berita`
--
ALTER TABLE `berita`
  MODIFY `id_berita` int(9) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `etalase`
--
ALTER TABLE `etalase`
  MODIFY `id_etalase` int(9) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `faq`
--
ALTER TABLE `faq`
  MODIFY `id_faq` int(9) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `favorit`
--
ALTER TABLE `favorit`
  MODIFY `id_favorit` int(9) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `kak`
--
ALTER TABLE `kak`
  MODIFY `id_kak` int(9) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `kategori_berita`
--
ALTER TABLE `kategori_berita`
  MODIFY `id_kb` int(9) NOT NULL AUTO_INCREMENT COMMENT 'id kategori_berita';

--
-- AUTO_INCREMENT untuk tabel `kategori_etalase`
--
ALTER TABLE `kategori_etalase`
  MODIFY `id_ke` int(9) NOT NULL AUTO_INCREMENT COMMENT 'id kategori_etalase';

--
-- AUTO_INCREMENT untuk tabel `kategori_unduhan`
--
ALTER TABLE `kategori_unduhan`
  MODIFY `id_ku` int(9) NOT NULL AUTO_INCREMENT COMMENT 'id kategori_unduhan';

--
-- AUTO_INCREMENT untuk tabel `keranjang`
--
ALTER TABLE `keranjang`
  MODIFY `id_keranjang` int(9) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `lampiran`
--
ALTER TABLE `lampiran`
  MODIFY `id_lampiran` int(9) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `merek`
--
ALTER TABLE `merek`
  MODIFY `id_merek` int(9) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `meta_produk`
--
ALTER TABLE `meta_produk`
  MODIFY `id_meta` int(9) NOT NULL AUTO_INCREMENT COMMENT 'id meta_produk';

--
-- AUTO_INCREMENT untuk tabel `negosiasi_spesifikasi`
--
ALTER TABLE `negosiasi_spesifikasi`
  MODIFY `id_ns` int(9) NOT NULL AUTO_INCREMENT COMMENT 'id negosiasi_spesifikasi';

--
-- AUTO_INCREMENT untuk tabel `negosiasi_tanggal`
--
ALTER TABLE `negosiasi_tanggal`
  MODIFY `id_nt` int(9) NOT NULL AUTO_INCREMENT COMMENT 'id negosiasi_tanggal';

--
-- AUTO_INCREMENT untuk tabel `paket`
--
ALTER TABLE `paket`
  MODIFY `id_paket` int(9) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `pengumuman`
--
ALTER TABLE `pengumuman`
  MODIFY `id_pengumuman` int(9) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `pk`
--
ALTER TABLE `pk`
  MODIFY `id_pk` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `produk`
--
ALTER TABLE `produk`
  MODIFY `id_produk` int(9) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `tahapan_pengumuman`
--
ALTER TABLE `tahapan_pengumuman`
  MODIFY `id_tp` int(9) NOT NULL AUTO_INCREMENT COMMENT 'id tahapan_pengumuman';

--
-- AUTO_INCREMENT untuk tabel `unduhan`
--
ALTER TABLE `unduhan`
  MODIFY `id_unduhan` int(9) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `berita`
--
ALTER TABLE `berita`
  ADD CONSTRAINT `berita_ibfk_1` FOREIGN KEY (`id_kb`) REFERENCES `kategori_berita` (`id_kb`),
  ADD CONSTRAINT `berita_ibfk_2` FOREIGN KEY (`id_admin`) REFERENCES `admin` (`id_admin`);

--
-- Ketidakleluasaan untuk tabel `etalase`
--
ALTER TABLE `etalase`
  ADD CONSTRAINT `etalase_ibfk_1` FOREIGN KEY (`id_ke`) REFERENCES `kategori_etalase` (`id_ke`);

--
-- Ketidakleluasaan untuk tabel `etalase_penyedia`
--
ALTER TABLE `etalase_penyedia`
  ADD CONSTRAINT `etalase_penyedia_ibfk_1` FOREIGN KEY (`id_penyedia`) REFERENCES `penyedia` (`id_penyedia`),
  ADD CONSTRAINT `etalase_penyedia_ibfk_2` FOREIGN KEY (`id_etalase`) REFERENCES `etalase` (`id_etalase`);

--
-- Ketidakleluasaan untuk tabel `faq`
--
ALTER TABLE `faq`
  ADD CONSTRAINT `faq_ibfk_1` FOREIGN KEY (`id_admin`) REFERENCES `admin` (`id_admin`);

--
-- Ketidakleluasaan untuk tabel `favorit`
--
ALTER TABLE `favorit`
  ADD CONSTRAINT `favorit_ibfk_1` FOREIGN KEY (`id_produk`) REFERENCES `produk` (`id_produk`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `favorit_ibfk_2` FOREIGN KEY (`id_pumk`) REFERENCES `pumk` (`id_pumk`);

--
-- Ketidakleluasaan untuk tabel `item`
--
ALTER TABLE `item`
  ADD CONSTRAINT `item_ibfk_1` FOREIGN KEY (`id_etalase`) REFERENCES `etalase` (`id_etalase`);

--
-- Ketidakleluasaan untuk tabel `kak`
--
ALTER TABLE `kak`
  ADD CONSTRAINT `kak_ibfk_1` FOREIGN KEY (`id_pk`) REFERENCES `pk` (`id_pk`);

--
-- Ketidakleluasaan untuk tabel `keranjang`
--
ALTER TABLE `keranjang`
  ADD CONSTRAINT `keranjang_ibfk_1` FOREIGN KEY (`id_produk`) REFERENCES `produk` (`id_produk`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `keranjang_ibfk_2` FOREIGN KEY (`id_paket`) REFERENCES `paket` (`id_paket`),
  ADD CONSTRAINT `keranjang_ibfk_3` FOREIGN KEY (`id_pumk`) REFERENCES `pumk` (`id_pumk`),
  ADD CONSTRAINT `keranjang_ibfk_4` FOREIGN KEY (`id_kak`) REFERENCES `kak` (`id_kak`);

--
-- Ketidakleluasaan untuk tabel `lampiran`
--
ALTER TABLE `lampiran`
  ADD CONSTRAINT `lampiran_ibfk_1` FOREIGN KEY (`id_produk`) REFERENCES `produk` (`id_produk`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `merek`
--
ALTER TABLE `merek`
  ADD CONSTRAINT `merek_ibfk_1` FOREIGN KEY (`id_pengumuman`) REFERENCES `pengumuman` (`id_pengumuman`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `meta_produk`
--
ALTER TABLE `meta_produk`
  ADD CONSTRAINT `meta_produk_ibfk_1` FOREIGN KEY (`id_produk`) REFERENCES `produk` (`id_produk`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `negosiasi_harga`
--
ALTER TABLE `negosiasi_harga`
  ADD CONSTRAINT `negosiasi_harga_ibfk_1` FOREIGN KEY (`id_keranjang`) REFERENCES `keranjang` (`id_keranjang`);

--
-- Ketidakleluasaan untuk tabel `negosiasi_spesifikasi`
--
ALTER TABLE `negosiasi_spesifikasi`
  ADD CONSTRAINT `negosiasi_spesifikasi_ibfk_1` FOREIGN KEY (`id_paket`) REFERENCES `paket` (`id_paket`);

--
-- Ketidakleluasaan untuk tabel `negosiasi_tanggal`
--
ALTER TABLE `negosiasi_tanggal`
  ADD CONSTRAINT `negosiasi_tanggal_ibfk_1` FOREIGN KEY (`id_paket`) REFERENCES `paket` (`id_paket`);

--
-- Ketidakleluasaan untuk tabel `paket`
--
ALTER TABLE `paket`
  ADD CONSTRAINT `paket_ibfk_1` FOREIGN KEY (`id_pp`) REFERENCES `pp` (`id_pp`),
  ADD CONSTRAINT `paket_ibfk_2` FOREIGN KEY (`id_penyedia`) REFERENCES `penyedia` (`id_penyedia`);

--
-- Ketidakleluasaan untuk tabel `pengumuman`
--
ALTER TABLE `pengumuman`
  ADD CONSTRAINT `pengumuman_ibfk_1` FOREIGN KEY (`id_etalase`) REFERENCES `etalase` (`id_etalase`),
  ADD CONSTRAINT `pengumuman_ibfk_2` FOREIGN KEY (`id_admin`) REFERENCES `admin` (`id_admin`);

--
-- Ketidakleluasaan untuk tabel `produk`
--
ALTER TABLE `produk`
  ADD CONSTRAINT `produk_ibfk_1` FOREIGN KEY (`id_etalase`) REFERENCES `etalase` (`id_etalase`),
  ADD CONSTRAINT `produk_ibfk_2` FOREIGN KEY (`no_item`) REFERENCES `item` (`no_item`);

--
-- Ketidakleluasaan untuk tabel `riwayat_nh`
--
ALTER TABLE `riwayat_nh`
  ADD CONSTRAINT `riwayat_nh_ibfk_1` FOREIGN KEY (`id_paket`) REFERENCES `paket` (`id_paket`);

--
-- Ketidakleluasaan untuk tabel `riwayat_ns`
--
ALTER TABLE `riwayat_ns`
  ADD CONSTRAINT `riwayat_ns_ibfk_1` FOREIGN KEY (`id_ns`) REFERENCES `negosiasi_spesifikasi` (`id_ns`);

--
-- Ketidakleluasaan untuk tabel `riwayat_nt`
--
ALTER TABLE `riwayat_nt`
  ADD CONSTRAINT `riwayat_nt_ibfk_1` FOREIGN KEY (`id_nt`) REFERENCES `negosiasi_tanggal` (`id_nt`);

--
-- Ketidakleluasaan untuk tabel `riwayat_paket`
--
ALTER TABLE `riwayat_paket`
  ADD CONSTRAINT `riwayat_paket_ibfk_1` FOREIGN KEY (`id_paket`) REFERENCES `paket` (`id_paket`);

--
-- Ketidakleluasaan untuk tabel `tags`
--
ALTER TABLE `tags`
  ADD CONSTRAINT `tags_ibfk_1` FOREIGN KEY (`id_berita`) REFERENCES `berita` (`id_berita`);

--
-- Ketidakleluasaan untuk tabel `tahapan_pengumuman`
--
ALTER TABLE `tahapan_pengumuman`
  ADD CONSTRAINT `tahapan_pengumuman_ibfk_1` FOREIGN KEY (`id_pengumuman`) REFERENCES `pengumuman` (`id_pengumuman`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `unduhan`
--
ALTER TABLE `unduhan`
  ADD CONSTRAINT `unduhan_ibfk_1` FOREIGN KEY (`id_ku`) REFERENCES `kategori_unduhan` (`id_ku`),
  ADD CONSTRAINT `unduhan_ibfk_2` FOREIGN KEY (`id_admin`) REFERENCES `admin` (`id_admin`);

--
-- Ketidakleluasaan untuk tabel `unit_pk`
--
ALTER TABLE `unit_pk`
  ADD CONSTRAINT `unit_pk_ibfk_1` FOREIGN KEY (`kode_unit`) REFERENCES `unit_kerja` (`kode_unit`) ON UPDATE CASCADE,
  ADD CONSTRAINT `unit_pk_ibfk_2` FOREIGN KEY (`id_pk`) REFERENCES `pk` (`id_pk`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `unit_pp`
--
ALTER TABLE `unit_pp`
  ADD CONSTRAINT `unit_pp_ibfk_1` FOREIGN KEY (`id_pp`) REFERENCES `pp` (`id_pp`),
  ADD CONSTRAINT `unit_pp_ibfk_2` FOREIGN KEY (`kode_unit`) REFERENCES `unit_kerja` (`kode_unit`);

--
-- Ketidakleluasaan untuk tabel `unit_pumk`
--
ALTER TABLE `unit_pumk`
  ADD CONSTRAINT `unit_pumk_ibfk_1` FOREIGN KEY (`id_pumk`) REFERENCES `pumk` (`id_pumk`),
  ADD CONSTRAINT `unit_pumk_ibfk_2` FOREIGN KEY (`kode_unit`) REFERENCES `unit_kerja` (`kode_unit`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
