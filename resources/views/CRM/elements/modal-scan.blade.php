<!-- Modal-->
<div class="modal fade" id="crm-scanModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <form id="form-scan-modal" action="" method="POST">
    @csrf
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="attach-modal-title">Nhập ngày (nhập học hoặc hoàn thiện hồ sơ): </h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span class="font-weight-light" aria-hidden="true">&times;</span></button>
        </div>
        <div class="modal-body">
          <input type="hidden" name="page_id" id="page-id" value=1>
         
          <div class="form-group">
            <label for="data_ngaybatdau">Ngày bắt đầu nhập học</label>
            <input class="form-control" name="data_ngaybatdau" placehoder="Ngày bắt đầu nhập học" type="text" required>
          </div>
          <div class="form-group">
             <label for="data_ngayketthuc">Ngày cuối cùng nhập học</label>
            <input class="form-control" name="data_ngayketthuc" placehoder="Ngày cuối cùng nhập học" type="text" required>
            <input type="hidden" name="data_scan" id="data-scan">
            <input type="hidden" name="data_type" id="data-type">
          </div>
        </div>
        <div class="modal-footer">
          <button class="btn" style="background:#9da9bb" type="button" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-danger">In giấy</button>  
        </div>
      </div>
    </div>
  </form>
</div>