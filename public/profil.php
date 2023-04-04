<?php
	defined('BASEPATH') or exit('No direct script access allowed');
	if(empty(sesuser("id_user"))){
		redirect(base_url("auth"));
	}

    if(!empty(cekuser(sesuser("no_user"), "gambar"))){
		$gambar_profil = base_url("berkas/user/".cekuser(sesuser("no_user"), "gambar"));
	}else{
		$gambar_profil = base_url('assets/images/default.png');
	}

    $post = $this->input->post();
    if(isset($post['editinprofil'])){
        $post_data	= array(
			"nama"	=> antixss($post['nama']),
			"id_jk"	=> antixss($post['id_jk']),
			"id_agama"	=> antixss($post['id_agama']),
			"hp"	=> antixss($post['hp']),
			"alamat"	=> antixss($post['alamat']),
			"email"	=> antixss($post['email'])
		);
		$hajar			= $this->db->update("users", $post_data, array("no_user" => sesuser("no_user")));
		if($hajar){
			$this->session->set_flashdata('pesen', '<script>sukses("edit");</script>');
		}else{
			$this->session->set_flashdata('pesen', '<script>gagal("edit");</script>');
		}
		redirect(base_url("profil"));
    }
?><!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title><?= $title ?> - <?= identitas("judul") ?></title>
    <meta name="description" content="<?= $title ?> - <?= identitas("judul") ?>">
    <meta name="author" content="Firman Santosa" />
    <link rel="shortcut icon" href="<?= identitas("favicon") ?>" />

	<!-- Global stylesheets -->
	<link href="<?= base_url() ?>assets//fonts/inter/inter.css" rel="stylesheet" type="text/css">
	<link href="<?= base_url() ?>assets//icons/phosphor/styles.min.css" rel="stylesheet" type="text/css">
	<link href="<?= base_url() ?>assets/css/ltr/all.min.css" id="stylesheet" rel="stylesheet" type="text/css">
    <link href="<?= base_url() ?>assets/css/animate.min.css" rel="stylesheet" type="text/css">
	<!-- /global stylesheets -->

	<!-- Core JS files -->
	<script src="<?= base_url() ?>assets//demo/demo_configurator.js"></script>
	<script src="<?= base_url() ?>assets//js/bootstrap/bootstrap.bundle.min.js"></script>

	<script src="<?= base_url() ?>assets/js/jquery/jquery.min.js"></script>
	<script src="<?= base_url() ?>assets/js/vendor/notifications/sweet_alert.min.js"></script>

	<script src="<?= base_url() ?>assets/js/app.js"></script>
    <script src="<?= base_url() ?>assets/demo/pages/animations_css3.js"></script>
	<script src="<?= base_url() ?>assets/js/fungsi.js"></script>
	<!-- /theme JS files -->

</head>

