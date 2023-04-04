<?php
defined('BASEPATH') or exit('No direct script access allowed');

?><!DOCTYPE html>
<html lang="zxx">
<head>
    <meta charset="utf-8" />
    <title>Under Construction</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <meta content="Under Construction" name="description" />
    <meta content="Under Construction" name="keywords" />
    <meta content="Firman Santosa" name="author" />
	<link rel="shortcut icon" href="<?= config_item('base_url') ?>/assets/images/favicon.ico">
        <!--[if lt IE 9]>
            <script src="js/html5shiv.js"></script>
        <![endif]-->

        <!-- CSS Files
            ================================================== -->
            <link href="<?= config_item('base_url') ?>/assets/maintenance/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
            <link href="<?= config_item('base_url') ?>/assets/maintenance/css/jpreloader.css" rel="stylesheet" type="text/css">
            <link href="<?= config_item('base_url') ?>/assets/maintenance/css/animate.css" rel="stylesheet" type="text/css" />
            <link href="<?= config_item('base_url') ?>/assets/maintenance/css/owl.carousel.css" rel="stylesheet" type="text/css" />
            <link href="<?= config_item('base_url') ?>/assets/maintenance/css/owl.theme.css" rel="stylesheet" type="text/css" />
            <link href="<?= config_item('base_url') ?>/assets/maintenance/css/owl.transitions.css" rel="stylesheet" type="text/css" />
            <link href="<?= config_item('base_url') ?>/assets/maintenance/css/magnific-popup.css" rel="stylesheet" type="text/css" />
            <link href="<?= config_item('base_url') ?>/assets/maintenance/css/jquery.countdown.css" rel="stylesheet" type="text/css" />
            <link href="<?= config_item('base_url') ?>/assets/maintenance/css/style.css" rel="stylesheet" type="text/css" />

            <!-- color scheme -->
            <link id="colors" href="<?= config_item('base_url') ?>/assets/maintenance/css/colors/scheme-01.css" rel="stylesheet" type="text/css" />
            <link href="<?= config_item('base_url') ?>/assets/maintenance/css/coloring.css" rel="stylesheet" type="text/css" />
        </head>

        <body>
            <div id="wrapper">

                <div id="btn-exit">
                    <div class="line-1"></div>
                    <div class="line-2"></div>
                </div>

                <div class="transition"></div>

                <!-- header begin -->
                <header class="transparent">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="d-flex justify-content-between">
                                    <div class="align-self-center header-col-left mt-3">
                                        <!-- logo begin -->
                                        <div id="logo">
                                            <a>
                                                <img src="<?= config_item('base_url') ?>/assets/images/firex.png" alt="CI Firex Edition" style="width:160px;">
                                            </a>
                                        </div>
                                        <!-- logo close -->
                                    </div>
                                    <div class="align-self-center ml-auto header-col-mid">
                                        <!-- mainmenu begin --
                                        <ul id="mainmenu" class="scrollnav">
                                            <li><a href="#section-about">About</a></li>
                                            <li><a href="#section-services">Services</a></li>
                                            <li><a href="#section-works">Works</a></li>
                                            <li><a href="#section-news">Blog</a></li>
                                            <li><a href="#section-contact">Contact</a></li>
                                        </ul>

                                        <!-- mainmenu close -->
                                    </div>
                                    <!--<div class="align-self-center ml-auto header-col-right">
                                        <div class="social-icons sc-plain">
                                            <a href="#"><i class="fa fa-facebook fa-lg"></i></a>
                                            <a href="#"><i class="fa fa-twitter fa-lg"></i></a>
                                            <a href="#"><i class="fa fa-linkedin fa-lg"></i></a>
                                            <a href="#"><i class="fa fa-instagram fa-lg"></i></a>
                                        </div>

                                        <span id="menu-btn"></span>
                                    </div>-->
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </header>
                <!-- header close -->
                <!-- content begin -->
                <div class="no-bottom no-top" id="content">
                    <div id="top"></div>

                    <!-- section begin -->
                    <section id="section-main" class="full-height text-light no-padding">
                        <div class="de-video-container">
                            <div class="de-video-content">
                                <div class="container">
                                    <div class="row wow fadeIn" data-wow-delay=".3s">
                                        <div class="col-lg-10 offset-lg-1 text-center">
                                            <h1>Mohon Maaf!<br><span class="id-color">Kami sedang dalam perbaikan</span></h1>
                                        </div>
                                        <div class="col-lg-6 offset-lg-3 text-center">
                                            <p>Kami sedang melakukan perawarat rutin. Untuk meningkatkan pelayanan, beberapa data sedang kami perbaharui menjadi lebih baik lagi. Mohon maaf atas ketidak nyamanan ini. Silahkan tunggu, kami akan segera kembali.</p>
                                            <div class="spacer-10"></div>
<!--
                                            <a class="btn-custom scroll-to text-dark" href="#section-about">Who We Are</a>&nbsp;&nbsp;
                                            <a class="btn-custom btn-border-light scroll-to" href="#section-services">What We Do</a>
-->
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="de-video-overlay"></div>

                            <!-- load your video here -->
                            <video autoplay="" loop="" muted="" poster="<?= config_item('base_url') ?>/assets/maintenance/images/video-poster.html">
                                <source src="<?= config_item('base_url') ?>/assets/maintenance/videos/video.mp4" type="video/mp4" />
                            </video>

                        </div>
                    </section>
                    <!-- section close -->
                </div>
                <!-- content close -->

            </div>



        <!-- Javascript Files
            ================================================== -->
            <script src="<?= config_item('base_url') ?>/assets/maintenance/js/jquery.min.js"></script>
            <script src="<?= config_item('base_url') ?>/assets/maintenance/js/jpreLoader.min.js"></script>
            <script src="<?= config_item('base_url') ?>/assets/maintenance/js/bootstrap.min.js"></script>
            <script src="<?= config_item('base_url') ?>/assets/maintenance/js/wow.min.js"></script>
            <script src="<?= config_item('base_url') ?>/assets/maintenance/js/jquery.isotope.min.js"></script>
            <script src="<?= config_item('base_url') ?>/assets/maintenance/js/easing.js"></script>
            <script src="<?= config_item('base_url') ?>/assets/maintenance/js/owl.carousel.js"></script>
            <script src="<?= config_item('base_url') ?>/assets/maintenance/js/validation.js"></script>
            <script src="<?= config_item('base_url') ?>/assets/maintenance/js/jquery.magnific-popup.min.js"></script>
            <script src="<?= config_item('base_url') ?>/assets/maintenance/js/enquire.min.js"></script>
            <script src="<?= config_item('base_url') ?>/assets/maintenance/js/jquery.stellar.min.js"></script>
            <script src="<?= config_item('base_url') ?>/assets/maintenance/js/jquery.plugin.js"></script>
            <script src="<?= config_item('base_url') ?>/assets/maintenance/js/typed.js"></script>
            <script src="<?= config_item('base_url') ?>/assets/maintenance/js/typed-custom.js"></script>
            <script src="<?= config_item('base_url') ?>/assets/maintenance/js/designesia.js"></script>
            
        </body>
</html>
