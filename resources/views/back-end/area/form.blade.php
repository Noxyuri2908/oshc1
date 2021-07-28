@if(isset($obj))
<input type="hidden" name="_id" value="{{$obj->id}}">
@endif
<div class="form-group">
    <label class="col-sm-2 control-label">Tiêu đề, khu vực (EN)</label>
    <div class="col-sm-4">
        <input type="text" class="form-control" name="name" id="name" value="{{isset($obj) ? $obj->name : ''}}" placeholder="">
    </div>
</div>
<div class="form-group">
    <label class="col-sm-2 control-label">Tiêu đề, khu vực (CN)</label>
    <div class="col-sm-4">
        <input type="text" class="form-control" name="name_cn" id="name_cn" value="{{isset($obj) ? $obj->name_cn : ''}}" placeholder="">
    </div>
</div>
<div class="form-group">
    <label class="col-sm-2 control-label">Tiêu đề, khu vực (VI)</label>
    <div class="col-sm-4">
        <input type="text" class="form-control" name="name_vi" id="name_vi" value="{{isset($obj) ? $obj->name_vi : ''}}" placeholder="">
    </div>
</div>
