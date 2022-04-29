@php
    $agent = $obj->agent
@endphp
@if(isset($obj) && isset($agent))
    <div id="div_hh_alert"></div>
    @if($hh == null)
        <div class="row">
            <input type="hidden" id="id_hh" value="0">
            <div class="col-md-6 form-left">
                <div class="form">
                    <div class="form-group clearfix">
                        <label class="control-label">Agent</label>
                        <div class="input-contenr">
                            <div class="form-row ">
                                <div class="col-md-5 col-sm-5 conte">
                                    <input type="text" class="form-control" value="{{$agent->name}}" readonly>
                                </div>
                                <div class="col-md-7 col-sm-5 conte">
                                    <input type="text" class="form-control text-right" id="agent_comm_tab" value=""
                                           readonly>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group clearfix">
                        <label class="control-label">Date of payment provider</label>
                        <div class="input-contenr">
                            <div class="form-row ">
                                <div class="col-md-12 col-sm-5 conte">
                                    <input type="text" class="form-control text-right"
                                           data-options='{"dateFormat":"d/m/Y"}' id="date_payment_provider" value="">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group clearfix">
                        <label class="control-label">Bank account</label>
                        <div class="input-contenr">
                            <div class="form-row ">
                                <div class="col-md-12 col-sm-5 conte">
                                    <select class="form-control" id="account_bank_hh">
                                        <option label=""></option>
                                        @foreach(getBank() as $key => $item)
                                            <option
                                                value="{{$item->id}}" {{!empty($receipt) && $receipt->account_bank == $item->id ? 'selected':''}}>{{$item->account}} {{$item->code}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group clearfix">
                        <label class="control-label">Note</label>
                        <div class="input-contenr">
                            <div class="form-row ">
                                <div class="col-md-12 col-sm-5 conte">
                                    <textarea name="" class="form-control" id="note" cols="30" rows="5"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 form-right">
                <div class="form">
                    <div class="form-group clearfix">
                        <label class="control-label">Date of payment agent</label>
                        <div class="input-contenr">
                            <div class="form-row ">
                                <div class="col-md-12 col-sm-5 conte">
                                    <input type="text" class="form-control text-right"
                                           data-options='{"dateFormat":"d/m/Y"}' id="date_payment_agent" value="">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group clearfix">
                        <label class="control-label">Policy number</label>
                        <div class="input-contenr">
                            <div class="form-row ">
                                <div class="col-md-12 col-sm-5 conte">
                                    <input type="text" class="form-control text-right" id="policy_no" value="">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group clearfix">
                        <label class="control-label">Issue Date</label>
                        <div class="input-contenr">
                            <div class="form-row ">
                                <div class="col-md-12 col-sm-5 conte">
                                    <input type="text" data-apply_id="{{$obj->id}}" class="form-control text-right"
                                           data-options='{"dateFormat":"d/m/Y"}' id="issue_date" value="">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group clearfix">
                        <label class="control-label">Policy status</label>
                        <div class="input-contenr">
                            <div class="form-row ">
                                <div class="col-md-12 col-sm-5 conte">
                                    <select class="form-control" id="policy_status">
                                        <option value=""></option>
                                        @foreach(config('myconfig.policy_status') as $key=>$value)
                                            <option value="{{$key}}">{{$value}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group clearfix">
                        <label class="control-label">Payment note(Provider)</label>
                        <div class="input-contenr">
                            <div class="form-row ">
                                <div class="col-md-12 col-sm-5 conte">
                                    <select class="form-control" id="payment_note_provider">
                                        @foreach(config('myconfig.payment_note_provider') as $key=>$value)
                                            <option value="{{$key}}">{{$value}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @else
        <div class="row">
            <input type="hidden" id="id_hh" value="{{$hh->id}}">
            <div class="col-md-6 form-left">
                <div class="form">
                    <div class="form-group clearfix">
                        <label class="control-label">Agent</label>
                        <div class="input-contenr">
                            <div class="form-row ">
                                <div class="col-md-5 col-sm-5 conte">
                                    <input type="text" class="form-control text-left" value="{{$agent->name}}" readonly>
                                </div>
                                <div class="col-md-7 col-sm-5 conte">
                                    <input type="text" class="form-control  text-right" id="agent_comm_tab"
                                           value="{{!empty($obj) && !empty($obj->getCom())?$obj->getCom()->display:''}}"
                                           readonly>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group clearfix">
                        <label class="control-label">Date of payment provider</label>
                        <div class="input-contenr">
                            <div class="form-row ">
                                <div class="col-md-12 col-sm-5 conte">
                                    <input type="text" class="form-control text-right"
                                           data-options='{"dateFormat":"d/m/Y"}' autocomplete="off"
                                           id="date_payment_provider"
                                           value="{{(!empty($hh->date_payment_provider))?convert_date_form_db($hh->date_payment_provider):''}}">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group clearfix">
                        <label class="control-label">Bank account</label>
                        <div class="input-contenr">
                            <div class="form-row ">
                                <div class="col-md-12 col-sm-5 conte">
                                    <select class="form-control" id="account_bank_hh">
                                        <option label=""></option>
                                        @foreach(getBank() as $key => $item)
                                            <option
                                                value="{{$item->id}}" {{!empty($hh) && $hh->account_bank == $item->id ? 'selected':''}}>{{$item->account}} {{$item->code}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group clearfix">
                        <label class="control-label">Note</label>
                        <div class="input-contenr">
                            <div class="form-row ">
                                <div class="col-md-12 col-sm-5 conte">
                                    <textarea name="" class="form-control" id="note" cols="30"
                                              rows="5">{{$hh->note}}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 form-right">
                <div class="form">
                    <div class="form-group clearfix">
                        <label class="control-label">Date of payment agent</label>
                        <div class="input-contenr">
                            <div class="form-row ">
                                <div class="col-md-12 col-sm-5 conte">
                                    <input type="text" class="form-control text-right"
                                           data-options='{"dateFormat":"d/m/Y"}' id="date_payment_agent"
                                           autocomplete="off" value="{{convert_date_form_db($hh->date_payment_agent)}}">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group clearfix">
                        <label class="control-label">Policy number</label>
                        <div class="input-contenr">
                            <div class="form-row ">
                                <div class="col-md-12 col-sm-5 conte">
                                    <input type="text" class="form-control text-right" id="policy_no"
                                           value="{{$hh->policy_no}}">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group clearfix">
                        <label class="control-label">Issue Date</label>
                        <div class="input-contenr">
                            <div class="form-row ">
                                <div class="col-md-12 col-sm-5 conte">
                                    <input type="text" class="form-control text-right"
                                           data-options='{"dateFormat":"d/m/Y"}' autocomplete="off" id="issue_date"
                                           value="{{convert_date_form_db($hh->issue_date)}}">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group clearfix">
                        <label class="control-label">Policy status</label>
                        <div class="input-contenr">
                            <div class="form-row ">
                                <div class="col-md-12 col-sm-5 conte">
                                    <select class="form-control" id="policy_status">
                                        @foreach(config('myconfig.policy_status') as $key=>$value)
                                            <option
                                                value="{{$key}}" {{$hh->policy_status == $key ? 'selected' : ''}}>{{$value}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group clearfix">
                        <label class="control-label">Com payment method</label>
                        <div class="input-contenr">
                            <div class="form-row ">
                                <div class="col-md-12 col-sm-5 conte">
                                    <select class="form-control" id="com_payment_method">
                                        <option value="1"{{!empty($hh) && $hh->com_payment_method == 1?'selected':''}}>
                                            Monthly
                                        </option>
                                        <option value="2"{{!empty($hh) && $hh->com_payment_method == 2?'selected':''}}>
                                            Deduction com
                                        </option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group clearfix">
                        <label class="control-label">Payment note(Provider)</label>
                        <div class="input-contenr">
                            <div class="form-row ">
                                <div class="col-md-12 col-sm-5 conte">
                                    <select class="form-control" id="payment_note_provider">
                                        @foreach(config('myconfig.payment_note_provider') as $key=>$value)
                                            <option
                                                value="{{$key}}" {{$hh->payment_note_provider == $key ? 'selected' : ''}}>{{$value}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
@endif
@push('scripts')
    @include('CRM.partials.number_currency',['ids'=>[
        'extra_money'
    ]])
    @include('CRM.partials.choose_date',[
    'ids'=>[
        'extra_time',
        'issue_date',
        'date_payment_agent',
        'date_payment_provider'
]
])
    <script>
        $(document).on('change', '#issue_date', function (e) {
            e.preventDefault()
            let date = $(this).val()
            let id = $(this).attr('data-apply_id')
            $.ajax({
                url: '{{route('ajax.getComByIssueDate')}}',
                type: 'get',
                data: {
                    date: date,
                    id: id,
                },
                success: function (data) {
                    $('#agent_comm_tab').val(data.display)
                },
            })
        })
    </script>
@endpush
