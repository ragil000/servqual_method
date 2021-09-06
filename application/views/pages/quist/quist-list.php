<div class="row">
  <div class="col-12">
    <div class="card shadow">
      <div class="card-header border-0">
        <div class="row">
          <div class="col-lg-3">
            <h3 class="mb-0 mt-2"><?=$title?></h3>
          </div>
          <div class="col-lg-9 text-left">
            <a href="<?=base_url('quist/createQuist/')?>" class="btn btn-primary"><i class="ni ni-single-copy-04"></i> Tambah</a>
          </div>
        </div>
      </div>
      <div class="table-responsive">
        <?php
            if($this->session->userdata('flash_message')) {
        ?>
        <div class="alert alert-<?=$this->session->userdata('status')?>" role="alert">
            <?=$this->session->userdata('message')?>
        </div>
        <?php
            }
        ?>
        <table class="table align-items-center table-flush">
          <thead class="thead-light">
            <tr>
              <th scope="col">Pertanyaan</th>
              <th scope="col">Jawaban</th>
              <th scope="col"></th>
            </tr>
          </thead>
          <tbody>
              <?php
                if(!empty($data)) {
                  foreach($data as $value) {
              ?>
              <tr>
                  <td><?=_limitText($value->question, 80)?></td>
                  <td><?=_limitText($value->correct_answer, 80)?></td>
                  <td class="text-right">
                      <!-- <a href="<?=base_url('/news/detail/'.$value->slug)?>" target="_blank" class="btn btn-sm btn-primary"><i class="fa fa-eye"></i></a> -->
                      <a href="#" class="btn btn-sm btn-warning" onclick="detailModal('<?=$value->_id?>')"><i class="fa fa-eye"></i></a>
                      <a href="#" class="btn btn-sm btn-danger" onclick="beforeDelete('<?=$value->_id?>')"><i class="fa fa-trash"></i></a>
                  </td>
              </tr>
              <?php
                    }
                  }else {
              ?>
              <tr>
                <td colspan="5" class="text-center"><h3>Data kosong.</h3></td>
              </tr>
              <?php
                  }
              ?>
              <button type="button" id="button-detail-modal" data-toggle="modal" data-target="#detail-modal" hidden></button>
          </tbody>
        </table>
      </div>
      <div class="card-footer py-4">
        <?=$pagination?>
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