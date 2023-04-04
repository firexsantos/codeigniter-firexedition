<?php
$cug1	= $this->uri->segment(1);
$cug2	= $this->uri->segment(2);
?>

<div class="sidebar sidebar-dark sidebar-main sidebar-expand-lg">

			<!-- Sidebar header -->
			<div class="sidebar-section bg-black bg-opacity-10 border-bottom border-bottom-white border-opacity-10">
				<div class="sidebar-logo d-flex justify-content-center align-items-center">
					<a href="<?= base_url("dash") ?>" class="d-inline-flex align-items-center py-2">
						<img src="<?= identitas("logo") ?>" class="sidebar-logo-icon" alt="<?= identitas("judul") ?>">
                        <span class="text-light fw-bold text-uppercase sidebar-resize-hide ms-3"><?= identitas("judul") ?></span>
					</a>

					<div class="sidebar-resize-hide ms-auto">
						<button type="button" class="btn btn-flat-white btn-icon btn-sm rounded-pill border-transparent sidebar-control sidebar-main-resize d-none d-lg-inline-flex">
							<i class="ph-arrows-left-right"></i>
						</button>

						<button type="button" class="btn btn-flat-white btn-icon btn-sm rounded-pill border-transparent sidebar-mobile-main-toggle d-lg-none">
							<i class="ph-x"></i>
						</button>
					</div>
				</div>
			</div>
			<!-- /sidebar header -->


			<!-- Sidebar content -->
			<div class="sidebar-content">

                <div class="sidebar-section sidebar-resize-hide dropdown mx-2">
					<a href="#" class="btn btn-link text-body text-start lh-1 dropdown-toggle p-2 my-1 w-100" data-bs-toggle="dropdown" data-color-theme="dark">
						<div class="hstack gap-2 flex-grow-1 my-1">
                            <i class="ph-user-circle-gear text-warning ph-2x w-30px h-30px"></i>
							<div class="me-auto">
								<div class="fs-sm text-white opacity-75 mb-1">Group</div>
								<div class="fw-semibold"><?= cekuser(sesuser("no_user"), "nm_group") ?></div>
							</div>
						</div>
					</a>

					<div class="dropdown-menu w-100">
                        <?php
                            $slevol = $this->db->get("group");
                            foreach($slevol->result_array() as $dlevol){
                                if(in_array($dlevol['id_group'], cekgroupdef("all")) && sesuser("id_group") != $dlevol['id_group']){
                                    echo'
                                    <a href="#" class="dropdown-item hstack gap-2 py-2 bpindahlaman" data-group="'.enkrip($dlevol['id_group']).'">
                                        <i class="ph-user-circle text-danger ph-2x w-30px h-30px"></i>
                                        <div>
                                            <div class="fs-sm text-muted">Pindah ke laman</div>
                                            <div class="fw-semibold">'.$dlevol['nm_group'].'</div>
                                        </div>
                                    </a>
                                    ';
                                }
                            }
                        ?>
					</div>
				</div>


				<!-- Main navigation -->
				<div class="sidebar-section">
					<ul class="nav nav-sidebar" data-nav-type="accordion">

                        <?php
							if($cug1 == "dash"){
								$moddashactive	= "active";
							}else{
								$moddashactive	= "";
							}
						?>
						<li class="nav-item">
							<a href="<?= base_url("dash") ?>" class="nav-link <?= $moddashactive ?>">
								<i class="ph-house"></i>
								<span>
									Dashboard
								</span>
							</a>
						</li>
                        <?php
						
                            $snavi1 = $this->db->query("SELECT * FROM modul WHERE main = '0' AND aktif = 'yes' ORDER BY urutan");
                            foreach ($snavi1->result_array() as $dnavi1) {
                                if($cug1 == $dnavi1['nm_seo']){
                                    $modactiveleng	= "active";
                                    $modactivedorr	= "nav-item-expanded nav-item-open";
                                    $modactiveshow = "show";
                                }else{
                                    $modactiveleng	= "";
                                    $modactivedorr	= "";
                                    $modactiveshow = "";
                                }
                                
                                $iconnotifmaster	= notif($dnavi1['notif']);
                                // $iconnotifmaster	= "";
                                    
                                if(in_array($this->session->userdata('id_group'), explode(".",$dnavi1['group']))){
                                    $hitbawahin	= $this->db->get_where("modul", array("main" => $dnavi1['id_modul'], "aktif" => "yes"))->num_rows();
                                    if($hitbawahin > 0){
                                        echo"
                                            <li class='nav-item nav-item-submenu ".$modactivedorr."'>
                                                <a href='".base_url($dnavi1['url_menu'])."' class='nav-link'>".$dnavi1['icon']." <span>".$dnavi1['nm_modul']."</span> ".$iconnotifmaster."</a>
                                                
                                                <ul class='nav-group-sub collapse ".$modactiveshow."'>";
                                                    $snavi2 = $this->db->query("SELECT * FROM modul WHERE aktif ='yes' AND main = '".$dnavi1['id_modul']."' ORDER BY urutan");
                                                    foreach ($snavi2->result_array() as $dnavi2) {
                                                        if($cug2 == $dnavi2['nm_seo']){
                                                            $modactiveleng2	= "active";
                                                        }else{
                                                            $modactiveleng2	= "";
                                                        }
                                                        
                                                        if(!empty($dnavi2['notif'])){
                                                            $iconnotif = notif($dnavi1['notif'], $dnavi2['notif']);
                                                        }else{
                                                            $iconnotif	= "";
                                                        }
                                                        
                                                        if(in_array($this->session->userdata('id_group'), explode(".",$dnavi2['group']))){
                                                            if($dnavi2['uc'] == "yes"){
                                                                echo"<li class='nav-item'><a href='#' class='nav-link btuc' data-toggle='modal' data-target='#modalUnderConstructions' data-nama='".$dnavi2['nm_modul']."'><span>".$dnavi2['nm_modul']."</span><span class='ml-auto text-warning'><i class='icon-notification2'></i></span></a></li>";
                                                            }else{
                                                                echo"<li class='nav-item'><a href='".base_url($dnavi2['url_menu'])."' class='nav-link ".$modactiveleng2."'>".$dnavi2['nm_modul']." ".$iconnotif."</a></li>";
                                                            }
                                                        }
                                                    }
                                                echo"
                                                </ul>
                                            </li>
                                        ";
                                        
                                    }else{
                                        if($dnavi1['uc'] == "yes"){
                                            echo"<li class='nav-item'><a href='#' class='nav-link btuc' data-toggle='modal' data-target='#modalUnderConstructions' data-nama='".$dnavi1['nm_modul']."'>".$dnavi1['icon']." <span>".$dnavi1['nm_modul']."</span><span class='ml-auto text-warning'><i class='icon-notification2'></i></span></a></li>";
                                        }else{
                                            echo"
                                                <li class='nav-item'>
                                                    <a href='".base_url($dnavi1['url_menu'])."' class='nav-link ".$modactiveleng."'>".$dnavi1['icon']." <span>".$dnavi1['nm_modul']."</span> ".$iconnotifmaster."</a>
                                                </li>
                                            ";
                                        }
                                    }
                                }
                            }
                        ?>
                        <li class="nav-item">
                            <?php
                                if(sesuser("id_group") == 1 || sesuser("id_group") == 2){
                                    $linkmbook = base_url("berkas/mbook/adadmisi.pdf");
                                }else if(sesuser("id_group") == 3){
                                    $linkmbook = base_url("berkas/mbook/adpp.pdf");
                                }else if(sesuser("id_group") == 4){
                                    $linkmbook = base_url("berkas/mbook/ppk.pdf");
                                }else if(sesuser("id_group") == 5){
                                    $linkmbook = base_url("berkas/mbook/pokja.pdf");
                                }
                            ?>
							<a href="<?= $linkmbook ?>" class="nav-link" target="_blank">
								<i class="ph-file-text"></i>
								<span>
									Manual Book
								</span>
							</a>
						</li>
					</ul>
				</div>
				<!-- /main navigation -->

			</div>
			<!-- /sidebar content -->

                            
            <div class="alert bg-secondary bg-opacity-20 sidebar-resize-hide rounded p-3 m-3">
				<div class="d-flex mb-2">
					<div class="d-inline-flex bg-white bg-opacity-10 lh-1 rounded-pill p-2">
						<i class="ph-timer"></i>
					</div>
					<button type="button" class="btn-close btn-close-white ms-auto" data-bs-dismiss="alert"></button>
				</div>
				<div class="mb-3 text-center fw-bold">
					<div id="jam_analog" style="font-size:24px;"></div>
                    <div><?= tgl_indo(tanggal("tgl")) ?></div>
				</div>
			</div>
		</div>


<script type="text/javascript">
    window.onload = function() { jamSekarang(); }
   
    function jamSekarang() {
        var e = document.getElementById('jam_analog'),
        d = new Date(), h, m, s;
        h = d.getHours();
        m = setJam(d.getMinutes());
        s = setJam(d.getSeconds());
   
        e.innerHTML = h +':'+ m +':'+ s;
   
        setTimeout('jamSekarang()', 1000);
    }
   
    function setJam(e) {
        e = e < 10 ? '0'+ e : e;
        return e;
    }

    $(document).ready(function() {
				
        $(document).on('click', '.bpindahlaman', function() {
            const groupx 	= $(this).data('group');
            $.ajax({
                type: "POST",
                url: "<?php echo base_url('auth/pindahlaman');?>",
                data: {group : groupx, user : '<?php echo enkrip(sesuser("id_user"));?>'},
                success: function(data){
                    window.location.href = "<?php echo base_url('dash');?>";
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    //alert(thrownError);
                }
            });
        });
            
    });
</script>