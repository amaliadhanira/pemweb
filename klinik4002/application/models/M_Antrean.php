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
		$this->db->select('nama_dokter, nama_spesialisasi, COUNT(antrean.id_dokter) as jumlah_antrean');
		$this->db->group_by('antrean.id_dokter');
		$this->db->from('antrean');
		$this->db->join('dokter', 'dokter.id_dokter = antrean.id_dokter');
		$this->db->join('spesialisasi', 'dokter.id_spesialisasi = spesialisasi.id_spesialisasi');
		$this->db->where('tgl_periksa', date("Y-m-d"));
		return $this->db->get()->result_array();
	}

	function get_my_antrean($username){
		$this->db->select('*');
		$this->db->from('spesialisasi');
		$this->db->join('dokter', 'dokter.id_spesialisasi = spesialisasi.id_spesialisasi');
		$this->db->join('antrean', 'dokter.id_dokter = antrean.id_dokter');
		$this->db->join('pasien', 'pasien.id_pasien = antrean.id_pasien');
		$this->db->where('username', $username);
		return $this->db->get()->result_array();
	}
}
?>