<div class="col-xl-12">
    <div class="card mb-3">
        <div class="card-header">
          <div class="chevron-down-up">
            <h5 class="mb-0">Agent info</h5>
            <p class="click-down" data-id="account"><span class="fas fa-chevron-down"></span></p>
          </div>
        </div>
        <div class="card-body bg-light" data-id="account">
          <div class="row">
            <div class="col-lg-4">
              <div class="form-group">
                <label for="agent_id">Agent</label>
                <select class="form-control" id="agent_id" name="agent_id" required>
                  {{-- <option data-country="" label=""></option> --}}
                  @foreach($agents as $agent)
                  @if(!isset($obj))
                  <option data-country="{{$agent->country()}}" value="{{$agent->id}}" {{$agent->is_default == 1 ? 'selected' : ''}}>{{$agent->name}}</option>
                  @else
                  <option data-country="{{$agent->country()}}" value="{{$agent->id}}" {{$obj->agent_id == $agent->id ? 'selected' : ''}}>{{$agent->name}}</option>
                  @endif
                  @endforeach
                </select>
              </div>
            </div>

            <div class="col-lg-4">
              <div class="form-group">
                <label for="name">Agent country</label>
                <input class="form-control"  id="agent_country" type="text" placeholder="" readonly>
              </div>
            </div>

            <div class="col-lg-4">
              <div class="form-group">
                <label for="master_agent">Master agent</label>
                <select class="form-control" id="master_agent" name="master_agent">
                  <option data-country="" label=""></option>
                  @foreach($agents as $agent)
                  @if(!isset($obj))
                  <option value="{{$agent->id}}" {{old('master_agent') == $agent->id ? 'selected' : ''}}>{{$agent->name}}</option>
                  @else
                  <option  value="{{$agent->id}}" {{$obj->master_agent == $agent->id ? 'selected' : ''}}>{{$agent->name}}</option>
                  @endif
                  @endforeach
                </select>
              </div>
            </div>

            <div class="col-lg-4">
              <div class="form-group">
                <label for="name">Commission</label>
                <input class="form-control"  id="comm_agent" type="text" placeholder="" readonly>
              </div>
            </div>
            <div class="col-lg-4">
              <div class="form-group">
                <label for="name">GST</label>
                <input class="form-control"  id="comm_gst" type="text" placeholder="" readonly>
              </div>
            </div>
            <div class="col-lg-4">
              <div class="form-group">
                <label for="name">Type payment</label>
                <input class="form-control"  id="comm_type_payment" type="text" placeholder="" readonly>
              </div>
            </div>
            <!-- HIDDEN DATA -->
            <input type="hidden" id="data_comm_agent" value="0">
            <input type="hidden" id="data_unit_comm_agent" value="1">
            <input type="hidden" id="data_gst_agent" value="0">
            <input type="hidden" id="data_type_payment_agent" value="1">
          </div>
        </div>
      </div>
</div>
