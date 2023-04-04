<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Cetak extends CI_Controller
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
	
	
	function pdf($kondisi = "")
	{
		$this->load->view('pdf');
	}
	
	function excel($kondisi = "")
	{
		$this->load->view('excel');
	}
}
