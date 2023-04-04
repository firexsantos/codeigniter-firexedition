<?php
	defined('BASEPATH') or exit('No direct script access allowed');
    if(empty(sesuser('id_user'))){
        redirect("/auth/login", refresh);
    }

    $id_zonasi = antixss(dekrip($this->uri->segment(4)));
    $sdata = $this->db->get_where("zonasi", array("id_zonasi" => $id_zonasi));
    $hdata = $sdata->num_rows();
    if($hdata == 0){
        $this->load->view('errors/404');
    }else{
        $ddata = $sdata->result_array();

        $post = $this->input->post();
        if(isset($post['editin'])){
            $groupdef		= ".";
            $nogrop = 1;
            foreach($post['zonasi'] as $mboh){
                $groupdef	.= $mboh.".";
                if($nogrop == 1){
                    $id_group = $mboh;
                }
                $nogrop++;
            }
            $post_data	= array(
                'kecamatan'		=> $groupdef,
                'nm_zonasi' => antixss($post['nm_zonasi'])
            );

            $hajar		= $this->db->update("zonasi", $post_data, array("id_zonasi" => $id_zonasi));
            if($hajar){
                $this->session->set_flashdata('pesen', '<script>sukses("edit");</script>');
            }else{
                $this->session->set_flashdata('pesen', '<script>gagal("edit");</script>');
            }
            
            redirect(base_url("master/zonasi"));
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

	<script src="<?= base_url() ?>assets/js/app.js"></script>
    <script src="<?= base_url() ?>assets/demo/pages/animations_css3.js"></script>
    <script src="<?= base_url() ?>assets/demo/pages/datatables_advanced.js"></script>
    <script src="<?= base_url() ?>assets/js/fungsi.js"></script>
    <script src="<?= base_url() ?>assets/demo/pages/form_multiselect.js"></script>
	<!-- /theme JS files -->

</head>

<body>

	<!-- Page content -->
	<div class="page-content">

		<?php
            $this->load->view("inc/sidebar");
        ?>


		<!-- Main content -->
		<div class="content-wrapper">

			<?php
                $this->load->view("inc/nav");
            ?>


			<!-- Inner content -->
			<div class="content-inner">

				<!-- Page header -->
				<div class="page-header page-header-light shadow">
					<div class="page-header-content d-lg-flex">
						<div class="d-flex">
							<h4 class="page-title mb-0">
								<?= $title ?>
							</h4>
						</div>
					</div>

					<div class="page-header-content d-lg-flex border-top">
						<div class="d-flex">
							<div class="breadcrumb py-2">
								<a href="<?= base_url("dash") ?>" class="breadcrumb-item"><i class="ph-house"></i></a>
								<a href="<?= base_url("master/zonasi") ?>" class="breadcrumb-item">Master Zonasi</a>
								<span class="breadcrumb-item active"><?= $title ?></span>
							</div>
						</div>
					</div>
				</div>


				<div class="content">

                    <?php
                        echo $this->session->flashdata('pesen');
                        unset($_SESSION['pesen']);
                    ?>
                    <div class="row">
                        <div class="col-md-8 col-lg-6">
                            <form method="post" class="card">
                                <div class="card-header">
                                    <h5 class="mb-0"><?= $title ?></h5>
                                </div>
                                <div class="card-body">
                                    <div class="mb-2">
                                        <label class="form-label">Nama Zonasi :</label>
                                        <input type="text" name="nm_zonasi" class="form-control" value="<?= $ddata[0]['nm_zonasi'] ?>" placeholder="Nama Zonasi" required>
                                    </div>
                                    <div class="mb-2">
                                        <label class="form-label">Pilih Kecamatan :</label>
                                        <span class="multiselect-native-select">
                                            <select class="form-control multiselect" multiple="multiple" data-include-select-all-option="true" name="zonasi[]" required>
                                                <?php
                                                    $groupdef = explode(".",$ddata[0]['kecamatan']);
                                                    $sgr = $this->db->get_where("kecamatan", array("id_kabupaten" => identitas("kabupaten")));
                                                    foreach($sgr->result_array() as $dgr){
                                                        if(in_array($dgr['id_kecamatan'], $groupdef)){
                                                            echo"<option value='".$dgr['id_kecamatan']."' selected>".$dgr['nm_kecamatan']."</option>";
                                                        }else{
                                                            echo"<option value='".$dgr['id_kecamatan']."'>".$dgr['nm_kecamatan']."</option>";
                                                        }
                                                        
                                                    }
                                                ?>
                                            </select>
                                        </span>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <a href="<?= base_url("master/zonasi") ?>" class="btn btn-link">Batal</a>
                                    <button type="submit" name="editin" class="btn btn-primary">Simpan</button>
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
<?php } ?>