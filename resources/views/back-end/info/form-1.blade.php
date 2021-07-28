<div class="panel-body">
    <fieldset class="form-horizontal">
    	<input type="hidden" name="user_id" value="{{isset($obj) ? $obj->id : ''}}">
        <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
            <label class="col-sm-2 control-label">Email (*) </label>
            <div class="col-sm-4">
                <input type="text" class="form-control" name="email" id="email" 
                value="{{isset($obj) ? $obj->email : old('email')}}" required>
            </div>
        </div>
        <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
            <label class="col-sm-2 control-label">Username (*) </label>
            <div class="col-sm-4">
                <input type="text" class="form-control" name="name" id="name" 
                value="{{isset($obj) ? $obj->name : old('name')}}" required>
            </div>
        </div>
        <div class="form-group {{ $errors->has('password') ? 'has-error' : '' }}">
            <label class="col-sm-2 control-label">Password {{isset($obj) ? "" : "(*)"}}</label>
            <div class="col-sm-4">
                @if(isset($obj))
                <input type="password" style="font-style: italic;" class="form-control" name="password_new" id="password_new" 
                value="{{old('password_new')}}" placeholder="New password (only fill when you want to change password)">
                @else
                <input type="password" class="form-control" name="password" id="password" 
                value="{{old('password')}}" required>
                @endif
            </div>
        </div>
        @if($account->can('assign-agent'))
        <div class="form-group {{ $errors->has('staff_id') ? 'has-error' : '' }}">
            <label class="col-sm-2 control-label">Assign for</label>
            <div class="col-sm-4">
                <select name=staff_id class="form-control" required>
                    <option label=""></option>
                    @foreach($staffs as $staff)
                    <option value="{{$staff->id}}" {{isset($obj) ? ($obj->staff_id == $staff->id ? 'selected' : ''):  (old('staff_id') ==  $staff->id ? 'selected' : '')}}>{{$staff->username}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        @endif
        @if(isset($obj) && $account->can('assign-agent',$obj))
        <div class="form-group">
            <label class="col-sm-2 control-label">Share for</label>
            <div class="col-sm-4">
                <select data-placeholder="Choose staff for share agent information" name=shares[] 
                    class="form-control chosen-select" multiple tabindex="4">
                        @foreach($staffs as $st)
                            <option value="{{$st->id}}"
                                {{isset($obj) ? (in_array($st->id, $obj->array_shares) ? 'selected' : '') : ''}}>
                                {{$st->username}}
                            </option>
                        @endforeach
                </select>
            </div>
        </div>
        @endif
        <div class="form-group  {{ $errors->has('status') ? 'has-error' : '' }}">
            <label class="col-sm-2 control-label">Status account (*)</label>
            <div class="col-sm-4">
                <select name=status class="form-control" required>
                    <option label=""></option>
                    <option value="0" {{isset($obj) ? ($obj->status == 0 ? 'selected' : ''):  (old('status') == 0 ? 'selected' : '')}}>Pending</option>
                    <option value="1" {{isset($obj) ? ($obj->status == 1 ? 'selected' : ''):  (old('status') == 1 ? 'selected' : '')}}>Active</option>
                    <option value="2" {{isset($obj) ? ($obj->status == 2 ? 'selected' : ''):  (old('status') == 2 ? 'selected' : '')}}>Deactive</option>
                </select>
            </div>
        </div>
    </fieldset>
</div>