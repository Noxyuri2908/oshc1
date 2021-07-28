@if(!empty($tmp))
    <div class="modal fade user-information" id="modal_invoice" tabindex="-1" role="dialog"
         aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit of Invoice</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span
                            class="font-weight-light" aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="content-information">
                        <h3 class="name">
                            {{(!empty($tmp))?$tmp->invoice_code:''}}
                        </h3>
                        <form id="edit-invoice-form" action="{{route('customer.update',['id'=>$tmp->id])}}"
                              method="post">
                            @csrf
                            <input type="hidden" name="_method" value="PATCH">
                            <input type="hidden" name="type_extra" value="{{$tmp->type_extra}}">
                            <div class="alert-validation">

                            </div>
                            <div class="row">
                                <div class="col-md-3 content-table">
                                    <div class="form-group">
                                        <label class="control-label">Agent:</label>
                                        <select class="form-control" id="agent_id" name="agent_id" required>
                                            <option data-country="" label=""></option>
                                            @foreach($agents as $agent)
                                                @if(!isset($tmp))
                                                    <option data-country="{{$agent->country()}}"
                                                            value="{{$agent->id}}" {{old('agent_id') == $agent->id ? 'selected' : ''}}>{{$agent->name}}</option>
                                                @else
                                                    <option data-country="{{$agent->country()}}"
                                                            value="{{$agent->id}}" {{$tmp->agent_id == $agent->id ? 'selected' : ''}}>{{$agent->name}}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3 content-table">
                                    <div class="form-group">
                                        <label class="control-label">Agent country:</label>
                                        <input type="text" name=""
                                               value="{{(!empty($tmp) && $tmp->agent != null) ? $tmp->agent->country() : ''}}"
                                               readonly>
                                    </div>
                                </div>
                                <div class="col-md-3 content-table">
                                    <div class="form-group">
                                        <label class="control-label">Master agent:</label>
                                        <select class="form-control" id="master_agent" name="master_agent">
                                            <option data-country="" label=""></option>
                                            @foreach($agents as $agent)
                                                @if(!isset($tmp))
                                                    <option
                                                        value="{{$agent->id}}" {{old('master_agent') == $agent->id ? 'selected' : ''}}>{{$agent->name}}</option>
                                                @else
                                                    <option
                                                        value="{{$agent->id}}" {{$tmp->master_agent == $agent->id ? 'selected' : ''}}>{{$agent->name}}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3 content-table">
                                    <div class="form-group">
                                        <label class="control-label">Location Australia:</label>
                                        <select class="form-control" id="location_australia" name="location_australia"
                                                required>
                                            <option label=""></option>
                                            @foreach(config('location_australia') as $key=>$value)
                                                @if(!isset($tmp))
                                                    <option
                                                        value="{{$key}}" {{old('location_australia') == $key ? 'selected' : ''}}>{{$value}}</option>
                                                @else
                                                    <option
                                                        value="{{$key}}" {{$tmp->location_australia == $key ? 'selected' : ''}}>{{$value}}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3 content-table">
                                    <div class="form-group">
                                        <label class="control-label">Service country:</label>
                                        <select class="form-control" id="service_country" name="service_country"
                                                required>
                                            <option label=""></option>
                                            @foreach(config('myconfig.service_country') as $key=>$value)
                                                @if(!isset($tmp))
                                                    <option
                                                        value="{{$key}}" {{old('service_country') == $key ? 'selected' : ''}}>{{$value}}</option>
                                                @else
                                                    <option
                                                        value="{{$key}}" {{$tmp->service_country == $key ? 'selected' : ''}}>{{$value}}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3 content-table">
                                    <div class="form-group">
                                        <label class="control-label">Type of service:</label>
                                        <select class="form-control" id="type_service" name="type_service" required>
                                            <option data-country="" label=""></option>
                                            @foreach($dichvus as $dichvu)
                                                @if(!isset($tmp))
                                                    <option
                                                        value="{{$dichvu->id}}" {{old('type_service') == $dichvu->id ? 'selected' : ''}}>{{$dichvu->name}}</option>
                                                @else
                                                    <option
                                                        value="{{$dichvu->id}}" {{$tmp->type_service == $dichvu->id ? 'selected' : ''}}>{{$dichvu->name}}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3 content-table">
                                    <div class="form-group">
                                        <label class="control-label">Type of invoice:</label>
                                        <select class="form-control" id="type_invoice" name="type_invoice" required>
                                            <option label=""></option>
                                            @foreach(config('myconfig.type_invoice') as $key=>$value)
                                                @if(!isset($tmp))
                                                    <option
                                                        value="{{$key}}" {{old('type_invoice') == $key ? 'selected' : ''}}>{{$value}}</option>
                                                @else
                                                    <option
                                                        value="{{$key}}" {{$tmp->type_invoice == $key ? 'selected' : ''}}>{{$value}}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3 content-table">
                                    <div class="form-group">
                                        <label class="control-label">Provider:</label>
                                        <select class="form-control" id="provider_id" name="provider_id" required>
                                            <option data-country="" label=""></option>
                                            @foreach($providers as $provider)
                                                @if(!isset($tmp))
                                                    <option
                                                        value="{{$provider->id}}" {{old('provider_id') == $provider->id ? 'selected' : ''}}>{{$provider->name}}</option>
                                                @else
                                                    <option
                                                        value="{{$provider->id}}" {{$tmp->provider_id == $provider->id ? 'selected' : ''}}>{{$provider->name}}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3 content-table">
                                    <div class="form-group">
                                        <label class="control-label">Policy:</label>
                                        <select class="form-control" id="policy" name="policy" required>
                                            <option label=""></option>
                                            @foreach(config('myconfig.policy') as $key=>$value)
                                                @if(!isset($tmp))
                                                    <option
                                                        value="{{$key}}" {{old('policy') == $key ? 'selected' : ''}}>{{$value}}</option>
                                                @else
                                                    <option
                                                        value="{{$key}}" {{$tmp->policy == $key ? 'selected' : ''}}>{{$value}}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3 content-table">
                                    <div class="form-group">
                                        <label class="control-label">No of adults:</label>
                                        <select class="form-control" id="no_of_adults" name="no_of_adults" required>
                                            <option value=1 {{(!empty($tmp) && $tmp->no_of_adults == 1)?'selected':''}}>
                                                1
                                            </option>
                                            <option value=2 {{(!empty($tmp) && $tmp->no_of_adults == 2)?'selected':''}}>
                                                2
                                            </option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3 content-table">
                                    <div class="form-group">
                                        <label class="control-label">No of children:</label>
                                        <select class="form-control" id="no_of_children" name="no_of_children" required>
                                            <option
                                                value=0 {{(!empty($tmp) && $tmp->no_of_children == 0)?'selected':''}}>0
                                            </option>
                                            <option
                                                value=1 {{(!empty($tmp) && $tmp->no_of_children == 1)?'selected':''}}>1
                                            </option>
                                            <option
                                                value=2 {{(!empty($tmp) && $tmp->no_of_children == 2)?'selected':''}}>2
                                            </option>
                                            <option
                                                value=3 {{(!empty($tmp) && $tmp->no_of_children == 3)?'selected':''}}>3
                                            </option>
                                            <option
                                                value=4 {{(!empty($tmp) && $tmp->no_of_children == 4)?'selected':''}}>4
                                            </option>
                                            <option
                                                value=5 {{(!empty($tmp) && $tmp->no_of_children == 5)?'selected':''}}>5
                                            </option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3 content-table">
                                    <div class="form-group">
                                        <label class="control-label">Type of visa:</label>
                                        <select class="form-control" id="type_visa" name="type_visa" required>
                                            <option label=""></option>
                                            @foreach(config('myconfig.type_visa') as $key=>$value)
                                                @if(!isset($tmp))
                                                    <option
                                                        value="{{$key}}" {{old('type_visa') == $key ? 'selected' : ''}}>{{$value}}</option>
                                                @else
                                                    <option
                                                        value="{{$key}}" {{$tmp->type_visa == $key ? 'selected' : ''}}>{{$value}}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3 content-table">
                                    <div class="form-group">
                                        <label class="control-label">Start date:</label>
                                        <input class=""
                                               id="start_date" name="start_date"
                                               value="{{isset($tmp) ? $tmp->start_date : old('start_date')}}"
                                               type="text"
                                               required
                                        >
                                    </div>
                                </div>

                                <div class="col-md-3 content-table">
                                    <div class="form-group">
                                        <label class="control-label">End date:</label>
                                        <input class="" id="end_date"
                                               name="end_date"
                                               value="{{isset($tmp) ? $tmp->end_date : old('end_date')}}"
                                               type="text" required>
                                    </div>
                                </div>
                                <div class="col-md-3 content-table">
                                    <div class="form-group">
                                        <label class="control-label">Ref No:</label>
                                        <input type="text" name="invoice_code"
                                               value="{{(!empty($tmp))?$tmp->invoice_code:''}}"
                                               readonly>
                                    </div>
                                </div>
                                <div class="col-md-3 content-table">
                                    <div class="form-group">
                                        <label class="control-label">Status:</label>
                                        <select class="form-control" id="status" name="status" required>
                                            <option label=""></option>
                                            @foreach(config('myconfig.status_invoice') as $key=>$value)
                                                @if(!isset($tmp))
                                                    <option
                                                        value="{{$key}}" {{old('status') == $key ? 'selected' : ''}}>{{$value}}</option>
                                                @else
                                                    <option
                                                        value="{{$key}}" {{$tmp->status == $key ? 'selected' : ''}}>{{$value}}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3 content-table">
                                    <div class="form-group">
                                        <label class="control-label">Net amount ($):</label>
                                        <input oninput="check(this)" class="net_amount_form_invoice" type="text" name="net_amount"
                                               value="{{(!empty($tmp))?number_format($tmp->net_amount):''}}" required>
                                    </div>
                                </div>
                                <div class="col-md-3 content-table">
                                    <div class="form-group">
                                        <label class="control-label">Promotion code:</label>
                                        <select class="form-control" id="promotion_id" name="promotion_id">
                                            <option data-amount="0" label=""></option>
                                            @if(!empty($promotions))
                                                @foreach($promotions as $promotion)
                                                    @if(!isset($tmp))
                                                        <option data-amount="{{$promotion->amount}}"
                                                                value="{{$promotion->id}}" {{old('promotion_id') == $promotion->id ? 'selected' : ''}}>{{$promotion->code}}</option>
                                                    @else
                                                        <option data-amount="{{$promotion->amount}}"
                                                                value="{{$promotion->id}}" {{$tmp->promotion_id == $promotion->id ? 'selected' : ''}}>{{$promotion->code}}</option>
                                                    @endif
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3 content-table">
                                    <div class="form-group">
                                        <label class="control-label">Promotion ($):</label>
                                        <input type="text" name="promotion_amount"
                                               value="{{(!empty($tmp))?number_format($tmp->promotion_amount):''}}"
                                               readonly>
                                    </div>
                                </div>
                                <div class="col-md-3 content-table">
                                    <div class="form-group">
                                        <label class="control-label">Bank fee (%):</label>
                                        <select class="form-control bank_fee_percent_form_invoice" id="bank_fee_percent_form_invoice" name="bank_fee" required>
                                            @foreach(config('myconfig.bank_fee') as $key=>$value)
                                                @if(!isset($tmp))
                                                    <option
                                                        value="{{$key}}" {{old('bank_fee') == $key ? 'selected' : ''}}>{{$value}}</option>
                                                @else
                                                    <option
                                                        value="{{$key}}" {{$tmp->bank_fee == $key ? 'selected' : ''}}>{{$value}}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3 content-table">
                                    <div class="form-group">
                                        <label class="control-label">Bank fee ($):</label>
                                        <input type="text" class="bank_fee_money_form_invoice" name=""
                                               value="{{(!empty($tmp) && isset(config('myconfig.bank_fee')[$tmp->bank_fee])) ? number_format($tmp->net_amount*$tmp->bank_fee)  : ''}}" readonly>
                                    </div>
                                </div>

                                <div class="col-md-3 content-table">
                                    <div class="form-group">
                                        <label class="control-label">Payment method:</label>
                                        <select class="form-control" id="payment_method" name="payment_method" required>
                                            <option label=""></option>
                                            @foreach(config('myconfig.payment_method') as $key=>$value)
                                                @if(!isset($tmp))
                                                    <option
                                                        value="{{$key}}" {{old('payment_method') == $key ? 'selected' : ''}}>{{$value}}</option>
                                                @else
                                                    <option
                                                        value="{{$key}}" {{$tmp->payment_method == $key ? 'selected' : ''}}>{{$value}}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3 content-table">
                                    <div class="form-group">
                                        <label class="control-label">Surcharge ($):</label>
                                        <input  oninput="check(this)"  type="text" name="surcharge" oninput="check(this)"
                                               value="{{(!empty($tmp))?number_format($tmp->surcharge):''}}"
                                               readonly>
                                    </div>
                                </div>
                                <div class="col-md-3 content-table">
                                    <div class="form-group">
                                        <label class="control-label">-/+ ($):</label>
                                        @if(!empty($tmp))
                                            <input type="text" name="extra"
                                                   value="{{($tmp->extra == 0) ? '-'.number_format($tmp->extra) : '+'.number_format($tmp->extra)}}">
                                        @else
                                            <input type="text" name="extra" value="">
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-3 content-table">
                                    <div class="form-group">
                                        <label class="control-label">Commission ($):</label>
                                        <input type="text" name="comm"
                                               value="{{(!empty($tmp))?number_format($tmp->comm):''}}"
                                               readonly>
                                    </div>
                                </div>
                                <div class="col-md-3 content-table">
                                    <div class="form-group">
                                        <label class="control-label">GST:</label>
                                        <input type="text" name="gst"
                                               value="{{(!empty($tmp) && $tmp->gst != null) ? $tmp->gst : 0}}">
                                    </div>
                                </div>

                                <div class="col-md-3 content-table">
                                    <div class="form-group">
                                        <label class="control-label">Total ($):</label>
                                        <input oninput="check(this)" type="text" name="total"
                                               value="{{(!empty($tmp))?number_format($tmp->total):''}}"
                                               required>
                                    </div>
                                </div>
                                <div class="col-md-3 content-table">
                                    <div class="form-group">
                                        <label class="control-label">Staff:</label>
                                        <select class="form-control" id="payment_method" name="payment_method" required>
                                            <option label=""></option>
                                            @foreach($staffs as $key=>$value)
                                                @if(!isset($tmp))
                                                    <option
                                                        value="{{$value['id']}}" {{old('staff_id') == $value['id'] ? 'selected' : ''}}>{{$value['username']}}</option>
                                                @else
                                                    <option
                                                        value="{{$value['id']}}" {{$tmp->staff_id == $value['id'] ? 'selected' : ''}}>{{$value['username']}}</option>
                                                @endif
                                            @endforeach
                                        </select>

                                    </div>
                                </div>
                                <div class="col-md-3 content-table">
                                    <div class="form-group">
                                        <label class="control-label">Creation date:</label>
                                        <input type="text" name="" value="{{(!empty($tmp))?$tmp->created_at:''}}"
                                               readonly>
                                    </div>
                                </div>
                                <div class="col-md-12 content-table">
                                    <div class="form-group">
                                        <label class="control-label">Note:</label>
                                        <textarea name="note" class="form-control"
                                                  rows="3">{{(!empty($tmp))?$tmp->note:''}}</textarea>
                                    </div>
                                </div>

                            </div>
                        </form>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-default btn-submit-invoice" >Save
                    </button>
{{--                    onclick="$('#edit-invoice-form').submit()"--}}
                    <button class="btn btn-secondary btn-sm" type="button" data-dismiss="modal">Close</button>
                </div>

            </div>
        </div>
    </div>
