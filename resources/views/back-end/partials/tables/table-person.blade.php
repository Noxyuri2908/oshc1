<table class="table table-striped table-bordered table-hover dataTables-example">
	<thead>
		<tr>
			<th class="no-sort check-all-table text-center"><input type="checkbox" id="master"></th>
			<th class="text-center">Agent</th>
			<th class="text-center">Họ tên</th>
			<th class="text-center">Vị trí, Chức vụ</th>
			<th class="text-center">Ngày sinh</th>
			<th class="text-center">Số điện thoại</th>
			<th class="text-center">Email</th>
			<th class="text-center">Skype</th>
			<th class="text-center">Trạng Thái</th>
			<th class="text-center">Action</th>
		</tr>
	</thead>
	<tbody>
		@foreach($data as $obj)
		<tr>
			<td class="text-center"><input type="checkbox" class="sub_chk" data-id="{{$obj->id}}"></td>
			@if($obj->agent != null && $obj->agent->user != null)
			<td class="text-center"><a href="{{route('info.edit',['id'=>$obj->agent->user->id])}}"> {{$obj->agent != null && $obj->agent->user != null ? $obj->agent->user->name : ''}}</a></td>
			@else
			<td class="text-center"></td>
			@endif
			<td class="text-center">{{$obj->name}}</td>
			<td class="text-center">{{$obj->position}}</td>
			<td class="text-center">{{$obj->birthday}}</td>
			<td class="text-center">{{ $obj->phone}}</td>
			<td class="text-center">{{ $obj->skype}}</td>
			<td class="text-center">{{ $obj->status}}</td>
			<td class="text-center">
				@if ($obj->status == 1)
				<span class="label label-success">Đang sử dụng</span></a>
				@else
				<span class="label label-danger">Ngừng sử dụng</span></a>
				@endif
			</td>
			<td class="text-center">
				<a href="{{route('person.edit', ['id'=>$obj->id])}}" class="btn btn-warning btn-circle"><i class="fa fa-edit"></i></a>
				<a 	class="btn btn-danger btn-circle btn-sm delete-button" 
					data-action ="{{ route('person.destroy',$obj->id) }}" type="button">
					<i class="fa fa-trash"></i>
				</a>
			</td>
		</tr>
		@endforeach
	</tbody>
</table>