<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Musers extends CI_Model
{
	//VARIABEL NAMA TABEL
	private $_pegawai 				= "pegawai";
	private $_mhs	 				= "mhs";
	private $_users					= "users";

    
    public function pegawaiaksi($data = "", $id = "")
    {
		if($data == "byid"){
			$post = $this->input->post();
			return $this->db->get_where($this->_pegawai, array('no_register' => dekrip($post["no_register"])))->result();
		}
    }
    
    public function dosenaksi($data = "", $id = "")
    {
		if($data == "byid"){
			$post = $this->input->post();
			return $this->db->get_where($this->_pegawai, array('no_register' => dekrip($post["no_register"])))->result();
		}
    }
    
    public function mhsaksi($data = "", $id = "")
    {
		if($data == "byid"){
			$post = $this->input->post();
			return $this->db->get_where($this->_mhs, array('no_register' => dekrip($post["no_register"])))->result();
		}
    }
   
}
