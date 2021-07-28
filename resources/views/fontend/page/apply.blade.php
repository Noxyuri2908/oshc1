@extends('fontend.layouts.master')
@section('title')
    @lang('header.apply_register') - OSHC
@endsection
@section('css')

    <link rel="stylesheet"
          href="https://cdn.jsdelivr.net/npm/shortcut-buttons-flatpickr@0.1.0/dist/themes/light.min.css">
    <link href="{{asset('backend/pages/assets/lib/flatpickr/flatpickr.min.css')}}" rel="stylesheet">
    <style>
        .left-poplink {
            display: none;
        }
    </style>
@endsection
@section('content')

    <section id="allpy-register-service">
        <div class="allpy-service">
            <div class="container">
                <div class="title-section">
                    {{ get_name($apply_section_1) }}
                </div>
                <div class="des-section">
                    {!! get_content($apply_section_1) !!}
                </div>
                <div class="buge">...</div>
                <div class="breadcrumb">
                    <ul>
                        <li>
                            @lang('header.get_a_quote')
                        </li>
                        <div class="dimi">
                            <i class="fa fa-angle-right" aria-hidden="true"></i>
                        </div>
                        <li class="active">
                            @lang('header.apply')
                        </li>
                        <div class="dimi">
                            <i class="fa fa-angle-right" aria-hidden="true"></i>
                        </div>
                        <li>
                            @lang('header.payment')
                        </li>
                    </ul>
                </div>

                <div class="infonation-apply">
                    @if(count($errors) > 0)
                        <div class="alert alert-danger">
                            @foreach($errors->all() as $err)
                                <strong>{{$err}}</strong><br>
                            @endforeach
                        </div>
                    @endif
                    @if(session('error-apply-web'))
                        <div class="alert alert-danger">
                            <strong>{{session('error-apply-web')}}</strong>
                        </div>
                    @endif
                    @if(session('success-apply-web'))
                        <div class="alert alert-success">
                            <strong>{{session('success-apply-web')}}</strong>
                        </div>
                    @endif

                    @include('fontend.partials.apply.detail')
                    <hr>

                    <div id="form-register-people">
                        <form id="apply-form" class="form-register-people"
                              action="{{route('apply.register.post')}}"
                              method="POST">
                            @csrf
                            <div class="col-inner col-md-12 col-sm-12 col-xs-12 pd0">
                                <div class="title-bank">
                                    <h3>{{ get_name($apply_section_2) }}</h3>
                                </div>
                            </div>
                            <span class="desciption">
								{!! get_content($apply_section_2) !!}
							</span>
                            <div class="row">
                                <div class="col-md-6">
                                    @include("fontend.partials.apply.row-register", ['data'=>!empty($main_customer)?$main_customer:[]])
                                    {{--                                    //add--}}
                                    @if($adults == 1 && $childs == 0)
                                        @include("fontend.partials.apply.agent-info",['data'=>!empty($main_customer)?$main_customer:[]])
                                        <div class="list-check-submit">
                                            <h4>@lang('header.terms') (*)</h4>
                                            <div class="form-group checkbox-list">
                                                <input type="checkbox" required>
                                                <span class="checkmark font-size-13"><a
                                                        href="{{$apply_section_5->link}}">{{get_name($apply_section_5)}}</a>{{get_content($apply_section_5)}}</span>
                                            </div>
                                            <div class="form-group checkbox-list">
                                                <input type="checkbox" name="" value="confirm" required>
                                                <span
                                                    class="checkmark font-size-13">{{get_content($apply_section_6)}}</span>
                                            </div>
                                            <div class="form-group checkbox-list d-flex">
                                                <input type="checkbox" name="" value="confirm" required>
                                                <span class="checkmark font-size-13">Note: If you hold a student dependent visa, you must be insured under the same policy as the main student visa holder. You are only eligible to hold a single OSHC policy if you are the primary visa holder.
                                            </span>
                                            </div>
                                        </div>
                                        <div class="list-control-btn">
                                            <button class="back-step"
                                                    onClick="window.location='{{route('get-a-quote.get')}}';">@lang('header.back')</button>
                                            <button class="submit-step" type="submit">@lang('header.continue')
                                            </button>
                                        </div>
                                    @endif
                                </div>

                                @if($adults > 1 || $childs > 0)
                                    <div class="col-sm-12 col-md-12">
                                        @include("fontend.partials.apply.partner",['data_adults'=>!empty($data_adults)?$data_adults:[]])
                                        @include("fontend.partials.apply.children",['data_childs'=>!empty($data_childs)?$data_childs:[]])
                                    </div>
                                    <div class="col-md-6">
                                        @include("fontend.partials.apply.agent-info",['data'=>!empty($main_customer)?$main_customer:[]])
                                        <div class="list-check-submit">
                                            <h4>@lang('header.terms') (*)</h4>
                                            <div class="form-group checkbox-list">
                                                <input type="checkbox" required>
                                                <span class="checkmark font-size-13"><a
                                                        href="{{$apply_section_5->link}}">{{get_name($apply_section_5)}}</a>{{get_content($apply_section_5)}}</span>
                                            </div>
                                            <div class="form-group checkbox-list">
                                                <input type="checkbox" name="" value="confirm" required>
                                                <span
                                                    class="checkmark font-size-13">{{get_content($apply_section_6)}}</span>
                                            </div>
                                            <div class="form-group checkbox-list d-flex">
                                                <input type="checkbox" name="" value="confirm" required>
                                                <span class="checkmark font-size-13">Note: If you hold a student dependent visa, you must be insured under the same policy as the main student visa holder. You are only eligible to hold a single OSHC policy if you are the primary visa holder.
                                            </span>
                                            </div>
                                        </div>
                                        <div class="list-control-btn">
                                            <button class="back-step"
                                                    onClick="window.location='{{route('get-a-quote.get')}}';">@lang('header.back')</button>
                                            <button class="submit-step" type="submit">@lang('header.continue')
                                            </button>
                                        </div>
                                    </div>
                                @endif



                                @if($apply_section_4 != null)
                                    <div class="col-md-6 banner-right pdr0 image-apply-register">
                                        <img src="{{$apply_section_4->image}}">
                                    </div>
                                @endif

                            </div>

                            <div class="contact-info-reg">
                                <div class="col-md-6 list-field pdl0 pr-xs-0">
                                    {{--                                    @include("fontend.partials.apply.agent-info",['data'=>$main_customer])--}}
                                    {{--                                    <div class="list-check-submit">--}}
                                    {{--                                        <h4>@lang('header.terms') (*)</h4>--}}
                                    {{--                                        <div class="form-group checkbox-list">--}}
                                    {{--                                            <input type="checkbox" required>--}}
                                    {{--                                            <span class="checkmark font-size-13" ><a--}}
                                    {{--                                                    href="{{$apply_section_5->link}}">{{get_name($apply_section_5)}}</a>{{get_content($apply_section_5)}}</span>--}}
                                    {{--                                        </div>--}}
                                    {{--                                        <div class="form-group checkbox-list">--}}
                                    {{--                                            <input type="checkbox" name="" value="confirm" required>--}}
                                    {{--                                            <span class="checkmark font-size-13">{{get_content($apply_section_6)}}</span>--}}
                                    {{--                                        </div>--}}
                                    {{--                                        <div class="form-group checkbox-list d-flex">--}}
                                    {{--                                            <input type="checkbox" name="" value="confirm" required>--}}
                                    {{--                                            <span class="checkmark font-size-13">Note: If you hold a student dependent visa, you must be insured under the same policy as the main student visa holder. You are only eligible to hold a single OSHC policy if you are the primary visa holder.--}}
                                    {{--                                            </span>--}}
                                    {{--                                        </div>--}}
                                    {{--                                    </div>--}}
                                    {{--                                    <div class="list-control-btn">--}}
                                    {{--                                        <button class="back-step"--}}
                                    {{--                                                onClick="window.location='{{route('get-a-quote.get')}}';">@lang('header.back')</button>--}}
                                    {{--                                        <button class="submit-step" type="submit">@lang('header.continue')--}}
                                    {{--                                        </button>--}}
                                    {{--                                    </div>--}}
                                </div>
                                <div class="offset-6">

                                </div>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
        <div class="loading-apply" style="display:none">Loading&#8230;</div>
        <!-- begin service-home -->
    @include('fontend.partials.service-home',['sevice_intro_home'=>$sevice_intro_home,'sevice_home'=>$sevice_home,'title'=>$sevice_title_home,'des'=>$sevice_des_home])
    <!--  end service-home -->
    @include('fontend.partials.partner-home',['title'=>$partner_title_home,'des'=>$partner_des_home,'partner'=>$pt_item])
    <!-- end partner-home -->
    </section>
@section('js')
    <script
        src="https://cdn.jsdelivr.net/npm/shortcut-buttons-flatpickr@0.1.0/dist/shortcut-buttons-flatpickr.min.js"></script>
    <script type="text/javascript" src="{{asset('backend/pages/assets/lib/flatpickr/flatpickr.min.js')}}"></script>
    <script type="text/javascript">
        $("#apply-form").submit(function (event) {
            $('.submit-step').hide();
            $('.back-step').hide();
            $('.loading-apply').show();
        });
        const months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
        const buttons = months.map((month) => {
            return {label: month.substr(0, 3)};
        });
        flatpickr("#birth-day", {
            dateFormat: "d/m/Y",
            plugins: [
                ShortcutButtonsPlugin({
                    button: buttons,
                    onClick: (index, fp) => {
                        const date = new Date();
                        date.setDate(1);
                        date.setMonth(index);
                        date.setYear(fp.currentYear);

                        fp.setDate(date);
                    }
                })
            ]
        });
        /* ===== Logic for creating fake Select Boxes ===== */
        $('.sel').each(function () {
            $(this).children('select').css('display', 'none');

            var $current = $(this);

            $(this).find('option').each(function (i) {
                if (i == 0) {
                    $current.prepend($('<div>', {
                        class: $current.attr('class').replace(/sel/g, 'sel__box')
                    }));

                    var placeholder = $(this).text();
                    $current.prepend($('<span>', {
                        class: $current.attr('class').replace(/sel/g, 'sel__placeholder'),
                        text: placeholder,
                        'data-placeholder': placeholder
                    }));

                    return;
                }
                $current.children('div').append($('<span>', {
                    class: $current.attr('class').replace(/sel/g, 'sel__box__options'),
                    text: $(this).text()
                }));
            });
        });
        // Toggling the `.active` state on the `.sel`.
        $('.sel').click(function () {
            $(this).toggleClass('active');
        });
        // Toggling the `.selected` state on the options.
        $('.sel__box__options').click(function () {
            var txt = $(this).text();
            var index = $(this).index();

            $(this).siblings('.sel__box__options').removeClass('selected');
            $(this).addClass('selected');

            var $currentSel = $(this).closest('.sel');
            $currentSel.children('.sel__placeholder').text(txt);
            $currentSel.children('select').prop('selectedIndex', index + 1);
        });
    </script>
@endsection
@endsection
