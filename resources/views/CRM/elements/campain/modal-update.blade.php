<div class="modal fade user-information" id="modal_campain_update" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Update campain: {{$obj->name}}</h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span class="font-weight-light" aria-hidden="true">&times;</span>
        </button>
      </div>
      <form role="form" action="{{route('campain.update', ['id'=>$obj->id])}}" method="POST">
      @csrf
      <div class="modal-body">
        <div class="content-information">
          <div class="row">
            <div class="col-md-3 content-table fill_content">
              <div class="form-group">
                <label class="control-label">Code:</label>
                <input type="text" id="code" value="{{$obj->code}}" name="code" class="form-control" placeholder="Code" required>
              </div>
            </div>
            <div class="col-md-9 content-table fill_content">
              <div class="form-group">
                <label class="control-label">Campaign:</label>
                <input type="text" id="name" name="name" value="{{$obj->name}}"  class="form-control" placeholder="Campaign" required>
              </div>
            </div>
            <div class="col-md-6 content-table fill_content">
              <div class="form-group">
                <label class="control-label">Start date:</label>
                <input type="text" id="start_date"  value="{{$obj->start_date}}" name="start_date" class="form-control" placeholder="Start date" required>
              </div>
            </div>
            <div class="col-md-6 content-table fill_content">
              <div class="form-group">
                <label class="control-label">End date:</label>
                <input type="text" id="end_date" value="{{$obj->end_date}}"  name="end_date" class="form-control" placeholder="End date" required>
              </div>
            </div>
            <div class="col-md-6 content-table">
              <div class="form-group">
                <label class="control-label">Assign for:</label>
                <select class="form-control" name="staff_id" id="staff_id" required>
                  <option label=""></option>
                  @foreach(\App\Admin::where('status',1)->get() as $admin)
                  <option value = "{{$admin->id}}" {{$obj->staff_id == $admin->id ? 'selected' : ''}}>{{$admin->username}}</option>
                  @endforeach
                </select>
              </div>
            </div>
            <div class="col-md-6 content-table">
              <div class="form-group">
                <label class="control-label">Status:</label>
                <select class="form-control" name="status" id="status" required>
                  <option value = "1" {{$obj->status == 1 ? 'selected' : ''}}> Active</option>
                  <option value = "0" {{$obj->status == 0 ? 'selected' : ''}}> Inactive</option>
                </select>
              </div>
            </div>
            <div class="col-md-6 content-table">
              <div class="form-group">
                <label class="control-label">SMS:</label>
                <select class="form-control" name="is_send_sms" id="is_send_sms" required>
                  <option value = "1" {{$obj->is_send_sms == 1 ? 'selected' : ''}}> Yes</option>
                  <option value = "0" {{$obj->is_send_sms == 0 ? 'selected' : ''}}> No</option>
                </select>
              </div>
            </div>
            <div class="col-md-6 content-table">
              <div class="form-group">
                <label class="control-label">Email:</label>
                <select class="form-control" name="is_send_email" id="is_send_email" required>
                  <option value = "1" {{$obj->is_send_email == 1 ? 'selected' : ''}}> Yes</option>
                  <option value = "0" {{$obj->is_send_email == 0 ? 'selected' : ''}}> No</option>
                </select>
              </div>
            </div>
            <div class="col-md-12 content-table fill_content">
              <div class="form-group">
                <label class="control-label">Subject:</label>
                <input type="text"  value="{{$obj->code}}" id="subject" name="subject" class="form-control" placeholder="Subject" required>
              </div>
            </div>
            <div class="col-md-12 content-table fill_content">
              <div class="form-group">
                <label class="control-label">Content:</label>
                <textarea name="content" id="content" class="form-control my-editor" rows="5">{!!$obj->content !!}</textarea>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button class="btn btn-success mr-1 mb-1" type="submit">Update</button>
        <button class="btn btn-info mr-1 mb-1" type="reset">Reset</button>
        <button class="btn btn-danger mr-1 mb-1" type="button" data-dismiss="modal">Close</button>
      </div>
      </form>
    </div>
  </div>
</div>