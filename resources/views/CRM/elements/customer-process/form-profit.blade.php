<div id="div_profit_alert"></div>
@if(!isset($profit))
<div class="form-row">
	<input type="hidden" id="_payment_note" value="{{$payment_note}}">
	<input type="hidden" id="id_profit" value="0">
	<div class="col-md-4 form-left">
		@include('CRM.elements.customer-process.profits.annalink')
        @include('CRM.elements.customer-process.profits.re_provider') {{--Commission from Provider--}}
	</div>
	<div class="col-md-4 form-left">
        @include('CRM.elements.customer-process.profits.pay_provider')
		@include('CRM.elements.customer-process.profits.profit') {{--Revenue--}}
	</div>
	<div class="col-md-4 form-left">
        @include('CRM.elements.customer-process.profits.pay_agent') {{--Commission for Agent/ Counsellor--}}
		@include('CRM.elements.customer-process.profits.visa')
		@include('CRM.elements.customer-process.profits.status')
	</div>
</div>
@else
<div class="form-row">
	<input type="hidden" id="_payment_note" value="{{$payment_note}}">
	<input type="hidden" id="id_profit" value="{{$profit->id}}">
    <div class="col-md-4 form-left">
        @include('CRM.elements.customer-process.profits.annalink')
        @include('CRM.elements.customer-process.profits.re_provider')
    </div>
    <div class="col-md-4 form-left">
        @include('CRM.elements.customer-process.profits.pay_provider')
        @include('CRM.elements.customer-process.profits.profit')
    </div>
    <div class="col-md-4 form-left">
        @include('CRM.elements.customer-process.profits.pay_agent')
        @include('CRM.elements.customer-process.profits.visa')
        @include('CRM.elements.customer-process.profits.status')
    </div>
</div>
@endif
