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
		$this->load->view('admin/adminaccount/v_data_admin', $data);
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

	function new_admin(){
		$data['title'] = 'Admin Baru';
		$data['page'] = 'new_admin';
		
		$this->load->view('admin/templates/v_header', $data);
		$this->load->view('admin/v_new_admin', $data);
		$this->load->view('admin/templates/v_footer', $data);
	}

	function admin_baru(){
		$this->m_admin->new_admin($data_admin);

		$this->form_validation->set_rules('nama_admin', 'Nama Lengkap', 'trim|required|alpha_numeric_spaces');
		$this->form_validation->set_rules('alamat', 'Alamat', 'required');
		$this->form_validation->set_rules('no_telp', 'Nomor Telepon', 'trim|required|numeric|min_length[10]|max_length[13]');
		$this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[users.email]');
		$this->form_validation->set_rules('username', 'username', 'required', 'min_length[5]|max_length[10]');
		$this->form_validation->set_rules('password', 'Sandi', 'trim|required|min_length[6]');
		$this->form_validation->set_rules('passconf', 'Konfirmasi Sandi', 'trim|required|matches[password]');

		if ($this->form_validation->run() == FALSE){
			redirect('admin/adminpage/new_admin');
		} else {
			if ($this->m_admin>match_password($id_admin, $password)){
			$data['info_msg'] = $this->session->set_flashdata('info_msg', 'success');
			$this->m_admin->new_admin($id_admin, $data_admin);
			} else {
			$data['info_msg'] = $this->session->set_flashdata('info_msg', 'error');
			}
		}
		redirect('admin/adminpage/new_admin');
	}

	function edit_admin(){
		$data['title'] = 'Edit Admin';
		$data['page'] = 'edit_admin';
		$data['admin'] = $this->m_admin->get_by_username($this->session->username);

		$this->load->view('admin/templates/v_header', $data);
		$this->load->view('admin/v_edit_admin', $data);
		$this->load->view('admin/templates/v_footer', $data);
	}

	function edit_profil(){
		$id_admin = $this->input->post('id_admin');
		$password = $this->input->post('password');

		//FORM VALIDATION
		$this->form_validation->set_rules('nama_admin', 'Nama Lengkap', 'trim|required|alpha_numeric_spaces');
		$this->form_validation->set_rules('alamat', 'Alamat', 'required');
		$this->form_validation->set_rules('no_telp', 'Nomor Telepon', 'trim|required|numeric|min_length[10]|max_length[13]');
		$this->form_validation->set_rules('password', 'Sandi', 'trim|required|min_length[6]');
		$this->form_validation->set_rules('passconf', 'Konfirmasi Sandi', 'trim|required|matches[password]');

		$input = array(
			'nama_admin' => $this->input->post('nama_admin'),
			'alamat' => $this->input->post('alamat'),
			'no_telp' => $this->input->post('no_telp'),
		);

		if ($this->form_validation->run() == FALSE){
			redirect('admin/adminpage/edit_admin');
		} else {
			if ($this->m_admin>match_password($id_admin, $password)){
			$data['info_msg'] = $this->session->set_flashdata('info_msg', 'success');
			$this->m_admin->edit_admin($id_admin, $data_admin);
			} else {
			$data['info_msg'] = $this->session->set_flashdata('info_msg', 'error');
			}
		}
		redirect('admin/adminpage/edit_admin');
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