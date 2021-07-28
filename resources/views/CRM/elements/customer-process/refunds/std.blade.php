<fieldset>
    <legend>Pay back student</legend>
	<div class="form">
		<div class="form-group clearfix">
			<label class="control-label">Amount ({{$obj->provider != null ? $obj->provider->currency() : ''}})</label>
			<div class="input-contenr">
				<input type="text" class="form-control" id="std_amount" value="{{$refund != null ? $refund->std_amount : ($obj->net_amount - $obj->promotion_amount - $obj->extra)}}">
            </div>

		</div>
		<div class="form-group clearfix">
			<label class="control-label">Deduction ($)</label>
			<div class="input-contenr">
				<input type="text" class="form-control" id="std_deduction" value="{{$refund != null ? $refund->std_deduction : 0}}">
			</div>
		</div>
        <div class="form-group clearfix">
            <label class="control-label">Total amount ($)</label>
            <div class="input-contenr">
                <input type="text" class="form-control" id="total_amount_pay_back_student_refund" value="" readonly>
            </div>
        </div>
		<div class="form-group clearfix">
			<label class="control-label">Exchange rate</label>
			<div class="input-contenr">
				<input type="text" class="form-control" id="std_exchange_rate" value="{{$refund != null ? $refund->std_exchange_rate : 0}}">
			</div>
		</div>
		<div class="form-group clearfix">
			<label class="control-label">Amount VND</label>
			<div class="input-contenr">
				<input type="text" class="form-control" id="std_refund_VND" value="" readonly>
			</div>
		</div>
		<div class="form-group clearfix">
			<label class="control-label">Date of payment</label>
			<div class="input-contenr">
				<input class="form-control choose-date-form" id="std_date_apyment" type="text" value="{{$refund != null ? convert_date_form_db($refund->std_date_apyment) : ''}}">
			</div>
        </div>
        <div class="form-group clearfix">
			<label class="control-label">Note</label>
			<div class="input-contenr">
				<textarea name="" class="form-control" id="std_note" cols="30" rows="10">{{$refund != null ? $refund->std_note : ''}}</textarea>
			</div>
		</div>
	</div>
</fieldset>
@push('scripts')
@include('CRM.partials.number_currency',[
    'ids'=>[
        'std_amount',
        'std_deduction',
        'std_exchange_rate',
        'std_refund_VND',
        'total_amount_pay_back_student_refund'
    ]])
@endpush
