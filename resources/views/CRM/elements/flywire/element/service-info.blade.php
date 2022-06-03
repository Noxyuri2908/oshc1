<div class="col-xl-12">
    <div class="card mb-3">
        <div class="card-header">
            <div class="chevron-down-up">
                <h5 class="mb-0">Service info</h5>
                <p class="click-down" data-id="service"><span class="fas fa-chevron-down"></span></p>
            </div>
        </div>
        <div class="card-body bg-light" data-id="service">
            <div class="row">
                <div class="col-lg-2">
                    <div class="form-group">
                        <label for="agent_id">Service country</label>
                        <select class="form-control" id="service_country" name="service_country" required>
                            <option label=""></option>
                            @foreach(config('myconfig.service_country') as $key=>$value)
                                @if(!isset($obj))
                                    <option
                                        value="{{$key}}" {{request()->get('service_country') == $key ? 'selected' : ''}}>{{$value}}</option>
                                @else
                                    <option
                                        value="{{$key}}" {{$obj->service_country == $key ? 'selected' : ''}}>{{$value}}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-lg-2">
                    <div class="form-group">
                        <label for="type_service">Type of service</label>
                        <select class="form-control" id="type_service" name="type_service" required>
                            <option data-country="" label=""></option>
                            @foreach($dichvus as $dichvu)
                                @if(!isset($obj))
                                    <option
                                        value="{{$dichvu->id}}" {{request()->get('type_service') == $dichvu->id ? 'selected' : ''}}>{{$dichvu->name}}</option>
                                @else
                                    <option
                                        value="{{$dichvu->id}}" {{$obj->type_service == $dichvu->id ? 'selected' : ''}}>{{$dichvu->name}}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-lg-2">
                    <div class="form-group">
                        <label for="agent_id">Type of invoice</label>
                        <select class="form-control" id="type_invoice" name="type_invoice" required>
                            <option label=""></option>
                            @foreach(config('myconfig.type_invoice') as $key=>$value)
                                @if(!isset($obj))
                                    <option
                                        value="{{$key}}" {{request()->get('type_invoice') == $key ? 'selected' : ''}}>{{$value}}</option>
                                @else
                                    <option
                                        value="{{$key}}" {{$obj->type_invoice == $key ? 'selected' : ''}}>{{$value}}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-lg-2">
                    <div class="form-group">
                        <label for="provider_id">Provider</label>
                        <select class="form-control" id="provider_id" name="provider_id" required>
                            <option data-country="" label=""></option>
                            @foreach($providers as $provider)
                                @if(!isset($obj))
                                    <option
                                        value="{{$provider->id}}" {{request()->get('provider_id') == $provider->id ? 'selected' : ''}}>{{$provider->name}}</option>
                                @else
                                    <option
                                        value="{{$provider->id}}" {{$obj->provider_id == $provider->id ? 'selected' : ''}}>{{$provider->name}}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-lg-2">
                    <div class="form-group">
                        <label for="policy">Policy</label>
                        <select class="form-control" id="policy" name="policy" required>
                            <option label=""></option>
                            @foreach(config('myconfig.policy') as $key=>$value)
                                @if(!isset($obj))
                                    <option value="{{$key}}" {{request()->get('policy') == $key ? 'selected' : ''}}>{{$value}}</option>
                                @else
                                    <option value="{{$key}}" {{$obj->policy == $key ? 'selected' : ''}}>{{$value}}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-lg-2">
                    <div class="form-group">
                        <label for="name">No of adults</label>
                        <select class="form-control" id="no_of_adults" name="no_of_adults" required>
                            @if(!empty($obj))
                            <option value=1 {{!empty($obj) && $obj->no_of_adults == 1 ? 'selected' : ''}}>1</option>
                            <option value=2 {{!empty($obj) && $obj->no_of_adults == 2 ? 'selected' : ''}}>2</option>
                            @else
                            <option value=1 {{request()->no_of_adults == 1 ? 'selected' : ''}}>1</option>
                            <option value=2 {{request()->no_of_adults == 2 ? 'selected' : ''}}>2</option>
                            @endif
                        </select>
                    </div>
                </div>
                <div class="col-lg-2">
                    <div class="form-group">
                        <label for="name">No of children</label>
                        <select class="form-control" id="no_of_children" name="no_of_children" required>
                            @if(!empty($obj))
                            <option value=0 {{!empty($obj) && $obj->no_of_children == 0 ? 'selected' : ''}}>0</option>
                            <option value=1 {{!empty($obj) &&$obj->no_of_children == 1 ? 'selected' : ''}}>1</option>
                            <option value=2 {{!empty($obj) && $obj->no_of_children == 2 ? 'selected' : ''}}>2</option>
                            <option value=3 {{!empty($obj) && $obj->no_of_children == 3 ? 'selected' : ''}}>3</option>
                            <option value=4 {{!empty($obj) && $obj->no_of_children == 4 ? 'selected' : ''}}>4</option>
                            <option value=5 {{!empty($obj) && $obj->no_of_children == 5 ? 'selected' : ''}}>5</option>
                            @else
                            <option value=0 {{request()->no_of_children == 0 ? 'selected' : ''}}>0</option>
                            <option value=1 {{request()->no_of_children == 1 ? 'selected' : ''}}>1</option>
                            <option value=2 {{request()->no_of_children == 2 ? 'selected' : ''}}>2</option>
                            <option value=3 {{request()->no_of_children == 3 ? 'selected' : ''}}>3</option>
                            <option value=4 {{request()->no_of_children == 4 ? 'selected' : ''}}>4</option>
                            <option value=5 {{request()->no_of_children == 5 ? 'selected' : ''}}>5</option>
                            @endif
                        </select>
                    </div>
                </div>
                <div class="col-lg-2">
                    <div class="form-group">
                        <label for="type_visa">Type of visa</label>
                        <select class="form-control" id="type_visa" name="type_visa" required>
                            <option label=""></option>
                            @foreach(config('myconfig.type_visa') as $key=>$value)
                                @if(!isset($obj))
                                    <option
                                        value="{{$key}}" {{request()->get('type_visa') == $key ? 'selected' : ''}}>{{$value}}</option>
                                @else
                                    <option
                                        value="{{$key}}" {{$obj->type_visa == $key ? 'selected' : ''}}>{{$value}}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-lg-2">
                    <div class="form-group">
                        <label for="start_date">Start date</label>
                        <input class="form-control datetimepicker" id="start_date" name="start_date"
                               value="{{isset($obj) ? $obj->start_date : old('start_date')}}" type="text"
                               data-options='{"dateFormat":"d/m/Y"}'>
                    </div>
                </div>
                <div class="col-lg-2">
                    <div class="form-group">
                        <label for="start_date">End date</label>
                        <input class="form-control datetimepicker" id="end_date" name="end_date"
                               value="{{isset($obj) ? $obj->end_date : old('end_date')}}" type="text"
                               data-options='{"dateFormat":"d/m/Y"}'>
                    </div>
                </div>
                <div class="col-lg-2">
                    <label for="net_amount">Net amount ($)</label>
                    <div class="input-group mb-3">
                        <input class="form-control" id="net_amount" name="net_amount"
                               value="{{isset($obj) ? $obj->net_amount : 0}}" type="text" step="0.01">
                    <div class="input-group-append"><span class="input-group-text">{{!empty($obj)? $obj->provider->currency() : ''}}</span></div>
                    </div>
                </div>
                <div class="col-lg-2">
                    <div class="form-group">
                        <label for="status">Status</label>
                        <select class="form-control" id="status" name="status" required>
                            <option label=""></option>
                            @foreach(config('myconfig.payment_status') as $key=>$value)
                                @if(!isset($obj))
                                    <option value="{{$key}}" {{old('status') == $key ? 'selected' : ''}}>{{$value}}</option>
                                @else
                                    <option value="{{$key}}" {{$obj->status == $key ? 'selected' : ''}}>{{$value}}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-lg-10">
                    <div class="form-group">
                        <label for="ref_no">Note</label>
                        <textarea class="form-control" id="note" name="note"
                                  rows="3">{{isset($obj) ? $obj->note : old('note')}}</textarea>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
