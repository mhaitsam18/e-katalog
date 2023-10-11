<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Model_pp extends CI_Model {

	public function get_paket($id)
    {
        return $this->db->query("SELECT link,id_paket,nama_paket,tanggal_mulai,tanggal_akhir,SUM(kuantitas) as jumlahproduk,paket.status as status,SUM(kuantitas*harga_ppn) as nominal,no_pr,id_kak,nama_perusahaan FROM keranjang JOIN paket USING(id_paket) JOIN produk USING(id_produk)JOIN kak USING(id_kak) JOIN penyedia ON(penyedia.id_penyedia = paket.id_penyedia) WHERE id_pp = $id AND paket.status =1 GROUP BY id_paket, produk.id_penyedia")->result();
    }

	public function get_kak($id)
    {
        return $this->db->query("SELECT * FROM kak JOIN paket USING(id_kak) JOIN pk USING(id_pk) WHERE id_paket=$id")->row();
    }

	public function get_pp($id)
	{
		return $this->db->query("SELECT * FROM pp JOIN unit_pp USING(id_pp) WHERE id_pp=$id")->row();
	}

	public function get_pk($id,$id_pk)
	{
		return $this->db->query("SELECT * FROM pk JOIN unit_pk USING(id_pk) WHERE kode_unit=$id AND id_pk!=$id_pk")->result();
	}

	public function get_paket_kak($id,$id_paket)
    {
        return $this->db->query("SELECT id_paket,nama_paket FROM kak JOIN paket USING(id_kak) WHERE id_kak=$id AND id_paket!=$id_paket")->result();
    }

	public function update_paket_kak($data,$id){
        $this->db->where('id_paket',$id);
        $o = $this->db->update('paket',$data);
        return $o;
    }

	public function update_kak($data,$id){
        $this->db->where('id_kak',$id);
        $o = $this->db->update('kak',$data);
        return $o;
    }

	public function get_negosiasi_id($id)
    {
			return $this->db->query("SELECT link,receipt,dokumen,id_kak,SUM(harga_ppn*kuantitas) as nominal,unit_pengukuran,id_paket, status, tanggal_mulai,tanggal_akhir, SUM(kuantitas) as jumlahproduk,SUM(harga*kuantitas) as total, no_pr,uraian_pekerjaan, SUM(kuantitas*harga) as total, alamat_kirim,nama_paket, no_pr, id_keranjang
										FROM paket JOIN keranjang USING(id_paket) JOIN produk USING(id_produk) JOIN kak USING(id_kak)
										WHERE id_paket = '$id'")->row();
    }

	public function get_paket_id($id)
    {
        return $this->db->query("SELECT id_keranjang,no_item,id_produk,nama_produk,kuantitas,harga,(kuantitas*harga) as total,foto, unit_pengukuran,merek,no_produk_penyedia,masa_berlaku,deskripsi FROM produk JOIN keranjang USING(id_produk) WHERE id_paket = '$id'")->result();
    }

	public function get_paket_nego_id($id)
    {
        return $this->db->query("SELECT id_keranjang,id_produk,nama_produk,kuantitas,harga,nominal,foto,unit_pengukuran,catatan_penyedia FROM produk JOIN keranjang USING(id_produk) JOIN negosiasi_harga USING(id_keranjang) WHERE id_paket = '$id'")->result();
    }

	public function get_subtotal_id($id)
    {
        return $this->db->query("SELECT SUM(kuantitas*harga) as total FROM produk JOIN keranjang USING(id_produk) WHERE id_paket = $id GROUP BY id_paket")->row();
    }

	public function get_subtotal_nego_id($id)
    {
        return $this->db->query("SELECT * FROM riwayat_nh WHERE id_paket = $id ORDER BY tanggal DESC")->row();
    }

	public function get_paket_ditolak($id)
    {
        return $this->db->query("SELECT id_paket,nama_paket,tanggal_mulai,tanggal_akhir,SUM(kuantitas) as jumlahproduk,paket.status as status,SUM(kuantitas*harga_ppn) as nominal,no_pr,id_kak FROM keranjang JOIN paket USING(id_paket) JOIN produk USING(id_produk)JOIN kak USING(id_kak) WHERE id_pp = $id AND paket.status =8 GROUP BY id_paket, produk.id_penyedia")->result();
    }

	//  public function get_negosiasi_harga($id)
    // {
    //     return $this->db->query("SELECT * FROM riwayat_nh WHERE id_paket = '$id' ORDER BY tanggal DESC")->row();
    // }

    public function get_negosiasi_spesifikasi($id)
    {
        return $this->db->query("SELECT * FROM negosiasi_spesifikasi WHERE id_paket = '$id'")->row();
    }

    public function get_negosiasi_tanggal($id)
    {
        return $this->db->query("SELECT * FROM negosiasi_tanggal WHERE id_paket = '$id'")->row();
    }

	public function get_paket_negosiasi($id)
    {
        return $this->db->query("SELECT id_paket,nama_paket,tanggal_mulai,tanggal_akhir,SUM(kuantitas) as jumlahproduk,paket.status as status,SUM(kuantitas*harga_ppn) as nominal,no_pr,id_kak FROM keranjang JOIN paket USING(id_paket) JOIN produk USING(id_produk)JOIN kak USING(id_kak) WHERE id_pp = $id AND paket.status BETWEEN 2 AND 3 GROUP BY id_paket")->result();
    }

    public function get_paket_negosiasi2($id)
    {
        return $this->db->query("SELECT id_paket,nama_paket,tanggal_mulai,tanggal_akhir,SUM(kuantitas) as jumlahproduk,paket.status as status,SUM(kuantitas*harga_ppn) as nominal,no_pr,id_kak FROM keranjang JOIN paket USING(id_paket) JOIN produk USING(id_produk)JOIN kak USING(id_kak) WHERE id_pp = $id AND paket.status =4 GROUP BY id_paket")->result();
    }

	public function get_paket_diproses($id)
    {   
        return $this->db->query("SELECT dokumen,paket.id_pp,paket.id_paket,nama_paket,tanggal_mulai,tanggal_akhir,SUM(kuantitas) as jumlahproduk,paket.status as status,SUM(kuantitas*harga_ppn) as nominal,no_pr FROM keranjang JOIN paket ON(keranjang.id_paket = paket.id_paket) JOIN produk ON(produk.id_produk = keranjang.id_produk) JOIN kak ON(kak.id_kak = paket.id_kak) WHERE paket.id_pp = $id AND paket.status BETWEEN 5 AND 6 GROUP BY paket.id_paket")->result();
    }

    public function get_paket_dikirim($id)
    {   
        return $this->db->query("SELECT id_paket,nama_paket,tanggal_mulai,tanggal_akhir,SUM(kuantitas) as jumlahproduk,paket.status as status,SUM(kuantitas*harga_ppn) as nominal,no_pr,id_kak FROM keranjang JOIN paket USING(id_paket) JOIN produk USING(id_produk)JOIN kak USING(id_kak) WHERE id_pp = $id AND paket.status =6 GROUP BY id_paket")->result();
    }


    public function get_paket_selesai($id)
    {   
        return $this->db->query("SELECT dokumen,receipt,id_paket,nama_paket,tanggal_mulai,tanggal_akhir,SUM(kuantitas) as jumlahproduk,paket.status as status,SUM(kuantitas*harga_ppn) as nominal,no_pr,id_kak FROM keranjang JOIN paket USING(id_paket) JOIN produk USING(id_produk)JOIN kak USING(id_kak) WHERE id_pp = $id AND paket.status = 7 GROUP BY id_paket")->result();
    }

	public function get_jumlah($id)
	{
		return $this->db->query("SELECT COUNT(id_keranjang) as jumlah FROM keranjang JOIN paket USING(id_paket) JOIN produk USING(id_produk)JOIN kak USING(id_kak) WHERE id_paket = $id GROUP BY id_paket, produk.id_penyedia")->row();
	}

//     public function get_pengumuman($id)
//     {
//         return $this->db->query("SELECT * FROM pengumuman JOIN etalase USING(id_etalase) WHERE id_user = '$id'")->result();
//     }
    
//     public function get_pengumuman2($id)
//     {
//         return $this->db->query("SELECT * FROM pengumuman JOIN etalase USING(id_etalase) WHERE id_pengumuman = '$id'")->row();
//     }

//     public function create_pengumuman($data){
// 		return $this->db->insert('pengumuman',$data);
// 	}

	public function create_keranjang($data){
		return $this->db->insert('keranjang',$data);
	}

	public function create_paket($data){
		return $this->db->insert('paket',$data);
	}

    public function create_nh($data){
		return $this->db->insert('negosiasi_harga',$data);
	}

	public function create_riwayat_nh($data){
		return $this->db->insert('riwayat_nh',$data);
	}

    public function update_paket($data,$id){
        $this->db->where('id_paket',$id);
        $o = $this->db->update('paket',$data);
        return $o;
    }

	public function update_nh($data,$id){
        $this->db->where('id_keranjang',$id);
        $o = $this->db->update('negosiasi_harga',$data);
        return $o;
    }

    public function create_ns($data){
		return $this->db->insert('negosiasi_spesifikasi',$data);
	}

    public function create_nt($data){
		return $this->db->insert('negosiasi_tanggal',$data);
	}

	public function update_keranjang($data,$id){
        $this->db->where('id_keranjang',$id);
        $o = $this->db->update('keranjang',$data);
        return $o;
    }

	public function cekProduk($id)
	{
		return $this->db->query("SELECT * FROM produk WHERE id_produk = $id")->row();
	}

	public function cekPaket($id)
	{
		return $this->db->query("SELECT * FROM paket WHERE id_paket = $id")->row();
	}

	public function cekKeranjang($id)
	{
		return $this->db->query("SELECT * FROM keranjang JOIN produk USING(id_produk) WHERE id_keranjang = $id")->row();
	}

	public function get_id_paket()
	{
		return $this->db->query("SELECT id_paket FROM paket ORDER BY id_paket DESC")->row();
	}

//     public function delete_pengumuman($id)
//     {
//         $this->db->where('id_pengumuman',$id);
// 		return $this->db->delete('pengumuman');
//     }

	public function delete_keranjang($id)
    {
        $this->db->where('id_keranjang',$id);
		return $this->db->delete('negosiasi_harga');
    }

	public function delete_paket($id)
    {
        $this->db->where('id_keranjang',$id);
		return $this->db->delete('paket');
    }
    
//     public function get_produk_etalase()
//     {
//         return $this->db->query('SELECT * FROM kategori_etalase JOIN etalase USING(id_ke)')->result();
//     }

//     public function get_merek($id)
//     {
//         return $this->db->query("SELECT * FROM merek JOIN etalase USING(id_etalase) WHERE id_pengumuman = '$id'")->result();
//     }

//     public function create_merek($data){
// 		return $this->db->insert('merek',$data);
// 	}

//     public function delete_merek($id)
//     {
//         $this->db->where('id_pengumuman',$id);
// 		return $this->db->delete('merek');
//     }

//     public function delete_merek2($id)
//     {
//         $this->db->where('id_merek',$id);
// 		return $this->db->delete('merek');
//     }

//     public function get_tahapan($id)
//     {
//         return $this->db->query("SELECT * FROM tahapan_pengumuman WHERE id_pengumuman = '$id'")->result();
//     }

//     public function create_tahapan($data){
// 		return $this->db->insert('tahapan_pengumuman',$data);
// 	}

//     public function delete_tahapan($id)
//     {
//         $this->db->where('id_pengumuman',$id);
// 		return $this->db->delete('tahapan_pengumuman');
//     }

//     public function delete_tahapan2($id)
//     {
//         $this->db->where('id_tp',$id);
// 		return $this->db->delete('tahapan_pengumuman');
//     }

//     public function get_paket_po_id($id_paket)
// 	{
// 		return $this->db->query("SELECT * FROM paket JOIN pengiriman USING(id_paket) JOIN po USING(id_paket)
// 			WHERE id_paket = ".$this->db->escape($id_paket)." ORDER BY id_po DESC limit 1")->row();
// 	}
        

    public function get_riwayat_paket($id)
    {
        return $this->db->query("SELECT * FROM riwayat_paket WHERE id_paket = '$id' AND status IS NOT NULL ORDER BY tanggal DESC")->result();
    }

    public function get_riwayat_nego_harga($id)
    {
        return $this->db->query("SELECT * FROM riwayat_nh WHERE id_paket = '$id' ORDER BY tanggal DESC")->result();
    }

    public function get_riwayat_nego_spesifikasi($id)
    {
        return $this->db->query("SELECT riwayat_ns.id_ns as id_ns,aksi,tanggal,riwayat_ns.catatan_pembeli as catatan_pembeli,riwayat_ns.catatan_penyedia as catatan_penyedia,id_paket FROM riwayat_ns LEFT JOIN negosiasi_spesifikasi ON(negosiasi_spesifikasi.id_ns = riwayat_ns.id_ns) WHERE id_paket = $id GROUP BY tanggal ORDER BY tanggal DESC")->result();
    }

//     public function get_check_negosiasi($id)
//     {
//         return $this->db->query("SELECT * FROM paket JOIN negosiasi_harga USING(id_paket) WHERE id_paket = $id ")->row();
//     }

//   public function get_invoice($id)
//     {
//         return $this->db->query("SELECT SUM(keranjang.kuantitas) AS jumlahproduk, SUM(kuantitas*harga) AS total, nama_etalase, paket.status, nama_paket, paket.id_paket, uraian_pekerjaan 
//             FROM paket 
//             LEFT JOIN keranjang USING(id_paket) 
//             JOIN produk USING(id_produk) 
//             JOIN etalase USING(id_etalase) 
//             JOIN po USING(id_paket)
//             WHERE paket.id_paket = ".$this->db->escape($id))->row();
//     }

// 	public function get_detail_kontrak($id_produk)
//     {
//         return $this->db->query("SELECT po.*, pk.*, pumk.*, penyedia.*, pp.*
//             FROM po 
//             JOIN paket USING(id_paket) 
//             JOIN pk USING(id_pk) 
//             JOIN keranjang USING(id_paket) 
//             JOIN produk USING(id_produk) 
//             JOIN penyedia ON(penyedia.id_user = produk.id_user) 
//             JOIN pumk ON(pumk.id_user = keranjang.id_user) 
//             JOIN pp ON(pp.id_user = paket.id_user) 
//             WHERE id_paket = ".$this->db->escape($id_produk))->row();
//     }

//     public function tanggal_pengiriman($id)
//     {
//         return $this->db->query("SELECT DISTINCT tanggal_pengiriman FROM paket JOIN negosiasi_harga USING(id_paket)
//         WHERE id_paket = $id GROUP BY id_paket ")->row();
//     }

// 	public function get_keranjang($id_paket)
// 	{
// 		return $this->db->query("SELECT * FROM keranjang
// 			JOIN produk USING(id_produk)
// 			WHERE id_paket = ".$this->db->escape($id_paket))->result();
// 	}

// 	 /**
//      * Ambil tanggal paket berdasarkan riwayat status
//      */
//     public function get_tanggal_paket($id_paket, $status)
//     {
//         $this->db->select('tanggal');
//         return $this->db->get_where('riwayat_paket', ['id_paket' => $id_paket, 'status' => $status])->row();
//     }

//     public function get_jumlah($id)
//     {
//         return $this->db->query("SELECT id_paket FROM paket WHERE status = $id")->result();
//     }

//     public function get_jumlah_total($id,$idd)
//     {
//         return $this->db->query("SELECT COUNT(id_paket) as id FROM paket WHERE id_paket = $idd AND paket.id_user = $id")->row();
//     }

    public function get_jumlah_baru($id)
    {
        return $this->db->query("SELECT COUNT(id_paket) as id FROM paket WHERE id_pp = $id AND paket.status =1")->row();
    }

    public function get_jumlah_negosiasi($id)
    {
        return $this->db->query("SELECT COUNT(id_paket) as id FROM paket WHERE id_pp = $id AND paket.status BETWEEN 2 AND 3")->row();
    }

    public function get_jumlah_review($id)
    {
        return $this->db->query("SELECT COUNT(id_paket) as id FROM paket WHERE id_pp = $id AND paket.status =4")->row();
    }

    public function get_jumlah_kirim($id)
    {
        return $this->db->query("SELECT COUNT(id_paket) as id FROM paket WHERE id_pp = $id AND paket.status BETWEEN 5 AND 6")->row();
    }

    public function get_jumlah_selesai($id)
    {
        return $this->db->query("SELECT COUNT(id_paket) as id FROM paket WHERE id_pp = $id AND paket.status =7")->row();
    }

    public function get_jumlah_tolak($id)
    {
        return $this->db->query("SELECT COUNT(id_paket) as id FROM paket WHERE id_pp = $id AND paket.status =8")->row();
    }

    public function get_update_nego($id)
    {
        return $this->db->query("SELECT paket.id_paket as id_paket,negosiasi_harga.nominal as nominal,negosiasi_harga.catatan_penyedia as catatan,paket.status as status FROM paket JOIN keranjang USING(id_paket) JOIN negosiasi_harga USING(id_keranjang) WHERE status BETWEEN 3 AND 4 ")->result();
    }

    public function update_ns($data,$id){
        $this->db->where('id_paket',$id);
        $o = $this->db->update('negosiasi_spesifikasi',$data);
        return $o;
    }

    public function update_nt($data,$id){
        $this->db->where('id_paket',$id);
        $o = $this->db->update('negosiasi_tanggal',$data);
        return $o;
    }

	public function get_compare($id,$harga,$id_produk){
		return $this->db->query("SELECT * FROM produk WHERE no_item=$id AND id_produk!=$id_produk AND harga<$harga limit 3 ")->result();
	}
}

?>
