@extends('CRM.layouts.default')

@section('title')
    Agent Contact Manager
    @parent
@stop

@section('css')
    @include('CRM.partials.css-list')
    @include('CRM.partials.css-font-size-12px')
    @include('CRM.partials.loading-css')
    @include('CRM.partials.css-table-filter-agent-select2')
    <style>
        .table-div .form-control {
            height: 28px;
        }

        .table-div {
            max-width: 100%;
            position: relative;
            overflow: scroll;
            height: 100vh;
            max-height: 80vh;
        }

        table {
            position: relative;
            border-collapse: collapse;
            white-space: nowrap;
            table-layout: fixed;
            width: 100%;
        }

        table td, table th {

        }

        td,
        th {
            padding: 0.25em;
        }

        thead .first-row th {
            position: -webkit-sticky; /* for Safari */
            position: sticky;
            top: 0;
            background: #007bff;
            color: #fff;
        }

        thead .last-row th {
            position: -webkit-sticky; /* for Safari */
            position: sticky;
            background: #eae7e7;
            color: #fff;
        }

        .top-80 {
            top: 25px;
        }

        .last-row th {
            top: 25px;
        }

        thead .first-row th:first-child, thead .last-row th:first-child {
            /* left: 0; */
            z-index: 1;
        }

        /* tbody th {
            position: -webkit-sticky;
            position: sticky;
            left: 0;
            background: #FFF;
            border-right: 1px solid #CCC;
        } */
        tbody th, tbody td {
            border-bottom: 1px solid #ccc;
        }

        .width-80 {
            width: 80px;
        }

        .width-220 {
            width: 220px;
        }

        .width-170 {
            width: 170px;
        }

        .width-200 {
            width: 200px;
        }

        .width-500 {
            width: 500px;
        }

        .width-300 {
            width: 300px;
        }

        .width-100 {
            width: 100px;
        }

        .white-space-break-spaces {
            text-overflow: ellipsis;
            overflow: hidden;
        }

        .bg-pale-gray {
            background-color: #eae7e7
        }

        .table-div select {
            padding: 0 20px;
        }

        #sale_task .card-body {
            padding: 0.5%;
        }

        #sale_task h5 {
            font-family: 'roboto', sans-serif !important;
            font-weight: 600;
        }

    </style>
@endsection
@section('content')
    <div>
        <div class="card">
            <div class="card-header">
                <h5>Agent Contact Manager</h5>
                <div class="d-flex justify-content-end">
{{--                    @can('customerManager.store')--}}
                        <a href="#" class="btn btn-falcon-default btn-sm mr-2 font-weight-normal font-size-12px" id="btn_add_agent_contact"><i class="fas fa-plus"></i> Add</a>
{{--                    @endcan--}}
                    <a href="{{route('queue_error_log.index',['model'=>\App\Admin\Person::class])}}" class=" mr-2 btn btn-falcon-default btn-sm font-weight-normal font-size-12px btn-show-error-log" title="Show error import"><i class="fas fa-exclamation-circle"></i>Show error import</a>
                    <a href="javascript:void(0)" class=" mr-2 btn btn-falcon-default btn-sm font-weight-normal font-size-12px"  id="exportExcel" title="Export"><i class="fas fa-file-export"></i>Export</a>
                    <button type="button" class="btn btn-falcon-default btn-sm mr-2 font-weight-normal font-size-12px" data-toggle="modal" data-target="#importModal">
                        <i class="fas fa-file-import"></i>
                        Import
                    </button>
                    <a href="#" class="delete-filter btn btn-falcon-default btn-sm mr-2 font-weight-normal font-size-12px">
                        @include('CRM.partials.img-filter')
                    </a>
                    <div class="modal fade" id="importModal" tabindex="-1" role="dialog"
                         aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <form id="modal-form-import" action="{{route('agent.contact.importExcel')}}"
                                  method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Tải file bạn muốn nhập vào hệ
                                            thống!</h5>
                                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                            <span class="font-weight-light" aria-hidden="true">×</span></button>
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
                </div>
            </div>
            <div class="card-body">
                <div class="table-agent-contact table-div">
                    <table class="">
                        <thead class="">
                        <tr class="first-row">
                            <th class="width-80">Action</th>
                            <th class="width-200">Branch</th>
                            <th class="width-200">Agent Name</th>
                            <th class="width-200">Country</th>
                            <th class="width-200">Status</th>
                            <th class="width-200">Type of agent</th>
                            <th class="width-200">Name</th>
                            <th class="width-200">Position</th>
                            <th class="width-200">PC</th>
                            <th class="width-200">Phone</th>
                            <th class="width-100">Birthday</th>
                            <th class="width-200">Email</th>
                            <th class="width-100">Skype</th>
                            <th class="width-200">Facebook</th>
                            <th class="width-300">Note</th>
                            <th class="width-100">Receive commission</th>
                            <th class="width-200">Acc Name</th>
                            <th class="width-200">Bank</th>
                            <th class="width-200">Bank account</th>
                            <th class="width-200">Currency</th>
                            <th class="width-200">Bank address</th>
                            <th class="width-200">Swift code</th>
                        </tr>
                        @include('CRM.pages.agent-contact.filter')
                        </thead>
                        <tbody id="agent-contact-table-tbody">

                        </tbody>
                    </table>

                </div>
            </div>
            <div class="card-footer border-top" style="padding: 0rem 1.23rem">
                <p class="mb-0 font-size-12px">Total: <span id="total-row-data" class="">0</span></p>
            </div>
        </div>
        <div id="modal_agent_contact_form"></div>
        <div class="loading-fixed-top">Loading&#8230;</div>
    </div>
