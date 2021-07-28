<div class="panel-body">
    <fieldset class="form-horizontal">
    	<input type="hidden" name="user_id" value="{{isset($obj) ? $obj->id : ''}}">
        <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
            <label class="col-sm-2 control-label">Email (*) </label>
            <div class="col-sm-5">
                <input type="text" class="form-control" name="email" id="email" 
                value="{{isset($obj) ? $obj->email : old('email')}}" required>
            </div>
        </div>
        <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
            <label class="col-sm-2 control-label">Tên người dùng (*) </label>
            <div class="col-sm-5">
                <input type="text" class="form-control" name="name" id="name" 
                value="{{isset($obj) ? $obj->name : old('name')}}" required>
            </div>
        </div>
        <div class="form-group {{ $errors->has('password') ? 'has-error' : '' }}">
            <label class="col-sm-2 control-label">Mật khẩu {{isset($obj) ? "" : "(*)"}}</label>
            <div class="col-sm-5">
                @if(isset($obj))
                <input type="password" style="font-style: italic;" class="form-control" name="password_new" id="password_new" 
                value="{{old('password_new')}}" placeholder="Nhập mật khẩu mới nếu muốn thay đổi">
                @else
                <input type="password" class="form-control" name="password" id="password" 
                value="{{old('password')}}" required>
                @endif
            </div>
        </div>     
        @include('back-end.partials.status')
    </fieldset>
</div>