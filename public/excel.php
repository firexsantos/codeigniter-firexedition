<?php
	
	//~ header("Content-type: application/vnd.ms-excel");
	//~ header("Content-Disposition: attachment; filename=Lap-" . date("YmdHis") . ".xls");
	header("Content-Type: application/xls");    
	header("Content-Disposition: attachment; filename=LAPORAN-" . date("YmdHis") . ".xls");  
	header("Pragma: no-cache"); 
	header("Expires: 0");
	
	$menu	= $this->uri->segment(3);
	
	if($menu == "contoh"){
		include "laporan/contoh.php";
	}
	
	else{
		echo "What are you going to print??";
	}
	
	

