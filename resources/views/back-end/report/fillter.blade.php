<div class="row">
	<div class="col-sm-2">
		<div class="form-group">
			<label class="control-label">
				Month
			</label>
			<select name="f_month" id="f_month" class="form-control">
				@for($i=1; $i<=12; $i++)
				<option value="{{$i}}" {{$month == $i ? 'selected' : ''}}> {{$i}}</option>
				@endfor
			</select>
		</div>
	</div>
	<div class="col-sm-2">
		<div class="form-group">
			<label class="control-label" for="agent">Agent</label>
			<select name="f_agent" id="f_agent" class="form-control">
				<option value="0">All</option>
				@foreach($agents as $obj)
				<option value="{{$obj->id}}" {{isset($agent) ? ($agent->id == $obj->id ? 'selected' : '') : ''}}>{{$obj->name}}</option>
				@endforeach
			</select>
		</div>
	</div>
</div>
