<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PP extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Model_pp');

        // Cek authorization
        if ($this->session->level !== 'pp') {
        	session_destroy();
        	return redirect('login');
        };
    }

    public function index()
    {
      $id = $this->session->id;
      $data = array(
         'paket'  => $this->Model_pp->get_jumlah_baru($id),
         'negosiasi' => $this->Model_pp->get_jumlah_negosiasi($id),
         'review' => $this->Model_pp->get_jumlah_review($id),
         'kirim'=> $this->Model_pp->get_jumlah_kirim($id),
         'selesai'=> $this->Model_pp->get_jumlah_selesai($id),
         'tolak'  => $this->Model_pp->get_jumlah_tolak($id),
         'data'   => $this->Model_pp->get_update_nego($id)
	  );  
      $this->load->view('dashboard/pp/index',$data);
    }

   //Kelola Paket
   public function kelola_paket()
   {
      $id = $this->session->id;
      $data = array(
         'data'  => $this->Model_pp->get_paket($id)
      );
    //   dd($data);
      $this->load->view('dashboard/pp/kelola_paket',$data);
   }

   public function edit_kak($id)
   {
	  $kak = $this->Model_pp->get_kak($id);
	  $pp = $this->Model_pp->get_pp($kak->id_pp);
      $data = array(
         'kak'  => $kak,
		 'paket' => $this->Model_pp->get_paket_kak($kak->id_kak,$id),
		 'akun' => $this->Model_pp->get_pk($pp->kode_unit,$kak->id_pk)
      );
	//   dd($data);
      $this->load->view('dashboard/pp/edit_kak',$data);
   }

   public function inputKAK()
   {
      $idpaket = $this->input->post('idpaket');
	  $idkak = $this->input->post('idkak');
      $data = array(
         'no_pr'          	=> $this->input->post('no_pr'),
         'jenis_pembayaran' => $this->input->post('jenis')
       );
	   $datakak = array(
		'nama_paket'       => $this->input->post('namapaket'),
		'uraian_pekerjaan' => $this->input->post('uraian_pekerjaan'),
		'ruang_lingkup'    => $this->input->post('ruang_lingkup'),
		'tanggal_mulai'  	=> $this->input->post('tanggalmulai'),
		'tanggal_akhir'  	=> $this->input->post('tanggalakhir'),
		'id_pk'				=> $this->input->post('pk')
	   );
      $input = $this->Model_pp->update_paket_kak($data,$idpaket);
	  $input2 = $this->Model_pp->update_kak($datakak,$idkak);
      echo"<script type='text/javascript'>
         alert('Data Berhasil Diedit');
         window.location='kelola_paket';
         </script>";
   }

   public function detail_paket($id)
   {
     $data = array(
        'nego'     => $this->Model_pp->get_negosiasi_id($id),
        'produk'   => $this->Model_pp->get_paket_id($id),
        'subtotal'   => $this->Model_pp->get_subtotal_id($id),
        'nego_harga'    => $this->Model_pp->get_subtotal_nego_id($id),
        'nego_spesifikasi'    => $this->Model_pp->get_negosiasi_spesifikasi($id),
        'nego_tanggal'     => $this->Model_pp->get_negosiasi_tanggal($id),
        'file_status' => 1
     );
    //  dd($data);
     $this->load->view('dashboard/pp/detail_paket',$data);
   }

   public function kelola_negosiasi()
   {
      $id = $this->session->id;
      $data = array(
         'data'  => $this->Model_pp->get_paket_negosiasi($id),
         'review'  => $this->Model_pp->get_paket_negosiasi2($id)
      );
      $this->load->view('dashboard/pp/kelola_negosiasi',$data);
   }

    public function kelola_selesai()
    {
      $id = $this->session->id;
      $data = array(
         'proses'   => $this->Model_pp->get_paket_diproses($id),
         'kirim'   => $this->Model_pp->get_paket_dikirim($id),
         'selesai'   => $this->Model_pp->get_paket_selesai($id),
		 'id_pp'	=> $id
      );
      $this->load->view('dashboard/pp/kelola_verifikasi',$data);
    }

	public function kelola_penolakan()
    {
      $id = $this->session->id;
      $data = array(
         'data'   => $this->Model_pp->get_paket_ditolak($id),
		 'id_pp'	=> $id
      );
      $this->load->view('dashboard/pp/kelola_penolakan',$data);
    }

	public function negosiasi_harga($id)
	{
	   $nego = $this->Model_pp->get_subtotal_nego_id($id);
	   if(!$nego){
		  $data = array(
			 'nego'     => $this->Model_pp->get_negosiasi_id($id),
			 'produk'   => $this->Model_pp->get_paket_id($id),
			 'subtotal' => $this->Model_pp->get_subtotal_id($id),
			 'check'    => 'belum ada'
		  );
		   $this->load->view('dashboard/pp/tambah_negoharga',$data);
	   }else{
		  $data = array(
			 'nego'      => $this->Model_pp->get_negosiasi_id($id),
			 'produk'    => $this->Model_pp->get_paket_nego_id($id),
			 'subtotal'  => $this->Model_pp->get_subtotal_nego_id($id),
			 'check'     => 'ada'
		  );
		   $this->load->view('dashboard/pp/tambah_negoharga',$data);
	   }
	}

	public function input_nh()
   {
      $id = $this->input->post('id_paket');
      $check = $this->input->post('check');
	  $checkjumlah = $this->Model_pp->get_jumlah($id);
	  $jumlah = $checkjumlah->jumlah;
	  $totalnominal = 0;
	  $no = 1;
      if($check == "ada"){
		while ($no <= $jumlah) {
			$id_keranjang = $this->input->post('id'.$no);
			$data = array(
				'catatan_pembeli' => $this->input->post('catatanpembeli'.$no),
				'nominal' => $this->input->post('nominal'.$no),
				'catatan_penyedia' => "-"
			);
			$nominal = $this->input->post('nominal'.$no);
			$kuantitas = $this->input->post('kuantitas'.$no); 
			$totalnominal = $totalnominal + ($nominal*$kuantitas);
			$update_paket = $this->Model_pp->update_nh($data,$id_keranjang);
			$no++;
		}
		$ppn = $totalnominal * 0.11;
		$totalpembayaran = $totalnominal + $ppn;
		$datanego = array(
			'id_paket'		=> $id,
			'aksi' 			=> "Negosiasi Kembali",
			'tanggal'		=> date('Y-m-d H:i:s'),
			'nominal' => $totalpembayaran,
			'ongkir'  => $this->input->post('ongkir'),
			'catatan_pembeli' => $this->input->post('keterangan'),
			'catatan_penyedia' => "-"
		);
      }else{
		while ($no <= $jumlah) {
                $data = array(
                    'catatan_pembeli' => $this->input->post('catatanpembeli'.$no),
                    'nominal' => $this->input->post('nominal'.$no),
                    'id_keranjang' => $this->input->post('id'.$no),
					'catatan_penyedia' => "-"
                );
				$nominal = $this->input->post('nominal'.$no);
				$kuantitas = $this->input->post('kuantitas'.$no); 
				$totalnominal = $totalnominal + ($nominal*$kuantitas);
            	$input = $this->Model_pp->create_nh($data,$id);
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
            'catatan_pembeli' => $this->input->post('keterangan'),
			'catatan_penyedia' => "-"
         );
      }
      $data2 = array(
         'status' => 2
      );
	  $negosiasi = $this->Model_pp->create_riwayat_nh($datanego);
      $update = $this->Model_pp->update_paket($data2,$id);
      echo"<script type='text/javascript'>
      alert('Negosiasi Disetujui');
      window.location='detail_paket/$id';
      </script>";
   }

   public function input_ns()
      {
         $id = $this->input->post('idpaket');
         $check = $this->input->post('check');
         if($check == "ada"){
            $data = array(
				'catatan_pembeli' => $this->input->post('spesifikasi'),
				'catatan_penyedia' => '-',
            );
            $update_paket = $this->Model_pp->update_ns($data,$id);
         }else{
            $data = array(
               'catatan_pembeli' => $this->input->post('spesifikasi'),
               'catatan_penyedia' => '-',
               'id_paket'  => $id
            );
            $input = $this->Model_pp->create_ns($data);
         }
         $data2 = array(
            'status' => 2
         );
         $update = $this->Model_pp->update_paket($data2,$id);
         echo"<script type='text/javascript'>
         alert('Negosiasi Disetujui');
         window.location='detail_paket/$id';
         </script>";
      }

	  public function switch_product($id_produk,$id_keranjang)
	  {
		$keranjang = $this->Model_pp->cekKeranjang($id_keranjang);
		$produk = $this->Model_pp->cekProduk($id_produk);
		$jumlahkeranjang = $this->Model_pp->get_jumlah($id_keranjang);
		if($keranjang->id_penyedia == $produk->id_penyedia){
			$data = array(
				'id_produk' => $id_produk
			);
			$update = $this->Model_pp->update_keranjang($data,$id_keranjang);
		}else if($jumlahkeranjang->jumlah == 1){
			$data = array(
				'id_produk' => $id_produk
			);
			$update = $this->Model_pp->update_keranjang($data,$id_keranjang);
			$data2 = array(
				'id_penyedia' => $produk->id_penyedia
			);
			$update2 = $this->Model_pp->update_paket($data2,$keranjang->id_paket);
		}else{
			$addID = $this->Model_pp->get_id_paket();
			$paket = $this->Model_pp->cekPaket($keranjang->id_paket);
			$id = $addID->id_paket+1;
			$data2 = array(
				'id_paket' 		=> $id,
				'id_pp'			=> $this->session->id,
				'id_penyedia' 	=> $produk->id_penyedia,
				'no_pr'			=> $paket->no_pr,
				'status'		=> $paket->status,
				'jenis_pembayaran'	=> $paket->jenis_pembayaran,
				'dokumen'		=> $paket->dokumen,
				'receipt' 		=> $paket->receipt,
				'id_kak'		=> $paket->id_kak
			);
			$insert = $this->Model_pp->create_paket($data2);
			$data = array(
				'id_produk' => $id_produk,
				'id_pumk' => $keranjang->id_pumk,
				'id_paket' => $id,
				'kuantitas' => $keranjang->kuantitas
			);
			$insert2 = $this->Model_pp->create_keranjang($data);
			$hapus = $this->Model_pp->delete_keranjang($id_keranjang);
			$hapus2 = $this->Model_pp->delete_paket($id_keranjang);
		}
		echo"<script type='text/javascript'>
		alert('Negosiasi Disetujui');
		window.location='../../detail_paket/$keranjang->id_paket';
		</script>";
	  }

   public function persetujuan_paket($id)
   {
      $data = array(
         'status' => 5,
      );
      $update = $this->Model_pp->update_paket($data,$id);
      echo"<script type='text/javascript'>
      alert('Paket Berhasil Disetujui');
      window.location='../kelola_negosiasi';
      </script>";
   }

