 <div id="cutum-frm" >
  <form role="form" class="form-filter" action="{{route('crm.apply.search')}}" method="POST">
    @csrf
    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-4 col-md-4">
          <div class="form-group">
            <label class="control-label" for="s_service">Service</label>
            <div class="gmail-kh forms-control">
              <div class="forms-control">
                <select class="form-control" name="s_service">
                  <option value="All">All</option>
                  @foreach($services as $service)
                  <option value="{{$service->id}}" {{isset($data['s_service']) ? ($data['s_service'] == $service->id ? 'selected' : '') : ''}}>{{$service->name}}</option>
                  @endforeach
                </select>
              </div>
            </div>
          </div>
          <div class="form-group">
            <label class="control-label" for="s_invoice_code">Invoice code</label>
            <div class="hostline forms-control">
             <input type="text" name="s_invoice_code" value="{{isset($data['s_invoice_code']) ? $data['s_invoice_code'] : ''}}" placeholder="Invoice code">
            </div>
          </div>
          <div class="form-group">
            <label class="control-label" for="s_start_date">Start date</label>
            <div class="hostline forms-control">
             <input type="text" name="s_start_date" value="{{isset($data['s_start_date']) ? $data['s_start_date'] : ''}}" placeholder="Start date">
            </div>
          </div>
          <div class="form-group">
            <label class="control-label" for="s_end_date">End date</label>
            <div class="hostline forms-control">
             <input type="text" name="s_end_date" value="{{isset($data['s_end_date']) ? $data['s_end_date'] : ''}}" placeholder="End date">
            </div>
          </div>
          <div class="form-group">
            <label class="control-label" for="s_no_of_adults">No of Adults</label>
            <div class="hostline forms-control">
             <input type="text" name="s_no_of_adults" value="{{isset($data['s_no_of_adults']) ? $data['s_no_of_adults'] : ''}}" placeholder="No of Adults">
            </div>
          </div>
        </div>

        <div class="col-lg-4 col-md-4">
          <div class="form-group">
            <label class="control-label" for="s_no_of_children">No of Children</label>
            <div class="hostline forms-control">
             <input type="text" name="s_no_of_children" value="{{isset($data['s_no_of_children']) ? $data['s_no_of_children'] : ''}}" placeholder="No of Children">
            </div>
          </div>
          <div class="form-group">
            <label class="control-label" for="s_price">Price</label>
            <div class="hostline forms-control">
             <input type="text" name="s_price" value="{{isset($data['s_price']) ? $data['s_price'] : ''}}" placeholder="Price">
            </div>
          </div>
          <div class="form-group">
            <label class="control-label" for="s_menthod_payment">Payment method</label>
            <div class="gmail-kh forms-control">
              <div class="forms-control">
                <select class="form-control" name="s_menthod_payment">
                  <option value="All">All</option>
                  <option value="1" {{isset($data['s_menthod_payment']) ? ($data['s_menthod_payment'] == 1 ? 'selected' : '') : ''}}>Payment by month</option>
                  <option value="2" {{isset($data['s_menthod_payment']) ? ($data['s_menthod_payment'] == 2 ? 'selected' : '') : ''}}>Payment by apply</option>
                </select>
              </div>
            </div>
          </div>
          <div class="form-group">
            <label class="control-label" for="s_price_comm">Commission</label>
            <div class="hostline forms-control">
             <input type="text" name="s_price_comm" value="{{isset($data['s_price_comm']) ? $data['s_price_comm'] : ''}}" placeholder="Price commission">
            </div>
          </div>
          <div class="form-group">
            <label class="control-label" for="s_price_gst">Price gst</label>
            <div class="hostline forms-control">
             <input type="text" name="s_price_gst" value="{{isset($data['s_price_gst']) ? $data['s_price_gst'] : ''}}" placeholder="Price gst">
            </div>
          </div>
        </div>

        <div class="col-lg-4 col-md-4">
          <div class="form-group">
            <label class="control-label" for="s_price_su">Surchage fee</label>
            <div class="hostline forms-control">
             <input type="text" name="s_price_su" value="{{isset($data['s_price_su']) ? $data['s_price_su'] : ''}}" placeholder="Surchage fee">
            </div>
          </div>
          <div class="form-group">
            <label class="control-label" for="s_total">Total</label>
            <div class="hostline forms-control">
             <input type="text" name="s_total" value="{{isset($data['s_total']) ? $data['s_total'] : ''}}" placeholder="Total">
            </div>
          </div>
          <div class="form-group">
            <label class="control-label" for="s_agent">Agent</label>
            <div class="gmail-kh forms-control">
              <div class="forms-control">
                <select class="form-control" name="s_agent">
                  <option value="All">All</option>
                  @foreach($agents as $agent)
                  <option value="{{$agent->id}}" {{isset($data['s_agent']) ? ($data['s_agent'] == $agent->id ? 'selected' : '') : ''}}>{{$agent->name}}</option>
                  @endforeach
                </select>
              </div>
            </div>
          </div>
          <div class="form-group">
            <label class="control-label" for="s_status">Status</label>
            <div class="gmail-kh forms-control">
              <div class="forms-control">
                <select class="form-control" name="s_status">
                  <option value="All">All</option>
                  <option value="0" {{isset($data['s_status']) ? ($data['s_status'] == 0 ? 'selected' : '') : ''}}>Pending</option>
                  <option value="1" {{isset($data['s_status']) ? ($data['s_status'] == 1 ? 'selected' : '') : ''}}>Running</option>
                  <option value="2" {{isset($data['s_status']) ? ($data['s_status'] == 2 ? 'selected' : '') : ''}}>Reject</option>
                  <option value="3" {{isset($data['s_status']) ? ($data['s_status'] == 3 ? 'selected' : '') : ''}}>Time-expired</option>
                </select>
              </div>
            </div>
          </div>
          <div class="form-group">
            <label class="control-label" for="s_promotion">Promotion</label>
            <div class="hostline forms-control">
             <input type="text" name="s_promotion" value="{{isset($data['s_promotion']) ? $data['s_promotion'] : ''}}" placeholder="promotion">
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-lg-12 col-md-12 " style="clear: both;">
      <div class="bt-submit">
       <button type="submit" class="tim-kiem">Tìm kiếm</button>
       <button class="closes" type="button">Đóng</button>
       <input type="hidden" name="" value="" />
     </div>
    </div>
  </form>
</div>