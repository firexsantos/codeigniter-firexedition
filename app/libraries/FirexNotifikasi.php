<?php
	Class FirexNotifikasi{
			
	}
	
	function notif($jenis, $data = ""){
		$ci 		= & get_instance();
		if($jenis == "pekerjaanppk"){
			//validasi user pendaftar
			$hvalid		= $ci->db->get_where("pekerjaan", array("ppk" => sesuser("no_register"), "status" => "pending"))->num_rows();
					
			$allnotif	= $hvalid;
			if(empty($data)){
				if($allnotif > 0){
					return '<span class="badge badge-pill bg-danger position-static ms-auto">'.$allnotif.'</span>';
				}else{
					return '';
				}
			}
		}
	}
?>
