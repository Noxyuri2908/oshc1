<div class="modal fade user-information" id="modal_promotion_add" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add new promotion</h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span class="font-weight-light" aria-hidden="true">&times;</span>
        </button>
      </div>
      <form role="form" action="{{route('promotion.store')}}" method="POST">
      @csrf
      <div class="modal-body">
        <div class="content-information">
          <div class="row">
            <div class="col-md-12 content-table fill_content">
              <div class="form-group">
                <label class="control-label">Campaign:</label>
                <input type="text" id="name" name="name" class="form-control" placeholder="Campaign" required>
              </div>
            </div>
            <div class="col-md-6 content-table fill_content">
              <div class="form-group">
                <label class="control-label">Start date:</label>
                <input type="text" id="start_date" name="start_date" class="form-control" placeholder="Start date" required>
              </div>
            </div>
            <div class="col-md-6 content-table fill_content">
              <div class="form-group">
                <label class="control-label">End date:</label>
                <input type="text" id="end_date" name="end_date" class="form-control" placeholder="End date" required>
              </div>
            </div>
            <div class="col-md-6 content-table">
              <div class="form-group">
                <label class="control-label">Assign for:</label>
                <select class="form-control" name="staff_id" id="staff_id" required>
                  <option label=""></option>
                  @foreach(\App\Admin::where('status',1)->get() as $admin)
                  <option value = "{{$admin->id}}">{{$admin->username}}</option>
                  @endforeach
                </select>
              </div>
            </div>
            <div class="col-md-12 content-table">
              <div class="form-group">
                <label class="control-label">SMS:</label>
                <select class="form-control" name="is_send_sms" id="is_send_sms" required>
                  <option value = "1"> Yes</option>
                  <option value = "0"> No</option>
                </select>
              </div>
            </div>
            <div class="col-md-12 content-table">
              <div class="form-group">
                <label class="control-label">Email:</label>
                <select class="form-control" name="is_send_email" id="is_send_email" required>
                  <option value = "1"> Yes</option>
                  <option value = "0"> No</option>
                </select>
              </div>
            </div>
            <div class="col-md-12 content-table fill_content">
              <div class="form-group">
                <label class="control-label">Subject:</label>
                <input type="text" id="subject" name="subject" class="form-control" placeholder="Subject" required>
              </div>
            </div>
            <div class="col-md-12 content-table">
              <div class="form-group">
                <label class="control-label">Status:</label>
                <select class="form-control" name="status" id="status" required>
                  <option value = "1"> Active</option>
                  <option value = "0"> Inactive</option>
                </select>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button class="btn btn-success mr-1 mb-1" type="submit">Add</button>
        <button class="btn btn-info mr-1 mb-1" type="reset">Reset</button>
        <button class="btn btn-danger mr-1 mb-1" type="button" data-dismiss="modal">Close</button>
      </div>
      </form>
    </div>
  </div>
</div>