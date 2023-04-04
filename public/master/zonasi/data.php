<?php
	defined('BASEPATH') or exit('No direct script access allowed');
    if(empty(sesuser('id_user'))){
        redirect("/auth/login", refresh);
    }

    $post = $this->input->post();
	if(isset($post['hapusin'])){
		$hajar			= $this->db->delete("users", array("no_register" => dekrip($post['no_register'])));
		if($hajar){
			$this->session->set_flashdata('pesen', '<script>sukses("hapus");</script>');
		}else{
			$this->session->set_flashdata('pesen', '<script>gagal("hapus");</script>');
		}
		redirect(base_url("users/superadmin"));
	}else if(isset($post['editinpass'])){
		$hajar			= $this->db->update("users", array("password" => md5(antixss($post['password']))), array("no_register" => dekrip($post['no_register'])));
		if($hajar){
			$this->session->set_flashdata('pesen', '<script>sukses("editpass");</script>');
		}else{
			$this->session->set_flashdata('pesen', '<script>gagal("editpass");</script>');
		}
		redirect(base_url("users/superadmin"));
	}else if(isset($post['blokirin'])){
		$hajar			= $this->db->update("users", array("blocked" => "yes"), array("no_register" => dekrip($post['no_register'])));
		if($hajar){
			$this->session->set_flashdata('pesen', '<script>sukses("block");</script>');
		}else{
			$this->session->set_flashdata('pesen', '<script>gagal("block");</script>');
		}
		redirect(base_url("users/superadmin"));
	}else if(isset($post['unblokirin'])){
		$hajar			= $this->db->update("users", array("blocked" => "no"), array("no_register" => dekrip($post['no_register'])));
		if($hajar){
			$this->session->set_flashdata('pesen', '<script>sukses("unblock");</script>');
		}else{
			$this->session->set_flashdata('pesen', '<script>gagal("unblock");</script>');
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

	<script src="<?= base_url() ?>assets/js/app.js"></script>
    <script src="<?= base_url() ?>assets/demo/pages/animations_css3.js"></script>
    <script src="<?= base_url() ?>assets/demo/pages/datatables_advanced.js"></script>
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

							<a href="#page_header" class="btn btn-light align-self-center collapsed d-lg-none border-transparent rounded-pill p-0 ms-auto" data-bs-toggle="collapse">
								<i class="ph-caret-down collapsible-indicator ph-sm m-1"></i>
							</a>
						</div>

						<div class="collapse d-lg-block my-lg-auto ms-lg-auto" id="page_header">
							<div class="hstack gap-3 mb-3 mb-lg-0">
                                <a href="<?= base_url("master/zonasi/add") ?>" class="btn btn-outline-primary btn-labeled btn-labeled-start rounded-pill">
                                    <span class="btn-labeled-icon bg-primary text-white rounded-pill">
                                        <i class="ph-plus"></i>
                                    </span>
                                    Tambah
                                </a>
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
										<th>Nama Zonasi</th>
										<th>Kecamatan</th>
										<th class="text-center">Act</th>
									</tr>
								</thead>
								<tbody>
									<?php
                                        $nodata = 1;
                                        $sdata = $this->db->get("zonasi");
                                        foreach($sdata->result_array() as $ddata){

											$groupnya	= "";
											$group_ex	= explode(".",$ddata['kecamatan']);
											$sgropx		= $this->db->get_where("kecamatan", array("id_kabupaten" => identitas("kabupaten")));
											foreach($sgropx->result_array() as $dgropx){
												if(in_array($dgropx['id_kecamatan'], $group_ex)){
													$groupnya	.= "<div class='fw-bold text-uppercase'>".$dgropx['nm_kecamatan']."</div>";
												}
											}

                                            echo"
                                                <tr class=''>
                                                    <td class='text-center'>".$nodata.".</td>
                                                    <td>".$ddata['nm_zonasi']."</td>
                                                    <td>".$groupnya."</td>
                                                    <td class='text-center'>
                                                        <div class='d-inline-flex'>
                                                            <div class='dropdown'>
                                                                <a href='#' class='btn btn-outline-warning btn-sm btn-icon dropdown-toggle' data-bs-toggle='dropdown'>
                                                                    <i class='ph-list'></i>
                                                                </a>
                
                                                                <div class='dropdown-menu dropdown-menu-end'>
                                                                    <a href='".base_url("master/zonasi/edit/".enkrip($ddata['id_zonasi']))."' class='dropdown-item'>
                                                                        <i class='ph-pencil me-2'></i>
                                                                        Edit Data
                                                                    </a>
                                                                    <a href='#' class='dropdown-item bthapus' data-bs-toggle='modal' data-bs-target='#modalHapus' data-id='".enkrip($ddata['id_zonasi'])."' data-nama='".enkrip($ddata['nm_zonasi'])."'>
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



    <div id="modalHapus" class="modal fade" tabindex="-1">
		<div class="modal-dialog modal-sm">
			<form method="post" class="modal-content">
                <input type="hidden" name="id_zonasi" id="id_zonasi_hapus">
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
		$(document).ready(function() {
			function selectElement(id, valueToSelect) {    
				let element = document.getElementById(id);
				element.value = valueToSelect;
			}
				
			$(document).on('click', '.bthapus', function() {
				const id 	= $(this).data('id');
				const nama 	= $(this).data('nama');
				$('#id_zonasi_hapus').val(id);
				$('#nama_hapus').html(nama);
			});
		});
	</script>
</body>
</html>