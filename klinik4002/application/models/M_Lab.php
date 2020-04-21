<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_Lab extends CI_Model{

	function __construct(){
		parent::__construct();
	}

	function get_all(){
		return $this->db->get('lab')->result_array();
	}

	function get_by_id($id_lab){
		$this->db->where('id_lab', $id_lab);
		return $this->db->get('lab')->row_array();
	}

	function new_examiner($data_examiner){
		$data = array(
			'nama_examiner' => $data_examiner['nama_examiner'],
			'alamat' => $data_examiner['alamat'],
			'no_telp' => $data_examiner['no_telp']
		);
		
		$this->db->insert('examiner', $data);
	}

	function edit_examiner($id_examiner, $data_examiner){
		$data = array(
			'nama_examiner' => $data_examiner['nama_examiner'],
			'alamat' => $data_examiner['alamat'],
			'no_telp' => $data_examiner['no_telp']
		);

		$this->db->where('id_examiner', $id_examiner);
		$this->db->update('examiner', $data);
	}

	function delete_examiner_by_id($id_examiner){
		if(is_array($id_examiner)){
			$this->db->where_in('id_examiner', $id_examiner);
		}else{
			$this->db->where('id_examiner', $id_examiner);
		}
	}

	function delete_all_examiner(){
		$this->db->delete('examiner');
	}

	function all_rows_count(){
		$query = $this->db->get('examiner');
		return $query->num_rows();
	}
}
?>