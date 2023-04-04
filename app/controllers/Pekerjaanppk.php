<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pekerjaanppk extends CI_Controller
{
    public function index()
	{
		if(in_array(sesuser('id_group'), cekakses("pekerjaanppk"))){
			$data['title'] = "Data Pekerjaan";
			$this->load->view('pekerjaanppk/data', $data);
		}else{
			$this->load->view('errors/403');
		}
	}
	
	function ta($kondisi = "")
	{
		if(in_array(sesuser('id_group'), cekakses("pekerjaanppk"))){
			$data['title'] = "Data Personel";
			$this->load->view('pekerjaanppk/ta', $data);
		}else{
			$this->load->view('errors/403');
		}
	}

	function detail($kondisi = "")
	{
		if(in_array(sesuser('id_group'), cekakses("pekerjaan"))){
			$data['title'] = "Detail Pekerjaan";
			$this->load->view('pekerjaanppk/detail', $data);
		}else{
			$this->load->view('errors/403');
		}
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
			"id_opd" => $ddata[0]['id_opd'],
			"nm_pekerjaan" => $ddata[0]['nm_pekerjaan'],
			"tahun" => $ddata[0]['tahun'],
			"id_pekerjaanjns" => $ddata[0]['id_pekerjaanjns'],
			"id_modpilih" => $ddata[0]['id_modpilih'],
			"waktu_pekerjaan" => $ddata[0]['waktu_pekerjaan'],
			"tgl_kontrak" => tgl_indo($ddata[0]['tgl_kontrak'],"a"),
			"nm_penyedia" => $ddata[0]['nm_penyedia'],
			"npwp_penyedia" => $ddata[0]['npwp_penyedia'],
			"hp_penyedia" => $ddata[0]['hp_penyedia'],
			"no_kontrak" => $ddata[0]['no_kontrak'],
			"id_kecamatan" => $ddata[0]['id_kecamatan'],
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
		$ar_json = array();
		$sdata = $this->db->query("SELECT a.*, b.`nm_pekerjaan`, b.`nm_penyedia`, b.`npwp_penyedia`, b.`hp_penyedia`, b.`tgl_kontrak`, b.`tgl_kontrak_berakhir`, b.`waktu_pekerjaan` FROM pekerjaan_ta a LEFT JOIN pekerjaan b ON a.`no_pekerjaan` = b.`no_pekerjaan` WHERE a.nik = '".antixss($post['nik'])."'");
		$hdata = $sdata->num_rows();
		if($hdata > 0){
			$ddata = $sdata->result_array();
			if(tanggal() >= $ddata[0]['tgl_kontrak'] && tanggal() <= $ddata[0]['tgl_kontrak_berakhir']){
				$ar_pesan = array(
					"status" => "no",
					"pesan" => "<div class='alert alert-danger'>NIK sudah terdaftar dengan Noreg: <a href='".base_url("pekerjaan/detail/".enkrip($ddata[0]['no_pekerjaan']))."' class='fw-bold' target='_blank'>".$ddata[0]['no_pekerjaan']."</a> oleh penyedia <b>".$ddata[0]['nm_penyedia']."</b> untuk pekerjaan <b>".$ddata[0]['nm_pekerjaan']."</b>.</div>"
				);
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
		$ar_json = array();
		$sdata = $this->db->query("SELECT a.*, b.`nm_pekerjaan`, b.`nm_penyedia`, b.`npwp_penyedia`, b.`hp_penyedia`, b.`tgl_kontrak`, b.`tgl_kontrak_berakhir`, b.`waktu_pekerjaan` FROM pekerjaan_ta a LEFT JOIN pekerjaan b ON a.`no_pekerjaan` = b.`no_pekerjaan` WHERE a.noreg = '".antixss($post['noreg'])."'");
		$hdata = $sdata->num_rows();
		if($hdata > 0){
			$ddata = $sdata->result_array();
			if(tanggal() >= $ddata[0]['tgl_kontrak'] && tanggal() <= $ddata[0]['tgl_kontrak_berakhir']){
				$ar_pesan = array(
					"status" => "no",
					"pesan" => "<div class='alert alert-danger'>Nomor Registrasi SKA/SKT sudah terdaftar dengan Noreg: <a href='".base_url("pekerjaan/detail/".enkrip($ddata[0]['no_pekerjaan']))."' class='fw-bold' target='_blank'>".$ddata[0]['no_pekerjaan']."</a> oleh penyedia <b>".$ddata[0]['nm_penyedia']."</b> untuk pekerjaan <b>".$ddata[0]['nm_pekerjaan']."</b>.</div>"
				);
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
}