@endif
@push('scripts')
    <script>
        $(document).ready(function () {
            $(document).on('click','.btn-submit-invoice',function(e){
                let _total = $('input[name="total"]').val();
                let _net_amount = $('input[name="net_amount"]').val();
                let _html = '';
                let boolean = true;

                if(_total == 0 || _total < 1 || _total == ''){
                    _html += '<div class="alert-danger ">The total number must not be zero or null</div><br>';
                    boolean = false;
                }
                if(_net_amount == 0 || _net_amount < 1 || _net_amount == ''){
                    _html += '<div class="alert-danger ">The subchange number must not be zero or null</div><br>';
                    boolean = false;
                }
                if(boolean){
                    $('#edit-invoice-form').submit();
                }else{
                    $('.alert-validation').html(_html);
                    $('#modal_invoice').animate({ scrollTop: 0 }, "slow");
                }
            });
            $(document).on('mouseover', '#start_date', function () {
                let start_date_class = $('#start_date').hasClass('flatpickr-input');
                if (!start_date_class) {
                    $(this).flatpickr({dateFormat: "d/m/Y"});
                }
            })
            $(document).on('mouseover', '#end_date', function () {
                let end_date_class = $('#end_date').hasClass('flatpickr-input');
                if (!end_date_class) {
                    $(this).flatpickr({dateFormat: "d/m/Y"});
                }
            });

        });
    </script>
@endpush

