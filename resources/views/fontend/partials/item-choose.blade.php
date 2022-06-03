<div class="item-chose d-flex">
	<div class="icon">
		<img src="{{$post->image}}">
	</div>
	<div class="cont">
		<div class="title">
			{!! get_name($post) !!}
		</div>
		<div class="des">
			{!! get_content($post) !!}
		</div>
	</div>
</div>
