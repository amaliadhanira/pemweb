<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_Farmasi extends CI_Model{

	function __construct(){
		parent::__construct();
	}

	function get_all(){
		return $this->db->get('farmasi')->result_array();
	}

	function get_by_id($id_apoteker){
		$this->db->where('id_apoteker', $id_apoteker);
		return $this->db->get('farmasi')->row_array();
	}

	function new_farmasi($data_farmasi){
		$data = array(
			'nama_apoteker' => $data_apoteker['nama_apoteker'],
			'alamat' => $data_apoteker['alamat'],
			'no_telp' => $data_apoteker['no_telp']
		);
		
		$this->db->insert('apoteker', $data);
	}

	function edit_apoteker($id_apoteker, $data_apoteker){
		$data = array(
			'nama_apoteker' => $data_apoteker['nama_apoteker'],
			'alamat' => $data_apoteker['alamat'],
			'no_telp' => $data_apoteker['no_telp']
		);

		$this->db->where('id_apoteker', $id_apoteker);
		$this->db->update('apoteker', $data);
	}

	function delete_apoteker_by_id($id_apoteker){
		if(is_array($id_apoteker)){
			$this->db->where_in('id_apoteker', $id_apoteker);
		}else{
			$this->db->where('id_apoteker', $id_apoteker);
		}
	}

	function delete_all_apoteker(){
		$this->db->delete('apoteker');
	}

	function all_rows_count(){
		$query = $this->db->get('apoteker');
		return $query->num_rows();
	}
}
?>