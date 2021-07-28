@if(isset($obj))
<input type="hidden" name="_id" value="{{$obj->id}}">
@endif
<div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
	<label class="col-sm-2 control-label">Tên trang (*) </label>
	<div class="col-sm-8">
		<input type="text" class="form-control" name="name" id="name" value="{{isset($obj) ? $obj->name : ''}}" placeholder="Trang chủ" required>
	</div>
</div>
<div class="form-group {{ $errors->has('slug') ? 'has-error' : '' }}">
	<label class="col-sm-2 control-label">Đường dẫn (*)</label>
	<div class="col-sm-8">
		<input type="text" class="form-control" name="slug" id="slug" value="{{isset($obj) ? $obj->slug : ''}}" placeholder="trang-chu">
	</div>
</div>
<div class="form-group {{ $errors->has('content') ? 'has-error' : '' }}">
	<label class="col-sm-2 control-label">Nội dung</label>
	<div class="col-sm-8">
		<textarea name="content" id="content" class="form-control my-editor" rows="40">
			{!! isset($obj) ? $obj->content : view('back-end.page.about') !!}
		</textarea>
	</div>
</div>
