<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_Laporan_Pemeriksaan extends CI_Model{

	var $column_order = array(null, 'nama_dokter', 'nama_spesialisasi', 'tgl_periksa', 'diagnosa', null);
	var $column_search = array('nama_dokter', 'nama_spesialisasi', 'tgl_periksa', 'diagnosa');
	var $order = array('tgl_periksa' => 'desc');
	var $table = 'laporan_pemeriksaan';

	function __construct(){
		parent::__construct();
	}

	function get_my_laporan($username){
		$this->db->select('*');
		$this->db->from('spesialisasi');
		$this->db->join('dokter', 'dokter.id_spesialisasi = spesialisasi.id_spesialisasi');
		$this->db->join('antrean', 'dokter.id_dokter = antrean.id_dokter');
		$this->db->join('pasien', 'pasien.id_pasien = antrean.id_pasien');
		$this->db->join('laporan_pemeriksaan', 'laporan_pemeriksaan.no_antrean = antrean.no_antrean');
		$this->db->where('username', $username);
	}

	private function _get_datatables_query(){

		$post_search = $this->input->post('search');
		$post_order = $this->input->post('order');

		$this->get_my_laporan($this->session->username);

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
		$this->get_my_laporan($this->session->username);

		return $this->db->count_all_results();
	}

	function get_by_id($id_laporan){
		$this->get_my_laporan($this->session->username);
		$this->db->where('id_laporan', $id_laporan);

		return $this->db->get()->row_array();
	}

/*
	function add_antrean($data){
		return $this->db->insert($this->table, $data);
		//return $this->db->insert_id();
	}

	function update_antrean($no_antrean, $data){
		$this->db->where('no_antrean', $no_antrean);
		return $this->db->update($this->table, $data);
		//return $this->db->affected_rows();
	}

	function del_antrean($no_antrean){
		$this->db->where('no_antrean', $no_antrean);
		$this->db->delete($this->table);
	}*/
}
?>