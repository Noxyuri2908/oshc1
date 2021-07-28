@extends('fontend.layouts.master')
@section('title')
    {{get_name($c_menu)}}
@endsection
@section('content')
    <section id="news-page">
        <input type="hidden" value="{{$c_menu->id}}" id="c_menu">
        <div class="">
            <div class="title-section">
                {{get_name($news_section_1)}}
            </div>
            <div class="des-section">
                {!! get_content($news_section_1) !!}
            </div>
            <div class="buge">...</div>
        </div>
        <div class="breadcrumb">
            <ul>
                <li>
                    <a href="{{route('home')}}">
                        @lang('header.home')
                    </a>
                </li>
                <div class="dimi">
                    <i class="fa fa-angle-right" aria-hidden="true"></i>
                </div>
                <li class="active">
                    {{get_name($c_menu)}}
                </li>
            </ul>
        </div><!--  end breadcrumb -->
        <div class="header-content">
            <div class="container">
                <div class="swith">
                    <label class="switch">
                        <input id="close_option" type="checkbox" checked>
                        <span class="slider round"></span>
                    </label>
                    <span class="title-swith">@lang('header.close_option')</span>
                </div> <!-- end swith -->
                <div class="clear"></div>
                <input type="hidden" id="tag" value="{{isset($tag) ? $tag->id : 0}}">
                <input type="hidden" id="current_choose" value="0">
                <input type="hidden" id="count_load" value="0">
                <div id="option_view">
                    @include('fontend.partials.option-news')
                </div>
            </div>

            <div class="container">
                <div class="row" id="list-news">
                    @include('fontend.partials.list-news')
                </div> <!-- end row -->
                <div class="row">

                    <div class="col-md-12">
                        <div class="load-more textx-center">
                            @if(!empty($posts))
                                @if(!empty($posts->hasPages()))
                                    {{ $posts->appends(convertArrNullToEmptyValue(request()->query()))->links() }}
                                @endif
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @include('fontend.partials.partner-home',['title'=>$partner_title_home,'des'=>$partner_des_home,'partner'=>$pt_item])
    <!-- end partner-home -->
    </section>
@section('js')
    <script type="text/javascript">
        $(document).ready(function () {
            url_option_view = $('#ajax_url').val() + 'open/option-view';
            url_get_new_by_cat = $('#ajax_url').val() + 'get-news-by-cat/ajax';
            $('.content-list').matchHeight();
            $('#close_option:checkbox').change(function () {
                c_menu = $('#c_menu').val();
                cat = $('#current_choose').val();
                _tag = $('#tag').val();
                if (this.checked) {
                    $.get(url_option_view, {query: cat, tag: _tag, menu: c_menu}, function (data) {
                        $('#option_view').html(data);
                    });
                } else {
                    $('#option_view').empty();
                }
            });

            $('#news-page').delegate('.item-cat', 'click', function () {
                cat_id = $(this).data('id');
                cat_name = $(this).data('name');
                $('#cat_choose').html(cat_name);
                $('#current_choose').val(cat_id);
                getPost();

            });

            $('#news-page').delegate('.item-tag', 'click', function () {
                if ($(this).hasClass('choose')) {
                    $(this).removeClass('choose');
                } else $(this).addClass('choose');
                getPost();

            });

            $('.load-more').click(function () {
                current_count = parseInt($('#count_load').val());
                next_count = current_count + 1;
                $('#count_load').val(next_count);
                getPost();
            });

            function getPost() {
                //get cat
                cat_id = $('#current_choose').val();
                c_menu = $('#c_menu').val();
                //get tag
                arr_tag = [];
                $('.item-tag').each(function () {
                    if ($(this).hasClass('choose')) {
                        arr_tag.push($(this).data('id'));
                    }
                });
                count_load = parseInt($('#count_load').val());
                $.get(url_get_new_by_cat, {
                    load: count_load,
                    cat: cat_id,
                    tags: arr_tag,
                    menu: c_menu
                }, function (data) {
                    $('#list-news').html(data);
                });
            }

            $(".nav-item:first").addClass("active");
            $(".tab-pane:first").addClass("active");
        });
    </script>
@endsection
@endsection
