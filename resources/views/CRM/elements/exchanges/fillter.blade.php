<div class="card mb-3">
   <div class="card-header">
      <div class="row">
        <div class="col-lg-12">
          <div class="select-box">
            <div class="form-row">
              <div  class="col-md-3 col-sm-4 col-xs-6">
                <label for="event-type">Month</label>
                <select class="form-control form-control-sm" id="f_month" name="f_month">
                  <option value="all">all</option>
                  @foreach(config('date-time.month') as $key=>$value)
                  <option value={{$key}} {{isset($f_data) ? ($f_data['f_month'] == $key ? 'selected' : '') : ''}}>{{$value}}</option>
                  @endforeach
                </select>
              </div>
              <div  class="col-md-3 col-sm-4 col-xs-6">
                <label for="event-type">Year</label>
                <select class="form-control form-control-sm" id="f_year" name="f_year">
                  <option value="all">all</option>
                  @foreach(config('date-time.year') as $key=>$value)
                  <option value={{$key}} {{isset($f_data) ? ($f_data['f_year'] == $key ? 'selected' : '') : ''}}>{{$value}}</option>
                  @endforeach
                </select>
              </div>
              <div  class="col-md-3 col-sm-4 col-xs-6">
                <label for="event-type">Type</label>
                <select class="form-control form-control-sm" id="f_type" name="f_type">
                  <option value="all">all</option>
                  @foreach(config('myconfig.type_exchange') as $key=>$value)
                  <option value={{$key}} {{isset($f_data) ? ($f_data['f_type'] == $key ? 'selected' : '') : ''}}>{{$value}}</option>
                  @endforeach
                </select>
              </div>
              <div  class="col-md-3 col-sm-4 col-xs-6">
                <label for="event-type">Created by</label>
                <select class="form-control form-control-sm" id="f_created_by" name="f_created_by">
                  <option value="all">all</option>
                  @foreach($admins as $admin)
                  <option value={{$admin->id}} {{isset($f_data) ? ($f_data['f_created_by'] == $admin->id ? 'selected' : '') : ''}}>{{$admin->username}}</option>
                  @endforeach
                </select>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
</div>