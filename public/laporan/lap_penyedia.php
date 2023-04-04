<?php
    $jenis = antixss(dekrip($this->uri->segment(4)));
    if($jenis == "tahun"){
        $penyedia = antixss(dekrip($this->uri->segment(5)));
        $tahun = antixss(dekrip($this->uri->segment(6)));
        
        $sdata = $this->db->query("SELECT a.*, b.`nm_opd`, c.`nm_modpilih`, d.`nm_pekerjaanjns` FROM pekerjaan a LEFT JOIN opd b ON a.`id_opd` = b.`id_opd` LEFT JOIN modpilih c ON a.`id_modpilih` = c.`id_modpilih` LEFT JOIN pekerjaanjns d ON a.`id_pekerjaanjns` = d.`id_pekerjaanjns` WHERE a.status = 'final' AND LEFT(a.tgladd, 4) = '".$tahun."' AND a.nm_penyedia LIKE '%".$penyedia."%' ORDER BY a.no_pekerjaan DESC");

        $judulaporin = "<span class='text-uppercase'>LAPORAN PEKERJAAN ".$penyedia." TAHUN ".$tahun."</span>";
    }

?>
<link href="<?php echo base_url();?>assets/css/mpdf-bootstrap.css" rel="stylesheet" type="text/css">

<?php
echo "
<img src='".identitas("logo")."' style='width:40px;margin-top:-40px;'>
<img src='".identitas("logo-lpse")."' style='width:80px;margin-top:-40px;'>
<table style='width:100%;margin-left:140px;margin-top:-50px;'>
    <tr>
        <td class='text-uppercase'>
            <h1 style='font-size:20px;'><b>".identitas("judul")."</b></h1>
            <h3 style='font-size:14px;'>".identitas("deskripsi")."</h3>
        </td>
    </tr>
</table>
<div style='border-top:4px solid #000;'></div>
"; 
?>
<style>
    .tabelan thead tr th{
        vertical-align: top;
    }
    .area_gendeng{
        padding:5px;
        padding-top:0px;
    }
    .tabel_gendeng{
        font-size:12pt;
    }
    .tabel_kosong{
        width:100%;
        margin-bottom:20px;
    }
    .tabel_kosong td{
        padding-top:15px;
    }
    .tabel_kosong th{
        padding-top:15px;
    }
    .ttd_wong{
        padding-left:320px;
    }
</style>
    
    
<div class="area_gendeng">
    
    <div class="" style="border-bottom:1px dashed #000;margin-top:20px;">
        <h5><b class="text-uppercase"><?= $judulaporin ?></b></h5>
    </div>

    <table class="table tabelan table-bordered mb-0" border="1" cellspacing="0" style="font-size:11px;margin-top:10px;">
		<thead>
			<tr>
                <th class="text-center">No.</th>
				<th>Kode RUP</th>
				<th>Nama Pekerjaan</th>
				<th>Perangkat Daerah</th>
				<th>Tahun Anggaran</th>
				<th>Jenis Pekerjaan</th>
				<th>Metode Pemilihan</th>
				<th>Waktu Pelaksanaan</th>
				<th>Tgl. Kontrak</th>
			</tr>
		</thead>
		<tbody>
            <?php
                $nodata = 1;
                foreach($sdata->result_array() as $ddata){
                    echo"
                        <tr>
                            <td class='text-center'>".$nodata.".</td>
                            <td>".$ddata['no_rup']."</td>
                            <td>".$ddata['nm_pekerjaan']."</td>
                            <td>".$ddata['nm_opd']."</td>
                            <td>".$ddata['tahun']."</td>
                            <td>".$ddata['nm_pekerjaanjns']."</td>
                            <td>".$ddata['nm_modpilih']."</td>
                            <td>".$ddata['waktu_pekerjaan']." Hari Kalender</td>
                            <td>".tgl_indo($ddata['tgl_kontrak'])."</td>
                        </tr>
                    ";
                    $nodata++;
                }
            ?>
		</tbody>
	</table>
</div>
