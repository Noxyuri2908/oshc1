@extends('CRM.layouts.default')

@section('title')
    STAFF
    @parent
@stop

@section('css')
    @include('CRM.partials.css-list')
    @include('CRM.pages.css.customer-css')
    <style>
        #table-flywire_wrapper .row {
            width: 100%;
        }
    </style>
@stop
@section('content')
    <div class="card">
        <div class="card-header">
            @can('users.store')
                <a href="{{route('staff.create')}}" class="btn btn-primary">Create</a>
            @endcan
        </div>
        <div class="card-body">
            <div id="multi_action" style="display: none" class="ml-5">
                <a data-type="{{(!empty($tab))?$tab:''}}" data-url="{{route("customer.multi_delete")}}" href="#"
                   class="btn btn-default delete_row_data"><i class="fas fa-trash-alt"></i></a>
                {{-- <a class="send_email btn btn-default"><span><i class="fas fa-envelope"></i></span></a> --}}
            </div>
            <div class="w-100 table-responsive-sm" style="overflow-y: scroll">
                <table class="table table-sm mb-0 table-dashboard fs--1 table-flywire" id="table-flywire">
                    <thead>
                    <tr>
                        <th class="no-sort check-all-table text-center"><input type="checkbox" id="master"></th>
                        <th class="text-center">Username</th>
                        <th class="text-center">Email</th>
                        <th class="text-center">ID</th>
                        <th class="text-center">Date of birth</th>
                        <th class="text-center">Address</th>
                        <th class="text-center">Phone</th>
                        <th class="text-center">Department</th>
                        <th class="text-center">Branch</th>
                        <th class="text-center">Position</th>
                        <th class="text-center">Created By</th>
                        <th class="text-center">Trạng Thái</th>
                        <th class="text-center">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($data as $obj)
                        <tr>
                            <td class="text-center"><input type="checkbox" class="sub_chk" data-id="{{$obj->id}}"></td>
                            <td class="text-center">{{$obj->username}}</td>
                            <td class="text-center">{{$obj->email}}</td>
                            <td class="text-center">
                                {{$obj->admin_id}}
                            </td>
                            <td class="text-center">
                                {{convert_date_form_db($obj->date_of_birth)}}
                            </td>
                            <td class="text-center">
                                {{$obj->address}}
                            </td>
                            <td class="text-center">
                                {{$obj->phone}}
                            </td>
                            <td class="text-center">
                                {{$department_ids->where('id',$obj->department_id)->pluck('name')->first()}}
                            </td>
                            <td class="text-center">
                                {{$branch_ids->where('id',$obj->branch_id)->pluck('name')->first()}}
                            </td>
                            <td class="text-center">
                                {{$position_ids->where('id',$obj->position_id)->pluck('name')->first()}}
                            </td>
                            <td class="text-center">{{$obj->staff != null ? $obj->staff->username : ''}}</td>
                            <td class="text-center">
                                @if ($obj->status == 1)
                                    <span class="label label-success">Đang sử dụng</span></a>
                                @else
                                    <span class="label label-danger">Ngừng sử dụng</span></a>
                                @endif
                            </td>
                            <td class="text-center">
                                @can('users.update')
                                    <a href="{{route('staff.edit', ['id'=>$obj->id])}}"
                                       class="btn btn-primary btn-circle"><i class="fa fa-edit"></i></a>
                                @endcan
                                @can('users.destroy')
                                    <a class="btn btn-danger btn-circle delete-button text-light"
                                       data-action="{{ route('staff.destroy',$obj->id) }}" type="button">
                                        <i class="fa fa-trash"></i>
                                    </a>
                                @endcan
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div class="d-flex justify-content-end mt-2">
                @if(!empty($invoices) && $invoices->hasPages())
                    {{ $invoices->appends(convertArrNullToEmptyValue(request()->query()))->links() }}
                @endif
            </div>
        </div>
    </div>
@stop
@push('scripts')
    <script src="{{asset('js/select-all.js')}}"></script>
    <script src="{{asset('backend/js/plugins/dataTables/datatables.min.js')}}"></script>
    <script src="{{asset('js/delete-modal.js')}}"></script>
    <script>
        $(document).ready(function () {
            @if(session()->has('success-staff'))
            toastr.success('Update successful!');
            @endif
            $(document).on('click', '.delete-button', function (e) {
                e.preventDefault();
                let url = $(this).attr('data-action');
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: url,
                            type: 'post',
                            data: {
                                _method: 'delete',
                                _token: '{{csrf_token()}}'
                            },
                            success: function (data) {
                                Swal.fire(
                                    'Deleted!',
                                    'Your file has been deleted.',
                                    'success'
                                )
                            }
                        })

                    }
                })
            })
            $('.table-flywire').DataTable({
                "scrollX": true
            });
        });
    </script>
@endpush
