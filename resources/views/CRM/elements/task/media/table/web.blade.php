<ul class="nav nav-tabs" id="myTab" role="tablist">
    @foreach($types as $type)
        <li class="nav-item">
            <a class="nav-link {{($loop->index == 0)?'active':''}}" id="{{$type}}-tab-nav" data-toggle="tab"
               href="#{{$type}}-tab" role="tab" aria-controls="home"
               aria-selected="true">{{trans('lang.'.$type)}}</a>
        </li>
    @endforeach
</ul>
<div class="tab-content" id="media_tab_list">
    @foreach($types as $keyTypeTab=>$type)
        <div class="tab-pane fade show {{($loop->index == 0)?'active':''}}" id="{{$type}}-tab" role="tabpanel"
             aria-labelledby="{{$type}}-tab-nav">
            <div class="card card_table_{{$type}}">
                <div class="card-header">
                    <div class="d-flex justify-content-end">
                        <a href="#" class="btn btn-primary font-size-13px" id="delete_all{{$type}}_fillter">Delete
                            Filter</a>
                        @if($type == 'web_task')
                            @can('mediaManagerWebsite.store')
                                <a href="#" class="btn btn-primary font-size-13px ml-2" id="btn_add_new_{{$type}}">
                                    <svg class="svg-inline--fa fa-plus fa-w-14" aria-hidden="true" data-prefix="fas"
                                         data-icon="plus" role="img" xmlns="http://www.w3.org/2000/svg"
                                         viewBox="0 0 448 512"
                                         data-fa-i2svg="">
                                        <path fill="currentColor"
                                              d="M416 208H272V64c0-17.67-14.33-32-32-32h-32c-17.67 0-32 14.33-32 32v144H32c-17.67 0-32 14.33-32 32v32c0 17.67 14.33 32 32 32h144v144c0 17.67 14.33 32 32 32h32c17.67 0 32-14.33 32-32V304h144c17.67 0 32-14.33 32-32v-32c0-17.67-14.33-32-32-32z"></path>
                                    </svg><!-- <i class="fas fa-plus"></i> --></a>
                            @endcan
                        @elseif($type == 'fanpage_task')
                            @can('mediaManagerFanpage.store')

                                <a href="#" class="btn btn-primary font-size-13px ml-2" id="btn_add_new_{{$type}}">
                                    <svg class="svg-inline--fa fa-plus fa-w-14" aria-hidden="true" data-prefix="fas"
                                         data-icon="plus" role="img" xmlns="http://www.w3.org/2000/svg"
                                         viewBox="0 0 448 512"
                                         data-fa-i2svg="">
                                        <path fill="currentColor"
                                              d="M416 208H272V64c0-17.67-14.33-32-32-32h-32c-17.67 0-32 14.33-32 32v144H32c-17.67 0-32 14.33-32 32v32c0 17.67 14.33 32 32 32h144v144c0 17.67 14.33 32 32 32h32c17.67 0 32-14.33 32-32V304h144c17.67 0 32-14.33 32-32v-32c0-17.67-14.33-32-32-32z"></path>
                                    </svg><!-- <i class="fas fa-plus"></i> --></a>
                            @endcan
                        @elseif($type == 'group_task')
                            @can('mediaManagerGroup.store')

                                <a href="#" class="btn btn-primary font-size-13px ml-2" id="btn_add_new_{{$type}}">
                                    <svg class="svg-inline--fa fa-plus fa-w-14" aria-hidden="true" data-prefix="fas"
                                         data-icon="plus" role="img" xmlns="http://www.w3.org/2000/svg"
                                         viewBox="0 0 448 512"
                                         data-fa-i2svg="">
                                        <path fill="currentColor"
                                              d="M416 208H272V64c0-17.67-14.33-32-32-32h-32c-17.67 0-32 14.33-32 32v144H32c-17.67 0-32 14.33-32 32v32c0 17.67 14.33 32 32 32h144v144c0 17.67 14.33 32 32 32h32c17.67 0 32-14.33 32-32V304h144c17.67 0 32-14.33 32-32v-32c0-17.67-14.33-32-32-32z"></path>
                                    </svg><!-- <i class="fas fa-plus"></i> --></a>
                            @endcan
                        @elseif($type == 'email_marketing')
                            @can('mediaManagerGroup.store')

                                <a href="#" class="btn btn-primary font-size-13px ml-2" id="btn_add_new_{{$type}}">
                                    <svg class="svg-inline--fa fa-plus fa-w-14" aria-hidden="true" data-prefix="fas"
                                         data-icon="plus" role="img" xmlns="http://www.w3.org/2000/svg"
                                         viewBox="0 0 448 512"
                                         data-fa-i2svg="">
                                        <path fill="currentColor"
                                              d="M416 208H272V64c0-17.67-14.33-32-32-32h-32c-17.67 0-32 14.33-32 32v144H32c-17.67 0-32 14.33-32 32v32c0 17.67 14.33 32 32 32h144v144c0 17.67 14.33 32 32 32h32c17.67 0 32-14.33 32-32V304h144c17.67 0 32-14.33 32-32v-32c0-17.67-14.33-32-32-32z"></path>
                                    </svg><!-- <i class="fas fa-plus"></i> --></a>
                            @endcan
                        @endif
                        <a href="#" data-url="{{route('tasks.media.exportMediaWebsite',['getMediaPost'=>$keyTypeTab])}}" class=" ml-2 btn btn-primary export-plan{{$type}}">Plan</a>
                    </div>
                </div>
                <div class="card-body pt-0">
                    <div class="table-{{$type}} table-div">
                        <table class="">
                            @if(!empty($type))
                                @if($type == 'web_task')
                                    @include('CRM.elements.task.media.table.web.thead',['typeMedia'=>$type,'typeId'=>$keyTypeTab])
                                @elseif($type == 'fanpage_task')
                                    @include('CRM.elements.task.media.table.fanpage.thead',['typeMedia'=>$type,'typeId'=>$keyTypeTab])
                                @elseif($type == 'group_task')
                                    @include('CRM.elements.task.media.table.group.thead',['typeMedia'=>$type,'typeId'=>$keyTypeTab])
                                @elseif($type == 'email_marketing')
                                    @include('CRM.elements.task.media.table.email-marketing.thead',['typeMedia'=>$type,'typeId'=>$keyTypeTab])
                                @endif
                            @endif

                            <tbody id="{{$type}}_data_body">

                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer">
                    <div>Total: <span id="total_page_{{$type}}"></span></div>
                </div>
            </div>
        </div>
    @endforeach
