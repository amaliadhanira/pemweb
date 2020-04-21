<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Adminpage extends ADM_Controller {
	
	public function __construct() {
		parent::__construct('member');
		$this->load->model('member_model');
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
		
		$data_view['rows'] = $this->M_Admin->get_all_member($page);
		$this->set_judul('list');
		$main = $this->load->view('admin/adminpage/main', $data_view, TRUE);
		$this->tampil($main);
	}

	function cari($pilihan = 'id', $input, $page = 1){
		
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
		
		if( ! is_numeric($page))
		{
			redirect('admin/page');
		}
		
		if($data_view['rows'] !== NULL)
		{
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
			$main = $this->load->view('admin/adminpage/main', $data_view, TRUE);
			$this->tampil($main);
		}
		else
		{
			$this->set_flash_feedback('Hasil pencarian tidak ada', 'info');
			redirect('admin/adminpage');
		}
	}

	function cek_hapus()
	{
		if($this->input->post('do_hapus') !== FALSE)
		{
			$id = $this->input->post('id_hapus');
			if($id !== FALSE)
			{
				$this->member_model->delete_member_by_id($id);
				$this->set_feedback('Berhasil hapus ' . count($id) . ' members', 'sukses');
			}
			else
			{
				$this->set_feedback('Pilih member yang akan dihapus !', 'error');
			}
		}
	}

	function reset_password($id = '')
	{
		if($id !== '')
		{
			$data_member = $this->member_model->get_member_by_id($id);
			
			if($data_member !== NULL)
			{
				//admin can't edit same level or higher
				if($this->is_authorized($data_member, $this->get_current_member()) === FALSE)
				{
					$this->set_flash_feedback('Anda tidak dapat mereset password member dengan level setara atau lebih tinggi!', 'error');
					redirect('administrator/member');
					return;
				}
				$this->set_judul('reset password');
				$data_member['password'] = random_string('alnum', 6);
				$this->member_model->update_password_by_id($id, $data_member['password']);
				$form = $this->load->view('backend/member/reset_password', $data_member, TRUE);
				$this->tampil($form);
			}
			else
			{
				$this->set_feedback('Tidak ada member dengan id ' . $id, 'error');
				redirect('administrator/member');
			}
		}
		else
		{
			redirect('administrator/member');
		}
	}

	function lihat($id = '')
	{		
		if(is_numeric($id) === TRUE)
		{
			$this->set_judul('lihat');
			$data_view = $this->member_model->get_member_by_id($id);
			
			if($data_view !== NULL)
			{
				$form = $this->load->view('backend/member/lihat_member', $data_view, TRUE);
				$this->tampil($form);
			}
			else
			{
				$this->set_flash_feedback('Tidak ada member dengan id ' . $id, 'error');
				redirect('administrator/member');
			}
		}
		else
		{
			redirect('administrator/member');
		}
	}
?>