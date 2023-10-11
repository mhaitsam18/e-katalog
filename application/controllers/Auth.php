<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller
{
	public function login()
	{
		if ($this->input->method() !== 'post') {
			return $this->load->view('landingpage/login');
		}

		// --------------
		// Proses validasi
		// --------------

		$this->load->library('form_validation');

		$this->form_validation->set_rules('email', 'Email', 'required|valid_email');
		$this->form_validation->set_rules('password', 'Password', 'required');
		// $this->form_validation->set_rules('jenis', 'Login Sebagai', 'required|in_list[pumk,pp,penyedia,admin]');

		if ( ! $this->form_validation->run()) {
			$this->alert->danger(validation_errors());

			redirect('login');
		}

		$this->load->model('Model_index');

		$email    = $this->input->post('email');
		$password = $this->input->post('password');

		$user = $this->Model_index->get_user($email);

		if ( ! password_verify($password, $user->password ?? '')) {
			$this->alert->danger('Email atau Password kurang tepat');

			redirect('login');
		}


		$data_user = $this->Model_index->get_nama_user($user->id_user, $user->level);

		$session          = $data_user;
		$session['login'] = 1;
		$session['level'] = $user->level;
		$session['id']    = $user->id_user;

		$this->session->set_userdata($session);


		switch ($user->level) {
			case 'admin':
				redirect('Admin');
				break;

			case 'penyedia':
				redirect('Penyedia');
				break;

			case 'pumk':
				redirect('PUMK');
				break;

			case 'pp':
				redirect('PP');
				break;

			default:
				redirect('login');
				break;
		}
	}

	public function logout()
	{
		if ($this->input->method() !== 'post') {
			show_404();
		}

		session_destroy();
		setcookie($this->config->item('sess_cookie_name'), null, time() - $this->config->item('sess_expiration'));

		redirect('login');
	}
}
