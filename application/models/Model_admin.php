<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Model_admin extends CI_Model
{
    public function get_summary()
    {
        $data = [
            'jml_etalase' => $this->db->count_all('etalase'),
            'jml_paket' => $this->db->count_all('paket'),
            'jml_pengumuman' => $this->db->count_all('pengumuman'),
            'jml_berita' => $this->db->count_all('berita'),
            'jml_unduhan' => $this->db->count_all('unduhan'),
        ];

        $kode_status = [
            'diproses' => [0, 1],
            'dinegosiasi' => [2, 3, 4],
            'dikirim' => [5, 6],
            'selesai' => [7],
            'ditolak' => [8],
        ];

        foreach ($kode_status as $nama => $kode) {
            $this->db->where_in('status', $kode);
            $data[$nama] = $this->db->count_all_results('paket');
        }

        return $data;
    }

    public function get_paket($id_paket = null)
    {
        if (!is_null($id_paket)) {
            $this->db->select('paket.*, pp.nama_pp, riwayat_paket.tanggal, kak.id_pk');
            $this->db->join('pp', 'id_pp');
            $this->db->join('kak', 'id_kak');
            $this->db->join('pk', 'id_pk');
            $this->db->join('riwayat_paket', 'id_paket');
            $this->db->where('id_paket', $id_paket);
            $this->db->where('riwayat_paket.status', 0);
            return $this->db->get('paket')->row();
        }

        // $this->db->join('keranjang', 'id_paket');
        // $this->db->order_by('paket.id_paket', 'DESC');
        // return $this->db->get('paket')->result();
    }

    public function get_paket_by_status(array $status)
    {
        $this->db->select('paket.*, link,nama_paket, nama_pumk, nama_pp, nama_pk');
        $this->db->join('kak', 'id_kak');
        $this->db->join('pk', 'id_pk');
        $this->db->join('pp', 'paket.id_pp = pp.id_pp');
        $this->db->join('keranjang', 'id_paket');
        $this->db->join('pumk', 'keranjang.id_pumk = pumk.id_pumk');
        $this->db->where_in('status', $status);
        $this->db->group_by('id_paket');
        $this->db->order_by('paket.id_paket', 'DESC');
        return $this->db->get('paket')->result();
    }

    public function get_detail_paket($id_paket)
    {
        $this->db->select('keranjang.*, produk.nama_produk, produk.harga_ppn, pumk.nama_pumk, penyedia.nama_penyedia');
        $this->db->join('produk', 'id_produk');
        $this->db->join('penyedia', 'produk.id_penyedia = penyedia.id_penyedia');
        $this->db->join('pumk', 'keranjang.id_pumk = pumk.id_pumk');
        $keranjang = $this->db->get_where('keranjang', ['id_paket' => $id_paket])->result();

        return [
            'keranjang' => $keranjang,
            // 'negosiasi_harga' => $this->db->get_where('negosiasi_harga', ['id_paket' => $id_paket])->result(),
            'negosiasi_harga' => [],
            'negosiasi_spesifikasi' => $this->db->get_where('negosiasi_spesifikasi', ['id_paket' => $id_paket])->result(),
            'negosiasi_tanggal' => $this->db->get_where('negosiasi_tanggal', ['id_paket' => $id_paket])->result(),
        ];
    }

    public function get_riwayat_paket($id_paket)
    {
        $this->db->select('id_paket, aksi, DATE_FORMAT(tanggal, "%H.%i") AS waktu, DATE_FORMAT(tanggal, "%d-%m-%Y") AS tanggal, no_pr, status, pp.nama_pp');
        $this->db->join('pp', 'id_pp', 'LEFT');
        $riwayat = $this->db->get_where('riwayat_paket', ['id_paket' => $id_paket])->result_array();

        return $this->_format_timeline($riwayat);
    }

    public function get_riwayat_nh($id_paket)
    {
        // Urutan select berpengaruh dalam format data yang akan ditampilkan pada view
        $this->db->select('id_nh, aksi, DATE_FORMAT(tanggal, "%H.%i") AS waktu, DATE_FORMAT(tanggal, "%d-%m-%Y") AS tanggal, `rhn`.`nominal` AS nominal, `rhn`.`ongkir` AS ongkir, `rhn`.`tanggal_pengiriman` AS tanggal_pengiriman, `rhn`.`catatan_pembeli` AS catatan_pembeli, catatan_penyedia');
        $this->db->join('negosiasi_harga', 'id_nh');
        $this->db->where('id_paket', $id_paket);
        $riwayat = $this->db->get('riwayat_nh AS rhn')->result_array();

        return $this->_format_timeline($riwayat);
    }

    public function get_riwayat_ns($id_paket)
    {
        // Urutan select berpengaruh dalam format data yang akan ditampilkan pada view
        $this->db->select('id_ns, aksi, DATE_FORMAT(tanggal, "%H.%i") AS waktu, DATE_FORMAT(tanggal, "%d-%m-%Y") AS tanggal, `rhs`.`spesifikasi` AS spesifikasi, `rhs`.`nilai` AS nilai, `rhs`.`catatan_pembeli` AS catatan_pembeli, catatan_penyedia');
        $this->db->join('negosiasi_spesifikasi', 'id_ns');
        $this->db->where('id_paket', $id_paket);
        $riwayat = $this->db->get('riwayat_ns AS rhs')->result_array();

        $result = [];
        $prevSpek = $riwayat[0]['spesifikasi'] ?? '';
        $prevNilai = $riwayat[0]['nilai'] ?? '';

        foreach ($riwayat as $data) {
            if (!is_null($data['spesifikasi'])) {
                $prevSpek = $data['spesifikasi'];
            }

            if (!is_null($data['nilai'])) {
                $prevNilai = $data['nilai'];
            }

            if (!array_key_exists($data['tanggal'], $result)) {
                $dataRiwayat = array_slice($data, 0, 3);

                $result[$data['tanggal']][0] = $dataRiwayat;
                $result[$data['tanggal']][0]['item_riwayat']['spesifikasi'] = $prevSpek;
                $result[$data['tanggal']][0]['item_riwayat']['nilai'] = $prevNilai;
                $result[$data['tanggal']][0]['item_riwayat']['catatan_pembeli'] = $data['catatan_pembeli'];
                $result[$data['tanggal']][0]['item_riwayat']['catatan_penyedia'] = $data['catatan_penyedia'];
                continue;
            }

            $dataRiwayat = array_slice($data, 0, 3);
            $dataRiwayat['item_riwayat']['spesifikasi'] = $prevSpek;
            $dataRiwayat['item_riwayat']['nilai'] = $prevNilai;
            $dataRiwayat['item_riwayat']['catatan_pembeli'] = $data['catatan_pembeli'];
            $dataRiwayat['item_riwayat']['catatan_penyedia'] = $data['catatan_penyedia'];
            array_push($result[$data['tanggal']], $dataRiwayat);
        }

        return $result;
    }

    public function get_riwayat_nt($id_paket)
    {
        // Urutan select berpengaruh dalam format data yang akan ditampilkan pada view
        $this->db->select('id_nt, aksi, DATE_FORMAT(tanggal, "%H.%i") AS waktu, DATE_FORMAT(tanggal, "%d-%m-%Y") AS tanggal, `rht`.`tanggal_mulai`, `rht`.`tanggal_akhir`, `rht`.`catatan_pembeli` AS catatan_pembeli, `rht`.`catatan_penyedia`');
        $this->db->join('negosiasi_tanggal', 'id_nt');
        $this->db->where('id_paket', $id_paket);
        $riwayat = $this->db->get('riwayat_nt AS rht')->result_array();

        return $this->_format_timeline($riwayat);
    }

    public function get_etalase($id_etalase = null)
    {
        if (!is_null($id_etalase)) {
            return $this->db->get_where('etalase', ['id_etalase' => $id_etalase])->row();
        }

        $this->db->order_by('nama_etalase');
        return $this->db->get('etalase')->result();
    }

    public function get_produk($id_produk)
    {
        $this->db->select('produk.*, etalase.*, kategori_etalase.*, penyedia.nama_perusahaan');
        $this->db->join('penyedia', 'id_penyedia');
        $this->db->join('etalase', 'id_etalase');
        $this->db->join('kategori_etalase', 'id_ke');
        return $this->db->get_where('produk', ['id_produk' => $id_produk])->row();
    }

    public function get_nama_produk($id_produk)
    {
        $this->db->select('nama_produk');
        return $this->db->get_where('produk', ['id_produk' => $id_produk])->row();
    }

    public function get_produk_by_etalase($id_etalase)
    {
        return $this->db->get_where('produk', ['id_etalase' => $id_etalase])->result();
    }

    public function get_riwayat_produk($id_produk)
    {
        $this->db->select('id_produk, aksi, DATE_FORMAT(tanggal, "%H.%i") AS waktu, DATE_FORMAT(tanggal, "%d-%m-%Y") AS tanggal, nama_produk, harga, harga_ppn, masa_berlaku, merek, no_produk_penyedia, unit_pengukuran, kode_kbki, nilai_tkdn, stok, deskripsi, foto, no_item, nama_etalase, nama_penyedia');
        $this->db->join('penyedia', 'id_penyedia', 'LEFT');
        $this->db->join('etalase', 'id_etalase', 'LEFT');
        $produk = $this->db->get_where('riwayat_produk', ['id_produk' => $id_produk])->result_array();

        return $this->_format_timeline($produk);
    }

    public function get_meta_produk($id_produk)
    {
        return $this->db->get_where('meta_produk', ['id_produk' => $id_produk])->result();
    }

    public function get_pengumuman($id_pengumuman = null)
    {
        $this->db->join('etalase', 'id_etalase');

        if (!is_null($id_pengumuman)) {
            return $this->db->get_where('pengumuman', ['id_pengumuman' => $id_pengumuman])->row();
        }

        $this->db->select('pengumuman.*, etalase.*');
        return $this->db->get('pengumuman')->result();
    }

    public function create_pengumuman($data)
    {
        return $this->db->insert('pengumuman', $data);
    }
    public function update_pengumuman($data, $id)
    {
        $this->db->where('id_pengumuman', $id);
        $o = $this->db->update('pengumuman', $data);
        return $o;
    }
    public function delete_pengumuman($id)
    {
        $this->db->where('id_pengumuman', $id);
        $o = $this->db->delete('pengumuman');
        return $o;
    }

    // public function get_merek($id_pengumuman)
    // {
    //     $this->db->join('etalase', 'id_etalase');
    //     return $this->db->get_where('merek', ['id_pengumuman' => $id_pengumuman])->result();
    // }

    public function get_merek($id)
    {
        return $this->db->query("SELECT * FROM merek WHERE id_pengumuman = '$id'")->result();
    }

    // get tahapan
    public function get_tahapan($id)
    {
        return $this->db->query("SELECT * FROM tahapan_pengumuman WHERE id_pengumuman = '$id'")->result();
    }

    public function get_berita($id_berita = null)
    {
        $this->db->join('kategori_berita', 'id_kb');
        $this->db->join('admin', 'id_admin');

        if (!is_null($id_berita)) {
            return $this->db->get_where('berita', ['id_berita' => $id_berita])->row();
        }

        $this->db->select('berita.id_berita, berita.judul, berita.tanggal, berita.gambar, kategori_berita.*, admin.*');
        // $this->db->select('berita.id_berita, berita.judul, berita.tanggal, kategori_berita.*');
        return $this->db->get('berita')->result();
    }

    public function get_berita_by_kb($id_berita)
    {
        return $this->db->get_where('berita', ['id_kb' => $id_berita])->result();
    }

    public function get_berita_by_tag($tag)
    {
        $this->db->join('tags', 'id_berita');
        $this->db->join('kategori_berita', 'id_kb');
        return $this->db->get_where('berita', ['tags.tag' => $tag])->result();
    }
    public function get_berita_complete($id)
    {
        return $this->db->query("SELECT * FROM berita JOIN kategori_berita USING(id_kb) WHERE id_admin = '$id'")->result();
    }

    public function get_kb($id_kb)
    {
        return $this->db->get_where('kategori_berita', ['id_kb' => $id_kb])->row();
    }

    public function get_tags_and_one_berita($id_berita)
    {
        $this->db->join('berita', 'id_berita');
        $this->db->select('berita.id_berita, berita.judul, tags.*');
        return $this->db->get_where('tags', ['id_berita' => $id_berita])->result();
    }

    public function get_unduhan($id_unduhan = null)
    {
        $this->db->join('kategori_unduhan', 'id_ku');
        $this->db->join('admin', 'id_admin');

        if (!is_null($id_unduhan)) {
            return $this->db->get_where('unduhan', ['id_unduhan' => $id_unduhan])->row();
        }

        return $this->db->get('unduhan')->result();
    }

    public function get_unduhan_by_ku($id_unduhan)
    {
        return $this->db->get_where('unduhan', ['id_ku' => $id_unduhan])->result();
    }

    public function get_ku($id_ku)
    {
        return $this->db->get_where('kategori_unduhan', ['id_ku' => $id_ku])->row();
    }

    public function get_kategori()
    {
        return [
            'kategori_etalase' => $this->db->get('kategori_etalase')->result(),
            'kategori_berita' => $this->db->get('kategori_berita')->result(),
            'kategori_unduhan' => $this->db->get('kategori_unduhan')->result(),
        ];
    }

		
	// --------------
    // Penyedia
	// --------------

    public function get_penyedia($id = null)
    {
        if (!is_null($id)) {
            return $this->db->get_where('penyedia', ['id_penyedia' => $id])->row();
        }
        return $this->db->get('penyedia')->result();
    }

    public function get_etalase_by_penyedia($id)
    {
        return $this->db->query("SELECT id_etalase FROM etalase_penyedia WHERE id_penyedia = '$id'")->result();
    }

    public function create_penyedia($data)
    {
        return $this->db->insert('penyedia', $data);
    }

    public function update_penyedia($data_penyedia, $data_etalase, $id_penyedia)
    {
		$this->db->trans_start();

        $this->db->where('id_penyedia', $id_penyedia);
        $this->db->update('penyedia', $data_penyedia);

		$this->db->where('id_penyedia', $id_penyedia);
		$this->db->delete('etalase_penyedia');

        $this->db->insert_batch('etalase_penyedia', $data_etalase);

		$this->db->trans_complete();

		if ($this->db->trans_status() === FALSE) {
			return FALSE;
		}

		return TRUE;
    }

    public function delete_penyedia($id)
    {
        $this->db->where('id_penyedia', $id);
        $o = $this->db->delete('penyedia');
        return $o;
    }


    public function switch_pp_pk($data)
    {
        $this->db->where('id_kak', $data['id_kak']);
        $this->db->update('kak', ['id_pk' => $data['pk']]);


        $this->db->where('id_paket', $data['id_paket']);
        return $this->db->update('paket', ['id_pp' => $data['pp']]);
    }


	// --------------
	// Kontak
	// --------------

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

	public function update_kontak($data)
	{
		return $this->db->update_batch('kontak', $data, 'key');
	}

	public function insert_kontak($data)
	{
		return $this->db->insert_batch('kontak', $data);
	}

	public function delete_kontak($data)
	{
		$this->db->where('key', $data);
		return $this->db->delete('kontak');
	}


    /**
     * Format hasil query riwayat
     *
     * @param     array    $riwayat    Hasil query yang berupa object
     * @return    array
     */
    private function _format_timeline(array $riwayat)
    {
        $result = [];

        foreach ($riwayat as $data) {
            if (!array_key_exists($data['tanggal'], $result)) {
                $dataRiwayat = array_slice($data, 0, 3);

                $result[$data['tanggal']][0] = $dataRiwayat;
                $result[$data['tanggal']][0]['item_riwayat'] = array_slice($data, 4);
                continue;
            }

            $dataRiwayat = array_slice($data, 0, 3);
            $dataRiwayat['item_riwayat'] = array_slice($data, 4);
            array_push($result[$data['tanggal']], $dataRiwayat);
        }

        return $result;
    }

    //  ====================================== dev1 ===========================================
    // get all kategori
    public function get_all_kb()
    {
        return $this->db->query("SELECT * FROM kategori_berita")->result();
    }

    // create berita
    public function create_berita($data)
    {
        return $this->db->insert('berita', $data);
    }

    // update berita
    public function update_berita($data, $id)
    {
        $this->db->where('id_berita', $id);
        $o = $this->db->update('berita', $data);
        return $o;
    }

    // delete berita
    public function delete_berita($id)
    {
        $this->db->where('id_berita', $id);
        $o = $this->db->delete('berita');
        return $o;
    }

    // get all and get one faq
    public function get_faq($id_faq = null)
    {
        $this->db->join('admin', 'id_admin');

        if (!is_null($id_faq)) {
            return $this->db->get_where('faq', ['id_faq' => $id_faq])->row();
        }

        $this->db->select('faq.*, admin.*');
        return $this->db->get('faq')->result();
    }

    // create faq
    public function create_faq($data)
    {
        return $this->db->insert('faq', $data);
    }

    // update faq
    public function update_faq($data, $id)
    {
        $this->db->where('id_faq', $id);
        $o = $this->db->update('faq', $data);
        return $o;
    }

    // delete faq
    public function delete_faq($id)
    {
        $this->db->where('id_faq', $id);
        $o = $this->db->delete('faq');
        return $o;
    }

    // unduhan
    // ambil semua kategori unduhan
    public function get_all_ku()
    {
        return $this->db->query("SELECT * FROM kategori_unduhan")->result();
    }

    // insert ke tabel unduhan
    public function create_unduhan($data)
    {
        return $this->db->insert('unduhan', $data);
    }

    // update unduhan
    public function update_unduhan($data, $id)
    {
        $this->db->where('id_unduhan', $id);
        return $this->db->update('unduhan', $data);
    }

	public function get_file_unduhan_lama($id)
	{
		$this->db->select('file');
		$this->db->where('id_unduhan', $id);
		$query = $this->db->get('unduhan')->row();

		return $query->file;
	}

    // delete unduhan
    public function delete_unduhan($id)
    {
        $this->db->where('id_unduhan', $id);
        return $this->db->delete('unduhan');
    }

    // tags
    // create tag
    public function create_tag($data)
    {
        return $this->db->insert_batch('tags', $data);
    }

    public function update_tag($data, $id)
    {
        // $this->db->where('id_berita', $id);
        // $o = $this->db->update('tags');
        // return $o;
        return $this->db->update_batch('tags', $data, $id);
    }

}
