	<span class="how-chose">
		{!! get_content($payment_finish) !!}
	</span>
	<div id="payment-check">
		<h3>Register Finish</h3>
		<div class="list-step-payment">
			<table class="table table-bordered">
							<tr>
								<td class="tg-cly1">Premium:</td>
								<td class="tg-cly2 grey">{{convert_price_float($apply->net_amount)}} AUD</td>
							</tr>
							@if(isset($price_comm) && $price_comm != 0)
							<tr>
								<td class="tg-cly1">Commission (include GST):</td>
								<td class="tg-cly2 grey">{{convert_price_float($price_comm)}} AUD</td>
							</tr>
							@endif
							@if(isset($price_gst) && $price_gst != 0)
							<tr>
								<td class="tg-cly1">GST:</td>
								<td class="tg-cly2 grey">{{convert_price_float($price_gst)}} AUD</td>
							</tr>
							@endif
							<tr>
								<td class="tg-cly1">Surcharge (3%):</td>
								<td class="tg-cly2 grey">{{convert_price_float($price_su)}} AUD</td>
							</tr>
							<tr>
								<td class="tg-cly1">Total to pay:</td>
								<td class="tg-cly2 grey">{{convert_price_float($total)}} AUD</td>
							</tr>
						</table>
					</div>
        @foreach($list_file as $nameFile)
        <a class="btn btn-default btn-outline-dark" target="_blank" href="{{\Config::get('admin.base_url')}}storage/app/public/pdf/{{$nameFile}}">{{get_name_file_payment($nameFile)}}</a>
        @endforeach
{{--					<button onclick="window.location.href='{{route('download',['id'=>$apply->id, 'type'=>1])}}'" class="buy">Download Invoice</button>--}}
		</div>
	</div>
	<div class="list-control-btn">
		<button onclick="window.location.href='{{route('home')}}'" class="submit-step">Go to home</button>
	</div>
