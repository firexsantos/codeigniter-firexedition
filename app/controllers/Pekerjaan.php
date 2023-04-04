<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pekerjaan extends CI_Controller
{
    public function index()
	{
		if(in_array(sesuser('id_group'), cekakses("pekerjaan"))){
			$data['title'] = "Data Pekerjaan";
			$this->load->view('pekerjaan/data', $data);
		}else{
			$this->load->view('errors/403');
		}
	}
	
	function ta($kondisi = "")
	{
		if(in_array(sesuser('id_group'), cekakses("pekerjaan"))){
			$data['title'] = "Data Personel";
			$this->load->view('pekerjaan/ta', $data);
		}else{
			$this->load->view('errors/403');
		}
	}

	function detail($kondisi = "")
	{
		$data['title'] = "Detail Pekerjaan";
		$this->load->view('pekerjaan/detail', $data);
	}


	function getpekerjaanbyid()
	{
		header("Access-Control-Allow-Origin: *");
        header('Content-Type: application/json');
		$post = $this->input->post();
		$no_pekerjaan = antixss(dekrip($post['no_pekerjaan']));
        $ddata = $this->db->get_where("pekerjaan", array("no_pekerjaan" => $no_pekerjaan))->result_array();
		$ar_json = array();
		$ar_data = array(
			"no_pekerjaan" => $ddata[0]['no_pekerjaan'],
			"no_rup" => $ddata[0]['no_rup'],
			"id_opd" => $ddata[0]['id_opd'],
			"nm_pekerjaan" => $ddata[0]['nm_pekerjaan'],
			"tahun" => $ddata[0]['tahun'],
			"id_pekerjaanjns" => $ddata[0]['id_pekerjaanjns'],
			"id_modpilih" => $ddata[0]['id_modpilih'],
			"waktu_pekerjaan" => $ddata[0]['waktu_pekerjaan'],
			"tgl_kontrak" => tgl_indo($ddata[0]['tgl_kontrak'],"a"),
			"nm_penyedia" => $ddata[0]['nm_penyedia'],
			"npwp_penyedia" => $ddata[0]['npwp_penyedia'],
			"jangka_waktu" => $ddata[0]['jangka_waktu'],
			"hp_penyedia" => $ddata[0]['hp_penyedia'],
			"no_kontrak" => $ddata[0]['no_kontrak'],
			"id_kecamatan" => $ddata[0]['id_kecamatan'],
			"ppk" => $ddata[0]['ppk'],
			"sumber" => $ddata[0]['sumber'],
			"kode_pokja" => $ddata[0]['kode_pokja'],
			"kode_tender" => $ddata[0]['kode_tender'],
			"nilai_pagu" => rupiah($ddata[0]['nilai_pagu']),
			"nilai_kontrak" => rupiah($ddata[0]['nilai_kontrak']),
			"tgl_kontrak_berakhir" => tgl_indo($ddata[0]['tgl_kontrak_berakhir'],"a")
		);
		array_push($ar_json, $ar_data);
        echo json_encode($ar_json);
	}

    function ceknik(){
		header("Access-Control-Allow-Origin: *");
        header('Content-Type: application/json');
		$post = $this->input->post();
		$tgl_kontrak = antixss(dekrip($post['tgl_kontrak']));
		$tgl_kontrak_berakhir = antixss(dekrip($post['tgl_kontrak_berakhir']));

		$ar_json = array();
		$sdata = $this->db->query("SELECT a.*, b.`nm_pekerjaan`, b.`nm_penyedia`, b.`npwp_penyedia`, b.`hp_penyedia`, b.`tgl_kontrak`, b.`tgl_kontrak_berakhir`, b.`waktu_pekerjaan`, c.nm_opd, b.id_kecamatan FROM pekerjaan_ta a LEFT JOIN pekerjaan b ON a.`no_pekerjaan` = b.`no_pekerjaan` LEFT JOIN opd c ON b.id_opd = c.id_opd WHERE a.nik = '".antixss($post['nik'])."' AND b.status = 'final'");
		$hdata = $sdata->num_rows();
		if($hdata > 0){
			$ddata = $sdata->result_array();
			// if(tanggal() >= $ddata[0]['tgl_kontrak'] && tanggal() <= $ddata[0]['tgl_kontrak_berakhir']){
			if(($tgl_kontrak >= $ddata[0]['tgl_kontrak'] && $tgl_kontrak <= $ddata[0]['tgl_kontrak_berakhir']) || ($tgl_kontrak_berakhir >= $ddata[0]['tgl_kontrak'] && $tgl_kontrak_berakhir <= $ddata[0]['tgl_kontrak_berakhir'])){
				//Cek zonasi
				$szona = $this->db->query("SELECT * FROM zonasi WHERE kecamatan LIKE '%".dekrip($post['kecamatan'])."%'");
				$dzona = $szona->result_array();
				$zona = explode(".", $dzona[0]['kecamatan']);
				if(in_array($ddata[0]['id_kecamatan'], $zona)){
					$ar_pesan = array(
						"status" => "no",
						"pesan" => "<div class='alert alert-warning'>NIK sudah terdaftar dengan Noreg: <a href='".base_url("pekerjaan/detail/".enkrip($ddata[0]['no_pekerjaan']))."' class='fw-bold' target='_blank'>".$ddata[0]['no_pekerjaan']."</a> oleh penyedia <b>".$ddata[0]['nm_penyedia']."</b> untuk pekerjaan <b>".$ddata[0]['nm_pekerjaan']."</b> pada <b>".$ddata[0]['nm_opd']."</b> masih di <b>DALAM SATU ZONA</b>.</div>"
					);
				}else{
					$ar_pesan = array(
						"status" => "no",
						"pesan" => "<div class='alert alert-danger'>NIK sudah terdaftar dengan Noreg: <a href='".base_url("pekerjaan/detail/".enkrip($ddata[0]['no_pekerjaan']))."' class='fw-bold' target='_blank'>".$ddata[0]['no_pekerjaan']."</a> oleh penyedia <b>".$ddata[0]['nm_penyedia']."</b> untuk pekerjaan <b>".$ddata[0]['nm_pekerjaan']."</b> pada <b>".$ddata[0]['nm_opd']."</b> di <b>LUAR ZONA</b>.</div>"
					);
				}
				//Akhir cek zonasi
				
			}else{
				$ar_pesan = array(
					"status" => "yes",
					"pesan" => "<span class='text-success'>Tersedia</span>"
				);
			}
		}else{
			$ar_pesan = array(
				"status" => "yes",
				"pesan" => "<span class='text-success'>Tersedia</span>"
			);
		}
		array_push($ar_json, $ar_pesan);
		echo json_encode($ar_json);
	}

	function ceknoreg(){
		header("Access-Control-Allow-Origin: *");
        header('Content-Type: application/json');
		$post = $this->input->post();
		$tgl_kontrak = antixss(dekrip($post['tgl_kontrak']));
		$tgl_kontrak_berakhir = antixss(dekrip($post['tgl_kontrak_berakhir']));
		
		$ar_json = array();
		$sdata = $this->db->query("SELECT a.*, b.`nm_pekerjaan`, b.`nm_penyedia`, b.`npwp_penyedia`, b.`hp_penyedia`, b.`tgl_kontrak`, b.`tgl_kontrak_berakhir`, b.`waktu_pekerjaan`, c.nm_opd, b.id_kecamatan FROM pekerjaan_ta a LEFT JOIN pekerjaan b ON a.`no_pekerjaan` = b.`no_pekerjaan` LEFT JOIN opd c ON b.id_opd = c.id_opd WHERE a.noreg = '".antixss($post['noreg'])."' AND b.status = 'final'");
		$hdata = $sdata->num_rows();
		if($hdata > 0){
			$ddata = $sdata->result_array();
			// if(tanggal() >= $ddata[0]['tgl_kontrak'] && tanggal() <= $ddata[0]['tgl_kontrak_berakhir']){
			if(($tgl_kontrak >= $ddata[0]['tgl_kontrak'] && $tgl_kontrak <= $ddata[0]['tgl_kontrak_berakhir']) || ($tgl_kontrak_berakhir >= $ddata[0]['tgl_kontrak'] && $tgl_kontrak_berakhir <= $ddata[0]['tgl_kontrak_berakhir'])){

				//Cek zonasi
				$szona = $this->db->query("SELECT * FROM zonasi WHERE kecamatan LIKE '%".dekrip($post['kecamatan'])."%'");
				$dzona = $szona->result_array();
				$zona = explode(".", $dzona[0]['kecamatan']);
				if(in_array($ddata[0]['id_kecamatan'], $zona)){
					$ar_pesan = array(
						"status" => "no",
						"pesan" => "<div class='alert alert-warning'>Nomor Registrasi SKA/SKT sudah terdaftar dengan Noreg: <a href='".base_url("pekerjaan/detail/".enkrip($ddata[0]['no_pekerjaan']))."' class='fw-bold' target='_blank'>".$ddata[0]['no_pekerjaan']."</a> oleh penyedia <b>".$ddata[0]['nm_penyedia']."</b> untuk pekerjaan <b>".$ddata[0]['nm_pekerjaan']."</b> pada <b>".$ddata[0]['nm_opd']."</b> masih di dalam satu zona.</div>"
					);
				}else{
					$ar_pesan = array(
						"status" => "no",
						"pesan" => "<div class='alert alert-danger'>Nomor Registrasi SKA/SKT sudah terdaftar dengan Noreg: <a href='".base_url("pekerjaan/detail/".enkrip($ddata[0]['no_pekerjaan']))."' class='fw-bold' target='_blank'>".$ddata[0]['no_pekerjaan']."</a> oleh penyedia <b>".$ddata[0]['nm_penyedia']."</b> untuk pekerjaan <b>".$ddata[0]['nm_pekerjaan']."</b> pada <b>".$ddata[0]['nm_opd']."</b> di luar zona.</div>"
					);
				}
				//Akhir zonasi

			}else{
				$ar_pesan = array(
					"status" => "yes",
					"pesan" => "<span class='text-success'>Tersedia</span>"
				);
			}
		}else{
			$ar_pesan = array(
				"status" => "yes",
				"pesan" => "<span class='text-success'>Tersedia</span>"
			);
		}
		array_push($ar_json, $ar_pesan);
		echo json_encode($ar_json);
	}

	function cektglberakhir(){
		$post = $this->input->post();
		$tgl_kontrak_berakhir = tambahhari(tgldb(antixss($post['tgl_kontrak'])), antixss($post['waktu_pekerjaan']));
		echo tgl_indo($tgl_kontrak_berakhir,"a");
		// echo antixss($post['tgl_kontrak']);
	}

	function getppk(){
		$post 			= $this->input->post();
		$id_opd	= antixss($post['id_opd']);
		$sdata			= $this->db->get_where('users', array('id_group' => 4, 'id_opd' => $id_opd));
		$html			= "<option value=''>[ Pilih Pejabat PPK ]</option>";
		foreach($sdata->result_array() as $ddata){
			$html		.= "<option value='".$ddata['no_register']."'>".$ddata['nama']."</option>";
		}
		$callback 		= array('data_ppk' => $html);
		echo json_encode($callback);
	}

	function getppkedit(){
		$post 			= $this->input->post();
		$id_opd	= antixss($post['id_opd']);
		$ppk	= antixss($post['ppk']);
		$sdata			= $this->db->get_where('users', array('id_group' => 4, 'id_opd' => $id_opd));
		$html			= "<option value=''>[ Pilih Pejabat PPK ]</option>";
		foreach($sdata->result_array() as $ddata){
			if($ppk == $ddata['no_register']){
				$html		.= "<option value='".$ddata['no_register']."' selected>".$ddata['nama']."</option>";
			}else{
				$html		.= "<option value='".$ddata['no_register']."'>".$ddata['nama']."</option>";
			}
			
		}
		$callback 		= array('data_ppk' => $html);
		echo json_encode($callback);
	}
}
