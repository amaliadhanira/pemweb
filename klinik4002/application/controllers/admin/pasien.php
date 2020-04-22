<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pasien extends ADM_Controller {
	
	public function __construct() {
		parent::__construct('pasien');
		$this->load->model('M_pasien');
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
			redirect('admin/pasien');
		}
		
		$this->cek_hapus();
		
		if($this->input->post('do_cari') !== FALSE)
		{
			$post = $this->input->post();
			redirect('pasien/pasienpage/cari/' . $post['pilihan_cari'] . '/' . $post['input_cari']);
		}
		//setup page links
		$this->load->library('pagination');

		$config['base_url'] = base_url() . 'index.php/admin/pasien';
		$config['total_rows'] = $this->M_Pasien->all_rows_count();
		$config['use_page_numbers'] = TRUE;
		$config['per_page'] = 10; 

		$this->pagination->initialize($config);
		$data_view['pagelink'] = $this->pagination->create_links();
		$data_view['pilihan'] = '';
		$data_view['input_cari'] = '';
		
		$data_view['rows'] = $this->M_Pasien->get_all_pasien($page);
		$this->set_judul('list');
		$main = $this->load->view('pasien/main', $data_view, TRUE);
		$this->tampil($main);
	}

	function cari($pilihan = 'id_pasien', $input, $page = 1){
		$this->cek_hapus();
		
		switch($pilihan)
		{
			case 'id':
				$data_view['rows'] = $this->M_Pasien->cari_id($input, $page);
				$config['total_rows'] = $this->M_Pasien->cari_id_count($input);
			break;
			case 'username':
				$data_view['rows'] = $this->M_Pasien->cari_username($input, $page);
				$config['total_rows'] = $this->M_Pasien->cari_username_count($input);
			break;
			default:
				redirect('admin/pasien');
			break;
		}
		
		if( ! is_numeric($page)){
			redirect('admin/pasien');
		}
		
		if($data_view['rows'] !== NULL){
			//setup page links
			$this->load->library('pagination');

			$config['base_url'] = base_url() . 'index.php/admin/pasien';
			$config['use_page_numbers'] = TRUE;
			$config['per_page'] = 10; 

			$this->pagination->initialize($config);
			$data_view['pagelink'] = $this->pagination->create_links();
		
			$this->set_judul('pencarian ' . $pilihan);
			$data_view['pilihan'] = $pilihan;
			$data_view['input_cari'] = $input;
			$main = $this->load->view('admin/main', $data_view, TRUE);
			$this->tampil($main);
		}else{
			$this->set_flash_feedback('Hasil pencarian tidak ada', 'info');
			redirect('admin/pasien');
		}
	}

	function cek_hapus(){
		if($this->input->post('do_hapus') !== FALSE){
			$id = $this->input->post('id_post');
			if($id !== FALSE){
				$this->M_pasien->delete_pasien_by_id($id);
				$this->set_feedback('Berhasil dihapus' . count($id) . ' pasien', 'sukses');
			}else{
				$this->set_feedback('Pilih pasien yang akan dihapus', 'error');
			}
		}
	}

	function lihat($id_pasien = ''){
		if(is_numeric($id_pasien) === TRUE){
			$this->set_judul('lihat');
			$data_view = $this->M_pasien->get_by_id($id_pasien);

			if($data_view !== NULL){
				$form = $this->load->view('pasien/pasienaccount/V_Lihat', $data_view, TRUE);
				$this->tampil($form);
			}else{
				$this->set_flash_feedback('Tidak ada pasien dengan id' . $id_pasien, 'error');
				redirect('pasien/pasienpage');
			}
		}else{
			redirect('pasien/pasienpage');
		}
	}

	function hapus($id_pasien = ''){
		if(is_numeric($id_pasien)){
			$data_pasien = $this->M_pasien->get_by_id($id_pasien);

			if($this->is_authorized($data_pasien, $this->get_current_pasien()) === FALSE){
				$this->set_flash_feedback('Anda tidak dapat menghapus pasien!', 'error');
				redirect('pasien/pasienpage');
				return;
			}
			$this->M_pasien->delete_pasien_by_id($id_pasien);
			$this->set_flash_feedback('Berhasil hapus pasien', 'sukses');
		}
		redirect('pasien/pasienpage');
	}

	function hapus_semua(){
		$this->M_pasien->delete_all_pasien();
		$this->set_flash_feedback('Berhasil hapus semua pasien', 'sukses');
		redirect('pasien/pasienpage');
	}
}
?>