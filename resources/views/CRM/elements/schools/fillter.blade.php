<div class="card mb-3">
   <div class="card-header">
      <div class="row">
        <div class="col-lg-12">
          <div class="select-box">
            <div class="form-row">
              <div  class="col-md-3 col-sm-4 col-xs-6">
                <label for="event-type">Name</label>
               <input type="text" class="form-control" id="f_name" value="{{isset($f_data) ? $f_data['f_name'] : ''}}">
              </div>
              <div  class="col-md-3 col-sm-4 col-xs-6">
                <label for="event-type">Country</label>
                <select class="form-control form-control" id="f_country" name="f_country">
                  <option value="all">all</option>
                  @foreach(config('country.list') as $key=>$value)
                  <option value={{$key}} {{isset($f_data) ? ($f_data['f_country'] == $key ? 'selected' : '') : ''}}>{{$value}}</option>
                  @endforeach
                </select>
              </div>
              <div  class="col-md-3 col-sm-4 col-xs-6">
                <label for="event-type">State/Region</label>
               <input type="text" class="form-control" id="f_state" value="{{isset($f_data) ? $f_data['f_state'] : ''}}">
              </div>
              <div  class="col-md-3 col-sm-4 col-xs-6">
                <label for="event-type">City</label>
               <input type="text" class="form-control" id="f_city" value="{{isset($f_data) ? $f_data['f_city'] : ''}}">
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
</div>