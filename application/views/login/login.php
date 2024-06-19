<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" href="<?= base_url('build/img/'); ?>icon-posyandu.png">

    <title><?= $title; ?></title>

    <!-- Bootstrap -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="<?= base_url('vendors/bootstrap/dist/css/bootstrap.min.css') ?>" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="<?= base_url('vendors/font-awesome/css/font-awesome.min.css') ?>" rel="stylesheet">
    <!-- NProgress -->
    <link href="<?= base_url('vendors/nprogress/nprogress.css') ?>" rel="stylesheet">
    <!-- Animate.css -->
    <link href="<?= base_url('vendors/animate.css/animate.min.css') ?>" rel="stylesheet">
    <!-- Toastr alert -->
    <link rel="stylesheet" type="text/css" href="<?= base_url('build/css/toastr.min.css') ?>">

    <!-- Custom Theme Style -->
    <link href="<?= base_url('build/css/custom.min.css') ?>" rel="stylesheet">
</head>

<body>

    <div class="bg-images"> <img src="<?= base_url('vendors/icon-1.png'); ?>" width="20%" style="margin-right: 20px; margin-top:150px;margin-left: 100px;"><img src="<?= base_url('vendors/icon-2.png'); ?>" width="20%" style="margin-right: 120px; margin-top:200px;margin-left: 50px; float:right;">
    </div>
    <div class="bg-text">
        <section class="login_content">
            <form class="user validate-form" action="<?php echo base_url('login'); ?>" method="POST">
                <h1>Silahkan Login</h1>

                <div class="form-group wrap-input100" data-validate="Masukkan Username">
                    <input type="text" class="form-control" placeholder="Username" required="" name="username" autofocus value="<?= set_value('username'); ?>" />
                    <?= form_error('username', '<small class="text-danger">', '</small>'); ?>
                </div>
                <div class="form-group wrap-input100" data-validate="Masukkan Password">
                    <input type="password" class="form-control" placeholder="Password" required="" name="password" />
                    <?= form_error('password', '<small class="text-danger">', '</small>'); ?>
                </div>
                <button type="submit" class="btn btn-danger btn-user btn-block">
                    Login
                </button>
                <div class="clearfix"></div>

                <div class="separator">
                    <div class="clearfix"></div>
                    <br />

                    <div style="display: flex; align-items: center;">
                        <img src="<?= base_url('vendors/kab_kerinci.png'); ?>" width="30%" style="margin-right: 20px;">
                        <div>
                            <h1 style="margin: 0;">Posyandu Desa Tanjung Tanah</h1>
                            <br>
                            <span style="font-size: 14px;">Copyright &copy; Posyandu Desa Tanjung Tanah <?= date('Y'); ?></span>
                        </div>
                    </div>

            </form>
        </section>
    </div>