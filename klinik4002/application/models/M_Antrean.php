<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_Antrean extends CI_Model{

	var $column_order = array(null, 'nama_dokter', 'nama_spesialisasi', 'jumlah_antrean');
	var $column_search = array('nama_dokter', 'nama_spesialisasi');
	var $order = array('nama_dokter' => 'asc');
	var $table = 'antrean';

	function __construct(){
		parent::__construct();
	}

	function get_all(){
		return $this->db->get('antrean')->result_array();
	}

	function get_jumlah(){
		$this->db->select('nama_dokter, nama_spesialisasi, COUNT(antrean.id_dokter) as jumlah_antrean');
		$this->db->group_by('antrean.id_dokter');
		$this->db->from('antrean');
		$this->db->join('dokter', 'dokter.id_dokter = antrean.id_dokter');
		$this->db->join('spesialisasi', 'dokter.id_spesialisasi = spesialisasi.id_spesialisasi');
		$this->db->where('tgl_periksa', date("Y-m-d"));
	}

	private function _get_datatables_query(){

		$post_search = $this->input->post('search');
		$post_order = $this->input->post('order');

		$this->get_jumlah();

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
		$this->get_jumlah();

		return $this->db->count_all_results();
	}
}
?>