<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dokter extends CI_Controller {
	
	public function __construct() {
		parent::__construct('dokter');
		$this->load->model('m_dokter');
		$this->load->helper('string');
		$this->load->helper('form');
	}

	function dokter(){
		$data['title'] = 'Dokter';
		$data['page'] = 'dokter';
		$this->load->view('admin/templates/v_header', $data);
		$this->load->view('admin/dokter/v_dokter', $data);
		$this->load->view('admin/templates/v_footer', $data);
	}

	function data_dokter(){
		$dokter = $this->m_dokter->get_datatables();
		$data = array();
		$id = $this->input->post('start');

		foreach($dokter as $dok) {
			$dis = '';
			$id++;
			$row = array();
			$row[] = $id;
			$row[] = $dok['nama_dokter'];
			$row[] = $dok['nama_spesialisasi'];
			$row[] = $dok['jadwal'];
			$row[] = $dok['alamat'];
			$row[] = $dok['no_telp'];

			$row[] = '<button class="btn btn-sm btn-warning'. $dis .'"'. $dis .' data-id_dokter="'. $dok['id_dokter'] .'" id="edit_dokter">Edit Dokter</button> <button class="btn btn-sm btn-danger'. $dis .'"'. $dis .' data-id_dokter="'. $dok['id_dokter'] .'" id="hapus_dokter">Hapus Dokter</button>';

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

	private function upload_foto($id_dokter = ''){
		if( ! is_numeric($id_dokter)){
			redirect('admin/dokter');
		}else{
			$data_view = $this->m_dokter->get_by_id($id_dokter);
			if($data_view === NULL){
				redirect('admin/dokter');
			}
			
			$config['upload_path'] = './images/dokter/';
			$config['allowed_types'] = 'jpg';
			$config['max_width']  = '250';
			$config['max_height']  = '250';
			$config['overwrite'] = TRUE;
			$config['file_name'] = $id;
		
			$this->set_judul('upload foto &raquo; ' . $data_view['nama_dokter']);

			$this->load->library('upload', $config);
		
				if ( ! $this->upload->do_upload('avatar')){
					$this->set_feedback($this->upload->display_errors('',''), 'error');
				}else{
					$this->set_feedback('Sukses upload avatar', 'sukses');
				}	
		}
	}

	function cek_edit($data_edit, $data_before){
		extract($data_edit);
		$array_error = array();
		
		//cek nama
		if(trim($nama_dokter) === ''){
			$array_error[] = 'Nama dokter tidak boleh kosong.';
		}else if(is_string($nama_dokter) === FALSE){
			$array_error[] = 'Nama dokter harus berupa huruf.';
		}
		
		//Cek spesialis
		if($id_spesialis !== '0'){
			if($this->m_spesialis->exist_id($id_spesialis) === FALSE){
				$array_erorr[] = 'Id spesialis invalid';
			}
		}else if(trim($nama_spesialisasi ==='')){
			$array_error[] = 'Nama spesialisasi harus diisi';
		}

		//Cek alamat
		if(trim($alamat) ===''){
			$array_error[] = 'Alamat tidak boleh kosong.';
		}

		//Cek no. telp
		if(is_numeric($no_telp) === FALSE){
			$array_error[] = 'No. Telepon harus berupa angka';
		}else if(trim($no_telp) ===''){
			$array_error[] = 'No. Telepon harus diisi.';
		}
		
		//final cek
		if(empty($array_error) === FALSE){
			return $array_error;
		}else{
			return TRUE;
		}
	}

	function edit_dokter(){
		if($this->input->post('do_create') !== FALSE){
			$data_post = $this->input->post();
			$allow_create = $this->cek_edit($data_post);
			
			if($allow_create === TRUE){
				$data = array(
					'id_dokter' => $this->input->post('id_dokter'),
					'nama_dokter' => $this->input->post('nama_dokter'),
					'nama_spesialisasi' => $this->input->post('nama_spesialisasi'),
					'jadwal' => $this->input->post('jadwal'),
					'alamat' => $this->input->post('alamat'),
					'no_telp' => $this->input->post('no_telp')
				);

		$edit = $this->m_dokter->edit_dokter($id_dokter, $data_dokter);
		if ($edit){
			echo json_encode(array("success" => TRUE));
			}
		}
		}
	}

	private function cek_buat_dokter($data_aokter){
		extract($data_dokter);
		$array_error = array();
		
		//cek nama
		if(trim($nama_dokter) === ''){
			$array_error[] = 'Nama dokter tidak boleh kosong.';
		}else if(is_string($nama_dokter) === FALSE){
			$array_error[] = 'Nama dokter harus berupa huruf.';
		}
		
		//Cek spesialis
		if($id_spesialis !== '0'){
			if($this->m_spesialis->exist_id($id_spesialis) === FALSE){
				$array_erorr[] = 'Id spesialis invalid';
			}
		}else if(trim($nama_spesialisasi ==='')){
			$array_error[] = 'Nama spesialisasi harus diisi';
		}

		//Cek alamat
		if(trim($alamat) ===''){
			$array_error[] = 'Alamat tidak boleh kosong.';
		}

		//Cek no. telp
		if(is_numeric($no_telp) === FALSE){
			$array_error[] = 'No. Telepon harus berupa angka';
		}else if(trim($no_telp) ===''){
			$array_error[] = 'No. Telepon harus diisi.';
		}
		
		//final cek
		if(empty($array_error) === FALSE){
			return $array_error;
		}else{
			return TRUE;
		}
	}

	function new_dokter(){
		if($this->input->post('do_create') !== FALSE){
			$data_post = $this->input->post();
			$allow_create = $this->cek_buat_dokter($data_post);
			
		$data = array(
			'id_dokter' => $this->input->post('id_dokter'),
			'nama_dokter' => $this->input->post('nama_dokter'),
			'nama_spesialisasi' => $this->input->post('nama_spesialisasi'),
			'jadwal' => $this->input->post('jadwal'),
			'alamat' => $this->input->post('alamat'),
			'no_telp' => $this->input->post('no_telp')
		);

		$insert = $this->m_dokter->dokter_baru($data_dokter);
		if ($insert) {
			echo json_encode(array("success" => TRUE));
		}
	}

	function delete_by_id($id_dokter){
		$this->m_dokter->delete_dokter_by_id($id_dokter);
		echo json_encode(array("success" => TRUE));
	}

	function delete_semua(){
		$this->m_dokter->delete_all_dokter();
		echo json_encode(array("success" => TRUE));
	}

}

?>