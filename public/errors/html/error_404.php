<?php
defined('BASEPATH') or exit('No direct script access allowed');
$CI =& get_instance();
if( ! isset($CI))
{
    $CI = new CI_Controller();
}
$CI->load->helper('url');
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>Halaman tidak ditemukan - <?php echo identitas("judul");?></title>
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
	<!-- /core JS files -->

	<!-- Theme JS files -->
	<script src="<?= base_url() ?>assets/js/app.js"></script>
    <script src="<?= base_url() ?>assets/demo/pages/animations_css3.js"></script>
	<!-- /theme JS files -->

</head>

<body>

	<!-- Page content -->
	<div class="page-content">

		<!-- Main content -->
		<div class="content-wrapper">

			<!-- Inner content -->
			<div class="content-inner">

				<!-- Content area -->
				<div class="content d-flex justify-content-center align-items-center">

					<!-- Container -->
					<div class="flex-fill">

						<!-- Error title -->
						<div class="text-center mb-4">
							<img src="<?= base_url() ?>assets/images/error_bg.svg" class="img-fluid mb-3" height="230" alt="">
							<h1 class="display-3 fw-semibold lh-1 mb-3">404</h1>
							<h6 class="w-md-25 mx-md-auto">Oops, terjadi kesalahan.<br>Halaman yang Anda cari tidak ditemukan.</h6>
						</div>
						<!-- /error title -->


						<!-- Error content -->
						<div class="text-center">
							<a href="<?= base_url("auth") ?>" class="btn btn-primary">
								<i class="ph-house me-2"></i>
								Kembali ke Halaman Login
							</a>
						</div>
						<!-- /error wrapper -->

					</div>
					<!-- /container -->

				</div>
				<!-- /content area -->



			</div>
			<!-- /inner content -->

		</div>
		<!-- /main content -->

	</div>
	<!-- /page content -->

</body>
</html>
