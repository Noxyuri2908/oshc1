@extends('CRM.layouts.default')

@section('title')
    Media Content
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

        .post-cont img {
            max-width: 100% !important;
            height: auto !important;
        }

        .post-cont img {
            max-width: 100% !important;

        }

        .post-cont {
            font-size: 14px;
            line-height: 1.6;
            color: #333;
        }

        .post-cont h1,
        .post-cont h2,
        .post-cont h3,
        .post-cont h4,
        .post-cont h5,
        .post-cont h6 {
            font-weight: 600 !important;
            color: #333;
        }

        .post-cont h1 {
            font-size: 3.0rem;
        }

        .post-cont h2 {
            font-size: 1.6rem;
        }

        .post-cont h3 {
            font-size: 1.4rem;
        }

        .post-cont h4 {
            font-size: 14px;
        }

        .post-cont h5 {
            font-size: 14px;
        }

        .post-cont h6 {
            font-size: 14px;
        }
    </style>
@endsection
@section('content')
    <div>
        <div class="card">
            <div class="card-header">
                <h5>Kho content</h5>
                <div class="d-flex justify-content-end">
                    <a href="{{route('archive-media-content.create')}}" class="btn btn-success " id=""><i class="fas fa-plus"></i></a>
                    <a href="#" class="delete-filter btn btn-primary ml-2">Delete Filter</a>
                </div>
            </div>
            <div class="card-body">
                <div class="table-archive-media-content table-div">
                    <table class="">
                        <thead class="">
                            <tr class="first-row">
                                <th class="width-80">Action</th>
                                <th class="width-200">Website</th>
                                <th class="width-220">Categories</th>
                                <th class="width-170">Title</th>
                                <th class="width-100">Content</th>
                                <th class="width-170">Date</th>
                                <th class="width-170">Status</th>
                                <th class="width-200">Note</th>
                                <th class="width-200">Created by</th>
                            </tr>
                            @include('CRM.pages.archive-media-content.filter')
                        </thead>
                        <tbody id="archive-media-content-table-tbody">

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div id="modal_archive_media_content_form"></div>
        <div id="modal_archive_media_content_view_content_post"></div>

    </div>
