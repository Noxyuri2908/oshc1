@extends('CRM.layouts.default')

@section('title')
    CREATE FLYWIRE
    @parent
@stop

@section('css')
    @include('CRM.partials.css-list')
    @include('CRM.pages.css.customer-css')
    <style>
        .user-information .modal-content {
            border: 2px solid #1a68d1;
            border-radius: 0;
        }


        .user-information .modal-header {
            background-color: #1a68d1;
            border-bottom: 1px solid #fff;
            border-radius: 0;
        }

        .user-information .modal-header h5,
        .user-information .modal-header .close {
            color: #fff;
        }


        .content-information h3.name {
            font-size: 24px;
            font-weight: 600;
            color: #1a68d1;
            padding-bottom: 5px;
            border-bottom: 1px solid #cadbef;
        }

        .content-information .form-group .control-label {
            width: 100%;
            float: none;
            color: #5e6e82;
            font-size: 13.33px;
        }

        .content-information .form-group input {
            width: 100%;
            border: 1px solid #d8e2ef;
            font-size: 1rem;
            font-weight: 300;
            color: #6c8bb5;
            padding: 0.2rem .5rem;
            border-radius: 0.25rem;
        }

        .delete-controlog .modal-content {
            border-radius: 5px;
        }

        .delete-controlog .modal-content .modal-body {
            text-align: center;
        }

        .delete-controlog .modal-title {
            font-size: 24px;
            font-weight: 600;
            color: #1a68d1;

        }

        .delete-controlog .comment-d {
            padding: 15px;
            width: 80%;
            margin: auto;
            background-color: #4b98ff;
            margin-top: 15px;
            margin-bottom: 15px;
            border: 1px solid #1967d1;
            border-radius: 9px;
        }

        .delete-controlog .comment-d p {
            margin-bottom: 0;
            font-size: 14px;
            color: #fff;
        }

        .delete-controlog .button-contenr .yes {
            background-color: #2c7be5;
            border-color: #2c7be5;
        }

        .delete-controlog .button-contenr .yes:hover {
            background-color: #1a68d1;
            border-color: #1862c6;
        }

        .delete-controlog .button-contenr .no {
            background-color: #f50000;
            border: 1px solid #f50000;
        }

        .delete-controlog .button-contenr .no:hover {
            background-color: #dc0000;
            border-color: #dc0000;

        }

        .delete-controlog .form-group {
            text-align: left;
        }

        .delete-controlog .form-group #email-example {
            width: 100%;
            border: 1px solid #d8e2ef;
            font-size: 1rem;
            font-weight: 300;
            color: #6c8bb5;
            padding: 0.2rem .5rem;
            border-radius: 0.25rem;
        }

        .delete-controlog .form-group #email-example option {
            font-weight: 300;
        }

        .thong-tin-user {
            position: absolute;
            left: 0;
            right: 0;
            -webkit-transform: translateY(100%);
            -ms-transform: translateY(100%);
            transform: translateY(100%);
            bottom: 0;
            padding-top: 2px;
            padding-bottom: 2px;
        }

        .thong-tin-user h2 {
            font-size: 29px;
            margin-bottom: 0;
        }

        .thong-tin-user p {
            margin: 0;
            font-size: 15px;
        }

        .chevron-down-up {
            position: relative;
        }

        .chevron-down-up .click-down {
            margin-bottom: 0px;
            position: absolute;
            right: 0;
            font-size: 11px;
            top: 0;
            /*	    color: #344050;*/
            cursor: pointer;
            padding: 2px 6px;
        }

        .dang-ky-new {
            margin-top: 10px;
        }

        .dang-ky-submit,
        .dang-ky-restart {
            font-size: 15px;
            padding: 3px 13px;
            border-radius: 5px;
            color: #fff;
            background-color: #f50000;
            border: 1px solid #f50000;
        }

        .dang-ky-submit {
            background-color: #2c7be5;
            border-color: #2c7be5;
            box-shadow: none;
        }

        .dang-ky-submit:hover {
            background-color: #1a68d1;
            border-color: #1862c6;

        }

        .dang-ky-restart:hover {
            background-color: #dc0000;
            border-color: #dc0000;
        }

        @media (max-width: 767px) {
            .card-header.position-relative {
                padding: 0;
            }

            .cover-image .rounded-soft {
                position: static;
                min-height: 210px;
            }

            .avatar-profile {
                left: 10px;
                -webkit-transform: translateY(12%);
                -ms-transform: translateY(12%);
                transform: translateY(12%);
            }

            .thong-tin-user {
                position: static;
                -webkit-transform: translateY(140%);
                -ms-transform: translateY(140%);
                transform: translateY(140%);
            }
        }

        @media (max-width: 500px) {
            .card-header.position-relative {
                margin-bottom: 165px !important;
            }
        }

        @media (min-width: 768px) {
            .thong-tin-user .offset-lg-2 {
                margin-left: 24.66667%;
            }

            .thong-tin-user .col-lg-10 {
                max-width: 75.33333%;
                flex: 0 0 75.33333%;
                -ms-flex: 0 0 75.33333%;
            }
        }

        @media (min-width: 1200px) {
            .thong-tin-user .offset-lg-2 {
                margin-left: 22.66667%;
            }

            .thong-tin-user .col-lg-10 {
                max-width: 77.33333%;
                flex: 0 0 77.33333%;
                -ms-flex: 0 0 77.33333%;
            }
        }

        @media (min-width: 1599px) {
            .thong-tin-user .offset-lg-2 {
                margin-left: 11.66667%;
            }

            .thong-tin-user .col-lg-10 {
                max-width: 88.33333%;
                flex: 0 0 88.33333%;
                -ms-flex: 0 0 88.33333%;
            }
        }
    </style>
