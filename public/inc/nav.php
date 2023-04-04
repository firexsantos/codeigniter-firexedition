<?php
	if(!empty(cekuser(sesuser("no_user"), "gambar"))){
		$gambar_profil = base_url("berkas/user/".cekuser(sesuser("no_user"), "gambar"));
	}else{
		$gambar_profil = base_url('assets/images/default.png');
	}

	$post = $this->input->post();
	if(isset($post['editinmypass'])){
		$hajar			= $this->db->update("users", array("password" => md5(antixss($post['password']))), array("no_user" => sesuser("no_user")));
		if($hajar){
			$this->session->set_flashdata('pesen', '<script>sukses("editpass");</script>');
		}else{
			$this->session->set_flashdata('pesen', '<script>gagal("editpass");</script>');
		}
		redirect(base_url("dash"));
	}

    $cug1	= $this->uri->segment(1);
    $cug2	= $this->uri->segment(2);
?>

<div class="navbar navbar-expand-xl navbar-static shadow">
		<div class="container-fluid">
			<div class="navbar-brand flex-1">
				<a href="<?= base_url() ?>" class="d-inline-flex align-items-center">
					<img src="<?= identitas("logo") ?>" alt="<?= identitas("judul") ?>" class="h-32px">
                    <span class="fw-bold text-dark mx-2 text-uppercase" style="font-size:18px;"><?= identitas("judul") ?></span>
					<!-- <img src="<?= base_url() ?>assets/images/logo_text_dark.svg" class="d-none d-sm-inline-block h-16px invert-dark ms-3" alt=""> -->
				</a>
			</div>

			<div class="d-flex w-100 w-xl-auto overflow-auto overflow-xl-visible scrollbar-hidden border-top border-top-xl-0 order-1 order-xl-0 pt-2 pt-xl-0 mt-2 mt-xl-0">
				<ul class="nav gap-1 justify-content-center flex-nowrap flex-xl-wrap mx-auto">
                <?php
							if($cug1 == "dash"){
								$moddashactive	= "active";
							}else{
								$moddashactive	= "";
							}
						?>
                        <li class="nav-item">
							<a href="<?= base_url("dash") ?>" class="navbar-nav-link rounded <?= $moddashactive ?>">
								<i class="ph-house me-2"></i>
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
                                    $modactivedorr	= "active";
                                }else{
                                    $modactiveleng	= "";
                                    $modactivedorr	= "";
                                }
                                
                                $iconnotifmaster	= notif($dnavi1['notif']);
                                // $iconnotifmaster	= "";
                                    
                                if(in_array($this->session->userdata('id_group'), explode(".",$dnavi1['group']))){
                                    $hitbawahin	= $this->db->get_where("modul", array("main" => $dnavi1['id_modul'], "aktif" => "yes"))->num_rows();
                                    if($hitbawahin > 0){
                                        echo"
                                            <li class='nav-item nav-item-dropdown-xl dropdown'>
                                                <a href='".base_url($dnavi1['url_menu'])."' class='navbar-nav-link dropdown-toggle rounded ".$modactivedorr."' data-bs-toggle='dropdown'><span>".$dnavi1['nm_modul']."</span> ".$iconnotifmaster."</a>
                                                
                                                <div class='dropdown-menu'>";
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
                                                                echo"<a href='#' class='dropdown-item rounded btuc' data-toggle='modal' data-target='#modalUnderConstructions' data-nama='".$dnavi2['nm_modul']."'><span>".$dnavi2['nm_modul']."</span><span class='ml-auto text-warning'><i class='icon-notification2'></i></span></a>";
                                                            }else{
                                                                echo"<a href='".base_url($dnavi2['url_menu'])."' class='dropdown-item rounded ".$modactiveleng2."'>".$dnavi2['nm_modul']." ".$iconnotif."</a>";
                                                            }
                                                        }
                                                    }
                                                echo"
                                                </div>
                                            </li>
                                        ";
                                        
                                    }else{
                                        if($dnavi1['uc'] == "yes"){
                                            echo"<li class='nav-item'><a href='#' class='navbar-nav-link rounded btuc' data-toggle='modal' data-target='#modalUnderConstructions' data-nama='".$dnavi1['nm_modul']."'><span>".$dnavi1['nm_modul']."</span><span class='ml-auto text-warning'><i class='icon-notification2'></i></span></a></li>";
                                        }else{
                                            echo"
                                                <li class='nav-item'>
                                                    <a href='".base_url($dnavi1['url_menu'])."' class='navbar-nav-link rounded ".$modactiveleng."'><span>".$dnavi1['nm_modul']."</span> ".$iconnotifmaster."</a>
                                                </li>
                                            ";
                                        }
                                    }
                                }
                            }
                        ?>

				</ul>
			</div>

			<!-- <ul class="nav gap-1 flex-xl-1 justify-content-end order-0 order-xl-1">
				<li class="nav-item">
					<a href="<?= base_url("auth") ?>" target="_blank" class="navbar-nav-link rounded fw-bold text-light bg-warning pe-3">
					<i class="ph-sign-in me-2"></i>
						Login
					</a>
				</li>
			</ul> -->
            <ul class="nav gap-1 flex-xl-1 justify-content-end order-0 order-xl-1">
						<?php if(sesuser("id_group") != 3){ ?>
						<li class="nav-item ms-lg-2">
							<a href="#" class="navbar-nav-link navbar-nav-link-icon rounded-pill" data-bs-toggle="modal" data-bs-target="#modalCari">
								<i class="ph-magnifying-glass"></i>
							</a>
						</li>
						<?php } ?>
						<li class="nav-item nav-item-dropdown-lg dropdown">
							<a href="#" class="navbar-nav-link align-items-center rounded-pill p-1" data-bs-toggle="dropdown">
								<div class="status-indicator-container">
									<img src="<?= $gambar_profil ?>" class="w-32px h-32px rounded-pill" alt="">
									<span class="status-indicator bg-success"></span>
								</div>
								<span class="d-none d-lg-inline-block mx-lg-2"><?= cekuser(sesuser("no_user"), "nama") ?></span>
							</a>

							<div class="dropdown-menu dropdown-menu-end">
								<a href="<?= base_url("profil") ?>" class="dropdown-item">
									<i class="ph-user-circle me-2"></i>
									Profil Saya
								</a>
								<div class="dropdown-divider"></div>
								<a href="#" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#modalEditMyPass">
									<i class="ph-gear me-2"></i>
									Ganti Password
								</a>
								<a href="#" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#modalLogout">
									<i class="ph-sign-out me-2"></i>
									Logout
								</a>
							</div>
						</li>
					</ul>
		</div>
	</div>
	<!-- /main navbar -->



    <div id="modalLogout" class="modal fade" tabindex="-1">
					<div class="modal-dialog modal-xs">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title">Yakin mau keluar?</h5>
							</div>

							<div class="modal-body">
								<p>Anda yakin akan keluar? Anda akan diminta untuk memasukkan ulang Username dan Password untuk masuk ke panel <?= identitas("judul") ?>.</p>
							</div>

							<div class="modal-footer">
								<button type="button" class="btn btn-light" data-bs-dismiss="modal">Tidak</button>
								<a href="<?php echo base_url("auth/logout");?>" class="btn btn-danger">Ya! Keluarkan Saya</a>
							</div>
						</div>
					</div>
				</div>



	<div id="modalEditMyPass" class="modal fade" tabindex="-1">
		<div class="modal-dialog modal-sm">
			<form method="post" class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Edit Password</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
				</div>

				<div class="modal-body">
					<div class="mb-2">
                        <label class="form-label fw-bold">Password Baru :</label>
                        <input type="password" name="password" class="form-control" placeholder="Ketik password baru" required>
                        <!-- <span class="form-text">+{3}0 000 000 000</span> -->
                    </div>
				</div>

				<div class="modal-footer">
					<button type="reset" class="btn btn-link" data-bs-dismiss="modal">Batal</button>
					<button type="submit" name="editinmypass" class="btn btn-primary">Simpan</button>
				</div>
			</form>
		</div>
	</div>


	<div id="modalCari" class="modal fade" tabindex="-1">
		<div class="modal-dialog modal-sm">
			<form class="modal-content p-0" action="<?= base_url("cari") ?>">
				<div class="modal-body">
					<div class="">
						<div class="form-control-feedback form-control-feedback-start">
							<div div class="input-group">
								<input type="text" class="form-control" placeholder="Cari di sini ..." name="s" required>
								<button class="btn btn-light" type="submit">Cari</button>
							</div>
							<div class="form-control-feedback-icon form-control-feedback-icon">
								<i class="ph-magnifying-glass"></i>
							</div>
						</div>			
                    </div>
				</div>
			</form>
		</div>
	</div>