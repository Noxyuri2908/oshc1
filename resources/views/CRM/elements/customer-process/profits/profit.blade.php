<fieldset>
	<legend>Revenue</legend>
	<div class="form">
		<input type="hidden" id="profit1_currency_receipt" value="{{!empty($obj->phieuthus) && !empty($obj->phieuthus->first()->current_id) ? $obj->phieuthus->first()->getCurrency():''}}">
		<div class="form-group clearfix">
			<label class="control-label">Profit ($)</label>
			<div class="input-contenr">
				<input type="text" class="form-control text-right" id="profit_money" value="" step="0.01" readonly>
			</div>
		</div>
		<div class="form-group clearfix">
			<label class="control-label">Extra fee ($)</label>
			<div class="input-contenr">
				<input type="text" class="form-control" id="profit_extra_money" value="{{$profit != null ? $profit->profit_extra_money : 0}}">
			</div>
		</div>
		<div class="form-group clearfix">
			<label class="control-label">Revenue from service</label>
			<div class="input-contenr">
				<input type="text" class="form-control" id="profit_total" value="" readonly>
			</div>
		</div>
		<div class="form-group clearfix">
			<label class="control-label">Revenue from Ex rate (VND)</label>
			<div class="input-contenr">
				<input type="text" class="form-control" id="profit_exchange_rate" value="{{$profit != null ? $profit->profit_exchange_rate : 0}}" readonly>
			</div>
		</div>
		<div class="form-group clearfix">
			<label class="control-label">Profit VND</label>
			<div class="input-contenr">
				<input type="text" class="form-control text-right" id="profit_money_VND" value="" readonly>
			</div>
		</div>
		<div class="form-group clearfix">
			<label class="control-label">Bank fee (VND)
			</label>
			<div class="input-contenr">
				<input type="text" class="form-control text-right" id="profit_bankfee_VND" value="" readonly>
			</div>
		</div>
        <div class="form-group clearfix">
            <label class="control-label">GST
            </label>
            <div class="input-contenr">
                <input type="text" class="form-control text-right" id="gst" value="">
            </div>
        </div>
	</div>
</fieldset>
@push('scripts')
@include('CRM.partials.number_currency',['ids'=>[
    'profit_money',
    'profit_extra_money',
    'profit_exchange_rate',
    'profit_money_VND',
    'profit_total'
]])
@endpush
