<?php
	defined('BASEPATH') or exit('No direct script access allowed');
    if(empty(sesuser('id_user'))){
        redirect("/auth/login", refresh);
    }

    $post = $this->input->post();
	
    $hasil = antixss(trim(@$_GET['s']));
    $tab = antixss(dekrip(trim(@$_GET['tab'])));
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
    <script src="<?= base_url() ?>assets/js/mark.min.js"></script>
	<!-- /theme JS files -->
    <style>
        mark {
            background-color: yellow;
            font-weight:bold;
        }
    </style>
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


				<div class="content container">




                    <div class="card">
						<form  action="<?= base_url("cari") ?>" class="card-body d-sm-flex">
							<div class="form-control-feedback form-control-feedback-start flex-grow-1 mb-3 mb-sm-0">
								<input type="text" class="form-control" value="<?= $hasil ?>" id="datacari" placeholder="Cari di sini" name="s" required>
								<div class="form-control-feedback-icon">
									<i class="ph-magnifying-glass"></i>
								</div>
							</div>

							<div class="ms-sm-3">
								<button type="submit" class="btn btn-primary w-100 w-sm-auto">Search</button>
							</div>
						</form>
					</div>
					<!-- /search field -->

                    <?php
                    if(!empty($hasil)){
                        $jumta = $this->db->query("SELECT a.* FROM pekerjaan_ta a LEFT JOIN pekerjaan b ON a.no_pekerjaan = b.no_pekerjaan WHERE b.status = 'final' AND (a.nm_ta LIKE '%".$hasil."%' OR a.nik LIKE '%".$hasil."%' OR a.noreg LIKE '%".$hasil."%')")->num_rows();

                        $jumkerja = $this->db->query("SELECT a.*, b.`nm_opd`, c.`nm_modpilih`, d.`nm_pekerjaanjns` FROM pekerjaan a LEFT JOIN opd b ON a.`id_opd` = b.`id_opd` LEFT JOIN modpilih c ON a.`id_modpilih` = c.`id_modpilih` LEFT JOIN pekerjaanjns d ON a.`id_pekerjaanjns` = d.`id_pekerjaanjns` WHERE a.status = 'final' AND (a.nm_penyedia LIKE '%".$hasil."%' OR a.nm_pekerjaan LIKE '%".$hasil."%') ORDER BY a.no_pekerjaan DESC")->num_rows();

                        if($tab == "pekerjaan"){
                            $acpekerjaan = "active";
                            $acta = "";
                            $fileno = "pekerjaan.php";
                        }else if($tab == "ta"){
                            $acpekerjaan = "";
                            $acta = "active";
                            $fileno = "ta.php";
                        }else{
                            $acpekerjaan = "active";
                            $acta = "";
                            $fileno = "pekerjaan.php";
                        }
                    ?>
					<!-- Tabs -->
					<div class="nav-tabs-responsive mb-3">
						<ul class="nav nav-tabs nav-tabs-underline">
							<li class="nav-item">
								<a href="<?= base_url("cari?tab=".enkrip("pekerjaan")."&s=".$hasil) ?>" class="nav-link <?= $acpekerjaan ?>">
									<i class="ph-monitor me-2"></i>
									Pekerjaan
                                    <span class="badge bg-yellow text-black rounded-pill ms-2"><?= $jumkerja ?></span>
								</a>
							</li>
							<li class="nav-item">
								<a href="<?= base_url("cari?tab=".enkrip("ta")."&s=".$hasil) ?>" class="nav-link <?= $acta ?>">
									<i class="ph-users-three me-2"></i>
									Personil
                                    <span class="badge bg-yellow text-black rounded-pill ms-2"><?= $jumta ?></span>
								</a>
							</li>
						</ul>
					</div>
                        


                    <?php
                        echo $this->session->flashdata('pesen');
                        unset($_SESSION['pesen']);

                        include($fileno);
                    }
                    ?>
					

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
                                <label class="form-label">Waktu Pelaksanaan Pekerjaan (Jumlah Hari) :</label>
                                <input type="number" name="waktu_pekerjaan" class="form-control" placeholder="Berapa Hari Kalender" required>
                                <!-- <span class="form-text">+{3}0 000 000 000</span> -->
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-2">
                                <label class="form-label">Tanggal Penandatanganan Kontrak :</label>
                                <input type="date" name="tgl_kontrak" class="form-control" required>
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
                                <label class="form-label">Waktu Pelaksanaan Pekerjaan (Jumlah Hari) :</label>
                                <input type="number" name="waktu_pekerjaan" id="waktu_pekerjaan_edit" class="form-control" placeholder="Berapa Hari Kalender" required>
                                <!-- <span class="form-text">+{3}0 000 000 000</span> -->
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-2">
                                <label class="form-label">Tanggal Penandatanganan Kontrak :</label>
                                <input type="date" name="tgl_kontrak" id="tgl_kontrak_edit" class="form-control" required>
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


        var carian = new Mark(document.querySelector(".datapencarian"));
        carian.mark($("#datacari").val());

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
					}
				});
			});
		});
	</script>
</body>
</html>