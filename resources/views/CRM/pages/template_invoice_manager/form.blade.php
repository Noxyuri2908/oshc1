@extends('CRM.layouts.default')

@section('title')
    Template Invoice {{!empty($templateData)?'Update':'Create'}}
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
            <a href="{{route('template_invoice_manager.index')}}" class="btn btn-primary mb-3"><i class="fas fa-long-arrow-alt-left"></i> Back</a>
            <h5>{{!empty($templateData)?'Update':'Create'}} Template Invoice</h5>
        </div>
        <div class="card-body">
            <form action="{{!empty($templateData)?route('template_invoice_manager.update',['id'=>$templateData->id]):route('template_invoice_manager.store')}}" method="post">
                @csrf
                @if (
                $templateData->template_name == 6 ||
                $templateData->template_name == 7 ||
                $templateData->template_name == 9 ||
                $templateData->template_name == 10 ||
                $templateData->template_name == 11 ||
                $templateData->template_name == 12 ||
                $templateData->template_name == 13 ||
                $templateData->template_name == 14 ||
                $templateData->template_name == 16 ||
                $templateData->template_name == 17 ||
                $templateData->template_name == 18 ||
                $templateData->template_name == 19 ||
                $templateData->template_name == 20
                )
                    <div class="row">
                        <div class="col-md-4 content-table fill_content">
                            <div class="form-group">
                                <label class="control-label">Template Name:</label>
                                <select class="form-control" name="template_name" id="template_name" required {{!empty($templateData)?'disabled':''}}>
                                    <option label=""></option>
                                    @if(!empty($invoiceTypeConfig))
                                        @foreach($invoiceTypeConfig as $keyTemplate=>$value)
                                            <option value="{{$keyTemplate}}" {{!empty($templateData) && $templateData->template_name == $keyTemplate ?'selected':''}} >{{$keyTemplate.'.'.$value}}</option>
                                        @endforeach
                                    @endif
                                </select>
                                @if($errors->has('template_name'))
                                    <small class="text-danger">{{$errors->get('template_name')[0]}}</small>
                                @endif
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="">Company Name </label>
                                <input type="text" class="form-control" name="company_name" id="company_name" autocomplete="off" value="{{!empty($templateData)?$templateData->company_name:''}}">
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="">Company Address</label>
                                <input type="text" class="form-control" name="company_address" id="company_address" autocomplete="off" value="{{!empty($templateData)?$templateData->company_address:''}}">
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="">Company Email</label>
                                <input type="text" class="form-control" name="company_email" id="company_email" autocomplete="off" value="{{!empty($templateData)?$templateData->company_email:''}}">
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="">Company Phone</label>
                                <input type="text" class="form-control" name="company_phone" id="company_phone" autocomplete="off" value="{{!empty($templateData)?$templateData->company_phone:''}}">
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="">Company Website</label>
                                <input type="text" class="form-control" name="company_website" id="company_website" autocomplete="off" value="{{!empty($templateData)?$templateData->company_website:''}}">
                            </div>
                        </div>
                    </div>
                @elseif(
                    $templateData->template_name == 1 ||
                    $templateData->template_name == 2 ||
                    $templateData->template_name == 3 ||
                    $templateData->template_name == 4 ||
                    $templateData->template_name == 5 ||
                    $templateData->template_name == 8 ||
                    $templateData->template_name == 15 ||
                    $templateData->template_name == 26 ||
                    $templateData->template_name == 25
)
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="">Tên công ty</label>
                                <input type="text" class="form-control" name="company_name_vi" id="company_name_vi" autocomplete="off" value="{{!empty($templateData)?$templateData->company_name_vi:''}}">
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="">Địa chỉ 1</label>
                                <input type="text" class="form-control" name="company_address_vi_1" id="company_address_vi_1" autocomplete="off" value="{{!empty($templateData)?$templateData->company_address_vi_1:''}}">
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="">Số điện thoại 1</label>
                                <input type="text" class="form-control" name="company_phone_vi_1" id="company_phone_vi_1" autocomplete="off" value="{{!empty($templateData)?$templateData->company_phone_vi_1:''}}">
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="">Địa chỉ 2</label>
                                <input type="text" class="form-control" name="company_address_vi_2" id="company_address_vi_2" autocomplete="off" value="{{!empty($templateData)?$templateData->company_address_vi_2:''}}">
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="">Số điện thoại 2</label>
                                <input type="text" class="form-control" name="company_phone_vi_2" id="company_phone_vi_2" autocomplete="off" value="{{!empty($templateData)?$templateData->company_phone_vi_2:''}}">
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="">Địa chỉ Email</label>
                                <input type="text" class="form-control" name="company_email_vi" id="company_email_vi" autocomplete="off" value="{{!empty($templateData)?$templateData->company_email_vi:''}}">
                            </div>
                        </div>
                    </div>
                @endif
                <div class="row">
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="">Logo</label>
                            <div class="row">

                                <div class="col-md-8">
                                    <input id="logo_thumb" class="form-control" type="text"
                                           name="logo" value="{{!empty($templateData)?$templateData->logo:''}}">
                                </div>
                                <div class="col-md-1">
                                    <span class="input-group-btn">
                                        <a href="{{\Config::get('lfm.URL_FILEMANAGE_ARR')}}logo_thumb"
                                           class="btn btn-primary red iframe-btn"
                                           id="logo_iframe-btn">
                                            Chọn
                                        </a>
                                    </span>
                                </div>
                            </div>

                        </div>
                        <div id="logo_preview" style="width:250px;overflow: hidden">
                            @if(!empty($templateData))
                                <img src="{{!empty($templateData)?asset('FILES/source/').'/'.$templateData->logo:''}}"
                                     class="w-100">
                            @else
                            @endif
                        </div>
                    </div>

                    <div class="col-md-12 content-table fill_content">
                        <div class="form-group">
                            <label class="control-label">Content:</label>
                            <textarea class="form-control" name="content" id="content" cols="30" rows="10">{{!empty($templateData)?$templateData->content:''}}</textarea>
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
        settingIframe('#logo_iframe-btn', '#logo_thumb', '#logo_preview')

        CKEDITOR.replace('content')
        $(document).on('change', '#website_id', function (e) {
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
            $('#category_id').html(html)
        })
    </script>
@endpush
