
<div class="title-bank">
	<h3 class="mg1">@lang('header.contact_detail')</h3>
</div>
<div class="form-list form-field">
	<div class="form-group">
		<input type="text"
		class="form-control"
		id="main_phone"
		name="main_phone"
		value="{{$data != null ? $data->phone : old('main_phone')}}"
		placeholder="(+61) 2 8283 0273" required>
	</div>
	<div class="form-group ">
		<input type="email"
		class="form-control"
		id="main_email"
		name="main_email"
		value="{{$data != null ? $data->email : old('main_email')}}"
		placeholder="Email" required>
	</div>
	<div class="form-group">
		<input type="email"
		class="form-control"
		id="main_email_confirm"
		name="main_email_confirm"
		value="{{$data != null ? $data->email : old('main_email_confirm')}}"
		placeholder="Email confirmation" required>
	</div>
	<div class="form-group">
		<label>{!! get_content($apply_section_3) !!}*</label>
		<select name="main_is_locate" id="main_is_locate" class="form-control" required>
			<option value="1"
			{{$data != null ? ($data->is_locate == '1' ? 'selected' : '') : (old('main_is_locate') == 1 ? 'selected' : '')}}>
			@lang('header.yes')
		</option>
		<option value="0"
		{{$data != null ? ($data->is_locate == '0' ? 'selected' : '') : (old('main_is_locate') == 1 ? 'selected' : '')}}>
		@lang('header.no')
	</option>
</select>
</div>
</div>
{{-- <div class="title-bank">
	<h3 class="mg3">@lang('header.agent_infomation')</h3>
</div>
@if($data == null)
	@if(auth()->check())
	@php
	$agent = auth()->user();
	if($agent->role != 'agent') $agent = null;
	@endphp
	<div class="form-list form-field">
		<div class="form-group">
			<input type="text"
			class="form-control"
			id="main_edu_agent"
			name="main_edu_agent"
			value="{{$agent != null ? $agent->name : old('main_edu_agent')}}"
			placeholder="Education User">
		</div>
		<div class="form-group">
			<input type="text"
			class="form-control"
			id="main_edu_code"
			name="main_edu_code"
			value="{{$agent != null && $agent->info != null ? $agent->info->agent_code : old('main_edu_code')}}"
			placeholder="User Code">
		</div>
	</div>
	@else
	<div class="form-list form-field">
		<div class="form-group">
			<input type="text"
			class="form-control"
			id="main_edu_agent"
			name="main_edu_agent"
			value="{{old('main_edu_agent')}}"
			placeholder="Education User">
		</div>
		<div class="form-group">
			<input type="text"
			class="form-control"
			id="main_edu_code"
			name="main_edu_code"
			value="{{old('main_edu_code')}}"
			placeholder="User Code">
		</div>
	</div>
	@endif
@else
<div class="form-list form-field">
	<div class="form-group">
		<input type="text"
		class="form-control"
		id="main_edu_agent"
		name="main_edu_agent"
		value="{{$data->education_agent}}"
		placeholder="Education User">
	</div>
	<div class="form-group">
		<input type="text"
		class="form-control"
		id="main_edu_code"
		name="main_edu_code"
		value="{{$data->agent_code}}"
		placeholder="User Code">
	</div>
</div>
@endif --}}
