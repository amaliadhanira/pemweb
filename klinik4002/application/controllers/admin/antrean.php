<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dokter extends CI_Controller {
	
	public function __construct() {
		parent::__construct('antrean');
		$this->load->model('m_antrean');
		$this->load->helper('string');
		$this->load->helper('form');
	}

	function admin(){
		$data['title'] = 'Admin';
		$data['page'] = 'admin';
		$this->load->view('admin/templates/v_header', $data);
		$this->load->view('admin/v_antrean', $data);
		$this->load->view('admin/templates/v_footer', $data);
	}

	function data_antrean(){
		$antrean = $this->m_antrean->get_datatables();
		$data = array();
		$no = $this->input->post('start');

		foreach($antrean as $ant) {
			$dis = '';
			$id++;
			$row = array();
			$row[] = $no;
			$row[] = $ant['nama_pasien'];
			$row[] = $ant['nama_dokter'];
			$row[] = $ant['tgl_periksa'];

			if($ant['tgl_periksa'] < date('Y-m-d')){
				$dis = ' disabled';
			}

			$row[] = '<button class="btn btn-sm btn-warning'. $dis .'"'. $dis .' data-no_antrean="'. $ant['no_antrean'] .'" id="edit_antrean">Edit Antrean</button> <button class="btn btn-sm btn-danger'. $dis .'"'. $dis .' data-bo_antrean="'. $ant['no_antrean'] .'" id="hapus_antrean">Hapus Antrean</button>';

			$data[] = $row;
		}

		$output = array(
						"draw" => $this->input->post('draw'),
						"recordsTotal" => $this->m_antrean->count_all(),
						"recordsFiltered" => $this->m_antrean->count_filtered(),
						"data" => $data,
		);

		echo json_encode($output);
	}

	function delete_by_id($no_antrean){
		$this->m_antrean->delete_dokter_by_id($id_dokter);
		echo json_encode(array("success" => TRUE));
	}

	function delete_semua(){
		$this->m_dokter->delete_all_dokter();
		echo json_encode(array("success" => TRUE));
	}

}

?>