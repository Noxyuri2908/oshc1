<div class="item-service col-md-3 col-sm-6 col-xs-6">
	<div class="item-service-in flex-column d-flex justify-content-center align-items-center">
		<div class="icon-sv">
			<img class="w-85" src="{{$post->image}}" alt="{{get_content($post)}}">
		</div>
		<div class="title-sv">
			{!! get_content($post) !!}aa
		</div>
	</div>
</div>
@push('scripts')
<script>
    $('.title-sv').matchHeight();
</script>
@endpush
