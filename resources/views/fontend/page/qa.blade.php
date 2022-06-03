@extends('fontend.layouts.master')
@section('title')
Q&A - OSHC
@endsection
@section('content')
<section id="qa-page">
	<div class="container">
		<div class="header-page">
			<div class="title-section">
				{{ get_name($qa_section_1)}}
			</div>
			<div class="des-section">
				{!! get_content($qa_section_1) !!}
			</div>
			<div class="buge">...</div>
		</div>
	</div>
	<div class="section1 on-desktop" >
		<div class="container">
			<div class="row">
				{{-- <div class="sidebar-menu col-md-3">
					<ul class="side-menu">
						@php
						$i = 1;
						@endphp
						@foreach($areas as $area)
						<li class="{{$i==1 ? 'active': ''}}">
							<a href="#menu{{$i}}" data-id="{{$i}}">{{$i}}. {{get_name($area)}} <i class="fa fa-play" aria-hidden="true"></i></a>
						</li>
						@php
						$i++;
						@endphp
						@endforeach
					</ul>
				</div> --}}
				<div class="col-md-9 tab-customs">
					@php
					$j = 1;
					@endphp
					@foreach($areas as $area)
					<div id="menu{{$j}}" class="tab-custom {{$j==1 ? 'active' : ''}}">
						<div class="panel-group" id="accordion{{$j}}">
							@php
							$i = 1;
							@endphp
							@foreach($area->qa()->where('status',1)->get() as $qa)
							<div class="panel panel-default">
								<div class="panel-heading">
									<div class="panel-title">
										<a data-toggle="collapse" data-parent="#accordion" href="#collapse{{$j}}{{$i}}"><i class="fa fa-caret-down" aria-hidden="true"></i><span>@lang('header.show_answer')</span></a>
										<p>{!! get_name($qa) !!}</p>
									</div>
								</div>
								<div id="collapse{{$j}}{{$i}}" class="panel-collapse collapse {{ $i==1 ? 'in' : '' }}">
									<div class="panel-body">
										{!! get_content($qa) !!}
									</div>
								</div>
							</div>
							@php
								$i++;
							@endphp
							@endforeach
						</div> <!-- end accordion -->
					</div>
					@php
					$j++;
					@endphp
					@endforeach
				</div> <!-- end col-md-6 -->
				<div class="sidebar col-md-3">
					<div id="title">
						<span class="title">
							{{get_name($qa_section_2)}}
						</span>
					</div>
					<div class="mail">
						<i class="fa fa-envelope" aria-hidden="true"></i>
						<p>{!! get_content($qa_section_2) !!}</p>
					</div>
					<div class="form">
						<form action="{{route('question')}}" method="post" class="form-horizontal">
							@csrf
							<div class="form-group2">
								<input type="text" class="form-control" name="name" placeholder="Your name" required>
							</div>
							<div class="form-group2">
								<input type="text" class="form-control" name="email" placeholder="Your email" required>
							</div>
							<div class="form-group2">
								<input type="text" class="form-control" name="phone" placeholder="Your phone" required>
							</div>
							<div class="form-group2">
							@lang('header.your_question')</label>
							</div>
							<div class="form-group2">
								<input type="text" class="form-control" name="ques" placeholder="Your Questions" required>
							</div>
							<div class="form-group2">
								<textarea class="form-control" rows="5" name="content" placeholder="Content" required></textarea>
							</div>
							<button type="submit" class="btn">
							@lang('header.send_question')
							</button>
						</form>


					</div>
					<div id="title">
						<span class="title">
							@lang('header.sub')
						</span>
					</div>
					<div class="input-group">
						<input id="email" type="text" class="form-control"placeholder="Your Email">
						<span class="input-group-addon sub-email"><i class="fa fa-share" aria-hidden="true"></i></span>
					</div>
				</div>
			</div>
		</div>
	</div> <!-- end section1 on destop-->

	<!-- begin service-home -->
	@include('fontend.partials.service-home',['sevice_intro_home'=>$sevice_intro_home,'sevice_home'=>$sevice_home,'title'=>$sevice_title_home,'des'=>$sevice_des_home])
	<!--  end service-home -->
	@include('fontend.partials.clients-home',['objs'=>$scs,'clients'=>$cts])
	<!-- end clients-home -->
	@include('fontend.partials.partner-home',['title'=>$partner_title_home,'des'=>$partner_des_home,'partner'=>$pt_item])
	<!-- end partner-home -->

</section>
@section('js')
<script type="text/javascript">
	$(document).ready(function(){
		$(".nav-item:first").addClass("active");
		$(".tab-pane:first").addClass("active");
	});
	ajax_url = $('#ajax_url').val() + "/subcriber";
	$('.sub-email').click(function(){
		email = $('#email').val();
		if(email != null && email != ''){
			$.get(ajax_url, { sub_email: email}, function (data) {
				alert(data);
	    	});
		}else{
			alert('Vui lòng nhập email!');
		}
	});
</script>
@endsection
@endsection
