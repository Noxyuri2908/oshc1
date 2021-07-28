@php
$staffs = App\Admin::where('status',1)->get();
@endphp
<div class="modal fade user-information" id="modal_attach" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Set person in charge</h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span class="font-weight-light" aria-hidden="true">&times;</span>
        </button>
      </div>
      <form role="form" action="{{route('crm.agent.attach')}}" method="POST">
        @csrf
        <input type="hidden" name="data_attach" id="data_attach">
        <div class="modal-body">
          <div class="content-information">
            <div class="row">
              <div class="col-md-12 content-table">
                <div class="form-group">
                  <label class="control-label">Choose people:</label>
                  <select class="form-control" name="staff_id" id="staff_id" required>
                    <option label=""></option>
                    @foreach($staffs as $staff)
                    <option value="{{$staff->id}}">{{$staff->username}}</option>
                    @endforeach
                  </select>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button class="btn btn-danger mr-1 mb-1 submit_attach" type="submit">Submit</button>
          <button class="btn btn-danger mr-1 mb-1" type="button" data-dismiss="modal">Close</button>
        </div>
      </form>
    </div>
  </div>
</div>