@php
    $refund = $obj->refund->first();
    $profit = $obj->profit->first();
@endphp
@if($profit != null)
    @if(!empty($refund) && auth()->user()->can('refundInvoice.update'))
        <button class="btn btn-falcon-default btn-sm mr-1 mb-1" type="button" id="btn_save_refund">
            <span class="far fa-save" data-fa-transform="shrink-3"></span>Update
        </button>
        <a href="#" class="btn btn-falcon-default btn-sm mr-1 mb-1" id="btn_reset_refund" data-url="{{route('crm.ajax.deleteRefund',['id'=>$refund->id])}}">Reset</a>
    @elseif(empty($refund) && auth()->user()->can('refundInvoice.store'))
        <button class="btn btn-falcon-default btn-sm mr-1 mb-1" type="button" id="btn_save_refund">
            <span class="far fa-save" data-fa-transform="shrink-3"></span>Save
        </button>
    @endif

    <div id="alert_msg_refund"></div>
    <hr>

    @include('CRM.elements.customer-process.form-refund', ['refund'=>$refund])
@else
    <div class='alert alert-danger alert-dismissible fade show' role='alert'>Can not find profit data !</div>
@endif
