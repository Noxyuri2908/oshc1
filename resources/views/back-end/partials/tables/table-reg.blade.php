<table class="table table-striped table-bordered table-hover dataTables-example">
	<thead>
		<tr>
			<th class="no-sort check-all-table text-center"><input type="checkbox" id="master"></th>
			<th class="text-center">Service</th>
			<th class="text-center">No of Adults</th>
			<th class="text-center">No of Children</th>
			<th class="text-center">Price</th>
			<th class="text-center">Full Name</th>
			<th class="text-center">Passport Number</th>
			<th class="text-center">Trạng Thái</th>
		</tr>
	</thead>
	<tbody>
		@foreach($data as $obj)
		<tr>
			<td class="text-center"><input type="checkbox" class="sub_chk" data-id="{{$obj->id}}"></td>
			<td class="text-center">{{$obj->Service->name}}</td>
			<td class="text-center">{{$obj->n_adult}}</td>
			<td class="text-center">{{$obj->n_child}}</td>
			<td class="text-center">{{$obj->price}}</td>
			<td class="text-center">{{$obj->f_name}} {{$obj->l_name}}</td>
			<td class="text-center">{{$obj->p_num}}</td>
			<td class="text-center">
				@if ($obj->status == 0)
					<span class="label label-success">Pending</span>
				@elseif ($obj->status == 1)
					<span class="label label-success">Agree</span>
				@else
					<span class="label label-danger">Reject</span></a>
				@endif
			</td>
		</tr>
		@endforeach
	</tbody>
</table>