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
	
	
	function admin($kondisi = "")
	{
		if(in_array(sesuser('id_group'), cekakses("admin"))){
			if(empty($kondisi) || $kondisi == "data"){
				$data['title'] = "Data User Administrator";
				$this->load->view('users/admin/data', $data);
			}else if($kondisi == "add"){
				$data['title'] = "Tambah User Administrator";
				$this->load->view('users/admin/add', $data);
			}else if($kondisi == "edit"){
				$data['title'] = "Edit User Administrator";
				$this->load->view('users/admin/edit', $data);
			}else if($kondisi == "detail"){
				$data['title'] = "Detail User Administrator";
				$this->load->view('users/admin/detail', $data);
			}else{
				$this->load->view('errors/404');
			}
		}else{
			$this->load->view('errors/403');
		}
	}

}