</div>
@foreach($types as $type)
    <div id="modal_{{$type}}_form"></div>
@endforeach
@push('scripts')
    <script>
        $(document).on('mouseover', 'input[name="post_date"]', function () {
            let start_date_class = $(this).hasClass('flatpickr-input')
            if (!start_date_class) {
                $(this).flatpickr({
                    dateFormat: 'd/m/Y',
                    allowInput: true,
                })
            }
        })
    </script>

    @foreach($types as $type)

        @include('CRM.partials.select-onchange-get-value-option-value',[
            'id'=>'source_post_filter'.$type,
            'subId'=>'source_detail_filter'.$type
        ])
        @include('CRM.partials.select-onchange-get-value-option-value',[
            'id'=>'post_place_id_filter'.$type,
            'subId'=>'category_filter'.$type
        ])
        @include('CRM.partials.select-onchange-get-value-option-value',[
            'id'=>'group_id_filter'.$type,
            'subId'=>'category_filter'.$type
        ])
        @include('CRM.partials.select-onchange-get-value-option-value',[
            'id'=>'group_id'.$type,
            'subId'=>'category'.$type
        ])
        @include('CRM.partials.choose_date',['ids'=>[
                    'schedule_post_date'.$type,
                    'created_post'.$type,
                    'post_date_'.$type,
                    'schedule_post_date_start'.$type,
                    'schedule_post_date_end'.$type,
                    'created_post_start'.$type,
                    'created_post_end'.$type,
                    'post_date_fanpage_start'.$type,
                    'post_date_fanpage_end'.$type,
                    'post_date_newletter_start'.$type,
                    'post_date_newletter_end'.$type,
                    'start_date_qc_filter'.$type,
                    'start_date_qc'.$type,
                    'transfer_staff_date'.$type,
                    'processing_date'.$type,
                    'promote_date'.$type,
                ]])
    @endforeach
    <script>
        var hoverTable = ''
        @foreach($types as $type)
        $(document).on('mouseover', '.card_table_{{$type}}', function () {
            hoverTable = '{{$type}}_table_hover'
            console.log(hoverTable)
        })
        @endforeach
    </script>

    <script>
        @foreach($types as $type)

        $(document).on('change', '#post_place_id{{$type}}', function (e) {
            var value = $(this).find(':selected').attr('data-value')
            var arrValue
            if (value) {
                arrValue = JSON.parse(value)
            } else {
                arrValue = []
            }
            html = ''
            $.each(arrValue, function (index, value) {
                html += '<option value="' + value + '">' + value + '</option>'
            })
            $('#category{{$type}}').html(html)
        })
        $(document).on('change', '#source_post{{$type}}', function (e) {
            var value = $(this).find(':selected').attr('data-value')
            var arrValue
            if (value) {
                arrValue = JSON.parse(value)
            } else {
                arrValue = []
            }
            html = ''
            $.each(arrValue, function (index, value) {
                html += '<option value="' + value + '">' + value + '</option>'
            })
            $('#source_detail{{$type}}').html(html)
        })
        @endforeach
    </script>
    {{--    <script>--}}
    @php
        $fields = [
            'group_id',
            'post_place_id',
            'schedule_post_date_start',
            'schedule_post_date_end',
            'created_post_start',
            'created_post_end',
            'category',
            'source_post',
            'source_detail',
            'post_title',
            'post_link',
            'service_id',
            'type_source',
            'view',
            'source_pr',
            'rate',
            'post_date_fanpage_start',
            'post_date_fanpage_end',
            'post_date_newletter_start',
            'post_date_newletter_end',
            'seo',
            'created_by',
            'note',
            'category_email_marketing',
            'object_email_marketing',
            'start_number_of_selected_email_marketing',
            'end_number_of_selected_email_marketing',
            'start_number_of_clicked_link_email_marketing',
            'end_number_of_clicked_link_email_marketing',
            'number_of_clicked_link_email_marketing',
            'type_of_promotion_email_marketing',
            'start_number_of_agent_onshore_email_marketing',
            'end_number_of_agent_onshore_email_marketing',
            'start_number_of_agent_offshore_email_marketing',
            'end_number_of_agent_offshore_email_marketing',
            'start_number_of_promotion_email_marketing',
            'end_number_of_promotion_email_marketing',
            'start_amount_of_money_aud_email_marketing',
            'end_amount_of_money_aud_email_marketing',
            'start_amount_of_money_vnd_email_marketing',
            'end_amount_of_money_vnd_email_marketing',
            'start_total_amount_of_money_email_marketing',
            'end_total_amount_of_money_email_marketing',
            'start_post_date_send',
            'end_post_date_send',
            'note_email_marketing',
            'created_post',
            'schedule_post_date',
            'post_date_newletter',
            'post_date_fanpage',
            'post_date',
            'tag',
            'react',
            'like',
            'share',
            'inbox',
            'budget_qc',
            'start_date_qc',
            'number_days',
            'total_budget',
            'credit_card',
            'is_hotnew',
            'transfer_staff_date',
            'translated_by',
            'processing_date',
            'promote_date',
            'promotion_for',
            'promotion_for_agent_id',
        ];
        foreach($types as $type){
            $fields[]='post_date_'.$type;
        }

    @endphp

    @foreach($types as $keyType=>$type)
        @include('CRM.elements.task.media.partials.curd-loading',[
            'nameAction'=>'customerManager',
            'valueNameField'=>$fields,
            'type'=>$type
        ])
    @endforeach
    @include('CRM.partials.number_currency',[
    'ids'=>[
        'amount_of_money_aud_email_marketingemail_marketing',
        'amount_of_money_vnd_email_marketingemail_marketing',
        'total_amount_of_money_email_marketingemail_marketing',
        'start_amount_of_money_aud_email_marketing_filteremail_marketing',
        'end_amount_of_money_aud_email_marketing_filteremail_marketing',
        'start_amount_of_money_vnd_email_marketing_filteremail_marketing',
        'end_amount_of_money_vnd_email_marketing_filteremail_marketing',
        'start_total_amount_of_money_email_marketing_filteremail_marketing',
        'end_total_amount_of_money_email_marketing_filteremail_marketing'

    ]
])
    {{--    </script>--}}
    @foreach($types as $keyType=>$type)
        @include('CRM.partials.choose_date_onchange_call_function',[
            'idElementInputFlatpick'=>[
                'schedule_post_date_start_filter'.$type,
                'schedule_post_date_end_filter'.$type,
                'created_post_start_filter'.$type,
                'created_post_end_filter'.$type,
                'post_date_fanpage_start_filter'.$type,
                'post_date_fanpage_end_filter'.$type,
                'post_date_newletter_start_filter'.$type,
                'post_date_newletter_end_filter'.$type,
                'start_date_qc_filter'.$type,
                'start_post_date_send_filter'.$type,
                'end_post_date_send_filter'.$type,
                'schedule_post_date_start_filter'.$type,
                'schedule_post_date_end_filter'.$type
            ],
            'functionNameCall'=>'debounceAjax'.$type
        ])
    @endforeach
@endpush
