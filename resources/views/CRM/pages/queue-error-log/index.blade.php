@extends('CRM.layouts.default')

@section('title')
    Error log import agent
    @parent
@stop

@section('css')
    @include('CRM.partials.css-list')
    @include('CRM.partials.css-table-filter')
@endsection
@section('content')
    <div>
        <div class="card">
            <div class="card-header">
                <h5>Error log import agent</h5>
            </div>
            <div class="card-body">
                <div class="table-customer table-div">
                    <table class="">
                        <thead class="">
                            <tr class="first-row">
                                <th class="width-500">Exception</th>
                                <th class="width-200">Created_at</th>
                            </tr>
                        </thead>
                        <tbody id="customer-table-tbody">

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div id="modal_customer_form"></div>
    </div>
@endsection
@push('scripts')

    @include('CRM.partials.ajax-curd-load-more.get-data',[
    'nameAction'=>'customerManager',
    'valueNameField'=>[
        'type_of_customer_id',
        'full_name',
        'source_id',
        'agent_id',
        'english_center_id',
        'event_id',
        'identification',
        'gender',
        'date_of_birth',
        'mail',
        'phone_number',
        'social_link',
        'country_id',
        'city_name',
        'school_name',
        'study_tour',
        'departure_date',
        'destination_to_study',
        'potentiality',
        'potential_service',
        'email_status',
        'note'
    ],
    'urlGetData'=>route('queue_error_log.getData',['model'=>$model]),
    'elementIdTableData'=>'customer-table-tbody',
    'elementClassSubmitForm'=>'btn_submit_customer_form',
    'elementIdEachData'=>'customer_data',
    'elementIdModalForm'=>'modal_customer_list',
    'elementIdCreateForm'=>'btn_add_customer',
    'urlCreateForm'=>'',
    'elementIdRenderModalForm'=>'modal_customer_form',
    'elementClassEditForm'=>'edit_customer',
    'elementClassDeleteForm'=>'delete_customer',
    'table_element_class_scroll'=>'table-customer'
])
    @include('CRM.partials.choose_date',['ids'=>[
        'date_of_birth',
        'departure_date',
        'date_of_birth_filter',
        'departure_date_filter'
    ]])
    @include('CRM.partials.choose_date_onchange_call_function',[
    'idElementInputFlatpick'=>[
        'date_of_birth_filter'
],
'functionNameCall'=>'debounceAjax'
])
@endpush
