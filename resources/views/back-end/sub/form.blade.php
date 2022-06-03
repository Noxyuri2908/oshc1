@if(isset($obj))
<input type="hidden" name="_id" value="{{$obj->id}}">
@endif
<div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
    <label class="col-sm-2 control-label">Email</label>
    <div class="col-sm-4">
        <input type="text" class="form-control" name="email" value="{{isset($obj) ? $obj->email : ''}}" required="">
    </div>
</div>
