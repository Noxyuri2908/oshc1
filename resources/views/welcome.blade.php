@extends('fontend.layouts.master')
@section('title')
    OSHC - Global
@endsection
@section('css')
@endsection
@section('content')
    <section id="home-page" class="d-flex flex-column">
        <div class="banner-slider">
            <div class="home-slides clear clearfix">
                <ul class="home-slide">
                    @if(!empty($bns))
                        @foreach ($bns as $bn)
                            <li class="slide-it">
                                <img src="{{$bn->image}}" class="init">
                            </li>
                        @endforeach
                    @endif
                </ul>
            </div>
            <div class="form-slider">
                <div class="container">
                    <div class="form-slider-inner">
                        <div class="cont-form-slider">
                            @if(!empty($title_form_home))
                                <h2>{{get_name($title_form_home)}}</h2>
                                <p>{!! get_content($title_form_home)  !!}</p>
                                <p class="desc-moblie">
                                    {!! get_content($title_form_home)  !!}
                                </p>
                        @endif
                        <!-- hiển thị trên mobile -->
                            <div class="form-field form-choose-service">
                                <form method="post" action="{{route('get-a-quote')}}" class="s-field">
                                    @csrf
                                    <div class="sel-from">
                                        <div class="form-group date">
                                            <input class="form-control w-100 min-width-95 datetimepicker"
                                                   id="datepicker"
                                                   placeholder="Start date" type="text"
                                                   value="{{(!empty($start_date))?$start_date:\Carbon\Carbon::now()->format('d/m/Y')}}"
                                                   name="start_date" required>
                                        </div>
                                    </div>
                                    <div class="sel-from">
                                        <div class="form-group date">
                                            <input class="form-control w-100 min-width-95 datetimepicker"
                                                   id="datepicker2"
                                                   placeholder="End date" type="text"
                                                   value="{{(!empty($end_date))?$end_date:\Carbon\Carbon::now()->addMonth(1)->subDay(1)->format('d/m/Y')}}"
                                                   name="end_date" required>
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
                                            <select class="children form-control" id="children" name="childs"
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
                                    <button type="submit" class="send-f">@lang('header.quote_now')</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="banner-qc" style="background: url('{{asset('images/qc.jpg')}}')">
            <div class="title-qc">
                @if(!empty($banner_home))
                    {!! get_content($banner_home)  !!}
                @endif
            </div>
        </div>

        <!-- begin service-home -->
    {{-- @include('fontend.partials.service-home',['sevice_intro_home'=>$sevice_intro_home,'sevice_home'=>$sevice_home,'title'=>$sevice_title_home,'des'=>$sevice_des_home]) --}}

    @include('fontend.partials.service-home')
    <!--  end service-home -->

        <div id="choose-home" class="d-flex padding-group">
            <div class="">
                <div class="title-section">
                    @if(!empty($title_choose_home))
                        {{get_name($title_choose_home)}}
                    @endif
                </div>

                @if(!empty($title_choose_home))
                    <div class="des-section">
                        {!!get_content($title_choose_home)!!}
                    </div>
                @endif
                <div class="list-choose-home">
                    <div class="col-l col-md-6">
                        <div class="choose-inner">
                            @if(!empty($chose_home))
                                @foreach ($chose_home as $ch)
                                    @include('fontend.partials.item-choose',['post'=>$ch])
                                @endforeach
                            @endif
                        </div>
                    </div>
                    <div class="col-r col-md-6">
                        <div class="video-home">
                            @if(!empty($video_home))
                                <iframe width="100%" height="280"
                                        src="https://www.youtube.com/embed/{{get_youtube_id_from_url($video_home->content)}}"
                                        frameborder="0"
                                        allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"
                                        allowfullscreen></iframe>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>

    @include('fontend.partials.clients-home',['objs'=>$scs,'clients'=>$cts])
    <!-- end clients-home -->
    @if(!empty($partner_title_home) && !empty($partner_des_home) && !empty($pt_item))
        @include('fontend.partials.partner-home',['title'=>$partner_title_home,'des'=>$partner_des_home,'partner'=>$pt_item])
    @endif
    <!-- end partner-home -->

    </section>
{{--    <div class="modal fade" id="myModal">--}}
{{--        <div class="modal-body max-width-60">--}}
{{--            <button type="button" class="close-md" data-dismiss="modal"></button>--}}
{{--            <div class="modal-block modal-left modal-top">--}}
{{--                <div class="modal-inner">--}}
{{--                    <div class="content-popup row">--}}
{{--                        <a class="w-100" href="{{isset($infos) ? $infos->link : ''}}">--}}
{{--                            <img src="{{isset($infos) ? $infos->image : ''}}">--}}
{{--                        </a>--}}
{{--                        <a class="pop-up-oshv-box" target="_blank" href="http://ovhcglobal.com.au/">--}}

{{--                        </a>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
@section('js')
{{--    <script>--}}
{{--        var modal = $('#myModal');--}}
{{--        setTimeout(function () {--}}
{{--            if (sessionStorage.getItem('popup') == null) {--}}
{{--                modal.modal('show');--}}
{{--                modal.css({--}}
{{--                    'display': 'flex',--}}
{{--                    'align-items': 'center'--}}
{{--                });--}}
{{--                sessionStorage.setItem("popup", "show");--}}
{{--            }--}}
{{--        }, 3000);--}}
{{--    </script>--}}
    <script type="text/javascript">
        $(document).ready(function () {
            jQuery('.home-slide').lightSlider({
                item: 1,
                slideMargin: 0,
                mode: 'fade',
                auto: true,
                pause: 3800,
                speed: 1800,
                pager: false,
                loop: true,
                controls: false,
                enableDrag: false,
            });
            $('.item-box').matchHeight();
            $('.des-box').matchHeight();
            {{--$("#datepicker").flatpickr({--}}
            {{--    dateFormat: "d/m/Y",--}}
            {{--    minDate: "{{\Carbon\Carbon::now()->format('d/m/Y')}}",--}}
            {{--});--}}
            {{--$("#datepicker2").flatpickr({--}}
            {{--    dateFormat: "d/m/Y",--}}
            {{--    minDate: new Date().fp_incr(1),--}}
            {{--});--}}
            function convertTZ(date, tzString) {
                return new Date((typeof date === "string" ? new Date(date) : date).toLocaleString("en-US", {timeZone: tzString}));
            }

            var dateUTCNow = new Date();
            var dateStart = convertTZ(dateUTCNow, 'Australia/Sydney');

            $("#datepicker").datepicker({
                format: 'dd/mm/yyyy',
                startDate: dateStart
            }).on('changeDate', function (selected) {
                var minDate = new Date(selected.date.valueOf());
                $('#datepicker2').datepicker('setStartDate', minDate);
                $('#datepicker2').datepicker('setDate', minDate);
            });

            $("#datepicker2").datepicker({
                format: 'dd/mm/yyyy',
                startDate: dateStart
            }).on('changeDate', function (selected) {
                var maxDate = new Date(selected.date.valueOf());
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
        })

    </script>
@endsection
@endsection
