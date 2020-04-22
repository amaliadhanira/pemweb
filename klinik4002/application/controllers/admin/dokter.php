<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dokter extends ADM_Controller {
	
	public function __construct() {
		parent::__construct('admin');
		$this->load->model('M_Dokter');
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
			redirect('admin/dokter');
		}
		
		$this->cek_hapus();
		
		if($this->input->post('do_cari') !== FALSE)
		{
			$post = $this->input->post();
			redirect('admin/dokter/cari/' . $post['pilihan_cari'] . '/' . $post['input_cari']);
		}
		//setup page links
		$this->load->library('pagination');

		$config['base_url'] = base_url() . 'index.php/admin/dokter';
		$config['total_rows'] = $this->M_Dokter->all_rows_count();
		$config['use_page_numbers'] = TRUE;
		$config['per_page'] = 10; 

		$this->pagination->initialize($config);
		$data_view['pagelink'] = $this->pagination->create_links();
		$data_view['pilihan'] = '';
		$data_view['input_cari'] = '';
		
		$data_view['rows'] = $this->M_Admin->get_all_admin($page);
		$this->set_judul('list');
		$main = $this->load->view('admin/dokter/main', $data_view, TRUE);
		$this->tampil($main);
	}

	function cari($pilihan = 'id_dokter', $input, $page = 1){
		$this->cek_hapus();
		
		switch($pilihan){
			case 'id':
				$data_view['rows'] = $this->M_Dokter->cari_id($input, $page);
				$config['total_rows'] = $this->M_Dokter->cari_id_count($input);
			break;
			case 'username':
				$data_view['rows'] = $this->M_Dokter->cari_username($input, $page);
				$config['total_rows'] = $this->M_Dokter->cari_username_count($input);
			break;
			default:
				redirect('admin/dokter');
			break;
		}
		
		if( ! is_numeric($page)){
			redirect('admin/dokter');
		}
		
		if($data_view['rows'] !== NULL){
			//setup page links
			$this->load->library('pagination');

			$config['base_url'] = base_url() . 'index.php/admin/dokter';
			$config['use_page_numbers'] = TRUE;
			$config['per_page'] = 10; 

			$this->pagination->initialize($config);
			$data_view['pagelink'] = $this->pagination->create_links();
		
			$this->set_judul('pencarian ' . $pilihan);
			$data_view['pilihan'] = $pilihan;
			$data_view['input_cari'] = $input;
			$main = $this->load->view('admin/dokter/main', $data_view, TRUE);
			$this->tampil($main);
		}else{
			$this->set_flash_feedback('Hasil pencarian tidak ada', 'info');
			redirect('admin/dokter');
		}
	}

	function cek_hapus(){
		if($this->input->post('do_hapus') !== FALSE){
			$id = $this->input->post('id_hapus');
			if($id !== FALSE){
				$this->M_Dokter->delete_dokter_by_id($id);
				$this->set_feedback('Berhasil hapus' . count($id). ' dokter', 'info');
			}else{
				$this->set_flash_feedback('Pilih dokter yang akan dihapus!', 'error');
			}
		}
	}

	function hapus_semua(){
		$this->M_Dokter->delete_all_dokter();
		$this->set_flash_feedback('Sukses hapus semua dokter', 'sukses');
		redirect('admin/dokter');
	}

	function cek_edit($data_edit, $data_before){
		extract($data_edit);
		$array_error = array();

		if(trim($nama) === ''){
			$array_error[] = 'Nama dokter tidak boleh kosong';
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

		if(trim($spesialis) === ''){
			$array_error[] = 'Spesialis tidak boleh kosong';
		}else if(is_string($spesialis) === FALSE){
			$array_error[] = 'Harus berupa huruf';
		}

		if(empty($array_error) === FALSE){
			return $array_error;
		}else{
			return TRUE;
		}
	}

	function status($pilihan = 'id_dokter'){
		switch($pilihan){
			case 'Ada':
			$pilihan = 'Ada';
			break;
			case 'Tidak ada':
			$pilihan = 'Tidak ada';
		}
	}

	function upload_foto($id_dokter =''){
		if(! is_numeric($id_dokter)){
			redirect('admin/dokter');
		}else{
			$data_view = $this->M_Dokter->get_by_id($id_dokter);
			if($data_view === NULL){
				redirect('admin/dokter');
			}
		
			$config['upload_path'] = './images/dokter/';
			$config['allowed_types'] = 'jpg';
			$config['max_width']  = '250';
			$config['max_height']  = '250';
			$config['overwrite'] = TRUE;
			$config['file_name'] = $id_dokter;

			$this->set_judul('upload foto' . $data_view['nama']);

			if($this->input->post('upload_foto')){
				$this->set_feedback($this->upload->display_errors('',''), 'error');
			}else{
				$this->set_feedback('Sukses upload foto');
			}

			$form = $this->load->view('admin/dokter/upload_foto', $data_view, TRUE);
			$this->show($form);
		}
	}

	function edit($id_dokter =''){
		if($id_dokter !== ''){
			$this->set_judul('edit');
			$data_view = $this->M_Dokter->get_by_id($id_dokter);

			if($this->input->post('do_edit')){
				$data_post = $this->input->post();
				$allow_edit = $this->cek_edit($data_post, $data_view);
				if($allow_edit === TRUE){
					$this->M_Dokter->edit_dokter($id_dokter, $data_post);
					$this->set_flash_feedback('Sukses edit dokter', 'sukses');
					redirect('admin/dokter/edit' . $id_dokter);
				}else{
					$this->set_feedback($allow_edit, 'error');
				}
			}
			if($data_view !== NULL){
				$form = $this->load->view('admin/dokter/V_Edit', $data_view, TRUE);
				$this->tampil($form);
			}else{
				$this->set_flash_feedback('Tidak ada dokter dengan id' . $id_dokter, 'error');
				redirect('admin/dokter');
			}
		}else{
			redirect('admin/adminpage');
		}
	}

	function cek_baru($data_dokter){
		extract($data_dokter);
		$array_error = array();

		if(trim($nama_dokter) === ''){
			$array_error[] = 'Nama dokter tidak boleh kosong'
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

		if(trim($spesialis) === ''){
			$array_error[] = 'Spesialis tidak boleh kosong';
		}else if(is_string($spesialis) === FALSE){
			$array_error[] = 'Harus berupa huruf';
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
				$this->M_Dokter->new_dokter($data_post);
				$this->set_flash_feedback('Berhasil tambah dokter', 'sukses');
				redirect('admin/dokter/edit/' . $this->M_Dokter->get_last_id());
			}else{
				$this->set_feedback($allow_create, 'error');
			}
		}else{
			$data_post['nama_dokter'] = '';
			$data_post['spesialis'] = '';
		}

		$data_view = $data_post;
		$form = $this->load->view('admin/dokter/V_Dokbaru', $data_view, TRUE);

		$this->show($form);
	}
}