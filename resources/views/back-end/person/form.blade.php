<div class="main-post col-md-8">
	<div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
		<label class="control-label">Tiêu tên</label>
		<div class="inner">
			<input type="text" class="form-control" name="name" id="name" 
			value="{{isset($obj) ? $obj->name : old('name')}}" placeholder="Nhập tên...">
		</div>
	</div>
	<div class="form-group {{ $errors->has('position') ? 'has-error' : '' }}">
		<label class="control-label">Vị trí, Chức vụ</label>
		<div class="inner">
			<input type="text" class="form-control" name="position" id="position" value="{{isset($obj) ? $obj->position : old('position')}}">
		</div>
	</div>
	<div class="form-group {{ $errors->has('birthday') ? 'has-error' : '' }}">
		<label class="control-label">Ngày sinh</label>
		<div class="inner">
			<input type="text" class="form-control" name="birthday" id="birthday" value="{{isset($obj) ? $obj->birthday : old('birthday')}}">
		</div>
	</div>
	<div class="form-group {{ $errors->has('phone') ? 'has-error' : '' }}">
		<label class="control-label">Số điện thoại</label>
		<div class="inner">
			<input type="text" class="form-control" name="phone" id="phone" value="{{isset($obj) ? $obj->phone : old('phone')}}">
		</div>
	</div>
	<div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
		<label class="control-label">Email</label>
		<div class="inner">
			<input type="text" class="form-control" name="email" id="email" value="{{isset($obj) ? $obj->email : old('email')}}">
		</div>
	</div>
	<div class="form-group {{ $errors->has('skype') ? 'has-error' : '' }}">
		<label class="control-label">Skype</label>
		<div class="inner">
			<input type="text" class="form-control" name="skype" id="skype" value="{{isset($obj) ? $obj->skype : old('skype')}}">
		</div>
	</div>
	<div class="form-group">
		<label class="control-label">Trạng thái (*)</label>
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

