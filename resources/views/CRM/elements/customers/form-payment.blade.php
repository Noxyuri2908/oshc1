<div class="card mb-3">
  <div class="card-header">
    <div class="chevron-down-up">
      <h5 class="mb-0">Payment info</h5>
      <p class="click-down" data-id="payment"><span class="fas fa-chevron-down"></span></p>
    </div>
  </div>
    <div class="card-body bg-light" data-id="payment">
        <div class="row">
            <div class="col-lg-2">
                <div class="form-group">
                    <label for="promotion_id">Promotion code</label>
                    <select class="form-control" id="promotion_id" name="promotion_id">
                        <option data-amount="0" label=""></option>
                            @foreach($promotions as $promotion)
                            @if(!isset($obj))
                            <option data-amount="{{$promotion->amount}}" value="{{$promotion->id}}" {{old('promotion_id') == $promotion->id ? 'selected' : ''}}>{{$promotion->code}}</option>
                            @else
                            <option data-amount="{{$promotion->amount}}"  value="{{$promotion->id}}" {{$obj->promotion_id == $promotion->id ? 'selected' : ''}}>{{$promotion->code}}</option>
                            @endif
                            @endforeach
                    </select>
                </div>
            </div>
            <div class="col-lg-2">
                <label for="promotion_amount">Promotion ($)</label>
                <div class="input-group mb-3">
                    <input type="text" onfocus="this.blur()" class="form-control" id="promotion_amount" name="promotion_amount" value="{{isset($obj) ? $obj->promotion_amount : 0}}">
                    <div class="input-group-append"><span class="input-group-text">{{!empty($obj)? $obj->provider->currency() : ''}}</span></div>
                </div>
            </div>
            <div class="col-lg-2">
                <label for="extend_fee">Extend fee</label>
                <div class="input-group mb-3">
                    <input type="text" class="form-control"  id="extend_fee" name="extend_fee" value="{{!empty($cus) ? $cus->extend_fee : 0}}">
                    <div class="input-group-append"><span class="input-group-text">{{!empty($obj)? $obj->provider->currency() : ''}}</span></div>
                </div>
            </div>
            <div class="col-lg-2">
                <div class="form-group">
                    <label for="bank_fee">Bank fee (%)</label>
                    <select class="form-control" id="bank_fee" name="bank_fee" required>
                    @foreach(config('myconfig.bank_fee') as $key=>$value)
                    @if(!isset($obj))
                    <option value="{{$key}}" {{old('bank_fee') == $key ? 'selected' : ''}}>{{$value}}</option>
                    @else
                    <option value="{{$key}}" {{$obj->bank_fee == $key ? 'selected' : ''}}>{{$value}}</option>
                    @endif
                    @endforeach
                    </select>
                </div>
            </div>
            <div class="col-lg-2">
                <label for="fee">Bank fee ($)</label>
                <div class="input-group mb-3">
                <input class="form-control" onfocus="this.blur()"  id="fee" name="bank_fee_number" value="{{(!empty($obj)?$obj->bank_fee_number:'')}}" type="text" placeholder="" >
                <div class="input-group-append"><span class="input-group-text">{{!empty($obj)? $obj->provider->currency() : ''}}</span></div>
                </div>
            </div>
            <div class="col-lg-2">
                <div class="form-group">
                    <label for="payment_method">Payment method</label>
                    <select class="form-control" id="payment_method" name="payment_method" required>
                        <option label=""></option>
                        @foreach(config('myconfig.payment_method') as $key=>$value)
                        @if(!isset($obj))
                        <option value="{{$key}}" {{old('payment_method') == $key ? 'selected' : ''}}>{{$value}}</option>
                        @else
                        <option value="{{$key}}" {{$obj->payment_method == $key ? 'selected' : ''}}>{{$value}}</option>
                        @endif
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-lg-2">
                <label for="gst">GST</label>
                <div class="input-group mb-3">
                    <input class="form-control" id="gst" name="gst" value="{{isset($obj) ? $obj->gst : 0}}" type="text" placeholder="">
                    <div class="input-group-append"><span class="input-group-text">{{!empty($obj)? $obj->provider->currency() : ''}}</span></div>
                </div>
            </div>
            {{--<div class="col-lg-2">--}}
            {{--    <label for="surcharge">Surcharge ($)</label>--}}
            {{--    <div class="input-group mb-3">--}}
            {{--        <input class="form-control" onfocus="this.blur()"  id="surcharge" name="surcharge" value="{{isset($obj) ? $obj->surcharge : 0}}" type="text" placeholder="">--}}
            {{--        <div class="input-group-append"><span class="input-group-text">{{!empty($obj)? $obj->provider->currency() : ''}}</span></div>--}}
            {{--    </div>--}}
            {{--</div>--}}
            <div class="col-lg-2">
                <label for="extra">Discount $</label>
                <div class="input-group mb-3">
                    <input class="form-control" id="extra" name="extra" value="{{isset($obj) ? $obj->extra : 0}}" type="text" placeholder="">
                    <div class="input-group-append"><span class="input-group-text">{{!empty($obj)? $obj->provider->currency() : ''}}</span></div>
                </div>
            </div>
            <div class="col-lg-2">
                <label for="comm">Commission ($)</label>
                <div class="input-group mb-3">
                    <input class="form-control" id="comm" name="comm" value="{{isset($obj) ? $obj->comm : 0}}" type="text" placeholder="">
                    <div class="input-group-append"><span class="input-group-text">{{!empty($obj)? $obj->provider->currency() : ''}}</span></div>
                </div>
            </div>
            <div class="col-lg-2">
                <label for="comm">Total ($)</label>
                <div class="input-group mb-3">
                    <input class="form-control" id="total" name="total" value="{{isset($obj) ? $obj->total : 0}}" type="text" placeholder="" >
                    <div class="input-group-append"><span class="input-group-text">{{!empty($obj)? $obj->provider->currency() : ''}}</span></div>
                </div>
            </div>
            <div class="col-lg-2">
                <label for="comm">Exchange Rate</label>
                <div class="input-group mb-3">
                    <input class="form-control" id="exchange_rate" name="exchange_rate" value="{{isset($obj) && !empty($obj->customer) ? $obj->customer->exchange_rate : 0}}" type="text" placeholder="">
{{--                    <div class="input-group-append"><span class="input-group-text">{{!empty($obj)? $obj->provider->currency() : ''}}</span></div>--}}
                </div>
            </div>

        </div>
    </div>
</div>

@push('scripts')
<script>
    $('#promotion_amount, #fee ,#surcharge,#comm,#total').on('mouseover',function(){
        $(this).attr('readonly','readonly');
    }).on('mouseleave',function(){
        $(this).removeAttr('readonly');
    });
</script>
@include('CRM.partials.number_currency',['ids'=>[
    'total',
    'fee',
    'promotion_amount',
    'extend_fee',
    'extra',
    'comm',
    'surcharge',
    'gst',
    'exchange_rate',
    'net_amount',

], 'currency' => !empty($obj) ? $obj->provider->currency() : ''])
@endpush
