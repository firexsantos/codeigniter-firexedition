<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Master extends CI_Controller
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
	
	
	function opd($kondisi = "")
	{
		if(in_array(sesuser('id_group'), cekakses("opd"))){
			$data['title'] = "Master OPD";
            $this->load->view('master/opd/data', $data);
		}else{
			$this->load->view('errors/403');
		}
	}
	
	function modpilih($kondisi = "")
	{
		if(in_array(sesuser('id_group'), cekakses("modpilih"))){
			$data['title'] = "Master Metode Pemilihan";
            $this->load->view('master/modpilih/data', $data);
		}else{
			$this->load->view('errors/403');
		}
	}
	
	function pekerjaanjns($kondisi = "")
	{
		if(in_array(sesuser('id_group'), cekakses("pekerjaanjns"))){
			$data['title'] = "Master Jenis Pekerjaan";
            $this->load->view('master/pekerjaanjns/data', $data);
		}else{
			$this->load->view('errors/403');
		}
	}

    function msifat($kondisi = "")
	{
		if(in_array(sesuser('id_group'), cekakses("msifat"))){
			$data['title'] = "Master Sifat Informasi";
            $this->load->view('master/msifat/data', $data);
		}else{
			$this->load->view('errors/403');
		}
	}

	function zonasi($kondisi = "")
	{
		if(in_array(sesuser('id_group'), cekakses("zonasi"))){
			if(empty($kondisi) || $kondisi == "data"){
				$data['title'] = "Master Zonasi";
				$this->load->view('master/zonasi/data', $data);
			}else if($kondisi == "add"){
				$data['title'] = "Tambah Master Zonasi";
				$this->load->view('master/zonasi/add', $data);
			}else if($kondisi == "edit"){
				$data['title'] = "Edit Master Zonasi";
				$this->load->view('master/zonasi/edit', $data);
			}else{
				$this->load->view('errors/404');
			}
			
		}else{
			$this->load->view('errors/403');
		}
	}

}
