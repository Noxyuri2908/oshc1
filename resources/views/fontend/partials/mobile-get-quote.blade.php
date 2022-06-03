<div class="on-mobile">
    <div class="panel-group" id="accordion">
        @foreach($services as $service)
            <div class="panel panel-default">

                <div class="bank-items">
                    <div class="bank-item">
                        <div class="col-xs-4">
                            <div class="avatar-bank avatar-bank-mobile">
                                <img src="{{$service->image}}">
                            </div>
                        </div>
                        @php
                            $price = isset($prices) && isset($prices[$service->slug]) ? $prices[$service->slug] : 0;
                        @endphp
                        <div class="col-xs-4">
                            <div class="avatar-bank">
                                <span class="price">$ {{number_format($price,2,".",",")}}</span>
                            </div>
                        </div>
                        <div class="col-xs-4">
                            <div class="avatar-bank">
                                @if($price == 0)
                                    <button type="button"
                                            class="btn-quote-list-mobile">@lang('header.quote_now')</button>
                                @else
                                    <button type="button" class="btn-quote-list-mobile"
                                            style="display:none">@lang('header.quote_now')</button>
                                    <button class="buy get-a-quote-buy-click" data-clicked=false
                                            data-url="{{route('apply',['id'=>$service->id, 'price'=>$price])}}"
                                            data-price="{{$price}}"
                                            data-id="{{$service->id}}">@lang('header.buy_now')</button>

                                    {{--                                    <button class="buy"><a--}}
                                    {{--                                            href="{{route('apply',['id'=>$service->id, 'price'=>$price])}}">@lang('header.buy_now')</a>--}}
                                    {{--                                    </button>--}}
                                @endif

                            </div>
                        </div>
                    </div>
                    <div class="clear"></div>
                </div>
                <a data-toggle="collapse" data-parent="#accordion" href="#collapse{{$loop->index+1}}"
                   class="btn_view_inclusion">
                    <span>View Inclusions</span>
                    <i class="fa fa-caret-down" aria-hidden="true"></i>
                </a>
                <div id="collapse{{$loop->index+1}}" class="panel-collapse collapse">
                    @foreach($cat_benefits as $cat)

                        <div class="list-col">
                            <div class="col-xs-8">
                                <strong>
                                    {{get_name($cat)}}
                                </strong>
                            </div>
                            <div class="col-xs-4 text-center">
                                <span class="check"></span>
                            </div>
                            <div class="clear"></div>
                        </div>
                        @foreach($cat->benefits as $benefit)

                            <div class="list-col">
                                <div class="col-xs-8">
                                    {{get_name($benefit)}}
                                </div>
                                @php
                                    $conf = $confs->where('status',1)->where('service_id',$service->id)
                                    ->where('benefit_id', $benefit->id)->first();
                                    if ($conf == null) $check = 0;
                                    else if($conf->note == null || $conf->note == '') $check = 1;
                                    else $check = 2;

                                @endphp
                                <div class="col-xs-4 text-center">
                                    @if ($check == 1)
                                        <span class="check"></span>
                                    @elseif ($check == 2)
                                        <span class="">
								{!! get_note($conf) !!}
							</span>
                                    @else
                                        <span></span>
                                    @endif
                                </div>
                                <div class="clear"></div>
                            </div>
                        @endforeach
                    @endforeach
                </div>
            </div> <!-- end panel panel-default -->
        @endforeach
    </div> <!-- end accordion -->
</div> <!-- end on-mobile -->
