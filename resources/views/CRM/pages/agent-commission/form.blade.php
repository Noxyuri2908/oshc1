<div class="modal fade user-information" id="modal_com_add" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{!empty($commData)?'Edit':'Add'}} commission</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span class="font-weight-light" aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="content-information" onmouseover="hoverToLoadSelectAgentContact()" >
                    <div class="row">
                        <div class="col-md-6 content-table fill_content">
                            <div class="form-group form-select-2 user_id_select2">
                                <label class="control-label">Agent:</label>
                                <select id="user_id" name="user_id" class="form-control" required>

                                </select>
                                <small id="user_id_div_alert" class="text-danger"></small>
                            </div>
                        </div>
                        <div class="col-md-6 content-table fill_content">
                            <div class="form-group">
                                <label class="control-label">Country service:</label>
                                <input class="form-control" type="text" id="country_service" readonly value="{{!empty($commData)?$commData->user->country():''}}">
                                <small id="country_service_div_alert" class="text-danger"></small>
                            </div>
                        </div>
                        <div class="col-md-6 content-table fill_content">
                            <div class="form-group">
                                <label class="control-label">Service:</label>
                                <select id="service_id" name="service_id" class="form-control">
                                    <option label=""></option>
                                    @if(!empty($dichvus))
                                        @foreach($dichvus as $dichvu)
                                            <option value="{{$dichvu->id}}" {{!empty($commData) && $commData->service_id == $dichvu->id?'selected':''}}>{{$dichvu->name}}</option>
                                        @endforeach
                                    @endif
                                </select>
                                <small id="service_id_div_alert" class="text-danger"></small>
                            </div>
                        </div>
                        <div class="col-md-6 content-table fill_content">
                            <div class="form-group">
                                <label class="control-label">Provider:</label>
                                @if(!empty($commData) && !empty($commData->service_id) && !empty($dichvus->where('id',$commData->service_id)->first()))
                                    <select class="form-control" name="provider_id" id="provider_id">
                                        @foreach($dichvus->where('id',$commData->service_id)->first()->providers as $provider)
                                            <option label="" value="{{$provider->id}}" {{!empty($commData) && $commData->provider_id == $provider->id?'selected':''}}>{{$provider->name}}</option>
                                        @endforeach
                                    </select>
                                @else
                                    <select class="form-control" name="provider_id" id="provider_id">

                                    </select>
                                @endif
                                <small id="provider_id_div_alert" class="text-danger"></small>
                            </div>
                        </div>
                        <div class="col-md-4 content-table fill_content">
                            <div class="form-group">
                                <label class="control-label">Commission:</label>
                                <input type="number" id="comm" name="comm" class="form-control" placeholder="" value="{{!empty($commData)?$commData->comm:''}}" required>
                                <small id="comm_div_alert" class="text-danger"></small>
                            </div>
                        </div>
                        <div class="col-md-4 content-table fill_content">
                            <div class="form-group">
                                <label class="control-label">Policy:</label>
                                <select class="form-control" id="policy" name="policy">
                                    @foreach($typePolicyConfig as $key=>$value)
                                        <option value="{{$key}}" {{!empty($commData) && $commData->policy == $key?'selected':''}}>{{$value}}</option>
                                    @endforeach
                                </select>
                                <small id="policy_div_alert" class="text-danger"></small>
                            </div>
                        </div>
                        <div class="col-md-4 content-table fill_content">
                            <div class="form-group">
                                <label class="control-label">(%) / ($):</label>
                                <select class="form-control" name="donvi" id="donvi">
                                    <option value=""></option>
                                    @foreach($typeUnitConfig as $key=>$value)
                                        <option value="{{$key}}" {{!empty($commData) && $commData->donvi == $key?'selected':''}}>{{$value}}</option>
                                    @endforeach
                                </select>
                                <small id="donvi_div_alert" class="text-danger"></small>
                            </div>
                        </div>
                        {{--<div class="col-md-4 content-table fill_content">--}}
                        {{--    <div class="form-group">--}}
                        {{--        <label class="control-label">Unit:</label>--}}
                        {{--        <select class="form-control" name="unit" id="unit">--}}
                        {{--            <option value=""></option>--}}
                        {{--            @foreach($currencyConfig as $key=>$value)--}}
                        {{--                <option value="{{$key}}" {{!empty($commData) && $commData->unit == $key?'selected':''}}>{{$value}}</option>--}}
                        {{--            @endforeach--}}
                        {{--        </select>--}}
                        {{--        <small id="unit_div_alert" class="text-danger"></small>--}}
                        {{--    </div>--}}
                        {{--</div>--}}
                        <div class="col-md-6 content-table">
                            <div class="form-group">
                                <label class="control-label">Type Payment:</label>
                                <select class="form-control" name="type_payment" id="type_payment">
                                    <option value=""></option>
                                    @if(!empty($typePaymentConfig))
                                        @foreach($typePaymentConfig as $keyPaymnet=>$valuePayment)
                                            <option value="{{$keyPaymnet}}" {{!empty($commData) && $commData->type_payment == $keyPaymnet?'selected':''}}>{{$valuePayment}}</option>
                                        @endforeach
                                    @endif
                                </select>
                                <small id="type_payment_div_alert" class="text-danger"></small>
                            </div>
                        </div>
                        <div class="col-md-6 content-table">
                            <div class="form-group">
                                <label class="control-label">GST:</label>
                                <select class="form-control" name="gst" id="gst">
                                    <option value=""></option>
                                    @if(!empty($typeGstConfig))
                                        @foreach($typeGstConfig as $keyGst=>$valueGst)
                                            <option value="{{$keyGst}}" {{!empty($commData) && $commData->gst == $keyGst?'selected':''}}>{{$valueGst}}</option>
                                        @endforeach
                                    @endif
                                </select>
                                <small id="gst_div_alert" class="text-danger"></small>
                            </div>
                        </div>
                        <div class="col-md-6 content-table fill_content">
                            <div class="form-group">
                                <label class="control-label">Validity start date:</label>
                                <input class="form-control datetimepicker" id="validity_start_date" name="date" type="text" value="{{!empty($commData)?convert_date_form_db($commData->validity_start_date):''}}" data-options='{"dateFormat":"d/m/Y"}'>
                                <small id="validity_start_date_div_alert" class="text-danger"></small>
                            </div>
                        </div>
                        <div class="col-md-6 content-table">
                            <div class="form-group">
                                <label class="control-label">Status:</label>
                                <select class="form-control" name="status" id="status" required>
                                    <option value="1"  {{!empty($commData) && $commData->status == 1?'selected':''}}> Active</option>
                                    <option value="2"  {{!empty($commData) && $commData->status == 2?'selected':''}}> Inactive</option>
                                </select>
                                <small id="status_div_alert" class="text-danger"></small>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-success mr-1 mb-1 btn_agent_commission_form" data-url="{{!empty($commData)?route('com.update',['id'=>$commData->id]):route('com.store')}}">{{!empty($commission)?'Update':'Save'}}</button>
                <button class="btn btn-danger mr-1 mb-1" type="button" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
