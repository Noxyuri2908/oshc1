<table class="table table-striped table-bordered table-hover dataTables-example">
	<thead>
		<tr>
			<th class="no-sort check-all-table text-center"><input type="checkbox" id="master"></th>
			<th class="text-center">Post</th>
			<th class="text-center">Name</th>
			<th class="text-center">Email</th>
			<th class="text-center">Content</th>
			<th class="text-center">Status</th>
			<th class="text-center">Action</th>
		</tr>
	</thead>
	<tbody>
		@foreach($data as $obj)
		<tr>
			<td class="text-center"><input type="checkbox" class="sub_chk" data-id="{{$obj->id}}"></td>
			<td class="text-center">{{$obj->Post != null ? $obj->Post->name : ''}}</td>
			<td class="text-center">{{$obj->name}}</td>
			<td class="text-center">{{$obj->email}}</td>
			<td class="text-center">{{$obj->content}}</td>
			<td class="text-center">
				@if ($obj->status == 1)
				<span class="label label-success">Public</span></a>
				@else
				<span class="label label-danger">Private</span></a>
				@endif
			</td>
			<td class="text-center">
				<a href="{{route('comment.edit', ['id'=>$obj->id])}}" class="btn btn-warning btn-circle"><i class="fa fa-edit"></i></a>
				<a 	class="btn btn-danger btn-circle btn-sm delete-button" 
					data-action ="{{route('comment.destroy',$obj->id) }}" type="button">
					<i class="fa fa-trash"></i>
				</a>
			</td>
		</tr>
		@endforeach
	</tbody>
</table>