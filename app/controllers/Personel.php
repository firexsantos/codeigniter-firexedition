<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Personel extends CI_Controller
{
    public function index()
	{
		if(in_array(sesuser('id_group'), cekakses("personel"))){
			$data['title'] = "Data Personel";
			$this->load->view('personel/data', $data);
		}else{
			$this->load->view('errors/403');
		}
	}

	function detail($kondisi = "")
	{
		if(in_array(sesuser('id_group'), cekakses("personel"))){
			$data['title'] = "Detail Personel";
			$this->load->view('personel/detail', $data);
		}else{
			$this->load->view('errors/403');
		}
	}

}
