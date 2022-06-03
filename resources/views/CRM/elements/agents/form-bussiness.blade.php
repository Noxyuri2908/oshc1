@if(!isset($obj) || $obj->info == null)
{{-- sticky-top sticky-sidebar --}}
<div class="">
  <div class="card mb-3 overflow-hidden">
    <div class="card-header">
      <h5 class="mb-0">Bussiness Settings</h5>
    </div>
    <div class="card-body bg-light">
      <div class="pl-2">
          <select name="department" id="department" class="form-control">
          <option value="">Choose department ?</option>
          <option value="1">HA NOI</option>
          <option value="2">HO CHI MINH</option>
          </select>
      </div>
      <hr class="border-dashed border-bottom-0">
      <div class="pl-2">
          <select name="staff_id" id="staff_id" class="form-control">
            <option value="">Choose person in charge ?</option>
            @foreach($staffs as $staff)
            <option value="{{$staff->id}}">{{$staff->username}}</option>
            @endforeach
          </select>
      </div>
      <hr class="border-dashed border-bottom-0">
      <div class="pl-2">
          <select name="rating" id="rating" class="form-control">
            <option value="">Choose rating ?</option>
              <option value="A">A</option>
              <option value="B">B</option>
              <option value="C">C</option>
          </select>
      </div>
      <hr class="border-dashed border-bottom-0">
      <div class="pl-2">
          <select name="status2" id="status2" class="form-control">
            <option value="">Choose status agent ?</option>
              @foreach(config('admin.status') as $key=>$value)
              <option value="{{$key}}">{{$value}}</option>
              @endforeach
          </select>
      </div>
      <hr class="border-dashed border-bottom-0">
      <div class="custom-control custom-switch">
        <input class="custom-control-input" value="1" type="checkbox" id="gst" name="gst" checked="checked" />
        <label class="custom-control-label" for="gst">Include GST
        </label>
      </div>
      <div class="custom-control custom-switch">
        <input class="custom-control-input" value="1" type="checkbox" id="type_payment" name="type_payment"/>
        <label class="custom-control-label" for="type_payment">Payment commission by month
        </label>
      </div>
    </div>
  </div>
</div>
@else
<div class="sticky-top sticky-sidebar">
  <div class="card mb-3 overflow-hidden">
    <div class="card-header">
      <h5 class="mb-0">Bussiness Settings</h5>
    </div>
    <div class="card-body bg-light">
      {{-- <div class="pl-2">
          <select name="department" id="department" class="form-control">
          <option value="">Choose department ?</option>
          <option value="1" {{$obj->info->department == 1 ? 'selected' : ''}}>HA NOI</option>
          <option value="2" {{$obj->info->department == 0 ? 'selected' : ''}}>HO CHI MINH</option>
          </select>
      </div> --}}
      <hr class="border-dashed border-bottom-0">
      <div class="pl-2">
          <select name="staff_id" id="staff_id" class="form-control">
            <option value="">Choose person in charge ?</option>
            @foreach($staffs as $staff)
            <option value="{{$staff->id}}" {{$obj->staff_id == $staff->id ? 'selected' : ''}}>{{$staff->username}}</option>
            @endforeach
          </select>
      </div>
      <hr class="border-dashed border-bottom-0">
      <div class="pl-2">
          <select name="rating" id="rating" class="form-control">
            <option value="">Choose rating ?</option>
              <option value="A" {{$obj->info->rating == "A" ? 'selected' : ''}}>A</option>
              <option value="B" {{$obj->info->rating == "B" ? 'selected' : ''}}>B</option>
              <option value="C" {{$obj->info->rating == "C" ? 'selected' : ''}}>C</option>
          </select>
      </div>
      <hr class="border-dashed border-bottom-0">
      <div class="pl-2">
          <select name="status2" id="status2" class="form-control">
            <option value="">Choose status agent ?</option>
              @foreach(config('admin.status') as $key=>$value)
              <option value="{{$key}}" {{$obj->info->status == $key ? 'selected' : ''}}>{{$value}}</option>
              @endforeach
          </select>
      </div>
      <hr class="border-dashed border-bottom-0">
      <div class="custom-control custom-switch">
        <input class="custom-control-input" value="1" type="checkbox" id="gst" name="gst" {{$obj->info->gst == 1 ? 'checked' : ''}} />
        <label class="custom-control-label" for="gst">Include GST
        </label>
      </div>
      <div class="custom-control custom-switch">
        <input class="custom-control-input" value="1" type="checkbox" id="type_payment" name="type_payment" {{$obj->info->type_payment == 1 ? 'checked' : ''}} />
        <label class="custom-control-label" for="type_payment">Payment commission by month
        </label>
      </div>
    </div>
  </div>
</div>
@endif
