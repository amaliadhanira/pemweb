<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller{

	function __construct(){
		parent::__construct();
		$this->load->model('m_login');
	}

	function index(){
		$data['title'] = 'Login Klinik 4002';
		$this->load->view('v_login', $data);
	}

	function auth(){
		$username = $this->input->post('username');
		$password = $this->input->post('password');

		if($this->m_login->auth_pasien($username, $password)){
			$session_data = array(
				'username' => $username,
				'level' => 'pasien',
				'status' => 'login_pasien'
			);

			$this->session->set_userdata($session_data);
			redirect('/klinik');

		}else if($this->m_login->auth_admin($username, $password)){
			$session_data = array(
				'username' => $username,
				'level' => 'admin',
				'status' => 'login_admin'
			);

			$this->session->set_userdata($session_data);
			redirect('admin/adminpage');
		} else {
			$data['error_msg'] = $this->session->set_flashdata('error_msg', 'Username atau Password salah');
			$this->load->view('v_login', $data);
		}
	}

	function logout(){
		$this->session->sess_destroy();
		redirect(base_url());
	}
}
?>