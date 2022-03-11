<div class="row mt-5">
    <div class="col-12">
        <form method="POST" action="<?=isset($old_data) ? base_url('questionnaire/question/put') : base_url('questionnaire/question/post')?>" onsubmit="return validateForm()">
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
                        <input type="text" name="lab_id" value="<?=isset($old_data) ? $old_data->lab_id : ''?>" hidden>
                        <input type="text" name="questionnaire_id" value="<?=isset($old_data) ? $old_data->questionnaire_id : ''?>" hidden>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <select type="select" class="form-control rmy-validation select2" name="dimension_id" id="dimension_id">
                                    <?php
                                        if(isset($old_data)) {
                                            echo '<option value="'.$old_data->dimension_id.'" selected>'.$old_data->dimension_title.'</option>';
                                        }
                                    ?>
                                    <!-- <option>2</option>
                                    <option>3</option>
                                    <option>4</option>
                                    <option>5</option> -->
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-8">
                            <div class="form-group">
                                <input type="text" class="form-control rmy-validation text-default" name="question" placeholder="Pertanyaan" aria-label="Pertanyaan" aria-describedby="basic-addon1" value="<?=isset($old_data) ? $old_data->question : ''?>">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 text-right">
                            <button type="button" onclick="window.location='<?= base_url('questionnaire/question') ?>'" class="btn btn-warning btn-icon mt-4"><span class="btn-inner--icon"><i class="ni ni-bold-left"></i></span> Kembali</button>
                            <button type="submit" class="btn btn-default btn-icon mt-4"><span class="btn-inner--icon"><i class="ni ni-cloud-upload-96"></i></span> Simpan</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>