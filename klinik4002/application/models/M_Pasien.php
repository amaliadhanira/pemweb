<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_Pasien extends CI_Model{
	var $column_order = array(null, 'nama_pasien', 'tanggal_lahir','username', 'alamat', 'no_telp','email','username');
	var $column_search = array('nama_pasien', 'username');
	var $order = array('username' => 'asc');
	var $table = 'pasien';

	function __construct(){
		parent::__construct();
	}

	function get_detail_pasien(){
		$this->db->select('*');
		$this->db->from('pasien');
	}

	function get_all(){
		$this->get_detail_pasien();
		return $this->db->get()->result_array();
	}

	function get_by_id($id_pasien){
		$this->db->where('id_pasien', $id_pasien);
		return $this->db->get('pasien')->row_array();
	}

	private function _get_datatables_query(){

		$post_search = $this->input->post('search');
		$post_order = $this->input->post('order');

		$this->get_detail_pasien();

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
		$this->get_detail_pasien();

		return $this->db->count_all_results();
	}

	function get_by_username($username){
		$this->db->where('username', $username);
		return $this->db->get('pasien')->row_array();
	}

	function new_pasien($data_pasien){
		$data = array(
			'nama_pasien' => $data_pasien['nama_pasien'],
			'ttl' => $data_pasien['ttl'],
			'username' => $data_pasien['username'],
			'alamat' => $data_pasien['alamat'],
			'no_telp' => $data_pasien['no_telp'],
			'email' => $data_pasien['email'],
			'password' => md5($data_pasien['password'])
		);
		
		$this->db->insert('pasien', $data);
	}

	function edit_pasien($id_pasien, $data_pasien){
		$data = array(
			'nama_pasien' => $data_pasien['nama_pasien'],
			'ttl' => $data_pasien['ttl'],
			'username' => $data_pasien['username'],
			'alamat' => $data_pasien['alamat'],
			'no_telp' => $data_pasien['no_telp'],
			'email' => $data_pasien['email'],
			'password' => md5($data_pasien['password'])
		);

		$this->db->where('id_pasien', $id_pasien);
		$this->db->update('pasien', $data);
	}

	function exist_username($username){
		$query = $this->db->where('pasien', array('username' => $username), 1);
		if($query->num_rows() > 0){
			return TRUE;
		}else{
			return FALSE;
		}
	}

	function exist_email($email){
		$query = $this->db->where('pasien', array('email' => $email), 1);
		if($query->num_rows() > 0){
			return TRUE;
		}else{
			return FALSE;
		}
	}

	function delete_pasien_by_id($id_pasien){
		$this->db->where('id_pasien', $id_pasien);
		$this->db->delete($this->table);
	}

	function delete_all_pasien(){
		$this->db->delete('pasien');
	}

	function all_rows_count(){
		$query = $this->db->get('pasien');
		return $query->num_rows();
	}
	
	function match_password($id_pasien, $password){
		$this->db->where('id_pasien', $id_pasien);
		$this->db->where('password', md5($password));
		$count = $this->db->from('pasien')->count_all_results();
		if ($count > 0){
			return true;
		} else {
			return false;
		}
	}
	
	function daftar_akun($data){
		return $this->db->insert('pasien', $data);
	}
	
	function update_pasien($id_pasien, $data){
		$this->db->where('id_pasien', $id_pasien);
		return $this->db->update('pasien', $data);
	}
}
?>
