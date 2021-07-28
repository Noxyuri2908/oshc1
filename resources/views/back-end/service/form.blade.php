<div class="main-post col-md-8">
	<div class="form-group {{ $errors->has('dichvu_id') ? 'has-error' : '' }}">
		<label class="control-label">Service(*)</label>
		<div class="inner">
			@if(!isset($obj))
			<select class="form-control m-b" name="dichvu_id">
				<option label=""></option>
				@foreach($dichvus as $dichvu)
				<option value="{{$dichvu->id}}" {{old('dichvu_id') == $dichvu->id ? "selected" : ""}}>{{$dichvu->name}}</option>
				@endforeach
			</select>
			@else
			<select class="form-control m-b" name="dichvu_id">
				<option label=""></option>
				@foreach($dichvus as $dichvu)
				<option value="{{$dichvu->id}}" {{$obj->dichvu_id == $dichvu->id ? "selected" : ""}}>{{$dichvu->name}}</option>
				@endforeach
			</select>
			@endif
		</div>
	</div>
	<div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
		<label class="control-label">Provider(*)</label>
		<div class="inner">
			<input type="text" class="form-control" name="name" id="name"
			value="{{isset($obj) ? $obj->name : old('name')}}" placeholder="Nhập tiêu đề" required>
			<input type="hidden" name="_id" id="_id" value="{{isset($obj) ? $obj->id : ''}}">
		</div>
	</div>
	<div class="form-group lb-slug {{ $errors->has('slug') ? 'has-error' : '' }}">
		<label class="control-label">Slug(*)</label>
		<div class="inner">
			<input type="text" class="form-control" name="slug" id="slug" value="{{isset($obj) ? $obj->slug : old('slug')}}" required>
		</div>
	</div>
	<div class="form-group lb-slug">
		<label class="control-label">Link</label>
		<div class="inner">
			<input type="text" class="form-control" name="link" id="link" value="{{isset($obj) ? $obj->link : old('link')}}">
		</div>
	</div>
	<div class="form-group lb-slug">
		<label class="control-label">Email</label>
		<div class="inner">
			<input type="text" class="form-control" name="email" id="email" value="{{isset($obj) ? $obj->email : old('email')}}">
		</div>
	</div>
	<div class="box box-primary">
		<div class="form-group">
			<label class="control-label">Short description</label>
			<div>
				<textarea rows="5" placeholder="" class="form-control" name="des_s">{{isset($obj) ? $obj->des_s : ''}}</textarea>
			</div>
		</div>
		<div class="form-group">
			<label class="control-label">Full description</label>
			<div class="noi-dung">
				<textarea name="des_f" id="des_f" class="form-control my-editor" rows="40">
					{{isset($obj) ? $obj->content : old('content')}}
				</textarea>
			</div>
		</div>
	</div>
</div>
<div class="sidebar-post col-md-4">
	<div class="box box-primary">
		<div class="box-body box-profile">
			<div class="form-group {{ $errors->has('image') ? 'has-error' : '' }}">
				<label class="control-label">Logo (*)</label>
				<div class="thumb">
					<div class="input-group">
						<span class="input-group-btn">
							<a href="{{\Config::get('lfm.URL_FILEMANAGE_0')}}"
							class="btn btn-primary red iframe-btn" id="iframe-btn-0"><i
							class="fa fa-picture-o"></i>Chọn</a>
						</span>
						@if(isset($obj))
						<input id="thumb_0" class="form-control" type="text" name="image" value="{{$obj->image}}" required>
						@else
						<input id="thumb_0" class="form-control" type="text" name="image" required>
						@endif
					</div>

					<div id="preview_0">
						@if(isset($obj))
						<img src="{{$obj->image}}" style="max-width: 100%;">
						@else
						@endif
					</div>
				</div>
			</div>
		</div>
		<!-- /.box-body -->
	</div>
	<div class="form-group">
		<label class="control-label">No</label>
		<div class="inner">
			<input type="number" class="form-control" name="pos" id="pos" value="{{isset($obj) ? $obj->pos : old('pos')}}">
		</div>
	</div>
	<div class="form-group">
		<label class="control-label">Type get price (*)</label>
		<div class="inner">
			@if(!isset($obj))
			<select class="form-control m-b" name="price_type">
				<option value="1" {{old('price_type') == "1" ? "selected" : ""}}>API</option>
				<option value="0" {{old('price_type') == "0" ? "selected" : ""}}>Database</option>
			</select>
			@else
			<select class="form-control m-b" name="price_type">
				<option value="1" {{$obj->price_type == "1" ? "selected" : ""}}>API</option>
				<option value="0" {{$obj->price_type == "0" ? "selected" : ""}}>Database</option>
			</select>
			@endif
		</div>
	</div>
	<div class="form-group lb-slug {{ $errors->has('price') ? 'has-error' : '' }}">
		<label class="control-label">Price(*)</label>
		<div class="inner">
			<input type="number" class="form-control" name="price" id="price" value="{{isset($obj) ? $obj->price : old('price')}}" required>
		</div>
	</div>
	<div class="form-group lb-slug {{ $errors->has('currency_id') ? 'has-error' : '' }}">
		<label class="control-label">Unit(*)</label>
		<div class="inner">
			<select class="form-control" name="currency_id" required>
				<option label=""></option>
				@foreach(config('myconfig.currency') as $key=>$value)
				<option value="{{$key}}" {{isset($obj) ? ($obj->currency_id == $key ? 'selected' : '') : (old('currency_id') == $key ? 'selected' : '')}}>{{$value}}</option>
				@endforeach
			</select>
		</div>
	</div>
	<div class="form-group lb-slug {{ $errors->has('country') ? 'has-error' : '' }}">
		<label class="control-label">Country(*)</label>
		<div class="inner">
			<select class="form-control" name="country" required>
				<option label=""></option>
				@foreach(config('country.list') as $key=>$value)
				<option value="{{$key}}" {{isset($obj) ? ($obj->country == $key ? 'selected' : '') : (old('country') == $key ? 'selected' : '')}}>{{$value}}</option>
				@endforeach
			</select>
		</div>
	</div>
	<div class="form-group">
		<label class="control-label">Status (*)</label>
		<div class="inner">
			@if(!isset($obj))
			<select class="form-control m-b" name="status">
				<option value="1" {{old('status') == "1" ? "selected" : ""}}>Sử dụng</option>
				<option value="0" {{old('status') == "0" ? "selected" : ""}}>Chưa sử dụng</option>
			</select>
			@else
			<select class="form-control m-b" name="status">
				<option value="1" {{$obj->status == "1" ? "selected" : ""}}>Sử dụng</option>
				<option value="0" {{$obj->status == "0" ? "selected" : ""}}>Chưa sử dụng</option>
			</select>
			@endif
		</div>
	</div>
</div>

