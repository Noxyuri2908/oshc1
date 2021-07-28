@if(isset($obj))
<input type="hidden" name="_id" value="{{$obj->id}}">
@endif
<div class="form-group">
    <label class="col-sm-2 control-label">Tên (EN)(*)</label>
    <div class="col-sm-4">
        <input type="text" class="form-control" name="name" id="name" value="{{isset($obj) ? $obj->name : ''}}" placeholder="" required>
    </div>
</div>
<div class="form-group">
    <label class="col-sm-2 control-label">Tên (CN)(*)</label>
    <div class="col-sm-4">
        <input type="text" class="form-control" name="name_cn" id="name_cn" value="{{isset($obj) ? $obj->name_cn : ''}}" placeholder="" required>
    </div>
</div>
<div class="form-group">
    <label class="col-sm-2 control-label">Tên (VI)(*)</label>
    <div class="col-sm-4">
        <input type="text" class="form-control" name="name_vi" id="name_vi" value="{{isset($obj) ? $obj->name_vi : ''}}" placeholder="" required>
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
<div class="form-group">
    <label class="col-sm-2 control-label">Vị trí</label>
    <div class="col-sm-4">
        <input type="number" class="form-control" name="pos" id="pos" value="{{isset($obj) ? $obj->pos : ''}}" 
        placeholder="1">
    </div>
</div>
