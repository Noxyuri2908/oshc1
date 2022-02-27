<div class="card mb-3">
    <div class="card-header pb-1">
        <div class="row align-items-center px-2">
            <div class="d-flex w-100 justify-content-between align-items-center">
                <h5 class="fs-0 mb-0 font-roboto">{{!isset($tab_name) ? 'CUSTOMER' : $tab_name}}</h5>
                @if(!empty($tab_name) && $tab_name == 'EXTEND')
                    <div>
                        <a class="btn btn-primary remind-extend-invoice" href="#">Extend</a>
                        <a class="btn btn-primary remind-invoice" href="#">Remind status</a>
                    </div>
                @endif
                <div class="d-flex">
                    <div id="btn-action" style="margin-right: 10px;display: none">
                        <a href="#" id="edit-cus" class="edit-cus btn btn-falcon-default font-weight-normal font-size-12px">
                            Edit
                        </a>
                        <a href="#" class="delete-cus btn btn-falcon-default font-weight-normal font-size-12px">
                            Delete
                        </a>
                        <a href="#" class="export-invoice-cus-1 btn btn-falcon-default font-weight-normal font-size-12px">
                            Export invoice 1
                        </a>
                        <a href="#" class="export-invoice-cus-2 btn btn-falcon-default font-weight-normal font-size-12px">
                            Export invoice 2
                        </a>
                        <a href="#" class="process-cus btn btn-falcon-default font-weight-normal font-size-12px position-relative">
                            Process &raquo
                            <ul class="sub-menu-process-cus position-absolute">
                                <li class="process-item-cus-com">
                                    <p>Commission</p>
                                </li>
                                <li class="process-item-cus-profit">
                                    <p>Profit</p>
                                </li>
                                <li class="process-item-cus-refund">
                                    <p>Refund</p>
                                </li>
                            </ul>
                        </a>

                    </div>
                    @can('customer.store')
{{--                        <a href="{{route('customer.create')}}"--}}
{{--                           class="btn btn-falcon-default mr-2 font-weight-normal font-size-12px">--}}
{{--                            <i class="fas fa-plus"></i> Add</a>--}}
                        <a href="#"
                           class="btn btn-falcon-default mr-2 font-weight-normal font-size-12px" data-toggle="modal" data-target="#modalCreateCustomer">
                            <i class="fas fa-plus"></i> Add</a>
                        {{-- modal create customer--}}
                        <div class="modal fade modalCreateCustomer" id="modalCreateCustomer" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">NEW APPLICATION</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        @include('CRM.elements.customers.modal-create')
                                    </div>
{{--                                    <div class="modal-footer">--}}
{{--                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>--}}
{{--                                        <button type="button" class="btn btn-primary">Save changes</button>--}}
{{--                                    </div>--}}
                                </div>
                            </div>
                        </div>
                    @endcan

                    <a href="#" class="delete-filter btn btn-falcon-default font-weight-normal font-size-12px">
                        <img style="width: 15px"
                             src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHZlcnNpb249IjEuMSIgeG1sbnM6eGxpbms9Imh0dHA6Ly93d3cudzMub3JnLzE5OTkveGxpbmsiIHhtbG5zOnN2Z2pzPSJodHRwOi8vc3ZnanMuY29tL3N2Z2pzIiB3aWR0aD0iNTEyIiBoZWlnaHQ9IjUxMiIgeD0iMCIgeT0iMCIgdmlld0JveD0iMCAwIDM5Ni44MTcgMzk2LjgxNyIgc3R5bGU9ImVuYWJsZS1iYWNrZ3JvdW5kOm5ldyAwIDAgNTEyIDUxMiIgeG1sOnNwYWNlPSJwcmVzZXJ2ZSIgY2xhc3M9IiI+PGc+CjxnIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+Cgk8Zz4KCQk8Zz4KCQkJPHJlY3QgeD0iMCIgeT0iMzAuNDQxIiB3aWR0aD0iMzEzLjQ2OSIgaGVpZ2h0PSIyNi4xMjIiIGZpbGw9IiMwMDAwMDAiIGRhdGEtb3JpZ2luYWw9IiMwMDAwMDAiIHN0eWxlPSIiIGNsYXNzPSIiPjwvcmVjdD4KCQkJPHBhdGggZD0iTTYuMjY5LDcyLjIzN0wxMjYuOTU1LDE5NC40OWMxLjU2NywxLjU2NywzLjY1NywzLjY1NywzLjY1Nyw1Ljc0N3YxNjYuMTM5bDUyLjI0NS0yOC4yMTJWMjAwLjIzNyAgICAgYzAtMi4wOSwyLjA5LTQuMTgsMy42NTctNS43NDdMMzA3LjIsNzIuMjM3SDYuMjY5eiIgZmlsbD0iIzAwMDAwMCIgZGF0YS1vcmlnaW5hbD0iIzAwMDAwMCIgc3R5bGU9IiIgY2xhc3M9IiI+PC9wYXRoPgoJCQk8cGF0aCBkPSJNMzc3LjczMSwyMDIuMzI3Yy0yOS4yNzgtMjYuOTg4LTc0Ljg5LTI1LjEzMS0xMDEuODc4LDQuMTQ3Yy0yNS40NDgsMjcuNjA3LTI1LjQ0OCw3MC4xMjQsMCw5Ny43MzEgICAgIGMyOS4yNzgsMjYuOTg4LDc0Ljg5LDI1LjEzMSwxMDEuODc4LTQuMTQ3QzQwMy4xNzgsMjcyLjQ1LDQwMy4xNzgsMjI5LjkzNCwzNzcuNzMxLDIwMi4zMjd6IE0zNjUuNzE0LDI4MS4yMTYgICAgIGMzLjAzLDIuNjcyLDMuMzIsNy4yOTQsMC42NDgsMTAuMzI0Yy0wLjIwMiwwLjIyOS0wLjQxOSwwLjQ0Ni0wLjY0OCwwLjY0OGMtMS41NTQsMS40NDYtMy42MjcsMi4yLTUuNzQ3LDIuMDkgICAgIGMtMS45NjIsMC4wOTEtMy44NjctMC42NzEtNS4yMjQtMi4wOWwtMjcuNjktMjcuNjlsLTI3LjY5LDI3LjY5Yy0zLjMxNSwyLjgxMy04LjE3OSwyLjgxMy0xMS40OTQsMCAgICAgYy0yLjUyOS0zLjIyLTIuNTI5LTcuNzUxLDAtMTAuOTcxbDI3LjY5LTI3LjY5bC0yNy42OS0yNy42OWMtMi41MjktMy4yMi0yLjUyOS03Ljc1MSwwLTEwLjk3MWMzLjIyNC0zLjA1Miw4LjI3LTMuMDUyLDExLjQ5NCwwICAgICBsMjcuNjksMjcuNjlsMjcuNjktMjcuNjljMi41OTctMy40NjMsNy41MDktNC4xNjQsMTAuOTcxLTEuNTY3YzMuNDYzLDIuNTk3LDQuMTY0LDcuNTA5LDEuNTY3LDEwLjk3MSAgICAgYy0wLjQ0NSwwLjU5NC0wLjk3MywxLjEyMi0xLjU2NywxLjU2N2wtMjcuNjksMjcuNjlMMzY1LjcxNCwyODEuMjE2eiIgZmlsbD0iIzAwMDAwMCIgZGF0YS1vcmlnaW5hbD0iIzAwMDAwMCIgc3R5bGU9IiIgY2xhc3M9IiI+PC9wYXRoPgoJCTwvZz4KCTwvZz4KPC9nPgo8ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciPgo8L2c+CjxnIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+CjwvZz4KPGcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj4KPC9nPgo8ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciPgo8L2c+CjxnIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+CjwvZz4KPGcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj4KPC9nPgo8ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciPgo8L2c+CjxnIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+CjwvZz4KPGcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj4KPC9nPgo8ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciPgo8L2c+CjxnIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+CjwvZz4KPGcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj4KPC9nPgo8ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciPgo8L2c+CjxnIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+CjwvZz4KPGcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj4KPC9nPgo8L2c+PC9zdmc+"/>
                        Delete Filter
                    </a>
                </div>

            </div>
        </div>
    </div>
    <div class="row m-0">
        <div class="card-body p-0 table-bodys col-left">
            <div id="table-scroll" class="table-scroll">
                <div class="table-wrap table-responsive-sm">
                    <div id="multi_action" style="display: none" class="ml-5">
                        <a data-type="{{(!empty($tab))?$tab:''}}"
                           @if($tab == 'cus' && auth()->user()->can('customer.delete'))
                           data-url="{{route("customer.multi_delete")}}"
                           href="#" class="btn btn-default delete_row_data"><i class="fas fa-trash-alt"></i></a>

                        @elseif($tab == 'com' && auth()->user()->can('commissionInvoice.delete'))
                            data-url="{{route("crm.hoahong.multi_delete")}}"
                            href="#" class="btn btn-default delete_row_data"><i class="fas fa-trash-alt"></i></a>

                        @elseif($tab == 'profit' && auth()->user()->can('profitInvoice.delete'))
                            data-url="{{route("crm.ajax.multiDeleteProfit")}}"
                            href="#" class="btn btn-default delete_row_data"><i class="fas fa-trash-alt"></i></a>

                        @elseif($tab == 'refund' && auth()->user()->can('refundInvoice.delete'))
                            data-url="{{route("crm.ajax.multiDeleteRefund")}}"
                            href="#" class="btn btn-default delete_row_data"><i class="fas fa-trash-alt"></i></a>

                        @elseif($tab == 'extend' && auth()->user()->can('extendInvoice.delete'))
                            data-url="{{route("customer.multi_delete")}}"
                            href="#" class="btn btn-default delete_row_data"><i class="fas fa-trash-alt"></i></a>

                        @endif
                        @can('customer.sendEmail')
                            <a class="send_email btn btn-default"><span><i class="fas fa-envelope"></i></span></a>
                        @endcan
                        <a href="#" class="btn btn-primary" data-toggle="modal" id="onEventPersonInCharge"  data-target="#modalAgentPersonCharge">Person in charge</a>
                        <!-- Modal persion in charge -->
                        <div class="modal fade" id="modalAgentPersonCharge" tabindex="-1" role="dialog" aria-labelledby="modalAgentPersonCharge" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <select name="persion_in_charge_update_add" id="persion_in_charge_update_add" style="width: 100%">
                                            <option value=""></option>
                                            @foreach($staffs as $item)
                                                <option value="{{$item->id}}">{{$item->admin_id}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button type="button" class="btn btn-primary" id="UpdateMultipleStaff">Save changes</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @if($tab == 'profit')
                            <a href="javascript:void(0);" data-toggle="modal" class="btn-update-all-date" data-target="#modalSelectDate">
                                Update all date
                            </a>
                        @endif
                    </div>
                    <div class="table-div table-main-customer">
                        <table id="table-all" class="">
                            @if(!empty($tab))
                                @if($tab=='cus')
                                    @include('CRM.elements.customers.col.cus',compact('tab'))
                                @elseif($tab == 'com')
                                    @include('CRM.elements.customers.col.com',compact('tab'))
                                @elseif($tab == 'profit')
                                    @include('CRM.elements.customers.col.profit')
                                @elseif($tab == 'refund')
                                    @include('CRM.elements.customers.col.refund')
                                @elseif($tab == 'extend')
                                    @include('CRM.elements.customers.col.extend')
                                @endif

                                <tbody id="tbody_invoice">
                                </tbody>
                            @endif
                        </table>
                    </div>

                </div>
            </div>
        </div>
        <div class="card-footer">
            <p class="mb-0">Total:<span id="total_data"></span></p>
        </div>
    </div>
    <div id="remind-form">

    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="modalSelectDate" tabindex="-1" role="dialog" aria-labelledby="modalSelectDate" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalSelectDate">Select date</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group row">
                    <label for="date1" class="col-sm-4 col-form-label">Date for provider</label>
                    <div class="col-sm-6">
                        <input type="text"  class="form-control" id="update_pay_provider_date" placeholder="dd/mm/YYYY">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="date2" class="col-sm-4 col-form-label">Date for agent</label>
                    <div class="col-sm-6">
                        <input type="text"  class="form-control" id="update_pay_agent_date" placeholder="dd/mm/YYYY">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="date3" class="col-sm-4 col-form-label">Date for commission</label>
                    <div class="col-sm-6">
                        <input type="text"  class="form-control" id="update_date_of_receipt" placeholder="dd/mm/YYYY">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <p style="flex: 1; color: red" id="text-danger-not-select-date" ></p>
                <button type="button" class="btn btn-primary" data-type="profit" data-url="http://oshcglobal/crm/ajax/updateAllDateProfit" id="update_all_date">Update</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
@push('scripts')
    <script>
        function getFilterTab() {
            $.get('{{route('ajax.customer.getStatusFilterCustomer',['tab'=>$tab])}}',{},function(data){
                if(data.total_row_data_status){
                    let html = '';
                    $.each(data.total_row_data_status,function(key,value){
                        html += '<a class="btn btn-falcon-info btn-sm btn_status mr-3 font-size-12px border border-radius-20px" data-value="'+value.id+'" href="#!">'+key+'<sup style="color: red">('+value.count+')</sup></a>';
                    })
                    $('#customer_filter_box').html(html);
                    $('#count_total_filter').text('('+data.total_data+')');
                }
            }).fail(function(fail) {
                console.log(fail)
            })
        }

        getFilterTab();

        var href = $('#viewInvoice>a').attr('href');
        $(document).on('click', '.export_invoice', function (e){
            var apply_id = $(this).attr('data-id');
            $('select[name="type_file"]').on('change', function () {
                console.log(apply_id);
                var newHref = href + '?template=' + $(this).val() + '&apply_id=' + apply_id;
                $('#viewInvoice>a').attr('href', newHref);
            })
        });

        $('#exportModalInvoice').on('hidden.bs.modal', function () {
            $('select[name="type_file"]').val(''); // reset option select template invoice
        });

        flatpickr('#update_pay_provider_date', {
            "dateFormat": "d/m/Y",
        });

        flatpickr('#update_pay_agent_date', {
            "dateFormat": "d/m/Y",
        });

        flatpickr('#update_date_of_receipt', {
            "dateFormat": "d/m/Y",
        });

        $(document).on('click', '#update_all_date', function (e) {
            e.preventDefault()
            var update_pay_provider_date = $('#update_pay_provider_date').val();
            var update_pay_agent_date = $('#update_pay_agent_date').val();
            var update_date_of_receipt = $('#update_date_of_receipt').val();

            if (update_pay_provider_date === '' && update_pay_agent_date === '' && update_date_of_receipt === '')
            {
                $('#text-danger-not-select-date').text('please select an date')
            }else{
                var allVals = []
                var dataType = $(this).attr('data-type')
                var _url = $(this).attr('data-url')
                $('.sub_chk:checked').each(function () {
                    allVals.push($(this).attr('data-id-profit'))
                })
                Swal.fire({
                    title: 'Are you sure?',
                    text: 'You won\'t be able to revert this!',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, update it!',
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: _url,
                            data: {
                                update_pay_provider_date,
                                update_pay_agent_date,
                                update_date_of_receipt,
                                ids: allVals,
                                _token:"{{csrf_token()}}",
                                type: dataType,
                            },
                            type: 'post',
                            success: function (data) {
                                if (data.success == 1) {
                                    Swal.fire(
                                        'success',
                                    )
                                    // $.each(data.ids, function (index, value) {
                                    //     $('#data-customer_' + value).remove()
                                    // })
                                    $('#modalSelectDate').modal('hide');

                                }
                            },
                        })
                    }
                })
            }
        })

        $('#type_service_filter').on('change', () => {
            var dataId = $('#type_service_filter').find(':selected').val();
            $.get('{{route('ajax.customer.getProvider')}}', { provider_id: dataId }, function (data) {
                let html = '<option value=""></option>'
                $.each(data, function (index, value) {
                    html += '<option value="' + value.id + '" data-value="' + value.slug + '" >' + value.name + '</option>'
                })
                $('#provider_id_filter').html(html)
            })
        })

        $('#modalCreateCustomer').on('hidden.bs.modal', function (e) {
            $.ajax({
                url: "{{route("modal.create.customer")}}",
                type: 'get',
                success: function (data) {
                    $('#modalCreateCustomer .modal-body').html(data.view);
                },
            })
        })

    </script>
@endpush
