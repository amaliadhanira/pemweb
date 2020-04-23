<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Klinik extends CI_Controller{
	function __construct(){
		parent::__construct();

		if ($this->session->status != 'login_pasien'){
			redirect(base_url());
		}

		$this->load->model('m_antrean');
		$this->load->model('m_antrean_saya');
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
		$this->load->view('pasien/templates/v_header', $data);
		$this->load->view('pasien/v_dokter', $data);
		$this->load->view('pasien/templates/v_footer', $data);
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

	/* END OF CONTROLLER FUNCTIONS FOR DATATABLE DOKTER */

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
		$data['dokter'] = $this->m_dokter->get_all();
		$this->load->view('pasien/templates/v_header', $data);
		$this->load->view('pasien/v_antrean_saya', $data);
		$this->load->view('pasien/templates/v_footer', $data);
	}

	/* CONTROLLER FUNCTIONS FOR DATATABLE ANTREAN SAYA */

	function data_antrean_saya(){
		$antrean = $this->m_antrean_saya->get_datatables();
		$data = array();
		$no = $this->input->post('start');

		foreach($antrean as $ant) {
			$dis = '';
			$no++;
			$row = array();
			$row[] = $no;
			$row[] = $ant['nama_dokter'];
			$row[] = $ant['nama_spesialisasi'];
			$row[] = $ant['tgl_periksa'];

			if($ant['tgl_periksa'] < date('Y-m-d')){
				$dis = ' disabled';
			}

			$row[] = '<button class="btn btn-sm btn-warning'. $dis .'"'. $dis .' data-no_antrean="'. $ant['no_antrean'] .'" id="ubah_antrean">Ubah Tanggal</button> <button class="btn btn-sm btn-danger'. $dis .'"'. $dis .' data-no_antrean="'. $ant['no_antrean'] .'" id="batalkan_antrean">Batalkan</button>';

			$data[] = $row;
		}

		$output = array(
						"draw" => $this->input->post('draw'),
						"recordsTotal" => $this->m_antrean_saya->count_all(),
						"recordsFiltered" => $this->m_antrean_saya->count_filtered(),
						"data" => $data,
		);

		echo json_encode($output);
	}

	function this_pasien(){
		$pasien = $this->m_pasien->get_by_username($this->session->username);
		echo json_encode($pasien);
	}

	function edit_antrean_saya($no_antrean){
		$data = $this->m_antrean_saya->get_by_no($no_antrean);
		echo json_encode($data);
	}

	function daftar_antrean(){

		$data = array(
			'id_dokter' => $this->input->post('id_dokter'),
			'id_pasien' => $this->input->post('id_pasien'),
			'tgl_periksa' => $this->input->post('tgl_periksa')
		);

		$insert = $this->m_antrean_saya->add_antrean($data);
		if ($insert) {
			echo json_encode(array("success" => TRUE));
		}
	}

	function ubah_antrean(){
		$no_antrean = $this->input->post('no_antrean');

		$data = array(
			'id_dokter' => $this->input->post('id_dokter'),
			'id_pasien' => $this->input->post('id_pasien'),
			'tgl_periksa' => $this->input->post('tgl_periksa')
		);

		$update = $this->m_antrean_saya->update_antrean($no_antrean, $data);
		if ($update) {
			echo json_encode(array("success" => TRUE));
		}
	}

	function batalkan_antrean($no_antrean){
		$this->m_antrean_saya->del_antrean($no_antrean);
		echo json_encode(array("success" => TRUE));
	}

	/* END OF CONTROLLER FUNCTIONS FOR DATATABLE ANTREAN SAYA */
}

?>
