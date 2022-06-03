@extends('fontend.layouts.master')
@section('title')
@lang('register.title')
@endsection
@section('content')
<section id="register-page">
	<div class="container">
		<div class="header-page">
			<div class="title-section">
				{{get_name($reg_section_1)}}
			</div>
			<div class="des-section">
				{{get_content($reg_section_1)}}
			</div>
			<div class="buge">...</div>
		</div>
	</div>
	<div class="body-content">
		<div class="container">
			<div class="row">
				<div class="col-md-6 col-md-offset-3 text-center">
					<h3>{{get_name($reg_section_2)}}</h3>
					<div class="desc-content">
						{{get_content($reg_section_2)}}
					</div>
				</div>
			</div> <!-- end col-md-6 -->

			<div class="row">
				<div class="col-md-6 col-md-offset-3">
					@if(session('error-reg-web'))
					<div class="alert alert-danger">
						<strong>{{session('error-reg-web')}}</strong>
					</div>
					@endif
					@if(session('success-reg-web'))
					<div class="alert alert-success">
						<strong>{{session('success-reg-web')}}</strong>
					</div>
					@endif
					<form action="{{route('become-a-agent')}}" method="Post">
						@csrf
						<div class="form-group">
							<input type="text" name="name" value="{{old('name')}}"" class="form-control"  placeholder="@lang('register.form.Name of Company/User')" required>
						</div>
						<div class="form-group">
							<input type="text" name="contact_person" value="{{old('contact_person')}}" class="form-control"  placeholder="@lang('register.form.Contact Person')" required>
						</div>
						<div class="form-group">
							<input type="text" name="title" value="{{old('title')}}" class="form-control"  placeholder="@lang('register.form.Position/Title')" required>
						</div>
						<div class="form-group">
							<input type="text" name="address_1" value="{{old('address_1')}}" class="form-control"  placeholder="@lang('register.form.Physical address')" required>
						</div>
						<div class="form-group">
							<input type="text" name="address_2" value="{{old('address_2')}}" class="form-control"  placeholder="@lang('register.form.Postal address')" required>
						</div>
						<div class="form-group">
							<input type="text" name="tel_1" value="{{old('tel_1')}}" class="form-control"  placeholder="@lang('register.form.Phone No')" required>
						</div>
						<div class="form-group">
							<input type="text" name="tel_2" value="{{old('tel_2')}}" class="form-control"  placeholder="@lang('register.form.Mobile Phone Number')" required>
						</div>
						<div class="form-group">
							<input type="email" name="email" value="{{old('email')}}" class="form-control"  placeholder="@lang('register.form.Email')" required>
						</div>
						<div class="form-group">
							<button class="btn btn-default dropdown-toggle" type="button" id="menu1" data-toggle="dropdown">@lang('register.form.Your country')
								<span class="caret"></span>
							</button>
							<ul class="dropdown-menu" role="menu" aria-labelledby="menu1">
								@foreach(config('country.list') as $key=>$value)
								<li role="presentation" data-value="{{$key}}" data-name="{{$value}}" class="country-item"><a role="menuitem" tabindex="-1" href="#">{{$value}}</a></li>
								@endforeach
							</ul>
							<input type="hidden" name="country" value="Việt Nam">
						</div>
						<div class="form-group">
							<textarea name="note" type="text" class="form-control"  placeholder="@lang('register.form.Questions & Comment')">{{old('note')}}</textarea>
						</div>
						<div class="term">
							<h4>
								{{get_name($reg_section_3)}} (*)
							</h4>
							<div class="box-term">
								<div class="custom-checkbox">
									<input type="checkbox" class="custom-control-input" id="toidadoc" required>
									<label class="custom-control-label" for="toidadoc">{{get_name($reg_section_4)}}<a href="{{get_link($reg_section_4)}}">{{get_content($reg_section_4)}}</a></label>
								</div>
								<div class="custom-checkbox">
									<input type="checkbox" class="custom-control-input" id="confirm" required>
									<label class="custom-control-label" for="confirm">{{get_content($reg_section_3)}}</label>
								</div>

							</div>

						</div> <!-- end term -->
						<div class="btn-re">
							<button class="btn btn-default" type="submit" >@lang('register.form.register')
							</button>
								<button class="btn btn-default bt-cancel" type="button" >@lang('register.form.cancel')
							</button>

						</div>
					</form> <!-- end form -->
				</div>
			</div>

		</div>

	</div>
		<!-- begin service-home -->
	@include('fontend.partials.service-home',['sevice_intro_home'=>$sevice_intro_home,'sevice_home'=>$sevice_home,'title'=>$sevice_title_home,'des'=>$sevice_des_home])
	<!--  end service-home
	include('fontend.partials.clients-home',['objs'=>$scs,'clients'=>$cts])  -->
	<!-- end clients-home -->
	@include('fontend.partials.partner-home',['title'=>$partner_title_home,'des'=>$partner_des_home,'partner'=>$pt_item])
	<!-- end partner-home -->

</section>
@section('js')
<script type="text/javascript">
	$(document).ready(function(){
		$(".nav-item:first").addClass("active");
		$(".tab-pane:first").addClass("active");
		$(".country-item").click(function(){
			v = $(this).data('value');
			n = $(this).data('name');
			$('#menu1').html(n);
			$('#country').val(v);
		});
	});
</script>
@endsection
@endsection
