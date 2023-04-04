<?php
	defined('BASEPATH') or exit('No direct script access allowed');
    if(empty(sesuser('id_user'))){
        redirect("/auth/login", refresh);
    }

    $post = $this->input->post();
	if(isset($post['tambahin'])){
		$ceking = $this->db->get_where("users", array("username" => antixss($post['username'])))->num_rows();
		if($ceking > 0){
			$this->session->set_flashdata('pesen', '<div class="alert alert-danger">Gagal! Username <b>'.antixss($post['username']).'</b> sudah terdaftar. Silahkan gunakan username lain.</div>');
		}else{
            $no_register = autoregister();
            $groupdef		= ".";
            $nogrop = 1;
			foreach($post['groupe'] as $mboh){
				$groupdef	.= $mboh.".";
                if($nogrop == 1){
                    $id_group = $mboh;
                }
                $nogrop++;
			}
			$post_data	= array(
				"no_register"	=> $no_register,
				"nama"	=> antixss($post['nama']),
				"nip"	=> antixss($post['nip']),
				"nik"	=> antixss($post['nik']),
				"id_jk"	=> antixss($post['id_jk']),
				"id_agama"	=> antixss($post['id_agama']),
				"hp"	=> antixss($post['hp']),
				"alamat"	=> antixss($post['alamat']),
				"email"	=> antixss($post['email']),
				"username"	=> antixss($post['username']),
				"password"	=> md5($post['password']),
                'id_group'		=> $id_group,
                'groupdef'		=> $groupdef,
			);

			$hajar		= $this->db->insert("users", $post_data);
			if($hajar){
				$this->session->set_flashdata('pesen', '<script>sukses("tambah");</script>');
			}else{
				$this->session->set_flashdata('pesen', '<script>gagal("tambah");</script>');
			}
		}
		redirect(base_url("users/superadmin"));
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
	<link href="<?= base_url() ?>assets/fonts/inter/inter.css" rel="stylesheet" type="text/css">
	<link href="<?= base_url() ?>assets/icons/phosphor/styles.min.css" rel="stylesheet" type="text/css">
	<link href="<?= base_url() ?>assets/css/ltr/all.min.css" id="stylesheet" rel="stylesheet" type="text/css">
    <link href="<?= base_url() ?>assets/css/animate.min.css" rel="stylesheet" type="text/css">
	<!-- /global stylesheets -->

	<!-- Core JS files -->
	<script src="<?= base_url() ?>assets/demo/demo_configurator.js"></script>
	<script src="<?= base_url() ?>assets/js/bootstrap/bootstrap.bundle.min.js"></script>

    <script src="<?= base_url() ?>assets/js/jquery/jquery.min.js"></script>
    <script src="<?= base_url() ?>assets/js/vendor/notifications/sweet_alert.min.js"></script>
	<script src="<?= base_url() ?>assets/js/vendor/tables/datatables/datatables.min.js"></script>
    <script src="<?= base_url() ?>assets/js/vendor/forms/selects/bootstrap_multiselect.js"></script>
    <script src="<?= base_url() ?>assets/js/jquery.mask.js"></script>
	<script src="<?= base_url() ?>assets/js/jquery.inputmask.bundle.js"></script>

	<script src="<?= base_url() ?>assets/js/app.js"></script>
    <script src="<?= base_url() ?>assets/demo/pages/animations_css3.js"></script>
    <script src="<?= base_url() ?>assets/demo/pages/datatables_advanced.js"></script>
    <script src="<?= base_url() ?>assets/js/fungsi.js"></script>
    <script src="<?= base_url() ?>assets/demo/pages/form_multiselect.js"></script>
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
								<?= $title ?>
							</h1>
						</div>
					</div>
				</div>
				

				<div class="content container pt-0">

                    <?php
                        echo $this->session->flashdata('pesen');
                        unset($_SESSION['pesen']);
                    ?>
                    <div class="row">
                        <div class="col-md-8 col-lg-6">
                            <form method="post" class="card">
                                <div class="card-header">
                                    <a href="<?= base_url("users/admin") ?>" class="btn btn-primary"><i class="ph-arrow-left mx-2"></i> Kembali</a>
                                </div>
                                <div class="card-body">
                                    <div class="mb-2">
                                        <label class="form-label">Nama :</label>
                                        <input type="text" name="nama" class="form-control" placeholder="Nama Lengkap" required>
                                        <!-- <span class="form-text">+{3}0 000 000 000</span> -->
                                    </div>
                                    <div class="mb-2">
                                        <label class="form-label">Jns. Kelamin :</label>
                                        <select class="form-control" name="id_jk" required>
                                            <option value="">[ Pilih Jenis Kelamin ]</option>
                                            <?php
                                                $sjk = $this->db->get("jk");
                                                foreach($sjk->result_array() as $djk){
                                                    echo"<option value='".$djk['id_jk']."'>".$djk['nm_jk']."</option>";
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
                                                    echo"<option value='".$djk['id_agama']."'>".$djk['nm_agama']."</option>";
                                                }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="mb-2">
                                        <label class="form-label">Nomor Handphone :</label>
                                        <input type="text" name="hp" class="form-control hpne" placeholder="Nomor Handphone" required>
                                        <!-- <span class="form-text">+{3}0 000 000 000</span> -->
                                    </div>
                                    <div class="mb-2">
                                        <label class="form-label">Alamat :</label>
                                        <input type="text" name="alamat" class="form-control" placeholder="Alamat" required>
                                        <!-- <span class="form-text">+{3}0 000 000 000</span> -->
                                    </div>
                                    <div class="mb-2">
                                        <label class="form-label">Email :</label>
                                        <input type="email" name="email" class="form-control" placeholder="Email">
                                        <!-- <span class="form-text">+{3}0 000 000 000</span> -->
                                    </div>
                                    <div class="mb-2">
                                        <label class="form-label">Pilih Group :</label>
                                        <span class="multiselect-native-select">
                                            <select class="form-control multiselect" multiple="multiple" data-include-select-all-option="true" name="groupe[]" required>
                                                <?php
                                                    $sgr = $this->db->query("SELECT * FROM `group` WHERE id_group <> '3'");
                                                    foreach($sgr->result_array() as $dgr){
                                                        echo"<option value='".$dgr['id_group']."'>".$dgr['nm_group']."</option>";
                                                    }
                                                ?>
                                            </select>
                                        </span>
                                    </div>
                                    <div class="mb-2">
                                        <label class="form-label fw-bold">Username :</label>
                                        <input type="text" name="username" class="form-control" placeholder="Username" required>
                                        <!-- <span class="form-text">+{3}0 000 000 000</span> -->
                                    </div>
                                    <div class="mb-2">
                                        <label class="form-label fw-bold">Password :</label>
                                        <input type="password" name="password" class="form-control" placeholder="Password" required>
                                        <!-- <span class="form-text">+{3}0 000 000 000</span> -->
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <a href="<?= base_url("users/admin") ?>" class="btn btn-link">Batal</a>
                                    <button type="submit" name="tambahin" class="btn btn-primary">Simpan</button>
                                </div>
                            </form>
                        </div>
                    </div>
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


    <script>
		$(document).ready(function() {
			function selectElement(id, valueToSelect) {    
				let element = document.getElementById(id);
				element.value = valueToSelect;
			}
		});
	</script>
</body>
</html>