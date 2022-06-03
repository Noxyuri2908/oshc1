@if($obj != null)
<div class="modal fade user-information" id="modal_custom_info" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Detail of Customer</h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span class="font-weight-light" aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="content-information">
         <h3 class="name">
          {{$obj->apply->invoice_code}}
        </h3>
        <div class="row">
          <div class="col-md-6 content-table">
            <div class="form-group">
              <label class="control-label">Prefix name:</label>
              <input type="text" name="" value="{{$obj->prefix_name}}" readonly>
            </div>
          </div>
          <div class="col-md-6 content-table">
            <div class="form-group">
              <label class="control-label">First name:</label>
              <input type="text" name="" value="{{$obj->first_name}}" readonly>
            </div>
          </div>
          <div class="col-md-6 content-table">
            <div class="form-group">
              <label class="control-label">Last name:</label>
              <input type="text" name="" value="{{$obj->last_name}}" readonly>
            </div>
          </div>
          <div class="col-md-6 content-table">
            <div class="form-group">
              <label class="control-label">Gender:</label>
              <input type="text" name="" value="{{$obj->gender == 1 ? 'Male' : 'Female'}}" readonly>
            </div>
          </div>
          <div class="col-md-6 content-table">
            <div class="form-group">
              <label class="control-label">Birth of date:</label>
              <input type="text" name="" value="{{$obj->birth_of_date}}" readonly>
            </div>
          </div>
          <div class="col-md-6 content-table">
            <div class="form-group">
              <label class="control-label">Passport:</label>
              <input type="text" name="" value="{{$obj->passport}}" readonly>
            </div>
          </div>
          <div class="col-md-6 content-table">
            <div class="form-group">
              <label class="control-label">Country:</label>
              <input type="text" name="" value="{{isset(config('country.list')[$obj->country]) ? config('country.list')[$obj->country] : ''}}" readonly>
            </div>
          </div>
          <div class="col-md-6 content-table">
            <div class="form-group">
              <label class="control-label">Place study:</label>
              <input type="text" name="" value="{{$obj->place_study}}" readonly>
            </div>
          </div>
          <div class="col-md-6 content-table">
            <div class="form-group">
              <label class="control-label">Student ID:</label>
              <input type="text" name="" value="{{$obj->student_id}}" readonly>
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
              <label class="control-label">Email:</label>
              <input type="text" name="" value="{{$obj->email}}" readonly>
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
