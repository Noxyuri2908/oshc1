<div id="cutum-frm" >
  <form class="form-filter">
  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-4 col-md-4">
        <div class="form-group">
          <label class="control-label" for="s_name">Name</label>
          <div class="ho-ten forms-control">
            <input type="text" id="s_name" value="{{isset($data['s_name']) ? $data['s_name'] : ''}}" placeholder="Name of agent">
          </div>
        </div>
        <div class="form-group">
          <label class="control-label" for="s_type">Type of agent</label>
          <div class="forms-control">
            <select class="form-control" id="s_type">
              <option value="all">all</option>
              @foreach(config('admin.type_agent') as $key=>$value)
                <option value="{{$key}}" {{isset($data['s_type']) ? ($data['s_type'] == $key ? 'selected' : '') : ''}}>{{$value}}</option>
              @endforeach
            </select>
          </div>
        </div>
        <div class="form-group">
            <label class="control-label" for="s_city">City</label>
            <div class="hostline forms-control">
             <input type="text" id="s_city" value="{{isset($data['s_city']) ? $data['s_city'] : ''}}" placeholder="City">
           </div>
        </div>
        <div class="form-group">
          <label class="control-label" for="s_phone">Skype</label>
          <div class="hostline forms-control">
            <input type="text" id="s_skype" value="{{isset($data['s_skype']) ? $data['s_skype'] : ''}}" placeholder="Skype">
          </div>
        </div>
        <div class="form-group">
          <label class="control-label" for="s_contact_1">Contact 1</label>
          <div class="hostline-kh forms-control">
            <input type="text"  id="s_contact_1" value="{{isset($data['s_contact_1']) ? $data['s_contact_1'] : ''}}" placeholder="Contact 1">
          </div>
        </div>
        <div class="form-group">
          <label class="control-label" for="s_contact_2">Contact 2</label>
          <div class="hostline-kh forms-control">
            <input type="text"  id="s_contact_2" value="{{isset($data['s_contact_2']) ? $data['s_contact_2'] : ''}}" placeholder="Contact 2">
          </div>
        </div>
        <div class="form-group">
          <label class="control-label" for="s_person">Person in charge</label>
          <div class="hostline-kh forms-control">
            <input type="text"  id="s_person" value="{{isset($data['s_person']) ? $data['s_person'] : ''}}" placeholder="Person in charge">
          </div>
        </div>
      </div>
      <div class="col-lg-4 col-md-4">
        <div class="form-group">
          <label class="control-label" for="s_status">Status</label>
          <div class="forms-control">
            <select class="form-control" id="s_status">
              <option value='all'>all</option>
              @foreach(config('admin.status') as $key=>$value)
              <option value=$key {{isset($data) ? ($data['s_status'] == $key ? 'selected' : '') : ''}}>{{$value}}</option>
              @endforeach
            </select>
          </div>
        </div>
        <div class="form-group">
          <label class="control-label" for="s_makert">Market</label>
          <div class="forms-control">
            <select class="form-control" id="s_makert">
              <option value='all'>all</option>
              @foreach(config('myconfig.market') as $key=>$value)
              <option value=$key {{isset($data) ? ($data['s_makert'] == $key ? 'selected' : '') : ''}}>{{$value}}</option>
              @endforeach
            </select>
          </div>
        </div>
        <div class="form-group">
          <label class="control-label" for="s_office">Office</label>
          <div class="hostline forms-control">
           <input type="text" id="s_office" value="{{isset($data['s_office']) ? $data['s_office'] : ''}}" placeholder="Office">
          </div>
        </div>
        <div class="form-group">
          <label class="control-label" for="s_website">Website</label>
          <div class="hostline forms-control">
           <input type="text" id="s_website" value="{{isset($data['s_website']) ? $data['s_website'] : ''}}" placeholder="Website">
          </div>
        </div>
        <div class="form-group">
          <label class="control-label" for="s_tel_1">Tel 1</label>
          <div class="hostline forms-control">
           <input type="text" id="s_tel_1" value="{{isset($data['s_tel_1']) ? $data['s_tel_1'] : ''}}" placeholder="Tel 1">
          </div>
        </div>
        <div class="form-group">
          <label class="control-label" for="s_tel_2">Tel 2</label>
          <div class="hostline forms-control">
            <input type="text" id="s_tel_2" value="{{isset($data['s_tel_2']) ? $data['s_tel_2'] : ''}}" placeholder="Tel 2">
          </div>
        </div>
      </div>
      <div class="col-lg-4 col-md-4">
        <div class="form-group">
          <label class="control-label" for="s_agent_code">Agent code</label>
          <div class="dia-chi-kh forms-control">
            <input type="text"  id="s_agent_code" value="{{isset($data['s_agent_code']) ? $data['s_agent_code'] : ''}}" placeholder="Agent code">
          </div>
        </div>
        <div class="form-group">
          <label class="control-label" for="s_country">Country</label>
          <div class="forms-control">
              <select class="form-control" id="s_country">
                <option value="all">all</option>
                @foreach(config('country.list') as $key=>$value)
                <option value="{{$key}}" {{isset($data['s_country']) ? ($data['s_country'] == $key ? 'selected' : '') : ''}}>{{$value}}</option>
                @endforeach
              </select>
          </div>
        </div>
        <div class="form-group">
          <label class="control-label" for="s_email">Email</label>
          <div class="dia-chi-kh forms-control">
            <input type="text"  id="s_email" value="{{isset($data['s_email']) ? $data['s_email'] : ''}}" placeholder="Email">
          </div>
        </div>
      </div>
      <div class="col-lg-12 col-md-12 " style="clear: both;">
        <div class="bt-submit">
         <button type="button" class="btn btn-warning btn-sm btn_search">Search</button>
         <button class="btn btn-danger btn-sm closes" type="button">Close</button>
       </div>
      </div>
    </div>
  </div>
  </form>
</div>