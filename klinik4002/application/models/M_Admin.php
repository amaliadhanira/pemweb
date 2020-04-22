<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_Admin extends CI_Model{

	function __construct(){
		parent::__construct();
	}

	function get_all(){
		return $this->db->get('admin')->result_array();
	}

	function get_by_id($id_admin, $array_row = TRUE){
		$query = $this->db->get_where('admin', array('id_admin' => $id_admin), 1);
		if($query->num_rows() > 0){
			if($array_row === TRUE){
				return $query->row_array();
			}else{
				return $query->row();
			}
		}else{
			return NULL;
		}
	}

	function get_by_username($username){
		$this->db->where('username', $username);
		return $this->db->get('admin')->row_array();
	}

	function get_by_email($email, $array_row = TRUE){
		$query = $this->db->get_where('admin', array('email' => $email), 1);
		if($query->num_rows() > 0){
			if($array_row === TRUE){
				return $query->row_array();
			}else{
				return $query->row();
			}
		}else{
			return NULL;
		}
	}

	function cari_id($id_admin, $page = 1){
		$this->db->limit(10, ($page-1) * 10);
		$this->db->where('id_admin', $id_admin);
		$query = $this->db->get('admin');
		
		if($query->num_rows() > 0)
		{
			return $query->result_array();
		}
		else
		{
			return NULL;
		}
	}

	function cari_id_count($id)
	{
		$query = $this->db->get('admin', array('id' => $id));
		return $query->num_rows();
	}

	function cari_username($username, $page = 1){
		$this->db->limit(10, ($page-1) * 10);
		$this->db->like('username', $username);
		$query = $this->db->get('admin');
		
		if($query->num_rows() > 0)
		{
			return $query->result_array();
		}
		else
		{
			return NULL;
		}
	}

	function cari_username_count($username)
	{
		$this->db->like('username', $username);
		$query = $this->db->get('admin');
		
		return $query->num_rows();
	}

	function edit_admin($id_admin, $data_admin, $from_admin = TRUE){
		$data = array(
			'nama_admin' => $data_admin['nama_admin'],
			'email' => $data_admin['email'],
			'alamat' => $data_admin['alamat'],
			'no_telp' => $data_admin['no_telp'],
			'username' => $data_admin['username'],
			'password' => md5($data_admin['password'])
		);

		$this->db->where('id_admin', $id_admin);
		$this->db->update('admin', $data);
	}

	function new_admin($data_admin){
		$data = array(
			'id_admin' => $data_admin['id_admin'],
			'nama_admin' => $data_admin['nama_admin'];
			'email' => $data_admin['email'],
			'alamat' => $data_admin['alamat'],
			'no_telp' => $data_admin['no_telp'],
			'username' => $data_admin['username'],
			'password' => md5($data_admin['password'])
		);
		$this->db->insert('admin', $data);
	}

	function exist_username($username){
		$query = $this->db->where('admin', array('username' => $username), 1);
		if($query->num_rows() > 0){
			return TRUE;
		}else{
			return FALSE;
		}
	}

	function exist_email($email){
		$query = $this->db->where('admin', array('email' => $email), 1);
		if($query->num_rows() > 0){
			return TRUE;
		}else{
			return FALSE;
		}
	}

	function delete_admin_by_id($id_admin){
		if(is_array($id_admin)){
			$this->db->where_in('id_admin', $id_admin);
		}else{
			$this->db->where('id_admin', $id_admin);
		}

		$this->db->where('id_admin !=', '1');
		$this->db->delete('admin');
	}

	function delete_all_admin(){
		$this->db->where('id_admin !=', '1');
		$this->db->delete('admin');
	}

	function all_rows_count(){
		$query = $this->db->get('admin');
		return $query->num_rows();
	}

	function update_password($post){
		$this->db->where('id_admin', $post['id_admin']);
		$this->db->update('admin', array('password' => $post['password']));
		return TRUE;
	}

	function is_valid_token($token){
		$this->db->select('id_admin');
		$this->db->where('sha1(admin.email)"-"admin.password) = $token');
		$this->db->get('admin');
	}
}
?>