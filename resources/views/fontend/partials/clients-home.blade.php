<div id="clients-home" class="padding-group">
	<div class="w-100">
		<div class="title-section">
			{!! $objs->des_s !!}
		</div>
		<div class="des-section">
			{!! $objs->des_f !!}
		</div>
		{{-- <div class="buge">...</div> --}}
		<div class="list-client-home">
			<div class="client-slides clear clearfix">
				<div class="client-slide owl-carousel owl-theme">
					@foreach ($clients as $client)
						@include("fontend.partials.item-client",['post'=>$client])
					@endforeach
                </div>
			</div>
		</div>
	</div>
</div>
@push('scripts')
<script>
    $('.cont').matchHeight();
    $('.client-slide').owlCarousel({
            margin:10,
            responsive:{
                0:{
                    items:1
                },
                600:{
                    items:1
                },
                1000:{
                    items:3
                }
            }
        })

</script>
@endpush
