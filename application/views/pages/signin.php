<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Website resmi Litbang kabupaten Bombana, Sulawesi Tenggara">
    <meta name="author" content="Creative Tim">
    <title>Servqual Method | Halaman Signin</title>
    <!-- Favicon -->
    <link href="<?= base_url() ?>back/assets/img/brand/logo.ico" rel="icon" type="image/png">
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
    <!-- Icons -->
    <link href="<?= base_url('back') ?>/assets/vendor/nucleo/css/nucleo.css" rel="stylesheet">
    <link href="<?= base_url('back') ?>/assets/vendor/@fortawesome/fontawesome-free/css/all.min.css" rel="stylesheet">
    <!-- Argon CSS -->
    <link type="text/css" href="<?= base_url('back') ?>/assets/css/argon.css?v=1.0.0" rel="stylesheet">
</head>

<body class="bg-default">
    <div class="main-content">
        <!-- Navbar -->
        <nav class="navbar navbar-top navbar-horizontal navbar-expand-md navbar-dark">
            <div class="container px-4">
                <a class="navbar-brand" href="#">
                    <!-- <img src="<?= base_url('back') ?>/assets/img/brand/white.png" /> -->
                    <h2 class="text-white">Servqual Method</h2>
                </a>
            </div>
        </nav>
        <!-- Header -->
        <div class="header bg-gradient-primary py-7 py-lg-8">
            <div class="separator separator-bottom separator-skew zindex-100">
                <svg x="0" y="0" viewBox="0 0 2560 100" preserveAspectRatio="none" version="1.1" xmlns="http://www.w3.org/2000/svg">
                    <polygon class="fill-default" points="2560 0 2560 100 0 100"></polygon>
                </svg>
            </div>
        </div>
        <!-- Page content -->
        <div class="container mt--8 pb-5">
            <div class="row justify-content-center">
                <div class="col-lg-5 col-md-7">
                    <div class="card bg-secondary shadow border-0">
                        <div class="card-body px-lg-5 py-lg-5">
                            <?php
                            if ($this->session->userdata('flash_message')) {
                            ?>
                                <div class="alert alert-danger" role="alert">
                                    <?= $this->session->userdata('message') ?>
                                </div>
                            <?php
                            }
                            ?>
                            <div class="text-center text-muted mb-4">
                                <small>Silahkan masuk dengan mengisi username dan password yang valid.</small>
                            </div>
                            <form role="form" method="POST" action="<?= base_url('Auth/signin') ?>">
                                <div class="form-group mb-3">
                                    <div class="input-group input-group-alternative">
                                        <?php
                                        $get_data = $this->db->get_where('labs', ['deleted_at' => NULL]);
                                        $link_jump = '<a href="'.base_url('Auth?is_super=yes').'" class="text-sm">super admin?</a>';
                                        if (@$_GET['is_super'] != 'yes') {
                                        ?>
                                            <select class="form-control" name="lab_id" required>
                                                <option value="">--Pilih Laboratorium--</option>
                                                <?php
                                                    if($get_data->num_rows() > 0) {
                                                        foreach($get_data->result() as $value) {
                                                ?>
                                                <option value="<?=$value->_id?>"><?=$value->title?></option>
                                                <?php
                                                        }
                                                    }
                                                ?>
                                            </select>
                                        <?php
                                        }else {
                                            $link_jump = '<a href="'.base_url('Auth?is_super=no').'" class="text-sm">admin lab?</a>';
                                        }
                                        ?>
                                    </div>
                                </div>
                                <div class="form-group mb-3">
                                    <div class="input-group input-group-alternative">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="ni ni-email-83"></i></span>
                                        </div>
                                        <input name="username" class="form-control" placeholder="Username" type="text" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="input-group input-group-alternative">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
                                        </div>
                                        <input name="password" class="form-control" placeholder="Password" type="password" required>
                                    </div>
                                </div>
                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary my-4">Masuk</button>
                                </div>
                                <div class="text-center">
                                    <?=$link_jump?>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Footer -->
    <footer class="py-1">
        <div class="container">
            <div class="row align-items-center justify-content-xl-center">
                <div class="col-xl-6">
                    <div class="copyright text-center text-muted text-sm">
                        &copy; <?= date('Y') ?> Developed by <a href="#" class="font-weight-bold ml-1">Kurniah</a> Designed by <a href="https://www.creative-tim.com" class="font-weight-bold ml-1" target="_blank">Creative Tim</a>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- Argon Scripts -->
    <!-- Core -->
    <script src="<?= base_url('back') ?>/assets/vendor/jquery/dist/jquery.min.js"></script>
    <script src="<?= base_url('back') ?>/assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Argon JS -->
    <script src="<?= base_url('back') ?>/assets/js/argon.js?v=1.0.0"></script>
</body>

</html>