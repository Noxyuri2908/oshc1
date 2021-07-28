<fieldset class="fom-fieldset-d">
	<legend>Status</legend>
	<div class="form">
		<div class="form-group clearfix">
			<label class="control-label">Commission payment status</label>
			<div class="input-contenr">
				<select class="form-control" id="comm_status">
                    <option value=""></option>
					<option value="1" {{$profit != null && $profit->comm_status == 1 ? 'selected' : ''}}>Done</option>
					<option value="2" {{$profit != null && $profit->comm_status == 2 ? 'selected' : ''}}>Refund</option>
				</select>
			</div>
		</div>
		<div class="form-group clearfix">
			<label class="control-label">Profit status</label>
			<div class="input-contenr">
				<select class="form-control" id="profit_status">
                    <option value=""></option>
					<option value="1" {{$profit != null && $profit->profit_status == 1 ? 'selected' : ''}}>Done</option>
					<option value="2" {{$profit != null && $profit->profit_status == 2 ? 'selected' : ''}}>Refund</option>
				</select>
			</div>
		</div>
	</div>
</fieldset>
