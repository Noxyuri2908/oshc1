<div id="div_refund_alert"></div>
<input type="hidden" id="id_refund" value="{{$refund != null ? $refund->id : 0}}">
<div class="form-row">
	<div class="col-md-6 form-left">
		@include('CRM.elements.customer-process.refunds.provider_paid') {{--Received from provider--}}
		@include('CRM.elements.customer-process.refunds.profit')
	</div>
	<div class="col-md-6 form-right">
		@include('CRM.elements.customer-process.refunds.std')
		<fieldset>
            {{-- {{dd($profit)}} --}}
			<legend>Recall commission from agent</legend>
			<div class="form">
                <div class="form-group clearfix">
                    <label class="control-label">% com</label>
                    <div class="input-contenr">
                        <input type="text" class="form-control" id="refund_percent_com_agent" value="{{$comm->comm}}%" data-value="{{$comm->comm}}" readonly>
                    </div>
                </div>
				<div class="form-group clearfix">
					<label class="control-label">Amount com</label>
					<div class="input-contenr">
                        <input type="text" class="form-control" id="refund_amount_com_agent_gbcfa" value="{{!empty($refund)?$refund->refund_amount_com_agent_gbcfa:0}}">
					</div>
				</div>
				<div class="form-group clearfix">
					<label class="control-label">Exchange rate</label>
					<div class="input-contenr">
                        <input type="text" class="form-control" id="refund_exchange_rate_agent"
                        @if(!empty($refund))
                            value="{{$refund->refund_exchange_rate_agent}}"
                        @elseif(!empty($profit))
                            value="{{$profit->pay_agent_exchange_rate}}"
                        @else
                            value=""
                        @endif>
					</div>
				</div>
				<div class="form-group clearfix">
					<label class="control-label">Amount VND</label>
					<div class="input-contenr">
                        <input type="text" class="form-control" id="refund_agent_vnd"
                        @if(!empty($refund))
                            value="{{$refund->refund_agent_vnd}}"
                        @elseif(!empty($profit))
                            value="{{$profit->pay_agent_amount_VN}}"
                        @else
                            value=""
                        @endif
                        >
					</div>
				</div>
                <div class="form-group clearfix">
                    <label class="control-label">Status</label>
                    <div class="input-contenr">
                        <select name="" id="status" class="form-control">
                            @foreach(config('myconfig.status_refund_recall') as $key=>$value)
                                <option value="{{$key}}" {{$refund != null ? ($refund->status == $key ? 'selected' : '') : ''}}>{{$value}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
				<div class="form-group clearfix">
					<label class="control-label">Note</label>
					<div class="input-contenr">
						<textarea name="" id="note2" cols="30" class="form-control" rows="10">{{$refund != null ? $refund->note2 : ''}}</textarea>
					</div>
				</div>

			</div>
		</fieldset>
	</div>
</div>
@push('scripts')
@include('CRM.partials.number_currency',[
    'ids'=>[
        'refund_amount_com_agent',
        'refund_exchange_rate_agent',
        'refund_profit_2',
        'refund_profit_2_VN',
        'refund_agent_vnd',
        'refund_amount_com_agent_gbcfa',
        'extra_fee_refund'
        ], 'currency' => $obj->provider->currency()])
@endpush
