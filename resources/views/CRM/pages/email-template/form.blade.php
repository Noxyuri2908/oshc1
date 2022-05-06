@extends('CRM.layouts.default')

@section('title')
    Email Tempaltes
    @parent
@stop

@section('css')
    @include('CRM.partials.loading-css')
@stop
@section('content')
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-7">
                <h4 class="page-title text-truncate text-dark font-weight-bold mb-1"> Email Template</h4>
                <div class="d-flex align-items-center">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb m-0 p-0">
                            <li class="breadcrumb-item text-muted active" aria-current="page">Dashboard</li>
                            <li class="breadcrumb-item text-muted" aria-current="page">Add new template</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <div class="card card-primary m-0 m-md-4 my-4 m-md-0 shadow">
        <form
            action="{{$action == 'update' ? route('email.email-template.update', ['id' => !empty($emailTemplate->id) ? $emailTemplate->id : '']) : route('email.email-template.store')}}"
            method="post">
            {{csrf_field()}}
            <div class="card-body">
                <div class="media mb-4 justify-content-between">
                    <div class="col-md-3 form-group ">
                        <label for="">Category</label>
                        <select name="cat_id" id="" class="form-control">
                            <option value=""></option>
                            @foreach(getEmailCategories() as $key => $item)
                                <option
                                    value="{{$item->id}}" {{!empty($emailTemplate) && $item->id == $emailTemplate->cat_id ? 'selected' : ''}}>{{$item->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3 form-group ">
                        <label for="">Subject</label>
                        <input type="text" name="subject" class="form-control"
                               value="{{!empty($emailTemplate) ? $emailTemplate->subject : ''}}">
                    </div>
                    <div class="col-md-3 form-group">
                        <label for="" class="position-relative" style="left: 18px">Status</label>
                        <div class="button-cover position-absolute " style="top: 40px">
                            <div class="button r" id="button-2">
                                <input type="checkbox"
                                       class="checkbox"
                                       name="status" {{!empty($emailTemplate) && $emailTemplate->mail_status == 0 ? 'checked': ''}}>
                                <div class="knobs"></div>
                                <div class="layer"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                    <textarea class="form-control summernote" name="template" id="summernote" rows="20"
                              style="display: none;">{{!empty($emailTemplate) ? $emailTemplate->template : ''}}</textarea>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <button type="submit"
                                class="btn waves-effect waves-light btn-rounded btn-primary btn-block mt-3 "
                                style="border-radius: 12px">
                            Update
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
@stop

@push('scripts')
    <script>
        $(document).ready(function () {
            $('#summernote').summernote({
                codemirror: { // codemirror options
                    theme: 'monokai'
                },
                toolbar: [
                    ['style', ['style']],
                    ['fontsize', ['fontsize']],
                    ['font', ['bold', 'underline', 'clear']],
                    ['fontname', ['fontname']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['table', ['table']],
                    ['insert', ['link', 'picture', 'video']],
                    ['view', ['fullscreen', 'codeview', 'help']],
                ],
            });
        })
    </script>
@endpush