@stop
@section('content')

    <form id="flywire-form" action="{{(!empty($obj))?route('flywire.update',['id' => $obj->id,'page'=>$page]):route('flywire.store')}}" method="POST" role="form">
        @if(!empty($obj))
            {{ method_field('PUT') }}
        @endif
        @csrf

        <div class="row">
            <div class="col-12">
                <div class="card mb-3 btn-reveal-trigger">
                    <div class="card-header position-relative minh-25vh mb-8">
                        <div class="cover-image">
                            <div class="bg-holder rounded-soft rounded-bottom-0" style="background-image:url({{asset('backend_CRM/pages/assets/img/slider1.jpg')}});">
                            </div>
                        </div>
                        <div class="avatar avatar-5xl avatar-profile shadow-sm img-thumbnail rounded-circle">
                            <div class="h-100 w-100 rounded-circle overflow-hidden position-relative">
                                <img src="{{asset('backend_CRM/pages/assets/img/new.png')}}" width="200" alt="">
                            </div>
                        </div>
                        <div class="thong-tin-user">
                            <div class="offset-md-2 col-md-10 offset-lg-2 col-lg-10 offset-sm-3 col-sm-9 offset-xs-4 col-xs-8">
                                <h2>{{!empty($obj) ?'Edit invoice':'New invoice'}}</h2>
                                <p><i>{{!empty($obj) ?'Edit invoice ':'Create new invoice'}}</i></p>
                            </div>
                            <div class="offset-md-10 col-md-10 offset-lg-2 col-lg-10 offset-sm-3 col-sm-9 offset-xs-4 col-xs-8 dang-ky-new">
                                @if(!empty($obj))
                                    @if(!empty($obj->profit) && !empty($obj->profit->first()->look_payment_form) && $obj->profit->first()->look_payment_form != 1)
                                        <button type="submit" class="dang-ky-submit">Update</button>

                                    @elseif(!empty($obj->profit) &&  !empty($obj->profit->first()->look_payment_form) &&  $obj->profit->first()->look_payment_form == 1)

                                    @else
                                        <button type="submit" class="dang-ky-submit">Update</button>
                                    @endif
                                @else
                                    <button type="submit" class="dang-ky-submit">Create</button>
                                @endif
                                <a href="{{route('flywire.index')}}" class="text-decoration-none dang-ky-restart">Close</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @if(session('error-create-flywire'))
            <div class="alert alert-danger">
                <strong>{{session('error-create-flywire')}}</strong>
            </div>
        @endif
        @if(session('success-create-flywire'))
            <div class="alert alert-success">
                <strong>{{session('success-create-flywire')}}</strong>
            </div>
        @endif

        <div class="row no-gutters">
            <div class="col-md-12">
                <div class="card mb-3">
                    <div class="card-header">
                        <div class="chevron-down-up">
                            <h5 class="mb-0">Payment info</h5>
                            <p class="click-down" data-id="account"><span class="fas fa-chevron-down"></span></p>
                            @if ($errors->any())
                                <ul class="alert alert-danger">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            @endif
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <input type="hidden" name="provider_id" id="provider_id" value="{{!empty($provider)?$provider:''}}">
                            <input type="hidden" name="type_service" id="type_service" value="{{!empty($dichvu_id)?$dichvu_id:''}}">
                            <div class="col-md-3">
                                <label for="">Invoice Code OSHC</label>
                                <input type="text" class="form-control" name="invoice_code_link" value="{{(!empty($obj))? $obj->invoice_code_link:'' }}">
                            </div>
                            <div class="col-md-3">
                                <label for="">Type of payment</label>
                                <select class="form-control" name="type_of_payment_fw" id="">
                                    <option value="">Select</option>
                                    @foreach($dichvus as $one)
                                        <option value="{{$one->id}}" {{(!empty($obj)) && $obj->type_of_payment_fw == $one->id ? 'selected' : ''}} >{{$one->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label for="">Payment ID</label>
                                <input type="text" autocomplete="off" class="form-control" name="ref_no" value="{{(!empty($obj))?$obj->ref_no:''}}" required>
                            </div>
                            <div class="col-md-3">
                                <label for="">Invoice ID</label>
                                <input type="text" autocomplete="off" class="form-control" name="invoice_code" value="{{(!empty($obj))?$obj->invoice_code:''}}">
                            </div>
                            <div class="col-md-3 agent_id_select2">
                                <label for="">Agent</label>
                                <select class="form-control" id="agent_id" name="agent_id">

                                </select>
                            </div>
                            <div class="col-md-3">
                                <label for="">Full Name</label>
                                <input type="text" class="form-control" name="full_name" value="{{(!empty($obj))?$obj->getFullNameCus():''}}" required>
                            </div>
                            <div class="col-md-3">
                                <label for="">Email</label>
                                <input type="email" class="form-control" name="email" value="{{(!empty($obj))?$obj->getEmailCus():''}}" required>
                            </div>
                            <div class="col-md-3">
                                <label for="status">Payment Status</label>
                                <select class="form-control" id="status" name="status" required>
                                    <option label=""></option>
                                    @foreach($paymentStatus as $key=>$value)
                                        @if(!isset($obj))
                                            <option value="{{$key}}" {{old('status') == $key ? 'selected' : ''}}>{{$value}}</option>
                                        @else
                                            <option value="{{$key}}" {{$obj->status == $key ? 'selected' : ''}}>{{$value}}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="prefix_name">Gender</label>
                                    <select class="form-control" id="gender" name="gender">
                                        @foreach($typeGender as $key=>$value)
                                            @if(!isset($cus))
                                                <option value="{{$key}}" {{request()->get('gender') == $key ? 'selected' : ''}}>{{$value}}</option>
                                            @else
                                                <option value="{{$key}}" {{$cus->gender == $key ? 'selected' : ''}}>{{$value}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Mobile No</label>
                                    <input class="form-control" id="phone" name="phone" value="{{(!empty($obj) && !empty($obj->registerCus()))?$obj->registerCus()->phone:''}}" type="text" placeholder="">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Date of birth</label>
                                    <input autocomplete="off" class="form-control open-jquery-date" id="birth_of_date" name="birth_of_date" value="{{(!empty($obj) && !empty($obj->registerCus()))?convert_date_form_db( $obj->registerCus()->birth_of_date):''}}" data-options='{"dateFormat":"d/m/Y"}'>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>School</label>
                                    <select class="form-control" name="school_id" id="school_id" required>
                                        <option value="">Select</option>
                                        @foreach($schools as $key=>$school)
                                            <option value="{{$key}}" {{(!empty($cus)) && $cus->place_study == $key?'selected':''}}>{{$school}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Std ID</label>
                                    <input type="text" name="std_id" class="form-control" value="{{(!empty($obj))?$obj->std_id:''}}">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Nationality</label>
                                    <select class="form-control" id="country" name="country" required>
                                        @foreach($countries as $key=>$value)
                                            @if(!isset($obj))
                                                <option value="{{$key}}" {{request()->get('country') == $key ? 'selected' : ''}}>{{$value}}</option>
                                            @else
                                                <option value="{{$key}}" {{!empty($obj->registerCus()) && $obj->registerCus()->country == $key ? 'selected' : ''}}>{{$value}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Amount from</label>
                                    <input type="text" id="amount_from" name="amount_from" class="form-control" value="{{(!empty($obj))?$obj->amount_from:''}}" required>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Unit </label>
                                    <select class="form-control" name="amount_from_unit" id="amount_from_unit" required>
                                        @foreach(\Config::get('myconfig.currency') as $key=>$one)
                                            <option value="{{$key}}" {{(!empty($obj) && $obj->amount_from_unit == $key)?'selected':''}}>{{$one}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>The payment will come from</label>
                                    <select class="form-control" id="payment_come_from" name="payment_come_from" required>
                                        @foreach($countries as $key=>$value)
                                            @if(!isset($obj))
                                                <option value="{{$key}}" {{request()->get('payment_come_from') == $key ? 'selected' : ''}}>{{$value}}</option>
                                            @else
                                                <option value="{{$key}}" {{$obj->payment_come_from == $key ? 'selected' : ''}}>{{$value}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Amount to</label>
                                    <input type="text" id="amount_to" name="amount_to" class="form-control" value="{{(!empty($obj))?$obj->amount_to:''}}" required>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Unit </label>
                                    <select class="form-control" name="amount_to_unit" id="amount_to_unit" required>
                                        @foreach(\Config::get('myconfig.currency') as $key=>$one)
                                            <option value="{{$key}}" {{(!empty($obj) && $obj->amount_to_unit == $key)?'selected':''}}>{{$one}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Payment type</label>
                                    <select class="form-control" name="payment_type" id="" required>
                                        @foreach($typePayment as $key=>$one)
                                            <option value="{{$key}}" {{(!empty($obj->payment_type) && $obj->payment_type == $key)?'selected':''}}>{{$one}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Initiated date</label>
                                    <input class="form-control datetimepicker flatpickr-input" id="initiated_date" name="initiated_date" value="{{!empty($obj) ? \Carbon::parse($obj->initiated_date)->format('d/m/Y') :''}}" data-options='{"dateFormat":"d/m/Y"}' required>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Payment method</label>
                                    <p>Flywire</p>
                                    <input type="hidden" name="payment_method" value="4">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Staff</label>
                                    <input class="form-control" name="staff_id" id="staff_id" hidden>
                                    <input class="form-control" name="staff_id_name" id="staff_id_name" readonly>
{{--                                    <select class="form-control" name="staff_id" id="staff_id" required>--}}
{{--                                        <option value="">Select</option>--}}
{{--                                        @foreach($staffs as $staff)--}}
{{--                                            <option value="{{$staff->id}}" {{(!empty($obj->staff_id) && $obj->staff_id == $staff->id)?'selected':''}}>{{$staff->admin_id}}</option>--}}
{{--                                        @endforeach--}}
{{--                                    </select>--}}
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="">Delivered date</label>
                                    <input class="form-control datetimepicker flatpickr-input" id="delivered_date" name="delivered_date" value="{{!empty($obj) && !empty($obj->delivered_date) ? \Carbon::parse($obj->delivered_date)->format('d/m/Y') :''}}" data-options='{"dateFormat":"d/m/Y"}' required>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="">Promotion code</label>
                                    <select name="promotion_id" class="form-control" id="promotion_id">
                                        <option value=""></option>
                                        @foreach($promotionCode as $code)
                                            <option {{$obj->promotion_id == $code->id?'selected':''}} data-amount="{{$code->amount}}" data-unit="{{!empty($code->unit)&& !empty($currencyConfig[$code->unit])?$currencyConfig[$code->unit]:''}}" value="{{$code->id}}">
                                                {{$code->name}}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="">Promotion</label>
                                    <input type="text" class="form-control" id="promotion_amount" value="{{!empty($obj) && !empty($obj->promotion)?$obj->promotion->amount:''}}" readonly>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="">Unit</label>
                                    <input type="text" class="form-control" id="promotion_unit" value="{{!empty($obj) && !empty($obj->promotion) && !empty($currencyConfig[$obj->promotion->unit])?$currencyConfig[$obj->promotion->unit]:''}}" readonly>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Note</label>
                                    <textarea name="note" id="" cols="30" class="form-control" rows="10">{{(!empty($obj))?$obj->note:''}}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @if(!empty($obj))
            @can('flywire.update')
                @if(!empty($obj->profit) && !empty($obj->profit->first()->look_payment_form) && $obj->profit->first()->look_payment_form != 1)
                    <button type="submit" class="dang-ky-submit">Update</button>

                @elseif(!empty($obj->profit) &&  !empty($obj->profit->first()->look_payment_form) &&  $obj->profit->first()->look_payment_form == 1)

                @else
                    <button type="submit" class="dang-ky-submit">Update</button>
                @endif
            @endcan
        @else
            @can('flywire.store')
                <button type="submit" class="dang-ky-submit">Create</button>
            @endcan
        @endif
        <a href="{{route('flywire.index',['page'=>(!empty(request()->get('page'))?request()->get('page'):1)])}}" class="text-decoration-none dang-ky-restart">Close</a>
        <br>
        <br>
    </form>

    @push('scripts')
        <script>
            $('#school_id, #payment_come_from, #amount_from_unit, #amount_to_unit, #country').select2()
            $(document).on('mouseover', '.open-jquery-date', function () {
                let start_date_class = $(this).hasClass('flatpickr-input')
                if (!start_date_class) {
                    $(this).flatpickr({
                        dateFormat: 'd/m/Y',
                        allowInput: true,
                    })
                }
            })
            $('#flywire-form').submit(function (e) {
                $('.dang-ky-submit').hide()
            })
            $(document).on('change','#promotion_id',function(e){
                let amount = $('option:selected',this).attr('data-amount');
                let unit = $('option:selected',this).attr('data-unit');
                $('#promotion_amount').val(amount);
                $('#promotion_unit').val(unit);
            });

            $(document).ready(function (){
                $('#agent_id').on('change', function (){
                    $.ajax({
                        url : "{{ route('agent.getAgentById') }}",
                        type : 'get',
                        data : {
                            agent_id : $(this).val(),
                            staff : 'staff'
                        },
                        success : function (data)
                        {
                            $('#staff_id').val(data.staff_id);
                            $('#staff_id_name').val(data.staff_name);
                        }
                    })
                })
            });
        </script>
    @endpush
    @push('scripts')
        @include('CRM.partials.number_currency',['ids'=>[
            'amount_from',
            'amount_to'
        ]])
        @include('CRM.partials.script-call-agent',[
            'elementIdSelect2'=>'agent_id',
            'elementParentIdSelect2'=>'agent_id_select2',
            'data'=>!empty($obj)?$obj:[],
            'dataId'=>!empty($obj)?$obj->agent_id:'',
            'dataName'=>!empty($obj) && !empty($obj->agent)?$obj->agent->name:''
        ])
    @endpush
@stop
