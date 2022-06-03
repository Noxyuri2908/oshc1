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
<div class="form-group  {{ $errors->has('cat_benefit_id') ? 'has-error' : '' }}">
    <label class="col-sm-2 control-label">Loại lợi ích(*)</label>
    <div class="col-sm-4">
        <select name=cat_benefit_id class="form-control" required>
            <option label=""></option>
            @foreach($cat_benefits as $tmp)
            <option value="{{$tmp->id}}" 
                {{isset($obj) ? 
                    (($obj->cat_benefit_id == $tmp->id) ? 'selected' : '') 
                    : (old('cat_benefit_id') == $tmp->id ? 'selected' : '')}}>
                {{$tmp->name}}
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
