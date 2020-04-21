<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_Login extends CI_Model{

	function __construct(){
		parent::__construct();
	}

	function auth_admin($username, $password){
		$this->db->where('username', $username);
		$this->db->where('password',md5('$password'));
		$count = $this->db->from('admin')->count_all_results();
		if ($count > 0){
			return true;
		} else {
			return false;
		}
	}

	function auth_pasien($username, $password){
		$this->db->where('username', $username);
		$this->db->where('password', md5($password));
		$count = $this->db->from('pasien')->count_all_results();
		if ($count > 0){
			return true;
		} else {
			return false;
		}
	}
}
?>