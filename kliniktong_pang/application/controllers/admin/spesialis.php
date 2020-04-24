<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Spesialis extends ADM_Controller {
	
	function __construct() {
		parent::__construct('spesialis');
		$this->load->model('M_Spesialis');
		$this->load->helper('string');
		$this->load->helper('form');
	}

	function _remap($method){
		$param_offset = 2;

		if(! method_exists($this, $method)){
			$param_offset = 1;
			$method = 'index';
		}

		$params = array_slice($this->url->segment_array(), $param_offset);

		call_user_func_array(array($this, $method), $params);
	}

	function index($page = 1){
		if(is_numeric($page) === FALSE){
			$page = 1;
		}

		$this->cek_hapus();

		if($this->input->post('do_cari') !== FALSE){
			$post = $this->input->post();
			redirect('admin/spesialis/cari/' . $post['pilihan_cari'] . '/' . $post['input_cari']);
		}

		$this->load->library('pagination');

		$config['base_url'] = base_url() . 'index.php/admin/spesialis';
		$config['total_rows'] = $this->M_Spesialis->all_rows_count();
		$config['use_page_numbers'] = TRUE;
		$config['per_page'] = 10; 

		$this->pagination->initialize($config);
		$data_view['pagelink'] = $this->pagination->create_links();
		$data_view['pilihan'] = '';
		$data_view['input_cari'] = '';
		
		$data_view['rows'] = $this->M_Spesialis->get_all_spesialis($page);
		$this->set_judul('list');
		$main = $this->load->view('admin/spesialis/main', $data_view, TRUE);
		$this->show($main);
	}

	function cari($pilihan = 'id_spesialisasi', $input, $page = 1){
		$this->cek_hapus();
		
		switch($pilihan){
			case 'id_spesialisasi':
				$data_view['rows'] = $this->M_Spesialis->cari_id($input, $page);
				$config['total_rows'] = $this->M_Spesialis->cari_id_count($input);
			break;
			case 'nama':
				$data_view['rows'] = $this->M_Spesialis->cari_nama($input, $page);
				$config['total_rows'] = $this->M_Spesialis->cari_nama_count($input);
			break;
			default:
				redirect('admin/spesialis');
			break;
		}
		
		if( ! is_numeric($page)){
			redirect('admin/spesialis');
		}
		
		if($data_view['rows'] !== NULL){
			//setup page links
			$this->load->library('pagination');

			$config['base_url'] = base_url() . 'index.php/admin/spesialis';
			$config['use_page_numbers'] = TRUE;
			$config['per_page'] = 10; 

			$this->pagination->initialize($config);
			$data_view['pagelink'] = $this->pagination->create_links();
		
			$this->set_judul('pencarian ' . $pilihan);
			$data_view['pilihan'] = $pilihan;
			$data_view['input_cari'] = $input;
			$main = $this->load->view('admin/spesialis/main', $data_view, TRUE);
			$this->tampil($main);
		}else{
			$this->set_flash_feedback('Hasil pencarian tidak ada', 'info');
			redirect('admin/spesialis');
		}
	}

	function cek_hapus(){
		if($this->input->post('do_hapus') !== FALSE){
			$id = $this->input->post('id_hapus');
			if($id !== FALSE){
				$this->kategori_model->delete_kategori_by_id($id);
				$this->set_feedback('Berhasil hapus ' . count($id) . ' kategori', 'sukses');
			}else{
				$this->set_feedback('Pilih kategori yang akan dihapus !', 'error');
			}
		}
	}

	function hapus_semua(){
		$this->M_Spesialis->delete_all_spesialis();
		$this->set_flash_feedback('Sukses hapus semua spesialis', 'sukses');
		redirect('admin/spesialis');
	}

	function cek_edit($data_edit, $data_before){
		extract($data_edit);
		$array_error = array();
		
		if(trim($nama_spesialisasi) === ''){
			$array_error[] = 'Nama spesialis tidak boleh kosong.';
		}else if($this->M_Spesialis->exist_nama($nama_spesialisasi) === TRUE
			&& $data_before['nama_spesialisasi'] != $nama_spesialisasi)
		{
			$array_error[] = 'Nama spesialis sudah ada.';
		}
		
		
		if(empty($array_error) === FALSE){
			return $array_error;
		}else{
			return TRUE;
		}
	}

	function edit($id_spesialis = ''){		
		if($id_spesialis !== ''){
			$this->set_judul('edit');
			$data_view = $this->M_Spesialis->get_spesialis_by_id($id_spesialis);
			
			//cek post
			if($this->input->post('do_edit')){
				$data_post = $this->input->post();
				$allow_edit = $this->cek_edit($data_post, $data_view);
				if($allow_edit === TRUE){
					$this->M_Spesialis->edit_spesialis_by_id($id_spesialis, $data_post);
					$this->set_flash_feedback('Sukses edit spesialis', 'sukses');
					redirect('admin/spesialis/edit/' . $id_spesialis);
				}else{
					$this->set_feedback($allow_edit, 'error');
				}
				
			}
			
			if($data_view !== NULL){
				$form = $this->load->view('admin/spesialis/V_Edit', $data_view, TRUE);
				$this->tampil($form);
			}else{
				$this->set_flash_feedback('Tidak ada spesialis dengan id ' . $id_spesialis, 'error');
				redirect('admin/spesialis');
			}
		}else{
			redirect('admin/spesialis');
		}
	}

	function cek_buat_spesialis($data_spesialis){
		extract($data_spesialis);
		$array_error = array();
		
		if(trim($nama_spesialisasi) === ''){
			$array_error[] = 'Nama spesialis tidak boleh kosong';
		}else if($this->M_Spesialis->exist_nama($nama_spesialisasi) === TRUE){
			$array_error[] = 'Nama spesialis sudah ada.';
		}
		
		if(empty($array_error) === FALSE){
			return $array_error;
		}else{
			return TRUE;
		}
	}

	function buat_spesialis(){
		$this->set_judul('baru');
		if($this->input->post('do_create') !== FALSE)
		{
			$data_post = $this->input->post();
			$allow_create = $this->cek_buat_spesialis($data_post);
			
			if($allow_create === TRUE)
			{
				$this->M_Spesialisasi->buat_spesialis($data_post);
				$this->set_flash_feedback('Berhasil membuat spesialis baru', 'sukses');
				redirect('admin/spesialis');
			}
			else
			{
				$this->set_feedback($allow_create, 'error');
				$form = $this->load->view('admin/spesialis/V_Buat', '', TRUE);
			}
		}
		else
		{
			$form = $this->load->view('admin/spesialis/V_Buat', '', TRUE);
		}
		
		$this->show($form);
	}