//    public function persetujuan_paket_fix($id)
//    {
//       $data = array(
//          'status' => 7,
//       );
//       $update = $this->Model_pp->update_paket($data,$id);
//       echo"<script type='text/javascript'>
//       alert('Paket Berhasil Disetujui');
//       window.location='../kelola_paket';
//       </script>";
//    }

   public function penolakan_paket($id)
   {
      $data = array(
         'status' => 8
      );
      // dd($data);
      $update = $this->Model_pp->update_paket($data,$id);
      echo"<script type='text/javascript'>
      alert('Paket Berhasil Ditolak');
      window.location='../kelola_negosiasi';
      </script>";
   }

 

   public function detail_paket_negosiasi($id)
   {
      $data = array(
         'nego'     => $this->Model_pp->get_negosiasi_id($id),
         'produk'   => $this->Model_pp->get_paket_id($id),
         'subtotal'   => $this->Model_pp->get_subtotal_id($id),
         'nego_harga'    => $this->Model_pp->get_subtotal_nego_id($id),
         'nego_spesifikasi'    => $this->Model_pp->get_negosiasi_spesifikasi($id),
         'nego_tanggal'     => $this->Model_pp->get_negosiasi_tanggal($id),
         'file_status' => 3
      );
     $this->load->view('dashboard/pp/detail_paket',$data);
   }

   public function riwayat_paket($id)
    {
      $data = array(
         'nego'     => $this->Model_pp->get_negosiasi_id($id),
         'riwayat'   => $this->Model_pp->get_riwayat_paket($id),
         'id'     => $id
      );
      $this->load->view('dashboard/pp/riwayat_paket',$data);
    }

    public function riwayat_negosiasi_harga($id)
    {
      $data = array(
         'nego'     => $this->Model_pp->get_negosiasi_id($id),
         'riwayat'   => $this->Model_pp->get_riwayat_nego_harga($id),
         'id'     => $id
      );
      $this->load->view('dashboard/pp/riwayat_nh',$data);
    }

    public function riwayat_negosiasi_spesifikasi($id)
    {
      $data = array(
         'nego'     => $this->Model_pp->get_negosiasi_id($id),
         'riwayat'   => $this->Model_pp->get_riwayat_nego_spesifikasi($id),
         'id'     => $id
      );
      $this->load->view('dashboard/pp/riwayat_ns',$data);
    }

    
