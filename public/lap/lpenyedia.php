<?php
	defined('BASEPATH') or exit('No direct script access allowed');
    if(empty(sesuser('id_user'))){
        redirect("/auth/login", refresh);
    }

    $post = $this->input->post();
	if(isset($post['cetaktahun'])){
        $jenis = antixss($post['jenis']);
        $penyedia = antixss($post['penyedia']);
        $tahun = antixss($post['tahun']);

		if($jenis == "pdf"){
            redirect(base_url("cetak/pdf/lap-penyedia/".enkrip("tahun")."/".$penyedia."/".enkrip($tahun)));
        }else if($jenis == "excel"){
            redirect(base_url("cetak/excel/lap-penyedia/".enkrip("tahun")."/".$penyedia."/".enkrip($tahun)));
        }
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
    <script src="<?= base_url() ?>assets/js/vendor/forms/selects/select2.min.js"></script>

	<script src="<?= base_url() ?>assets/js/app.js"></script>
    <script src="<?= base_url() ?>assets/demo/pages/animations_css3.js"></script>
    <script src="<?= base_url() ?>assets/demo/pages/datatables_advanced.js"></script>
    <script src="<?= base_url() ?>assets/demo/pages/form_select2.js"></script>
    <!-- <script src="<?= base_url() ?>assets/demo/pages/extra_sweetalert.js"></script> -->
    <script src="<?= base_url() ?>assets/js/fungsi.js"></script>
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
                        <div class="col-lg-3 col-md-4">
                            <form method="post" class="card" target="_blank">
                                <div class="card-header">
                                    <h5 class="mb-0">Laporan</h5>
                                </div>
                                <div class="card-body" style="min-height:360px;">
                                    <div class="mb-2">
                                        <label class="form-label">Pilih Penyedia :</label>
                                        <select class="form-control select select2-hidden-accessible" data-minimum-input-length="2" data-minimum-results-for-search="Infinity" data-select2-id="7" tabindex="-1" name="penyedia" aria-hidden="true" data-placeholder="Pilih Penyedia" required>
											<option></option>
                                            <optgroup label="Pilih Penyedia">
                                            <?php
                                                $spen = $this->db->query("SELECT COUNT(nm_penyedia) AS judi, nm_penyedia FROM pekerjaan WHERE `status` = 'final' GROUP BY nm_penyedia ORDER BY nm_penyedia DESC");
                                                foreach($spen->result_array() as $dpen){
                                                    echo"<option value='".enkrip($dpen['nm_penyedia'])."'>".$dpen['nm_penyedia']."</option>";
                                                }
                                            ?>
                                            </optgroup>
										</select>
                                    </div>
                                    <div class="mb-2">
                                        <label class="form-label">Tahun :</label>
                                        <input type="number" max="2099" name="tahun" class="form-control" placeholder="Ketik tahun" required>
                                    </div>
                                    <div class="mb-2">
                                        <label class="form-label">Jenis Cetak :</label>
                                        <select class="form-control" name="jenis" required>
                                            <option value="">[ Pilih Jenis Cetak ]</option>
                                            <option value="pdf">PDF</option>
                                            <option value="excel">Excel</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <button type="reset" class="btn btn-link">Reset</button>
                                    <button type="submit" name="cetaktahun" class="btn btn-primary"><i class="ph-printer mx-2"></i> Cetak Laporan</button>
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


    <div id="modalTambah" class="modal fade" tabindex="-1">
		<div class="modal-dialog modal-sm">
			<form method="post" class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Formulir Tambah</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
				</div>

				<div class="modal-body">
                    <div class="mb-2">
                        <label class="form-label">Nama OPD :</label>
                        <input type="text" name="nm_opd" class="form-control" placeholder="Nama OPD" required>
                        <!-- <span class="form-text">+{3}0 000 000 000</span> -->
                    </div>
				</div>

				<div class="modal-footer">
					<button type="reset" class="btn btn-link" data-bs-dismiss="modal">Batal</button>
					<button type="submit" name="tambahin" class="btn btn-primary">Simpan</button>
				</div>
			</form>
		</div>
	</div>

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