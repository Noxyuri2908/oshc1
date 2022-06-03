@if(isset($obj))
<input type="hidden" name="_id" value="{{$obj->id}}">
@endif
<div class="form-group  {{ $errors->has('user_id') ? 'has-error' : '' }}">
    <label class="col-sm-2 control-label">Agent(*)</label>
    <div class="col-sm-4">
        <select name=user_id class="form-control" required>
            <option label=""></option>
            @foreach($agents as $agent)
            <option value="{{$agent->id}}" 
                {{isset($obj) ? 
                    (($obj->user_id == $agent->id) ? 'selected' : '') 
                    : (old('user_id') == $agent->id ? 'selected' : '')}}>
                {{$agent->name}}
            </option>
            @endforeach
        </select>
    </div>
</div>
<div class="form-group  {{ $errors->has('service_id') ? 'has-error' : '' }}">
    <label class="col-sm-2 control-label">Dịch vụ(*)</label>
    <div class="col-sm-4">
        <select name=service_id class="form-control" required>
            <option label=""></option>
            @foreach($services as $service)
            <option value="{{$service->id}}" 
                {{isset($obj) ? 
                    (($obj->service_id == $service->id) ? 'selected' : '') 
                    : (old('service_id') == $service->id ? 'selected' : '')}}>
                {{$service->name}}
            </option>
            @endforeach
        </select>
    </div>
</div>
<div class="form-group  {{ $errors->has('type') ? 'has-error' : '' }}">
    <label class="col-sm-2 control-label">Loại dịch vụ(*)</label>
    <div class="col-sm-4">
        <select name=type class="form-control" required>
            <option label=""></option>
            <option value="1" {{isset($obj) ? (($obj->type == 1) ? 'selected' : '') 
                    : (old('type') == 1 ? 'selected' : '')}}>
                Single
            </option>
            <option value="2" {{isset($obj) ? (($obj->type == 2) ? 'selected' : '') 
                    : (old('type') == 2 ? 'selected' : '')}}>
                Couple
            </option>
             <option value="3" {{isset($obj) ? (($obj->type == 3) ? 'selected' : '') 
                    : (old('type') == 3 ? 'selected' : '')}}>
                Family
            </option>
        </select>
    </div>
</div>
<div class="form-group {{ $errors->has('comm') ? 'has-error' : '' }}">
    <label class="col-sm-2 control-label">Hoa hồng (*) </label>
    <div class="col-sm-4">
        <input type="text" class="form-control" name="comm" id="comm" value="{{isset($obj) ? $obj->comm : ''}}" placeholder="Trang chủ" required>
    </div>
</div>
<div class="form-group {{ $errors->has('date') ? 'has-error' : '' }}">
    <label class="col-sm-2 control-label">Ngày hết hạn (*) </label>
    <div class="col-sm-4">
        <input type="text" class="form-control" name="date" id="date" value="{{isset($obj) ? $obj->date : ''}}" placeholder="Trang chủ" required>
    </div>
</div>
