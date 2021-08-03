<fieldset>
    <legend>Received from provider</legend>
    <div class="form">
        <div class="form-group clearfix">
            <label class="control-label">Type of refund</label>
            <div class="input-contenr">
                <select name="" id="refund_type_of_refund_pp" class="form-control">
                    <option value=""></option>
                    @foreach($configTypeOfRefund as $keyTypeOfRefund=>$typeOfRefund)
                        <option value="{{$keyTypeOfRefund}}" {{!empty($refund) && $refund->refund_type_of_refund_pp == $keyTypeOfRefund ? 'selected':''}}>{{$typeOfRefund}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="form-group clearfix">
            <label class="control-label">Amount ({{$obj->provider != null ? $obj->provider->currency() : ''}})</label>
            <div class="input-contenr">
                <input type="text" class="form-control" id="refund_provider_amount" value="{{$refund != null ? $refund->refund_provider_amount : 0}}">
            </div>
        </div>
        <div class="form-group clearfix">
            <label class="control-label">Exchange rate</label>
            <div class="input-contenr">
                <input type="text" class="form-control" id="refund_provider_exchange_rate" value="{{$refund != null ? $refund->refund_provider_exchange_rate : 0}}">
            </div>
        </div>
        <div class="form-group clearfix">
            <label class="control-label">Amount (VND)</label>
            <div class="input-contenr">
                <input type="text" class="form-control" id="refund_provider_amount_VND" value="" readonly>
            </div>
        </div>

        <div class="form-group clearfix">
            <label class="control-label">Paid date</label>
            <div class="input-contenr">
                <input class="form-control choose-date-form" id="refund_provider_date" type="text" value="{{$refund != null ? convert_date_form_db($refund->refund_provider_date) : ''}}">
            </div>
        </div>
        <div class="form-group clearfix">
            <label class="control-label">Bank</label>
            <div class="input-contenr">
                <input type="text" class="form-control" id="refund_bank_pp" value="{{!empty($refund)?$refund->refund_bank_pp:''}}">
            </div>
        </div>
        <div class="form-group clearfix">
            <label class="control-label">Commission</label>
            <div class="input-contenr">
                <input type="text" class="form-control" id="commission_refund" value="{{!empty($refund)?$refund->commission:''}}">
            </div>
        </div>
        <div class="form-group clearfix">
            <label class="control-label">Situation</label>
            <div class="input-contenr">
                <textarea type="text" class="form-control" id="refund_situation_pp">{{$refund != null ? $refund->refund_situation_pp : ''}}</textarea>
            </div>
        </div>
    </div>
</fieldset>
@push('scripts')
    @include('CRM.partials.number_currency',[
        'ids'=>[
            'refund_provider_exchange_rate',
            'refund_provider_amount',
            'refund_provider_amount_VND',
            'commission_refund'
        ], 'currency' => $obj->provider->currency()])
@endpush
