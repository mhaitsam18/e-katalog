<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Model_index extends CI_Model
{

    /**
     * Dapatkan data ringkasan untuk ditampilkan di beranda landing page
     */
    public function get_summary()
    {
        $this->db->select('id_pengumuman, judul');
        $this->db->order_by('id_pengumuman', 'DESC');
        $this->db->limit(6);
        $pengumuman = $this->db->get('pengumuman')->result();

        $this->db->select('id_produk, nama_produk, harga, foto');
        $this->db->order_by('id_produk', 'DESC');
        $this->db->limit(8);
        $produk = $this->db->get('produk')->result();

        $this->db->select('id_berita, nama_kb, judul, gambar');
        $this->db->join('kategori_berita', 'id_kb');
        $this->db->order_by('id_berita', 'DESC');
        $this->db->limit(4);
        $berita = $this->db->get('berita')->result();

        return [
            'pengumuman' => $pengumuman,
            'produk' => $produk,
            'berita' => $berita,
        ];
    }

    // --------------
    // Produk
    // --------------

    public function get_produk_id($id)
    {
        return $this->db->query("SELECT * FROM produk JOIN etalase USING(id_etalase) JOIN kategori_etalase USING(id_ke) WHERE id_produk = '$id'")->row();
    }

    public function get_spesifikasi($id)
    {
        return $this->db->query("SELECT * FROM meta_produk WHERE id_produk = '$id'")->result();
    }

    public function find_produk($search, $merek, $low, $high, $limit, $offset)
    {
        if (!empty($search)) {
            $this->db->like('nama_produk', $search);
        }

        if (!empty($merek)) {
            $this->db->like('merk', $merek);
        }

        if (!empty($low)) {
            $this->db->where('harga >=', $low);
        }

        if (!empty($high)) {
            $this->db->where('harga <= ', $high);
        }

        $this->db->select('id_produk, nama_produk, harga, foto, nama_etalase, id_etalase');
        $this->db->join('etalase', 'id_etalase');
        $this->db->from('produk');

        return [
            'jumlah' => $this->db->count_all_results(null, false),
            'data' => $this->db->get(null, $limit, $offset)->result(),
        ];
    }

    public function get_jumlah_produk()
    {
        return $this->db->get('produk.id_produk')->num_rows();
    }

    public function compare_product($id, $idd, $harga)
    {
        return $this->db->query("SELECT * FROM produk JOIN etalase USING(id_etalase) JOIN kategori_etalase USING(id_ke) WHERE id_produk != '$id' AND no_item = $idd AND harga<=$harga ORDER BY harga ASC")->row();
    }

    public function get_spesifikasi2($id)
    {
        return $this->db->query("SELECT * FROM meta_produk WHERE id_produk = '$id'")->result();
    }

    // --------------
    // Pengumuman
    // --------------

    public function get_all_pengumuman($limit, $offset)
    {
        $this->db->from('pengumuman');

        return [
            'jumlah' => $this->db->count_all_results(null, false),
            'data' => $this->db->get(null, $limit, $offset)->result(),
        ];
    }

    public function find_pengumuman($search, $start, $finish, $limit, $offset)
    {
        if (!empty($search)) {
            $this->db->like('pengumuman.judul', $search);
        }

        if (!empty($start)) {
            $this->db->where('tanggal_mulai >=', $start);
        }

        if (!empty($finish)) {
            $this->db->where('tanggal_akhir <= ', $finish);
        }

        $this->db->select('pengumuman.id_pengumuman, pengumuman.judul, nama_ke, kategori_etalase.id_ke');
        $this->db->join('tahapan_pengumuman', 'id_pengumuman');
        $this->db->join('etalase', 'id_etalase');
        $this->db->join('kategori_etalase', 'id_ke');
        $this->db->group_by('pengumuman.id_pengumuman');
        $this->db->from('pengumuman');

        return [
            'jumlah' => $this->db->count_all_results(null, false),
            'data' => $this->db->get(null, $limit, $offset)->result(),
        ];
    }

    public function get_postingan($id)
    {
        return $this->db->query("SELECT * FROM pengumuman JOIN etalase USING(id_etalase) WHERE id_pengumuman = '$id'")->row();
    }

    public function get_tahapan_pengumuman($id)
    {
        return $this->db->query("SELECT * FROM tahapan_pengumuman WHERE id_pengumuman = '$id'")->result();
    }

    public function get_merek($id)
    {
        return $this->db->query("SELECT * FROM merek JOIN etalase USING(id_etalase) WHERE id_pengumuman = '$id'")->result();
    }

    // --------------
    // Berita
    // --------------

    public function get_kategori_berita()
    {
        return $this->db->query("SELECT id_kb, nama_kb, COUNT(berita.id_kb) as jumlah FROM kategori_berita JOIN berita USING(id_kb) GROUP BY id_kb")->result();
    }

    public function get_berita_id($id)
    {
        return $this->db->query("SELECT * FROM berita JOIN kategori_berita USING(id_kb) WHERE id_berita = " . $this->db->escape($id))->row();
    }

    public function find_berita($search, $id_kb, $limit, $offset)
    {
        if (!is_null($id_kb)) {
            $this->db->where('id_kb', $id_kb);
        }

        // $this->db->select('id_berita, judul, SUBSTRING(body, 0, 100) as body, penulis, tanggal, gambar, kategori_berita.*');
        $this->db->join('kategori_berita', 'id_kb');
        $this->db->like('judul', $search);
        $this->db->from('berita');

        return [
            'jumlah' => $this->db->count_all_results(null, false),
            'data' => $this->db->get(null, $limit, $offset)->result(),
        ];
    }

    public function get_tags_id($id)
    {
        return $this->db->query("SELECT * FROM tags WHERE id_berita = " . $this->db->escape($id))->result();
    }

    public function newsupdate()
    {
        return $this->db->query("SELECT * FROM berita JOIN kategori_berita USING(id_kb) ORDER BY id_berita DESC limit 5")->result();
    }

    // deprecated
    // public function get_berita_post($limit, $offset)
    // {
    //     // return $this->db->query("SELECT * FROM berita JOIN kategori_berita USING(id_kb)")->result();

    //     $this->db->join('kategori_berita', 'id_kb');
    //     $this->db->from('berita');

    //     return [
    //         'jumlah' => $this->db->count_all_results(NULL, FALSE),
    //         'data'   => $this->db->get(NULL, $limit, $offset)->result()
    //     ];
    // }

    // --------------
    // Unduhan
    // --------------

    public function find_unduhan($search, $id_ku, $limit, $offset)
    {
        if (!is_null($id_ku)) {
            $this->db->where('id_ku', $id_ku);
        }

        $this->db->join('kategori_unduhan', 'id_ku');
        $this->db->like('nama_unduhan', $search);
        $this->db->from('unduhan');

        return [
            'jumlah' => $this->db->count_all_results(null, false),
            'data' => $this->db->get(null, $limit, $offset)->result(),
        ];
    }

    public function get_kategori_unduh()
    {
        return $this->db->query("SELECT id_ku, nama_ku, COUNT(unduhan.id_ku) as jumlah FROM kategori_unduhan JOIN unduhan USING(id_ku) GROUP BY id_ku")->result();
    }

    // --------------
    // PO
    // --------------

    public function get_kak($link)
    {
        $query = $this->db->query('SELECT * FROM kak JOIN pk USING(id_pk) WHERE link = ' . $this->db->escape($link));
        return $query->row();
    }

    public function get_keranjang_kak($id_kak)
    {
        return $this->db->query("SELECT * FROM keranjang
            JOIN produk USING(id_produk) JOIN paket USING(id_paket) JOIN kak USING(id_kak) JOIN penyedia ON (penyedia.id_penyedia = produk.id_penyedia) JOIN item USING(no_item)
            WHERE id_kak = ".$this->db->escape($id_kak))->result();

        // $this->db->select('id_produk, id_paket, nama_produk, kuantitas, unit_pengukuran, harga, foto, merek, masa_berlaku, no_item, id_meta, spesifikasi, nilai');
		// $this->db->join('paket', 'id_paket');
		// $this->db->join('kak', 'id_kak');
		// $this->db->join('produk', 'id_produk');
        // $this->db->join('meta_produk', 'id_produk', 'LEFT');
        // $this->db->where('id_kak', $id_kak);
        // $result = $this->db->get('keranjang')->result_array();

        // // d($result);
        // $data = $this->_format_keranjang($result);

        // // dd($data);
        // return $data;
    }

	public function get_harga($id_kak)
	{
		return $this->db->query("SELECT SUM(kuantitas*harga_ppn) AS total 
			FROM keranjang 
			JOIN paket USING(id_paket) 
			JOIN produk USING(id_produk) 
			JOIN kak USING(id_kak) 
			WHERE id_kak = ".$this->db->escape($id_kak))->row();
	}

    public function get_nego_harga($id_paket)
    {
        $this->db->select('negosiasi_harga.nominal');
        $this->db->join('paket', 'id_paket');
        $this->db->where('status >=', '4');
        $this->db->where('paket.id_paket', $id_paket);

        return $this->db->get('negosiasi_harga')->row();
    }

    public function get_nego_spesifikasi($id_paket)
    {
        $this->db->select('spesifikasi, nilai');
        $this->db->join('paket', 'id_paket');
        $this->db->where('status >=', '4');
        $this->db->where('paket.id_paket', $id_paket);

        return $this->db->get('negosiasi_spesifikasi')->result_array();
    }

    public function get_nego_tanggal($id_paket)
    {
        $this->db->select('tanggal_mulai, tanggal_akhir');
        $this->db->join('paket', 'id_paket');
        $this->db->where('status >=', '4');
        $this->db->where('paket.id_paket', $id_paket);

        return $this->db->get('negosiasi_tanggal')->result_array();
    }

    // --------------
    // Auth
    // --------------

    public function get_user($email)
    {
        return $this->db->get_where('user', ['email' => $email])->row();
    }

    public function get_nama_user($id_user, $level)
    {
        if ($level === 'admin') {
            return;
        }

        $this->db->select('nama_' . $level);
        return $this->db->get_where($level, ['id_' . $level => $id_user])->row_array();
    }

    // --------------
    // Informasi
    // --------------

    public function get_produk_tayang()
    {
        return $this->db->query("SELECT nama_ke,nama_etalase,nama_item,SUM(id_produk) as totalproduk,COUNT(produk.id_penyedia) as totalpenyedia FROM produk JOIN etalase USING(id_etalase) JOIN item USING(no_item) JOIN kategori_etalase USING(id_ke) GROUP BY produk.id_produk")->result();
    }

	public function get_jumlah_produk_tayang()
    {
        return $this->db->query("SELECT COUNT(id_produk) as jumlahproduk FROM produk")->row();
    }

    public function get_transaksi()
    {
        return $this->db->query("SELECT SUM(kuantitas) as totalproduk,unit_pengukuran, COUNT(id_paket) as totalpaket,nama_ke,nama_etalase,nama_item,SUM(id_produk) as totalproduk,COUNT(produk.id_penyedia) as totalpenyedia FROM produk JOIN etalase USING(id_etalase) JOIN item USING(no_item) JOIN kategori_etalase USING(id_ke) JOIN keranjang USING(id_produk) JOIN paket USING(id_paket) GROUP BY produk.id_produk")->result();
    }

    // --------------
    // Other
    // --------------

    /**
     * Import data item dari excel
     */
    public function import_item($data_etalase, $data_item)
    {
        $this->db->insert_batch('etalase', $data_etalase);

        $this->db->insert_batch('item', $data_item);
    }

	public function get_kontak()
	{
		$result      = $this->db->get('kontak')->result();
		$kontak_init = ['nama_kontak', 'alamat', 'telepon_1', 'telepon_2', 'jam_telepon', 'email', 'website', 'googlemap_src'];
		$kontak      = [];
		$kontak_tambahan = [];

		foreach ($result as $k) {
			if (! in_array($k->key, $kontak_init)) {
				$kontak_tambahan[$k->key] = $k->value;
				
				continue;
			}

			$kontak[$k->key] = $k->value;
		}

		return array_merge($kontak, $kontak_tambahan);
	}

    // --------------

    /**
     * Method untuk format data keranjang untuk ditampilkan di laporan po
     */
    private function _format_keranjang($data)
    {
        $result = [];
        $produk_formatted = [];
        $i = -1;

        foreach ($data as $produk) {

            if (!in_array($produk['id_produk'], $produk_formatted)) {
                if (!empty($produk['id_meta'])) {
                    $meta_produk = array_slice($produk, -2, 2);

                    $produk['meta_produk'][] = $meta_produk;
                }

                $i++;
                $result[$i] = $produk;

                $produk_formatted[] += $produk['id_produk'];

                continue;
            }

            $meta_produk = array_slice($produk, -2, 2);
            array_push($result[$i]['meta_produk'], $meta_produk);
        }

        return $result;
    }

    // get all faq
    public function get_faq()
    {
        return $this->db->get('faq')->result();
    }
}
