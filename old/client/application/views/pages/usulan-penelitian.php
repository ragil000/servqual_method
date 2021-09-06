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
                            if(isset($_SESSION['flash_message'])) {
                        ?>
                        <div class="alert alert-<?=@$_SESSION['status']?>" role="alert">
                            <?=@$_SESSION['message']?>
                        </div>
                        <?php
                            }
                        ?>
                        <h3 class="sidebar-title">Form Usulan Penelitian</h3>
                        <div class="reply-form">
                            <p>Silahkan ajukan penelitian anda disini </p>
                            <form action="<?=base_url('penelitian/post')?>" enctype="multipart/form-data" method="post">
                            <div class="row">
                                <div class="col-lg-12 form-group">
                                    <input name="title" type="text" class="form-control" placeholder="Judul*" required>
                                </div>
                                <div class="col-lg-12 form-group">
                                    <textarea name="problem" class="form-control" placeholder="Identifikasi Masalah*" required></textarea>
                                </div>
                                <div class="col-lg-12 form-group">
                                    <textarea name="purpose" class="form-control" placeholder="Tujuan*" required></textarea>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col form-group">
                                    <select class="form-control" name="agency" required>
                                        <option value="">--Pilih Instansi--</option>
                                        <?php
                                            if($agencies) {
                                                foreach($agencies as $result) {
                                        ?>
                                        <option value="<?=$result['id']?>"><?=$result['title']?></option>
                                        <?php
                                                }
                                            }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col form-group">
                                    <input name="email" type="email" class="form-control" placeholder="Email" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col form-group">
                                    <label for="tor">TOR</label>
                                    <input name="tor" type="file" id="tor" class="form-control" placeholder="TOR" required>
                                    <small class="text-danger">*Hanya file PDF dengan maksimal berat file 2,5MB</small>
                                </div>
                                <div class="col form-group">
                                    <label for="icp">ICP</label>
                                    <input name="ICP" type="file" id="icp" class="form-control" placeholder="ICP" required>
                                    <small class="text-danger">*Hanya file PDF dengan maksimal berat file 2,5MB</small>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">Kirim</button>
                            </form>
                        </div>

                    </div><!-- End blog entries list -->

                    <div class="col-lg-4">

                        <div class="sidebar">
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
        $('#parent-2').addClass('active');
    </script>