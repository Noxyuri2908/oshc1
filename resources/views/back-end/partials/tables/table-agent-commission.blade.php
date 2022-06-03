<table class="table table-striped table-bordered table-hover dataTables-example">
	<thead>
		<tr>
			<th class="no-sort check-all-table text-center"><input type="checkbox" id="master"></th>
			<th class="text-center">Dịch vụ</th>
			<th class="text-center">Loại dịch vụ</th>
			<th class="text-center">Hoa hồng</th>
			<th class="text-center">Ngày hết hạn</th>
			<th class="text-center">Trạng Thái</th>
		</tr>
	</thead>
	<tbody>
		@foreach($data as $obj)
		<tr>
			<td class="text-center"><input type="checkbox" class="sub_chk" data-id="{{$obj->id}}"></td>
			<td class="text-center">{{$obj->Service->name}}</td>
			<td class="text-center">
				@if ($obj->status == 1)
				<span class="label label-success">Single</span></a>
				@elseif ($obj->status == 2)
				<span class="label label-danger">Couple</span></a>
				@elseif ($obj->status == 3)
				<span class="label label-danger">Family</span></a>
				@endif
			</td>
			<td class="text-center">{{ $obj->comm }}%</td>
			<td class="text-center">{{ $obj->date }}</td>
			<td class="text-center">
				@if ($obj->status == 1)
				<span class="label label-success">Đang sử dụng</span></a>
				@else
				<span class="label label-danger">Ngừng sử dụng</span></a>
				@endif
			</td>
		</tr>
		@endforeach
	</tbody>
</table>