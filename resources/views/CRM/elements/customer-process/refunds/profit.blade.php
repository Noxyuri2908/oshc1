<fieldset>
	<legend>Revenue ajustment</legend>
	<div class="form">
		<div class="form-group clearfix">
			<div class="form-group clearfix">
			<label class="control-label">Request date</label>
			<div class="input-contenr">
				<input class="form-control choose-date-form" id="request_date" type="text" value="{{$refund != null ? convert_date_form_db($refund->request_date) : ''}}">
			</div>
		</div>
		</div>
		<div class="form-group clearfix">
			<label class="control-label">Status refund</label>
			<div class="input-contenr">
				<select name="" id="std_status" class="form-control">
					@foreach(config('myconfig.status_refund') as $key=>$value)
					<option value="{{$key}}" {{$refund != null ? ($refund->std_status == $key ? 'selected' : '') : ''}}>{{$value}}</option>
					@endforeach
				</select>
			</div>
        </div>
        <div class="form-group clearfix">
            <div class="form-group clearfix">
                <label class="control-label">Extra fee</label>
                <div class="input-contenr">
                    <input class="form-control " id="extra_fee_refund" type="text" value="{{$refund != null ? $refund->extra_fee : ''}}">
                </div>
            </div>
        {{-- {{dd($profit)}} --}}
		<div class="form-group clearfix">
			<label class="control-label">Revenue</label>
			<div class="input-contenr">
            <input type="text" class="form-control" id="refund_profit_2"
            @if(!empty($refund))
                value="{{$refund->refund_profit_2}}"
            @elseif(!empty($profit))
                value="{{$profit->profit_money}}"
            @else
                value="0"
            @endif
             >
			</div>
		</div>
		<div class="form-group clearfix">
			<label class="control-label">Profit VND</label>
			<div class="input-contenr">
                <input type="text" class="form-control" id="refund_profit_2_VN"
                 @if(!empty($refund))
                    value="{{$refund->refund_profit_2_VN}}"
                @elseif(!empty($profit))
                    value="{{$profit->profit_money_VND}}"
                @else
                    value="0"
                @endif
            >
			</div>
		</div>
	</div>
</fieldset>
