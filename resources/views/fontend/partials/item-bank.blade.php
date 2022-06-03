<div class="bank-item col-md-2 col-sm-4 col-xs-6 pd0">
	<div class="avatar-bank">
		<img src="{{$service->image}}">
	</div>
	<div class="list-info">
		@php
			$i = 0;
		@endphp
		@foreach($service->docs as $doc)
		<div class="cont">
			<span><a href="{{$doc->link}}">{{get_name($doc)}}</a></span>
		</div>
		@php
			$i++;
		@endphp
		@endforeach
		@for($j = $i; $j < $num_doc; $j++)
		<div class="cont">
		</div>
		@endfor
	</div>
	<div class="bottom">
		@php
		$price = isset($prices) && isset($prices[$service->slug]) ? $prices[$service->slug] : 0;
		@endphp
            <span class="price">$ {{number_format($price,2,".",",")}}</span>
        @if($price == 0)
            <button type="button" class="btn-quote-list send-f">@lang('header.quote_now')</button>
        @else
            <button type="button" class="btn-quote-list send-f" style="display:none">@lang('header.quote_now')</button>
            <button class="buy get-a-quote-buy-click" data-clicked=false data-url="{{route('apply',['id'=>$service->id, 'price'=>$price])}}" data-price="{{$price}}" data-id="{{$service->id}}">@lang('header.buy_now')</button>
        @endif
	</div>
</div>
