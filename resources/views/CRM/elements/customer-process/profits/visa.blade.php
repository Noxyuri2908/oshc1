
<fieldset>
	<legend>Visa status</legend>
	<div class="form">
		<div class="form-group clearfix">
			<label class="control-label">Visa status</label>
			<div class="input-contenr">
				<select class="form-control" id="visa_status_profit">
					<option value=""></option>
					@foreach(config('myconfig.status_visa') as $key=>$value)
						<option value="{{$key}}" {{$profit != null && $profit->visa_status == $key ? 'selected' : ''}}>{{$value}}</option>
					@endforeach
				</select>
			</div>
		</div>
		<div class="form-group clearfix months-year">
			<label class="control-label">Months</label>
			<div class="input-contenr">
                <input type="number" class="form-control" id="visa_month" value="{{$profit != null ? $profit->visa_month : ''}}">
			</div>
        </div>
        <div class="form-group clearfix">
            <label class="control-label">Year</label>
            <div class="input-contenr">
                <input type="number" class="form-control" id="visa_year" value="{{$profit != null ? $profit->visa_year : ''}}">
            </div>
        </div>
	</div>
</fieldset>
