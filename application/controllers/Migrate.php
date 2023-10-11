<?php

class Migrate extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		
		if (ENVIRONMENT !== 'development') show_404();
	}

	public function index()
	{
		$this->load->library('migration');

		if ($this->migration->latest() === FALSE) {
			show_error($this->migration->error_string());
		}
	}

	public function rollback()
	{
		$this->load->library('migration');

		$current_version = $this->_get_version();
		$version = $current_version - 1;

		if ($current_version == '0') {
			$this->db->query('DROP TABLE IF EXISTS migrations');
			$this->db->query('CREATE TABLE migrations(version INT)');
			$this->db->insert('migrations', ['version' => '1']);

			$version = 0;
		}

		if ($this->migration->version($version) === FALSE) {
			show_error($this->migration->error_string());
		}
	}

	private function _get_version()
	{
		$row = $this->db->select('version')->get('migrations')->row();
		return $row ? $row->version : '0';
	}
}
