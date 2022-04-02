<table class="table table-striped table-bordered table-hover dataTables-example">
	<thead>
		<tr>
			<th class="no-sort check-all-table text-center"><input type="checkbox" id="master"></th>
			<th class="text-center">Service</th>
			<th class="text-center">Provider</th>
			<th class="text-center">Image</th>
			<th class="text-center">Price</th>
			<th class="text-center">Created by</th>
			<th class="text-center">Created at</th>
			<th class="text-center">Status</th>
			<th class="text-center">Action</th>
		</tr>
	</thead>
	@can('providerList.index')
        <tbody>
        @foreach($data as $obj)
            <tr>
                <td class="text-center"><input type="checkbox" class="sub_chk" data-id="{{$obj->id}}"></td>
                <td class="text-center">{{$obj->dichvu != null ? $obj->dichvu->name : ''}}</td>
                <td class="text-center">{{$obj->name}}</td>
                <td class="text-center"><img src="{{$obj->image}}" style="max-width: 200px;"></td>
                <td class="text-center">{{ $obj->price }}</td>
                <td class="text-center">{{ $obj->User != null ? $obj->User->name : '' }}</td>
                <td class="text-center">{{ $obj->created_at }}</td>
                <td class="text-center">
                    @if ($obj->status == 1)
                        <span class="label label-success">Đang sử dụng</span></a>
                    @else
                        <span class="label label-danger">Ngừng sử dụng</span></a>
                    @endif
                </td>
                <td class="text-center">
                    @can('providerList.update')
                        <a href="{{route('service.edit', ['id'=>$obj->id])}}" class="btn btn-warning btn-circle"><i class="fa fa-edit"></i></a>
                    @endcan
                    @can('providerList.destroy')
                        <a 	class="btn btn-danger btn-circle btn-sm delete-button"
                              data-action ="{{ route('service.destroy',$obj->id) }}" type="button">
                            <i class="fa fa-trash"></i>
                        </a>
                    @endcan
                </td>
            </tr>
        @endforeach
        </tbody>
    @endcan
</table>
