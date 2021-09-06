<div class="row mt-5">
    <div class="col-12">
        <form method="POST" action="<?=base_url('content/postTentang/')?>" enctype="multipart/form-data" onsubmit="return validateForm()">
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
                                <input type="text" class="form-control rmy-validation text-default" name="title" placeholder="Judul" aria-label="Judul" aria-describedby="basic-addon1">
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <div class="custom-file">
                                    <input type="file" name="file" id="input-image" class="custom-file-input rmy-validation" data-mime="image/jpeg, image/png" lang="en">
                                    <label class="custom-file-label" for="input-image">Pilih gambar</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <input type="text" class="form-control text-default" name="youtube" placeholder="Link Youtube" aria-label="Link Youtube" aria-describedby="basic-addon1">
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <textarea id="editor" class="rmy-validation" name="description" placeholder="Tuliskan disini" autofocus></textarea>                
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 text-right">
                            <button type="button" onclick="window.location='<?=base_url('content/tentang')?>'" class="btn btn-warning mt-4">Kembali</button>
                            <button type="submit" class="btn btn-default mt-4">Simpan</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>