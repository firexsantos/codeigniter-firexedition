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
?>
<div class="navbar navbar-expand-lg navbar-static shadow">
				<div class="container-fluid">
					<div class="d-flex d-lg-none me-2">
						<button type="button" class="navbar-toggler sidebar-mobile-main-toggle rounded-pill">
							<i class="ph-list"></i>
						</button>
					</div>

					<div class="navbar-collapse flex-lg-1 order-2 order-lg-1 collapse" id="navbar_search">
                    <span class="ml-3 d-none d-sm-block"><?php echo sambutan(cekuser(sesuser("no_user"), "nama"));?>.</span>
					</div>

					<ul class="nav hstack gap-sm-1 flex-row justify-content-end order-1 order-lg-2">
						<li class="nav-item ms-lg-2">
							<a href="#" class="navbar-nav-link navbar-nav-link-icon rounded-pill" data-bs-toggle="modal" data-bs-target="#modalCari">
								<i class="ph-magnifying-glass"></i>
							</a>
						</li>
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
					<h5 class="modal-title">Formulir Edit Password</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
				</div>

				<div class="modal-body">
					<div class="mb-2">
                        <label class="form-label fw-bold">Password :</label>
                        <input type="password" name="password" class="form-control" placeholder="Password" required>
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