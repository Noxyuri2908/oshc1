<div class="main-post col-md-8">
	<div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
		<label class="control-label">Title  (EN)(*)</label>
		<div class="inner">
			<input type="text" class="form-control" name="name" id="name" 
			value="{{isset($obj) ? $obj->name : old('name')}}" placeholder="" required>
			<input type="hidden" name="_id" id="_id" value="{{isset($obj) ? $obj->id : ''}}">
		</div>
	</div>
	<div class="form-group {{ $errors->has('name_cn') ? 'has-error' : '' }}">
		<label class="control-label">Title (CN)(*)</label>
		<div class="inner">
			<input type="text" class="form-control" name="name_cn" id="name_cn" 
			value="{{isset($obj) ? $obj->name_cn : old('name_cn')}}" placeholder="" required>
		</div>
	</div>
	<div class="form-group {{ $errors->has('name_vi') ? 'has-error' : '' }}">
		<label class="control-label">Title (VI)(*)</label>
		<div class="inner">
			<input type="text" class="form-control" name="name_vi" id="name_vi" 
			value="{{isset($obj) ? $obj->name_vi : old('name_vi')}}" placeholder="" required>
		</div>
	</div>
	<div class="box box-primary">
		<div class="form-group {{ $errors->has('content') ? 'has-error' : '' }}">
			<label class="control-label">Content (EN)(*)</label>
			<div class="noi-dung">
				<textarea name="content" id="content" class="form-control my-editor" rows="40" required>
					{{isset($obj) ? $obj->content : old('content')}}
				</textarea>
			</div>
		</div>
		<div class="form-group {{ $errors->has('content_cn') ? 'has-error' : '' }}">
			<label class="control-label">Content (CN)(*)</label>
			<div class="noi-dung">
				<textarea name="content_cn" id="content_cn" class="form-control my-editor" rows="40" required>
					{{isset($obj) ? $obj->content_cn : old('content_cn')}}
				</textarea>
			</div>
		</div>
		<div class="form-group {{ $errors->has('content_vi') ? 'has-error' : '' }}">
			<label class="control-label">Content (VI)(*)</label>
			<div class="noi-dung">
				<textarea name="content_vi" id="content_vi" class="form-control my-editor" rows="40" required>
					{{isset($obj) ? $obj->content_vi : old('content_vi')}}
				</textarea>
			</div>
		</div>
	</div>
</div>
<div class="sidebar-post col-md-4">
	<div class="form-group">
		<label class="control-label">Type Mail(*)</label>
		<div class="inner">
			<select class="form-control m-b" name="type" id="type" required>
				<option label=""></option>
				@foreach($types as $key=>$value)
				<option value="{{$key}}" {{isset($obj) ? ($obj->type == $key ? 'selected' : '') : (old('type') == $key ? 'selected' : '')}}>{{$value}}</option>
				@endforeach
			</select>
		</div>
	</div>
	<div class="form-group">
		<label class="control-label">Status (*)</label>
		<div class="inner">
			@if(!isset($obj))
			<select class="form-control m-b" name="status">
				<option value="1" {{old('status') == "1" ? "selected" : ""}}>Active</option>
				<option value="0" {{old('status') == "0" ? "selected" : ""}}>Deactive</option>
			</select>
			@else
			<select class="form-control m-b" name="status">
				<option value="1" {{$obj->status == "1" ? "selected" : ""}}>Active</option>
				<option value="0" {{$obj->status == "0" ? "selected" : ""}}>Deactive</option>
			</select>
			@endif
		</div>
	</div>
</div>

