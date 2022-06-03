<div class="item-box col-md-4 col-sm-6 col-xs-6">
	<div class="item-box-in">
		<div class="icon-box">
			<img src="{{$post->image}}">
		</div>
		<div class="title-box">
			{{ get_name($post) }}
		</div>
		<div class="des-box">
		{!! get_content($post) !!}
		</div>
		<a href="{{$post->link}}" class="read-m">@lang('header.read_more')</a>
	</div>
</div>