@extends('fontend.layouts.master')
{{--@section('meta_title')--}}
{{--    OSHC global,{{$post->title}}--}}
{{--@stop--}}

{{--@section('meta_description')--}}
{{--    {{$post->title}},Giúp việc 88 cung cấp dich vụ giúp việc gia đình, giúp việc chăm trẻ, dịch vụ chăm sóc người già, chăm sóc người bệnh uy tín, chất lượng tại Hà Nội và TP. Hồ Chí Minh ✓Uy tín ✓Ổn định ✓Lâu dài--}}
{{--@stop--}}

{{--@section('meta_keywords')--}}
{{--    {{$post->title}}, giup viec cham be, giup viec cham ong ba, giúp việc nhà, giúp việc trông trẻ--}}
{{--@stop--}}

{{--@section('meta_image')--}}
{{--    {{$post->thumbnail}}--}}
{{--@stop--}}
@section('title')
{{get_name($post)}}
@endsection

@section('content')
<div class="clear"></div>
<section id="news-page">
	<div class="container">
		<div class="">
			<div class="title-section">
				{{get_name($news_detail_section_1)}}
			</div>
			<div class="des-section">
				{{get_content($news_detail_section_1)}}
			</div>
			<div class="buge">...</div>
		</div>
		<div class="breadcrumb">
			<ul>
				<li>
					<a href="{{route('home')}}">
						@lang('header.home')
					</a>
				</li>
				<div class="dimi">
					<i class="fa fa-angle-right" aria-hidden="true"></i>
				</div>
				<li>
					<a href="{{route('get_by_menu',['slug'=>$c_menu->slug])}}">
						{{get_name($c_menu)}}
					</a>
				</li>
				<div class="dimi">
					<i class="fa fa-angle-right" aria-hidden="true"></i>
				</div>
				<li>
					<a href="{{route('get_by_cat',['slug'=>$c_menu->slug, 'cat'=>$post->category->slug])}}">
						{{get_name($post->category)}}
					</a>
				</li>
				<div class="dimi">
					<i class="fa fa-angle-right" aria-hidden="true"></i>
				</div>

				<li class="active">
					{{get_name($post)}}
				</li>
			</ul>
		</div><!-- end breakcums -->
	</div>
	<div class="header-content">

		<div class="container">
			<div class="row">
				<div class="col-md-9">
					<div class="back">
						<a href="{{route('get_by_cat',['slug'=>$c_menu->slug, 'cat'=>$post->category->slug])}}">
							<i class="fa fa-arrow-left" aria-hidden="true"></i>
							<span>Back</span>
						</a>
					</div>
					<div class="clear"></div>
					<div class="body-content">
						<div class="post-content">
							<div class="header-post d-flex flex-column">
								<h1 class="title-page w-100">
									{{get_name($post)}}
                                </h1>
                                <div>
                                    <i class="fas fa-clock"></i> :{{(!empty($post->post_created_at))?\Carbon::parse($post->post_created_at)->format('d/m/Y'):\Carbon::parse($post->created_at)->format('d/m/Y')}}
                                    <div class="mt-3 mb-3">
                                        <div class="new-detail-icon-social-list">
                                            <div class="d-flex">
                                                <div class="mr-2 d-flex">Share :</div>
                                                <ul class="p-0 mb-0 list-style-none d-flex ">
                                                    <li class="facebook-color"><a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u={{url()->current()}}"><i class="fab fa-facebook-f text-light"></i></a></li>
                                                    <li class="google-color"><a href="https://plus.google.com/share?url={{url()->current()}}"><i class="fab fa-google-plus-g text-light"></i></a></li>
                                                    <li class="linkedin-color"><a target="_blank" href="https://www.linkedin.com/shareArticle?mini=true&url={{url()->current()}}"><i class="text-light fab fa-linkedin-in"></i></a>
                                                    </li>
                                                    <li class="pinterest-color"><a href="http://pinterest.com/pin/create/button/?url={{url()->current()}}&description={{get_name($post)}}"><i class="text-light fab fa-pinterest"></i></a>
                                                    </li>
                                                    <li class="twitter-color"><a target="_blank" href="https://twitter.com/intent/tweet?text={{get_name($post)}}&url={{url()->current()}}"><i class="text-light fab fa-twitter"></i></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
							</div>
							<div class="post-cont">
								{!! get_content($post) !!}
							</div> <!-- end post-cont -->
						</div> <!-- end content post -->
						<div class="footer-post">
							<div class="admin-cate">
								{{-- <div class="admin">
									@lang('header.post_by') <span>{{$post->user != null ? $post->user->name : 'hide'}}</span>
								</div>
								<div> | </div> --}}
								<div class="catego">
									@lang('header.category')  <span>{{$cat != null ? get_name($cat) : ''}}</span>
								</div>
							</div> 	 <!-- end admin-cate -->

							<div class="comment">
								<img src="{{asset('images/comment.png')}}" alt="comment">
								<span class="num">
									4
								</span>
							</div>
							<div class="clear"></div>
						</div> <!-- end footer-post -->

						<div class="tags-post">
							<div class="title-tag">
								<label for="" class="title">@lang('header.tags'):</label>
							</div>
							<div class="tags">
								@foreach($post->list_tags as $tag)
									<a href="{{route('tag',['slug'=>$tag->slug])}}" class="tag-cloud-link">{{get_name($tag)}}</a>
								@endforeach
							</div>		<!--  end tags -->
							<div class="clear"></div>
						</div>	 <!-- end tag -->
						<div class="reply-comment">
							@include('fontend.partials.item-comment')
						</div>	 <!-- end reply-comment -->
						<div class="leave-reply">
							<div class="title-form">
								@lang('header.leave_a_reply') <span class="name_comment" style="color: red"></span>
							</div>
							<div class="content-form">
								<div class="row">
									<div class="form-group col-md-6">
										<label class="control-icon" for="name">
											<i class="fa fa-user" aria-hidden="true"></i>
										</label>
										<input type="text" class="form-control" id="name" placeholder="@lang('header.YOUR NAME')" name="name">
									</div>
									<div class="form-group col-md-6">
										<label class="control-icon" for="email">
											<i class="fa fa-envelope" aria-hidden="true"></i>
										</label>
										<input type="email" class="form-control" id="email" placeholder="@lang('header.EMAIL ADDRESS')" name="email">
									</div>
									<div class="form-group col-md-12">
										<label class="control-icon penci" for="content">
											<i class="fa fa-pencil" aria-hidden="true"></i>
										</label>
										<textarea type="text" class="form-control" id="content" placeholder="@lang('header.YOUR COMMENT')" name="content"></textarea>
									</div>
									<div class="form-group submit-form col-md-3">
										<label class="control-icon " for="subm">
											<i class="fa fa-envelope" aria-hidden="true"></i>
										</label>
										<button type="button" class="form-control" id="subm" name="subm">@lang('header.SUBMIT COMMENT')</button>
									</div>
									<div class=" col-md-9 note">
										<span>*</span> {!! get_content($comment_note) !!}
									</div>
								</div>
							</div>
						</div>
					</div>		<!-- end body-content -->
				</div>   <!-- end col-md-9 -->
				<input type="hidden" name="post_id" id="post_id" value="{{$post->id}}">
				<input type="hidden" name="comment_id" id="comment_id">
				<div class="col-md-3">
					<div class="widget">
						<h3 class="title-widget">
							@lang('header.Recent Post')
						</h3>
						<div class="widget_1" id="widget-1">
							@foreach($posts as $_post)
							@php
							$url_post = '#';
							$_cat = $_post->category;
							if($_cat != null)
							$url_post = route('get_detail',['slug'=>$c_menu->slug, 'cat'=>$_cat->slug, 'post'=>$_post->slug]);
							@endphp
							<div class="list-post">
								<div class="img">
									<a href="{{$url_post}}">
									<img src="{{$_post->image}}" alt="{{get_name($_post)}}">
									</a>
								</div>
								<div class="content-list">
									<div class="header-content">
										<div class="date">
											<span class="day">{{covert_string_date($_post)['day']}}</span>
											<span class="mount">{{covert_string_date($_post)['month']}}</span>
										</div>
										<div class="title">
											<a href="{{$url_post}}">
											{{get_name($_post)}}
											</a>
										</div>
									</div> <!-- end header-content -->
								</div> <!-- end content-list -->
							</div> <!-- end list-post -->
							@endforeach
						</div> <!-- end widget_1 -->
					</div>
					{{-- <div class="widget">
						<h3 class="title-widget">
							@lang('header.Tags Cloud')
						</h3>
						<div class="widget_2" id="widget_2">
							@foreach($tags as $_tag)
							<a href="{{route('tag',['slug'=>$_tag->slug])}}" class="tag-cloud-link">{{get_name($_tag)}}</a>
							@endforeach
						</div>
						<div class="clear"></div>
					</div> --}}
					{{-- <div class="widget">
						<img src="{{get_image($news_detail_section_2)}}" alt="{{get_name($news_detail_section_2)}}">
					</div>
					<div class="widget">
						<img src="{{get_image($news_detail_section_3)}}" alt="{{get_name($news_detail_section_3)}}">
					</div> --}}
				</div> <!-- end col-md-3 -->
			</div> <!-- end row -->
			<div class="news-detail">
				<h3 class="title">@lang('header.NEWS RELATED')</h3>
				<div class="row">
					@foreach($r_posts as $_post)
						@php
							$url_post = '#';
							$_cat = $_post->category;
							if($_cat != null)
							$url_post = route('get_detail',['slug'=>$c_menu->slug, 'cat'=>$_cat->slug, 'post'=>$_post->slug]);
						@endphp
					<div class="col-md-4">
						<div class="list-post">
							<div class="img d-flex w-100">
                                <a class="news-list-image" href="{{$url_post}}">
                                    <img src="{{$_post->image}}" alt="{{get_name($_post)}}">
                                </a>
							</div>
							<div class="content-list">
								<div class="header-content d-flex">
									<div class="date">
										<span class="day">{{covert_string_date($_post)['day']}}</span>
										<span class="mount">{{covert_string_date($_post)['month']}}</span>
									</div>
									<div class="title">
										{{get_name($_post)}}
									</div>
								</div> <!-- end header-content -->
								<div class="body-content text-limit-line-4">
									{{get_des_s($_post)}}
								</div> <!-- end body-content -->

							</div> <!-- end content-list -->
							<div class="footer-content">
								{{-- <div class="admin">
									@lang('header.post_by')<span>{{$_post->user != null ? $_post->user->name : 'hide'}}</span>
								</div> --}}
								<div class="read-more">
									@if($post->category != null)
									<a href="{{$url_post}}">
									@else
									<a href="#">
									@endif
									@lang('header.read_more') <i class="fa fa-angle-right" aria-hidden="true"></i>
									</a>
								</div>
							</div> <!-- end fooer content -->
						</div> <!-- end list-post -->
					</div>
					@endforeach
				</div>
			</div>
		</div>
	</div>
    @include('fontend.partials.clients-home',['objs'=>$scs,'clients'=>$cts])

    @include('fontend.partials.partner-home',['title'=>$partner_title_home,'des'=>$partner_des_home,'partner'=>$pt_item])
