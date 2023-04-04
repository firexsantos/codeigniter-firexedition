<?php
    $group = antixss(dekrip($this->uri->segment(4)));

    $dgroup = $this->db->get_where("group", array("id_group" => $group))->result_array();
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
    <?php if($group == 1 || $group == 2 || $group == 5){ ?>
    <div class="" style="border-bottom:1px dashed #000;margin-top:20px;">
        <h5><b class="text-uppercase">LAPORAN DATA <?= $dgroup[0]['nm_group'] ?></b></h5>
    </div>

    <table class="table tabelan table-bordered mb-0" border="1" cellspacing="0" style="font-size:11px;margin-top:10px;">
		<thead>
			<tr>
                <th class="text-center">No.</th>
				<th>Pengguna</th>
				<th>NIP</th>
				<th>Jns. Kelamin</th>
				<th>HP</th>
				<th>Username</th>
				<th>Group</th>
			</tr>
		</thead>
		<tbody>
        <?php
            $nodata = 1;
            $sdata = $this->db->query("SELECT a.*, b.`nm_jk`, c.`nm_agama`, d.`nm_group` FROM users a LEFT JOIN jk b ON a.`id_jk` = b.`id_jk` LEFT JOIN agama c ON a.`id_agama` = c.`id_agama` LEFT JOIN `group` d ON a.`id_group` = d.`id_group` WHERE a.groupdef LIKE '%.".$group.".%'");
            foreach($sdata->result_array() as $ddata){
				if($ddata['blocked'] == "no"){
					$bgblock = "";
				}else{
					$bgblock = "bg-danger";
				}

				$groupnya	= "";
				$group_ex	= explode(".",$ddata['groupdef']);
				$sgropx		= $this->db->get("group");
				foreach($sgropx->result_array() as $dgropx){
					if(in_array($dgropx['id_group'], $group_ex)){
						$groupnya	.= "<div class='fw-bold text-uppercase'>".$dgropx['nm_group']."</div>";
					}
				}

                echo"
                    <tr class='".$bgblock."'>
                        <td class='text-center'>".$nodata.".</td>
                        <td class='fw-bold'>".$ddata['nama']."</td>
                        <td>".$ddata['nip']."</td>
                        <td>".$ddata['nm_jk']."</td>
                        <td>".$ddata['hp']."</td>
                        <td class='fw-bold'>".$ddata['username']."</td>
                        <!--<td><b>".$groupnya."</b></td>-->
                        <td><b>".$dgroup[0]['nm_group']."</b></td>
                    </tr>
                ";
                $nodata++;
            }
        ?>
		</tbody>
	</table>

    <?php }elseif($group == 3 || $group == 4){ ?>
    <div class="" style="border-bottom:1px dashed #000;margin-top:20px;">
        <h5><b class="text-uppercase">LAPORAN DATA <?= $dgroup[0]['nm_group'] ?></b></h5>
    </div>

    <table class="table tabelan table-bordered mb-0" border="1" cellspacing="0" style="font-size:11px;margin-top:10px;">
		<thead>
			<tr>
                <th class="text-center">No.</th>
				<th>Nama</th>
				<th>NIP</th>
				<th>Jns. Kelamin</th>
				<th>HP</th>
				<th>Username</th>
				<th>OPD</th>
			</tr>
		</thead>
		<tbody>
            <?php
                $nodata = 1;
                $sdata = $this->db->query("SELECT a.*, b.`nm_jk`, c.`nm_agama`, d.`nm_group`, e.nm_opd FROM users a LEFT JOIN jk b ON a.`id_jk` = b.`id_jk` LEFT JOIN agama c ON a.`id_agama` = c.`id_agama` LEFT JOIN `group` d ON a.`id_group` = d.`id_group` LEFT JOIN opd e ON a.id_opd = e.id_opd WHERE a.id_group LIKE '".$group."'");
                foreach($sdata->result_array() as $ddata){
					if($ddata['blocked'] == "no"){
						$bgblock = "";
					}else{
						$bgblock = "bg-danger";
					}

                    echo"
                        <tr class='".$bgblock."'>
                            <td class='text-center'>".$nodata.".</td>
                            <td class='fw-bold'>".$ddata['nama']."</td>
                            <td>".$ddata['nip']."</td>
                            <td>".$ddata['nm_jk']."</td>
                            <td>".$ddata['hp']."</td>
                            <td class='fw-bold'>".$ddata['username']."</td>
                            <td class='fw-bold'>".$ddata['nm_opd']."</td>
                        </tr>
                    ";
                    $nodata++;
                }
            ?>
		</tbody>
	</table>
    <?php } ?>
</div>
