@push('css')
    <style>
        .table-main-customer thead.commission-thead .first-row th:first-child,
        .table-main-customer thead.commission-thead .last-row th:first-child {
            left: 0;
            z-index: 2;
        }
        .table-main-customer thead.commission-thead .first-row th:nth-child(2),
        .table-main-customer thead.commission-thead .last-row th:nth-child(2) {
            left: 40px;
            z-index: 3;
        }
        .table-main-customer thead.commission-thead .first-row th:nth-child(3),
        .table-main-customer thead.commission-thead .last-row th:nth-child(3) {
            left: 90px;
            z-index: 2;
        }
        .table-main-customer thead.commission-thead .first-row th:nth-child(4),
        .table-main-customer thead.commission-thead .last-row th:nth-child(4) {
            left: 190px;
            z-index: 2;
        }
        .table-main-customer thead.commission-thead .first-row th:nth-child(5),
        .table-main-customer thead.commission-thead .last-row th:nth-child(5) {
            left: 290px;
            z-index: 2;
        }
        .table-main-customer thead.commission-thead .first-row th:nth-child(6),
        .table-main-customer thead.commission-thead .last-row th:nth-child(6) {
            left: 390px;
            z-index: 2;
        }
        .table-main-customer thead.commission-thead .first-row th:nth-child(7),
        .table-main-customer thead.commission-thead .last-row th:nth-child(7) {
            left: 510px;
            z-index: 2;
        }
        .table-main-customer tbody tr.data-commission td:nth-child(1) {
            left: 0;
            z-index: 1;
            background-color: #fff;
        }
        .table-main-customer tbody tr.data-commission td:nth-child(2) {
            left: 40px;
            z-index: 1;
            background-color: #fff;
        }
        .table-main-customer tbody tr.data-commission td:nth-child(3) {
            left: 90px;
            z-index: 1;
            background-color: #fff;
        }
        .table-main-customer tbody tr.data-commission td:nth-child(4) {
            left: 190px;
            z-index: 1;
            background-color: #fff;
        }
        .table-main-customer tbody tr.data-commission td:nth-child(5){
            left: 290px;
            z-index: 1;
            background-color: #fff;
        }
        .table-main-customer tbody tr.data-commission td:nth-child(6){
            left: 390px;
            z-index: 1;
            background-color: #fff;
        }
        .table-main-customer tbody tr.data-commission td:nth-child(7){
            left: 510px;
            z-index: 1;
            background-color: #fff;
        }
        thead.commission-thead .last-row th {
            position: -webkit-sticky;
            position: sticky;
            background: #eae7e7;
            color: #fff;
        }
    </style>
    @endpush
<thead class="bg-200 text-900 thead-dark commission-thead">
<tr class="first-row">
    <th class="width-40">
        <input id="master" class="ml-3" type="checkbox" aria-label="Checkbox for this table"/>
    </th>
    <th class="width-50">Action</th>
    <th class="width-100">Invoice</th>
    <th class="width-100">Agent</th>
    <th class="width-100">Country</th>
    <th class="width-120">Name in full</th>
    <th class="width-170">Net amount</th>
    <th class="width-170">Promotion $</th>
    <th class="width-170">Bank fee $</th>
    <th class="width-170">Surcharge $</th>
    <th class="width-170">Total $</th>
    <th class="width-170">Provider</th>
    <th class="width-170">Status</th>
    <th class="width-170">Type of service</th>
    <th class="width-170">Service country</th>
    <th class="width-170">Visa status</th>
    <th class="width-170">Month</th>
    <th class="width-170">Year</th>
    <th class="width-170">Date of payment provider</th>
    <th class="width-170">Bank account</th>
    <th class="width-170">Date of payment agent</th>
    <th class="width-170">Policy No</th>
    <th class="width-170">Agent com</th>
    <th class="width-170">Issue Date</th>
    <th class="width-170">Policy status</th>
    <th class="width-170">Payment note</th>
    <th class="width-170">+/- $</th>
    <th class="width-170">+/- time</th>
    <th class="width-170">Receipt amount</th>
    <th class="width-170">Note</th>
    <th class="width-170">Created by</th>
    <th class="width-170">Created date</th>
</tr>
@include('CRM.elements.customers.filter.com')
</thead>
@push('scripts')
    @include('CRM.elements.customers.partials.js.script-loading',[
        'elementFilterIds'=>
        [
            'ref_no',
            'agent_id',
            'country_id',
            'register',
            'net_amount',
            'provider_id',
            'status',
            'type_service',
            'service_country',
            'visa_status',
            'hoahong_month',
            'hoahong_year',
            'date_payment_provider',
            'account_bank',
            'date_payment_agent',
            'policy_no',
            'issue_date',
            'policy_status',
            'payment_note_provider',
            'note',
            'staff_id',
            'created_at',
        ],
        'tab'=>$tab,
        'element_class_btn_row_edit'=>'commission_data_edit',
        'element_id_row_edit'=>'data-commission'
    ])
    @include('CRM.partials.choose_date_onchange_call_function',[
                'idElementInputFlatpick'=>[
                    'date_payment_provider_filter',
                    'date_payment_agent_filter',
                    'created_at_filter',
                    'issue_date_filter'
                    ],
                'functionNameCall'=>'debounceAjax'
            ])
@endpush
