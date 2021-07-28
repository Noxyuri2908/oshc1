@extends('fontend.layouts.master')
@section('title')
    @lang('header.get_a_quote') - OSHC
@endsection
@section('css')
    <link href="{{asset('backend/pages/assets/lib/flatpickr/flatpickr.min.css')}}" rel="stylesheet">
    <style>
        .left-poplink {
            display: none;
        }
    </style>
@endsection
@section('content')
    {{--    @dump(session()->all())--}}
    <section id="get-a-quote-page">
        <div class="register-service">
            <div class="container">
                <div class="title-section">
                    {{ get_name($get_a_quote_section_1) }}
                </div>
                <div class="des-section">
                    {!! get_content($get_a_quote_section_1) !!}
                </div>
                <div class="buge">...</div>
                <div class="breadcrumb">
                    <ul>
                        <li class="active">
                            @lang('header.get_a_quote')
                        </li>
                        <div class="dimi">
                            <i class="fa fa-angle-right" aria-hidden="true"></i>
                        </div>
                        <li>
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

                <div class="choose-service">

                    <div class="title">
                        @lang('header.choose_service')
                    </div>
                    <div class="form-choose-service">
                        <div class="form-field desktop-form-get-a-quote">
                            <form method="post" action="{{route('get-a-quote')}}" class="s-field">
                                @csrf
                                <div class="sel-from">
                                    <div class="form-group date">
                                        <input class="form-control datetimepicker min-width-95 w-100"
                                               id="datepicker_reg"
                                               placeholder="Start date" type="text"
                                               value="{{(!empty($start_date))?\Carbon::parse($start_date)->format('d/m/Y'):\Carbon\Carbon::now()->format('d/m/Y')}}"
                                               name="start_date" data-options='{"dateFormat":"d/m/y"}' required>
                                    </div>
                                </div>
                                <div class="sel-from">
                                    <div class="form-group date">
                                        <input class="form-control datetimepicker min-width-95 w-100"
                                               id="datepicker_reg2"
                                               placeholder="End date" type="text"
                                               value="{{(!empty($end_date))?\Carbon::parse($end_date)->format('d/m/Y'):\Carbon\Carbon::now()->addMonth(1)->subDay(1)->format('d/m/Y')}}"
                                               name="end_date"
                                               data-options='{"dateFormat":"d/m/y"}' required>
                                    </div>
                                </div>
                                <div class="sel-from">
                                    <div class="form-group">
                                        <select class="adults form-control" id="adults" name="adults" required>
                                            <option value="1" {{$adults == 1 ? 'selected' : ''}}>1 Adult</option>
                                            <option value="2" {{$adults == 2 ? 'selected' : ''}}>2 Adults</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="sel-from">
                                    <div class="form-group">
                                        <select class="children form-control" id="children" name="children" required>
                                            <option value="0" {{$childs == 0 ? 'selected' : ''}}>0 Children</option>
                                            <option value="1" {{$childs == 1 ? 'selected' : ''}}>1 Child</option>
                                            <option value="2" {{$childs == 2 ? 'selected' : ''}}>2 Children</option>
                                            <option value="3" {{$childs == 3 ? 'selected' : ''}}>3 Children</option>
                                            <option value="4" {{$childs == 4 ? 'selected' : ''}}>4 Children</option>
                                            <option value="5" {{$childs == 5 ? 'selected' : ''}}>5 Children</option>
                                        </select>
                                    </div>
                                </div>
                                <button type="button" class="send-f get-a-quote-btn">@lang('header.quote_now')</button>
                            </form>
                        </div>
                        <div class="form-field mobile-form-get-a-quote">
                            <form method="post" action="{{route('get-a-quote')}}" id="get-a-quote-mobile"
                                  class="s-field">
                                @csrf
                                <div class="sel-from">
                                    <div class="form-group date">
                                        <input class="form-control datetimepicker min-width-99"
                                               id="datepicker_reg_mobile"
                                               placeholder="Start date" type="text"
                                               value="{{(!empty($start_date))?\Carbon::parse($start_date)->format('d/m/Y'):\Carbon\Carbon::now()->format('d/m/Y')}}"
                                               name="start_date_mobile" data-options='{"dateFormat":"d/m/y"}' required>
                                    </div>
                                </div>
                                <div class="sel-from">
                                    <div class="form-group date">
                                        <input class="form-control datetimepicker min-width-99"
                                               id="datepicker_reg2_mobile"
                                               placeholder="End date" type="text"
                                               value="{{(!empty($end_date))?\Carbon::parse($end_date)->format('d/m/Y'):\Carbon\Carbon::now()->addMonth(1)->subDay(1)->format('d/m/Y')}}"
                                               name="end_date_mobile"
                                               data-options='{"dateFormat":"d/m/y"}' required>
                                    </div>
                                </div>
                                <div class="sel-from">
                                    <div class="form-group">
                                        <select class="adults form-control" id="adults" name="adults_mobile" required>
                                            <option value="1" {{$adults == 1 ? 'selected' : ''}}>1 Adult</option>
                                            <option value="2" {{$adults == 2 ? 'selected' : ''}}>2 Adults</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="sel-from">
                                    <div class="form-group">
                                        <select class="children form-control" id="children" name="children_mobile"
                                                required>
                                            <option value="0" {{$childs == 0 ? 'selected' : ''}}>0 Children</option>
                                            <option value="1" {{$childs == 1 ? 'selected' : ''}}>1 Child</option>
                                            <option value="2" {{$childs == 2 ? 'selected' : ''}}>2 Children</option>
                                            <option value="3" {{$childs == 3 ? 'selected' : ''}}>3 Children</option>
                                            <option value="4" {{$childs == 4 ? 'selected' : ''}}>4 Children</option>
                                            <option value="5" {{$childs == 5 ? 'selected' : ''}}>5 Children</option>
                                        </select>
                                    </div>
                                </div>
                                <input type="hidden" name="type" value="mobile">
                                <button type="button"
                                        class="send-f get-a-quote-btn-mobile">@lang('header.quote_now')</button>
                            </form>
                        </div>
                    </div>
                    <div class="text-descretion">
                        {!! get_content($get_a_quote_section_2) !!}
                        <span class="color-1"><a style="font-size:14px;font-weight: bold"
                                                 href="{{$get_a_quote_section_2->link}}">{!! get_name($get_a_quote_section_2) !!}</a></span>
                    </div>
                    <div id="table-bank" class="on-destop">
                        @include('fontend.partials.get-a-quote.table-bank')
                    </div> <!-- end on-destop -->

                    <div id="table-bank-content" class="banner-price on-destop ">
                        @if(!empty($get_a_quote_banner_deskop_1->image))
                            <img src="{{$get_a_quote_banner_deskop_1->image}}">
                        @endif
                    </div><!--  end banner -->

                    @include("fontend.partials.destop-get-quote")
                    <div id="table-bank-mobile">
                        @include("fontend.partials.mobile-get-quote")
                    </div>

                    <div class="banner-price on-mobile">
                        @if(!empty($get_a_quote_banner_deskop_1->image))
                            <img src="{{$get_a_quote_banner_deskop_1->image}}">
                        @endif
                    </div> <!-- banner trên mobile -->
                </div>
            </div>
        </div>

        <!-- begin service-home -->
    @include('fontend.partials.service-home',['sevice_intro_home'=>$sevice_intro_home,'sevice_home'=>$sevice_home,'title'=>$sevice_title_home,'des'=>$sevice_des_home])
    <!--  end service-home -->
    @include('fontend.partials.clients-home',['objs'=>$scs,'clients'=>$cts])
    <!-- end clients-home -->
    @include('fontend.partials.partner-home',['title'=>$partner_title_home,'des'=>$partner_des_home,'partner'=>$pt_item])
    <!-- end partner-home -->
    </section>
