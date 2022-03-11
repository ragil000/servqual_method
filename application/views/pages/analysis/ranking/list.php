                <div class="row">
                    <div class="col-12">
                        <div class="card shadow">
                            <div class="card-header border-0">
                            <div class="row">
                                    <div class="col-lg-3">
                                        <h3 class="mb-0 mt-2"><?= $title ?></h3>
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
                                            <th scope="col">Kriteria/Pertanyaan</th>
                                            <th scope="col">Dimensi</th>
                                            <th scope="col" class="text-center">Nilai GAP 5</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if (!empty($data)) {
                                            foreach ($data as $value) {
                                                $expectation_average = round(($value->sum_total_answerer > 0 ? ($value->sum_expectation_answer/$value->sum_total_answerer) : 0), 2);
                                                $reality_average = round(($value->sum_total_answerer > 0 ? ($value->sum_reality_answer/$value->sum_total_answerer) : 0), 2);
                                                $gap5 = $value->sum_total_answerer > 0 ? $reality_average-$expectation_average : 0;
                                                $rating = '';
                                                if($gap5 == 0) {
                                                    $rating = 'Puas terhadap layanan';
                                                }else if($gap5 > 0) {
                                                    $rating = 'Sangat puas terhadap layanan (diskrepansi)';
                                                }else if($gap5 < 0) {
                                                    $rating = 'Kurang puas terhadap layanan';
                                                }
                                        ?>
                                                <tr>
                                                    <td><a href="#" onclick="detailModal(this)" data-value="<?=$value->question?>" data-id="<?=$value->_id?>" data-toggle="tooltip" data-placement="top" title="Klik untuk melihat detail"><?= _limitText($value->question, 55) ?></a></td>
                                                    <td><?= $value->dimension_title ?></td>
                                                    <td class="text-center"><span class="badge badge-success" data-toggle="tooltip" data-placement="left" title="<?=$rating?>"><?= $gap5 ?></span></td>
                                                </tr>
                                            <?php
                                            }
                                        } else {
                                            ?>
                                            <tr>
                                                <td colspan="8" class="text-center">
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