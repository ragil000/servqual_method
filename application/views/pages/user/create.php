<div class="row mt-5">
    <div class="col-12">
        <form method="POST" action="<?=isset($old_data) ? base_url('user/put') : base_url('user/post')?>" onsubmit="return validateForm()">
            <div class="card shadow">
                <div class="card-header border-0">
                    <h1><?= $head ?></h1>
                </div>
                <div class="card-body">
                    <?php
                    $role = $this->input->get('role');
                    $is_admin = 'hidden';
                    $lab_validation = '';
                    if($role) {
                        if($role == 'admin') {
                            $is_admin = '';
                            $lab_validation = 'rmy-validation';
                        }
                    }

                    $password_validation = 'rmy-validation';
                    if(isset($old_data)) {
                        $password_validation = '';
                    }
                    if ($this->session->userdata('flash_message')) {
                    ?>
                        <div class="alert alert-<?= $this->session->userdata('status') ?>" role="alert">
                            <?= $this->session->userdata('message') ?>
                        </div>
                    <?php
                    }
                    ?>
                    <div class="row">
                        <input type="text" name="role" value="<?=$role?>" hidden>
                        <input type="text" name="_id" value="<?=isset($old_data) ? $old_data->_id : ''?>" hidden>
                        <div class="col-lg-12" <?=$is_admin?>>
                            <div class="form-group">
                                <select type="select" class="form-control <?=$lab_validation?> select2" name="lab_id" id="lab_id">
                                    <?php
                                        if(isset($old_data)) {
                                            echo '<option value="'.$old_data->lab_id.'" selected>'.$old_data->lab_title.'</option>';
                                        }
                                    ?>
                                    <!-- <option>2</option>
                                    <option>3</option>
                                    <option>4</option>
                                    <option>5</option> -->
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <input type="text" class="form-control rmy-validation text-default" name="username" placeholder="Username" aria-label="Username" aria-describedby="basic-addon1" value="<?=isset($old_data) ? $old_data->username : ''?>">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <input type="password" class="form-control <?=$password_validation?> text-default" name="password" placeholder="Password" aria-label="Password" aria-describedby="basic-addon1" value="">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 text-right">
                            <button type="button" onclick="window.location='<?= base_url('user?role='.$role) ?>'" class="btn btn-warning btn-icon mt-4"><span class="btn-inner--icon"><i class="ni ni-bold-left"></i></span> Kembali</button>
                            <button type="submit" class="btn btn-default btn-icon mt-4"><span class="btn-inner--icon"><i class="ni ni-cloud-upload-96"></i></span> Simpan</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
    const ROLE = '<?=$this->input->get('role')?>' || 'admin';
</script>