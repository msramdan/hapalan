<?php


class M_login extends CI_Model
{
	public function __construct(){
		parent::__construct();
		$this->load->database();
	}
 	public function checklogin($kd_karyawan, $password)
 	{
 		$this->db->from('karyawan');
 		$this->db->where('kd_karyawan',$kd_karyawan);
 		$this->db->where('password',md5($password));
 		return $this->db->get(); 		
 	}
}