<div class="row mt-5">
    <div class="col-12">
        <form method="POST" action="<?=isset($old_data) ? base_url('laboratorium/put') : base_url('laboratorium/post')?>" onsubmit="return validateForm()">
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
                        <input type="text" name="_id" value="<?=isset($old_data) ? $old_data->_id : ''?>" hidden>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <input type="text" class="form-control rmy-validation text-default" name="title" placeholder="Nama" aria-label="Nama" aria-describedby="basic-addon1" value="<?=isset($old_data) ? $old_data->title : ''?>">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 text-right">
                            <button type="button" onclick="window.location='<?= base_url('laboratorium') ?>'" class="btn btn-warning btn-icon mt-4"><span class="btn-inner--icon"><i class="ni ni-bold-left"></i></span> Kembali</button>
                            <button type="submit" class="btn btn-default btn-icon mt-4"><span class="btn-inner--icon"><i class="ni ni-cloud-upload-96"></i></span> Simpan</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>