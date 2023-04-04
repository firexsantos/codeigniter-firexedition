<?php
	
	//~ header("Content-type: application/vnd.ms-excel");
	//~ header("Content-Disposition: attachment; filename=Lap-" . date("YmdHis") . ".xls");
	header("Content-Type: application/xls");    
	header("Content-Disposition: attachment; filename=LAPORAN-" . date("YmdHis") . ".xls");  
	header("Pragma: no-cache"); 
	header("Expires: 0");
	
	$menu	= $this->uri->segment(3);
	
	if($menu == "lap-users"){
		include "laporan/lap_users.php";
	}else if($menu == "lap-pekerjaan"){
		include "laporan/lap_pekerjaan.php";
	}else if($menu == "lap-penyedia"){
		include "laporan/lap_penyedia.php";
	}else if($menu == "lap-jtk"){
		include "laporan/lap_jtk.php";
	}
	
	else{
		echo "What are you going to print??";
	}
	
	

