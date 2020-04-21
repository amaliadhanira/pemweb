<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_Pasien extends CI_Model{

	function __construct(){
		parent::__construct();
	}

	function get_all(){
		return $this->db->get('pasien')->result_array();
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
		if(is_array($id_pasien)){
			$this->db->where_in('id_pasien', $id_pasien);
		}else{
			$this->db->where('id_pasien', $id_pasien);
		}
	}

	function delete_all_pasien(){
		$this->db->delete('pasien');
	}

	function all_rows_count(){
		$query = $this->db->get('pasien');
		return $query->num_rows();
	}
}
?>