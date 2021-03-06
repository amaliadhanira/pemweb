<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Adminpage extends CI_Controller{
	function __construct(){
		parent::__construct();

		if ($this->session->status != 'login_admin'){
			redirect(base_url());
		}

		$this->load->model('m_admin');
		$this->load->model('m_dokter');
		$this->load->model('m_spesialisasi');
		$this->load->model('m_pasien');
		$this->load->model('m_antrean');
		$this->load->model('m_farmasi');
		$this->load->model('m_lab');
		$this->load->model('m_laporan_admin');
	}

	function index(){
		$data['title'] = 'Home';
		$data['page'] = 'home';
		$this->load->view('admin/templates/v_header', $data);
		$this->load->view('admin/home', $data);
		$this->load->view('admin/templates/v_footer', $data);
	}

	function admin(){
		$data['title'] = 'Admin';
		$data['page'] = 'admin';
		$this->load->view('admin/templates/v_header', $data);
		$this->load->view('admin/v_admin', $data);
		$this->load->view('admin/templates/v_footer', $data);
	}

	/* CONTROLLER FUNCTIONS FOR DATATABLE ADMIN */

	function data_admin(){
		$admin = $this->m_admin->get_datatables();
		$data = array();
		$no = $this->input->post('start');
		$this_username = $this->session->username;

		foreach($admin as $adm) {
			$dis = '';
			$no++;
			$row = array();
			$row[] = $no;
			$row[] = $adm['nama_admin'];
			$row[] = $adm['email'];
			$row[] = $adm['alamat'];
			$row[] = $adm['username'];
			$row[] = $adm['no_telp'];

			if(($this_username != 'superadmin') OR ($adm['username'] == 'superadmin')){
				$dis = ' disabled';
			}

			$row[] = '<button class="btn btn-sm btn-warning" data-id_admin="'. $adm['id_admin'] .'" id="ubah_admin">Edit</button> <button class="btn btn-sm btn-danger'. $dis .'"'. $dis .' data-id_admin="'. $adm['id_admin'] .'" id="hapus_admin">Hapus</button>';

			$data[] = $row;
		}

		$output = array(
						"draw" => $this->input->post('draw'),
						"recordsTotal" => $this->m_admin->count_all(),
						"recordsFiltered" => $this->m_admin->count_filtered(),
						"data" => $data,
		);

		echo json_encode($output);
	}

	function edit_admin($id_admin){
		$data = $this->m_admin->get_by_id($id_admin);
		echo json_encode($data);
	}

	function tambah_admin(){
		//FORM VALIDATION
		$this->form_validation->set_rules('nama_admin', 'Nama Lengkap', 'trim|required|alpha_numeric_spaces');
		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|is_unique[admin.email]');
		$this->form_validation->set_rules('username', 'Username', 'trim|required|min_length[5]|max_length[12]|alpha_dash|is_unique[admin.username]');
		$this->form_validation->set_rules('alamat', 'Alamat', 'trim|required');
		$this->form_validation->set_rules('no_telp', 'Nomor Telepon', 'trim|required|numeric|min_length[10]|max_length[13]');
		$this->form_validation->set_rules('password', 'Sandi', 'trim|required|min_length[8]');
		$this->form_validation->set_rules('passconf', 'Konfirmasi Sandi', 'trim|required|matches[password]');

		$data = array(
			'nama_admin' => $this->input->post('nama_admin'),
			'email' => $this->input->post('email'),
			'alamat' => $this->input->post('alamat'),
			'username' => $this->input->post('username'),
			'no_telp' => $this->input->post('no_telp'),
			'password' => $this->input->post('password'),
		);

		if ($this->form_validation->run() == FALSE){
			$this->admin();
		} else {
			$insert = $this->m_admin->add_admin($data);
			if ($insert) echo json_encode(array("success" => TRUE));
		}
	}

	function ubah_admin(){
		$id_admin = $this->input->post('id_admin');
		$password = $this->input->post('password');

		//FORM VALIDATION
		$this->form_validation->set_rules('alamat', 'Alamat', 'trim|required');
		$this->form_validation->set_rules('no_telp', 'Nomor Telepon', 'trim|required|numeric|min_length[10]|max_length[13]');
		$this->form_validation->set_rules('password', 'Sandi', 'trim|required|min_length[8]');
		$this->form_validation->set_rules('passconf', 'Konfirmasi Sandi', 'trim|required|matches[password]');
		
		$data = array(
			'alamat' => $this->input->post('alamat'),
			'no_telp' => $this->input->post('no_telp'),
		);

		if ($this->form_validation->run() == FALSE){
			$this->admin();
		} else {
			if ($this->m_admin->match_password($id_admin, $password)){
				$update = $this->m_admin->update_admin($id_admin, $data);
				if ($update) echo json_encode(array("success" => TRUE));
			} else {
				$this->admin();
			}
		}
				
	}

	function hapus_admin($id_admin){
		$this->m_admin->del_admin($id_admin);
		echo json_encode(array("success" => TRUE));
	}

	/* END OF CONTROLLER FUNCTIONS FOR DATATABLE ADMIN */

	function antrean(){
		$data['title'] = 'Antrean';
		$data['page'] = 'antrean';
		$this->load->view('admin/templates/v_header', $data);
		$this->load->view('admin/v_antrean', $data);
		$this->load->view('admin/templates/v_footer', $data);
	}

	/* CONTROLLER FUNCTIONS FOR DATATABLE ANTREAN */

	function data_antrean(){
		$antrean = $this->m_antrean->get_datatables();
		$data = array();
		$no = $this->input->post('start');

		foreach($antrean as $ant) {
			$dis = '';
			$no++;
			$row = array();
			$row[] = $no;
			$row[] = $ant['nama_pasien'];
			$row[] = $ant['nama_dokter'];
			$row[] = $ant['nama_spesialisasi'];
			$row[] = $ant['tgl_periksa'];
			$row[] = $ant['waktu_daftar'];

			if($ant['tgl_periksa'] < date('Y-m-d')){
				$dis = ' disabled';
			}


			$row[] = '<button class="btn btn-sm btn-warning'. $dis .'"'. $dis .'data-no_antrean="'. $ant['no_antrean'] .'" id="ubah_antrean">Ubah</button> <button class="btn btn-sm btn-danger" data-no_antrean="'. $ant['no_antrean'] .'" id="hapus_antrean">Hapus</button>';

			$data[] = $row;
		}

		$output = array(
						"draw" => $this->input->post('draw'),
						"recordsTotal" => $this->m_antrean->count_all(),
						"recordsFiltered" => $this->m_antrean->count_filtered(),
						"data" => $data,
		);

		echo json_encode($output);
	}

	function edit_antrean($no_antrean){
		$data = $this->m_antrean->get_by_no($no_antrean);
		echo json_encode($data);
	}

	function ubah_antrean(){
		$no_antrean = $this->input->post('no_antrean');

		$data = array(
			'id_dokter' => $this->input->post('id_dokter'),
			'id_pasien' => $this->input->post('id_pasien'),
			'tgl_periksa' => $this->input->post('tgl_periksa')
		);

		$update = $this->m_antrean->update_antrean($no_antrean, $data);
		if ($update) {
			echo json_encode(array("success" => TRUE));
		}
	}

	function hapus_antrean($no_antrean){
		$this->m_antrean->del_antrean($no_antrean);
		echo json_encode(array("success" => TRUE));
	}

	// END OF CONTROLLER FUNCTIONS FOR DATATABLE ANTREAN 

	function dokter(){
		$data['title'] = 'Dokter';
		$data['page'] = 'dokter';
		$data['spesialisasi'] = $this->m_spesialisasi->get_all();
		$this->load->view('admin/templates/v_header', $data);
		$this->load->view('admin/v_dokter', $data);
		$this->load->view('admin/templates/v_footer', $data);
	}

	// CONTROLLER FUNCTIONS FOR DATATABLE DOKTER
	function data_dokter(){
		$dokter = $this->m_dokter->get_datatables();
		$data = array();
		$no = $this->input->post('start');

		foreach($dokter as $dok) {
			$dis = '';
			$no++;
			$row = array();
			$row[] = $no;
			$row[] = $dok['nama_dokter'];
			$row[] = $dok['nama_spesialisasi'];
			$row[] = $dok['jadwal'];
			$row[] = $dok['alamat'];
			$row[] = $dok['no_telp'];
			$row[] = '<button class="btn btn-sm btn-warning" data-id_dokter="'. $dok['id_dokter'] .'" id="ubah_dokter">Edit</button> <button class="btn btn-sm btn-danger" data-id_dokter="'. $dok['id_dokter'] .'" id="hapus_dokter">Hapus</button>';
			$data[] = $row;
		}

		$output = array(
						"draw" => $this->input->post('draw'),
						"recordsTotal" => $this->m_dokter->count_all(),
						"recordsFiltered" => $this->m_dokter->count_filtered(),
						"data" => $data,
		);

		echo json_encode($output);
	}

	function edit_dokter($id_dokter){
		$data = $this->m_dokter->get_by_id($id_dokter);
		echo json_encode($data);
	}

	function tambah_dokter(){
		// FORM VALIDATION
		$this->form_validation->set_rules('nama_dokter', 'Nama Dokter', 'trim|required|alpha_numeric_spaces');
		$this->form_validation->set_rules('jadwal', 'Jadwal', 'trim|required');
		$this->form_validation->set_rules('alamat', 'Alamat', 'trim|required');
		$this->form_validation->set_rules('no_telp', 'Nomor Telepon', 'trim|required|numeric|min_length[10]|max_length[13]');

		$data_dokter = array(
			'nama_dokter' => $this->input->post('nama_dokter'),
			'id_spesialisasi' => $this->input->post('id_spesialisasi'),
			'jadwal' => $this->input->post('jadwal'),
			'alamat' => $this->input->post('alamat'),
			'no_telp' => $this->input->post('no_telp')
		);

		if ($this->form_validation->run() == FALSE){
			$this->dokter();
		} else {
			$insert = $this->m_dokter->dokter_baru($data_dokter);
			if ($insert) echo json_encode(array("success" => TRUE));
		}
	
	}

	function ubah_dokter(){
		$id_dokter = $this->input->post('id_dokter');

		// FORM VALIDATION
		$this->form_validation->set_rules('jadwal', 'Hari Start', 'trim|required');
		$this->form_validation->set_rules('alamat', 'Alamat', 'trim|required');
		$this->form_validation->set_rules('no_telp', 'Nomor Telepon', 'trim|required|numeric|min_length[10]|max_length[13]');

		$data_dokter = array(
			'jadwal' => $this->input->post('jadwal'),
			'alamat' => $this->input->post('alamat'),
			'no_telp' => $this->input->post('no_telp')
		);

		$update = $this->m_dokter->edit_dokter($id_dokter, $data_dokter);
		if($update){
			echo json_encode(array("success" => TRUE));
		}
	}

	function hapus_dokter($id_dokter){
		$this->m_dokter->delete_dokter_by_id($id_dokter);
		echo json_encode(array("success" => TRUE));
	}

	// END OF CONTROLLER FUNCTIONS FOR DATATABLE DOKTER

	function pasien(){
		$data['title'] = 'Pasien';
		$data['page'] = 'pasien';
		$this->load->view('admin/templates/v_header', $data);
		$this->load->view('admin/v_pasien', $data);
		$this->load->view('admin/templates/v_footer', $data);
	}

	// CONTROLLER FUNCTION FOR DATATABLE PASIEN

	function data_pasien(){
		$pasien = $this->m_pasien->get_datatables();
		$data = array();
		$no = $this->input->post('start');

		foreach($pasien as $psn) {
			$dis = '';
			$no++;
			$row = array();
			$row[] = $no;
			$row[] = $psn['nama_pasien'];
			$row[] = $psn['tanggal_lahir'];
			$row[] = $psn['email'];
			$row[] = $psn['alamat'];
			$row[] = $psn['username'];
			$row[] = $psn['no_telp'];
			$row[] = '<button class="btn btn-sm btn-danger" data-id_pasien="'. $psn['id_pasien'] .'" id="hapus_pasien">Hapus</button>';
			$data[] = $row;
		}

		$output = array(
						"draw" => $this->input->post('draw'),
						"recordsTotal" => $this->m_pasien->count_all(),
						"recordsFiltered" => $this->m_pasien->count_filtered(),
						"data" => $data,
		);

		echo json_encode($output);
	}

	function hapus_pasien($id_pasien){
		$this->m_pasien->delete_pasien_by_id($id_pasien);
		echo json_encode(array("success" => TRUE));
	}

	function lab(){
		$data['title'] = 'Lab';
		$data['page'] = 'lab';
		$this->load->view('admin/templates/v_header', $data);
		$this->load->view('admin/v_lab', $data);
		$this->load->view('admin/templates/v_footer', $data);
	}

	// CONTROLLER FUNCTION FOR DATATABLE LAB
	function data_lab(){
		$lab = $this->m_lab->get_datatables();
		$data = array();
		$no = $this->input->post('start');

		foreach($lab as $exm) {
			$no++;
			$row = array();
			$row[] = $no;
			$row[] = $exm['nama_examiner'];
			$row[] = $exm['alamat'];
			$row[] = $exm['no_telp'];
			$row[] = '<button class="btn btn-sm btn-warning" data-id_examiner="'. $exm['id_examiner'] .'" id="ubah_lab">Edit</button> <button class="btn btn-sm btn-danger" data-id_examiner="'. $exm['id_examiner'] .'" id="hapus_lab">Hapus</button>';
			$data[] = $row;
		}

		$output = array(
						"draw" => $this->input->post('draw'),
						"recordsTotal" => $this->m_lab->count_all(),
						"recordsFiltered" => $this->m_lab->count_filtered(),
						"data" => $data,
		);

		echo json_encode($output);
	}

	function edit_lab($id_examiner){
		$data = $this->m_lab->get_by_id($id_examiner);
		echo json_encode($data);
	}

	function buat_lab(){
		// FORM VALIDATION
		$this->form_validation->set_rules('nama_examiner', 'Nama Analis', 'trim|required|alpha_numeric_spaces');
		$this->form_validation->set_rules('alamat', 'Alamat', 'trim|required');
		$this->form_validation->set_rules('no_telp', 'Nomor Telepon', 'trim|required|numeric|min_length[10]|max_length[13]');

		$data = array(
			'nama_examiner' => $this->input->post('nama_examiner'),
			'alamat' => $this->input->post('alamat'),
			'no_telp' => $this->input->post('no_telp')
		);

		if ($this->form_validation->run() == FALSE){
			$this->lab();
		} else {
			$insert = $this->m_lab->add_lab($data);
			if ($insert) echo json_encode(array("success" => TRUE));
		}
	}

	function ubah_lab(){
		$id_examiner = $this->input->post('id_examiner');

		// FORM VALIDATION
		$this->form_validation->set_rules('nama_examiner', 'Nama Analis', 'trim|required|alpha_numeric_spaces');
		$this->form_validation->set_rules('alamat', 'Alamat', 'trim|required');
		$this->form_validation->set_rules('no_telp', 'Nomor Telepon', 'trim|required|numeric|min_length[10]|max_length[13]');

		$data = array(
			'nama_examiner' => $this->input->post('nama_examiner'),
			'alamat' => $this->input->post('alamat'),
			'no_telp' => $this->input->post('no_telp')
		);

		if ($this->form_validation->run() == FALSE){
			$this->lab();
		} else {
			$update = $this->m_lab->update_lab($id_examiner, $data);
			if ($update) echo json_encode(array("success" => TRUE));
		}
	}

	function hapus_lab($id_examiner){
		$this->m_lab->del_lab($id_examiner);
		echo json_encode(array("success" => TRUE));
	}

	function farmasi(){
		$data['title'] = 'Farmasi';
		$data['page'] = 'farmasi';
		$this->load->view('admin/templates/v_header', $data);
		$this->load->view('admin/v_farmasi', $data);
		$this->load->view('admin/templates/v_footer', $data);
	}

	// CONTROLLER FUNCTION FOR DATATABLE FARMASI
	function data_farmasi(){
		$farmasi = $this->m_farmasi->get_datatables();
		$data = array();
		$no = $this->input->post('start');

		foreach($farmasi as $frm) {
			$dis = '';
			$no++;
			$row = array();
			$row[] = $no;
			$row[] = $frm['nama_apoteker'];
			$row[] = $frm['alamat'];
			$row[] = $frm['no_telp'];

			$row[] = '<button class="btn btn-sm btn-warning" data-id_apoteker="'.$frm['id_apoteker'].'"id="ubah_farmasi">Edit</button> <button class="btn btn-sm btn-danger" data-id_apoteker="'.$frm['id_apoteker'].'" id="hapus_farmasi">Hapus</button>';

			$data[] = $row;
		}

		$output = array(
						"draw" => $this->input->post('draw'),
						"recordsTotal" => $this->m_farmasi->count_all(),
						"recordsFiltered" => $this->m_farmasi->count_filtered(),
						"data" => $data,
		);

		echo json_encode($output);
	}

	function edit_farmasi($id_apoteker){
		$data = $this->m_farmasi->get_by_id($id_apoteker);
		echo json_encode($data);
	}

	function buat_farmasi(){
		// FORM VALIDATION
		$this->form_validation->set_rules('nama_apoteker', 'Nama Apoteker', 'trim|required|alpha_numeric_spaces');
		$this->form_validation->set_rules('alamat', 'Alamat', 'trim|required');
		$this->form_validation->set_rules('no_telp', 'Nomor Telepon', 'trim|required|numeric|min_length[10]|max_length[13]');

		$data_apoteker = array(
			'nama_apoteker' => $this->input->post('nama_apoteker'),
			'alamat' => $this->input->post('alamat'),
			'no_telp' => $this->input->post('no_telp')
		);

		if ($this->form_validation->run() == FALSE){
			$this->farmasi();
		} else {
			$insert = $this->m_farmasi->add_apoteker($data_apoteker);
			if ($insert) echo json_encode(array("success" => TRUE));
		}
	}

	function ubah_farmasi(){
		$id_apoteker = $this->input->post('id_apoteker');

		// FORM VALIDATION
		$this->form_validation->set_rules('nama_apoteker', 'Nama Apoteker', 'trim|required|alpha_numeric_spaces');
		$this->form_validation->set_rules('alamat', 'Alamat', 'trim|required');
		$this->form_validation->set_rules('no_telp', 'Nomor Telepon', 'trim|required|numeric|min_length[10]|max_length[13]');

		$data_apoteker = array(
			'nama_apoteker' => $this->input->post('nama_apoteker'),
			'alamat' => $this->input->post('alamat'),
			'no_telp' => $this->input->post('no_telp')
		);

		if ($this->form_validation->run() == FALSE){
			$this->farmasi();
		} else {
			$update = $this->m_farmasi->update_apoteker($id_apoteker, $data_apoteker);
			if ($update) echo json_encode(array("success" => TRUE));
		}
	}

	function hapus_apoteker($id_apoteker){
		$this->m_farmasi->delete_apoteker_by_id($id_apoteker);
		echo json_encode(array("success" => TRUE));
	}

	function laporan(){
		$data['title'] = 'Laporan Pemeriksaan Pasien';
		$data['page'] = 'laporan_pasien';
		$data['antrean'] = $this->m_antrean->get_all_not_in_laporan();
		$this->load->view('admin/templates/v_header', $data);
		$this->load->view('admin/v_laporan', $data);
		$this->load->view('admin/templates/v_footer', $data);
	}

	function data_laporan(){
		$laporan = $this->m_laporan_admin->get_datatables();
		$data = array();
		$no = $this->input->post('start');

		foreach($laporan as $lap) {
			$no++;
			$row = array();
			$row[] = $no;
			$row[] = $lap['no_antrean'];
			$row[] = $lap['nama_pasien'];
			$row[] = $lap['nama_dokter'];
			$row[] = $lap['nama_spesialisasi'];
			$row[] = $lap['tgl_periksa'];
			$row[] = $lap['diagnosa'];
			$row[] = $lap['resep_obat'];

			$row[] = '<button class="btn btn-sm btn-warning" data-id_laporan="'.$lap['id_laporan'].'" id="ubah_laporan">Edit</button> <button class="btn btn-sm btn-danger" data-id_laporan="'.$lap['id_laporan'].'"id="hapus_laporan">Hapus</button>';

			$data[] = $row;
		}

		$output = array(
						"draw" => $this->input->post('draw'),
						"recordsTotal" => $this->m_laporan_admin->count_all(),
						"recordsFiltered" => $this->m_laporan_admin->count_filtered(),
						"data" => $data,
		);

		echo json_encode($output);
	}

	function antrean_options(){
		$antrean = $this->m_antrean->get_all_not_in_laporan();
		echo json_encode($antrean);
	}

	function this_antrean($no_antrean){
		$antrean = $this->m_antrean->get_by_no($no_antrean);
		echo json_encode($antrean);
	}

	function edit_laporan($id_laporan){
		$data = $this->m_laporan_admin->get_by_id($id_laporan);
		echo json_encode($data);
	}

	function buat_laporan(){
		// FORM VALIDATION
		$this->form_validation->set_rules('no_antrean', 'Nomor Antrean', 'trim|required|numeric');
		$this->form_validation->set_rules('diagnosa', 'Diagnosa', 'trim|required');
		$this->form_validation->set_rules('resep_obat', 'Resep Obat', 'trim|required');

		$data_laporan = array(
			'no_antrean' => $this->input->post('no_antrean'),
			'diagnosa' => $this->input->post('diagnosa'),
			'resep_obat' => $this->input->post('resep_obat')
		);

		if ($this->form_validation->run() == FALSE){
			$this->laporan();
		} else {
			$insert = $this->m_laporan_admin->buat_laporan($data_laporan);
			if ($insert) echo json_encode(array("success" => TRUE));
		}
	}

	function ubah_laporan(){
		$id_laporan = $this->input->post('id_laporan');

		// FORM VALIDATION
		$this->form_validation->set_rules('diagnosa', 'Diagnosa', 'trim|required');
		$this->form_validation->set_rules('resep_obat', 'Resep Obat', 'trim|required');

		$data_laporan = array(
			'diagnosa' => $this->input->post('diagnosa'),
			'resep_obat' => $this->input->post('resep_obat')
		);

		if ($this->form_validation->run() == FALSE){
			$this->laporan();
		} else {
			$update = $this->m_laporan_admin->edit_laporan($id_laporan, $data_laporan);
			if ($update) echo json_encode(array("success" => TRUE));
		}
	}

	function hapus_laporan($id_laporan){
		$this->m_laporan_admin->delete_laporan($id_laporan);
		echo json_encode(array("success" => TRUE));
	}

	function spesialisasi(){
		$data['title'] = 'Kelola Spesialisasi';
		$data['page'] = 'spesialisasi';
		$this->load->view('admin/templates/v_header', $data);
		$this->load->view('admin/v_spesialisasi', $data);
		$this->load->view('admin/templates/v_footer', $data);
	}

	// CONTROLLER FUNCTION FOR DATATABLE SPESIALISASI
	function data_spesialisasi(){
		$spesialisasi = $this->m_spesialisasi->get_datatables();
		$data = array();
		$no = $this->input->post('start');

		foreach($spesialisasi as $spe) {
			$no++;
			$row = array();
			$row[] = $no;
			$row[] = $spe['nama_spesialisasi'];
			$row[] = '<button class="btn btn-sm btn-warning" data-id_spesialisasi="'. $spe['id_spesialisasi'] .'" id="ubah_spesialisasi">Edit</button> <button class="btn btn-sm btn-danger" data-id_spesialisasi="'. $spe['id_spesialisasi'] .'" id="hapus_spesialisasi">Hapus</button>';
			$data[] = $row;
		}

		$output = array(
						"draw" => $this->input->post('draw'),
						"recordsTotal" => $this->m_lab->count_all(),
						"recordsFiltered" => $this->m_lab->count_filtered(),
						"data" => $data,
		);

		echo json_encode($output);
	}

	function edit_spesialisasi($id_spesialisasi){
		$data = $this->m_spesialisasi->get_by_id($id_spesialisasi);
		echo json_encode($data);
	}

	function tambah_spesialisasi(){
		// FORM VALIDATION
		$this->form_validation->set_rules('nama_spesialisasi', 'Nama Spesialisasi', 'trim|required|alpha_numeric_spaces');

		$data = array(
			'nama_spesialisasi' => $this->input->post('nama_spesialisasi'),
		);

		if ($this->form_validation->run() == FALSE){
			$this->spesialisasi();
		} else {
			$insert = $this->m_spesialisasi->add_spesialisasi($data);
			if ($insert) echo json_encode(array("success" => TRUE));
		}
	}

	function ubah_spesialisasi(){
		$id_spesialisasi = $this->input->post('id_spesialisasi');

		// FORM VALIDATION
		$this->form_validation->set_rules('nama_spesialisasi', 'Nama Spesialisasi', 'trim|required|alpha_numeric_spaces');

		$data = array(
			'nama_spesialisasi' => $this->input->post('nama_spesialisasi'),
		);

		if ($this->form_validation->run() == FALSE){
			$this->spesialisasi();
		} else {
			$update = $this->m_spesialisasi->update_spesialisasi($id_spesialisasi, $data);
			if ($update) echo json_encode(array("success" => TRUE));
		}
	}

	function hapus_spesialisasi($id_spesialisasi){
		$this->m_spesialisasi->del_spesialisasi($id_spesialisasi);
		echo json_encode(array("success" => TRUE));
	}
}
?>