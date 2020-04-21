<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_Antrean extends CI_Model{

	function __construct(){
		parent::__construct();
	}

	function get_all(){
		return $this->db->get('antrean')->result_array();
	}

	function get_jumlah(){
		$this->db->select('nama_dokter, spesialis, COUNT(antrean.id_dokter) as jumlah_antrean');
		$this->db->group_by('antrean.id_dokter');
		$this->db->from('antrean');
		$this->db->join('dokter', 'dokter.id_dokter = antrean.id_dokter');
		$this->db->where('tgl_periksa', date("Y-m-d"));
		return $this->db->get()->result_array();
	}

	function get_my_antrean($username){
		$this->db->select('nama_dokter, spesialis, tgl_periksa');
		$this->db->from('dokter');
		$this->db->join('antrean', 'dokter.id_dokter = antrean.id_dokter');
		$this->db->join('pasien', 'pasien.id_pasien = antrean.id_pasien');
		$this->db->where('username', $username);
		return $this->db->get()->result_array();
	}

	function tambah_antrean($data){
		$data = array(
			'id_dokter' => $this->input->post('id_dokter'),
			'id_pasien' => $this->input->post('id_pasien'),
			'tgl_periksa' => $this->input->post('tgl_periksa')
		);

		$this->db->insert('antrean', $data);
	}

	function cancel_antrean($no_antrean){
		if(is_array($id_apoteker)){
			$this->db->where_in('no_antrean', $no_antrean);
		}else{
			$this->db->where('no_antrean', $no_antrean);
		}
	}
}
?>