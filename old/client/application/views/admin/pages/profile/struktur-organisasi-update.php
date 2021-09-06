<div class="row mt-5">
    <div class="col-12">
        <form method="POST" action="<?=base_url('admin/profile/put/'.$slug.'/').$id?>" enctype="multipart/form-data" onsubmit="return validateForm()">
            <div class="card shadow">
                <div class="card-header border-0">
                    <h1><?=$head?></h1>
                </div>
                <div class="card-body">
                    <?php
                        if(isset($_SESSION['flash_message'])) {
                    ?>
                    <div class="alert alert-<?=@$_SESSION['status']?>" role="alert">
                        <?=@$_SESSION['message']?>
                    </div>
                    <?php
                        }
                    ?>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <input type="text" class="form-control rmy-validation text-default" name="title" placeholder="Judul" aria-label="Username" aria-describedby="basic-addon1" value="<?=$data[0]['title']?>">
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <div class="custom-file">
                                    <input type="file" name="file" id="input-image" class="custom-file-input rmy-validation" data-mime="image/jpeg, image/png" lang="en" value="<?=$data[0]['file']?>">
                                    <label class="custom-file-label" for="input-image"><?=$data[0]['file']?></label>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <textarea id="editor" class="rmy-validation" name="content" placeholder="Tuliskan disini" autofocus><?=$data[0]['content']?></textarea>                
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 text-right">
                            <button type="button" onclick="window.location='<?=base_url('admin/profile/').$slug?>'" class="btn btn-warning mt-4">Kembali</button>
                            <button type="submit" class="btn btn-default mt-4">Simpan</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>