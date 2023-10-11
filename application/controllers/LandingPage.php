<?php
defined('BASEPATH') or exit('No direct script access allowed');

class LandingPage extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Model_index');
    }

    public function index()
    {
        $data = $this->Model_index->get_summary();

        $this->load->view('landingpage/index', $data);
    }

    public function produk()
    {
        $search = $this->input->get('search');
        $merek = $this->input->get('merek');
        $low = $this->input->get('low');
        $high = $this->input->get('high');
        $offset = $this->input->get('per_page') ?? '0';
        $item_perhalaman = 12;

        $produk = $this->Model_index->find_produk($search, $merek, $low, $high, $item_perhalaman, $offset);

        if (!is_null($this->input->get('search'))) {
            $etalase = array();

            foreach ($produk['data'] as $data) {
                if (!array_key_exists($data->id_etalase, $etalase)) {
                    $etalase[$data->id_etalase]['nama_etalase'] = $data->nama_etalase;
                    $etalase[$data->id_etalase]['jumlah_produk'] = 1;
                    continue;
                }

                $etalase[$data->id_etalase]++;
            }

            $dataProduk['etalase'] = $etalase;
        }

        // Setting pagination
        $this->load->library('pagination');

        $config['base_url'] = base_url() . 'produk';
        $config['total_rows'] = $produk['jumlah'];
        $config['per_page'] = $item_perhalaman;
        $config['page_query_string'] = true;
        $config['reuse_query_string'] = true;
        $config['full_tag_open'] = '<div class="pagination">';
        $config['full_tag_close'] = '</div>';
        $config['first_link'] = '&lt;&lt;';
        $config['last_link'] = '&gt;&gt;';
        $config['cur_tag_open'] = '<a class="active">';
        $config['cur_tag_close'] = '</a>';
        $config['num_links'] = '3';

        $this->pagination->initialize($config);

        $dataProduk['produk'] = $produk['data'];
        // dd($dataProduk);
        $this->load->helper('text');
        $this->load->view('landingpage/hasil_cari', $dataProduk);
    }

    public function pengumuman()
    {
        $offset = $this->input->get('per_page') ?? '0';
        $item_perhalaman = 12;

        // Jika ada GET search maka cari pengumuman
        // Jika tidak ada maka ambil semua pengumuman
        if (!is_null($this->input->get('search'))) {

            $search = $this->input->get('search');
            $start = $this->input->get('start');
            $finish = $this->input->get('finish');

            $pengumuman = $this->Model_index->find_pengumuman($search, $start, $finish, $item_perhalaman, $offset);
            // dd($pengumuman);
        } else {
            $pengumuman = $this->Model_index->get_all_pengumuman($item_perhalaman, $offset);
        }

        // Setting pagination
        $this->load->library('pagination');

        $config['base_url'] = base_url() . 'pengumuman';
        $config['total_rows'] = $pengumuman['jumlah'];
        $config['per_page'] = $item_perhalaman;
        $config['page_query_string'] = true;
        $config['reuse_query_string'] = true;
        $config['full_tag_open'] = '<ul class="pagination">';
        $config['full_tag_close'] = '</ul>';
        $config['first_link'] = '&lt;&lt;';
        $config['last_link'] = '&gt;&gt;';
        $config['cur_tag_open'] = '<li class="page-item active"><a href=# class="page-link">';
        $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li class="page-item">';
        $config['num_tag_close'] = '</li>';
        $config['num_links'] = '3';
        $config['attributes']['class'] = 'page-link';

        $this->pagination->initialize($config);

        $data = array(
            'pengumuman' => $pengumuman['data'],
        );

        // dd($pengumuman);
        $this->load->view('landingpage/pengumuman', $data);
    }

    public function postingan_pengumuman($id)
    {
        $data = array(
            'posting' => $this->Model_index->get_postingan($id),
            'merek' => $this->Model_index->get_merek($id),
            'tahapan' => $this->Model_index->get_tahapan_pengumuman($id),
        );
        $this->load->view('landingpage/post_pengumuman', $data);
    }

    public function berita()
    {
        $offset = $this->input->get('per_page') ?? '0';
        $item_perhalaman = 12;

        $search = $this->input->get('search');
        $id_kategori = $this->input->get('kategori');

        $berita = $this->Model_index->find_berita($search, $id_kategori, $item_perhalaman, $offset);
        // dd($berita);

        // Setting pagination
        $this->load->library('pagination');

        $config['base_url'] = base_url() . 'berita';
        $config['total_rows'] = $berita['jumlah'];
        $config['per_page'] = $item_perhalaman;
        $config['page_query_string'] = true;
        $config['reuse_query_string'] = true;
        $config['full_tag_open'] = '<ul class="pagination">';
        $config['full_tag_close'] = '</ul>';
        $config['first_link'] = '&lt;&lt;';
        $config['last_link'] = '&gt;&gt;';
        $config['cur_tag_open'] = '<li class="page-item active"><a href=# class="page-link">';
        $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li class="page-item">';
        $config['num_tag_close'] = '</li>';
        $config['num_links'] = '3';
        $config['attributes']['class'] = 'page-link';

        $this->pagination->initialize($config);

        $data = array(
            'news' => $this->Model_index->newsupdate(),
            'kategori' => $this->Model_index->get_kategori_berita(),
            'berita' => $berita['data'],
        );

        $this->load->helper('text');
        $this->load->view('landingpage/berita', $data);
    }

    public function postingan_berita($id)
    {
        $data = array(
            'berita' => $this->Model_index->get_berita_id($id),
            'tag' => $this->Model_index->get_tags_id($id),
        );
        $this->load->view('landingpage/post_berita', $data);
    }

    public function produk_tayang()
    {
        $data = array(

            'produk' => $this->Model_index->get_produk_tayang(),
			'total' => $this->Model_index->get_jumlah_produk_tayang()
        );
        $this->load->view('landingpage/produk_tayang', $data);
    }

    public function transaksi()
    {
        $data = array(
            'produk' => $this->Model_index->get_transaksi(),
        );
        $this->load->view('landingpage/transaksi', $data);
    }

    public function unduh()
    {
        $offset = $this->input->get('per_page') ?? '0';
        $item_perhalaman = 12;

        $search = $this->input->get('search');
        $id_kategori = $this->input->get('kategori');

        $unduhan = $this->Model_index->find_unduhan($search, $id_kategori, $item_perhalaman, $offset);
        // dd($unduhan);

        // Setting pagination
        $this->load->library('pagination');

        $config['base_url'] = base_url() . 'unduh';
        $config['total_rows'] = $unduhan['jumlah'];
        $config['per_page'] = $item_perhalaman;
        $config['page_query_string'] = true;
        $config['reuse_query_string'] = true;
        $config['full_tag_open'] = '<ul class="pagination">';
        $config['full_tag_close'] = '</ul>';
        $config['first_link'] = '&lt;&lt;';
        $config['last_link'] = '&gt;&gt;';
        $config['cur_tag_open'] = '<li class="page-item active"><a href=# class="page-link">';
        $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li class="page-item">';
        $config['num_tag_close'] = '</li>';
        $config['num_links'] = '3';
        $config['attributes']['class'] = 'page-link';

        $this->pagination->initialize($config);

        $data = array(
            'unduh' => $unduhan['data'],
            'kategori' => $this->Model_index->get_kategori_unduh(),
        );

        $this->load->view('landingpage/unduh', $data);
    }

    public function tanya_jawab()
    {
        $data = array(
            "faq" => $this->Model_index->get_faq(),
        );
        $this->load->view('landingpage/tanya_jawab', $data);
    }

    public function kontak()
    {
		$data = array(
			'kontak' => $this->Model_index->get_kontak(),
		);

        $this->load->view('landingpage/kontak', $data);
    }

    public function lihat_produk($id)
    {
        $data = array(
            'produk' => $this->Model_index->get_produk_id($id),
            'spesifikasi' => $this->Model_index->get_spesifikasi($id),
        );
        $this->load->view('landingpage/produk', $data);
    }

    public function kak($link)
    {
        $kak = $this->Model_index->get_kak($link);

        if (empty($kak)) {
            show_404();
        }

        $data = array(
            'kak' => $kak,
            'keranjang' => $this->Model_index->get_keranjang_kak($kak->id_kak),
            'subtotal' => $this->Model_index->get_harga($kak->id_kak),
        );
		// dd($data);
        $this->load->view('landingpage/laporan_kak', $data);
    }

    public function bandingkan_produk($id)
    {
        $produk = $this->Model_index->get_produk_id($id);
        $compare = $this->Model_index->compare_product($produk->id_produk, $produk->no_item, $produk->harga);
        $data = array(
            'produk' => $produk,
            'spesifikasi' => $this->Model_index->get_spesifikasi($id),
            'compare' => $compare,
            'spesifikasi2' => $this->Model_index->get_spesifikasi2($compare->id_produk),
        );
        $this->load->view('landingpage/bandingkan', $data);
    }
}
