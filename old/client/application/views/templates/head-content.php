    <!-- ======= Hero Section ======= -->
    <section id="hero" class="d-flex justify-cntent-center align-items-center">
        <div id="heroCarousel" class="container carousel carousel-fade" data-ride="carousel">

        <!-- Slide 1 -->
        <div class="carousel-item active">
            <div class="carousel-container">
            <?php
                if(isset($logo)) {
            ?>
            <img style="width: 130px; height: auto; margin-top: 50px; margin-bottom: 20px;" src="<?=base_url('front/assets/img/bombana.png')?>" alt="Bombana Logo">
            <?php
                }
            ?>
            <h2 class="animate__animated animate__fadeInDown"><?=$head?></h2>
            <p class="animate__animated animate__fadeInUp"><?=$content?></p>
            </div>
        </div>

        </div>
    </section><!-- End Hero -->