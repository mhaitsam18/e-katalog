<?php
defined('BASEPATH') or exit('No direct script access allowed');

use Box\Spout\Reader\Common\Creator\ReaderEntityFactory;

class Penyedia extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Model_penyedia');
        $this->load->library('form_validation');
        // Cek authorization
        if ($this->session->level !== 'penyedia') {
            session_destroy();
            return redirect('login');
        };
    }

    public function index()
    {
        $id = $this->session->id;
        $data = array(
            'produk'   => $this->Model_penyedia->get_jumlah_produk($id),
			'pengumuman' => $this->Model_penyedia->get_jumlah_pengumuman($id),
            'nego'     => $this->Model_penyedia->get_jumlah_negosiasi($id),
            'proses'    =>  $this->Model_penyedia->get_jumlah_proses($id),
			'kirim'    =>  $this->Model_penyedia->get_jumlah_kirim($id),
            'selesai'  => $this->Model_penyedia->get_jumlah_selesai($id),
            'produknew' => $this->Model_penyedia->get_produk_new($id)
        );
        $this->load->view('dashboard/penyedia/index', $data);
    }

    public function kategori_etalase()
    {
        $id = $this->session->id;
        $data = array(
            'kategori_etalase' => $this->Model_penyedia->get_kategori_etalase(),
            'etalase_produk' => $this->Model_penyedia->get_produk_etalase($id),
            'item' => $this->Model_penyedia->get_item_etalase($id),
        );
        $this->load->view('dashboard/penyedia/kategori_etalase', $data);
    }

    public function etalase_produk()
    {
        $id = $this->session->id;
        $data = array(
            'produk' => $this->Model_penyedia->get_produk($id),
        );
        $this->load->view('dashboard/penyedia/etalase_produk', $data);
    }

    public function spesifikasi_produk($id)
    {
        $data = array(
            'detail_produk' => $this->Model_penyedia->get_detail_produk1($id),
            'spesifikasi' => $this->Model_penyedia->spesifikasi_produk($id),
        );
        $this->load->view('dashboard/penyedia/etalase_produk2', $data);
    }

    public function lampiran($id)
    {
        $data = array(
            'detail_produk' => $this->Model_penyedia->get_detail_produk1($id),
            'lampiran' => $this->Model_penyedia->lampiran($id),
        );
        $this->load->view('dashboard/penyedia/lampiran_produk', $data);
    }

    public function tambah_produk($hasil)
    {
        $id = $this->session->id;
        $data = array(
            'etalase_produk' => $this->Model_penyedia->get_produk_etalase($id),
            'item' => $this->Model_penyedia->get_item_etalase($id),
            'hasil' => $hasil,
        );
        $this->load->view('dashboard/penyedia/tambah_produk', $data);
    }

    public function tambah_produk2()
    {
        $this->load->view('dashboard/penyedia/tambah_produk2');
    }

    public function tambah_lampiran()
    {
        $id = $this->session->id;
        $data = array(
            'produk' => $this->Model_penyedia->get_produk($id),
        );
        $this->load->view('dashboard/penyedia/tambah_lampiran', $data);
    }

    public function input_data()
    {
        $file = $this->input->post('filedata');
        $hasil = 'berhasil';
        $pesan = 'Import data berhasil';

        $config['upload_path'] = "./uploads/file_excel/";
        $config['allowed_types'] = "xlsx|xls";
        $config['max_size'] = 2000;
        $config['encrypt_name'] = true;

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('filedata')) {
            $hasil = 'gagal';
            $pesan = $this->upload->display_errors();
        } else {
            $file = $this->upload->data();
            $reader = ReaderEntityFactory::createXLSXReader();

            $reader->open('uploads/file_excel/' . $file['file_name']);

            $dataBarang = [];

            foreach ($reader->getSheetIterator() as $sheet) {
                $numRow = 1;

                foreach ($sheet->getRowIterator() as $row) {
                    if ($numRow > 1) {

                        // field yg tidak boleh NULL berdasarkan skema database tabel produk
                        $nama_produk = $row->getCellAtIndex(0)->getValue();
                        $harga = $row->getCellAtIndex(1)->getValue();
                        $merek = $row->getCellAtIndex(3)->getValue();
                        $kode_kbki = $row->getCellAtIndex(6)->getValue();
                        $stok = $row->getCellAtIndex(8)->getValue();
                        $id_etalase = $row->getCellAtIndex(10)->getValue();
                        $no_item = $row->getCellAtIndex(11)->getValue();

                        // jika field di atas ada yang kosong maka keluar loop untuk berhenti mengambil data di file excel
                        if (empty($nama_produk) ||
                            empty($harga) ||
                            empty($merek) ||
                            empty($kode_kbki) ||
                            empty($stok) ||
                            empty($id_etalase) ||
                            empty($no_item)) {

                            $hasil = 'gagal';
                            $pesan = 'Terdapat baris pada spreadsheet yang tidak sesuai format. Periksa kembali data yang harus diisi.' .
                                '<br> Kemungkinan kesalahan berada pada baris ke-' . $numRow;

                            break 2;
                        }

                        array_push($dataBarang, array(
                            'id_etalase' => $id_etalase,
                            'nama_produk' => $nama_produk,
                            'merek' => $merek,
                            'harga' => $harga,
                            'harga_ppn' => $row->getCellAtIndex(2)->getValue(),
                            'no_produk_penyedia' => $row->getCellAtIndex(4)->getValue(),
                            'unit_pengukuran' => $row->getCellAtIndex(5)->getValue(),
                            'kode_kbki' => $kode_kbki,
                            'nilai_tkdn' => $row->getCellAtIndex(7)->getValue(),
                            'stok' => $stok,
                            'deskripsi' => $row->getCellAtIndex(9)->getValue(),
                            'no_item' => $no_item,
                            'id_penyedia' => $this->session->id,
                        ));
                    }

                    $numRow++;
                }
            }

            $reader->close();

            if ($hasil === 'berhasil') {
                $this->Model_penyedia->import_data($dataBarang);
            }

            unlink('uploads/file_excel/' . $file['file_name']);
        }

        $this->session->set_flashdata(array(
            'hasil' => $hasil,
            'pesan' => $pesan,
        ));

        // d($numRow);
        // d($this->session->flashdata());
        // dd($dataBarang);
        redirect('Penyedia/tambah_produk2');
    }

    public function input_produk()
    {
        $kategori = $this->input->post('kategori');
        $item = $this->input->post('item');
        $produk = $this->input->post('namaproduk');
        $merk = $this->input->post('merk');
        $harga = $this->input->post('hargaproduk');
        $masaberlaku = $this->input->post('masaberlaku');
        $nopenyedia = $this->input->post('noproduk');
        $unit = $this->input->post('unit');
        $kode = $this->input->post('kode');
        $tkdn = $this->input->post('nilai');
        $stok = $this->input->post('stokproduk');
        $deskripsi = $this->input->post('deskripsi');
        $foto = $this->input->post('foto');
        $hitung = $harga * 0.11;
        $harga_ppn = $harga + $hitung;

        $config['upload_path'] = "./uploads/foto_produk/";
        $config['allowed_types'] = "jpeg|jpg|png";
        $config['max_size'] = 2000;
        $config['encrypt_name'] = true;

        //   $this->form_validation->set_rules($foto,'Foto Produk','required',
        //   array(
        //      'required'  => '%s tidak boleh kosong'
        //   ));
        // if($this->form_validation->run() == FALSE){
        //   $this->tambah_produk("gagal");
        // }else{
        $this->load->library('upload', $config);
        if ($this->upload->do_upload('foto')) {
            $foto = $this->upload->data();
            $data = array(
                'id_etalase' => $kategori,
                'nama_produk' => $produk,
                'merek' => $merk,
                'harga' => $harga,
                'harga_ppn' => $harga_ppn,
                'masa_berlaku' => $masaberlaku,
                'no_produk_penyedia' => $nopenyedia,
                'unit_pengukuran' => $unit,
                'kode_kbki' => $kode,
                'nilai_tkdn' => $tkdn,
                'stok' => $stok,
                'deskripsi' => $deskripsi,
                'foto' => $foto['file_name'],
                'id_penyedia' => $this->session->id,
                'no_item' => $item,
            );
            $simpan = $this->Model_penyedia->create_produk($data);
            if ($simpan) {
                redirect('Penyedia/tambah_produk/berhasil');
            } else {
                redirect('Penyedia/tambah_produk/gagal');
            }
        } else {
            $data = array(
                'id_etalase' => $kategori,
                'nama_produk' => $produk,
                'merek' => $merk,
                'harga' => $harga,
                'harga_ppn' => $harga_ppn,
                'masa_berlaku' => $masaberlaku,
                'no_produk_penyedia' => $nopenyedia,
                'unit_pengukuran' => $unit,
                'kode_kbki' => $kode,
                'nilai_tkdn' => $tkdn,
                'stok' => $stok,
                'deskripsi' => $deskripsi,
                'id_penyedia' => $this->session->id,
                'no_item' => $item,
            );
            $simpan = $this->Model_penyedia->create_produk($data);
            if ($simpan) {
                $hasil = "berhasil";
                redirect('Penyedia/tambah_produk/' . $hasil);
            } else {
                $hasil = "gagal";
                redirect('Penyedia/tambah_produk/' . $hasil);
            }
        }
    }

	public function input_dokumen()
    {
        $config['upload_path'] = "./uploads/dokumen/";
        $config['allowed_types'] = "pdf|zip|rar";
        // $config['max_size'] = 2000;
        $config['encrypt_name'] = true;

        //   $this->form_validation->set_rules($foto,'Foto Produk','required',
        //   array(
        //      'required'  => '%s tidak boleh kosong'
        //   ));
        // if($this->form_validation->run() == FALSE){
        //   $this->tambah_produk("gagal");
        // }else{
        $this->load->library('upload', $config);
        if ($this->upload->do_upload('foto')) {
            $foto = $this->upload->data();
			$id = $this->input->post('id');
            $data = array(
                'dokumen' => $foto['file_name'],
            );
			$update = $this->Model_penyedia->update_paket($data,$id);
			echo "<script type='text/javascript'>
			alert('Dokumen Berhasil Diupdate');
			window.location='kelola_kirim';
			</script>";
        } else {
            echo "<script type='text/javascript'>
			alert('Dokumen Gagal Diupdate');
			window.location='kelola_kirim';
			</script>";
        }
    }

    public function tambah_spesifikasi($hasil)
    {
        $id = $this->session->id;
        $data = array(
            'produk' => $this->Model_penyedia->get_produk($id),
            'hasil' => $hasil,
        );
        $this->load->view('dashboard/penyedia/tambah_spesifikasi', $data);
    }

    public function inputSpesifikasi()
    {
        $kategori = $this->input->post('kategori');
        $no = 1;
        while ($no <= 10) {
            if ($this->input->post('spesifikasi' . $no)) {
                $data = array(
                    'spesifikasi' => $this->input->post('spesifikasi' . $no),
                    'nilai' => $this->input->post('nilai' . $no),
                    'id_produk' => $kategori,
                );
				// print_r($data);
                $simpan = $this->Model_penyedia->create_spesifikasi($data);
            } else {
                $data = "empty";
            }
            $no++;
        }
        if ($simpan) {
            redirect('Penyedia/tambah_spesifikasi/berhasil');
        } else {
            redirect('Penyedia/tambah_spesifikasi/gagal');
        }
    }

    public function inputLampiran()
    {
        $kategori = $this->input->post('kategori');
        $lampiran = $this->input->post('namalampiran');
        $file = $this->input->post('foto');

        $config['upload_path'] = "./uploads/file_lampiran/";
        $config['allowed_types'] = "pdf|docs|jpg";
        $config['max_size'] = 2000;
        $config['encrypt_name'] = true;

        $this->load->library('upload', $config);
        if ($this->upload->do_upload('foto')) {
            $file = $this->upload->data();
            $data = array(
                'id_produk' => $kategori,
                'nama_lampiran' => $lampiran,
                'keterangan' => $file['file_name'],
            );
            $simpan = $this->Model_penyedia->create_lampiran($data);
            if ($simpan) {
                redirect('Penyedia/tambah_produk/berhasil');
            } else {
                redirect('Penyedia/tambah_produk/gagal');
            }
        } else {
            $data = array(
                'id_etalase' => $kategori,
                'nama_lampiran' => $lampiran,
            );
            $simpan = $this->Model_penyedia->create_lampiran($data);
            if ($simpan) {
                redirect('Penyedia/tambah_produk/berhasil');
            } else {
                redirect('Penyedia/tambah_produk/gagal');
            }
        }
    }

    public function edit_produk($id)
    {
        $idproduk = $this->session->id;
        $data = array(
            'detail_produk' => $this->Model_penyedia->get_detail_produk($id),
            'etalase_produk' => $this->Model_penyedia->get_produk_etalase($idproduk),
            'hasil' => $id,
        );
        $this->load->view('dashboard/penyedia/edit_produk', $data);
    }

    public function updateProduk()
    {
        $id = $this->input->post('id');
        $kategori = $this->input->post('kategori');
        $produk = $this->input->post('namaproduk');
        $merk = $this->input->post('merk');
        $harga = $this->input->post('hargaproduk');
        $masaberlaku = $this->input->post('masaberlaku');
        $nopenyedia = $this->input->post('noproduk');
        $unit = $this->input->post('unit');
        $kode = $this->input->post('kode');
        $tkdn = $this->input->post('nilai');
        $stok = $this->input->post('stokproduk');
        $deskripsi = $this->input->post('deskripsi');
        $foto = $this->input->post('foto');
        $hitung = $harga * 0.11;
        $harga_ppn = $harga + $hitung;

        $config['upload_path'] = "./uploads/foto_produk/";
        $config['allowed_types'] = "jpeg|jpg|png";
        $config['max_size'] = 2000;
        $config['encrypt_name'] = true;

        // $this->form_validation->set_rules('namapromo','Nama Promo','required',
        //  array(
        //     'required'  => '%s tidak boleh kosong'
        //  ));
        //  if($this->form_validation->run() == FALSE){
        //     $this->tambahPromo();
        //  }else{
        $this->load->library('upload', $config);
        if ($this->upload->do_upload('foto')) {
            $foto = $this->upload->data();
            $data = array(
                'id_etalase' => $kategori,
                'nama_produk' => $produk,
                'merek' => $merk,
                'harga' => $harga,
                'harga_ppn' => $harga_ppn,
                'masa_berlaku' => $masaberlaku,
                'no_produk_penyedia' => $nopenyedia,
                'unit_pengukuran' => $unit,
                'kode_kbki' => $kode,
                'nilai_tkdn' => $tkdn,
                'stok' => $stok,
                'deskripsi' => $deskripsi,
                'foto' => $foto['file_name'],
            );
            $update = $this->Model_penyedia->update_produk($data, $id);
            if ($update) {
                echo "<script type='text/javascript'>
			   alert('Data Berhasil Diupdate');
			   window.location='etalase_produk';
			   </script>";
            } else {
                echo "<script type='text/javascript'>
			   alert('Data Gagal Diupdate');
			   window.location='etalase_produk';
			   </script>";
            }
        } else {
            $data = array(
                'id_etalase' => $kategori,
                'nama_produk' => $produk,
                'merek' => $merk,
                'harga' => $harga,
                'harga_ppn' => $harga_ppn,
                'masa_berlaku' => $masaberlaku,
                'no_produk_penyedia' => $nopenyedia,
                'unit_pengukuran' => $unit,
                'kode_kbki' => $kode,
                'nilai_tkdn' => $tkdn,
                'stok' => $stok,
                'deskripsi' => $deskripsi,
            );
            $update = $this->Model_penyedia->update_produk($data, $id);
            if ($update) {
                echo "<script type='text/javascript'>
			   alert('Data Berhasil Diupdate');
			   window.location='etalase_produk';
			   </script>";
            } else {
                echo "<script type='text/javascript'>
			   alert('Data Gagal Diupdate');
			   window.location='etalase_produk';
			   </script>";
            }
        }
        // }
    }

    public function edit_spesifikasi($id)
    {
        $data = array(
            'detail_produk' => $this->Model_penyedia->get_detail_produk1($id),
            'spesifikasi' => $this->Model_penyedia->spesifikasi_produk2($id),
        );
        $this->load->view('dashboard/penyedia/edit_spesifikasi', $data);
    }

    public function edit_spesifikasi2($id)
    {
        $data = array(
            'data' => $this->Model_penyedia->spesifikasi_produk3($id),
        );
        $this->load->view('dashboard/penyedia/edit_spesifikasi2', $data);
    }

    public function updateSpesifikasi()
    {
        $id = $this->input->post('id');
        $data = array(
            'spesifikasi' => $this->input->post('spesifikasi'),
            'nilai' => $this->input->post('nilai'),
        );
        $update = $this->Model_penyedia->update_spesifikasi($data, $id);
        if ($update) {
            echo "<script type='text/javascript'>
			  alert('Data Berhasil Diupdate');
			  window.location='etalase_produk';
			  </script>";
        } else {
            echo "<script type='text/javascript'>
			  alert('Data Gagal Diupdate');
			  window.location='etalase_produk';
			  </script>";
        }
    }

    public function hapus_produk($id)
    {
        $hapus3 = $this->Model_penyedia->delete_lampiran($id);
        $hapus1 = $this->Model_penyedia->delete_spesifikasi($id);
        $hapus2 = $this->Model_penyedia->delete_produk($id);
        echo "<script type='text/javascript'>
		 alert('Data Berhasil Dihapus');
		 window.location='../etalase_produk';
		 </script>";
    }

    public function hapus_lampiran($id)
    {
        $hapus3 = $this->Model_penyedia->delete_lampiran2($id);
        echo "<script type='text/javascript'>
		 alert('Data Berhasil Dihapus');
		 window.location='../etalase_produk';
		 </script>";
	}

	// //Pengumuman
	public function pengumuman()
	{
		$id = $this->session->id;
		$data = array(
			'pengumuman' => $this->Model_penyedia->get_pengumuman($id),
		);
		$this->load->view('dashboard/penyedia/pengumuman', $data);
	}

	public function tambah_pengumuman($id)
	{
		$idproduk = $this->session->id;
		$data = array(
			'kategori' => $this->Model_penyedia->get_produk_etalase($idproduk),
			'hasil' => $id
		);
		$this->load->view('dashboard/penyedia/tambah_pengumuman', $data);
	}

	public function inputPengumuman()
	{
		$config['upload_path'] = "./uploads/dokumen_pengumuman/";
		$config['allowed_types'] = "pdf|docs|jpg";
		$config['max_size'] = 2000;
		$config['encrypt_name'] = TRUE;

		// $this->form_validation->set_rules('besarpromo','Besar Promo','required',
		//  array(
		//     'required'  => '%s tidak boleh kosong'
		//  ));
		//  if($this->form_validation->run() == FALSE){
		//     $this->tambahPromo();
		//  }else{
		$this->load->library('upload', $config);
		if ($this->upload->do_upload('filedokumen')) {
			$file = $this->upload->data();
			$data       = array(
				'judul'            => $this->input->post('judul'),
				'jumlah_penawaran' => $this->input->post('jumlah'),
				'syarat_ketentuan' => $this->input->post('syarat'),
				'dok_pengumuman'       => $file['file_name'],
				'id_etalase'       => $this->input->post('kategori'),
				'id_user'          => $this->session->id
			);
			$simpan = $this->Model_penyedia->create_pengumuman($data);
			if ($simpan) {
				redirect('Penyedia/tambah_pengumuman/berhasil');
			} else {
				redirect('Penyedia/tambah_pengumuman/gagal');
			}
		} else {
			$data       = array(
				'judul'            => $this->input->post('judul'),
				'jumlah_penawaran' => $this->input->post('jumlah'),
				'syarat_ketentuan' => $this->input->post('syarat'),
				'id_etalase'       => $this->input->post('kategori'),
				'id_user'          => $this->session->id
			);
			$simpan = $this->Model_penyedia->create_pengumuman($data);
			if ($simpan) {
				redirect('Penyedia/tambah_pengumuman/berhasil');
			} else {
				redirect('Penyedia/tambah_pengumuman/gagal');
			}
		}
	}

	public function hapus_pengumuman($id)
	{
		$hapus3 = $this->Model_penyedia->delete_merek($id);
		$hapus1 = $this->Model_penyedia->delete_tahapan($id);
		$hapus2 = $this->Model_penyedia->delete_pengumuman($id);
		echo "<script type='text/javascript'>
				 alert('Data Berhasil Dihapus');
				 window.location='../pengumuman';
				 </script>";
    }

    public function merek_pengumuman($id)
    {
        $data = array(
            'merek' => $this->Model_penyedia->get_merek($id),
        );
        $this->load->view('dashboard/penyedia/merek_pengumuman', $data);
    }

    public function inputMerek()
    {
        $kategori = $this->input->post('kategoriP');
        $no = 1;
        while ($no <= 6) {
            if ($this->input->post('merek' . $no)) {
                $data = array(
                    'nama_merek' => $this->input->post('merek' . $no),
                    'deskripsi' => $this->input->post('deskripsi' . $no),
                    'id_pengumuman' => $kategori,
                );
                $simpan = $this->Model_penyedia->create_merek($data);
            } else {
                $data = "empty";
            }
            $no++;
        }
        if ($simpan) {
            redirect('Penyedia/tambah_merek/berhasil');
        } else {
            redirect('Penyedia/tambah_merek/gagal');
        }
    }

    public function tambah_merek($id)
    {
        $iduser = $this->session->id;
        $data = array(
            'pengumuman' => $this->Model_penyedia->get_pengumuman($iduser),
            'kategori' => $this->Model_penyedia->get_produk_etalase($iduser),
            'hasil' => $id,
        );
        $this->load->view('dashboard/penyedia/tambah_merek', $data);
    }

    public function hapus_merek($id)
    {
        $hapus3 = $this->Model_penyedia->delete_merek2($id);
        echo "<script type='text/javascript'>
		 alert('Data Berhasil Dihapus');
		 window.location='../pengumuman';
		 </script>";
    }

    public function tahapan_pengumuman($id)
    {
        $data = array(
            'pengumuman' => $this->Model_penyedia->get_pengumuman2($id),
            'tahapan' => $this->Model_penyedia->get_tahapan($id),
        );
        $this->load->view('dashboard/penyedia/tahapan_pengumuman', $data);
    }

    public function tambah_tahapan($id)
    {
        $iduser = $this->session->id;
        $data = array(
            'pengumuman' => $this->Model_penyedia->get_pengumuman($iduser),
            'hasil' => $id,
        );
        $this->load->view('dashboard/penyedia/tambah_tahapanP', $data);
    }

    public function inputTahapan()
    {
        $kategori = $this->input->post('kategoriP');
        $no = 1;
        while ($no <= 6) {
            if ($this->input->post('judul' . $no)) {
                $data = array(
                    'judul' => $this->input->post('judul' . $no),
                    'tanggal_mulai' => $this->input->post('tanggalmulai' . $no),
                    'tanggal_akhir' => $this->input->post('tanggalakhir' . $no),
                    'perubahan' => $this->input->post('perubahan' . $no),
                    'id_pengumuman' => $kategori,
                );
                $simpan = $this->Model_penyedia->create_tahapan($data);
            } else {
                $data = "empty";
            }
            $no++;
        }
        if ($simpan) {
            redirect('Penyedia/tambah_tahapan/berhasil');
        } else {
            redirect('Penyedia/tambah_tahapan/gagal');
        }
    }

    public function hapus_tahapan($id)
    {
        $hapus1 = $this->Model_penyedia->delete_tahapan2($id);
        echo "<script type='text/javascript'>
		 alert('Data Berhasil Dihapus');
		 window.location='../pengumuman';
		 </script>";
    }

    //Paket
    public function kelola_negosiasi()
    {
        $id = $this->session->id;
        $data = array(
            'data' => $this->Model_penyedia->get_negosiasi($id),
        );
        $this->load->view('dashboard/penyedia/negosiasi', $data);
    }

    public function detail_nego($id)
    {
        $data = array(
            'nego'               => $this->Model_penyedia->get_negosiasi_id($id),
            'produk'             => $this->Model_penyedia->get_paket_id($id),
            'subtotal'           => $this->Model_penyedia->get_subtotal_id($id),
            'nego_harga'         => $this->Model_penyedia->get_negosiasi_harga($id),
            'nego_spesifikasi'   => $this->Model_penyedia->get_negosiasi_spesifikasi($id),
            'nego_tanggal'       => $this->Model_penyedia->get_negosiasi_tanggal($id),
			'file_status'		 => 2
        );
        $this->load->view('dashboard/penyedia/detail_negosiasi', $data);
    }

