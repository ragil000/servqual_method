                <!-- Footer -->
                <footer class="footer">
                    <div class="row align-items-center justify-content-xl-between">
                        <div class="col-xl-6">
                            <div class="copyright text-center text-xl-left text-muted">
                                &copy; <?=date('Y')?> <a href="#" class="font-weight-bold ml-1">Kurniah</a>
                            </div>
                        </div>
                        <div class="col-xl-6">
                            <!-- <ul class="nav nav-footer justify-content-center justify-content-xl-end">
                                <li class="nav-item">
                                    <a href="https://www.creative-tim.com" class="nav-link" target="_blank">Creative Tim</a>
                                </li>
                                <li class="nav-item">
                                    <a href="https://www.creative-tim.com/presentation" class="nav-link" target="_blank">About Us</a>
                                </li>
                                <li class="nav-item">
                                    <a href="http://blog.creative-tim.com" class="nav-link" target="_blank">Blog</a>
                                </li>
                                <li class="nav-item">
                                    <a href="https://github.com/creativetimofficial/argon-dashboard/blob/master/LICENSE.md" class="nav-link" target="_blank">MIT License</a>
                                </li>
                            </ul> -->
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        
        <!-- Argon Scripts -->
        
        <!-- Core -->
        <script src="<?=base_url()?>back/assets/vendor/jquery/dist/jquery.min.js"></script>
        <script src="<?=base_url()?>back/assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
        
        <!-- Optional JS -->
        <script src="<?=base_url()?>back/assets/vendor/chart.js/dist/Chart.min.js"></script>
        <script src="<?=base_url()?>back/assets/vendor/chart.js/dist/Chart.extension.js"></script>
        
        <!-- Argon JS -->
        <script src="<?=base_url()?>back/assets/js/argon.js?v=1.0.0"></script>

        <!-- Sim text editor -->
        <script type="text/javascript" src="<?=base_url()?>back/node_modules/simple-hotkeys/node_modules/simple-module/lib/module.js"></script>
        <script type="text/javascript" src="<?=base_url()?>back/node_modules/simple-hotkeys/lib/hotkeys.js"></script>
        <script type="text/javascript" src="<?=base_url()?>back/node_modules/simple-uploader/dist/uploader.js"></script>
        <script type="text/javascript" src="<?=base_url()?>back/node_modules/simditor/lib/simditor.js"></script>
        
        <!-- ckditor5 -->
        <script src="https://cdn.ckeditor.com/ckeditor5/23.1.0/classic/ckeditor.js"></script>

        <!-- by node_modules -->
        <?php
            if(isset($node_modules)) {
        ?>
        <script type="text/javascript" src="<?=base_url()?>back/node_modules/<?=$node_modules?>"></script>
        <?php
            }
        ?>

        <!-- Custom inline -->
        <script type="text/javascript">
            const base_url = '<?=base_url()?>'
            const base_api_url = '<?=BASE_API_URL?>'
        </script>

        <!-- RMY Library -->
        <script src="<?=base_url()?>back/assets/js/RMYLibrary.js?v=<?=time()?>"></script>

        <!-- custom script -->
        <script type="text/javascript" src="<?=base_url()?>back/assets/js/<?=$script?>?v=<?=time()?>"></script>

    </body>

</html>