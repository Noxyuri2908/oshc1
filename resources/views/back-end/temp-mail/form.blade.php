<div class="main-post col-md-8">
	<div class="box box-primary">
		<div class="form-group {{ $errors->has('content') ? 'has-error' : '' }}">
			<label class="control-label">Content Sign (EN)(*)</label>
			<div class="noi-dung">
				<textarea name="content" id="content" class="form-control my-editor" rows="40" required>
					{{isset($obj) ? $obj->content : old('content')}}
				</textarea>
			</div>
		</div>
		<div class="form-group {{ $errors->has('content_cn') ? 'has-error' : '' }}">
			<label class="control-label">Content Sign (CN)(*)</label>
			<div class="noi-dung">
				<textarea name="content_cn" id="content_cn" class="form-control my-editor" rows="40" required>
					{{isset($obj) ? $obj->content_cn : old('content_cn')}}
				</textarea>
			</div>
		</div>
		<div class="form-group {{ $errors->has('content_vi') ? 'has-error' : '' }}">
			<label class="control-label">Content Sign (VI)(*)</label>
			<div class="noi-dung">
				<textarea name="content_vi" id="content_vi" class="form-control my-editor" rows="40" required>
					{{isset($obj) ? $obj->content_vi : old('content_vi')}}
				</textarea>
			</div>
		</div>
	</div>
</div>
<div class="sidebar-post col-md-4">
	<div class="box box-primary">
		<div class="box-body box-profile">
			<div class="form-group {{ $errors->has('banner') ? 'has-error' : '' }}">
				<label class="control-label">Banner(*)</label>
				<div class="thumb">
					<div class="input-group">
						<span class="input-group-btn">
							<a href="{{\Config::get('lfm.URL_FILEMANAGE_0')}}"
							class="btn btn-primary red iframe-btn" id="iframe-btn-0"><i
							class="fa fa-picture-o"></i>Select</a>
						</span>
						@if(isset($obj))
						<input id="thumb_0" class="form-control" type="text" name="banner" value="{{$obj->banner}}" required>
						@else
						<input id="thumb_0" class="form-control" type="text" name="banner" required>
						@endif
					</div>
					<div id="preview_0">
						@if(isset($obj))
						<img src="{{$obj->banner}}" style="max-width: 100%;">
						@else
						@endif
					</div>
				</div>
			</div>
		</div>
		<!-- /.box-body -->
	</div>
	<div class="box box-primary">
		<div class="box-body box-profile">
			<div class="form-group {{ $errors->has('background_footer') ? 'has-error' : '' }}">
				<label class="control-label">Background Sign(*)</label>
				<div class="thumb">
					<div class="input-group">
						<span class="input-group-btn">
							<a href="{{\Config::get('lfm.URL_FILEMANAGE_0')}}"
							class="btn btn-primary red iframe-btn" id="iframe-btn-1"><i
							class="fa fa-picture-o"></i>Select</a>
						</span>
						@if(isset($obj))
						<input id="thumb_1" class="form-control" type="text" name="background_footer" value="{{$obj->background_footer}}" required>
						@else
						<input id="thumb_1" class="form-control" type="text" name="background_footer" required>
						@endif
					</div>
					<div id="preview_1">
						@if(isset($obj))
						<img src="{{$obj->background_footer}}" style="max-width: 100%;">
						@else
						@endif
					</div>
				</div>
			</div>
		</div>
		<!-- /.box-body -->
	</div>
	<div class="form-group">
		<label class="control-label">Tempate Mail(*)</label>
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

