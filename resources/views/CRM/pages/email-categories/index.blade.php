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
                <h4 class="page-title text-truncate text-dark font-weight-bold mb-1"> Email Categories</h4>
                <div class="d-flex align-items-center">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb m-0 p-0">
                            <li class="breadcrumb-item text-muted active" aria-current="page">Dashboard</li>
                            <li class="breadcrumb-item text-muted" aria-current="page">Email Categories</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <div class="card card-primary m-0 m-md-4 my-4 m-md-0 shadow">
        <div class="card-body">
            <div class="row">
                <!--       START FORM show categories         -->
                <div style="border-right: 1px solid #ccc;" class="col-md-6">
                    <div class="table-email-templates">
                        <table class="w-100">
                            <tr class="bg-color-email-template text-center">
                                <th class="width-15">STT</th>
                                <th class="width-140">Name</th>
                                <th class="width-25">Status</th>
                                <th class="width-25">Action</th>
                            </tr>

                            @if(!empty($emailCategories))
                                @foreach($emailCategories as $key => $item)
                                    <tr class="tr-content {{$loop->iteration / 2 != 0 ? 'odd' : ''}}">
                                        <td class="text-center">{{$item->id}}</td>
                                        <td>{{$item->name}}</td>
                                        <td class="text-center"><span
                                                class="badge badge-pill badge-success">{{$item->status == 1 ? 'Active' : 'Deactive'}}</span>
                                        </td>
                                        <td>
                                            <div class="d-flex justify-content-around">
                                                <a href=""
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
                <!--       END FORM show catetories         -->

                <!--       START FORM ADD + UPDATE CATEGORIES         -->
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label for="">Name</label>
                            <input type="text" class="form-control" id="" aria-describedby="emailHelp">
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="" class="position-relative" style="left: 18px">Status</label>
                            <div class="button-cover position-absolute " style="top: 40px">
                                <div class="button r" id="button-2">
                                    <input type="checkbox"
                                           class="checkbox" {{!empty($emailTemplate) && $emailTemplate->status == 1 ? 'checked': ''}}>
                                    <div class="knobs"></div>
                                    <div class="layer"></div>
                                </div>
                            </div>

                        </div>
                        <div class="col-md-12">
                            <button type="submit"
                                    class="btn waves-effect waves-light btn-rounded btn-primary btn-block mt-3 "
                                    style="border-radius: 12px">
                                Update
                            </button>
                        </div>
                    </div>
                </div>
                <!--       END FORM ADD + UPDATE CATEGORIES         -->
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
