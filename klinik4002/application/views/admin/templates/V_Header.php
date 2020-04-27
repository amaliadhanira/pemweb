<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title><?= $title ?></title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- favicon
    ============================================ -->
    <link rel="shortcut icon" type="image/x-icon" href="img/tp-logo-png.png">
    <!-- Google Fonts
    ============================================ -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,700,900" rel="stylesheet">
    <!-- Bootstrap CSS
    ============================================ -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <!-- Bootstrap CSS
    ============================================ -->
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <!-- owl.carousel CSS
    ============================================ -->
    <link rel="stylesheet" href="css/owl.carousel.css">
    <link rel="stylesheet" href="css/owl.theme.css">
    <link rel="stylesheet" href="css/owl.transitions.css">
    <!-- animate CSS
    ============================================ -->
    <link rel="stylesheet" href="css/animate.css">
    <!-- normalize CSS
    ============================================ -->
    <link rel="stylesheet" href="css/normalize.css">
    <!-- meanmenu icon CSS
    ============================================ -->
    <link rel="stylesheet" href="css/meanmenu.min.css">
    <!-- main CSS
    ============================================ -->
    <link rel="stylesheet" href="css/main.css">
    <!-- educate icon CSS
    ============================================ -->
    <link rel="stylesheet" href="css/educate-custon-icon.css">
    <!-- morrisjs CSS
    ============================================ -->
    <link rel="stylesheet" href="css/morrisjs/morris.css">
    <!-- mCustomScrollbar CSS
    ============================================ -->
    <link rel="stylesheet" href="css/scrollbar/jquery.mCustomScrollbar.min.css">
    <!-- metisMenu CSS
    ============================================ -->
    <link rel="stylesheet" href="css/metisMenu/metisMenu.min.css">
    <link rel="stylesheet" href="css/metisMenu/metisMenu-vertical.css">
    <!-- calendar CSS
    ============================================ -->
    <link rel="stylesheet" href="css/calendar/fullcalendar.min.css">
    <link rel="stylesheet" href="css/calendar/fullcalendar.print.min.css">
    <!-- style CSS
    ============================================ -->
    <link rel="stylesheet" href="style.css">
    <!-- responsive CSS
    ============================================ -->
    <link rel="stylesheet" href="css/responsive.css">
    <!-- modernizr JS
    ============================================ -->
    <script src="js/vendor/modernizr-2.8.3.min.js"></script>
</head>
<body>
	<div class="left-sidebar-pro">
        <nav id="sidebar" class="">
            <div class="sidebar-header">
                <a href="<? site_url('admin/adminpage') ?>"><img class="main-logo" src="<?php echo base_url(); ?>assets/img/tp-logo-png.png" width="100" /></a>
                <strong><a href="index.html"><img src="" alt="" /></a></strong>
            </div>
            <div class="left-custom-menu-adp-wrap comment-scrollbar">
                <nav class="sidebar-nav left-sidebar-menu-pro">
                    <ul class="metismenu" id="menu1">
                        <li class="active">
                   <a title="Landing Page" href="<?= site_url('admin/adminpage') ?>" aria-expanded="false"><span class="educate-icon educate-home icon-wrap" aria-hidden="true"></span> <span class="mini-click-non">Dashboard</span></a>
                        </li>
                        <li>
                            <a title="Landing Page" href="<? site_url('admin/antrean') ?>" aria-expanded="false"><span class="educate-icon educate-event icon-wrap sub-icon-mg" aria-hidden="true"></span> <span class="mini-click-non">Antrean</span></a>
                        </li>
                        <li>
                            <a class="has-arrow" href="<? site_url('admin/dokter') ?>" aria-expanded="false"><span class="educate-icon educate-professor icon-wrap"></span> <span class="mini-click-non">Data Dokter</span></a>
                            <ul class="submenu-angle" aria-expanded="false">
                                <li><a title="semua dokter" href="<? site_url('admin/dokter') ?>"><span class="mini-sub-pro">Semua Dokter</span></a></li>
                                <li><a title="tambah dokter" href="<? site_url('admin/dokter/new_dokter') ?>"><span class="mini-sub-pro">Menambahkan Dokter</span></a></li>
                                <li><a title="Edit Dokter" href="<? site_url('admin/dokter/edit_dokter') ?>"><span class="mini-sub-pro">Edit Dokter</span></a></li>
                            </ul>
                        </li>
                        <li>
                            <a title="Landing Page" href="<? site_url('admin/pasien') ?>" aria-expanded="false"><span class="educate-icon educate-student icon-wrap" aria-hidden="true"></span> <span class="mini-click-non">Data Pasien</span></a>
                                
                        
                         
                                
                    
                            <!--/ul-->
                        </li>
                        
                        
                        
                        
                       
                        
                       
                    </ul>
                </nav>
            </div>
        </nav>
    </div>
    <div class="all-content-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    
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
                                    <div class="col-lg-1 col-md-0 col-sm-1 col-xs-12">
                                        <div class="menu-switcher-pro">
                                            <button type="button" id="sidebarCollapse" class="btn bar-button-pro header-drl-controller-btn btn-info navbar-btn">
                                                    <i class=""></i>
                                                </button>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-7 col-sm-6 col-xs-12">
                                        <div class="header-top-menu tabl-d-n">
                                            <ul class="nav navbar-nav mai-top-nav">
                                               
                                               
                                                  
                                                </li>
                                                
                                               
                                        </div>
                                    </div>
                                    <div class="col-lg-5 col-md-5 col-sm-12 col-xs-12">
                                        <div class="header-right-info">
                                            <ul class="nav navbar-nav mai-top-nav header-right-menu">
                                                <li class="">
                                                    <a href="#" data-toggle="dropdown" role="button" aria-expanded="false" class="nav-link dropdown-toggle"><i class="" aria-hidden="true"></i><span class=""></span></a>
                                                    <div role="menu" class="author-message-top dropdown-menu animated zoomIn">
                                                        <div class="">
                                                        
                                                <li class="nav-item"><a href="#" data-toggle="dropdown" role="button" aria-expanded="false" class="nav-link dropdown-toggle"><i class="educate-icon educate-bell" aria-hidden="true"></i><span class="indicator-nt"></span></a>
                                                    <div role="menu" class="notification-author dropdown-menu animated zoomIn">
                                                        <div class="notification-single-top">
                                                            <h1>Notifications</h1>
                                                        </div>