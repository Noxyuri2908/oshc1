<div class="sticky-top sticky-sidebar sidebar-left">
  <div class="card mb-3 mb-lg-0">
    <div class="card-body bg-light">
      <h6><b>AGENT INFO</b></h6>
      <div class="pat-sidebar">
        <div class="form-group custom-control custom-radio">
          <label class="custom-control-label" for="customRadio4"> <strong>Agent</strong></label><small class="form-text mt-0" style="color: #01A9DB">{{(!empty($obj))?$obj->name:''}}</small>
        </div>
      </div>
      <div class="pat-sidebar">
        <div class="form-group custom-control custom-radio">
          <label class="custom-control-label" for="customRadio4"> <strong>{{$fields[9]}}</strong></label><small class="form-text mt-0" style="color: #01A9DB">{{(!empty($obj))?$obj->agent_code:''}}</small>
        </div>
      </div>
      <div class="pat-sidebar">
        <div class="form-group custom-control custom-radio">
          <label class="custom-control-label" for="customRadio5"> <strong>{{$fields[15]}}</strong></label><small class="form-text mt-0" style="color: #01A9DB">{{ !empty($obj)&& !empty(config('admin.type_agent')[$obj->type_id]) ? config('admin.type_agent')[$obj->type_id] : ''}}</small>
        </div>
      </div>
      <div class="pat-sidebar">
        <div class="form-group custom-control custom-radio">
          <label class="custom-control-label" for="customRadio4"> <strong>{{$fields[2]}}</strong></label><small class="form-text mt-0" style="color: #01A9DB">{{!empty($obj) ? $obj->country() : ''}} / {{!empty($obj) ?$obj->city:''}}</small>
        </div>
      </div>
      <div class="pat-sidebar">
        <div class="form-group custom-control custom-radio">
          <label class="custom-control-label" for="customRadio4"> <strong>{{$fields[21]}}</strong></label><small class="form-text mt-0" style="color: #01A9DB">{{!empty($obj) ? $obj->office : ''}}</small>
        </div>
      </div>
      <div class="pat-sidebar">
        <div class="form-group custom-control custom-radio">
          <label class="custom-control-label" for="customRadio4"> <strong>{{$fields[16]}}</strong></label><small class="form-text mt-0" style="color: #01A9DB">{{!empty($obj) ? $obj->email : ''}}</small>
        </div>
      </div>
      <div class="pat-sidebar">
        <div class="form-group custom-control custom-radio">
          <label class="custom-control-label" for="customRadio4"> <strong>{{$fields[17]}}</strong></label><small class="form-text mt-0" style="color: #01A9DB">{{!empty($obj) ?$obj->tel_1:''}}</small>
        </div>
      </div>
      <div class="pat-sidebar">
        <div class="form-group custom-control custom-radio">
          <label class="custom-control-label" for="customRadio4"> <strong>{{$fields[19]}}</strong></label><small class="form-text mt-0" style="color: #01A9DB">{{!empty($obj) ?$obj->website:''}}</small>
        </div>
      </div>
        <div class="pat-sidebar">
            <div class="form-group custom-control custom-radio">
                <label class="custom-control-label" for="customRadio4"> <strong>{{$fields[3]}}</strong></label><small class="form-text mt-0" style="color: #01A9DB">{{!empty($obj) ?$obj->text_status:''}}</small>
            </div>
        </div>
        <div class="pat-sidebar">
            <div class="form-group custom-control custom-radio">
                <label class="custom-control-label" for="customRadio4"> <strong>{{$fields[6]}}</strong></label><small class="form-text mt-0" style="color: #01A9DB">{{!empty($obj) ?$obj->rating:''}}</small>
            </div>
        </div>
        <div class="pat-sidebar">
            <div class="form-group custom-control custom-radio">
                <label class="custom-control-label" for="customRadio4"> <strong>{{$fields[5]}}</strong></label><small class="form-text mt-0" style="color: #01A9DB">{{!empty($obj) ?$obj->getPotentialService($dichvus):''}}</small>
            </div>
        </div>
        <div class="pat-sidebar">
            <div class="form-group custom-control custom-radio">
                <label class="custom-control-label" for="customRadio4"> <strong>{{$fields[22]}}</strong></label><small class="form-text mt-0" style="color: #01A9DB">{{!empty($obj) ?$obj->fb:''}}</small>
            </div>
        </div>
        <div class="pat-sidebar">
            <div class="form-group custom-control custom-radio">
                <label class="custom-control-label" for="customRadio4"> <strong>{{$fields[10]}}</strong></label><small class="form-text mt-0" style="color: #01A9DB">{{!empty($obj) && !empty($obj->staff_id) ? $admins[$obj->staff_id]:''}}</small>
            </div>
        </div>
        <div class="pat-sidebar">
            <div class="form-group custom-control custom-radio">
                <label class="custom-control-label" for="customRadio4"> <strong>{{$fields[13]}}</strong></label><small class="form-text mt-0" style="color: #01A9DB">{{!empty($obj) ?$obj->note1:''}}</small>
            </div>
        </div>
        <div class="pat-sidebar">
            <div class="form-group custom-control custom-radio">
                <label class="custom-control-label" for="customRadio4"> <strong>{{$fields[14]}}</strong></label><small class="form-text mt-0" style="color: #01A9DB">{{!empty($obj) ?$obj->note2:''}}</small>
            </div>
        </div>
      <h6><b>CONTACT</b></h6>
      @if(!empty($obj))
            @foreach($obj->contacts()->get() as $contact)
                <div class="pat-sidebar">
                    <div class="form-group custom-control custom-radio">
                        <label class="custom-control-label" for="customRadio5"> <strong>{{$contact->name}}:</strong></label>
                        <a><small class="form-text mt-0" style="color: #01A9DB">View</small></a>
                    </div>
                </div>
            @endforeach
      @endif
    </div>
  </div>
</div>
