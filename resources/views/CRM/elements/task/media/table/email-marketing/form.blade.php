<div class="modal fade user-information" id="modal_{{$types[$typeMediaPost]}}" tabindex="-1" role="dialog"
     aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                <label for="">Gửi Newsletter</label>
                                <input type="text" class="form-control"
                                       value="{{(!empty($mediaPost->typeMediaPosts) && $mediaPost->typeMediaPosts->count()>0)?convert_date_form_db($mediaPost->typeMediaPosts->where('type_id',$typeMediaPost)->first()->post_date):''}}"
                                       placeholder="Nhập ngày" id="post_date{{$mediaPostName}}"
                                       name="post_date" autocomplete="off">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">Ngày dự kiến gửi</label>
                                <input autocomplete="off" type="text" class="form-control" placeholder="Nhập ngày"
                                       id="schedule_post_date{{$mediaPostName}}" name="schedule_post_date"
                                       value="{{!empty($mediaPost)?convert_date_form_db($mediaPost->schedule_post_date):''}}" {{($typeMediaPost == 2 && !empty($mediaPost) && !empty($mediaPost->post_date_fanpage))?'readonly disabled':''}}>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">Loại bài DV </label>
                                <select name="service_id" id="service_id{{$mediaPostName}}" class="form-control">
                                    <option value=""></option>
                                    @foreach($services as $service)
                                        <option
                                            value="{{$service->id}}"
                                            {{!empty($mediaPost) && $mediaPost->service_id == $service->id?'selected':''}}
                                        >{{$service->name}}</option>
                                    @endforeach
                                </select>
                                <small id="service_id_help" class="form-text text-danger"></small>

                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">Tiêu đề</label>
                                <textarea name="post_title" id="post_title{{$mediaPostName}}" class="form-control"
                                          cols="10" rows="3"
                                          maxlength="150" >{{!empty($mediaPost)?$mediaPost->post_title:''}}</textarea>
                                <small id="post_title_help" class="form-text text-danger"></small>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="">Hạng mục email MKT</label>
                                <select name="category_email_marketing" class="form-control" id="category_email_marketing{{$mediaPostName}}">
                                    <option value=""></option>
                                    @if(!empty($categoryEmailMarketing))
                                        @foreach($categoryEmailMarketing as $valueCategoryEmailMarketing)
                                            <option value="{{$valueCategoryEmailMarketing->id}}" {{!empty($mediaPost) && $mediaPost->category_email_marketing == $valueCategoryEmailMarketing->id?'selected':''}} >{{$valueCategoryEmailMarketing->name}}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="">Đối tượng gửi</label>
                                <select name="object_email_marketing" class="form-control" id="object_email_marketing{{$mediaPostName}}">
                                    <option value=""></option>
                                    @if(!empty($objectEmailMarketing))
                                        @foreach($objectEmailMarketing as $valueObjectEmailMarketing)
                                            <option value="{{$valueObjectEmailMarketing->id}}" {{!empty($mediaPost) && $mediaPost->object_email_marketing == $valueObjectEmailMarketing->id?'selected':''}}>{{$valueObjectEmailMarketing->name}}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for=""> Lượt mở email</label>
                                <input name="number_of_selected_email_marketing" class="form-control" id="number_of_selected_email_marketing{{$mediaPostName}}" value="{{!empty($mediaPost)?$mediaPost->number_of_selected_email_marketing:''}}">
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="">Lượt click link</label>
                                <input name="number_of_clicked_link_email_marketing" class="form-control" id="number_of_clicked_link_email_marketing{{$mediaPostName}}" value="{{!empty($mediaPost)?$mediaPost->number_of_clicked_link_email_marketing:''}}">
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="">Hình thức promotion</label>
                                <select name="type_of_promotion_email_marketing" class="form-control" id="type_of_promotion_email_marketing{{$mediaPostName}}">
                                    <option value=""></option>
                                    @if(!empty($typeOfPromotionEmailMarketing))
                                        @foreach($typeOfPromotionEmailMarketing as $valueTypeOfPromotionEmailMarketing)
                                            <option value="{{$valueTypeOfPromotionEmailMarketing->id}}" {{!empty($mediaPost) && $mediaPost->type_of_promotion_email_marketing == $valueTypeOfPromotionEmailMarketing->id?'selected':''}}>{{$valueTypeOfPromotionEmailMarketing->name}}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="">Agent Onshore</label>
                                <input type="number" name="number_of_agent_onshore_email_marketing" class="form-control" id="number_of_agent_onshore_email_marketing{{$mediaPostName}}" value="{{!empty($mediaPost)?$mediaPost->number_of_agent_onshore_email_marketing:''}}">
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="">Agent OFFshore</label>
                                <input type="number" name="number_of_agent_offshore_email_marketing" class="form-control" id="number_of_agent_offshore_email_marketing{{$mediaPostName}}" value="{{!empty($mediaPost)?$mediaPost->number_of_agent_offshore_email_marketing:''}}">
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="">Số lượng promotion</label>
                                <input type="number" name="number_of_promotion_email_marketing" class="form-control" id="number_of_promotion_email_marketing{{$mediaPostName}}" value="{{!empty($mediaPost)?$mediaPost->number_of_promotion_email_marketing:''}}">
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="">AUD</label>
                                <input name="amount_of_money_aud_email_marketing" class="form-control" id="amount_of_money_aud_email_marketing{{$mediaPostName}}" value="{{!empty($mediaPost)?$mediaPost->amount_of_money_aud_email_marketing:''}}">
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for=""> VND</label>
                                <input name="amount_of_money_vnd_email_marketing" class="form-control" id="amount_of_money_vnd_email_marketing{{$mediaPostName}}" value="{{!empty($mediaPost)?$mediaPost->amount_of_money_vnd_email_marketing:''}}">
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for=""> Tổng tiền</label>
                                <input name="total_amount_of_money_email_marketing" class="form-control" id="total_amount_of_money_email_marketing{{$mediaPostName}}" value="{{!empty($mediaPost)?$mediaPost->total_amount_of_money_email_marketing:''}}">
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="">Note</label>
                                <textarea name="note_email_marketing" class="form-control" id="note_email_marketing{{$mediaPostName}}" cols="3">{{!empty($mediaPost)?$mediaPost->note_email_marketing:''}}</textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-success mr-1 mb-1 btn_submit_{{$mediaPostName}}_form" type="submit" is-click="false"
                        data-type="{{$typeMediaPost}}"
                        data-url="{{!empty($mediaPost)?route('tasks.media.updateMediaPost.post',['type_media_post'=>$typeMediaPost,'id'=>$mediaPost->id]):route('tasks.media.storeMediaPost.post',['type_media_post'=>$typeMediaPost])}}">{{!empty($mediaPost)?'Update':'Add'}}</button>
                <button class="btn btn-danger mr-1 mb-1" type="button" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
