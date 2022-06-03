@extends('fontend.layouts.master')
@section('title')
    {{$about->name}}
@endsection
@section('content')
    <section id="about-page">
        <div class="banner-page"
        >
            <div class="d-flex justify-content-center align-items-center">
                <img class="banner-page-image-about"
                     src="{{(!empty($about->content['image_banner']))?$about->content['image_banner']:''}}">
            </div>
            <div class="container">
                <div class="cont-banner-page">
                    <div
                        class="title-section">{{(!empty($about->content['banner_main_content']))?$about->content['banner_main_content']:''}}</div>

                    <div class="des-section">&nbsp;</div>

                    <div class="buge">...</div>
                </div>
            </div>
        </div>

        <div class="banner-qc" style="background: url('http://oshcglobal.com.au/images/qc.jpg')">
            <div class="title-qc">
                @if(!empty($about->content['banner_sub_content']))
                <span>{!!$about->content['banner_sub_content']!!}</span>
                @endif
            </div>
        </div>

        <div class="who-about">
            <div class="container">
                <div class="title-section">{{(!empty($about->content['title-1']))?$about->content['title-1']:''}}</div>

                <div
                    class="des-section font-size-16px">{{(!empty($about->content['who_we_are_content']))?$about->content['who_we_are_content']:''}}</div>

                <div class="buge">...</div>

                <div class="list-core">
                    <div class="row">
                        @if(!empty($about->content['repeat']['core_value']))
                            @foreach($about->content['repeat']['core_value'] as $core_value)
                                <div class="core-item col-md-3 col-sm-6 col-xs-6">
                                    <div class="core-inner">
                                        <div class="icon"><img
                                                src="{{(!empty($core_value['image']))?$core_value['image']:''}}"
                                                style=""/></div>
                                                {{-- width: 35px; height: 47px; --}}

                                        <div class="cont">
                                            <div class="star">&nbsp;</div>

                                            <div
                                                class="title">{{(!empty($core_value['main_content']))?$core_value['main_content']:''}}</div>

                                            <div class="line">&nbsp;</div>

                                            <div
                                                class="info font-size-13">{{(!empty($core_value['title']))?$core_value['title']:''}}</div>

                                            <div class="info">&nbsp;</div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
                {{-- <div class="who-slides clear clearfix">
                    <div class="who-slide owl-carousel owl-theme">
                        @if(!empty($about->content['image_slide_who_we_are']))
                            @php
                                $image_slide = json_decode($about->content['image_slide_who_we_are'],true);
                            @endphp
                            @if(is_array($image_slide))
                                @foreach($image_slide as $one)
                                    <div class="item"><img class="w-100" src="{{$one}}"/></div>
                                @endforeach
                            @else
                                <li class="item"><img class="w-100" src="{{$about->content['image_slide_who_we_are']}}"/></li>
                                @endif
                        @endif
                    </div>
                </div> --}}

                <div class="tab-video">
                    <div class="col-md-9 content-list-video pd0">
                        <div class="tab-content">
                            @foreach($about->content['link_youtube'] as $link)
                                <div class="tab-pane {{($loop->index == 0)?'active':''}} fade" id="video{{$loop->index+1}}" role="tabpanel">
                                    <iframe
                                        allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"
                                        allowfullscreen="" frameborder="0" height="100%"
                                        src="https://www.youtube.com/embed/{{get_youtube_id_from_url($link)}}"
                                        width="100%"></iframe>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="col-md-3 left-nav-video pd0">
                        <h3>Your Chanel</h3>

                        <ul class="nav nav-tabs nav-tabs--vertical nav-tabs--left" role="navigation">
                            @foreach($about->content['link_youtube'] as $link)
                                <li class="nav-item">
                                    <div class="item-nav-vi">
                                        <div class="thumb"><a aria-controls="video{{$loop->index+1}}" class="nav-link"
                                                              data-toggle="tab"
                                                              href="#video{{$loop->index+1}}" role="tab"><img
                                                    src="{{youtube_image_medium(get_youtube_id_from_url($link))}}"/>
                                            </a></div>

                                        <div class="cont">
                                            <div class="title"><a aria-controls="video{{$loop->index+1}}" class="nav-link"
                                                                  data-toggle="tab"
                                                                  href="#video{{$loop->index+1}}"
                                                                  role="tab">{{youtube_title(get_youtube_id_from_url($link))}}</a>
                                            </div>

                                        </div>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>

                {{-- <div class="core-value">
                    <div class="title-section">{{(!empty($about->content['title-2']))?$about->content['title-2']:''}}</div>

                    <div
                        class="des-section">{{(!empty($about->content['core_value_main_content']))?$about->content['core_value_main_content']:''}}
                    </div>

                    <div class="buge">...</div>


                </div> --}}
            </div>
        </div>

        <div class="mission d-flex">
            <div class="container">
                <div class="title-section">{{(!empty($about->content['title-3']))?$about->content['title-3']:''}}</div>

                <div
                    class="des-section">{{(!empty($about->content['our_mission_main_content']))?$about->content['our_mission_main_content']:''}}
                </div>

                <div class="buge">...</div>

                <div class="our-mission">
                    <div class="row">
                        @if(!empty($about->content['repeat']['our_mission']))
                            @foreach($about->content['repeat']['our_mission'] as $our_mission)
                                <div class="item-mission col-md-6 col-sm-12 col-xs-12">
                                    <div class="icon-mission"><img alt="Our mission"
                                                                   src="{{(!empty($our_mission['image']))?$our_mission['image']:''}}"/>
                                        <div
                                            class="title-mission">{{(!empty($our_mission['main_content']))?$our_mission['main_content']:''}}</div>
                                    </div>

                                    <div
                                        class="content-mission">{{(!empty($our_mission['title']))?$our_mission['title']:''}}
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <div class="company d-flex">
            <div class="container">
                <div class="title-section">{{(!empty($about->content['title-4']))?$about->content['title-4']:''}}</div>

                <div
                    class="des-section">{{(!empty($about->content['company_business_main_content']))?$about->content['company_business_main_content']:''}}
                </div>

                <div class="buge">...</div>

                <div class="list-info-about">
                    @if(!empty($about->content['repeat']['company_business']))
                        @foreach($about->content['repeat']['company_business'] as $company_business)
                            <div class="item-company col-md-3 col-sm-3 col-xs-6">
                                <div class="icon-company d-flex justify-content-center">
                                    <div class="frame d-flex justify-content-center align-items-center"><img
                                            src="{{(!empty($company_business['image']))?$company_business['image']:''}}"/>
                                    </div>
                                </div>

                                <div class="content-company">
                                    <h3 class="title">{{(!empty($company_business['main_content'][0]))?$company_business['main_content'][0]:''}}</h3>

                                    <div
                                        class="number">{{(!empty($company_business['main_content'][1]))?$company_business['main_content'][1]:''}}</div>

                                    <h3 class="des">{{(!empty($company_business['main_content'][2]))?$company_business['main_content'][2]:''}}</h3>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </section>
@endsection
@section('js')
<script>
    $('.who-slide').owlCarousel({
        margin:10,
        loop:true,
        items:2,
        responsive:{
        0:{
            items:1
        },
        600:{
            items:1
        },
        1000:{
            items:2
        }
    }
    })
    $('.core-inner').matchHeight();
    $('.item-mission').matchHeight();
    $('.item-company').matchHeight();
</script>
@endsection
