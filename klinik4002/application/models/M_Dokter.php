<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_Dokter extends CI_Model{

	function __construct(){
		parent::__construct();
	}

	function get_all(){
		return $this->db->get('dokter')->result_array();
	}

	function get_by_id($id_dokter){
		$this->db->where('id_dokter', $id_dokter);
		return $this->db->get('dokter')->row_array();
	}

	function cari_id($id_dokter, $page = 1){
		
		$this->db->limit(10, ($page-1) * 10);
		$this->db->select('(SELECT nama FROM kategori WHERE id = produk.id_kategori LIMIT 1) as kategori, id, nama, harga, deskripsi, tersedia, dilihat, dipesan', FALSE);
		$this->db->where('id', $id);
		$query = $this->db->get('dokter');
		
		if($query->num_rows() > 0){
			return $query->result_array();
		}else{
			return NULL;
		}
	}

	function dokter_baru($data_dokter){
		$data = array(
			'id_dokter' => $data_dokter['id_dokter'],
			'nama_dokter' => $data_dokter['nama_dokter'],
			'spesialis' => $data_dokter['spesialis'],
			'alamat' => $data_dokter['alamat'],
			'no_telp' => $data_dokter['no_telp']
		);

		$this->db->insert('dokter', $data);
	}

	function edit_dokter($id_dokter, $data_dokter){
		$data = array(
			'id_dokter' => $data_dokter['id_dokter'],
			'nama_dokter' => $data_dokter['nama_dokter'],
			'spesialis' => $data_dokter['spesialis'],
			'alamat' => $data_dokter['alamat'],
			'no_telp' => $data_dokter['no_telp']
		);

		$this->db->where('id_dokter', $id_dokter)
	}

	function get_last_id(){
		return $this->db->insert_id();
	}

	function delete_dokter_by_id($id_dokter){
		if(is_array($id_dokter)){
			$this->db->where_in('id_dokter', $id_dokter);
		}else{
			$this->db->where('id_dokter', $id_dokter);
		}
	}

	function delete_all_dokter(){
		$this->db->delete('dokter');
	}

	function all_rows_count(){
		$query = $this->db->get('dokter');
		return $query->num_rows();
	}
}
?>