</section>
@endsection
@push('scripts')
<script>
    $(document).ready(function(){
        $('.content-list').matchHeight();
    })

</script>
@endpush
@section('js')
<script type="text/javascript">
	function getNumberComment(){
		count = 0;
		$('.child-comment').each(function(){
		    count = count + 1;
		});
		$('.parent-comment').each(function(){
		   	count = count + 1;
		});
		$('.num').html(count);
	}
	$(document).ready(function(){
		url_post_comment = $('#ajax_url').val() + '/customer/comments';
		$(".nav-item:first").addClass("active");
		$(".tab-pane:first").addClass("active");

		$("#subm").click(function(){
			post_id = $('#post_id').val();
			comment_id = $('#comment_id').val();
			cus_name = $('#name').val();
			cus_email = $('#email').val();
			cus_content = $('#content').val();
			$.get(url_post_comment, {post:post_id, comment: comment_id, name:cus_name, email:cus_email, content:cus_content }, function (data) {
		    		$('.reply-comment').html(data);
		    		getNumberComment();
			});
		});

		$('.reply-comment').delegate('.reply', 'click', function(){
			$('#comment_id').val($(this).data('id'));
			$('.name_comment').html("<i>:" + $(this).data('name') + "</i>");
		});
		getNumberComment();

	});
</script>
@endsection
