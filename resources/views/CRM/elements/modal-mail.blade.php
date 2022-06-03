<!-- Modal-->
<div class="modal fade" id="crm-emailModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="send-data-title">Bạn muốn gửi email cho các học viên đã chọn.</h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span class="font-weight-light" aria-hidden="true">&times;</span></button>
      </div>
      <div class="modal-footer">
        <button class="btn btn-secondary" style="background:#9da9bb" type="button" data-dismiss="modal">Close</button>
        <form id="form-modal-mail" action="" method="POST">
          @csrf
          <input type="hidden" name="page_id" id="page-id" value=1>
          <input type="hidden" name="data_email" id="data-email">
          <input type="hidden" name="send_data_type" id="send-data-type">
          <button type="submit" class="btn btn-danger">Thực hiện</button>
        </form>
      </div>
    </div>
  </div>
</div>