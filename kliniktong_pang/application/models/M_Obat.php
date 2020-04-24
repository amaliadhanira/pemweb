<? php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_Obat extends CI_Model {

	function __construct(){
		parent::__construct();
	}

	function get_all($page = 1){
		return $this->db->get('obat')->result_array();
	}

	function cari_id($id_obat){
		$this->db->where('id_obat', $id_obat);
		return $this->db->get('obat')->row_array();
	}

	function cari_nama($nama_obat){
		$this->db->like('nama_obat', $nama_obat);
		return $this->db->get('obat')->row_array();
	}

	function insert_obat($data_obat){
		$data = array(
			'nama_obat' => $data_obat['nama_obat'],
			'produsen' => $data_obat['produsen'],
			'manufacture_date' => $data_obat['manufacture_date'],
			'expired_date' => $data_obat['expired_date'],
			'jumlah' => $data_obat['jumlah'],
			'harga' => $data_obat['harga']
		);

		$this->db->insert('obat', $data_obat);
	}

	function edit_obat($id_obat, $data_obat){
		$data = array(
			'nama_obat' => $data_obat['nama_obat'],
			'produsen' => $data_obat['produsen'],
			'manufacture_date' => $data_obat['manufacture_date'],
			'expired_date' => $data_obat['expired_date'],
			'jumlah' => $data_obat['jumlah'],
			'harga' => $data_obat['harga']
		);

		$this->db->where('id_obat', $id_obat);
		$this->db->update('obat', $data_obat);
	}

	function delete_obat($id_obat){
		if(is_array($id_obat)){
			$this->db->where_in('id_obat', $id_obat);
		}else{
			$this->db->where('id_obat', $id_obat);
		}
	}

	function delete_all_obat(){
		$this->db->delete('obat');
	}

	function all_rows_count(){
		$query = $this->db->get('obat');
		return $query->num_rows();
	}
}
?>