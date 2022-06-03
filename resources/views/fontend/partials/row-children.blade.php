@php
if(isset($data)) $i = $data->id;
else if(isset($j))  $i = $j;
@endphp
<div class="row-register row-register-box">
	<div class="form-field col-md-1 col">
		<div class="form-group">
			<label>Title</label>
			<select name="{{$i}}_child_title" id="{{$i}}_child_title" class="sel-countrie form-control">
				<option value="mr" {{$data != null ? ($data->prefix_name == 'mr' ? 'selected' : '') : ''}}>Mr</option>
				<option value="miss" {{$data != null ? ($data->prefix_name == 'miss' ? 'selected' : '') : ''}}>Miss</option>
				<option value="mrs" {{$data != null ? ($data->prefix_name == 'mrs' ? 'selected' : '') : ''}}>Mrs</option>
			</select>
		</div>
	</div>
	<div class="form-field col-md-3 col">
		<div class="form-group">
			<label>First Name <span class="text-danger">*</span></label>
			<input type="text" value="{{$data != null ? $data->first_name : ''}}" class="form-control" id="{{$i}}_child_first_name" name="{{$i}}_child_first_name" placeholder="Your first name" required>
		</div>
	</div>
	<div class="form-field col-md-3 col">
		<div class="form-group">
			<label>Last Name <span class="text-danger">*</span></label>
			<input type="text" value="{{$data != null ? $data->last_name : ''}}" class="form-control" id="{{$i}}_child_last_name" name="{{$i}}_child_last_name" placeholder="Your last name" required>
		</div>
	</div>
	<div class="form-field col-md-3 col">
		<label>Date of birth <span class="text-danger">*</span></label>
		<div class="form-group col-md-3 pd4">
			<select name="{{$i}}_child_date" id="{{$i}}_child_date" class="form-control" required>
				@for ($x = 1; $x <= 31; $x++)
				<option value="{{$x}}" {{$data != null ? ($data->dateB == $x ? 'selected' : '') : ''}}>{{$x}}</option>
				@endfor
			</select>
		</div>
		<div class="form-group col-md-5 pd4">
			<select name="{{$i}}_child_month" id="{{$i}}_child_month" class="form-control" required>
				<option value="01" {{$data != null ? ($data->monthB == '01' ? 'selected' : '') : ''}}>January</option>
				<option value="02" {{$data != null ? ($data->monthB == '02' ? 'selected' : '') : ''}}>February</option>
				<option value="03" {{$data != null ? ($data->monthB == '03' ? 'selected' : '') : ''}}>March</option>
				<option value="04" {{$data != null ? ($data->monthB == '04' ? 'selected' : '') : ''}}>April</option>
				<option value="05" {{$data != null ? ($data->monthB == '05' ? 'selected' : '') : ''}}>May</option>
				<option value="06" {{$data != null ? ($data->monthB == '06' ? 'selected' : '') : ''}}>June</option>
				<option value="07" {{$data != null ? ($data->monthB == '07' ? 'selected' : '') : ''}}>July</option>
				<option value="08" {{$data != null ? ($data->monthB == '08' ? 'selected' : '') : ''}}>August</option>
				<option value="09" {{$data != null ? ($data->monthB == '09' ? 'selected' : '') : ''}}>September</option>
				<option value="10" {{$data != null ? ($data->monthB == '10' ? 'selected' : '') : ''}}>October</option>
				<option value="11" {{$data != null ? ($data->monthB == '11' ? 'selected' : '') : ''}}>November</option>
				<option value="12" {{$data != null ? ($data->monthB == '12' ? 'selected' : '') : ''}}>December</option>
			</select>
		</div>
		<div class="form-group col-md-4 pd4">
			<select name="{{$i}}_child_year" id="{{$i}}_child_year" class="form-control" required>
				<option value="">Year</option>
				@for ($x = 1945; $x <= 2019; $x++)
				<option value="{{$x}}" {{$data != null ? ($data->yearB == $x ? 'selected' : '') : ''}}>{{$x}}</option>
				@endfor
			</select>
		</div>
	</div>
	<div class="form-group col-md-2 col">
		<label>Gender <span class="text-danger">*</span></label>
		<select name="{{$i}}_child_gender" id="{{$i}}_child_gender" class="form-control" required>
            @foreach(\Config::get('myconfig.gender') as $key=>$gender)
                <option value="{{$key}}" {{$data != null ? ($data->gender == $key ? 'selected' : '') : ''}}>{{$gender}}</option>
            @endforeach
		</select>
	</div>
	<div class="form-field col-md-6 col">
		<div class="form-group">
			<label>Passport No</label>
			<input type="text" value="{{$data != null ? $data->passport : ''}}" class="form-control" id="{{$i}}_child_pass" name="{{$i}}_child_pass" placeholder="Your Passport No">
		</div>
	</div>
	<div class="form-field col-md-6 col">
		<div class="form-group">
			<label>Country</label>
			<select name="{{$i}}_child_country" id="{{$i}}_child_country"
			class="form-control">
				<option label="">Your country</option>
				@foreach(config('country.list') as $key=>$value)
				<option value="{{$key}}" {{$data != null ? ($data->country == $key ? 'selected' : '') : ''}}>{{$value}}</option>
				@endforeach
			</select>
		</div>
	</div>
</div>
