<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Model_api extends CI_Model {

	public function insert_penyedia($datas)
	{
		$this->db->trans_start();

		foreach ($datas as $data) {
			if (empty($data['email']) || empty($data['password'])) return FALSE;
			
			$id_user_baru = $this->_insert_user('penyedia', $data['email'], $data['password']);

			$data_penyedia = [
				'id_penyedia' => $id_user_baru,
				'nama_penyedia' => $data['nama'] ?? NULL,
				'alamat_penyedia' => $data['alamat'] ?? NULL,
				'nama_perusahaan' => $data['nama_perusahaan'] ?? NULL,
				'bank' => $data['bank'] ?? NULL,
				'norek' => $data['no_rek'] ?? NULL,
			];

			$this->db->insert('penyedia', $data_penyedia);
		}

		return $this->db->trans_complete();
	}

	public function update_penyedia($datas)
	{
		$this->db->trans_start();

		foreach ($datas as $data) {

			if (! empty($data['password'])) {
				$this->db->set('password', password_hash($data['password'], PASSWORD_DEFAULT));
				$this->db->where('email', $data['email']);
				$this->db->update('user');
			}


			$data_penyedia = [];

			if (! empty($data['nama'])) $data_penyedia['nama_penyedia'] = $data['nama'];
			if (! empty($data['alamat'])) $data_penyedia['alamat_penyedia'] = $data['alamat'];
			if (! empty($data['nama_perusahaan'])) $data_penyedia['nama_perusahaan'] = $data['nama_perusahaan'];
			if (! empty($data['bank'])) $data_penyedia['bank'] = $data['bank'];
			if (! empty($data['no_rek'])) $data_penyedia['norek'] = $data['no_rek'];

			if (! empty($data_penyedia)) {
				$this->db->where('email', $data['email']);
				$this->db->update('penyedia JOIN user ON(user.id_user = penyedia.id_penyedia)', $data_penyedia);
			}
		}

		return $this->db->trans_complete();
	}

	public function insert_pumk($datas)
	{
		$this->db->trans_start();

		foreach ($datas as $data) {
			if (empty($data['email']) || 
				empty($data['password']) ||
				empty($data['nama']) ||
				empty($data['alamat']) ||
				empty($data['jabatan']) ||
				empty($data['kode_unit']))
			return FALSE;
			
			$id_user_baru = $this->_insert_user('pumk', $data['email'], $data['password']);

			$data_pumk = [
				'id_pumk' => $id_user_baru,
				'nama_pumk' => $data['nama'],
				'alamat_pumk' => $data['alamat'],
				'jabatan_pumk' => $data['jabatan'],
			];

			$this->db->insert('pumk', $data_pumk);

			$data_unit = [];
			foreach ($data['kode_unit'] as $kode_unit) {
				$data_unit[] = [
					'id_pumk' => $id_user_baru,
					'kode_unit' => $kode_unit,
				];
			}

			$this->db->insert_batch('unit_pumk', $data_unit);
		}

		return $this->db->trans_complete();
	}

	public function update_pumk($datas)
	{
		$this->db->trans_start();

		foreach ($datas as $data) {
			if (empty($data['email'])) return FALSE;

			if (! empty($data['password'])) {
				$this->db->set('password', password_hash($data['password'], PASSWORD_DEFAULT));
				$this->db->where('email', $data['email']);
				$this->db->update('user');
			}


			$data_pumk = [];

			if (! empty($data['nama'])) $data_pumk['nama_pumk'] = $data['nama'];
			if (! empty($data['alamat'])) $data_pumk['alamat_pumk'] = $data['alamat'];
			if (! empty($data['jabatan'])) $data_pumk['jabatan_pumk'] = $data['jabatan'];

			if (! empty($data_pumk)) {
				$this->db->where('email', $data['email']);
				$this->db->update('pumk JOIN user ON(user.id_user = pumk.id_pumk)', $data_pumk);
			}


			if (! empty($data['kode_unit'])) {
				$this->db->select('id_pumk');
				$this->db->join('user', 'user.id_user = pumk.id_pumk');
				$query = $this->db->get_where('pumk', ['email' => $data['email']])->row();

				$id_pumk = $query->id_pumk;

				$this->db->query('DELETE unit_pumk FROM unit_pumk 
					JOIN pumk USING(id_pumk) 
					JOIN user ON(user.id_user = pumk.id_pumk) 
					WHERE email = '.$this->db->escape($data['email']));

				$data_unit = [];

				foreach ($data['kode_unit'] as $kode_unit) {
					$data_unit[] = [
						'id_pumk' => $id_pumk,
						'kode_unit' => $kode_unit,
					];
				}

				$this->db->insert_batch('unit_pumk', $data_unit);
			}
		}

		return $this->db->trans_complete();
	}

	public function insert_pp($datas)
	{
		$this->db->trans_start();

		foreach ($datas as $data) {
			if (empty($data['email']) || 
				empty($data['password']) ||
				empty($data['nama']) ||
				empty($data['jabatan']) ||
				empty($data['kode_unit']))
			return FALSE;
			
			$id_user_baru = $this->_insert_user('pp', $data['email'], $data['password']);

			$data_pp = [
				'id_pp' => $id_user_baru,
				'nama_pp' => $data['nama'],
				'jabatan_pp' => $data['jabatan'],
			];

			$this->db->insert('pp', $data_pp);

			$data_unit = [];
			foreach ($data['kode_unit'] as $kode_unit) {
				$data_unit[] = [
					'id_pp' => $id_user_baru,
					'kode_unit' => $kode_unit,
				];
			}

			$this->db->insert_batch('unit_pp', $data_unit);
		}

		return $this->db->trans_complete();
	}

	public function update_pp($datas)
	{
		$this->db->trans_start();

		foreach ($datas as $data) {
			if (empty($data['email'])) return FALSE;

			if (! empty($data['password'])) {
				$this->db->set('password', password_hash($data['password'], PASSWORD_DEFAULT));
				$this->db->where('email', $data['email']);
				$this->db->update('user');
			}


			$data_pp = [];

			if (! empty($data['nama'])) $data_pp['nama_pp'] = $data['nama'];
			if (! empty($data['jabatan'])) $data_pp['jabatan_pp'] = $data['jabatan'];

			if (! empty($data_pp)) {
				$this->db->where('email', $data['email']);
				$this->db->update('pp JOIN user ON(user.id_user = pp.id_pp)', $data_pp);
			}


			if (! empty($data['kode_unit'])) {
				$this->db->select('id_pp');
				$this->db->join('user', 'user.id_user = pp.id_pp');
				$query = $this->db->get_where('pp', ['email' => $data['email']])->row();

				$id_pp = $query->id_pp;

				$this->db->query('DELETE unit_pp FROM unit_pp 
					JOIN pp USING(id_pp) 
					JOIN user ON(user.id_user = pp.id_pp) 
					WHERE email = '.$this->db->escape($data['email']));

				$data_unit = [];

				foreach ($data['kode_unit'] as $kode_unit) {
					$data_unit[] = [
						'id_pp' => $id_pp,
						'kode_unit' => $kode_unit,
					];
				}

				$this->db->insert_batch('unit_pp', $data_unit);
			}
		}

		return $this->db->trans_complete();
	}

	public function insert_admin($datas)
	{
		$this->db->trans_start();

		foreach ($datas as $data) {
			if (empty($data['email']) || 
				empty($data['password']) ||
				empty($data['nama']) ||
				empty($data['jabatan']))
			return FALSE;
			
			$id_user_baru = $this->_insert_user('admin', $data['email'], $data['password']);

			$data_admin = [
				'id_admin' => $id_user_baru,
				'nama_admin' => $data['nama'],
				'jabatan_admin' => $data['jabatan'],
			];

			$this->db->insert('admin', $data_admin);
		}

		return $this->db->trans_complete();
	}

	public function update_admin($datas)
	{
		$this->db->trans_start();

		foreach ($datas as $data) {
			if (empty($data['email'])) return FALSE;

			if (! empty($data['password'])) {
				$this->db->set('password', password_hash($data['password'], PASSWORD_DEFAULT));
				$this->db->where('email', $data['email']);
				$this->db->update('user');
			}


			$data_admin = [];

			if (! empty($data['nama'])) $data_admin['nama_admin'] = $data['nama'];
			if (! empty($data['jabatan'])) $data_admin['jabatan_admin'] = $data['jabatan'];

			if (! empty($data_admin)) {
				$this->db->where('email', $data['email']);
				$this->db->update('admin JOIN user ON(user.id_user = admin.id_admin)', $data_admin);
			}
		}

		return $this->db->trans_complete();
	}

	public function insert_pk($datas)
	{
		$this->db->trans_start();

		foreach ($datas as $data) {
			if (empty($data['nama']) ||
				empty($data['nip']) ||
				empty($data['kode_unit']))
			return FALSE;
			
			$data_pk = [
				'nama_pk' => $data['nama'],
				'nip' => $data['nip'],
			];

			$this->db->insert('pk', $data_pk);
			$id_user_baru = $this->db->insert_id();

			$data_unit = [];
			foreach ($data['kode_unit'] as $kode_unit) {
				$data_unit[] = [
					'id_pk' => $id_user_baru,
					'kode_unit' => $kode_unit,
				];
			}

			$this->db->insert_batch('unit_pk', $data_unit);
		}

		return $this->db->trans_complete();
	}

	public function update_pk($datas)
	{
		$this->db->trans_start();

		foreach ($datas as $data) {
			if (empty($data['nip']))
			return FALSE;

			$data_pk = [];

			if (! empty($data['nama'])) $data_pk['nama_pk'] = $data['nama'];

			if (! empty($data_pk)) {
				$this->db->where('nip', $data['nip']);
				$this->db->update('pk', $data_pk);
			}


			if (! empty($data['kode_unit'])) {
				$this->db->select('id_pk');
				$query = $this->db->get_where('pk', ['nip' => $data['nip']])->row();

				$id_pk = $query->id_pk;

				$this->db->query('DELETE unit_pk FROM unit_pk
					JOIN pk USING(id_pk)
					WHERE nip = '.$this->db->escape($data['nip']));

				$data_unit = [];

				foreach ($data['kode_unit'] as $kode_unit) {
					$data_unit[] = [
						'id_pk' => $id_pk,
						'kode_unit' => $kode_unit,
					];
				}

				$this->db->insert_batch('unit_pk', $data_unit);
			}
		}

		return $this->db->trans_complete();
	}

	
	private function _insert_user($level, $email, $password)
	{
		$data_user = [
			'email'    => $email,
			'password' => password_hash($password, PASSWORD_DEFAULT),
			'level'    => $level,
		];

		$this->db->insert('user', $data_user);
		return $this->db->insert_id();
	}
}
