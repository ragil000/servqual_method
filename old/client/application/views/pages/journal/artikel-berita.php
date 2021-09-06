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

        <!-- ======= Blog Section ======= -->
        <section class="blog" data-aos="fade-up" data-aos-easing="ease-in-out" data-aos-duration="500">
            <div class="container">

                <div class="row">

                    <div class="col-lg-8 entries">

                        <?php
                            if(!empty($results)) {
                                foreach($results as $value) {
                        ?>
                        <article class="entry">

                            <div class="entry-img">
                                <img src="<?=base_url('uploads/images/smalls/').$value['file']?>" alt="Gambar" style="width:100%; height:300px; object-fit:cover;" class="img-fluid">
                            </div>

                            <h2 class="entry-title">
                                <a href="<?=base_url('journal/detail/artikel-berita/').$value['slug']?>"><?=_limitText($value['title'], 170)?></a>
                            </h2>

                            <div class="entry-meta">
                                <ul>
                                    <li class="d-flex align-items-center">
                                        <i class="icofont-user"></i>
                                        <a href="#">Admin</a>
                                    </li>
                                    <li class="d-flex align-items-center">
                                        <i class="icofont-wall-clock"></i>
                                        <a href="#"><time datetime="2020-01-01"><?=_dateShortID($value['created_at'])?></time></a>
                                    </li>
                                </ul>
                            </div>

                            <div class="entry-content">
                                <p><?=_limitText($value['content'], 450)?></p>
                                <div class="read-more">
                                    <a href="<?=base_url('journal/detail/artikel-berita/').$value['slug']?>">Baca selanjutnya</a>
                                </div>
                            </div>

                        </article><!-- End blog entry -->
                        <?php
                                }
                            }else {
                        ?>
                            <h3 class="text-center mt-3">Data Kosong.</h3>
                        <?php
                            }
                        ?>

                        <div class="blog-pagination">
                            <?=$pagination?>
                        </div>

                    </div><!-- End blog entries list -->

                    <div class="col-lg-4">

                        <div class="sidebar">

                        <!-- <h3 class="sidebar-title">Pencarian</h3>
                        <div class="sidebar-item search-form">
                            <form action="">
                                <input type="text" placeholder="Cari artikel/berita">
                                <button type="submit"><i class="icofont-search"></i></button>
                            </form>
                        </div>End sidebar search formn -->

                        <h3 class="sidebar-title">Menu Jurnal Lainnya</h3>
                        <div class="sidebar-item categories">
                            <ul>
                                <?php
                                    foreach($side_submenu as $submenu) {
                                ?>
                                <li><a href="<?=$submenu['slug']?>"><?=$submenu['title']?> <?=!empty($submenu['total']) ? '<span>('.$submenu['total'].')</span>' : '' ?></a></li>
                                <?php
                                    }
                                ?>
                            </ul>
                        </div><!-- End sidebar categories-->

                        <h3 class="sidebar-title">Artikel/Berita Terbaru</h3>
                        <div class="sidebar-item recent-posts">

                            <?php
                                if(!empty($new_articles)) {
                                    foreach($new_articles as $value) {
                            ?>
                            <div class="post-item clearfix">
                                <img src="<?=base_url('uploads/images/thumbs/').$value['file']?>" alt="gambar">
                                <h4><a href="<?=base_url('journal/detail/artikel-berita/').$value['slug']?>"><?=_limitText($value['title'],35)?></a></h4>
                                <time datetime="<?=date('Y-m-d')?>"><?=_dateShortID($value['created_at'])?></time>
                            </div>
                            <?php
                                    }
                                }else {
                            ?>
                            <h3>Tidak ada berita.</h3>
                            <?php
                                }
                            ?>

                        </div><!-- End sidebar recent posts-->

                        </div><!-- End sidebar -->

                    </div><!-- End blog sidebar -->

                </div><!-- End row -->

            </div><!-- End container -->
        </section><!-- End Blog Section -->

    </main><!-- End #main -->

    <script>
        $('.parent-menu').removeClass('active');
        $('#parent-4').addClass('active');
    </script>