<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Gtele extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
	}


	public function index()
	{
		if(in_array(sesuser('id_group'), cekakses("gtele"))){
			$data['title'] = "Group Telegram";
            $this->load->view('gtele/data', $data);
		}else{
			$this->load->view('errors/403');
		}
	}
}
