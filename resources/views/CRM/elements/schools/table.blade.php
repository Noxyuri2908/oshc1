@foreach($objs as $obj)
<tr class="btn-reveal-trigger">
	<td class="align-middle">
		<input class="ml-3 sub_chk" data-id="{{$obj->id}}" type="checkbox" aria-label="Checkbox for this row" />
	</td>
	<td class="align-middle">{{$obj->id}}</td>
	<td class="align-middle">{{$obj->name}}</td>
	<td class="align-middle">{{$obj->countryName()}}</td>
	<td class="align-middle">{{$obj->staffCreate != null ? $obj->staffCreate->username : ''}}</td>
	<td class="align-middle">{{$obj->created_at}}</td>
	<td class="align-middle">{{$obj->staffUpdate != null ? $obj->staffUpdate->username : ''}}</td>
	<td class="align-middle">{{$obj->updated_at}}</td>
	<td class="align-middle">
		<div class="dropdown text-sans-serif">
			<button class="btn btn-link text-600 btn-sm dropdown-toggle btn-reveal mr-3" type="button" id="dropdown1" data-toggle="dropdown" data-boundary="viewport" aria-haspopup="true" aria-expanded="false"><span class="fas fa-ellipsis-h fs--1"></span></button>
			<div class="dropdown-menu dropdown-menu-right border py-0" aria-labelledby="dropdown1">
				<div class="bg-white py-2">
					<a class="dropdown-item modal_edit" data-id="{{$obj->id}}" href="#">Edit</a>
					<div class="dropdown-divider"> </div>
					<a class="dropdown-item text-danger modal_delete" data-id="{{$obj->id}}" href="#!">Delete</a>
				</div>
			</div>
		</div>
	</td>
</tr>
@endforeach