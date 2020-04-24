<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_Dokter extends CI_Model{
	
	var $column_order = array(null, 'nama_dokter', 'nama_spesialisasi', 'no_telp');
	var $column_search = array('nama_dokter', 'nama_spesialisasi');
	var $order = array('nama_dokter' => 'asc');
	var $table = 'dokter';

	function __construct(){
		parent::__construct();
	}

	function get_detail_dokter(){
		$this->db->select('*');
		$this->db->from('spesialisasi');
		$this->db->join('dokter', 'dokter.id_spesialisasi = spesialisasi.id_spesialisasi');
	}

	function get_all(){
		$this->get_detail_dokter();
		return $this->db->get()->result_array();
	}

	function get_by_id($id_dokter){
		$this->db->where('id_dokter', $id_dokter);
		return $this->db->get('dokter')->row_array();
	}
	
	/* FUNCTION FOR DATATABLE AJAX */

	private function _get_datatables_query(){

		$post_search = $this->input->post('search');
		$post_order = $this->input->post('order');

		$this->get_detail_dokter();

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
		$this->get_detail_dokter();

		return $this->db->count_all_results();
	}

	/* END OF FUNCTION FOR DATATABLE AJAX */


	/*function cari_id($id_dokter, $page = 1){
		
		$this->db->limit(10, ($page-1) * 10);
		$this->db->select('(SELECT nama_spesialisasi FROM spesialisasi WHERE id_dokter = dokter.id_spesialisasi LIMIT 1) as spesialisasi, id_dokter, nama_dokter', FALSE);
		$this->db->where('id_dokter', $id_dokter);
		$query = $this->db->get('dokter');
		
		if($query->num_rows() > 0){
			return $query->result_array();
		}else{
			return NULL;
		}
	}*/

	function dokter_baru($data_dokter){
		/*$data = array(
			'id_dokter' => $data_dokter['id_dokter'],
			'nama_dokter' => $data_dokter['nama_dokter'],
			'nama_spesialisasi' => $data_dokter['nama_spesialisasi'],
			'alamat' => $data_dokter['alamat'],
			'no_telp' => $data_dokter['no_telp']
		);*/

		return $this->db->insert($this->table, $data);
	}

	function edit_dokter($id_dokter, $data_dokter){
		/*$data = array(
			'id_dokter' => $data_dokter['id_dokter'],
			'nama_dokter' => $data_dokter['nama_dokter'],
			'nama_spesialisasi' => $data_dokter['nama_spesialisasi'],
			'alamat' => $data_dokter['alamat'],
			'no_telp' => $data_dokter['no_telp']
		);*/

		$this->db->where('id_dokter', $id_dokter);
		return $this->db->update($this->table, $data_dokter);
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
