<table class="table table-striped table-bordered table-hover dataTables-example">
	<thead>
		<tr>
			<th class="no-sort check-all-table text-center"><input type="checkbox" id="master"></th>
			<th class="text-center">Code</th>
			<th class="text-center">Status</th>
			<th class="text-center">Service</th>
			<th class="text-center">Start date</th>
			<th class="text-center">End date</th>
			<th class="text-center">Person Register</th>
			<th class="text-center">Agent</th>
			<th class="text-center">Method Payment</th>
			<th class="text-center">Commission</th>
			<th class="text-center">Surcharge</th>
			<th class="text-center">GST</th>
			<th class="text-center">Total</th>
			<th class="text-center">Action</th>
		</tr>
	</thead>
	<tbody>
		@foreach($data as $obj)
		<tr>
			<td class="text-center"><input type="checkbox" class="sub_chk" data-id="{{$obj->id}}"></td>
			<td class="text-center">{{$obj->invoice_code}}</td>
			<td class="text-center">
				@if ($obj->status == 2)
					<span class="label label-success">Running</span></a>
				@elseif ($obj->status == 1)
					<span class="label label-warning">Pending</span></a>
				@elseif ($obj->status == 3)
					<span class="label label-danger">Reject</span></a>
				@elseif ($obj->status == 0)
					<span class="label label-danger">Incomplete</span></a>
				@endif
			</td>
			<td class="text-center">{{$obj->Service != null ? $obj->Service->name : ''}}</td>
			<td class="text-center">{{$obj->start_date}}</td>
			<td class="text-center">{{$obj->end_date}}</td>
			<td class="text-center">
				@php
					$customer = $obj->customers()->where('type',0)->first();
					if($customer != null) echo $customer->first_name.' '.$customer->last_name;
					else echo '';
				@endphp
			</td>
			<td class="text-center">{{$obj->User != null ? $obj->User->name : ''}}</td>
			<td class="text-center">
				@if ($obj->menthod_payment == 1)
					<span class="label label-success">Telegraphic (Wire) Transfer</span></a>
				@elseif ($obj->menthod_payment == 2)
					<span class="label label-warning">Pay by Paypal</span></a>
				@elseif ($obj->menthod_payment == 3)
					<span class="label label-danger">Pay by Credit Card</span></a>
				@endif
			</td>
			<td class="text-center">{{$obj->price_comm}}</td>
			<td class="text-center">{{$obj->price_su}}</td>
			<td class="text-center">{{$obj->price_gst}}</td>
			<td class="text-center">{{$obj->total}}</td>
			<td class="text-center">
				<a href="{{route('apply.edit', ['id'=>$obj->id])}}" class="btn btn-warning btn-circle"><i class="fa fa-edit"></i></a>
				@if($obj->status == 1)
				<a href="javascripts:void(0)" class="btn btn-success btn-circle action-status-apply" data-action="{{route('apply.action.update.status',['id'=>$obj->id])}}" data-value="2"><i class="fa fa-check"></i></a>
				<a href="javascripts:void(0)" class="btn btn-danger btn-circle action-status-apply" data-action="{{route('apply.action.update.status',['id'=>$obj->id])}}" data-value="3"><i class="fa fa-x">X</i></a>
				@endif
				@if($obj->status != 2)
				<a 	class="btn btn-danger btn-circle btn-sm delete-button" 
					data-action ="{{ route('apply.destroy',$obj->id) }}" type="button">
					<i class="fa fa-trash"></i>
				</a>
				@endif
			</td>
		</tr>
		@endforeach
	</tbody>
</table>