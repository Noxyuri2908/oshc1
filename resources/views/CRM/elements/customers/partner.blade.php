@php
    if(!empty($partners)){

    }elseif(!empty(request()->get('partner')) && request()->get('partner') != "[]"){
        $partners = json_decode(request()->get('partner'), true);
    }
@endphp
@if($number != 0)
    @for($i = $number; $i <= $number; $i++)
        <div class="row">
            <div class="col-md-6">

                <div class="form-group row ">
                    <label class="col-md-4" for="prefix_name">Title</label>
                    <select class="form-control col-md-8" id="partner_prefix_name_{{$i}}" name="partner_prefix_name[]" >
                        @foreach(config('myconfig.title') as $key=>$value)
                            <option value="{{$key}}" {{(!empty($partners) && $partners['prefix_name'] == $key)?'selected':''}}>{{$value}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group row">
                    <label class="col-md-4" for="first_name">Last name</label>
                    <input class="form-control col-md-8" autocomplete="off" value="{{(!empty($partners))?$partners['last_name']:''}}" id="last_name_{{$i}}" name="partner_last_name[]" type="text" placeholder="" >
                </div>

                <div class="form-group row">
                    <label class="col-md-4" for="start_date">Date of birth</label>
                    <input class="form-control open-jquery-date col-md-8" autocomplete="off" value="{{(!empty($partners))?$partners['birth_of_date']:''}}" id="birth_of_date_{{$i}}" name="partner_birth_of_date[]"  type="text" >
                </div>

            </div>


            <div class="col-md-6">

                <div class="form-group row">
                    <label class="col-md-4" for="first_name">First name</label>
                    <input class="form-control col-md-8" autocomplete="off" value="{{(!empty($partners))?$partners['first_name']:''}}" id="first_name_{{$i}}" name="partner_first_name[]" type="text" placeholder="" >
                </div>

                <div class="form-group row">
                    <label class="col-md-4" for="prefix_name">Gender</label>
                    <select class="form-control col-md-8" id="gender_{{$i}}" name="partner_gender[]" >
                        @foreach(config('myconfig.gender') as $key=>$value)
                            <option value="{{$key}}" {{(!empty($partners) && $partners['gender'] == $key)?'selected':''}}>{{$value}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group row">
                    <label class="col-md-4" for="first_name">Passport No</label>
                    <input class="form-control col-md-8" id="passport_{{$i}}" autocomplete="off" value="{{(!empty($partners))?$partners['passport']:''}}" name="partner_passport[]"type="text" placeholder="" >
                </div>
            </div>

        </div>
    @endfor
@endif

