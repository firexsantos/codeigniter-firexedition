<?php
	defined('BASEPATH') or exit('No direct script access allowed');
    if(empty(sesuser('id_user'))){
        redirect("/auth/login", refresh);
    }

    $nomormboh = antixss(dekrip($this->uri->segment(3)));
    $pecahkan = explode("***", $nomormboh);
    if($pecahkan[0] == "nik"){
        $nosarung = $pecahkan[1];
        $sdata = $this->db->query("SELECT a.*, b.`nm_pekerjaan`, b.tgl_kontrak, b.`no_kontrak`, b.`nilai_kontrak`, c.`nm_kecamatan`, d.nm_opd FROM pekerjaan_ta a LEFT JOIN pekerjaan b ON a.`no_pekerjaan` = b.`no_pekerjaan` LEFT JOIN kecamatan c ON b.`id_kecamatan` = c.`id_kecamatan` LEFT JOIN opd d ON b.id_opd = d.id_opd WHERE a.nik = '".$nosarung."' AND b.status = 'final' ORDER BY b.tgl_kontrak DESC");
        $hdata = $sdata->num_rows();
    }else if($pecahkan[0] == "ska"){
        $nosarung = $pecahkan[1];
        $sdata = $this->db->query("SELECT a.*, b.`nm_pekerjaan`, b.tgl_kontrak, b.`no_kontrak`, b.`nilai_kontrak`, c.`nm_kecamatan`, d.nm_opd FROM pekerjaan_ta a LEFT JOIN pekerjaan b ON a.`no_pekerjaan` = b.`no_pekerjaan` LEFT JOIN kecamatan c ON b.`id_kecamatan` = c.`id_kecamatan` LEFT JOIN opd d ON b.id_opd = d.id_opd WHERE a.noreg = '".$nosarung."' AND b.status = 'final' ORDER BY b.tgl_kontrak DESC");
        $hdata = $sdata->num_rows();
    }

    if($hdata == 0){
        $this->load->view('errors/404');
    }else{

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
    <script src="<?= base_url() ?>assets/js/jquery.mask.js"></script>
	<script src="<?= base_url() ?>assets/js/jquery.inputmask.bundle.js"></script>

	<script src="<?= base_url() ?>assets/js/app.js"></script>
    <script src="<?= base_url() ?>assets/demo/pages/animations_css3.js"></script>
    <script src="<?= base_url() ?>assets/demo/pages/datatables_advanced.js"></script>
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
								<?= $title ?> <b class="text-danger">#<?= $nosarung ?></b>
							</h4>

							<a href="#page_header" class="btn btn-light align-self-center collapsed d-lg-none border-transparent rounded-pill p-0 ms-auto" data-bs-toggle="collapse">
								<i class="ph-caret-down collapsible-indicator ph-sm m-1"></i>
							</a>
						</div>

						<div class="collapse d-lg-block my-lg-auto ms-lg-auto" id="page_header">
							<div class="hstack gap-3 mb-3 mb-lg-0">
                                <!-- <a href="<?= base_url("cetak/pdf/personel/".enkrip($nomormboh)) ?>" class="btn btn-outline-primary btn-labeled btn-labeled-start rounded-pill" target="_blank">
                                    <span class="btn-labeled-icon bg-primary text-white rounded-pill">
                                        <i class="ph-printer"></i>
                                    </span>
                                    Cetak Data
                                </a> -->
							</div>
						</div>
					</div>

					<div class="page-header-content d-lg-flex border-top">
						<div class="d-flex">
							<div class="breadcrumb py-2">
								<a href="<?= base_url("dash") ?>" class="breadcrumb-item"><i class="ph-house"></i></a>
								<a href="<?= base_url("personel") ?>" class="breadcrumb-item">Data Personel</a>
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

                    <div class="card">
                        <div class="card-header">
                            <h5 class="mb-0">Data Pekerjaan Personel</h5>
                        </div>
                        <table class="table table-hover datatable-highlight">
							<thead>
                                <tr>
									<th class="text-center">#</th>
									<th>No. Pekerjaan</th>
									<th>Nama Pekerjaan</th>
									<th>No. Kontrak</th>
									<th>Tgl. Kontrak</th>
									<th>Nama Personel</th>
									<th>NIK</th>
									<th>Nomor Registrasi SKA/SKT</th>
									<th>Jenis Keterampilan SKA/SKT</th>
									<th>OPD</th>
								</tr>
							</thead>
							<tbody>
                                <?php
                                    $nodata = 1;
                                    foreach($sdata->result_array() as $ddata){
                                        echo"
                                            <tr>
                                                <td class='text-center'>".$nodata.".</td>
                                                <td><a href='".base_url("pekerjaan/detail/".enkrip($ddata['no_pekerjaan']))."' target='_blank' class='fw-bold'>".$ddata['no_pekerjaan']."</a></td>
                                                <td>".$ddata['nm_pekerjaan']."</td>
                                                <td>".$ddata['no_kontrak']."</td>
                                                <td>".tgl_indo($ddata['tgl_kontrak'],"a")."</td>
                                                <td>".$ddata['nm_ta']."</td>
                                                <td>".$ddata['nik']."</td>
                                                <td>".$ddata['noreg']."</td>
                                                <td>".$ddata['jns_keterampilan']."</td>
                                                <td>".$ddata['nm_opd']."</td>
                                            </tr>
                                        ";
                                        $nodata++;
                                    }
                                ?>
							</tbody>
						</table>
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