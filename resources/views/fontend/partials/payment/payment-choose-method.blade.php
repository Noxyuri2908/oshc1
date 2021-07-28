<span class="how-chose">
		{!! get_content($payment_section_2) !!}
	</span>
<div id="payment-check">
    <h3>@lang('header.payment_menthod')</h3>
    <div class="list-step-payment">
        <ul class="nav nav-pills d-flex">
            <li class="nav-item active">
                <a class="nav-link" data-toggle="pill" href="#step1">1. {!! get_content($payment_section_3) !!}</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="pill" href="#step2">2. {!! get_content($payment_section_4) !!}</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="pill" href="#step3">3. {!! get_content($payment_section_5) !!}</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="pill" href="#step4">4. Flywire</a>
            </li>
        </ul>

        <!-- Tab panes -->
        <div class="tab-content">
            <div class="tab-pane active" id="step1">
                <div class="content-step1">
                    <h4>{{ get_name($payment_section_6) }}</h4>
                    {!! get_content($payment_section_6) !!}
                </div>
                <!-- Modal -->
{{--                data-toggle="modal" data-target="#chose-banks"--}}
{{--                <div class="d-flex overflow-hidden">--}}
{{--                    <a href="{{route('payment.tranfer')}}" class="btn buy d-table" target="_blank">Pay by Telegraphic (Wire) Transfer</a>--}}
{{--                </div>--}}
                <button type="button" class="btn btn-md buy payment-tranfer" style="width: auto;">Pay by Telegraphic (Wire) Transfer</button>

{{--                <div id="chose-banks" class="modal fade" role="dialog">--}}
{{--                    <div class="modal-dialog">--}}

