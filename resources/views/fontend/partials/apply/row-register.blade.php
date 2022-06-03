<div class="row d-flex">
    <div class="col-md-6 col-xs-6">
        <div class="row">
            <div class="col-md-5 col-xs-6">
                <div class="w14 pd0">
                    <div class="form-group">
                        <select class="adults form-control" name="main_title" required>
                            <option value="mr" {{$data != null ? ($data->prefix_name == 'mr' ? 'selected' : '') : ''}}>
                                Mr
                            </option>
                            <option
                                value="miss" {{$data != null ? ($data->prefix_name == 'miss' ? 'selected' : '') : ''}}>
                                Ms
                            </option>
                            <option
                                value="mrs" {{$data != null ? ($data->prefix_name == 'mrs' ? 'selected' : '') : ''}}>Mrs
                            </option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-md-5 col-xs-6">
                <div class="w14 pd0">
                    <div class="form-group">
                        <select class="adults form-control" name="main_gender" required>
                            @foreach(\Config::get('myconfig.gender') as $key=>$gender)
                                <option
                                    value="{{$key}}" {{$data != null ? ($data->gender == $key ? 'selected' : '') : ''}}>{{$gender}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="offset-6">

    </div>
</div>

<div class="row">
    <div class="col-xs-6">
        <div class="w14 pd0">
            <div class="form-group">
                <input type="text" value="{{$data != null ? $data->first_name : ''}}" class="form-control"
                       id="main_first_name" name="main_first_name" placeholder="First Name" required>
            </div>
        </div>
    </div>
    <div class="col-xs-6">
        <div class=" w14 pd0">
            <div class="form-group">
                <input type="text" value="{{$data != null ? $data->last_name : ''}}" class="form-control"
                       id="main_last_name" name="main_last_name" placeholder="Last Name" required>
            </div>
        </div>
    </div>
</div>


<div class="w50">
    <label class="pd0" style="float: left;width: 100%;">Date of birth <span style="color: red">*</span></label>
    <div class="row">
        <div class="col-xs-4">
            <div class="form-group w14 pd0" style="padding-left: 0 !important;">
                <select name="main_date" id="main_date" class="form-control" required>
                    @for ($x = 1; $x <= 31; $x++)
                        <option
                            value="{{$x}}" {{$data != null ? ($data->dateB == $x ? 'selected' : '') : ''}}>{{$x}}</option>
                    @endfor
                </select>
            </div>
        </div>
        <div class="col-xs-4">
            <div class="form-group w14 pd0">
                <select name="main_month" id="main_month"
                        class="form-control" required>
                    <option value="01" {{$data != null ? ($data->monthB == '01' ? 'selected' : '') : ''}}>January
                    </option>
                    <option value="02" {{$data != null ? ($data->monthB == '02' ? 'selected' : '') : ''}}>February
                    </option>
                    <option value="03" {{$data != null ? ($data->monthB == '03' ? 'selected' : '') : ''}}>March</option>
                    <option value="04" {{$data != null ? ($data->monthB == '04' ? 'selected' : '') : ''}}>April</option>
                    <option value="05" {{$data != null ? ($data->monthB == '05' ? 'selected' : '') : ''}}>May</option>
                    <option value="06" {{$data != null ? ($data->monthB == '06' ? 'selected' : '') : ''}}>June</option>
                    <option value="07" {{$data != null ? ($data->monthB == '07' ? 'selected' : '') : ''}}>July</option>
                    <option value="08" {{$data != null ? ($data->monthB == '08' ? 'selected' : '') : ''}}>August
                    </option>
                    <option value="09" {{$data != null ? ($data->monthB == '09' ? 'selected' : '') : ''}}>September
                    </option>
                    <option value="10" {{$data != null ? ($data->monthB == '10' ? 'selected' : '') : ''}}>October
                    </option>
                    <option value="11" {{$data != null ? ($data->monthB == '11' ? 'selected' : '') : ''}}>November
                    </option>
                    <option value="12" {{$data != null ? ($data->monthB == '12' ? 'selected' : '') : ''}}>December
                    </option>
                </select>
            </div>
        </div>
        <div class="col-xs-4">
            <div class="form-group w14 pd0">
                <select name="main_year" id="main_year" class="form-control" required>
                    <option value="">Year</option>
                    @for ($x = 1900; $x <= \Carbon\Carbon::now()->format('Y'); $x++)
                        <option style="color:#555"
                                value="{{$x}}" {{$data != null ? ($data->yearB == $x ? 'selected' : '') : ''}}>{{$x}}</option>
                    @endfor
                </select>
            </div>
        </div>
    </div>
</div>

<div class="w14 pdl0">
    <div class="form-group">
        <input type="text" value="{{$data != null ? $data->passport : ''}}" class="form-control"
               id="main_passport_number" name="main_passport_number" placeholder="Passport number" required>
    </div>
    @include("fontend.partials.select-country")
</div>
<div class="w14 pd0">
    <div class="form-group">
        <input type="text" value="{{$data != null ? $data->place_study : ''}}" class="form-control"
               id="main_education" name="main_education"
               placeholder="Where is the student studying (education instituation)" required>
    </div>
</div>
<div class="w14 pd0">
    <div class="form-group">
        <input type="text" value="{{$data != null ? $data->student_id : ''}}" class="form-control"
               id="main_student_id" name="main_student_id" placeholder="Student ID">
    </div>
</div>

<div class="w50">
    <div class="form-group w14 pd0" style="padding-left: 0 !important;">
        <label>My current or future location in Australia <span style="color: red">*</span></label>
        <select name="location_australia" id="location_australia" class="form-control" required>
            <option value="">Select</option>
            @foreach(\Config::get('location_australia') as $key=>$location)
                <option value="{{$key}}">{{$location}}</option>
            @endforeach
        </select>
    </div>
</div>

