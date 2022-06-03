@if($hh != null && $comm != null)
    {{--    @php--}}
    {{--        dd($providerCom->textCom());--}}
    {{--    @endphp--}}
    <fieldset>
        <legend>Commission from provider</legend>
        <div class="form">
            <div class="form-group clearfix">
                <label class="control-label">% Commission received</label>
                <div class="input-contenr">
                    <input type="text" class="form-control text-right" id="comm_re" value="{{$providerCom->textCom()}}"
                           readonly>
                    <input type="hidden" id="payment_note" value="{{$payment_note}}">
                    <input type="hidden" id="provider_com_id" value="2">
                </div>
            </div>
            <div class="form-group d-flex">
                <label class="control-label">Amount ($)</label>
                <div class="input-group">
                    @php
                        if($providerCom->type == 1){
                            switch ($payment_note) {
                                case '1':
                                    $re_total_amount = floatval($obj->net_amount)*floatval($providerCom->amount)/100;
                                    break;
                                default:
                                    $re_total_amount = convert_price_float($providerCom->amount);
                                    break;
                            }
                        }else{
                            $re_total_amount = convert_price_float(floatval($obj->net_amount));
                        }
                        $re_total_amount = floor($re_total_amount * 100) / 100
                    @endphp

                    <input type="text" class="form-control text-right" id="re_total_amount"
                           value="{{convert_price_float($re_total_amount)}}" step="0.01" readonly>
                    <div class="rounded-right input-currency-group d-flex align-items-center">
                        <span class=""
                              id="basic-addon1">{{$obj->provider != null ? $obj->provider->currency() : ''}}</span>
                    </div>
                </div>
            </div>
            <div class="form-group clearfix">
                <label class="control-label">Bonus com from provider </label>
                <div class="input-contenr">
                    <input class="form-control text-right" id="bonus_com_from_provider" type="text"
                           value="{{!empty($profit) ? $profit->bonus_com_from_provider : ''}}">
                </div>
            </div>
            <div class="form-group clearfix">
                <label class="control-label">Exchange rate</label>
                <div class="input-contenr">
                    <input type="text" class="form-control text-right" id="exchange_rate_re_provider"
                           @if(!empty($profit))
                               value="{{$profit->exchange_rate_re_provider}}"
                           @else
                               value="{{$exchangeRateProvider}}"
                        @endif
                        {{--                           @elseif(!empty($payment_note))--}}
                        {{--                           @if($payment_note == 2)--}}
                        {{--                           value="1"--}}
                        {{--                           @elseif($payment_note == 1)--}}
                        {{--                           value='0'--}}
                        {{--                        @endif--}}
                    >
                </div>
            </div>
            <div class="form-group clearfix">
                <label class="control-label">Total amount (vnd)</label>
                <div class="input-contenr">
                    <input class="form-control text-right" id="re_total_amount_vn" type="text" value="0" readonly>
                </div>
            </div>

            <div class="form-group clearfix">
                <label class="control-label">Date of receipt</label>
                <div class="input-contenr">
                    <input type="text" placeholder="dd/mm/YYYY" class="form-control text-right" id="date_of_receipt"
                           value="{{$profit != null ? convert_date_form_db($profit->date_of_receipt) :'' }}" required>
                </div>
            </div>

            <div class="form-group clearfix">
                <label class="control-label">Note</label>
                <div class="input-contenr">
                    <textarea class="form-control" id="note_of_receipt"
                              rows="5">{{$profit != null ? $profit->note_of_receipt : 0}}</textarea>
                </div>
            </div>
        </div>
    </fieldset>
@else
    <div class="alert-danger">
        Commission received from provider is empty, please redirect to agent commission and set % commission
        <a class="" href="{{route('agent.edit',['id'=>$agent->id])}}">Here</a>
    </div>

@endif
@push('scripts')
    @include('CRM.partials.choose_date',[
    'ids'=>[
        'pay_provider_date'
]
])
    <script>

        $('#exchange_rate_re_provider').inputmask({alias: 'currency', prefix: '', digits: 2})
        $('#bonus_com_from_provider').inputmask({alias: 'currency', prefix: '', digits: 2})

        function convertNumberToCurrency(number) {
            if (number !== undefined) {
                var currency = number.toLocaleString(
                    undefined, // leave undefined to use the browser's locale,
                    // or use a string like 'en-US' to override it.
                    {minimumFractionDigits: 2},
                )
                return currency
            }
        }

        function calReAmountVN() {
            _tmp = getNumber($('#re_total_amount').val())
            _net_amount = parseFloat(_tmp)
            _exchange_rate = $('#exchange_rate_re_provider').val() || '0'
            _exchange_rate = _exchange_rate.replace(/,/g, '')
            _total_VN = _net_amount * _exchange_rate
            $('#re_total_amount_vn').val(convertNumberToCurrency(parseInt(_total_VN)))
        }

        @if(!empty($payment_note) && $payment_note == 1)
        $(document).on('change', '#date_of_receipt', function (e) {
            let dateChoose = $(this).val()
            let typeExchangeRate = $('#provider_com_id').val()
            $.ajax({
                url: "{{route('ajax.getExchangeRateByDate')}}",
                type: 'get',
                data: {
                    type: typeExchangeRate,
                    date: dateChoose,
                },
                success: function (data) {
                    $('#exchange_rate_re_provider').val(data)
                    calReAmountVN()
                },
            })
        })
        @endif
    </script>
@endpush
