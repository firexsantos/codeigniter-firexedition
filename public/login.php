<?php
	defined('BASEPATH') or exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1.0, shrink-to-fit=no">
<link href="<?= identitas("favicon") ?>" rel="icon">
<title><?= $title ?> - <?= identitas("judul") ?></title>
<meta name="description" content="Login and Register Form Html Template">
<meta name="author" content="harnishdesign.net">

<!-- Web Fonts
========================= -->
<link rel="stylesheet" href="<?= base_url() ?>assets/login/css/css" type="text/css">

<!-- Stylesheet
========================= -->
<link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/login/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/login/css/all.min.css">
<link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/login/css/stylesheet.css">
<!-- Colors Css -->
<!-- <link id="color-switcher" type="text/css" rel="stylesheet" href="<?= base_url() ?>assets/login/css/color-purple.css"> -->
<link id="color-switcher" type="text/css" rel="stylesheet" href="<?= base_url() ?>assets/login/css/color-brown.css">
</head>
<body>

<!-- Preloader -->
<div class="preloader preloader-dark" style="display: none;">
  <div class="lds-ellipsis" style="display: none;">
    <div></div>
    <div></div>
    <div></div>
    <div></div>
  </div>
</div>
<!-- Preloader End -->

<div id="main-wrapper" class="oxyy-login-register">
  <div class="hero-wrap">
    <div class="hero-mask opacity-8 bg-dark"></div>
    <div class="hero-bg hero-bg-scroll" style="background-image:url(<?= base_url() ?>assets/login/images/login-bg-4.jpg);"></div>
    <div class="hero-content w-100">
      <div class="container">
        <div class="row g-0">
          <div class="col-lg-11 col-xl-9 mx-auto">
            <div class="row g-0 min-vh-100"> 
              <!-- Welcome Text
			  ========================= -->
              <div class="col-md-6">
                <div class="hero-wrap h-100">
                  <div class="hero-mask opacity-7 bg-primary"></div>
                  <div class="hero-bg hero-bg-scroll" style="background-image:url(<?= base_url() ?>assets/login/images/login-bg.jpg);"></div>
                  <div class="hero-content w-100 min-vh-100 d-flex flex-column">
                    <div class="row g-0">
                      <div class="col-10 col-lg-9 mx-auto">
                        <div class="logo mt-5 mb-5 mb-md-0"> <a class="d-flex" href="<?= base_url() ?>" title="<?= identitas("judul") ?>"><img src="<?= identitas("logo") ?>" alt="<?= identitas("judul") ?>" style="width:100px;"> <img src="<?= base_url("assets/images/km.png") ?>" alt="Kampus Merdeka" style="width:170px;height:100px;" class="mx-3"></a> </div>
                      </div>
                    </div>
                    <div class="row g-0 my-auto">
                      <div class="col-10 col-lg-9 mx-auto">
                        <h1 class="text-10 text-white fw-700 text-uppercase mb-4"><?= identitas("judul") ?></h1>
                        <p class="text-white fw-500 text-uppercase lh-base mb-5"><?= identitas("deskripsi") ?></p>
                      </div>
                    </div>
                    <div style="position:float;bottom:20px;padding:20px;" class="text-light text-center">Bagian Sarana Prasarana dan Aset (BSPA)</div>
                  </div>
                </div>
              </div>
              <!-- Welcome Text End --> 
              <!-- Login Form
			  ========================= -->
              <div class="col-md-6 d-flex flex-column bg-light shadow-lg">
                <div class="container my-auto py-5">
                  <div class="row g-0">
                    <div class="col-10 col-lg-9 mx-auto">
                      <h3 class="text-6 fw-600">Log In</h3>
                      <p class="text-2 mb-5">Masuk untuk mengakses panel <?= identitas("judul") ?></p>
                      <?php if($this->session->flashdata('message')) { echo $this->session->flashdata('message'); } ?>
                      <form id="loginForm" class="form-border" method="POST" action="<?php echo base_url('auth/login'); ?>">
                        <div class="icon-group icon-group-end mb-3">
                          <input type="text" class="form-control border-dark" id="emailAddress" name="username" required="" placeholder="Username">
                          <span class="icon-inside"><i class="fas fa-user"></i></span> </div>
                        <div class="icon-group icon-group-end mb-3">
                          <input type="password" class="form-control border-dark" id="loginPassword" name="password" required="" placeholder="Password">
                          <span class="icon-inside"><i class="fas fa-lock"></i></span> </div>
                        <div class="form-check mt-4">
                          <input id="remember-me" name="remember" class="form-check-input border-dark rounded-0" type="checkbox">
                          <label class="form-check-label" for="remember-me">Ingat Saya</label>
                        </div>
                        <button class="btn btn-primary rounded-0 my-4" type="submit">Log In</button>
                      </form>
                    </div>
                  </div>
                </div>
                <div class="container pt-2 pb-3">
                  <div class="row">
                    <div class="col-10 col-lg-9 mx-auto text-center">
                      <p class="text-2 text-muted mb-0">Copyright © 2023 <a href="<?= base_url() ?>"><?= identitas("judul")." - ".identitas("deskripsi") ?></a>. All Rights Reserved.</p>
                    </div>
                  </div>
                </div>
              </div>
              <!-- Login Form End --> 
              
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Script --> 
<script src="<?= base_url() ?>assets/login/js/jquery.min.js"></script> 
<script src="<?= base_url() ?>assets/login/js/bootstrap.bundle.min.js"></script> 
<!-- Style Switcher --> 
<script src="<?= base_url() ?>assets/login/js/switcher.min.js"></script> 
<script src="<?= base_url() ?>assets/login/js/theme.js"></script>

</body></html>
