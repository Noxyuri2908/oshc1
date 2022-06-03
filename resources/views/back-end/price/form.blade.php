@if(isset($obj))
<input type="hidden" name="_id" value="{{$obj->id}}">
@endif
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
<div class="form-group {{ $errors->has('num_month') ? 'has-error' : '' }}">
    <label class="col-sm-2 control-label">Số tháng(*)</label>
    <div class="col-sm-4">
        <input type="number" class="form-control" name="num_month" id="num_month" value="{{isset($num_month) ? $obj->num_month : ''}}" 
        placeholder="1" required>
    </div>
</div>
<div class="form-group {{ $errors->has('price') ? 'has-error' : '' }}">
    <label class="col-sm-2 control-label">Giá(*)</label>
    <div class="col-sm-4">
        <input type="number" class="form-control" name="price" id="price" value="{{isset($price) ? $obj->price : ''}}" 
        placeholder="1" required>
    </div>
</div>
