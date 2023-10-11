-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 16 Sep 2022 pada 18.24
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
-- Struktur dari tabel `berita`
--

CREATE TABLE `berita` (
  `id_berita` int(9) NOT NULL,
  `judul` varchar(255) NOT NULL,
  `body` text NOT NULL,
  `penulis` varchar(255) NOT NULL,
  `tanggal` datetime DEFAULT current_timestamp(),
  `gambar` varchar(100) DEFAULT NULL,
  `id_kb` int(9) NOT NULL COMMENT 'id kategori_paket',
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struktur dari tabel `dummy_penyedia`
--

CREATE TABLE `dummy_penyedia` (
  `id_penyedia` int(9) NOT NULL,
  `nama_penyedia` varchar(255) DEFAULT NULL,
  `alamat` varchar(255) DEFAULT NULL
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
-- Struktur dari tabel `favorit`
--

CREATE TABLE `favorit` (
  `id_favorit` int(9) NOT NULL,
  `id_pmok` int(9) NOT NULL,
  `id_produk` int(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
  `id_produk` int(9) NOT NULL,
  `id_pmok` int(9) NOT NULL,
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
  `id_pengumuman` int(9) NOT NULL,
  `id_etalase` int(9) NOT NULL
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
  `id_nh` int(9) NOT NULL COMMENT 'id negosiasi_harga',
  `nominal` int(11) UNSIGNED NOT NULL,
  `ongkir` int(11) UNSIGNED DEFAULT NULL,
  `tanggal_pengiriman` datetime DEFAULT NULL,
  `catatan_pembeli` varchar(2000) DEFAULT NULL,
  `id_paket` int(9) NOT NULL,
  `id_pbj` int(9) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Trigger `negosiasi_harga`
--
DELIMITER $$
CREATE TRIGGER `after_insert_riwayat_nh` AFTER INSERT ON `negosiasi_harga` FOR EACH ROW BEGIN
				INSERT INTO riwayat_nh
				(id_nh, aksi, tanggal, nominal, ongkir, tanggal_pengiriman, catatan_pembeli, id_pbj)
				VALUE
				(NEW.id_nh, "Negosiasi dimulai", NOW(), NEW.nominal, NEW.ongkir, NEW.tanggal_pengiriman, NEW.catatan_pembeli, NEW.id_pbj);
			END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `after_update_riwayat_nh` AFTER UPDATE ON `negosiasi_harga` FOR EACH ROW BEGIN
				DECLARE aksi VARCHAR(255) DEFAULT "Ubah ";
				DECLARE nominal INT(11);
				DECLARE ongkir INT(11);
				DECLARE tanggal_pengiriman DATETIME;
				DECLARE catatan_pembeli VARCHAR(2000);
                DECLARE id_pbj INT(9);

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
                
                IF NOT OLD.id_pbj <=> NEW.id_pbj THEN 
					SET id_pbj = NEW.id_pbj;
					SET aksi = CONCAT(aksi, "pbj, ");
				END IF;

				INSERT INTO riwayat_nh
				(`id_nh`, `aksi`, `tanggal`, `nominal`, `ongkir`, `tanggal_pengiriman`, `catatan_pembeli`, `id_pbj`)
				VALUE
				(OLD.id_nh, aksi, NOW(), nominal, ongkir, tanggal_pengiriman, catatan_pembeli, id_pbj);
			END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `negosiasi_spesifikasi`
--

CREATE TABLE `negosiasi_spesifikasi` (
  `id_ns` int(9) NOT NULL COMMENT 'id negosiasi_spesifikasi',
  `spesifikasi` varchar(255) NOT NULL,
  `nilai` varchar(255) NOT NULL,
  `catatan_pembeli` varchar(2000) DEFAULT NULL,
  `id_paket` int(9) NOT NULL,
  `id_pbj` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Trigger `negosiasi_spesifikasi`
--
DELIMITER $$
CREATE TRIGGER `after_insert_riwayat_ns` AFTER INSERT ON `negosiasi_spesifikasi` FOR EACH ROW BEGIN
				INSERT INTO riwayat_ns
				(id_ns, aksi, tanggal, spesifikasi, nilai, catatan_pembeli, id_pbj)
				VALUE
				(NEW.id_ns, "Negosiasi dimulai", NOW(), NEW.spesifikasi, NEW.nilai, NEW.catatan_pembeli, NEW.id_pbj);
			END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `after_update_riwayat_ns` AFTER UPDATE ON `negosiasi_spesifikasi` FOR EACH ROW BEGIN
				DECLARE aksi VARCHAR(255) DEFAULT "Ubah ";
				DECLARE spesifikasi VARCHAR(255);
				DECLARE nilai VARCHAR(255);
				DECLARE catatan_pembeli VARCHAR(2000);
                DECLARE id_pbj INT(9);

				IF NOT OLD.spesifikasi <=> NEW.spesifikasi THEN 
					SET spesifikasi = NEW.spesifikasi;
					SET aksi = CONCAT(aksi, "spesifikasi, ");
				END IF;

				IF NOT OLD.nilai <=> NEW.nilai THEN 
					SET nilai = NEW.nilai;
					SET aksi = CONCAT(aksi, "nilai, ");
				END IF;
                
                IF NOT OLD.id_pbj <=> NEW.id_pbj THEN 
					SET id_pbj = NEW.id_pbj;
					SET aksi = CONCAT(aksi, "pbj, ");
				END IF;

				IF NOT OLD.catatan_pembeli <=> NEW.catatan_pembeli OR OLD.catatan_pembeli IS NULL THEN 
					SET catatan_pembeli = NEW.catatan_pembeli;
					SET aksi = CONCAT(aksi, "catatan_pembeli, ");
				END IF;

				INSERT INTO riwayat_ns
				(`id_ns`, `aksi`, `tanggal`, `spesifikasi`, `nilai`, `catatan_pembeli`, `id_pbj`)
				VALUE
				(OLD.id_ns, aksi, NOW(), spesifikasi, nilai, catatan_pembeli, id_pbj);
			END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `paket`
--

CREATE TABLE `paket` (
  `id_paket` int(9) NOT NULL,
  `id_pbj` int(9) DEFAULT NULL COMMENT 'Reviewer',
  `no_anggaran` varchar(50) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `tanggal` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Trigger `paket`
--
DELIMITER $$
CREATE TRIGGER `after_insert_paket` AFTER INSERT ON `paket` FOR EACH ROW BEGIN
				INSERT INTO riwayat_paket
				(id_paket, aksi, tanggal, id_pbj, no_anggaran, status)
				VALUE
				(NEW.id_paket, "Paket dibuat", NOW(), NEW.id_pbj, NEW.no_anggaran, NEW.status);
			END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `after_update_paket` AFTER UPDATE ON `paket` FOR EACH ROW BEGIN
				DECLARE aksi VARCHAR(255) DEFAULT "Ubah ";
				DECLARE id_pbj INT;
				DECLARE no_anggaran VARCHAR(50);
				DECLARE status TINYINT;

				IF NOT OLD.id_pbj <=> NEW.id_pbj THEN 
					SET id_pbj = NEW.id_pbj;
					SET aksi = CONCAT(aksi, "pbj, ");
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
				(`id_paket`, `aksi`, `tanggal`, `id_pbj`, `no_anggaran`, `status`)
				VALUE
				(OLD.id_paket, aksi, NOW(), id_pbj, no_anggaran, status);
			END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengiriman`
--

CREATE TABLE `pengiriman` (
  `id_pengiriman` int(9) NOT NULL,
  `uraian_pekerjaan` varchar(255) NOT NULL,
  `id_paket` int(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
  `penulis` varchar(255) NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struktur dari tabel `produk`
--

CREATE TABLE `produk` (
  `id_produk` int(9) NOT NULL,
  `nama_produk` varchar(255) NOT NULL,
  `harga` int(10) UNSIGNED NOT NULL,
  `masa_berlaku` date DEFAULT NULL,
  `merk` varchar(255) NOT NULL,
  `no_produk_penyedia` varchar(255) DEFAULT NULL,
  `unit_pengukuran` varchar(100) DEFAULT NULL,
  `kode_kbki` varchar(100) NOT NULL,
  `nilai_tkdn` decimal(3,2) DEFAULT NULL,
  `stok` int(11) NOT NULL,
  `deskripsi` text DEFAULT NULL,
  `foto` varchar(100) DEFAULT NULL,
  `id_etalase` int(9) NOT NULL,
  `id_penyedia` int(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Trigger `produk`
--
DELIMITER $$
CREATE TRIGGER `after_delete_produk` AFTER DELETE ON `produk` FOR EACH ROW BEGIN
				INSERT INTO riwayat_produk
				(id_produk, aksi, tanggal, nama_produk, harga, masa_berlaku, merk, no_produk_penyedia, unit_pengukuran, kode_kbki, nilai_tkdn, stok, deskripsi, foto, id_etalase, id_penyedia)
				VALUE
				(OLD.id_produk, "produk dihapus", NOW(), OLD.nama_produk, OLD.harga, OLD.masa_berlaku, OLD.merk, OLD.no_produk_penyedia, OLD.unit_pengukuran, OLD.kode_kbki, OLD.nilai_tkdn, OLD.stok, OLD.deskripsi, OLD.foto, OLD.id_etalase, OLD.id_penyedia);
			END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `after_insert_produk` AFTER INSERT ON `produk` FOR EACH ROW BEGIN
				INSERT INTO riwayat_produk
				(id_produk, aksi, tanggal, nama_produk, harga, masa_berlaku, merk, no_produk_penyedia, unit_pengukuran, kode_kbki, nilai_tkdn, stok, deskripsi, foto, id_etalase)
				VALUE
				(NEW.id_produk, "produk dibuat", NOW(), NEW.nama_produk, NEW.harga, NEW.masa_berlaku, NEW.merk, NEW.no_produk_penyedia, NEW.unit_pengukuran, NEW.kode_kbki, NEW.nilai_tkdn, NEW.stok, NEW.deskripsi, NEW.foto, NEW.id_etalase);
			END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `after_update_produk` AFTER UPDATE ON `produk` FOR EACH ROW BEGIN
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
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `riwayat_nh`
--

CREATE TABLE `riwayat_nh` (
  `id_nh` int(9) NOT NULL COMMENT 'id negosiasi_harga',
  `aksi` varchar(255) NOT NULL,
  `tanggal` datetime DEFAULT current_timestamp(),
  `nominal` int(11) UNSIGNED DEFAULT NULL,
  `ongkir` int(11) UNSIGNED DEFAULT NULL,
  `tanggal_pengiriman` datetime DEFAULT NULL,
  `catatan_pembeli` varchar(2000) DEFAULT NULL,
  `catatan_penyedia` varchar(2000) DEFAULT NULL,
  `id_pbj` int(9) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struktur dari tabel `riwayat_ns`
--

CREATE TABLE `riwayat_ns` (
  `id_ns` int(9) NOT NULL COMMENT 'id negosiasi_spesifikasi',
  `aksi` varchar(255) NOT NULL,
  `tanggal` datetime DEFAULT current_timestamp(),
  `spesifikasi` varchar(255) DEFAULT NULL,
  `nilai` varchar(255) DEFAULT NULL,
  `catatan_pembeli` varchar(2000) DEFAULT NULL,
  `catatan_penyedia` varchar(2000) DEFAULT NULL,
  `id_pbj` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struktur dari tabel `riwayat_paket`
--

CREATE TABLE `riwayat_paket` (
  `id_paket` int(9) NOT NULL,
  `aksi` varchar(255) NOT NULL,
  `tanggal` datetime DEFAULT current_timestamp(),
  `id_ppk` int(9) DEFAULT NULL,
  `no_anggaran` varchar(50) DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  `id_pbj` int(9) DEFAULT NULL
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
  `masa_berlaku` date DEFAULT NULL,
  `merk` varchar(255) DEFAULT NULL,
  `no_produk_penyedia` varchar(255) DEFAULT NULL,
  `unit_pengukuran` varchar(100) DEFAULT NULL,
  `kode_kbki` varchar(100) DEFAULT NULL,
  `nilai_tkdn` decimal(3,2) DEFAULT NULL,
  `stok` int(11) DEFAULT NULL,
  `deskripsi` text DEFAULT NULL,
  `foto` varchar(100) DEFAULT NULL,
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
  `penulis` varchar(255) NOT NULL,
  `file` varchar(255) NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `berita`
--
ALTER TABLE `berita`
  ADD PRIMARY KEY (`id_berita`),
  ADD KEY `id_kb` (`id_kb`);

--
-- Indeks untuk tabel `dummy_penyedia`
--
ALTER TABLE `dummy_penyedia`
  ADD PRIMARY KEY (`id_penyedia`);

--
-- Indeks untuk tabel `etalase`
--
ALTER TABLE `etalase`
  ADD PRIMARY KEY (`id_etalase`),
  ADD KEY `id_ke` (`id_ke`);

--
-- Indeks untuk tabel `favorit`
--
ALTER TABLE `favorit`
  ADD PRIMARY KEY (`id_favorit`),
  ADD KEY `favorit_ibfk_1` (`id_produk`);

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
  ADD KEY `id_paket` (`id_paket`),
  ADD KEY `keranjang_ibfk_1` (`id_produk`);

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
  ADD KEY `id_etalase` (`id_etalase`),
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
  ADD PRIMARY KEY (`id_nh`),
  ADD KEY `id_paket` (`id_paket`);

--
-- Indeks untuk tabel `negosiasi_spesifikasi`
--
ALTER TABLE `negosiasi_spesifikasi`
  ADD PRIMARY KEY (`id_ns`),
  ADD KEY `id_paket` (`id_paket`);

--
-- Indeks untuk tabel `paket`
--
ALTER TABLE `paket`
  ADD PRIMARY KEY (`id_paket`);

--
-- Indeks untuk tabel `pengiriman`
--
ALTER TABLE `pengiriman`
  ADD PRIMARY KEY (`id_pengiriman`),
  ADD KEY `id_paket` (`id_paket`);

--
-- Indeks untuk tabel `pengumuman`
--
ALTER TABLE `pengumuman`
  ADD PRIMARY KEY (`id_pengumuman`),
  ADD KEY `id_etalase` (`id_etalase`);

--
-- Indeks untuk tabel `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id_produk`),
  ADD KEY `id_etalase` (`id_etalase`);

--
-- Indeks untuk tabel `riwayat_nh`
--
ALTER TABLE `riwayat_nh`
  ADD KEY `id_nh` (`id_nh`);

--
-- Indeks untuk tabel `riwayat_ns`
--
ALTER TABLE `riwayat_ns`
  ADD KEY `id_ns` (`id_ns`);

--
-- Indeks untuk tabel `riwayat_paket`
--
ALTER TABLE `riwayat_paket`
  ADD KEY `id_paket` (`id_paket`);

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
  ADD KEY `id_ku` (`id_ku`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `berita`
--
ALTER TABLE `berita`
  MODIFY `id_berita` int(9) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `dummy_penyedia`
--
ALTER TABLE `dummy_penyedia`
  MODIFY `id_penyedia` int(9) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `etalase`
--
ALTER TABLE `etalase`
  MODIFY `id_etalase` int(9) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `favorit`
--
ALTER TABLE `favorit`
  MODIFY `id_favorit` int(9) NOT NULL AUTO_INCREMENT;

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
-- AUTO_INCREMENT untuk tabel `negosiasi_harga`
--
ALTER TABLE `negosiasi_harga`
  MODIFY `id_nh` int(9) NOT NULL AUTO_INCREMENT COMMENT 'id negosiasi_harga';

--
-- AUTO_INCREMENT untuk tabel `negosiasi_spesifikasi`
--
ALTER TABLE `negosiasi_spesifikasi`
  MODIFY `id_ns` int(9) NOT NULL AUTO_INCREMENT COMMENT 'id negosiasi_spesifikasi';

--
-- AUTO_INCREMENT untuk tabel `paket`
--
ALTER TABLE `paket`
  MODIFY `id_paket` int(9) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `pengiriman`
--
ALTER TABLE `pengiriman`
  MODIFY `id_pengiriman` int(9) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `pengumuman`
--
ALTER TABLE `pengumuman`
  MODIFY `id_pengumuman` int(9) NOT NULL AUTO_INCREMENT;

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
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `berita`
--
ALTER TABLE `berita`
  ADD CONSTRAINT `berita_ibfk_1` FOREIGN KEY (`id_kb`) REFERENCES `kategori_berita` (`id_kb`);

--
-- Ketidakleluasaan untuk tabel `etalase`
--
ALTER TABLE `etalase`
  ADD CONSTRAINT `etalase_ibfk_1` FOREIGN KEY (`id_ke`) REFERENCES `kategori_etalase` (`id_ke`);

--
-- Ketidakleluasaan untuk tabel `favorit`
--
ALTER TABLE `favorit`
  ADD CONSTRAINT `favorit_ibfk_1` FOREIGN KEY (`id_produk`) REFERENCES `produk` (`id_produk`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `keranjang`
--
ALTER TABLE `keranjang`
  ADD CONSTRAINT `keranjang_ibfk_1` FOREIGN KEY (`id_produk`) REFERENCES `produk` (`id_produk`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `keranjang_ibfk_2` FOREIGN KEY (`id_paket`) REFERENCES `paket` (`id_paket`);

--
-- Ketidakleluasaan untuk tabel `lampiran`
--
ALTER TABLE `lampiran`
  ADD CONSTRAINT `lampiran_ibfk_1` FOREIGN KEY (`id_produk`) REFERENCES `produk` (`id_produk`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `merek`
--
ALTER TABLE `merek`
  ADD CONSTRAINT `merek_ibfk_1` FOREIGN KEY (`id_pengumuman`) REFERENCES `pengumuman` (`id_pengumuman`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `merek_ibfk_2` FOREIGN KEY (`id_etalase`) REFERENCES `etalase` (`id_etalase`);

--
-- Ketidakleluasaan untuk tabel `meta_produk`
--
ALTER TABLE `meta_produk`
  ADD CONSTRAINT `meta_produk_ibfk_1` FOREIGN KEY (`id_produk`) REFERENCES `produk` (`id_produk`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `negosiasi_harga`
--
ALTER TABLE `negosiasi_harga`
  ADD CONSTRAINT `negosiasi_harga_ibfk_1` FOREIGN KEY (`id_paket`) REFERENCES `paket` (`id_paket`);

--
-- Ketidakleluasaan untuk tabel `negosiasi_spesifikasi`
--
ALTER TABLE `negosiasi_spesifikasi`
  ADD CONSTRAINT `negosiasi_spesifikasi_ibfk_1` FOREIGN KEY (`id_paket`) REFERENCES `paket` (`id_paket`);

--
-- Ketidakleluasaan untuk tabel `pengiriman`
--
ALTER TABLE `pengiriman`
  ADD CONSTRAINT `pengiriman_ibfk_1` FOREIGN KEY (`id_paket`) REFERENCES `paket` (`id_paket`);

--
-- Ketidakleluasaan untuk tabel `pengumuman`
--
ALTER TABLE `pengumuman`
  ADD CONSTRAINT `pengumuman_ibfk_1` FOREIGN KEY (`id_etalase`) REFERENCES `etalase` (`id_etalase`);

--
-- Ketidakleluasaan untuk tabel `produk`
--
ALTER TABLE `produk`
  ADD CONSTRAINT `produk_ibfk_1` FOREIGN KEY (`id_etalase`) REFERENCES `etalase` (`id_etalase`);

--
-- Ketidakleluasaan untuk tabel `riwayat_nh`
--
ALTER TABLE `riwayat_nh`
  ADD CONSTRAINT `riwayat_nh_ibfk_1` FOREIGN KEY (`id_nh`) REFERENCES `negosiasi_harga` (`id_nh`);

--
-- Ketidakleluasaan untuk tabel `riwayat_ns`
--
ALTER TABLE `riwayat_ns`
  ADD CONSTRAINT `riwayat_ns_ibfk_1` FOREIGN KEY (`id_ns`) REFERENCES `negosiasi_spesifikasi` (`id_ns`);

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
  ADD CONSTRAINT `unduhan_ibfk_1` FOREIGN KEY (`id_ku`) REFERENCES `kategori_unduhan` (`id_ku`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