@section('js')
    <script type="text/javascript" src="{{asset('backend/pages/assets/lib/flatpickr/flatpickr.min.js')}}"></script>

    <script type="text/javascript">

        $(document).on('click', '.get-a-quote-buy-click', function (e) {
            e.preventDefault();
            let _url = $(this).attr('data-url');
            let _price = $(this).attr('data-price');
            let _click = $(this).attr('data-clicked');
            if (parseInt(_price) > 0) {
                if (_click == 'false') {
                    _click = 'true';
                    $.ajax({
                        url: _url,
                        type: 'post',
                        data: {
                            _token: "{{csrf_token()}}"
                        },
                        success: function (data) {
                            window.location.href = data;
                        },
                        complete: function () {
                            _click = 'false';
                        }
                    })
                }

            }

        })
        $('input[name="start_date"]').change(function (e) {
            $('.btn-quote-list').css('display', 'block');
            $(".price").html('');
            $(".buy").css('display', 'none');
        });
        $('input[name="end_date"]').change(function (e) {
            $('.btn-quote-list').css('display', 'block');
            $(".price").html('');
            $(".buy").css('display', 'none');
        });
        $('select[name="adults"]').change(function (e) {
            $('.btn-quote-list').css('display', 'block');
            $(".price").html('');
            $(".buy").css('display', 'none');
        });
        $('select[name="children"]').change(function (e) {
            $('.btn-quote-list').css('display', 'block');
            $(".price").html('');
            $(".buy").css('display', 'none');
        });
        $('input[name="start_date_mobile"]').change(function (e) {
            $('.btn-quote-list-mobile').css('display', 'block');
            $(".price").html('');
            $(".buy").css('display', 'none');
        });
        $('input[name="end_date_mobile"]').change(function (e) {
            $('.btn-quote-list-mobile').css('display', 'block');
            $(".price").html('');
            $(".buy").css('display', 'none');
        });
        $('select[name="adults_mobile"]').change(function (e) {
            $('.btn-quote-list-mobile').css('display', 'block');
            $(".price").html('');
            $(".buy").css('display', 'none');
        });
        $('select[name="children_mobile"]').change(function (e) {
            $('.btn-quote-list-mobile').css('display', 'block');
            $(".price").html('');
            $(".buy").css('display', 'none');
        });
        $(document).ajaxStart(function () {
            $('.btn-quote-list').css('display', 'none');
            $('.btn-quote-list-mobile').css('display', 'none');
            $(".price").html('<div class="d-flex justify-content-center align-items-center"><div class="loader-a-quote"></div></div>');
        });
        window.onscroll = function () {
            myFunction()
        };
        var header = document.getElementById("table-bank");
        var content = document.getElementById("table-bank-content");
        var sticky = header.offsetTop;
        var ajax_url = $("#ajax_url").val();
        // var getAQuote_url = ajax_url + "/get-a-quote/ajax";
        var getAQuote_url = "{{route('get-a-quote.ajax')}}";

        function getAQuote() {
            _start_date = $("#datepicker_reg").val();
            _end_date = $("#datepicker_reg2").val();
            _adults = $("#adults").val();
            _childs = $("#children").val();
            $.get(getAQuote_url, {
                start_date: _start_date,
                end_date: _end_date,
                adults: _adults,
                childs: _childs
            }, function (data) {
                $(document).ajaxComplete(function () {
                    $('#table-bank').html(data);
                });
            })
        }

        $(".get-a-quote-btn").click(getAQuote);
        $(document).on('click', '.btn-quote-list', function () {
            _start_date = $("#datepicker_reg").val();
            _end_date = $("#datepicker_reg2").val();
            _adults = $("#adults").val();
            _childs = $("#children").val();
            $.get(getAQuote_url, {
                start_date: _start_date,
                end_date: _end_date,
                adults: _adults,
                childs: _childs
            }, function (data) {
                $(document).ajaxComplete(function () {
                    $('#table-bank').html(data);
                });
            })
        });


        function getAQuoteMobile() {
            _start_date = $('input[name="start_date_mobile"]').val();
            _end_date = $('input[name="end_date_mobile"]').val();
            _adults = $('select[name="adults_mobile"]').val();
            _childs = $('select[name="children_mobile"]').val();
            _type = $('input[name="type"]').val();
            $.get(getAQuote_url, {
                start_date: _start_date,
                end_date: _end_date,
                adults: _adults,
                childs: _childs,
                type: _type
            }, function (data) {
                $(document).ajaxComplete(function () {
                    $('#table-bank-mobile').html(data);
                });
            })
        }

        $(document).on('click', '.btn-quote-list-mobile', getAQuoteMobile);
        $('.get-a-quote-btn-mobile').click(getAQuoteMobile);

        function myFunction() {
            if (window.pageYOffset > sticky) {
                header.classList.add("sticky");
                content.classList.add("sticky-content");
            } else {
                header.classList.remove("sticky");
                content.classList.remove("sticky-content");
            }
        }

        function convertTZ(date, tzString) {
            return new Date((typeof date === "string" ? new Date(date) : date).toLocaleString("en-US", {timeZone: tzString}));
        }

        var dateUTCNow = new Date();
        var dateStart = convertTZ(dateUTCNow, 'Australia/Sydney');

        $("#datepicker_reg").datepicker({
            format: 'dd/mm/yyyy',
            startDate: dateStart,
        }).on('changeDate', function (selected) {
            var minDate = new Date(selected.date.valueOf());
            $('#datepicker_reg2').datepicker('setStartDate', minDate);
            $('#datepicker_reg2').datepicker('setDate', minDate);
        });

        $("#datepicker_reg2").datepicker({
            format: 'dd/mm/yyyy',
            startDate: dateStart,
        }).on('changeDate', function (selected) {
            var maxDate = new Date(selected.date.valueOf());
        });

        $("#datepicker_reg_mobile").datepicker({
            format: 'dd/mm/yyyy',
            startDate: dateStart,
        }).on('changeDate', function (selected) {
            var minDate = new Date(selected.date.valueOf());
            $('#datepicker_reg2_mobile').datepicker('setStartDate', minDate);
            $('#datepicker_reg2_mobile').datepicker('setDate', minDate);
        });
        ;
        $("#datepicker_reg2_mobile").datepicker({
            format: 'dd/mm/yyyy',
            startDate: dateStart,
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

        function goodbye(e) {
            alert('a');
        }

        window.onbeforeunload = goodbye;
    </script>
@endsection
@endsection
