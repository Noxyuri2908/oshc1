<div class="panel-body">
    <fieldset class="form-horizontal">
        <div class="form-group" >
            <input type="hidden" value="{{$cus->id}}" name="main_id">
            <label class="col-sm-2 control-label">Title</label>
            <div class="col-md-5">
                <select class="form-control m-b" name="main_title">
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
                <input type="text" class="form-control" name="main_first_name" id="first_name" 
                value="{{isset($cus) ? $cus->first_name : old('first_name')}}">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">Last Name</label>
            <div class="col-sm-5">
                <input type="text" class="form-control" name="main_last_name" id="main_last_name" 
                value="{{isset($cus) ? $cus->last_name : old('last_name')}}">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">Date of birth</label>
            <div class="col-sm-5">
                <input type="text" class="form-control" name="main_birth_of_date" id="main_birth_of_date" 
                value="{{isset($cus) ? $cus->birth_of_date : old('birth_of_date')}}">
            </div>
        </div>
        <div class="form-group" >
            <label class="col-sm-2 control-label">Gender</label>
            <div class="col-md-5">
                <select class="form-control m-b" name="main_gender">
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
            <label class="col-sm-2 control-label">Phone</label>
            <div class="col-sm-5">
                <input type="text" class="form-control" name="main_phone" id="phone" 
                value="{{isset($cus) ? $cus->phone : old('phone')}}">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">Email</label>
            <div class="col-sm-5">
                <input type="text" class="form-control" name="main_email" id="main_email" 
                value="{{isset($cus) ? $cus->email : old('email')}}">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">Is the primary student visa holder currently located in Australia? *</label>
            <div class="col-sm-5">
                <input type="text" class="form-control" name="main_is_locate" id="main_is_locate" 
                value="{{isset($cus) ? $cus->is_locate : old('is_locate')}}">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">Passport number(*)</label>
            <div class="col-sm-5">
                <input type="text" class="form-control" name="main_passport" id="main_passport" 
                value="{{isset($cus) ? $cus->passport : old('passport')}}">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">Country(*)</label>
            <div class="col-sm-5">
                <input type="text" class="form-control" name="main_country" id="main_country" 
                value="{{isset($cus) ? $cus->country : old('country')}}">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">Education instituation</label>
            <div class="col-sm-5">
                <input type="text" class="form-control" name="main_education" id="main_education" 
                value="{{isset($cus) ? $cus->place_study : old('place_study')}}">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">Agent Code</label>
            <div class="col-sm-5">
                <input type="text" class="form-control" name="main_agent_code" id="main_agent_code" 
                value="{{isset($cus) ? $cus->agent_code : old('agent_code')}}">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">Education Agent</label>
            <div class="col-sm-5">
                <input type="text" class="form-control" name="main_education_agent" id="main_education_agent" 
                value="{{isset($cus) ? $cus->education_agent : old('education_agent')}}">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">Student ID</label>
            <div class="col-sm-5">
                <input type="text" class="form-control" name="main_student_id" id="main_student_id" 
                value="{{isset($cus) ? $cus->student_id : old('student_id')}}">
            </div>
        </div>
    </fieldset>
</div>
