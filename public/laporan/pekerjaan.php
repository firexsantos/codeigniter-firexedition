<?php
    $no_pekerjaan = antixss(dekrip($this->uri->segment(4)));
    $skerja = $this->db->query("SELECT a.*, LEFT(a.tgladd, 10) AS tglno, MID(a.tgladd, 12, 5) AS waktuno, b.`nm_opd`, c.`nm_modpilih`, d.`nm_pekerjaanjns`, e.nm_kecamatan, f.nama AS nm_ppk FROM pekerjaan a LEFT JOIN opd b ON a.`id_opd` = b.`id_opd` LEFT JOIN modpilih c ON a.`id_modpilih` = c.`id_modpilih` LEFT JOIN pekerjaanjns d ON a.`id_pekerjaanjns` = d.`id_pekerjaanjns` LEFT JOIN kecamatan e ON a.id_kecamatan = e.id_kecamatan LEFT JOIN users f ON a.ppk = f.no_register WHERE a.no_pekerjaan = '".$no_pekerjaan."'");
    $hkerja = $skerja->num_rows();
    if($hkerja == 0){
        echo"Tidak ada data untuk dicetak...";
    }else{
        $dkerja = $skerja->result_array();
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
        margin-bottom:10px;
    }
    .tabel_kosong td{
        padding-top:5px;
    }
    .tabel_kosong th{
        padding-top:5px;
    }
    .ttd_wong{
        padding-left:320px;
    }
</style>
    
    
<div class="area_gendeng">
    <div class="" style="border-bottom:1px dashed #000;margin-top:20px;">
        <h5><b class="text-uppercase">DATA PEKERJAAN <span class="text-danger">#<?= $no_pekerjaan ?></span></b></h5>
    </div>


    <table class="tabel_kosong" cellspacing="0" style="font-size:11px;">
        <tbody>
            <tr>
                <td style="width:230px;">No. Register</td>
                <td style="width:20px;">:</td>
                <th><?= $no_pekerjaan ?></th>
            </tr>
            <tr>
                <td style="width:230px;">Tgl. Register</td>
                <td style="width:20px;">:</td>
                <td><?= tgl_indo($dkerja[0]['tglno'],"a")." ".$dkerja[0]['waktuno'] ?> WIB</td>
            </tr>
            <tr>
                <td>Kode RUP</td>
                <td>:</td>
                <td><?= $dkerja[0]['no_rup'] ?></td>
            </tr>
            <tr>
                <td>Kode Tender</td>
                <td>:</td>
                <td><?= $dkerja[0]['kode_tender'] ?></td>
            </tr>
            <tr>
                <td>Nama Pekerjaan</td>
                <td>:</td>
                <td><?= $dkerja[0]['nm_pekerjaan'] ?></td>
            </tr>
            <tr>
                <td>Jenis Pekerjaan</td>
                <td>:</td>
                <td><?= $dkerja[0]['nm_pekerjaanjns'] ?></td>
            </tr>
            <tr>
                <td>Tahun Anggaran</td>
                <td>:</td>
                <td><?= $dkerja[0]['tahun'] ?></td>
            </tr>
            <tr>
                <td>Nilai Pagu Anggaran</td>
                <td>:</td>
                <th>Rp <?= rupiah($dkerja[0]['nilai_pagu']) ?>,-</th>
            </tr>
            <tr>
                <td>Nilai Pekerjaan</td>
                <td>:</td>
                <td>Rp <?= rupiah($dkerja[0]['nilai_kontrak']) ?>,-</td>
            </tr>
            <tr>
                <td>Metode Pemilihan</td>
                <td>:</td>
                <td><?= $dkerja[0]['nm_modpilih'] ?></td>
            </tr>
            <tr>
                <td>No. Kontrak</td>
                <td>:</td>
                <td><?= $dkerja[0]['no_kontrak'] ?></td>
            </tr>
            <tr>
                <td>Tgl. Penandatanganan Kontrak</td>
                <td>:</td>
                <td><?= tgl_indo($dkerja[0]['tgl_kontrak']) ?></td>
            </tr>
            <tr>
                <td>Waktu Pelaksanaan Pekerjaan</td>
                <td>:</td>
                <td><?= $dkerja[0]['waktu_pekerjaan'] ?> hari kalender</td>
            </tr>
            <tr>
                <td>Tgl. Berakhir Kontrak</td>
                <td>:</td>
                <td><?= tgl_indo($dkerja[0]['tgl_kontrak_berakhir']) ?></td>
            </tr>
            <tr>
                <td>Jangka Waktu Pelaksanaan</td>
                <td>:</td>
                <th><?= $dkerja[0]['jangka_waktu'] ?> hari</th>
            </tr>
            <tr>
                <td>Nama Penyedia</td>
                <td>:</td>
                <td><?= $dkerja[0]['nm_penyedia'] ?></td>
            </tr>
            <tr>
                <td>NPWP Penyedia</td>
                <td>:</td>
                <td><?= $dkerja[0]['npwp_penyedia'] ?></td>
            </tr>
            <tr>
                <td>No. HP Penyedia</td>
                <td>:</td>
                <td><?= $dkerja[0]['hp_penyedia'] ?></td>
            </tr>
            <tr>
                <td>Perangkat Daerah</td>
                <td>:</td>
                <td><?= $dkerja[0]['nm_opd'] ?></td>
            </tr>
            <tr>
                <td style="width:230px;">Pemerintah Daerah</td>
                <td style="width:20px;">:</td>
                <td>Kabupaten Pelalawan</td>
            </tr>
            <tr>
                <td>Zona Pekerjaan</td>
                <td>:</td>
                <td><?= $dkerja[0]['nm_kecamatan'] ?></td>
            </tr>
            <tr>
                <td>Pejabat PPK</td>
                <td style="width:20px;">:</td>
                <th><?= $dkerja[0]['nm_ppk'] ?></th>
            </tr>
            <tr>
                <td>Kode Pokja</td>
                <td style="width:20px;">:</td>
                <th><?= $dkerja[0]['kode_pokja'] ?></th>
            </tr>
            <tr>
                <td>Sumber</td>
                <td style="width:20px;">:</td>
                <th><?= $dkerja[0]['sumber'] ?></th>
            </tr>
        </tbody>
    </table>

    <div class="" style="border-bottom:1px dashed #000;margin-top:20px;">
        <h5><b class="text-uppercase">DATA PERSONEL</b></h5>
    </div>
    <table class="table tabelan table-bordered mb-0" border="1" cellspacing="0" style="font-size:10px;margin-top:10px;">
		<thead>
			<tr>
                <th class="text-center">No.</th>
				<th>Nama Personel</th>
				<th>NIK</th>
				<th>Jenis Keterampilan SKA/SKT</th>
				<th>Nomor Registrasi SKA/SKT</th>
				<th>Deskripsi</th>
			</tr>
		</thead>
		<tbody>
			<?php
                $nodata = 1;
                $sdata = $this->db->get_where("pekerjaan_ta", array("no_pekerjaan" => $no_pekerjaan));
                foreach($sdata->result_array() as $ddata){
                    echo"
                        <tr>
                            <td class='text-center'>".$nodata.".</td>
                            <td>".$ddata['nm_ta']."</td>
                            <td>".$ddata['nik']."</td>
                            <td>".$ddata['jns_keterampilan']."</td>
                            <td>".$ddata['noreg']."</td>
                            <td>".$ddata['deskripsi']."</td>
                        </tr>
                    ";
                    $nodata++;
                }
            ?>
		</tbody>
	</table>
</div>
<?php } ?>