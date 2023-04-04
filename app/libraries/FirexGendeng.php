<?php
	Class FirexGendeng{
			
	}
	
	function identitas($jenis){
		if(empty($jenis) || $jenis == "judul"){
			return "CodeIgniter Custom Firex Edition";
		}else if($jenis == "deskripsi"){
			return "Framework CodeIgniter 3 Custom Firex Edition dengan Bootstrap 5";
		}else if($jenis == "author"){
			return "Firman Santosa";
		}else if($jenis == "favicon"){
			return base_url("assets/images/ci3.png");
		}else if($jenis == "logo"){
			return base_url("assets/images/firex.png");
		}else if($jenis == "logo-header"){
			return base_url("assets/images/firex.png");
		}else if($jenis == "logo-header-dark"){
			return base_url("assets/images/firex.png");
		}
	}
	
	function random(){
		return uniqid(md5(mt_rand()), true).date("YmdHis");
	}
	
	function youtube($url){
		$value 		= explode("v=", $url);
    	$datax 		= $value[1];
		$ytendarray	= explode("&", $datax);
		$data		= $ytendarray[0];
		$imgurl		= "https://img.youtube.com/vi/".$data."/hqdefault.jpg";
		return $imgurl;
	}
	
	function toroman($integer){
		$integer	= intval($integer);
		$result 	= '';
		$lookup 	= array(
			'M' 	=> 1000,
			'CM' 	=> 900,
			'D' 	=> 500,
			'CD' 	=> 400,
			'C' 	=> 100,
			'XC' 	=> 90,
			'L' 	=> 50,
			'XL' 	=> 40,
			'X' 	=> 10,
			'IX' 	=> 9,
			'V' 	=> 5,
			'IV' 	=> 4,
			'I' 	=> 1
		);

		foreach ($lookup as $roman => $value) {
			$matches = intval($integer / $value);
			$result .= str_repeat($roman, $matches);
			$integer = $integer % $value;
		}
		return $result;
	}

	function formathp($nohp){
		$nohp = str_replace(" ","",$nohp);
		$nohp = str_replace("(","",$nohp);
		$nohp = str_replace(")","",$nohp);
		$nohp = str_replace(".","",$nohp);
		$nohp = str_replace("+","",$nohp);
		$nohp = str_replace("-","",$nohp);
		
		if(preg_match('/[0-9]/',trim($nohp))){
			// cek apakah no hp mengandung karakter + dan 0-9
			if(substr(trim($nohp), 0, 2)=='62'){
				// cek apakah no hp karakter 1-3 adalah 62
				$hp = trim($nohp);
			}else if(substr(trim($nohp), 0, 1)=='0'){
				// cek apakah no hp karakter 1 adalah 0
				$hp = '62'.substr(trim($nohp), 1);
			}else if(substr(trim($nohp), 0, 1)=='8'){
				// cek apakah no hp karakter 1 adalah 0
				$hp = '62'.trim($nohp);
			}else{
				$hp = 'salah';
			}
			// fungsi trim() untuk menghilangan
			// spasi yang ada didepan/belakang
		}else{
			$hp = 'salah';
		}
		return $hp;
	}
	
	function sambutan($data){
		date_default_timezone_set("Asia/Jakarta");
		$b 		= time();
		$hour 	= date("G", $b);
		if ($hour >= 0 && $hour <= 2) {
			$pesanane	= "Assalamualaikum. Selamat malam";
		} else if ($hour >= 3 && $hour <= 5) {
			$pesanane	= "Assalamualaikum. Selamat subuh";
		} else if ($hour >= 6 && $hour <= 9) {
			$pesanane	= "Assalamualaikum. Selamat pagi";
		} else if ($hour >= 10 && $hour <= 11) {
			$pesanane	= "Assalamualaikum. Selamat pagi menjelang siang";
		} else if ($hour >= 12 && $hour <= 14) {
			$pesanane	= "Assalamualaikum. Selamat siang";
		} else if ($hour == 15) {
			$pesanane	= "Assalamualaikum. Selamat siang menjelang sore";
		} else if ($hour >= 16 && $hour <= 17) {
			$pesanane	= "Assalamualaikum. Selamat sore";
		} else if ($hour >= 18 && $hour <= 19) {
			$pesanane	= "Assalamualaikum. Selamat petang";
		} else if ($hour >= 20 && $hour <= 23) {
			$pesanane	= "Assalamualaikum. Selamat malam";
		}
		return $pesanane." <b>".$data."</b>";
	}

	
	function convtime($data, $jenis){
		if($jenis == "toam"){
			$sabun	= date("h:i A", strtotime($data));
		}else if($jenis == "to24"){
			$sabun	= date("H:i", strtotime($data)).":00";
		}
		return $sabun;
	}
	
	function rupiah($angka){

		$hasil_rupiah = number_format($angka, 0, ',', '.');
		return $hasil_rupiah;
	}

	function angka($rupiah){
		$pattern = '/([^0-9]+)/';
		$angka_final = preg_replace($pattern, '', $rupiah);
		return $angka_final;
	}

	function umur($tgl){
		$tglb = $tgl;

		$tglbe = new DateTime($tglb);
		$today = new DateTime();

		$diff = $today->diff($tglbe);
		$umur = $diff->y;
		return $umur;
	}

	function tanggal($data = ""){
		date_default_timezone_set('Asia/Jakarta');
		if(empty($data) || $data == "tgl"){
			$gendeng	= date("Y-m-d");
		}else if($data == "tgljam"){
			$gendeng	= date("Y-m-d H:i:s");
		}else if($data == "jam"){
			$gendeng	= date("H:i:s");
		}
		return $gendeng;
	}

	function hari_indo($tanggal){
		$daftar_hari = array(
			'Sunday' 	=> 'Minggu',
			'Monday' 	=> 'Senin',
			'Tuesday' 	=> 'Selasa',
			'Wednesday' => 'Rabu',
			'Thursday' 	=> 'Kamis',
			'Friday' 	=> 'Jumat',
			'Saturday' 	=> 'Sabtu'
		);
		$namahari = date('l', strtotime($tanggal));

		return $daftar_hari[$namahari];
	}
	
	function tgl_indo($tunggulin, $jenis = "")
	{
		$tunggulin	= date('Y-m-d', strtotime($tunggulin));
		if(empty($tunggulin)){
			return "";
		}else{
			if(empty($jenis)) {
				
				$belendung = array(
					1 =>   'Januari',
					'Februari',
					'Maret',
					'April',
					'Mei',
					'Juni',
					'Juli',
					'Agustus',
					'September',
					'Oktober',
					'November',
					'Desember'
				);
				$pecahkandong = explode('-', $tunggulin);
				return $pecahkandong[2] . ' ' . $belendung[(int) $pecahkandong[1]] . ' ' . $pecahkandong[0];
			} else if($jenis == "x") {
				$belendung = array(
					1 =>   'Jan',
					'Feb',
					'Mar',
					'Apr',
					'Mei',
					'Jun',
					'Jul',
					'Agus',
					'Sept',
					'Okt',
					'Nov',
					'Des'
				);
				$pecahkandong = explode('-', $tunggulin);
				return $pecahkandong[2] . ' ' . $belendung[(int) $pecahkandong[1]] . ' ' . $pecahkandong[0];
			} else {
				return date('d/m/Y', strtotime($tunggulin));
			}
		}
	}


	function tgldb($data, $jenis = ""){
		if(!empty($data)){
			if(empty($jenis)){
				return date_format(date_create_from_format('d/m/Y', $data), 'Y-m-d');
			}else{
				return date_format(date_create_from_format('Y-m-d', $data), 'd/m/Y');
			}
		}else{
			if(empty($jenis)){
				return date('Y-m-d');
			}else{
				return date('d/m/Y');
			}
		}
	}

	function hitsenjang($tgl1, $tgl2, $aksi = ""){
		$diff 		= abs(strtotime($tgl2) - strtotime($tgl1));
		$tahun 		= floor($diff / (365*60*60*24));
		$bulan	 	= floor(($diff - $tahun * 365*60*60*24) / (30*60*60*24));
		$hari 		= floor(($diff - $tahun * 365*60*60*24 - $bulan*30*60*60*24)/ (60*60*24));
		if(empty($aksi)){
			return $tahun." Tahun , ".$bulan." Bulan, ".$hari." Hari";
		}else if($aksi == "tahun"){
			return $tahun;
		}else if($aksi == "bulan"){
			return $bulan;
		}else if($aksi == "hari"){
			return $hari;
		}
	}
	
	function ukuranberkas($bytes){
        if ($bytes >= 1073741824)
        {
            $bytes = number_format($bytes / 1073741824, 2) . ' GB';
        }
        elseif ($bytes >= 1048576)
        {
            $bytes = number_format($bytes / 1048576, 2) . ' MB';
        }
        elseif ($bytes >= 1024)
        {
            $bytes = number_format($bytes / 1024, 2) . ' KB';
        }
        elseif ($bytes > 1)
        {
            $bytes = $bytes . ' bytes';
        }
        elseif ($bytes == 1)
        {
            $bytes = $bytes . ' byte';
        }
        else
        {
            $bytes = '0 bytes';
        }

        return $bytes;
	}


	function blnthn_indo($tunggulin, $jenis = ""){
		if(empty($tunggulin)){
			return "";
		}else{
			$belendung = array(
				1 =>   'Januari',
				'Februari',
				'Maret',
				'April',
				'Mei',
				'Juni',
				'Juli',
				'Agustus',
				'September',
				'Oktober',
				'November',
				'Desember'
			);
			$pecahkandong = explode('-', $tunggulin);
			return $belendung[(int) $pecahkandong[1]] . ' ' . $pecahkandong[0];
		}
	}
	
	function hitungbulan($tgl1, $tgl2){
		$timeStart 	= strtotime($tgl1);
		$timeEnd 	= strtotime($tgl2);
		// Menambah bulan ini + semua bulan pada tahun sebelumnya
		$numBulan 	= 1 + (date("Y",$timeEnd)-date("Y",$timeStart))*12;
		// menghitung selisih bulan
		$numBulan 	+= date("m",$timeEnd)-date("m",$timeStart);

		return $numBulan;
	}
	
	function penyebut($nilai) {
		$nilai = abs($nilai);
		$huruf = array("", "satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas");
		$temp = "";
		if ($nilai < 12) {
			$temp = " ". $huruf[$nilai];
		} else if ($nilai <20) {
			$temp = penyebut($nilai - 10). " belas";
		} else if ($nilai < 100) {
			$temp = penyebut($nilai/10)." puluh". penyebut($nilai % 10);
		} else if ($nilai < 200) {
			$temp = " seratus" . penyebut($nilai - 100);
		} else if ($nilai < 1000) {
			$temp = penyebut($nilai/100) . " ratus" . penyebut($nilai % 100);
		} else if ($nilai < 2000) {
			$temp = " seribu" . penyebut($nilai - 1000);
		} else if ($nilai < 1000000) {
			$temp = penyebut($nilai/1000) . " ribu" . penyebut($nilai % 1000);
		} else if ($nilai < 1000000000) {
			$temp = penyebut($nilai/1000000) . " juta" . penyebut($nilai % 1000000);
		} else if ($nilai < 1000000000000) {
			$temp = penyebut($nilai/1000000000) . " milyar" . penyebut(fmod($nilai,1000000000));
		} else if ($nilai < 1000000000000000) {
			$temp = penyebut($nilai/1000000000000) . " trilyun" . penyebut(fmod($nilai,1000000000000));
		}     
		return $temp;
	}
 
	function terbilang($nilai) {
		if($nilai<0) {
			$hasil = "minus ". trim(penyebut($nilai));
		} else {
			$hasil = trim(penyebut($nilai));
		}     		
		return $hasil;
	}
	
	function hitunghari($tgl1, $tgl2){
		$tglcut1	= new DateTime($tgl1);
		$tglcut2	= new DateTime($tgl2);
		$cuthit		= $tglcut1->diff($tglcut2)->days + 1;
		return $cuthit;
	}
	
	function tambahhari($tanggal, $jmlhari){
		return date('Y-m-d', strtotime('+'.$jmlhari.' days', strtotime($tanggal))); 
	}

	function cekuser($no_user, $jenis = ""){
		$ci 	= & get_instance();
		$ddata	= $ci->db->query("SELECT a.*, b.`nm_jk`, c.`nm_agama`, d.`nm_group` FROM users a LEFT JOIN jk b ON a.`id_jk` = b.`id_jk` LEFT JOIN agama c ON a.`id_agama` = c.`id_agama` LEFT JOIN `group` d ON a.`id_group` = d.`id_group` WHERE a.no_user = '".$no_user."'")->result_array();
		return $ddata[0][$jenis];
	}

	function autoformatrt($nilai){
		$sort_nilai = (int) substr($nilai, 0, 3);
		return sprintf("%03s", $sort_nilai);
	}
?>
