<div id="cutum-frm" >
  <form class="form-filter">
  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-4 col-md-4">
        <div class="form-group">
          <label class="control-label" for="f_method">Payment method</label>
          <div class="forms-control">
            <select class="form-control" id="f_method">
              <option value="all">all</option>
              @foreach(config('myconfig.payment_method') as $key=>$value)
                <option value="{{$key}}" {{isset($f_data['f_method']) ? ($f_data['f_method'] == $key ? 'selected' : '') : ''}}>{{$value}}</option>
              @endforeach
            </select>
          </div>
        </div>
        <div class="form-group">
          <label class="control-label" for="f_policy">Policy</label>
          <div class="forms-control">
            <select class="form-control" id="f_policy">
              <option value="all">all</option>
              @foreach(config('myconfig.policy') as $key=>$value)
                <option value="{{$key}}" {{isset($f_data['f_policy']) ? ($f_data['f_policy'] == $key ? 'selected' : '') : ''}}>{{$value}}</option>
              @endforeach
            </select>
          </div>
        </div>
        <div class="form-group">
            <label class="control-label" for="f_no_of_adults">No of adults</label>
            <div class="hostline forms-control">
             <input type="number" id="f_no_of_adults" value="{{isset($f_data['f_no_of_adults']) ? $f_data['f_data'] : ''}}" placeholder="">
           </div>
        </div>
        <div class="form-group">
            <label class="control-label" for="f_no_of_children">No of children</label>
            <div class="hostline forms-control">
             <input type="number" id="f_no_of_children" value="{{isset($f_data['f_no_of_children']) ? $f_data['f_no_of_children'] : ''}}" placeholder="">
           </div>
        </div>
        <div class="form-group">
          <label class="control-label" for="f_destination">Destination</label>
          <div class="forms-control">
            <select class="form-control" id="f_destination">
              <option value="all">all</option>
              @foreach(config('country.list') as $key=>$value)
                <option value="{{$key}}" {{isset($f_data['f_destination']) ? ($f_data['f_destination'] == $key ? 'selected' : '') : ''}}>{{$value}}</option>
              @endforeach
            </select>
          </div>
        </div>
        <div class="form-group">
            <label class="control-label" for="f_mobile">Mobile No</label>
            <div class="hostline forms-control">
             <input type="number" id="f_mobile" value="{{isset($f_data['f_mobile']) ? $f_data['f_mobile'] : ''}}" placeholder="">
           </div>
        </div>
        <div class="form-group">
            <label class="control-label" for="f_facebook">Facebook</label>
            <div class="hostline forms-control">
             <input type="text" id="f_facebook" value="{{isset($f_data['f_facebook']) ? $f_data['f_facebook'] : ''}}" placeholder="">
           </div>
        </div>
        <div class="form-group">
            <label class="control-label" for="f_plus">-/+ ($)</label>
            <div class="hostline forms-control">
             <input type="text" id="f_plus" value="{{isset($f_data['f_plus']) ? $f_data['f_plus'] : ''}}" placeholder="">
           </div>
        </div>
        <div class="form-group">
            <label class="control-label" for="f_comm">Commission ($)</label>
            <div class="hostline forms-control">
             <input type="text" id="f_comm" value="{{isset($f_data['f_comm']) ? $f_data['f_comm'] : ''}}" placeholder="">
           </div>
        </div>
        <div class="form-group">
            <label class="control-label" for="f_date">Creation date</label>
            <div class="hostline forms-control">
             <input type="text" id="f_date" value="{{isset($f_data['f_date']) ? $f_data['f_date'] : ''}}" placeholder="">
           </div>
        </div>
      </div>
      <div class="col-lg-4 col-md-4">
        <div class="form-group">
            <label class="control-label" for="f_no_of_children">No of children</label>
            <div class="hostline forms-control">
             <input type="number" id="f_no_of_children" value="{{isset($f_data['f_no_of_children']) ? $f_data['f_no_of_children'] : ''}}" placeholder="">
           </div>
        </div>
        <div class="form-group">
          <label class="control-label" for="f_type_visa">Type of visa</label>
          <div class="forms-control">
            <select class="form-control" id="f_type_visa">
              <option value="all">all</option>
              @foreach(config('myconfig.type_visa') as $key=>$value)
                <option value="{{$key}}" {{isset($f_data['f_type_visa']) ? ($f_data['f_type_visa'] == $key ? 'selected' : '') : ''}}>{{$value}}</option>
              @endforeach
            </select>
          </div>
        </div>
        <div class="form-group">
            <label class="control-label" for="f_net_amount">Net amount ($)</label>
            <div class="hostline forms-control">
             <input type="number" id="f_net_amount" value="{{isset($f_data['f_net_amount']) ? $f_data['f_net_amount'] : ''}}" placeholder="">
           </div>
        </div>
        <div class="form-group">
            <label class="control-label" for="f_email">Email</label>
            <div class="hostline forms-control">
             <input type="email" id="f_email" value="{{isset($f_data['f_email']) ? $f_data['f_email'] : ''}}" placeholder="">
           </div>
        </div>
        <div class="form-group">
            <label class="control-label" for="f_edu_instituation">Education instituation</label>
            <div class="hostline forms-control">
             <input type="text" id="f_edu_instituation" value="{{isset($f_data['f_edu_instituation']) ? $f_data['f_edu_instituation'] : ''}}" placeholder="">
           </div>
        </div>
        <div class="form-group">
            <label class="control-label" for="f_std_id">Student ID</label>
            <div class="hostline forms-control">
             <input type="text" id="f_std_id" value="{{isset($f_data['f_std_id']) ? $f_data['f_std_id'] : ''}}" placeholder="">
           </div>
        </div>
        <div class="form-group">
            <label class="control-label" for="f_surcharge">Surcharge ($)</label>
            <div class="hostline forms-control">
             <input type="text" id="f_surcharge" value="{{isset($f_data['f_surcharge']) ? $f_data['f_surcharge'] : ''}}" placeholder="">
           </div>
        </div>
        <div class="form-group">
            <label class="control-label" for="f_total">Total ($)</label>
            <div class="hostline forms-control">
             <input type="text" id="f_total" value="{{isset($f_data['f_total']) ? $f_data['f_total'] : ''}}" placeholder="">
           </div>
        </div>
        <div class="form-group">
            <label class="control-label" for="f_note">Note</label>
            <div class="hostline forms-control">
             <input type="text" id="f_note" value="{{isset($f_data['f_note']) ? $f_data['f_note'] : ''}}" placeholder="">
           </div>
        </div>
        <div class="form-group">
          <label class="control-label" for="f_staff">Staff</label>
          <div class="forms-control">
            <select class="form-control" id="f_staff">
              <option value="all">all</option>
              @foreach($staffs as $staff)
                <option value="{{$staff->id}}" {{isset($f_data['f_staff']) ? ($f_data['f_staff'] == $staff->id ? 'selected' : '') : ''}}>{{$staff->username}}</option>
              @endforeach
            </select>
          </div>
        </div>
      </div>
      <div class="col-lg-4 col-md-4">
        <div class="form-group">
            <label class="control-label" for="f_ref_no">Ref No</label>
            <div class="hostline forms-control">
             <input type="text" id="f_ref_no" value="{{isset($f_data['f_ref_no']) ? $f_data['f_ref_no'] : ''}}" placeholder="">
           </div>
        </div>
        <div class="form-group">
            <label class="control-label" for="f_first_name">First name</label>
            <div class="hostline forms-control">
             <input type="text" id="f_first_name" value="{{isset($f_data['f_first_name']) ? $f_data['f_first_name'] : ''}}" placeholder="">
           </div>
        </div>
        <div class="form-group">
            <label class="control-label" for="f_last_name">Last name</label>
            <div class="hostline forms-control">
             <input type="text" id="f_last_name" value="{{isset($f_data['f_last_name']) ? $f_data['f_last_name'] : ''}}" placeholder="">
           </div>
        </div>
        <div class="form-group">
            <label class="control-label" for="f_pass_no">Passport No</label>
            <div class="hostline forms-control">
             <input type="text" id="f_pass_no" value="{{isset($f_data['f_pass_no']) ? $f_data['f_pass_no'] : ''}}" placeholder="">
           </div>
        </div>
        <div class="form-group">
            <label class="control-label" for="f_pass_no">Passport No</label>
            <div class="hostline forms-control">
             <input type="text" id="f_pass_no" value="{{isset($f_data['f_pass_no']) ? $f_data['f_pass_no'] : ''}}" placeholder="">
           </div>
        </div>
        <div class="form-group">
            <label class="control-label" for="f_code">Promotion code</label>
            <div class="hostline forms-control">
             <input type="text" id="f_code" value="{{isset($f_data['f_code']) ? $f_data['f_code'] : ''}}" placeholder="">
           </div>
        </div>
        <div class="form-group">
            <label class="control-label" for="f_code_money">Promotion ($)</label>
            <div class="hostline forms-control">
             <input type="text" id="f_code_money" value="{{isset($f_data['f_code_money']) ? $f_data['f_code_money'] : ''}}" placeholder="">
           </div>
        </div>
        <div class="form-group">
          <label class="control-label" for="f_fee">Bank fee (%)</label>
          <div class="forms-control">
            <select class="form-control" id="f_fee">
              <option value="all">all</option>
              @foreach(config('myconfig.bank_fee') as $key=>$value)
                <option value="{{$key}}" {{isset($f_data['f_fee']) ? ($f_data['f_fee'] == $key ? 'selected' : '') : ''}}>{{$value}}</option>
              @endforeach
            </select>
          </div>
        </div>
        <div class="form-group">
            <label class="control-label" for="f_fee_money">Bank fee ($)</label>
            <div class="hostline forms-control">
             <input type="text" id="f_fee_money" value="{{isset($f_data['f_fee_money']) ? $f_data['f_fee_money'] : ''}}" placeholder="">
           </div>
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
  </form>
</div>
