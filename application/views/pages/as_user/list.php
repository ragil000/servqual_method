                                        <?php
                                            $session_user = $this->session->userdata('session_user');
                                            $lab_id = null;
                                            $questionnaire_id = null;
                                            $lab = '-';
                                            $periode = '-';
                                            $total_data = 0;
                                            if($data->status) {
                                                $periode = _dateShortID($data->data[0]->questionnaire_start_periode, false) . ' / ' . _dateShortID($data->data[0]->questionnaire_end_periode, false);
                                                $lab_id = $data->data[0]->lab_id;
                                                $questionnaire_id = $data->data[0]->questionnaire_id;
                                                $lab = $data->data[0]->lab_title;
                                                $total_data = $data->total_data_displayed;
                                        ?>
                                                <div class="content">
                                                    <div class="page-inner">
                                                        <div class="card m-4 p-4">
                                                            <h4><strong>Kuesioner Penilaian Kualitas Pelayanan <span class="text-warning"><?=$lab?></span> Periode <span class="text-warning"><?=$periode?></span></strong></h4>
                                                            <p>Kuesioner ini dimaksudkan untuk melakukan penilaian kulitas pelayanan <span class="text-warning"><?=$lab?></span>. Hasil dari perhitungan skor pada kuesioner ini akan menjadi bahan evaluasi pengurus laboratorium #Jaringan# dan pihak yang terkait untuk meningkatkan kualitas layanan kedepan. </p>
                                                            <p class="text-small text-danger">* Mohon diisi sesuai dengan harapan dan kenyataan yang anda alami selama menggunakan layanan kami.</p>
                                                            <form action="<?=base_url('as_user/post')?>" method="post" onsubmit="return validateForm()">
                                                                <div class="row">
                                                                    <div class="col-12 mb-4">
                                                                        <div class="card bg-active">
                                                                            <div class="card-body">    
                                                                                
                                                                                <div class="row">
                                                                                    <div class="col-lg-12 text-center">
                                                                                        <h3><?=$session_user ? '<span style="text-transform:uppercase">'.$session_user['user_name'].'</span>' : 'NaN'?></h3>
                                                                                        <h3><?=$session_user ? '<span style="text-transform:uppercase">'.$session_user['user_nim'].'</span>' : 'NaN'?></h3>
                                                                                        <button type="button" onclick="resetUser()" class="btn btn-sm btn-default mt-4">Reset User</button>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <input type="text" id="total_data" name="total_data" value="<?=$total_data?>" hidden>
                                                                    <input type="text" name="name" value="<?=$session_user ? $session_user['user_name'] : ''?>" hidden>
                                                                    <input type="text" name="nim" value="<?=$session_user ? $session_user['user_nim'] : ''?>" hidden>
                                                                    <input type="text" name="lab_id" value="<?=$lab_id?>" hidden>
                                                                    <input type="text" name="questionnaire_id" value="<?=$questionnaire_id?>" hidden>
                                                                    <?php
                                                                        $no = 1;
                                                                        foreach($data->data as $value) {
                                                                    ?>
                                                                    <input type="text" name="question_id_<?=$no?>" value="<?=$value->_id?>" hidden>
                                                                    <div class="col-12 mb-0 pb-0">
                                                                        <div class="card bg-active mb-2">
                                                                            <div class="card-body pl-3 pr-2 pb-0 pt-3">    
                                                                                <p id="question_<?=$no?>"><span class="badge badge-danger mr-2"><?=$no?></span> <?=$value->question?></p>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-12 mb-4 border">
                                                                        <div class="row">
                                                                            <div class="col-6">
                                                                                <div class="row border">
                                                                                    <div class="col-12 text-center mb-4">
                                                                                        <b>Harapan</b>
                                                                                    </div>
                                                                                    <div class="col-6">
                                                                                        <div class="row">
                                                                                            <div class="col-12 ml-lg-4">
                                                                                                <label class="form-radio-label">
                                                                                                    <input class="form-radio-input" type="radio" name="expectation_answer_<?=$no?>" value="1">
                                                                                                    <span class="form-radio-sign">Sangat Tidak Setuju</span>
                                                                                                </label>
                                                                                            </div>
                                                                                            <div class="col-12 ml-lg-4">
                                                                                                <label class="form-radio-label">
                                                                                                    <input class="form-radio-input" type="radio" name="expectation_answer_<?=$no?>" value="2">
                                                                                                    <span class="form-radio-sign">Tidak Setuju</span>
                                                                                                </label>
                                                                                            </div>
                                                                                            <div class="col-12 ml-lg-4">
                                                                                                <label class="form-radio-label">
                                                                                                    <input class="form-radio-input" type="radio" name="expectation_answer_<?=$no?>" value="3">
                                                                                                    <span class="form-radio-sign">Biasa</span>
                                                                                                </label>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-6">
                                                                                        <div class="row">
                                                                                            <div class="col-12 ml-lg-4">
                                                                                                <label class="form-radio-label">
                                                                                                    <input class="form-radio-input" type="radio" name="expectation_answer_<?=$no?>" value="4">
                                                                                                    <span class="form-radio-sign">Setuju</span>
                                                                                                </label>
                                                                                            </div>
                                                                                            <div class="col-12 ml-lg-4">
                                                                                                <label class="form-radio-label">
                                                                                                    <input class="form-radio-input" type="radio" name="expectation_answer_<?=$no?>" value="5">
                                                                                                    <span class="form-radio-sign">Sangat Setuju</span>
                                                                                                </label>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-6">
                                                                                <div class="row border">
                                                                                    <div class="col-12 text-center mb-4">
                                                                                        <b>Kenyataan</b>
                                                                                    </div>
                                                                                    <div class="col-6">
                                                                                        <div class="row">
                                                                                            <div class="col-12 ml-lg-4">
                                                                                                <label class="form-radio-label">
                                                                                                    <input class="form-radio-input" type="radio" name="reality_answer_<?=$no?>" value="1">
                                                                                                    <span class="form-radio-sign">Sangat Tidak Setuju</span>
                                                                                                </label>
                                                                                            </div>
                                                                                            <div class="col-12 ml-lg-4">
                                                                                                <label class="form-radio-label">
                                                                                                    <input class="form-radio-input" type="radio" name="reality_answer_<?=$no?>" value="2">
                                                                                                    <span class="form-radio-sign">Tidak Setuju</span>
                                                                                                </label>
                                                                                            </div>
                                                                                            <div class="col-12 ml-lg-4">
                                                                                                <label class="form-radio-label">
                                                                                                    <input class="form-radio-input" type="radio" name="reality_answer_<?=$no?>" value="3">
                                                                                                    <span class="form-radio-sign">Biasa</span>
                                                                                                </label>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-6">
                                                                                        <div class="row">
                                                                                            <div class="col-12 ml-lg-4">
                                                                                                <label class="form-radio-label">
                                                                                                    <input class="form-radio-input" type="radio" name="reality_answer_<?=$no?>" value="4">
                                                                                                    <span class="form-radio-sign">Setuju</span>
                                                                                                </label>
                                                                                            </div>
                                                                                            <div class="col-12 ml-lg-4">
                                                                                                <label class="form-radio-label">
                                                                                                    <input class="form-radio-input" type="radio" name="reality_answer_<?=$no?>" value="5">
                                                                                                    <span class="form-radio-sign">Sangat Setuju</span>
                                                                                                </label>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <?php
                                                                            $no++;
                                                                        }
                                                                    ?>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-lg-12 text-right">
                                                                        <button type="submit" class="btn btn-default mt-4">Kirim Jawaban</button>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                        <?php
                                            }else {
                                        ?>
                                                <div class="content">
                                                    <div class="page-inner">
                                                        <div class="card m-4 p-4 text-center">
                                                            <h4><strong>Maaf, saat ini tidak ada kuesioner yang tersedia!</strong></h4>
                                                        </div>
                                                    </div>
                                                </div>
                                        <?php
                                            }
                                        ?>

                                        <!-- Modal -->
                                        <div class="modal fade" id="modalInput" tabindex="-1" role="dialog" aria-labelledby="modalInputLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="modalInputLabel">Modal title</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body" id="modalInputContent">
                                                    ...
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Keluar</button>
                                                </div>
                                                </div>
                                            </div>
                                        </div>

                                        <script>
                                            const IS_DATA_READY = <?=json_encode($data->status)?>;
                                            const SESSION_USER = <?=($this->session->userdata('session_user') ? json_encode($this->session->userdata('session_user')) : json_encode(null))?>;
                                        </script>