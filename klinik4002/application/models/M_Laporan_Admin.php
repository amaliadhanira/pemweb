<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_Laporan_Admin extends CI_Model{

	var $column_order = array(null, 'no_antrean', 'nama_pasien', 'nama_dokter', 'nama_spesialisasi', 'tgl_periksa', 'diagnosa', null);
	var $column_search = array('nama_pasien', 'nama_dokter', 'nama_spesialisasi', 'tgl_periksa', 'diagnosa');
	var $order = array('tgl_periksa' => 'desc');
	var $table = 'laporan_pemeriksaan';

	function __construct(){
		parent::__construct();
	}

	function get_laporan(){
		$this->db->select('*');
		$this->db->from('spesialisasi');
		$this->db->join('dokter', 'dokter.id_spesialisasi = spesialisasi.id_spesialisasi');
		$this->db->join('antrean', 'dokter.id_dokter = antrean.id_dokter');
		$this->db->join('pasien', 'pasien.id_pasien = antrean.id_pasien');
		$this->db->join('laporan_pemeriksaan', 'laporan_pemeriksaan.no_antrean = antrean.no_antrean');
	}

	private function _get_datatables_query(){

		$post_search = $this->input->post('search');
		$post_order = $this->input->post('order');

		$this->get_laporan();

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
		$this->get_laporan();

		return $this->db->count_all_results();
	}

	function buat_laporan($data_laporan){
		return $this->db->insert($this->table, $data_laporan);
	}

	function edit_laporan($id_laporan, $data_laporan){
		$this->db->where('id_laporan', $id_laporan);
		return $this->db->update($this->table, $data_laporan);
	}

	function get_by_id($id_laporan){
		$this->get_laporan();
		$this->db->where('id_laporan', $id_laporan);

		return $this->db->get()->row_array();
	}

	function buat_resep($data){
		$this->get_laporan();
		$this->db->join('resep_obat', 'resep_obat.id_laporan = laporan_pemeriksaan.id_laporan');
		$this->db->join('obat', 'resep_obat.id_obat = obat.id_obat');
		$this->db->where('resep_obat.id_laporan', $id_laporan);

		return $this->db->insert($this->table, $data);
	}

	function get_by_id_join_resep($id_laporan){
		$this->get_laporan();
		$this->db->join('resep_obat', 'resep_obat.id_laporan = laporan_pemeriksaan.id_laporan');
		$this->db->join('obat', 'resep_obat.id_obat = obat.id_obat');
		$this->db->where('resep_obat.id_laporan', $id_laporan);

		return $this->db->get()->result_array();
	}

	function delete_laporan($id_laporan){
		$this->db->where('id_laporan', $id_laporan);
		$this->db->delete($this->table);
	}

}
?>