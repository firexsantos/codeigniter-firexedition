<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Auth extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Mlogin');
    }
    public function index()
    {
        $data['title'] = "Login";
        if ($this->session->userdata('authenticated'))
            redirect('dash');
        $this->load->view('login', $data);
    }
    
    public function login()
    {
        $username 	= $this->input->post('username');
        $password 	= md5($this->input->post('password'));
        $user 		= $this->Mlogin->get($username);
        if (empty($user)) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger">Username tidak ditemukan</div>');
            redirect('auth');
        } else {
            if ($password == $user->password) {
				if($user->blocked == "no"){
                    $session = array(
                        'authenticated' 	=> true,
                        'id_user' 			=> $user->id_user,
                        'id_group' 			=> $user->id_group,
                        'no_user'		=> $user->no_user,
                        'groupdef'			=> $user->groupdef,
                    );
                    $this->session->set_userdata($session);

                    
                    redirect('dash');
				}else{
					$this->session->set_flashdata('message', '<div class="alert alert-danger">Terjadi kesalahan! Silahkan menghubungi Super Admin.</div>');
					redirect('auth');
				}
                
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger"><b>Username</b> dan <b>Password</b> tidak cocok</div>');
                redirect('auth');
            }
        }
    }
    
    public function pindahlaman()
    {
        $id_group 	= dekrip($this->input->post('group'));
        $id_user 	= dekrip($this->input->post('user'));
        $session = array(
			'authenticated' 	=> true,
			'id_user' 			=> $id_user,
			'id_group' 			=> $id_group,
			'no_user'		=> $this->session->userdata('no_user'),
			'groupdef'			=> $this->session->userdata('groupdef'),
		);
		if(!empty($this->session->userdata('no_user'))){
			$this->session->set_userdata($session);
			$this->db->update("users", array("id_group" => $id_group), array("id_user" => $id_user));
		}else{
			redirect(base_url("dash"));
		}
    }

    public function logout()
    {
        $this->session->sess_destroy();
        redirect('auth');
    }
}
