<?php
	defined('BASEPATH') or exit('No direct script access allowed');
    if(empty(sesuser('id_user'))){
        redirect("/auth/login", refresh);
    }

    $no_pekerjaan = antixss(dekrip($this->uri->segment(3)));
    $skerja = $this->db->query("SELECT a.*, b.`nm_opd`, c.`nm_modpilih`, d.`nm_pekerjaanjns` FROM pekerjaan a LEFT JOIN opd b ON a.`id_opd` = b.`id_opd` LEFT JOIN modpilih c ON a.`id_modpilih` = c.`id_modpilih` LEFT JOIN pekerjaanjns d ON a.`id_pekerjaanjns` = d.`id_pekerjaanjns` WHERE a.no_pekerjaan = '".$no_pekerjaan."'");
    $hkerja = $skerja->num_rows();
    if($hkerja == 0){
        $this->load->view('errors/404');
    }else{
        $dkerja = $skerja->result_array();

        $post = $this->input->post();
        if(isset($post['tambahin'])){
            $post_data	= array(
                "no_pekerjaan" => $no_pekerjaan,
                "nik"	=> antixss($post['nik']),
                "nm_ta"	=> antixss($post['nm_ta']),
                "jns_keterampilan"	=> antixss($post['jns_keterampilan']),
                "noreg"	=> antixss($post['noreg']),
                "deskripsi"	=> antixss($post['deskripsi']),
                "useradd" => sesuser("no_register"),
            );
            $hajar		= $this->db->insert("pekerjaan_ta", $post_data);
            if($hajar){
                $this->session->set_flashdata('pesen', '<script>sukses("tambah");</script>');
            }else{
                $this->session->set_flashdata('pesen', '<script>gagal("tambah");</script>');
            }
            redirect(base_url("pekerjaanppk/ta/".enkrip($no_pekerjaan)));
        }else if(isset($post['editin'])){
            // echo antixss($post['nik']);
            // echo dekrip($post['id_ta']);
            $post_data	= array(
                "nik"	=> antixss($post['nik']),
                "nm_ta"	=> antixss($post['nm_ta']),
                "jns_keterampilan"	=> antixss($post['jns_keterampilan']),
                "noreg"	=> antixss($post['noreg']),
                "deskripsi"	=> antixss($post['deskripsi']),
            );
            $hajar			= $this->db->update("pekerjaan_ta", $post_data, array("id_ta" => dekrip($post['id_ta'])));
            if($hajar){
                $this->session->set_flashdata('pesen', '<script>sukses("edit");</script>');
            }else{
                $this->session->set_flashdata('pesen', '<script>gagal("edit");</script>');
            }
            redirect(base_url("pekerjaanppk/ta/".enkrip($no_pekerjaan)));
        }else if(isset($post['hapusin'])){
            $hajar			= $this->db->delete("pekerjaan_ta", array("id_ta" => dekrip($post['id_ta'])));
            if($hajar){
                $this->db->delete("pekerjaan_ta", array("no_pekerjaan" => dekrip($post['no_pekerjaan'])));
                $this->session->set_flashdata('pesen', '<script>sukses("hapus");</script>');
            }else{
                $this->session->set_flashdata('pesen', '<script>gagal("hapus");</script>');
            }
            redirect(base_url("pekerjaanppk/ta/".enkrip($no_pekerjaan)));
        }else if(isset($post['finalken'])){
            $post_data	= array(
                "status"	=> "final"
            );
            $hajar			= $this->db->update("pekerjaan", $post_data, array("no_pekerjaan" => $no_pekerjaan));
            if($hajar){
                $this->session->set_flashdata('pesen', '<script>sukses("proses");</script>');
            }else{
                $this->session->set_flashdata('pesen', '<script>gagal("proses");</script>');
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
                                <button type="button" class="btn btn-outline-warning btn-icon rounded-pill" data-bs-toggle="modal" data-bs-target="#modalDetail">
                                    <i class="ph-eye"></i>
                                </button>
                                <button type="button" class="btn btn-outline-primary btn-labeled btn-labeled-start rounded-pill" data-bs-toggle="modal" data-bs-target="#modalTambah">
                                    <span class="btn-labeled-icon bg-primary text-white rounded-pill">
                                        <i class="ph-plus"></i>
                                    </span>
                                    Tambah
                                </button>
							</div>
						</div>
					</div>

					<div class="page-header-content d-lg-flex border-top">
						<div class="d-flex">
							<div class="breadcrumb py-2">
								<a href="<?= base_url("dash") ?>" class="breadcrumb-item"><i class="ph-house"></i></a>
								<a href="<?= base_url("pekerjaanppk") ?>" class="breadcrumb-item">Data Pekerjaan</a>
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
										<th>Jenis Keterampilan SKA/SKT</th>
										<th>Nomor Registrasi SKA/SKT</th>
										<th>Deskripsi</th>
										<th class="text-center">Act</th>
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
                                                    <td class='text-center'>
                                                        <div class='d-inline-flex'>
                                                            <div class='dropdown'>
                                                                <a href='#' class='btn btn-outline-warning btn-sm btn-icon dropdown-toggle' data-bs-toggle='dropdown'>
                                                                    <i class='ph-list'></i>
                                                                </a>
                
                                                                <div class='dropdown-menu dropdown-menu-end'>
                                                                    <!--<a href='#' class='dropdown-item btedit' data-bs-toggle='modal' data-bs-target='#modalEdit' data-id='".enkrip($ddata['id_ta'])."' data-nama='".$ddata['nm_ta']."' data-nik='".$ddata['nik']."' data-jenis='".$ddata['jns_keterampilan']."' data-noreg='".$ddata['noreg']."'>
                                                                        <i class='ph-pencil me-2'></i>
                                                                        Edit Data
                                                                    </a>-->
                                                                    <a href='#' class='dropdown-item bthapus' data-bs-toggle='modal' data-bs-target='#modalHapus' data-id='".enkrip($ddata['id_ta'])."' data-nama='".$ddata['nm_ta']."'>
                                                                        <i class='ph-trash me-2'></i>
                                                                        Hapus Data
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        </div>
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
                    <div class="alert alert-warning alert-dismissible fade show">
						<i class="ph-warning-circle me-2"></i>
						<span class="fw-semibold">Mohon diperhatikan!</span> Data tidak akan terkirim selama belum difinalisasi. Silahkan lengkapi seluruh data dan lakukan <span class="alert-link">Finalisasi Data</sp>.
						<button type="button" class="btn-close" data-bs-dismiss="alert"></button>
					</div>
                    <a href="#" class="btn btn-lg btn-danger" data-bs-toggle="modal" data-bs-target="#modalFinalken">Finalisasi Data</a>
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
                    <div class="row">
                        <div class="col-md-12">
                            <div class="mb-2">
                                <label class="form-label">Nama Personel :</label>
                                <input type="text" name="nm_ta" class="form-control" placeholder="Nama Personel" required>
                                <!-- <span class="form-text">+{3}0 000 000 000</span> -->
                            </div>
                            <div class="mb-2">
                                <label class="form-label">NIK :</label>
                                <input type="text" name="nik" id="nik" class="form-control nikne" placeholder="Nomor Induk Kependudukan" onkeyup="ceknikta()" required>
                                <span class="form-text" id="pesan_nik_tambah"></span>
                            </div>
                            <div id="form_sertifikat_tambah">
                            <div class="mb-2">
                                <label class="form-label">Jenis Keterampilan SKA/SKT :</label>
                                <input type="text" name="jns_keterampilan" class="form-control" placeholder="Jenis Keterampilan SKA/SKT" required>
                                <!-- <span class="form-text">+{3}0 000 000 000</span> -->
                            </div>
                            <div class="mb-2">
                                <label class="form-label">Nomor Registrasi SKA/SKT :</label>
                                <input type="text" name="noreg" id="noreg" class="form-control" onkeyup="ceknoregta()" placeholder="Nomor Registrasi SKA/SKT" required>
                                <span class="form-text" id="pesan_noreg_tambah"></span>
                            </div>
                            </div>
                            <div class="mb-2">
                                <label class="form-label">Deskripsi :</label>
                                <textarea name="deskripsi" class="form-control" placeholder="Deskripsi" style="min-height:100px;"></textarea>
                                <!-- <span class="form-text">+{3}0 000 000 000</span> -->
                            </div>
                        </div>
                    </div>
				</div>

				<div class="modal-footer" id="tomsub_tambah">
					<button type="reset" class="btn btn-link" data-bs-dismiss="modal">Batal</button>
					<button type="submit" name="tambahin" class="btn btn-primary">Simpan</button>
				</div>
			</form>
		</div>
	</div>

    <div id="modalEdit" class="modal fade" tabindex="-1">
		<div class="modal-dialog modal-sm">
			<form method="post" class="modal-content">
                <input type="hidden" name="id_ta" id="id_ta_edit">
				<div class="modal-header">
					<h5 class="modal-title">Formulir Edit</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
				</div>

				<div class="modal-body">
					<div class="row">
                        <div class="col-md-12">
                            <div class="mb-2">
                                <label class="form-label">Nama Personel :</label>
                                <input type="text" name="nm_ta" id="nm_ta_edit" class="form-control" placeholder="Nama Personel" required>
                                <!-- <span class="form-text">+{3}0 000 000 000</span> -->
                            </div>
                            <div class="mb-2">
                                <label class="form-label">NIK :</label>
                                <input type="text" name="nik" id="nik_edit" class="form-control nikne" placeholder="Nomor Induk Kependudukan" required>
                                <span class="form-text" id="pesan_nik_edit"></span>
                            </div>
                            <div class="mb-2">
                                <label class="form-label">Jenis Keterampilan SKA/SKT :</label>
                                <input type="text" name="jns_keterampilan" id="jns_keterampilan_edit" class="form-control" placeholder="Jenis Keterampilan SKA/SKT" required>
                                <!-- <span class="form-text">+{3}0 000 000 000</span> -->
                            </div>
                            <div class="mb-2">
                                <label class="form-label">Nomor Registrasi SKA/SKT :</label>
                                <input type="text" name="noreg" id="noreg_edit" class="form-control" placeholder="Nomor Registrasi SKA/SKT" required>
                                <!-- <span class="form-text">+{3}0 000 000 000</span> -->
                            </div>
                            <div class="mb-2">
                                <label class="form-label">Deskripsi :</label>
                                <textarea name="deskripsi" id="deskripsi_edit" class="form-control" placeholder="Deskripsi" style="min-height:100px;"></textarea>
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
                <input type="hidden" name="id_ta" id="id_ta_hapus">
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


    <div id="modalFinalken" class="modal fade" tabindex="-1">
		<div class="modal-dialog modal-sm">
			<form method="post" class="modal-content">
                <input type="hidden" name="id_ta" id="id_ta_hapus">
				<div class="modal-header">
					<h5 class="modal-title">Konfirmasi Finalisasi</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
				</div>

				<div class="modal-body">
                    <div class="alert alert-warning alert-icon-start alert-dismissible fade show mb-0">
						<span class="alert-icon bg-danger text-white">
							<i class="ph-warning-circle"></i>
						</span>
						<span class="fw-semibold">Anda yakin akan melakukan Finalisasi Data ini?!</span> Pastikan Anda sudah mengecek seluruh kelengkapan data pekerjaan ini. Data yang sudah difinalisasi tidak bisa dihapus dan diedit kembali.
					</div>
				</div>

				<div class="modal-footer">
					<button type="reset" class="btn btn-link" data-bs-dismiss="modal">Batal</button>
					<button type="submit" name="finalken" class="btn btn-danger btn-lg">Ya! Finalisasi data</button>
				</div>
			</form>
		</div>
	</div>


    <div id="modalDetail" class="modal fade" tabindex="-1">
		<div class="modal-dialog">
			<form method="post" class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Detail Pekerjaan</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
				</div>
                <table class="table table-hover">
                    <tbody>
                        <tr>
                            <td>Nomor</td>
                            <td style="width:20px;">:</td>
                            <th class="text-danger"><?= $no_pekerjaan ?></th>
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
                            <td>Metode Pemilihan</td>
                            <td>:</td>
                            <th><?= $dkerja[0]['nm_modpilih'] ?></th>
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
                            <td>Tgl. Kontrak</td>
                            <td>:</td>
                            <th><?= tgl_indo($dkerja[0]['tgl_kontrak']) ?></th>
                        </tr>
                        <tr>
                            <td>Waktu Pelaksaan</td>
                            <td>:</td>
                            <th><?= $dkerja[0]['waktu_pekerjaan'] ?> Hari Kalender</th>
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
			</form>
		</div>
	</div>



    <script>
        $("#tomsub_tambah").show();
        $("#form_sertifikat_tambah").show();
        function ceknikta(){
            let nik = $("#nik").val();
            $.ajax({
                type: "POST",
                url: "<?= base_url("pekerjaan/ceknik") ?>",
                data: {nik: nik, tgl_kontrak: "<?= enkrip($dkerja[0]['tgl_kontrak']) ?>", tgl_kontrak_berakhir: "<?= enkrip($dkerja[0]['tgl_kontrak_berakhir']) ?>", kecamatan: "<?= enkrip($dkerja[0]['id_kecamatan']) ?>"},
                success: function(respon){
                    // console.log(respon[0].pesan);
                    if(respon[0].status == "yes"){
                        // $("#pesan_nik_tambah").html(respon[0].pesan);
                        $("#pesan_nik_tambah").html("");
                        $("#form_sertifikat_tambah").show();
                        $("#tomsub_tambah").show();
                        $("#noreg").val("");
                    }else{
                        $("#pesan_nik_tambah").html(respon[0].pesan);
                        $("#form_sertifikat_tambah").show();
                        $("#tomsub_tambah").show();
                    }
                }
            });
        }

        function ceknoregta(){
            let noreg = $("#noreg").val();
            $.ajax({
                type: "POST",
                url: "<?= base_url("pekerjaan/ceknoreg") ?>",
                data: {noreg: noreg, tgl_kontrak: "<?= enkrip($dkerja[0]['tgl_kontrak']) ?>", tgl_kontrak_berakhir: "<?= enkrip($dkerja[0]['tgl_kontrak_berakhir']) ?>", kecamatan: "<?= enkrip($dkerja[0]['id_kecamatan']) ?>"},
                success: function(respon){
                    // console.log(respon[0].pesan);
                    if(respon[0].status == "yes"){
                        // $("#pesan_noreg_tambah").html(respon[0].pesan);
                        $("#pesan_noreg_tambah").html("");
                        $("#tomsub_tambah").show();
                    }else{
                        $("#pesan_noreg_tambah").html(respon[0].pesan);
                        $("#tomsub_tambah").show();
                    }
                }
            });
        }

		$(document).ready(function() {
			function selectElement(id, valueToSelect) {    
				let element = document.getElementById(id);
				element.value = valueToSelect;
			}
				
			$(document).on('click', '.bthapus', function() {
				const id 	= $(this).data('id');
				const nama 	= $(this).data('nama');
				$('#id_ta_hapus').val(id);
				document.getElementById("nama_hapus").innerHTML = nama;
				//console.log("data : " + nama);
			});
			
			$(document).on('click', '.btedit', function() {
				const id 	= $(this).data('id');
				const nama 	= $(this).data('nama');
				const nik 	= $(this).data('nik');
				const jenis 	= $(this).data('jenis');
				const noreg 	= $(this).data('noreg');

				$("#id_ta_edit").val(id);
				$("#nik_edit").val(nik);
				$("#nm_ta_edit").val(nama);
				$("#jns_keterampilan_edit").val(jenis);
				$("#noreg_edit").val(noreg);
			});
		});
	</script>
</body>
</html>
<?php } ?>