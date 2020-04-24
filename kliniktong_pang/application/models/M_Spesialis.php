<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_Spesialis extends CI_Model{
	function __construct(){
		parent::__construct();
	}

	function get_all_spesialisasi($page = 1){
		if($page !== 0){
			$this->db->limit(10, ($page-1) * 10);
		}
		$query = $this->db->get('spesialisasi');

		if($query->num_rows() > 0){
			return $query->result_array();
		}else{
			return NULL;
		}
	}

	function cari_id($id_spesialisasi, $page = 1){
		$this->db->limit(10, ($page-1) * 10);
		$this->db->where('id_spesialisasi', $id_spesialisasi);
		$query = $this->db->get('spesialisasi');

		if($query->num_rows() > 0){
			return $query->result_array();
		}else{
			return NULL;
		}
	}

	function cari_id_count($id_spesialisasi){
		$query = $this->db->get('spesialisasi', array('id_spesialisasi' => $id_spesialisasi));
		return $query->num_rows();
	}

	function cari_nama($nama_spesialisasi, $page = 1){
		$this->db->limit(10, ($page-1) * 10);
		$this->db->like('nama_spesialisasi', $nama_spesialisasi);
		$query = $this->db->get('spesialisasi');

		if($query->num_rows() > 0){
			return $query->result_array();
		}else{
			return NULL;
		}
	}

	function cari_nama_count($nama_spesialisasi){
		$this->db->like('nama_spesialisasi', $nama_spesialisasi);
		$query = $this->db->get('spesialisasi');

		return $query->num_rows();
	}

	function get_spesialis_by_id($id_spesialisasi, $array_row = TRUE){
		$query = $this->db->get_where('spesialisasi', array('id_spesialisasi'), 1);
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

	function get_nama_by_id($id_spesialisasi){
		if($id !== 0){
			$this->db->select('nama_spesialisasi');
			$query = $this->db->get_where('spesialisasi', array('id_spesialisasi' => $id_spesialisasi), 1);
			if($query->num_rows() > 0){
				$array = $query->row_array();
				return $array['nama_spesialisasi'];
			}else{
				return 'tanpa spesialis';
			}
		}else{
			return 'tanpa spesialis';
		}
	}

	function buat_spesialis($data_spesialis){
		$data = array(
			'nama_spesialisasi' => $data_spesialis['nama_spesialisasi']
		);

		$this->db->insert('spesialisasi', $data);
	}

	function edit_by_id($id_spesialisasi, $data_spesialis){
		$data = array(
			'nama_spesialisasi' => $data_spesialis['nama_spesialisasi']
		);

		$this->db->where('id_spesialisasi', $id_spesialisasi);
		$this->db->update('spesialisasi', $data);
	}

	function delete_spesialis_by_id($id_spesialisasi){
		if(is_array($id_spesialisasi)){
			$this->db->where_in('id_spesialisasi', $id_spesialisasi);
		}else{
			$this->db->where('id_spesialisasi', $id_spesialisasi);
		}
		$this->db->delete('spesialisasi');

		if(is_array($id_spesialisasi)){
			$this->db->where_in('id_spesialisasi', $id_spesialisasi);
		}else{
			$this->db->where('id_spesialisasi', $id_spesialisasi);
		}
		$data_update = array('id_spesialisasi' => 0);
		$this->db->update('spesialisasi', $data_update);
	}

	function delete_all_spesialis(){
		$this->db->empty_table('spesialisasi');
		$data_update = array('id_spesialisasi' => 0);
		$this->db->update('spesialisasi', $data_update);
	}

	function all_rows_count(){
		$query = $this->db->get('spesialisasi');
		return $query->num_rows();
	} 

	function exist_nama($nama_spesialisasi){
		$query = $this->db->get_where('spesialisasi', array('LOWER(nama_spesialisasi)' => strtolower($nama_spesialisasi)), 1);
		if($query->num_rows() > 0){
			return TRUE;
		}else{
			return FALSE;
		}
	}
}
