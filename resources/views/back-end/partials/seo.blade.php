</hr>
<div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
	<label class="control-label">Meta Tag Title </label>
	<div class="inner">
		<input type="text" class="form-control" name="meta_title" id="meta_title" 
				value="{{isset($obj->meta_title) ? $obj->meta_title : old('meta_title')}}">
	</div>
</div>
<div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
	<label class="control-label">Meta Tag Description </label>
	<div class="inner">
		<input type="text" class="form-control" name="meta_des" id="meta_des" 
		value="{{isset($obj->meta_des) ? $obj->meta_des : old('meta_des')}}">
	</div>
</div>
<div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
	<label class="control-label">Meta Tag Keyword</label>
	<div class="inner">
		<input type="text" class="form-control" name="meta_key" id="meta_key" 
		value="{{isset($obj->meta_key) ? $obj->meta_title : old('meta_key')}}">
	</div>
</div>