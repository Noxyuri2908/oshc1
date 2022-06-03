@extends('CRM.layouts.default')

@section('title')
    Google Adword Media
    @parent
@stop

@section('css')
    @include('CRM.partials.css-list')
    <style>
        .table-div .form-control {
            height: 28px;
        }

        .table-div {
            max-width: 100%;
            position: relative;
            overflow: scroll;
            height: 32em;
            max-height: 32em;
        }

        table {
            position: relative;
            border-collapse: collapse;
            white-space: nowrap;
            table-layout: fixed;
            width: 100%;
        }

        table td, table th {

        }

        td,
        th {
            padding: 0.25em;
        }

        thead .first-row th {
            position: -webkit-sticky; /* for Safari */
            position: sticky;
            top: 0;
            background: #007bff;
            color: #fff;
        }

        thead .last-row th {
            position: -webkit-sticky; /* for Safari */
            position: sticky;
            background: #eae7e7;
            color: #fff;
        }

        .top-80 {
            top: 25px;
        }

        .last-row th {
            top: 25px;
        }


        thead .first-row th:first-child, thead .last-row th:first-child {
            /* left: 0; */
            z-index: 1;
        }

        /* tbody th {
            position: -webkit-sticky;
            position: sticky;
            left: 0;
            background: #FFF;
            border-right: 1px solid #CCC;
        } */
        tbody th, tbody td {
            border-bottom: 1px solid #ccc;
        }

        .width-80 {
            width: 80px;
        }

        .width-220 {
            width: 220px;
        }

        .width-170 {
            width: 170px;
        }

        .width-200 {
            width: 200px;
        }

        .width-500 {
            width: 500px;
        }

        .width-300 {
            width: 300px;
        }

        .width-100 {
            width: 100px;
        }

        .white-space-break-spaces {
            text-overflow: ellipsis;
            overflow: hidden;
        }

        .bg-pale-gray {
            background-color: #eae7e7
        }

        .table-div select {
            padding: 0 20px;
        }

        #sale_task .card-body {
            padding: 0.5%;
        }

        #sale_task h5 {
            font-family: 'roboto', sans-serif !important;
            font-weight: 600;
        }
    </style>
@endsection
@section('content')
    <div>
        <div class="card">
            <div class="card-header">
                <h5>Google Adword</h5>
                <div class="d-flex justify-content-end">
                    <a href="#" class="btn btn-success " id="btn_add_new_google_adword_media"><i class="fas fa-plus"></i></a>
                    <a href="#" class="btn btn-primary delete-filter ml-2">Delete Filter</a>
                </div>
            </div>
            <div class="card-body">
                <div class="table-google-adword-media table-div">
                    <table class="">
                        <thead class="">
                        <tr class="first-row">
                            <th class="width-80">Action</th>
                            <th class="width-200">Thời gian bắt đầu</th>
                            <th class="width-200">Thời gian kết thúc</th>
                            <th class="width-200">Website</th>
                            <th class="width-100">Chiến dịch</th>
                            <th class="width-200">Địa điểm tìm kiếm</th>
                            <th class="width-200">Ngôn ngữ tìm kiếm</th>
                            <th class="width-200">Mạng</th>
                            <th class="width-200">Giá đặt thầu</th>
                            <th class="width-200">Từ khoá </th>
                            <th class="width-200">Dòng tiêu đề 1 </th>
                            <th class="width-200">Dòng tiêu đề 2 </th>
                            <th class="width-200">Dòng tiêu đề 3</th>
                            <th class="width-200">Mô tả</th>
                            <th class="width-200">Link bài</th>
                            <th class="width-200">Thời gian chạy (Ngày) </th>
                            <th class="width-200">Budget (VND)</th>
                            <th class="width-200">Số lượng click dự kiến</th>
                            <th class="width-200">Số lượng click thực tế</th>
                            <th class="width-200">Số lần hiển thị</th>
                            <th class="width-200">CPC trung bình</th>
                        </tr>
                        @include('CRM.pages.google-adword-media.filter')
                        </thead>
                        <tbody id="google-adword-media-table-tbody">

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div id="modal_google_adword_media_form"></div>
    </div>
