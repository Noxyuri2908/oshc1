@php
 $loopBox = 0;
 $lengCatBenefits= count($cat_benefits);
@endphp
<div class="on-destop">
    @foreach($cat_benefits as $cat)
    @php
        $loopBox ++;
    @endphp
	<div class="list-row-content w-100">
		<h3 class="title-table">{{get_name($cat)}}</h3>
		@foreach($cat->benefits as $benefit)
        <div class="row-item ">
				<div class="col col-title col-md-2 pd0 flex grey">
					<span>{{get_name($benefit)}}</span>
				</div>
				@foreach($services as $service)
					@php
						$conf = $confs->where('status',1)->where('service_id',$service->id)
						->where('benefit_id', $benefit->id)->first();
						if ($conf == null) $check = 0;
						else if($conf->note == null || $conf->note == '') $check = 1;
						else $check = 2;
					@endphp
					<div class="col col-md-2 pd0 flex {{($loop->index %2)?'grey':''}} {{($lengCatBenefits == $loopBox && $loop->index == 2)?'annalink-bg-color-yellow':''}}">
                        @if ($check == 1)
                            <i class="fas fa-check font-size-21px annalink-color-pink"></i>
						@elseif ($check == 2)
                            @if(get_note($conf) == 'x')
                            <span class="left d-flex justify-content-center">
                                <i class="fas fa-times annalink-color-green font-size-21px "></i>
                            </span>
                            @else
                            <span class="left">
                                {!! get_note($conf) !!}
                            </span>
                            @endif
						@else
							<span></span>
						@endif
					</div>
				@endforeach
		</div>
		@endforeach

	</div>
	@endforeach
	<div class="row-item bank-item">
		<div class="col col-title col-md-2 pd0 flex">
		</div>
        @foreach($services as $service)
            @php
            $price = isset($prices) && isset($prices[$service->slug]) ? $prices[$service->slug] : 0;
            @endphp

			<div class="col col-title col-md-2 pd0 flex">
                @if($price == 0)
                    <button type="button" class="btn-quote-list send-f">@lang('header.quote_now')</button>
                @else
                    <button type="button" class="btn-quote-list send-f" style="display:none">@lang('header.quote_now')</button>
                    <button class="buy get-a-quote-buy-click" data-clicked=false data-url="{{route('apply',['id'=>$service->id, 'price'=>isset($prices) && isset($prices[$service->slug]) ? $prices[$service->slug] : 0])}}" data-price="{{$price}}" data-id="{{$service->id}}">@lang('header.buy_now')</button>

{{--                    <button class="buy font-weight-100"><a class="" href="{{route('apply',['id'=>$service->id, 'price'=>isset($prices) && isset($prices[$service->slug]) ? $prices[$service->slug] : 0])}}">@lang('header.buy_now')</a></button>--}}
                @endif
			</div>
		@endforeach
	</div>
</div>
