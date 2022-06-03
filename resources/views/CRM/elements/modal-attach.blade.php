<!-- Modal-->
<div class="modal fade" id="crm-attachModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="attach-modal-title">Bạn muốn gán học viên đã chọn.</h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span class="font-weight-light" aria-hidden="true">&times;</span></button>
      </div>
      <div class="modal-footer">
        <button class="btn btn-secondary" type="button" data-dismiss="modal">Close</button>
        <form id="form-attach-modal" action="" method="POST">
          @csrf
          <input type="hidden" name="data_attach" id="data-attach">
          <input type="hidden" name="data_user" id="data-user">
          <button type="submit" class="btn btn-danger">Thực hiện</button>
        </form>
      </div>
    </div>
  </div>
</div>