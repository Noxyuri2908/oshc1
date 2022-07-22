<table class="table table-md mb-0 table-dashboard fs--1 tab-data-table">
	<thead class="bg-200 text-900">
		<tr>
			<th class="status">Agent</th>
			<th class="status">Agent country</th>
			<th class="status">Master agent</th>
			<th class="status">Service country</th>
			<th class="status">Type of service</th>
			<th class="status">Type of invoice</th>
			<th class="status">Provider</th>
			<th class="status">Policy</th>
			<th class="status">No of adults</th>
			<th class="status">No of children</th>
			<th class="status">Type of visa</th>
			<th class="status">Start date</th>
			<th class="status">End date</th>
			<th class="status">Ref No</th>
			<th class="status">Status</th>
			<th class="status">Register</th>
			<th class="status">Adults</th>
			<th class="status">Children</th>
          {{-- <th class="status">Email</th>
          <th class="status">Education instituation</th>
          <th class="status">Student ID</th>
          <th class="status">Mobile No</th>
          <th class="status">Facebook</th> --}}
          <th class="status">Net amount ($)</th>
          <th class="status">Promotion code</th>
          <th class="status">Promotion ($)</th>
          <th class="status">Bank fee (%)</th>
          <th class="status">Bank fee ($)</th>
          <th class="status">Payment method</th>
          <th class="status">Surcharge ($)</th>
          <th class="status">-/+ ($)</th>
          <th class="status">Commission ($)</th>
          <th class="status">Total ($)</th>
          <th class="status">Staff</th>
          <th class="status">Note</th>
          <th class="status">Creation date</th>
      </tr>
  </thead>
  <tbody>
  	<tr>
  		<td class="align-middle"><a style="cursor: pointer; color: red" class="agent_info" data-id={{$obj->agent != null ? $obj->agent->id : ''}}>{{$obj->agent != null ? $obj->agent->name : ''}}</a></td>
  		<td class="align-middle">{{$obj->agent != null ? $obj->agent->country() : ''}}</td>
  		<td class="align-middle"><a style="cursor: pointer; color: red" class="agent_info" data-id={{$obj->master != null ? $obj->master->id : ''}}>{{$obj->master != null ? $obj->master->name : ''}}</a></td>
  		<td class="align-middle">{{isset(config('myconfig.service_country')[$obj->service_country]) ? config('myconfig.service_country')[$obj->service_country] : ''}}</td>
  		<td class="align-middle">{{$obj->service != null ? $obj->service->name : ''}}</td>
  		<td class="align-middle">{{isset(config('myconfig.type_invoice')[$obj->type_invoice]) ? config('myconfig.type_invoice')[$obj->type_invoice] : ''}}</td>
  		<td class="align-middle">{{$obj->provider != null ? $obj->provider->name : ''}}</td>
  		<td class="align-middle">{{isset(config('myconfig.policy')[$obj->policy]) ? config('myconfig.policy')[$obj->policy] : ''}}</td>
  		<td class="align-middle">{{$obj->no_of_adults}}</td>
  		<td class="align-middle">{{$obj->no_of_children}}</td>
  		<td class="align-middle">{{isset(config('myconfig.type_visa')[$obj->type_visa]) ? config('myconfig.type_visa')[$obj->type_visa] : ''}}</td>
  		<td class="align-middle">{{$obj->start_date}}</td>
  		<td class="align-middle">{{$obj->end_date}}</td>
  		<td class="align-middle">{{$obj->ref_no}}</td>
  		<td class="align-middle" id="td_invoice_status">{{isset(config('myconfig.status_invoice')[$obj->status]) ? config('myconfig.status_invoice')[$obj->status] : ''}}</td>
  		<td class="align-middle"><a style="cursor: pointer; color: red" class="customer_info" data-id={{$obj->registerCus() != null ? $obj->registerCus()->id : ""}}>{{$obj->registerCus() != null ? $obj->registerCus()->first_name.' '.$obj->registerCus()->last_name : ''}}</a></td>
  		<td class="align-middle">@foreach($obj->partners() as $partner)
  			<a style="cursor: pointer; color: red" class="customer_info" data-id={{$partner->id}}>{{$partner->first_name.' '.$partner->last_name}}</a><br>
  		@endforeach</td>
  		<td class="align-middle">@foreach($obj->childrens() as $partner)
  			<a style="cursor: pointer; color: red" class="customer_info" data-id={{$partner->id}}>{{$partner->first_name.' '.$partner->last_name}}</a><br>
  		@endforeach</td>
  {{-- <td class="align-middle">{{$obj->registerCus() != null ? $obj->registerCus()->email : ''}}</td>
  <td class="align-middle">{{$obj->registerCus() != null ? $obj->registerCus()->place_study : ''}}</td>
  <td class="align-middle">{{$obj->registerCus() != null ? $obj->registerCus()->student_id : ''}}</td>
  <td class="align-middle">{{$obj->registerCus() != null ? $obj->registerCus()->phone : ''}}</td>
  <td class="align-middle">{{$obj->registerCus() != null ? $obj->registerCus()->fb : ''}}</td> --}}
  <td class="align-middle">{{number_format($obj->net_amount)}}</td>
  <td class="align-middle">{{$obj->promotion != null ? $obj->promotion->code : ''}}</td>
  <td class="align-middle">{{number_format($obj->promotion_amount)}}</td>

  <td class="align-middle">{{isset(config('myconfig.bank_fee')[$obj->bank_fee]) ? config('myconfig.bank_fee')[$obj->bank_fee] : ''}}</td>
  <td class="align-middle">{{isset(config('myconfig.bank_fee')[$obj->bank_fee]) ? number_format($obj->net_amount*$obj->bank_fee)  : ''}}</td>
  <td class="align-middle">{{isset(config('myconfig.payment_metdod')[$obj->payment_metdod]) ? config('myconfig.payment_metdod')[$obj->payment_metdod] : ''}}</td>
  <td class="align-middle">{{number_format($obj->surcharge)}}</td>
  <td class="align-middle">{{$obj->type_extra == 0 ? '(-)'.number_format($obj->extra) : '(+)'.number_format($obj->extra)}}</td>
  <td class="align-middle">{{number_format($obj->comm)}}</td>
  <td class="align-middle">{{number_format($obj->total)}}</td>
  <td class="align-middle">{{$obj->staff != null ? $obj->staff->username : ''}}</td>
  <td class="align-middle">{{$obj->note}}</td>
  <td class="align-middle">{{$obj->created_at}}</td>
</tr>
</tbody>
</table>
