<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Users extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
	}


	public function index()
	{
		$this->load->view('errors/404');
	}
	
	
	function superadmin($kondisi = "")
	{
		if(in_array(sesuser('id_group'), cekakses("superadmin"))){
			if(empty($kondisi) || $kondisi == "data"){
				$data['title'] = "Data Admin Agensi";
				$this->load->view('users/superadmin/data', $data);
			}else if($kondisi == "add"){
				$data['title'] = "Tambah Admin Agensi";
				$this->load->view('users/superadmin/add', $data);
			}else if($kondisi == "edit"){
				$data['title'] = "Edit Admin Agensi";
				$this->load->view('users/superadmin/edit', $data);
			}else{
				$this->load->view('errors/404');
			}
		}else{
			$this->load->view('errors/403');
		}
	}
	
	function adopd($kondisi = "")
	{
		if(in_array(sesuser('id_group'), cekakses("adopd"))){
			if(empty($kondisi) || $kondisi == "data"){
				$data['title'] = "Data Admin PP";
				$this->load->view('users/adopd/data', $data);
			}else if($kondisi == "add"){
				$data['title'] = "Tambah Admin PP";
				$this->load->view('users/adopd/add', $data);
			}else if($kondisi == "edit"){
				$data['title'] = "Edit Admin PP";
				$this->load->view('users/adopd/edit', $data);
			}else{
				$this->load->view('errors/404');
			}
		}else{
			$this->load->view('errors/403');
		}
	}

	function ppk($kondisi = "")
	{
		if(in_array(sesuser('id_group'), cekakses("ppk"))){
			if(empty($kondisi) || $kondisi == "data"){
				$data['title'] = "Data PPK";
				$this->load->view('users/ppk/data', $data);
			}else if($kondisi == "add"){
				$data['title'] = "Tambah PPK";
				$this->load->view('users/ppk/add', $data);
			}else if($kondisi == "edit"){
				$data['title'] = "Edit PPK";
				$this->load->view('users/ppk/edit', $data);
			}else{
				$this->load->view('errors/404');
			}
		}else{
			$this->load->view('errors/403');
		}
	}

	function pokja($kondisi = "")
	{
		if(in_array(sesuser('id_group'), cekakses("pokja"))){
			if(empty($kondisi) || $kondisi == "data"){
				$data['title'] = "Data POKJA Pemilihan";
				$this->load->view('users/pokja/data', $data);
			}else if($kondisi == "add"){
				$data['title'] = "Tambah POKJA Pemilihan";
				$this->load->view('users/pokja/add', $data);
			}else if($kondisi == "edit"){
				$data['title'] = "Edit POKJA Pemilihan";
				$this->load->view('users/pokja/edit', $data);
			}else{
				$this->load->view('errors/404');
			}
		}else{
			$this->load->view('errors/403');
		}
	}

	function getdosenbyid(){
		header("Access-Control-Allow-Origin: *");
        header('Content-Type: application/json');
		$post = $this->input->post();
		$no_register = antixss(dekrip($post['no_register']));
        $ddata = $this->db->query("SELECT a.*, z.`username`, z.`groupdef`, z.`id_group`, z.`blocked`, b.`nm_jk`, c.`nm_agama`, d.`nm_prodi`, e.`nm_fakultas`, e.`id_fakultas`, f.`nm_jafung`, f.`angka_kredit` FROM dosenpeg a LEFT JOIN users z ON a.`no_register` = z.`no_register` LEFT JOIN jk b ON a.id_jk = b.`id_jk` LEFT JOIN agama c ON a.`id_agama` = c.`id_agama` LEFT JOIN prodi d ON a.`id_prodi` = d.`id_prodi` LEFT JOIN fakultas e ON d.`id_fakultas` = e.`id_fakultas` LEFT JOIN jafung f ON a.`id_jafung` = f.`id_jafung` WHERE a.no_register = '".$no_register."'")->result();
        echo json_encode($ddata);
	}

	function getpegawaibyid(){
		header("Access-Control-Allow-Origin: *");
        header('Content-Type: application/json');
		$post = $this->input->post();
		$no_register = antixss(dekrip($post['no_register']));
        $ddata = $this->db->query("SELECT a.*, z.`username`, z.`groupdef`, z.`id_group`, z.`blocked`, b.`nm_jk`, c.`nm_agama` FROM dosenpeg a LEFT JOIN users z ON a.`no_register` = z.`no_register` LEFT JOIN jk b ON a.id_jk = b.`id_jk` LEFT JOIN agama c ON a.`id_agama` = c.`id_agama` WHERE a.no_register = '".$no_register."'")->result();
        echo json_encode($ddata);
	}

	function getmhsbyid(){
		header("Access-Control-Allow-Origin: *");
        header('Content-Type: application/json');
		$post = $this->input->post();
		$no_register = antixss(dekrip($post['no_register']));
        $ddata = $this->db->query("SELECT a.*, z.`username`, z.`groupdef`, z.`id_group`, z.`blocked`, b.`nm_jk`, c.`nm_agama`, d.nm_prodi, d.id_fakultas, e.nm_fakultas FROM mhs a LEFT JOIN users z ON a.`no_register` = z.`no_register` LEFT JOIN jk b ON a.id_jk = b.`id_jk` LEFT JOIN agama c ON a.`id_agama` = c.`id_agama` LEFT JOIN prodi d ON a.id_prodi = d.id_prodi LEFT JOIN fakultas e ON d.id_fakultas = e.id_fakultas WHERE a.no_register = '".$no_register."'")->result();
        echo json_encode($ddata);
	}
}
