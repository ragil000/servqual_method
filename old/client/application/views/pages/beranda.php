    <main id="main">

    <!-- ======= Services Section ======= -->
    <section class="services">
      <div class="container">

        <div class="row">
          <div class="col-md-6 col-lg-3 d-flex align-items-stretch" data-aos="fade-up">
            <div class="icon-box icon-box-pink">
              <div class="icon"><i class="bx bx-file"></i></div>
              <h4 class="title"><a href="">Usulan Penelitian</a></h4>
              <p class="description">Anda dapat mengajukan usulan penelitian pada menu ini.</p>
            </div>
          </div>

          <div class="col-md-6 col-lg-3 d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="100">
            <div class="icon-box icon-box-cyan">
              <div class="icon"><i class="bx bx-file"></i></div>
              <h4 class="title"><a href="">Hasil Penelitian</a></h4>
              <p class="description">Anda dapat melihat dokumen hasil penelitian pada menu ini.</p>
            </div>
          </div>

          <div class="col-md-6 col-lg-3 d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="200">
            <div class="icon-box icon-box-green">
              <div class="icon"><i class="bx bx-file"></i></div>
              <h4 class="title"><a href="">Jurnal</a></h4>
              <p class="description">Anda dapat melihat informasi jurnal Litbang kabupaten Bombana seperti berita dan agenda kegiatan pada menu ini.</p>
            </div>
          </div>

          <div class="col-md-6 col-lg-3 d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="200">
            <div class="icon-box icon-box-blue">
              <div class="icon"><i class="bx bx-file"></i></div>
              <h4 class="title"><a href="">Galeri</a></h4>
              <p class="description">Anda dapat melihat foto-foto kegiatan serta video kegiatan Litbang kabupaten Bombana pada menu ini.</p>
            </div>
          </div>

        </div>

      </div>
    </section><!-- End Services Section -->

    <!-- ======= Portfolio Section ======= -->
    <section class="portfolio">
      <div class="container">

        <div class="section-title">
          <h2>Galeri Foto Kegiatan</h2>
          <p>Dokumentasi kegiatan Litbang kabupaten Bombana.</p>
        </div>

        <div class="row portfolio-container" data-aos="fade-up" data-aos-easing="ease-in-out" data-aos-duration="500">

          <?php
              if(!empty($results)) {
                  foreach($results as $value) {
          ?>
          <div class="col-lg-4 col-md-6 filter-app">
              <div class="portfolio-item">
              <img src="<?=base_url('uploads/images/smalls/').$value['file']?>" class="img-fluid" alt="">
              <div class="portfolio-info">
                  <h3><a href="<?=base_url('uploads/images/').$value['file']?>" data-gall="portfolioGallery" class="venobox" title="<?=$value['title']?>"><?=$value['title']?></a></h3>
              </div>
              </div>
          </div>
          <?php
                  }
              }
          ?>

          <div class="col-12 filter-web text-right">
            <a href="<?=base_url('galery/foto-kegiatan')?>" class="btn-get-started">Lihat semua foto galeri</a>
          </div>

        </div>

      </div>
    </section><!-- End Portfolio Section -->

  </main><!-- End #main -->