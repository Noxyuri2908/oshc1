@extends('back-end.layouts.main')

@section('title')
    Homepage
    @parent
@stop

@section('css')
    <link href="{{asset('backend/css/plugins/dataTables/datatables.min.css')}}" rel="stylesheet">
@stop

{{-- Page content --}}
@section('content')
<div class="container-fluid">
    <form action="{{route('home-page.store')}}" method="get" id="homepage">
        <div class="mt-50 about-us-form">
            <input name="title-1" value="{{(!empty($content['title-1']))?$content['title-1']:''}}" class="form-control">
            <div class="form-group">
                <label>Service home main content</label>
                <textarea type="text" class="form-control" name="service_home_main_content"
                          value="">{{(!empty($content['service_home_main_content']))?$content['service_home_main_content']:''}}</textarea>
            </div>
            <div class="form-group about-us-form">
                <h2>Box Content Title 1</h2>
                <div>
                    <div>
                        <label>
                            Icon 1
                        </label>
                        <div class="row">
                            <div class="col-md-1">
                                <span class="input-group-btn">
                                    <a href="{{\Config::get('lfm.URL_FILEMANAGE_ARR')}}service_home_thumb_1"
                                       class="btn btn-primary red iframe-btn" id="service_home_iframe-btn-1"><i
                                            class="fa fa-picture-o"></i>Chọn</a>
                                </span>
                            </div>
                            <div class="col-md-11">
                                @if(isset($content['service_home_image_1']))
                                    <input id="service_home_thumb_1" class="form-control" type="text"
                                           name="service_home_image_1"
                                           value="{{$content['service_home_image_1']}}"
                                           required>
                                @else
                                    <input id="service_home_thumb_1" class="form-control" type="text"
                                           name="service_home_image_1" required>
                                @endif

                            </div>
                        </div>
                        <div id="service_home_preview_1" class="mt-20">
                            @if(isset($content['service_home_image_1']))
                                <img src="{{$content['service_home_image_1']}}" style="max-width: 250px;">
                            @else
                            @endif
                        </div>
                    </div>
                    <label>Service home sub content 1</label>
                    <textarea type="text" class="form-control"
                              name="service_home_value_title_1">{{(!empty($content['service_home_value_title_1']))?$content['service_home_value_title_1']:''}}</textarea>
                    <label for="">Link</label>
                    <input type="text" value="{{(!empty($content['service_home_value_link_1']))?$content['service_home_value_link_1']:''}}"  name="service_home_value_link_1" class="form-control">
                    <input type="hidden" name="service_home_type_1" value="1">
                </div>
            </div>
            <div class="form-group about-us-form">
                <h2>Box Content Title 2</h2>
                <div>
                    <div>
                        <label>
                            Icon 2
                        </label>
                        <div class="row">
                            <div class="col-md-1">
                                <span class="input-group-btn">
                                    <a href="{{\Config::get('lfm.URL_FILEMANAGE_ARR')}}service_home_thumb_2"
                                       class="btn btn-primary red iframe-btn" id="service_home_iframe-btn-2"><i
                                            class="fa fa-picture-o"></i>Chọn</a>
                                </span>
                            </div>
                            <div class="col-md-11">
                                @if(isset($content['service_home_image_2']))
                                    <input id="service_home_thumb_2" class="form-control" type="text"
                                           name="service_home_image_2"
                                           value="{{$content['service_home_image_2']}}"
                                           required>
                                @else
                                    <input id="service_home_thumb_2" class="form-control" type="text"
                                           name="service_home_image_2" required>
                                @endif

                            </div>
                        </div>
                        <div id="service_home_preview_2" class="mt-20">
                            @if(isset($content['service_home_image_2']))
                                <img src="{{$content['service_home_image_2']}}" style="max-width: 250px;">
                            @else
                            @endif
                        </div>
                    </div>
                    <label>Service home sub content 2</label>
                    <textarea type="text" class="form-control"
                              name="service_home_value_title_2">{{(!empty($content['service_home_value_title_2']))?$content['service_home_value_title_2']:''}}</textarea>
                    <input type="hidden" name="service_home_type_2" value="2">
                    <label for="">Link</label>
                    <input type="text" value="{{(!empty($content['service_home_value_link_2']))?$content['service_home_value_link_2']:''}}"  name="service_home_value_link_2" class="form-control">
                </div>
            </div>
            <div class="form-group about-us-form">
                <h2>Box Content Title 3</h2>
                <div>
                    <div>
                        <label>
                            Icon 3
                        </label>
                        <div class="row">
                            <div class="col-md-1">
                                <span class="input-group-btn">
                                    <a href="{{\Config::get('lfm.URL_FILEMANAGE_ARR')}}service_home_thumb_3"
                                       class="btn btn-primary red iframe-btn" id="service_home_iframe-btn-3"><i
                                            class="fa fa-picture-o"></i>Chọn</a>
                                </span>
                            </div>
                            <div class="col-md-11">
                                @if(isset($content['service_home_image_3']))
                                    <input id="service_home_thumb_3" class="form-control" type="text"
                                           name="service_home_image_3"
                                           value="{{$content['service_home_image_3']}}"
                                           required>
                                @else
                                    <input id="service_home_thumb_3" class="form-control" type="text"
                                           name="service_home_image_3" required>
                                @endif

                            </div>
                        </div>
                        <div id="service_home_preview_3" class="mt-20">
                            @if(isset($content['service_home_image_3']))
                                <img src="{{$content['service_home_image_3']}}" style="max-width: 250px;">
                            @else
                            @endif
                        </div>
                    </div>
                    <label>Service home sub content 3</label>
                    <textarea type="text" class="form-control"
                              name="service_home_value_title_3">{{(!empty($content['service_home_value_title_3']))?$content['service_home_value_title_3']:''}}</textarea>
                              <input type="hidden" name="service_home_type_3" value="2">
                              <label for="">Link</label>
                              <input value="{{(!empty($content['service_home_value_link_3']))?$content['service_home_value_link_3']:''}}"  type="text" name="service_home_value_link_3" class="form-control">
                            </div>
            </div>
            <div class="form-group about-us-form">
                <h2>Box Content Title 4</h2>
                <div>
                    <div>
                        <label>
                            Icon 4
                        </label>
                        <div class="row">
                            <div class="col-md-1">
                                <span class="input-group-btn">
                                    <a href="{{\Config::get('lfm.URL_FILEMANAGE_ARR')}}service_home_thumb_4"
                                       class="btn btn-primary red iframe-btn" id="service_home_iframe-btn-4"><i
                                            class="fa fa-picture-o"></i>Chọn</a>
                                </span>
                            </div>
                            <div class="col-md-11">
                                @if(isset($content['service_home_image_4']))
                                    <input id="service_home_thumb_4" class="form-control" type="text"
                                           name="service_home_image_4"
                                           value="{{$content['service_home_image_4']}}"
                                           required>
                                @else
                                    <input id="service_home_thumb_4" class="form-control" type="text"
                                           name="service_home_image_4" required>
                                @endif

                            </div>
                        </div>
                        <div id="service_home_preview_4" class="mt-20">
                            @if(isset($content['service_home_image_4']))
                                <img src="{{$content['service_home_image_4']}}" style="max-width: 250px;">
                            @else
                            @endif
                        </div>
                    </div>
                    <label>Service home sub content 4</label>
                    <textarea type="text" class="form-control"
                              name="service_home_value_title_4">{{(!empty($content['service_home_value_title_4']))?$content['service_home_value_title_4']:''}}</textarea>
                              <input type="hidden" name="service_home_type_4" value="2">
                              <label for="">Link</label>
                              <input type="text" value="{{(!empty($content['service_home_value_link_4']))?$content['service_home_value_link_4']:''}}"  name="service_home_value_link_4" class="form-control">
                            </div>
            </div>
            <div class="form-group about-us-form">
                <h2>Box Content Title 5</h2>
                <div>
                    <div>
                        <label>
                            Icon 5
                        </label>
                        <div class="row">
                            <div class="col-md-5">
                                <span class="input-group-btn">
                                    <a href="{{\Config::get('lfm.URL_FILEMANAGE_ARR')}}service_home_thumb_5"
                                       class="btn btn-primary red iframe-btn" id="service_home_iframe-btn-5"><i
                                            class="fa fa-picture-o"></i>Chọn</a>
                                </span>
                            </div>
                            <div class="col-md-11">
                                @if(isset($content['service_home_image_5']))
                                    <input id="service_home_thumb_5" class="form-control" type="text"
                                           name="service_home_image_5"
                                           value="{{$content['service_home_image_5']}}"
                                           required>
                                @else
                                    <input id="service_home_thumb_5" class="form-control" type="text"
                                           name="service_home_image_5" required>
                                @endif

                            </div>
                        </div>
                        <div id="service_home_preview_5" class="mt-20">
                            @if(isset($content['service_home_image_5']))
                                <img src="{{$content['service_home_image_5']}}" style="max-width: 250px;">
                            @else
                            @endif
                        </div>
                    </div>
                    <label>Service home sub content 5</label>
                    <textarea type="text" class="form-control"
                              name="service_home_value_title_5">{{(!empty($content['service_home_value_title_5']))?$content['service_home_value_title_5']:''}}</textarea>
                              <input type="hidden" name="service_home_type_5" value="2">
                              <label for="">Link</label>
                              <input type="text" value="{{(!empty($content['service_home_value_link_5']))?$content['service_home_value_link_5']:''}}"  name="service_home_value_link_5" class="form-control">
                            </div>
            </div>
            <div class="form-group about-us-form">
                <h2>Box Content Title 6</h2>
                <div>
                    <div>
                        <label>
                            Icon 6
                        </label>
                        <div class="row">
                            <div class="col-md-1">
                                <span class="input-group-btn">
                                    <a href="{{\Config::get('lfm.URL_FILEMANAGE_ARR')}}service_home_thumb_6"
                                       class="btn btn-primary red iframe-btn" id="service_home_iframe-btn-6"><i
                                            class="fa fa-picture-o"></i>Chọn</a>
                                </span>
                            </div>
                            <div class="col-md-11">
                                @if(isset($content['service_home_image_6']))
                                    <input id="service_home_thumb_6" class="form-control" type="text"
                                           name="service_home_image_6"
                                           value="{{$content['service_home_image_6']}}"
                                           required>
                                @else
                                    <input id="service_home_thumb_6" class="form-control" type="text"
                                           name="service_home_image_6" required>
                                @endif

                            </div>
                        </div>
                        <div id="service_home_preview_6" class="mt-20">
                            @if(isset($content['service_home_image_6']))
                                <img src="{{$content['service_home_image_6']}}" style="max-width: 250px;">
                            @else
                            @endif
                        </div>
                    </div>
                    <label>Service home sub content 6</label>
                    <textarea type="text" class="form-control"
                              name="service_home_value_title_6">{{(!empty($content['service_home_value_title_6']))?$content['service_home_value_title_6']:''}}</textarea>
                              <input type="hidden" name="service_home_type_6" value="2">
                              <label for="">Link</label>
                              <input type="text" name="service_home_value_link_6" value="{{(!empty($content['service_home_value_link_6']))?$content['service_home_value_link_6']:''}}"  class="form-control">
                            </div>
            </div>
            <div class="form-group about-us-form">
                <h2>Box Content Title 7</h2>
                <div>
                    <div>
                        <label>
                            Icon 7
                        </label>
                        <div class="row">
                            <div class="col-md-1">
                                <span class="input-group-btn">
                                    <a href="{{\Config::get('lfm.URL_FILEMANAGE_ARR')}}service_home_thumb_7"
                                       class="btn btn-primary red iframe-btn" id="service_home_iframe-btn-7"><i
                                            class="fa fa-picture-o"></i>Chọn</a>
                                </span>
                            </div>
                            <div class="col-md-11">
                                @if(isset($content['service_home_image_7']))
                                    <input id="service_home_thumb_7" class="form-control" type="text"
                                           name="service_home_image_7"
                                           value="{{$content['service_home_image_7']}}"
                                           required>
                                @else
                                    <input id="service_home_thumb_7" class="form-control" type="text"
                                           name="service_home_image_7" required>
                                @endif

                            </div>
                        </div>
                        <div id="service_home_preview_7" class="mt-20">
                            @if(isset($content['service_home_image_7']))
                                <img src="{{$content['service_home_image_7']}}" style="max-width: 250px;">
                            @else
                            @endif
                        </div>
                    </div>
                    <label>Service home sub content 7</label>
                    <textarea type="text" class="form-control"
                              name="service_home_value_title_7">{{(!empty($content['service_home_value_title_7']))?$content['service_home_value_title_7']:''}}</textarea>
                              <input type="hidden" name="service_home_type_7" value="2">
                              <label for="">Link</label>
                              <input value="{{(!empty($content['service_home_value_link_7']))?$content['service_home_value_link_7']:''}}"  type="text" name="service_home_value_link_7" class="form-control">
                            </div>
            </div>
            <div class="form-group about-us-form">
                <h2>Box Content Title 8</h2>
                <div>
                    <div>
                        <label>
                            Icon 8
                        </label>
                        <div class="row">
                            <div class="col-md-1">
                                <span class="input-group-btn">
                                    <a href="{{\Config::get('lfm.URL_FILEMANAGE_ARR')}}service_home_thumb_8"
                                       class="btn btn-primary red iframe-btn" id="service_home_iframe-btn-8"><i
                                            class="fa fa-picture-o"></i>Chọn</a>
                                </span>
                            </div>
                            <div class="col-md-11">
                                @if(isset($content['service_home_image_8']))
                                    <input id="service_home_thumb_8" class="form-control" type="text"
                                           name="service_home_image_8"
                                           value="{{$content['service_home_image_8']}}"
                                           required>
                                @else
                                    <input id="service_home_thumb_8" class="form-control" type="text"
                                           name="service_home_image_8" required>
                                @endif

                            </div>
                        </div>
                        <div id="service_home_preview_8" class="mt-20">
                            @if(isset($content['service_home_image_8']))
                                <img src="{{$content['service_home_image_8']}}" style="max-width: 250px;">
                            @else
                            @endif
                        </div>
                    </div>
                    <label>Service home sub content 8</label>
                    <textarea type="text" class="form-control"
                              name="service_home_value_title_8">{{(!empty($content['service_home_value_title_8']))?$content['service_home_value_title_8']:''}}</textarea>
                              <input type="hidden" name="service_home_type_8" value="2">
                              <label for="">Link</label>
                            <input type="text" name="service_home_value_link_8" value="{{(!empty($content['service_home_value_link_8']))?$content['service_home_value_link_8']:''}}" class="form-control">
                            </div>
            </div>
        </div>
        <div class="mt-50 about-us-form">
            <div class="form-group about-us-form">
                <h2>Sub box service home Title 1</h2>
                <div>
                    <div>
                        <label>
                            Icon 1
                        </label>
                        <div class="row">
                            <div class="col-md-1">
                                <span class="input-group-btn">
                                    <a href="{{\Config::get('lfm.URL_FILEMANAGE_ARR')}}sub_service_home_thumb_1"
                                       class="btn btn-primary red iframe-btn" id="sub_service_home_iframe-btn-1"><i
                                            class="fa fa-picture-o"></i>Chọn</a>
                                </span>
                            </div>
                            <div class="col-md-11">
                                @if(isset($content['sub_service_home_image_1']))
                                    <input id="sub_service_home_thumb_1" class="form-control" type="text"
                                           name="sub_service_home_image_1"
                                           value="{{$content['sub_service_home_image_1']}}"
                                           required>
                                @else
                                    <input id="sub_service_home_thumb_1" class="form-control" type="text"
                                           name="sub_service_home_image_1" required>
                                @endif

                            </div>
                        </div>
                        <div id="sub_service_home_preview_1" class="mt-20">
                            @if(isset($content['sub_service_home_image_1']))
                                <img src="{{$content['sub_service_home_image_1']}}" style="max-width: 250px;">
                            @else
                            @endif
                        </div>
                    </div>
                    <label>Service home sub content 1</label>
                    <textarea type="text" class="form-control"
                              name="sub_service_home_value_title_1">{{(!empty($content['sub_service_home_value_title_1']))?$content['sub_service_home_value_title_1']:''}}</textarea>
                    <label for="">Link</label>
                    <input type="text" value="{{(!empty($content['sub_service_home_value_link_1']))?$content['sub_service_home_value_link_1']:''}}" name="sub_service_home_value_link_1" class="form-control">
                </div>
            </div>
            <div class="form-group about-us-form">
                <h2>Sub box service home Title 2</h2>
                <div>
                    <div>
                        <label>
                            Icon 2
                        </label>
                        <div class="row">
                            <div class="col-md-1">
                                <span class="input-group-btn">
                                    <a href="{{\Config::get('lfm.URL_FILEMANAGE_ARR')}}sub_service_home_thumb_2"
                                       class="btn btn-primary red iframe-btn" id="sub_service_home_iframe-btn-2"><i
                                            class="fa fa-picture-o"></i>Chọn</a>
                                </span>
                            </div>
                            <div class="col-md-11">
                                @if(isset($content['sub_service_home_image_2']))
                                    <input id="sub_service_home_thumb_2" class="form-control" type="text"
                                           name="sub_service_home_image_2"
                                           value="{{$content['sub_service_home_image_2']}}"
                                           required>
                                @else
                                    <input id="sub_service_home_thumb_2" class="form-control" type="text"
                                           name="sub_service_home_image_2" required>
                                @endif

                            </div>
                        </div>
                        <div id="sub_service_home_preview_2" class="mt-20">
                            @if(isset($content['sub_service_home_image_2']))
                                <img src="{{$content['sub_service_home_image_2']}}" style="max-width: 250px;">
                            @else
                            @endif
                        </div>
                    </div>
                    <label>Service home sub content 2</label>
                    <textarea type="text" class="form-control"
                              name="sub_service_home_value_title_2">{{(!empty($content['sub_service_home_value_title_2']))?$content['sub_service_home_value_title_2']:''}}</textarea>
                    <label for="">Link</label>
                    <input type="text" value="{{(!empty($content['sub_service_home_value_link_2']))?$content['sub_service_home_value_link_2']:''}}" name="sub_service_home_value_link_2" class="form-control">
                </div>
            </div>
            <div class="form-group about-us-form">
                <h2>Sub box service home Title 3</h2>
                <div>
                    <div>
                        <label>
                            Icon 3
                        </label>
                        <div class="row">
                            <div class="col-md-1">
                                <span class="input-group-btn">
                                    <a href="{{\Config::get('lfm.URL_FILEMANAGE_ARR')}}sub_service_home_thumb_3"
                                       class="btn btn-primary red iframe-btn" id="sub_service_home_iframe-btn-3"><i
                                            class="fa fa-picture-o"></i>Chọn</a>
                                </span>
                            </div>
                            <div class="col-md-11">
                                @if(isset($content['sub_service_home_image_3']))
                                    <input id="sub_service_home_thumb_3" class="form-control" type="text"
                                           name="sub_service_home_image_3"
                                           value="{{$content['sub_service_home_image_3']}}"
                                           required>
                                @else
                                    <input id="sub_service_home_thumb_3" class="form-control" type="text"
                                           name="sub_service_home_image_3" required>
                                @endif

                            </div>
                        </div>
                        <div id="sub_service_home_preview_3" class="mt-20">
                            @if(isset($content['sub_service_home_image_3']))
                                <img src="{{$content['sub_service_home_image_3']}}" style="max-width: 250px;">
                            @else
                            @endif
                        </div>
                    </div>
                    <label>Service home sub content 3</label>
                    <textarea type="text" class="form-control"
                              name="sub_service_home_value_title_3">{{(!empty($content['sub_service_home_value_title_3']))?$content['sub_service_home_value_title_3']:''}}</textarea>
                    <label for="">Link</label>
                    <input type="text" value="{{(!empty($content['sub_service_home_value_link_3']))?$content['sub_service_home_value_link_3']:''}}" name="sub_service_home_value_link_3" class="form-control">
                </div>
            </div>
            <div class="form-group about-us-form">
                <h2>Sub box service home Title 4</h2>
                <div>
                    <div>
                        <label>
                            Icon 4
                        </label>
                        <div class="row">
                            <div class="col-md-1">
                                <span class="input-group-btn">
                                    <a href="{{\Config::get('lfm.URL_FILEMANAGE_ARR')}}sub_service_home_thumb_4"
                                       class="btn btn-primary red iframe-btn" id="sub_service_home_iframe-btn-4"><i
                                            class="fa fa-picture-o"></i>Chọn</a>
                                </span>
                            </div>
                            <div class="col-md-11">
                                @if(isset($content['sub_service_home_image_4']))
                                    <input id="sub_service_home_thumb_4" class="form-control" type="text"
                                           name="sub_service_home_image_4"
                                           value="{{$content['sub_service_home_image_4']}}"
                                           required>
                                @else
                                    <input id="sub_service_home_thumb_4" class="form-control" type="text"
                                           name="sub_service_home_image_4" required>
                                @endif

                            </div>
                        </div>
                        <div id="sub_service_home_preview_4" class="mt-20">
                            @if(isset($content['sub_service_home_image_4']))
                                <img src="{{$content['sub_service_home_image_4']}}" style="max-width: 250px;">
                            @else
                            @endif
                        </div>
                    </div>
                    <label>Service home sub content 4</label>
                    <textarea type="text" class="form-control"
                              name="sub_service_home_value_title_4">{{(!empty($content['sub_service_home_value_title_4']))?$content['sub_service_home_value_title_4']:''}}</textarea>
                    <label for="">Link</label>
                    <input type="text" value="{{(!empty($content['sub_service_home_value_link_4']))?$content['sub_service_home_value_link_4']:''}}" name="sub_service_home_value_link_4" class="form-control">
                </div>
            </div>
        </div>
        <button type="submit" style=" border: 1px solid #000; border-radius:10px;color: #000;background-color: #f3f3f4;width: 75px;height: 75px; text-align: center;position: fixed;bottom: 10px;right: 10px"> Save</button>
    </form>
