<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Firebase\JWT\SignatureInvalidException;

class Api extends CI_Controller
{
	/**
	 * Data request yang sudah dikonversi menjadi array associative
	 *
	 * @var array
	 */
	private $_datas;

	/**
	 * Insert user baru
	 * 
	 * @param    string    $user    Jenis/level user
	 */
	public function store(string $user)
	{
		if (! $this->_is_request_valid()) return;

		$this->load->model('Model_api');
		$result = $this->Model_api->{"insert_".$user}($this->_datas);

		if (! $result) {
			return $this->output->set_status_header(500);
		}

		$this->output
			->set_content_type('application/json')
			->set_output(json_encode(['status' => 'Ok']));
	}

	/**
	 * Update user yang sudah ada
	 * 
	 * @param    string    $user    Jenis/level user
	 */
	public function update(string $user)
	{
		if (! $this->_is_request_valid()) return;

		$this->load->model('Model_api');
		$result = $this->Model_api->{"update_".$user}($this->_datas);

		if (! $result) {
			return $this->output->set_status_header(500);
		}


		$this->output
			->set_content_type('application/json')
			->set_output(json_encode(['status' => 'Ok']));
	}


	private function _is_request_valid()
	{
		if ($this->input->method() === 'get') show_404();


		$auth_header = $this->input->get_request_header('Authorization');

		if (empty($auth_header)) {
			$this->output->set_status_header(401);

			return FALSE;
		}


		$token = substr($auth_header, 7);
		// $key   = $this->config->item('api_key');
		$key   = '656b6174616c6f67417070313233';


		try {
			JWT::decode($token, new Key($key, 'HS256'));
		} catch (SignatureInvalidException $e) {
			$this->output->set_status_header(401);

			return FALSE;
		}


		$data_json    = $this->input->raw_input_stream;
		$this->_datas = json_decode($data_json, TRUE);

		if (json_last_error() !== JSON_ERROR_NONE) {
			$this->output->set_status_header(422);

			return FALSE;
		}

		return TRUE;
	}
}
