<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Model_penyedia extends CI_Model
{

    //Kelola Kategori
    public function get_kategori_etalase()
    {
        return $this->db->query('SELECT * FROM kategori_etalase')->result();
    }

    public function get_produk_etalase($id)
    {
        return $this->db->query("SELECT * FROM kategori_etalase JOIN etalase USING(id_ke) JOIN etalase_penyedia USING(id_etalase) WHERE id_penyedia = $id")->result();
    }

    public function get_item_etalase($id)
    {
        return $this->db->query("SELECT * FROM item JOIN etalase USING(id_etalase) JOIN etalase_penyedia USING(id_etalase) WHERE id_penyedia = $id")->result();
    }

    //Kelola Produk
    public function get_produk($id)
    {
        return $this->db->query("SELECT * FROM produk JOIN etalase USING(id_etalase) WHERE id_penyedia = '$id' ORDER BY id_produk DESC")->result();
    }

    public function get_detail_produk($id)
    {
        return $this->db->query("SELECT * FROM produk JOIN etalase USING(id_etalase) WHERE id_produk = '$id'")->row();
    }

    public function get_detail_produk1($id)
    {
        return $this->db->query("SELECT * FROM produk WHERE id_produk = '$id'")->row();
    }

    public function create_produk($data)
    {
        return $this->db->insert('produk', $data);
    }

    public function update_produk($data, $id)
    {
        $this->db->where('id_produk', $id);
        $o = $this->db->update('produk', $data);

        // Hapus cache riwayat produk
        $this->load->driver('cache', ['adapter' => 'file']);
        $this->cache->delete('riwayat_produk_' . $id);

        return $o;
    }

	public function import_data($dataBarang)
    {
        // $this->db->replace('produk', $dataBarang);
        $this->db->insert_batch('produk', $dataBarang);
    }


    public function get_check_negosiasi($id_paket)
    {
        // return $this->db->query('SELECT * 
		// 	FROM paket 
		// 	JOIN keranjang
		// 	JOIN negosiasi_harga USING(id_paket) 
		// 	WHERE id_paket ='.$this->db->escape($id_paket))->row();

		$this->db->limit('1');
		$this->db->order_by('tanggal', 'DESC');
		return $this->db->get_where('riwayat_nh', ['id_paket' => $id_paket])->result();
    }

    public function delete_produk($id)
    {
        $this->db->where('id_produk', $id);
        return $this->db->delete('produk');
    }

    //Kelola Spesifikasi
    public function create_spesifikasi($data)
    {
        return $this->db->insert('meta_produk', $data);
    }

    public function spesifikasi_produk($id)
    {
        return $this->db->query("SELECT * FROM meta_produk JOIN produk USING(id_produk) WHERE produk.id_produk = '$id'")->result();
    }

    public function delete_spesifikasi($id)
    {
        $this->db->where('id_produk', $id);
        return $this->db->delete('meta_produk');
    }

    public function spesifikasi_produk2($id)
    {
        return $this->db->query("SELECT * FROM meta_produk WHERE id_produk = '$id'")->result();
    }

    public function spesifikasi_produk3($id)
    {
        return $this->db->query("SELECT * FROM meta_produk JOIN produk USING (id_produk) WHERE id_meta = '$id'")->row();
    }

    public function update_spesifikasi($data, $id)
    {
        $this->db->where('id_meta', $id);
        $o = $this->db->update('meta_produk', $data);
        return $o;
    }

    //Lampiran Produk
    public function lampiran($id)
    {
        return $this->db->query("SELECT * FROM lampiran WHERE id_produk = '$id'")->result();
    }

    public function create_lampiran($data)
    {
        return $this->db->insert('lampiran', $data);
    }

    public function delete_lampiran($id)
    {
        $this->db->where('id_produk', $id);
        return $this->db->delete('lampiran');
    }

    public function delete_lampiran2($id)
    {
        $this->db->where('id_lampiran', $id);
        return $this->db->delete('lampiran');
    }

    //Kelola Pengumuman
    public function get_pengumuman($id)
    {
        return $this->db->query("SELECT * FROM pengumuman JOIN etalase USING(id_etalase) WHERE id_user='$id'")->result();
    }

    public function get_pengumuman2($id)
    {
        return $this->db->query("SELECT * FROM pengumuman JOIN etalase USING(id_etalase) WHERE id_pengumuman = '$id'")->row();
    }

    public function create_pengumuman($data)
    {
        return $this->db->insert('pengumuman', $data);
    }

    public function delete_pengumuman($id)
    {
        $this->db->where('id_pengumuman', $id);
        return $this->db->delete('pengumuman');
    }

    public function get_merek($id)
    {
        return $this->db->query("SELECT * FROM merek WHERE id_pengumuman = '$id'")->result();
    }

    public function create_merek($data)
    {
        return $this->db->insert('merek', $data);
    }

    public function delete_merek($id)
    {
        $this->db->where('id_pengumuman', $id);
        return $this->db->delete('merek');
    }

    public function delete_merek2($id)
    {
        $this->db->where('id_merek', $id);
        return $this->db->delete('merek');
    }

    public function get_tahapan($id)
    {
        return $this->db->query("SELECT * FROM tahapan_pengumuman WHERE id_pengumuman = '$id'")->result();
    }

    public function create_tahapan($data)
    {
        return $this->db->insert('tahapan_pengumuman', $data);
    }

    public function delete_tahapan($id)
    {
        $this->db->where('id_pengumuman', $id);
        return $this->db->delete('tahapan_pengumuman');
    }

    public function delete_tahapan2($id)
    {
        $this->db->where('id_tp', $id);
        return $this->db->delete('tahapan_pengumuman');
    }

    //Kelola Paket
    public function update_paket($data, $id)
    {
        $this->db->where('id_paket', $id);
        $o = $this->db->update('paket', $data);
        return $o;
    }

	public function cekPaket($id)
	{
		return $this->db->query("SELECT * FROM paket JOIN kak USING(id_kak) WHERE id_paket = $id")->row();
	}

    // Kelola Negosiasi
    public function get_negosiasi($id)
    {
        return $this->db->query("SELECT id_paket,nama_paket,tanggal_mulai,tanggal_akhir,SUM(kuantitas) as jumlahproduk,paket.status as status,SUM(kuantitas*harga_ppn) as nominal,no_pr,id_kak FROM keranjang JOIN paket USING(id_paket) JOIN produk USING(id_produk)JOIN kak USING(id_kak) WHERE paket.id_penyedia = $id AND paket.status IN (2,4) GROUP BY id_paket")->result(); 
    }

    public function get_negosiasi_id($id)
    {
        return $this->db->query("SELECT id_kak,SUM(harga_ppn*kuantitas) as nominal,unit_pengukuran,id_paket, paket.status as status, tanggal_mulai,tanggal_akhir, SUM(kuantitas) as jumlahproduk,SUM(harga*kuantitas) as total, no_pr,uraian_pekerjaan, SUM(kuantitas*harga) as total, alamat_kirim,nama_paket, no_pr
		FROM paket JOIN keranjang USING(id_paket) JOIN produk USING(id_produk) JOIN kak USING(id_kak)
		WHERE id_paket = '$id'")->row();
    }

    public function get_paket_id($id)
    {
        return $this->db->query("SELECT id_keranjang,no_item,id_produk,nama_produk,kuantitas,harga,(kuantitas*harga) as total,foto, unit_pengukuran,merek,no_produk_penyedia,masa_berlaku,deskripsi FROM produk JOIN keranjang USING(id_produk) WHERE id_paket = '$id'")->result();
    }

	public function get_paket_nego_id($id)
    {
        return $this->db->query("SELECT id_keranjang,id_produk,nama_produk,kuantitas,harga,nominal,foto,unit_pengukuran,catatan_pembeli FROM produk JOIN keranjang USING(id_produk) JOIN negosiasi_harga USING(id_keranjang) WHERE id_paket = '$id'")->result();
    }

    public function get_subtotal_id($id)
    {
        return $this->db->query("SELECT SUM(kuantitas*harga) as total FROM produk JOIN keranjang USING(id_produk) JOIN paket USING(id_paket) WHERE id_paket = $id GROUP BY id_paket")->row();
    }

    public function get_negosiasi_harga($id)
    {
        return $this->db->query("SELECT * FROM riwayat_nh WHERE id_paket = $id ORDER BY tanggal DESC")->row();
    }

    public function get_negosiasi_spesifikasi($id)
    {
        return $this->db->query("SELECT * FROM paket JOIN negosiasi_spesifikasi USING(id_paket) JOIN riwayat_ns USING(id_ns) WHERE id_paket = '$id' GROUP BY tanggal")->row();
    }

    public function get_negosiasi_tanggal($id)
    {
        return $this->db->query("SELECT negosiasi_tanggal.tanggal_mulai as tanggal_mulai,negosiasi_tanggal.tanggal_akhir as tanggal_akhir,riwayat_nt.catatan_pembeli as catatan_pembeli FROM paket JOIN negosiasi_tanggal USING(id_paket) JOIN riwayat_nt USING(id_nt) WHERE id_paket = '$id' GROUP BY tanggal")->row();
    }

	public function get_jumlah_produk2($id)
	{
		return $this->db->query("SELECT COUNT(id_keranjang) as jumlah FROM keranjang JOIN paket USING(id_paket) JOIN produk USING(id_produk)JOIN kak USING(id_kak) WHERE id_paket = $id GROUP BY id_paket, produk.id_penyedia")->row();
	}

    public function get_riwayat_nego_harga($id)
    {
        return $this->db->query("SELECT id_paket,tanggal,riwayat_nh.catatan_pembeli as catatan_pembeli,riwayat_nh.catatan_penyedia as catatan_penyedia,riwayat_nh.ongkir as ongkir,riwayat_nh.nominal as nominal FROM riwayat_nh WHERE id_paket = ".$this->db->escape($id))->result();
    }

    public function get_riwayat_nego_spesifikasi($id)
    {
        return $this->db->query("SELECT riwayat_ns.tanggal as tanggal,riwayat_ns.catatan_pembeli as catatan_pembeli, riwayat_ns.catatan_penyedia as catatan_penyedia,id_paket FROM riwayat_ns JOIN negosiasi_spesifikasi USING(id_ns) JOIN paket USING(id_paket) WHERE id_paket = ".$this->db->escape($id))->result();
    }

    public function create_nh($data)
    {
        return $this->db->insert('negosiasi_harga', $data);
    }

	public function create_riwayat_nh($data){
		return $this->db->insert('riwayat_nh',$data);
	}


    public function update_nh($data, $id)
    {
        $this->db->where('id_keranjang', $id);
        $o = $this->db->update('negosiasi_harga', $data);
        return $o;
    }

    public function create_ns($data)
    {
        return $this->db->insert('negosiasi_spesifikasi', $data);
    }

    public function update_ns($data, $id)
    {
        $this->db->where('id_paket', $id);
        $o = $this->db->update('negosiasi_spesifikasi', $data);
        return $o;
    }

    public function create_nt($data)
    {
        return $this->db->insert('negosiasi_tanggal', $data);
    }

    public function update_nt($data, $id)
    {
        $this->db->where('id_paket', $id);
        $o = $this->db->update('negosiasi_tanggal', $data);
        return $o;
    }

    public function update_kak($data, $id)
    {
        $this->db->where('id_kak', $id);
        $o = $this->db->update('kak', $data);
        return $o;
    }

// //     public function get_id_nh()
// //     {
// //         return $this->db->query("SELECT id_nh FROM negosiasi_harga ORDER BY id_nh DESC")->row();
// //     }

// //     public function get_id_ns()
// //     {
// //         return $this->db->query("SELECT id_ns FROM negosiasi_spesifikasi ORDER BY id_ns DESC")->row();
// //     }

// //     public function create_nh($data){
// //         return $this->db->insert('negosiasi_harga',$data);
// //     }

// //     public function riwayat_nh($data){
// //         return $this->db->insert('riwayat_nh',$data);
// //     }

// //     public function riwayat_ns($data){
// //         return $this->db->insert('riwayat_ns',$data);
// //     }

// //     public function update_ns($data,$id){
// //         $this->db->where('id_ns',$id);
// //         $o = $this->db->update('riwayat_ns',$data);
// //         return $o;
// //     }

    //Kelola Paket Dikirim
    public function get_negosiasi2($id)
    {
        return $this->db->query("SELECT dokumen,id_paket,nama_paket,tanggal_mulai,tanggal_akhir,SUM(kuantitas) as jumlahproduk,paket.status as status,SUM(kuantitas*harga_ppn) as nominal,no_pr,id_kak FROM keranjang JOIN paket USING(id_paket) JOIN produk USING(id_produk)JOIN kak USING(id_kak) WHERE paket.id_penyedia = $id AND paket.status =5 GROUP BY id_paket")->result();
    }

    public function get_keranjang($id_paket)
    {
        return $this->db->query("SELECT * FROM keranjang
            JOIN produk USING(id_produk)
            WHERE id_paket = " . $this->db->escape($id_paket))->result();
    }

    public function get_detail_kontrak($id_paket, $id_penyedia)
    {
        return $this->db->query("SELECT kak.*, pk.*, pumk.*, penyedia.*, pp.*, CONCAT(paket.id_paket, '/', paket.no_pr) AS no_sp
            FROM paket
            JOIN kak USING(id_kak)
            JOIN pk USING(id_pk)
            JOIN keranjang USING(id_paket)
            JOIN produk USING(id_produk)
            JOIN penyedia ON(penyedia.id_penyedia = produk.id_penyedia)
            JOIN pumk ON(pumk.id_pumk = keranjang.id_pumk)
            JOIN pp ON(pp.id_pp = paket.id_pp)
            WHERE paket.id_paket = " . $this->db->escape($id_paket) . "
            AND produk.id_penyedia = " . $this->db->escape($id_penyedia))->row();
    }

    public function get_invoice($id_paket, $id_penyedia)
    {
        return $this->db->query("SELECT produk.id_penyedia, SUM(keranjang.kuantitas) AS jumlahproduk, SUM(kuantitas*harga) AS total, nama_etalase, paket.status, nama_paket, paket.id_paket, uraian_pekerjaan
            FROM paket
            LEFT JOIN keranjang USING(id_paket)
            JOIN produk USING(id_produk)
            JOIN etalase USING(id_etalase)
            JOIN kak USING(id_kak)
            WHERE paket.id_paket = " . $this->db->escape($id_paket) . "
            AND produk.id_penyedia = " . $this->db->escape($id_penyedia))->row();
    }

    /**
     * Ambil tanggal paket berdasarkan riwayat status
     */
    public function get_tanggal_paket($id_paket, $status)
    {
        $this->db->select('tanggal');
        return $this->db->get_where('riwayat_paket', ['id_paket' => $id_paket, 'status' => $status])->row();
    }

    public function list_produk($id_paket)
    {
        return $this->db->query("SELECT DISTINCT(id_produk),id_produk,nama_produk, no_item,unit_pengukuran, kuantitas 
			FROM produk 
			JOIN keranjang USING(id_produk) 
			JOIN paket USING(id_paket) 
			WHERE id_paket = ".$this->db->escape($id_paket)."
			GROUP BY id_produk")->result();
    }

    //Kelola Paket Selesai
    public function get_negosiasi3($id)
    {
        return $this->db->query("SELECT receipt,id_paket,nama_paket,tanggal_mulai,tanggal_akhir,SUM(kuantitas) as jumlahproduk,paket.status as status,SUM(kuantitas*harga_ppn) as nominal,no_pr,id_kak FROM keranjang JOIN paket USING(id_paket) JOIN produk USING(id_produk)JOIN kak USING(id_kak) WHERE paket.id_penyedia = $id AND paket.status BETWEEN 6 AND 7 GROUP BY id_paket")->result();
    }

    public function get_jumlah_produk($id)
    {
        return $this->db->query("SELECT COUNT(id_produk) as id FROM produk
                                    WHERE id_penyedia = $id")->row();
    }

    public function get_jumlah_negosiasi($id)
    {
        return $this->db->query("SELECT COUNT(id_paket) as id FROM paket WHERE id_penyedia = $id AND status = 2")->row();
    }

    public function get_jumlah_proses($id)
    {
        return $this->db->query("SELECT COUNT(id_paket) as id FROM paket WHERE id_penyedia = $id AND status = 5")->row();
    }

	public function get_jumlah_kirim($id)
    {
        return $this->db->query("SELECT COUNT(id_paket) as id FROM paket WHERE id_penyedia = $id AND status = 6")->row();
    }

    public function get_jumlah_selesai($id)
    {	
    	 return $this->db->query("SELECT COUNT(id_paket) as id FROM paket WHERE id_penyedia = $id AND status =7")->row();
    }

    public function get_produk_new($id)
    {
        return $this->db->query("SELECT * FROM produk WHERE id_penyedia = $id ORDER BY id_produk DESC limit 8")->result();
    }

	public function get_jumlah_pengumuman($id)
	{
		return $this->db->query("SELECT COUNT(id_pengumuman) as id FROM pengumuman WHERE id_user = $id")->row();
	}


}
