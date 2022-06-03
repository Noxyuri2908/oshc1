@foreach($objs as $obj)
<tr class="btn-reveal-trigger">
	<td class="align-middle">
		<input class="ml-3 sub_chk" data-id="{{$obj->id}}" type="checkbox" aria-label="Checkbox for this row" />
	</td>
	<td class="align-middle">{{$obj->id}}</td>
	<td class="align-middle">{{$obj->month}}</td>
	<td class="align-middle">{{$obj->year}}</td>
	<td class="align-middle">{{$obj->unitName()}}</td>
	<td class="align-middle">{{$obj->rate}}</td>
    <td class="align-middle">{{$obj->typeName()}}</td>
    <td class="align-middle">{{getQuarterNameNumber($obj->quarter_id)}}</td>
    <td class="align-middle">{{convert_price_float($obj->unit_to_aud)}}</td>
    <td class="align-middle">{{convert_price_float($obj->aud_to_vnd)}}</td>
	<td class="align-middle">{{$obj->staffCreate != null ? $obj->staffCreate->username : ''}}</td>
	<td class="align-middle">{{\Carbon::parse($obj->created_at)->format('d/m/Y')}}</td>
	<td class="align-middle">{{$obj->staffUpdate != null ? $obj->staffUpdate->username : ''}}</td>
	<td class="align-middle">{{\Carbon::parse($obj->updated_at)->format('d/m/Y')}}</td>
	<td class="align-middle">
		<div class="dropdown text-sans-serif">
			<button class="btn btn-link text-600 btn-sm dropdown-toggle btn-reveal mr-3" type="button" id="dropdown1" data-toggle="dropdown" data-boundary="viewport" aria-haspopup="true" aria-expanded="false"><span class="fas fa-ellipsis-h fs--1"></span></button>
			<div class="dropdown-menu dropdown-menu-right border py-0" aria-labelledby="dropdown1">
				<div class="bg-white py-2">
                    @can('exchangeRate.update')
                        <a class="dropdown-item modal_edit" data-id="{{$obj->id}}" href="#">Edit</a>
                    @endcan
					<div class="dropdown-divider"> </div>
					@can('exchangeRate.destroy')
                        <a class="dropdown-item text-danger modal_delete" data-id="{{$obj->id}}" href="#!">Delete</a>
                    @endcan
				</div>
			</div>
		</div>
	</td>
</tr>
@endforeach
