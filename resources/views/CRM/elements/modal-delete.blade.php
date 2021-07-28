<!-- Modal-->
<div class="modal fade" id="crm-deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Bạn có muốn xóa dữ liệu đã chọn !</h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span class="font-weight-light" aria-hidden="true">&times;</span></button>
      </div>
      <div class="modal-footer">
        <button class="btn" style="background:#9da9bb" type="button" data-dismiss="modal">Close</button>
        <form id="form-delete-modal" action="" method="POST">
          @csrf
          <input type="hidden" name="page_id" value=1 id="page-id">
          <input type="hidden" name="data_del" id="data-del">
          <button type="submit" class="btn btn-danger">Delete</button>
        </form>
      </div>
    </div>
  </div>
</div>