<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title><?= $title ?></title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="shortcut icon" type="image/x-icon" href="<?= base_url('assets/img/tp-logo-png.png') ?>">
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,700,900" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="<?= base_url('assets/css/font-awesome.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/owl.carousel.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/owl.theme.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/owl.transitions.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/animate.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/normalize.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/meanmenu.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/main.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/educate-custon-icon.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/morrisjs/morris.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/scrollbar/jquery.mCustomScrollbar.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/metisMenu/metisMenu.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/metisMenu/metisMenu-vertical.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/calendar/fullcalendar.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/calendar/fullcalendar.print.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/style.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/responsive.css') ?>">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.20/datatables.min.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css" integrity="sha256-siyOpF/pBWUPgIcQi17TLBkjvNgNQArcmwJB8YvkAgg=" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?= base_url('assets/css/datepicker_style.css') ?>" type="text/css">
</head>

<body class="d-flex flex-column h-100">
    <!-- Left Menu Area -->
    <div class="left-sidebar-pro">
        <nav id="sidebar" class="">
            <div class="sidebar-header">
                <a href="<?= site_url('klinik') ?>"><img class="main-logo" src="<?php echo base_url(); ?>assets/img/tp-logo-png.png" width="100" /></a>
            </div>
            <div class="left-custom-menu-adp-wrap comment-scrollbar">
                <nav class="sidebar-nav left-sidebar-menu-pro">
                    <ul class="metismenu" id="menu1">
                        <li>
                            <a href="<?= site_url('klinik') ?>" aria-expanded="false"><span class="mini-click-non">Home</span></a>
                        </li>
                         <li>
                            <a href="<?= site_url('klinik/dokter') ?>" aria-expanded="false"><span class="mini-click-non">Dokter</span></a>
                        </li>
                        <li>
                            <a class="has-arrow" data-toggle="collapse" href="#antrean-collapse" aria-expanded="false" aria-controls="antrean-collapse" role="button"><span class="mini-click-non">Antrean</span></a>
                            <ul class="submenu-angle collapse in" aria-expanded="false" id="antrean-collapse">
                                <li><a title="jumlah antrean" href="<?= site_url('klinik/jumlah_antrean') ?>"><span class="mini-sub-pro">Jumlah Antrean</span></a></li>
                                <li><a title="ambil antrean" href="<?= site_url('klinik/antrean_saya') ?>"><span class="mini-sub-pro">Ambil Antrean</span></a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="<?= site_url('klinik/laporan_pemeriksaan') ?>" aria-expanded="false"><span class="mini-click-non">Laporan Pemeriksaan</span></a>
                        </li>
                    </ul>
                    <span class="navbar-text">
                    <strong>Halo, <?= $this->session->username; ?></strong>
                </span>
                </nav>
            </div>
        </nav>
    </div>

    <div class="all-content-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="logo-pro">
                        <a href="<?= site_url('klinik') ?>"><img class="main-logo" src="<?php echo base_url(); ?>assets/img/tp-logo-png.png" width="50" alt="" /></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="header-advance-area">
            <div class="header-top-area">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="header-top-wraper">
                                <div class="row">
                                    <div class="col-lg-0 col-md-0 col-sm-1 col-xs-12">
                                        <div class="menu-switcher-pro">
                                            <button type="button" id="sidebarCollapse" class="btn bar-button-pro header-drl-controller-btn btn-info navbar-btn">
                                                <i class=""></i>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-7 col-sm-6 col-xs-12">
                                        <div class="header-top-menu tabl-d-n">
                                            <ul class="nav navbar-nav mai-top-nav">
                                            </ul>
                                        </div>
                                    </div>

                                    <div class="col-lg-5 col-md-5 col-sm-12 col-xs-12">
                                        <div class="header-right-info order-3">
                                            <ul class="nav navbar-nav mai-top-nav header-right-menu ml-auto">
                                                <li class="nav-item" style="cursor:pointer">
                                                    <a data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link">
                                                        <span class="admin-name">Halo, <?= $this->session->username; ?></span>
                                                        <i class="fa fa-angle-down edu-icon edu-down-arrow p-1"></i>
                                                    </a>
                                                    <div class="dropdown-menu">
                                                        <a href="<?= base_url('klinik/ubah_profil') ?>" class="dropdown-item"><span class="edu-icon edu-locked author-log-ic"></span>Ubah Profil</a>
                                                        <a href="<?= base_url('login') ?>" class="dropdown-item"><span class="edu-icon edu-locked author-log-ic"></span>Log Out</a>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <main role="main" class="flex-shrink-0">


  