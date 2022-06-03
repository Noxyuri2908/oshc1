@extends('back-end.layouts.main')

@section('title')
    About Us
    @parent
@stop

@section('css')
    <link href="{{asset('backend/css/plugins/dataTables/datatables.min.css')}}" rel="stylesheet">
@stop

{{-- Page content --}}
@section('content')
<input type="hidden" id="ckeditor_path" value="{{\Config::get('lfm.CKEDITOR_PATH')}}">

    <div class="container-fluid" style="overflow: hidden">
        <form action="{{route('about-us.store')}}" method="get" id="about">
            <div class="about-us-banner about-us-form">
                <h1>Ảnh bìa</h1>
                <div class="mb-20">
                    <div class="row mb-20">
                        <div class="col-md-1">
                            <span class="input-group-btn">
                            <a href="{{\Config::get('lfm.URL_FILEMANAGE_ARR')}}thumb_0"
                               class="btn btn-primary red iframe-btn" id="iframe-btn-0"><i
                                    class="fa fa-picture-o"></i>Chọn</a>
                        </span>
                        </div>
                        <div class="col-md-11">
                            @if(isset($content['image_banner']))
                                <input id="thumb_0" class="form-control" type="text" name="image_banner"
                                       value="{{$content['image_banner']}}"
                                       >
                            @else
                                <input id="thumb_0" class="form-control" type="text" name="image_banner" >
                            @endif
                        </div>
                    </div>
                    <div id="preview_0">
                        @if(isset($content['image_banner']))
                            <img src="{{$content['image_banner']}}" style="max-width: 250px;">
                        @else
                        @endif
                    </div>
                </div>
                <div>
                    <label>Banner main content</label>
                    <div class="form-group">
                        <textarea type="text" class="form-control"
                                  name="banner_main_content">{{(!empty($content['banner_main_content']))?$content['banner_main_content']:''}}</textarea>
                    </div>
                </div>
                <div>
                    <label>Banner sub content</label>
                    <div class="form-group">
                        <textarea type="text" class="form-control my-editor" id="content"
                                  name="banner_sub_content">{{(!empty($content['banner_sub_content']))?$content['banner_sub_content']:''}}</textarea>
                    </div>
                </div>
            </div>
            <div class="mt-50 about-us-form">
            <input name="title-1" value="{{(!empty($content['title-1']))?$content['title-1']:''}}" class="form-control">
                <div>
                    <label>Main content</label>
                    <div class="form-group">
                        <textarea type="text" class="form-control"
                                  name="who_we_are_content">{{(!empty($content['who_we_are_content']))?$content['who_we_are_content']:''}}</textarea>
                    </div>
                </div>
                <div>
                    <label>Slide image</label>
                    <div class="row">
                        <div class="col-md-1">
                            <span class="input-group">
                                <a href="{{\Config::get('lfm.URL_FILEMANAGE_ARR')}}thumb_1"
                                   class="btn btn-primary red iframe-btn" id="iframe-btn-1"><i
                                        class="fa fa-picture-o"></i>Chọn</a>
                            </span>
                        </div>
                        <div class="col-md-11">
                            @if(isset($content['image_slide_who_we_are']))
                                <input id="thumb_1" class="form-control" type="text" name="image_slide_who_we_are"
                                       value="{{$content['image_slide_who_we_are']}}"
                                       >
                            @else
                                <input id="thumb_1" class="form-control" type="text" name="image_slide_who_we_are"
                                       >
                            @endif
                        </div>
                    </div>
                    <div id="preview_1" class="mt-20">
                        <div class="owl-carousel owl-theme">
                        @if(isset($content['image_slide_who_we_are']))
                            @if(is_array(json_decode($content['image_slide_who_we_are'])))
                                @foreach(json_decode($content['image_slide_who_we_are']) as $img)
                                        <div class="item"><img src="{{$img}}" style="max-width: 250px;"></div>
                                @endforeach
                            @else
                                <img src="{{$content['image_slide_who_we_are']}}" style="max-width: 250px;">
                            @endif
                        @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="mt-50 about-us-form">
                <div>
                    <h1>Youtube</h1>
                    <div id="link-youtube-group" class="form-group">
                        <label>Link video</label>
                        @if(!empty($content['link_youtube']))
                            @foreach($content['link_youtube'] as $key=>$link)
                                @if($key > 0)
                                    <div class="fieldwrapper row " id="field{{$loop->index}}">
                                        <div class="col-md-11">
                                            <input type="text" class="form-control input-link-youtube"
                                                   value="{{(!empty($link))?$link:''}}"
                                                   name="link_youtube[]" placeholder="Link youtube" required>
                                        </div>
                                        <div class="col-md-1">
                                            <input type="button" class="remove" value="-">
                                        </div>
                                    </div>

                                @else
                                    <div>
                                        <input type="text" class="form-control input-link-youtube"
                                               value="{{(!empty($link))?$link:''}}"
                                               name="link_youtube[]" placeholder="Link youtube" required>
                                    </div>
                                @endif
                            @endforeach
                        @else
                            <div>
                                <input type="text" class="input-link-youtube"
                                       value=""
                                       name="link_youtube[]" placeholder="Link youtube" required>
                            </div>
                        @endif
                    </div>
                    <a class="plus-youtube" href="#">Add link +</a>
                </div>
            </div>
            <div class="mt-50 about-us-form">
                <input name="title-2" value="{{(!empty($content['title-2']))?$content['title-2']:''}}" class="form-control">
                <div class="form-group">
                    <label>Core value main content</label>
                    <textarea type="text" class="form-control" name="core_value_main_content"
                              value="">{{(!empty($content['core_value_main_content']))?$content['core_value_main_content']:''}}</textarea>
                </div>
                <div class="form-group about-us-form">
                    <h2>Box Content Title 1</h2>
                    <div>
                        <div class="form-group">
                            <label>Core value main content 1</label>
                            <textarea type="text" class="form-control"
                                      name="core_value_main_content_1">{{(!empty($content['core_value_main_content_1']))?$content['core_value_main_content_1']:''}}</textarea>
                        </div>
                        <div>
                            <label>
                                Icon 1
                            </label>
                            <div class="row">
                                <div class="col-md-1">
                                    <span class="input-group-btn">
                                        <a href="{{\Config::get('lfm.URL_FILEMANAGE_ARR')}}core_value_thumb_1"
                                           class="btn btn-primary red iframe-btn" id="core_value_iframe-btn-1"><i
                                                class="fa fa-picture-o"></i>Chọn</a>
                                    </span>
                                </div>
                                <div class="col-md-11">
                                    @if(isset($content['core_value_image_1']))
                                        <input id="core_value_thumb_1" class="form-control" type="text"
                                               name="core_value_image_1"
                                               value="{{$content['core_value_image_1']}}"
                                               required>
                                    @else
                                        <input id="core_value_thumb_1" class="form-control" type="text"
                                               name="core_value_image_1" required>
                                    @endif

                                </div>
                            </div>
                            <div id="core_value_preview_1" class="mt-20">
                                @if(isset($content['core_value_image_1']))
                                    <img src="{{$content['core_value_image_1']}}" style="max-width: 250px;">
                                @else
                                @endif
                            </div>
                        </div>
                        <label>Core value sub content 1</label>
                        <textarea type="text" class="form-control"
                                  name="box_core_value_title_1">{{(!empty($content['box_core_value_title_1']))?$content['box_core_value_title_1']:''}}</textarea>
                    </div>
                </div>
                <div class="form-group about-us-form">
                    <h2>Box Content Title 2</h2>
                    <div>
                        <div class="form-group">
                            <label>Core value main content 2</label>
                            <textarea type="text" class="form-control"
                                      name="core_value_main_content_2">{{(!empty($content['core_value_main_content_2']))?$content['core_value_main_content_2']:''}}</textarea>
                        </div>
                        <div>
                            <label>
                                Icon 2
                            </label>
                            <div class="row">
                                <div class="col-md-1">
                                    <span class="input-group-btn">
                                        <a href="{{\Config::get('lfm.URL_FILEMANAGE_ARR')}}core_value_thumb_2"
                                           class="btn btn-primary red iframe-btn" id="core_value_iframe-btn-2"><i
                                                class="fa fa-picture-o"></i>Chọn</a>
                                    </span>
                                </div>
                                <div class="col-md-11">
                                    @if(isset($content['core_value_image_2']))
                                        <input id="core_value_thumb_2" class="form-control" type="text"
                                               name="core_value_image_2"
                                               value="{{$content['core_value_image_2']}}"
                                               required>
                                    @else
                                        <input id="core_value_thumb_2" class="form-control" type="text"
                                               name="core_value_image_2" required>
                                    @endif

                                </div>
                            </div>
                            <div id="core_value_preview_2" class="mt-20">
                                @if(isset($content['core_value_image_2']))
                                    <img src="{{$content['core_value_image_2']}}" style="max-width: 250px;">
                                @else
                                @endif
                            </div>
                        </div>
                        <label>Core value sub content 2</label>
                        <textarea type="text" class="form-control"
                                  name="box_core_value_title_2">{{(!empty($content['box_core_value_title_2']))?$content['box_core_value_title_2']:''}}</textarea>
                    </div>
                </div>
                <div class="form-group about-us-form">
                    <h2>Box Content Title 3</h2>
                    <div>
                        <div class="form-group">
                            <label>Core value main content 3</label>
                            <textarea type="text" class="form-control"
                                      name="core_value_main_content_3">{{(!empty($content['core_value_main_content_3']))?$content['core_value_main_content_3']:''}}</textarea>
                        </div>
                        <div>
                            <label>
                                Icon 3
                            </label>
                            <div class="row">
                                <div class="col-md-1">
                                    <span class="input-group-btn">
                                        <a href="{{\Config::get('lfm.URL_FILEMANAGE_ARR')}}core_value_thumb_3"
                                           class="btn btn-primary red iframe-btn" id="core_value_iframe-btn-3"><i
                                                class="fa fa-picture-o"></i>Chọn</a>
                                    </span>
                                </div>
                                <div class="col-md-11">
                                    @if(isset($content['core_value_image_3']))
                                        <input id="core_value_thumb_3" class="form-control" type="text"
                                               name="core_value_image_3"
                                               value="{{$content['core_value_image_3']}}"
                                               required>
                                    @else
                                        <input id="core_value_thumb_3" class="form-control" type="text"
                                               name="core_value_image_3" required>
                                    @endif

                                </div>
                            </div>
                            <div id="core_value_preview_3" class="mt-20">
                                @if(isset($content['core_value_image_3']))
                                    <img src="{{$content['core_value_image_3']}}" style="max-width: 250px;">
                                @else
                                @endif
                            </div>
                        </div>
                        <label>Core value sub content 3</label>
                        <textarea type="text" class="form-control"
                                  name="box_core_value_title_3">{{(!empty($content['box_core_value_title_3']))?$content['box_core_value_title_3']:''}}</textarea>
                    </div>
                </div>
                <div class="form-group about-us-form">
                    <h2>Box Content Title 4</h2>
                    <div>
                        <div class="form-group">
                            <label>Core value main content 4</label>
                            <textarea type="text" class="form-control"
                                      name="core_value_main_content_4">{{(!empty($content['core_value_main_content_4']))?$content['core_value_main_content_4']:''}}</textarea>
                        </div>
                        <div>
                            <label>
                                Icon 4
                            </label>
                            <div class="row">
                                <div class="col-md-1">
                                    <span class="input-group-btn">
                                        <a href="{{\Config::get('lfm.URL_FILEMANAGE_ARR')}}core_value_thumb_4"
                                           class="btn btn-primary red iframe-btn" id="core_value_iframe-btn-4"><i
                                                class="fa fa-picture-o"></i>Chọn</a>
                                    </span>
                                </div>
                                <div class="col-md-11">
                                    @if(isset($content['core_value_image_4']))
                                        <input id="core_value_thumb_4" class="form-control" type="text"
                                               name="core_value_image_4"
                                               value="{{$content['core_value_image_4']}}"
                                               required>
                                    @else
                                        <input id="core_value_thumb_4" class="form-control" type="text"
                                               name="core_value_image_4" required>
                                    @endif

                                </div>
                            </div>
                            <div id="core_value_preview_4" class="mt-20">
                                @if(isset($content['core_value_image_4']))
                                    <img src="{{$content['core_value_image_4']}}" style="max-width: 250px;">
                                @else
                                @endif
                            </div>
                        </div>
                        <label>Core value sub content 4</label>
                        <textarea type="text" class="form-control"
                                  name="box_core_value_title_4">{{(!empty($content['box_core_value_title_4']))?$content['box_core_value_title_4']:''}}</textarea>
                    </div>
                </div>
            </div>
            <div class="mt-50 about-us-form">
                <input name="title-3" value="{{(!empty($content['title-3']))?$content['title-3']:''}}" class="form-control">
                <div class="form-group">
                    <label>Our Mission main content</label>
                    <textarea type="text" class="form-control"
                              name="our_mission_main_content">{{(!empty($content['our_mission_main_content']))?$content['our_mission_main_content']:''}}</textarea>
                </div>
                <div class="form-group about-us-form">
                    <h2>Our Mission 1</h2>
                    <div>
                        <div class="form-group">
                            <label>Our Mission main content 1</label>
                            <textarea class="form-control" type="text"
                                      name="our_mission_main_content_1">{{(!empty($content['our_mission_main_content_1']))?$content['our_mission_main_content_1']:''}}</textarea>
                        </div>
                        <div>
                            <label>
                                Icon 1
                            </label>
                            <div class="row">
                                <div class="col-md-1">
                                    <span class="input-group-btn">
                                        <a href="{{\Config::get('lfm.URL_FILEMANAGE_ARR')}}our_mission_thumb_1"
                                           class="btn btn-primary red iframe-btn" id="our_mission_iframe-btn-1"><i
                                                class="fa fa-picture-o"></i>Chọn</a>
                                    </span>
                                </div>
                                <div class="col-md-11">
                                    @if(isset($content['our_mission_image_banner_1']))
                                        <input id="our_mission_thumb_1" class="form-control" type="text"
                                               name="our_mission_image_banner_1"
                                               value="{{$content['our_mission_image_banner_1']}}"
                                               required>
                                    @else
                                        <input id="our_mission_thumb_1" class="form-control" type="text"
                                               name="our_mission_image_banner_1"
                                               required>
                                    @endif
                                </div>
                            </div>


                            <div id="our_mission_preview_1" class="mt-20">
                                @if(isset($content['our_mission_image_banner_1']))
                                    <img src="{{$content['our_mission_image_banner_1']}}" style="max-width: 250px;">
                                @else
                                @endif
                            </div>
                        </div>
                        <label>Our Mission sub content 1</label>
                        <textarea type="text" class="form-control"
                                  name="our_mission_value_title_1">{{(!empty($content['our_mission_value_title_1']))?$content['our_mission_value_title_1']:''}}</textarea>
                    </div>
                </div>
                <div class="form-group about-us-form">
                    <h2>Our Mission Title 2</h2>
                    <div>
                        <div class="form-group">
                            <label>Our Mission main content 2</label>
                            <textarea class="form-control" type="text"
                                      name="our_mission_main_content_2">{{(!empty($content['our_mission_main_content_2']))?$content['our_mission_main_content_2']:''}}</textarea>
                        </div>
                        <div>
                            <label>
                                Icon 2
                            </label>
                            <div class="row">
                                <div class="col-md-1">
                                    <span class="input-group-btn">
                                        <a href="{{\Config::get('lfm.URL_FILEMANAGE_ARR')}}our_mission_thumb_2"
                                           class="btn btn-primary red iframe-btn" id="our_mission_iframe-btn-2"><i
                                                class="fa fa-picture-o"></i>Chọn</a>
                                    </span>
                                </div>
                                <div class="col-md-11">
                                    @if(isset($content['our_mission_image_banner_2']))
                                        <input id="our_mission_thumb_2" class="form-control" type="text"
                                               name="our_mission_image_banner_2"
                                               value="{{$content['our_mission_image_banner_2']}}"
                                               required>
                                    @else
                                        <input id="our_mission_thumb_2" class="form-control" type="text"
                                               name="our_mission_image_banner_2"
                                               required>
                                    @endif
                                </div>
                            </div>


                            <div id="our_mission_preview_2" class="mt-20">
                                @if(isset($content['our_mission_image_banner_2']))
                                    <img src="{{$content['our_mission_image_banner_2']}}" style="max-width: 250px;">
                                @else
                                @endif
                            </div>
                        </div>
                        <label>Our Mission sub content 2</label>
                        <textarea type="text" class="form-control"
                                  name="our_mission_value_title_2">{{(!empty($content['our_mission_value_title_2']))?$content['our_mission_value_title_2']:''}}</textarea>
                    </div>
                </div>
                <div class="form-group about-us-form">
                    <h2>Our Mission Title 3</h2>
                    <div>
                        <div class="form-group">
                            <label>Our Mission main content 3</label>
                            <textarea class="form-control" type="text"
                                      name="our_mission_main_content_3">{{(!empty($content['our_mission_main_content_3']))?$content['our_mission_main_content_3']:''}}</textarea>
                        </div>
                        <div>
                            <label>
                                Icon 3
                            </label>
                            <div class="row">
                                <div class="col-md-1">
                                    <span class="input-group-btn">
                                        <a href="{{\Config::get('lfm.URL_FILEMANAGE_ARR')}}our_mission_thumb_3"
                                           class="btn btn-primary red iframe-btn" id="our_mission_iframe-btn-3"><i
                                                class="fa fa-picture-o"></i>Chọn</a>
                                    </span>
                                </div>
                                <div class="col-md-11">
                                    @if(isset($content['our_mission_image_banner_3']))
                                        <input id="our_mission_thumb_3" class="form-control" type="text"
                                               name="our_mission_image_banner_3"
                                               value="{{$content['our_mission_image_banner_3']}}"
                                               required>
                                    @else
                                        <input id="our_mission_thumb_3" class="form-control" type="text"
                                               name="our_mission_image_banner_3"
                                               required>
                                    @endif
                                </div>
                            </div>


                            <div id="our_mission_preview_3" class="mt-20">
                                @if(isset($content['our_mission_image_banner_3']))
                                    <img src="{{$content['our_mission_image_banner_3']}}" style="max-width: 250px;">
                                @else
                                @endif
                            </div>
                        </div>
                        <label>Our Mission sub content 3</label>
                        <textarea type="text" class="form-control"
                                  name="our_mission_value_title_3">{{(!empty($content['our_mission_value_title_3']))?$content['our_mission_value_title_3']:''}}</textarea>
                    </div>
                </div>
                <div class="form-group about-us-form">
                    <h2>Our Mission Title 4</h2>
                    <div>
                        <div class="form-group">
                            <label>Our Mission main content 4</label>
                            <textarea class="form-control" type="text"
                                      name="our_mission_main_content_4">{{(!empty($content['our_mission_main_content_4']))?$content['our_mission_main_content_4']:''}}</textarea>
                        </div>
                        <div>
                            <label>
                                Icon 4
                            </label>
                            <div class="row">
                                <div class="col-md-1">
                                    <span class="input-group-btn">
                                        <a href="{{\Config::get('lfm.URL_FILEMANAGE_ARR')}}our_mission_thumb_4"
                                           class="btn btn-primary red iframe-btn" id="our_mission_iframe-btn-4"><i
                                                class="fa fa-picture-o"></i>Chọn</a>
                                    </span>
                                </div>
                                <div class="col-md-11">
                                    @if(isset($content['our_mission_image_banner_4']))
                                        <input id="our_mission_thumb_4" class="form-control" type="text"
                                               name="our_mission_image_banner_4"
                                               value="{{$content['our_mission_image_banner_4']}}"
                                               required>
                                    @else
                                        <input id="our_mission_thumb_4" class="form-control" type="text"
                                               name="our_mission_image_banner_4"
                                               required>
                                    @endif
                                </div>
                            </div>


                            <div id="our_mission_preview_4" class="mt-20">
                                @if(isset($content['our_mission_image_banner_4']))
                                    <img src="{{$content['our_mission_image_banner_4']}}" style="max-width: 250px;">
                                @else
                                @endif
                            </div>
                        </div>
                        <label>Our Mission sub content 4</label>
                        <textarea type="text" class="form-control"
                                  name="our_mission_value_title_4">{{(!empty($content['our_mission_value_title_4']))?$content['our_mission_value_title_4']:''}}</textarea>
                    </div>
                </div>
            </div>
            <div class="mt-50 about-us-form">
                <input name="title-4" value="{{(!empty($content['title-4']))?$content['title-4']:''}}" class="form-control">
                <div class="form-group">
                    <label>Company Business Parameters main content</label>
                    <textarea type="text" class="form-control"
                              name="company_business_main_content">{{(!empty($content['company_business_main_content']))?$content['company_business_main_content']:''}}</textarea>
                </div>
                <div class="form-group about-us-form">
                    <h2>Company Business Parameters 1</h2>
                    <div>
                        <div>
                            <label>
                                Icon 1
                            </label>
                            <div class="row">
                                <div class="col-md-1">
                                    <span class="input-group-btn">
                                        <a href="{{\Config::get('lfm.URL_FILEMANAGE_ARR')}}company_business_main_thumb_1"
                                           class="btn btn-primary red iframe-btn"
                                           id="company_business_main_iframe-btn-1"><i
                                                class="fa fa-picture-o"></i>Chọn</a>
                                    </span>
                                </div>
                                <div class="col-md-11">
                                    @if(isset($content['company_business_image_banner_1']))
                                        <input id="company_business_main_thumb_1" class="form-control" type="text"
                                               name="company_business_image_banner_1"
                                               value="{{$content['company_business_image_banner_1']}}"
                                               required>
                                    @else
                                        <input id="company_business_main_thumb_1" class="form-control" type="text"
                                               name="company_business_image_banner_1" required>
                                    @endif
                                </div>
                            </div>
                            <div id="company_business_main_preview_1">
                                @if(isset($content['company_business_image_banner_1']))
                                    <img src="{{$content['company_business_image_banner_1']}}"
                                         style="max-width: 250px;">
                                @else
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Company Business Parameters Title 1_1</label>
                            <textarea type="text" class="form-control"
                                      name="company_business_main_content_1[]">{{(!empty($content['company_business_main_content_1'][0]))?$content['company_business_main_content_1'][0]:''}}</textarea>
                        </div>
                        <div class="form-group">
                            <label>Company Business Parameters Title 1_2</label>
                            <textarea type="text" class="form-control"
                                      name="company_business_main_content_1[]">{{(!empty($content['company_business_main_content_1'][1]))?$content['company_business_main_content_1'][1]:''}}</textarea>
                        </div>
                        <div class="form-group">
                            <label>Company Business Parameters Title 1_3</label>
                            <textarea type="text" class="form-control"
                                      name="company_business_main_content_1[]">{{(!empty($content['company_business_main_content_1'][2]))?$content['company_business_main_content_1'][2]:''}}</textarea>
                        </div>
                    </div>
                </div>
                <div class="form-group about-us-form">
                    <h2>Company Business Parameters 2</h2>
                    <div>
                        <div>
                            <label>
                                Icon 2
                            </label>
                            <div class="row">
                                <div class="col-md-1">
                                    <span class="input-group-btn">
                                        <a href="{{\Config::get('lfm.URL_FILEMANAGE_ARR')}}company_business_main_thumb_2"
                                           class="btn btn-primary red iframe-btn"
                                           id="company_business_main_iframe-btn-2"><i
                                                class="fa fa-picture-o"></i>Chọn</a>
                                    </span>
                                </div>
                                <div class="col-md-11">
                                    @if(isset($content['company_business_image_banner_2']))
                                        <input id="company_business_main_thumb_2" class="form-control" type="text"
                                               name="company_business_image_banner_2"
                                               value="{{$content['company_business_image_banner_2']}}"
                                               required>
                                    @else
                                        <input id="company_business_main_thumb_2" class="form-control" type="text"
                                               name="company_business_image_banner_2" required>
                                    @endif
                                </div>
                            </div>
                            <div id="company_business_main_preview_2">
                                @if(isset($content['company_business_image_banner_2']))
                                    <img src="{{$content['company_business_image_banner_2']}}"
                                         style="max-width: 250px;">
                                @else
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Company Business Parameters Title 2_1</label>
                            <textarea type="text" class="form-control"
                                      name="company_business_main_content_2[]">{{(!empty($content['company_business_main_content_2'][0]))?$content['company_business_main_content_2'][0]:''}}</textarea>
                        </div>
                        <div class="form-group">
                            <label>Company Business Parameters Title 2_2</label>
                            <textarea type="text" class="form-control"
                                      name="company_business_main_content_2[]">{{(!empty($content['company_business_main_content_2'][1]))?$content['company_business_main_content_2'][1]:''}}</textarea>
                        </div>
                        <div class="form-group">
                            <label>Company Business Parameters Title 2_3</label>
                            <textarea type="text" class="form-control"
                                      name="company_business_main_content_2[]">{{(!empty($content['company_business_main_content_2'][2]))?$content['company_business_main_content_2'][2]:''}}</textarea>
                        </div>
                    </div>
                </div>
                <div class="form-group about-us-form">
                    <h2>Company Business Parameters 3</h2>
                    <div>
                        <div>
                            <label>
                                Icon 3
                            </label>
                            <div class="row">
                                <div class="col-md-1">
                                    <span class="input-group-btn">
                                        <a href="{{\Config::get('lfm.URL_FILEMANAGE_ARR')}}company_business_main_thumb_3"
                                           class="btn btn-primary red iframe-btn"
                                           id="company_business_main_iframe-btn-3"><i
                                                class="fa fa-picture-o"></i>Chọn</a>
                                    </span>
                                </div>
                                <div class="col-md-11">
                                    @if(isset($content['company_business_image_banner_3']))
                                        <input id="company_business_main_thumb_3" class="form-control" type="text"
                                               name="company_business_image_banner_3"
                                               value="{{$content['company_business_image_banner_3']}}"
                                               required>
                                    @else
                                        <input id="company_business_main_thumb_3" class="form-control" type="text"
                                               name="company_business_image_banner_3" required>
                                    @endif
                                </div>
                            </div>
                            <div id="company_business_main_preview_3">
                                @if(isset($content['company_business_image_banner_3']))
                                    <img src="{{$content['company_business_image_banner_3']}}"
                                         style="max-width: 250px;">
                                @else
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Company Business Parameters Title 3_1</label>
                            <textarea type="text" class="form-control"
                                      name="company_business_main_content_3[]">{{(!empty($content['company_business_main_content_3'][0]))?$content['company_business_main_content_3'][0]:''}}</textarea>
                        </div>
                        <div class="form-group">
                            <label>Company Business Parameters Title 3_2</label>
                            <textarea type="text" class="form-control"
                                      name="company_business_main_content_3[]">{{(!empty($content['company_business_main_content_3'][1]))?$content['company_business_main_content_3'][1]:''}}</textarea>
                        </div>
                        <div class="form-group">
                            <label>Company Business Parameters Title 3_3</label>
                            <textarea type="text" class="form-control"
                                      name="company_business_main_content_3[]">{{(!empty($content['company_business_main_content_3'][2]))?$content['company_business_main_content_3'][2]:''}}</textarea>
                        </div>
                    </div>
                </div>
                <div class="form-group about-us-form">
                    <h2>Company Business Parameters 4</h2>
                    <div>
                        <div>
                            <label>
                                Icon 4
                            </label>
                            <div class="row">
                                <div class="col-md-1">
                                    <span class="input-group-btn">
                                        <a href="{{\Config::get('lfm.URL_FILEMANAGE_ARR')}}company_business_main_thumb_4"
                                           class="btn btn-primary red iframe-btn"
                                           id="company_business_main_iframe-btn-4"><i
                                                class="fa fa-picture-o"></i>Chọn</a>
                                    </span>
                                </div>
                                <div class="col-md-11">
                                    @if(isset($content['company_business_image_banner_4']))
                                        <input id="company_business_main_thumb_4" class="form-control" type="text"
                                               name="company_business_image_banner_4"
                                               value="{{$content['company_business_image_banner_4']}}"
                                               required>
                                    @else
                                        <input id="company_business_main_thumb_4" class="form-control" type="text"
                                               name="company_business_image_banner_4" required>
                                    @endif
                                </div>
                            </div>
                            <div id="company_business_main_preview_4">
                                @if(isset($content['company_business_image_banner_4']))
                                    <img src="{{$content['company_business_image_banner_4']}}"
                                         style="max-width: 250px;">
                                @else
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Company Business Parameters Title 4_1</label>
                            <textarea type="text" class="form-control"
                                      name="company_business_main_content_4[]">{{(!empty($content['company_business_main_content_4'][0]))?$content['company_business_main_content_4'][0]:''}}</textarea>
                        </div>
                        <div class="form-group">
                            <label>Company Business Parameters Title 4_2</label>
                            <textarea type="text" class="form-control"
                                      name="company_business_main_content_4[]">{{(!empty($content['company_business_main_content_4'][1]))?$content['company_business_main_content_4'][1]:''}}</textarea>
                        </div>
                        <div class="form-group">
                            <label>Company Business Parameters Title 4_3</label>
                            <textarea type="text" class="form-control"
                                      name="company_business_main_content_4[]">{{(!empty($content['company_business_main_content_4'][2]))?$content['company_business_main_content_4'][2]:''}}</textarea>
                        </div>
                    </div>
                </div>
            </div>
            <button type="submit" class="form-control" style=" border: 1px solid #000; border-radius:10px;color: #000;background-color: #f3f3f4;width: 75px;height: 75px; text-align: center;position: fixed;bottom: 10px;right: 10px">Save</button>
        </form>
    </div>
