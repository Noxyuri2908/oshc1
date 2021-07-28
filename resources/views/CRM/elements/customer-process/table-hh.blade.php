<table class="table table-md mb-0 table-dashboard fs--1 tab-data-commission">
	<thead class="bg-200 text-900">
		<tr>
			<th class="status">STT</th>
			<th class="status">Created date</th>
			<th class="status">Updated date</th>
			<th class="status">Visa status</th>
			<th class="status">Month</th>
			<th class="status">Year</th>
			<th class="status">Date of payment provider</th>
			<th class="status">Bank account</th>
			<th class="status">Date of payment agent</th>
			<th class="status">Policy number</th>
			<th class="status">Issue Date</th>
			<th class="status">Policy status</th>
			<th class="status">Payment note</th>
			<th class="status">+/- $</th>
			<th class="status"></th>
			<th class="status">+/- time</th>
			<th class="status">Note</th>
			<th class="status">Created by</th>
			<th class="status">Updated by</th>
		</tr>
	</thead>
	<tbody>
		@if(isset($hoahongs))
		@php
		$stt = 1;
		@endphp
		@foreach($hoahongs as $tmp)
		@php
			$invoice = $tmp->invoice;
			if($invoice != null){
				$agent = $invoice->agent;
				$resCus = $invoice->registerCus();
			}
		@endphp
		@if($invoice != null && isset($agent) &&  isset($agent->info) && $resCus != null)
		<tr  class="edit_hh" data-id="{{$tmp->id}}">
			<td>{{$stt}}</td>
			<td>{{$tmp->created_at}}</td>
			<td>{{$tmp->updated_at}}</td>
			<td>{{isset(config('myconfig.status_visa')[$tmp->visa_status]) ? config('myconfig.status_visa')[$tmp->visa_status] : ''}}</td>
			<td>{{$tmp->hoahong_month}}</td>
			<td>{{$tmp->hoahong_year}}</td>
			<td>{{$tmp->date_payment_provider}}</td>
			<td>{{$tmp->account_bank}}</td>

			<td>{{$tmp->date_payment_agent}}</td>
			<td>{{$tmp->policy_no}}</td>
			<td>{{$tmp->issue_date}}</td>
			<td>{{isset(config('myconfig.policy_status')[$tmp->policy_status]) ? config('myconfig.policy_status')[$tmp->policy_status] : ''}}</td>
			<td>{{isset(config('myconfig.payment_note_provider')[$tmp->payment_note_provider]) ? config('myconfig.payment_note_provider')[$tmp->payment_note_provider] : ''}}</td>
			<td>{{$tmp->extra_money}}</td>
			<td>{{isset(config('myconfig.currency')[$tmp->unit_money]) ? config('myconfig.currency')[$tmp->unit_money] : ''}}</td>
			<td>{{$tmp->extra_time}}</td>
			<td>{{$tmp->note}}</td>
			<td>{{$tmp->creater != null ? $tmp->creater->username : ''}}</td>
			<td>{{$tmp->updater != null ? $tmp->updater->username : ''}}</td>
		</tr>
		@php
		$stt++;
		@endphp
		@endif
		@endforeach
		@else
		<tr>
			<td colspan="16">No data !</td>
		</tr>
		@endif
	</tbody>
</table>