@if(isset($obj))
<input type="hidden" name="_id" value="{{!empty($obj) ? $obj->id : ''}}">
@endif
<div class="form-group">
	<label class="col-sm-2 control-label">Area</label>
	<div class="col-sm-4">
		<select class="form-control m-b" name="area_id">
			<option label=""></option>
			@foreach($areas as $area)
			<option value="{{$area->id}}" {{isset($obj) ? ($obj->area_id == $area->id ? 'selected' : '') : (old('area_id') == $area->id ? 'selected' : '')}}>{{$area->name}}</option>
			@endforeach
		</select>
	</div>
</div>
<div class="form-group">
    <label class="col-sm-2 control-label">Question (EN)</label>
    <div class="col-sm-4">
        <textarea rows="5" placeholder="" class="form-control" name="name">{{isset($obj) ? $obj->name : ''}}</textarea>
    </div>
</div>
<div class="form-group">
    <label class="col-sm-2 control-label">Question (CN)</label>
     <div class="col-sm-4">
        <textarea rows="5" placeholder="" class="form-control" name="name_cn">{{isset($obj) ? $obj->name_cn : ''}}</textarea>
    </div>
</div>
<div class="form-group">
    <label class="col-sm-2 control-label">Question (VI)</label>
     <div class="col-sm-4">
        <textarea rows="5" placeholder="" class="form-control" name="name_vi">{{isset($obj) ? $obj->name_vi : ''}}</textarea>
    </div>
</div>

<div class="form-group {{ $errors->has('content') ? 'has-error' : '' }}">
    <label class="col-sm-2 control-label">Answer (EN)</label>
    <div class="col-sm-4">
        <textarea rows="5" placeholder="" class="form-control" name="content">{{isset($obj) ? $obj->content : ''}}</textarea>
    </div>
</div>
<div class="form-group {{ $errors->has('content_cn') ? 'has-error' : '' }}">
    <label class="col-sm-2 control-label">Answer (CN)</label>
    <div class="col-sm-4">
        <textarea rows="5" placeholder="" class="form-control" name="content_cn">{{isset($obj) ? $obj->content_cn : ''}}</textarea>
    </div>
</div>
<div class="form-group {{ $errors->has('content_vi') ? 'has-error' : '' }}">
    <label class="col-sm-2 control-label">Answer (VI)</label>
    <div class="col-sm-4">
        <textarea rows="5" placeholder="" class="form-control" name="content_vi">{{isset($obj) ? $obj->content_vi : ''}}</textarea>
    </div>
</div>
