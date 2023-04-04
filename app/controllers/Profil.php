<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Profil extends CI_Controller
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
			$data['title'] = "Profil Saya";
			$this->load->view('profil', $data);
		}
	}

    function addgambarproses(){
		$post = $this->input->post();
		if(isset($post['editingambarprofil'])){
			$file_name = str_replace('.','',random());
			$config['upload_path']          = './berkas/user/';
			$config['allowed_types']        = 'gif|jpg|png|jpeg';
			$config['file_name']            = $file_name;
			$config['overwrite']            = true;
			$this->load->library('upload', $config);

			if(!$this->upload->do_upload('berkas')){
				$this->session->set_flashdata('pesen', '<script>gagal("edit");</script>');
				redirect(base_url("profil"));
			}else{
				$uploaded_data = $this->upload->data();
				$post_data = array(
					"gambar" => $uploaded_data['file_name']
				);
				$proses = $this->db->update("users", $post_data, array("no_register" => sesuser("no_register")));
				if($proses){
					$this->session->set_flashdata('pesen', '<script>sukses("edit");</script>');
				}else{
					$this->session->set_flashdata('pesen', '<script>gagal("edit");</script>');
				}
				redirect(base_url("profil"));
			}
		}
	}
}
