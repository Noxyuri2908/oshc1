@php
    if(!empty(request()->get('destination'))){
        $destination = request()->get('destination');
    }
@endphp
<div class="card mb-3">

    <div class="card-header">
        <div class="chevron-down-up">
            <h5 class="mb-0">Customer info</h5>
            <p class="click-down" data-id="customer"><span class="fas fa-chevron-down"></span></p>
        </div>
    </div>

    <div class="card-body bg-light" data-id="customer">
        <div class="row">

            <div class="col-md-6">
                <div class="form-group row">
                    <label class="col-md-4" for="prefix_name">Title</label>
                    <select class="form-control col-md-8" id="prefix_name" name="prefix_name" required>
                        @foreach(config('myconfig.title') as $key=>$value)
                            @if(!isset($cus))
                                <option value="{{$key}}" {{request()->get('prefix_name') == $key ? 'selected' : ''}}>{{$value}}</option>
                            @else
                                <option value="{{$key}}" {{$cus->prefix_name == $key ? 'selected' : ''}}>{{$value}}</option>
                            @endif
                        @endforeach
                    </select>
                </div>

                <div class="form-group row">
                    <label class="col-md-4" for="first_name">Last name</label>
                    <input class="form-control col-md-8" autocomplete="off" id="last_name" name="last_name" value="{{isset($cus) ? $cus->last_name : request()->get('last_name')}}" type="text" placeholder="" required>
                </div>

                <div class="form-group row">
                    <label class="col-md-4" for="start_date">Date of birth</label>
                    <input class="form-control col-md-8 open-jquery-date" autocomplete="off" id="birth_of_date" name="birth_of_date" value="{{!empty($cus) ? convert_date_form_db($cus->birth_of_date) : request()->get('birth_of_date')}}" data-options='{"dateFormat":"d/m/Y"}'>
                </div>

                <div class="form-group row">
                    <label class="col-md-4" for="country">Nationality</label>
                    <select class="form-control col-md-8" id="country" name="country">
                        <option value=""></option>
                        @foreach(config('country.list') as $key=>$value)
                            @if(!isset($cus))
                                <option value="{{$key}}" {{request()->get('country') == $key ? 'selected' : ''}}>{{$value}}</option>
                            @else
                                <option value="{{$key}}" {{$cus->country == $key ? 'selected' : ''}}>{{$value}}</option>
                            @endif
                        @endforeach
                    </select>
                </div>

                <div class="form-group row">
                    <label class="col-md-4" for="">OSHC provider of School</label>
                    <input type="text"  name="provider_of_school" value="{{!empty($cus) ? $cus->provider_of_school : ''}}" class="form-control col-md-8">
                </div>

                <div class="form-group row">
                    <label class="col-md-4" for="place_study">School</label>
                    <select class="form-control col-md-8" name="place_study">
                        <option label=""></option>
                        @foreach($schools as $school)
                            <option value="{{$school->id}}" {{isset($cus) ? ($cus->place_study == $school->id ? 'selected' : '') : (request()->get('place_study') == $school->id ? 'selected' : '')}}>{{$school->name}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group row">
                    <label class="col-md-4" for="student_id">Mobile No</label>
                    <input class="form-control col-md-8" id="phone" autocomplete="off" name="phone" value="{{isset($cus) ? $cus->phone : request()->get('phone')}}" type="text" placeholder="">
                </div>

                <div class="form-group row">
                    <label class="col-md-4" for="student_id">Location Australia</label>
                    <select name="location_australia" id="location_australia" class="form-control col-md-8">
                        @foreach(\Config::get('location_australia') as $key => $location)
                            @if(!empty($obj))

                                <option value="{{$key}}" {{$obj->location_australia == $key ? 'selected' : ''}}>{{$location}}</option>
                            @else
                                <option value="{{$key}}" {{request()->location_australia == $key ?'selected' : ''}}>{{$location}}</option>
                            @endif
                        @endforeach
                    </select>
                </div>

            </div>

            <div class="col-md-6">

                <div class="form-group row">
                    <label class="col-md-4" for="first_name">First name</label>
                    <input class="form-control col-md-8" autocomplete="off" id="first_name" name="first_name" value="{{isset($cus) ? $cus->first_name : request()->get('first_name')}}" type="text" placeholder="" required>
                </div>



                <div class="form-group row">
                    <label class="col-md-4" for="prefix_name">Gender</label>
                    <select class="form-control col-md-8" id="gender" name="gender" required>
                        @foreach(config('myconfig.gender') as $key=>$value)
                            @if(!isset($cus))
                                <option value="{{$key}}" {{request()->get('gender') == $key ? 'selected' : ''}}>{{$value}}</option>
                            @else
                                <option value="{{$key}}" {{$cus->gender == $key ? 'selected' : ''}}>{{$value}}</option>
                            @endif
                        @endforeach
                    </select>
                </div>



                <div class="form-group row">
                    <label class="col-md-4" for="first_name">Passport No</label>
                    <input class="form-control col-md-8" id="passport" autocomplete="off" name="passport" value="{{isset($cus) ? $cus->passport : request()->get('passport')}}" type="text" placeholder="">
                </div>


                <div class="form-group row">
                    <label class="col-md-4" for="">Destination</label>
                    <select class="form-control col-md-8" id="destination" name="destination" required>
                        <option value=""></option>
                        @foreach(config('country.list') as $key=>$value)
                            @if(!isset($cus))
                                <option value="{{$key}}" {{request()->get('destination') == $key ? 'selected' : ''}}>{{$value}}</option>
                            @else
                                <option value="{{$key}}" {{$cus->destination == $key ? 'selected' : ''}}>{{$value}}</option>
                            @endif
                        @endforeach
                    </select>
                </div>


                <div class="form-group row">
                    <label class="col-md-4" for="first_name">Email</label>
                    <input class="form-control col-md-8" autocomplete="off" id="email" name="email" value="{{isset($cus) ? $cus->email : request()->get('email')}}" type="email" placeholder="">
                </div>



                <div class="form-group row">
                    <label class="col-md-4" for="student_id">STD ID</label>
                    <input class="form-control col-md-8" id="student_id" autocomplete="off" name="student_id" value="{{isset($cus) ? $cus->student_id : request()->get('student_id')}}" type="text" placeholder="">
                </div>



                <div class="form-group row">
                    <label class="col-md-4" for="student_id">Facebook</label>
                    <input class="form-control col-md-8" id="fb" autocomplete="off" name="fb" value="{{isset($cus) ? $cus->fb : request()->get('fb')}}" type="text" placeholder="">
                </div>

                <div class="form-group row">
                    <label class="col-md-4" for="student_id">Is the student already living in Australia?</label>
                    <select name="live_in_AS" id="live_in_AS" class="form-control col-md-8">
                        <option value=""></option>
                        @foreach(config('myconfig.live_in_AS') as $key => $value)
                            <option value="{{$key}}" {{ !empty($cus) && $cus->s_live_in_AS == $key ? 'selected' : ''  }}>{{$value}}</option>
                        @endforeach
                    </select>
                </div>


            </div>
        </div>
    </div>
</div>
@push('scripts')
    <script>
        $(document).ready(function (){
            @if(isset($destination))
                if (!destination){
                    $('#destination').val(destination);
                }
            @endif

            $(document).on('change', '#prefix_name', function (){
                var valueTitle = $(this).val();
                if (valueTitle === '2' || valueTitle === '3'){
                    $('#gender').val('2');
                }else{
                    $('#gender').val('1');
                }
            })
        })


    </script>
@endpush
