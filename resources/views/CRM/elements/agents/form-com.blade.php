<div class="modal fade user-information" id="modal_com_add" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add new commission</h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span class="font-weight-light" aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="content-information">
          <div class="row">
            <div class="col-md-9 content-table fill_content">
              <div class="form-group">
                <label class="control-label">Country service:</label>
                <select id="country_id" name="country_id" class="form-control" required>
                  <option label=""></option>
                  @foreach(config('country.list') as $key=>$value)
                  <option value="{{$key}}">{{$value}}</option>
                  @endforeach
                </select>
              </div>
            </div>
            <div class="col-md-6 content-table fill_content">
              <div class="form-group">
                <label class="control-label">Service:</label>
                <select id="service_id" name="service_id" class="form-control">
                  <option label=""></option>
                  @foreach($dichvus as $dichvu)
                  <option value="{{$dichvu->id}}">{{$dichvu->name}}</option>
                  @endforeach
                </select>
              </div>
            </div>
            <div class="col-md-6 content-table fill_content">
              <div class="form-group">
                <label class="control-label">Provider:</label>
                <select id="type_service" name="type_service" class="form-control">
                  <option label=""></option>
                </select>
              </div>
            </div>
            <div class="col-md-3 content-table fill_content">
              <div class="form-group">
                <label class="control-label">Commission:</label>
                <input type="number" id="comm" name="comm" class="form-control" placeholder="" required>
              </div>
            </div>
            <div class="col-md-3 content-table fill_content">
              <div class="form-group">
                <label class="control-label">Policy:</label>
                <select class="form-control" name="type">
                  @foreach(config('myconfig.policy') as $key=>$value)
                  <option value="{{$key}}">{{$value}}</option>
                  @endforeach
                </select>
              </div>
            </div>
            <div class="col-md-3 content-table fill_content">
              <div class="form-group">
                <label class="control-label">(%) / ($):</label>
                <select class="form-control" name="donvi">
                  @foreach(config('myconfig.donvi') as $key=>$value)
                  <option value="{{$key}}">{{$value}}</option>
                  @endforeach
                </select>
              </div>
            </div>
            <div class="col-md-3 content-table fill_content">
              <div class="form-group">
                <label class="control-label">Unit:</label>
                <select class="form-control" name="unit">
                  <option label=""></option>
                  @foreach(config('myconfig.unit') as $key=>$value)
                  <option value="{{$key}}">{{$value}}</option>
                  @endforeach
                </select>
              </div>
            </div>
            <div class="col-md-6 content-table fill_content">
              <div class="form-group">
                <label class="control-label">Validity start date:</label>
                <input class="form-control datetimepicker" id="datepicker" name="date" type="text" data-options='{"dateFormat":"Y-m-d"}' required>
              </div>
            </div>
            <div class="col-md-6 content-table">
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
        <button class="btn btn-success mr-1 mb-1" type="button">Add</button>
        <button class="btn btn-info mr-1 mb-1" type="reset">Reset</button>
        <button class="btn btn-danger mr-1 mb-1" type="button" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>