<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();

		$this->load->model('Model_admin');

		// Cek authorization
		if ($this->session->level !== 'admin') {
			session_destroy();
			return redirect('login');
		};
	}

	public function index()
	{
		$data = $this->Model_admin->get_summary();

		// dd($data);
		$this->load->view('dashboard/admin/index', $data);
	}

	// --------------
	// Kelola Paket
	// --------------
	public function paket_diproses()
	{
		$data = [
			'paket' => $this->Model_admin->get_paket_by_status($this->_get_status('diproses')),
		];

		// dd($data);
		$this->session->set_userdata('daftar_paket', 'paket_diproses');
		$this->load->view('dashboard/admin/daftar_paket', $data);
	}

	public function paket_dinegosiasi()
	{
		$data = [
			'paket' => $this->Model_admin->get_paket_by_status($this->_get_status('dinegosiasi')),
		];

		// dd($data);
		$this->session->set_userdata('daftar_paket', 'paket_dinegosiasi');
		$this->load->view('dashboard/admin/daftar_paket', $data);
	}

	public function paket_dikirim()
	{
		$data = [
			'paket' => $this->Model_admin->get_paket_by_status($this->_get_status('dikirim')),
		];

		// dd($data);
		$this->session->set_userdata('daftar_paket', 'paket_dikirim');
		$this->load->view('dashboard/admin/daftar_paket', $data);
	}

	public function paket_selesai()
	{
		$data = [
			'paket' => $this->Model_admin->get_paket_by_status($this->_get_status('selesai')),
		];

		// dd($data);
		$this->session->set_userdata('daftar_paket', 'paket_selesai');
		$this->load->view('dashboard/admin/daftar_paket', $data);
	}

	public function paket($id_paket)
	{
		$paket = $this->Model_admin->get_paket($id_paket);

		if (empty($paket)) {
			redirect('Admin');
		}

		$data = [
			'paket' => $paket,
		];

		$data += $this->Model_admin->get_detail_paket($id_paket);
		// dd($data);
		$this->load->view('dashboard/admin/paket', $data);
	}

    public function edit_paket($id_paket)
    {
        // data dummy
        // $pp = [(object) ['id_pp' => 1, 'nama_pp' => 'A'], (object) ['id_pp' => 2, 'nama_pp' => 'B']];
        // $pk = [(object) ['id_pk' => 1, 'nama_pk' => 'A'], (object) ['id_pk' => 2, 'nama_pk' => 'B']];
        $pp = $this->db->get('pp')->result();
        $pk = $this->db->get('pk')->result();

        $data = [
            'paket' => $this->Model_admin->get_paket($id_paket),
            'pp' => $pp,
            'pk' => $pk,
        ];

        $this->load->view('dashboard/admin/edit_paket', $data);
    }

    public function switch_pp_pk()
    {
        $this->Model_admin->switch_pp_pk($this->input->post());
        redirect($_SERVER['HTTP_REFERER']);
    }

	public function riwayat_paket($id_paket)
	{
		$data = [
			'riwayat' => $this->Model_admin->get_riwayat_paket($id_paket),
			'id_paket' => $id_paket,
			'hlm' => 'riwayat_paket', // view timeline_body
		];

		// dd($data);
		$this->load->view('dashboard/admin/riwayat_paket', $data);
	}

	public function riwayat_negosiasi($jenis, $id_paket)
	{
		if ($jenis === 'harga') {
			$method = 'get_riwayat_nh';
			$hlm = 'riwayat_nh';
		} elseif ($jenis === 'spesifikasi') {
			$method = 'get_riwayat_ns';
			$hlm = 'riwayat_ns';
		} elseif ($jenis === 'tanggal') {
			$method = 'get_riwayat_nt';
			$hlm = 'riwayat_nt';
		} else {
			redirect('Admin');
		}

		$data = [
			'riwayat' => $this->Model_admin->$method($id_paket),
			'id_paket' => $id_paket,
			'hlm' => $hlm,
		];

		// dd($data);
		$this->load->view('dashboard/admin/riwayat_paket', $data);
	}

	// --------------
	// Kelola Etalase dan Produk
	// --------------
	public function etalase_produk($id_etalase = null)
	{
		// Jika $id_etalase null berarti ambil semua etalase
		if (is_null($id_etalase)) {
			$data = [
				'etalase' => $this->Model_admin->get_etalase(),
			];

			return $this->load->view('dashboard/admin/daftar_etalase', $data);
		}

		$etalase = $this->Model_admin->get_etalase($id_etalase);

		// Jika $id_etalase tidak ada di database maka redirect ke daftar etalase
		if (empty($etalase)) {
			$this->alert->alertWarning('Etalase tidak ditemukan');

			redirect('Admin/etalase_produk');
		}

		$data = [
			'etalase' => $etalase,
			'produk' => $this->Model_admin->get_produk_by_etalase($id_etalase),
		];

		// dd($data);
		$this->load->view('dashboard/admin/daftar_produk', $data);
	}

	public function produk($id_produk)
	{
		$produk = $this->Model_admin->get_produk($id_produk);

		if (empty($produk)) {
			redirect('Admin/etalase_produk');
		}

		$data = [
			'produk' => $produk,
			'meta' => $this->Model_admin->get_meta_produk($id_produk),
		];

		// dd($data);
		$this->load->view('dashboard/admin/produk', $data);
	}

	public function riwayat_produk($id_produk)
	{
		$data = [
			'riwayat' => $this->Model_admin->get_riwayat_produk($id_produk),
			'id_produk' => $id_produk,
		];

		// dd($data);
		$this->load->view('dashboard/admin/riwayat_produk', $data);
	}

	public function download_riwayat_produk($id_produk)
	{
		$this->load->driver('cache', ['adapter' => 'file']);

		$riwayat = $this->cache->get('riwayat_produk_' . $id_produk);

		if ($riwayat === false) {
			$data = $this->Model_admin->get_riwayat_produk($id_produk);

			if (empty($data)) {
				$this->cache->save('riwayat_produk_' . $id_produk, '', 60 * 60 * 24 * 30);
			}

			$text = 'Riwayat Produk' . PHP_EOL . PHP_EOL;

			foreach ($data as $tanggal => $rwt) {
				foreach ($rwt as $r) {
					$text .= $tanggal . ' ' . $r['waktu'] . ' - ';
					$text .= ucfirst(str_replace('_', ' ', trim($r['aksi'], ', '))) . PHP_EOL;

					$item = $r['item_riwayat'];

					$text .= is_null($item['nama_produk']) ? '' : 'Nama produk: ' . $item['nama_produk'] . PHP_EOL;
					$text .= is_null($item['harga']) ? '' : 'Harga: ' . rupiah($item['harga']) . PHP_EOL;
					$text .= is_null($item['harga_ppn']) ? '' : 'Harga (+PPN): ' . rupiah($item['harga_ppn']) . PHP_EOL;
					$text .= is_null($item['masa_berlaku']) ? '' : 'Masa berlaku: ' . tanggal($item['masa_berlaku']) . PHP_EOL;
					$text .= is_null($item['merek']) ? '' : 'Nama Produk: ' . $item['merek'] . PHP_EOL;
					$text .= is_null($item['no_produk_penyedia']) ? '' : 'No. produk penyedia: ' . $item['no_produk_penyedia'] . PHP_EOL;
					$text .= is_null($item['unit_pengukuran']) ? '' : 'Unit Pengukuran: ' . $item['unit_pengukuran'] . PHP_EOL;
					$text .= is_null($item['kode_kbki']) ? '' : 'Kode KBKI: ' . $item['kode_kbki'] . PHP_EOL;
					$text .= is_null($item['nilai_tkdn']) ? '' : 'Nilai TKDN: ' . $item['nilai_tkdn'] . PHP_EOL;
					$text .= is_null($item['stok']) ? '' : 'Stok: ' . $item['stok'] . PHP_EOL;
					$text .= is_null($item['deskripsi']) ? '' : 'Deskripsi: ' . $item['deskripsi'] . PHP_EOL;
					$text .= is_null($item['no_item']) ? '' : 'No. Item: ' . $item['no_item'] . PHP_EOL;
					$text .= is_null($item['nama_etalase']) ? '' : 'Etalase: ' . $item['nama_etalase'] . PHP_EOL;
					$text .= is_null($item['nama_penyedia']) ? '' : 'Penyedia: ' . $item['nama_penyedia'] . PHP_EOL;
					$text .= is_null($item['foto']) ? '' : 'Foto: ' . $item['foto'] . PHP_EOL;

					$text .= PHP_EOL;
				}
			}

			$riwayat = $text;
			$this->cache->save('riwayat_produk_' . $id_produk, $text, 60 * 60 * 24 * 30);
		} elseif ($riwayat === '') {
			exit;
		}

		$produk = $this->Model_admin->get_nama_produk($id_produk);

		$this->output->set_header('Content-Type: text/plain;charset=UTF-8');
		$this->output->set_header('Content-Disposition: attachment; filename=log_produk_' . $produk->nama_produk . '.txt');
		echo $riwayat;
	}


	// -------------
	// Kelola Penyedia
	// -------------
	public function penyedia($id_penyedia = null)
	{
		// Jika $id_penyedia null berarti ambil semua penyedia
		if (is_null($id_penyedia)) {
			$data = [
				'penyedia' => $this->Model_admin->get_penyedia(),
			];

			return $this->load->view('dashboard/admin/daftar_penyedia', $data);
		}

		$penyedia = $this->Model_admin->get_penyedia($id_penyedia);

		if (empty($penyedia)) {
			$this->alert->alertWarning('Penyedia tidak ditemukan');

			redirect('Admin/penyedia');
		}

		$data = [
			'penyedia' => $penyedia,
		];

		$this->load->view('dashboard/admin/penyedia', $data);
	}

	// unused
	// public function tambah_penyedia()
	// {
	//     $data = array(
	//         'etalase' => $this->Model_admin->get_etalase(),
	//     );
	//     $this->load->view('dashboard/admin/tambah_penyedia', $data);
	// }

	// unused
	// public function input_penyedia()
	// {
	//     $this->form_validation->set_rules('nama_penyedia', 'Nama Penyedia', 'required|max_length[50]|trim',
	//         array(
	//             'required' => '%s tidak boleh kosong',
	//             'max_length' => '%s maksimal 50 karakter',
	//         ));
	//     $this->form_validation->set_rules('alamat_penyedia', 'Alamat Penyedia', 'required|max_length[250]|trim',
	//         array(
	//             'required' => '%s tidak boleh kosong',
	//             'max_length' => '%s maksimal 250 karakter',
	//         ));
	//     $this->form_validation->set_rules('nama_perusahaan', 'Nama Perusahaan', 'required|max_length[200]|trim',
	//         array(
	//             'required' => '%s tidak boleh kosong',
	//             'max_length' => '%s maksimal 200 karakter',
	//         ));
	//     $this->form_validation->set_rules('bank', 'Bank', 'required|max_length[50]|trim',
	//         array(
	//             'required' => '%s tidak boleh kosong',
	//             'max_length' => '%s maksimal 50 karakter',
	//         ));
	//     $this->form_validation->set_rules('norek', 'Nomor Rekening', 'required|max_length[50]|integer|trim',
	//         array(
	//             'required' => '%s tidak boleh kosong',
	//             'integer' => '%s Harus Angka',
	//             'max_length' => '%s maksimal 50 karakter',
	//         ));
	//     $this->form_validation->set_rules('etalase', 'Kategori Etalase', 'required|trim',
	//         array(
	//             'required' => '%s tidak boleh kosong',
	//         ));
	//     if ($this->form_validation->run() == false) {
	//         $this->tambah_penyedia();
	//     } else {
	//         // id Penyedia harus uniq
	//         // langsung insert di kedua tabel
	//         // id_penyedia harus sama

	//         // tabel etalase_penyedia
	//         $dataEtalase = array(
	//             'id_penyedia' => 1,
	//             'id_etalase' => $this->input->post('etalase'),
	//         );
	//         // tabel penyedia
	//         $data = array(
	//             'id_penyedia' => 1,
	//             'nama_penyedia' => $this->input->post('nama_penyedia'),
	//             'alamat_penyedia' => $this->input->post('alamat_penyedia'),
	//             'nama_perusahaan' => $this->input->post('nama_perusahaan'),
	//             'bank' => $this->input->post('bank'),
	//             'norek' => $this->input->post('norek'),
	//         );
	//         var_dump($data);
	//         var_dump($dataEtalase);
	//         die();
	//         // dd($data, $dataEtalase);
	//         $this->Model_admin->create_penyedia($data);
	//         $this->session->set_flashdata('flash', 'Berhasil Menambahkan Data');
	//         redirect('Admin/penyedia');
	//     }

	// }

	public function edit_penyedia($id)
	{
		$etalase_penyedia = $this->Model_admin->get_etalase_by_penyedia($id);
		$etalase_id = [];
		foreach ($etalase_penyedia as $value) {
			array_push($etalase_id, $value->id_etalase);
			$etalate_id = $value->id_etalase;
		}
		$data = array(
			'etalase_penyedia' => $etalase_id,
			'etalase' => $this->Model_admin->get_etalase(),
			'penyedia' => $this->Model_admin->get_penyedia($id),
		);
		$this->load->view('dashboard/admin/edit_penyedia', $data);
	}

	public function update_penyedia()
	{
		$this->load->library('form_validation');

		$this->form_validation->set_rules('b', '', 'required|integer|greater_than[0]');
		$this->form_validation->set_rules('nama_penyedia', 'Nama Penyedia', 'required|max_length[50]|trim');
		$this->form_validation->set_rules('alamat_penyedia', 'Alamat Penyedia', 'required|max_length[250]|trim');
		$this->form_validation->set_rules('nama_perusahaan', 'Nama Perusahaan', 'required|max_length[200]|trim');
		$this->form_validation->set_rules('bank', 'Bank', 'required|max_length[50]|trim');
		$this->form_validation->set_rules('norek', 'Nomor Rekening', 'required|numeric|max_length[50]|trim');
		$this->form_validation->set_rules('etalase[]', 'Kategori Etalase', 'required|integer|trim');

		$id_penyedia = $this->input->post('b');

		if (!$this->form_validation->run()) {
			return $this->edit_penyedia($id_penyedia);
		}


		$data_penyedia = array(
			'nama_penyedia' => $this->input->post('nama_penyedia'),
			'alamat_penyedia' => $this->input->post('alamat_penyedia'),
			'nama_perusahaan' => $this->input->post('nama_perusahaan'),
			'bank' => $this->input->post('bank'),
			'norek' => $this->input->post('norek'),
		);

		$etalase_penyedia = $this->input->post('etalase[]');
		$data_etalase     = [];

		foreach ($etalase_penyedia as $ep) {
			$data_etalase[] = [
				'id_penyedia' => $id_penyedia,
				'id_etalase'  => $ep
			];
		}

		$result = $this->Model_admin->update_penyedia($data_penyedia, $data_etalase, $id_penyedia);

		if ($result) {
			$this->session->set_flashdata('flash', 'Berhasil mengubah data Penyedia');
		} else {
			$this->session->set_flashdata('flash', 'Gagal mengubah data penyedia');
		}

		// TODO: tes edit penyedia
		redirect('Admin/penyedia');
	}

	// unused
	// public function hapus_penyedia($id_penyedia)
	// {
	//     $this->Model_admin->delete_penyedia($id_penyedia);

	//     $this->session->set_flashdata('flash', 'Berhasil Hapus Data');

	//     redirect('Admin/penyedia');
	// }

	// --------------
	// Kelola Pengumuman
	// --------------
	public function pengumuman($id_pengumuman = null)
	{
		$this->load->helper('text');

		// Jika $id_pengumuman null berarti ambil semua etalase
		if (is_null($id_pengumuman)) {
			$data = [
				'pengumuman' => $this->Model_admin->get_pengumuman(),
			];
			return $this->load->view('dashboard/admin/daftar_pengumuman', $data);
		}

		$pengumuman = $this->Model_admin->get_pengumuman($id_pengumuman);

		// Jika $id_pengumuman tidak ada di database maka redirect ke halaman daftar pengumuman
		if (empty($pengumuman)) {
			$this->alert->alertWarning('Pengumuman tidak ditemukan');

			redirect('Admin/pengumuman');
		}

		$data = [
			'pengumuman' => $pengumuman,
			'merek' => $this->Model_admin->get_merek($id_pengumuman),
		];

		// dd($data);
		$this->load->view('dashboard/admin/pengumuman', $data);
	}

	public function tambah_pengumuman()
	{
		$data = array(
			'etalase' => $this->Model_admin->get_etalase(),
		);
		$this->load->view('dashboard/admin/tambah_pengumuman', $data);
	}

	public function input_pengumuman()
	{
		$this->load->library('form_validation');

		$this->form_validation->set_rules('judul', 'Judul Pengumuman', 'required|trim');
		$this->form_validation->set_rules('etalase', 'Etalase', 'required');
		$this->form_validation->set_rules('syarat', 'Syarat', 'required|trim');
		$this->form_validation->set_rules('jumlah_penawaran', 'Jumlah Penawaran', 'required|numeric');
		$this->form_validation->set_rules('file_dokumen', 'File Dokumen', 'callback_validasi_dokumen_pengumuman'); // penamaan callback, calback_nama fungsi

		if (!$this->form_validation->run()) {
			$this->tambah_pengumuman();
		} else {
			date_default_timezone_set('Asia/Jakarta');
			$config['upload_path'] = "./uploads/dokumen_pengumuman/";
			$config['allowed_types'] = "pdf|xlsx|docx|doc|ppt|csv";
			// kilo byte
			$config['max_size'] = 5000;
			$config['encrypt_name'] = true;
			$this->load->library('upload', $config);
			if ($this->upload->do_upload('file_dokumen')) {
				$file = $this->upload->data();
				$data = array(
					'judul' => $this->input->post('judul'),
					"jumlah_penawaran" => $this->input->post("jumlah_penawaran"),
					"syarat_ketentuan" => $this->input->post("syarat"),
					'dok_pengumuman' => $file['file_name'],
					'id_etalase' => $this->input->post('etalase'),
					'id_user' => $this->session->id,
				);
				$this->Model_admin->create_pengumuman($data);
				$this->session->set_flashdata('flash', 'Pengumuman Berhasil Ditambahkan');
				redirect("Admin/pengumuman");
			}
		}
	}

	public function edit_pengumuman($id)
	{
		$data = array(
			'pengumuman' => $this->Model_admin->get_pengumuman($id),
			'etalase' => $this->Model_admin->get_etalase(),
		);
		// dd($data);
		$this->load->view('dashboard/admin/edit_pengumuman', $data);
	}

	public function update_pengumuman($id)
	{
		$this->load->library('form_validation');

		$this->form_validation->set_rules('judul', 'Judul Pengumuman', 'required|trim');
		$this->form_validation->set_rules('etalase', 'Etalase', 'required');
		$this->form_validation->set_rules('syarat', 'Syarat', 'required|trim');
		$this->form_validation->set_rules('jumlah_penawaran', 'Jumlah Penawaran', 'required|numeric');
		$this->form_validation->set_rules('file_dokumen', 'File Dokumen', 'callback_validasi_dokumen_pengumuman'); // penamaan callback, calback_nama fungsi

		if (!$this->form_validation->run()) {
			$this->edit_pengumuman($id);
		} else {
			// date_default_timezone_set('Asia/Jakarta');
			// $config['upload_path'] = "./uploads/dokumen_pengumuman/";
			// $config['allowed_types'] = "pdf|xlsx|docx|doc|ppt|csv";
			// // kilo byte
			// $config['max_size'] = 5000;
			// $config['encrypt_name'] = true;
			// $this->load->library('upload', $config);
			// if ($this->upload->do_upload('file_dokumen')) {
			//     $file = $this->upload->data();
			//     $data = array(
			//         'judul' => $this->input->post('judul'),
			//         "jumlah_penawaran" => $this->input->post("jumlah_penawaran"),
			//         "syarat_ketentuan" => $this->input->post("syarat"),
			//         'dok_pengumuman' => $file['file_name'],
			//         'id_etalase' => $this->input->post('etalase'),
			//         'id_user' => $this->session->id,
			//     );
			//     $this->Model_admin->create_pengumuman($data);
			//     $this->session->set_flashdata('flash', 'Pengumuman Berhasil Ditambahkan');
			//     redirect("Admin/pengumuman");
			// }
			$old_file_dokumen = $this->input->post("old_file_dokumen");
			$new_file_dokumen = $_FILES['file_dokumen']['name'];
			$path = './uploads/dokumen_pengumuman/';
			if ($new_file_dokumen == true) {
				date_default_timezone_set('Asia/Jakarta');
				$config['upload_path'] = "./uploads/dokumen_pengumuman/";
				$config['allowed_types'] = "pdf|xlsx|docx|doc|ppt|csv";
				// kilo byte
				$config['max_size'] = 5000;
				$config['encrypt_name'] = true;
				$this->load->library('upload', $config);
				if ($this->upload->do_upload('file_dokumen')) {
					$file = $this->upload->data('file_name');
					// hapus foto lama selain foto default
					$fileDokumen = $this->upload->data("file_name");
					if (file_exists($path . $old_file_dokumen)) {
						unlink(FCPATH . $path . $old_file_dokumen);
					}
				}
			} else {
				$fileDokumen = $old_file_dokumen;
			}
			$data = array(
				'judul' => $this->input->post('judul'),
				"jumlah_penawaran" => $this->input->post("jumlah_penawaran"),
				"syarat_ketentuan" => $this->input->post("syarat"),
				'dok_pengumuman' => $fileDokumen,
				'id_etalase' => $this->input->post('etalase'),
				'id_user' => $this->session->id,
			);
			// dd($data);
			$this->Model_admin->update_pengumuman($data, $id);
			$this->session->set_flashdata('flash', 'Pengumuman Berhasil Diupdate');
			redirect("Admin/pengumuman");
		}
	}

	public function hapus_pengumuman($id, $file)
	{
		$path = './uploads/dokumen_pengumuman/';
		if (file_exists($path . $file)) {
			unlink(FCPATH . $path . $file);
		}
		$this->Model_admin->delete_pengumuman($id);
		$this->session->set_flashdata('flash', 'Pengumuma Berhasil Di Hapus');
		redirect('Admin/unduhan');
	}

	// validasi dokumen pengumuman
	public function validasi_dokumen_pengumuman()
	{
		$check = true;
		// ini pengecekan file kosong
		// tapi jika di update
		// file tersebut tetap tercek
		if ((!isset($_FILES['file_dokumen'])) || $_FILES['file_dokumen']['size'] == 0) {
			$this->form_validation->set_message('validasi_dokumen_pengumuman', '{field} Tidak Boleh Kosong');
			$check = false;
		} else if (isset($_FILES['file_dokumen']) && $_FILES['file_dokumen']['size'] != 0) {
			$allowedExts = array("pdf", "xlsx", "docx", "doc", "ppt", "csv");
			// $allowedTypes = array(IMAGETYPE_PNG, IMAGETYPE_JPEG, IMAGETYPE_GIF);
			$extension = pathinfo($_FILES["file_dokumen"]["name"], PATHINFO_EXTENSION);
			// $detectedType = exif_imagetype($_FILES['file_dokumen']['tmp_name']);
			$type = $_FILES['file_dokumen']['type'];
			// if (!in_array($detectedType, $allowedTypes)) {
			//     $this->form_validation->set_message('validasi_dokumen_pengumuman', 'Invalid Image Content!');
			//     $check = false;
			// }
			// satuan  byte 5mb
			if (filesize($_FILES['file_dokumen']['tmp_name']) > 5242880) {
				$this->form_validation->set_message('validasi_dokumen_pengumuman', 'Maksimal Ukuran file 5Mb');
				$check = false;
			}
			if (!in_array($extension, $allowedExts)) {
				$this->form_validation->set_message('validasi_dokumen_pengumuman', "File Extensi {$extension} Salah");
				$check = false;
			}
		}
		return $check;
	}

	// Merek
	public function merek_pengumuman($id)
	{
		$data = array(
			'merek' => $this->Model_admin->get_merek($id),
		);
		$this->load->view('dashboard/admin/merek_pengumuman', $data);
	}

	// Tahapan Pengumuman
	public function tahapan_pengumuman($id)
	{
		$data = array(
			'pengumuman' => $this->Model_admin->get_pengumuman($id),
			'tahapan' => $this->Model_admin->get_tahapan($id),
		);
		$this->load->view('dashboard/Admin/tahapan_pengumuman', $data);
	}


	// --------------
	// Kelola Berita
	// --------------
	public function berita($id_berita = null)
	{
		$this->load->helper('text');

		// Jika $id_berita null berarti ambil semua etalase
		if (is_null($id_berita)) {
			$data = [
				'berita' => $this->Model_admin->get_berita(),
			];

			return $this->load->view('dashboard/admin/daftar_berita', $data);
		}

		$berita = $this->Model_admin->get_berita($id_berita);

		// Jika $id_berita tidak ada di database maka redirect ke halaman daftar berita
		if (empty($berita)) {
			$this->alert->alertWarning('Berita tidak ditemukan');

			redirect('Admin/berita');
		}

		$data = [
			'berita' => $berita,
			'tags' => $this->Model_admin->get_tags_and_one_berita($id_berita),
		];

		$this->load->view('dashboard/admin/berita', $data);
	}

	public function tambah_berita()
	{
		$data = array(
			'kategori' => $this->Model_admin->get_all_kb(),
		);
		$this->load->view('dashboard/admin/tambah_berita', $data);
	}

	public function input_berita()
	{
		$config['upload_path'] = "./uploads/poster_berita/";
		$config['allowed_types'] = "png|jpeg|jpg";
		$config['max_size'] = 2000;
		$config['encrypt_name'] = true;
		// dd($_FILES['gambarberita']);

		$this->load->library('form_validation');

		$this->form_validation->set_rules('judul', 'Judul', 'required');
		$this->form_validation->set_rules('body', 'Body', 'required');
		$this->form_validation->set_rules('kategori', 'kategori', 'required');
		$this->form_validation->set_rules('gambarberita', 'Gambar', 'callback_validate_image'); // penamaan callback, calback_nama fungsi

		if ($this->form_validation->run() == false) {
			$this->tambah_berita();
		} else {
			date_default_timezone_set('Asia/Jakarta');
			$this->load->library('upload', $config);
			if ($this->upload->do_upload('gambarberita')) {
				$file = $this->upload->data();
				$data = array(
					'judul' => $this->input->post('judul'),
					'body' => $this->input->post('body'),
					'tanggal' => date('Y-m-d H:i:s'),
					'gambar' => $file['file_name'],
					'id_kb' => $this->input->post('kategori'),
					'id_admin' => $this->session->id,
				);
				// dd($data);
				$this->Model_admin->create_berita($data);
				$this->session->set_flashdata('message', 'Berita Berhasil Ditambahakan');
				redirect("Admin/berita");
			} else {
				$data = array(
					'judul' => $this->input->post('judul'),
					'body' => $this->input->post('body'),
					'tanggal' => date('Y-m-d H:i:s'),
					'gambar' => 'default.jpg',
					'id_kb' => $this->input->post('kategori'),
					'id_admin' => $this->session->id,
				);
				$this->Model_admin->create_berita($data);
				$this->session->set_flashdata('flash', 'Berita Berhasil Ditambahakan');
				redirect("Admin/berita");
			}
		}
	}

	public function edit_berita($id)
	{
		$data = array(
			'berita' => $this->Model_admin->get_berita($id),
			'kategori' => $this->Model_admin->get_all_kb(),
		);
		$this->load->view('dashboard/admin/edit_berita', $data);
	}

	public function update_berita($id)
	{
		$this->load->library('form_validation');

		$this->form_validation->set_rules('judul', 'Judul', 'required');
		$this->form_validation->set_rules('body', 'Body', 'required');
		$this->form_validation->set_rules('kategori', 'kategori', 'required');
		$this->form_validation->set_rules('gambarberita', 'Gambar', 'callback_validate_image'); // penamaan callback, calback_nama fungsi

		if ($this->form_validation->run() == false) {
			$this->edit_berita($id);
		} else {
			$config['upload_path'] = "./uploads/poster_berita/";
			$config['allowed_types'] = "png|jpeg|jpg";
			$config['max_size'] = 2000;
			$config['encrypt_name'] = true;

			$this->load->library('upload', $config);
			$old_gambar = $this->input->post("old_gambarberita");
			$new_gambar = $_FILES['gambarberita']['name'];
			$path = './uploads/poster_berita/';

			// upload foto baru
			if ($new_gambar == true) {
				date_default_timezone_set('Asia/Jakarta');
				if ($this->upload->do_upload('gambarberita')) {
					// hapus foto lama selain foto default
					$fileGambar = $this->upload->data("file_name");
					if ($old_gambar != 'default.jpg' && file_exists($path . $old_gambar)) {
						unlink(FCPATH . $path . $old_gambar);
					}
				}
			} else {
				$fileGambar = $old_gambar;
			}

			$data = array(
				'judul' => $this->input->post('judul'),
				'body' => $this->input->post('body'),
				'tanggal' => date('Y-m-d H:i:s'),
				'gambar' => $fileGambar,
				'id_kb' => $this->input->post('kategori'),
				'id_admin' => $this->session->id,
			);
			$this->Model_admin->update_berita($data, $id);
			$this->session->set_flashdata('flash', 'Berita Berhasil Diupdate');
			redirect("Admin/berita");
		}
	}

	public function hapus_berita($id, $file)
	{
		$path = './uploads/poster_berita/';
		if ($file != 'default.jpg') {
			unlink(FCPATH . $path . $file);
		}
		$this->Model_admin->delete_berita($id);
		$this->session->set_flashdata('flash', 'Berita Berhasil Di Hapus');
		redirect('Admin/berita');
	}

	// validasi file image berita
	public function validate_image()
	{
		$check = true;

		if (isset($_FILES['gambarberita']) && $_FILES['gambarberita']['size'] != 0) {
			$allowedExts = array("gif", "jpeg", "jpg", "png", "JPG", "JPEG", "GIF", "PNG");
			$allowedTypes = array(IMAGETYPE_PNG, IMAGETYPE_JPEG, IMAGETYPE_GIF);
			$extension = pathinfo($_FILES["gambarberita"]["name"], PATHINFO_EXTENSION);
			$detectedType = exif_imagetype($_FILES['gambarberita']['tmp_name']);
			$type = $_FILES['gambarberita']['type'];
			if (!in_array($detectedType, $allowedTypes)) {
				$this->form_validation->set_message('validate_image', 'Harus Image jpg,png,jpeg');
				$check = false;
			}
			// satuan byte max 2mb
			if (filesize($_FILES['gambarberita']['tmp_name']) > 2097152) {
				$this->form_validation->set_message('validate_image', 'Maksimal Ukuran Gambar 2MB!');
				$check = false;
			}
			if (!in_array($extension, $allowedExts)) {
				$this->form_validation->set_message('validate_image', "File Extensi {$extension} Salah");
				$check = false;
			}
		}
		// dd($check);
		return $check;
	}
	public function kategori_berita($id_kb)
	{
		$berita = $this->Model_admin->get_berita_by_kb($id_kb);

		if (empty($berita)) {
			redirect('Admin/berita');
		}

		$data = [
			'berita' => $berita,
			'kb' => $this->Model_admin->get_kb($id_kb),
		];

		$this->load->view('dashboard/admin/daftar_berita', $data);
	}

	public function tags($tag)
	{
		$berita = $this->Model_admin->get_berita_by_tag($tag);

		if (empty($berita)) {
			redirect('Admin/berita');
		}

		$data = [
			'berita' => $berita,
		];

		// dd($data);
		$this->load->view('dashboard/admin/daftar_berita', $data);
	}

	public function tambah_tags()
	{
		// $iduser = $this->session->id;
		$data = array(
			'berita' => $this->Model_admin->get_berita(),
		);
		$this->load->view('dashboard/admin/tambah_tag', $data);
	}

	public function input_tag()
	{
		$this->load->library('form_validation');

		$this->form_validation->set_rules('id_berita', 'Berita', 'required|trim');
		$this->form_validation->set_rules('tag1', 'Tag1', 'required|trim');
		if ($this->form_validation->run() == false) {
			$this->tambah_tags();
		} else {
			$id_berita = $this->input->post('id_berita');
			$no = 1;
			$data = [];
			while ($no <= 3) {
				array_push($data, array(
					'tag' => $this->input->post('tag' . $no),
					'id_berita' => $id_berita,
				));
				$no++;
			}
			$this->Model_admin->create_tag($data);
			$this->session->set_flashdata('flash', 'Berhasil Menambahkan Tags');
			redirect('Admin/berita');
		}
	}
	public function edit_tag($id)
	{
		$data = array(
			'tags' => $this->Model_admin->get_tags_and_one_berita($id),
		);
		if (empty($data['tags'])) {
			$this->session->set_flashdata('flash', 'Tidak Ada Tags, Silakan Tambahkan Dulu');
			redirect('Admin/tambah_tags');
		} else {
			$this->load->view('dashboard/admin/edit_tag', $data);
		}
	}

	// harus ada Primary key unique
	public function update_tag($id)
	{
		$this->load->library('form_validation');

		$this->form_validation->set_rules(
			'tag1',
			'Tag1',
			'required|trim',
			array(
				'required' => 'Minimal satu tag tidak boleh kosong (%s)',
			)
		);
		$length_tags = $this->Model_admin->get_tags_and_one_berita($id);

		if ($this->form_validation->run() == false) {
			$this->edit_tag($id);
		} else {
			$no = 1;
			$data = [];
			while ($no <= count($length_tags)) {
				array_push($data, array(
					'tag' => $this->input->post('tag' . $no),
				));
				$no++;
			}
			$this->Model_admin->update_tag($data, $id);
			$this->session->set_flashdata('flash', 'Berhasil Update Tags');
			redirect('Admin/berita');
		}
	}

	// --------------
	// Kelola Unduhan
	// --------------
	public function unduhan($id_unduhan = null)
	{
		// Jika $id_unduhan null berarti ambil semua etalase
		if (is_null($id_unduhan)) {
			$data = [
				'unduhan' => $this->Model_admin->get_unduhan(),
			];

			return $this->load->view('dashboard/admin/daftar_unduhan', $data);
		}

		$data = [
			'unduhan' => $this->Model_admin->get_unduhan($id_unduhan),
		];

		$this->load->view('dashboard/admin/unduhan', $data);
	}

	public function tambah_unduhan()
	{
		if ($this->input->method() === 'post') {
			$this->_input_unduhan();
		}

		$data = array(
			'kategori' => $this->Model_admin->get_all_ku(),
		);

		$this->load->view('dashboard/admin/tambah_unduhan', $data);
	}

	private function _input_unduhan()
	{
		$this->load->library('form_validation');

		$this->form_validation->set_rules('nama_unduhan', 'Nama Unduhan', 'required');
		$this->form_validation->set_rules('kategori', 'Kategori', 'required|integer|greater_than[0]');
		// $this->form_validation->set_rules('unduhan', 'File unduhan', 'callback_validate_unduhan');

		if (! $this->form_validation->run()) {
			return;
		}
		

		$this->load->library('upload');

		if (! $this->_uploadUnduhan()) {
			return;
		}

		$data = array(
			'nama_unduhan' => $this->input->post('nama_unduhan'),
			'kapasitas'    => $this->upload->data('file_size'), // file size satuan kilo byte
			'id_ku'        => $this->input->post('kategori'),
			'file'         => $this->upload->data('file_name'),
			'id_admin'     => $this->session->id,
		);

		$this->Model_admin->create_unduhan($data);
		$this->session->set_flashdata('flash', 'Unduhan Berhasil Ditambahkan');

		redirect("Admin/unduhan");
	}

	public function edit_unduhan($id)
	{
		if ($this->input->method() === 'post') {
			$this->_update_unduhan();
		}

		$unduhan = $this->Model_admin->get_unduhan($id);

		$data = array(
			'unduhan'  => $unduhan,
			'kategori' => $this->Model_admin->get_all_ku(),
		);

		$this->load->view('dashboard/admin/edit_unduhan', $data);
	}

	private function _update_unduhan()
	{
		$this->load->library('form_validation');

		// Validasi id_unduhan
		$this->form_validation->set_rules('u', '', 'required|integer|greater_than[0]');

		if (! $this->form_validation->run()) {
			redirect('Admin');
		}

		$id_unduhan = $this->input->post('u');

		// Validasi inputan
		$this->form_validation->set_rules('nama_unduhan', 'Nama Unduhan', 'required');
		$this->form_validation->set_rules('kategori', 'Kategori', 'required|integer|greater_than[0]');
		// $this->form_validation->set_rules('unduhan', 'Unduhan', 'callback_validate_unduhan');

		if (! $this->form_validation->run()) {
			return;
		}

		// data untuk di-update
		$data = [];

		// Jika ada file yang diupload maka simpan file baru dan hapus file lama
		if ($_FILES['unduhan']['error'] !== UPLOAD_ERR_NO_FILE) {
			$this->load->library('upload');
	
			if (! $this->_uploadUnduhan()) {
				return;
			}

			$nama_file_lama = $this->Model_admin->get_file_unduhan_lama($id_unduhan);
			
			unlink('./uploads/file_unduhan/'.$nama_file_lama);

			$data['kapasitas'] = $this->upload->data('file_size'); // file size satuan kilo byte
			$data['file']      = $this->upload->data('file_name');
		}

		
		// $old_unduhan = $this->input->post("old_unduhan");
		// $new_unduhan = $_FILES['unduhan']['name'];
		// $path = './uploads/file_unduhan/';

		// if ($new_unduhan == true) {
		// 	date_default_timezone_set('Asia/Jakarta');
		// 	$config['upload_path'] = "./uploads/file_unduhan/";
		// 	$config['allowed_types'] = "pdf|xlsx|docx|doc|ppt";
		// 	// kilo byte
		// 	$config['max_size'] = 5000;
		// 	$config['encrypt_name'] = true;

		// 	$this->load->library('upload', $config);

		// 	if ($this->upload->do_upload('unduhan')) {
		// 		$file = $this->upload->data('file_name');
		// 		// hapus foto lama selain foto default
		// 		$fileUnduhan = $this->upload->data("file_name");
		// 		$fileKapasitas = $this->upload->data("file_size");
		// 		if (file_exists($path . $old_unduhan)) {
		// 			unlink(FCPATH . $path . $old_unduhan);
		// 		}
		// 	}
		// } else {
		// 	$fileKapasitas = $this->input->post("old_kapasitas");
		// 	$fileUnduhan = $old_unduhan;
		// }

		// $data = array(
		// 	'nama_unduhan' => $this->input->post('nama_unduhan'),
		// 	'tanggal' => date('Y-m-d H:i:s'),

		// 	// file size satuan KB
		// 	'kapasitas' => $fileKapasitas,
		// 	'id_ku' => $this->input->post('kategori'),
		// 	'file' => $fileUnduhan,
		// 	'id_admin' => $this->session->id,
		// );
		// dd($data);

		$data['nama_unduhan'] = $this->input->post('nama_unduhan');
		$data['id_ku'] = $this->input->post('kategori');
		$data['id_admin'] = $this->session->id;

		// dd($data);
		$this->Model_admin->update_unduhan($data, $id_unduhan);
		$this->session->set_flashdata('flash', 'Unduhan berhasil diupdate');

		redirect("Admin/unduhan");
	}

	/**
	 * Callback custom untuk validasi unduhan
	 * 
	 * @return bool
	 */
	// public function validate_unduhan()
	// {
	// 	if ($this->input->method() === 'get') {
	// 		return show_404();
	// 	}

	// 	// ini pengecekan file kosong
	// 	// tapi jika di update
	// 	// file tersebut tetap tercek
	// 	if ((! isset($_FILES['unduhan'])) || $_FILES['unduhan']['size'] === 0) {
	// 		$this->form_validation->set_message('validate_unduhan', '{field} tidak boleh kosong');

	// 		return FALSE;
	// 	} elseif (isset($_FILES['unduhan']) && $_FILES['unduhan']['size'] !== 0) {

	// 		// Cek ukuran maks
	// 		// satuan byte, 5MB
	// 		if (filesize($_FILES['unduhan']['tmp_name']) > 5242880) {
	// 			$this->form_validation->set_message('validate_unduhan', 'Maksimal ukuran file 5MB');

	// 			return FALSE;
	// 		}

	// 		$allowedExts = array('pdf', 'xlsx', 'docx', 'doc', 'ppt');
	// 		$extension   = pathinfo($_FILES["unduhan"]["name"], PATHINFO_EXTENSION);

	// 		if (! in_array($extension, $allowedExts)) {
	// 			$this->form_validation->set_message('validate_unduhan', 
	// 				"File extensi {$extension} tidak bisa diunggah. Hanya unggah file dengan ekstensi .pdf, .docx, .doc, .xlsx, .ppt");

	// 			return FALSE;
	// 		}
	// 	}

	// 	return TRUE;
	// }

	/**
	 * Upload File Unduhan
	 * 
	 * dan juga untuk validasi
	 * 
	 * @return bool
	 */
	private function _uploadUnduhan()
	{
		$config['upload_path']   = "./uploads/file_unduhan/";
		$config['allowed_types'] = "pdf";
		$config['max_size']      = 5000;
		$config['encrypt_name']  = true;

		$this->upload->initialize($config);

		if (! $this->upload->do_upload('unduhan')) {
			$this->alert->danger('Unduhan gagal diinputkan karena file gagal diunggah');
			$this->alert->danger($this->upload->display_errors('', ''));

			return FALSE;
		}

		return TRUE;
	}

	public function hapus_unduhan()
	{
		if ($this->input->method() !== 'post') {
			redirect('Admin/unduhan');
		}


		$this->load->library('form_validation');

		$this->form_validation->set_rules('hapus-unduhan', 'unduhan yang dihapus', 'required|integer|greater_than[0]');

		if (! $this->form_validation->run()) {
			$this->alert->danger(validation_errors());

			redirect('Admin/unduhan');
		}

		$id_unduhan = $this->input->post('hapus-unduhan');
		$result = $this->Model_admin->delete_unduhan($id_unduhan);

		if (! $result)
			redirect('Admin/unduhan');

			
		$file = $this->Model_admin->get_file_unduhan_lama($id_unduhan);
		$path = './uploads/file_unduhan/';

		unlink(FCPATH . $path . $file);

		$this->session->set_flashdata('flash', 'Berhasil Di Hapus');
		redirect('Admin/unduhan');
	}

	public function kategori_unduhan($id_ku)
	{
		$unduhan = $this->Model_admin->get_unduhan_by_ku($id_ku);

		if (empty($unduhan)) {
			redirect('Admin/unduhan');
		}

		$data = [
			'unduhan' => $unduhan,
			'ku' => $this->Model_admin->get_ku($id_ku),
		];

		$this->load->view('dashboard/admin/daftar_unduhan', $data);
	}


	// --------------
	// FAQ
	// --------------
	public function faq($id_faq = null)
	{
		// Jika $id_faq null berarti ambil semua etalase
		if (is_null($id_faq)) {
			$data = [
				'faq' => $this->Model_admin->get_faq(),
			];

			return $this->load->view('dashboard/admin/daftar_faq', $data);
		}

		$data = [
			'faq' => $this->Model_admin->get_faq($id_faq),
		];

		$this->load->view('dashboard/admin/faq', $data);
	}

	public function tambah_faq()
	{
		if ($this->input->method() !== 'post') {
			return $this->load->view('dashboard/admin/tambah_faq');
		}

		$this->load->library('form_validation');

		$this->form_validation->set_rules('pertanyaan', 'Pertanyaan', 'required|max_length[200]|trim');
		$this->form_validation->set_rules('jawaban', 'Jawaban', 'required|max_length[200]|trim');

		if (!$this->form_validation->run()) {
			return $this->load->view('dashboard/admin/tambah_faq');
		}

		$data = array(
			'pertanyaan' => $this->input->post('pertanyaan'),
			'jawaban'    => $this->input->post('jawaban'),
			'id_admin'   => $this->session->id,
		);

		$result = $this->Model_admin->create_faq($data);

		$pesan  = $result ? 'Berhasil' : 'Gagal';

		$this->session->set_flashdata('flash', $pesan . ' menambahkan data');

		redirect('Admin/faq');
	}

	public function input_faq()
	{
		if ($this->input->method() !== 'post') {
			redirect('Admin/faq');
		}

		$this->load->library('form_validation');

		$this->form_validation->set_rules('pertanyaan', 'Pertanyaan', 'required|max_length[200]|trim');
		$this->form_validation->set_rules('jawaban', 'Jawaban', 'required|max_length[200]|trim');

		if (!$this->form_validation->run()) {
			return $this->tambah_faq();
		}

		$data = array(
			'pertanyaan' => $this->input->post('pertanyaan'),
			'jawaban' => $this->input->post('jawaban'),
			'id_admin' => $this->session->id,
		);

		$this->Model_admin->create_faq($data);
		$this->session->set_flashdata('flash', 'Berhasil Menambahkan Data');

		redirect('Admin/faq');
	}

	public function edit_faq($id_faq)
	{
		$faq = $this->Model_admin->get_faq($id_faq);

		$data = array(
			'pertanyaan' => set_value('pertanyaan', $faq->pertanyaan),
			'jawaban' => set_value('jawaban', $faq->jawaban),
			'id_faq' => $id_faq,
		);

		$this->load->view('dashboard/admin/edit_faq', $data);
	}

	public function update_faq($id_faq)
	{
		if ($this->input->method() !== 'post') {
			redirect('Admin/faq');
		}

		$this->load->library('form_validation');

		$this->form_validation->set_rules('pertanyaan', 'Pertanyaan', 'required|max_length[200]|trim');
		$this->form_validation->set_rules('jawaban', 'Jawaban', 'required|max_length[200]|trim');

		if (!$this->form_validation->run()) {
			$this->edit_faq($id_faq);
		} else {
			$data = array(
				'pertanyaan' => $this->input->post('pertanyaan'),
				'jawaban' => $this->input->post('jawaban'),
				'id_admin' => $this->session->id,
			);

			$this->Model_admin->update_faq($data, $id_faq);
			$this->session->set_flashdata('flash', 'Berhasil Update Data');

			redirect('Admin/faq');
		}
	}

	public function hapus_faq()
	{
		if ($this->input->method() !== 'post') {
			redirect('Admin/faq');
		}

		$this->load->library('form_validation');

		$this->form_validation->set_rules('hapus-faq', 'FAQ yang dihapus', 'required|integer|greater_than[0]');

		if (! $this->form_validation->run()) {
			$this->alert->danger(validation_errors());

			redirect('Admin/faq');
		}

		$id_faq = $this->input->post('hapus-faq');
		$result = $this->Model_admin->delete_faq($id_faq);

		$pesan  = $result ? 'berhasil' : 'gagal';
		$alert  = $result ? 'success' : 'danger';

		$this->alert->$alert('Data FAQ ' . $pesan . ' dihapus');
		redirect('Admin/faq');
	}

	// --------------
	// Kelola Kontak
	// --------------

	public function kontak()
	{
		if ($this->input->method() === 'post') {
			$this->_update_kontak();

			$data['kontak'] = $this->input->post();
		} else {
			$data['kontak'] = $this->Model_admin->get_kontak();
		}

		// dd($data);
		$this->load->view('dashboard/admin/kontak', $data);
	}

	private function _update_kontak()
	{
		/* validasi */
		$this->load->library('form_validation');

		$input_names = array_keys($this->input->post());

		foreach ($input_names as $input) {
			$rule = 'max_length[300]';

			if ($input === 'nama_kontak' || $input === 'alamat' || $input === 'telepon_1' || $input === 'email') {
				$rule = 'required|max_length[300]';
			} elseif ($input === 'googlemap') {
				// Dilebihkan 200 dari constraint di database (300 karakter)
				// karena di database hanya untuk menyimpan nilai dari atribut src dari <iframe>
				// sedangkan inputan untuk google map di-copy dari <iframe> google map langsung yang panjangnya bisa lebih dari 300 karakter.
				// Kenapa tidak di database saja yg diperpanjang constraint-nya lebih dari 300?
				// Karena saat ini ini adalah solusi yang paling gampang dan singkat, masih perlu memprioritaskan task yg lain
				$rule = 'max_length[500]';
			}

			$this->form_validation->set_rules($input, ucwords(str_replace('_', ' ', $input)), $rule);
		}

		if (!$this->form_validation->run()) {
			return;
		}


		$input = $this->input->post();


		$dom = new DOMDocument();
		$dom->loadHTML($this->input->post('googlemap'));

		$iframe = $dom->getElementsByTagName('iframe')[0];

		$googlemap_src = $iframe->getAttribute('src');

		unset($input['googlemap']);
		$input['googlemap_src'] = $googlemap_src;


		$data = [];

		foreach ($input as $key => $value) {
			array_push($data, [
				'key' => $key,
				'value' => $value
			]);
		}

		// dd($data);
		$result = $this->Model_admin->update_kontak($data);

		if ($result === FALSE) {
			$this->alert->danger('Update kontak gagal');
		} elseif ($result > 0) {
			$this->alert->success('Berhasil update kontak');
		}

		redirect('Admin/kontak');
	}

	public function tambah_kontak()
	{
		if ($this->input->method() !== 'post') {
			return $this->load->view('dashboard/admin/tambah_kontak');
		}

		$this->load->library('form_validation');

		$this->form_validation->set_rules('data_baru[key][]', 'Nama Data Baru', 'required|max_length[50]');
		$this->form_validation->set_rules('data_baru[value][]', 'Nilai Data Baru', 'required|max_length[300]');

		if (!$this->form_validation->run()) {
			return $this->load->view('dashboard/admin/tambah_kontak');
		}

		$data_keys   = $this->input->post('data_baru[key][]');
		$data_values = $this->input->post('data_baru[value][]');
		$data        = [];

		for ($i = 0; $i < count($data_keys); $i++) {
			array_push($data, [
				'key'   => $data_keys[$i],
				'value' => $data_values[$i],
			]);
		}

		$result = $this->Model_admin->insert_kontak($data);

		if ($result === FALSE) {
			$this->alert->danger('Tambah data kontak baru gagal');
		} elseif ($result > 0) {
			$this->alert->success('Berhasil tambah data kontak baru');
		}

		redirect('Admin/kontak');
	}

	public function hapus_kontak()
	{
		if ($this->input->method() !== 'post') {
			redirect('Admin/kontak');
		}

		$this->load->library('form_validation');

		$this->form_validation->set_rules('hapus-kontak', 'kontak yang dihapus', 'required');

		if (!$this->form_validation->run()) {
			$this->alert->danger(validation_errors());

			redirect('Admin/kontak');
		}

		$data = $this->input->post();

		if (in_array($data['hapus-kontak'], ['nama-kontak', 'alamat', 'telepon_1', 'telepon_2', 'jam-telepon', 'email', 'website', 'googlemap'])) {
			$this->alert->danger('Data kontak <i>' . ucwords(str_replace('-', ' ', $data['hapus-kontak'])) . '</i> tidak bisa untuk dihapus.');

			redirect('Admin/kontak');
		}


		$result = $this->Model_admin->delete_kontak($data['hapus-kontak']);

		$alert  = $result ? ['success', 'berhasil'] : ['danger', 'gagal'];

		$this->alert->$alert[0]('Data kontak <i>' . ucwords(str_replace('-', ' ', $data['hapus-kontak'])) . '</i> ' . $alert[1] . ' dihapus');
		redirect('Admin/kontak');
	}

	// --------------
	// Lain-lain
	// --------------
	public function kategori()
	{
		$data = $this->Model_admin->get_kategori();

		// dd($data);
		$this->load->view('dashboard/admin/kategori', $data);
	}

	// --------------

	/**
	 * Get kode status
	 *
	 * @param   string    $status    Nama status yang digunakan di front-end
	 * @return  array
	 */
	private function _get_status(string $status): array
	{
		$kode_status = [
			'diproses' => [0, 1],
			'dinegosiasi' => [2, 3, 4],
			'dikirim' => [5, 6],
			'selesai' => [7, 8],
		];

		return $kode_status[$status];
	}
}
