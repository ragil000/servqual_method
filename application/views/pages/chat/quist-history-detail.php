<div class="row mt-5">
    <div class="col-12">
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
                    <?php
                        if(!empty($data)) {
                            $no = 1;
                            foreach($data as $value) {
                    ?>
                    <div class="col-lg-12">
                        <div class="form-group">
                            <p><span class="badge badge-danger"><?=$no?>.</span> <strong><?=$value->question?></strong></p>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <?php
                            $radioId = 0;
                            foreach($value->answers as $answer) {
                        ?>
                        <div class="form-group">
                            <div class="custom-control custom-radio">
                                <input type="radio" id="customRadioInline<?=$radioId?>" value="0" <?=$answer->_id == $value->answer_id ? 'checked' : 'disabled'?> class="custom-control-input form-control rmy-validation">
                                <label class="custom-control-label" for="customRadioInline<?=$radioId?>"><?=$answer->answer?> <?=$answer->is_correct == 'yes' ? '<span class="badge badge-success">benar</span>' : ''?></label>
                            </div>
                        </div>
                        <?php
                                $radioId++;
                            }
                        ?>
                    </div>
                    <?php
                                $no++;
                            }
                        }
                    ?>
                </div>
                <div class="row">
                    <div class="col-lg-12 text-right">
                        <button type="button" onclick="window.location='<?=base_url('quist/history')?>'" class="btn btn-warning mt-4">Kembali</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>