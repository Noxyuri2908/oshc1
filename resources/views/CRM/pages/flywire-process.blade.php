@extends('CRM.layouts.process')

@section('title')
    CUSTOMER PROCESS
    @parent
@stop

@section('css')
    @include('CRM.elements.customer-process.css')
    @include('CRM.partials.css-list')
    <style>
        .bg-readonly {
            background-color: #edf2f9;
        }
    </style>
@stop

@section('content')
    @include('CRM.partials.topbar',['linkUrlBack'=>route('flywire.index')])
    <div class="row no-gutters">
        <div class="col-xl-2 pl-xl-2">
            <div class="sticky-top sticky-sidebar  sidebar-left">
                <div class="card mb-3 mb-lg-0">
                    <div class="card-body bg-light">
                        <h6><b>PAYMENT INFO</b></h6>
                        <div class="pat-sidebar">
                            <div class="form-group custom-control custom-radio">
                                <label class="custom-control-label" for="customRadio4">
                                    <strong>Payment ID</strong>
                                </label>
                                <small class="form-text mt-0" style="color: #01A9DB">{{(!empty($obj))?$obj->ref_no:''}}</small>
                            </div>
                        </div>
                        <div class="pat-sidebar">
                            <div class="form-group custom-control custom-radio">
                                <label class="custom-control-label" for="customRadio4">
                                    <strong>Agent</strong>
                                </label>
                                <small class="form-text mt-0" style="color: #01A9DB">{{(!empty($obj))?$obj->getAgentName():''}}</small>
                            </div>
                        </div>
                        <div class="pat-sidebar">
                            <div class="form-group custom-control custom-radio">
                                <label class="custom-control-label" for="customRadio4">
                                    <strong>Full Name</strong>
                                </label>
                                <small class="form-text mt-0" style="color: #01A9DB">{{(!empty($obj))?$obj->getFullNameCus():''}}</small>
                            </div>
                        </div>
                        <div class="pat-sidebar">
                            <div class="form-group custom-control custom-radio">
                                <label class="custom-control-label" for="customRadio4">
                                    <strong>Payment Status</strong>
                                </label>
                                <small class="form-text mt-0" style="color: #01A9DB">{{(!empty($obj))?$obj->getPaymentStatusFlywire():''}}</small>
                            </div>
                        </div>
                        <div class="pat-sidebar">
                            <div class="form-group custom-control custom-radio">
                                <label class="custom-control-label" for="customRadio4">
                                    <strong>Gender</strong>
                                </label>
                                <small class="form-text mt-0" style="color: #01A9DB">{{(!empty($obj))?$obj->getGenderCus():''}}</small>
                            </div>
                        </div>
                        <div class="pat-sidebar">
                            <div class="form-group custom-control custom-radio">
                                <label class="custom-control-label" for="customRadio4">
                                    <strong>Mobile No</strong>
                                </label>
                                <small class="form-text mt-0" style="color: #01A9DB">{{(!empty($obj))?$obj->registerCus()->phone:''}}</small>
                            </div>
                        </div>
                        <div class="pat-sidebar">
                            <div class="form-group custom-control custom-radio">
                                <label class="custom-control-label" for="customRadio4">
                                    <strong>The payment will come from</strong>
                                </label>
                                <small class="form-text mt-0" style="color: #01A9DB">{{(!empty($obj))?$obj->getPayComeFrom():''}}</small>
                            </div>
                        </div>
                        <div class="pat-sidebar">
                            <div class="form-group custom-control custom-radio">
                                <label class="custom-control-label" for="customRadio4">
                                    <strong>Amount from/Unit</strong>
                                </label>
                                <small class="form-text mt-0" style="color: #01A9DB">{{(!empty($obj))?convert_price_float($obj->amount_from):''}} {{(!empty($obj))?getCurrency($obj->amount_from_unit):''}}</small>
                            </div>
                        </div>
                        <div class="pat-sidebar">
                            <div class="form-group custom-control custom-radio">
                                <label class="custom-control-label" for="customRadio4">
                                    <strong>Amount to/Unit</strong>
                                </label>
                                <small class="form-text mt-0" style="color: #01A9DB">{{(!empty($obj))?convert_price_float($obj->amount_to):''}} {{(!empty($obj))?getCurrency($obj->amount_to_unit):''}}</small>
                            </div>
                        </div>
                        <div class="pat-sidebar">
                            <div class="form-group custom-control custom-radio">
                                <label class="custom-control-label" for="customRadio4">
                                    <strong>Payment type</strong>
                                </label>
                                <small class="form-text mt-0" style="color: #01A9DB">{{(!empty($obj))?$obj->getPaymentType():''}} </small>
                            </div>
                        </div>
                        <div class="pat-sidebar">
                            <div class="form-group custom-control custom-radio">
                                <label class="custom-control-label" for="customRadio4">
                                    <strong>Initiated date</strong>
                                </label>
                                <small class="form-text mt-0" style="color: #01A9DB">{{(!empty($obj))?convert_date_form_db($obj->initiated_date):''}} </small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-10 pl-xl-2">
            <div class="card mb-3">
                <div class="card-header">
                    <div class="tab-form-bt tab-data-table" onmouseover="callVndFormat();callDigitFormat();">
                        <div class="row">
                            <div class="col-12">
                                <div class="group-checkbox">
                                    <div class="row">
                                        @foreach(config('myconfig.flywire_status') as $key=>$value)
                                            <div class="col-sm-6 col-md-3 checkboxs">
                                                <div class="form-group">
                                                    <input data-text="{{$value}}" type="radio" {{(!empty($obj) && $obj->status == $key) ? 'checked=true' : ''}} class="c_status" id="invoice_status" name="invoice_status" value="{{$key}}">
                                                    <label for="">{{$value}}</label>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                                @if(session('error-agent-process'))
                                    <div class="alert alert-danger">
                                        <strong>{{session('error-agent-process')}}</strong>
                                    </div>
                                @endif
                                @if(session('success-agent-process'))
                                    <div class="alert alert-success">
                                        <strong>{{session('success-agent-process')}}</strong>
                                    </div>
                                @endif
                                <ul class="nav nav-tabs" id="myTab" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link {{(request()->get('tab_link') == 1 )? 'active' : ''}}" id="invoice-tab" data-toggle="tab" href="#tab-invoice" role="tab" aria-controls="tab-invoice" aria-selected="true">Commission & Profit</a>
                                    </li>
                                </ul>
                                <div class="tab-content border-x border-bottom p-3" id="myTabContent">
                                    <div class="tab-pane fade {{request()->get('tab_link') == 1  ? 'show active' : ''}}" id="tab-invoice" role="tabpanel" aria-labelledby="doc-tab">
                                        <div>
                                            {{--<form action="">--}}
                                            <div class="row">
                                                @php
                                                    $getComProvider = \App\Admin\Apply::getProviderComFlywire($obj->provider_id, $obj->delivered_date);
                                                    $com_form_provider = $obj->amount_to * $getComProvider /100;
                                                    $exchange_to_AUD = (!empty($exchangeRateFlywireComProvider))?$exchangeRateFlywireComProvider->unit_to_aud:0;
                                                    $exchange_to_VND = (!empty($exchangeRateFlywireComAgent))?$exchangeRateFlywireComAgent->aud_to_vnd:0;
                                                    $com_in_aud = $com_form_provider * $exchange_to_AUD;
                                                    $com_agent = !empty($obj) && !empty($obj->getComFlywire()) ? $obj->getComFlywire()->comm:0;
                                                    $com_for_agent_aud = $obj->amount_to * ($com_agent /100) * $exchange_to_AUD;
                                                    $promotionAmount = (!empty($obj) && !empty($obj->promotion))?$obj->promotion->amount:0;
                                                    $totalComAgent = $promotionAmount+$com_for_agent_aud;
                                                    $com_for_agent_vnd = $totalComAgent * $exchange_to_VND;
                                                    $profit_aud = $com_in_aud - $com_for_agent_aud;
                                                    $profit_vnd = $profit_aud * $exchange_to_VND;
                                                @endphp
                                                <input type="hidden" name="apply_id" id="apply_id" value="{{(!empty($obj))?$obj->id:''}}">
                                                <input type="hidden" name="profit_id" id="profit_id" value="{{(!empty($profit))?$profit->id:''}}">
                                                <div class="col-md-3">
                                                    <label for="">Com from provider ($)</label>
                                                    <input type="text" id="com_from_provider_cp" onfocus="this.blur()" value="{{!($unitEquals) ? $com_form_provider : 0}}" name="com_from_provider_cp" class="form-control bg-readonly">
                                                </div>
                                                <div class="col-md-3">
                                                    <label for="">Exchange in AUD</label>
                                                    <input type="text" id="exchange_in_aud_cp" onfocus="this.blur()" value="{{!($unitEquals) ? $exchange_to_AUD : 0}}" name="exchange_in_aud_cp" class="form-control bg-readonly">
                                                </div>
                                                <div class="col-md-3">
                                                    <label for="">Com in AUD</label>
                                                    <input type="text" id="com_in_aud_cp" onfocus="this.blur()" value="{{!($unitEquals) ? $com_in_aud : 0}}" name="com_in_aud_cp" class="form-control bg-readonly">
                                                </div>
                                                <div class="col-md-3">
                                                    <label for="">Provider paid date</label>
                                                    <input type="text" value="{{(!empty($profit) && !($unitEquals) )?convert_date_form_db($profit->provider_paid_date_cp):""}}" id="provider_paid_date_cp" name="provider_paid_date_cp" class="form-control choose-date-form">
                                                </div>
                                                <div class="col-md-3">
                                                    <label for="">Com agent %</label>
                                                    <input type="text" value="{{!($unitEquals) ? $com_agent : 0}}" id='com_agent_cp' name="com_agent_cp" class="form-control" readonly>
                                                </div>
                                                <div class="col-md-3">
                                                    <label for="">Com agent AUD</label>
                                                    <input type="text" onfocus="this.blur()" value="{{(!empty($com_for_agent_aud) && !($unitEquals) )?$com_for_agent_aud:0}}" id="com_for_agent_aud_cp" name="com_for_agent_aud_cp" class="form-control bg-readonly" readonly>
                                                </div>
                                                <div class="col-md-3">
                                                    <label for="">Promotion</label>
                                                    <input type="text" onfocus="this.blur()" value="{{!($unitEquals) ? $promotionAmount : 0}}" id="" name="" class="form-control bg-readonly" readonly>
                                                </div>
                                                <div class="col-md-3">
                                                    <label for="">Unit</label>
                                                    <input type="text" onfocus="this.blur()" value="{{(!empty($obj) && !empty($obj->promotion))?$obj->promotion->getUnit():''}}" id="" name="" class="form-control bg-readonly" readonly>
                                                </div>
                                                <div class="col-md-3">
                                                    <label for="">Total com agent AUD</label>
                                                    <input type="text" onfocus="this.blur()" value="{{!($unitEquals) ? $totalComAgent : 0}}" id="total_com_agent_aud" name="" class="form-control bg-readonly" readonly>
                                                </div>
                                                <div class="col-md-3">
                                                    <label for="">Exchange rate (AUD/VND)</label>
                                                    <input type="text" value="{{!($unitEquals) ? $exchange_to_VND : 0}}" id="exchange_rate_cp" name="exchange_rate_cp" class="form-control" readonly>
                                                </div>
                                                <div class="col-md-3">
                                                    <label for="">Com agent VND</label>
                                                    <input type="text" onfocus="this.blur()" value="{{!($unitEquals) ? $com_for_agent_vnd : 0}}" id="com_for_agent_vnd_cp" name="com_for_agent_vnd_cp" class="form-control bg-readonly">
                                                </div>
                                                <div class="col-md-3">
                                                    <label for="">Paid com date (agent)</label>
                                                    <input type="text" value="{{(!empty($profit) && $unitEquals == false )?convert_date_form_db($profit->paid_com_date_agent_cp):''}}" id="paid_com_date_agent_cp" name="paid_com_date_agent_cp" class="form-control choose-date-form">
                                                </div>
                                                <div class="col-md-3">
                                                    <label for="">Com status</label>
                                                    <select class="form-control" name="com_status_cp" id="com_status_cp">
                                                        @foreach(\Config::get('myconfig.com_status') as $key=>$one)
                                                            <option value="{{$key}}" {{(!empty($profit)) && $profit->com_status_cp == $key?'selected':''}}>{{$one}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-md-3">
                                                    <label for="">Profit AUD</label>
                                                    <input type="text" onfocus="this.blur()" value="{{!($unitEquals) ? $profit_aud : 0}}" id="profit_aud_cp" name="profit_aud_cp" class="form-control bg-readonly">
                                                </div>
                                                <div class="col-md-3">
                                                    <label for="">Profit (VND)</label>
                                                    <input type="text" onfocus="this.blur()" value="{{!($unitEquals) ? $profit_vnd : 0}}" id="profit_vnd_cp" name="profit_vnd_cp" class="form-control bg-readonly">
                                                </div>
                                                <div class="col-md-3">
                                                    <label for="">Staff</label>
                                                    <select class="form-control" name="staff_id_cp" id="staff_id_cp">
                                                        <option value="">Select</option>
                                                        @foreach($staffs as $staff)
                                                            @if(!empty($profit) && $profit->staff_id_cp == $staff->id)
                                                                <option value="{{$staff->id}}" {{!empty($profit) && $profit->staff_id_cp == $staff->id?'selected':''}}>{{$staff->admin_id}}</option>
                                                            @elseif(\Illuminate\Support\Facades\Auth::user()->id == $staff->id)
                                                                <option value="{{$staff->id}}" {{\Illuminate\Support\Facades\Auth::user()->id == $staff->id?'selected':''}}>{{$staff->admin_id}}</option>
                                                            @else
                                                                <option value="{{$staff->id}}" {{!empty($profit) && $profit->staff_id_cp == $staff->id?'selected':''}}>{{$staff->admin_id}}</option>
                                                            @endif
                                                        @endforeach
                                                    </select>
                                                    {{-- <p>{{(!empty($profit))?$profit->getStaffName():\Auth::user()->username}}</p>
                                                    <input type="hidden" value="{{(!empty($profit))?$profit->staff_id_cp:\Auth::user()->id}}" id="staff_id_cp" name="staff_id_cp" class="form-control"> --}}
                                                </div>
                                                <div class="col-md-3">
                                                    <div>
                                                        <label for="">Look payment form</label>
                                                    </div>
                                                    <div>
                                                        <input type="checkbox" id="look_payment_form" name="look_payment_form" class="form-check-input" id="lookPayment"{{(!empty($profit)) && $profit->look_payment_form ?'checked':''}}>
                                                        <label class="form-check-label" for="lookPayment">Lock</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <label for="">Note</label>
                                                    <textarea type="text" value="" name="note_cp" rows="3" class="form-control" id="note_cp">{{(!empty($profit))?$profit->note_cp:''}}</textarea>
                                                </div>
                                            </div>
                                            {{--</form>--}}
                                        </div>
                                        <div class="form-submit clearfix tab-form-1 mt-3">
                                            <div class="bottom-submit">
                                                @can('flywire.commissionAndProfit.store')
                                                    <button class="btn btn-falcon-default btn-sm mr-1 mb-1" type="button" data-click='click' data-type='{{(!empty($profit))?'update':'create'}}' id="btn_add_com_and_profit">
                                                        <span class="fas fa-plus mr-1" data-fa-transform="shrink-3"></span> {{(!empty($profit))?'Update':'Save'}}
                                                    </button>
                                                @endcan
                                                <a class="btn btn-falcon-default btn-sm mr-1 mb-1" href="{{route('flywire.index')}}">Back</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        @include('CRM.partials.js.number_currency_format',['ids'=>[
                'com_from_provider_cp',
                'exchange_in_aud_cp',
                'com_in_aud_cp',
                'com_for_agent_aud_cp',
                'profit_aud_cp',
                'com_agent_cp',
                'total_com_agent_aud'
            ],
            'nameFunction'=>'callDigitFormat']);

        @include('CRM.partials.js.number_vnd_format',[
    'ids'=>[
            'com_for_agent_vnd_cp',
            'profit_vnd_cp',
            'exchange_rate_cp'
        ],
        'nameFunction'=>'callVndFormat'
        ])

        <script>

            flatpickr('#provider_paid_date_cp', {dateFormat : 'd/m/Y', allowInput : true})
            flatpickr('#paid_com_date_agent_cp', {dateFormat : 'd/m/Y', allowInput : true})

            // $(document).on('mouseover', '.choose-date-form', function () {
            //     let start_date_class = $(this).hasClass('flatpickr-input')
            //     if (!start_date_class) {
            //         $(this).flatpickr({
            //             dateFormat: 'd/m/Y',
            //         })
            //     }
            // })

        </script>
        <script>


            function convertStringCurrencyToNumber(string) {
                if (string == null || string == '') {
                    string = ''
                } else {
                    string = string.replace(' VND', '')
                    string = string.replace(/,/g, '')
                }
                return string
            }

            function convertNumberToCurrency(number) {
                var currency = number.toLocaleString(
                    undefined, // leave undefined to use the browser's locale,
                    // or use a string like 'en-US' to override it.
                    { minimumFractionDigits: 2 },
                )
                return currency
            }

            $('#com_for_agent_vnd_cp').on('mouseover', function () {
                $(this).attr('readonly', 'readonly')
            }).on('mouseleave', function () {
                $(this).removeAttr('readonly')
            })
            $('#com_for_agent_aud_cp').on('mouseover', function () {
                $(this).attr('readonly', 'readonly')
            }).on('mouseleave', function () {
                $(this).removeAttr('readonly')
            })
            $('#profit_aud_cp').on('mouseover', function () {
                $(this).attr('readonly', 'readonly')
            }).on('mouseleave', function () {
                $(this).removeAttr('readonly')
            })
            $('#profit_vnd_cp').on('mouseover', function () {
                $(this).attr('readonly', 'readonly')
            }).on('mouseleave', function () {
                $(this).removeAttr('readonly')
            })
            $('#com_in_aud_cp').on('mouseover', function () {
                $(this).attr('readonly', 'readonly')
            }).on('mouseleave', function () {
                $(this).removeAttr('readonly')
            })

            function calcOnChangeRate() {
                let com_for_agent_aud_cp = convertStringCurrencyToNumber($('#com_for_agent_aud_cp').val())
                let exchange_rate_cp = convertStringCurrencyToNumber($('#exchange_rate_cp').val())
                let com_for_agent_vnd_cp = $('#com_for_agent_vnd_cp')
                let calc_com_for_agent_vnd_cp = com_for_agent_aud_cp * exchange_rate_cp
                let profit_vnd_cp = $('#profit_vnd_cp')
                let profit_aud_cp = convertStringCurrencyToNumber($('#profit_aud_cp').val())
                let calc_profit_vnd_cp = profit_aud_cp * exchange_rate_cp
                com_for_agent_vnd_cp.val(convertNumberToCurrency(calc_com_for_agent_vnd_cp))
                profit_vnd_cp.val(convertNumberToCurrency(calc_profit_vnd_cp))
            }

            function calcProfit() {
                let com_from_provider_cp = convertStringCurrencyToNumber($('#com_from_provider_cp').val())
                let exchange_in_aud_cp = convertStringCurrencyToNumber($('#exchange_in_aud_cp').val())
                let calc_com_in_aud_cp = com_from_provider_cp * exchange_in_aud_cp
                let com_in_aud_cp = $('#com_in_aud_cp')
                let com_for_agent_aud_cp = $('#com_for_agent_aud_cp')
                let com_agent_cp = $('#com_agent_cp').val()
                let calc_com_for_agent_aud_cp = com_from_provider_cp * com_agent_cp / 100 * exchange_in_aud_cp
                let profit_aud_cp = $('#profit_aud_cp')
                let calc_profit_aud_cp = calc_com_in_aud_cp - calc_com_for_agent_aud_cp
                com_for_agent_aud_cp.val(calc_com_for_agent_aud_cp)
                com_in_aud_cp.val(convertNumberToCurrency(calc_com_in_aud_cp))
                profit_aud_cp.val(convertNumberToCurrency(calc_profit_aud_cp))
            }

            // calcOnChangeRate();
            // calcProfit();
            // $(document).on('change','#provider_paid_date_cp',function(e){
            //     let date = $(this).val();
            //     $.ajax({
            //         url:'{{route("flywires.process.get_exchange_rate_date")}}',
            //         type:'post',
            //         data:{
            //             'date':date,
            //             '_token':'{{csrf_token()}}'
            //         },
            //         success:function(data){
            //             $('#exchange_rate_cp').val(data);
            //             calcOnChangeRate();
            //         }
            //     })
            // })

            $(document).on('change', '#com_from_provider_cp , #exchange_in_aud_cp', function (e) {
                let com_from_provider_cp = convertStringCurrencyToNumber($('#com_from_provider_cp').val())
                let exchange_in_aud_cp = convertStringCurrencyToNumber($('#exchange_in_aud_cp').val())
                let calc_com_in_aud_cp = com_from_provider_cp * exchange_in_aud_cp
                let com_in_aud_cp = $('#com_in_aud_cp')
                let com_for_agent_aud_cp = $('#com_for_agent_aud_cp')
                let com_agent_cp = $('#com_agent_cp').val()
                let calc_com_for_agent_aud_cp = com_from_provider_cp * com_agent_cp / 100 * exchange_in_aud_cp
                let profit_aud_cp = $('#profit_aud_cp')
                let calc_profit_aud_cp = calc_com_in_aud_cp - calc_com_for_agent_aud_cp
                com_for_agent_aud_cp.val(calc_com_for_agent_aud_cp)
                com_in_aud_cp.val(convertNumberToCurrency(calc_com_in_aud_cp))
                profit_aud_cp.val(convertNumberToCurrency(calc_profit_aud_cp))
            })
            $(document).on('change', '#com_for_agent_aud_cp , #exchange_rate_cp', function (e) {
                let com_for_agent_aud_cp = convertStringCurrencyToNumber($('#com_for_agent_aud_cp').val())
                let exchange_rate_cp = convertStringCurrencyToNumber($('#exchange_rate_cp').val())
                let com_for_agent_vnd_cp = $('#com_for_agent_vnd_cp')
                let calc_com_for_agent_vnd_cp = com_for_agent_aud_cp * exchange_rate_cp
                let profit_vnd_cp = $('#profit_vnd_cp')
                let profit_aud_cp = convertStringCurrencyToNumber($('#profit_aud_cp').val())
                let calc_profit_vnd_cp = profit_aud_cp * exchange_rate_cp
                com_for_agent_vnd_cp.val(convertNumberToCurrency(calc_com_for_agent_vnd_cp))
                profit_vnd_cp.val(convertNumberToCurrency(calc_profit_vnd_cp))
            })
            $(document).on('click', '#btn_add_com_and_profit', function (e) {
                e.preventDefault()
                let com_from_provider_cp = convertStringCurrencyToNumber($('#com_from_provider_cp').val())
                let exchange_in_aud_cp = convertStringCurrencyToNumber($('#exchange_in_aud_cp').val())
                let com_in_aud_cp = convertStringCurrencyToNumber($('#com_in_aud_cp').val())
                let provider_paid_date_cp = $('#provider_paid_date_cp').val()
                let com_agent_cp = $('#com_agent_cp').val()
                let com_for_agent_aud_cp = convertStringCurrencyToNumber($('#com_for_agent_aud_cp').val())
                let exchange_rate_cp = convertStringCurrencyToNumber($('#exchange_rate_cp').val())
                let com_for_agent_vnd_cp = convertStringCurrencyToNumber($('#com_for_agent_vnd_cp').val())
                let paid_com_date_agent_cp = $('#paid_com_date_agent_cp').val()
                let com_status_cp = $('#com_status_cp').val()
                let profit_aud_cp = convertStringCurrencyToNumber($('#profit_aud_cp').val())
                let profit_vnd_cp = convertStringCurrencyToNumber($('#profit_vnd_cp').val())
                let staff_id_cp = $('#staff_id_cp').val()
                let note_cp = $('#note_cp').val()
                let apply_id = $('#apply_id').val()
                let type_request = $(this).data('type')
                let profit_id = $('#profit_id').val()
                let look_payment_form = $('#look_payment_form:checked').length
                let click = $(this).data('click')
                let status = $('input[name="invoice_status"]:checked').val()

                //console.log(status);
                //return ;
                if (click == 'click') {
                    $(this).attr('data-click', 'clicked')
                    $.ajax({
                        url: "{{route('flywires.process.com_and_profit')}}",
                        type: 'post',
                        data: {
                            'com_from_provider_cp': com_from_provider_cp,
                            'exchange_in_aud_cp': exchange_in_aud_cp,
                            'com_in_aud_cp': com_in_aud_cp,
                            'provider_paid_date_cp': provider_paid_date_cp,
                            'com_agent_cp': com_agent_cp,
                            'com_for_agent_aud_cp': com_for_agent_aud_cp,
                            'exchange_rate_cp': exchange_rate_cp,
                            'com_for_agent_vnd_cp': com_for_agent_vnd_cp,
                            'paid_com_date_agent_cp': paid_com_date_agent_cp,
                            'com_status_cp': com_status_cp,
                            'profit_aud_cp': profit_aud_cp,
                            'profit_vnd_cp': profit_vnd_cp,
                            'staff_id_cp': staff_id_cp,
                            'note_cp': note_cp,
                            'apply_id': apply_id,
                            '_token': '{{csrf_token()}}',
                            'type_request': type_request,
                            'profit_id': profit_id,
                            'look_payment_form': look_payment_form,
                            'status': status,
                        },
                        success: function (data) {
                            if (data.success == 1) {
                                Swal.fire(
                                    'Success',
                                    'Create success',
                                    'success',
                                )
                            } else if (data.success == 2) {
                                Swal.fire(
                                    'Success',
                                    'Update success',
                                    'success',
                                )
                            }
                            //window.location.reload();
                            $(this).attr('data-click', 'click')
                        },
                    })
                } else if (click == 'clicked') {
                    return
                }
            })
        </script>
    @endpush

@stop
