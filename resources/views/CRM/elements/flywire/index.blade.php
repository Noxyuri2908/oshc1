<div class="container-fluid " id="flywire-crm">
    @include('CRM.elements.flywire.search')
    <div class="card mb-3">
        <div class="card-header d-flex justify-content-end">

            {{-- import com status --}}
            <a href="#" class="ml-2 import-com-status btn btn-falcon-default font-weight-normal font-size-12px" data-toggle="modal" data-target="#import-com-status">
                <i class="fas fa-file-export"></i> Import com status
            </a>
            <div class="modal fade" id="import-com-status" tabindex="-1" role="dialog"
                 aria-labelledby="exampleModalLabel" style="display: none;" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <form id="modal-form-import"
                          action="{{route('flywire.importComStatus')}}"
                          method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Tải file bạn muốn
                                    nhập vào hệ
                                    thống!</h5>
                                <button class="close" type="button" data-dismiss="modal"
                                        aria-label="Close">
                                    <span class="font-weight-light" aria-hidden="true">×</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="form-group">
                                    <input class="form-control-file" name="fileImportCom" id="fileImportCom"
                                           type="file" required="" accept=".xlsx,.csv,.xls">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button class="btn btn-secondary" type="button"
                                        data-dismiss="modal">Close
                                </button>
                                <button type="submit" class="btn btn-primary">Upload</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            {{-- import promotion code --}}
            <a href="#" class="ml-2 import-p-code btn btn-falcon-default font-weight-normal font-size-12px" data-toggle="modal" data-target="#import-p-code">
                <i class="fas fa-file-export"></i> Import promotion code
            </a>
            <div class="modal fade" id="import-p-code" tabindex="-1" role="dialog"
                 aria-labelledby="exampleModalLabel" style="display: none;" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <form id="modal-form-import"
                          action="{{route('flywire.importPromotionCode')}}"
                          method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Tải file bạn muốn
                                    nhập vào hệ
                                    thống!</h5>
                                <button class="close" type="button" data-dismiss="modal"
                                        aria-label="Close">
                                    <span class="font-weight-light" aria-hidden="true">×</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="form-group">
                                    <input class="form-control-file" name="fileImportPromotionCode" id="fileImportPromotionCode"
                                           type="file" required="" accept=".xlsx,.csv,.xls">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button class="btn btn-secondary" type="button"
                                        data-dismiss="modal">Close
                                </button>
                                <button type="submit" class="btn btn-primary">Upload</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            {{-- import agent --}}
            <a href="#" class="ml-2 import-agent btn btn-falcon-default font-weight-normal font-size-12px" data-toggle="modal" data-target="#importAgent">
                <i class="fas fa-file-export"></i> Import agent
            </a>
            <div class="modal fade" id="importAgent" tabindex="-1" role="dialog"
                 aria-labelledby="exampleModalLabel" style="display: none;" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <form id="modal-form-import"
                          action="{{route('flywire.importAgent')}}"
                          method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Tải file bạn muốn
                                    nhập vào hệ
                                    thống!</h5>
                                <button class="close" type="button" data-dismiss="modal"
                                        aria-label="Close">
                                    <span class="font-weight-light" aria-hidden="true">×</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="form-group">
                                    <input class="form-control-file" name="importAgent" id="importAgent"
                                           type="file" required="" accept=".xlsx,.csv,.xls">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button class="btn btn-secondary" type="button"
                                        data-dismiss="modal">Close
                                </button>
                                <button type="submit" class="btn btn-primary">Upload</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>


            <a href="#" class="delete-filter btn btn-falcon-default font-weight-normal font-size-12px">
                <img style="width: 15px" src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHZlcnNpb249IjEuMSIgeG1sbnM6eGxpbms9Imh0dHA6Ly93d3cudzMub3JnLzE5OTkveGxpbmsiIHhtbG5zOnN2Z2pzPSJodHRwOi8vc3ZnanMuY29tL3N2Z2pzIiB3aWR0aD0iNTEyIiBoZWlnaHQ9IjUxMiIgeD0iMCIgeT0iMCIgdmlld0JveD0iMCAwIDM5Ni44MTcgMzk2LjgxNyIgc3R5bGU9ImVuYWJsZS1iYWNrZ3JvdW5kOm5ldyAwIDAgNTEyIDUxMiIgeG1sOnNwYWNlPSJwcmVzZXJ2ZSIgY2xhc3M9IiI+PGc+CjxnIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+Cgk8Zz4KCQk8Zz4KCQkJPHJlY3QgeD0iMCIgeT0iMzAuNDQxIiB3aWR0aD0iMzEzLjQ2OSIgaGVpZ2h0PSIyNi4xMjIiIGZpbGw9IiMwMDAwMDAiIGRhdGEtb3JpZ2luYWw9IiMwMDAwMDAiIHN0eWxlPSIiIGNsYXNzPSIiPjwvcmVjdD4KCQkJPHBhdGggZD0iTTYuMjY5LDcyLjIzN0wxMjYuOTU1LDE5NC40OWMxLjU2NywxLjU2NywzLjY1NywzLjY1NywzLjY1Nyw1Ljc0N3YxNjYuMTM5bDUyLjI0NS0yOC4yMTJWMjAwLjIzNyAgICAgYzAtMi4wOSwyLjA5LTQuMTgsMy42NTctNS43NDdMMzA3LjIsNzIuMjM3SDYuMjY5eiIgZmlsbD0iIzAwMDAwMCIgZGF0YS1vcmlnaW5hbD0iIzAwMDAwMCIgc3R5bGU9IiIgY2xhc3M9IiI+PC9wYXRoPgoJCQk8cGF0aCBkPSJNMzc3LjczMSwyMDIuMzI3Yy0yOS4yNzgtMjYuOTg4LTc0Ljg5LTI1LjEzMS0xMDEuODc4LDQuMTQ3Yy0yNS40NDgsMjcuNjA3LTI1LjQ0OCw3MC4xMjQsMCw5Ny43MzEgICAgIGMyOS4yNzgsMjYuOTg4LDc0Ljg5LDI1LjEzMSwxMDEuODc4LTQuMTQ3QzQwMy4xNzgsMjcyLjQ1LDQwMy4xNzgsMjI5LjkzNCwzNzcuNzMxLDIwMi4zMjd6IE0zNjUuNzE0LDI4MS4yMTYgICAgIGMzLjAzLDIuNjcyLDMuMzIsNy4yOTQsMC42NDgsMTAuMzI0Yy0wLjIwMiwwLjIyOS0wLjQxOSwwLjQ0Ni0wLjY0OCwwLjY0OGMtMS41NTQsMS40NDYtMy42MjcsMi4yLTUuNzQ3LDIuMDkgICAgIGMtMS45NjIsMC4wOTEtMy44NjctMC42NzEtNS4yMjQtMi4wOWwtMjcuNjktMjcuNjlsLTI3LjY5LDI3LjY5Yy0zLjMxNSwyLjgxMy04LjE3OSwyLjgxMy0xMS40OTQsMCAgICAgYy0yLjUyOS0zLjIyLTIuNTI5LTcuNzUxLDAtMTAuOTcxbDI3LjY5LTI3LjY5bC0yNy42OS0yNy42OWMtMi41MjktMy4yMi0yLjUyOS03Ljc1MSwwLTEwLjk3MWMzLjIyNC0zLjA1Miw4LjI3LTMuMDUyLDExLjQ5NCwwICAgICBsMjcuNjksMjcuNjlsMjcuNjktMjcuNjljMi41OTctMy40NjMsNy41MDktNC4xNjQsMTAuOTcxLTEuNTY3YzMuNDYzLDIuNTk3LDQuMTY0LDcuNTA5LDEuNTY3LDEwLjk3MSAgICAgYy0wLjQ0NSwwLjU5NC0wLjk3MywxLjEyMi0xLjU2NywxLjU2N2wtMjcuNjksMjcuNjlMMzY1LjcxNCwyODEuMjE2eiIgZmlsbD0iIzAwMDAwMCIgZGF0YS1vcmlnaW5hbD0iIzAwMDAwMCIgc3R5bGU9IiIgY2xhc3M9IiI+PC9wYXRoPgoJCTwvZz4KCTwvZz4KPC9nPgo8ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciPgo8L2c+CjxnIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+CjwvZz4KPGcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj4KPC9nPgo8ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciPgo8L2c+CjxnIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+CjwvZz4KPGcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj4KPC9nPgo8ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciPgo8L2c+CjxnIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+CjwvZz4KPGcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj4KPC9nPgo8ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciPgo8L2c+CjxnIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+CjwvZz4KPGcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj4KPC9nPgo8ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciPgo8L2c+CjxnIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+CjwvZz4KPGcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj4KPC9nPgo8L2c+PC9zdmc+" /> Delete Filter
            </a>
            {{--import flywire by payment id--}}
            <a class="ml-2 btn btn-falcon-default btn_import font-weight-normal font-size-12px" href="{{route('flywire.importFlywirebyPaymentId')}}" data-toggle="modal" data-target="#importFlywirebyPaymentId" title="Import"><i class="fas fa-file-export"></i>Import Flywire by Payment Id</a>
            <a class="ml-2 btn btn-falcon-default btn_import font-weight-normal font-size-12px" href="javascript:void(0);" id="exportFlywire" title="Export"><i class="fas fa-file-export"></i>Export</a>

            <div class="modal fade" id="importFlywirebyPaymentId" tabindex="-1" role="dialog"
                 aria-labelledby="exampleModalLabel" style="display: none;" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <form id="modal-form-import"
                          action="{{route('flywire.importFlywirebyPaymentId')}}"
                          method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Tải file bạn muốn
                                    nhập vào hệ
                                    thống!</h5>
                                <button class="close" type="button" data-dismiss="modal"
                                        aria-label="Close">
                                    <span class="font-weight-light" aria-hidden="true">×</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="form-group">
                                    <input class="form-control-file" name="file" id="file"
                                           type="file" required="" accept=".xlsx,.csv,.xls">
                                </div>
                                <input class="form-control-file" name="tmp" value="111"
                                       type="hidden">
                            </div>
                            <div class="modal-footer">
                                <button class="btn btn-secondary" type="button"
                                        data-dismiss="modal">Close
                                </button>
                                <button type="submit" class="btn btn-primary">Upload</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            {{--end model import--}}
            <a class="ml-2 btn btn-falcon-default btn_import font-weight-normal font-size-12px" data-toggle="modal" data-target="#importModal" title="Import"><i class="fas fa-file-import"></i>Import</a>
            <div class="modal fade" id="importModal" tabindex="-1" role="dialog"
                 aria-labelledby="exampleModalLabel" style="display: none;" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <form id="modal-form-import" action="{{route('ajax.flywire.storeFlywireByPaymentId')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Nhập danh sách Payment Id</h5>
                                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                    <span class="font-weight-light" aria-hidden="true">×</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="form-group">
                                    <textarea name="payment_ids" id="" class="form-control" cols="30" rows="10"></textarea>
                                </div>

                            </div>
                            <div class="modal-footer">
                                <button class="btn btn-secondary" type="button"
                                        data-dismiss="modal">Close
                                </button>
                                <button type="submit" class="btn btn-primary">Import</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div id="multi_action" style="display: none" class="ml-5">
                <a data-type="{{(!empty($tab))?$tab:''}}" data-url="{{route("customer.multi_delete")}}" href="#"
                   class="btn btn-default delete_row_data"><i class="fas fa-trash-alt"></i></a>
                {{-- <a class="send_email btn btn-default"><span><i class="fas fa-envelope"></i></span></a> --}}
            </div>
            <div class="table-div table-main-customer">
                <table>
                    <thead class="customer-thead">
                        <tr class="first-row">
                            <th class="width-50">
                                <input id="master" class="ml-3" type="checkbox" aria-label="Checkbox for this table" />
                            </th>
                            <th class="width-80">Action</th>
                            <th class="width-170">Payment ID</th>
                            <th class="width-170">Agent</th>
                            <th class="width-170">Full name</th>
                            <th class="width-170">Email</th>
                            <th class="width-100">Status</th>
                            <th class="width-100">Gender</th>
                            <th class="width-130">Phone No</th>
                            <th class="width-100">DOB</th>
                            <th class="width-300">School</th>
                            <th class="width-170">Nationality</th>
                            <th class="width-170">Agent email</th>
                            <th class="width-170">Staff</th>
                            <th class="width-100">Payment will come from</th>
                            <th class="width-130">Amount from</th>
                            <th class="width-80">Unit</th>
                            <th class="width-130">Amount to</th>
                            <th class="width-80">Unit</th>
                            <th class="width-100">Payment type</th>
                            <th class="width-170">Initiated date</th>
                            <th class="width-170">Delivered date</th>
                            @can('flywire.columnComAnnalink')
                                <th class="width-170">Com Annalink%</th>
                            @endcan
                            @can('flywire.columnComFromProvider')
                                <th class="width-170">Com from provider ($)</th>
                            @endcan
                            @can('flywire.columnUnitComFromProvider')
                                <th class="width-80">Unit</th>
                            @endcan
                            @can('flywire.columnExchangeInAudProvider')
                                <th class="width-170">Exchange in AUD</th>
                            @endcan
                            @can('flywire.columnComInAudProvider')
                                <th class="width-170">Com in AUD</th>
                            @endcan
                            @can('flywire.columnProviderPaidDate')
                                <th class="width-170">Provider paid date</th>
                            @endcan
                            <th class="width-170">Com agent %</th>
                            <th class="width-170">Com for agent AUD</th>
                            <th class="width-170">Exchange rate (AUD/VND)</th>
                            <th class="width-170">Com for agent VND</th>
                            <th class="width-170">Paid com date (agent)</th>
                            <th class="width-170">Com status</th>
                            @can('flywire.columnProfitAud')
                                <th class="width-170">Profit AUD</th>
                            @endcan
                            @can('flywire.columnProfitVnd')
                                <th class="width-170">Profit (VND)</th>
                            @endcan
                            <th class="width-170">Note</th>
                            <th class="width-170">Creation date</th>
                            <th class="width-170">Invoice Code OSHC</th>
                            <th class="width-170">Promotion Code</th>
                        </tr>
                        @include('CRM.elements.flywire.filter')
                    </thead>
                    <tbody id="tbody_invoice">

                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer">
            <p>Total: <span id="total-row"></span></p>
            <p>Com for agent VND: <span id="totalCom-row"></span></p>
        </div>
    </div>
    <div class="card mb-3">
        <div class="fancy-tab">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item"><a
                        class="nav-link active"
                        data-toggle="tab" href="#tab-docs" role="tab"
                        aria-controls="tab-docs" aria-selected="false">Docs</a></li>
            </ul>
            <div class="tab-content border-x border-bottom p-3" id="myTabContent">
                <div
                    class="tab-pane fade show active"
                    id="tab-docs" role="tabpanel" aria-labelledby="docs-tab">
                    <div class="alert-modal-receipt"></div>
                    <div class="form-submit clearfix tab-form-1">
                        <div class="bottom-submit">
                            @can('customerDoc.store')
                                <button class="btn btn-falcon-default btn-sm mr-1 mb-1" type="button" data-type=2
                                        id="btn_add_doc">
                                    <span class="fas fa-plus mr-1" data-fa-transform="shrink-3"></span> Add
                                </button>
                            @endcan
                        </div>
                    </div>
                    <div class="table-responsive" id="div_table_doc_receipt">
                        @include('CRM.elements.customer-process.table-doc')
                    </div>
                    <div id="div_modal_doc">

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@push('scripts')
    @include('CRM.elements.customers.partials.js.get-form-create-tai-lieu')
    <script>
        $(document).on('click', '.data-customer', function () {
            if ($(this).attr('is-render') == 'false') {
                $('.data-customer th').css('background-color', '')

                $('.data-customer').removeClass('selected_row')

                $('.data-customer').attr('is-render', false)
                $(this).attr('is-render', true)
                $(this).children('th').css('background-color', '#ccc')
                $(this).addClass('selected_row')
                $('.alert-modal-receipt').html('')
                var apply_id = $(this).attr('data-id')
                $('.remind-extend-invoice').attr('data-id', apply_id)
                $('.remind-invoice').attr('data-id', apply_id)
                $('.remind-email-invoice').attr('data-id', apply_id)
                getFormCreateTailieu(apply_id)
                $.ajax({
                    url: '{{route('ajax.flywire.showDocsAndRemindForm')}}',
                    data: {
                        apply_id: apply_id,
                    },
                    type: 'get',
                    success: function (data) {
                        $('#div_table_doc_receipt').html(data.view)
                        $('#remind-form').html(data.remind_form)
                        $('.save-remind-form').attr('data-id', apply_id)
                        $('.remind-extend-invoice').attr('href', data.urlExtend)
                        $('#btn_add_doc').attr('data-id', apply_id)
                    },
                    beforeSend: function () {
                        $('#div_table_doc_receipt').text('loading..')
                    },
                })
            }
        })

        $(document).delegate('#btn_add_doc', 'click', function () {
            _id = $(this).attr('data-id')
            _html = ''
            if (_id > 0) {
                _url = '{{route('ajax.getFormCreateTailieu')}}'
                $.get(_url, { id: _id, type: 'flywire_docs' }, function (data) {
                    $('#div_modal_doc').html(data)
                    $('#tailieuModal').modal('toggle')
                    $('#form-docs-action').val('customer_docs_receipt_create')
                })
            } else {
                _html += '<div class="alert alert-danger">Please select customer to create receipt</div>'
                $('.alert-modal-receipt').html(_html)
            }
        })

        function storeDocs(formdata) {
            $.ajax({
                url: '{{route('apply.tailieu.store')}}',
                data: formdata,
                type: 'post',
                dataType: 'html',
                processData: false,
                contentType: false,
                success: function (data) {
                    $('#div_table_doc_receipt').html(data)
                    Swal.fire({
                        position: 'center',
                        icon: 'success',
                        title: 'Success',
                        showConfirmButton: false,
                        timer: 1500,
                    })
                    $('#tailieuModal').modal('hide')
                },
            })
        }

        $(document).on('click', '.edit_doc', function (e) {
            e.preventDefault()
            _id = $('#_id').val()
            _url = '{{route('ajax.getFormEditTailieu')}}'
            _tailieu_id = $(this).attr('data-id')
            $.get(_url, { id: _id, type: 'customer_docs', tailieu_id: _tailieu_id }, function (data) {
                $('#div_modal_doc').html(data)
                $('#tailieuModal').modal('toggle')
                $('#form-docs-action').val('customer_docs_receipt_update')
            })
        })

        function updateDocs(formdata) {
            var url = '{{route('apply.tailieu.update',":id")}}'
            var _tailieu_id = formdata.get('tailieu_id')
            url = url.replace(':id', _tailieu_id)
            $.ajax({
                url: url,
                data: formdata,
                type: 'post',
                dataType: 'html',
                processData: false,
                contentType: false,
                success: function (data) {
                    $('#div_table_doc_receipt').html(data)
                    Swal.fire({
                        position: 'center',
                        icon: 'success',
                        title: 'Success',
                        showConfirmButton: false,
                        timer: 1500,
                    })
                    $('#tailieuModal').modal('hide')
                },
            })
        }

        $(document).on('submit', '#form-scan-modal', function (e) {
            e.preventDefault()
            var formdata = new FormData($(this)[0])
            console.log(formdata.get('action'), formdata.get('apply_id'))
            if (formdata.get('action') == 'customer_docs_receipt_create') {
                storeDocs(formdata)
            } else if (formdata.get('action') == 'customer_docs_receipt_update') {
                updateDocs(formdata)
            }
        })
        $(document).on('click', '.delete_doc', function (e) {
            e.preventDefault()
            let _url = '{{route('apply.tailieu.destroy')}}'
            let _id = $(this).data('id')
            Swal.fire({
                title: 'Are you sure?',
                text: 'You won\'t be able to revert this!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!',
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        url: _url,
                        type: 'post',
                        dataType: 'html',
                        data: {
                            data_del: _id,
                            _token: '{{csrf_token()}}',
                            action: 'customer_docs_receipt_delete',
                            type: 'flywire',
                        },
                        success: function (data) {
                            $('#div_table_doc_receipt').html(data)
                        },
                    })
                    Swal.fire(
                        'Deleted!',
                        'Your file has been deleted.',
                        'success',
                    )
                }
            })

        })

        $(document).on('shown.bs.dropdown', '.table-responsive-sm', function (e) {
            var $table = $(this),
                $menu = $(e.target).find('.dropdown-menu'),
                tableOffsetHeight = $table.offset().top + $table.height(),
                menuOffsetHeight = $menu.offset().top + $menu.outerHeight(true)

            if (menuOffsetHeight > tableOffsetHeight) {
                $('#table-flywire').css('padding-bottom', menuOffsetHeight - tableOffsetHeight)
            }
        })

        $(document).on('hide.bs.dropdown', '.table-responsive-sm', function () {
            $('#table-flywire').css('padding-bottom', 0)
        })

        $('#exportFlywire').on('click', function (){
            var query = {
                ref_no_filter : $('#ref_no_filter').val(),
                invoice_code_filter : $('#invoice_code_filter').val(),
                agent_id_filter : $('#agent_id_filter').val(),
                full_name_filter : $('#full_name_filter').val(),
                email_filter : $('#email_filter').val(),
                status_filter : $('#status_filter').val(),
                gender_filter : $('#gender_filter').val(),
                phone_filter : $('#phone_filter').val(),
                birth_of_date_filter : $('#birth_of_date_filter').val(),
                school_id_filter : $('#school_id_filter').val(),
                std_id_filter : $('#std_id_filter').val(),
                country_filter : $('#country_filter').val(),
                amount_from_filter : $('#amount_from_filter').val(),
                amount_from_unit_filter : $('#amount_from_unit_filter').val(),
                payment_come_from_filter : $('#payment_come_from_filter').val(),
                amount_to_filter : $('#amount_to_filter').val(),
                amount_to_unit_filter : $('#amount_to_unit_filter').val(),
                payment_type_filter : $('#payment_type_filter').val(),
                initiated_date_filter : $('#initiated_date_filter').val(),
                staff_id_filter : $('#staff_id_filter').val(),
                note_filter : $('#note_filter').val(),
                agent_email_filter : $('#agent_email_filter').val(),
                paid_com_date_agent_cp_filter : $('#paid_com_date_agent_cp_filter').val(),
                created_at_filter : $('#created_at_filter').val(),
                provider_paid_date_cp_filter : $('#provider_paid_date_cp_filter').val(),
                _department : $('#f_department').val(),
                _period : $('#f_period').val(),
                _time : $('#f_time').val(),
                f_time_end : $('#f_time_end').val(),
                f_time_start : $('#f_time_start').val(),
                _country : $('#f_country').val(),
                _type : $('#f_type').val(),
                _status : $('#f_status').val()
            }
            var url = "{{route('flywire.exportFlywire')}}?" + $.param(query)

            window.location = url;

        })

    </script>
    @include('CRM.partials.choose_date',[
    'ids'=>[
        'birth_of_date_filter',
        'initiated_date_filter',
        'paid_com_date_agent_cp_filter',
        'created_at_filter',
        'provider_paid_date_cp_filter',
        'delivered_start_date_filter',
        'delivered_end_date_filter'
]
])
    @include('CRM.elements.flywire.partials.js.script-loading',[
     'elementFilterIds'=>
        [
            'delivered_start_date',
            'delivered_end_date',
            'ref_no',
            'invoice_code',
            'agent_id',
            'full_name',
            'email',
            'status',
            'gender',
            'phone',
            'birth_of_date',
            'school_id',
            'std_id',
            'country',
            'amount_from',
            'amount_from_unit',
            'payment_come_from',
            'amount_to',
            'amount_to_unit',
            'payment_type',
            'initiated_date',
            'staff_id',
            'note',
            'agent_email',
            'paid_com_date_agent_cp',
            'created_at',
            'provider_paid_date_cp',
            'comstatus'
        ],
        'popup_form_element_class'=>[
            'customer_data_edit',
            'customer_data_profit'
        ],
        'element_id_row_edit'=>'data-customer'
])
@endpush
