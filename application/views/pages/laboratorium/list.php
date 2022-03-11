                <div class="row">
                    <div class="col-12">
                        <div class="card shadow">
                            <div class="card-header border-0">
                                <div class="row">
                                    <div class="col-lg-3">
                                        <h3 class="mb-0 mt-2"><?= $title ?></h3>
                                    </div>
                                    <div class="col-lg-9 text-left">
                                        <a href="<?= base_url('laboratorium/create') ?>" class="btn btn-primary btn-icon"><span class="btn-inner--icon"><i class="ni ni-single-copy-04"></i></span> Tambah</a>
                                    </div>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <?php
                                if ($this->session->userdata('flash_message')) {
                                ?>
                                    <div class="alert alert-<?= $this->session->userdata('status') ?>" role="alert">
                                        <?= $this->session->userdata('message') ?>
                                    </div>
                                <?php
                                }
                                ?>
                                <table class="table align-items-center table-flush">
                                    <thead class="thead-light">
                                        <tr>
                                            <th scope="col">Nama</th>
                                            <th scope="col"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if (!empty($data)) {
                                            foreach ($data as $value) {
                                        ?>
                                                <tr>
                                                    <td><?= $value->title ?></td>
                                                    <td class="text-right">
                                                        <a href="<?= base_url('laboratorium/create?_id='.urlencode(_encrypt($value->_id, 'penyihir-cinta', true))) ?>" class="btn btn-sm btn-info" data-toggle="tooltip" data-placement="top" title="Ubah data"><i class="ni ni-settings-gear-65"></i></a>
                                                        <a href="#" class="btn btn-sm btn-danger" data-toggle="tooltip" data-placement="top" title="Hapus data" onclick="beforeDelete('<?= base_url('laboratorium/delete?_id='.urlencode(_encrypt($value->_id, 'penyihir-cinta', true))) ?>')"><i class="fa fa-trash"></i></a>
                                                    </td>
                                                </tr>
                                            <?php
                                            }
                                        } else {
                                            ?>
                                            <tr>
                                                <td colspan="2" class="text-center">
                                                    <h3>Data kosong.</h3>
                                                </td>
                                            </tr>
                                        <?php
                                        }
                                        ?>
                                        <button type="button" id="button-detail-modal" data-toggle="modal" data-target="#detail-modal" hidden></button>
                                    </tbody>
                                </table>
                            </div>
                            <div class="card-footer py-4">
                                <?= $pagination ?>
                                <!-- <nav aria-label="...">
                            <ul class="pagination justify-content-end mb-0">
                                <li class="page-item disabled">
                                    <a class="page-link" href="#" tabindex="-1">
                                        <i class="fas fa-angle-left"></i>
                                        <span class="sr-only">Previous</span>
                                    </a>
                                </li>
                                <li class="page-item active">
                                    <a class="page-link" href="#">1</a>
                                </li>
                                <li class="page-item">
                                    <a class="page-link" href="#">2 <span class="sr-only">(current)</span></a>
                                </li>
                                <li class="page-item"><a class="page-link" href="#">3</a></li>
                                <li class="page-item">
                                    <a class="page-link" href="#">
                                        <i class="fas fa-angle-right"></i>
                                        <span class="sr-only">Next</span>
                                    </a>
                                </li>
                            </ul>
                        </nav> -->
                            </div>
                        </div>
                    </div>