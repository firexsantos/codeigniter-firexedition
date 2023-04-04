<?php
    $jtk = antixss(dekrip($this->uri->segment(4)));
        
    $sdata = $this->db->query("SELECT * FROM pekerjaan_ta WHERE jns_keterampilan LIKE '%".$jtk."%' ORDER BY jns_keterampilan");

    $judulaporin = "<span class='text-uppercase'>LAPORAN JENIS TENAGA KERJA: ".$jtk."</span>";

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
        <h5 style="font-size:10pt;"><b class="text-uppercase"><?= $judulaporin ?></b></h5>
    </div>

    <table class="table tabelan table-bordered mb-0" border="1" cellspacing="0" style="font-size:11px;margin-top:10px;">
		<thead>
			<tr>
                <th class="text-center">No.</th>
				<th>Nama Personel</th>
				<th>NIK</th>
				<th>Nomor Registrasi SKA/SKT</th>
				<th>Jenis Keterampilan SKA/SKT</th>
			</tr>
		</thead>
		<tbody>
            <?php
                $nodata = 1;
                foreach($sdata->result_array() as $ddata){
                    echo"
                        <tr>
                            <td class='text-center'>".$nodata.".</td>
                            <td>".$ddata['nm_ta']."</td>
                            <td>".$ddata['nik']."</td>
                            <td>".$ddata['noreg']."</td>
                            <td>".$ddata['jns_keterampilan']."</td>
                        </tr>
                    ";
                    $nodata++;
                }
            ?>
		</tbody>
	</table>
</div>