//     public function print_invoice($id_paket)
//     {
//         $data = array(
//          'paket'   => $this->Model_pp->get_invoice($id_paket),
//          'produk' => $this->Model_pp->get_keranjang($id_paket),
//          'tanggal_invoice' => $this->Model_pp->get_tanggal_paket($id_paket, 1),
//          'data_kontrak' => $this->Model_pp->get_detail_kontrak($id_paket),
//          'negosiasi' => $this->Model_pp->get_check_negosiasi($id_paket),
//         );

//       //   dd($data);
//         $this->load->view('landingpage/laporan_invoice', $data);
//     }

    public function print_kontrak($id_paket)
    {
        // $kontrak     = $this->Model_pp->get_detail_kontrak($id_paket);

        // if (empty($kontrak)) {
        //     redirect('PP');
        // }

        $data = array(
            // 'data_kontrak'    => $kontrak,
            // 'tanggal_kontrak' => $this->Model_pp->get_tanggal_paket($id_paket, 5),
            // 'keranjang'       => $this->Model_pp->get_keranjang($id_paket),
			// 'negosiasi' => $this->Model_pp->get_check_negosiasi($id_paket),
        );

        // dd($data);
        $this->load->view('landingpage/laporan_kontrak', $data);
    }

//    public function print_preorder($id_paket)
//     {
//         $data = array(
//             'keranjang' => $this->Model_pp->get_keranjang($id_paket),
//          'paket'     => $this->Model_pp->get_paket_po_id($id_paket)
//         );

