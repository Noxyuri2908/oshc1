@if($hh != null && $comm != null)
    <fieldset>
        <legend>Pay for provider</legend>
        <div class="form">
            <div class="form-group clearfix">
                <label class="control-label">% Paid</label>
                <div class="input-contenr">
                    <input readonly class="form-control text-right" id="pay_provider_paid"
                           value="{{$profit != null ? $profit->pay_provider_paid : 0}}">
                </div>
            </div>
            <div class="form-group d-flex">
                <label class="control-label">Amount</label>
                <div class="input-group">
                    <input type="text" class="form-control text-right" id="pay_provider_amount"
                           value="{{$profit != null ? $profit->pay_provider_amount : 0}}" readonly>
                    <div class="rounded-right input-currency-group d-flex align-items-center">
                        <span class=""
                              id="basic-addon1">{{$obj->provider != null ? $obj->provider->currency() : ''}}</span>
                    </div>
                </div>
            </div>
            <div class="form-group d-flex">
                <label class="control-label">Extend fee</label>
                <div class="input-group">
                    <input type="text" class="form-control text-right" id="extend_fee"
                           value="{{$obj->customers() != null ? $obj->customers()->first()->extend_fee : 0}}" readonly>
                    <div class="rounded-right input-currency-group d-flex align-items-center">
                        <span class=""
                              id="basic-addon1">{{$obj->provider != null ? $obj->provider->currency() : ''}}</span>
                    </div>
                </div>
            </div>
            <div class="form-group clearfix">
                <label class="control-label">Bank fee / Surcharge fee</label>
                <div class="input-contenr">
                    <select class="form-control text-right" id="pay_provider_bank_fee">
                        @foreach(config('myconfig.bank_fee') as $key=>$value)
                            <option
                                value="{{$key}}" {{!empty($profit) && $profit->pay_provider_bank_fee == $key?'selected':''}}>{{$value}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group clearfix">
                <label class="control-label">Total amount</label>
                <div class="input-contenr">
                    <input type="text" class="form-control text-right" id="pay_provider_total_amount" value="" readonly>
                </div>
            </div>
            <div class="form-group clearfix">
                <label class="control-label">Exchange rate</label>
                <div class="input-contenr">
                    <input type="text" class="form-control text-right" id="pay_provider_exchange_rate"
                           value="{{!empty($profit)?$profit->pay_provider_exchange_rate:$exchangeRateProvider}}">
                    {{-- {{$profit != null ? $profit->pay_provider_exchange_rate : 0}} --}}
                </div>
            </div>
            <div class="form-group clearfix">
                <label class="control-label">Total amount VND</label>
                <div class="input-contenr">
                    <input type="text" class="form-control text-right" id="pay_provider_total_VN" value="" readonly>
                </div>
            </div>
            <div class="form-group clearfix">
                <label class="control-label">Provider</label>
                <div class="input-contenr">
                    <input type="text" class="form-control text-right"
                           value="{{$obj->provider != null ? $obj->provider->name : ''}}" readonly>
                </div>
            </div>
            <div class="form-group clearfix">
                <label class="control-label">Payment note</label>
                <div class="input-contenr">
                    <input type="text" class="form-control text-right" id="profit_payment_note_provider"
                           value="{{isset(config('myconfig.payment_note_provider')[$payment_note]) ? config('myconfig.payment_note_provider')[$payment_note] : ''}}"
                           readonly>
                    <input type="text" hidden id="profit_payment_note_hidden" value="{{$payment_note}}">
                </div>
            </div>
            <div class="form-group clearfix">
                <label class="control-label">Date of payment</label>
                <div class="input-contenr">
                    <input class="form-control text-right" id="pay_provider_date" type="text" placeholder="dd/mm/YYYY"
                           value="{{$profit != null ? convert_date_form_db($profit->pay_provider_date) : ''}}">
                </div>
            </div>
            <div class="form-group clearfix">
                <label class="control-label">Bank account</label>
                <div class="input-contenr">
                    <select class="form-control text-right" id="pay_provider_bank_account">
                        @foreach(config('bank_account') as $key=>$value)
                            <option
                                value="{{$key}}" {{$profit != null && $profit->pay_provider_bank_account == $key ? 'selected' : ''}}>{{$key}}
                                ({{$value['code']}})
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
    </fieldset>
@endif

@push('scripts')
    @include('CRM.partials.choose_date',['ids'=>['pay_provider_date']])
    @include('CRM.partials.number_currency',['ids'=>['pay_provider_total_VN', 'pay_provider_exchange_rate', 'pay_provider_amount'], 'currency' => !empty($obj) ? $obj->provider->currency() : ''])
    <script>


        $(document).ready(() => {
            var paid = 100 - parseFloat($('#comm_re').val());
            var profit = $('#profit_payment_note_hidden').val();

            console.log(paid);
            if (profit === "1") {
                $('#pay_provider_paid').val('100%');
            } else if (profit === "2") {
                $('#pay_provider_paid').val(`${paid}%`);
            }
        });
    </script>
@endpush
