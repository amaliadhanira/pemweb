<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_Admin extends CI_Model{
	var $column_order = array(null, 'username', 'nama_admin', 'no_telp');
	var $column_search = array('username', 'nama_sadmin');
	var $order = array('nama_admin' => 'asc');
	var $table = 'admin';

	function __construct(){
		parent::__construct();
	}

	function get_detail_admin(){
		$this->db->select('*');
		$this->db->from('admin');
	}

	function get_all(){
		$this->get_detail_admin();
		return $this->db->get()->result_array();
	}

	function get_by_id($id_admin){
		$this->db->where('id_admin', $id_admin);
		return $this->db->get('admin')->row_array();
	}

	private function _get_datatables_query(){

		$post_search = $this->input->post('search');
		$post_order = $this->input->post('order');

		$this->get_detail_admin();

		$i = 0;

		foreach($this->column_search as $item){
			if($post_search['value']){
				if($i===0){
					$this->db->group_start();
					$this->db->like($item, $post_search['value']);
				} else {
					$this->db->or_like($item, $post_search['value']);
				}

				if(count($this->column_search)-1 == $i){
					$this->db->group_end();
				}
			}
			$i++;
		}

		if($post_order){
			$this->db->order_by($this->column_order[$post_order['0']['column']], $post_order['0']['dir']);
		} else if (isset($this->order)) {
			$order = $this->order;
			$this->db->order_by(key($order), $order[key($order)]);
		}
	}

	function get_datatables(){
		$this->_get_datatables_query();
		if($this->input->post('length') != -1){
			$this->db->limit($this->input->post('length'), $this->input->post('start'));
			return $this->db->get()->result_array();
		}
	}

	function count_filtered(){
		$this->_get_datatables_query();
		return $this->db->get()->num_rows();
	}

	function count_all(){
		$this->get_detail_admin();

		return $this->db->count_all_results();
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

	function cari_id_count($id){
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

	function cari_username_count($username){
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
		return $this->db->update($this->table, $data_admin);
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
		$this->db->insert($this->table, $data);
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

	function match_password($id_admin, $password){
		$this->db->where('id_admin', $id_admin);
		$this->db->where('password', md5($password));
		$count = $this->db->from('admin')->count_all_results();
		if ($count > 0){
			return true;
		} else {
			return false;
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

	/*function is_valid_token($token){
		$this->db->select('id_admin');
		$this->db->where('sha1(admin.email)"-"admin.password) = $token');
		$this->db->get('admin');*/
	
}
?>