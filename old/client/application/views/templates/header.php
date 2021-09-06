<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Netlitbang | Bombana</title>
  <meta content="" name="descriptison">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="<?=base_url('front/')?>assets/img/logo.png" rel="icon">
  <link href="<?=base_url('front/')?>assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Roboto:300,300i,400,400i,500,500i,700,700i&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="<?=base_url('front/')?>assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="<?=base_url('front/')?>assets/vendor/animate.css/animate.min.css" rel="stylesheet">
  <link href="<?=base_url('front/')?>assets/vendor/icofont/icofont.min.css" rel="stylesheet">
  <link href="<?=base_url('front/')?>assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="<?=base_url('front/')?>assets/vendor/venobox/venobox.css" rel="stylesheet">
  <link href="<?=base_url('front/')?>assets/vendor/owl.carousel/assets/owl.carousel.min.css" rel="stylesheet">
  <link href="<?=base_url('front/')?>assets/vendor/aos/aos.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="<?=base_url('front/')?>assets/css/style.css" rel="stylesheet">

  <!-- =======================================================
  * Template Name: Moderna - v2.1.0
  * Template URL: https://bootstrapmade.com/free-bootstrap-template-corporate-moderna/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
  <script src="<?=base_url('front/')?>assets/vendor/jquery/jquery.min.js"></script>
</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="fixed-top header-transparent">
    <div class="container">

      <div class="logo float-left pr-5">
        <!-- <h1 class="text-light"><a href="<?=base_url()?>"><span>NETLITBANG</span></a></h1> -->
        <!-- Uncomment below if you prefer to use an image logo -->
        <a href="<?=base_url()?>"><img src="<?=base_url('front/')?>assets/img/logo.png" alt="" class="img-fluid"> <span class="text-light">NETLITBANG</span></a>
      </div>

      <nav class="nav-menu d-none d-lg-block">
        <ul>
          <li id="parent-1" class="parent-menu active"><a href="<?=base_url()?>">Beranda</a></li>
          <li id="parent-2" class="parent-menu"><a href="<?=base_url('usulan-penelitian')?>">Usulan Penelitian</a></li>
          <li id="parent-3" class="drop-down parent-menu"><a href="">Hasil Penelitian</a>
            <ul>
              <li><a href="<?=base_url('litbang/sosial-pemerintahan')?>">Sosial Ekonomi dan Pemerintahan</a></li>
              <li><a href="<?=base_url('litbang/ekonomi-pembangunan')?>">Pembangunan, Inovasi dan Teknologi</a></li>
              <!-- <li><a href="<?=base_url('litbang/inovasi-pelayanan-publik')?>">Inovasi dan Pelayanan Publik</a></li> -->
            </ul>
          </li>
          <li id="parent-4" class="drop-down parent-menu"><a href="">Jurnal</a>
            <ul>
              <li><a href="<?=base_url('journal/sop-kelitbangan')?>">SOP Kelitbangan</a></li>
              <li><a href="<?=base_url('journal/rik-bombana')?>">RIK Kab. Bombana</a></li>
              <li><a href="<?=base_url('journal/agenda-kegiatan')?>">Agenda Kegiatan</a></li>
              <!-- <li><a href="<?=base_url('journal/rekomendasi')?>">Rekomendasi</a></li> -->
              <li><a href="<?=base_url('journal/artikel-berita')?>">Artikel dan Berita</a></li>
            </ul>
          </li>
          <li id="parent-5" class="parent-menu"><a href="<?=base_url('journal/rekomendasi')?>">Rekomendasi</a></li>
          <li id="parent-6" class="drop-down parent-menu"><a href="">Galeri</a>
            <ul>
              <li><a href="<?=base_url('galery/foto-kegiatan')?>">Foto Kegiatan</a></li>
              <li><a href="<?=base_url('galery/video')?>">Video</a></li>
            </ul>
          </li>
          <li id="parent-7" class="drop-down parent-menu"><a href="">Profil</a>
            <ul>
              <li><a href="<?=base_url('profile/definisi')?>">Definisi</a></li>
              <li><a href="<?=base_url('profile/struktur-organisasi')?>">Struktur Organisasi</a></li>
              <li><a href="<?=base_url('profile/regulasi')?>">Regulasi</a></li>
              <li><a href="<?=base_url('profile/kontak-kami')?>">Kontak Kami</a></li>
            </ul>
          </li>
        </ul>
      </nav><!-- .nav-menu -->

      <div class="logo float-right">
        <a href="<?=base_url()?>"><img src="<?=base_url('front/')?>assets/img/logo-kanan.png" alt="" class="img-fluid"> <span class="text-light"></span></a>
      </div>

    </div>
  </header><!-- End Header -->