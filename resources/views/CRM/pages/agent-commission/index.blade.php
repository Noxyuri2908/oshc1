@extends('CRM.layouts.default')
@section('title')
    COMMISSIONS MANAGEMENT
    @parent
@stop
@section('css')
    @include('CRM.partials.css')
    @include('CRM.partials.loading-css')
    @include('CRM.partials.css-table-filter')
    @include('CRM.partials.css-table-filter-agent-select2')
    <style>
        .table-agent-commission.table-div {
            max-width: 100%;
            position: relative;
            overflow: scroll;
            height: 100vh;
            max-height: 80vh;
        }
    </style>
@endsection
@section('content')
    {{--    @include('CRM.pages.agent-commission.filter_header')--}}
    <div class="card mb-3">
        <div class="card-header">
            <div class="row align-items-center">
                <div class="col">
                    <div class="d-flex justify-content-between">
                        <h5 class="fs-0 mb-0">COMMISSIONS</h5>
                        <div>
                            @can('commissionAgent.store')
                                <a href="#" class="btn btn-falcon-default btn-sm mr-2 font-weight-normal font-size-12px" id="btn_add_agent_commision"><i class="fas fa-plus"></i> Add</a>
                            @endcan
                            <a href="{{route('queue_error_log.index',['model'=>\App\Admin\Commission::class])}}" class=" mr-2 btn btn-falcon-default btn-sm font-weight-normal font-size-12px btn-show-error-log" title="Show error import"><i class="fas fa-exclamation-circle"></i>Show error import</a>
                            @can('commissionAgent.store')
                                <button type="button" class="btn btn-falcon-default btn-sm mr-2 font-weight-normal font-size-12px" data-toggle="modal" data-target="#importModal">
                                    <i class="fas fa-file-import"></i>
                                    Import
                                </button>
                            @endcan
                            <a href="#" class="delete-filter btn btn-falcon-default btn-sm mr-2 font-weight-normal font-size-12px">
                                @include('CRM.partials.img-filter')
                            </a>
                            @can('commissionAgent.store')
                                <div class="modal fade" id="importModal" tabindex="-1" role="dialog"
                                     aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <form id="modal-form-import" action="{{route('com.importExcel')}}"
                                              method="POST" enctype="multipart/form-data">
                                            @csrf
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Tải file bạn muốn nhập vào hệ
                                                        thống!</h5>
                                                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                                        <span class="font-weight-light" aria-hidden="true">×</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="form-group">
                                                        <input class="form-control-file" name="file" id="file" type="file"
                                                               required="">
                                                    </div>
                                                    <input class="form-control-file" name="tmp" value="111" type="hidden">
                                                </div>
                                                <div class="modal-footer">
                                                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Close
                                                    </button>
                                                    <button type="submit" class="btn btn-primary">Upload</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            @endcan
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body p-0">
            <div class="table-agent-commission table-div">
                <table class="">
                    <thead class="">
                        <tr class="first-row">
                            <th class="width-80">
                                <input id="master" class="ml-3" type="checkbox" aria-label="Checkbox for this table" />
                            </th>
                            <th class="width-80">Action</th>
                            <th class="width-100">Country</th>
                            <th class="width-200">Agent</th>
                            <th class="width-120">Service</th>
                            <th class="width-200">Provider</th>
                            <th class="width-80">Policy</th>
                            <th class="width-80">Commission</th>
                            <th class="width-80">Unit</th>
                            <th class="width-120">Validity start date</th>
                            <th class="width-120">Type Payment</th>
                            <th class="width-100">GST</th>
                            <th class="width-100">Status</th>
                        </tr>
                        @include('CRM.pages.agent-commission.filter')
                    </thead>
                    <tbody id="data_table_commisson_t_body">

                    </tbody>
                </table>
            </div>

        </div>
        <div class="card-footer border-top" style="padding: 0rem 1.23rem">
            <p class="mb-0 font-size-12px">Total: <span id="total-row-data" class="">0</span></p>
        </div>
    </div>
    <div id="modal_commission_agent_form"></div>
    <div class="loading-fixed-top">Loading&#8230;</div>
@endsection
@push('scripts')
    @include('CRM.partials.choose_date',['ids'=>[
    'validity_start_date'
]])
    @include('CRM.pages.agent-commission.js.get-data',[
    'nameAction'=>'commissionAgent',
    'valueNameField'=>[
        'user_id',
        'service_id',
        'provider_id',
        'comm',
        'donvi',
        'type_payment',
        'validity_start_date',
        'gst',
        'status',
        'unit',
        'policy',
        'country'
    ],
    'urlGetData'=>route('com.getData'),
    'elementIdTableData'=>'data_table_commisson_t_body',
    'elementClassSubmitForm'=>'btn_agent_commission_form',
    'elementIdEachData'=>'com_data',
    'elementIdModalForm'=>'modal_com_add',
    'elementIdCreateForm'=>'btn_add_agent_commision',
    'urlCreateForm'=>route('com.create'),
    'elementIdRenderModalForm'=>'modal_commission_agent_form',
    'elementClassEditForm'=>'edit_comm',
    'elementClassDeleteForm'=>'delete_comm',
    'table_element_class_scroll'=>'table-agent-commission'
])
    <script>
        $(document).on('change', '#user_id', function (e) {
            e.preventDefault()
            var countryAgent = $(this).find(':selected').attr('data-country')
            $('#country_service').val(countryAgent)
        })
        $(document).on('change', '#service_id', function (e) {
            var id = $(this).val()
            $.get('{{route('com.getProvider')}}', { id: id }, function (data) {
                $('#provider_id').html(data)
            })
        })
        $(document).on('mouseover', 'select#user_id', function () {

        })
    </script>
@endpush

