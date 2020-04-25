<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller{

	function __construct(){
		parent::__construct();
		$this->load->model('m_login');
		$this->load->model('m_pasien');
	}

	function index(){
		$data['title'] = 'Klinik Tong Pang';
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

		} else if($this->m_login->auth_admin($username, $password)){
			$session_data = array(
				'username' => $username,
				'level' => 'admin',
				'status' => 'login_admin'
			);

			$this->session->set_userdata($session_data);
			redirect('/admin/adminpage');
		} else {
			$data['error_msg'] = $this->session->set_flashdata('error_msg', 'Username atau Password salah');
			redirect(site_url());
		}
	}

	function daftar(){
		$data['title'] = 'Daftar Akun';
		$this->load->view('v_daftar', $data);
	}

	function daftar_akun(){
		//FORM VALIDATION
		$this->form_validation->set_rules('nama_pasien', 'Nama Lengkap', 'trim|required|alpha_numeric_spaces');
		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|is_unique[pasien.email]');
		$this->form_validation->set_rules('username', 'Username', 'trim|required|min_length[5]|max_length[12]|alpha_dash|is_unique[pasien.username]');
		$this->form_validation->set_rules('alamat', 'Alamat', 'required');
		$this->form_validation->set_rules('no_telp', 'Nomor Telepon', 'trim|required|numeric|min_length[10]|max_length[13]');
		$this->form_validation->set_rules('password', 'Sandi', 'trim|required|min_length[6]');
		$this->form_validation->set_rules('passconf', 'Konfirmasi Sandi', 'trim|required|matches[password]');

		$input = array(
			'username' => $this->input->post('username'),
			'email' => $this->input->post('email'),
			'nama_pasien' => $this->input->post('nama_pasien'),
			'tanggal_lahir' => $this->input->post('tanggal_lahir'),
			'alamat' => $this->input->post('alamat'),
			'no_telp' => $this->input->post('no_telp'),
			'password' => md5($this->input->post('password'))
		);

		if ($this->form_validation->run() == FALSE){
			$this->daftar();
		} else {
			$cek = $this->m_pasien->daftar_akun($input);
			if ($cek) $data['info_msg'] = $this->session->set_flashdata('info_msg', 'Berhasil daftar. Silahkan masuk');
			$this->index();
		}

	}

	function logout(){
		$this->session->sess_destroy();
		redirect(base_url());
	}
}
?>