//     // public function negosiasi_paket($id)
//     // {
//     //     $data = array(
//     //         'nego'     => $this->Model_penyedia->get_negosiasi_id($id),
//     //         'produk'   => $this->Model_penyedia->get_paket_id($id),
//     //         'nego_harga'    => $this->Model_penyedia->get_negosiasi_harga($id),
//     //         'nego_spesifikasi'    => $this->Model_penyedia->get_negosiasi_spesifikasi($id),
//     //     );
//     //     //   dd($data);
//     //     $this->load->view('dashboard/penyedia/negosiasi_paket', $data);
//     // }

    public function detail_kirim($id)
    {
        $data = array(
            'nego'     => $this->Model_penyedia->get_negosiasi_id($id),
            'produk'   => $this->Model_penyedia->get_paket_id($id),
            'subtotal'   => $this->Model_penyedia->get_subtotal_id($id),
            'nego_harga'    => $this->Model_penyedia->get_negosiasi_harga($id),
            'nego_spesifikasi'    => $this->Model_penyedia->get_negosiasi_spesifikasi($id),
			'nego_tanggal'    => $this->Model_penyedia->get_negosiasi_tanggal($id),
        );
        $this->load->view('dashboard/penyedia/detail_kirim', $data);
    }

//     // public function inputAjukan()
//     // {
//     //     $id_ns = $this->Model_penyedia->get_id_ns();
//     //     $id_nh = $this->Model_penyedia->get_id_nh();
//     //     $data = array(
//     //         'id_nh'              => $id_nh->id_nh + 1,
//     //         'nominal'            => $this->input->post('nominal'),
//     //         'ongkir'             => $this->input->post('ongkir'),
//     //         'tanggal_pengiriman' => $this->input->post('tgl'),
//     //         'id_paket'           => $this->input->post('idpaket')
//     //     );
//     //     $input1 = $this->Model_penyedia->create_nh($data);
//     //     $data2 = array(
//     //         'id_ns'           => $id_ns->id_ns + 1,
//     //         'spesifikasi'     => $this->input->post('syarat'),
//     //         'nilai'           => $this->input->post('nilai'),
//     //         'id_paket'        => $this->input->post('idpaket')
//     //     );
//     //     $input2 = $this->Model_penyedia->create_ns($data2);
//     //     $id_paket = $this->input->post('idpaket');
//     //     $data3 = array(
//     //         'status' => 3
//     //     );
//     //     $update = $this->Model_penyedia->update_paket($data3, $id_paket);
//     //     $data4 = array(
//     //         'catatan_penyedia'   => $this->input->post('catatan'),
//     //     );
//     //     $update2 = $this->Model_penyedia->update_nh($data4, $id_nh->id_nh + 1);
//     //     $data5 = array(
//     //         'catatan_penyedia'   => $this->input->post('catatan2'),
//     //     );
//     //     $update3 = $this->Model_penyedia->update_nh($data5, $id_ns->id_ns + 1);
//     //     echo "<script type='text/javascript'>
//     //   alert('Negosiasi Berhasil Dibuat');
//     //   window.location='kelola_negosiasi';
//     //   </script>";
//     // }

    public function persetujuan_paket($id)
    {
        $data = array(
            'status' => 4,
        );
        $update = $this->Model_penyedia->update_paket($data, $id);
        echo "<script type='text/javascript'>
      alert('Paket Berhasil Disetujui, Akan dilakukan review kembali oleh PP');
      window.location='../detail_nego/$id';
      </script>";
    }

    public function persetujuan_kirim($id)
    {
        $data = array(
            'status' => 6,
        );
        $update = $this->Model_penyedia->update_paket($data, $id);
        echo "<script type='text/javascript'>
      alert('Paket Berhasil Disetujui');
      window.location='../kelola_selesai';
      </script>";
    }

    public function riwayat_negosiasi_harga($id)
    {
        $data = array(
            'nego'     => $this->Model_penyedia->get_negosiasi_id($id),
            'riwayat'   => $this->Model_penyedia->get_riwayat_nego_harga($id),
            'id'     => $id
        );
        $this->load->view('dashboard/penyedia/riwayat_nh', $data);
    }

    public function riwayat_negosiasi_spesifikasi($id)
    {
        $data = array(
            'nego'     => $this->Model_penyedia->get_negosiasi_id($id),
            'riwayat'   => $this->Model_penyedia->get_riwayat_nego_spesifikasi($id),
            'id'     => $id
        );
        $this->load->view('dashboard/penyedia/riwayat_ns', $data);
    }

    public function kelola_kirim()
    {
        $id = $this->session->id;
        $data = array(
            'data'   => $this->Model_penyedia->get_negosiasi2($id),
        );
        // dd($data);
        $this->load->view('dashboard/penyedia/pengiriman', $data);
    }

    public function kelola_selesai()
    {
        $id = $this->session->id;
        $data = array(
            'data'   => $this->Model_penyedia->get_negosiasi3($id),
        );
        $this->load->view('dashboard/penyedia/paket_selesai', $data);
    }

    public function print_invoice($id_paket)
    {
        $id_penyedia = $this->session->id;
        $paket       = $this->Model_penyedia->get_invoice($id_paket, $id_penyedia);

        if (empty($paket)) {
            redirect('Penyedia');
        }

        $data = array(
            'paket'   => $paket,
            'data_kontrak' => $this->Model_penyedia->get_detail_kontrak($id_paket, $id_penyedia),
            'tanggal_invoice' => $this->Model_penyedia->get_tanggal_paket($id_paket, 1),
            'produk' => $this->Model_penyedia->list_produk($id_paket),
            'negosiasi' => $this->Model_penyedia->get_check_negosiasi($id_paket),
        );

        // dd($data);
        $this->load->view('dashboard/laporan_invoice', $data);
    }

    public function print_kontrak($id_paket)
    {
        $id_penyedia = $this->session->id;
        $kontrak     = $this->Model_penyedia->get_detail_kontrak($id_paket, $id_penyedia);

		// dd($kontrak, TRUE);
        if (empty($kontrak)) {
            redirect('Penyedia');
        }

        $data = array(
            'data_kontrak' => $kontrak,
            'keranjang'    => $this->Model_penyedia->get_keranjang($id_paket),
            'tanggal_kontrak' => $this->Model_penyedia->get_tanggal_paket($id_paket, 5),
            // 'negosiasi' => $this->Model_penyedia->get_check_negosiasi($id_paket),
            'negosiasi' => $this->Model_penyedia->get_riwayat_nego_harga($id_paket),
        );
        // dd($data);
        $this->load->view('dashboard/laporan_kontrak', $data);
    }

    public function negosiasi_harga($id)
    {
        $nego = $this->Model_penyedia->get_negosiasi_harga($id);
        if (!$nego) {
            $data = array(
                'nego'     => $this->Model_penyedia->get_negosiasi_id($id),
                'produk'   => $this->Model_penyedia->get_paket_id($id),
                'subtotal' => $this->Model_penyedia->get_subtotal_id($id),
                'check'    => 'belum ada'
            );
            $this->load->view('dashboard/penyedia/tambah_negoharga', $data);
        } else {
            $data = array(
                'nego'      => $this->Model_penyedia->get_negosiasi_id($id),
                'produk'    => $this->Model_penyedia->get_paket_nego_id($id),
                'subtotal'  => $this->Model_penyedia->get_subtotal_id($id),
                'nego_harga' => $this->Model_penyedia->get_negosiasi_harga($id),
                'check'     => 'ada'
            );
            $this->load->view('dashboard/penyedia/tambah_negoharga', $data);
        }
    }

    public function negosiasi_teknis($id)
    {
        $nego = $this->Model_penyedia->get_negosiasi_spesifikasi($id);
        if (!$nego) {
            $data = array(
                'nego'     => $this->Model_penyedia->get_negosiasi_id($id),
                'produk'   => $this->Model_penyedia->get_paket_id($id),
                'subtotal' => $this->Model_penyedia->get_subtotal_id($id),
                'check'    => 'belum ada'
            );
            $this->load->view('dashboard/penyedia/tambah_negospesifikasi', $data);
        } else {
            $data = array(
                'nego'      => $this->Model_penyedia->get_negosiasi_id($id),
                'produk'    => $this->Model_penyedia->get_paket_id($id),
                'subtotal'  => $this->Model_penyedia->get_subtotal_id($id),
                'nego_spesifikasi'    => $this->Model_penyedia->get_negosiasi_spesifikasi($id),
                'check'     => 'ada'
            );
            $this->load->view('dashboard/penyedia/tambah_negospesifikasi', $data);
        }
    }

    public function negosiasi_tanggal($id)
    {
        $nego = $this->Model_penyedia->get_negosiasi_tanggal($id);
        if (!$nego) {
            $data = array(
                'nego'     => $this->Model_penyedia->get_negosiasi_id($id),
                'produk'   => $this->Model_penyedia->get_paket_id($id),
                'subtotal' => $this->Model_penyedia->get_subtotal_id($id),
                'check'    => 'belum ada'
            );
            $this->load->view('dashboard/penyedia/tambah_negotanggal', $data);
        } else {
            $data = array(
                'nego'      => $this->Model_penyedia->get_negosiasi_id($id),
                'produk'    => $this->Model_penyedia->get_paket_id($id),
                'subtotal'  => $this->Model_penyedia->get_subtotal_id($id),
                'nego_tanggal'    => $this->Model_penyedia->get_negosiasi_tanggal($id),
                'check'     => 'ada'
            );
            $this->load->view('dashboard/penyedia/tambah_negotanggal', $data);
        }
    }

	public function input_nh()
	{
	$id = $this->input->post('id_paket');
	$check = $this->input->post('check');
	$checkjumlah = $this->Model_penyedia->get_jumlah_produk2($id);
	$jumlah = $checkjumlah->jumlah;
	$totalnominal = 0;
	$no = 1;
	if($check == "ada"){
		while ($no <= $jumlah) {
			$id_keranjang = $this->input->post('id'.$no);
			$data = array(
				'catatan_penyedia' => $this->input->post('catatanpenyedia'.$no),
				'nominal' => $this->input->post('nominal'.$no),
				'catatan_pembeli' => "-"
			);
			$nominal = $this->input->post('nominal'.$no);
			$kuantitas = $this->input->post('kuantitas'.$no); 
			$totalnominal = $totalnominal + ($nominal*$kuantitas);
			$update_paket = $this->Model_penyedia->update_nh($data,$id_keranjang);
			$no++;
		}
		$ppn = $totalnominal * 0.11;
		$totalpembayaran = $totalnominal + $ppn;
		$datanego = array(
			'id_paket'		=> $id,
			'aksi' 			=> "Pengajuan Negosiasi Dari Penyedia",
			'tanggal'		=> date('Y-m-d H:i:s'),
			'nominal' => $totalpembayaran,
			'ongkir'  => $this->input->post('ongkir'),
			'catatan_penyedia' => $this->input->post('keterangan'),
			'catatan_pembeli' => "-"
		);
	}else{
		while ($no <= $jumlah) {
				$data = array(
					'catatan_penyedia' => $this->input->post('catatanpenyedia'.$no),
					'nominal' => $this->input->post('nominal'.$no),
					'id_keranjang' => $this->input->post('id'.$no),
					'catatan_pembeli' => "-"
				);
				$nominal = $this->input->post('nominal'.$no);
				$kuantitas = $this->input->post('kuantitas'.$no); 
				$totalnominal = $totalnominal + ($nominal*$kuantitas);
				$input = $this->Model_penyedia->create_nh($data,$id);
				$no++;
		}
		$ppn = $totalnominal * 0.11;
		$totalpembayaran = $totalnominal + $ppn;
		$datanego = array(
			'id_paket'		=> $id,
			'aksi' 			=> "Ajukan Negosiasi",
			'tanggal'		=> date('Y-m-d H:i:s'),
			'nominal' => $totalpembayaran,
			'ongkir'  => $this->input->post('ongkir'),
			'catatan_penyedia' => $this->input->post('keterangan'),
			'catatan_pembeli' => "-"
		);
	}
	$data2 = array(
		'status' => 3
	);
	$negosiasi = $this->Model_penyedia->create_riwayat_nh($datanego);
	$update = $this->Model_penyedia->update_paket($data2,$id);
	echo "<script type='text/javascript'>
      alert('Negosiasi Disetujui');
      window.location='detail_nego/$id';
      </script>";
	}

	public function input_ns()
	{
	   $id = $this->input->post('idpaket');
	   $check = $this->input->post('check');
	   if($check == "ada"){
		  $data = array(
			  'catatan_penyedia' => $this->input->post('spesifikasi'),
			  'catatan_pembeli' => '-',
		  );
		  $update_paket = $this->Model_penyedia->update_ns($data,$id);
	   }else{
		  $data = array(
			 'catatan_penyedia' => $this->input->post('spesifikasi'),
			 'catatan_pembeli' => '-',
			 'id_paket'  => $id
		  );
		  $input = $this->Model_penyedia->create_ns($data);
	   }
	   $data2 = array(
		  'status' => 3
	   );
	   $update = $this->Model_penyedia->update_paket($data2,$id);
	   echo "<script type='text/javascript'>
      alert('Negosiasi Disetujui');
      window.location='detail_nego/$id';
      </script>";
	}

    public function input_nt()
    {
        $id = $this->input->post('idpaket');
		$paket = $this->Model_penyedia->cekPaket($id);
        $check = $this->input->post('check');
        if ($check == "ada") {
            $data = array(
                'tanggal_mulai' => $this->input->post('mulai'),
                'tanggal_akhir'  => $this->input->post('akhir'),
                'catatan_penyedia' => $this->input->post('catatan'),
            );
            $update_paket = $this->Model_penyedia->update_nt($data, $id);
        } else {
            $data = array(
                'tanggal_mulai' => $this->input->post('mulai'),
                'tanggal_akhir'  => $this->input->post('akhir'),
                'catatan_penyedia' => $this->input->post('catatan'),
                'id_paket'  => $id
            );
            $input = $this->Model_penyedia->create_nt($data, $id);
        }
        $data2 = array(
            'status' => 3
        );
        $data3 = array(
            'tanggal_mulai' => $this->input->post('mulai'),
            'tanggal_akhir'  => $this->input->post('akhir')
        );
        $update2 = $this->Model_penyedia->update_kak($data3, $paket->id_paket);
        $update = $this->Model_penyedia->update_paket($data2, $id);
        echo "<script type='text/javascript'>
      alert('Negosiasi Disetujui');
      window.location='detail_nego/$id';
      </script>";
    }

