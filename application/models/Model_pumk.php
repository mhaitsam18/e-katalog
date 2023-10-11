<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Model_pumk extends CI_Model {

	/**
	 * Dapatkan ringkasan data untuk ditampilan di dashboard
	 */
	public function get_summary($id_pumk)
	{
		// jumlah keranjang
		$this->db->where('id_pumk', $id_pumk);
		$this->db->where('id_paket IS NULL');
		$jml_keranjang = $this->db->count_all_results('keranjang');

		// jumlah favorit
		$this->db->where('id_pumk', $id_pumk);
		$jml_favorit = $this->db->count_all_results('favorit');

		// jumlah paket
		$this->db->select('id_paket');
		$this->db->distinct();
		$this->db->where('id_pumk', $id_pumk);
		$this->db->where('id_paket IS NOT NULL');
		$jml_paket = $this->db->count_all_results('keranjang');

		$data = array(
			'jml_keranjang' => $jml_keranjang,
			'jml_favorit'   => $jml_favorit,
			'jml_paket'     => $jml_paket,
		);

		// jumlah paket setiap kategori status
		$kode_status = [
			'pending'   => [0, 1],
			'negosiasi' => [2, 3, 4],
			'kirim'     => [5, 6],
			'selesai'   => [7],
			'batal'     => [8],
		];

		foreach ($kode_status as $nama => $kode) {
			$this->db->select('id_paket');
			$this->db->distinct();
			$this->db->join('paket', 'id_paket');
			$this->db->where('keranjang.id_pumk', $id_pumk);
			$this->db->where_in('status', $kode);
			$data[$nama] = $this->db->count_all_results('keranjang');
		}

		return $data;
	}


	// --------------
	// Keranjang
	// --------------

	public function get_keranjang($id_pumk)
	{
		return $this->db->query("SELECT keranjang.*, nama_produk, harga, foto, id_penyedia, nama_perusahaan
			FROM keranjang
			JOIN produk USING(id_produk)
			JOIN penyedia USING(id_penyedia)
			WHERE id_pumk = ".$this->db->escape($id_pumk).
			"AND id_paket is NULL")->result();
	}

	public function cek_keranjang($id_produk, $id_pumk)
	{
		return $this->db->get_where('keranjang', [
			'id_produk' => $id_produk,
			'id_pumk'   => $id_pumk,
			'id_paket'  => NULL,
		])->row();
	}

	public function create_keranjang($data)
	{
		return $this->db->insert('keranjang',$data);
	}

	public function delete_keranjang($id_produk, $id_pumk)
	{
		$this->db->where('id_produk', $id_produk);
		$this->db->where('id_pumk', $id_pumk);
		$this->db->where('id_paket IS NULL');
		return $this->db->delete('keranjang');
	}

	public function get_keranjang_paket($id_penyedia, $id_pbj)
	{
		return $this->db->query("SELECT SUM(kuantitas*harga) as jumlah FROM keranjang JOIN produk USING(id_produk) WHERE id_pbj = '$id_pbj' AND id_paket is NULL AND id_penyedia = $id_penyedia")->row();
	}

	/**
	 * Update keranjang satu per satu berdasarkan id_produk dan id_user
	 * atau beberapa baris sekaligus
	 */
	public function update_keranjang($data, $id_produk = NULL, $id_pumk = NULL)
	{
		/* Jika $id_produk dan $id_pumk tidak bernilai NULL maka update satu baris keranjang saja */
		if (! is_null($id_produk) && ! is_null($id_pumk)) {
			$this->db->where(['id_produk' => $id_produk, 'id_pumk' => $id_pumk, 'id_paket' => 'NULL']);
			return $this->db->update('keranjang', $data);
		}

		foreach ($data as $d) {
			$this->db->where(['id_produk' => $d['id_produk'], 'id_pumk' => $d['id_pumk'], 'id_paket' => NULL]);
			$this->db->set($d);
			$this->db->update('keranjang', $d);
		}
	}

	/**
	 * Update id_paket pada keranjang
	 */
	public function update_keranjang2($id_paket, $id_pumk, $id_penyedia)
	{
		$id_paket    = $this->db->escape($id_paket);
		$id_pumk     = $this->db->escape($id_pumk);
		$id_penyedia = $this->db->escape($id_penyedia);

		return $this->db->query("UPDATE keranjang JOIN produk USING(id_produk) SET id_paket = $id_paket WHERE keranjang.id_pumk = $id_pumk AND id_paket IS NULL AND produk.id_penyedia = $id_penyedia");
	}


	// --------------
	// Paket
	// --------------

	/**
	 * Buat paket baru.
	 * 
	 * Paket dibuat dengan transaction dan dibuat sebanyak penyedia yang dipilih
	 * 
	 * @param array      $data        data untuk KAK dan id_pp untuk paket
	 * @param string|int $id_pumk     ID PUMK
	 * @param array      $id_penyedia ID Penyedia
	 * @return bool|int
	 */
	public function create_paket($data, $id_pumk, $id_penyedia)
	{
		$this->db->trans_start();

		$this->db->set('nama_paket', $data['nama_paket']);
		$this->db->set('uraian_pekerjaan', $data['uraian_pekerjaan']);
		$this->db->set('ruang_lingkup', $data['ruang_lingkup']);
		$this->db->set('tahun_anggaran', $data['tahun_anggaran']);
		$this->db->set('alamat_kirim', $data['alamat_kirim']);
		$this->db->set('tanggal_mulai', $data['tanggal_mulai']);
		$this->db->set('tanggal_akhir', $data['tanggal_akhir']);
		$this->db->set('id_pk', $data['id_pk']);
		$this->db->set('link', 'UUID()', FALSE);
		$this->db->insert('kak');
		$id_kak = $this->db->insert_id();

		foreach ($id_penyedia as $id_p) {
			$this->db->insert('paket', array('status' => 0, 'id_pp' => $data['id_pp'], 'id_kak' => $id_kak, 'id_penyedia' => $id_p ));
			$id_paket = $this->db->insert_id();
	
			$this->db->query("UPDATE keranjang JOIN produk USING(id_produk) SET id_paket = $id_paket WHERE keranjang.id_pumk = $id_pumk AND id_paket IS NULL AND produk.id_penyedia = $id_p");
		}

		$this->db->trans_complete();

		if ($this->db->trans_status() === FALSE) {
			return FALSE;
		}

		return $id_paket;
	}

	// deprecated
	// public function get_paket_id($id)
	// {
	// 	return $this->db->query("SELECT * FROM paket WHERE id_paket=$id")->row();
	// }

	public function get_paket_full($id_paket, $id_pumk)
	{
		$this->db->select('kak.*, paket.*, id_pumk');
		$this->db->join('kak', 'id_kak');
		$this->db->join('keranjang', 'keranjang.id_paket = paket.id_paket');
		$this->db->where('keranjang.id_pumk', $id_pumk);
		$this->db->where('paket.id_paket', $id_paket);

		return $this->db->get('paket')->row();
	}

	public function get_paket_all($id_pumk)
	{
		return $this->db->query("SELECT DISTINCT id_paket, nama_paket, nama_perusahaan, status 
			FROM keranjang 
			JOIN paket USING(id_paket) 
			JOIN kak USING(id_kak) 
			JOIN penyedia USING(id_penyedia)
			WHERE keranjang.id_pumk = ".$this->db->escape($id_pumk).
			"AND keranjang.id_paket IS NOT NULL")->result();
	}

	public function get_detail_paket($id_pumk, $id_paket)
	{
		$this->db->select('paket.*, keranjang.*, kak.*, pp.nama_pp, pk.nama_pk, penyedia.nama_perusahaan');
		$this->db->join('keranjang', 'id_paket', 'LEFT');
		$this->db->join('pp', 'id_pp');
		$this->db->join('kak', 'id_kak');
		$this->db->join('pk', 'id_pk');
		$this->db->join('penyedia', 'id_penyedia');
		$this->db->where('keranjang.id_pumk', $id_pumk);
		$this->db->where('paket.id_paket', $id_paket);
		return $this->db->get('paket')->row();
	}

	public function get_list_produk_paket($id_pumk, $id_paket)
	{
		$this->db->select('*');
		$this->db->join('produk', 'id_produk');
		$this->db->join('etalase', 'id_etalase');
		$this->db->where('keranjang.id_pumk', $id_pumk);
		$this->db->where('id_paket', $id_paket);
		return $this->db->get('keranjang')->result();
	}

	public function get_riwayat_paket($id_paket)
	{
		return $this->db->query("SELECT riwayat_paket.*, nama_pp FROM riwayat_paket LEFT JOIN pp USING(id_pp) WHERE id_paket = ".$this->db->escape($id_paket))->result();
	}

	public function update_paket($data, $id_paket, $id_pumk)
	{
		$this->db->where('id_paket', $id_paket);
		$this->db->where('keranjang.id_pumk', $id_pumk);
		return $this->db->update('paket JOIN keranjang USING(id_paket)',$data);
	}

	public function update_paket_full($data, $id_paket)
	{
		$this->db->where('id_paket', $id_paket);
		return $this->db->update('paket JOIN kak USING(id_kak)', $data);
	}

	/**
	 * Cek Paket
	 * 
	 * Cek apakah paket dimiliki PUMK tersebut dan masih dalam status bisa di-update
	 * 
	 * @param string|int $id_paket ID Paket
	 * @param string|int $id_pumk  ID PUMK
	 */
	public function cek_update_paket($id_paket, $id_pumk)
	{
		// return $this->db->get_where('keranjang', [
		// 	'id_pumk'  => $id_pumk,
		// 	'id_paket' => $id_paket
		// ])->row();

		$this->db->select('id_paket');
		$this->db->join('keranjang', 'id_paket');
		$this->db->where('id_paket', $id_paket);
		$this->db->where('id_pumk', $id_pumk);
		$this->db->where('status <', 2);
		return $this->db->get('paket')->row();
	}

	// deprecated
	// public function create_pengiriman($data)
	// {
	// 	$this->db->insert('pengiriman',$data);
	// 	return $this->db->insert_id();
	// }

	// deprecated
	// public function update_pengiriman($data,$id)
	// {
	//     $this->db->where('id_pemesanan',$id);
	//     $o = $this->db->update('pengiriman',$data);
	//     return $o;
	// }

	// public function get_paket($id)
	// {
	//     return $this->db->query("SELECT id_produk,nama_produk,harga,kuantitas,foto FROM keranjang JOIN paket USING(id_paket) JOIN produk USING(id_produk) WHERE id_pemesanan = $id")->result();
	// }

	// public function get_subtotal($id)
	// {
	//     return $this->db->query("SELECT SUM(harga*kuantitas) as jumlah FROM keranjang JOIN produk USING(id_produk) WHERE id_paket = $id")->row();
	// }

	// public function create_negoHarga($data)
	// {
	// 	return $this->db->insert('negosiasi_harga',$data);
	// }

	// --------------
	// Favorit
	// --------------
	public function create_favorit($data)
	{
		return $this->db->insert('favorit',$data);
	}

	public function get_favorit($id_pumk)
	{
		return $this->db->query("SELECT * FROM favorit JOIN produk USING(id_produk) WHERE id_pumk = ".$this->db->escape($id_pumk))->result();
	}

	public function delete_favorit($id_pumk, $id_produk)
	{
		$this->db->where('id_pumk', $id_pumk);
		$this->db->where('id_produk', $id_produk);
		return $this->db->delete('favorit');
	}


	// deprecated
	// public function get_etalase_full($id_paket)
	// {
	// 	return $this->db->query("SELECT * FROM paket JOIN keranjang USING(id_paket) JOIN produk USING(id_produk) JOIN etalase USING(id_etalase) WHERE id_paket = $id_paket")->result();
	// }

	// public function get_jumlah_produk($id)
	// {
	// 	return $this->db->query("SELECT COUNT(id_produk) as id FROM keranjang WHERE id_paket = '$id'")->row();
	// }

	// public function get_nego_harga_id($id)
	// {
	// 	return $this->db->query("SELECT negosiasi_harga.nominal as nominal,negosiasi_harga.ongkir as ongkir, negosiasi_harga.tanggal_pengiriman as tanggal_pengiriman, negosiasi_harga.catatan_pembeli as catatan_pembeli, catatan_penyedia,id_paket FROM negosiasi_harga JOIN riwayat_nh USING(id_nh) WHERE id_paket= $id ORDER BY riwayat_nh.id_nh DESC")->row();
	// }

	// deprecated
	// public function get_nego_spesifikasi_id($id)
	// {
	// 	return $this->db->query("SELECT negosiasi_spesifikasi.spesifikasi as spesifikasi,negosiasi_spesifikasi.nilai as nilai,negosiasi_spesifikasi.catatan_pembeli as catatan_pembeli,catatan_penyedia FROM negosiasi_spesifikasi JOIN riwayat_ns USING(id_ns) WHERE id_paket= $id ORDER BY riwayat_ns.id_ns DESC")->row();
	// }

	// deprecated
	// public function create_nh($data){
	// 	return $this->db->insert('negosiasi_harga',$data);
	// }

	// deprecated
	// public function create_ns($data){
	// 	return $this->db->insert('negosiasi_spesifikasi',$data);
	// }

	// deprecated
	// public function update_nh($data,$id){
	// 	$this->db->where('id_paket',$id);
	// 	$o = $this->db->update('negosiasi_harga',$data);
	// 	return $o;
	// }

	// deprecated
	// public function update_ns($data,$id){
	// 	$this->db->where('id_paket',$id);
	// 	$o = $this->db->update('negosiasi_spesifikasi',$data);
	// 	return $o;
	// }

	// deprecated
	// public function get_nego_harga($id)
	// {
	// 	return $this->db->query("SELECT tanggal,aksi,negosiasi_harga.nominal as nominal,riwayat_nh.nominal as nom,negosiasi_harga.ongkir as ongkir,riwayat_nh.ongkir as ongk, negosiasi_harga.tanggal_pengiriman as tanggal_pengiriman, riwayat_nh.tanggal_pengiriman as tgl,negosiasi_harga.catatan_pembeli as catatan_pembeli, catatan_penyedia,id_paket FROM negosiasi_harga JOIN riwayat_nh USING(id_nh) WHERE id_paket= $id ORDER BY riwayat_nh.tanggal ASC")->result();
	// }

	// depreacted
	// public function get_nego_spesifikasi($id)
	// {
	// 	return $this->db->query("SELECT aksi,negosiasi_spesifikasi.spesifikasi as spesifikasi,riwayat_ns.spesifikasi as spek,negosiasi_spesifikasi.nilai as nilai,riwayat_ns.nilai as nilaii,negosiasi_spesifikasi.catatan_pembeli as catatan_pembeli,catatan_penyedia FROM negosiasi_spesifikasi JOIN riwayat_ns USING(id_ns) WHERE id_paket= $id")->result();
	// }

	// --------------
	// Invoice & Kontrak
	// --------------
	public function get_invoice($id_paket, $id_pumk)
	{
		$id_paket = $this->db->escape($id_paket);
		$id_pumk  = $this->db->escape($id_pumk);

		return $this->db->query("SELECT SUM(keranjang.kuantitas) AS jumlahproduk, SUM(kuantitas*harga) AS total, nama_etalase, paket.status, nama_paket, paket.id_paket, uraian_pekerjaan
			FROM paket
            LEFT JOIN keranjang USING(id_paket)
            JOIN produk USING(id_produk)
            JOIN etalase USING(id_etalase)
            JOIN kak USING(id_kak)
			WHERE paket.id_paket = $id_paket
			AND keranjang.id_pumk = $id_pumk")->row();
	}

	public function get_detail_kontrak($id_paket, $id_pumk)
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
			AND keranjang.id_pumk = ".$this->db->escape($id_pumk))->row();
	}

	public function tanggal_pengiriman($id_paket)
	{
		$id_paket = $this->db->escape($id_paket);

		return $this->db->query("SELECT DISTINCT tanggal_mulai
			FROM paket
			JOIN negosiasi_tanggal USING(id_paket)
			WHERE id_paket = $id_paket
			GROUP BY id_paket ")->row();
	}

	/**
	 * Ambil tanggal paket berdasarkan riwayat status
	 */
	public function get_tanggal_paket($id_paket, $status)
	{
		$this->db->select('tanggal');
		return $this->db->get_where('riwayat_paket', ['id_paket' => $id_paket, 'status' => $status])->row();
	}

	public function get_keranjang_kontrak($id_paket)
	{
		return $this->db->query("SELECT * FROM keranjang
			JOIN produk USING(id_produk)
			WHERE id_paket = ".$this->db->escape($id_paket))->result();
	}

	public function get_check_negosiasi($id_paket)
	{
		return $this->db->query("SELECT nominal FROM negosiasi_harga WHERE id_paket = ".$this->db->escape($id_paket))->row();
	}

	public function get_riwayat_nego_harga($id_paket)
    {
        return $this->db->query("SELECT id_paket,tanggal,riwayat_nh.catatan_pembeli as catatan_pembeli,riwayat_nh.catatan_penyedia as catatan_penyedia,riwayat_nh.ongkir as ongkir,riwayat_nh.nominal as nominal FROM riwayat_nh WHERE id_paket = ".$this->db->escape($id_paket))->result();
    }



	// --------------
	// PO
	// --------------

	// deprecated
	// public function create_po($id_paket)
	// {
	// 	$this->db->query('INSERT INTO `po` (id_po, id_paket) VALUE (UUID(), '.$id_paket.')');

	// 	$this->db->select('id_po');
	// 	$po = $this->db->get_where('po', ['id_paket' => $id_paket])->row();

	// 	return $po->id_po;
	// }

	// deprecated
	// public function get_id_po($id_paket, $id_pumk)
	// {
	// 	$this->db->select('id_po');
	// 	$this->db->join('paket', 'id_paket', 'RIGHT');
	// 	$this->db->join('keranjang', 'id_paket', 'RIGHT');
	// 	$this->db->where('keranjang.id_paket', $id_paket);
	// 	$this->db->where('keranjang.id_user', $id_pumk);
	// 	$this->db->limit(1);
	// 	return $this->db->get('po')->row();
	// }

	// deprecated
	// public function get_po($id_po)
	// {
	// 	$this->db->where('id_po', $id_po);
	// 	// alternatif jika where di atas tidak bisa
	// 	// $this->db->escape($id_po);
	// 	// $this->db->where('id_po = UUID_TO_BIN('.$id_po.')');
	// 	return $this->db->get('po')->row();
	// }

	// deprecated
	// public function update_po($id_paket, $data)
	// {
	// 	$this->db->trans_start();

	// 	$this->db->where('id_paket', $id_paket);
	// 	$this->db->set('no_anggaran', $data['no_anggaran']);
	// 	$this->db->set('status', $data['status']);
	// 	$this->db->update('paket');

	// 	$this->db->where('id_paket', $id_paket);
	// 	$this->db->set('no_sp', $data['no_sp']);
	// 	$this->db->update('po');

	// 	$this->db->trans_complete();
	// }

	public function get_pp($id_pumk)
	{
		$this->db->select('pp.id_pp, nama_pp');
		$this->db->join('unit_pp', 'id_pp');
		$this->db->join('unit_pumk', 'kode_unit', 'RIGHT');
		$this->db->where('id_pumk', $id_pumk);
		return $this->db->get('pp')->result();
	}

	public function get_pk($id_pumk)
	{
		$this->db->distinct();
		$this->db->select('id_pk, nama_pk');
		$this->db->join('unit_pk', 'id_pk');
		$this->db->join('unit_pumk', 'kode_unit', 'RIGHT');
		$this->db->where('id_pumk', $id_pumk);
		return $this->db->get('pk')->result();
	}

	// deprecated
	// public function get_jumlah_keranjang($id)
	// {
	//     return $this->db->query("SELECT COUNT(id_produk) as id FROM keranjang JOIN produk USING(id_produk) WHERE id_pbj='$id' AND id_paket IS NULL ORDER BY id_penyedia")->row();
	// }

	// public function get_jumlah_favorit($id)
	// {
	//     return $this->db->query("SELECT COUNT(id_favorit) as id FROM favorit WHERE id_pbj = '$id'")->row();
	// }

	// public function get_jumlah_paket($id)
	// {
	//     return $this->db->query("SELECT COUNT(id_paket) as id FROM keranjang WHERE id_pbj = '$id'")->row();
	// }

	// public function get_jumlah_paket_pending($id)
	// {
	//     return $this->db->query("SELECT COUNT(id_paket) as id FROM keranjang JOIN paket USING(id_paket) WHERE id_pbj = '$id' AND status = 0")->row();
	// }

	// public function get_jumlah_paket_negosiasi($id)
	// {
	//     return $this->db->query("SELECT COUNT(id_paket) as id FROM keranjang JOIN paket USING(id_paket) WHERE id_pbj = '$id' AND status = 2 OR status =3 OR status = 3 OR status = 4 OR status = 5")->row();
	// }

	// public function get_jumlah_paket_kirim($id)
	// {
	//     return $this->db->query("SELECT COUNT(id_paket) as id FROM keranjang JOIN paket USING(id_paket) WHERE id_pbj = '$id' AND status = 7")->row();
	// }

	// public function get_jumlah_paket_selesai($id)
	// {
	//     return $this->db->query("SELECT COUNT(id_paket) as id FROM keranjang JOIN paket USING(id_paket) WHERE id_pbj = '$id' AND status = 8")->row();
	// }

	// public function get_ppk()
	// {
	// 	return $this->db->get('dummy_ppk')->result();
	// }
}