@endsection
@push('scripts')
    @include('CRM.partials.choose_date',['ids'=>[
        'start_date',
        'end_date'
    ]])
    <script>
        var pageGoogleAdwordMedia = 1;
        var lastPageGoogleAdwordMedia;
        var readyGoogleAdwordMedia = true;
        var arrData = [];
        //filter
        var start_date_filter = '';
        var end_date_filter = '';
        var website_id_filter = '';
        var campaign_filter = '';
        var location_search_filter = '';
        var language_search_filter = '';
        var type_campaign_filter = '';
        var bid_price_filter = '';
        var keyword_filter = '';
        var title_1_filter = '';
        var title_2_filter = '';
        var title_3_filter = '';
        var describe_filter = '';
        var link_post_filter = '';
        var budget_filter = '';

        function getGoogleAdwordMedia(page) {
            if (!page) {
                page = 1;
            }
            $.ajax({
                url: "{{route('google-adword-media.getData')}}",
                type: 'get',
                data: {
                    page: page,
                    @if(request()->get('report_end_date') && request()->get('report_start_date'))
                    processing_date_archiveMediaLink_start: "{{request()->get('report_start_date')}}",
                    processing_date_archiveMediaLink_end: "{{request()->get('report_end_date')}}",
                    @endif
                        @if(request()->get('filter_date_option'))
                    filter_date_option: "{{request()->get('filter_date_option')}}",
                    @endif
                },
                success: function (data) {
                    $('#google-adword-media-table-tbody').html(data.view);
                    lastPageGoogleAdwordMedia = data.last_page;
                }
            })
        }
        getGoogleAdwordMedia();

        function callAjaxGoogleAdwordMedia(){
            readyGoogleAdwordMedia = false;
            pageGoogleAdwordMedia = 1;
            start_date_filter =$('#start_date_filter').val();
            end_date_filter =$('#end_date_filter').val();
            website_id_filter =$('#website_id_filter').val();
            campaign_filter =$('#campaign_filter').val();
            location_search_filter =$('#location_search_filter').val();
            language_search_filter =$('#language_search_filter').val();
            type_campaign_filter =$('#type_campaign_filter').val();
            bid_price_filter =$('#bid_price_filter').val();
            keyword_filter =$('#keyword_filter').val();
            title_1_filter =$('#title_1_filter').val();
            title_2_filter =$('#title_2_filter').val();
            title_3_filter =$('#title_3_filter').val();
            describe_filter =$('#describe_filter').val();
            link_post_filter =$('#link_post_filter').val();
            budget_filter =$('#budget_filter').val();
            getArchiveMediaLinkFilter(
                pageGoogleAdwordMedia,
                start_date_filter ,
                end_date_filter ,
                website_id_filter ,
                campaign_filter ,
                location_search_filter ,
                language_search_filter ,
                type_campaign_filter ,
                bid_price_filter ,
                keyword_filter ,
                title_1_filter ,
                title_2_filter ,
                title_3_filter ,
                describe_filter ,
                link_post_filter ,
                budget_filter ,
                0);
            $('#box_data_customer').scrollTop(0);
        }
        function ajaxGoogleAdwordMedia(data) {
            if (readyGoogleAdwordMedia) {
                callAjaxGoogleAdwordMedia();
            }
        }

        function debounce(fn, delay) {
            return args => {
                clearTimeout(fn.id)

                fn.id = setTimeout(() => {
                    fn.call(this, args)
                }, delay)
            }
        }

        const debounceAjaxGoogleAdwordMedia = debounce(ajaxGoogleAdwordMedia, 400)

        $(document).on('keyup', '.table-google-adword-media .last-row input', function (e) {
            debounceAjaxGoogleAdwordMedia(e.target.value)
        })
        $(document).on('change', '.table-google-adword-media .last-row select', function (e) {
            debounceAjaxGoogleAdwordMedia(e.target.value)
        })

        $(document).on('keypress', function (e) {
            if (e.keyCode == 13 && readyGoogleAdwordMedia) {
                callAjaxGoogleAdwordMedia();
            }
        });

        function getArchiveMediaLinkFilter(
            pageGoogleAdwordMedia,
            start_date_filter ,
            end_date_filter ,
            website_id_filter ,
            campaign_filter ,
            location_search_filter ,
            language_search_filter ,
            type_campaign_filter ,
            bid_price_filter ,
            keyword_filter ,
            title_1_filter ,
            title_2_filter ,
            title_3_filter ,
            describe_filter ,
            link_post_filter ,
            budget_filter,
            isAppend) {
            $.ajax({
                url: "{{route('google-adword-media.getData')}}",
                type: 'get',
                data: {
                    page: pageGoogleAdwordMedia,
                    start_date :start_date_filter,
                    end_date :end_date_filter,
                    website_id :website_id_filter,
                    campaign :campaign_filter,
                    location_search :location_search_filter,
                    language_search :language_search_filter,
                    type_campaign :type_campaign_filter,
                    bid_price :bid_price_filter,
                    keyword :keyword_filter,
                    title_1 :title_1_filter,
                    title_2 :title_2_filter,
                    title_3 :title_3_filter,
                    describe :describe_filter,
                    link_post :link_post_filter,
                    budget :budget_filter,
                },
                success: function (data) {
                    if (isAppend == 0) {
                        $('#google-adword-media-table-tbody').html(data.view);
                    } else if (isAppend == 1) {
                        $('#google-adword-media-table-tbody').append(data.view);
                    }
                    lastPageGoogleAdwordMedia = data.last_page;
                },
                complete: function () {
                    readyGoogleAdwordMedia = true;
                }
            })

        }
        $('.table-archive-media-link').scroll(function(e) {
            if(readyGoogleAdwordMedia && Math.round($(this).scrollTop() + $(this).innerHeight(),10) >= Math.round($(this)[0].scrollHeight,10)-80){
                readyGoogleAdwordMedia = false;
                if(pageGoogleAdwordMedia < lastPageGoogleAdwordMedia){
                    pageGoogleAdwordMedia++;
                    getArchiveMediaLinkFilter(
                        pageGoogleAdwordMedia,
                        start_date_filter ,
                        end_date_filter ,
                        website_id_filter ,
                        campaign_filter ,
                        location_search_filter ,
                        language_search_filter ,
                        type_campaign_filter ,
                        bid_price_filter ,
                        keyword_filter ,
                        title_1_filter ,
                        title_2_filter ,
                        title_3_filter ,
                        describe_filter ,
                        link_post_filter ,
                        budget_filter,
                        1);
                }else{
                    readyGoogleAdwordMedia = true;
                }
            }
        });

        $(document).on('click', '#btn_add_new_google_adword_media', function (e) {
            e.preventDefault();
            var id = $(this).attr('data-id');
            if (readyGoogleAdwordMedia) {
                readyGoogleAdwordMedia = false;
                $.ajax({
                    url: "{{route('google-adword-media.create')}}",
                    type: 'get',
                    data: {
                        id: id
                    },
                    success: function (data) {
                        $('#modal_google_adword_media_form').html(data);
                        $('#modal_google_adword_media').modal('toggle');
                    }, complete: function () {
                        readyGoogleAdwordMedia = true;
                    }
                })
            }
        })
        $(document).on('click', '.edit_google_adword_media', function (e) {
            e.preventDefault();
            var id = $(this).attr('data-id');
            var agent_id = $(this).attr('data-agent_id');
            var url = $(this).attr('data-url');
            if (readyGoogleAdwordMedia) {
                readyGoogleAdwordMedia = false;
                $.ajax({
                    url: url,
                    type: 'get',
                    data: {
                        id: id
                    },
                    success: function (data) {
                        $('#modal_google_adword_media_form').html(data);
                        $('#modal_google_adword_media').modal('toggle');
                    }, complete: function () {
                        readyGoogleAdwordMedia = true;
                    }
                })
            }
        })
        $(document).on('click', '.btn_submit_google_adword_media_form', function (e) {
            e.preventDefault();
            let _url = $(this).attr('data-url');
            let _start_date =$('#start_date').val();
            let _end_date =$('#end_date').val();
            let _website_id =$('#website_id').val();
            let _campaign =$('#campaign').val();
            let _location_search =$('#location_search').val();
            let _language_search =$('#language_search').val();
            let _type_campaign =$('#type_campaign').val();
            let _bid_price =$('#bid_price').val();
            let _keyword =$('#keyword').val();
            let _title_1 =$('#title_1').val();
            let _title_2 =$('#title_2').val();
            let _title_3 =$('#title_3').val();
            let _describe =$('#describe').val();
            let _link_post =$('#link_post').val();
            let _number_days =$('#number_days').val();
            let _budget =$('#budget').val();
            let _number_click_expected =$('#number_click_expected').val();
            let _number_click_reality =$('#number_click_reality').val();
            let _number_impression =$('#number_impression').val();
            let _average_CPC =$('#average_CPC').val();
            let _created_by =$('#created_by').val();
            if (readyGoogleAdwordMedia) {
                readyGoogleAdwordMedia = false;
                $.ajax({
                    url: _url,
                    type: 'post',
                    data: {
                        _token: "{{csrf_token()}}",
                        start_date:_start_date,
                        end_date:_end_date,
                        website_id:_website_id,
                        campaign:_campaign,
                        location_search:_location_search,
                        language_search:_language_search,
                        type_campaign:_type_campaign,
                        bid_price:_bid_price,
                        keyword:_keyword,
                        title_1:_title_1,
                        title_2:_title_2,
                        title_3:_title_3,
                        describe:_describe,
                        link_post:_link_post,
                        number_days:_number_days,
                        budget:_budget,
                        number_click_expected:_number_click_expected,
                        number_click_reality:_number_click_reality,
                        number_impression:_number_impression,
                        average_CPC:_average_CPC,
                        created_by:_created_by
                    },
                    success: function (data) {
                        // console.log(data);
                        if (data.type == 'create') {
                            pageGoogleAdwordMedia = 1;
                            $('#google-adword-media-table-tbody').html(data.view);
                            lastPageGoogleAdwordMedia = data.last_page;
                        } else if (data.type == 'update') {
                            $('#google_adword_media_content_data_' + data.id).replaceWith(data.view);
                        }
                        toastr.success('Cập nhật dữ liệu thành công', 'Success', {timeOut: 5000});
                        $('#modal_google_adword_media').modal('hide');
                    }, complete: function () {
                        readyGoogleAdwordMedia = true;
                    }
                })
            }
        })
        $(document).on('click', '.delete_google_adword_media', function (e) {
            e.preventDefault();
            let id = $(this).attr('data-id');
            let _url = $(this).attr('data-url');
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed && readyGoogleAdwordMedia) {
                    readyGoogleAdwordMedia = false;
                    $.ajax({
                        url: _url,
                        type: 'post',
                        data: {
                            _token: "{{csrf_token()}}",
                        },
                        success: function (data) {
                            $('#google_adword_media_content_data_' + data.id).remove();
                            Swal.fire(
                                'Deleted!',
                                'Your file has been deleted.',
                                'success'
                            )
                            $('#modal_google_adword_media').modal('hide');
                        }, complete: function () {
                            readyGoogleAdwordMedia = true;
                        }
                    })
                }
            })
        })
        $(document).on('click', '.delete-filter', function (e) {
            e.preventDefault();
            $('#start_date_filter').val('');
            $('#end_date_filter').val('');
            $('#website_id_filter').val('');
            $('#campaign_filter').val('');
            $('#location_search_filter').val('');
            $('#language_search_filter').val('');
            $('#type_campaign_filter').val('');
            $('#bid_price_filter').val('');
            $('#keyword_filter').val('');
            $('#title_1_filter').val('');
            $('#title_2_filter').val('');
            $('#title_3_filter').val('');
            $('#describe_filter').val('');
            $('#link_post_filter').val('');
            $('#budget_filter').val('');
            getGoogleAdwordMedia();
        })

    </script>
    @endpush
