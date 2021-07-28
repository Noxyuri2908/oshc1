@if(empty($obj))
    <div class="card mb-3">
        <div class="card-header">
            <div class="chevron-down-up">
                <h5 class="mb-0">Detail Settings</h5>
                <p class="click-down" data-id="detail"><span class="fas fa-chevron-down"></span></p>
            </div>
        </div>
        <div class="card-body bg-light" data-id="detail">
            <div class="row">
                <div class="col-lg-4">
                    <div class="form-group">
                        <label for="country">Country</label>
                        <select name="country_id" id="country" class="form-control">
                            <option label=""></option>
                            @foreach(config('country.list') as $key=>$value)
                                <option value="{{$key}}">{{$value}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="form-group">
                        <label for="city">City</label>
                        <input class="form-control" id="city" name="city" type="text" placeholder="Ha Noi">
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="form-group">
                        <label for="city">Office</label>
                        <input class="form-control" id="office" name="office" type="text" placeholder="Example company">
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="form-group">
                        <label for="agent-code">Agent code</label>
                        <input class="form-control" id="agent_code" name="agent_code" type="text"
                               placeholder="OSHC-xxxxx">
                    </div>
                </div>
                <div class="col-4">
                    <div class="form-group">
                        <label for="tel_1">Tel 1</label>
                        <input class="form-control" id="tel_1" name="tel_1" type="text" placeholder="084-XXX-YYY-ZZZ">
                    </div>
                </div>
                <div class="col-4">
                    <div class="form-group">
                        <label for="tel_1">Tel 2</label>
                        <input class="form-control" id="tel_2" name="tel_2" type="text" placeholder="084-XXX-YYY-ZZZ">
                    </div>
                </div>
                <div class="col-4">
                    <div class="form-group">
                        <label for="fb">Facebook</label>
                        <input class="form-control" id="fb" name="fb" type="text" placeholder="Link facebook of agent">
                    </div>
                </div>
                <div class="col-4">
                    <div class="form-group">
                        <label for="website">Website</label>
                        <input class="form-control" id="website" name="website" type="text"
                               placeholder="Link website of agent">
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="form-group">
                        <label for="country">Rating</label>
                        <select name="rating" id="rating" class="form-control">
                            <option label=""></option>
                            @foreach(config('myconfig.rating') as $key=>$value)
                                <option value="{{$key}}" {{!empty($obj) && $obj->rating == $key ? 'selected':''}}>{{$value}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="form-group">
                        <label for="">Potential service</label>
                        <select class="form-control choose_multiple_select" name="potential_service[]" id="potential_service_follow_up" multiple>
                            {{-- <option label=""></option> --}}
                            @if(!empty($dichvus))
                                @foreach($dichvus as $keyService=>$service)
                                    <option value="{{$service->id}}" {{!empty($obj) && !empty($obj->potential_service) && in_array($service->id,json_decode($obj->potential_service,true)) ?'selected="selected"':''}}>{{$service->name}}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>
@else
    <div class="card mb-3">
        <div class="card-header">
            <div class="chevron-down-up">
                <h5 class="mb-0">Detail Settings</h5>
                <p class="click-down" data-id="detail"><span class="fas fa-chevron-down"></span></p>
            </div>
        </div>
        <div class="card-body bg-light" data-id="detail">
            <div class="row">
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="agent-code">Agent code</label>
                        <input class="form-control" value="{{$obj->agent_code}}" id="agent_code" name="agent_code"
                               type="text" placeholder="OSHC-xxxxx">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="country">Country</label>
                        <select name="country" id="country" class="form-control">
                            <option label=""></option>
                            @foreach(config('country.list') as $key=>$value)
                                <option
                                    value="{{$key}}" {{$obj->country == $key ? 'selected' : ''}}>{{$value}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="city">City</label>
                        <input class="form-control" value="{{$obj->city}}" id="city" name="city" type="text"
                               placeholder="Ha Noi">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="city">Department / Office</label>
                        <input class="form-control" value="{{$obj->office}}" id="office" name="office" type="text"
                               placeholder="Example company">
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <label for="tel_1">Tel 1</label>
                        <input class="form-control" value="{{$obj->tel_1}}" id="tel_1" name="tel_1" type="text"
                               placeholder="084-XXX-YYY-ZZZ">
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <label for="tel_1">Tel 2</label>
                        <input class="form-control" value="{{$obj->tel_2}}" id="tel_2" name="tel_2" type="text"
                               placeholder="084-XXX-YYY-ZZZ">
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <label for="fb">Facebook</label>
                        <input class="form-control" value="{{$obj->fb}}" id="fb" name="fb" type="text"
                               placeholder="Link facebook of agent">
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <label for="website">Website</label>
                        <input class="form-control" value="{{$obj->website}}" id="website" name="website"
                               type="text" placeholder="Link website of agent">
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="form-group">
                        <label for="country">Rating</label>
                        <select name="rating" id="rating" class="form-control">
                            <option label=""></option>
                            @foreach(config('myconfig.rating') as $key=>$value)
                                <option value="{{$key}}" {{!empty($obj) && $obj->rating == $key ? 'selected':''}}>{{$value}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="form-group">
                        <label for="">Potential service</label>
                        <select class="form-control choose_multiple_select" name="potential_service[]" id="potential_service_follow_up" multiple>
                            {{-- <option label=""></option> --}}
                            @if(!empty($dichvus))
                                @foreach($dichvus as $keyService=>$service)
                                    <option value="{{$service->id}}" {{!empty($obj) && !empty($obj->potential_service) && in_array($service->id,$obj->potential_service) ?'selected="selected"':''}}>{{$service->name}}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <label for="type">Type of agent</label>
                        <select class="form-control" id="type_id" name="type_id" required>
                            <option label=""></option>
                            @foreach(config('admin.type_agent') as $key=>$value)
                                <option value="{{$key}}" {{!empty($obj) && $obj->type_id == $key ? 'selected':'' }}>{{$value}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endif