@endsection
@push('scripts')

    @include('CRM.partials.choose_date',['ids'=>[
        'date_of_birth',
        'departure_date',
        'date_of_birth_filter',
        'departure_date_filter'
    ]])
    @include('CRM.partials.ajax-curd-load-more.get-data',[
    'nameAction'=>'agentContact',
    'valueNameField'=>$fieldContactAgent,
    'urlGetData'=>route('agent.contact.getData'),
    'elementIdTableData'=>'agent-contact-table-tbody',
    'elementClassSubmitForm'=>'btn_submit_agent_contact_form',
    'elementIdEachData'=>'agent_contact_data',
    'elementIdModalForm'=>'modal_agent_contact_list',
    'elementIdCreateForm'=>'btn_add_agent_contact',
    'urlCreateForm'=>route('agent.contact.create'),
    'elementIdRenderModalForm'=>'modal_agent_contact_form',
    'elementClassEditForm'=>'edit_agent_contact',
    'elementClassDeleteForm'=>'delete_agent_contact',
    'table_element_class_scroll'=>'table-agent-contact'
])
    <script>
        $(document).on('change','#is_receive_comm',function(e){
            e.preventDefault();
            if(this.checked == true){
                $('.info_bank').css('display','block');
            }else if(this.checked == false){
                $('.info_bank').css('display','none');
            }
        })

        $('#exportExcel').on('click', function (){
            var query = {
                department : $('#department_filter').val(),
                staff_id : $('#staff_id_filter').val(),
                user_id : $('#user_id_filter').val(),
                name : $('#name_filter').val(),
                position : $('#position_filter').val(),
                phone : $('#phone_filter').val(),
                birthday : $('#birthday_filter').val(),
                email : $('#email_filter').val(),
                skype : $('#skype_filter').val(),
                facebook : $('#facebook_filter').val(),
                note : $('#note_filter').val(),
                acc_name : $('#acc_name_filter').val(),
                bank : $('#bank_filter').val(),
                currency : $('#currency_filter').val(),
                bank_address : $('#bank_address_filter').val(),
                receiver_address : $('#receiver_address_filter').val(),
                swift_code : $('#swift_code_filter').val(),
                country : $('#country_filter').val(),
                status : $('#status_filter').val(),
                type_id : $('#type_id_filter').val(),
            }

            var url = "{{route('agent.contact.exportExcel')}}?" + $.param(query)

            window.location = url;
        })

    </script>
    @include('CRM.partials.fancybox-class-popup',[
'classElements'=>[
'btn-show-error-log'
]
])
@endpush
