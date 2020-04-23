<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Klinik extends CI_Controller{
	function __construct(){
		parent::__construct();
		
		if ($this->session->status != 'login'){
			redirect(base_url());
		}
		
		$this->load->model('m_login');
		$this->load->model('m_antrean');
		$this->load->model('m_dokter');
		$this->load->model('m_pasien');
	}

	function index(){
		$data['title'] = 'Home';
		$data['page'] = 'home';
		$this->load->view('pasien/templates/v_header', $data);
		$this->load->view('pasien/v_home', $data);
		$this->load->view('pasien/templates/v_footer', $data);
	}

	function dokter(){
		$data['title'] = 'Dokter';
		$data['page'] = 'dokter';
		$data['dokter'] = $this->m_dokter->get_all();
		$this->load->view('pasien/templates/v_header', $data);
		$this->load->view('pasien/v_dokter', $data);
		$this->load->view('pasien/templates/v_footer', $data);
	}

	function jumlah_antrean(){
		$data['title'] = 'Jumlah Antrean Hari Ini';
		$data['page'] = 'jumlah_antrean';
		$data['antrean'] = $this->m_antrean->get_jumlah();
		$this->load->view('pasien/templates/v_header', $data);
		$this->load->view('pasien/v_jumlah_antrean', $data);
		$this->load->view('pasien/templates/v_footer', $data);
	}

	function antrean_saya(){
		$data['title'] = 'Antrean Saya';
		$data['page'] = 'antrean_saya';
		$username = $this->session->username;
		$data['antrean'] = $this->m_antrean->get_my_antrean($username);
		$this->load->view('pasien/templates/v_header', $data);
		$this->load->view('pasien/v_antrean_saya', $data);
		$this->load->view('pasien/templates/v_footer', $data);
	}

	function daftar_antrean(){
		$data['title'] = 'Daftar Antrean';
		$data['page'] = 'antrean_saya';
		$username = $this->session->username;
		$data['pasien'] = $this->m_pasien->get_by_username($username);
		$this->load->view('pasien/templates/v_header', $data);
		$this->load->view('pasien/v_antrean_saya', $data);
		$this->load->view('pasien/templates/v_footer', $data);
	}
}

?>
