@foreach($posts as $post)

@php
$url_post = '#';
if($post->category != null) $url_post = route('get_detail',['slug'=>$c_menu->slug, 'cat'=>$post->category->slug, 'post'=>$post->slug]);
@endphp
<div class="col-md-4">
	<div class="list-post">
		<div class="img d-flex w-100">
			<a class="news-list-image" href="{{$url_post}}"><img src="{{$post->image}}" alt="{{get_name($post)}}"></a>
		</div>
		<div class="div-tag">

		</div>
		<div class="content-list">
			<div class="header-content">
				<div class="date">

					<span class="day">{{covert_string_date($post)['day']}}</span>
					<span class="mount">{{covert_string_date($post)['month']}}</span>
				</div>
				<div class="title">
					<a href="{{$url_post}}">{{get_name($post)}}</a>
				</div>
				<div class="clear"></div>
			</div> <!-- end header-content -->
			<div class="body-content text-limit-line-4">
				{{get_des_s($post)}}
			</div> <!-- end body-content -->
		</div><!--  end content -list -->
		<div class="footer-content">
			<div class="admin">
				{{-- @lang('header.post_by') <span>{{$post->user != null ? $post->user->name : 'hide'}}</span> --}}
			</div>
			<div class="read-more">

				<a href="{{$url_post}}">@lang('header.read_more')<i class="fa fa-angle-right" aria-hidden="true"></i>
				</a>
			</div>
		</div><!-- end fooer content -->
	</div> <!-- end list-post -->
</div>
@endforeach
