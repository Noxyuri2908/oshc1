<div class="slide-client">
	<div class="client-inner">
		<div class="avatar">
			<img src="{{$post->image}}">
		</div>
		<div class="cont">
			<div class="name">
				{{$post->name}}
			</div>
			<div class="chuc-danh">
				{!! $post->des_s !!}
			</div>
			<div class="star"></div>
			<div class="line"></div>
			<div class="comment">
				{!! $post->des_f !!}
			</div>
		</div>
	</div>
</div>
