<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Adminpage extends CI_Controller{
	function __construct(){
		parent::__construct();

		if ($this->session->status != 'login_admin'){
			redirect(base_url());
		}

		$this->load->model('m_admin');
		$this->load->model('m_dokter');
		$this->load->model('m_pasien');
		$this->load->model('m_antrean');
		$this->load->model('m_antrean_saya');
		$this->load->model('m_laporan_pemeriksaan');
	}

	function index(){
		$data['title'] = 'Home';
		$data['page'] = 'home';
		$this->load->view('admin/templates/v_header', $data);
		$this->load->view('admin/home', $data);
		$this->load->view('admin/templates/v_footer', $data);
	}

	function admin(){
		$data['title'] = 'Admin';
		$data['page'] = 'admin';
		$this->load->view('admin/templates/v_header', $data);
		$this->load->view('admin/v_admin', $data);
		$this->load->view('admin/templates/v_footer', $data);
	}

	// CONTROLLER FUNCTIONS FOR DATATABLE ADMIN 
	function data_admin(){
		$admin = $this->m_admin->get_datatables();
		$data = array();
		$no = $this->input->post('start');

		foreach($admin as $adm) {
			$dis = '';
			$no++;
			$row = array();
			$row[] = $no;
			$row[] = $adm['nama_admin'];
			$row[] = $adm['email'];
			$row[] = $adm['alamat'];
			$row[] = $adm['username'];
			$row[] = $adm['no_telp'];

			$data[] = $row;
		}

		$output = array(
						"draw" => $this->input->post('draw'),
						"recordsTotal" => $this->m_admin->count_all(),
						"recordsFiltered" => $this->m_admin->count_filtered(),
						"data" => $data,
		);

		echo json_encode($output);
	}

	// CONTROLLER FUNCTION FOR DATATABLE DOKTER
	function dokter(){
		$data['title'] = 'Dokter';
		$data['page'] = 'dokter';
		$this->load->view('admin/templates/v_header', $data);
		$this->load->view('admin/v_dokter', $data);
		$this->load->view('admin/templates/v_footer', $data);
	}

	/* CONTROLLER FUNCTIONS FOR DATATABLE DOKTER */
	function data_dokter(){
		$dokter = $this->m_dokter->get_datatables();
		$data = array();
		$no = $this->input->post('start');

		foreach($dokter as $dok) {
			$dis = '';
			$no++;
			$row = array();
			$row[] = $no;
			$row[] = $dok['nama_dokter'];
			$row[] = $dok['nama_spesialisasi'];
			$row[] = $dok['jadwal'];
			$row[] = $dok['alamat'];
			$row[] = $dok['no_telp'];

			$data[] = $row;
		}

		$output = array(
						"draw" => $this->input->post('draw'),
						"recordsTotal" => $this->m_dokter->count_all(),
						"recordsFiltered" => $this->m_dokter->count_filtered(),
						"data" => $data,
		);

		echo json_encode($output);
	}

	// CONTROLLER FUNCTION FOR DATATABLE PASIEN
	function pasien(){
		$data['title'] = 'Pasien';
		$data['page'] = 'pasien';
		$this->load->view('admin/templates/v_header', $data);
		$this->load->view('admin/v_pasien', $data);
		$this->load->view('admin/templates/v_footer', $data);
	}

	function data_pasien(){
		$pasien = $this->m_pasien->get_datatables();
		$data = array();
		$no = $this->input->post('start');

		foreach($pasien as $psn) {
			$dis = '';
			$no++;
			$row = array();
			$row[] = $no;
			$row[] = $psn['nama_pasien'];
			$row[] = $psn['tanggal_lahir'];
			$row[] = $psn['email'];
			$row[] = $psn['alamat'];
			$row[] = $psn['username'];
			$row[] = $psn['no_telp'];

			$data[] = $row;
		}

		$output = array(
						"draw" => $this->input->post('draw'),
						"recordsTotal" => $this->m_pasien->count_all(),
						"recordsFiltered" => $this->m_pasien->count_filtered(),
						"data" => $data,
		);

		echo json_encode($output);
	}
}
?>