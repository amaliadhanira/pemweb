<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_Spesialisasi extends CI_Model{
	var $column_order = array(null, 'nama_spesialisasi', null);
	var $column_search = array('nama_spesialisasi');
	var $order = array('nama_spesialisasi' => 'asc');
	var $table = 'spesialisasi';

	function __construct(){
		parent::__construct();
	}

	function get_spesialisasi(){
		$this->db->select('*');
		$this->db->from('spesialisasi');
	}

	function get_all(){
		$this->get_spesialisasi();
		return $this->db->get()->result_array();
	}

	function get_by_id($id_spesialisasi){
		$this->db->where('id_spesialisasi', $id_spesialisasi);
		return $this->db->get($this->table)->row_array();
	}

	private function _get_datatables_query(){

		$post_search = $this->input->post('search');
		$post_order = $this->input->post('order');

		$this->get_spesialisasi();

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
		$this->get_spesialisasi();

		return $this->db->count_all_results();
	}

	function add_spesialisasi($data){
		return $this->db->insert($this->table, $data);
	}

	function update_spesialisasi($id_spesialisasi, $data){
		$this->db->where('id_spesialisasi', $id_spesialisasi);
		return $this->db->update($this->table, $data);
	}

	function del_spesialisasi($id_spesialisasi){
		$this->db->where('id_spesialisasi', $id_spesialisasi);
		$this->db->delete($this->table);
	}
}
