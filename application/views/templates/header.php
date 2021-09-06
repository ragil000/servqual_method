<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="Website resmi Litbang kabupaten Bombana, Sulawesi Tenggara">
        <meta name="author" content="Creative Tim">
        <title>Pregnancy Interactive Learning | Admin</title>
        <!-- Favicon -->
        <link href="<?=base_url()?>back/assets/img/brand/logo.png" rel="icon" type="image/png">
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
        <!-- Icons -->
        <link href="<?=base_url()?>back/assets/vendor/nucleo/css/nucleo.css" rel="stylesheet">
        <link href="<?=base_url()?>back/assets/vendor/@fortawesome/fontawesome-free/css/all.min.css" rel="stylesheet">
        <!-- Argon CSS -->
        <link type="text/css" href="<?=base_url()?>back/assets/css/argon.css?v=1.0.0" rel="stylesheet">

        <!-- custom CSS -->
        <link type="text/css" href="<?=base_url()?>back/assets/css/custom.css" rel="stylesheet">

        <!-- SIM editor -->
        <link rel="stylesheet" type="text/css" href="<?=base_url()?>back/node_modules/simditor/styles/simditor.css" />

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

        <?php
            $ch = curl_init(BASE_API_URL.'history/dashboard');
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    
            $serverOutput = curl_exec($ch);
            curl_close($ch);
            
            $serverOutput = json_decode($serverOutput);

            $evaluation = $serverOutput->evaluation;
            $chat = $serverOutput->chat;
            $new_chat = $serverOutput->new_chat;
        ?>

        <!-- Sidenav -->
        <nav class="navbar navbar-vertical fixed-left navbar-expand-md navbar-light bg-white" id="sidenav-main">
            <div class="container-fluid">

                <!-- Toggler -->
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#sidenav-collapse-main" aria-controls="sidenav-main" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <!-- Brand -->
                <a class="navbar-brand pt-0" href="<?=base_url()?>">
                    <!-- <img src="<?=base_url()?>back/assets/img/brand/blue.png" class="navbar-brand-img" alt="..."> -->
                    <h2 class="text-primary">PIL APP</h2>
                </a>

                <!-- Collapse -->
                <div class="collapse navbar-collapse" id="sidenav-collapse-main">
                    
                    <!-- Collapse header -->
                    <div class="navbar-collapse-header d-md-none">
                        <div class="row">
                            <div class="col-6 collapse-brand">
                                <a href="<?=base_url('dashboard')?>">
                                    <!-- <img src="<?=base_url()?>back/assets/img/brand/blue.png"> -->
                                    <h2 class="text-primary">PIL APP</h2>
                                </a>
                            </div>
                            <div class="col-6 collapse-close">
                                <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#sidenav-collapse-main" aria-controls="sidenav-main" aria-expanded="false" aria-label="Toggle sidenav">
                                    <span></span>
                                    <span></span>
                                </button>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Navigation -->
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" id="beranda" href="<?=base_url('dashboard')?>">
                                <i class="ni ni-tv-2 text-purple"></i> Beranda
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="chat" href="<?=base_url('chat')?>">
                                <i class="ni ni-chat-round text-warning"></i> Pesan Masuk <?=@$new_chat > 0 ? ' <span class="badge badge-warning">'.$new_chat.'</span>' : ''?>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="member-history" href="<?=base_url('history')?>">
                                <i class="ni ni-active-40 text-info"></i> Riwayat Kunjungan
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="quast" href="<?=base_url('quast')?>">
                                <i class="ni ni-chart-bar-32 text-yellow"></i> Kuesioner
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" id="content" href="#navbar-content" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="navbar-content">
                                <i class="ni ni-collection text-primary"></i>
                                <span class="nav-link-text">Konten</span>
                            </a>
                            <div class="collapse show" id="navbar-content">
                                <ul class="nav nav-sm flex-column">
                                    <li class="nav-item">
                                        <a href="<?=base_url('content')?>" id="kompetensi" class="nav-link">
                                            <i class="ni ni-align-left-2 text-primary"></i>
                                            <span class="sidenav-normal"> Kompetensi </span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="<?=base_url('content/materi')?>" id="materi" class="nav-link">
                                            <i class="ni ni-align-left-2 text-primary"></i>
                                            <span class="sidenav-normal"> Materi </span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="<?=base_url('content/tentang')?>" id="tentang" class="nav-link">
                                            <i class="ni ni-align-left-2 text-primary"></i>
                                            <span class="sidenav-normal"> Tentang </span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="<?=base_url('content/bantuan')?>" id="bantuan" class="nav-link">
                                            <i class="ni ni-align-left-2 text-primary"></i>
                                            <span class="sidenav-normal"> Bantuan </span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" id="quist" href="#navbar-quist" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="navbar-quist">
                                <i class="ni ni-bullet-list-67 text-success"></i>
                                <span class="nav-link-text">Evaluasi</span>
                            </a>
                            <div class="collapse show" id="navbar-quist">
                                <ul class="nav nav-sm flex-column">
                                    <li class="nav-item">
                                        <a href="<?=base_url('quist')?>" id="question" class="nav-link">
                                            <i class="ni ni-align-left-2 text-success"></i>
                                            <span class="sidenav-normal"> Pertanyaan </span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="<?=base_url('quist/history')?>" id="history" class="nav-link">
                                            <i class="ni ni-align-left-2 text-success"></i>
                                            <span class="sidenav-normal"> Riwayat </span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="galery" href="#">
                                <i class="ni ni-send text-danger"></i> Pesan
                            </a>
                        </li>
                    </ul>

                    <!-- Divider -->
                    <hr class="my-3">

                    <!-- Navigation -->
                    <ul class="navbar-nav mb-md-3">
                        <li class="nav-item">
                            <a class="nav-link" href="<?=base_url('Auth/logout')?>">
                                <i class="ni ni-curved-next"></i> Keluar
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <!-- Main content -->
        <div class="main-content">
        
            <!-- Top navbar -->
            <nav class="navbar navbar-top navbar-expand-md navbar-dark" id="navbar-main">
                <div class="container-fluid">
            
                    <!-- Brand -->
                    <a class="h4 mb-0 text-white text-uppercase d-none d-lg-inline-block" href="<?=base_url()?>"><?=$head?></a>

                    <!-- User -->
                    <ul class="navbar-nav align-items-center d-none d-md-flex">
                        <li class="nav-item dropdown">
                            <a class="nav-link pr-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <div class="media align-items-center">
                                    <span class="avatar avatar-sm rounded-circle">
                                        <img alt="Image placeholder" src="<?=base_url()?>back/assets/img/theme/user.jpg">
                                    </span>
                                    <div class="media-body ml-2 d-none d-lg-block">
                                        <span class="mb-0 text-sm  font-weight-bold"><?=$this->session->userdata('username')?></span>
                                    </div>
                                </div>
                            </a>
                            <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-right">
                                <div class=" dropdown-header noti-title">
                                    <h6 class="text-overflow m-0">Selamat datang!</h6>
                                </div>
                                <!-- <a href="#" class="dropdown-item">
                                    <i class="ni ni-settings-gear-65"></i>
                                    <span>Pengaturan</span>
                                </a> -->
                                <div class="dropdown-divider"></div>
                                <a href="<?=base_url('Auth/logout')?>" class="dropdown-item">
                                    <i class="ni ni-curved-next"></i>
                                    <span>Keluar</span>
                                </a>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>
                
            <!-- Header -->
            <div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
                <div class="container-fluid">
                    <div class="header-body">
                    
                        <!-- Card stats -->
                        <div class="row justify-content-center">
                            <div class="col-xl-3 col-lg-6">
                                <div class="card card-stats mb-4 mb-xl-0">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col">
                                                <h5 class="card-title text-uppercase text-muted mb-0">Evaluasi</h5>
                                                <span class="h2 font-weight-bold mb-0"><?=@$evaluation ? $evaluation : 0?></span>
                                            </div>
                                            <div class="col-auto">
                                                <div class="icon icon-shape bg-danger text-white rounded-circle shadow">
                                                    <i class="ni ni-single-copy-04"></i>
                                                </div>
                                            </div>
                                        </div>
                                        <p class="mt-3 mb-0 text-muted text-sm">
                                            <span class="text-nowrap">Tahun <?=@$newsTahun ? $newsTahun : date('Y')?></span>
                                        </p>
                                    </div>
                                </div>
                            </div>
          
                            <div class="col-xl-3 col-lg-6">
                                <div class="card card-stats mb-4 mb-xl-0">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col">
                                                <h5 class="card-title text-uppercase text-muted mb-0">Pesan</h5>
                                                <span class="h2 font-weight-bold mb-0"><?=@$chat ? $chat : 0?></span>
                                            </div>
                                            <div class="col-auto">
                                                <div class="icon icon-shape bg-warning text-white rounded-circle shadow">
                                                    <i class="fas fa-chart-bar"></i>
                                                </div>
                                            </div>
                                        </div>
                                        <p class="mt-3 mb-0 text-muted text-sm">
                                            <span class="text-nowrap">Tahun <?=@$gameryTahun ? $gameryTahun : date('Y')?></span>
                                        </p>
                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>
                </div>
            </div>
            
            <!-- Page content -->
            <div class="container-fluid mt--7">
