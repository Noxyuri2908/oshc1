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
                            <li class="breadcrumb-item text-muted" aria-current="page">Email Template</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <div class="card card-primary m-0 m-md-4 my-4 m-md-0 shadow">
        <div class="card-body">
            <div class="media mb-4 justify-content-between">
                <a href="{{route('email.email-template.add-new')}}" class="btn btn-sm  btn-primary mr-2"> Add new</a>
            </div>
            <div class="table-email-templates">
                <table class="w-100">
                    <thead>
                    <tr class="bg-color-email-template text-center">
                        <th class="width-50">STT</th>
                        <th class="width-100">Subject</th>
                        <th>Content</th>
                        <th class="width-150">Catogory</th>
                        <th class="width-100">Status</th>
                        <th class="width-100">Action</th>
                    </tr>
                    </thead>

                    <tbody id="data-email-templates">
                    @include('CRM.pages.email-template.data', ['EmailTemplates' => $EmailTemplates]) {{--resources/views/CRM/pages/email-template/data.blade.php--}}
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@stop

@push('scripts')
    <script>
        $(document).ready(function () {
            $(document).on('click', '#destroy', function (e) {
                e.preventDefault();
                var id = $(this).attr('data-id');
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then(result => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: "{{route('email.email-template.destroy')}}",
                            type: 'post',
                            data: {
                                _token: "{{csrf_token()}}",
                                id,
                            },
                            success: function (result) {
                                if (result.code == 200) {
                                    $('#data-email-templates').html(result.view);
                                    Notiflix.Notify.success(`${result.message}`);
                                }
                            }
                        })
                    }
                })
            })
        })
    </script>
@endpush
