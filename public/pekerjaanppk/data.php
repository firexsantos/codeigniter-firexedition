<?php
	defined('BASEPATH') or exit('No direct script access allowed');
    if(empty(sesuser('id_user'))){
        redirect("/auth/login", refresh);
    }

    $post = $this->input->post();
	if(isset($post['editin'])){
        $tgl_kontrak_berakhir = tambahhari(tgldb(antixss($post['tgl_kontrak'])), antixss($post['waktu_pekerjaan']));
		$post_data	= array(
			"no_rup"	=> antixss($post['no_rup']),
			"nm_pekerjaan"	=> antixss($post['nm_pekerjaan']),
            "tahun"	=> antixss($post['tahun']),
			"id_pekerjaanjns"	=> antixss($post['id_pekerjaanjns']),
			"id_modpilih"	=> antixss($post['id_modpilih']),
            "no_kontrak"	=> antixss($post['no_kontrak']),
            "nilai_pagu"	=> str_replace(".","",antixss($post['nilai_pagu'])),
			"nilai_kontrak"	=>str_replace(".","",antixss($post['nilai_kontrak'])),
			"waktu_pekerjaan"	=> antixss($post['waktu_pekerjaan']),
			"tgl_kontrak"	=> tgldb(antixss($post['tgl_kontrak'])),
            "tgl_kontrak_berakhir" => $tgl_kontrak_berakhir,
			"nm_penyedia"	=> antixss($post['nm_penyedia']),
			"npwp_penyedia"	=> antixss($post['npwp_penyedia']),
            "jangka_waktu"	=> antixss($post['jangka_waktu']),
			"hp_penyedia"	=> antixss($post['hp_penyedia']),
            "id_kecamatan"	=> antixss($post['id_kecamatan']),
		);
		$hajar			= $this->db->update("pekerjaan", $post_data, array("no_pekerjaan" => dekrip($post['no_pekerjaan'])));
		if($hajar){
			$this->session->set_flashdata('pesen', '<div class="alert alert-warning">Proses berhasil. Silahkan atur data personel.</div>');
			// $this->session->set_flashdata('pesen', '<script>sukses("edit");</script>');
		}else{
			$this->session->set_flashdata('pesen', '<script>gagal("edit");</script>');
		}
		redirect(base_url("pekerjaanppk/ta/".antixss($post['no_pekerjaan'])));
	}else if(isset($post['hapusin'])){
		$hajar			= $this->db->delete("pekerjaan", array("no_pekerjaan" => dekrip($post['no_pekerjaan'])));
		if($hajar){
            $this->db->delete("pekerjaan_ta", array("no_pekerjaan" => dekrip($post['no_pekerjaan'])));
			$this->session->set_flashdata('pesen', '<script>sukses("hapus");</script>');
		}else{
			$this->session->set_flashdata('pesen', '<script>gagal("hapus");</script>');
		}
		redirect(base_url("pekerjaanppk"));
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

							<!-- <a href="#page_header" class="btn btn-light align-self-center collapsed d-lg-none border-transparent rounded-pill p-0 ms-auto" data-bs-toggle="collapse">
								<i class="ph-caret-down collapsible-indicator ph-sm m-1"></i>
							</a> -->
						</div>

						<!-- <div class="collapse d-lg-block my-lg-auto ms-lg-auto" id="page_header">
							<div class="hstack gap-3 mb-3 mb-lg-0">
                                <button type="button" class="btn btn-outline-primary btn-labeled btn-labeled-start rounded-pill" data-bs-toggle="modal" data-bs-target="#modalTambah">
                                    <span class="btn-labeled-icon bg-primary text-white rounded-pill">
                                        <i class="ph-plus"></i>
                                    </span>
                                    Tambah
                                </button>
							</div>
						</div> -->
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
										<th>Kode RUP</th>
										<th>Nama Pekerjaan</th>
										<th>Tahun Anggaran</th>
										<th>Jenis Pekerjaan</th>
										<th>Metode Pemilihan</th>
										<!-- <th>Perangkat Daerah</th>
										<th>PPK</th> -->
										<th>Status</th>
										<th class="text-center">Act</th>
									</tr>
								</thead>
								<tbody>
									<?php
                                        $nodata = 1;

                                        $sdata = $this->db->query("SELECT a.*, b.`nm_opd`, c.`nm_modpilih`, d.`nm_pekerjaanjns`, e.nm_kecamatan, f.nama AS nm_ppk FROM pekerjaan a LEFT JOIN opd b ON a.`id_opd` = b.`id_opd` LEFT JOIN modpilih c ON a.`id_modpilih` = c.`id_modpilih` LEFT JOIN pekerjaanjns d ON a.`id_pekerjaanjns` = d.`id_pekerjaanjns` LEFT JOIN kecamatan e ON a.id_kecamatan = e.id_kecamatan LEFT JOIN users f ON a.ppk = f.no_register WHERE a.ppk = '".sesuser("no_register")."' ORDER BY a.no_pekerjaan DESC");
                                        
                                        foreach($sdata->result_array() as $ddata){
                                            if($ddata['status'] == "pending"){
                                                $statuse = "<span class='badge bg-danger'>Pending</span>";
                                            }else{
                                                $statuse = "<span class='badge bg-success'>Final</span>";
                                            }
                                            echo"
                                                <tr>
                                                    <td class='text-center'>".$nodata.".</td>
                                                    <td>".$ddata['no_rup']."</td>
                                                    <td>".$ddata['nm_pekerjaan']."</td>
                                                    <td>".$ddata['tahun']."</td>
                                                    <td>".$ddata['nm_pekerjaanjns']."</td>
                                                    <td>".$ddata['nm_modpilih']."</td>
                                                    <!--<td>".$ddata['nm_opd']."</td>
                                                    <td>".$ddata['nm_ppk']."</td>-->
                                                    <td>".$statuse."</td>
                                                    <td class='text-center'>";
                                                        if($ddata['status'] == "pending"){
                                                            echo"<a href='#' class='btn btn-danger btedit' data-bs-toggle='modal' data-bs-target='#modalSetKontrak' data-id='".enkrip($ddata['no_pekerjaan'])."'>Set Kontrak</a>";
                                                        }else{
                                                            echo"
                                                        <div class='d-inline-flex'>
                                                            <div class='dropdown'>
                                                                <a href='#' class='btn btn-outline-warning btn-sm btn-icon dropdown-toggle' data-bs-toggle='dropdown'>
                                                                    <i class='ph-list'></i>
                                                                </a>
                
                                                                <div class='dropdown-menu dropdown-menu-end'>";
                                                                if($ddata['status'] == "final"){
                                                                    echo"
                                                                    <a href='".base_url("cetak/pdf/pekerjaan/".enkrip($ddata['no_pekerjaan']))."' class='dropdown-item' target='_blank'>
                                                                        <i class='ph-printer me-2'></i>
                                                                        Cetak Pekerjaan
                                                                    </a>";
                                                                }
                                                                echo"
                                                                    <a href='".base_url("pekerjaan/detail/".enkrip($ddata['no_pekerjaan']))."' class='dropdown-item'>
                                                                        <i class='ph-eye me-2'></i>
                                                                        Detail Pekerjaan
                                                                    </a>";
                                                                    if($ddata['status'] == "pending"){
                                                                        echo"
                                                                    <div class='dropdown-divider'></div>
                                                                    <a href='#' class='dropdown-item btedit' data-bs-toggle='modal' data-bs-target='#modalEdit' data-id='".enkrip($ddata['no_pekerjaan'])."' data-nama='".$ddata['nm_pekerjaan']."'>
                                                                        <i class='ph-pencil me-2'></i>
                                                                        Edit Pekerjaan
                                                                    </a>
                                                                    <a href='".base_url("pekerjaan/ta/".enkrip($ddata['no_pekerjaan']))."' class='dropdown-item'>
                                                                        <i class='ph-pencil me-2'></i>
                                                                        Edit Personel
                                                                    </a>
                                                                    <div class='dropdown-divider'></div>
                                                                    <a href='#' class='dropdown-item bthapus' data-bs-toggle='modal' data-bs-target='#modalHapus' data-id='".enkrip($ddata['no_pekerjaan'])."' data-nama='".$ddata['nm_pekerjaan']."'>
                                                                        <i class='ph-trash me-2'></i>
                                                                        Hapus Data
                                                                    </a>";
                                                                    }
                                                                    echo"
                                                                </div>
                                                            </div>
                                                        </div>";
                                                                }
                                                        echo"
                                                    </td>
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

    <div id="modalSetKontrak" class="modal fade" tabindex="-1">
		<div class="modal-dialog modal-lg">
			<form method="post" class="modal-content">
                <input type="hidden" name="no_pekerjaan" id="no_pekerjaan_edit">
				<div class="modal-header">
					<h5 class="modal-title">Set Data Kontrak</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
				</div>

				<div class="modal-body">
					<div class="row">

                        <div class="col-md-12"><h6>DETAIL KONTRAK</h6></div>
                        <div class="col-md-6">
                            <div class="mb-2">
                                <label class="form-label">No. Kontrak :</label>
                                <input type="text" placeholder="Nomor Kontrak" name="no_kontrak" id="no_kontrak_edit" class="form-control" required>
                                <!-- <span class="form-text">+{3}0 000 000 000</span> -->
                            </div>
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
                        </div>
                        <div class="col-md-6">
                            <div class="mb-2">
                                <label class="form-label">Waktu Pelaksanaan Pekerjaan (Jumlah Hari) :</label>
                                <input type="number" name="waktu_pekerjaan"  id="waktu_pekerjaan_edit" onkeyup="hitungTanggalBerakhirEdit()" class="form-control" placeholder="Berapa Hari Kalender" required>
                                <!-- <span class="form-text">+{3}0 000 000 000</span> -->
                            </div>
                            <div class="mb-2">
                                <label class="form-label">Tanggal Berakhir Kontrak :</label>
                                <div class="input-group">
									<span class="input-group-text">
										<i class="ph-calendar"></i>
									</span>
                                    <input type="text" id="tgl_kontrak_berakhir_edit" class="form-control" placeholder="Otomatis" readonly>
                                </div>
                                <!-- <span class="form-text">+{3}0 000 000 000</span> -->
                            </div>
                        </div>
                        <div class="col-md-12 mt-3"><h6>DETAIL PEKERJAAN</h6></div>
                        <div class="col-md-6">
                            <div class="mb-2">
                                <label class="form-label">Kode RUP :</label>
                                <input type="text" name="no_rup" id="no_rup_edit" class="form-control" placeholder="Kode RUP" required>
                                <!-- <span class="form-text">+{3}0 000 000 000</span> -->
                            </div>
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
                                <label class="form-label">Nilai Pagu Anggaran (Rp) :</label>
                                <input type="text" placeholder="Ketik angka" name="nilai_pagu" id="nilai_pagu_edit" class="form-control uang" required>
                                <!-- <span class="form-text">+{3}0 000 000 000</span> -->
                            </div>
                            <div class="mb-2">
                                <label class="form-label">Nilai Pekerjaan (Rp) :</label>
                                <input type="text" placeholder="Ketik angka" name="nilai_kontrak" id="nilai_kontrak_edit" class="form-control uang" required>
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
                        </div>
                        <div class="col-md-6">
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
                                <label class="form-label">Jangka Waktu Pelaksanaan :</label>
                                <div class="input-group">
                                    <input type="number" name="jangka_waktu" id="jangka_waktu_edit" class="form-control" placeholder="0" required>
                                    <span class="input-group-text">hari</span>
                                </div>
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
                        $("#no_rup_edit").val(respon[0].no_rup);
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
                        $("#nilai_pagu_edit").val(respon[0].nilai_pagu);
                        $("#jangka_waktu_edit").val(respon[0].jangka_waktu);
						$("#id_kecamatan_edit").val(respon[0].id_kecamatan);
					}
				});
			});
		});
	</script>
</body>
</html>