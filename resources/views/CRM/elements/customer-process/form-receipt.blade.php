@php
$agent = $obj->agent;
$resCus = $obj->registerCus();
if($agent != null) $info = $agent->info;
@endphp

<div id="div_phieuthu_alert"></div>
@if(!isset($phieuthu))
<input type="hidden" id="id_phieuthu" value="0">
<div class="cash-ch clearfix">
	<div class="radio-checked">
		<input type="radio" id="type_payment" name="type_payment" value="1"
		checked>
		<label for="cash">Cash</label>
	</div>
	<div class="radio-checked">
		<input type="radio" id="type_payment" name="type_payment" value="2">
		<label for="chuyen-khoan">Chuyển khoản</label>
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
						<input type="text" class="form-control" value="{{$resCus->first_name." ".$resCus->last_name}}" readonly>
					</div>
				</div>
				<div class="form-group clearfix">
					<label class="control-label">Agent</label>
					<div class="input-contenr">
						<input type="text" class="form-control" value="{{$agent->name." (".$agent->info->agent_code.")"}}" readonly>
					</div>
				</div>
				<div class="form-group clearfix">
					<label class="control-label">Payer</label>
					<div class="input-contenr">
						<input type="text" class="form-control" id="phieuthu_payer" value="">
					</div>
				</div>
				<div class="form-group clearfix">
					<label class="control-label">Address</label>
					<div class="input-contenr">
						<input type="text" class="form-control" id="phieuthu_address" value="">
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
										@foreach(config('bank_account') as $key=>$value)
										<option data-name="{{$value['name']}}"
										data-brand="{{$value['brand']}}"
										data-code="{{$value['code']}}"
										data-bank="{{$value['bank']}}"
										value="{{$key}}">{{$key}}</option>
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
						<textarea class="form-control" name="" id="phieuthu_note" cols="30" rows="5"></textarea>
					</div>
				</div>
			</div>
		</fieldset>
	</div>
	<div class="col-md-5 form-right">
		<fieldset>
			<legend>Document infromation</legend>
			<div class="form">
				<div class="form-group clearfix">
					<label class="control-label">Number</label>
					<div class="input-contenr">
						<input type="text" class="form-control" id="phieuthu_code" value="PT{{$obj->ref_no}}-{{$stt}}">
					</div>
				</div>
				<div class="form-group clearfix">
					<label class="control-label">Date of receipt</label>
					<div class="input-contenr">
						<input type="text" class="form-control choose-date-form" id="date-receipt" value="{{date("d/m/Y")}}" >
					</div>
				</div>
				<div class="form-group clearfix">
					<label class="control-label">Receiver</label>
					<div class="input-contenr">
						<input type="text" class="form-control" name="" value="{{auth()->guard('admin')->user()->username}}" readonly>
					</div>
				</div>
				<div class="form-group clearfix">
					<label class="control-label">Amount of money</label>
					<div class="input-contenr">
						<input type="number" class="form-control" id="phieuthu_amount" value="0">
						<input type="hidden" id="old_phieuthu_amount" value="0">
					</div>
                </div>
                <div class="form-group clearfix">
					<label class="control-label">Unit</label>
					<div class="input-contenr">
						<select class="form-control" id="phieuthu_current_id">
							@foreach(config('myconfig.currency') as $key=>$value)
							<option value="{{$key}}">{{$value}}</option>
							@endforeach
						</select>
					</div>
				</div>
				<div class="form-group clearfix">
					<label class="control-label">Net amount</label>
					<div class="input-group">
                        <input type="text" class="form-control w-75" id="receipt_net_amount" value="{{number_format($obj->net_amount)}}">
                        <div class="input-group-append">
                            <span class="input-group-text">{{$obj->provider->currency()}}</span>
                        </div>
					</div>
				</div>

				<div class="form-group clearfix">
					<label class="control-label">Bank fee</label>
					<div class="input-contenr">
						<input type="text" class="form-control" id="phieuthu_bank_fee" value="0">
						<input type="hidden" id="old_phieuthu_bank_fee" value="0">
					</div>
				</div>
				<div class="form-group clearfix">
					<label class="control-label">Exchange rate</label>
					<div class="input-contenr">
						<input type="number" class="form-control" id="phieuthu_exchange_rate" value="">
					</div>
				</div>
				<div class="form-group clearfix">
					<label class="control-label">Type of receipt</label>
					<div class="input-contenr">
						<select class="form-control" id="phieuthu_type">
							@foreach(config('myconfig.type_receipt') as $key=>$value)
							<option value="{{$key}}">{{$value}}</option>
							@endforeach
						</select>
					</div>
				</div>
			</div>
		</fieldset>
	</div>
</div>
@else
@php
$phieuthu_sum_amount = $obj->phieuthus->sum('amount');
$phieuthu_sum_bank_fee = $obj->phieuthus->sum('bank_fee');
// $phieuthu_exchange_rate = round($phieuthu_sum_amount/($obj->net_amount + $phieuthu_sum_bank_fee), 2);
$phieuthu_exchange_rate = $phieuthu->amount/($phieuthu->receipt_net_amount + $phieuthu->bank_fee);


