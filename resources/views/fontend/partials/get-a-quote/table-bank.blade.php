<div id="table-banks">
	<div class="table-bank-inner d-flex">
		<div class="bank-item col-md-2 col-sm-4 col-xs-6 pd0 d-flex">
            <div class="w-100 d-flex overflow-hidden">
                @if(!empty($getImageQuote))
                    <img class="w-100" style="object-fit: contain;" src="{{$getImageQuote->image}}" alt="">
                @endif
            </div>
        </div>
        @foreach($services as $service)
		    @include("fontend.partials.item-bank",['service'=>$service])
		@endforeach
	</div>
</div>
