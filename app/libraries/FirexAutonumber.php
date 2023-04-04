<?php
	Class FirexAutonumber{
			
	}

	function autouser(){
		$ci = & get_instance();
		
		date_default_timezone_set('Asia/Jakarta');
		$tglauto			= date("ymd.Hi");
		// $jumun				= date("Hi");
		
		$sdata 				= $ci->db->query("SELECT MAX(RIGHT(no_user, 5)) as max_id FROM users WHERE LEFT(no_user,11) = '".$tglauto."'");
		$hdata				= $sdata->num_rows();
		if ($hdata > 0) {
			$ddata			= $sdata->result_array();
			$id_max_data	= $ddata[0]['max_id'];
			$sort_data 		= (int) substr($id_max_data, 0, 5);
			$sort_data++;
			$new_data 		= $tglauto.".USR.". sprintf("%05s", $sort_data);
		} else {
			$new_data		= $tglauto.".USR.00001";
		}
		return $new_data;
	}

?>
