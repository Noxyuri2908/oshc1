<div class="form-row">
  <div  class="col-md-2 col-sm-4 col-xs-6">
    <label for="event-type">Agent</label>
    <select class="form-control form-control-sm" id="f_agent" name="f_agent">
      <option value="all">all</option>
      @foreach($agents as $agent)
      <option value={{$agent->id}} {{isset($f_data) ? ($f_data['f_agent'] == $agent->id ? 'selected' : '') : ''}}>{{$agent->name}}</option>
      @endforeach
    </select>
  </div>
  <div  class="col-md-2 col-sm-4 col-xs-6">
    <label for="event-type">Country</label>
    <select class="form-control form-control-sm" id="f_country" name="f_country">
      <option value='all'>all</option>
      @foreach(config('country.list') as $key=>$value)
      <option value={{$key}} {{isset($f_data) ? ($f_data['f_country'] == $key ? 'selected' : '') : ''}}>{{$value}}</option>
      @endforeach
    </select>
  </div>
  <div  class="col-md-2 col-sm-4 col-xs-6">
    <label for="event-type">Master agent</label>
    <select class="form-control form-control-sm" id="f__master_agent" name="f__master_agent">
      <option value="all">all</option>
      @foreach($agents as $agent)
      <option value={{$agent->id}} {{isset($f_data) ? ($f_data['f__master_agent'] == $agent->id ? 'selected' : '') : ''}}>{{$agent->name}}</option>
      @endforeach
    </select>
  </div>
  <div  class="col-md-2 col-sm-4 col-xs-6">
    <label for="event-type">Service country</label>
    <select class="form-control form-control-sm" id="f_service_country" name="f_service_country">
      <option value='all'>all</option>
      @foreach(config('myconfig.service_country') as $key=>$value)
      <option value={{$key}} {{isset($f_data) ? ($f_data['f_service_country'] == $key ? 'selected' : '') : ''}}>{{$value}}</option>
      @endforeach
    </select>
  </div>
  <div  class="col-md-2 col-sm-4 col-xs-6">
    <label for="event-type">Type of service</label>
    <select class="form-control form-control-sm" id="f_dichvu" name="f_dichvu">
      <option value='all'>all</option>
      @foreach($dichvus as $dichvu)
      <option value={{$dichvu->id}} {{isset($f_data) ? ($f_data['f_dichvu'] == $dichvu->id ? 'selected' : '') : ''}}>{{$dichvu->name}}</option>
      @endforeach
    </select>
  </div>
  <div  class="col-md-2 col-sm-4 col-xs-6">
    <label for="event-type">Type of invoice</label>
    <select class="form-control form-control-sm" id="f_type_invoice" name="f_type_invoice">
      <option value='all'>all</option>
      @foreach(config('myconfig.type_invoice') as $key=>$value)
      <option value={{$key}} {{isset($f_data) ? ($f_data['f_type_invoice'] == $key ? 'selected' : '') : ''}}>{{$value}}</option>
      @endforeach
    </select>
  </div>
  <div  class="col-md-2 col-sm-4 col-xs-6">
    <label for="event-type">Providers</label>
    <select class="form-control form-control-sm" id="f_providers" name="f_providers">
      <option value="all">all</option>
      @foreach($providers as $provider)
      <option value={{$provider->id}} {{isset($f_data) ? ($f_data['f_providers'] == $provider->id ? 'selected' : '') : ''}}>{{$provider->name}}</option>
      @endforeach
    </select>
  </div>
  <div  class="col-md-2 col-sm-4 col-xs-6">
    <label for="event-type">Status</label>
    <select class="form-control form-control-sm" id="f_status" name="f_status">
      <option value='all'>all</option>
      @foreach(config('myconfig.status_invoice') as $key=>$value)
      <option value={{$key}} {{isset($f_data) ? ($f_data['f_status'] == $key ? 'selected' : '') : ''}}>{{$value}}</option>
      @endforeach
    </select>
  </div>
</div>