                <div class="row">
                    <div class="col-12">
                        <div class="card shadow">
                            <div class="card-header border-0">
                                <div class="row">
                                    <div class="col-lg-3">
                                        <h3 class="mb-0 mt-2"><?= $title ?></h3>
                                    </div>
                                    <div class="col-lg-9 text-left">
                                        <a href="<?= base_url('questionnaire/questionnaire/create') ?>" class="btn btn-primary btn-icon"><span class="btn-inner--icon"><i class="ni ni-single-copy-04"></i></span> Tambah</a>
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
                                            <th scope="col">Periode</th>
                                            <?php
                                                if($this->session->userdata('role') == 'super') {

                                            ?>
                                            <th scope="col">Lab</th>
                                            <?php
                                                }else {
                                            ?>
                                            <th scope="col">Tipe</th>
                                            <?php
                                                }
                                            ?>
                                            <th scope="col">Status</th>
                                            <th scope="col"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $is_active = [
                                            'active' => 'Aktif',
                                            'nonactive' => 'Tidak Aktif'
                                        ];

                                        if (!empty($data)) {
                                            $date_now = date('Y-m-d');
                                            foreach ($data as $value) {
                                                $date1 = new DateTime($date_now);
                                                $date2 = new DateTime($value->end_periode);

                                                $end_date = '';
                                                if($date1 > $date2) $end_date = 'class="text-danger" data-toggle="tooltip" data-placement="right" title="Kuesioner sudah kadaluarsa (user tidak akan bisa mengisi kuesioner ini lagi)"';
                                                $is_disabled = '';
                                                if(($value->created_by_role == 'admin' && $this->session->userdata('role') == 'super') || ($value->created_by_role == 'super' && $this->session->userdata('role') == 'admin')) $is_disabled = 'disabled';

                                                $is_delete = '';
                                                $is_publish = '';
                                                $is_activate = '';
                                                $is_nonactivate = '';
                                                $see_as_user = 'hidden';
                                                $hidden_pubish_button = '';
                                                if($value->is_publish == 'yes' && $value->status == 'active') {
                                                    $see_as_user = '';
                                                    $hidden_pubish_button = 'hidden';
                                                }
                                                if($value->is_publish == 'yes') $is_publish = 'disabled';
                                                if($value->is_delete == 'no' || ($value->created_by_role == 'admin' && $this->session->userdata('role') == 'super')) $is_delete = 'disabled';
                                                if($value->status == 'active') $is_activate = 'hidden';
                                                if($value->status == 'nonactive') $is_nonactivate = 'hidden';
                                        ?>
                                                <tr>
                                                    <td><span <?= $end_date ?>><?= _dateShortID($value->start_periode, false) . ' / ' . _dateShortID($value->end_periode, false) ?></span></td>
                                                    <?php
                                                        if($this->session->userdata('role') == 'super') {
                                                    ?>
                                                    <td><?= $value->group_id ? '<span class="text-warning"><a href="#" onclick="detailModal(this)" data-id="'.$value->group_id.'" data-toggle="tooltip" data-placement="top" title="Klik untuk melihat detail">bersama lab lain</a></span>' : $value->lab_title ?></td>
                                                    <?php
                                                        }else {
                                                    ?>
                                                    <td><?= $value->group_id ? '<span class="text-warning"><a href="#" onclick="detailModal(this)" data-id="'.$value->group_id.'" data-toggle="tooltip" data-placement="top" title="Klik untuk melihat detail">bersama lab lain</a></span>' : '<span class="text-info">hanya lab ini</span>' ?></td>
                                                    <?php
                                                        }
                                                    ?>
                                                    <td><?= $is_active[$value->status] ?></td>
                                                    <td class="text-right">
                                                        <a href="#" class="btn btn-sm btn-info <?=$is_disabled?> <?=$is_publish?>" <?=$hidden_pubish_button?> data-toggle="tooltip" data-placement="top" title="Publish data" onclick="beforePublish('<?= base_url('questionnaire/questionnaire/publish?_id='.urlencode(_encrypt($value->_id, 'penyihir-cinta', true))) ?>')"><i class="ni ni-notification-70"></i></a>
                                                        <a href="<?= base_url('as_user?questionnaire_id='.urlencode(_encrypt($value->_id, 'penyihir-cinta', true))) ?>" target="_blank" class="btn btn-sm btn-info" <?=$see_as_user?> data-toggle="tooltip" data-placement="top" title="Lihat sebagai user"><i class="ni ni-send"></i></a>
                                                        <a href="#" onclick="copyText('<?= base_url('as_user?questionnaire_id='.urlencode(_encrypt($value->_id, 'penyihir-cinta', true))) ?>')" class="btn btn-sm btn-success" <?=$see_as_user?> data-toggle="tooltip" data-placement="top" title="Salin url"><i class="ni ni-ungroup"></i></a>
                                                        <a href="#" class="btn btn-sm btn-primary <?=($value->group_id ? $is_disabled : '')?>" <?=$is_activate?> data-toggle="tooltip" data-placement="top" title="Aktifkan data" onclick="beforeActivate('<?= base_url('questionnaire/questionnaire/activate?_id='.urlencode(_encrypt($value->_id, 'penyihir-cinta', true))) ?>')"><i class="ni ni-button-play"></i></a>
                                                        <a href="#" class="btn btn-sm btn-primary <?=($value->group_id ? $is_disabled : '')?>" <?=$is_nonactivate?> data-toggle="tooltip" data-placement="top" title="Non-aktifkan data" onclick="beforeNonactivate('<?= base_url('questionnaire/questionnaire/nonactivate?_id='.urlencode(_encrypt($value->_id, 'penyihir-cinta', true))) ?>')"><i class="ni ni-button-pause"></i></a>
                                                        <a href="#" class="btn btn-sm btn-warning" data-toggle="tooltip" data-placement="top" title="Lihat list pertanyaan" onclick="detail('<?= base_url('questionnaire/question?questionnaire_id='.urlencode(_encrypt($value->_id, 'penyihir-cinta', true))) ?>')"><i class="fa fa-eye"></i></a>
                                                        <a href="#" class="btn btn-sm btn-danger <?=$is_disabled?> <?=$is_delete?>" data-toggle="tooltip" data-placement="top" title="Hapus data" onclick="beforeDelete('<?= base_url('questionnaire/questionnaire/delete?_id='.urlencode(_encrypt($value->_id, 'penyihir-cinta', true))) ?>')"><i class="fa fa-trash"></i></a>
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