</div>
@endsection
@section('js')
<script>
    $(document).ready(function(e){
        settingIframe("#service_home_iframe-btn-1", "#service_home_thumb_1", "#service_home_preview_1");
        settingIframe("#service_home_iframe-btn-2", "#service_home_thumb_2", "#service_home_preview_2");
        settingIframe("#service_home_iframe-btn-3", "#service_home_thumb_3", "#service_home_preview_3");
        settingIframe("#service_home_iframe-btn-4", "#service_home_thumb_4", "#service_home_preview_4");
        settingIframe("#service_home_iframe-btn-5", "#service_home_thumb_5", "#service_home_preview_5");
        settingIframe("#service_home_iframe-btn-6", "#service_home_thumb_6", "#service_home_preview_6");
        settingIframe("#service_home_iframe-btn-7", "#service_home_thumb_7", "#service_home_preview_7");
        settingIframe("#service_home_iframe-btn-8", "#service_home_thumb_8", "#service_home_preview_8");

        settingIframe("#sub_service_home_iframe-btn-1", "#sub_service_home_thumb_1", "#sub_service_home_preview_1");
        settingIframe("#sub_service_home_iframe-btn-2", "#sub_service_home_thumb_2", "#sub_service_home_preview_2");
        settingIframe("#sub_service_home_iframe-btn-3", "#sub_service_home_thumb_3", "#sub_service_home_preview_3");
        settingIframe("#sub_service_home_iframe-btn-4", "#sub_service_home_thumb_4", "#sub_service_home_preview_4");

    })

</script>
@endsection
