<div class="row mt-5">
    <div class="col-12">
        <form method="POST" action="<?=base_url('quast/postQuast/')?>" onsubmit="return validateForm()">
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
                                <input type="text" class="form-control rmy-validation text-default" name="title" maxlength="100" placeholder="Judul" aria-label="Judul" aria-describedby="basic-addon1">
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <input type="text" class="form-control rmy-validation text-default" name="link" placeholder="Link" aria-label="Link" aria-describedby="basic-addon1">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 text-right">
                            <button type="button" onclick="window.location='<?=base_url('quast')?>'" class="btn btn-warning mt-4">Kembali</button>
                            <button type="submit" class="btn btn-default mt-4">Simpan</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>