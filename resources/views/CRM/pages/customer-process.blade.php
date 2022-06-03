@extends('CRM.layouts.process')

@section('title')
    CUSTOMER PROCESS
    @parent
@stop

@section('css')
    @include('CRM.elements.customer-process.css')
    @include('CRM.partials.css-list')
@stop

@section('content')
    @include('CRM.partials.topbar',['linkUrlBack'=>route('customer.index')])
    @php
        $agent = $obj->agent;
        $resCus = $obj->registerCus();
        $sum_amount = $obj->phieuthus->sum('amount');
        $sum_bank_fee =  $obj->phieuthus->sum('bank_fee');
        $_total_amount = floatval($obj->total);
        $phieuthuUnit = !empty($obj->phieuthus) && !empty($obj->phieuthus->first()->current_id) ?$obj->phieuthus->first()->getCurrency():'';
        $providerUnit = $obj->provider != null ? $obj->provider->currency() :'';
        if($phieuthuUnit == $providerUnit){
            $phieuthu_old_exchange_rate = 1;
        }else{
            $phieuthu_old_exchange_rate = ($_total_amount != 0)?round(floatval((floatval($sum_amount)/floatval($_total_amount))), 2):0;
        }
        $comm = $obj->getCom();
    @endphp

    {{-- HIDDEN DATA --}}
    <input type="hidden" id="provider_comm_value" value="{{$providerCom->amount}}">
    <input type="hidden" id="provider_comm_type" value="{{$providerCom->type}}">
    <input type="hidden" id="phieuthu_sum_amount" value="{{$sum_amount}}">
    <input type="hidden" id="phieuthu_sum_bank_fee" value="{{$sum_bank_fee}}">
    <input type="hidden" id="apply_net_amount" value="{{$obj->net_amount}}">
    <div id="div_alert"></div>
    @if(session('error-customer-process-'.$obj->id))
        <div class="alert alert-danger">
            <strong>{{session('error-customer-process-'.$obj->id)}}</strong>
        </div>
    @endif
    @if(session('success-customer-process-'.$obj->id))
        <div class="alert alert-success">
            <strong>{{session('success-customer-process-'.$obj->id)}}</strong>
        </div>
    @endif
    <input type="hidden" id="_id" value="{{!empty($obj) ? $obj->id : ''}}">
    <div class="row no-gutters">
        <div class="col-xl-2 pl-xl-2">
            @include('CRM.elements.info')
        </div>
        <div class="col-xl-10 pl-xl-2">
            @include('CRM.elements.customer-process.form')
        </div>
    </div>
    <div id="div_modal_customer_info"></div>
    <div id="div_modal_agent_info"></div>
    <div id="div_modal_invoice_info"></div>
    <div id="div_modal_doc"></div>
    @include('CRM.elements.modal-delete')
@stop

@section('js')
    @include('CRM.elements.customer-process.js')
@stop
