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
    <link rel="shortcut icon" type="image/x-icon" href="<?= base_url('assets/img/tp-logo-png.png') ?>">
    <!-- Google Fonts
    ============================================ -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,700,900" rel="stylesheet">
    <!-- Bootstrap CSS
    ============================================ -->
    <link rel="stylesheet" href="<?= base_url('assets/css/bootstrap.min.css') ?>">
    <!-- Bootstrap CSS
    ============================================ -->
    <link rel="stylesheet" href="<?= base_url('assets/css/font-awesome.min.css') ?>">
    <!-- owl.carousel CSS
    ============================================ -->
    <link rel="stylesheet" href="<?= base_url('assets/css/owl.carousel.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/owl.theme.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/owl.transitions.css') ?>">
    <!-- animate CSS
    ============================================ -->
    <link rel="stylesheet" href="<?= base_url('assets/css/animate.css') ?>">
    <!-- normalize CSS
    ============================================ -->
    <link rel="stylesheet" href="<?= base_url('assets/css/normalize.css') ?>">
    <!-- meanmenu icon CSS
    ============================================ -->
    <link rel="stylesheet" href="<?= base_url('assets/css/meanmenu.min.css') ?>">
    <!-- main CSS
    ============================================ -->
    <link rel="stylesheet" href="<?= base_url('assets/css/main.css') ?>">
    <!-- educate icon CSS
    ============================================ -->
    <link rel="stylesheet" href="<?= base_url('assets/css/educate-custon-icon.css') ?>">
    <!-- morrisjs CSS
    ============================================ -->
    <link rel="stylesheet" href="<?= base_url('assets/css/morrisjs/morris.css') ?>">
    <!-- mCustomScrollbar CSS
    ============================================ -->
    <link rel="stylesheet" href="<?= base_url('assets/css/scrollbar/jquery.mCustomScrollbar.min.css') ?>">
    <!-- metisMenu CSS
    ============================================ -->
    <link rel="stylesheet" href="<?= base_url('assets/css/metisMenu/metisMenu.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/metisMenu/metisMenu-vertical.css') ?>">
    <!-- calendar CSS
    ============================================ -->
    <link rel="stylesheet" href="<?= base_url('assets/css/calendar/fullcalendar.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/calendar/fullcalendar.print.min.css') ?>">
    <!-- style CSS
    ============================================ -->
    <link rel="stylesheet" href="<?= base_url('assets/style.css') ?>">
    <!-- responsive CSS
    ============================================ -->
    <link rel="stylesheet" href="<?= base_url('assets/css/responsive.css') ?>">
    <!-- modernizr JS
    ============================================ -->
    <script src="<?= base_url('assets/js/vendor/modernizr-2.8.3.min.js') ?>"></script>
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
                   <a title="Landing Page" href="<?= site_url('admin/adminpage') ?>" aria-expanded="false"><span class="mini-click-non">Dashboard</span></a>
                        </li>
                        <li>
                            <a title="Landing Page" href="<? site_url('admin/antrean') ?>" aria-expanded="false"><span class="mini-click-non">Antrean</span></a>
                        </li>
                        <li>
                            <a class="has-arrow" href="<? site_url('admin/dokter') ?>" aria-expanded="false"><span class="mini-click-non">Data Dokter</span></a>
                            <ul class="submenu-angle" aria-expanded="false">
                                <li><a title="semua dokter" href="<? site_url('admin/dokter') ?>"><span class="mini-sub-pro">Semua Dokter</span></a></li>
                                <li><a title="tambah dokter" href="<? site_url('admin/dokter/new_dokter') ?>"><span class="mini-sub-pro">Menambahkan Dokter</span></a></li>
                                <li><a title="Edit Dokter" href="<? site_url('admin/dokter/edit_dokter') ?>"><span class="mini-sub-pro">Edit Dokter</span></a></li>
                            </ul>
                        </li>
                        <li>
                            <a title="Landing Page" href="<? site_url('admin/pasien') ?>" aria-expanded="false"><span class="mini-click-non">Data Pasien</span></a>
                                
                        
                         
                                
                    
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
                                                         <ul class="notification-menu">
                                                            <li>
                                                                <a href="#">
                                                                    <div class="notification-icon">
                                                                        <i class="educate-icon educate-checked edu-checked-pro admin-check-pro" aria-hidden="true"></i>
                                                                    </div>
                                                                    <div class="notification-content">
                                                                        <span class="notification-date">16 Sept</span>
                                                                        <h2> New </h2>
                                                                        <p>Anda baru saja mengedit data dokter</p>
                                                                    </div>
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <a href="#">
                                                                    <div class="notification-icon">
                                                                        <i class="fa fa-cloud edu-cloud-computing-down" aria-hidden="true"></i>
                                                                    </div>
                                                                    <div class="notification-content">
                                                                        <span class="notification-date">16 Sept</span>
                                                                        <h2> New </h2>
                                                                        <p>Anda baru saja menambahkan dokter</p>
                                                                    </div>
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <a href="#">
                                                                    <div class="notification-icon">
                                                                        <i class="fa fa-eraser edu-shield" aria-hidden="true"></i>
                                                                    </div>
                                                                    <div class="notification-content">
                                                                        <span class="notification-date">16 Sept</span>
                                                                        <h2> New </h2>
                                                                        <p>Anda baru saja menghapus pasien</p>
                                                                    </div>
                                                                </a>
                                                            </li>
                                                            
                                                        <div class="notification-view">
                                                            <a href="#">View All Notification</a>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li class="nav-item">
                                                    <a href="#" data-toggle="dropdown" role="button" aria-expanded="false" class="nav-link dropdown-toggle">
                                                            <img src="img/product/pro4.jpg" alt="" />
                                                            <span class="admin-name">Susi Susanti</span>
                                                            <i class="fa fa-angle-down edu-icon edu-down-arrow"></i>
                                                        </a>
                                                    <ul role="menu" class="dropdown-header-top author-log dropdown-menu animated zoomIn">
                                                       
                                                        <li><a href="Login(Masuk).html"><span class="edu-icon edu-locked author-log-ic"></span>Log Out</a>
                                                        </li>
                                                    </ul>
                                                </li>
                                                <li class="n"><a href="#" data-toggle="dropdown" role="button" aria-expanded="false" class="nav-link dropdown-toggle"><i class=""></i></a>

                                                    <div role="menu" class="admintab-wrap menu-setting-wrap menu-setting-wrap-bg dropdown-menu animated zoomIn">
                                                        <ul class="nav nav-tabs custon-set-tab">
                                                         
                                                        </ul>

                                                        <div class="">
                                                            <div id="" class="">
                                                                <div class="">
                                                                    <div class="">
                                                                      
                                                                    </div>
                                                                    <div class="">
                                                                        <ul class="">
                                                                            <li>
                                                                                <a href="#">
                                                                                    <div class="notes-list-flow">
                                                                                        <div class="notes-img">
                                                                                        
                                                                                        </div>
                                                                                    </div>
                                                                                </a>
                                                                            </li>
                                                                            <li>
                                                                                <a href="#">
                                                                                    <div class="notes-list-flow">
                                                                                        <div class="notes-img">
                                                                                      
                                                                                        </div>
                                                                                    </div>
                                                                                </a>
                                                                            </li>
                                                                            <li>
                                                                                <a href="#">
                                                                                    <div class="notes-list-flow">
                                                                                        <div class="notes-img">
                                                                                        
                                                                                        </div>
                                                                                    </div>
                                                                                </a>
                                                                            </li>
                                                                            <li>
                                                                                <a href="#">
                                                                                    <div class="notes-list-flow">
                                                                                        <div class="notes-img">
                                                                                          
                                                                                        </div>
                                                                                    </div>
                                                                                </a>
                                                                            </li>
                                                                            <li>
                                                                                <a href="#">
                                                                                    <div class="notes-list-flow">
                                                                                        <div class="notes-img">
                                                                                         
                                                                                        </div>
                                                                                    </div>
                                                                                </a>
                                                                            </li>
                                                                            <li>
                                                                                <a href="#">
                                                                                    <div class="notes-list-flow">
                                                                                        <div class="notes-img">
                                                                                         
                                                                                        </div>
                                                                                    </div>
                                                                                </a>
                                                                            </li>
                                                                            <li>
                                                                                <a href="#">
                                                                                    <div class="notes-list-flow">
                                                                                        <div class="notes-img">
                                                                                         
                                                                                        </div>
                                                                                    </div>
                                                                                </a>
                                                                            </li>
                                                                            <li>
                                                                                <a href="#">
                                                                                    <div class="notes-list-flow">
                                                                                        <div class="notes-img">
                                                                                      
                                                                                        </div>
                                                                                    </div>
                                                                                </a>
                                                                            </li>
                                                                            <li>
                                                                                <a href="#">
                                                                                    <div class="notes-list-flow">
                                                                                        <div class="notes-img">
                                                                                           
                                                                                        </div>
                                                                                    </div>
                                                                                </a>
                                                                            </li>
                                                                            <li>
                                                                                <a href="#">
                                                                                    <div class="notes-list-flow">
                                                                                        <div class="notes-img">
                                                                                           
                                                                                        </div>
                                                                                    </div>
                                                                                </a>
                                                                            </li>
                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                            </div>