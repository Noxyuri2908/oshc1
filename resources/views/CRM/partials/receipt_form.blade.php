@if(!empty($getApply))
    @php
        $resCus = $getApply->registerCus();
        $sum_amount = $getApply->phieuthus->sum('amount');
        $sum_bank_fee =  $getApply->phieuthus->sum('bank_fee');
        $comm = $getApply->getCom();
        $amount = $getApply->net_amount ? $getApply->net_amount : 0;
        $promotion_amount = $getApply->promotion_amount ? $getApply->promotion_amount : 0;
        $extend_fee = count($getApply->customers) > 0 ? $getApply->customers->first()->extend_fee : 0;
        $extra = $getApply->extra ? $getApply->extra : 0;
        $totalInvoice = round(floatval(floatval($amount) - floatval($promotion_amount) + floatval($extend_fee) - floatval($extra)),2);
    @endphp
@endif
<div id="tab-receipt">
    <input type="hidden" id="provider_comm_value" value="{{(!empty($providerCom))?$providerCom->amount:0}}">
    <input type="hidden" id="provider_comm_type" value="{{(!empty($providerCom))?$providerCom->type:0}}">
    <input type="hidden" id="phieuthu_sum_amount" value="{{(!empty($sum_amount))?$sum_amount:0}}">
    <input type="hidden" id="phieuthu_sum_bank_fee" value="{{(!empty($sum_bank_fee))?$sum_bank_fee:0}}">
    <input type="hidden" id="apply_net_amount" value="{{(!empty($getApply))?$getApply->net_amount:0}}">
    <input type="hidden" id="form-set-action" name="button_action" value="{{!empty($action)?$action:''}}">
    <input type="hidden" id="id_phieuthu" value="{{(!empty($receipt))?$receipt->id:0}}">
    <input type="hidden" id="_id" value="{{(!empty($getApply))?$getApply->id:0}}">
    <input type="hidden" id="currency_aud_id" value="{{!empty($currencyAudId)?$currencyAudId:''}}">
    <div id="div_phieuthu_alert">

    </div>
    <div class="cash-ch clearfix">
        <div class="radio-checked">
{{--            @dump($receipt->type_payment)--}}
            <input type="radio" name="type_payment" value="1"
                   {{(!empty($receipt) && $receipt->type_payment == 1)?'checked':''}} required>
            <label for="cash">Cash</label>
        </div>
        <div class="radio-checked">
            <input type="radio" name="type_payment" value="2"
                   {{(!empty($receipt->type_payment) && $receipt->type_payment == 2)?'checked':''}} required>
            <label for="chuyen-khoan">Transfer</label>
        </div>
    </div>
    <div class="form-row">
        <div class="col-md-7 form-left">
            <fieldset>
                <legend>Notification</legend>
                <div class="form">
                    <div class="form-group clearfix">
                        <label class="control-label">Full Name</label>
                        <div class="input-contenr">
                            <input type="text" class="form-control"
                                   value="{{(!empty($resCus))?$resCus->first_name." ".$resCus->last_name:""}}" readonly>
                        </div>
                    </div>
                    <div class="form-group clearfix">
                        <label class="control-label">Agent</label>
                        <div class="input-contenr">
                            <input type="text" class="form-control"
                                   value="{{(!empty($getApply) && !empty($getApply->agent))?$getApply->agent->name." (".$getApply->agent->agent_code.")":''}}"
                                   readonly>
                        </div>
                    </div>
                    <div class="form-group clearfix">
                        <label class="control-label">Payer</label>
                        <div class="input-contenr">
                            <input type="text" class="form-control" id="phieuthu_payer"
                                   value="{{(!empty($receipt->payer))?$receipt->payer:''}}">
                        </div>
                    </div>
                    <div class="form-group clearfix">
                        <label class="control-label">Address</label>
                        <div class="input-contenr">
                            <input type="text" class="form-control" id="phieuthu_address"
                                   value="{{(!empty($receipt->address))?$receipt->address:''}}">
                        </div>
                    </div>
                    <div class="tai-khoan">
                        <div class="form-group clearfix">
                            <label class="control-label">Account</label>
                            <div class="input-contenr">
                                <div class="form-row">
                                    <div class="col-md-6">
                                        <select class="form-control" id="phieuthu_account_bank">
                                            <option label=""></option>
                                            @foreach(getBank() as $key => $item)
                                                <option value="{{$item->id}}" {{!empty($receipt) && $receipt->account_bank == $item->id ? 'selected':''}}>{{$item->account}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" id="bank_info" value="" readonly>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group clearfix">
                        <label class="control-label">Note</label>
                        <div class="input-contenr">
                            <textarea class="form-control" name="" id="phieuthu_note" cols="30"
                                      rows="5">{{(!empty($receipt->note))?$receipt->note:''}}</textarea>
                        </div>
                    </div>
                </div>
            </fieldset>
        </div>
        <div class="col-md-5 form-right">
            <fieldset>
                <legend>Document information</legend>
                <div class="form">
                    <div class="form-group clearfix">
                        <label class="control-label">Number</label>
                        <div class="input-contenr">
                            <input type="text" class="form-control" id="phieuthu_code"
                                   @if(!empty($receipt) && !empty($receipt->code))
                                   value="{{$receipt->code}}"
                                   @else
                                   value="PT{{(!empty($getApply))?$getApply->ref_no:""}}-{{(!empty($stt))?$stt+1:1}}"
                                @endif
                            >
                        </div>
                    </div>
                    <div class="form-group clearfix">
                        <label class="control-label">Date of receipt</label>
                        <div class="input-contenr">
                            <input type="text" class="form-control choose-date-form date-receipt" id="date_receipt" value="{{(!empty($receipt->date_receipt))?convert_date_form_db($receipt->date_receipt):date('d/m/Y')}}">
                        </div>
                    </div>
                    <div class="form-group clearfix">
                        <label class="control-label">Receiver</label>
                        <div class="input-contenr">
                            <input type="text" class="form-control" name=""
                                   value="{{auth()->guard('admin')->user()->username}}" readonly>
                        </div>
                    </div>
                    <div class="form-group clearfix">
                        <label class="control-label">Amount of money</label>
                        <div class="input-contenr">
                            <input type="text" class="form-control" id="phieuthu_amount"
                                   value="{{(!empty($receipt->amount))?$receipt->amount:0}}">
                            <input type="hidden" id="old_phieuthu_amount" value="0">

                        </div>
                    </div>
                    <div class="form-group clearfix">
                        <label class="control-label">Unit</label>
                        <div class="input-contenr">
                            <select class="form-control" id="phieuthu_current_id">
                                @foreach(config('myconfig.currency') as $key=>$value)
                                    <option
                                        value="{{$key}}" {{(!empty($receipt->current_id) && $receipt->current_id == $key)?'selected':''}}>{{$value}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group clearfix">
                        <label class="control-label">Net amount</label>
                        <div class="input-contenr d-flex">
                            <input type="text" class="form-control w-75" id="receipt_net_amount"
                                   @if(!empty($receipt))
                                   value="{{convert_price_float($receipt->receipt_net_amount)}}" step="0.01">
                            @elseif(!empty($getApply))
                                value="{{convert_price_float($getApply->net_amount)}}" step="0.01">
                            @else
                                value="0" step="0.01">
                            @endif
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1">{{!empty($getApply->provider->currency())??''}}</span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="">Total</label>
                        <input type="text" class="form-control" id="receipt_total" value="{{!empty($totalInvoice)?$totalInvoice:''}}">
                    </div>

                    <div class="form-group clearfix">
                        <label class="control-label">Bank fee</label>
                        <div class="input-contenr">
                            <input type="text" class="form-control" id="phieuthu_bank_fee"
                                   @if(!empty($receipt->bank_fee))
                                   value="{{convert_price_float($receipt->bank_fee)}}"
                                   @elseif(!empty($getApply))
                                   value="{{$getApply->bank_fee_number}}"
                            @else
                                   value="0"
                                @endif

                            >
                            <input type="hidden" id="old_phieuthu_bank_fee" value="0">
                        </div>
                    </div>
                    <div class="form-group clearfix">
                        <label class="control-label">Exchange rate</label>
                        <div class="input-contenr">
                            <input type="number" class="form-control" id="phieuthu_exchange_rate" value="{{!empty($receipt)?$receipt->exchange_rate:''}}" readonly>
                        </div>
                    </div>
                    <div class="form-group clearfix">
                        <label class="control-label">Type of receipt</label>
                        <div class="input-contenr">
                            <select class="form-control" id="phieuthu_type">
                                @foreach(config('myconfig.type_receipt') as $key=>$value)
                                    <option
                                        value="{{$key}}" {{(!empty($receipt->type) && $receipt->type == $key)?'selected':''}} >{{$value}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </fieldset>
        </div>
    </div>
</div>

@push('scripts')
    <script>
        $(document).on('mouseover', '#receipt_total', function () {
            $(this).inputmask({ alias: 'currency', prefix: '', digits: 2 })
        })
        $(document).on('mouseover', '#phieuthu_amount', function () {
            $(this).inputmask({ alias: 'currency', prefix: '', digits: 2 })
        })
        $(document).on('mouseover', '#receipt_net_amount', function () {
            $(this).inputmask({ alias: 'currency', prefix: '', digits: 2 })
        })
        $(document).on('mouseover', '#phieuthu_bank_fee', function () {
            $(this).inputmask({ alias: 'currency', prefix: '', digits: 2 })
        })
    </script>
@endpush