//     // //tahap pengerjaan
//     // function input_produk2()
//     // {

//     //     $config['upload_path'] = "./uploads/file_excel/";
//     //     $config['allowed_types'] = "xlsx|csv";
//     //     $config['encrypt_name'] = TRUE;
//     //     $this->load->library('upload', $config);
//     //     if ($this->upload->do_upload('file')) {
//     //         $foto = $this->upload->data();
//     //         $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
//     //         $spreadsheet = $reader->load('file');
//     //         $d = $spreadsheet->getSheet(0)->toArray();
//     //         unset($d[0]);
//     //         $datas = array();
//     //         foreach ($d as $t) {

//     //             $data["title"] = $t[0];
//     //             $data["price"] = $t[1];
//     //             $data["description"] = $t[2];
//     //             array_push($datas, $data);
//     //         }
//     //     } else {
//     //         $datas = NULL;
//     //     }
//     //     dd($datas);
//     //     // $result = $this->Mdl_product->add_data($datas);
//     //     // if($result){
//     //     //     echo "Data berhasil diimport.";
//     //     // }else{
//     //     //     echo "Data gagal diimport.";
//     //     // }
//     // }

//     // //Berita

//     // public function berita()
//     // {
//     //     $id = $this->session->id;
//     //     $data = array(
//     //         'berita' => $this->Model_penyedia->get_berita($id)
//     //     );
//     //     $this->load->view('dashboard/penyedia/berita', $data);
//     // }

