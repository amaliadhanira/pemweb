<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Obat extends far_controller{

	function __construct(){
		parent::__construct('obat');
		$this->load->model('M_Farmasi');
		$this->load->model('M_Obat');
		$this->load->helper('string');
		$this->load->helper('form');
	}

	function cari($pilihan = 'id', $input, $page = 1){
		
		$this->cek_hapus();
		
		switch($pilihan)
		{
			case 'id':
				$data_view['rows'] = $this->M_Obat->cari_id($input, $page);
				$config['total_rows'] = $this->M_Obat->cari_id_count($input);
			break;
			case 'nama':
				$data_view['rows'] = $this->M_Obat->cari_nama($input, $page);
				$config['total_rows'] = $this->M_Obat->cari_nama_count($input);
			break;
			default:
				redirect('farmasi/obat');
			break;
		}
		
		if( ! is_numeric($page))
		{
			redirect('farmasi/obat');
		}
		
		if($data_view['rows'] !== NULL)
		{
			//setup page links
			$this->load->library('pagination');

			$config['base_url'] = base_url() . 'index.php/farmasi/obat';
			$config['use_page_numbers'] = TRUE;
			$config['per_page'] = 10; 

			$this->pagination->initialize($config);
			$data_view['pagelink'] = $this->pagination->create_links();
		
			$this->set_judul('pencarian ' . $pilihan);
			$data_view['pilihan'] = $pilihan;
			$data_view['input_cari'] = $input;
			$main = $this->load->view('farmasi/', $data_view, TRUE);
			$this->tampil($main);
		}
		else
		{
			$this->set_flash_feedback('Hasil pencarian tidak ada', 'info');
			redirect('farmasi/obat');
		}
	}

	
}
?>