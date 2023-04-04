<?php
	defined('BASEPATH') or exit('No direct script access allowed');
	if(empty(sesuser("id_user"))){
		redirect(base_url("auth"));
	}

    $no_user = antixss(dekrip($this->uri->segment(4)));
    $sdata = $this->db->query("SELECT a.*, b.`nm_jk`, c.`nm_agama`, d.`nm_group` FROM users a LEFT JOIN jk b ON a.`id_jk` = b.`id_jk` LEFT JOIN agama c ON a.`id_agama` = c.`id_agama` LEFT JOIN `group` d ON a.`id_group` = d.`id_group` WHERE a.no_user = '".$no_user."'");
    $hdata = $sdata->num_rows();
    if(empty($no_user) || $hdata == 0){
        $this->load->view('errors/404');
    }else{
        $ddata = $sdata->result_array();
    if(!empty(cekuser($no_user, "gambar"))){
		$gambar_profil = base_url("berkas/user/".cekuser($no_user, "gambar"));
	}else{
		$gambar_profil = base_url('assets/images/default.png');
	}

    $post = $this->input->post();

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
									</div>

									<h6 class="mb-0"><?= cekuser($no_user, "nama") ?></h6>
									<span class="text-muted"><?= $no_user ?></span>
								</div>
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
                                                <th><?= $no_user ?></th>
                                            </tr>
                                            <tr>
                                                <td>Nama Lengkap</td>
                                                <td>:</td>
                                                <td><?= cekuser($no_user, "nama") ?></td>
                                            </tr>
                                            <tr>
                                                <td>Jns. Kelamin</td>
                                                <td>:</td>
                                                <td><?= cekuser($no_user, "nm_jk") ?></td>
                                            </tr>
                                            <tr>
                                                <td>Agama</td>
                                                <td>:</td>
                                                <td><?= cekuser($no_user, "nm_agama") ?></td>
                                            </tr>
                                            <tr>
                                                <td>No. Handphone</td>
                                                <td>:</td>
                                                <td><?= cekuser($no_user, "hp") ?></td>
                                            </tr>
                                            <tr>
                                                <td>Alamat</td>
                                                <td>:</td>
                                                <td><?= cekuser($no_user, "alamat") ?></td>
                                            </tr>
                                            <tr>
                                                <td>Email</td>
                                                <td>:</td>
                                                <td><?= cekuser($no_user, "email") ?></td>
                                            </tr>
                                            <tr>
                                                <td>Username</td>
                                                <td>:</td>
                                                <td><?= cekuser($no_user, "username") ?></td>
                                            </tr>
                                            <tr>
                                                <td>Group</td>
                                                <td>:</td>
                                                <td><?= cekuser($no_user, "nm_group") ?></td>
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



</body>
</html>
<?php } ?>