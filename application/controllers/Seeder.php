<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Seeder
 *
 * Controller untuk seeding database.
 * Isi database menggunakan library FakerPHP.
 *
 */
class Seeder extends CI_controller {

	/**
	 * Jumlah kategori berita
	 *
	 * @var int
	 */
	private $_jmlKatBerita;

	/**
	 * Jumlah kategori etalase
	 *
	 * @var int
	 */
	private $_jmlKatEtalase;

	/**
	 * Jumlah kategori unduhan
	 *
	 * @var int
	 */
	private $_jmlKatUnduhan;

	//---------------------------------

	public function __construct()
	{
		parent::__construct();

		if (ENVIRONMENT !== 'development') show_404();
	}

	public function index()
	{
		$faker = \Faker\Factory::create('id_ID');

		// --------------
		// User
		// --------------

		$kodeUnit = [];

		for ($i=0; $i < 3; $i++) {
			$dataUnit = [
				'kode_unit' => $faker->randomNumber(7, TRUE),
				'nama_unit' => 'Unit ' . chr(65 + $i),
				'is_faculty' => $faker->randomElement([0, 1]),
				'nickname' => 'U'.chr(65 + $i),
				'jenis' => 	$faker->randomElement(['F', 'D', 'N', 'R']),
			];

			$kodeUnit[] += $dataUnit['kode_unit'];

			$this->db->insert('unit_kerja', $dataUnit);
		}
		echo 'Isi tabel unit_kerja selesai'.PHP_EOL;


		for ($i=0; $i < 2; $i++) {
			$dataUser = [
				'email' => 'admin'.$i.'@e-katalog.com',
				'password' => password_hash('admin'.$i, PASSWORD_DEFAULT),
				'level' => 'admin',
			];

			$this->db->insert('user', $dataUser);
			$id_user = $this->db->insert_id();

			$dataAdmin = [
				'id_admin' => $id_user,
				'nama_admin' => $faker->name(),
				'jabatan_admin' => 'Admin '.($i+1)
			];

			$this->db->insert('admin', $dataAdmin);
		}
		echo 'Isi tabel admin selesai'.PHP_EOL;

		for ($i=0; $i < 2; $i++) {
			$dataUser = [
				'email' => 'pumk'.$i.'@e-katalog.com',
				'password' => password_hash('pumk'.$i, PASSWORD_DEFAULT),
				'level' => 'pumk',
			];

			$this->db->insert('user', $dataUser);
			$id_user = $this->db->insert_id();

			$dataPumk = [
				'id_pumk' => $id_user,
				'nama_pumk' => $faker->name(),
				'alamat_pumk' => $faker->address(),
				'jabatan_pumk' => 'Jabatan PUMK '.$i,
			];

			$this->db->insert('pumk', $dataPumk);
		}
		echo 'Isi tabel pumk selesai'.PHP_EOL;

		for ($i=0; $i < 4; $i++) {
			$data= [
				'id_pumk' => $faker->randomElement([3, 4]),
				'kode_unit' => $faker->randomElement($kodeUnit),
			];

			$this->db->insert('unit_pumk', $data);
		}
		echo 'Isi tabel unit_pumk selesai'.PHP_EOL;

		for ($i=0; $i < 5; $i++) {
			$dataUser = [
				'email' => 'pp'.$i.'@e-katalog.com',
				'password' => password_hash('pp'.$i, PASSWORD_DEFAULT),
				'level' => 'pp',
			];

			$this->db->insert('user', $dataUser);
			$id_user = $this->db->insert_id();

			$data = [
				'id_pp' => $id_user,
				'nama_pp' => $faker->name(),
				'jabatan_pp' => 'Jabatan PP '.$i,
			];

			$this->db->insert('pp', $data);
		}
		echo 'Isi tabel pp selesai'.PHP_EOL;

		for ($i=0; $i < 7; $i++) {
			$data= [
				'id_pp' => $faker->randomElement([5, 6, 7, 8, 9]),
				'kode_unit' => $faker->randomElement($kodeUnit),
			];

			$this->db->insert('unit_pp', $data);
		}
		echo 'Isi tabel unit_pp selesai'.PHP_EOL;

		for ($i=0; $i < 3; $i++) {
			$dataUser = [
				'email' => 'penyedia'.$i.'@e-katalog.com',
				'password' => password_hash('penyedia'.$i, PASSWORD_DEFAULT),
				'level' => 'penyedia',
			];

			$this->db->insert('user', $dataUser);
			$id_user = $this->db->insert_id();

			$data = [
				'id_penyedia' => $id_user,
				'nama_penyedia' => $faker->name(),
				'alamat_penyedia' => $faker->address(),
				'nama_perusahaan' => $faker->company(),
				'bank' => 'Bank '.chr(65 + $i),
				'norek' => $faker->creditCardNumber(),
			];

			$this->db->insert('penyedia', $data);
		}
		echo 'Isi tabel penyedia selesai'.PHP_EOL;

		for ($i=0; $i < 5; $i++) {
			$dataPk= [
				'nama_pk' => $faker->name(),
				'nip' => $faker->randomNumber(9, TRUE).$faker->randomNumber(9, TRUE),
			];

			$this->db->insert('pk', $dataPk);
		}
		echo 'Isi tabel pk selesai'.PHP_EOL;

		for ($i=0; $i < 10; $i++) {
			$dataPk= [
				'id_pk' => $faker->numberBetween(1, 5),
				'kode_unit' => $faker->randomElement($kodeUnit),
			];

			$this->db->insert('unit_pk', $dataPk);
		}
		echo 'Isi tabel unit_pk selesai'.PHP_EOL;


		// Isi tabel-tabel kategori
		// yang tidak bisa random
		$this->_isiKategori();


		// --------------
		// Produk & Paket
		// --------------

		for ($i=0; $i < 10; $i++) {
			$dataEtalase= [
				'nama_etalase' => 'Etalase '.$i,
				'id_ke' => $faker->numberBetween(1, $this->_jmlKatEtalase),
			];

			$this->db->insert('etalase', $dataEtalase);
		}
		echo 'Isi tabel etalase selesai'.PHP_EOL;

		for ($i=0; $i < 6; $i++) { 
			$dataEp = [
				'id_penyedia' => intdiv($i, 3) + 10,
				'id_etalase'  => $i + 1,
			];

			$this->db->insert('etalase_penyedia', $dataEp);
		}
		echo 'Isi tabel etalase_penyedia selesai'.PHP_EOL;

		$no_item = [];

		for ($i=0; $i < 10; $i++) { 
			$dataItem = [
				'no_item' => $faker->randomNumber(6, TRUE),
				'nama_item' => 'Item '.chr(65 + $i),
				'uom' => $faker->randomElement(['buah', 'cm', 'kg', 'm', 'liter', 'lembar']),
				'id_etalase' => $faker->randomElement([1, 2, 3, 4, 5, 6, 7, 8, 9, 10]),
			];

			$no_item[] += $dataItem['no_item'];

			$this->db->insert('item', $dataItem);
		}
		echo 'Isi tabel item selesai'.PHP_EOL;

		for ($i=0; $i < 18; $i++) {
			$harga = $faker->randomNumber(2) * 100000;
			$harga_ppn = $harga + $harga * 0.11;

			$dataProduk= [
				'nama_produk' => 'Produk '.$i,
				'harga' => $harga,
				'harga_ppn' => $harga_ppn,
				'masa_berlaku' => $faker->date(),
				'merek' => $faker->word(),
				'no_produk_penyedia' => $faker->randomNumber(5, TRUE),
				'nilai_tkdn' => $faker->randomFloat(2, 1, 70),
				'deskripsi' => $faker->paragraph(3),
				'kode_kbki' => $faker->randomNumber(6, TRUE),
				'stok' => $faker->randomNumber(3),
				'id_etalase' => intdiv($i, 9) + 1,
				'id_penyedia' => intdiv($i, 9) + 10,
				'no_item' => $faker->randomElement($no_item),
			];

			$this->db->insert('produk', $dataProduk);
		}
		echo 'Isi tabel produk selesai'.PHP_EOL;

		for ($i=0; $i < 5; $i++) {
			$dataLampiran= [
				'nama_lampiran' => 'nama file',
				'keterangan' => $faker->paragraphs(3, TRUE),
				'id_produk' => $i + 1,
			];

			$this->db->insert('lampiran', $dataLampiran);
		}
		echo 'Isi tabel lampiran selesai'.PHP_EOL;

		// $no_pr = [];

		for ($i=1; $i < 3; $i++) {
			$dataKak = [
				'id_pk' => $i,
				'nama_paket' => 'Paket '.$faker->word(),
				'alamat_kirim' => $faker->address(),
				'tanggal_mulai' => '2022-10-'.($i+2),
				'tanggal_akhir' => '2022-10-'.($i+9),
				'uraian_pekerjaan' => $faker->paragraph(1),
				'ruang_lingkup' => $faker->paragraphs(3, TRUE),
				'tahun_anggaran' => '2022',
				'link' => $faker->uuid(),
			];

			$this->db->insert('kak', $dataKak);
		}
		echo 'Isi tabel kak selesai'.PHP_EOL;

		for ($i=0; $i < 5; $i++) {
			$dataPaket = [
				'id_pp' => $faker->randomElement([5, 6]),
				'id_penyedia' => $faker->randomElement([10, 11]),
				'id_kak' => $faker->randomElement([1, 2]),
			];

			$this->db->insert('paket', $dataPaket);
		}

		// for ($i=0; $i < 5; $i++) {
		// 	$np = $faker->randomNumber(9, TRUE);
		// 	$no_pr[] += $np;

		// 	$dataPaket = [
		// 		[
		// 			'id_paket' => $i + 1,
		// 			'no_pr' => $np,
		// 			'status' => 1
		// 		],
		// 	];

		// 	$this->db->where('id_paket', $i + 1);
		// 	$this->db->update('paket', $dataPaket);
		// }
		echo 'Isi tabel paket selesai'.PHP_EOL;


		for ($i=1; $i < 11; $i++) {
			$dataKeranjang = [
				'id_produk' => (($i-1) % 10) + 1,
				'id_pumk' => $faker->numberBetween(3, 4),
				'id_paket' => $i <= 7 ? (($i-1) % 5) + 1 : NULL,
				// 'id_paket' => $i <= 7 ? $faker->numberBetween(1, 2) : NULL,
				'kuantitas' => $faker->numberBetween(1, 10),
			];

			$this->db->insert('keranjang', $dataKeranjang);
		}
		echo 'Isi tabel keranjang selesai'.PHP_EOL;

		for ($i=0; $i < 10; $i++) {
			$dataFavorit= [
				'id_pumk' => $faker->numberBetween(3, 4),
				'id_produk' => $faker->numberBetween(1, 18),
			];

			$this->db->insert('favorit', $dataFavorit);
		}
		echo 'Isi tabel favorit selesai'.PHP_EOL;


		// --------------
		// Konten
		// --------------

		for ($i=0; $i < 10; $i++) {
			$dataUnduhan= [
				'nama_unduhan' => 'Unduhan '.$i,
				'kapasitas' => $faker->randomNumber(4, TRUE),
				'id_ku' => $faker->numberBetween(1, $this->_jmlKatUnduhan),
				'file' => 'a',
				'id_admin' => $faker->numberBetween(1, 2)
			];

			$this->db->insert('unduhan', $dataUnduhan);
		}
		echo 'Isi tabel unduhan selesai'.PHP_EOL;

		for ($i=0; $i < 10; $i++) {
			$dataPengumuman= [
				'judul' => 'Pengumuman '.$i,
				'jumlah_penawaran' => $faker->randomNumber(2),
				'syarat_ketentuan' => $faker->paragraphs(3, TRUE),
				'id_etalase' => $faker->numberBetween(1, 10),
				'id_user' => $faker->randomElement([1, 2, 10, 11, 12])
			];

			$this->db->insert('pengumuman', $dataPengumuman);
		}
		echo 'Isi tabel pengumuman selesai'.PHP_EOL;

		for ($i=0; $i < 10; $i++) {
			$dataMerek = [
				'nama_merek' => $faker->word(),
				'deskripsi' => $faker->paragraphs(3, TRUE),
				'id_pengumuman' => $faker->numberBetween(1, 10),
			];

			$this->db->insert('merek', $dataMerek);
		}
		echo 'Isi tabel merek selesai'.PHP_EOL;

		for ($i=0; $i < 10; $i++) {
			$dataTahapan = [
				'judul' => $faker->words(3, TRUE),
				'tanggal_mulai' => $faker->date(),
				'tanggal_akhir' => $faker->date(),
				'perubahan' => $faker->sentence(),
				'id_pengumuman' => $faker->numberBetween(1, 5),
			];

			$this->db->insert('tahapan_pengumuman', $dataTahapan);
		}
		echo 'Isi tabel tahapan_pengumuman selesai'.PHP_EOL;

		for ($i=0; $i < 10; $i++) {
			$dataBerita= [
				'judul' => 'Berita '.$i,
				'body' => $faker->paragraphs(5, TRUE),
				'id_kb' => $faker->numberBetween(1, $this->_jmlKatBerita),
				'id_admin' => $faker->numberBetween(1, 2),
			];

			$this->db->insert('berita', $dataBerita);
		}
		echo 'Isi tabel berita selesai'.PHP_EOL;

		for ($i=0; $i < 10; $i++) {
			$dataTags = [
				'id_berita' => $faker->numberBetween(1, 10),
				'tag' => $faker->word(),
			];

			$this->db->insert('tags', $dataTags);
		}
		echo 'Isi tabel tags selesai'.PHP_EOL;


		// --------------
		// Isi tabel lain yang tidak bisa random
		// --------------

		$dataMeta = [
			['spesifikasi' => 'habis pakai', 'nilai' => 'ya', 'id_produk' => 1],
			['spesifikasi' => 'lisensi', 'nilai' => 'tidak', 'id_produk' => 1],
			['spesifikasi' => 'habis pakai', 'nilai' => 'tidak', 'id_produk' => 2],
			['spesifikasi' => 'lisensi', 'nilai' => 'ya', 'id_produk' => 2],
			['spesifikasi' => 'anti air', 'nilai' => 'ya', 'id_produk' => 1],
			['spesifikasi' => 'Warna', 'nilai' => 'oranye', 'id_produk' => 1],
			['spesifikasi' => 'bandwidth', 'nilai' => 'Penuh', 'id_produk' => 1],
			['spesifikasi' => 'anti air', 'nilai' => 'tidak', 'id_produk' => 2],
			['spesifikasi' => 'warna', 'nilai' => 'kuning', 'id_produk' => 2]
		];

		$this->db->insert_batch('meta_produk', $dataMeta);
		echo 'Isi tabel meta_produk selesai'.PHP_EOL;

		$dataKontak = [
			['key' => 'nama_kontak', 'value' => 'Universitas Padjadjaran'],
			['key' => 'alamat', 'value' => 'Jl. Raya Bandung Sumedang KM.21, Hegarmanah, Kec. Jatinangor, Kabupaten Sumedang, Jawa Barat 45363'],
			['key' => 'telepon_1', 'value' => '(022) 842 88828'],
			['key' => 'telepon_2', 'value' => '(022) 842 88888'],
			['key' => 'jam_telepon', 'value' => 'Senin - Jumat (08.00 WIB - 16.00 WIB)'],
			['key' => 'email', 'value' => 'humas@unpad.ac.id'],
			['key' => 'website', 'value' => 'https://www.unpad.ac.id'],
			['key' => 'googlemap_src', 'value' => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3960.7024030366956!2d107.77249405035722!3d-6.926132094971146!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e68e653eb17e239%3A0xc6192a1f92aa9e41!2sUniversitas%20Padjadjaran!5e0!3m2!1sid!2sid!4v1667840542320!5m2!1sid!2sid'],
		];

		$this->db->insert_batch('kontak', $dataKontak);
		echo 'Isi tabel kontak selesai'.PHP_EOL;
	}

	/**
	 * Isi tabel-tabel kategori
	 *
	 * @return void
	 */
	private function _isiKategori()
	{
		$this->_jmlKatBerita = $this->db->count_all('kategori_berita');

		if($this->_jmlKatBerita <= 0)
		{
			$dataKategoriBerita = array(
				[ 'nama_kb' => 'Katalog' ],
				[ 'nama_kb' => 'Pengumuman' ],
			);

			$this->db->insert_batch('kategori_berita', $dataKategoriBerita);
			echo 'Isi tabel kategori_berita selesai'.PHP_EOL;

			$this->_jmlKatBerita = count($dataKategoriBerita);
		}


		$this->_jmlKatEtalase = $this->db->count_all('kategori_etalase');

		if($this->_jmlKatEtalase <= 0)
		{
			$dataKategoriEtalase = array(
				[ 'nama_ke' => 'Barang' ],
				[ 'nama_ke' => 'Jasa' ],
				[ 'nama_ke' => 'Jasa Lainnya' ],
			);

			$this->db->insert_batch('kategori_etalase', $dataKategoriEtalase);
			echo 'Isi tabel kategori_etalase selesai'.PHP_EOL;

			$this->_jmlKatEtalase = count($dataKategoriEtalase);
		}



		$this->_jmlKatUnduhan = $this->db->count_all('kategori_unduhan');

		if($this->_jmlKatUnduhan <= 0)
		{
			$dataKategoriUnduhan = array(
				[ 'nama_ku' => 'Undangan' ],
				[ 'nama_ku' => 'Informasi' ],
				[ 'nama_ku' => 'Petunjuk Penggunaan' ],
				[ 'nama_ku' => 'Surat Edaran' ],
			);

			$this->db->insert_batch('kategori_unduhan', $dataKategoriUnduhan);
			echo 'Isi tabel kategori_unduhan selesai'.PHP_EOL;

			$this->_jmlKatUnduhan = count($dataKategoriUnduhan);
		}

	}
}
