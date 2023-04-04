<?php
	Class FirexAutonumber{
			
	}

	function autoregister(){
		$ci = & get_instance();
		
		date_default_timezone_set('Asia/Jakarta');
		$tglauto			= date("ymd.Hi");
		// $jumun				= date("Hi");
		
		$sdata 				= $ci->db->query("SELECT MAX(RIGHT(no_register, 5)) as max_id FROM users WHERE LEFT(no_register,11) = '".$tglauto."'");
		$hdata				= $sdata->num_rows();
		if ($hdata > 0) {
			$ddata			= $sdata->result_array();
			$id_max_data	= $ddata[0]['max_id'];
			$sort_data 		= (int) substr($id_max_data, 0, 5);
			$sort_data++;
			$new_data 		= $tglauto.".REG.". sprintf("%05s", $sort_data);
		} else {
			$new_data		= $tglauto.".REG.00001";
		}
		return $new_data;
	}
	
	function autopekerjaan(){
		$ci = & get_instance();
		
		date_default_timezone_set('Asia/Jakarta');
		$tglauto			= date("y.md.His");
		// $jumun				= date("His");
		
		$sdata 				= $ci->db->query("SELECT MAX(RIGHT(no_pekerjaan, 3)) as max_id FROM pekerjaan WHERE LEFT(no_pekerjaan,14) = '".$tglauto."'");
		$hdata				= $sdata->num_rows();
		if ($hdata > 0) {
			$ddata			= $sdata->result_array();
			$id_max_data	= $ddata[0]['max_id'];
			$sort_data 		= (int) substr($id_max_data, 0, 3);
			$sort_data++;
			$new_data 		= $tglauto.".".sprintf("%03s", $sort_data);
		} else {
			$new_data		= $tglauto.".001";
		}
		return $new_data;
	}
?>
