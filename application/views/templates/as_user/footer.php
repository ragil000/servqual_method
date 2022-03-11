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

        <!-- by vendor -->
        <?php
        if(isset($js_vendors)) {
            for($i=0; $i<count($js_vendors); $i++) {
        ?>
            <script type="text/javascript" src="<?=base_url()?>back/assets/vendor/<?=$js_vendors[$i]?>"></script>
        <?php
            }
        }
        ?>

        <!-- Custom inline -->
        <script type="text/javascript">
            const base_url = '<?=base_url()?>';
            const sessions = <?=json_encode($this->session->userdata())?>;
        </script>

        <!-- RMY Library -->
        <script src="<?=base_url()?>back/assets/js/RMYLibrary.js?v=<?=time()?>"></script>

        <?php
        if(isset($script)) {
        ?>
            <!-- custom script -->
            <script type="text/javascript" src="<?=base_url()?>back/assets/js/<?=$script?>?v=<?=time()?>"></script>
        <?php
        }
        ?>

    </body>

</html>