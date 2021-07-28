@if($hh != null && $comm != null && $agent != null)
    <fieldset onmouseover="numberFormatVnd();">
        <legend>Commission for Agent/ Counsellor</legend>
        <div class="form">
            <input type="hidden" id="agent_com_id" value="1">
            <div class="form-group clearfix">
                <label class="control-label">Commission rate</label>
                <div class="input-contenr">
                    <input type="text" id="comm_rate_agent_profit" class="form-control text-right" value="{{$comm->comm}}%" data-com="{{$comm->comm}}" readonly>
                </div>
            </div>
            <div class="form-group clearfix">
                <label class="control-label">Bonus %</label>
                <div class="input-contenr">
                    <input type="number" class="form-control text-right" id="pay_agent_bonus" value="{{$profit != null ? $profit->pay_agent_bonus : 0}}">
                </div>
            </div>
            <div class="form-group clearfix">
                <label class="control-label">Amount com</label>
                <div class="input-contenr">
                    <input type="text" class="form-control text-right" id="pay_agent_amount_comm" value="{{$obj->comm}}" step="0.01" readonly>
                </div>
            </div>
            <div class="form-group clearfix">
                <label class="control-label">+/- ($)</label>
                <div class="input-contenr">
                    <input type="text" class="form-control text-right" id="pay_agent_extra" value="{{$profit != null ? $profit->pay_agent_extra : 0}}">
                </div>
            </div>
            <div class="form-group clearfix">
                <label class="control-label">Total amount com ($)</label>
                <div class="input-contenr">
                    <input type="text" class="form-control text-right" id="pay_agent_total_amount" value="" readonly>
                </div>
            </div>
            <div class="form-group clearfix">
                <label class="control-label">Exchange rate</label>
                <div class="input-contenr">
                    <input type="text" class="form-control text-right" id="pay_agent_exchange_rate" value="{{$profit != null ? $profit->pay_agent_exchange_rate : $exchangeRateAgent}}">
                </div>
            </div>
            <div class="form-group clearfix">
                <label class="control-label">Amount VND</label>
                <div class="input-contenr">
                    <input type="text" class="form-control text-right" id="pay_agent_amount_VN" value="" readonly>
                </div>
            </div>
            <div class="form-group clearfix">
                <label class="control-label">Date of payment</label>
                <div class="input-contenr">
                    <input class="form-control text-right choose-date-form" id="pay_agent_date" type="text" placeholder="dd/mm/YYYY" value="{{$profit != null ? convert_date_form_db($profit->pay_agent_date) : ''}}" autocomplete="off" >
                </div>
            </div>
            <div class="form-group clearfix">
                <label class="control-label">GST Status</label>
                <div class="input-contenr">
                    <select class="form-control" id="gst_status_agent_profit">
                        @if(!empty($profit))
                            <option value="1" {{$profit->gst_status_agent_profit == 1 ? 'selected' : ''}}>Included</option>
                            <option value="2" {{$profit->gst_status_agent_profit == 2 ? 'selected' : ''}}>Not Included</option>
                        @else
                            <option value="1" {{$agent->gst == 1 ? 'selected' : ''}}>Included</option>
                            <option value="2" {{$agent->gst == 2 ? 'selected' : ''}}>Not Included</option>
                        @endif
                    </select>
                </div>
            </div>
            <div class="form-group clearfix">
                <label class="control-label">Issue Date</label>
                <div class="input-contenr">
                    <div class="form-row ">
                        <div class="col-md-12 col-sm-5 conte">
                            <input placeholder="dd/mm/yyyy" type="text" class="form-control text-right choose-date-form" data-options='{"dateFormat":"d/m/Y"}' id="issue_date_com_agent_profit" value="{{(!empty($profit))?\Carbon::parse($profit->issue_date_com_agent)->format('d/m/Y'):convert_date_form_db($issueDate)}}">
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group clearfix">
                <label class="control-label">Note</label>
                <div class="input-contenr">
                    <div class="form-row ">
                        <div class="col-md-12 col-sm-5 conte">
                            <textarea name="note_cp" class="form-control" id="note_cp" cols="30" rows="5">{{($profit->note_cp) ?? ''}}</textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </fieldset>
@endif
@push('scripts')
    @include('CRM.partials.choose_date',[
    'ids'=>[
        'pay_agent_date',
        'issue_date_com_agent_profit'
]
])
    <script>



        @if(!empty($payment_note) && $payment_note == 1)
        $(document).on('change', '#pay_agent_date', function (e) {
            let dateChoose = $(this).val()
            let typeExchangeRate = $('#agent_com_id').val()
            $.ajax({
                url: "{{route('ajax.getExchangeRateByDate')}}",
                type: 'get',
                data: {
                    type: typeExchangeRate,
                    date: dateChoose,
                },
                success: function (data) {
                    if (data != 0) {
                        $('#pay_agent_exchange_rate').val(data)
                    }
                    calReAmountVNAgent()
                },
            })
        })
        @endif



    </script>
    @include('CRM.partials.number_currency',['ids'=>[
        'pay_agent_amount_comm',
        'pay_agent_extra',
        'pay_agent_total_amount'
    ]])
    @include('CRM.partials.js.number_vnd_format',[
    'ids'=>[
        'pay_agent_exchange_rate',
        'pay_agent_amount_VN'
    ],
    'nameFunction'=>'numberFormatVnd'
])
@endpush
