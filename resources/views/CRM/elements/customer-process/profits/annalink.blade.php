@php
    $_total_VND = floatval($obj->phieuthus->sum('amount'));
@endphp
<fieldset>
    <legend>Annalink received</legend>
    <div class="form">
        <div class="form-group d-flex align-items-center">
            <label class="mb-0">Gross amount</label>
            <div class="input-group">
                <input type="text" class="form-control text-right" name="" id="gross-amount" value="{{convert_price_float($obj->net_amount)}}" step="0.01" readonly>
                <div class="rounded-right input-currency-group d-flex align-items-center">
                    <span class="" id="basic-addon1">{{$obj->provider != null ? $obj->provider->currency() : ''}}</span>
                </div>
            </div>
        </div>
        <div class="form-group d-flex">
            <label class="control-label">Promotion ($)</label>
            <div class="input-group">
                <input type="text" class="form-control text-right" id="promotion_annalink_receipt" name="" value="{{convert_price_float($obj->promotion_amount)}}" step="0.01" readonly>
                <div class="rounded-right input-currency-group d-flex align-items-center">
                    <span class="" id="basic-addon1">{{$obj->provider != null ? $obj->provider->currency() : ''}}</span>
                </div>
            </div>
        </div>
        {{--<div class="form-group d-flex">--}}
        {{--	<label class="control-label">Surcharge ($)</label>--}}
        {{--	<div class="input-group">--}}
        {{--        <input type="text" class="form-control text-right" name="" value="{{convert_price_float($obj->surcharge)}}" step="0.01"  readonly>--}}
        {{--        <div class="rounded-right input-currency-group d-flex align-items-center">--}}
        {{--            <span class="" id="basic-addon1">{{$obj->provider != null ? $obj->provider->currency() : ''}}</span>--}}
        {{--        </div>--}}
        {{--	</div>--}}
        {{--</div>--}}
        <div class="form-group d-flex">
            <label class="control-label">Surcharge fee</label>
            <div class="input-group">
                <input type="text" class="form-control text-right" name="" id="bankfee_annalink_receipt" value="{{convert_price_float($obj->bank_fee_number) + convert_price_float($obj->customers()->first()->extend_fee) }}" step="0.01" readonly>
                <div class="rounded-right input-currency-group d-flex align-items-center">
                    <span class="" id="basic-addon1">{{$obj->provider != null ? $obj->provider->currency() : ''}}</span>
                </div>
            </div>
        </div>
        <div class="form-group d-flex">
            <label class="control-label">Discount $</label>
            <div class="input-group">
                <input type="text" class="form-control text-right" id="discount_annalink_receipt" name="" value="{{convert_price_float($obj->extra)}}" step="0.01" readonly>
                <div class="rounded-right input-currency-group d-flex align-items-center">
                    <span class="" id="basic-addon1">{{$obj->provider != null ? $obj->provider->currency() : ''}}</span>
                </div>
            </div>
        </div>
        <div class="form-group d-flex">
            <label class="control-label">Total amount ($)</label>
            <div class="input-group">
                <input type="text" class="form-control text-right" id="total-amount" name="" value="{{convert_price_float($obj->total)}}" readonly>
                <div class="rounded-right input-currency-group d-flex align-items-center">
                    <span class="" id="basic-addon1">{{$obj->provider != null ? $obj->provider->currency() : ''}}</span>
                </div>
            </div>
        </div>
        <div class="form-group d-flex">
            <label class="control-label">Exchange rate</label>
            <div class="input-group">
                <input type="text" class="form-control text-right" id="exchange_rate_annalink_receipt" name="" value="{{$phieuthu_old_exchange_rate}}" readonly>
                <div class="rounded-right input-currency-group d-flex align-items-center">
                    <span class="" id="basic-addon1">{{$obj->provider != null ? $obj->provider->currency() : ''}}</span>
                </div>
            </div>
        </div>
        <div class="form-group clearfix">
            <label class="control-label">Total amount receive</label>
            <div class="input-group">
                <input type="text" class="form-control text-right " id="total-amount-annalink-received" name="" value="{{convert_price_float($_total_VND)}}" readonly>
                <div class="rounded-right input-currency-group d-flex align-items-center">
                    <span class="" id="basic-addon1">{{!empty($obj->phieuthus) && !empty($obj->phieuthus->first()->current_id)? $obj->phieuthus->first()->getCurrency() : ''}}</span>
                </div>
            </div>
        </div>
        <div class="form-group clearfix">
            <label class="control-label">Difference ($)</label>
            <div class="input-group">
                <input type="text" class="form-control text-right " id="difference-annalink-received" name="" value="{{convert_price_float($obj->difference)}}" readonly>
{{--                <div class="rounded-right input-currency-group d-flex align-items-center">--}}
{{--                    <span class="" id="basic-addon1">{{!empty($obj->phieuthus) && !empty($obj->phieuthus->first()->current_id)? $obj->phieuthus->first()->getCurrency() : ''}}</span>--}}
{{--                </div>--}}
            </div>
        </div>
    </div>
</fieldset>
<script>
    @if(!empty($obj->phieuthus) && !empty($obj->phieuthus->first()->current_id) && $obj->phieuthus->first()->getCurrency() == 'VND')
    $('#total-amount-annalink-received').inputmask({ alias: 'currency', prefix: '', digits: 0 })
    @else
    $('#total-amount-annalink-received').inputmask({ alias: 'currency', prefix: '', digits: 2 })
    @endif
</script>
@push('scripts')
        @include('CRM.partials.number_currency',['ids'=>['gross-amount'], 'currency' => !empty($obj) ? $obj->provider->currency() : ''])
    <script type="text/javascript">
        $(document).ready(() => {

            var exchange_rate = $('#exchange_rate_annalink_receipt').val();
            var total_amount_received = $('#total-amount-annalink-received').val();
            var total_amount = $('#total-amount').val();
            var diff = parseFloat(total_amount_received) - parseFloat(total_amount);
            if (exchange_rate === "1")
            {
                $('#difference-annalink-received').val(diff.toFixed(2))
            }else{
                $('#difference-annalink-received').val(0)
            }
        });
    </script>
@endpush
