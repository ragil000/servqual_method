    <main id="main">

        <!-- ======= Blog Section ======= -->
        <section class="breadcrumbs">
        <div class="container">

            <div class="d-flex justify-content-between align-items-center">
            <h2><?=$title?></h2>

            <ol>
                <?php
                    foreach($link_map as $link) {
                ?>
                <li><a href="<?=$link['slug']?>"><?=$link['title']?></a></li>
                <?php
                    }
                ?>
            </ol>
            </div>

        </div>
        </section><!-- End Blog Section -->
        
        <section class="portfolio">
            <div class="container">

                <div class="section-title">
                <h2>Galeri Foto Dokumentasi</h2>
                <p>Foto - Foto Dokumentasi Litbang kabupaten Bombana.</p>
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

                </div>

            </div>
        </section><!-- End Portfolio Section -->

        <!-- ======= Blog Section ======= -->
        <section class="blog" data-aos="fade-up" data-aos-easing="ease-in-out" data-aos-duration="500">
            
            <div class="container">

                <div class="row">

                    <div class="col-lg-8 entries">
                        <div class="blog-pagination">
                            <?=$pagination?>
                        </div> 
                    </div><!-- End blog entries list -->

                </div><!-- End row -->

            </div><!-- End container -->
        
        </section><!-- End Blog Section -->

    </main><!-- End #main -->

    <script>
        $('.parent-menu').removeClass('active');
        $('#parent-6').addClass('active');
    </script>