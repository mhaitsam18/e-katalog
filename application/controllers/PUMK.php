<?php
defined('BASEPATH') or exit('No direct script access allowed');

class PUMK extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Model_pumk');
		$this->load->model('Model_index');

		// Cek authorization
		if ($this->session->level !== 'pumk') {
			session_destroy();
			redirect('login');
		};
	}

	public function index()
	{
		$id   = $this->session->id;
		$data = $this->Model_pumk->get_summary($id);

		// dd($data);
		$this->load->view('landingpage/profile_pumk', $data);
	}


	public function keranjang()
	{
		$id_pumk   = $this->session->id;
		$keranjang = $this->Model_pumk->get_keranjang($id_pumk);
		// $penyedia  = array();
		// dd($keranjang);

		// if (!empty($keranjang)) {
		// 	foreach ($keranjang as $data) {
		// 		if (!array_key_exists($data->id_penyedia, $penyedia)) {
		// 			$penyedia[$data->id_penyedia][0] = (array) $data;
		// 			continue;
		// 		}

		// 		array_push($penyedia[$data->id_penyedia], (array) $data);
		// 	}
		// }

		// $data = array(
		// 	'penyedia' => $penyedia,
		// );

		$this->load->view('landingpage/keranjang', ['keranjang' => $keranjang]);
	}

	/**
	 * Input produk ke keranjang
	 */
	public function input_produk($id_produk)
	{
		// Cek jika PUMK telah mengambil produk yg sama
		if (!is_null($this->Model_pumk->cek_keranjang($id_produk, $this->session->id))) {
			// TODO: jika PUMK memilih produk yg sama ke keranjang maka akan menambah jumlah di keranjang (?)
			redirect('PUMK/keranjang');
		}


		$data = array(
			'id_pumk' 	=> $this->session->id,
			'id_produk' => $id_produk,
			'kuantitas'	=> 1,
		);


		if (!empty($this->input->post('qty'))) {
			$this->load->library('form_validation');

			$this->form_validation->set_rules('qty', 'Kuantitas', 'integer|greater_than[0]');

			if ($this->form_validation->run() == FALSE) {
				// $this->alert->danger(validation_errors());

				redirect('LandingPage/lihat_produk/' . $id_produk);
			}


			$data['kuantitas'] = $this->input->post('qty');
		}


		$this->Model_pumk->create_keranjang($data);

		if ($prev = $this->input->get_request_header('referer', TRUE)) {
			$this->session->set_flashdata(['keranjang_alert' => TRUE]);

			redirect($prev);
		}

		$this->alert->success('Produk berhasil dimasukan ke keranjang');

		redirect('PUMK/keranjang');
	}

	/**
	 * Deprecated
	 *
	 * Input produk ke keranjang dari halaman produk.php
	 */
	// public function input_produk2($id)
	// {
	// 	$this->load->library('form_validation');

	// 	$this->form_validation->set_rules('kuantitas', 'Kuantitas', 'required|integer|greater_than[0]');

	// 	if ($this->form_validation->run() == FALSE) {
	// 		// $this->alert->danger(validation_errors());

	// 		redirect('LandingPage/lihat_produk/' . $id);
	// 	}

	// 	$data = array(
	// 		'id_pumk' 	=> $this->session->id,
	// 		'id_produk' => $id,
	// 		'kuantitas'	=> $this->input->post('qty')
	// 	);

	// 	$insert = $this->Model_pumk->create_keranjang($data);

	// 	echo "<script type='text/javascript'>
	// 	alert('Berhasil Masuk Keranjang');
	// 	window.location='../../LandingPage';
	// 	</script>";
	// }

	/**
	 * Hapus produk dari keranjang
	 */
	public function hapus_produk($id_produk)
	{
		$id_pumk = $this->session->id;
		$this->Model_pumk->delete_keranjang($id_produk, $id_pumk);

		$this->alert->success('Produk dikeluarkan dari keranjang');

		redirect('PUMK/keranjang');
	}

	public function update_keranjang()
	{
		$this->load->library('form_validation');

		$this->form_validation->set_rules('data[qty][]', 'Kuantitas', 'required|integer|greater_than[0]');

		if ($this->form_validation->run() == FALSE) {
			$this->alert->danger(validation_errors());

			redirect('PUMK/keranjang');
		}

		$data = $this->input->post('data');

		/* $data['pro'] == id produk */
		for ($i = 0; $i < count($data['pro']); $i++) {
			$data_update[$i]['id_produk'] = $data['pro'][$i];
			$data_update[$i]['kuantitas'] = $data['qty'][$i];
			$data_update[$i]['id_pumk']   = $this->session->id;
			$data_update[$i]['id_paket']  = NULL;
		}

		// dd($data_update);
		$this->Model_pumk->update_keranjang($data_update);

		$this->alert->success('Update keranjang berhasil');

		redirect('PUMK/keranjang');
	}

	// deprecated
	// public function anggaran()
	// {
	// 	if ($this->input->method() === 'post') {
	// 		$this->load->library('form_validation');

	// 		$this->form_validation->set_rules('p', 'p', 'required|integer|greater_than[0]');

	// 		if ($this->form_validation->run() == FALSE) {
	// 			redirect('PUMK/anggaran');
	// 		}


	// 		/* Masukan ke session id_penyedia yang dipilih untuk dijadikan paket */
	// 		$this->session->set_userdata([
	// 			'id_penyedia' => (int) $this->input->post('p')
	// 		]);
	// 	}

	// 	$data = array(
	// 		'anggaran'	=> $this->Model_pumk->get_anggaran(),
	// 	);

	// 	$this->load->view('landingpage/pilih_anggaran', $data);
	// }

	// deprecated
	// public function check_anggaran()
	// {
	// 	/* Cek jika user pernah memilih keranjang yang ingin dijadikan paket */
	// 	if (!$this->session->has_userdata('id_penyedia')) {
	// 		$this->alert->danger('Pilih keranjang yang mau dibuat paket terlebih dahulu');

	// 		redirect('PUMK/keranjang');
	// 	}

	// 	$id_anggaran = $this->input->post('anggaran');
	// 	$id_penyedia = $this->session->id_penyedia;
	// 	$id_pumk     = $this->session->id;

	// 	$anggaran = $this->Model_pumk->get_anggaran_id($id_anggaran);
	// 	$harga    = $this->Model_pumk->get_keranjang_paket($id_penyedia, $id_pumk);


	// 	if ($harga->jumlah > $anggaran->nominal) {
	// 		// echo"<script type='text/javascript'>
	// 		// alert('Anggaran tidak mencukupi subtotal paket');
	// 		// window.location='../../anggaran/$id';
	// 		// </script>";

	// 		$this->alert->danger('Anggaran tidak mencukupi subtotal paket (' . rupiah($harga->jumlah) . ')');

	// 		redirect('PUMK/anggaran');
	// 	}

	// 	date_default_timezone_set('Asia/Jakarta');
	// 	$data_paket = array(
	// 		'id_anggaran' => $id_anggaran,
	// 		'status'      => 0,
	// 		'tanggal'     => date('Y-m-d H:i:s'),
	// 	);

	// 	$this->session->set_userdata(array('data_paket' => $data_paket));
	// 	// $id_paket_baru = $this->Model_pumk->create_paket($data_paket);
	// 	// $this->Model_pumk->update_keranjang2($id_paket_baru, $id_pumk, $id_penyedia);

	// 	redirect('PUMK/informasi');
	// }

	public function ambil_keranjang()
	{
		if ($this->input->method() !== 'post') {
			redirect('PUMK/keranjang');
		}

		$this->load->library('form_validation');

		$this->form_validation->set_rules('pilihan-produk[]', 'Pilihan produk', 'required|integer|greater_than[0]');

		if ($this->form_validation->run() == FALSE) {
			$this->alert->danger(validation_errors());

			redirect('PUMK/keranjang');
		}

		/* Masukan ke session id_penyedia yang dipilih untuk update keranjang */
		$this->session->set_userdata([
			'pilihan_produk' => $this->input->post('pilihan-produk')
		]);

		redirect('PUMK/informasi_pesanan');
	}

	public function informasi_pesanan()
	{
		/* Cek jika user pernah memilih keranjang yang ingin dijadikan paket */
		if (!$this->session->has_userdata('pilihan_produk')) {
			$this->alert->danger('Pilih keranjang yang mau dibuat paket terlebih dahulu');

			redirect('PUMK/keranjang');
		}

		/* Jika ada kiriman $_POST dari inputan form ke method ini maka handle inputan */
		if ($this->input->method() === 'post') {
			$this->_handle_pesanan();
		}

		/* Jika tidak ada $_POST berarti tampilkan halaman form seperti biasa */
		$id_pumk = $this->session->id;

		$data = array(
			'pp' => $this->Model_pumk->get_pp($id_pumk),
			'pk' => $this->Model_pumk->get_pk($id_pumk),
		);

		// dd($data);
		$this->load->view('landingpage/informasi_pesanan', $data);
	}

	private function _handle_pesanan()
	{
		/* validasi */
		$this->load->library('form_validation');

		$this->form_validation->set_rules('nama-paket', 'Nama Paket', 'required|max_length[255]');
		$this->form_validation->set_rules('uraian-pekerjaan', 'Uraian Pekerjaan', 'required|max_length[255]');
		$this->form_validation->set_rules('ruang-lingkup', 'Ruang Lingkup', 'required|max_length[255]');
		$this->form_validation->set_rules('tahun-anggaran', 'Tahun Anggaran', 'required|numeric|exact_length[4]');
		$this->form_validation->set_rules('alamat', 'Alamat Pengiriman', 'required|max_length[511]');
		$this->form_validation->set_rules('tanggal-mulai', 'Tanggal Mulai', 'required');
		$this->form_validation->set_rules('tanggal-akhir', 'Tanggal Akhir', 'required');
		$this->form_validation->set_rules('pp', 'Personil Pengadaan', 'required|integer|greater_than[0]');
		$this->form_validation->set_rules('pk', 'Pembuat Komitmen', 'required|integer|greater_than[0]');

		if (!$this->form_validation->run()) {
			$this->alert->danger(validation_errors());

			return;
		}

		$timestamp_tm = strtotime($this->input->post('tanggal-mulai'));
		$timestamp_ta = strtotime($this->input->post('tanggal-akhir'));

		if (!$timestamp_tm || !$timestamp_ta) {
			$this->alert->danger('Format tanggal tidak valid');

			return;
		}

		if ($timestamp_tm < strtotime(date('Y-m-d'))) {
			$this->alert->danger('Tanggal Mulai tidak boleh lebih awal dari tanggal sekarang');

			return;
		}

		if ($timestamp_ta < $timestamp_tm) {
			$this->alert->danger('Tanggal Akhir tidak bisa lebih awal dari Tanggal Mulai');

			return;
		}


		$data = array(
			'id_pk'            => $this->input->post('pk'),
			'id_pp'            => $this->input->post('pp'),
			'nama_paket'       => $this->input->post('nama-paket'),
			'uraian_pekerjaan' => $this->input->post('uraian-pekerjaan'),
			'ruang_lingkup'    => $this->input->post('ruang-lingkup'),
			'tahun_anggaran'   => $this->input->post('tahun-anggaran'),
			'alamat_kirim'     => $this->input->post('alamat'),
			'tanggal_mulai'    => $this->input->post('tanggal-mulai'),
			'tanggal_akhir'    => $this->input->post('tanggal-akhir'),
		);

		$id_pumk     = $this->session->id;
		$id_penyedia = array_unique($this->session->pilihan_produk);

		$paket_baru  = $this->Model_pumk->create_paket($data, $id_pumk, $id_penyedia);

		if (! $paket_baru) {
			$this->alert->danger('Paket gagal dibuat');

			return;
		}


		// /* Simpan paket baru ke db dan dapatkan id paket baru */
		// $data_paket = array('status' => 0);
		// $id_paket   = $this->Model_pumk->create_paket($data_paket);

		// /* Update id_paket pada keranjang yang dipilih */
		// $id_pumk     = $this->session->id;
		// $id_penyedia = $this->session->id_penyedia;
		// $this->Model_pumk->update_keranjang2($id_paket, $id_pumk, $id_penyedia);

		// /* Simpan data pengiriman ke db */
		// $data_pengiriman = array(
		// 	'nama_paket'       => $this->input->post('nama-paket'),
		// 	'uraian_pekerjaan' => $this->input->post('uraian-pekerjaan'),
		// 	'alamat'           => $this->input->post('alamat'),
		// 	'id_paket'         => $id_paket,
		// );
		// $this->Model_pumk->create_pengiriman($data_pengiriman);

		// /* Buat po baru */
		// $id_po = $this->Model_pumk->create_po($id_paket);


		/* unset semua session yang berkaitan dengan pembuatan paket dan pengiriman */
		$this->session->unset_userdata('pilihan_produk');


		$this->alert->success('Berhasil membuat paket');

		// redirect('PUMK/keranjang');
		// TODO: detail paket pakai id_kak?
		redirect('PUMK/detail_paket/'.$paket_baru);
	}

	// depreacated
	// public function tambahan_info()
	// {
	// 	/* Cek jika user pernah memilih keranjang yang ingin dijadikan paket */
	// 	if (!$this->session->has_userdata('id_penyedia')) {
	// 		$this->alert->danger('Pilih keranjang yang mau dibuat paket terlebih dahulu');

	// 		redirect('PUMK/keranjang');
	// 	}

	// 	/* Jika ada kiriman $_POST dari inputan form maka cek inputan form */
	// 	if ($this->input->method() === 'post') {
	// 		return $this->_update_pemesanan();
	// 	}

	// 	/* Jika tidak ada kiriman $_POST berarti user pergi ke halaman tambahan info */
	// 	$this->load->view('landingpage/data_pemesan');
	// }

	// deprecated
	/**
	 * Method untuk cek informasi tambahan
	 */
	// private function _update_pemesanan()
	// {
	// 	/* validasi */
	// 	$this->load->library('form_validation');

	// 	$this->form_validation->set_rules('nama', 'Nama', 'required');
	// 	$this->form_validation->set_rules('jabatan', 'Jabatan', 'required');
	// 	$this->form_validation->set_rules('nip', 'NIP', 'required|numeric|min_length[18]');
	// 	$this->form_validation->set_rules('email', 'Email', 'required|valid_email');
	// 	$this->form_validation->set_rules('sertifikat', 'Sertifikat', 'required');

	// 	if (!$this->form_validation->run()) {
	// 		$this->alert->danger(validation_errors());

	// 		return $this->load->view('landingpage/data_pemesan');
	// 	}


	// 	$data_pengiriman = $this->session->userdata('a');

	// 	$data_pengiriman['nama_pemesan']  = $this->input->post('nama');
	// 	$data_pengiriman['jabatan']       = $this->input->post('jabatan');
	// 	$data_pengiriman['nip']           = $this->input->post('nip');
	// 	$data_pengiriman['email']         = $this->input->post('email');
	// 	$data_pengiriman['no_sertifikat'] = $this->input->post('sertifikat');

	// 	$this->session->set_userdata(array('data_pengiriman' => $data_pengiriman));
	// 	// $update = $this->Model_pumk->update_pengiriman($data,$id);

	// 	redirect('PUMK/data_ppk');
	// }

	// deprecated
	// public function data_ppk()
	// {
	// 	/* Cek jika user pernah memilih keranjang yang ingin dijadikan paket */
	// 	if (!$this->session->has_userdata('id_penyedia')) {
	// 		$this->alert->danger('Pilih keranjang yang mau dibuat paket terlebih dahulu');

	// 		redirect('PUMK/keranjang');
	// 	}

	// 	$data = array(
	// 		'daftar_ppk' => $this->Model_pumk->get_ppk()
	// 	);

	// 	$this->load->view('landingpage/data_ppk', $data);
	// }

	// deprecated
	// public function update_ppk()
	// {
	// 	if ($this->input->method() !== 'post') {
	// 		redirect('PUMK/keranjang');
	// 	}

	// 	/* validasi */
	// 	$this->load->library('form_validation');

	// 	$this->form_validation->set_rules('ppk', 'PPK', 'required|integer|greater_than[0]');

	// 	if (!$this->form_validation->run()) {
	// 		redirect('PUMK/data_ppk');
	// 	}

	// 	$id_ppk = $this->input->post('ppk');

	// 	$data_paket = $this->session->data_paket;

	// 	$data_paket['id_ppk'] = $id_ppk;

	// 	$this->session->set_userdata('data_paket', $data_paket);

	// 	// dd($this->session->userdata());
	// 	redirect('PUMK/daftar_produk');
	// }

	// deprecated ?
	// public function daftar_produk()
	// {
	// 	/* Cek jika user pernah memilih keranjang yang ingin dijadikan paket */
	// 	if (!$this->session->has_userdata('id_penyedia')) {
	// 		$this->alert->danger('Pilih keranjang yang mau dibuat paket terlebih dahulu');

	// 		redirect('PUMK/keranjang');
	// 	}

	// 	$id_pumk     = $this->session->id;
	// 	$id_penyedia = $this->session->id_penyedia;

	// 	$data = array(
	// 		'paket' => $this->Model_pumk->get_preview_produk($id_pumk, $id_penyedia),
	// 	);

	// 	// dd($data);
	// 	$this->load->view('landingpage/daftar_produk', $data);
	// }

	// public function preview_po($id_paket)
	// {
	// 	$id_pumk = $this->session->id;
	// 	$id_po   = $this->Model_pumk->get_id_po($id_paket, $id_pumk);

	// 	if (empty($id_po)) {
	// 		show_404();
	// 	}


	// 	$po = $this->Model_pumk->get_po($id_po->id_po);

	// 	if (empty($po)) {
	// 		show_404();
	// 	}

	// 	$data = array(
	// 		'po'    => $po,
	// 	);

	// 	// dd($data);
	// 	$this->session->set_userdata('id_paket_preview_po', $id_paket);
	// 	$this->alert->info('Selanjutnya masukan nomor anggaran dari Oracle');

	// 	$this->load->view('landingpage/preview_po', $data);
	// }

	// deprecated
	// public function update_po()
	// {
	// 	if ($this->input->method() !== 'post') {
	// 		redirect('PUMK');
	// 	}

	// 	$id_paket = $this->session->id_paket_preview_po;

	// 	/* validasi */
	// 	$this->load->library('form_validation');

	// 	// $this->form_validation->set_rules('p', 'p', 'required|integer|greater_than[0]');
	// 	$this->form_validation->set_rules('no-sp', 'No. Surat Peanan', 'required|max_length[23]');
	// 	$this->form_validation->set_rules('no-anggaran', 'No. Anggaran', 'required|max_length[20]');

	// 	if (! $this->form_validation->run()) {
	// 		redirect('PUMK/preview_po/'.$id_paket);
	// 	}

	// 	$data = array(
	// 		'no_sp' => $this->input->post('no-sp'),
	// 		'no_anggaran' => $this->input->post('no-anggaran'),
	// 		'status' => 1,
	// 	);

	// 	$this->Model_pumk->update_po($id_paket, $data);

	// 	$this->alert->success('Laporan PO berhasil diperbarui');
	// 	$this->session->unset_userdata('id_paket_preview_po');

	// 	redirect('PUMK/detail_paket/'.$id_paket);
	// }

	public function detail_paket($id_paket)
	{
		$id_pumk = $this->session->id;
		$pemesanan = $this->Model_pumk->get_detail_paket($id_pumk, $id_paket);

		if (empty($pemesanan)) {
			redirect('PUMK');
		}


		$data = array(
			'pemesanan' => $pemesanan,
			'produk'    => $this->Model_pumk->get_list_produk_paket($id_pumk, $id_paket),
		);

		// dd($data);
		$this->load->view('landingpage/detail_paket', $data);
	}

	public function riwayat_paket($id_paket)
	{
		$data = array(
			'riwayat' => $this->Model_pumk->get_riwayat_paket($id_paket),
			'id_paket' => $id_paket
		);

		// dd($data);
		$this->load->view('landingpage/riwayat_paket', $data);
	}

	public function daftar_paket()
	{
		$id_pumk = $this->session->id;

		$data = array(
			'paket'		=> $this->Model_pumk->get_paket_all($id_pumk)
		);

		// dd($data);
		$this->load->view('landingpage/daftar_paket', $data);
	}

	public function ubah_paket($id_paket)
	{
		$id_pumk  = $this->session->id;

		// Cek apakah paket dimiliki PUMK tersebut dan masih dalam status bisa di-update
		if (empty($this->Model_pumk->cek_update_paket($id_paket, $id_pumk))) {
			redirect('PUMK');
		}


		if ($this->input->method() === 'post') {
			$this->_update_paket();
		}


		$pemesanan = $this->Model_pumk->get_paket_full($id_paket, $id_pumk);

		if (empty($pemesanan)) {
			redirect('PUMK');
		}

		$data = array(
			'pemesanan' => $pemesanan,
			'id_paket'  => $id_paket,
			'pp'        => $this->Model_pumk->get_pp($id_pumk),
			'pk'        => $this->Model_pumk->get_pk($id_pumk),
		);

		// dd($data);
		// $this->session->set_userdata('no_pr', $pemesanan->no_pr);
		$this->load->view('landingpage/ubah_paket', $data);
	}

	private function _update_paket()
	{
		/* validasi id */
		$this->load->library('form_validation');

		$this->form_validation->set_rules('p', '', 'required|integer|greater_than[0]');

		if (!$this->form_validation->run()) {
			redirect('PUMK');
		}

		$id_paket = $this->input->post('p');
		$id_pumk  = $this->session->id;

		if (empty($this->Model_pumk->cek_update_paket($id_paket, $id_pumk))) {
			redirect('PUMK');
		}

		/* validasi setiap field */
		$this->form_validation->set_rules('no-pr', 'Nomor PR', 'integer|max_length[20]');
		$this->form_validation->set_rules('nama-paket', 'Nama Paket', 'required|max_length[255]');
		$this->form_validation->set_rules('uraian-pekerjaan', 'Uraian Pekerjaan', 'required|max_length[255]');
		$this->form_validation->set_rules('ruang-lingkup', 'Ruang Lingkup', 'required|max_length[255]');
		$this->form_validation->set_rules('tahun-anggaran', 'Tahun Anggaran', 'required|numeric|exact_length[4]');
		$this->form_validation->set_rules('alamat', 'Alamat Pengiriman', 'required|max_length[511]');
		$this->form_validation->set_rules('tanggal-mulai', 'Tanggal Mulai', 'required');
		$this->form_validation->set_rules('tanggal-akhir', 'Tanggal Akhir', 'required');
		$this->form_validation->set_rules('pp', 'Personil Pengadaan', 'required|integer|greater_than[0]');
		$this->form_validation->set_rules('pk', 'Pembuat Komitmen', 'required|integer|greater_than[0]');

		if (!$this->form_validation->run()) {
			$this->alert->danger(validation_errors());

			return;
		}

		/* validasi tanggal_mulai dg tanggal_akhir */
		$timestamp_tm = strtotime($this->input->post('tanggal-mulai'));
		$timestamp_ta = strtotime($this->input->post('tanggal-akhir'));

		if (!$timestamp_tm || !$timestamp_ta) {
			$this->alert->danger('Format tanggal tidak valid');

			return;
		} elseif ($timestamp_ta < $timestamp_tm) {
			$this->alert->danger('Tanggal Akhir tidak bisa lebih awal dari Tanggal Mulai');

			return;
		}

		$data = array(
			'id_pp'            => $this->input->post('pp'),
			'id_pk'            => $this->input->post('pk'),
			'nama_paket'       => $this->input->post('nama-paket'),
			'uraian_pekerjaan' => $this->input->post('uraian-pekerjaan'),
			'ruang_lingkup'    => $this->input->post('ruang-lingkup'),
			'tahun_anggaran'   => $this->input->post('tahun-anggaran'),
			'alamat_kirim'     => $this->input->post('alamat'),
			'tanggal_mulai'    => $this->input->post('tanggal-mulai'),
			'tanggal_akhir'    => $this->input->post('tanggal-akhir'),
		);

		if (! empty($no_pr = $this->input->post('no-pr'))) {
			$data['no_pr']  = $no_pr;
			$data['status'] = 1;
		}

		// dd($data);
		$update = $this->Model_pumk->update_paket_full($data, $id_paket);

		if (!$update) {
			$this->alert->warning('Paket gagal diubah');
			redirect('PUMK/ubah_paket/' . $id_paket);
		}

		// $this->session->unset_userdata('no_pr');

		$this->alert->success('Paket berhasil diubah');
		redirect('PUMK/detail_paket/' . $id_paket);
	}

	// deprecated
	// public function prosespaket($id)
	// {
	// 	$data = array(
	// 		'status'	=> 1
	// 	);
	// 	$update = $this->Model_pumk->update_paket($data, $id);
	// 	echo "<script type='text/javascript'>
	// 	alert('Paket Berhasil Diproses');
	// 	window.location='../detailpaket/$id';
	// 	</script>";
	// }

	public function selesai_paket($id_paket)
	{
		$id_pumk = $this->session->id;

		$data = array(
			'status' => 7
		);
		if ($this->input->post('receipt')) {
			$data['receipt'] = $this->input->post('receipt');
		}

		$this->Model_pumk->update_paket($data, $id_paket, $id_pumk);

		$this->alert->info('Paket telah terverifikasi sudah sampai');
		redirect('PUMK/detail_paket/' . $id_paket);
	}

	public function batalkan($id_paket)
	{
		$id_pumk = $this->session->id;

		$data = array(
			'status' => 8
		);

		$this->Model_pumk->update_paket($data, $id_paket, $id_pumk);

		$this->alert->info('Paket telah dibatalkan');
		redirect('PUMK/detail_paket/' . $id_paket);
	}

	// deprecated
	// public function update_paket_fix($id)
	// {
	// 	$data = array(
	// 		'status'	=> 5
	// 	);
	// 	$update = $this->Model_pumk->update_paket($data, $id);
	// 	echo "<script type='text/javascript'>
	// 	alert('Negosiasi Berhasil');
	// 	window.location='../detailpaket/$id';
	// 	</script>";
	// }

	// deprecated
	// public function tambahnegosiasi($id)
	// {
	// 	$harga		= $this->Model_pumk->get_nego_harga_id($id);
	// 	if (!$harga) {
	// 		$harga2 = "Tidak ada";
	// 	} else {
	// 		$harga2 = $this->Model_pumk->get_nego_harga_id($id);
	// 	}
	// 	$spesifikasi		= $this->Model_pumk->get_nego_spesifikasi_id($id);
	// 	if (!$spesifikasi) {
	// 		$spesifikasi2 = "Tidak ada";
	// 	} else {
	// 		$spesifikasi2 = $this->Model_pumk->get_nego_spesifikasi_id($id);
	// 	}
	// 	$data = array(
	// 		'harga'			=> $harga2,
	// 		'spesifikasi'	=> $spesifikasi2,
	// 		'id'			=> $id,
	// 		'paket'         => $this->Model_pumk->get_paket_idd($id)
	// 	);
	// 	$this->load->view('landingpage/tambah_nego', $data);
	// }

	// deprecated
	// public function updateNego()
	// {
	// 	$id = $this->input->post('idpaket');
	// 	print_r($id);
	// 	if (!$this->input->post('cek') == "new") {
	// 		$data = array(
	// 			'nominal'				=> $this->input->post('nominal'),
	// 			'ongkir'				=> $this->input->post('ongkir'),
	// 			'tanggal_pengiriman'	=> $this->input->post('tanggal'),
	// 			'catatan_pembeli'		=> $this->input->post('catatan'),
	// 		);
	// 		$update = $this->Model_pumk->update_nh($data, $id);
	// 	} else {
	// 		$data = array(
	// 			'nominal'				=> $this->input->post('nominal'),
	// 			'ongkir'				=> $this->input->post('ongkir'),
	// 			'tanggal_pengiriman'	=> $this->input->post('tanggal'),
	// 			'catatan_pembeli'		=> $this->input->post('catatan'),
	// 			'id_paket'				=> $id
	// 		);
	// 		$insert = $this->Model_pumk->create_nh($data);
	// 	}
	// 	if (!$this->input->post('cek2') == "new") {
	// 		$data2 = array(
	// 			'spesifikasi'			=> $this->input->post('spesifikasi'),
	// 			'nilai'					=> $this->input->post('nilai'),
	// 			'catatan_pembeli'		=> $this->input->post('c_spesifikasi'),
	// 		);
	// 		$update = $this->Model_pumk->update_ns($data2, $id);
	// 	} else {
	// 		$data2 = array(
	// 			'spesifikasi'			=> $this->input->post('spesifikasi'),
	// 			'nilai'					=> $this->input->post('nilai'),
	// 			'catatan_pembeli'		=> $this->input->post('c_spesifikasi'),
	// 			'id_paket'				=> $id
	// 		);
	// 		$insert = $this->Model_pumk->create_ns($data2);
	// 	}
	// 	echo "<script type='text/javascript'>
	// 	alert('Negosiasi Berhasil');
	// 	window.location='tambahnegosiasi/$id';
	// 	</script>";
	// }

	public function input_favorit($id_produk)
	{
		$data = array(
			'id_user' 	=> $this->session->id,
			'id_produk' => $id_produk
		);

		$this->Model_pumk->create_favorit($data);

		echo "<script type='text/javascript'>
		alert('Produk Masuk dalam Favorit');
		window.location='../../';
		</script>";
	}

	public function favorit()
	{
		$id_pumk = $this->session->id;

		$data = array(
			'fav'	=> $this->Model_pumk->get_favorit($id_pumk)
		);

		$this->load->view('landingpage/favorit', $data);
	}

	public function hapus_favorit($id_produk)
	{
		$id_pumk = $this->session->id;

		$this->Model_pumk->delete_favorit($id_pumk, $id_produk);

		$this->alert->success('Produk dihapus dari favorit');

		redirect('PUMK/favorit');
	}

	// deprecated
	// public function riwayat_nh($id)
	// {
	// 	$data = array(
	// 		'riwayat'	 => $this->Model_pumk->get_nego_harga($id),
	// 		'id'		 => $id
	// 	);
	// 	$this->load->view('landingpage/riwayat_nh', $data);
	// }

	// deprecated
	// public function riwayat_ns($id)
	// {
	// 	$data = array(
	// 		'riwayat'		 => $this->Model_pumk->get_nego_spesifikasi($id),
	// 		'id'			=> $id
	// 	);
	// 	$this->load->view('landingpage/riwayat_ns', $data);
	// }

	public function print_invoice($id_paket)
	{
		$id_pumk = $this->session->id;
		$paket = $this->Model_pumk->get_invoice($id_paket, $id_pumk);

		if (empty($paket)) {
			redirect('PUMK');
		}


		$data = array(
			'paket' => $paket,
			'data_kontrak' => $this->Model_pumk->get_detail_kontrak($id_paket, $id_pumk),
			'tanggal_invoice' => $this->Model_pumk->get_tanggal_paket($id_paket, 1),
			'produk' => $this->Model_pumk->get_list_produk_paket($id_pumk, $id_paket),
			'negosiasi' => $this->Model_pumk->get_check_negosiasi($id_paket),
		);

		// dd($data, TRUE);
		$this->load->view('dashboard/laporan_invoice', $data);
	}

	public function print_kontrak($id_paket)
	{
		$id_pumk = $this->session->id;
		$kontrak = $this->Model_pumk->get_detail_kontrak($id_paket, $id_pumk);

		if (empty($kontrak)) {
			redirect('PUMK');
		}


		$data = array(
			'data_kontrak'    => $kontrak,
			'keranjang'       => $this->Model_pumk->get_keranjang_kontrak($id_paket),
			'tanggal_kontrak' => $this->Model_pumk->get_tanggal_paket($id_paket, 5),
			// 'negosiasi' => $this->Model_pumk->get_check_negosiasi($id_paket),
			'negosiasi' => $this->Model_penyedia->get_riwayat_nego_harga($id_paket),
		);

		// dd($data);
		$this->load->view('dashboard/laporan_kontrak', $data);
	}

	// deprecated
	// /**
	//  * Get daftar provinsi atau get provinsi berdasarkan index array
	//  */
	// private function _get_provinsi($idx = NULL)
	// {
	// 	$provinsi = array(
	// 		'Nanggroe Aceh Darussalam',
	// 		'Sumatra Utara',
	// 		'Sumatra Barat',
	// 		'Bengkulu',
	// 		'Riau',
	// 		'Kepulauan Riau',
	// 		'Jambi',
	// 		'Lampung',
	// 		'Bangka Belitung',
	// 		'Kalimantan Barat',
	// 		'Kalimantan Timur',
	// 		'Kalimantan Selatan',
	// 		'Kalimantan Tengah',
	// 		'Kalimantan Utara',
	// 		'Banten',
	// 		'DKI Jakarta',
	// 		'Jawa Barat',
	// 		'Jawa Tengah',
	// 		'Jawa Timur',
	// 		'Daerah Istimewa Yogyakarta',
	// 		'Bali',
	// 		'Nusa Tenggara Barat',
	// 		'Nusa Tenggara Timur',
	// 		'Mataram',
	// 		'Gorontalo',
	// 		'Sulawesi Barat',
	// 		'Sulawesi Tengah',
	// 		'Sulawesi Tenggara',
	// 		'Sulawesi Selatan',
	// 		'Maluku Utara',
	// 		'Maluku',
	// 		'Papua',
	// 		'Papua Selatan',
	// 		'Papua Tengah',
	// 		'Papua Pegunungan',
	// 	);

	// 	if (!is_null($idx)) {
	// 		return $provinsi[$idx];
	// 	}

	// 	return $provinsi;
	// }
}
