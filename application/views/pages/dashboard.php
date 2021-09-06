<div class="row">
  <div class="col-12">
    <div class="card shadow">
      <div class="card-header border-0">
        <div class="row">
          <div class="col-lg-3">
            <h3 class="mb-0 mt-2"><?=$title?></h3>
          </div>
        </div>
      </div>
      
      <div class="card-footer py-4">
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
                <div class="modal-body" style="overflow-y: scroll; height:400px;">
                    <h3 id="title">Title</h3>
                    <h6><span id="date"><i class="ni ni-watch-time"></i> 20 Jan 2020</span></h6>
                    <div id="image"></div>
                    <div id="content"class="text-medium"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary btn-sm" data-dismiss="modal">Keluar</button>
                </div>
            </div>
        </div>
    </div>
  </div>
</div>