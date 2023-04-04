<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dash extends CI_Controller
{

	
	function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
	}


	public function index()
	{
		if(empty(sesuser('id_user'))){
			$this->load->view('errors/403');
		}else{
			$dgroup = $this->db->get_where("group", array("id_group" => sesuser("id_group")))->result_array();
			$data['title'] = "Dashboard ".$dgroup[0]['nm_group'];
			$this->load->view('dash/'.sesuser("id_group"), $data);
		}
	}
}
