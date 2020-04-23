<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Adminpage extends ADM_Controller {
	
	public function __construct() {
		parent::__construct('admin');
		$this->load->model('M_Admin');
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
			redirect('admin/adminpage');
		}
		
		$this->cek_hapus();
		
		if($this->input->post('do_cari') !== FALSE)
		{
			$post = $this->input->post();
			redirect('admin/adminpage/cari/' . $post['pilihan_cari'] . '/' . $post['input_cari']);
		}
		//setup page links
		$this->load->library('pagination');

		$config['base_url'] = base_url() . 'index.php/admin/adminpage';
		$config['total_rows'] = $this->M_Admin->all_rows_count();
		$config['use_page_numbers'] = TRUE;
		$config['per_page'] = 10; 

		$this->pagination->initialize($config);
		$data_view['pagelink'] = $this->pagination->create_links();
		$data_view['pilihan'] = '';
		$data_view['input_cari'] = '';
		
		$data_view['rows'] = $this->M_Admin->get_all_admin($page);
		$this->set_judul('list');
		$main = $this->load->view('admin/adminaccount/main', $data_view, TRUE);
		$this->tampil($main);
	}

	function cari($pilihan = 'id_admin', $input, $page = 1){
		$this->cek_hapus();
		
		switch($pilihan)
		{
			case 'id':
				$data_view['rows'] = $this->M_Admin->cari_id($input, $page);
				$config['total_rows'] = $this->M_Admin->cari_id_count($input);
			break;
			case 'username':
				$data_view['rows'] = $this->M_Admin->cari_username($input, $page);
				$config['total_rows'] = $this->M_Admin->cari_username_count($input);
			break;
			default:
				redirect('admin/adminpage');
			break;
		}
		
		if( ! is_numeric($page)){
			redirect('admin/page');
		}
		
		if($data_view['rows'] !== NULL){
			//setup page links
			$this->load->library('pagination');

			$config['base_url'] = base_url() . 'index.php/admin/adminpage';
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
			redirect('admin/adminpage');
		}
	}

	function cek_hapus(){
		if($this->input->post('do_hapus') !== FALSE){
			$id = $this->input->post('id_post');
			if($id !== FALSE){
				$this->M_Admin->delete_admin_by_id($id_admin);
				$this->set_feedback('Berhasil dihapus' . count($id_admin) . ' admin', 'sukses');
			}else{
				$this->set_feedback('Pilih admin yang akan dihapus', 'error');
			}
		}
	}

	function lihat($id_admin = ''){
		if(is_numeric($id_admin) === TRUE){
			$this->set_judul('lihat');
			$data_view = $this->M_Admin->get_by_id($id_admin);

			if($data_view !== NULL){
				$form = $this->load->view('admin/adminaccount/V_Lihat', $data_view, TRUE);
				$this->tampil($form);
			}else{
				$this->set_flash_feedback('Tidak ada admin dengan id' . $id_admin, 'error');
				redirect('admin/adminpage');
			}
		}else{
			redirect('admin/adminpage');
		}
	}

	function hapus($id_admin = ''){
		if(is_numeric($id_admin)){
			$data_admin = $this->M_Admin->get_by_id($id_admin);

			if($this->is_authorized($data_admin, $this->get_current_admin()) === FALSE){
				$this->set_flash_feedback('Anda tidak dapat menghapus admin!', 'error');
				redirect('admin/adminpage');
				return;
			}
			$this->M_Admin->delete_admin_by_id($id_admin);
			$this->set_flash_feedback('Berhasil hapus admin', 'sukses');
		}
		redirect('admin/adminpage');
	}

	function hapus_semua(){
		$this->M_Admin->delete_all_admin();
		$this->set_flash_feedback('Berhasil hapus semua admin', 'sukses');
		redirect('admin/adminpage');
	}

	function cek_sign_up($data_admin){
		extract($data_admin);
		$array_error = array();

		if(trim($username) === ''){
			$array_error[] = 'Username harus diisi';
		}else if($this->M_Admin->exist_username($username) === TRUE){
			$array_error[] = 'Username sudah ada yang punya';
		}

		$this->load->helper('email');
		if(trim($email) === ''){
			$array_error[] = 'Email harus diisi';
		}else if($this->M_Admin->exist_email($email) === TRUE){
			$array_error[] = 'Email sudah ada yang punya';
		}else if(valid_email($email) === FALSE){
			$array_error[] = 'Email tidak valid';
		}

		if(trim($no_telp) === '' && $id_admin != 1){
			$array_error[] = 'Nomor HP tidak boleh kosong';
		}else if(is_numeric($no_telp) === FALSE){
			$array_error[] = 'Harus berupa angka';
		}

		if(trim($alamat) === '' && $id_admin != 1){
			$array_error[] = 'Alamat tidak boleh kosong';
		}

		if(empty($array_error) === FALSE){
			return $array_error;
		}else{
			return TRUE;
		}
	}

	function sign_up(){
		if($this->input->post('do_create') !== FALSE){
			$data_post = $this->input->post();
			$data_post['password'] = random_string('alnum', 8);
			$allow_create = $this->cek_sign_up($data_post);

			if($allow_create === TRUE){
				$this->M_Admin->new_admin($data_post);
				$form = $this->load->view('admin/adminaccount/V_Adminsiap', '', TRUE);
			}else{
				$this->set_feedback($allow_create, 'error');
				$form = $this->load->view('admin/adminaccount/V_Signup', '', TRUE);
			}
		}else{
			$form = $this->load->view('admin/adminaccount/V_Signup', '', TRUE);
		}
		$this->show($form);
	}

	function lupa_password(){
		$token = $this->base64url_decode($this->url->segment(4));
		$cleanToken = $this->security->xss_clean($token);

		$info = $this->M_Admin->is_valid_token($cleanToken);

		$this->form_validation->set_rules('newpw', 'Password Baru', 'required|min_length[8]');
		$this->form_validation->set_rules('repw', 'Re enter password', 'required|matches[password]');

		if($this->form_validation->run() == FALSE){
			$this->load->view('admin/adminaccount/V_Lupa', $data);
		}else{
			$post = $this->input->post(NULL,TRUE);
			$cleanPost = $this->security->xss_clean($post);
			$hashed = md5(cleanPost['password']);
			$cleanPost['password'] = $hashed;
			$cleanPost['id_admin'] = $info->id_admin;
			unset($cleanPost['repw']);
			if(!$this->M_Admin->update_password){
				$this->session->set_flashdata('sukses', 'Ganti password gagal');
			}else{
				$this->session->set_flashdata('sukses', 'Password berhasil diganti. Silakan Login');
			}
			redirect('admin/adminpage');
		}
	}

	function base64url_encode($data){
		return rtrim(strtr(base64_encode($data), '+/', '-_'),'=');
	}

	function base64url_decode($data){
		return base64_decode(str_pad(strtr($data, '-_', '+/'), strlen($data)%4,'=',STR_PAD_RIGHT));
	}

	function cek_edit($edit_admin, $admin_before){
		extract($data_admin);
		$array_error = array();

		if(trim($username) === ''){
			$array_error[] = 'Username harus diisi';
		}else if($this->M_Admin->exist_username($username) === TRUE){
			$array_error[] = 'Username sudah ada yang punya';
		}

		$this->load->helper('email');
		if(trim($email) === ''){
			$array_error[] = 'Email harus diisi';
		}else if($this->M_Admin->exist_email($email) === TRUE){
			$array_error[] = 'Email sudah ada yang punya';
		}else if(valid_email($email) === FALSE){
			$array_error[] = 'Email tidak valid';
		}

		if(trim($no_telp) === '' && $id_admin !== 1){
			$array_error[] = 'Nomor HP tidak boleh kosong';
		}else if(is_numeric($no_telp) === FALSE){
			$array_error[] = 'Harus berupa angka';
		}

		if(trim($alamat) === '' && $id_admin !== 1){
			$array_error[] = 'Alamat tidak boleh kosong';
		}

		if(empty($array_error) === FALSE){
			return $array_error;
		}else{
			return TRUE;
		}
	}

	function upload_foto($id_admin){
		$config['upload_path'] = './images/avatar/';
		$config['allowed_types'] = 'jpg';
		$config['max_width']  = '150';
		$config['max_height']  = '150';
		$config['overwrite'] = TRUE;
		$config['file_name'] = $id_admin;
		
		$this->load->library('upload', $config);
		
		if ( ! $this->upload->do_upload('avatar')){
			$this->set_feedback($this->upload->display_errors('',''), 'error');
		}else{
			$this->set_feedback('Sukses upload avatar', 'sukses');
		}	
	}

	function is_authorized($target_admin,$current_admin){
		if($target_admin['id_admin'] !== $current_admin['id_admin']){
			return TRUE;
		}else{
			return FALSE;
		}
	}

	function edit($id_admin = ''){
		if($id_admin !== ''){
			$this->set_judul('edit');
			$data_view = $this->M_Admin->get_by_id($id_admin);
			
			if($this->is_authorized($data_view, $this->get_current_admin()) === FALSE){
				$this->set_flash_feedback('Anda tidak dapat mengedit admin!', 'error');
				redirect('admin/adminpage');
				return;
			}
			
			if($this->input->post('do_edit')){
				$data_post = $this->input->post();
				$allow_edit = $this->cek_edit($data_post, $data_view);
				if($allow_edit === TRUE){
					$this->M_Admin->edit_by_id($id_admin, $data_post);
					$this->set_flash_feedback('Sukses edit admin', 'sukses');
					redirect('admin/adminpage/edit/' . $id_admin);
				}else{
					$this->set_feedback($allow_edit, 'error');
				}
				
			}else if($this->input->post('do_upload') !== FALSE){
				$this->upload_foto($data_view['id_admin']);
			}
			
			if($data_view !== NULL){
				$form = $this->load->view('admin/adminaccount/V_Edit', $data_view, TRUE);
				$this->tampil($form);
			}else{
				$this->set_flash_feedback('Tidak ada admin dengan id ' . $id_admin, 'error');
				redirect('admin/adminpage');
			}
		}else{
			redirect('admin/adminpage');
		}
	}
}
?>