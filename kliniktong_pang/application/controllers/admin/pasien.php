<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pasien extends ADM_Controller {
	
	public function __construct() {
		parent::__construct('pasien');
		$this->load->model('M_pasien');
		$this->load->helper('string');
		$this->load->helper('form');
	}

	function pasien(){
		$data['title'] = 'Pasien';
		$data['page'] = 'pasien';
		$this->load->view('admin/templates/v_header', $data);
		$this->load->view('admin/pasien/v_pasien', $data);
		$this->load->view('admin/templates/v_footer', $data);
	}
	
	function data_pasien(){
		$pasien = $this->m_pasien->get_datatables();
		$data = array();
		$id = $this->input->post('start');

		foreach($pasien as $psn) {
			$dis = '';
			$id++;
			$row = array();
			$row[] = $id;
			$row[] = $psn['nama_pasien'];
			$row[] = $psn['tanggal_lahir'];
			$row[] = $psn['username'];
			$row[] = $psn['alamat'];
			$row[] = $psn['no_telp'];
			$row[] = $psn['email'];

			$row[] = '<button class="btn btn-sm btn-warning'. $dis .'"'. $dis .' data-id_pasien="'. $psn['id_pasien'] .'" id="edit_pasien">Edit Pasien</button> <button class="btn btn-sm btn-danger'. $dis .'"'. $dis .' data-id_pasien="'. $psn['id_pasien'] .'" id="hapus_pasien">Hapus Pasien</button>';

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

	function delete_by_id($id_pasien){
		$this->m_pasien->delete_pasien_by_id($id_pasien);
		echo json_encode(array("success" => TRUE));
	}

	function delete_semua(){
		$this->m_pasien->delete_all_pasien();
		echo json_encode(array("success" => TRUE));
	}
}
?>