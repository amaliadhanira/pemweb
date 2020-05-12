<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_Lab extends CI_Model{
	var $column_order = array(null, 'nama_examiner', 'alamat', 'no_telp', null);
	var $column_search = array('nama_examiner');
	var $order = array('nama_examiner' => 'asc');
	var $table = 'lab';

	function __construct(){
		parent::__construct();
	}

	function get_lab(){
		$this->db->select('*');
		$this->db->from('lab');
	}

	function get_all(){
		$this->get_lab();
		return $this->db->get()->result_array();
	}

	function get_by_id($id_examiner){
		$this->db->where('id_examiner', $id_examiner);
		return $this->db->get($this->table)->row_array();
	}

	private function _get_datatables_query(){

		$post_search = $this->input->post('search');
		$post_order = $this->input->post('order');

		$this->get_lab();

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
		$this->get_lab();

		return $this->db->count_all_results();
	}

	function add_lab($data){
		return $this->db->insert($this->table, $data);
	}

	function update_lab($id_examiner, $data){
		$this->db->where('id_examiner', $id_examiner);
		return $this->db->update($this->table, $data);
	}

	function del_lab($id_examiner){
		$this->db->where('id_examiner', $id_examiner);
		$this->db->delete($this->table);
	}
	
}
?>