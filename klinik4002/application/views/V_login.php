<!DOCTYPE html>
<html>
<head>
	<title><?= $title ?></title>

	<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" type="image/x-icon" href="<?= base_url('assets/img/tp-logo-png.png') ?>">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

  	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">

  	<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800&display=swap" rel="stylesheet">

  	<link rel="stylesheet" href="<?= base_url('assets/css/style1.css') ?>" type="text/css">
</head>
<body class="login">
	<section class="main-area">
        <div class="container">
            <div class="row h100">
                <div class="col-md-6 p-0">
                    <div class="login">
                        <div class="center-box">
                            <div class="logo">
                                <img src="<?= base_url('assets/img/tp-logo-png.png') ?>" width="150" height="150.276" viewBox="0 0 150 150.276">
                            </div>
                            <div class="title">
                                <h4>Selamat Datang Di Klinik Tong Pang</h4>
                                <p>Fasilitas pelayanan kesehatan yang menyelenggarakan dan menyediakan pelayanan medis dasar dan atau spesialistik, diselenggarakan oleh lebih dari satu jenis tenaga kesehatan dan dipimpin oleh seorang tenaga medis (Permenkes RI No.9, 2014). <br>
                            </div>
                            <div class="form-wrap">
                                <form class="pui-form" method="post" action="<?= site_url('login/auth') ?>">
                                	<?php if ($this->session->flashdata('error_msg')) { ?>
										<div class="alert alert-danger" role="alert">
											<?= $this->session->flashdata('error_msg'); ?>
										</div>
									<?php } else if ($this->session->flashdata('info_msg')) { ?> 
                                        <div class="alert alert-success" role="alert">
                                            <?= $this->session->flashdata('info_msg'); ?>
                                        </div>
                                    <?php } ?>
                                    <div class="pui-form__element">
                                        <label class="animated-label">Username</label>
                                        <input type="text" id="username" class="form-control" placeholder=""
                                            required="true" name="username" >
                                    </div>
                                    <div class="pui-form__element">
                                        <label class="animated-label">Sandi</label>
                                        <input type="password" id="password" class="form-control" placeholder=""
                                            type="password" name="password" required="true">
                                    </div>
                                    <!--<div class="form-check">
                                        <label class="form-check-label forget-password"><a
                                                href="#">Lupa Sandi?</a></label>
                                    </div>-->
                                    <div class="pui-form__element">
                                        <button class="btn btn-lg btn-primary btn-block" type="submit">Masuk</button>
                                    </div>
                                </form>
                                <span class="signup-label">Belum punya akun? <a href="<?= site_url('login/daftar') ?>"> Daftar. </a></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 p-0 m-none" style="background: url(<?= base_url('assets/img/unnamed.png') ?>) center center;background-size: cover;
                background-repeat: no-repeat;">

                </div>
            </div>
        </div>
    </section>

	<script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

    <script src="<?= base_url('assets/js/main.js') ?>"></script>
</body>
</html>