@endphp
<input type="hidden" id="id_phieuthu" value="{{$phieuthu->id}}">
<div class="cash-ch clearfix">
	<div class="radio-checked">
		<input type="radio" id="type_payment" name="type_payment" value="1"
		{{$phieuthu->type_payment == 1 ? 'checked' : ''}}>
		<label for="cash">Cash</label>
	</div>
	<div class="radio-checked">
		<input type="radio" id="type_payment" name="type_payment" value="2" {{$phieuthu->type_payment == 1 ? 'checked' : ''}}>
		<label for="chuyen-khoan">Chuyển khoản</label>
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
						<input type="text" class="form-control" value="{{$resCus->first_name." ".$resCus->last_name}}" readonly>
					</div>
				</div>
				<div class="form-group clearfix">
					<label class="control-label">Agent</label>
					<div class="input-contenr">
						<input type="text" class="form-control" value="{{$agent->name." (".$agent->info->agent_code.")"}}" readonly>
					</div>
				</div>
				<div class="form-group clearfix">
					<label class="control-label">Payer</label>
					<div class="input-contenr">
						<input type="text" class="form-control" id="phieuthu_payer" value="{{$phieuthu->payer}}">
					</div>
				</div>
				<div class="form-group clearfix">
					<label class="control-label">Address</label>
					<div class="input-contenr">
						<input type="text" class="form-control" id="phieuthu_address" value="{{$phieuthu->address}}">
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
										@foreach(config('bank_account') as $key=>$value)
										<option data-name="{{$value['name']}}"
										data-brand="{{$value['brand']}}"
										data-code="{{$value['code']}}"
										data-bank="{{$value['bank']}}"
										value="{{$key}}" {{$phieuthu->account_bank == $key ? 'selected' : ''}}>{{$key}}</option>
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
						<textarea name="" id="phieuthu_note" class="form-control" cols="30" rows="5">{{$phieuthu->note}}</textarea>
					</div>
				</div>
			</div>
		</fieldset>
	</div>
	<div class="col-md-5 form-right">
		<fieldset>
			<legend>Document infromation</legend>
			<div class="form">
				<div class="form-group clearfix">
					<label class="control-label">Number</label>
					<div class="input-contenr">
						<input type="text" class="form-control" id="phieuthu_code" value="{{$phieuthu->code}}">
					</div>
				</div>
				<div class="form-group clearfix">
					<label class="control-label">Date of update</label>
					<div class="input-contenr">
						<input type="text" class="form-control choose-date-form" value="{{convert_date_form_db($phieuthu->date_receipt)}}">
					</div>
				</div>
				<div class="form-group clearfix">
					<label class="control-label">User update</label>
					<div class="input-contenr">
						<input type="text" class="form-control" name="" value="{{auth()->guard('admin')->user()->username}}" readonly>
					</div>
				</div>
				<div class="form-group clearfix">
					<label class="control-label">Amount of money</label>
					<div class="input-contenr">
						<input type="text" class="form-control" id="phieuthu_amount" value="{{$phieuthu->amount}}">
						<input type="hidden" id="old_phieuthu_amount" value="{{$phieuthu->amount}}">
					</div>
                </div>
                <div class="form-group clearfix">
					<label class="control-label">Unit</label>
					<div class="input-contenr">
						<select class="form-control" id="phieuthu_current_id">
							@foreach(config('myconfig.currency') as $key=>$value)
							<option value="{{$key}}" {{$phieuthu->current_id == $key ? 'selected' : ''}}>{{$value}}</option>
							@endforeach
						</select>
					</div>
				</div>
				<div class="form-group clearfix">
					<label class="control-label">Net amount</label>
					<div class="input-group">
                        <input type="text" class="form-control w-75" id="receipt_net_amount" value="{{convert_price_float($phieuthu->receipt_net_amount)}}">
                        <div class="input-group-append"><span class="input-group-text">{{$obj->provider->currency()}}</span></div>
					</div>
				</div>

				<div class="form-group clearfix">
					<label class="control-label">Bank fee</label>
					<div class="input-contenr">
						<input type="text" class="form-control" id="phieuthu_bank_fee" value="{{$phieuthu->bank_fee}}">
						<input type="hidden" id="old_phieuthu_bank_fee" value="{{$phieuthu->bank_fee}}">
					</div>
				</div>
				<div class="form-group clearfix">
					<label class="control-label">Exchange rate</label>
					<div class="input-contenr">
						<input type="text" class="form-control" id="phieuthu_exchange_rate" value="{{$phieuthu_exchange_rate}}" readonly>
					</div>
				</div>
				<div class="form-group clearfix">
					<label class="control-label">Type of receipt</label>
					<div class="input-contenr">
						<select class="form-control" id="phieuthu_type">
							@foreach(config('myconfig.type_receipt') as $key=>$value)
							<option value="{{$key}}" {{$phieuthu->type_receipt == $key ? 'selected' : ''}}>{{$value}}</option>
							@endforeach
						</select>
					</div>
				</div>
			</div>
		</fieldset>
    </div>

</div>
@endif

