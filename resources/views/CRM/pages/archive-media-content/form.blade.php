@extends('CRM.layouts.default')

@section('title')
    Media Content {{!empty($archiveMediaContentData)?'Update':'Create'}}
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

        thead th {
            font-size: 0.83rem;
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

        .table-div thead th input, .table-div thead th select, .table-div tbody th, .table-div tbody td {
            font-size: 0.83rem;
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
    <div class="card">
        <div class="card-header">
            <a href="{{route('archive-media-content.index')}}" class="btn btn-primary mb-3"><i class="fas fa-long-arrow-alt-left"></i> Back</a>
            <h5>{{!empty($archiveMediaContentData)?'Update':'Create'}} Media Content</h5>
        </div>
        <div class="card-body">
            <form action="{{!empty($archiveMediaContentData)?route('archive-media-content.update',['id'=>$archiveMediaContentData->id]):route('archive-media-content.store')}}" method="post">
                @csrf
                <div class="row">
                    <div class="col-md-4 content-table fill_content">
                        <div class="form-group">
                            <label class="control-label">Website:</label>
                            <select class="form-control" name="website_id" id="website_id">
                                <option label=""></option>
                                @foreach($webMedia as $value)
                                    <option data-value="{{$value->value}}" value="{{$value->id}}" {{!empty($archiveMediaContentData) && $archiveMediaContentData->website_id == $value->id ?'selected':''}} >{{$value->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4 content-table fill_content">
                        <div class="form-group">
                            <label class="control-label">Categories:</label>
                            @if(!empty($archiveMediaContentData))
                                <select name="category_id" id="category_id" class="form-control">
                                    @foreach($archiveMediaContentData->getWebsiteValue($webMedia) as $keyValueWebsite=>$value)
                                        <option
                                            value="{{$keyValueWebsite+1}}" {{$archiveMediaContentData->category_id == $keyValueWebsite+1 ?'selected':''}}>{{$value}}</option>
                                    @endforeach
                                </select>
                            @else
                                <select name="category_id" id="category_id" class="form-control">

                                </select>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="">Date</label>
                            <input type="text" class="form-control" name="date" id="date" autocomplete="off" value="{{!empty($archiveMediaContentData)?convert_date_form_db($archiveMediaContentData->date):''}}">
                        </div>
                    </div>
                    <div class="col-md-12 content-table fill_content">
                        <div class="form-group">
                            <label class="control-label">Title:</label>
                            <input class="form-control" value="{{!empty($archiveMediaContentData)?$archiveMediaContentData->title:''}}"
                                   name="title" id="title" type="text" required>
                        </div>
                    </div>
                    <div class="col-md-12 content-table fill_content">
                        <div class="form-group">
                            <label class="control-label">Content:</label>
                            <textarea class="form-control" name="content" id="content" cols="30" rows="10">{{!empty($archiveMediaContentData)?$archiveMediaContentData->content:''}}</textarea>
                        </div>
                    </div>
                    <div class="col-md-4 content-table fill_content">
                        <div class="form-group">
                            <label class="control-label">Status:</label>
                            <select class="form-control" name="status" id="status">
                                <option label=""></option>
                                @if(!empty($statusArchiveMediaContent))
                                    @foreach($statusArchiveMediaContent as $keyStatusArchiveMediaContent=>$value)
                                        <option
                                            value="{{$keyStatusArchiveMediaContent}}" {{!empty($archiveMediaContentData) && $archiveMediaContentData->status == $keyStatusArchiveMediaContent ?'selected':''}}>{{$value}}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4 content-table fill_content">
                        <div class="form-group">
                            <label class="control-label">Create By:</label>
                            <select class="form-control" name="created_by" id="created_by">
                                <option label=""></option>
                                @if(!empty($admins))
                                    @foreach($admins as $keyAdmin=>$value)
                                        <option
                                            value="{{$keyAdmin}}" {{!empty($archiveMediaContentData) && $archiveMediaContentData->created_by == $keyAdmin ?'selected':''}}>{{$value}}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                    </div>
                    <div class="col-md-12 content-table fill_content">
                        <div class="form-group">
                            <label class="control-label">Note:</label>
                            <textarea name="note" id="note" class="form-control my-editor"
                                      rows="5"> {{!empty($archiveMediaContentData)?$archiveMediaContentData->note:''}}</textarea>
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>

@endsection
@push('scripts')
    @include('CRM.partials.choose_date',['ids'=>[
        'date'
    ]]);

    <script>
        CKEDITOR.replace('content');
        $(document).on('change', '#website_id', function (e) {
            var value = $(this).find(":selected").attr('data-value');
            var arrValue;
            if (value) {
                arrValue = JSON.parse(value);
            } else {
                arrValue = [];
            }
            html = '';
            $.each(arrValue, function (index, value) {
                html += '<option value="' + parseInt(index+1) + '">' + value + '</option>';
            });
            $('#category_id').html(html);
        })
    </script>
    @endpush
