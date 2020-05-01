<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Lab extends ADM_Controller {
	
	public function __construct() {
		parent::__construct('lab');
		$this->load->model('M_Lab');
		$this->load->helper('string');
		$this->load->helper('form');
	}
	
function data_lab(){
		$lab = $this->m_lab->get_datatables();
		$data = array();
		$id_examiner = $this->input->post('start');

		foreach($lab as $lb) {
			$dis = '';
			$id++;
			$row = array();
			$row[] = $id_examiner;
			$row[] = $lb['nama_examiner'];
			$row[] = $lb['alamat']
			$row[] = $lb['no_telp'];

			$row[] = '<button class="btn btn-sm btn-warning'. $dis .'"'. $dis .' data-id_examiner="'. $lb['id_examiner'] .'" id="edit_examiner">Edit Examiner</button> <button class="btn btn-sm btn-danger'. $dis .'"'. $dis .' data-id_examiner="'. $adm['id_examiner'] .'" id="hapus_examiner">Hapus Examiner</button>';

			$data[] = $row;
		}

		$output = array(
						"draw" => $this->input->post('draw'),
						"recordsTotal" => $this->m_lab->count_all(),
						"recordsFiltered" => $this->m_lab->count_filtered(),
						"data" => $data,
		);

		echo json_encode($output);
	}

	private function upload_foto($id_examiner = ''){
		if( ! is_numeric($id_examiner)){
			redirect('admin/adminpage');
		}else{
			$data_view = $this->m_lab->get_by_id($id_examiner);
			if($data_view === NULL){
				redirect('admin/adminpage');
			}
			
			$config['upload_path'] = './images/dokter/';
			$config['allowed_types'] = 'jpg';
			$config['max_width']  = '250';
			$config['max_height']  = '250';
			$config['overwrite'] = TRUE;
			$config['file_name'] = $id;
		
			$this->set_judul('upload foto &raquo; ' . $data_view['nama_examiner']);

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
		if(trim($nama_examiner) === ''){
			$array_error[] = 'Nama examiner tidak boleh kosong.';
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

	function edit_examiner($id_examiner){
		if($this->input->post('do_create') !== FALSE){
			$data_post = $this->input->post();
			$allow_create = $this->cek_baru($data_post);
			
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

	function new_dokter(){

		$data = array(
			'id_dokter' => $this->input->post('id_dokter'),
			'nama_dokter' => $this->input->post('nama_dokter'),
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