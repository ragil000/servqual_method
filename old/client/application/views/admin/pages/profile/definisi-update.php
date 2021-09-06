<div class="row mt-5">
    <div class="col-12">
        <form method="POST" action="<?=base_url('admin/profile/put/'.$slug.'/').$id?>">
            <div class="card shadow">
                <div class="card-header border-0">
                    <h1><?=$head?></h1>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <div class="input-group">
                                    <input type="text" class="form-control text-default" name="title" placeholder="Judul" aria-label="Username" aria-describedby="basic-addon1" value="<?=$data[0]['title']?>">
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <textarea id="editor" name="content" placeholder="Tuliskan disini" autofocus><?=$data[0]['content']?></textarea>                
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 text-right">
                            <button type="button" onclick="window.location='<?=base_url('admin/profile/').$slug?>'" class="btn btn-warning mt-4">Kembali</button>
                            <button type="submit" class="btn btn-default mt-4">Simpan</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>