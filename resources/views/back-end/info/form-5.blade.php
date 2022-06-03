<div class="panel-body">
    <fieldset class="form-horizontal">
        <div class="main-post col-md-8">
            <div class="form-group {{ $errors->has('p_name') ? 'has-error' : '' }}">
                <label class="control-label">Tên</label>
                <div class="inner">
                    <input type="text" class="form-control" name="p_name" id="p_name" 
                    value="{{isset($contact_person) ? $contact_person->name : old('p_name')}}" placeholder="Nhập tên...">
                </div>
            </div>
            <div class="form-group {{ $errors->has('p_position') ? 'has-error' : '' }}">
                <label class="control-label">Vị trí, Chức vụ</label>
                <div class="inner">
                    <input type="text" class="form-control" name="p_position" id="p_position" value="{{isset($contact_person) ? $contact_person->position : old('p_position')}}">
                </div>
            </div>
            <div class="form-group {{ $errors->has('p_birthday') ? 'has-error' : '' }}">
                <label class="control-label">Ngày sinh</label>
                <div class="inner">
                    <input type="text" class="form-control" name="p_birthday" id="p_birthday" value="{{isset($contact_person) ? $contact_person->birthday : old('p_birthday')}}">
                </div>
            </div>
            <div class="form-group {{ $errors->has('p_phone') ? 'has-error' : '' }}">
                <label class="control-label">Số điện thoại</label>
                <div class="inner">
                    <input type="text" class="form-control" name="p_phone" id="p_phone" value="{{isset($contact_person) ? $contact_person->phone : old('p_phone')}}">
                </div>
            </div>
            <div class="form-group {{ $errors->has('p_email') ? 'has-error' : '' }}">
                <label class="control-label">Email</label>
                <div class="inner">
                    <input type="text" class="form-control" name="p_email" id="p_email" value="{{isset($contact_person) ? $contact_person->email : old('p_email')}}">
                </div>
            </div>
            <div class="form-group {{ $errors->has('skype') ? 'has-error' : '' }}">
                <label class="control-label">Skype</label>
                <div class="inner">
                    <input type="text" class="form-control" name="p_skype" id="p_skype" value="{{isset($contact_person) ? $contact_person->skype : old('p_skype')}}">
                </div>
            </div>
            <div class="form-group">
                <label class="control-label">Trạng thái (*)</label>
                <div class="inner">
                    @if(!isset($contact_person))
                    <select class="form-control m-b" name="p_status">
                        <option value="1" {{old('p_status') == "1" ? "selected" : ""}}>Sử dụng</option>
                        <option value="0" {{old('p_status') == "0" ? "selected" : ""}}>Chưa sử dụng</option>
                    </select>
                    @else
                    <select class="form-control m-b" name="p_status">
                        <option value="1" {{$contact_person->status == "1" ? "selected" : ""}}>Sử dụng</option>
                        <option value="0" {{$contact_person->status == "0" ? "selected" : ""}}>Chưa sử dụng</option>
                    </select>
                    @endif
                </div>
            </div>
        </div>
    </fieldset>
</div>
