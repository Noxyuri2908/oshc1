@php
    if(!empty($partners)){

    }elseif(!empty(request()->get('partner')) && request()->get('partner') != "[]" ){
        $partners = json_decode(request()->get('partner'))[0];
    }


@endphp
@for($i = 0; $i < $number; $i++)
    <div class="row">
        <div class="col-lg-2">
            <div class="form-group">
                <label for="prefix_name">Title</label>
                <select class="form-control" id="partner_prefix_name_{{$i}}" name="partner_prefix_name[]" required>
                    @foreach(config('myconfig.title') as $key=>$value)
                        <option value="{{$key}}" {{(!empty($partners) && $partners->prefix_name == $key)?'selected':''}}>{{$value}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-lg-2">
            <div class="form-group">
                <label for="first_name">First name</label>
                <input class="form-control" autocomplete="off" value="{{(!empty($partners))?$partners->first_name:''}}" id="first_name_{{$i}}" name="partner_first_name[]" type="text" placeholder="" required>
            </div>
        </div>
        <div class="col-lg-2">
            <div class="form-group">
                <label for="first_name">Last name</label>
                <input class="form-control" autocomplete="off" value="{{(!empty($partners))?$partners->last_name:''}}" id="last_name_{{$i}}" name="partner_last_name[]" type="text" placeholder="" required>
            </div>
        </div>
        <div class="col-lg-2">
            <div class="form-group">
                <label for="prefix_name">Gender</label>
                <select class="form-control" id="gender_{{$i}}" name="partner_gender[]" required>
                    @foreach(config('myconfig.gender') as $key=>$value)
                        <option value="{{$key}}" {{(!empty($partners) && $partners->gender == $key)?'selected':''}}>{{$value}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-lg-2">
            <div class="form-group">
                <label for="start_date">Date of birth</label>
                <input class="form-control open-jquery-date" autocomplete="off" value="{{(!empty($partners))?$partners->birth_of_date:''}}" id="birth_of_date_{{$i}}" name="partner_birth_of_date[]"  type="text" required>
            </div>
        </div>
        <div class="col-lg-2">
            <div class="form-group">
                <label for="first_name">Passport No</label>
                <input class="form-control" id="passport_{{$i}}" autocomplete="off" value="{{(!empty($partners))?$partners->passport:''}}" name="partner_passport[]"type="text" placeholder="" >
            </div>
        </div>
    </div>
@endfor


