@if(!isset($obj))
    <div class="card mb-3">
        <div class="card-header">
            <div class="chevron-down-up">
                <h5 class="mb-0">Account Settings</h5>
                <p class="click-down" data-id="account"><span class="fas fa-chevron-down"></span></p>
            </div>
        </div>
        <div class="card-body bg-light" data-id="account">
            <div class="row">
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="name">Username</label>
                        <input class="form-control" name="name" id="name" type="text" placeholder="Example" required>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="email">Company email</label>
                        <input class="form-control" name="email" id="email" type="email" placeholder="example@example.com" required>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input class="form-control" name="password" id="password" type="password" placeholder="***********">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="type">Type of agent</label>
                        <select class="form-control" id="type_id" name="type_id" required>
                            <option label=""></option>
                            @foreach(config('admin.type_agent') as $key=>$value)
                                <option value="{{$key}}">{{$value}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="phone">Status</label>
                        <select class="form-control" id="status" name="status" required>
                            <option label=""></option>
                            @foreach(config('admin.status') as $key=>$value)
                                <option value="{{$key}}">{{$value}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="phone">Market</label>
                        <select class="form-control" id="market_id" name="market_id[]" required multiple>
                            <option label=""></option>
                            @foreach(config('myconfig.market') as $key=>$value)
                                <option value="{{$key}}">{{$value}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="phone">Department</label>
                        <select class="form-control" id="department" name="department" required>
                            <option label=""></option>
                            @foreach(config('myconfig.department') as $key=>$value)
                                <option value="{{$key}}">{{$value}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

            </div>
            <div class="row">
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="">Note 1</label>
                        <textarea name="note1" class="form-control" id="note1" cols="30" rows="5"></textarea>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="">Note 2</label>
                        <textarea name="note2" class="form-control" id="note2" cols="30" rows="5"></textarea>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="rating">Person in charge</label>
                        <select name="staff_id" id="staff_id" class="form-control">
                            <option label=""></option>
                            @foreach($staffs as $staff)
                                <option value="{{$staff->id}}" {{\Illuminate\Support\Facades\Auth::user()->id == $staff->id?'selected':''}}>{{$staff->admin_id}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="date_of_contract">Date of contract</label>
                        <input type="text" onmouseover="onLoadChooseDate()" class="form-control" name="date_of_contract" id="date_of_contract" placeholder="d/m/y">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="form-group">
                        <label for="password">Commission offer</label>
                        <input class="form-control" name="commission_offer" id="commission_offer" type="text" placeholder="">
                    </div>
                </div>
            </div>
        </div>
    </div>
@else

    <div class="card mb-3">
        <div class="card-header">
            <div class="chevron-down-up">
                <h5 class="mb-0">Account Settings</h5>
                <p class="click-down" data-id="account"><span class="fas fa-chevron-down"></span></p>
            </div>
        </div>
        <div class="card-body bg-light" data-id="account">
            <div class="row">
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="name">Username</label>
                        <input class="form-control" name="name" id="name" type="text" value="{{$obj->name}}" placeholder="Example" required>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="email">Company email</label>
                        <input class="form-control" name="email" id="email" type="email" value="{{$obj->email}}" placeholder="example@example.com" required>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input class="form-control" name="password" id="password" type="password" placeholder="Enter to change">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="phone">Status</label>
                        <select class="form-control" id="status" name="status" required>
                            <option label=""></option>
                            @foreach(config('admin.status') as $key=>$value)
                                <option value="{{$key}}" {{$obj->status == $key ? "selected" : ''}}>{{$value}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="phone">Market</label>
                        <select class="form-control" id="market_id" name="market_id[]" required multiple>
                            <option label=""></option>
                            @foreach(config('myconfig.market') as $key=>$value)
                                <option value="{{$key}}" {{(!empty($obj)) && collect($obj->market_id)->contains($key)? "selected" : ''}}>{{$value}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="phone">Department</label>
                        <select class="form-control" id="department" name="department" required>
                            <option label=""></option>
                            @foreach(config('myconfig.department') as $key=>$value)
                                <option value="{{$key}}" {{$obj->department == $key ? "selected" : ''}}>{{$value}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="">Note 1</label>
                        <textarea name="note1" class="form-control" id="note1" cols="30" rows="5">{{$obj->note1}}</textarea>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="">Note 2</label>
                        <textarea name="note2" class="form-control" id="note2" cols="30" rows="5">{{$obj->note2}}</textarea>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="rating">Person in charge</label>
                        <select name="staff_id" id="staff_id" class="form-control">
                            <option label=""></option>
                            @foreach($staffs as $staff)
                                @if($action == 'edit')
                                    <option value="{{$staff->id}}" {{$obj->staff_id == $staff->id ? 'selected' : '' }} >{{$staff->admin_id}}</option>
                                @else
                                    <option value="{{$staff->id}}" {{\Illuminate\Support\Facades\Auth::user()->id == $staff->id?'selected':''}}>{{$staff->admin_id}}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="date_of_contract">Date of contract</label>
                        <input type="text" onmouseover="onLoadChooseDate()" class="form-control" name="date_of_contract" id="date_of_contract" value="{{convert_date_form_db($obj->date_of_contract)}}" placeholder="d/m/y">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="form-group">
                        <label for="password">Commission offer</label>
                        <input class="form-control" name="commission_offer" id="commission_offer" type="text" value="{{$obj->commission_offer}}" placeholder="">
                    </div>
                </div>
            </div>
        </div>
    </div>

@endif
@push('scripts')
    <script>
        $('#market_id').select2({
            closeOnSelect: false
        });

        function onLoadChooseDate() {
            let date_class = $('#date_of_contract').hasClass('flatpickr-input')
            if (!date_class) {
                $('#date_of_contract').flatpickr({
                    dateFormat: 'd/m/Y',
                    allowInput: true,
                })
            }
        }
    </script>
    @endpush
