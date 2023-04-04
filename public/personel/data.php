<?php
	defined('BASEPATH') or exit('No direct script access allowed');
    if(empty(sesuser('id_user'))){
        redirect("/auth/login", refresh);
    }

    $fil = antixss(dekrip(trim(@$_GET['fil'])));
    if($fil == "ska"){
        $groupby = "a.noreg";
    }else{
        $groupby = "a.nik";
    }
    $sdata = $this->db->query("SELECT COUNT(".$groupby.") AS jumkerjo, ".$groupby." FROM pekerjaan_ta a LEFT JOIN pekerjaan b ON a.no_pekerjaan = b.no_pekerjaan WHERE b.status = 'final' GROUP BY ".$groupby);
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
    <script src="<?= base_url() ?>assets/js/vendor/ui/moment/moment.min.js"></script>
    <script src="<?= base_url() ?>assets/js/vendor/notifications/sweet_alert.min.js"></script>
	<script src="<?= base_url() ?>assets/js/vendor/tables/datatables/datatables.min.js"></script>
    <script src="<?= base_url() ?>assets/js/jquery.mask.js"></script>
	<script src="<?= base_url() ?>assets/js/jquery.inputmask.bundle.js"></script>
    <script src="<?= base_url() ?>assets/js/vendor/pickers/daterangepicker.js"></script>
    <script src="<?= base_url() ?>assets/js/vendor/pickers/datepicker.min.js"></script>

	<script src="<?= base_url() ?>assets/js/app.js"></script>
    <script src="<?= base_url() ?>assets/demo/pages/animations_css3.js"></script>
    <script src="<?= base_url() ?>assets/demo/pages/datatables_advanced.js"></script>
    <script src="<?= base_url() ?>assets/demo/pages/extra_sweetalert.js"></script>
    <script src="<?= base_url() ?>assets/js/fungsi.js"></script>

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

							<a href="#page_header" class="btn btn-light align-self-center collapsed d-lg-none border-transparent rounded-pill p-0 ms-auto" data-bs-toggle="collapse">
								<i class="ph-caret-down collapsible-indicator ph-sm m-1"></i>
							</a>
						</div>

						<div class="collapse d-lg-block my-lg-auto ms-lg-auto" id="page_header">
                            <div class="d-sm-flex align-items-center mb-3 mb-lg-0 ms-lg-3">
								<div class="dropdown w-100 w-sm-auto">
                                    <?php
                                        if($fil == "ska"){
                                            echo'
                                            <a href="#" class="d-flex align-items-center text-body lh-1 dropdown-toggle py-sm-2" data-bs-toggle="dropdown" data-bs-display="static" aria-expanded="false">
                                                <img src="'.base_url().'assets/images/icons/ska.svg" class="w-32px h-32px me-2" alt="">
                                                <div class="me-auto me-lg-1">
                                                    <div class="fs-sm text-muted mb-1">Group by</div>
                                                    <div class="fw-semibold">No. Register SKA/SKT</div>
                                                </div>
                                            </a>

                                            <div class="dropdown-menu dropdown-menu-lg-end w-100 w-lg-auto wmin-300 wmin-sm-350 pt-0">
                                                <div class="d-flex align-items-center p-3">
                                                    <h6 class="fw-semibold mb-0">Set Grouping</h6>
                                                </div>
                                                <a href="'.base_url("personel?fil=".enkrip("ktp")).'" class="dropdown-item py-2">
                                                    <img src="'.base_url().'assets/images/icons/ktp.svg" class="w-32px h-32px me-2" alt="">
                                                    <div>
                                                        <div class="fw-semibold">Nomor Induk Kependudukan</div>
                                                        <div class="fs-sm text-muted">42 personel</div>
                                                    </div>
                                                </a>
                                                <a href="'.base_url("personel?fil=".enkrip("ska")).'" class="dropdown-item active py-2">
                                                    <img src="'.base_url().'assets/images/icons/ska.svg" class="w-32px h-32px me-2" alt="">
                                                    <div>
                                                        <div class="fw-semibold">No. Register SKA/SKT</div>
                                                        <div class="fs-sm text-muted">49 personel</div>
                                                    </div>
                                                </a>
                                            </div>
                                            ';
                                        }else{
                                            echo'
                                            <a href="#" class="d-flex align-items-center text-body lh-1 dropdown-toggle py-sm-2" data-bs-toggle="dropdown" data-bs-display="static" aria-expanded="false">
                                                <img src="'.base_url().'assets/images/icons/ktp.svg" class="w-32px h-32px me-2" alt="">
                                                <div class="me-auto me-lg-1">
                                                    <div class="fs-sm text-muted mb-1">Group by</div>
                                                    <div class="fw-semibold">Nomor Induk Kependudukan</div>
                                                </div>
                                            </a>

                                            <div class="dropdown-menu dropdown-menu-lg-end w-100 w-lg-auto wmin-300 wmin-sm-350 pt-0">
                                                <div class="d-flex align-items-center p-3">
                                                    <h6 class="fw-semibold mb-0">Set Grouping</h6>
                                                </div>
                                                <a href="'.base_url("personel?fil=".enkrip("ktp")).'" class="dropdown-item active py-2">
                                                    <img src="'.base_url().'assets/images/icons/ktp.svg" class="w-32px h-32px me-2" alt="">
                                                    <div>
                                                        <div class="fw-semibold">Nomor Induk Kependudukan</div>
                                                        <div class="fs-sm text-muted">42 personel</div>
                                                    </div>
                                                </a>
                                                <a href="'.base_url("personel?fil=".enkrip("ska")).'" class="dropdown-item py-2">
                                                    <img src="'.base_url().'assets/images/icons/ska.svg" class="w-32px h-32px me-2" alt="">
                                                    <div>
                                                        <div class="fw-semibold">No. Register SKA/SKT</div>
                                                        <div class="fs-sm text-muted">49 personel</div>
                                                    </div>
                                                </a>
                                            </div>
                                            ';
                                        }
                                    ?>
									
								</div>
							</div>
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

					<div class="card">
						<!-- <div class="card-header">
							<h5 class="mb-0"><?= $title ?></h5>
						</div> -->

						<div class="">
                            <table class="table table-hover datatable-highlight">
								<thead>
									<tr>
										<th class="text-center">#</th>
										<th>Nama Personel</th>
										<th>NIK</th>
										<th>Nomor Registrasi SKA/SKT</th>
										<th>Jenis Keterampilan SKA/SKT</th>
										<th>Jumlah Pekerjaan</th>
									</tr>
								</thead>
								<tbody>
									<?php
                                        $nodata = 1;
                                        foreach($sdata->result_array() as $ddata){
                                            
                                            if($fil == "ska"){
                                                $clnik = "";
                                                $clska = "fw-bold";
                                                $ddor = $this->db->get_where("pekerjaan_ta", array("noreg" => $ddata['noreg']))->result_array();
                                            }else{
                                                $clnik = "fw-bold";
                                                $clska = "";
                                                $ddor = $this->db->get_where("pekerjaan_ta", array("nik" => $ddata['nik']))->result_array();
                                            }
                                            echo"
                                                <tr>
                                                    <td class='text-center'>".$nodata.".</td>
                                                    <td>".$ddor[0]['nm_ta']."</td>
                                                    <td><a href='".base_url("personel/detail/".enkrip("nik***".$ddor[0]['nik']))."' target='_blank' class='".$clnik."' data-bs-popup='popover' data-bs-trigger='hover' data-bs-content='Klik untuk melihat detail personel berdasarkan Nomor Induk Kependudukan.' data-bs-original-title='Tampilkan Detail'>".$ddor[0]['nik']."</a></td>
                                                    <td><a href='".base_url("personel/detail/".enkrip("ska***".$ddor[0]['noreg']))."' target='_blank' class='".$clska."' data-bs-popup='popover' data-bs-trigger='hover' data-bs-content='Klik untuk melihat detail personel berdasarkan Nomor Registrasi SKA/SKT.' data-bs-original-title='Tampilkan Detail'>".$ddor[0]['noreg']."</a></td>
                                                    <td>".$ddor[0]['jns_keterampilan']."</td>
                                                    <td>".$ddata['jumkerjo']." pekerjaan</td>
                                                </tr>
                                            ";
                                            $nodata++;
                                        }
                                    ?>
								</tbody>
							</table>
						</div>
					</div>
					<!-- /basic table -->

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
		<div class="modal-dialog modal-lg">
			<form method="post" class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Formulir Tambah</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
				</div>

				<div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <?php
                            if(sesuser("id_group") == 1 || sesuser("id_group") == 2){
                                echo"
                                    <div class='mb-2'>
                                        <label class='form-label'>Pilih OPD:</label>
                                        <select class='form-control' name='id_opd' required>
                                            <option value=''>[ Pilih OPD ]</option>";
                                            $sop = $this->db->get("opd");
                                            foreach($sop->result_array() as $dop){
                                                echo"<option value='".$dop['id_opd']."'>".$dop['nm_opd']."</option>";
                                            }
                                            echo"
                                        </select>
                                    </div>
                                ";
                            }else{
                                echo"<input type='hidden' name='id_opd' value='".sesuser("id_opd")."'>";
                            }
                            ?>
                            <div class="mb-2">
                                <label class="form-label">Nama Pekerjaan :</label>
                                <input type="text" name="nm_pekerjaan" class="form-control" placeholder="Nama Pekerjaan" required>
                                <!-- <span class="form-text">+{3}0 000 000 000</span> -->
                            </div>
                            <div class="mb-2">
                                <label class="form-label">Tahun Anggaran :</label>
                                <input type="number" name="tahun" class="form-control" max="<?= date("Y") + 1 ?>" placeholder="Tahun Anggaran" required>
                                <!-- <span class="form-text">+{3}0 000 000 000</span> -->
                            </div>
                            <div class="mb-2">
                                <label class="form-label">Jenis Pekerjaan :</label>
                                <select name="id_pekerjaanjns" class="form-control" required>
                                    <option value="">[ Pilih Jenis Pekerjaan ]</option>
                                    <?php
                                        $sdor = $this->db->get("pekerjaanjns");
                                        foreach($sdor->result_array() as $ddor){
                                            echo"<option value='".$ddor['id_pekerjaanjns']."'>".$ddor['nm_pekerjaanjns']."</option>";
                                        }
                                    ?>
                                </select>
                            </div>
                            <div class="mb-2">
                                <label class="form-label">Metode Pemilihan :</label>
                                <select name="id_modpilih" class="form-control" required>
                                    <option value="">[ Pilih Metode Pemilihan ]</option>
                                    <?php
                                        $sdor = $this->db->get("modpilih");
                                        foreach($sdor->result_array() as $ddor){
                                            echo"<option value='".$ddor['id_modpilih']."'>".$ddor['nm_modpilih']."</option>";
                                        }
                                    ?>
                                </select>
                            </div>
                            <div class="mb-2">
                                <label class="form-label">No. Kontrak :</label>
                                <input type="text" placeholder="Nomor Kontrak" name="no_kontrak" class="form-control" required>
                                <!-- <span class="form-text">+{3}0 000 000 000</span> -->
                            </div>
                            <div class="mb-2">
                                <label class="form-label">Nilai Kontrak (Rp) :</label>
                                <input type="text" placeholder="Ketik angka" name="nilai_kontrak" class="form-control uang" required>
                                <!-- <span class="form-text">+{3}0 000 000 000</span> -->
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-2">
                                <label class="form-label">Tanggal Penandatanganan Kontrak :</label>
                                <!-- <input type="date" name="tgl_kontrak" id="tgl_kontrak_tambah" onchange="hitungTanggalBerakhir()" class="form-control" required> -->
                                <div class="input-group">
									<span class="input-group-text">
										<i class="ph-calendar"></i>
									</span>
                                    <input type="text" name="tgl_kontrak" id="tgl_kontrak_tambah" onchange="hitungTanggalBerakhir()" class="form-control tgl_firex" placeholder="Pilih tanggal" required>
                                </div>
                                <!-- <span class="form-text">+{3}0 000 000 000</span> -->
                            </div>
                            <div class="mb-2">
                                <label class="form-label">Waktu Pelaksanaan Pekerjaan (Jumlah Hari) :</label>
                                <input type="number" name="waktu_pekerjaan" id="waktu_pekerjaan_tambah" onkeyup="hitungTanggalBerakhir()" class="form-control" placeholder="Berapa Hari Kalender" required>
                                <!-- <span class="form-text">+{3}0 000 000 000</span> -->
                            </div>
                            <div class="mb-2">
                                <label class="form-label">Tanggal Berkahir Kontrak :</label>
                                <div class="input-group">
									<span class="input-group-text">
										<i class="ph-calendar"></i>
									</span>
                                    <input type="text" id="tgl_kontrak_berakhir_tambah" class="form-control" placeholder="Otomatis" readonly>
                                </div>
                                <!-- <span class="form-text">+{3}0 000 000 000</span> -->
                            </div>
                            <div class="mb-2">
                                <label class="form-label">Nama Penyedia :</label>
                                <input type="text" name="nm_penyedia" class="form-control" placeholder="Nama Penyedia" required>
                                <!-- <span class="form-text">+{3}0 000 000 000</span> -->
                            </div>
                            <div class="mb-2">
                                <label class="form-label">NPWP Penyedia :</label>
                                <input type="text" name="npwp_penyedia" class="form-control npwp" placeholder="NPwP Penyedia" required>
                                <!-- <span class="form-text">+{3}0 000 000 000</span> -->
                            </div>
                            <div class="mb-2">
                                <label class="form-label">No. HP Penyedia :</label>
                                <input type="text" name="hp_penyedia" class="form-control hpne" placeholder="No. HP Penyedia" required>
                                <!-- <span class="form-text">+{3}0 000 000 000</span> -->
                            </div>
                            <div class="mb-2">
                                <label class="form-label">Zona Pekerjaan :</label>
                                <select name="id_kecamatan" class="form-control" required>
                                    <option value="">[ Pilih Zona Pekerjaan ]</option>
                                    <?php
                                        $skec = $this->db->get_where("kecamatan", array("id_kabupaten" => identitas("kabupaten")));
                                        foreach($skec->result_array() as $dkec){
                                            echo"<option value='".$dkec['id_kecamatan']."'>".$dkec['nm_kecamatan']."</option>";
                                        }
                                    ?>
                                </select>
                                <!-- <span class="form-text">+{3}0 000 000 000</span> -->
                            </div>
                        </div>
                    </div>
				</div>

				<div class="modal-footer">
					<button type="reset" class="btn btn-link" data-bs-dismiss="modal">Batal</button>
					<button type="submit" name="tambahin" class="btn btn-primary">Simpan</button>
				</div>
			</form>
		</div>
	</div>

    <div id="modalEdit" class="modal fade" tabindex="-1">
		<div class="modal-dialog modal-lg">
			<form method="post" class="modal-content">
                <input type="hidden" name="no_pekerjaan" id="no_pekerjaan_edit">
				<div class="modal-header">
					<h5 class="modal-title">Formulir Edit</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
				</div>

				<div class="modal-body">
					<div class="row">
                        <div class="col-md-6">
                            <?php
                            if(sesuser("id_group") == 1 || sesuser("id_group") == 2){
                                echo"
                                    <div class='mb-2'>
                                        <label class='form-label'>Pilih OPD:</label>
                                        <select class='form-control' name='id_opd' id='id_opd_edit' required>
                                            <option value=''>[ Pilih OPD ]</option>";
                                            $sop = $this->db->get("opd");
                                            foreach($sop->result_array() as $dop){
                                                echo"<option value='".$dop['id_opd']."'>".$dop['nm_opd']."</option>";
                                            }
                                            echo"
                                        </select>
                                    </div>
                                ";
                            }else{
                                echo"<input type='hidden' name='id_opd' id='id_opd_edit' value='".sesuser("id_opd")."'>";
                            }
                            ?>
                            <div class="mb-2">
                                <label class="form-label">Nama Pekerjaan :</label>
                                <input type="text" name="nm_pekerjaan" id="nm_pekerjaan_edit" class="form-control" placeholder="Nama Pekerjaan" required>
                                <!-- <span class="form-text">+{3}0 000 000 000</span> -->
                            </div>
                            <div class="mb-2">
                                <label class="form-label">Tahun Anggaran :</label>
                                <input type="number" name="tahun" id="tahun_edit" class="form-control" max="<?= date("Y") + 1 ?>" placeholder="Tahun Anggaran" required>
                                <!-- <span class="form-text">+{3}0 000 000 000</span> -->
                            </div>
                            <div class="mb-2">
                                <label class="form-label">Jenis Pekerjaan :</label>
                                <select name="id_pekerjaanjns" id="id_pekerjaanjns_edit" class="form-control" required>
                                    <option value="">[ Pilih Jenis Pekerjaan ]</option>
                                    <?php
                                        $sdor = $this->db->get("pekerjaanjns");
                                        foreach($sdor->result_array() as $ddor){
                                            echo"<option value='".$ddor['id_pekerjaanjns']."'>".$ddor['nm_pekerjaanjns']."</option>";
                                        }
                                    ?>
                                </select>
                            </div>
                            <div class="mb-2">
                                <label class="form-label">Metode Pemilihan :</label>
                                <select name="id_modpilih" id="id_modpilih_edit" class="form-control" required>
                                    <option value="">[ Pilih Metode Pemilihan ]</option>
                                    <?php
                                        $sdor = $this->db->get("modpilih");
                                        foreach($sdor->result_array() as $ddor){
                                            echo"<option value='".$ddor['id_modpilih']."'>".$ddor['nm_modpilih']."</option>";
                                        }
                                    ?>
                                </select>
                            </div>
                            <div class="mb-2">
                                <label class="form-label">No. Kontrak :</label>
                                <input type="text" placeholder="Nomor Kontrak" name="no_kontrak" id="no_kontrak_edit" class="form-control" required>
                                <!-- <span class="form-text">+{3}0 000 000 000</span> -->
                            </div>
                            <div class="mb-2">
                                <label class="form-label">Nilai Kontrak (Rp) :</label>
                                <input type="text" placeholder="Ketik angka" name="nilai_kontrak" id="nilai_kontrak_edit" class="form-control uang" required>
                                <!-- <span class="form-text">+{3}0 000 000 000</span> -->
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-2">
                                <label class="form-label">Tanggal Penandatanganan Kontrak :</label>
                                <!-- <input type="date" name="tgl_kontrak" id="tgl_kontrak_tambah" onchange="hitungTanggalBerakhir()" class="form-control" required> -->
                                <div class="input-group">
									<span class="input-group-text">
										<i class="ph-calendar"></i>
									</span>
                                    <input type="text" name="tgl_kontrak" id="tgl_kontrak_edit" onchange="hitungTanggalBerakhirEdit()" class="form-control tgl_firex" placeholder="Pilih tanggal" required>
                                </div>
                                <!-- <span class="form-text">+{3}0 000 000 000</span> -->
                            </div>
                            <div class="mb-2">
                                <label class="form-label">Waktu Pelaksanaan Pekerjaan (Jumlah Hari) :</label>
                                <input type="number" name="waktu_pekerjaan"  id="waktu_pekerjaan_edit" onkeyup="hitungTanggalBerakhirEdit()" class="form-control" placeholder="Berapa Hari Kalender" required>
                                <!-- <span class="form-text">+{3}0 000 000 000</span> -->
                            </div>
                            <div class="mb-2">
                                <label class="form-label">Tanggal Berkahir Kontrak :</label>
                                <div class="input-group">
									<span class="input-group-text">
										<i class="ph-calendar"></i>
									</span>
                                    <input type="text" id="tgl_kontrak_berakhir_edit" class="form-control" placeholder="Otomatis" readonly>
                                </div>
                                <!-- <span class="form-text">+{3}0 000 000 000</span> -->
                            </div>
                            <div class="mb-2">
                                <label class="form-label">Nama Penyedia :</label>
                                <input type="text" name="nm_penyedia" id="nm_penyedia_edit" class="form-control" placeholder="Nama Penyedia" required>
                                <!-- <span class="form-text">+{3}0 000 000 000</span> -->
                            </div>
                            <div class="mb-2">
                                <label class="form-label">NPWP Penyedia :</label>
                                <input type="text" name="npwp_penyedia" id="npwp_penyedia_edit" class="form-control npwp" placeholder="NPwP Penyedia" required>
                                <!-- <span class="form-text">+{3}0 000 000 000</span> -->
                            </div>
                            <div class="mb-2">
                                <label class="form-label">No. HP Penyedia :</label>
                                <input type="text" name="hp_penyedia" id="hp_penyedia_edit" class="form-control hpne" placeholder="No. HP Penyedia" required>
                                <!-- <span class="form-text">+{3}0 000 000 000</span> -->
                            </div>
                            <div class="mb-2">
                                <label class="form-label">Zona Pekerjaan :</label>
                                <select name="id_kecamatan" id="id_kecamatan_edit" class="form-control" required>
                                    <option value="">[ Pilih Zona Pekerjaan ]</option>
                                    <?php
                                        $skec = $this->db->get_where("kecamatan", array("id_kabupaten" => identitas("kabupaten")));
                                        foreach($skec->result_array() as $dkec){
                                            echo"<option value='".$dkec['id_kecamatan']."'>".$dkec['nm_kecamatan']."</option>";
                                        }
                                    ?>
                                </select>
                                <!-- <span class="form-text">+{3}0 000 000 000</span> -->
                            </div>
                        </div>
                    </div>
				</div>

				<div class="modal-footer">
					<button type="reset" class="btn btn-link" data-bs-dismiss="modal">Batal</button>
					<button type="submit" name="editin" class="btn btn-primary">Simpan</button>
				</div>
			</form>
		</div>
	</div>

    <div id="modalHapus" class="modal fade" tabindex="-1">
		<div class="modal-dialog modal-sm">
			<form method="post" class="modal-content">
                <input type="hidden" name="no_pekerjaan" id="no_pekerjaan_hapus">
				<div class="modal-header">
					<h5 class="modal-title">Konfirmasi Hapus</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
				</div>

				<div class="modal-body">
					<div class="alert alert-danger">Anda yakin akan menghapus data <b id="nama_hapus"></b>? Data yang sudah dihapus tidak bisa dikembalikan lagi.</div>
				</div>

				<div class="modal-footer">
					<button type="reset" class="btn btn-link" data-bs-dismiss="modal">Batal</button>
					<button type="submit" name="hapusin" class="btn btn-danger">Hapus permanen data</button>
				</div>
			</form>
		</div>
	</div>

    <script>
        function hitungTanggalBerakhir(){
            // console.log($("#tgl_kontrak_tambah").val());
            if($("#tgl_kontrak_tambah").val().length != 0 && $("#waktu_pekerjaan_tambah").val().length != 0){
                $.ajax({
                    type: "POST",
                    url: "<?= base_url("pekerjaan/cektglberakhir") ?>",
                    data: {
                        tgl_kontrak: $("#tgl_kontrak_tambah").val(),
                        waktu_pekerjaan: $("#waktu_pekerjaan_tambah").val(),
                    },
                    success: function(respon){
                        console.log(respon);
                        $("#tgl_kontrak_berakhir_tambah").val(respon);
                    }
                });
            }
        }

        function hitungTanggalBerakhirEdit(){
            // console.log($("#tgl_kontrak_tambah").val());
            if($("#tgl_kontrak_edit").val().length != 0 && $("#waktu_pekerjaan_edit").val().length != 0){
                $.ajax({
                    type: "POST",
                    url: "<?= base_url("pekerjaan/cektglberakhir") ?>",
                    data: {
                        tgl_kontrak: $("#tgl_kontrak_edit").val(),
                        waktu_pekerjaan: $("#waktu_pekerjaan_edit").val(),
                    },
                    success: function(respon){
                        console.log(respon);
                        $("#tgl_kontrak_berakhir_edit").val(respon);
                    }
                });
            }
        }

		$(document).ready(function() {
			function selectElement(id, valueToSelect) {    
				let element = document.getElementById(id);
				element.value = valueToSelect;
			}
				
			$(document).on('click', '.bthapus', function() {
				const id 	= $(this).data('id');
				const nama 	= $(this).data('nama');
				$('#no_pekerjaan_hapus').val(id);
				document.getElementById("nama_hapus").innerHTML = nama;
				//console.log("data : " + nama);
			});
			
			$(document).on('click', '.btedit', function() {
				const id 	= $(this).data('id');
				$.ajax({
					type: "POST",
					url: "<?= base_url("pekerjaan/getpekerjaanbyid") ?>",
					data: {no_pekerjaan: id},
					success: function(respon){
						$("#no_pekerjaan_edit").val(id);
						$("#id_opd_edit").val(respon[0].id_opd);
						$("#nm_pekerjaan_edit").val(respon[0].nm_pekerjaan);
						$("#tahun_edit").val(respon[0].tahun);
						$("#id_pekerjaanjns_edit").val(respon[0].id_pekerjaanjns);
						$("#id_modpilih_edit").val(respon[0].id_modpilih);
						$("#waktu_pekerjaan_edit").val(respon[0].waktu_pekerjaan);
						$("#tgl_kontrak_edit").val(respon[0].tgl_kontrak);
						$("#nm_penyedia_edit").val(respon[0].nm_penyedia);
						$("#npwp_penyedia_edit").val(respon[0].npwp_penyedia);
						$("#hp_penyedia_edit").val(respon[0].hp_penyedia);
						$("#no_kontrak_edit").val(respon[0].no_kontrak);
						$("#nilai_kontrak_edit").val(respon[0].nilai_kontrak);
						$("#tgl_kontrak_berakhir_edit").val(respon[0].tgl_kontrak_berakhir);
						$("#id_kecamatan_edit").val(respon[0].id_kecamatan);
					}
				});
			});
		});
	</script>
</body>
</html>