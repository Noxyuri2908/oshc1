@if(isset($obj))
<input type="hidden" name="_id" value="{{$obj->id}}">
@endif
<div class="form-group">
    <label class="col-sm-2 control-label">Tiêu đề (EN)(*)</label>
    <div class="col-sm-4">
        <input type="text" class="form-control" name="name" id="name" value="{{isset($obj) ? $obj->name : ''}}" placeholder="" required>
    </div>
</div>
<div class="form-group">
    <label class="col-sm-2 control-label">Tiêu đề (CN)(*)</label>
    <div class="col-sm-4">
        <input type="text" class="form-control" name="name_cn" id="name_cn" value="{{isset($obj) ? $obj->name_cn : ''}}" placeholder="" required>
    </div>
</div>
<div class="form-group">
    <label class="col-sm-2 control-label">Tiêu đề (VI)(*)</label>
    <div class="col-sm-4">
        <input type="text" class="form-control" name="name_vi" id="name_vi" value="{{isset($obj) ? $obj->name_vi : ''}}" placeholder="" required>
    </div>
</div>
<div class="form-group">
    <label class="col-sm-2 control-label">Link(*)</label>
    <div class="col-sm-4">
        <input type="text" class="form-control" name="link" id="link" value="{{isset($obj) ? $obj->link : ''}}" placeholder="" required>
    </div>
</div>
<div class="form-group">
    <label class="col-sm-2 control-label">Miêu tả ngắn</label>
    <div class="col-sm-8">
        <textarea name="des_s" id="des_s" class="form-control my-editor" rows="40">
            {{isset($obj) ? $obj->des_s : old('des_s')}}
        </textarea>
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
<div class="form-group">
    <label class="col-sm-2 control-label">Vị trí</label>
    <div class="col-sm-4">
        <input type="number" class="form-control" name="pos" id="pos" value="{{isset($obj) ? $obj->pos : ''}}" 
        placeholder="1">
    </div>
</div>