//     // public function tambah_berita($hasil)
//     // {
//     //     $data = array(
//     //         'kategori'  => $this->Model_penyedia->get_kategori_berita(),
//     //         'hasil'     => $hasil
//     //     );
//     //     $this->load->view('dashboard/penyedia/tambah_berita', $data);
//     // }

//     // public function inputBerita()
//     // {
//     //     $config['upload_path'] = "./uploads/poster_berita/";
//     //     $config['allowed_types'] = "png|jpeg|jpg";
//     //     $config['max_size'] = 2000;
//     //     $config['encrypt_name'] = TRUE;

//     //     // $this->form_validation->set_rules('namapromo','Nama Promo','required',
//     //     //  array(
//     //     //     'required'  => '%s tidak boleh kosong'
//     //     //  ));
//     //     // $this->form_validation->set_rules('kodepromo','Kode Promo','required',
//     //     //  array(
//     //     //     'required'  => '%s tidak boleh kosong'
//     //     //  ));
//     //     // $this->form_validation->set_rules('besarpromo','Besar Promo','required',
//     //     //  array(
//     //     //     'required'  => '%s tidak boleh kosong'
//     //     //  ));
//     //     //  if($this->form_validation->run() == FALSE){
//     //     //     $this->tambahPromo();
//     //     //  }else{
//     //     date_default_timezone_set('Asia/Jakarta');
//     //     $this->load->library('upload', $config);
//     //     if ($this->upload->do_upload('gambarberita')) {
//     //         $file = $this->upload->data();
//     //         $data       = array(
//     //             'judul'            => $this->input->post('judul'),
//     //             'body'             => $this->input->post('deskripsi'),
//     //             'penulis'          => $this->input->post('penulis'),
//     //             'tanggal'          => date('Y-m-d H:i:s'),
//     //             'gambar'           => $file['file_name'],
//     //             'id_kb'            => $this->input->post('kategori'),
//     //             'id_user'          => $this->session->id
//     //         );
//     //         $simpan = $this->Model_penyedia->create_berita($data);
//     //         if ($simpan) {
//     //             redirect('Penyedia/tambah_berita/berhasil');
//     //         } else {
//     //             redirect('Penyedia/tambah_berita/gagal');
//     //         }
//     //     } else {
//     //         $data       = array(
//     //             'judul'            => $this->input->post('judul'),
//     //             'body'             => $this->input->post('deskripsi'),
//     //             'penulis'          => $this->input->post('penulis'),
//     //             'tanggal'          => date('Y-m-d H:i:s'),
//     //             'id_kb'            => $this->input->post('kategori'),
//     //             'id_user'          => $this->session->id
//     //         );
//     //         $simpan = $this->Model_penyedia->create_berita($data);
//     //         if ($simpan) {
//     //             redirect('Penyedia/tambah_berita/berhasil');
//     //         } else {
//     //             redirect('Penyedia/tambah_berita/gagal');
//     //         }
//     //     }
//     //     // }
//     // }

