<table class="table table-striped table-bordered table-hover dataTables-example">
	<thead>
		<tr>
			<th class="no-sort check-all-table text-center"><input type="checkbox" id="master"></th>
			<th class="text-center">Name</th>
			<th class="text-center">Phone</th>
			<th class="text-center">Email</th>
			<th class="text-center">Question</th>
			<th class="text-center">Trạng Thái</th>
			<th class="text-center">Action</th>
		</tr>
	</thead>
	<tbody>
		@foreach($data as $obj)
		<tr>
			<td class="text-center"><input type="checkbox" class="sub_chk" data-id="{{$obj->id}}"></td>
			<td class="text-center">{{$obj->name}}</td>
			<td class="text-center">{{$obj->phone}}</td>
			<td class="text-center">{{$obj->email}}</td>
			<td class="text-center">{{$obj->ques}}</td>
			<td class="text-center">
				@if ($obj->status == 0)
				<span class="label label-success">Chưa trả lời</span></a>
				@else
				<span class="label label-danger">Đã trả lời</span></a>
				@endif
			</td>
			<td class="text-center">
				<a href="{{route('question.edit', ['id'=>$obj->id])}}" class="btn btn-warning btn-circle"><i class="fa fa-edit"></i></a>
				<a 	class="btn btn-danger btn-circle btn-sm delete-button" 
					data-action ="{{ route('question.destroy',$obj->id) }}" type="button">
					<i class="fa fa-trash"></i>
				</a>
			</td>
		</tr>
		@endforeach
	</tbody>
</table>