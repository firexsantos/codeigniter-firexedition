<?php
	defined('BASEPATH') or exit('No direct script access allowed');
	if(empty(sesuser("id_user"))){
		redirect(base_url("auth"));
	}
?><!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title><?= $title ?> - <?= identitas("judul") ?></title>
    <meta name="description" content="<?= $title ?> - <?= identitas("judul") ?>">
    <meta name="author" content="Ridwan" />
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
								<?= $title ?>
							</h1>

							<a href="#page_header" class="btn btn-light align-self-center collapsed d-lg-none border-transparent rounded-pill p-0 ms-auto" data-bs-toggle="collapse">
								<i class="ph-caret-down collapsible-indicator ph-sm m-1"></i>
							</a>
						</div>

						<div class="collapse d-lg-block my-lg-auto ms-lg-auto" id="page_header">
							<div class="d-sm-flex align-items-center mb-3 mb-lg-0 ms-lg-3">
								

								

								<div class="d-inline-flex mt-3 mt-sm-0">
									<div class="d-block text-end">
									<div id="jam_analog" style="font-size:18px;" class="fw-bold"></div>
                    				<div class="fw-semibold text-muted" style="font-size:12px;margin-top:-5px;"><?= tgl_indo(tanggal("tgl")) ?></div>
									</div>
									
								</div>

								<div class="vr d-none d-sm-block flex-shrink-0 my-2 mx-3"></div>

								<div class="dropdown w-100 w-sm-auto">

									<a href="#" class="d-flex align-items-center text-body lh-1 dropdown-toggle py-sm-2" data-bs-toggle="dropdown" data-bs-display="static" aria-expanded="false">
										<div class="hstack gap-2 flex-grow-1 my-1">
											<i class="ph-user-circle-gear text-danger ph-2x w-30px h-30px"></i>
											<div class="me-auto">
												<div class="fs-sm text-muted opacity-75 mb-1">Group Level</div>
												<div class="fw-semibold"><?= cekuser(sesuser("no_user"), "nm_group") ?></div>
											</div>
										</div>
									</a>

									<div class="dropdown-menu dropdown-menu-lg-end w-100 w-lg-auto wmin-300 wmin-sm-350">
										<?php
											$slevol = $this->db->get("group");
											foreach($slevol->result_array() as $dlevol){
												if(in_array($dlevol['id_group'], cekgroupdef("all")) && sesuser("id_group") != $dlevol['id_group']){
													echo'
													<a href="#" class="dropdown-item hstack gap-2 py-2 bpindahlaman" data-group="'.enkrip($dlevol['id_group']).'">
														<i class="ph-user-circle text-danger ph-2x w-30px h-30px"></i>
														<div>
															<div class="fs-sm text-muted">Pindah ke laman</div>
															<div class="fw-semibold">'.$dlevol['nm_group'].'</div>
														</div>
													</a>
													';
												}
											}
										?>
									</div>
								</div>
								
							</div>
						</div>
					</div>
				</div>
				

				<div class="content container pt-0">

					<?php
                        echo $this->session->flashdata('pesen');
                        unset($_SESSION['pesen']);
                    ?>
					

					<div class="row">
					<div class="col-sm-6 col-xl-3">
							<div class="card card-body">
								<div class="d-flex align-items-center">
									<i class="ph-hand-pointing ph-2x text-success me-3"></i>

									<div class="flex-fill text-end">
										<h4 class="mb-0"><?= number_format($this->db->get("users")->num_rows()) ?></h4>
										<span class="text-muted">Total User</span>
									</div>
								</div>
							</div>
						</div>

						<div class="col-sm-6 col-xl-3">
							<div class="card card-body">
								<div class="d-flex align-items-center">
									<i class="ph-users-three ph-2x text-indigo me-3"></i>

									<div class="flex-fill text-end">
										<h4 class="mb-0"><?= number_format($this->db->get("users")->num_rows()) ?></h4>
										<span class="text-muted">Total Personil</span>
									</div>
								</div>
							</div>
						</div>

						<div class="col-sm-6 col-xl-3">
							<div class="card card-body">
								<div class="d-flex align-items-center">
									<div class="flex-fill">
										<h4 class="mb-0"><?= number_format($this->db->get("users")->num_rows()) ?></h4>
										<span class="text-muted">Total Super Admin</span>
									</div>

									<i class="ph-users ph-2x text-primary ms-3"></i>
								</div>
							</div>
						</div>

						<div class="col-sm-6 col-xl-3">
							<div class="card card-body">
								<div class="d-flex align-items-center">
									<div class="flex-fill">
										<h4 class="mb-0"><?= number_format($this->db->get("users")->num_rows()) ?></h4>
										<span class="text-muted">Total Admin</span>
									</div>

									<i class="ph-users ph-2x text-danger ms-3"></i>
								</div>
							</div>
						</div>
					</div>

					<div class="card">
						<div class="card-header">
							<h5 class="mb-0">Lorem Ipsun Dolor si Rahmat</h5>
						</div>
						<div class="table-responsive">
							<table class="table table-hover table-striped">
								<thead>
									<tr>
										<th>#</th>
										<th>Kolom 1</th>
										<th>Kolom 2</th>
										<th>Kolom 3</th>
										<th>Kolom 4</th>
										<th>Kolom 5</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td>1.</td>
										<td>Mboh 1</td>
										<td>Mboh 2</td>
										<td>Mboh 3</td>
										<td>Mboh 4</td>
										<td>Mboh 5</td>
									</tr>
									<tr>
										<td>2.</td>
										<td>Mboh 1</td>
										<td>Mboh 2</td>
										<td>Mboh 3</td>
										<td>Mboh 4</td>
										<td>Mboh 5</td>
									</tr>
									<tr>
										<td>3.</td>
										<td>Mboh 1</td>
										<td>Mboh 2</td>
										<td>Mboh 3</td>
										<td>Mboh 4</td>
										<td>Mboh 5</td>
									</tr>
									<tr>
										<td>4.</td>
										<td>Mboh 1</td>
										<td>Mboh 2</td>
										<td>Mboh 3</td>
										<td>Mboh 4</td>
										<td>Mboh 5</td>
									</tr>
									<tr>
										<td>5.</td>
										<td>Mboh 1</td>
										<td>Mboh 2</td>
										<td>Mboh 3</td>
										<td>Mboh 4</td>
										<td>Mboh 5</td>
									</tr>
									<tr>
										<td>6.</td>
										<td>Mboh 1</td>
										<td>Mboh 2</td>
										<td>Mboh 3</td>
										<td>Mboh 4</td>
										<td>Mboh 5</td>
									</tr>
								</tbody>
							</table>
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



<script type="text/javascript">
    window.onload = function() { jamSekarang(); }
   
    function jamSekarang() {
        var e = document.getElementById('jam_analog'),
        d = new Date(), h, m, s;
        h = d.getHours();
        m = setJam(d.getMinutes());
        s = setJam(d.getSeconds());
   
        e.innerHTML = h +':'+ m +':'+ s;
   
        setTimeout('jamSekarang()', 1000);
    }
   
    function setJam(e) {
        e = e < 10 ? '0'+ e : e;
        return e;
    }

    $(document).ready(function() {
				
        $(document).on('click', '.bpindahlaman', function() {
            const groupx 	= $(this).data('group');
            $.ajax({
                type: "POST",
                url: "<?php echo base_url('auth/pindahlaman');?>",
                data: {group : groupx, user : '<?php echo enkrip(sesuser("id_user"));?>'},
                success: function(data){
                    window.location.href = "<?php echo base_url('dash');?>";
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    //alert(thrownError);
                }
            });
        });
            
    });
</script>


</body>
</html>