//     // public function hapus_berita($id)
//     // {
//     //     $hapus1 = $this->Model_penyedia->delete_tag($id);
//     //     $hapus2 = $this->Model_penyedia->delete_berita($id);
//     //     echo "<script type='text/javascript'>
//     //      alert('Data Berhasil Dihapus');
//     //      window.location='../berita';
//     //      </script>";
//     // }

//     // public function tag_berita($id)
//     // {
//     //     $data = array(
//     //         'tags'  => $this->Model_penyedia->get_tag($id)
//     //     );
//     //     $this->load->view('dashboard/penyedia/tags', $data);
//     // }

//     // public function tambah_tags($id)
//     // {
//     //     $iduser = $this->session->id;
//     //     $data = array(
//     //         'berita' => $this->Model_penyedia->get_berita($iduser),
//     //         'hasil' => $id
//     //     );
//     //     $this->load->view('dashboard/penyedia/tambah_tag', $data);
//     // }

//     // public function inputTag()
//     // {
//     //     $kategori = $this->input->post('kategori');
//     //     $no = 1;
//     //     while ($no <= 6) {
//     //         if ($this->input->post('tag' . $no)) {
//     //             $data = array(
//     //                 'tag' => $this->input->post('tag' . $no),
//     //                 'id_berita' => $kategori
//     //             );
//     //             $simpan = $this->Model_penyedia->create_tag($data);
//     //         } else {
//     //             $data = "empty";
//     //         }
//     //         $no++;
//     //     }
//     //     if ($simpan) {
//     //         redirect('Penyedia/tambah_tags/berhasil');
//     //     } else {
//     //         redirect('Penyedia/tambah_tags/gagal');
//     //     }
//     // }

