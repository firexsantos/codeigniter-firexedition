<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Mdaftarulang extends CI_Model
{
    public function get($nik)
    {
		$this->db->where('nik', $nik);
		$result = $this->db->get('pmb')->row();
		return $result;
        
    }
}