@endsection
@section('js')
    <link rel="stylesheet" type="text/css" href="{{asset('backend/css/plugins/owl-carousel/owl.carousel.min.css')}}"/>
    <link rel="stylesheet" type="text/css" href="{{asset('backend/css/plugins/owl-carousel/owl.theme.default.min.css')}}"/>
    <script type="text/javascript" src="{{asset('backend/js/plugins/owl-carousel/owl.carousel.min.js')}}"></script>
    <script src="{{asset('backend/js/plugins/chosen/chosen.jquery.js')}}"></script>
    <script>
        var ckeditor_path = $("#ckeditor_path").val();
        $(document).ready(function() {
            settingIframe("#iframe-btn-0", "#thumb_0", "#preview_0");
            CKEDITOR.replace('content',{
                filebrowserBrowseUrl : ckeditor_path,
                filebrowserUploadUrl : ckeditor_path,
                filebrowserImageBrowseUrl : ckeditor_path,
            });
            $('.chosen-select').chosen({width: "100%"});
        });
    </script>
    <script>

        $(document).ready(function () {
            $('.owl-carousel').owlCarousel({
                margin:10,
                nav:true,
                touchDrag:true,
                responsive:{
                    0:{
                        items:1
                    },
                    600:{
                        items:3
                    },
                    1000:{
                        items:3
                    }
                }
            });

            $(".plus-youtube").click(function (e) {
                e.preventDefault();
                var lastField = $("#link-youtube-group div:last");
                var intId = (lastField && lastField.length && lastField.data("idx") + 1) || 1;

                var fieldWrapper = $("<div class=\"fieldwrapper row \" id=\"field" + intId + "\"/>");
                fieldWrapper.data("idx", intId);
                var fName = $("<div class=\"col-md-11\"><input type=\"text\" class=\"form-control input-link-youtube\" value=\"\" name=\"link_youtube[]\" placeholder=\"Link youtube\" required></div>");
                var removeButton = $("<div class=\"col-md-1\"><input type=\"button\" class=\"remove\" value=\"-\" /></div>");
                removeButton.click(function () {
                    $(this).parent().remove();
                });
                fieldWrapper.append(fName);
                fieldWrapper.append(removeButton);
                $("#link-youtube-group").append(fieldWrapper);
            });
            $(document).on('click', '.remove', function (e) {
                e.preventDefault();
                $(this).parent().parent().remove();
            })

            settingIframe("#iframe-btn-0", "#thumb_0", "#preview_0");
            settingIframeArr("#iframe-btn-1", "#thumb_1", "#preview_1");
            settingIframe("#iframe-btn-2", "#thumb_2", "#preview_2");
            settingIframe("#iframe-btn-3", "#thumb_3", "#preview_3");
            settingIframe("#iframe-btn-4", "#thumb_4", "#preview_4");
            settingIframe("#iframe-btn-5", "#thumb_5", "#preview_5");

            //core value
            settingIframe("#core_value_iframe-btn-1", "#core_value_thumb_1", "#core_value_preview_1");
            settingIframe("#core_value_iframe-btn-2", "#core_value_thumb_2", "#core_value_preview_2");
            settingIframe("#core_value_iframe-btn-3", "#core_value_thumb_3", "#core_value_preview_3");
            settingIframe("#core_value_iframe-btn-4", "#core_value_thumb_4", "#core_value_preview_4");
            //our_mission
            settingIframe("#our_mission_iframe-btn-1", "#our_mission_thumb_1", "#our_mission_preview_1");
            settingIframe("#our_mission_iframe-btn-2", "#our_mission_thumb_2", "#our_mission_preview_2");
            settingIframe("#our_mission_iframe-btn-3", "#our_mission_thumb_3", "#our_mission_preview_3");
            settingIframe("#our_mission_iframe-btn-4", "#our_mission_thumb_4", "#our_mission_preview_4");
            //Company Business Parameters
            settingIframe("#company_business_main_iframe-btn-1", "#company_business_main_thumb_1", "#company_business_main_preview_1");
            settingIframe("#company_business_main_iframe-btn-2", "#company_business_main_thumb_2", "#company_business_main_preview_2");
            settingIframe("#company_business_main_iframe-btn-3", "#company_business_main_thumb_3", "#company_business_main_preview_3");
            settingIframe("#company_business_main_iframe-btn-4", "#company_business_main_thumb_4", "#company_business_main_preview_4");

            $('.chosen-select').chosen({
                width: "100%",
                scroll_to_highlighted: false
            });
        });
    </script>
@endsection
