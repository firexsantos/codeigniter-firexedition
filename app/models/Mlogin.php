<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Mlogin extends CI_Model
{
    public function get($username)
    {
		//~ $this->db->where('username', $username);
		$result = $this->db->get_where("users", array("username" => $username))->row();
		return $result;
        
    }
}
