@if($obj != null)
@php
$info = $obj->info;
@endphp
@if($info != null)
<div class="modal fade user-information" id="modal_agent_info" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Detail of Agent</h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span class="font-weight-light" aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="content-information">
         <h3 class="name">
{{--          <a href="{{route('crm.agent.edit',['id'=>$obj->id])}}">{{$obj->name}}</a>--}}
         </h3>
         <div class="row">
          <div class="col-md-6 content-table">
           <div class="form-group">
            <label class="control-label">Email:</label>
            <input type="text" name="" value="{{$obj->email}}" readonly>
          </div>

        </div>
        <div class="col-md-6 content-table">
         <div class="form-group">
          <label class="control-label">Status:</label>
          <input type="text" name="" value="{{$obj->status == 1 ? "Active" : "De-active"}}" readonly>
        </div>
      </div>
      <div class="col-md-6 content-table">
        <div class="form-group">
          <label class="control-label">Person in charge:</label>
          <input type="text" name="" value="{{$obj->staff != null ? $obj->staff->username : '' }}" readonly>
        </div>
      </div>
      <div class="col-md-6 content-table">
        <div class="form-group">
          <label class="control-label">Registered date:</label>
          <input type="text" name="" value="{{$info->registered_date}}" readonly>
        </div>
      </div>
      <div class="col-md-6 content-table">
        <div class="form-group">
          <label class="control-label">Agent code:</label>
          <input type="text" name="" value="{{$info->agent_code}}" readonly>
        </div>
      </div>
      <div class="col-md-6 content-table">
        <div class="form-group">
          <label class="control-label">Status Business:</label>
          <input type="text" name="" value="{{$info->text_status}}" readonly>
        </div>
      </div>
      <div class="col-md-6 content-table">
        <div class="form-group">
          <label class="control-label">Rating:</label>
          <input type="text" name="" value="{{$info->rating}}" readonly>
        </div>
      </div>
      <div class="col-md-6 content-table">
        <div class="form-group">
          <label class="control-label">Country:</label>
          <input type="text" name="" value="{{isset(config('country.list')[$info->country]) ? config('country.list')[$info->country] : ''}}" readonly>
        </div>
      </div>
      <div class="col-md-6 content-table">
        <div class="form-group">
          <label class="control-label">City:</label>
          <input type="text" name="" value="{{$info->city}}" readonly>
        </div>
      </div>
      <div class="col-md-6 content-table">
        <div class="form-group">
          <label class="control-label">Office:</label>
          <input type="text" name="" value="{{$info->office}}" readonly>
        </div>
      </div>
      <div class="col-md-6 content-table">
        <div class="form-group">
          <label class="control-label">Tel 1:</label>
          <input type="text" name="" value="{{$info->tel_1}}" readonly>
        </div>
      </div>
      <div class="col-md-6 content-table">
        <div class="form-group">
          <label class="control-label">Tel 2:</label>
          <input type="text" name="" value="{{$info->tel_2}}" readonly>
        </div>
      </div>
      <div class="col-md-6 content-table">
        <div class="form-group">
          <label class="control-label">Facebook:</label>
          <input type="text" name="" value="{{$info->fb}}" readonly>
        </div>
      </div>
      <div class="col-md-6 content-table">
        <div class="form-group">
          <label class="control-label">Website:</label>
          <input type="text" name="" value="{{$info->website}}" readonly>
        </div>
      </div>
      <div class="col-md-6 content-table">
        <div class="form-group">
          <label class="control-label">Gst:</label>
          <input type="text" name="" value="{{$info->gst == 1 ? 'Include' : 'Not Include'}}" readonly>
        </div>
      </div>
      <div class="col-md-6 content-table">
        <div class="form-group">
          <label class="control-label">Type payment:</label>
          <input type="text" name="" value="{{$info->type_payment == 1 ? 'Pay by month' : 'Pay by apply'}}" readonly>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="modal-footer">
  <button class="btn btn-secondary btn-sm" type="button" data-dismiss="modal">Close</button>
</div>
</div>
</div>
</div>
@endif
@endif
