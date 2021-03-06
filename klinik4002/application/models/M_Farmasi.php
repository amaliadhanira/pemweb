<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_Farmasi extends CI_Model{
	var $column_order = array(null, 'nama_apoteker', 'alamat', 'no_telp', null);
	var $column_search = array('nama_apoteker', 'no_telp');
	var $order = array('nama_apoteker' => 'asc');
	var $table = 'farmasi';

	function __construct(){
		parent::__construct();
	}

	function get_detail_apoteker(){
		$this->db->select('*');
		$this->db->from('farmasi');
	}

	function get_all(){
		return $this->db->get($this->table)->result_array();
	}

	function get_by_id($id_apoteker){
		$this->db->where('id_apoteker', $id_apoteker);
		return $this->db->get($this->table)->row_array();
	}

	private function _get_datatables_query(){

		$post_search = $this->input->post('search');
		$post_order = $this->input->post('order');

		$this->get_detail_apoteker();

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
		$this->get_detail_apoteker();

		return $this->db->count_all_results();
	}

	function add_apoteker($data_apoteker){
		return $this->db->insert($this->table, $data_apoteker);
	}

	function update_apoteker($id_apoteker, $data_apoteker){
		$this->db->where('id_apoteker', $id_apoteker);
		return $this->db->update($this->table, $data_apoteker);
	}

	function delete_apoteker_by_id($id_apoteker){
		$this->db->where('id_apoteker', $id_apoteker);
		$this->db->delete($this->table);
	}

}
?>