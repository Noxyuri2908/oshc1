<div class="modal fade user-information" id="modal_{{$types[$typeMediaPost]}}" tabindex="-1" role="dialog"
     aria-labelledby="exampleModalLabel" aria-hidden="true" onmouseover="hoverToLoadSelectAgent()">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{!empty($mediaPost)?'Update':'Add new'}} web_task</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span
                        class="font-weight-light" aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="content-information">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">{{$mediaPostName}}</label>
                                <select name="post_place_id" id="post_place_id{{$mediaPostName}}" class="form-control"
                                            required {{($typeMediaPost == 2 && !empty($mediaPost) && !empty($mediaPost->post_date_fanpage))?'':''}}>
                                    <option value="" {{($typeMediaPost == 2 && !empty($mediaPost) && !empty($mediaPost->post_date_fanpage))?'':''}}></option>
                                    @foreach($webMedia->where('type',$typeMediaPost) as $keyWeb=>$web)
                                        <option data-value="{{json_encode($web->category)}}" value="{{$web->id}}"
                                            @if($typeMediaPost == 2 && !empty($mediaPost) && !empty($mediaPost->post_date_fanpage))
                                                {{!empty($mediaPost) && !empty($mediaPost->typeMediaPosts) && $mediaPost->typeMediaPosts->where('type_id',$typeMediaPost)->count()>0 && $mediaPost->typeMediaPosts->where('type_id',$typeMediaPost)->first()->type_content_id == $web->id?'selected':''}}
                                                @elseif($typeMediaPost == 2 && empty($mediaPost->post_date_fanpage))
                                                {{!empty($mediaPost) && !empty($mediaPost->typeMediaPosts) && $mediaPost->typeMediaPosts->where('type_id',$typeMediaPost)->count()>0 && $mediaPost->typeMediaPosts->where('type_id',$typeMediaPost)->first()->type_content_id == $web->id?'selected':''}}
                                                @elseif($typeMediaPost == 1)
                                                {{!empty($mediaPost) && !empty($mediaPost->typeMediaPosts) && $mediaPost->typeMediaPosts->where('type_id',$typeMediaPost)->count()>0 && $mediaPost->typeMediaPosts->where('type_id',$typeMediaPost)->first()->type_content_id == $web->id?'selected':''}}
                                            @endif
                                        >{{$web->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        {{--                        @if($typeMediaPost == 3)--}}
                        {{--                            <div class="col-md-4">--}}
                        {{--                                <div class="form-group">--}}
                        {{--                                    <label for="">Group</label>--}}
                        {{--                                    <select name="group_id" id="group_id{{$mediaPostName}}" class="form-control"--}}
                        {{--                                            required>--}}
                        {{--                                        <option value=""></option>--}}
                        {{--                                        @if(!empty($groupMedias))--}}
                        {{--                                            @foreach($groupMedias as $keyGroup=>$group)--}}
                        {{--                                                <option data-value="{{$group->value}}"--}}
                        {{--                                                        value="{{$group->id}}" {{!empty($mediaPost) && $mediaPost->group_id == $group->id?'selected':''}}>{{$group->name}}</option>--}}
                        {{--                                            @endforeach--}}
                        {{--                                        @endif--}}
                        {{--                                    </select>--}}
                        {{--                                </div>--}}
                        {{--                            </div>--}}
                        {{--                        @endif--}}
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">Ngày đăng </label>
                                <input type="text" class="form-control" placeholder="Nhập ngày"
                                       id="post_date{{$mediaPostName}}"
                                       name="post_date"
                                       autocomplete="off"
                                       value="{{!empty($mediaPost) && !empty($mediaPost->typeMediaPosts) && $mediaPost->typeMediaPosts->where('type_id',$typeMediaPost)->count()>0?convert_date_form_db($mediaPost->typeMediaPosts->where('type_id',$typeMediaPost)->first()->post_date):''}}" {{($typeMediaPost == 2 && !empty($mediaPost) && !empty($mediaPost->post_date_fanpage))?'readonly disabled':''}}>
                                <small id="created_post_help" class="form-text text-danger"></small>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">CHUYÊN MỤC</label>
                                {{--                                                                                                @dd($mediaPost->getWebsiteValue($typeMediaPost))--}}
                                @if(!empty($mediaPost))
                                    <select name="category" id="category{{$mediaPostName}}" class="form-control">
                                        @foreach($mediaPost->getWebsiteValue($typeMediaPost) as $value)
                                            <option
                                                value="{{$value}}" {{
    (!empty($mediaPost->typeMediaPosts) &&
 $mediaPost->typeMediaPosts->where('type_id',$typeMediaPost)->count()>0 &&
 $mediaPost->typeMediaPosts->where('type_id',$typeMediaPost)->first()->category == $value
 )?'selected':''}}
                                            >{{$value}}</option>
                                        @endforeach
                                    </select>
                                @else
                                    <select name="category" id="category{{$mediaPostName}}" class="form-control">

                                    </select>
                                @endif
                                <small id="category_help" class="form-text text-danger"></small>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">Nguồn bài </label>
                                <select name="source_post" id="source_post{{$mediaPostName}}" class="form-control" {{($typeMediaPost == 2 && !empty($mediaPost) && !empty($mediaPost->post_date_fanpage))?'readonly':''}}>
                                    <option value="" {{($typeMediaPost == 2 && !empty($mediaPost) && !empty($mediaPost->post_date_fanpage))?'disabled':''}}></option>
                                    @foreach($sourcePostMedias as $sourcePost)
                                        <option value="{{$sourcePost['id']}}" data-value="{{$sourcePost['value']}}"
                                        @if($typeMediaPost == 2 && !empty($mediaPost) && !empty($mediaPost->post_date_fanpage))
                                            {{!empty($mediaPost) && $mediaPost['source_post'] == $sourcePost['id'] ? 'selected':'disabled'}}
                                            @elseif($typeMediaPost == 2 && empty($mediaPost->post_date_fanpage))
                                            {{!empty($mediaPost) && $mediaPost['source_post'] == $sourcePost['id'] ? 'selected':''}}
                                            @elseif($typeMediaPost == 1)
                                            {{!empty($mediaPost) && $mediaPost['source_post'] == $sourcePost['id'] ? 'selected':''}}
                                            @endif
                                        >{{$sourcePost['name']}}</option>
                                    @endforeach
                                </select>
                                <small id="source_post_help" class="form-text text-danger"></small>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group source_detail_select2_parent" onmouseover="callSelect2()">
                                <label for="">Chi tiết nguồn bài </label>
                                @if(!empty($mediaPost))
                                    <select name="source_detail" id="source_detail{{$mediaPostName}}" class="form-control" {{($typeMediaPost == 2 && !empty($mediaPost) && !empty($mediaPost->post_date_fanpage))?'readonly':''}}>
                                        @if(!empty($mediaPost->source_post) && !empty($sourcePostMedias->where('id',$mediaPost->source_post)->pluck('value')->first()))
                                            @foreach(json_decode($sourcePostMedias->where('id',$mediaPost->source_post)->pluck('value')->first()) as $valueSource)
                                                <option
                                                    value="{{$valueSource}}"
                                                    @if($typeMediaPost == 2 && !empty($mediaPost) && !empty($mediaPost->post_date_fanpage)) {{--fanpage--}}
                                                        {{$mediaPost->source_detail == $valueSource?'selected':'disabled'}}
                                                    @elseif($typeMediaPost == 1)  {{--web--}}
                                                        {{$mediaPost->source_detail == $valueSource?'selected':''}}
                                                    @endif
                                                >{{$valueSource}}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                @else
                                    <select name="source_detail" id="source_detail{{$mediaPostName}}" class="form-control">

                                    </select>
                                @endif
                                <small id="source_detail_help" class="form-text text-danger"></small>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">BÀI POST</label>
                                <textarea name="post_title" id="post_title{{$mediaPostName}}" class="form-control"
                                          cols="10" rows="3"
                                          maxlength="150" {{($typeMediaPost == 2 && !empty($mediaPost) && !empty($mediaPost->post_date_fanpage))?'readonly':''}}>{{!empty($mediaPost)?$mediaPost->post_title:''}}</textarea>
                                <small id="post_title_help" class="form-text text-danger"></small>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">LINK POST</label>
                                <textarea name="post_link" id="post_link{{$mediaPostName}}" class="form-control"
                                          cols="10" rows="3"
                                          maxlength="150" {{($typeMediaPost == 2 && !empty($mediaPost) && !empty($mediaPost->post_date_fanpage))?'readonly':''}}>{{!empty($mediaPost)?$mediaPost->post_link:''}}</textarea>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">Loại tin bài </label>
                                <select name="type_source" id="type_source{{$mediaPostName}}" class="form-control" {{($typeMediaPost == 2 && !empty($mediaPost) && !empty($mediaPost->post_date_fanpage))?'readonly':''}}>
                                    <option value="" {{($typeMediaPost == 2 && !empty($mediaPost) && !empty($mediaPost->post_date_fanpage))?'disabled':''}}></option>
                                    @foreach($typeSourceMedia as $sourceMedia)
                                        <option
                                            value="{{$sourceMedia->name}}"
                                        @if($typeMediaPost == 2 && !empty($mediaPost) && !empty($mediaPost->post_date_fanpage))
                                            {{!empty($mediaPost) && $mediaPost->type_source == $sourceMedia->name?'selected':'disabled'}}
                                            @elseif($typeMediaPost == 2 && empty($mediaPost->post_date_fanpage))
                                            {{!empty($mediaPost) && $mediaPost->type_source == $sourceMedia->name?'selected':''}}
                                            @elseif($typeMediaPost == 1)
                                            {{!empty($mediaPost) && $mediaPost->type_source == $sourceMedia->name?'selected':''}}
                                            @endif
                                        >{{$sourceMedia->name}}</option>
                                    @endforeach
                                </select>
                                <small id="type_source_help" class="form-text text-danger"></small>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">Người đăng</label>
                                <select name="created_by" id="created_by{{$mediaPostName}}" class="form-control" {{($typeMediaPost == 2 && !empty($mediaPost) && !empty($mediaPost->post_date_fanpage))?'readonly':''}}>
                                    <option value="" {{($typeMediaPost == 2 && !empty($mediaPost) && !empty($mediaPost->post_date_fanpage))?'disabled':''}}></option>
                                    @foreach($admins as $idAdmin=>$admin)
                                        <option
                                            value="{{$idAdmin}}"
                                        @if($typeMediaPost == 2 && !empty($mediaPost) && !empty($mediaPost->post_date_fanpage))
                                            {{!empty($mediaPost) && $mediaPost->created_by == $idAdmin?'selected':'disabled'}}
                                            @elseif($typeMediaPost == 2 && empty($mediaPost->post_date_fanpage))
                                            {{!empty($mediaPost) && $mediaPost->created_by == $idAdmin?'selected':''}}
                                            @elseif($typeMediaPost == 1)
                                            {{!empty($mediaPost) && $mediaPost->created_by == $idAdmin?'selected':''}}
                                            @endif

                                        >{{$admin}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">Đánh giá </label>
                                <select name="rate" id="rate{{$mediaPostName}}" class="form-control" {{($typeMediaPost == 2 && !empty($mediaPost) && !empty($mediaPost->post_date_fanpage))?'readonly':''}}>
                                    <option value="" {{($typeMediaPost == 2 && !empty($mediaPost) && !empty($mediaPost->post_date_fanpage))?'disabled':''}}></option>
                                    @foreach($rates as $keyRate=>$rate)
                                        <option
                                            value="{{$keyRate}}"
                                        @if($typeMediaPost == 2 && !empty($mediaPost) && !empty($mediaPost->post_date_fanpage))
                                            {{!empty($mediaPost) && $mediaPost->rate == $keyRate?'selected':'disabled'}}
                                            @elseif($typeMediaPost == 2 && empty($mediaPost->post_date_fanpage))
                                            {{!empty($mediaPost) && $mediaPost->rate == $keyRate?'selected':''}}
                                            @elseif($typeMediaPost == 1)
                                            {{!empty($mediaPost) && $mediaPost->rate == $keyRate?'selected':''}}
                                            @endif
                                        >{{$rate}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="form-group">
                                <label for="">NOTE</label>
                                <textarea name="note" id="note{{$mediaPostName}}" class="form-control" cols="10"
                                          rows="4"
                                          maxlength="300" {{($typeMediaPost == 2 && !empty($mediaPost) && !empty($mediaPost->post_date_fanpage))?'readonly':''}}>{{!empty($mediaPost)?$mediaPost->note:''}}</textarea>
                            </div>
                        </div>
                        @if($typeMediaPost == 1 ||$typeMediaPost == 2)
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">Lên lịch hẹn đăng bài </label>
                                    <input autocomplete="off" type="text" class="form-control" placeholder="Nhập ngày"
                                           id="schedule_post_date{{$mediaPostName}}" name="schedule_post_date"
                                           value="{{!empty($mediaPost)?convert_date_form_db($mediaPost->schedule_post_date):''}}" {{($typeMediaPost == 2 && !empty($mediaPost) && !empty($mediaPost->post_date_fanpage))?'readonly disabled':''}}>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">Loại bài DV </label>
                                    <select name="service_id" id="service_id{{$mediaPostName}}" class="form-control" {{($typeMediaPost == 2 && !empty($mediaPost) && !empty($mediaPost->post_date_fanpage))?'readonly':''}}>
                                        <option value="" {{($typeMediaPost == 2)?'disabled':''}}></option>
                                        @foreach($services as $service)
                                            <option
                                                value="{{$service->id}}"
                                            @if($typeMediaPost == 2)
                                                {{!empty($mediaPost) && $mediaPost->service_id == $service->id?'selected':''}}
                                                @elseif($typeMediaPost == 1)
                                                {{!empty($mediaPost) && $mediaPost->service_id == $service->id?'selected':''}}
                                            @endif
                                            >{{$service->name}}</option>
                                        @endforeach
                                    </select>
                                    <small id="service_id_help" class="form-text text-danger"></small>

                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label for="">Nguồn bài PR </label>
                                    <textarea name="source_pr" id="source_pr{{$mediaPostName}}" class="form-control"
                                              cols="10" rows="2"
                                              maxlength="50" {{($typeMediaPost == 2 && !empty($mediaPost) && !empty($mediaPost->post_date_fanpage))?'readonly':''}}>{{!empty($mediaPost)?$mediaPost->source_pr:''}}</textarea>
                                </div>
                            </div>
                        @endif
                        @if($typeMediaPost == 2 ||$typeMediaPost == 3)
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">React</label>
                                    <input type="number" class="form-control" placeholder="Nhập số" name="react"
                                           id="react{{$mediaPostName}}"
                                           value="{{!empty($mediaPost)?$mediaPost->react:''}}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">Like </label>
                                    <input type="number" class="form-control" placeholder="Nhập số" name="like"
                                           id="like{{$mediaPostName}}"
                                           value="{{!empty($mediaPost)?$mediaPost->like:''}}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">Share</label>
                                    <input type="number" class="form-control" placeholder="Nhập số" name="share"
                                           id="share{{$mediaPostName}}"
                                           value="{{!empty($mediaPost)?$mediaPost->share:''}}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">Inbox </label>
                                    <input type="number" class="form-control" placeholder="Nhập số" name="inbox"
                                           id="inbox{{$mediaPostName}}"
                                           value="{{!empty($mediaPost)?$mediaPost->inbox:''}}">
                                </div>
                            </div>
                        @endif
                        @if($typeMediaPost == 1)
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">Lượt view </label>
                                    <input type="number" class="form-control" placeholder="Nhập số" name="view"
                                           id="view{{$mediaPostName}}"
                                           value="{{!empty($mediaPost)?$mediaPost->view:''}}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">Bài viết chuẩn SEO </label>
                                    <select name="seo" id="seo{{$mediaPostName}}" class="form-control">
                                        <option value=""></option>
                                        @foreach($seos as $keySeo=>$seo)
                                            <option
                                                value="{{$keySeo}}" {{!empty($mediaPost) && $mediaPost->seo == $keySeo?'selected':''}}>{{$seo}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">Ngày chuyển CTV</label>
                                    <input type="text" class="form-control" id="transfer_staff_date{{$mediaPostName}}" value="{{!empty($mediaPost)?convert_date_form_db($mediaPost->transfer_staff_date):''}}" autocomplete="off">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">Dịch bởi</label>
                                    <select name="" id="translated_by{{$mediaPostName}}" class="form-control">
                                        <option value=""></option>
                                        @foreach($admins as $idAdmin=>$admin)
                                            <option value="{{$idAdmin}}" {{!empty($mediaPost) && $mediaPost->translated_by == $idAdmin?'selected':''}}>{{$admin}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">Ngày xử lý</label>
                                    <input type="text" class="form-control" id="processing_date{{$mediaPostName}}" value="{{!empty($mediaPost)?convert_date_form_db($mediaPost->processing_date):''}}" autocomplete="off">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">Ngày promote</label>
                                    <input type="text" class="form-control" id="promote_date{{$mediaPostName}}" value="{{!empty($mediaPost)?convert_date_form_db($mediaPost->promote_date):''}}" autocomplete="off">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">Promotion for </label>
                                    <select name="" id="promotion_for{{$mediaPostName}}" class="form-control select_promotion">
                                        <option value=""></option>
                                        @foreach($typePromotion as $keyPromotion=>$promotion)
                                            <option value="{{$keyPromotion}}" data-type="{{$promotion['type']}}" {{!empty($mediaPost) && $mediaPost->promotion_for == $keyPromotion?'selected':''}}>{{$promotion['name']}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            {{--                        @dd( $typePromotion[$mediaPost->promotion_for]['type'] == 'show')--}}
                            <div class="col-md-4 box_user_id_select2 {{(!empty($mediaPost) && !empty($mediaPost->promotion_for) && $typePromotion[$mediaPost->promotion_for]['type'] == 'show')?'':'d-none'}}">
                                <div class="form-group user_id_select2">
                                    <label for="">Agent</label>
                                    <select name="" id="promotion_for_agent_id{{$mediaPostName}}" class="form-control promotion_select2">

                                    </select>
                                </div>
                            </div>
                        @endif
                        @if($typeMediaPost == 2)
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">Budget QC/ngày</label>
                                    <input type="text" class="form-control" placeholder="Nhập text"
                                           id="budget_qc{{$mediaPostName}}"
                                           name="budget_qc"
                                           value="{{!empty($mediaPost)?$mediaPost->budget_qc:''}}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">Đối tượng QC
                                    </label>
                                    <input type="text" class="form-control" placeholder="Nhập text"
                                           id="tag{{$mediaPostName}}"
                                           name="tag"
                                           value="{{!empty($mediaPost)?$mediaPost->tag:''}}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">Start date </label>
                                    <input type="text" class="form-control" placeholder="Nhập ngày"
                                           id="start_date_qc{{$mediaPostName}}" name="start_date_qc"
                                           value="{{!empty($mediaPost)?convert_date_form_db($mediaPost->start_date_qc):''}}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">Days</label>
                                    <input type="number" class="form-control" placeholder="Nhập số ngày"
                                           id="number_days{{$mediaPostName}}" name="number_days"
                                           value="{{!empty($mediaPost)?$mediaPost->number_days:''}}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">Total budget</label>
                                    <input type="text" class="form-control" placeholder="Nhập text"
                                           id="total_budget{{$mediaPostName}}" name="total_budget"
                                           value="{{!empty($mediaPost)?$mediaPost->total_budget:''}}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">Credit card</label>
                                    <input type="text" class="form-control" placeholder="Nhập text"
                                           id="credit_card{{$mediaPostName}}" name="credit_card"
                                           value="{{!empty($mediaPost)?$mediaPost->credit_card:''}}">
                                </div>
                            </div>
                        @endif
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">Hotnew</label>
                                <select name="" id="is_hotnew{{$mediaPostName}}" class="form-control">
                                    <option value="1">Ok</option>
                                    <option value="2">Not ok</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        @foreach($types as $keyTypeMediaConfig=>$typeMediaConfig)
                            @if($typeMediaPost != $keyTypeMediaConfig)
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="">Ngày đăng {{$typeMediaConfig}} </label>
                                        <input type="text" class="form-control"
                                               value="{{!empty($mediaPost) && !empty($mediaPost->typeMediaPosts) && $mediaPost->typeMediaPosts->where('type_id',$keyTypeMediaConfig)->count()>0?convert_date_form_db($mediaPost->typeMediaPosts->where('type_id',$keyTypeMediaConfig)->first()->post_date):''}}"
                                               placeholder="Nhập ngày đăng" id="post_date_{{$typeMediaConfig}}{{$mediaPostName}}"
                                               name="post_date" autocomplete="off">
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-success mr-1 mb-1 btn_submit_{{$mediaPostName}}_form" type="submit" is-click="false"
                        data-type="{{$typeMediaPost}}"
                        data-url="{{!empty($mediaPost)?route('tasks.media.updateMediaPost.post',['type_media_post'=>$typeMediaPost,'id'=>$mediaPost->id]):route('tasks.media.storeMediaPost.post',['type_media_post'=>$typeMediaPost])}}">{{!empty($mediaPost)?'Update':'Add'}}</button>
                <button class="btn btn-danger mr-1 mb-1" type="button" data-dismiss="modal">Close</button>
                {{--                @dd($mediaPost->user)--}}
            </div>
        </div>
    </div>
</div>
@include('CRM.partials.script-call-agent',[
    'nameFunction'=>'hoverToLoadSelectAgent',
    'elementIdSelect2'=>'promotion_for_agent_id'.$mediaPostName,
    'elementParentIdSelect2'=>'user_id_select2',
    'data'=>(!empty($mediaPost))?$mediaPost:null,
    'dataName'=>(!empty($mediaPost) && !empty($mediaPost->user))?$mediaPost->user->name:'',
    'dataId'=>(!empty($mediaPost) && !empty($mediaPost->user))?$mediaPost->promotion_for_agent_id:''
]);
@include('CRM.partials.js.callSelect2',[
    'nameFunction'=>'callSelect2',
    'selectElement'=>"#source_detail".$mediaPostName,
    'selectElementParent'=>'.source_detail_select2_parent'
])
<script>




    $(document).on('click', '.select_promotion', function (e) {
        e.preventDefault()
        var attrValue = $('option:selected', this).attr('data-type')
        if (attrValue == 'show') {
            $('.box_user_id_select2').removeClass('d-none')
            $('.promotion_select2').prop('disabled', false)
        } else {
            $('.box_user_id_select2').addClass('d-none')
            $('.promotion_select2').prop('disabled', true)
        }
    })
</script>
