<div class="col-xl-12">
    <div class="card mb-3">
        <div class="card-header">
          <div class="chevron-down-up">
            <h5 class="mb-0">Customer info</h5>
            <p class="click-down" data-id="customer"><span class="fas fa-chevron-down"></span></p>
          </div>
        </div>
        <div class="card-body bg-light" data-id="customer">
          <div class="row">
            <div class="col-lg-2">
              <div class="form-group">
                <label for="prefix_name">Title</label>
                <select class="form-control" id="prefix_name" name="prefix_name" required>
                  @foreach(config('myconfig.title') as $key=>$value)
                  @if(!isset($cus))
                  <option value="{{$key}}" {{request()->get('prefix_name') == $key ? 'selected' : ''}}>{{$value}}</option>
                  @else
                  <option value="{{$key}}" {{$cus->prefix_name == $key ? 'selected' : ''}}>{{$value}}</option>
                  @endif
                  @endforeach
                </select>
              </div>
            </div>
            <div class="col-lg-3">
              <div class="form-group">
                <label for="first_name">First name</label>
                <input class="form-control" id="first_name" name="first_name" value="{{isset($cus) ? $cus->first_name : request()->get('first_name')}}" type="text" placeholder="" required>
              </div>
            </div>
            <div class="col-lg-3">
              <div class="form-group">
                <label for="first_name">Last name</label>
                <input class="form-control" id="last_name" name="last_name" value="{{isset($cus) ? $cus->last_name : request()->get('last_name')}}" type="text" placeholder="" required>
              </div>
            </div>
            <div class="col-lg-2">
              <div class="form-group">
                <label for="prefix_name">Gender</label>
                <select class="form-control" id="gender" name="gender" required>
                  @foreach(config('myconfig.gender') as $key=>$value)
                  @if(!isset($cus))
                  <option value="{{$key}}" {{request()->get('gender') == $key ? 'selected' : ''}}>{{$value}}</option>
                  @else
                  <option value="{{$key}}" {{$cus->gender == $key ? 'selected' : ''}}>{{$value}}</option>
                  @endif
                  @endforeach
                </select>
              </div>
            </div>
            <div class="col-lg-2">
              <div class="form-group">
                <label for="start_date">Date of birth</label>
                <input class="form-control datetimepicker flatpickr-input" id="birth_of_date" name="birth_of_date" value="{{!empty($cus) ? $cus->birth_of_date : request()->get('birth_of_date')}}"  data-options='{"dateFormat":"d/m/Y"}'>
              </div>
            </div>
            <div class="col-lg-3">
              <div class="form-group">
                <label for="first_name">Passport No</label>
                <input class="form-control" id="passport" name="passport" value="{{isset($cus) ? $cus->passport : request()->get('passport')}}" type="text" placeholder="" >
              </div>
            </div>
            <div class="col-lg-3">
              <div class="form-group">
                <label for="country">Destination</label>
                <select class="form-control" id="country" name="country" required>
                  @foreach(config('country.list') as $key=>$value)
                  @if(!isset($cus))
                  <option value="{{$key}}" {{request()->get('country') == $key ? 'selected' : ''}}>{{$value}}</option>
                  @else
                  <option value="{{$key}}" {{$cus->country == $key ? 'selected' : ''}}>{{$value}}</option>
                  @endif
                  @endforeach
                </select>
              </div>
            </div>
            <div class="col-lg-3">
              <div class="form-group">
                <label for="first_name">Email</label>
                <input class="form-control" id="email" name="email" value="{{isset($cus) ? $cus->email : request()->get('email')}}" type="email" placeholder="">
              </div>
            </div>
            <div class="col-lg-3">
              <div class="form-group">
                <label for="place_study">Education instituation</label>

                <select  class="form-control" name="place_study">
                  <option label=""></option>
                  @foreach($schools as $school)
                  <option value="{{$school->id}}" {{isset($cus) ? ($cus->place_study == $school->id ? 'selected' : '') : (request()->get('place_study') == $school->id ? 'selected' : '')}}>{{$school->name}}</option>
                  @endforeach
                </select>
              </div>
            </div>
            <div class="col-lg-2">
              <div class="form-group">
                <label for="student_id">STD ID</label>
                <input class="form-control" id="student_id" name="student_id" value="{{isset($cus) ? $cus->student_id : request()->get('student_id')}}" type="text" placeholder="">
              </div>
            </div>
            <div class="col-lg-2">
              <div class="form-group">
                <label for="student_id">Mobile No</label>
                <input class="form-control" id="phone" name="phone" value="{{isset($cus) ? $cus->phone : request()->get('phone')}}" type="text" placeholder="">
              </div>
            </div>
            <div class="col-lg-3">
              <div class="form-group">
                <label for="student_id">Facebook</label>
                <input class="form-control" id="fb" name="fb" value="{{isset($cus) ? $cus->fb : request()->get('fb')}}" type="text" placeholder="">
              </div>
            </div>
            <div class="col-lg-5">
              <div class="form-group">
                <label for="student_id">Location Australia</label>
                <select name="location_australia" id="location_australia" class="form-control" required>
                  <option value="">Select</option>
                  @foreach(\Config::get('location_australia') as $key=>$location)
                  @if(!empty($obj))
                      <option value="{{$key}}" {{isset($obj) && $obj->location_australia == $key ?'selected' : ''}}>{{$location}}</option>
                      @else
                      <option value="{{$key}}" {{request()->location_australia == $key ?'selected' : ''}}>{{$location}}</option>
                      @endif
                  @endforeach
              </select>
              </div>
            </div>
          </div>
        </div>
      </div>
</div>
