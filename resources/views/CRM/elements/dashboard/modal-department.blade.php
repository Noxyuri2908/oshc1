<div class="modal fade user-information" id="modal_department" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Choose department</h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span class="font-weight-light" aria-hidden="true">&times;</span>
        </button>
      </div>
      <form role="form" action="#" method="POST">
      @csrf
      <div class="modal-body">
        <div class="content-information">
          <div class="row">
            <div class="col-md-12 content-table">
              <div class="form-group">
                <label class="control-label">Department:</label>
                <select class="form-control" name="department_id" id="department_id" required>
                  <option value = "1"> HA NOI</option>
                  <option value = "0"> HO CHI MINH</option>
                </select>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button class="btn btn-success mr-1 mb-1" type="submit">Apply</button>
        <button class="btn btn-danger mr-1 mb-1" type="button" data-dismiss="modal">Close</button>
      </div>
      </form>
    </div>
  </div>
</div>