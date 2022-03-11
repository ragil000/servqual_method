<div class="row mt-5">
    <div class="col-12">
        <form method="POST" action="<?= base_url('questionnaire/questionnaire/post') ?>" onsubmit="return validateForm()">
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
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="start_periode" class="form-control-label">Periode Awal</label>
                                <input class="form-control rmy-validation" type="date" name="start_periode" value="<?= date('Y-m-d') ?>" id="start_periode">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="end_periode" class="form-control-label">Periode Akhir</label>
                                <input class="form-control rmy-validation" type="date" name="end_periode" value="<?= date('Y-m-d', strtotime('+1 month')) ?>" id="end_periode">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 text-right">
                            <button type="button" onclick="window.location='<?= base_url('questionnaire/questionnaire') ?>'" class="btn btn-warning btn-icon mt-4"><span class="btn-inner--icon"><i class="ni ni-bold-left"></i></span> Kembali</button>
                            <button type="submit" class="btn btn-default btn-icon mt-4"><span class="btn-inner--icon"><i class="ni ni-cloud-upload-96"></i></span> Simpan</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>