@if(isset($obj))
<input type="hidden" name="_id" value="{{$obj->id}}">
@endif
<div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
	<label class="col-sm-2 control-label">Name  (EN) (*) </label>
	<div class="col-sm-4">
		<input type="text" class="form-control" name="name" id="name" value="{{isset($obj) ? $obj->name : ''}}" placeholder="" required>
	</div>
</div>
<div class="form-group {{ $errors->has('name_cn') ? 'has-error' : '' }}">
	<label class="col-sm-2 control-label">Name (CN) (*) </label>
	<div class="col-sm-4">
		<input type="text" class="form-control" name="name_cn" id="name_cn" value="{{isset($obj) ? $obj->name_cn : ''}}" placeholder="" required>
	</div>
</div>
<div class="form-group {{ $errors->has('name_vi') ? 'has-error' : '' }}">
	<label class="col-sm-2 control-label">Name (VI) (*) </label>
	<div class="col-sm-4">
		<input type="text" class="form-control" name="name_vi" id="name_vi" value="{{isset($obj) ? $obj->name_vi : ''}}" placeholder="" required>
	</div>
</div>
<div class="form-group {{ $errors->has('slug') ? 'has-error' : '' }}">
	<label class="col-sm-2 control-label">Slug (*)</label>
	<div class="col-sm-4">
		<input type="text" class="form-control" name="slug" id="slug" value="{{isset($obj) ? $obj->slug : ''}}" placeholder="">
	</div>
</div>
<div class="form-group {{ $errors->has('pos') ? 'has-error' : '' }}">
	<label class="col-sm-2 control-label">Position</label>
	<div class="col-sm-4">
		<input type="number" class="form-control" name="pos" id="pos" value="{{isset($obj) ? $obj->pos : ''}}" placeholder="1">
	</div>
</div>
