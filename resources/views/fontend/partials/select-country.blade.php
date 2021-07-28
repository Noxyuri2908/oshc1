<div class="form-row">
	<div class="form-field form-field w20 pd0">
		<div class="form-group">
			<select name="main_country" id="main_country" class="sel-countrie form-control" required>
				<option value="">Your country</option>
				@foreach(config('country.list') as $key=>$value)
				<option value="{{$key}}" {{$data != null ? ($data->country == $key ? 'selected' : '') : ''}}>{{$value}}</option>
				@endforeach
			</select>
		</div>
	</div>
</div>
