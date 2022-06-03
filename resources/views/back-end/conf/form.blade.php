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
<div class="form-group  {{ $errors->has('benefit_id') ? 'has-error' : '' }}">
    <label class="col-sm-2 control-label">Lợi ích(*)</label>
    <div class="col-sm-4">
        <select name=benefit_id class="form-control" required>
            <option label=""></option>
            @foreach($benefits as $benefit)
            <option value="{{$benefit->id}}" 
                {{isset($obj) ? 
                    (($obj->benefit_id == $benefit->id) ? 'selected' : '') 
                    : (old('benefit_id') == $benefit->id ? 'selected' : '')}}>
                {{$benefit->name}}
            </option>
            @endforeach
        </select>
    </div>
</div>
<div class="form-group">
    <label class="col-sm-2 control-label">Ghi chú (EN)</label>
    <div class="col-sm-4">
        <input type="text" class="form-control" name="note" id="note" value="{{isset($obj) ? $obj->note : ''}}" 
        placeholder="">
    </div>
</div>
<div class="form-group">
    <label class="col-sm-2 control-label">Ghi chú (CN)</label>
    <div class="col-sm-4">
        <input type="text" class="form-control" name="note_cn" id="note_cn" value="{{isset($obj) ? $obj->note_cn : ''}}" 
        placeholder="">
    </div>
</div>
<div class="form-group">
    <label class="col-sm-2 control-label">Ghi chú (VI)</label>
    <div class="col-sm-4">
        <input type="text" class="form-control" name="note_vi" id="note_vi" value="{{isset($obj) ? $obj->note_vi : ''}}" 
        placeholder="">
    </div>
</div>