//     // //Kelola Unduh
//     // public function unduh()
//     // {
//     //     $id = $this->session->id;
//     //     $data = array(
//     //         'unduhan' => $this->Model_penyedia->get_unduh($id)
//     //     );
//     //     $this->load->view('dashboard/penyedia/unduh', $data);
//     // }

//     // public function tambah_unduh($hasil)
//     // {
//     //     $data = array(
//     //         'kategori'  => $this->Model_penyedia->get_kategori_unduh(),
//     //         'hasil'     => $hasil
//     //     );
//     //     $this->load->view('dashboard/penyedia/tambah_unduh', $data);
//     // }

//     // public function inputUnduh()
//     // {
//     //     $config['upload_path'] = "./uploads/file_unduhan/";
//     //     $config['allowed_types'] = "pdf|docs|jpg";
//     //     $config['max_size'] = 2000;
//     //     $config['encrypt_name'] = TRUE;

//     //     // $this->form_validation->set_rules('namapromo','Nama Promo','required',
//     //     //  array(
//     //     //     'required'  => '%s tidak boleh kosong'
//     //     //  ));
//     //     // $this->form_validation->set_rules('kodepromo','Kode Promo','required',
//     //     //  array(
//     //     //     'required'  => '%s tidak boleh kosong'
//     //     //  ));
//     //     // $this->form_validation->set_rules('besarpromo','Besar Promo','required',
//     //     //  array(
//     //     //     'required'  => '%s tidak boleh kosong'
//     //     //  ));
//     //     //  if($this->form_validation->run() == FALSE){
//     //     //     $this->tambahPromo();
//     //     //  }else{
//     //     date_default_timezone_set('Asia/Jakarta');
//     //     $this->load->library('upload', $config);
//     //     if ($this->upload->do_upload('laporan')) {
//     //         $file = $this->upload->data();
//     //         $data       = array(
//     //             'nama_unduhan'       => $this->input->post('judul'),
//     //             'tanggal'            => date('Y-m-d H:i:s'),
//     //             'kapasitas'          => $this->input->post('kapasitas'),
//     //             'id_ku'              => $this->input->post('kategori'),
//     //             'file'               => $file['file_name'],
//     //             'penulis'            => $this->input->post('penulis'),
//     //             'id_user'          => $this->session->id
//     //         );
//     //         $simpan = $this->Model_penyedia->create_unduhan($data);
//     //         if ($simpan) {
//     //             redirect('Penyedia/tambah_unduh/berhasil');
//     //         } else {
//     //             redirect('Penyedia/tambah_unduh/gagal');
//     //         }
//     //     } else {
//     //         $data       = array(
//     //             'nama_unduhan'       => $this->input->post('judul'),
//     //             'tanggal'            => date('Y-m-d H:i:s'),
//     //             'kapasitas'          => $this->input->post('kapasitas'),
//     //             'id_ku'              => $this->input->post('kategori'),
//     //             'penulis'            => $this->input->post('penulis'),
//     //             'id_user'          => $this->session->id
//     //         );
//     //         $simpan = $this->Model_penyedia->create_unduhan($data);
//     //         if ($simpan) {
//     //             redirect('Penyedia/tambah_unduh/berhasil');
//     //         } else {
//     //             redirect('Penyedia/tambah_unduh/gagal');
//     //         }
//     //     }
//     //     // }
//     // }

//     // public function hapus_unduh($id)
//     // {
//     //     $hapus3 = $this->Model_penyedia->delete_unduhan($id);
//     //     echo "<script type='text/javascript'>
//     //      alert('Data Berhasil Dihapus');
//     //      window.location='../unduh';
//     //      </script>";
//     // }

}