<body>

			<?php
                $this->load->view("inc/nav");
            ?>
	<!-- Page content -->
	<div class="page-content">

		<?php
            // $this->load->view("inc/sidebar");
        ?>


		<!-- Main content -->
		<div class="content-wrapper">



			<!-- Inner content -->
			<div class="content-inner">


				<div class="page-header">
					<div class="page-header-content container d-lg-flex">
						<div class="d-flex">
							<h1 class="page-title mb-0">
								<?= $title ?></span>
							</h1>
                            <a href="#page_header" class="btn btn-light align-self-center collapsed d-lg-none border-transparent rounded-pill p-0 ms-auto" data-bs-toggle="collapse">
								<i class="ph-caret-down collapsible-indicator ph-sm m-1"></i>
							</a>
						</div>
                        <div class="collapse d-lg-block my-lg-auto ms-lg-auto" id="page_header">
							<div class="hstack gap-3 mb-3 mb-lg-0">
								<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalEditProfil">
									<i class="ph-pencil me-2"></i>
									Edit Profl
								</button>
							</div>
						</div>
					</div>
				</div>

				<div class="content container pt-0">

					<?php
                        echo $this->session->flashdata('pesen');
                        unset($_SESSION['pesen']);
                    ?>
					<div class="row">
                        <div class="col-md-4 col-lg-3">
                            <div class="card">
								<div class="sidebar-section-body text-center pt-4 mb-3">
									<div class="card-img-actions d-inline-block mb-3">
										<img class="img-fluid rounded-circle" src="<?= $gambar_profil ?>" alt="" width="200" height="200">
										<div class="card-img-actions-overlay card-img rounded-circle">
											<a href="#" class="btn btn-outline-white btn-icon rounded-pill" data-bs-toggle="modal" data-bs-target="#modalEditGambarProfil">
												<i class="ph-pencil"></i>
											</a>
										</div>
									</div>

									<h6 class="mb-0"><?= cekuser(sesuser("no_user"), "nama") ?></h6>
									<span class="text-muted"><?= sesuser("no_user") ?></span>
								</div>

								<ul class="nav nav-sidebar" role="tablist">
									
									<li class="nav-item-divider"></li>
									<li class="nav-item" role="presentation">
										<a href="#" data-bs-toggle="modal" data-bs-target="#modalLogout" class="nav-link" data-bs-toggle="tab" aria-selected="false" tabindex="-1" role="tab">
											<i class="ph-sign-out me-2"></i>
											Keluar Sistem
										</a>
									</li>
								</ul>
							</div>
                        </div>
                        <div class="col-md-8 col-lg-9">
                            <div class="card">
								<div class="card-header d-sm-flex">
									<h5 class="mb-0">Detail Profil</h5>
								</div>

								<div class="table-responsive">
                                    <table class="table table-hover">
                                        <tbody>
                                            <tr>
                                                <th>No. Register</th>
                                                <th style="width:30px;">:</th>
                                                <th><?= sesuser("no_user") ?></th>
                                            </tr>
                                            <tr>
                                                <td>Nama Lengkap</td>
                                                <td>:</td>
                                                <td><?= cekuser(sesuser("no_user"), "nama") ?></td>
                                            </tr>
                                            <tr>
                                                <td>Jns. Kelamin</td>
                                                <td>:</td>
                                                <td><?= cekuser(sesuser("no_user"), "nm_jk") ?></td>
                                            </tr>
                                            <tr>
                                                <td>Agama</td>
                                                <td>:</td>
                                                <td><?= cekuser(sesuser("no_user"), "nm_agama") ?></td>
                                            </tr>
                                            <tr>
                                                <td>No. Handphone</td>
                                                <td>:</td>
                                                <td><?= cekuser(sesuser("no_user"), "hp") ?></td>
                                            </tr>
                                            <tr>
                                                <td>Alamat</td>
                                                <td>:</td>
                                                <td><?= cekuser(sesuser("no_user"), "alamat") ?></td>
                                            </tr>
                                            <tr>
                                                <td>Email</td>
                                                <td>:</td>
                                                <td><?= cekuser(sesuser("no_user"), "email") ?></td>
                                            </tr>
                                            <tr>
                                                <td>Username</td>
                                                <td>:</td>
                                                <td><?= cekuser(sesuser("no_user"), "username") ?></td>
                                            </tr>
                                            <tr>
                                                <td>Group</td>
                                                <td>:</td>
                                                <td><?= cekuser(sesuser("no_user"), "nm_group") ?></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
							</div>
                        </div>
                    </div>
								<!-- Navigation -->
								

                    
				</div>
				<!-- /content area -->


				<?php
                    $this->load->view("inc/footer");
                ?>

			</div>
			<!-- /inner content -->


		</div>
		<!-- /main content -->

	</div>
	<!-- /page content -->

    <div id="modalEditProfil" class="modal fade" tabindex="-1">
		<div class="modal-dialog modal-sm">
			<form method="post" class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Edit Profil</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
				</div>

				<div class="modal-body">
					<div class="mb-2">
                        <label class="form-label">Nama Lengkap :</label>
                        <input type="text" name="nama" class="form-control" placeholder="Nama Lengkap" value="<?= cekuser(sesuser("no_user"), "nama") ?>" required>
                        <!-- <span class="form-text">+{3}0 000 000 000</span> -->
                    </div>
                    <div class="mb-2">
                        <label class="form-label">Jenis Kelamin :</label>
                        <select class="form-control" name="id_jk" required>
                            <option value="">[ Pilih Jenis Kelamin ]</option>
                            <?php
                                $sjk = $this->db->get("jk");
                                foreach($sjk->result_array() as $djk){
                                    if(cekuser(sesuser("no_user"), "id_jk") == $djk['id_jk']){
                                        echo"<option value='".$djk['id_jk']."' selected>".$djk['nm_jk']."</option>";
                                    }else{
                                        echo"<option value='".$djk['id_jk']."'>".$djk['nm_jk']."</option>";
                                    }
                                }
                            ?>
                        </select>
                    </div>
                    <div class="mb-2">
                        <label class="form-label">Agama :</label>
                        <select class="form-control" name="id_agama" required>
                            <option value="">[ Pilih Agama ]</option>
                            <?php
                                $sjk = $this->db->get("agama");
                                foreach($sjk->result_array() as $djk){
                                    if(cekuser(sesuser("no_user"), "id_agama") == $djk['id_agama']){
                                        echo"<option value='".$djk['id_agama']."' selected>".$djk['nm_agama']."</option>";
                                    }else{
                                        echo"<option value='".$djk['id_agama']."'>".$djk['nm_agama']."</option>";
                                    }
                                }
                            ?>
                        </select>
                    </div>
                    <div class="mb-2">
                        <label class="form-label">No. Hanphone :</label>
                        <input type="text" name="hp" class="form-control" placeholder="No. Handphone" value="<?= cekuser(sesuser("no_user"), "hp") ?>" required>
                        <!-- <span class="form-text">+{3}0 000 000 000</span> -->
                    </div>
                    <div class="mb-2">
                        <label class="form-label">Alamat :</label>
                        <input type="text" name="alamat" class="form-control" placeholder="Alamat Lengkap" value="<?= cekuser(sesuser("no_user"), "alamat") ?>" required>
                        <!-- <span class="form-text">+{3}0 000 000 000</span> -->
                    </div>
                    <div class="mb-2">
                        <label class="form-label">Email :</label>
                        <input type="email" name="email" class="form-control" placeholder="Email" value="<?= cekuser(sesuser("no_user"), "email") ?>" required>
                        <!-- <span class="form-text">+{3}0 000 000 000</span> -->
                    </div>
				</div>

				<div class="modal-footer">
					<button type="reset" class="btn btn-link" data-bs-dismiss="modal">Batal</button>
					<button type="submit" name="editinprofil" class="btn btn-primary">Simpan</button>
				</div>
			</form>
		</div>
	</div>
    
    
    
    <div id="modalEditGambarProfil" class="modal fade" tabindex="-1">
		<div class="modal-dialog modal-sm">
			<form method="post" class="modal-content" enctype="multipart/form-data" action="<?= base_url("profil/addgambarproses") ?>">
				<div class="modal-header">
					<h5 class="modal-title">Edit Gambar Profil</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
				</div>

				<div class="modal-body">
					<div class="mb-2">
                        <label class="form-label">Nama Lengkap :</label>
                        <input type="file" name="berkas" class="form-control" id="taxtno200" accept="image/*" required>
                    </div>
                    
				</div>

				<div class="modal-footer">
					<button type="reset" class="btn btn-link" data-bs-dismiss="modal">Batal</button>
					<button type="submit" name="editingambarprofil" class="btn btn-primary">Simpan</button>
				</div>
			</form>
		</div>
	</div>


</body>
</html>