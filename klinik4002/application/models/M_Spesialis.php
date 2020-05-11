<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_Spesialis extends CI_Model{
	function __construct(){
		parent::__construct();
	}

	function get_detail_spesialisasi(){
		$this->db->select('*');
		$this->db->from('spesialisasi');
	}

	function get_all(){
		$this->get_detail_spesialisasi();
		return $this->db->get()->result_array();
	}

	function tambah_spesialis($data_spesialis){
		return $this->db->insert('spesialisasi', $data_spesialis);
	}

	function delete_spesialis($id_spesialisasi){
		$this->db->where('id_spesialisasi', $id_spesialisasi);
		$this->db->delete('spesialisasi');
	}
}
