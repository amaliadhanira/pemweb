<!DOCTYPE html>
<html>
<head>
	<title><?= $title ?></title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
	
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.20/datatables.min.css"/>

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css" integrity="sha256-siyOpF/pBWUPgIcQi17TLBkjvNgNQArcmwJB8YvkAgg=" crossorigin="anonymous" />

  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">

  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800&display=swap" rel="stylesheet">

  <link rel="stylesheet" href="<?= base_url('assets/css/datepicker_style.css') ?>" type="text/css">
</head>
<body>
	<div class="container">
		<nav class="navbar navbar-expand-lg navbar-light bg-light">
  			<a class="navbar-brand" href="<?= site_url('klinik') ?>">Administrasi</a>
  			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    			<span class="navbar-toggler-icon"></span>
  			</button>
  			<div class="collapse navbar-collapse" id="navbarNav">
    			<ul class="navbar-nav mr-auto">
      				<li class="nav-item <?php if ($page=='home') echo 'active'; ?>">
        				<a class="nav-link" href="<?= site_url('klinik') ?>">Home</a>
      				</li>
              <li class="nav-item <?php if ($page=='home') echo 'active'; ?>">
                <a class="nav-link" href="<?= site_url('admin/adminpage') ?>">Daftar Admin</a>
              </li>
              <li class="nav-item">
                <a class="nav-link <?php if ($page=='dokter') echo 'active'; ?>" href="<?= site_url('admin/dokter') ?>">Dokter</a>
              </li>
               <li class="nav-item">
                <a class="nav-link <?php if ($page=='farmasi') echo 'active'; ?>" href="<?= site_url('admin/farmasi') ?>">Farmasi</a>
              </li> 
               <li class="nav-item">
                <a class="nav-link <?php if ($page=='lab') echo 'active'; ?>" href="<?= site_url('admin/lab') ?>">Lab</a>
              </li>
               <li class="nav-item">
                <a class="nav-link <?php if ($page=='antrean') echo 'active'; ?>" href="<?= site_url('admin/antrean') ?>">Antrean</a>
              </li>
      				<li class="nav-item">
        				<a class="nav-link <?php if ($page=='laporan') echo 'active'; ?>" href="#">Laporan Pemeriksaan</a>
      				</li>
      				<li class="nav-item dropdown">
        				<a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Profil</a>
        				<div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
          					<a class="dropdown-item" href="#">Ubah Profil</a>
          					<a class="dropdown-item" href="<?= site_url('login/logout') ?>">Logout</a>
        				</div>
      				</li>
    			</ul>
    			<span class="navbar-text">
    				<strong>Halo, <?= $this->session->username; ?></strong>
    			</span>
  			</div>
		</nav>
	</div>
