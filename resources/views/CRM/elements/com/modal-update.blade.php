<div class="modal fade user-information" id="modal_com_update" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Update commission</h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span class="font-weight-light" aria-hidden="true">&times;</span>
        </button>
      </div>
      <form role="form" action="{{route('com.update', ['id'=>$obj->id])}}" method="POST">
      @csrf
      <div class="modal-body">
        <div class="content-information">
          <div class="row">
            <div class="col-md-6 content-table fill_content">
              <div class="form-group">
                <label class="control-label">Agent:</label>
                <select id="user_id" name="user_id" class="form-control" required>
                  <option label=""></option>
                  @foreach($users as $user)
                  <option value="{{$user->id}}" data-country ="{{$user->country()}}" {{$obj->user_id == $user->id ? 'selected' : ''}}>{{$user->name}}</option>
                  @endforeach
                </select>
              </div>
            </div>
            <div class="col-md-6 content-table fill_content">
              <div class="form-group">
                <label class="control-label">Country service:</label>
                <input class="form-control" type="hidden" id="country_service" value="{{$obj->user != null ? $obj->user->country() : ''}}" readonly>
              </div>
            </div>
            <div class="col-md-6 content-table fill_content">
              <div class="form-group">
                <label class="control-label">Service:</label>
                <select id="service_id" name="service_id" class="form-control">
                  <option label=""></option>
                  @foreach($dichvus as $dichvu)
                  <option value="{{$dichvu->id}}" {{$_dichvu_id == $dichvu->id ? 'selected' : ''}}>{{$dichvu->name}}</option>
                  @endforeach
                </select>
              </div>
            </div>
            <div class="col-md-6 content-table fill_content">
              <div class="form-group">
                <label class="control-label">Provider:</label>
                <select id="type_service" name="type_service" class="form-control">
                  <option label=""></option>
                  @if(isset($providers))
                  @foreach($providers as $provider)
                  <option value="{{$provider->id}}" {{$obj->type_service == $provider->id ? 'selected' : ''}}>{{$provider->name}}</option>
                  @endforeach
                  @endif
                </select>
              </div>
            </div>
            <div class="col-md-4 content-table fill_content">
              <div class="form-group">
                <label class="control-label">Commission:</label>
                <input type="number" id="comm" name="comm" value="{{$obj->comm}}" class="form-control" placeholder="" required>
              </div>
            </div>
            <div class="col-md-4 content-table fill_content">
              <div class="form-group">
                <label class="control-label">Policy:</label>
                <select class="form-control" name="type">
                  @foreach(config('myconfig.policy') as $key=>$value)
                  <option value="{{$key}}" {{$obj->type == $key ? 'selected' : ''}}>{{$value}}</option>
                  @endforeach
                </select>
              </div>
            </div>
            <div class="col-md-4 content-table fill_content">
              <div class="form-group">
                <label class="control-label">(%) / ($):</label>
                <select class="form-control" name="donvi">
                  @foreach(config('myconfig.donvi') as $key=>$value)
                  <option value="{{$key}}" {{$obj->donvi == $key ? 'selected' : ''}}>{{$value}}</option>
                  @endforeach
                </select>
              </div>
            </div>
            <div class="col-md-6 content-table">
              <div class="form-group">
                <label class="control-label">Type Payment:</label>
                <select class="form-control" name="type_payment" id="type_payment" required>
                  <option value = "1" {{$obj->type_payment == 1 ? 'selected' : ''}}> Monthly</option>
                  <option value = "2" {{$obj->type_payment == 2 ? 'selected' : ''}}> Deduction com</option>
                </select>
              </div>
            </div>
            <div class="col-md-6 content-table">
              <div class="form-group">
                <label class="control-label">GST:</label>
                <select class="form-control" name="gst" id="gst" required>
                  <option value = "0" {{$obj->gst == 0 ? 'selected' : ''}}> Not include</option>
                  <option value = "1" {{$obj->gst == 1 ? 'selected' : ''}}> Include</option>
                </select>
              </div>
            </div>
            <div class="col-md-6 content-table fill_content">
              <div class="form-group">
                <label class="control-label">Validity start date:</label>
                <input class="form-control datetimepicker" id="datepicker" name="date" type="text" data-options='{"dateFormat":"Y-m-d"}' 
                value="{{$obj->date}}" required>
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