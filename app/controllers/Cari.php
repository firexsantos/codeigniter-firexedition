<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Cari extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
	}


	public function index()
	{
        $data['title'] = "Data Pencarian";
		$this->load->view('cari/cari.php', $data);
	}
}
