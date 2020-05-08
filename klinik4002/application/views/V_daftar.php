<!DOCTYPE html>
<html>
<head>
    <title><?= $title ?></title>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    
    <link rel="shortcut icon" type="image/x-icon" href="<?= base_url('assets/img/tp-logo-png.png') ?>">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">

    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="<?= base_url('assets/css/style1.css') ?>" type="text/css">

</head>

<body class="login">
    <section class="main-area m-5">
        <div class="container pt-5">
            <div class="row h100">
                <div class="col-md-6 p-0">
                    <div class="login">
                        <div class="center-box">
                            <div class="logo">
                                <img src="<?= base_url('assets/img/tp-logo-png.png') ?>" width="150" height="150.276" viewBox="0 0 150 150.276">
                            </div>
                            <div class="title">
                                <h4>Selamat Datang Di Klinik Tong Pang</h4>
                                <!--<p>Fasilitas pelayanan kesehatan yang menyelenggarakan dan menyediakan pelayanan medis dasar dan atau spesialistik, diselenggarakan oleh lebih dari satu jenis tenaga kesehatan dan dipimpin oleh seorang tenaga medis (Permenkes RI No.9, 2014). <br>-->
                                   
                            </div>
                            <div class="form-wrap">
                                <?= validation_errors('<div class="error alert alert-danger" role="alert">', '</div>') ?>
                                <form class="pui-form" method="post" action="<?= base_url('login/daftar_akun') ?>">
                                    <div class="pui-form__element">
                                        <label class="animated-label">Nama Lengkap</label>
                                        <input type="text" name="nama_pasien" class="form-control" required>
                                    </div>
                                    <div class="pui-form__element">
                                        <label class="animated-label">Email</label>
                                        <input type="email" name="email" class="form-control" required>
                                    </div>
                                    <div class="pui-form__element">
                                        <label class="animated-label">Username</label>
                                        <input type="text" name="username" class="form-control" required>
                                    </div>
                                    <div class="pui-form__element">
                                        <label class="animated-label">Tanggal Lahir</label>
                                        <input type="text" onfocus="(this.type='date')" onblur="if(!this.value)this.type='text'" name="tanggal_lahir" class="form-control" value="" min="1930-01-01" max="<?= (new DateTime('today'))->format('Y-m-d') ?>" required>
                                    </div>
                                    <div class="pui-form__element">
                                        <label class="animated-label">Nomor Telepon</label>
                                        <input type="text" name="no_telp" class="form-control" required>
                                    </div>
                                    <div class="pui-form__element">
                                        <label class="animated-label">Alamat</label>
                                        <input type="text" name="alamat" class="form-control" required>
                                    </div>
                                    <div class="pui-form__element">
                                        <label class="animated-label">Sandi</label>
                                        <input type="password" class="form-control" type="password" name="password" required>
                                    </div>
                                    <div class="pui-form__element">
                                        <label class="animated-label">Konfirmasi Sandi</label>
                                        <input type="password" class="form-control" type="password" name="passconf" required>
                                    </div>
                                    <div class="pui-form__element">
                                        <button class="btn btn-lg btn-primary btn-block" type="submit">Daftar</button>
                                    </div>
                                </form>
                                <span class="signup-label" style="padding-bottom: 20px">Sudah punya akun? <a href="<?= site_url() ?>"> Masuk. </a></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 p-0 m-none align-middle" style="background: url(<?= base_url('assets/img/unnamed.png') ?>) center center;background-size: cover; background-repeat: no-repeat;">
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