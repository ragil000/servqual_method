<div class="row mt-5">
    <div class="col-12">
        <form method="POST" action="<?=base_url('analysis/ranking/list')?>" onsubmit="return validateForm()">
            <div class="card shadow">
                <div class="card-header border-0">
                    <h1><?= $head ?></h1>
                </div>
                <div class="card-body">
                    <?php
                    if ($this->session->userdata('flash_message')) {
                    ?>
                        <div class="alert alert-<?= $this->session->userdata('status') ?>" role="alert">
                            <?= $this->session->userdata('message') ?>
                        </div>
                    <?php
                    }
                    ?>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <select class="form-control select2 rmy-validation" type="select" name="questionnaire_id" id="questionnaire_id">
                                    <!-- <option>2</option>
                                    <option>3</option>
                                    <option>4</option>
                                    <option>5</option> -->
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 text-right">
                            <button type="submit" class="btn btn-default tn-icon mt-4"><span class="btn-inner--icon"><i class="ni ni-chart-bar-32"></i></span> Lihat</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>