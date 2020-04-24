<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Adminpage extends CI_Controller{
	function __construct(){
		parent::__construct();

		if ($this->session->status != 'login_admin'){
			redirect(base_url());
		}

		$this->load->model('m_admin');
	}

	function index(){
		$data['title'] = 'Home';
		$data['page'] = 'home';
		$this->load->view('admin/templates/v_header', $data);
		$this->load->view('admin/home', $data);
		$this->load->view('admin/templates/v_footer', $data);
	}

	function admin(){
		$data['title'] = 'Admin';
		$data['page'] = 'admin';
		$this->load->view('admin/templates/v_header', $data);
		$this->load->view('admin/adminaccount/v_daftar_admin', $data);
		$this->load->view('admin/adminaccount/v_buat', $data);
		$this->load->view('admin/adminaccount/v_edit', $data);
		$this->load->view('admin/templates/v_footer', $data);
	}

	// CONTROLLER FUNCTIONS FOR DATATABLE ADMIN 
	function data_admin(){
		$admin = $this->m_admin->get_datatables();
		$data = array();
		$id = $this->input->post('start');

		foreach($admin as $adm) {
			$dis = '';
			$id++;
			$row = array();
			$row[] = $id;
			$row[] = $adm['nama_admin'];
			$row[] = $adm['email'];
			$row[] = $adm['alamat'];
			$row[] = $adm['no_telp'];
			$row[] = $adm['username'];

			$row[] = '<button class="btn btn-sm btn-warning'. $dis .'"'. $dis .' data-id_admin="'. $adm['id_admin'] .'" id="edit_admin">Edit Admin</button> <button class="btn btn-sm btn-danger'. $dis .'"'. $dis .' data-id_admin="'. $adm['id_admin'] .'" id="hapus_admin">Hapus Admin</button>';

			$data[] = $row;
		}

		$output = array(
						"draw" => $this->input->post('draw'),
						"recordsTotal" => $this->m_admin->count_all(),
						"recordsFiltered" => $this->m_admin->count_filtered(),
						"data" => $data,
		);

		echo json_encode($output);
	}

	function cek_edit_admin($data_edit, $data_before){
		extract($data_edit);
		$array_error = array();
		
		//cek username
		if(trim($username) === ''){
			$array_error[] = 'Username tidak boleh kosong';
		}else if($this->m_admin->exist_username($username) === TRUE && $data_before['username'] != $username){
			$array_error[] = 'Username sudah ada yang punya';
		}
		
		//cek email
		$this->load->helper('email');
		if(trim($email) === ''){
			$array_error[] = 'Email tidak boleh kosong';
		}else if(valid_email($email) === FALSE){
			$array_error[] = 'Email tidak valid';
		}else if($this->m_admin->exist_email($email) === TRUE && $data_before['email'] != $email){
			$array_error[] = 'Email sudah ada yang punya';
		}
		
		//cek nomor hp, except for admin
		if(trim($no_telp) === '' && $id !== 1){
			$array_error[] = 'Nomor hp tidak boleh kosong';
		}else if(is_numeric($no_telp) === FALSE){
			$array_error[] = 'Nomor hp harus berupa angka';
		}
		
		//cek alamat, except for admin
		if(trim($alamat) === '' && $id !== 1){
			$array_error[] = 'Alamat tidak boleh kosong';
		}
		
		//final cek
		if(empty($array_error) === FALSE){
			return $array_error;
		}else{
			return TRUE;
		}
	}

	private function upload_foto($id_admin){
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

	function is_authorized($target_admin){
		if($target_admin['id'] !== 1){
			return TRUE;
		}else{
			return FALSE;
		}
	}

	function edit_admin(){	
		if($id !== ''){
			$this->set_judul('edit');
			$data_view = $this->member_model->get_member_by_id($id);
			
			//admin can't edit same level or higher
			if($this->is_authorized($data_view, $this->get_current_member()) === FALSE){
				$this->set_flash_feedback('Anda tidak dapat mengedit super!', 'error');
				redirect('admin/adminpage');
				return;
			}
			
			//cek post
			if($this->input->post('do_edit')){
				$id_admin = $this->input->post('id_admin');

				$data = array(
					'id_admin' => $this->input->post('id_admin'),
					'nama_admin' => $this->input->post('nama_admin'),
					'email' => $this->input->post('email'),
					'alamat' => $this->input->post('alamat'),
					'no_telp' => $this->input->post('no_telp'),
					'username' => $this->input->post('username'),
					'password' => $this->input->post('password')
				);

				$update = $this->m_admin->edit_admin($id_admin, $data);
				if ($update) {
					echo json_encode(array("success" => TRUE));
				}
				redirect('admin/adminpage/edit_admin');
			}else if($this->input->post('do_upload') !== FALSE){
				$this->upload_foto($data_view['id']);
			}
			
			if($data_view !== NULL){
				$form = $this->load->view('admin/adminaccount/edit_admin', $data_view, TRUE);
				$this->tampil($form);
			}else{
				$this->set_flash_feedback('Tidak ada admin dengan id ' . $id_admin, 'error');
				redirect('admin/adminpage');
			}
		}else{
			redirect('admin/adminpage');
		}
	}


	private function cek_buat_admin($data_admin){
		extract($data_admin);
		$array_error = array();
		
		//cek username
		if(trim($username) === ''){
			$array_error[] = 'Username tidak boleh kosong';
		}else if($this->m_admin->exist_username($username) === TRUE){
			$array_error[] = 'Username sudah ada yang punya';
		}
		
		//cek email
		$this->load->helper('email');
		if(trim($email) === ''){
			$array_error[] = 'Email tidak boleh kosong';
		}else if(valid_email($email) === FALSE){
			$array_error[] = 'Email tidak valid';
		}else if($this->m_admin->exist_email($email) === TRUE){
			$array_error[] = 'Email sudah ada yang punya';
		}
		
		//final cek
		if(empty($array_error) === FALSE){
			return $array_error;
		}else{
			return TRUE;
		}
	}

	function new_admin(){
		if($this->input->post('do_create') !== FALSE){
			$data_post = $this->input->post();
			$allow_create = $this->cek_buat_admin($data_post);
			
			if($allow_create === TRUE){
				$data = array(
					'id_admin' => $this->input->post('id_admin'),
					'nama_admin' => $this->input->post('nama_admin'),
					'email' => $this->input->post('email'),
					'alamat' => $this->input->post('alamat'),
					'no_telp' =>$this->input->post('no_telp'),
					'username' =>$this->input->post('username'),
					'password' =>$this->input->post('password')
				);

				$insert = $this->m_admin->new_admin($data_admin);
				if ($insert) {
					echo json_encode(array("success" => TRUE));
				}
			}
		}
	}


	function delete_by_id($id_admin){
		$this->m_admin->delete_admin_by_id($id_admin);
		echo json_encode(array("success" => TRUE));
	}

	function delete_semua(){
		$this->m_admin->delete_all_admin();
		echo json_encode(array("success" => TRUE));
	}
}

?>