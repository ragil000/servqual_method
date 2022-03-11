<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Website resmi Litbang kabupaten Bombana, Sulawesi Tenggara">
    <meta name="author" content="Creative Tim">
    <title>Servqual Method | <?=isset($title) ? $title : 'Admin'?></title>
    <!-- Favicon -->
    <link href="<?= base_url() ?>back/assets/img/brand/logo.ico" rel="icon" type="image/png">
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
    <!-- Icons -->
    <link href="<?= base_url() ?>back/assets/vendor/nucleo/css/nucleo.css" rel="stylesheet">
    <link href="<?= base_url() ?>back/assets/vendor/@fortawesome/fontawesome-free/css/all.min.css" rel="stylesheet">
    <!-- Argon CSS -->
    <link type="text/css" href="<?= base_url() ?>back/assets/css/argon.css?v=1.0.0" rel="stylesheet">

    <!-- by vendor -->
    <?php
    if(isset($css_vendors)) {
        for($i=0; $i<count($css_vendors); $i++) {
    ?>
        <link type="text/css" href="<?= base_url() ?>back/assets/vendor/<?=$css_vendors[$i]?>" rel="stylesheet">
    <?php
        }
    }
    ?>

    <?php
    if(isset($style)) {
    ?>
        <!-- custom CSS -->
        <link type="text/css" href="<?= base_url() ?>back/assets/css/<?=$style?>" rel="stylesheet">
    <?php
    }
    ?>

    <style>
        /* width */
        ::-webkit-scrollbar {
            width: 5px;
        }

        /* Track */
        ::-webkit-scrollbar-track {
            background: #f1f1f1;
        }

        /* Handle */
        ::-webkit-scrollbar-thumb {
            background: #888;
        }

        /* Handle on hover */
        ::-webkit-scrollbar-thumb:hover {
            background: #191D4D;
        }
    </style>

</head>

<body>
    <!-- Sidenav -->

    <!-- Main content -->
    <div class="main-content">

        <!-- Top navbar -->
        <nav class="navbar navbar-top navbar-expand-md navbar-dark" id="navbar-main">
            <div class="container-fluid">

                <!-- Brand -->
                <a class="h4 mb-0 text-white text-uppercase d-none d-lg-inline-block" href="<?= base_url() ?>"><?= $head ?></a>

            </div>
        </nav>

        <!-- Header -->
        <div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
            <div class="container-fluid">
                <div class="header-body">

                    <!-- Card stats -->
                    <div class="row justify-content-center">
                        <!-- <div class="col-xl-3 col-lg-6">
                            <div class="card card-stats mb-4 mb-xl-0">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col">
                                            <h5 class="card-title text-uppercase text-muted mb-0">Kuesioner</h5>
                                            <span class="h2 font-weight-bold mb-0">0</span>
                                        </div>
                                        <div class="col-auto">
                                            <div class="icon icon-shape bg-danger text-white rounded-circle shadow">
                                                <i class="ni ni-single-copy-04"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <p class="mt-3 mb-0 text-muted text-sm">
                                        <span class="text-nowrap">Tahun <?= date('Y') ?></span>
                                    </p>
                                </div>
                            </div>
                        </div> -->

                    </div>

                </div>
            </div>
        </div>

        <!-- Page content -->
        <div class="container-fluid mt--7">