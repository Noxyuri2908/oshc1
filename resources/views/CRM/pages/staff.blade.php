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
                        <button id="button_countries" data-toggle="modal" data-target="#modalCountries">Countries</button>
                        <button id="button_department" data-toggle="modal" data-target="#modalDepartment">Department</button>
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
                        <tr id="staff-record" data-id="{{$obj->id}}" is-clicked="false">
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

    <!-- Modal countries -->
    <div class="modal fade" id="modalCountries" tabindex="-1" role="dialog" aria-labelledby="modalCountries" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">List of countries for staff</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div id="countries_parent">
                        <label for="countries">List of countries</label>
                        <div>
                            <select name="countries[]" id="countries" style="width: 50%" multiple="multiple">
                                <option value=""></option>
                                @foreach(config('country.list') as $key => $item)
                                    <option value="{{$key}}">{{$item}}</option>
                                @endforeach
                            </select>
                        </div>
                        <input type="hidden" data-id="" id="id_selected">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="saveRoleCountries">Save changes</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Department -->
    <div class="modal fade" id="modalDepartment" tabindex="-1" role="dialog" aria-labelledby="modalDepartment" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Department authorization</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div id="countries_parent">
                        <label for="department">Department</label>
                        <div>
                            <select name="department[]" id="department" style="width: 50%" multiple="multiple">
                                <option value=""></option>
                                @foreach(config('myconfig.department') as $key => $item)
                                    <option value="{{$key}}">{{$item}}</option>
                                @endforeach
                            </select>
                        </div>
                        <input type="hidden" data-id="" id="id_selected">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="saveRoleDepartment">Save changes</button>
                </div>
            </div>
        </div>
    </div>
@stop
@push('scripts')
    <script src="{{asset('js/select-all.js')}}"></script>
    <script src="{{asset('backend/js/plugins/dataTables/datatables.min.js')}}"></script>
    <script src="{{asset('js/delete-modal.js')}}"></script>
    <script>
        var arrCountries = [];
        var arrDepartment = [];
        var idStaff;

        $(document).on('click', '#saveRoleDepartment', function (){
            if (arrDepartment.length >= 3)
            {
                arrDepartment = arrDepartment.slice(1);
            }
            $.ajax({
                url: "{{route('staff.roleDepartment')}}",
                type: 'post',
                data: {
                    idStaff,
                    arrDepartment,
                    _token: "{{csrf_token()}}",
                },
                success: function (data) {
                    if (data.code == 200)
                    {
                        console.log('update role successfully');
                        $('#modalDepartment').modal('hide')
                    }
                }
            })
        })

        $(document).on('click', '#saveRoleCountries', function (){
            if (arrCountries.length >= 3)
            {
                arrCountries = arrCountries.slice(1);
            }
            $.ajax({
                url: "{{route('staff.roleCountries')}}",
                type: 'post',
                data: {
                    idStaff,
                    arrCountries,
                    _token: "{{csrf_token()}}",
                },
                success: function (data) {
                    if (data.code == 200)
                    {
                        console.log('update role successfully');
                        $('#modalCountries').modal('hide')
                    }
                }
            })
        })

        $(document).on('change', '#countries', function(){

            var options = $('#countries').find(':selected');
            options.each( index => {
                arrCountries.push(options[index].value);
            })

            if ($('#countries').find(':selected').text() === '')
            {
                arrCountries = [];

            }
        })

        $(document).on('change', '#department', function(){
            var options = $('#department').find(':selected');
            options.each( index => {
                arrDepartment.push(options[index].value);
            })

            if ($('#department').find(':selected').text() == '')
            {
                arrDepartment = [];

            }
        })

        $(document).on('click', '#staff-record', function (){
            if ($(this).attr('is-clicked') == 'false')
            {
                //remove record in-active
                $('tr#staff-record.odd').css('background-color','');
                $('tr#staff-record.even').css('background-color','');

                // remove att is-clicked with record in-active
                $('tr#staff-record.odd').attr('is-clicked', false);
                $('tr#staff-record.even').attr('is-clicked', false);

                // active record clicked
                $(this).css('background-color', '#ccc');
                $(this).attr('is-clicked', true);
                idStaff = $(this).attr('data-id');
                $.ajax({
                    url: "{{route('staff.getRoleCountries')}}",
                    type: 'post',
                    data: {
                        idStaff,
                        _token: "{{csrf_token()}}",
                    },
                    success: function (data) {
                        if (data.code == 200)
                        {
                            var countries = data.data;
                            if (_.size(countries) > 0)
                            {
                                for (const [key, value] of Object.entries(countries)) {
                                    var option = new Option(value,key, true, true)
                                    $('#countries').append(option).trigger('change')
                                }

                            }
                        }
                    }
                })


                $.ajax({
                    url: "{{route('staff.getRoleDepartment')}}",
                    type: 'post',
                    data: {
                        idStaff,
                        _token: "{{csrf_token()}}",
                    },
                    success: function (data) {
                        if (data.code == 200)
                        {
                            var countries = data.data;
                            if (_.size(countries) > 0)
                            {
                                for (const [key, value] of Object.entries(countries)) {
                                    var option = new Option(value,key, true, true)
                                    $('#department').append(option).trigger('change')
                                }

                            }
                        }
                    }
                })

                // open option role countries
                $('#button_countries').css('display', 'block')
                $('#button_department').css('display', 'block')
            }
        })

        $(document).ready(function () {

            $('#countries').select2({
                multiple : true,
                dropdownParent: $('#countries_parent'),
            })

            $('#department').select2({
                multiple : true,
            })


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
