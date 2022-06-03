<table class="table table-striped table-bordered table-hover dataTables-example">
	<thead>
		<tr>
			<th class="no-sort check-all-table text-center"><input type="checkbox" id="master"></th>
			<th class="text-center">No</th>
			<th class="text-center">Registered date</th>
			<th class="text-center">Agent</th>
			<th class="text-center">Agent code</th>
			<th class="text-center">Rating</th>
			<th class="text-center">Country</th>
			<th class="text-center">Tel 1</th>
			<th class="text-center">Tel 2</th>
			<th class="text-center">Email</th>
			<th class="text-center">Website</th>
			<th class="text-center">Contact person</th>
			<th class="text-center">Person in charge</th>
			<th class="text-center">Note</th>
			<th class="text-center">Status Account</th>
			<th class="text-center">Status Agent</th>
			@if($account->role == 1)
			<th class="text-center">Staff</th>
			@endif
			<th class="text-center">Action</th>
		</tr>
	</thead>
	<tbody>
		@foreach($data as $obj)
		@php
			$tmp = $obj->info; 
		@endphp
		@if($tmp != null)
			<tr>
				<td class="text-center"><input type="checkbox" class="sub_chk" data-id="{{$obj->id}}"></td>
				<td class="text-center">{{$obj->id}}</td>
				<td class="text-center">{{$tmp->registered_date}}</td>
				<td class="text-center">{{$obj->name}}</td>
	            <td class="text-center">{{$tmp->agent_code}}</td>
				<td class="text-center">{{$tmp->rating}}</td>
				<td class="text-center">{{$tmp->country}}</td>
	            <td class="text-center">{{$tmp->tel_1}}</td>
	            <td class="text-center">{{$tmp->tel_2}}</td>
	            <td class="text-center">{{$obj->email}}</td>
	            <td class="text-center">{{$tmp->website}}</td>
	            <td class="text-center">{{$tmp->person != null ? $tmp->person->name : ''}}</td>
	            <td class="text-center">{{$tmp->person_charge != null ? $tmp->person_charge->name : ''}}</td>
	            <td class="text-center">{{$tmp->note}}</td>
	            <td class="text-center">
				@if ($obj->status == 0)
				<span class="label label-warning">Pending</span></a>
				@elseif ($obj->status == 1)
				<span class="label label-success">Active</span></a>
				@else
				<span class="label label-danger">Deactive</span></a>
				@endif
				</td>
	            <td class="text-center">
				@if ($tmp->status == 1)
				<span class="label label-success">Cooperating</span></a>
				@elseif ($tmp->status == 2)
				<span class="label label-danger">Pending</span></a>
				@elseif ($tmp->status == 3)
				<span class="label label-success">Signed</span></a>
				@elseif ($tmp->status == 4)
				<span class="label label-success">Potential</span></a>
				@endif
				</td>
				@if($account->role == 1)
				<td class="text-center">{{$obj->staff != null ? $obj->staff->username : ''}}</th>
				@endif
				<td class="text-center">
					@if($obj->status != 1)
					<a href="{{route('active.info', ['id'=>$obj->id])}}" class="btn btn-success btn-circle"><i class="fa fa-star"></i></a>
					@endif
					<a href="{{route('info.edit', ['id'=>$obj->id])}}" class="btn btn-warning btn-circle"><i class="fa fa-edit"></i></a>
					<a 	class="btn btn-danger btn-circle btn-sm delete-button" 
						data-action ="{{ route('info.destroy',$obj->id) }}" type="button">
						<i class="fa fa-trash"></i>
					</a>
				</td>
			</tr>
		@endif
		@endforeach
	</tbody>
</table>