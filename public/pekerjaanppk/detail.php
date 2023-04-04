<?php
	defined('BASEPATH') or exit('No direct script access allowed');
    if(empty(sesuser('id_user'))){
        redirect("/auth/login", refresh);
    }

    $no_pekerjaan = antixss(dekrip($this->uri->segment(3)));
    $skerja = $this->db->query("SELECT a.*, b.`nm_opd`, c.`nm_modpilih`, d.`nm_pekerjaanjns`, e.nm_kecamatan FROM pekerjaan a LEFT JOIN opd b ON a.`id_opd` = b.`id_opd` LEFT JOIN modpilih c ON a.`id_modpilih` = c.`id_modpilih` LEFT JOIN pekerjaanjns d ON a.`id_pekerjaanjns` = d.`id_pekerjaanjns` LEFT JOIN kecamatan e ON a.id_kecamatan = e.id_kecamatan WHERE a.no_pekerjaan = '".$no_pekerjaan."'");
    $hkerja = $skerja->num_rows();
    if($hkerja == 0){
        $this->load->view('errors/404');
    }else{
        $dkerja = $skerja->result_array();

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
								<?= $title ?> <b class="text-danger">#<?= $no_pekerjaan ?></b>
							</h4>

							<a href="#page_header" class="btn btn-light align-self-center collapsed d-lg-none border-transparent rounded-pill p-0 ms-auto" data-bs-toggle="collapse">
								<i class="ph-caret-down collapsible-indicator ph-sm m-1"></i>
							</a>
						</div>

						<div class="collapse d-lg-block my-lg-auto ms-lg-auto" id="page_header">
							<div class="hstack gap-3 mb-3 mb-lg-0">
                                <a href="<?= base_url("cetak/pdf/pekerjaan/".enkrip($no_pekerjaan)) ?>" class="btn btn-outline-primary btn-labeled btn-labeled-start rounded-pill" target="_blank">
                                    <span class="btn-labeled-icon bg-primary text-white rounded-pill">
                                        <i class="ph-printer"></i>
                                    </span>
                                    Cetak Pekerjaan
                                </a>
							</div>
						</div>
					</div>

					<div class="page-header-content d-lg-flex border-top">
						<div class="d-flex">
							<div class="breadcrumb py-2">
								<a href="<?= base_url("dash") ?>" class="breadcrumb-item"><i class="ph-house"></i></a>
								<a href="<?= base_url("pekerjaan") ?>" class="breadcrumb-item">Data Pekerjaan</a>
								<span class="breadcrumb-item active"><?= $title ?> #<?= $no_pekerjaan ?></span>
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
							<h5 class="mb-0"><?= $title ?></h5>
						</div>
                        <table class="table table-hover">
                            <tbody>
                                <tr>
                                    <td>Pemerintah Daerah</td>
                                    <td style="width:20px;">:</td>
                                    <th>Kabupaten Pelalawan</th>
                                </tr>
                                <tr>
                                    <td>Zona Pekerjaan</td>
                                    <td style="width:20px;">:</td>
                                    <th><?= $dkerja[0]['nm_kecamatan'] ?></th>
                                </tr>
                                <tr>
                                    <td>Perangkat Daerah</td>
                                    <td>:</td>
                                    <th><?= $dkerja[0]['nm_opd'] ?></th>
                                </tr>
                                <tr>
                                    <td>Tahun Anggaran</td>
                                    <td>:</td>
                                    <th><?= $dkerja[0]['tahun'] ?></th>
                                </tr>
                                <tr>
                                    <td>Metode Pemilihan</td>
                                    <td>:</td>
                                    <th><?= $dkerja[0]['nm_modpilih'] ?></th>
                                </tr>
                                <tr>
                                    <td>Nama Pekerjaan</td>
                                    <td>:</td>
                                    <th><?= $dkerja[0]['nm_pekerjaan'] ?></th>
                                </tr>
                                <tr>
                                    <td>Jenis Pekerjaan</td>
                                    <td>:</td>
                                    <th><?= $dkerja[0]['nm_pekerjaanjns'] ?></th>
                                </tr>
                                <tr>
                                    <td>No. Kontrak</td>
                                    <td>:</td>
                                    <th><?= $dkerja[0]['no_kontrak'] ?></th>
                                </tr>
                                <tr>
                                    <td>Nilai Kontrak</td>
                                    <td>:</td>
                                    <th>Rp <?= rupiah($dkerja[0]['nilai_kontrak']) ?>,-</th>
                                </tr>
                                <tr>
                                    <td>Tgl. Penandatanganan Kontrak</td>
                                    <td>:</td>
                                    <th><?= tgl_indo($dkerja[0]['tgl_kontrak']) ?></th>
                                </tr>
                                <tr>
                                    <td>Waktu Pelaksanaan Pekerjaan</td>
                                    <td>:</td>
                                    <th><?= $dkerja[0]['waktu_pekerjaan'] ?> hari kalender</th>
                                </tr>
                                <tr>
                                    <td>Tgl. Berakhir Kontrak</td>
                                    <td>:</td>
                                    <th><?= tgl_indo($dkerja[0]['tgl_kontrak_berakhir']) ?></th>
                                </tr>
                                <tr>
                                    <td>Nama Penyedia</td>
                                    <td>:</td>
                                    <th><?= $dkerja[0]['nm_penyedia'] ?></th>
                                </tr>
                                <tr>
                                    <td>NPWP Penyedia</td>
                                    <td>:</td>
                                    <th><?= $dkerja[0]['npwp_penyedia'] ?></th>
                                </tr>
                                <tr>
                                    <td>No. HP Penyedia</td>
                                    <td>:</td>
                                    <th><?= $dkerja[0]['hp_penyedia'] ?></th>
                                </tr>
                            </tbody>
                        </table>
					</div>
					

                    <div class="card">
                        <div class="card-header">
                            <h5 class="mb-0">Data Personel</h5>
                        </div>
                        <table class="table table-hover">
							<thead>
								<tr>
									<th class="text-center">#</th>
									<th>Nama Personel</th>
									<th>NIK</th>
									<th>Jenis Keterampilan SKA/SKT</th>
									<th>Nomor Registrasi SKA/SKT</th>
									<th>Deskripsi</th>
								</tr>
							</thead>
							<tbody>
								<?php
                                    $nodata = 1;
                                    $sdata = $this->db->get_where("pekerjaan_ta", array("no_pekerjaan" => $no_pekerjaan));
                                    foreach($sdata->result_array() as $ddata){
                                        echo"
                                            <tr>
                                                <td class='text-center'>".$nodata.".</td>
                                                <td>".$ddata['nm_ta']."</td>
                                                <td>".$ddata['nik']."</td>
                                                <td>".$ddata['jns_keterampilan']."</td>
                                                <td>".$ddata['noreg']."</td>
                                                <td>".$ddata['deskripsi']."</td>
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