//         // dd($data);
//         $this->load->view('dashboard/pp/laporan_po', $data);
//     }

   public function negosiasi_teknis($id)
   {
      $nego = $this->Model_pp->get_negosiasi_spesifikasi($id);
      if(!$nego){
         $data = array(
            'nego'     => $this->Model_pp->get_negosiasi_id($id),
            'produk'   => $this->Model_pp->get_paket_id($id),
            'subtotal' => $this->Model_pp->get_subtotal_id($id),
            'check'    => 'belum ada'
         );
         $this->load->view('dashboard/pp/tambah_negospesifikasi',$data);
      }else{
         $data = array(
            'nego'      => $this->Model_pp->get_negosiasi_id($id),
            'produk'    => $this->Model_pp->get_paket_id($id),
            'nego_spesifikasi'    => $this->Model_pp->get_negosiasi_spesifikasi($id),
            'check'     => 'ada'
         );
         $this->load->view('dashboard/pp/tambah_negospesifikasi',$data);
      }
   }

   public function negosiasi_tanggal($id)
   {
      $nego = $this->Model_pp->get_negosiasi_tanggal($id);
      if(!$nego){
         $data = array(
            'nego'     => $this->Model_pp->get_negosiasi_id($id),
            'produk'   => $this->Model_pp->get_paket_id($id),
            'subtotal' => $this->Model_pp->get_subtotal_id($id),
            'check'    => 'belum ada'
         );
         $this->load->view('dashboard/pp/tambah_negotanggal',$data);
      }else{
         $data = array(
            'nego'      => $this->Model_pp->get_negosiasi_id($id),
            'produk'    => $this->Model_pp->get_paket_id($id),
            'subtotal'  => $this->Model_pp->get_subtotal_id($id),
            'nego_tanggal'    => $this->Model_pp->get_negosiasi_tanggal($id),
            'check'     => 'ada'
         );
         $this->load->view('dashboard/pp/tambah_negotanggal',$data);
      }
   }

//    public function verifikasi_paket($id)
//    {
//       $data2 = array(
//          'status' => 7
//       );
//       $update = $this->Model_pp->update_paket($data2,$id);
//       echo"<script type='text/javascript'>
//       alert('Paket Selesai');
//       window.location='../kelola_selesai';
//       </script>";
//    }


   public function input_nt()
   {
      $id = $this->input->post('idpaket');
      $check = $this->input->post('check');
      if($check == "ada"){
         $data = array(
            'tanggal_mulai' => $this->input->post('mulai'),
            'tanggal_akhir'  => $this->input->post('akhir'),
            'catatan_pembeli' => $this->input->post('catatan'),
         );
         $update_paket = $this->Model_pp->update_nt($data,$id);
      }else{
         $data = array(
            'tanggal_mulai' => $this->input->post('mulai'),
            'tanggal_akhir'  => $this->input->post('akhir'),
            'catatan_pembeli' => $this->input->post('catatan'),
            'id_paket'  => $id
         );
         $input = $this->Model_pp->create_nt($data,$id);
      }
      $data2 = array(
         'status' => 2
      );
      $data3 = array(
         'tanggal_mulai' => $this->input->post('mulai'),
         'tanggal_akhir'  => $this->input->post('akhir')
      );
    //   $update2 = $this->Model_pp->update_po($data3,$id);
      $update = $this->Model_pp->update_paket($data2,$id);
      echo"<script type='text/javascript'>
      alert('Negosiasi Disetujui');
      window.location='detail_paket/$id';
      </script>";
   }

}
