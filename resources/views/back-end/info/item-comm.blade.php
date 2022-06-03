@foreach($obj->commission as $comm)
<div class="form-group">
	<div class="col-sm-2">
		<select name="service_{{$comm->id}}" class="form-control" required>
			@foreach($products as $product)
			<option value="{{$product->id}}" {{$comm->service_id == $product->id ? 'selected' : ''}}>{{$product->name}}</option>
			@endforeach
		</select>
	</div>
	<div class="col-sm-2">
		<select name="policy_{{$comm->id}}" class="form-control" required>
			<option value="1" {{$comm->type == 1 ? 'selected' : ''}}>Single</option>
			<option value="2" {{$comm->type == 2 ? 'selected' : ''}}>Couple</option>
			<option value="3" {{$comm->type == 3 ? 'selected' : ''}}>Family</option>
		</select>
	</div>
	<div class="col-sm-2">
		<input type="text" class="form-control" name="comm_{{$comm->id}}"
		value="{{$comm->comm}}%" required>
	</div>
	<div class="col-sm-2">
		<input type="text" class="form-control" name="date_{{$comm->id}}"
		value="{{$comm->date}}" required>
	</div>
</div>
@endforeach
@if(isset($comm_news) && isset($count))
	@for($i = 1; $i <= $count; $i++)
		@if(isset($comm_news[$i]['service_id']))
		<div class="form-group">
			<div class="col-sm-2">
				<select name="add_service_{{$i}}" class="form-control" required>
					@foreach($products as $product)
					<option value="{{$product->id}}" {{$comm_news[$i]['service_id'] == $product->id ? 'selected' : ''}}>{{$product->name}}</option>
					@endforeach
				</select>
			</div>
			<div class="col-sm-2">
				<select name="add_policy_{{$i}}" class="form-control" required>
					<option value="1" {{$comm_news[$i]['type'] == 1 ? 'selected' : ''}}>Single</option>
					<option value="2" {{$comm_news[$i]['type'] == 2 ? 'selected' : ''}}>Couple</option>
					<option value="3" {{$comm_news[$i]['type'] == 3 ? 'selected' : ''}}>Family</option>
				</select>
			</div>
			<div class="col-sm-2">
				<input type="text" class="form-control" name="add_comm_{{$i}}"
				value="{{$comm_news[$i]['comm']}}%" required>
			</div>
			<div class="col-sm-2">
				<input type="text" class="form-control" name="add_date_{{$i}}"
				value="{{$comm_news[$i]['end_date']}}" required>
			</div>
		</div>
		@endif
	@endfor
@endif
