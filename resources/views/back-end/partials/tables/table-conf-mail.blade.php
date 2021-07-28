<table class="table table-striped table-bordered table-hover dataTables-example">
	<thead>
		<tr>
			<th class="no-sort check-all-table text-center"><input type="checkbox" id="master"></th>
			<th class="text-center">Type mail</th>
			<th class="text-center">Title (EN)</th>
			<th class="text-center">Title (VI)</th>
			<th class="text-center">Title (CN)</th>
			<th class="text-center">Status</th>
			<th class="text-center">Action</th>
		</tr>
	</thead>
	<tbody>
		@foreach($data as $obj)
		<tr>
			<td class="text-center"><input type="checkbox" class="sub_chk" data-id="{{$obj->id}}"></td>
			<td class="text-center"><?php
				if(isset($types[$obj->type])) echo $types[$obj->type];
				else echo '';
			 ?></td>
			<td class="text-center">{{$obj->name}}</td>
			<td class="text-center">{{$obj->name_vi}}</td>
			<td class="text-center">{{$obj->name_cn}}</td>
			<td class="text-center">
				@if ($obj->status == 1)
				<span class="label label-success">Active</span></a>
				@else
				<span class="label label-danger">Deactive</span></a>
				@endif
			</td>
			<td class="text-center">
				<a href="{{route('conf-mail.edit', ['id'=>$obj->id])}}" class="btn btn-warning btn-circle"><i class="fa fa-edit"></i></a>
				<a 	class="btn btn-danger btn-circle btn-sm delete-button"
					data-action ="{{ route('conf-mail.destroy',$obj->id) }}" type="button">
					<i class="fa fa-trash"></i>
				</a>
			</td>
		</tr>
		@endforeach
	</tbody>
</table>