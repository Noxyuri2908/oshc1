<div class="modal fade user-information" id="modal_com_add" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add new commission</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span class="font-weight-light" aria-hidden="true">&times;</span>
                </button>
            </div>
            <form role="form" action="{{route('com.store')}}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="content-information">
                        <div class="row">
                            <div class="col-md-6 content-table fill_content">
                                <div class="form-group">
                                    <label class="control-label">Agent:</label>
                                    <select id="user_id" name="user_id" class="form-control" required>
                                        <option label=""></option>
                                        @if(!empty($users))
                                            @foreach($users as $user)
                                                <option value="{{$user->id}}" data-country="{{$user->country()}}">{{$user->name}}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6 content-table fill_content">
                                <div class="form-group">
                                    <label class="control-label">Country service:</label>
                                    <input class="form-control" type="text" id="country_service" readonly>
                                </div>
                            </div>
                            <div class="col-md-6 content-table fill_content">
                                <div class="form-group">
                                    <label class="control-label">Service:</label>
                                    <select id="service_id" name="service_id" class="form-control">
                                        <option label=""></option>
                                        @if(!empty($dichvus))
                                            @foreach($dichvus as $dichvu)
                                                <option value="{{$dichvu->id}}">{{$dichvu->name}}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6 content-table fill_content">
                                <div class="form-group">
                                    <label class="control-label">Provider:</label>
                                    <select id="type_service" name="type_service" class="form-control">
                                        <option label=""></option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4 content-table fill_content">
                                <div class="form-group">
                                    <label class="control-label">Commission:</label>
                                    <input type="number" id="comm" name="comm" class="form-control" placeholder="" required>
                                </div>
                            </div>
                            <div class="col-md-4 content-table fill_content">
                                <div class="form-group">
                                    <label class="control-label">Policy:</label>
                                    <select class="form-control" name="type">
                                        @foreach(config('myconfig.policy') as $key=>$value)
                                            <option value="{{$key}}">{{$value}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4 content-table fill_content">
                                <div class="form-group">
                                    <label class="control-label">(%) / ($):</label>
                                    <select class="form-control" name="donvi">
                                        @foreach(config('myconfig.donvi') as $key=>$value)
                                            <option value="{{$key}}">{{$value}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6 content-table">
                                <div class="form-group">
                                    <label class="control-label">Type Payment:</label>
                                    <select class="form-control" name="type_payment" id="type_payment">
                                        <option value="1"> Monthly</option>
                                        <option value="2"> Deduction com</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6 content-table">
                                <div class="form-group">
                                    <label class="control-label">GST:</label>
                                    <select class="form-control" name="gst" id="gst">
                                        <option value="0"> Not include</option>
                                        <option value="1"> Include</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6 content-table fill_content">
                                <div class="form-group">
                                    <label class="control-label">Validity start date:</label>
                                    <input class="form-control datetimepicker" id="datepicker" name="date" type="text" data-options='{"dateFormat":"d/m/Y"}'>
                                </div>
                            </div>
                            <div class="col-md-6 content-table">
                                <div class="form-group">
                                    <label class="control-label">Status:</label>
                                    <select class="form-control" name="status" id="status" required>
                                        <option value="1"> Active</option>
                                        <option value="0"> Inactive</option>
                                    </select>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-success mr-1 mb-1" type="submit">Add</button>
                    <button class="btn btn-info mr-1 mb-1" type="reset">Reset</button>
                    <button class="btn btn-danger mr-1 mb-1" type="button" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>
