<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Mmaster extends CI_Model
{
	//VARIABEL NAMA TABEL
	private $_indikator				= "indikator";
	private $_periode 				= "periode";
	private $_feedback				= "feedback";
	private $_tahun 				= "tahun";
	private $_ruang 				= "ruang";
	private $_kurikulum				= "kurikulum";
	private $_mkwajib				= "mkwajib";
	private $_nilaimas				= "nilaimas";
	private $_maxsks				= "maxsks";
	private $_predikat				= "predikat";
	private $_mkjenis				= "mkjenis";
	private $_mk					= "mk";
    
    public function indicatorsaksi($data = "", $id = "")
    {
		if($data == "byid"){
			$post = $this->input->post();
			return $this->db->get_where($this->_indikator, array('id_indikator' => dekrip($post["id_indikator"])))->result();
		}
    }
    
    public function feedbackaksi($data = "", $id = "")
    {
		if($data == "byid"){
			$post = $this->input->post();
			return $this->db->get_where($this->_feedback, array('id_feedback' => dekrip($post["id_feedback"])))->result();
		}
    }
    
    public function periodaksi($data = "", $id = "")
    {
		if($data == "byid"){
			$post = $this->input->post();
			return $this->db->get_where($this->_periode, array('id_periode' => dekrip($post["id_periode"])))->result();
		}
    }
    
    
    
    public function tahunaksi($data = "", $id = "")
    {
		if($data == "byid"){
			$post = $this->input->post();
			return $this->db->get_where($this->_tahun, array('id_tahun' => dekrip($post["id_tahun"])))->result();
		}else if($data == "delete"){
			$post = $this->input->post();
			$this->id_tahun		= antixss($post["id_tahun"]);
			$this->db->delete($this->_tahun, array("id_tahun" => dekrip($post['id_tahun'])));
		}
    }
    
    public function ruangaksi($data = "", $id = "")
    {
		if($data == "byid"){
			$post = $this->input->post();
			return $this->db->get_where($this->_ruang, array('id_ruang' => dekrip($post["id_ruang"])))->result();
		}else if($data == "delete"){
			$post = $this->input->post();
			$this->id_ruang		= antixss($post["id_ruang"]);
			return $this->db->delete($this->_ruang, array("id_ruang" => dekrip($post['id_ruang'])));
		}
    }
    
    
    public function kurikulumaksi($data = "", $id = "")
    {
		if($data == "kurikulum-byid"){
			$post = $this->input->post();
			return $this->db->get_where($this->_kurikulum, array('id_kurikulum' => dekrip($post["id_kurikulum"])))->result();
		}
    }
    
    public function pilwajibaksi($data = "", $id = "")
    {
		if($data == "pilwajib-byid"){
			$post = $this->input->post();
			return $this->db->get_where($this->_mkwajib, array('id_mkwajib' => dekrip($post["id_mkwajib"])))->result();
		}
    }
    
    public function nilaimasaksi($data = "", $id = "")
    {
		if($data == "nilaimas-byid"){
			$post = $this->input->post();
			return $this->db->get_where($this->_nilaimas, array('id_nilaimas' => dekrip($post["id_nilaimas"])))->result();
		}
    }
    
    public function maxsksaksi($data = "", $id = "")
    {
		if($data == "maxsks-byid"){
			$post = $this->input->post();
			return $this->db->get_where($this->_maxsks, array('id_maxsks' => dekrip($post["id_maxsks"])))->result();
		}
    }
    
    public function predikataksi($data = "", $id = "")
    {
		if($data == "predikat-byid"){
			$post = $this->input->post();
			return $this->db->get_where($this->_predikat, array('id_predikat' => dekrip($post["id_predikat"])))->result();
		}
    }
    
    public function mkjenisaksi($data = "", $id = "")
    {
		if($data == "mkjenis-byid"){
			$post = $this->input->post();
			return $this->db->get_where($this->_mkjenis, array('id_mkjenis' => dekrip($post["id_mkjenis"])))->result();
		}
    }
    
    public function makulaksi($data = "", $id = "")
    {
		if($data == "makul-byid"){
			$post = $this->input->post();
			return $this->db->get_where($this->_mk, array('kode_mk' => dekrip($post["kode_mk"]), 'kode_prodi' => $post['kode_prodi']))->result();
		}
    }
}
