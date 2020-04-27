<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title><?= $title ?></title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/x-icon" href="<?= base_url('assets/img/tp-logo-png.png') ?>">
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,700,900" rel="stylesheet">
    <link rel="stylesheet" href="<?= base_url('assets/css/bootstrap.min.css') ?>">
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
    <link rel="stylesheet" href="<?= base_url('assets/style.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/responsive.css') ?>">
    <script src="<?= base_url('assets/js/vendor/modernizr-2.8.3.min.js') ?>"></script>
</head>
<body>
    <!-- Left Menu Area -->
	<div class="left-sidebar-pro">
        <nav id="sidebar" class="">
            <div class="sidebar-header">
                <a href="<? site_url('admin/adminpage') ?>"><img class="main-logo" src="<?php echo base_url(); ?>assets/img/tp-logo-png.png" width="100" /></a>
            </div>
            <div class="left-custom-menu-adp-wrap comment-scrollbar">
                <nav class="sidebar-nav left-sidebar-menu-pro">
                    <ul class="metismenu" id="menu1">
                        <li class="active">
                            <a title="Landing Page" href="<?= site_url('admin/adminpage') ?>" aria-expanded="false"><span class="mini-click-non">Home</span></a>
                        </li>
                        <li>
                            <a title="Landing Page" href="<? site_url('admin/antrean') ?>" aria-expanded="false"><span class="mini-click-non">Antrean</span></a>
                        </li>
                        <li>
                            <a class="has-arrow" href="#" aria-expanded="false"><span class="mini-click-non">Data Dokter</span></a>
                            <ul class="submenu-angle" aria-expanded="false">
                                <li><a class="dropdown-item <?php if ($page=='dokter') echo 'active'; ?>" title="semua dokter" href="<? site_url('admin/dokter') ?>"><span class="mini-sub-pro">Semua Dokter</span></a></li>
                                <li><a class="dropdown-item <?php if ($page=='new_dokter') echo 'active'; ?>" title="tambah dokter" href="<? site_url('admin/dokter/new_dokter') ?>"><span class="mini-sub-pro">Menambahkan Dokter</span></a></li>
                                <li><a class="dropdown-item <?php if ($page=='edit_dokter') echo 'active'; ?>" title="Edit Dokter" href="<? site_url('admin/dokter/edit_dokter') ?>"><span class="mini-sub-pro">Edit Dokter</span></a></li>
                            </ul>
                        </li>
                        <li>
                            <a title="Landing Page" href="<? site_url('admin/pasien') ?>" aria-expanded="false"><span class="mini-click-non">Data Pasien</span></a>
                    <!--/ul-->
                        </li>

                    </ul>
                    <span class="navbar-text">
                    <strong>Halo, <?= $this->session->username; ?></strong>
                </span>
                </nav>
            </div>
        </nav>
    </div>

  