@include('CRM.partials.script-call-agent',[
    'nameFunction'=>'hoverToLoadSelectAgentContact',
    'elementIdSelect2'=>'user_id',
    'elementParentIdSelect2'=>'user_id_select2',
    'data'=>(!empty($commData))?$commData:null,
    'dataName'=>(!empty($commData) && !empty($commData->user))?$commData->user->name:'',
    'dataId'=>(!empty($commData) && !empty($commData->user))?$commData->user_id:''
]);
{{--<script>--}}
{{--    function getUserId(){--}}
{{--        $('select#user_id').select2({--}}
{{--            dropdownParent: $('.form-select-2'),--}}
{{--            ajax: {--}}
{{--                url: '{{route('agent.getAgentSelect')}}',--}}
{{--                type: 'GET',--}}
{{--                quietMillis: 10000,--}}
{{--                dataType: 'json',--}}
{{--                data: function (term) {--}}
{{--                    var query = {--}}
{{--                        name: term.term,--}}
{{--                    }--}}
{{--                    return query;--}}
{{--                },--}}
{{--                processResults: function (data) {--}}
{{--                    // Transforms the top-level key of the response object from 'items' to 'results'--}}

{{--                    var results = [];--}}
{{--                    data.forEach(e => {--}}
{{--                        results.push({--}}
{{--                            id: e.id,--}}
{{--                            text: e.name ,--}}
{{--                            country :e.country--}}
{{--                        });--}}
{{--                    });--}}
{{--                    return {--}}
{{--                        results: results--}}
{{--                    };--}}
{{--                }--}}
{{--            },--}}
{{--        })--}}
{{--        $('select#user_id').on('select2:select', function (e) {--}}
{{--            var data = e.params.data;--}}
{{--            var country = data.country;--}}
{{--            $('#country_service').val(country);--}}
{{--        });--}}
{{--    }--}}

{{--</script>--}}