@endsection
@push('scripts')

    @if(session()->get('success')== 1)
        <script>
            toastr.success('{{!empty(session()->get('update'))?'Update success':'Create success'}}', 'Alert')
        </script>
    @endif
    <script>
        var pageArchiveMediaContent = 1
        var lastPageArchiveMediaContent
        var readyArchiveMediaContent = true
        var arrData = []
        //filter
        var website_id_filter = ''
        var category_id_filter = ''
        var title_filter = ''
        var date_filter = ''
        var status_filter = ''
        var note_filter = ''
        var created_by_filter = ''

        function getArchiveMediaContent(page) {
            if (!page) {
                page = 1
            }
            $.ajax({
                url: "{{route('archive-media-content.getData')}}",
                type: 'get',
                data: {
                    page: page,
                    @if(request()->get('report_end_date') && request()->get('report_start_date'))
                    processing_date_ArchiveMediaContent_start: "{{request()->get('report_start_date')}}",
                    processing_date_ArchiveMediaContent_end: "{{request()->get('report_end_date')}}",
                    @endif
                        @if(request()->get('filter_date_option'))
                    filter_date_option: "{{request()->get('filter_date_option')}}",
                    @endif
                },
                success: function (data) {
                    $('#archive-media-content-table-tbody').html(data.view)
                    lastPageArchiveMediaContent = data.last_page
                },
            })
        }

        getArchiveMediaContent()

        function callAjaxArchiveMediaContent() {
            readyArchiveMediaContent = false
            pageArchiveMediaContent = 1
            website_id_filter = $('#website_id_filter').val()
            category_id_filter = $('#category_id_filter').val()
            title_filter = $('#title_filter').val()
            date_filter = $('#date_filter').val()
            status_filter = $('#status_filter').val()
            note_filter = $('#note_filter').val()
            created_by_filter = $('#created_by_filter').val()
            getArchiveMediaContentFilter(
                pageArchiveMediaContent,
                website_id_filter,
                category_id_filter,
                title_filter,
                date_filter,
                status_filter,
                note_filter,
                created_by_filter
                , 0)
            $('#box_data_customer').scrollTop(0)
        }

        function ajaxArchiveMediaContent(data) {
            if (readyArchiveMediaContent) {
                callAjaxArchiveMediaContent()
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

        const debounceAjaxArchiveMediaContent = debounce(ajaxArchiveMediaContent, 400)

        $(document).on('keyup', '.table-archive-media-content .last-row input', function (e) {
            debounceAjaxArchiveMediaContent(e.target.value)
        })
        $(document).on('change', '.table-archive-media-content .last-row select', function (e) {
            debounceAjaxArchiveMediaContent(e.target.value)
        })

        $(document).on('keypress', function (e) {
            if (e.keyCode == 13 && readyArchiveMediaContent) {
                callAjaxArchiveMediaContent()
            }
        })

        function getArchiveMediaContentFilter(
            pageArchiveMediaContent,
            website_id_filter,
            category_id_filter,
            title_filter,
            date_filter,
            status_filter,
            note_filter,
            created_by_filter
            , isAppend) {
            $.ajax({
                url: "{{route('archive-media-content.getData')}}",
                type: 'get',
                data: {
                    page: pageArchiveMediaContent,
                    website_id: website_id_filter,
                    category_id: category_id_filter,
                    title: title_filter,
                    date: date_filter,
                    status: status_filter,
                    note: note_filter,
                    created_by: created_by_filter,
                },
                success: function (data) {
                    if (isAppend == 0) {
                        $('#archive-media-content-table-tbody').html(data.view)
                    } else if (isAppend == 1) {
                        $('#archive-media-content-table-tbody').append(data.view)
                    }
                    lastPageArchiveMediaContent = data.last_page
                },
                complete: function () {
                    readyArchiveMediaContent = true
                },
            })

        }

        $('.table-archive-media-content').scroll(function (e) {
            if (readyArchiveMediaContent && Math.round($(this).scrollTop() + $(this)
                .innerHeight(), 10) >= Math.round($(this)[0].scrollHeight, 10) - 80) {
                readyArchiveMediaContent = false
                if (pageArchiveMediaContent < lastPageArchiveMediaContent) {
                    pageArchiveMediaContent++
                    getArchiveMediaContentFilter(
                        pageArchiveMediaContent,
                        website_id_filter,
                        category_id_filter,
                        title_filter,
                        date_filter,
                        status_filter,
                        note_filter,
                        created_by_filter,
                        1)
                } else {
                    readyArchiveMediaContent = true
                }
            }
        })

        $(document).on('click', '.delete_archive_media_content', function (e) {
            e.preventDefault()
            let id = $(this).attr('data-id')
            let _url = $(this).attr('data-url')
            Swal.fire({
                title: 'Are you sure?',
                text: 'You won\'t be able to revert this!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!',
            }).then((result) => {
                if (result.isConfirmed && readyArchiveMediaContent) {
                    readyArchiveMediaContent = false
                    $.ajax({
                        url: _url,
                        type: 'post',
                        data: {
                            _token: "{{csrf_token()}}",
                        },
                        success: function (data) {
                            $('#archive_media_content_data_' + data.id).remove()
                            Swal.fire(
                                'Deleted!',
                                'Your file has been deleted.',
                                'success',
                            )
                            $('#modal_archive_media_content').modal('hide')
                        }, complete: function () {
                            readyArchiveMediaContent = true
                        },
                    })
                }
            })
        })
        $(document).on('change', '#website_id_filter', function (e) {
            var value = $(this).find(':selected').attr('data-value')
            var arrValue
            if (value) {
                arrValue = JSON.parse(value)
            } else {
                arrValue = []
            }
            html = ''
            $.each(arrValue, function (index, value) {
                html += '<option value="' + parseInt(index + 1) + '">' + value + '</option>'
            })
            $('#category_id_filter').html(html)
        })
        $(document).on('click', '.view_content_post', function (e) {
            e.preventDefault()
            _url = $(this).attr('data-url')
            $.ajax({
                url: _url,
                type: 'get',
                success: function (data) {
                    $('#modal_archive_media_content_view_content_post').html(data)
                    $('#modalViewContentPost').modal('show')
                },
            })
        })
        $(document).on('click', '.delete-filter', function (e) {
            e.preventDefault();
            $('#website_id_filter').val('')
            $('#category_id_filter').val('')
            $('#title_filter').val('')
            $('#date_filter').val('')
            $('#status_filter').val('')
            $('#note_filter').val('')
            $('#created_by_filter').val('')
            getArchiveMediaContent()
        })
    </script>
    @include('CRM.partials.choose_date_onchange_call_function',[
    'idElementInputFlatpick'=>[
        'date_filter'
],
'functionNameCall'=>'callAjaxArchiveMediaContent'
])
@endpush
