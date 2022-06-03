@if($obj != null)
<div class="modal fade user-information" id="modal_contact_info" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Detail of Contact Person</h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span class="font-weight-light" aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="content-information">
         <h3 class="name">
          {{$obj->name}}
        </h3>
        <div class="row">
          <div class="col-md-6 content-table">
            <div class="form-group">
              <label class="control-label">Agent:</label>
              <input type="text" name="" value="{{$obj->agent != null ? $obj->agent->user->name : ''}}" readonly>
            </div>
          </div>
          <div class="col-md-6 content-table">
            <div class="form-group">
              <label class="control-label">Position:</label>
              <input type="text" name="" value="{{$obj->position}}" readonly>
            </div>
          </div>
          <div class="col-md-6 content-table">
            <div class="form-group">
              <label class="control-label">Phone:</label>
              <input type="text" name="" value="{{$obj->phone}}" readonly>
            </div>
          </div>
          <div class="col-md-6 content-table">
            <div class="form-group">
              <label class="control-label">Birthday:</label>
              <input type="text" name="" value="{{$obj->birthday}}" readonly>
            </div>
          </div>
          <div class="col-md-6 content-table">
            <div class="form-group">
              <label class="control-label">Email:</label>
              <input type="text" name="" value="{{$obj->email}}" readonly>
            </div>
          </div>
          <div class="col-md-6 content-table">
            <div class="form-group">
              <label class="control-label">Skype:</label>
              <input type="text" name="" value="{{$obj->skype}}" readonly>
            </div>
          </div>
          <div class="col-md-6 content-table">
            <div class="form-group">
              <label class="control-label">Status:</label>
              <input type="text" name="" value="{{$obj->status == 1 ? 'Active' : 'De-active'}}" readonly>
            </div>
          </div>
      </div>
    </div>
  </div>
  <div class="modal-footer">
    <button class="btn btn-secondary btn-sm" type="button" data-dismiss="modal">Close</button>
  </div>
</div>
</div>
</div>

@endif
