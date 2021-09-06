<div class="row mt-5">
    <div class="col-12">
        <form method="POST" action="<?=base_url('quist/postQuist/')?>" onsubmit="return validateForm()">
            <div class="card shadow">
                <div class="card-header border-0">
                    <h1><?=$head?></h1>
                </div>
                <div class="card-body">
                    <?php
                        if($this->session->userdata('flash_message')) {
                    ?>
                    <div class="alert alert-<?=$this->session->userdata('status')?>" role="alert">
                        <?=$this->session->userdata('message')?>
                    </div>
                    <?php
                        }
                    ?>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <input type="text" class="form-control rmy-validation text-default" name="question" maxlength="350" placeholder="Pertanyaan" aria-label="Pertanyaan" aria-describedby="basic-addon1">
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="customRadioInline1" name="is_correct" value="0" class="custom-control-input form-control rmy-validation">
                                    <label class="custom-control-label" for="customRadioInline1">
                                        <input type="text" class="form-control form-control-sm rmy-validation text-default" name="answer_a" maxlength="45" placeholder="Jawaban" aria-label="Jawaban" aria-describedby="basic-addon1">
                                    </label>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="customRadioInline2" name="is_correct" value="1" class="custom-control-input form-control rmy-validation">
                                    <label class="custom-control-label" for="customRadioInline2">
                                        <input type="text" class="form-control form-control-sm rmy-validation text-default" name="answer_b" maxlength="45" placeholder="Jawaban" aria-label="Jawaban" aria-describedby="basic-addon1">
                                    </label>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="customRadioInline3" name="is_correct" value="2" class="custom-control-input form-control rmy-validation">
                                    <label class="custom-control-label" for="customRadioInline3">
                                        <input type="text" class="form-control form-control-sm rmy-validation text-default" name="answer_c" maxlength="45" placeholder="Jawaban" aria-label="Jawaban" aria-describedby="basic-addon1">
                                    </label>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="customRadioInline4" name="is_correct" value="3" class="custom-control-input form-control rmy-validation">
                                    <label class="custom-control-label" for="customRadioInline4">
                                        <input type="text" class="form-control form-control-sm rmy-validation text-default" name="answer_d" maxlength="45" placeholder="Jawaban" aria-label="Jawaban" aria-describedby="basic-addon1">
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 text-right">
                            <button type="button" onclick="window.location='<?=base_url('quist')?>'" class="btn btn-warning mt-4">Kembali</button>
                            <button type="submit" class="btn btn-default mt-4">Simpan</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>