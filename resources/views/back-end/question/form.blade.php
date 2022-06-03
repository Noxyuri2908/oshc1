@if(isset($obj))
<input type="hidden" name="_id" value="{{$obj->id}}">
@endif
<div class="form-group">
    <label class="col-sm-2 control-label">Name</label>
    <div class="col-sm-4">
        <input type="text" class="form-control" name="name" value="{{$obj->name}}" readonly>
    </div>
</div>
<div class="form-group">
    <label class="col-sm-2 control-label">Email</label>
    <div class="col-sm-4">
        <input type="text" class="form-control" name="email" value="{{$obj->email}}" readonly>
    </div>
</div>
<div class="form-group">
    <label class="col-sm-2 control-label">Phone</label>
    <div class="col-sm-4">
        <input type="text" class="form-control" name="phone" value="{{$obj->phone}}" readonly>
    </div>
</div>

<div class="form-group {{ $errors->has('ques') ? 'has-error' : '' }}">
    <label class="col-sm-2 control-label">Question</label>
    <div class="col-sm-4">
        <textarea rows="5" placeholder="" class="form-control" name="ques" readonly>{{isset($obj) ? $obj->ques : ''}}</textarea>
    </div>
</div>
<div class="form-group {{ $errors->has('content') ? 'has-error' : '' }}">
    <label class="col-sm-2 control-label">Content</label>
    <div class="col-sm-4">
        <textarea rows="5" placeholder="" class="form-control" name="content" readonly>{{isset($obj) ? $obj->content : ''}}</textarea>
    </div>
</div>
<div class="form-group {{ $errors->has('answer') ? 'has-error' : '' }}">
    <label class="col-sm-2 control-label">Answer</label>
    <div class="col-sm-4">
        <textarea rows="5" placeholder="" class="form-control" name="answer">{{isset($obj) ? $obj->answer : ''}}</textarea>
    </div>
</div>
