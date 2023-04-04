<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Lap extends CI_Controller
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
	
	
	function lusers($kondisi = "")
	{
		if(in_array(sesuser('id_group'), cekakses("lusers"))){
			$data['title'] = "Lap. Data Pengguna";
            $this->load->view('lap/lusers', $data);
		}else{
			$this->load->view('errors/403');
		}
	}

    function lpekerjaan($kondisi = "")
	{
		if(in_array(sesuser('id_group'), cekakses("lpekerjaan"))){
			$data['title'] = "Lap. Data Pekerjaan";
            $this->load->view('lap/lpekerjaan', $data);
		}else{
			$this->load->view('errors/403');
		}
	}

	function lpenyedia($kondisi = "")
	{
		if(in_array(sesuser('id_group'), cekakses("lpenyedia"))){
			$data['title'] = "Lap. Data Penyedia";
            $this->load->view('lap/lpenyedia', $data);
		}else{
			$this->load->view('errors/403');
		}
	}

	function ljtk($kondisi = "")
	{
		if(in_array(sesuser('id_group'), cekakses("ljtk"))){
			$data['title'] = "Lap. Jenis Tenaga Kerja";
            $this->load->view('lap/ljtk', $data);
		}else{
			$this->load->view('errors/403');
		}
	}
}
