<?php

	Class FirexGroupModul
	{
	/*
      *************************************************
      * Library Name: FirexGroupModul                 *
      * Author: Firman Santosa                        *
      * Web: https://www.sifirman.com                 *
      * Email: admin@sifirman.com                     *
      * Github: https://github.com/firexsantos        *
      * Created on: Mei 02, 2019 15:43 WIB        *
      * Licence: GPL-MIT Licence                      *
      *************************************************
      */
		function getData($aksi){
			$CI 			= & get_instance();
			if(!empty($CI->session->userdata('id_group'))){
				$query  	= $CI->db->query("SELECT `group` FROM modul WHERE nm_seo = '".$aksi."'");
				$sambel		= $query->result_array();
				return explode(".",$sambel[0]['group']);
			}
		}
		
		function getGroupdef($data){
			$CI 	= & get_instance();
			$sabun 	= explode(".",$CI->session->userdata('groupdef'));
			if($data == "all"){
				return $sabun;
			}else{
				return $sabun[$data];
			}
		}
		
		function SesongUser($aksi){
			$CI 			= & get_instance();
			if($aksi == "id_user"){
				return $CI->session->userdata('id_user');
			}else if($aksi == "id_group"){
				return $CI->session->userdata('id_group');
			}else if($aksi == "groupdef"){
				return $CI->session->userdata('groupdef');
			}else if($aksi == "no_user"){
				return $CI->session->userdata('no_user');
			}
		}
	}
	
	function cekakses($data){
		$firex 		= new FirexGroupModul();
		$gendeng 	= $firex->getData($data);
		return $gendeng;
	}
	
	function sesuser($data){
		$firex 		= new FirexGroupModul();
		$gendeng 	= $firex->SesongUser($data);
		return $gendeng;
	}
	
	function cekgroupdef($data){
		$firex 		= new FirexGroupModul();
		$gendeng 	= $firex->getGroupdef($data);
		return $gendeng;
	}
	
	
?>
