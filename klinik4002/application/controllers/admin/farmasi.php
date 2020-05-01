<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Farmasi extends ADM_Controller {
	
	public function __construct() {
		parent::__construct('admin');
		$this->load->model('M_farmasi');
		$this->load->helper('string');
		$this->load->helper('form');
	}
	
	function _remap($method){
		$param_offset = 2;

		if ( ! method_exists($this, $method))
		{
			$param_offset = 1;
			$method = 'index';
		}

		$params = array_slice($this->uri->rsegment_array(), $param_offset);

		call_user_func_array(array($this, $method), $params);
	}

	function index($page = 1){
		if( ! is_numeric($page))
		{
			redirect('admin/farmasi');
		}
		
		$this->cek_hapus();
		
		if($this->input->post('do_cari') !== FALSE)
		{
			$post = $this->input->post();
			redirect('admin/farmasi/cari/' . $post['pilihan_cari'] . '/' . $post['input_cari']);
		}
		//setup page links
		$this->load->library('pagination');

		$config['base_url'] = base_url() . 'index.php/admin/farmasi';
		$config['total_rows'] = $this->M_farmasi->all_rows_count();
		$config['use_page_numbers'] = TRUE;
		$config['per_page'] = 10; 

		$this->pagination->initialize($config);
		$data_view['pagelink'] = $this->pagination->create_links();
		$data_view['pilihan'] = '';
		$data_view['input_cari'] = '';
		
		$data_view['rows'] = $this->M_Admin->get_all_admin($page);
		$this->set_judul('list');
		$main = $this->load->view('admin/farmasi/main', $data_view, TRUE);
		$this->tampil($main);
	}

	function cari($pilihan = 'id_apoteker', $input, $page = 1){
		$this->cek_hapus();
		
		switch($pilihan){
			case 'id':
				$data_view['rows'] = $this->M_farmasi->cari_id($input, $page);
				$config['total_rows'] = $this->M_farmasi->cari_id_count($input);
			break;
			case 'username':
				$data_view['rows'] = $this->M_farmasi->cari_username($input, $page);
				$config['total_rows'] = $this->M_farmasi->cari_username_count($input);
			break;
			default:
				redirect('admin/farmasi');
			break;
		}
		
		if( ! is_numeric($page)){
			redirect('admin/farmasi');
		}
		
		if($data_view['rows'] !== NULL){
			//setup page links
			$this->load->library('pagination');

			$config['base_url'] = base_url() . 'index.php/admin/farmasi';
			$config['use_page_numbers'] = TRUE;
			$config['per_page'] = 10; 

			$this->pagination->initialize($config);
			$data_view['pagelink'] = $this->pagination->create_links();
		
			$this->set_judul('pencarian ' . $pilihan);
			$data_view['pilihan'] = $pilihan;
			$data_view['input_cari'] = $input;
			$main = $this->load->view('admin/farmasi/main', $data_view, TRUE);
			$this->tampil($main);
		}else{
			$this->set_flash_feedback('Hasil pencarian tidak ada', 'info');
			redirect('admin/farmasi');
		}
	}

	function cek_hapus(){
		if($this->input->post('do_hapus') !== FALSE){
			$id = $this->input->post('id_hapus');
			if($id !== FALSE){
				$this->M_farmasi->delete_farmasi_by_id($id_apoteker);
				$this->set_feedback('Berhasil hapus' . count($id_apoteker). ' farmasi', 'info');
			}else{
				$this->set_flash_feedback('Pilih farmasi yang akan dihapus!', 'error');
			}
		}
	}

	function hapus_semua(){
		$this->M_farmasi->delete_all_farmasi();
		$this->set_flash_feedback('Sukses hapus semua apoteker', 'sukses');
		redirect('admin/farmasi');
	}

	function cek_edit($data_edit, $data_before){
		extract($data_edit);
		$array_error = array();

		if(trim($nama_apoteker) === ''){
			$array_error[] = 'Nama apoteker tidak boleh kosong';
		}else if(is_string($nama) === FALSE){
			$array_error
		}

		if(trim($alamat) === ''){
			$array_error[] = 'Alamat tidak boleh kosong'
		}

		if(trim($no_telp) === ''){
			$array_error[] = 'Nomor HP tidak boleh kosong';
		}else if(is_numeric($no_telp) === FALSE){
			$array_error[] = 'Harus berupa angka';
		}

		if(empty($array_error) === FALSE){
			return $array_error;
		}else{
			return TRUE;
		}
	}

	function upload_foto($id_apoteker =''){
		if(! is_numeric($id_apoteker)){
			redirect('admin/farmasi');
		}else{
			$data_view = $this->M_farmasi->get_by_id($id_apoteker);
			if($data_view === NULL){
				redirect('admin/farmasi');
			}
		
			$config['upload_path'] = './images/farmasi/';
			$config['allowed_types'] = 'jpg';
			$config['max_width']  = '250';
			$config['max_height']  = '250';
			$config['overwrite'] = TRUE;
			$config['file_name'] = $id_apoteker;

			$this->set_judul('upload foto' . $data_view['nama']);

			if($this->input->post('upload_foto')){
				$this->set_feedback($this->upload->display_errors('',''), 'error');
			}else{
				$this->set_feedback('Sukses upload foto');
			}

			$form = $this->load->view('admin/farmasi/upload_foto', $data_view, TRUE);
			$this->show($form);
		}
	}

	function edit($id_apoteker =''){
		if($id_apoteker !== ''){
			$this->set_judul('edit');
			$data_view = $this->M_farmasi->get_by_id($id_apoteker);

			if($this->input->post('do_edit')){
				$data_post = $this->input->post();
				$allow_edit = $this->cek_edit($data_post, $data_view);
				if($allow_edit === TRUE){
					$this->M_farmasi->edit_farmasi($id_apoteker, $data_post);
					$this->set_flash_feedback('Sukses edit farmasi', 'sukses');
					redirect('admin/farmasi/edit' . $id_apoteker);
				}else{
					$this->set_feedback($allow_edit, 'error');
				}
			}
			if($data_view !== NULL){
				$form = $this->load->view('admin/farmasi/V_Edit', $data_view, TRUE);
				$this->tampil($form);
			}else{
				$this->set_flash_feedback('Tidak ada apoteker dengan id' . $id_apoteker, 'error');
				redirect('admin/farmasi');
			}
		}else{
			redirect('admin/adminpage');
		}
	}

	function cek_baru($data_farmasi){
		extract($data_farmasi);
		$array_error = array();

		if(trim($nama_apoteker) === ''){
			$array_error[] = 'Nama apoteker tidak boleh kosong'
		}else if(is_string($nama_apoteker) === FALSE){
			$array_error
		}

		if(trim($alamat) === ''){
			$array_error[] = 'Alamat tidak boleh kosong'
		}

		if(trim($no_telp) === ''){
			$array_error[] = 'Nomor HP tidak boleh kosong';
		}else if(is_numeric($no_telp) === FALSE){
			$array_error[] = 'Harus berupa angka';
		}

		if(empty($array_error) === FALSE){
			return $array_error;
		}else{
			return TRUE;
		}
	}

	function baru(){
		$this->set_judul('baru');

		if($this->inputpost('do_create') !== FALSE){
			$data_post = $this->input->post();
			$allow_create = $this->cek_baru($data_post);

			if($allow_create === TRUE){
				$this->M_farmasi->new_farmasi($data_post);
				$this->set_flash_feedback('Berhasil tambah farmasi', 'sukses');
				redirect('admin/farmasi/edit/' . $this->M_farmasi->get_last_id());
			}else{
				$this->set_feedback($allow_create, 'error');
			}
		}else{
			$data_post['nama_apoteker'] = '';
		}

		$data_view = $data_post;
		$form = $this->load->view('admin/farmasi/V_Aptkbaru', $data_view, TRUE);

		$this->show($form);
	}
}