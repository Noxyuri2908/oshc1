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
                <h4 class="page-title text-truncate text-dark font-weight-bold mb-1"> Email settings</h4>
                <div class="d-flex align-items-center">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb m-0 p-0">
                            <li class="breadcrumb-item text-muted active" aria-current="page">Dashboard</li>
                            <li class="breadcrumb-item text-muted" aria-current="page">Email settings</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <!--  START CARD SHORT CODE  -->
    <div class="card card-primary m-0 m-md-4 my-4 m-md-0 shadow">
        <div class="card-body">
            <div class="table-responsive table-short-code">
                <table class="table">
                    <thead>
                    <tr>
                        <th class="font-weight-bold"> SHORTCODE</th>
                        <th class="font-weight-bold"> DESCRIPTION</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>
                            <pre> [[name]] </pre>
                        </td>
                        <td> User's Name will replace here.</td>
                    </tr>
                    <tr>
                        <td>
                            <pre> [[message]] </pre>
                        </td>
                        <td>Application notification message will replace here.</td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!--  END CARD SHORT CODE  -->


    <!--  START EMAIL SETTINGS  -->
    <div class="card card-primary m-0 m-md-4 my-4 m-md-0 shadow">
        <div class="card-body">

            <form action="{{route('email.email-settings.update')}}"
                  method="post">
                {{csrf_field()}}
                <input type="hidden" value="{{!empty($emailSettings[0]) ? $emailSettings[0]->id : ''}}" name="id">
                <div class="row">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label for="">Email address</label>
                                <input type="email" name="email-address" class="form-control" id="" aria-describedby=""
                                       placeholder="Enter email"
                                       value="{{!empty($emailSettings[0]) ? $emailSettings[0]->email_from : ''}}">
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="">Password</label>
                                <input type="password" name="email-password" class="form-control" id=""
                                       aria-describedby=""
                                       placeholder="Enter password"
                                       value="{{!empty($emailSettings[0]) ? $emailSettings[0]->email_password : ''}}">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 form-group">
                                <label for="">Email description</label>
                                <textarea class="form-control summernote" name="email-description" id="summernote"
                                          rows="20"
                                          style="display: none;">{{!empty($emailSettings[0]) ? $emailSettings[0]->email_description : ''}}</textarea>
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
                </div>
            </form>
        </div>
    </div>
    <!--  END EMAIL SETTINGS  -->
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
