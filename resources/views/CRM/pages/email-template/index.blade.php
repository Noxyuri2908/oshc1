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
                <a href="{{route('email.email-template..add-new')}}" class="btn btn-sm  btn-primary mr-2"> Add new</a>
            </div>
            <div class="table-email-templates">
                <table class="w-100">
                    <tr class="bg-color-email-template text-center">
                        <th class="width-50">STT</th>
                        <th>Content</th>
                        <th class="width-150">Catogory</th>
                        <th class="width-100">Status</th>
                        <th class="width-100">Action</th>
                    </tr>

                    @if(!empty($EmailTemplates))
                        @foreach($EmailTemplates as $key => $item)
                            <tr class="tr-content {{$loop->iteration / 2 != 0 ? 'odd' : ''}}">
                                <td>{{$item->id}}</td>
                                <td>{{$item->template}}</td>
                                <td>{{$item->cat_id}}</td>
                                <td><span
                                        class="badge badge-pill badge-success">{{$item->mail_status == 1 ? 'Active' : 'Deactive'}}</span>
                                </td>
                                <td>
                                    <div class="d-flex justify-content-around">
                                        <a href="{{route('email.email-template..edit', ['id' => $item->id])}}"
                                           class="btn btn-sm btn-primary">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <a href="javascript:void(0)" class="btn btn-sm btn-danger" id="destroy">
                                            <i class="fas fa-trash-alt"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td>no data</td>
                        </tr>
                    @endif
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
                        Swal.fire(
                            'Deleted!',
                            'Your file has been deleted.',
                            'success'
                        )
                    }
                })
            })
        })
    </script>
@endpush
