<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Lab extends ADM_Controller {
	
	public function __construct() {
		parent::__construct('admin');
		$this->load->model('M_Lab');
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
			redirect('admin/lab');
		}
		
		$this->cek_hapus();
		
		if($this->input->post('do_cari') !== FALSE)
		{
			$post = $this->input->post();
			redirect('admin/lab/cari/' . $post['pilihan_cari'] . '/' . $post['input_cari']);
		}
		//setup page links
		$this->load->library('pagination');

		$config['base_url'] = base_url() . 'index.php/admin/lab';
		$config['total_rows'] = $this->M_lab->all_rows_count();
		$config['use_page_numbers'] = TRUE;
		$config['per_page'] = 10; 

		$this->pagination->initialize($config);
		$data_view['pagelink'] = $this->pagination->create_links();
		$data_view['pilihan'] = '';
		$data_view['input_cari'] = '';
		
		$data_view['rows'] = $this->M_Admin->get_all_admin($page);
		$this->set_judul('list');
		$main = $this->load->view('admin/lab/main', $data_view, TRUE);
		$this->tampil($main);
	}

	function cari($pilihan = 'id_examiner', $input, $page = 1){
		$this->cek_hapus();
		
		switch($pilihan){
			case 'id':
				$data_view['rows'] = $this->M_lab->cari_id($input, $page);
				$config['total_rows'] = $this->M_lab->cari_id_count($input);
			break;
			case 'username':
				$data_view['rows'] = $this->M_lab->cari_username($input, $page);
				$config['total_rows'] = $this->M_lab->cari_username_count($input);
			break;
			default:
				redirect('admin/lab');
			break;
		}
		
		if( ! is_numeric($page)){
			redirect('admin/lab');
		}
		
		if($data_view['rows'] !== NULL){
			//setup page links
			$this->load->library('pagination');

			$config['base_url'] = base_url() . 'index.php/admin/lab';
			$config['use_page_numbers'] = TRUE;
			$config['per_page'] = 10; 

			$this->pagination->initialize($config);
			$data_view['pagelink'] = $this->pagination->create_links();
		
			$this->set_judul('pencarian ' . $pilihan);
			$data_view['pilihan'] = $pilihan;
			$data_view['input_cari'] = $input;
			$main = $this->load->view('admin/lab/main', $data_view, TRUE);
			$this->tampil($main);
		}else{
			$this->set_flash_feedback('Hasil pencarian tidak ada', 'info');
			redirect('admin/lab');
		}
	}

	function cek_hapus(){
		if($this->input->post('do_hapus') !== FALSE){
			$id = $this->input->post('id_hapus');
			if($id !== FALSE){
				$this->M_lab->delete_lab_by_id($id);
				$this->set_feedback('Berhasil hapus' . count($id). ' lab', 'info');
			}else{
				$this->set_flash_feedback('Pilih lab yang akan dihapus!', 'error');
			}
		}
	}

	function hapus_semua(){
		$this->M_lab->delete_all_lab();
		$this->set_flash_feedback('Sukses hapus semua lab', 'sukses');
		redirect('admin/lab');
	}

	function cek_edit($data_edit, $data_before){
		extract($data_edit);
		$array_error = array();

		if(trim($nama) === ''){
			$array_error[] = 'Nama lab tidak boleh kosong';
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

	function upload_foto($id_examiner =''){
		if(! is_numeric($id_examiner)){
			redirect('admin/lab');
		}else{
			$data_view = $this->M_lab->get_by_id($id_examiner);
			if($data_view === NULL){
				redirect('admin/lab');
			}
		
			$config['upload_path'] = './images/lab/';
			$config['allowed_types'] = 'jpg';
			$config['max_width']  = '250';
			$config['max_height']  = '250';
			$config['overwrite'] = TRUE;
			$config['file_name'] = $id_examiner;

			$this->set_judul('upload foto' . $data_view['nama']);

			if($this->input->post('upload_foto')){
				$this->set_feedback($this->upload->display_errors('',''), 'error');
			}else{
				$this->set_feedback('Sukses upload foto');
			}

			$form = $this->load->view('admin/lab/upload_foto', $data_view, TRUE);
			$this->show($form);
		}
	}

	function edit($id_examiner =''){
		if($id_examiner !== ''){
			$this->set_judul('edit');
			$data_view = $this->M_lab->get_by_id($id_examiner);

			if($this->input->post('do_edit')){
				$data_post = $this->input->post();
				$allow_edit = $this->cek_edit($data_post, $data_view);
				if($allow_edit === TRUE){
					$this->M_lab->edit_lab($id_examiner, $data_post);
					$this->set_flash_feedback('Sukses edit lab', 'sukses');
					redirect('admin/lab/edit' . $id_examiner);
				}else{
					$this->set_feedback($allow_edit, 'error');
				}
			}
			if($data_view !== NULL){
				$form = $this->load->view('admin/lab/V_Edit', $data_view, TRUE);
				$this->tampil($form);
			}else{
				$this->set_flash_feedback('Tidak ada lab dengan id' . $id_examiner, 'error');
				redirect('admin/lab');
			}
		}else{
			redirect('admin/adminpage');
		}
	}

	function cek_baru($data_lab){
		extract($data_lab);
		$array_error = array();

		if(trim($nama_examiner) === ''){
			$array_error[] = 'Nama lab tidak boleh kosong'
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

	function baru(){
		$this->set_judul('baru');

		if($this->inputpost('do_create') !== FALSE){
			$data_post = $this->input->post();
			$allow_create = $this->cek_baru($data_post);

			if($allow_create === TRUE){
				$this->M_lab->new_lab($data_post);
				$this->set_flash_feedback('Berhasil tambah lab', 'sukses');
				redirect('admin/lab/edit/' . $this->M_lab->get_last_id());
			}else{
				$this->set_feedback($allow_create, 'error');
			}
		}else{
			$data_post['nama_examiner'] = '';
		}

		$data_view = $data_post;
		$form = $this->load->view('admin/lab/V_Exmbaru', $data_view, TRUE);

		$this->show($form);
	}
}