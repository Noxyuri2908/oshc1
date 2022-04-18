<div class="card mb-3">
    <div class="card-header">
        <div class="chevron-down-up">
            <h5 class="mb-0">Commission Settings</h5>
            <p class="click-down" data-id="com"><span class="fas fa-chevron-down"></span></p>
        </div>
    </div>
    <div class="card-body bg-light" data-id="com">
        @can('commissionAgent.store')
            @if(empty($is_show))
                <a href="#" class="mb-4 d-block d-flex align-items-center add-comm-slide-show"><span
                        class="circle-dashed">
                        <span class="fas fa-plus"></span></span>
                    <span class="ml-3">Add new commission</span>
                </a>
            @endif
        @endcan
        <div class="collapse" id="comm-form">
            <form>
                <div class="alert-danger validate-form-agent-error">

                </div>
                <div class="alert-success validate-form-agent-success">

                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-lg-3 text-lg-right">
                            <label class="mb-0" for="service">Service</label>
                        </div>
                        @foreach($services as $service)
                            <input type="hidden" id="info_service_{{$service->id}}" data-src="{{$service->image}}"
                                   data-name="{{$service->name}}">
                        @endforeach
                        <div class="col-lg-7">
                            <select id="service" class="form-control">
                                @foreach($services as $service)
                                    <option value="{{$service->id}}">{{$service->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-lg-3 text-lg-right">
                            <label class="mb-0" for="policy">Policy</label>
                        </div>
                        <div class="col-lg-7">
                            <select id="policy" class="form-control">
                                @foreach(config('myconfig.policy') as $key=>$value)
                                    <option value="{{$key}}">{{$value}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-lg-3 text-lg-right">
                            <label class="mb-0" for="city">Commission</label>
                        </div>
                        <div class="col-lg-7">
                            <input class="form-control form-control-sm" id="commission" type="number" placeholder="5"/>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-lg-3 text-lg-right">
                            <label class="mb-0" for="city">(%) / ($)</label>
                        </div>
                        <div class="col-lg-7">
                            <select class="form-control" id="donvi_comm">
                                @foreach(config('myconfig.donvi') as $key=>$value)
                                    <option value="{{$key}}">{{$value}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-lg-3 text-lg-right">
                            <label class="mb-0" for="city">GST</label>
                        </div>
                        <div class="col-lg-7">
                            <select class="form-control" id="gst_comm" style="text-transform: uppercase">
                                <option value=""></option>
                                @foreach(config('myconfig.gst') as $key => $value)
                                    @if($key == (int)$obj->gst)
                                        <option value="{{$key}}" selected>{{$value}}</option>
                                    @else
                                        <option value="{{$key}}">{{$value}}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-lg-3 text-lg-right">
                            <label class="mb-0" for="city">Type payment</label>
                        </div>
                        <div class="col-lg-7">
                            <select class="form-control" id="type_payment_comm">
                                <option value="1">Monthly</option>
                                <option value="2">Deduction com</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-lg-3 text-lg-right">
                            <label class="mb-0" for="end_date">Validity start date</label>
                        </div>
                        <div class="col-lg-7">
                            <input class="form-control orm-control-sm datetimepicker" id="end_date" name="end_date"
                                   type="text" data-options='{"dateFormat":"d/m/Y"}'>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-lg-7 offset-lg-3">
                            @if(empty($is_show))
                                @can('commissionAgent.store')
                                    <button class="btn btn-primary add_new_comm" id="add_new_comm" type="button">Add
                                    </button>
                                @endcan
                                <button class="btn btn-danger close_slide_form" type="button">Close</button>
                            @endif
                        </div>
                    </div>
                </div>
            </form>
            <hr class="border-dashed border-bottom-0 my-4"/>
        </div>
        @if(isset($obj))
            <div id="data-old">
                @foreach($comms as $comm)
                    <input type="hidden" id="old_comm_{{$comm->id}}" data-service="{{$comm->type_service}}"
                           data-type="{{$comm->type}}" data-comm="{{$comm->comm}}" data-date="{{$comm->date}}">
                @endforeach
            </div>
            <div id="data-hidden">
                {{-- @foreach($comms as $comm)
                <input type="hidden" name="service_id[]" value="{{$comm->type_service}}">
                <input type="hidden" name="type[]" value="{{$comm->type}}">
                <input type="hidden" name="comm[]" value="{{$comm->comm}}">
                <input type="hidden" name="date[]" value="{{$comm->date}}">
                <input type="hidden" name="donvi[]" value="{{$comm->donvi}}">
                <input type="hidden" name="gst[]" value="{{$comm->gst}}">
                <input type="hidden" name="type_payment[]" value="{{$comm->type_payment}}">
                @endforeach --}}
            </div>
            <div class="w-100 table-div" style="overflow-x: scroll">
                <table class="table">
                    <thead>
                    <tr class="first-row">
                        <th class="width-40" scope="col">Action</th>
                        <th class="width-140" scope="col">Service</th>
                        <th class="width-80" scope="col">Policy</th>
                        <th class="width-90" scope="col">Commission</th>
                        <th class="width-100" scope="col">GST</th>
                        <th class="width-100" scope="col">Type Payment</th>
                        <th class="width-130" scope="col">Validity start date</th>
                    </tr>
                    </thead>
                    <tbody id="table_comm">
                    @include('CRM.partials.com-agent',['comms'=>$comms])
                    </tbody>
                </table>
            </div>
        @else
            <div id="data-hidden">
            </div>
            <div class="w-100" style="overflow-x: scroll">
                <table class="table">
                    <thead class="thead-dark">
                    <tr>
                        <th scope="col">Service</th>
                        <th scope="col">Policy</th>
                        <th scope="col">Commission</th>
                        <th scope="col">GST</th>
                        <th scope="col">Type Payment</th>
                        <th scope="col">Validity start date</th>
                    </tr>
                    </thead>
                    <tbody id="table_comm">
                    </tbody>
                </table>
            </div>
        @endif
    </div>
</div>
