<div class="panel-body">
    <fieldset class="form-horizontal">
        <div class="form-group" >
            <label class="col-sm-2 control-label">Title</label>
            <input type="hidden" value="{{$cus->id}}" name="{{$i}}_child_id">
            <div class="col-md-5">
                <select class="form-control m-b" name="{{$i}}_child_title">
                    <option value="mr" {{$cus->prefix_name == 'mr' ? 'selected' : ''}}>
                        Mr
                    </option>
                     <option value="ms" {{$cus->prefix_name == 'ms' ? 'selected' : ''}}>
                        Ms
                    </option>
                     <option value="mrs" {{$cus->prefix_name == 'mrs' ? 'selected' : ''}}>
                        Mrs
                    </option>                                         
                </select>                                         
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">First Name</label>
            <div class="col-sm-5">
                <input type="text" class="form-control" name="{{$i}}_child_first_name"
                value="{{isset($cus) ? $cus->first_name : old('first_name')}}">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">Last Name</label>
            <div class="col-sm-5">
                <input type="text" class="form-control" name="{{$i}}_child_last_name"
                value="{{isset($cus) ? $cus->last_name : old('last_name')}}">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">Date of birth</label>
            <div class="col-sm-5">
                <input type="text" class="form-control" name="{{$i}}_child_dob" id="{{$i}}_dob" 
                value="{{isset($cus) ? $cus->birth_of_date : old('birth_of_date')}}">
            </div>
        </div>
        <div class="form-group" >
            <label class="col-sm-2 control-label">Gender</label>
            <div class="col-md-5">
                <select class="form-control m-b" name="{{$i}}_child_gender">
                    <option value="0" {{$cus->gender == '0' ? 'selected' : ''}}>
                        Male
                    </option>
                     <option value="1" {{$cus->gender == '1' ? 'selected' : ''}}>
                        Female
                    </option>                                       
                </select>                                         
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">Passport number</label>
            <div class="col-sm-5">
                <input type="text" class="form-control" name="{{$i}}_child_pass" id="{{$i}}_pass" 
                value="{{isset($cus) ? $cus->passport : old('passport')}}">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">Country</label>
            <div class="col-sm-5">
                <input type="text" class="form-control" name="{{$i}}_child_country" id="{{$i}}_country" 
                value="{{isset($cus) ? $cus->country : old('country')}}">
            </div>
        </div>
    </fieldset>
</div>
