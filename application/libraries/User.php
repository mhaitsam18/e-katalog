<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Data User (Deprecated)
 * 
 * Library untuk mengambil data user melalui api
 */
class User 
{
	/**
	 * Object CI
	 * 
	 * @var object
	 */
	private $_CI;

	public function __construct()
	{
		$this->_CI =& get_instance();
	}

	/**
	 * Dapatkan nama user berdasarkan id
	 * 
	 * @param    string|int    $id_user    id_pmuk, id_pbj, atau id_penyedia
	 * 
	 * @return   string
	 */
	public function get_nama($id_user)
	{
		if (empty($id_user)) {
			return '-';
		}

		$this->_CI->load->driver('cache', ['adapter' => 'apc', 'backup' => 'file']);

		if (! $nama = $this->_CI->cache->get('nama_'.$id_user))
		{
			// $client = new \GuzzleHttp\Client();

			// $response = $client->request('post', 'http://localhost/e-katalog/public/', [
			// 	'form_params' => [
			// 		'id_user' => $id_user,
			// 	]
			// ]);

			// if ($response->getStatusCode() != 200) {
			// 	// $this->_CI->alert->warning('Nama user tidak ditemukan');

			// 	return $id_user;
			// }


			// $data = json_decode($response->getBody());

			// $this->_CI->cache->save('nama_'.$id_user, $data['nama'], 60 * 60 * 2);


			// temp
			$this->_CI->cache->save('nama_'.$id_user, $id_user, 60 * 60 * 2);
			return $id_user;
		}

		return $nama;
	}

	/**
	 * Dapatkan data user berdasarkan id
	 * 
	 * @param    string|int    $id_user    id_pmuk, id_pbj, atau id_penyedia
	 * 
	 * @return   string
	 */
	public function get_data($id_user)
	{
		if (empty($id_user)) {
			return '-';
		}
		
		$this->_CI->load->driver('cache');

		if (! $data_user = $this->_CI->cache->get('data_'.$id_user))
		{
			// $client = new \GuzzleHttp\Client();

			// $response = $client->request('post', 'http://localhost/e-katalog/public/', [
			// 	'form_params' => [
			// 		'id_user' => $id_user,
			// 	]
			// ]);

			// if ($response->getStatusCode() != 200) {
			// 	// $this->_CI->alert->warning('data user tidak ditemukan');

			// 	return $id_user;
			// }


			// $data = json_decode($response->getBody());

			// $this->_CI->cache->save('data_'.$id_user, $data['data'], 60 * 60 * 2);


			// temp
			$this->_CI->cache->save('nama_'.$id_user, $id_user, 60 * 60 * 2);
			return $id_user;
		}

		return $data_user;
	}
}
