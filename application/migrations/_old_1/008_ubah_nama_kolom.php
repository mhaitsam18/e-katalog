<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Migration_Ubah_Nama_Kolom extends CI_Migration
{
	/**
	 * Daftar tabel untuk diganti nama kolom id dan nama
	 * 
	 * @var array
	 */
	private $_tables = [
		// [nama_tabel, nama_id, panjang varchar kolom nama]
		['anggaran'],
		['berita'],
		['etalase', '', 255],
		['favorit'],
		['kategori_berita', 'kb', 50],
		['kategori_etalase', 'ke', 50],
		['kategori_unduhan', 'ku', 50],
		['lampiran', '', 255],
		['merek', '', 255],
		['meta_produk', 'meta'],
		['negosiasi_harga', 'nh'],
		['negosiasi_spesifikasi', 'ns'],
		['paket'],
		['pengumuman'],
		['produk', '', 255],
		['tahapan_pengumuman', 'tp'],
		['unduhan', '', 255],
	];

	/**
	 * Daftar constraint foreign key
	 * 
	 * @var array
	 */
	private $_constraints = [
		// [nama_tabel, nama_constraint, hubungan tabel, sufiks]
		['berita', 'berita_ibfk_1', 'kategori_berita', 'kb'],
		['etalase', 'etalase_ibfk_1', 'kategori_etalase', 'ke'],
		['favorit', 'favorit_ibfk_1', 'produk'],
		['keranjang', 'keranjang_ibfk_1', 'produk'],
		['keranjang', 'keranjang_ibfk_2', 'paket'],
		['lampiran', 'lampiran_ibfk_1', 'produk'],
		['merek', 'merek_ibfk_1', 'pengumuman'],
		['merek', 'merek_ibfk_2', 'etalase'],
		['meta_produk', 'meta_produk_ibfk_1', 'produk'],
		['negosiasi_spesifikasi', 'negosiasi_spesifikasi_ibfk_1', 'paket'],
		['negosiasi_harga', 'negosiasi_harga_ibfk_1', 'paket'],
		['paket', 'paket_ibfk_2', 'anggaran'],
		['pengumuman', 'pengumuman_ibfk_1', 'etalase'],
		['produk', 'produk_ibfk_1', 'etalase'],
		['riwayat_nh', 'riwayat_nh_ibfk_1', 'negosiasi_harga', 'nh'],
		['riwayat_ns', 'riwayat_ns_ibfk_1', 'negosiasi_spesifikasi', 'ns'],
		['riwayat_paket', 'riwayat_paket_ibfk_1', 'paket'],
		['tags', 'tags_ibfk_1', 'berita'],
		['tahapan_pengumuman', 'tahapan_pengumuman_ibfk_1', 'pengumuman'],
		['unduhan', 'unduhan_ibfk_1', 'kategori_unduhan', 'ku'],
	];

	public function up()
	{
		echo PHP_EOL . "--- Migrasi 8 ---" . PHP_EOL;

		// Hapus semua hubungan foreign key
		foreach ($this->_constraints as $constraint) {
			$this->db->query("ALTER TABLE $constraint[0] DROP FOREIGN KEY $constraint[1]");
			echo "Hapus foreign key $constraint[1]".PHP_EOL;
		}

		// Hapus isi tabel
		$this->_clean();

		// Ubah nama kolom untuk kategori
		$this->db->query('ALTER TABLE etalase CHANGE COLUMN id_kategori_etalase id_ke INT(9) NOT NULL COMMENT "id kategori_etalase"');
		echo "Kolom `id_kategori_etalase` diubah menjadi `id_ke` di tabel etalase".PHP_EOL;

		$this->db->query('ALTER TABLE unduhan CHANGE COLUMN id_kategori_unduhan id_ku INT(9) NOT NULL COMMENT "id kategori_unduhan"');
		echo "Kolom `id_kategori_unduhan` diubah menjadi `id_ku` di tabel unduhan".PHP_EOL;

		$this->db->query('ALTER TABLE berita CHANGE COLUMN id_kategori_berita id_kb INT(9) NOT NULL COMMENT "id kategori_paket"');
		echo "Kolom `id_kategori_berita` diubah menjadi `id_kb` di tabel berita".PHP_EOL;

		// Ubah nama kolom id dan nama
		foreach ($this->_tables as $table) {
			$nama_id = $table[0];
			$comment = '';
			$tambahan = '';
			$pesan = '';

			if (! empty($table[1])) {
				$nama_id = $table[1];
				$comment = ' COMMENT "id '.$table[0].'"';
			}

			if (isset($table[2])) {
				$tambahan = ", CHANGE COLUMN nama nama_$nama_id VARCHAR($table[2]) NOT NULL";
				$pesan = "Kolom `nama` diubah menjadi `nama_$nama_id` di tabel $table[0]".PHP_EOL;
			}

			$query = "ALTER TABLE $table[0] CHANGE COLUMN id id_$nama_id INT(9) NOT NULL AUTO_INCREMENT".$comment.$tambahan;

			$this->db->query($query);
			echo "Kolom `id` diubah menjadi `id_$nama_id` di tabel $table[0]".PHP_EOL;
			echo $pesan;
		}

		// Hubungkan ulang foreign key
		foreach ($this->_constraints as $constraint) {
			$nama_id = isset($constraint[3]) ? $constraint[3] : $constraint[2];

			$this->db->query("ALTER TABLE $constraint[0] ADD FOREIGN KEY (id_$nama_id) REFERENCES $constraint[2](id_$nama_id)");
			echo "Tambah foreign key di tabel $constraint[0] (id_$nama_id)" . PHP_EOL;
		}
	}

	public function down()
	{
		echo PHP_EOL . "--- Migrasi 8 ---" . PHP_EOL;

		// Ganti nama constraint pada tabel paket sesuai dengan hasil method up() di atas
		$this->_constraints[11] = ['paket', 'paket_ibfk_1', 'anggaran'];

		// Hapus semua hubungan foreign key
		foreach ($this->_constraints as $constraint) {
			$this->db->query("ALTER TABLE $constraint[0] DROP FOREIGN KEY $constraint[1]");
			echo "Hapus foreign key $constraint[1]" . PHP_EOL;
		}

		// Hapus isi tabel
		$this->_clean(TRUE);

		// Ubah nama kolom untuk kategori
		$this->db->query('ALTER TABLE etalase CHANGE COLUMN id_ke id_kategori_etalase INT(9) NOT NULL');
		echo "Kolom `id_ke` diubah menjadi `id_kategori_etalase` di tabel etalase" . PHP_EOL;

		$this->db->query('ALTER TABLE unduhan CHANGE COLUMN id_ku id_kategori_unduhan INT(9) NOT NULL');
		echo "Kolom `id_ku` diubah menjadi `id_kategori_unduhan` di tabel unduhan" . PHP_EOL;

		$this->db->query('ALTER TABLE berita CHANGE COLUMN id_kb id_kategori_berita INT(9) NOT NULL');
		echo "Kolom `id_kb` diubah menjadi `id_kategori_berita` di tabel berita" . PHP_EOL;

		// Ubah nama kolom id dan nama
		foreach ($this->_tables as $table) {
			$nama_id = $table[0];
			$tambahan = '';
			$pesan = '';

			if (!empty($table[1])) {
				$nama_id = $table[1];
			}

			if (isset($table[2])) {
				$tambahan = ", CHANGE COLUMN nama_$nama_id nama VARCHAR($table[2]) NOT NULL";
				$pesan = "Kolom `nama_$nama_id` diubah menjadi `nama` di tabel $table[0]" . PHP_EOL;
			}

			$query = "ALTER TABLE $table[0] CHANGE COLUMN id_$nama_id id INT(9) NOT NULL AUTO_INCREMENT" . $tambahan;

			$this->db->query($query);
			echo "Kolom `id_$nama_id` diubah menjadi `id` di tabel $table[0]" . PHP_EOL;
			echo $pesan;
		}

		// Hubungkan ulang foreign key
		foreach ($this->_constraints as $constraint) {
			$nama_id = $constraint[2];

			if ($constraint[0] === 'riwayat_nh' || $constraint[0] === 'riwayat_ns') {
				$nama_id = $constraint[3];
			}

			$this->db->query("ALTER TABLE $constraint[0] ADD FOREIGN KEY (id_$nama_id) REFERENCES $constraint[2](id)");
			echo "Tambah foreign key di tabel $constraint[0] (id_$nama_id)" . PHP_EOL;
		}
	}

	/**
	 * Bersihkan isi semua tabel
	 * 
	 * @param bool $all Semua tabel dihapus?
	 */
	private function _clean($all = FALSE)
	{
		$tables = [
			'anggaran',
			'berita',
			'etalase',
			'favorit',
			'keranjang',
			'lampiran',
			'merek',
			'meta_produk',
			'negosiasi_harga',
			'negosiasi_spesifikasi',
			'paket',
			'pengumuman',
			'produk',
			'tags',
			'tahapan_pengumuman',
			'unduhan'
		];

		if ($all) {
			array_push($tables, 'riwayat_ns', 'riwayat_nh', 'riwayat_paket');
		}

		foreach ($tables as $table) {
			$this->db->query("TRUNCATE TABLE $table");
			echo "Isi $table dihapus!".PHP_EOL;
		}
	}
}
