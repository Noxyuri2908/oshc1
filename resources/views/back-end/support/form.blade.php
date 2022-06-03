<div class="main-post col-md-8">
	<div class="form-group {{ $errors->has('process') ? 'has-error' : '' }}">
		<label class="control-label">Nội dung hoạt động *</label>
		<div class="inner">
			<input type="text" class="form-control" name="process" id="process" 
			value="{{isset($obj) ? $obj->process : old('process')}}" placeholder="Nội dung chăm sóc..." required>
		</div>
	</div>
	<div class="form-group {{ $errors->has('date') ? 'has-error' : '' }}">
		<label class="control-label">Ngày tháng</label>
		<div class="inner">
			<input type="text" class="form-control" name="date" id="date" value="{{isset($obj) ? $obj->date : old('date')}}">
		</div>
	</div>
	<div class="form-group">
		<label class="control-label">Tạo bởi *</label>
		<div class="inner">
			@if(!isset($obj))
			<select class="form-control m-b" name="role" id="role" required>
				<option label=""></option>
				@foreach($users as $p)
				<option value="{{$p->role}}" {{old('role') == $p->role ? "selected" : ""}}>{{$p->role}}</option>
				@endforeach
			</select> 
			@else
			<select class="form-control m-b" name="role" id="role" required>
				<option label=""></option>
				@foreach($users as $p)
				<option value="{{$p->role}}" {{$obj->role == $p->role ? "selected" : ""}}>{{$p->role}}</option>
				@endforeach
			</select>
			@endif                                           
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