{{--                        <!-- Modal content-->--}}
{{--                        <div class="modal-content">--}}
{{--                            <div class="modal-header">--}}
{{--                                <button type="button" class="close" data-dismiss="modal"><i class="fa fa-times-circle"--}}
{{--                                                                                            aria-hidden="true"></i>--}}
{{--                                </button>--}}
{{--                                <h4 class="modal-title">Choose a bank</h4>--}}
{{--                            </div>--}}
{{--                            <div class="modal-body">--}}
{{--                                <div class="form-group">--}}
{{--                                    <label>Choose a bank from list bank</label>--}}
{{--                                    <select name="list_bank_sel" id="list_bank_sel" class="form-control" required="">--}}
{{--                                        @if(\Session::get('country',0) == 'VN')--}}
{{--                                            <option value="scb" selected>--}}
{{--                                                TMCP Sài Gòn (SCB) – Chi nhánh Bến Thành--}}
{{--                                            </option>--}}
{{--                                            <option value="eximbank">--}}
{{--                                                TMCP Xuất Nhập Khẩu (Eximbank)-Chi nhánh HCM--}}
{{--                                            </option>--}}
{{--                                            <option value="anz">--}}
{{--                                                ANZ Bank, Australia.--}}
{{--                                            </option>--}}
{{--                                        @else--}}
{{--                                            <option value="anz">--}}
{{--                                                ANZ Bank, Australia.--}}
{{--                                            </option>--}}
{{--                                        @endif--}}
{{--                                    </select>--}}
{{--                                </div>--}}
{{--                                <div class="info-bank-selected">--}}
{{--                                    <div class="bank-item">--}}
{{--                                        <div class="avatar-bank">--}}
{{--                                            <img src="{{$apply->provider->image}}">--}}
{{--                                        </div>--}}
{{--                                        <div class="bottom">--}}
{{--                                            <span class="price">{{convert_price_float($apply->net_amount)}} AUD</span>--}}
{{--                                            <button type="button" class="buy ">Continue</button>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}

{{--                    </div>--}}
{{--                </div>--}}
            </div>
            <div class="tab-pane fade" id="step2">
                <div class="content-step2">
                    <table class="table table-bordered">
                        <tr>
                            <td class="tg-cly1">Premium:</td>
                            <td class="tg-cly2 grey">{{convert_price_float($apply->net_amount)}} AUD</td>
                        </tr>
                        @if(isset($price_comm) && $price_comm != 0)
                            <tr>
                                <td class="tg-cly1">Commission (include GST):</td>
                                <td class="tg-cly2 grey">{{convert_price_float($price_comm)}} AUD</td>
                            </tr>
                        @endif
                        @if(isset($price_gst) && $price_gst != 0)
                            <tr>
                                <td class="tg-cly1">GST:</td>
                                <td class="tg-cly2 grey">{{$price_gst}} AUD</td>
                            </tr>
                        @endif
                        <tr>
                            <td class="tg-cly1">Surcharge (3%):</td>
                            <td class="tg-cly2 grey">{{convert_price_float($price_su)}} AUD</td>
                        </tr>
                        <tr>
                            <td class="tg-cly1">Total to pay:</td>
                            <td class="tg-cly2 grey">{{convert_price_float($total)}} AUD</td>
                        </tr>
                    </table>
                    <button onclick="window.location.href='{{route('method.paypal',['id'=>$apply->id])}}'"
                            class="send-f">@lang('header.buy_now')</button>
                </div>
            </div>
            <div class="tab-pane fade" id="step3">
                <div class="content-step2">
                    <table class="table table-bordered">
                        <tr>
                            <td class="tg-cly1">Premium:</td>
                            <td class="tg-cly2 grey">{{convert_price_float($apply->net_amount)}} AUD</td>
                        </tr>
                        @if(isset($price_comm) && $price_comm != 0)
                            <tr>
                                <td class="tg-cly1">Commission (include GST):</td>
                                <td class="tg-cly2 grey">{{convert_price_float($price_comm)}} AUD</td>
                            </tr>
                        @endif
                        @if(isset($price_gst) && $price_gst != 0)
                            <tr>
                                <td class="tg-cly1">GST:</td>
                                <td class="tg-cly2 grey">{{$price_gst}} AUD</td>
                            </tr>
                        @endif
                        <tr>
                            <td class="tg-cly1">Surcharge (3%):</td>
                            <td class="tg-cly2 grey">{{convert_price_float($price_su)}} AUD</td>
                        </tr>
                        <tr>
                            <td class="tg-cly1">Total to pay:</td>
                            <td class="tg-cly2 grey">{{convert_price_float($total)}} AUD</td>
                        </tr>
                    </table>
                    <button onclick="window.location.href='{{route('method.credit',['id'=>$apply->id])}}'"
                            class="send-f">@lang('header.buy_now')</button>
                </div>
            </div>
            <div class="tab-pane fade" id="step4">
                <div class="content-step2">
                    <table class="table table-bordered">
                        <tr>
                            <td class="tg-cly1">Premium:</td>
                            <td class="tg-cly2 grey">{{convert_price_float($apply->net_amount)}} AUD</td>
                        </tr>
                        @if(isset($price_comm) && $price_comm != 0)
                            <tr>
                                <td class="tg-cly1">Commission (include GST):</td>
                                <td class="tg-cly2 grey">{{convert_price_float($price_comm)}} AUD</td>
                            </tr>
                        @endif
                        @if(isset($price_gst) && $price_gst != 0)
                            <tr>
                                <td class="tg-cly1">GST:</td>
                                <td class="tg-cly2 grey">{{$price_gst}} AUD</td>
                            </tr>
                        @endif
                        <tr>
                            <td class="tg-cly1">Surcharge (3%):</td>
                            <td class="tg-cly2 grey">{{convert_price_float($price_su)}} AUD</td>
                        </tr>
                        <tr>
                            <td class="tg-cly1">Total to pay:</td>
                            <td class="tg-cly2 grey">{{convert_price_float($total)}} AUD</td>
                        </tr>
                    </table>
                    <button id="pay_flywire" class="send-f" >@lang('header.buy_now')</button>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="list-control-btn">
    <button onclick="window.location.href='{{route('apply.get',['id'=>$apply->id])}}'"
            class="submit-step btn-payment">@lang('header.back to your details')</button>
    <button onclick="window.location.href='{{route('home')}}'"
            class="back-step btn-payment">@lang('header.cancel')</button>
</div>
@push('scripts')
    <script src="https://checkout.flywire.com/flywire-payment.js"></script>
    <script>
        $('.nav-link').matchHeight();
        $('.btn-payment').matchHeight();
        document.querySelector("#pay_flywire")
             .addEventListener("click", function (e) {
                 e.preventDefault();
                 var config = {
                    amount: {{$total}},

                    // Be sure to change both these values when switching between demo and prod
                    env: "production",
                    recipientCode: "OSH",

                    // Recommended settings
                    requestPayerInfo: true,
                    requestRecipientInfo: false,
                    skipCompletedSteps: true,

                    onInvalidInput: function (errors) {
                        errors.forEach(function(error) {
                            // Supply your own error reporting rather than alert boxes
                            alert(error.msg);
                        });
                    },

                    // From the information collected on the policy page
                    firstName: "{{!empty($customerRegister)?$customerRegister->first_name:''}}",
                    lastName: "{{!empty($customerRegister)?$customerRegister->last_name:''}}",
                    email: "{{!empty($customerRegister)?$customerRegister->email:''}}",
                    phone: "{{!empty($customerRegister)?$customerRegister->phone:''}}",
                    address: "",
                    city: "",
                    country: "{{!empty($customerRegister)?$customerRegister->country:''}}",

                    // Ensure all these values are supplied
                    recipientFields: {
                        policy_invoice_number: "{{$apply->ref_no}}",
                        policy_provider: "{{$apply->getProviderName()}}",
                        policy_start_date: "{{$apply->start_date}}",
                        policy_end_date: "{{$apply->end_date}}",
                        policy_number_of_adults: "{{$apply->no_of_adults}}",
                        policy_number_of_children: "{{$apply->no_of_children}}"
                    },

                    // Prevent payers from modifying the values
                    readonlyFields: [
                        "policy_invoice_number",
                        "policy_provider",
                        "policy_start_date",
                        "policy_end_date",
                        "policy_number_of_adults",
                        "policy_number_of_children",
                    ],

                    // Supply your own return page
                    returnUrl: "{{route('payment.flywire.order.success',['id'=>$apply->id])}}",

                    // Include these values if you intend to process Flywire server-to-server notifications (see documentation)
                    callbackId: "",
                    callbackUrl: ""
                };
                 var modal = window.FlywirePayment.initiate(config);
                 modal.render();
             });
    </script>
@endpush
