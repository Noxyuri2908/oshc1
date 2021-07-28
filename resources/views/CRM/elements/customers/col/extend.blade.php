@push('css')
    <style>
        .first-row-head th {
            position: sticky;
            left: 0;
        }

        .table-main-customer thead.extend-thead .first-row {
            top: 0px;
        }

        .table-main-customer thead.extend-thead .last-row {
            top: 25px;
        }

        .table-main-customer thead.extend-thead .first-row th:first-child,
        .table-main-customer thead.extend-thead .last-row th:first-child {
            left: 0;
            z-index: 2;
        }

        .table-main-customer thead.extend-thead .first-row th:nth-child(2),
        .table-main-customer thead.extend-thead .last-row th:nth-child(2) {
            left: 40px;
            z-index: 3;
        }

        .table-main-customer thead.extend-thead .first-row th:nth-child(3),
        .table-main-customer thead.extend-thead .last-row th:nth-child(3) {
            left: 90px;
            z-index: 2;
        }

        .table-main-customer thead.extend-thead .first-row th:nth-child(4),
        .table-main-customer thead.extend-thead .last-row th:nth-child(4) {
            left: 190px;
            z-index: 2;
        }

        .table-main-customer thead.extend-thead .first-row th:nth-child(5),
        .table-main-customer thead.extend-thead .last-row th:nth-child(5) {
            left: 290px;
            z-index: 2;
        }

        .table-main-customer thead.extend-thead .first-row th:nth-child(6),
        .table-main-customer thead.extend-thead .last-row th:nth-child(6) {
            left: 390px;
            z-index: 2;
        }

        .table-main-customer thead.extend-thead .first-row th:nth-child(7),
        .table-main-customer thead.extend-thead .last-row th:nth-child(7) {
            left: 510px;
            z-index: 2;
        }

        .table-main-customer tbody tr.data-customer td:nth-child(1) {
            left: 0;
            z-index: 1;
            background-color: #fff;
            position: sticky;
        }

        .table-main-customer tbody tr.data-customer td:nth-child(2) {
            left: 40px;
            z-index: 1;
            background-color: #fff;
            position: sticky;
        }

        .table-main-customer tbody tr.data-customer td:nth-child(3) {
            left: 90px;
            z-index: 1;
            background-color: #fff;
            position: sticky;
        }

        .table-main-customer tbody tr.data-customer td:nth-child(4) {
            left: 190px;
            z-index: 1;
            background-color: #fff;
            position: sticky;
        }

        .table-main-customer tbody tr.data-customer td:nth-child(5) {
            left: 290px;
            z-index: 1;
            background-color: #fff;
            position: sticky;
        }

        .table-main-customer tbody tr.data-customer td:nth-child(6) {
            left: 390px;
            z-index: 1;
            background-color: #fff;
            position: sticky;
        }

        .table-main-customer tbody tr.data-customer td:nth-child(7) {
            left: 510px;
            z-index: 1;
            background-color: #fff;
            position: sticky;
        }

        thead.extend-thead .last-row th {
            position: -webkit-sticky;
            position: sticky;
            background: #eae7e7;
            color: #fff;
        }
    </style>
@endpush
<col class="width-40"/>
<col class="width-50"/>
<col class="width-100"/>
<col class="width-100"/>
<col class="width-100"/>
<col class="width-120"/>
<col class="width-120"/>
<col class="width-170"/>
<col class="width-170"/>
<col class="width-170"/>
<col class="width-170"/>
<col class="width-170"/>
<col class="width-170"/>
<col class="width-170"/>
<col class="width-170"/>
<col class="width-170"/>
<col class="width-120"/>
<col class="width-170"/>
<col class="width-170"/>
<col class="width-170"/>
<col class="width-170"/>
<col class="width-170"/>
<col class="width-170"/>
<col class="width-170"/>
<col class="width-170"/>
<col class="width-170"/>
<col class="width-120"/>
<col class="width-170"/>
<col class="width-170"/>
<col class="width-170"/>
<col class="width-170"/>
<col class="width-170"/>
<col class="width-170"/>
<col class="width-170"/>
<col class="width-170"/>
<col class="width-300"/>

<thead class="bg-200 text-900 thead-dark extend-thead">
<tr class="first-row">
    <th>
        <input id="master" class="ml-3" type="checkbox" aria-label="Checkbox for this table"/>
    </th>
    <th>Action</th>
    <th>Ref No</th>
    <th>Creation date</th>
    <th>Agent</th>
    <th>Agent country</th>
    <th>Register</th>
    <th>Status</th>
    <th>Master agent</th>
    <th>Service country</th>
    <th>Type of service</th>
    <th>Type of invoice</th>
    <th>Provider</th>
    <th>Policy</th>
    <th>No of adults</th>
    <th>No of children</th>
    <th>Type of visa</th>
    <th>Start date</th>
    <th>End date</th>
    <th>Times left (days)</th>
    <th>Remind status</th>
    <th>Adults</th>
    <th>Children</th>
    <th>Net amount ($)</th>
    <th>Promotion code</th>
    <th>Promotion ($)</th>
    <th>Bank fee (%)</th>
    <th>Bank fee ($)</th>
    <th>Payment method</th>
    <th>Surcharge ($)</th>
    <th>-/+ ($)</th>
    <th>Commission ($)</th>
    <th>Total ($)</th>
    <th>Staff</th>
    <th>Note</th>
    <th>My current or future location in Australia</th>

</tr>
@include('CRM.elements.customers.filter.extend')
</thead>
@push('scripts')
    @include('CRM.elements.customers.partials.js.script-loading',[
        'elementFilterIds'=>
        [
            'ref_no',
'created_at',
'agent_id',
'register',
'status',
'email',
'master_agent',
'service_country',
'type_service',
'type_invoice',
'provider_id',
'policy',
'type_visa',
'start_date',
'end_date',
'net_amount',
'promotion_id',
'payment_method',
'policy_number',
'issue_date',
'payment_note',
'staff_id',
'note',
'location_australia',
'country_id',
'promotion_code',
'remind_status'
        ],
        'tab'=>$tab,
                'element_class_btn_row_edit'=>'customer_data_edit',
        'element_id_row_edit'=>'data-customer'
    ])
@endpush
