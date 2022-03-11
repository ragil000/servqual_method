                <div class="row">
                    <div class="col-12">
                        <div class="card shadow">
                            <div class="card-header border-0">
                                <div class="row">
                                    <div class="col-lg-3">
                                        <h3 class="mb-0 mt-2"><?= $title ?></h3>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <select class="form-control select2" name="questionnaire_id" onchange="changeData('<?=base_url('questionnaire/question')?>', {'questionnaire_id': {'type': 'select', 'id': 'questionnaire_id'}})" id="questionnaire_id">
                                                <?php
                                                $is_delete = '';
                                                if($current_questionnaire->status) {
                                                    if($current_questionnaire->data->is_publish == 'yes') $is_delete = 'disabled';
                                                ?>
                                                <option selected value="<?=$current_questionnaire->data->_id?>"><?=_dateShortID($current_questionnaire->data->start_periode, false).' / '._dateShortID($current_questionnaire->data->end_periode, false).($current_questionnaire->data->status == 'active' ? ' (aktif)' : '')?></option>
                                                <?php
                                                }
                                                ?>
                                                <!-- <option>2</option>
                                                <option>3</option>
                                                <option>4</option>
                                                <option>5</option> -->
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-5 text-left">
                                        <a href="<?= base_url('questionnaire/question/create') ?>" class="btn btn-primary btn-icon <?=$is_delete?>"><span class="btn-inner--icon"><i class="ni ni-single-copy-04"></i></span> Tambah</a>
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
                                            <th scope="col">Pertanyaan</th>
                                            <th scope="col">Dimensi</th>
                                            <th scope="col"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if (!empty($data)) {
                                            foreach ($data as $value) {
                                        ?>
                                                <tr>
                                                    <td><a href="#" onclick="detailModal(this)" data-value="<?=$value->question?>" data-toggle="tooltip" data-placement="top" title="Klik untuk melihat detail"><?= _limitText($value->question, 80) ?></a></td>
                                                    <td><a href="#" onclick="detailModal(this)" data-value="<?=$value->dimension_description?>" data-toggle="tooltip" data-placement="top" title="Klik untuk melihat detail"><?= $value->dimension_title ?></a></td>
                                                    <td class="text-right">
                                                        <a href="<?= base_url('questionnaire/question/create?_id='.urlencode(_encrypt($value->_id, 'penyihir-cinta', true))) ?>" class="btn btn-sm btn-info <?=$is_delete?>" data-toggle="tooltip" data-placement="top" title="Ubah data"><i class="ni ni-settings-gear-65"></i></a>
                                                        <a href="#" class="btn btn-sm btn-danger <?=$is_delete?>" data-toggle="tooltip" data-placement="top" title="Hapus data" onclick="beforeDelete('<?= base_url('questionnaire/question/delete?_id='.urlencode(_encrypt($value->_id, 'penyihir-cinta', true))) ?>')"><i class="fa fa-trash"></i></a>
                                                    </td>
                                                </tr>
                                            <?php
                                            }
                                        } else {
                                            ?>
                                            <tr>
                                                <td colspan="5" class="text-center">
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
                    <!-- Modal -->
                    <div class="col-12">
                        <div class="modal fade" id="detail-modal" tabindex="-1" role="dialog" aria-labelledby="detail-modal-label" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="detail-modal-label">Detail</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body" style="overflow-y: scroll;">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="form-group">
                                                    <h3 id="question2">...</h3>
                                                </div>
                                            </div>
                                            <div class="col-lg-12" id="answers">

                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-primary btn-sm" data-dismiss="modal">Keluar</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>