@if(!isset($agent))
<table class="table table-striped table-bordered table-hover dataTables-example">
	<thead>
		<tr>
			<th class="no-sort check-all-table text-center"><input type="checkbox" id="master"></th>
			<th class="text-center">Agent Name</th>
			<th class="text-center">Agent Code</th>
			<th class="text-center">Amount</th>
			<th class="text-center">Status</th>
		</tr>
	</thead>
	<tbody>
		@foreach($agents as $obj)
		<tr>
			<td class="text-center"><input type="checkbox" class="sub_chk" data-id="{{$obj->id}}"></td>
			<td class="text-center">{{$obj->name}}</td>
			<td class="text-center">{{$obj->info->code}}</td>
			<td class="text-center">{{get_sum_comm_by_month($month, $obj->id)}}</td>
			<td class="text-center">
				@if ($obj->status == 0)
				<span class="label label-danger">Deactive</span></a>
				@else
				<span class="label label-success">Active</span></a>
				@endif
			</td>
		</tr>
		@endforeach
	</tbody>
</table>
@else
<table class="table table-striped table-bordered table-hover dataTables-example">
	<thead>
		<tr>
			<th class="no-sort check-all-table text-center"><input type="checkbox" id="master"></th>
			<th class="text-center">Invoice Code</th>
			<th class="text-center">Created At</th>
			<th class="text-center">Service</th>
			<th class="text-center">Amount</th>
		</tr>
	</thead>
	<tbody>
		@foreach($reports as $obj)
		<tr>
			<td class="text-center"><input type="checkbox" class="sub_chk" data-id="{{$obj->id}}"></td>
			<td class="text-center">{{$obj->apply != null ? $obj->apply->invoice_code : ''}}</td>
			<td class="text-center">{{$obj->created_at}}</td>
			<td class="text-center">{{$obj->apply != null && $obj->apply->service != null ? $obj->apply->service->name : ''}}</td>
			<th class="text-center">{{$obj->amount}}</th>
		</tr>
		@endforeach
	</tbody>
</table>
@endif