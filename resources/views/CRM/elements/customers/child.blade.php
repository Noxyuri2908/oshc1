@php
$childs = json_decode(request()->get('childs'));
@endphp
@for($i = 0; $i < $number; $i++)
    <div class="row">

        <div class="col-md-6">

            <div class="form-group row">
                <label class="col-md-4" for="prefix_name">Title</label>
                <select class="form-control col-md-8" id="child_prefix_name_{{$i}}" name="child_prefix_name[]" >
                    @foreach(config('myconfig.title') as $key=>$value)
                        @if(!empty($childrens[$i]))
                            <option value="{{$key}}" {{(!empty($childrens[$i]) && $childrens[$i]->prefix_name == $key)?'selected':''}}>{{$value}}</option>
                        @elseif(!empty($childs))
                            <option value="{{$key}}" {{(!empty($childs[$i]) && $childs[$i]->prefix_name == $key)?'selected':''}}>{{$value}}</option>
                        @else
                            <option value="{{$key}}">{{$value}}</option>
                        @endif
                    @endforeach
                </select>
            </div>

            <div class="form-group row">
                <label class="col-md-4" for="first_name">Last name</label>
                @if(!empty($childrens[$i]))
                    <input class="form-control col-md-8" autocomplete="off" value='{{!empty($childrens[$i])?$childrens[$i]->last_name:''}}' id="child_last_name_{{$i}}" name="child_last_name[]" type="text" placeholder="" >
                @elseif(!empty($childs))
                    <input class="form-control col-md-8" autocomplete="off" value='{{!empty($childs[$i])?$childs[$i]->last_name:''}}' id="child_last_name_{{$i}}" name="child_last_name[]" type="text" placeholder="" >
                @else
                    <input class="form-control col-md-8" autocomplete="off" value='' id="child_last_name_{{$i}}" name="child_last_name[]" type="text" placeholder="" >
                @endif
            </div>

            <div class="form-group row">
                <label class="col-md-4" for="start_date">Date of birth</label>
                @if(!empty($childrens[$i]))
                    <input class="form-control open-jquery-date col-md-8" autocomplete="off" value='{{!empty($childrens[$i])?$childrens[$i]->birth_of_date:''}}'  id="child_birth_of_date_{{$i}}" name="child_birth_of_date[]"  type="text" data-options='{"dateFormat":"d/m/Y"}' >
                @elseif(!empty($childs))
                    <input class="form-control open-jquery-date col-md-8" autocomplete="off" value='{{!empty($childs[$i])?$childs[$i]->birth_of_date:''}}'  id="child_birth_of_date_{{$i}}" name="child_birth_of_date[]"  type="text" data-options='{"dateFormat":"d/m/Y"}' >
                @else
                    <input class="form-control open-jquery-date col-md-8" autocomplete="off" value=''  id="child_birth_of_date_{{$i}}" name="child_birth_of_date[]"  type="text" data-options='{"dateFormat":"d/m/Y"}' >
                @endif
            </div>

        </div>

        <div class="col-md-6">

            <div class="form-group row">
                <label class="col-md-4" for="first_name">First name</label>
                @if(!empty($childrens[$i]))
                    <input class="form-control col-md-8" autocomplete="off" value='{{!empty($childrens[$i])?$childrens[$i]->first_name:''}}' id="child_first_name_{{$i}}" name="child_first_name[]" type="text" placeholder="" >
                @elseif(!empty($childs))
                    <input class="form-control col-md-8" autocomplete="off" value='{{!empty($childs[$i])?$childs[$i]->first_name:''}}' id="child_first_name_{{$i}}" name="child_first_name[]" type="text" placeholder="" >
                @else
                    <input class="form-control col-md-8" autocomplete="off" value='' id="child_first_name_{{$i}}" name="child_first_name[]" type="text" placeholder="" >
                @endif
            </div>

            <div class="form-group row">
                <label class="col-md-4" for="prefix_name">Gender</label>
                <select class="form-control col-md-8" id="child_gender_{{$i}}" name="child_gender[]" >
                    @foreach(config('myconfig.gender') as $key=>$value)
                        @if(!empty($childrens[$i]))
                            <option value="{{$key}}" {{(!empty($childrens[$i]) && $childrens[$i]->gender == $key)?'selected':''}} >{{$value}}</option>
                        @elseif(!empty($childs))
                            <option value="{{$key}}" {{(!empty($childs[$i]) && $childs[$i]->gender == $key)?'selected':''}} >{{$value}}</option>
                        @else
                            <option value="{{$key}}">{{$value}}</option>

                        @endif

                    @endforeach
                </select>
            </div>

            <div class="form-group row">
                <label class="col-md-4" for="first_name">Passport No</label>
                @if(!empty($childrens[$i]))
                    <input class="form-control col-md-8" id="passport_{{$i}}" autocomplete="off" value='{{!empty($childrens[$i])?$childrens[$i]->passport:''}}' name="child_passport[]"type="text" placeholder="">
                @elseif(!empty($childs))
                    <input class="form-control col-md-8" id="passport_{{$i}}" autocomplete="off" value='{{!empty($childs[$i])?$childs[$i]->passport:''}}' name="child_passport[]"type="text" placeholder="">
                @else
                    <input class="form-control col-md-8" id="passport_{{$i}}" autocomplete="off" value='' name="child_passport[]"type="text" placeholder="">
                @endif
            </div>

        </div>

    </div>
    @endfor
