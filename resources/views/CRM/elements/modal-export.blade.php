<!-- Modal-->
<div class="modal fade" id="crm-exportModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <form id="form-export-modal" action="" method="POST">
    @csrf
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="attach-modal-title">Nhập tên file bạn muốn xuất ra: </h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span class="font-weight-light" aria-hidden="true">&times;</span></button>
        </div>
        <div class="modal-body">
          <input type="hidden" name="data_export" id="data-export-cq">
          <div class="form-group">
            <input class="form-control" name="namefile" placehoder="Danh_sach_hoc_vien_chinh_quy_xxxxx" type="text" required>
          </div>
        </div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-danger">Thực hiện</button>  
        </div>
      </div>
    </div>
  </form>
</div>