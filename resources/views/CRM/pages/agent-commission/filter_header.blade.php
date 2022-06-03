<div class="card mb-3">
    <div class="contenr-header">
        <div class="card-header">
            <div class="row">
                <div class="col-lg-10">
                    <div class="select-box">
                        <div class="row">
                            <div class="col-md-2 col-sm-4 col-xs-6">
                                <label for="event-type">Agent</label>
                                <select class="form-control form-control-sm" id="f_agent" name="f_agent">
                                    <option value='all'>all</option>
                                    @if(!empty($users))
                                        @foreach($users as $user)
                                            <option value={{$user->id}}>{{$user->name}}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                            <div class="col-md-2 col-sm-4 col-xs-6">
                                <label for="event-type">Service</label>
                                <select class="form-control form-control-sm" id="f_service">
                                    <option value="all">all</option>
                                    @if(!empty($dichvus))
                                        @foreach($dichvus as $dichvu)
                                            <option value={{$dichvu->id}}>{{$dichvu->name}}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                            <div class="col-md-2 col-sm-4 col-xs-6">
                                <label for="event-type">Provider</label>
                                <select class="form-control form-control-sm" id="f_provider">
                                    <option value="all">all</option>
                                </select>
                            </div>
                            <div class="col-md-2 col-sm-4 col-xs-6">
                                <label for="timepicker2">Validity start date</label>
                                <input class="form-control form-control-sm datetimepicker"
                                       value="{{isset($f_data) ? $f_data['f_time'] : ''}}" id="f_time" type="f_time"
                                       data-options='{"mode":"range","dateFormat":"Y-m-d"}'>
                            </div>
                            <div class="col-md-2 col-sm-4 col-xs-6">
                                <label for="event-type">Policy</label>
                                <select class="form-control form-control-sm" id="f_policy" name="f_policy">
                                    <option value='all'>all</option>
                                    @foreach(config('myconfig.policy') as $key=>$value)
                                        <option value={{$key}}>{{$value}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-2 col-sm-4 col-xs-6">
                                <label for="event-type">Status</label>
                                <select class="form-control form-control-sm" id="f_status" name="f_status">
                                    <option value='all'>all</option>
                                    @foreach(config('myconfig.status') as $key=>$value)
                                        <option value={{$key}}>{{$value}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-2 col-sm-4 col-xs-6">
                                <label for="event-type">Commission</label>
                                <input class="form-control form-control-sm" type="number" name="f_comm" id="f_comm">
                            </div>
                            <div class="col-md-2 col-sm-4 col-xs-6">
                                <label for="event-type">Country</label>
                                <select class="form-control form-control-sm" id="f_country" name="f_country">
                                    <option value='all'>all</option>
                                    @foreach(config('country.list') as $key=>$value)
                                        <option value={{$key}}>{{$value}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-2 col-sm-4 col-xs-6">
                                <label for="event-type">Unit</label>
                                <select class="form-control form-control-sm" id="f_unit" name="f_unit">
                                    <option value='all'>all</option>
                                    @foreach(config('myconfig.unit') as $key=>$value)
                                        <option value={{$key}}>{{$value}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <br />
            <div class="row">
                <div class="col-lg-6">
                    <div class="form-row">
                        <div class="col-lg-3 col-md-3 col-sm-6 col-new">
                            <a class="form-control form-control-sm btn btn-falcon-success btn-sm sxme add_new d-flex justify-content-center align-items-center"
                               href="#!"><span class="fas fa-plus mr-1" data-fa-transform="shrink-3"></span>
                                <span>New</span></a>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-6 col-new">
                            <a class="form-control form-control-sm btn btn-falcon-info btn-sm sxme edit_all d-flex justify-content-center align-items-center"
                               href="#!"><span class="fas fa-edit mr-1" data-fa-transform="shrink-3"></span>
                                <span>Edit</span></a>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-6 col-new">
                            <a class="form-control form-control-sm btn btn-falcon-danger btn-sm sxme del_all d-flex justify-content-center align-items-center"
                               href="#!">
                                <span class="fas fa-trash mr-1" data-fa-transform="shrink-3"></span>
                                <span>Delete</span>
                            </a>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-6 col-new">
                            <a class="form-control form-control-sm btn btn-falcon-warning btn-sm sxme d-flex justify-content-center align-items-center"
                               href="#!" data-toggle="modal" data-target="#importModal">
                                <i class="fas fa-file-import mr-1"></i>
                                <span>Import</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
