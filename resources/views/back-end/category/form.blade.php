@if(isset($obj))
<input type="hidden" name="_id" value="{{$obj->id}}">
@endif
<div class="form-group {{ $errors->has('menu_id') ? 'has-error' : '' }}">
	<label class="col-sm-2 control-label">Menu Header (*) </label>
	<div class="col-sm-4">
		<select class="form-control" name="menu_id" id="menu_id" required>
			<option label=""></option>
			@foreach($menu_headers as $p)
				<option value="{{$p->id}}" {{isset($obj) ? ($obj->menu_id == $p->id ? "selected" : "") : ''}}>{{get_name($p)}}</option>
			@endforeach
		</select>
	</div>
</div>
<div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
	<label class="col-sm-2 control-label">Tên chuyên mục (EN) (*) </label>
	<div class="col-sm-4">
		<input type="text" class="form-control" name="name" id="name" value="{{isset($obj) ? $obj->name : ''}}" placeholder="" required>
	</div>
</div>
<div class="form-group {{ $errors->has('name_cn') ? 'has-error' : '' }}">
	<label class="col-sm-2 control-label">Tên chuyên mục (CN) (*) </label>
	<div class="col-sm-4">
		<input type="text" class="form-control" name="name_cn" id="name_cn" value="{{isset($obj) ? $obj->name_cn : ''}}" placeholder="" required>
	</div>
</div>
<div class="form-group {{ $errors->has('name_vi') ? 'has-error' : '' }}">
	<label class="col-sm-2 control-label">Tên chuyên mục (VI) (*) </label>
	<div class="col-sm-4">
		<input type="text" class="form-control" name="name_vi" id="name_vi" value="{{isset($obj) ? $obj->name_vi : ''}}" placeholder="" required>
	</div>
</div>
<div class="form-group {{ $errors->has('slug') ? 'has-error' : '' }}">
	<label class="col-sm-2 control-label">Đường dẫn (*)</label>
	<div class="col-sm-4">
		<input type="text" class="form-control" name="slug" id="slug" value="{{isset($obj) ? $obj->slug : ''}}" placeholder="">
	</div>
</div>
